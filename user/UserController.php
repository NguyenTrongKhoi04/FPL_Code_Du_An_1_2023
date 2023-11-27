<?php
session_start();
ob_start();
include_once '../app/Pdo.php';
include_once '../assets/global/User.php';
include_once '../assets/global/url_Path.php';
include_once 'models/Login.php';
include_once '../assets/global/Header.php';
include_once "../assets/global/Validate.php";
include_once "../assets/global/SendGmail.php";
include_once 'models/Login.php';
include_once 'models/Home.php';
include_once 'models/ProductPortfolio.php';
include_once 'models/Cart.php';
include_once 'models/CreateAccount.php';
include_once 'models/ChiTietSanPham.php';
include_once 'models/DatBan.php';
include_once 'models/LoginNhanh.php';


check_LoginNhanh();
check_Login();

if(isset($_GET['act'])&&($_GET['act'] !='' )){
    if(empty($_SESSION['user'])){
        if($_GET['act']=='dangnhap_AnTaiQuan'){
            include_once 'views/LoginNhanh.php';
        }else{
            include_once 'views/LoginThuong.php';
        }
    } else {
        $act = $_GET['act'];
        switch($act){
        /**
            * ====================================================================================
            *                                 LOGIN - LOGOUT
            * ====================================================================================
            */
            case 'dangnhap':
                if ($_SESSION['user']['Role'] == 1) {
                    header('location: ../admin/AdminController.php');
                } else {
                    $loadHeader = 0;
                    if ($loadHeader == 0) {
                        header('location: UserController.php');
                        include_once 'views/Home.php';
                        $loadHeader = 1;
                    }
                }
                break;
            
            case 'dangnhap_AnTaiQuan':
                header('location: UserController.php?act=ListBan');
                include_once 'views/LoginNhanh.php';
                break;
            case 'dangxuat':
                session_destroy();
                header('location: UserController.php');
                break;
        /**
            * ====================================================================================
            *                                 DANG KY
            * ====================================================================================
            */
            case 'TaoTaiKhoan':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $dataAccount = $_POST;
                    $alert = CreateAccount_CreateAccount($dataAccount);
                    if ($alert === "") {
                        header("location: UserController.php?act=VerifyAccount");
                    }
                }
                include_once 'views/CreateAccount.php';
                break;
            case "VerifyAccount":
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $dataVerifyAccount = $_POST;
                    $alert = CreateAccount_CreateAccount1($dataVerifyAccount);
                }
                include_once 'views/VerifyAccount.php';
                break;
        /**
            * ====================================================================================
            *                                     HOME
            * ====================================================================================
            */     
            case 'trangchu':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $dataBooking = $_POST;
                    $alert = home_BookingTable($dataBooking);
                }
                include_once 'views/Home.php';

        /**
            * ====================================================================================
            *                                PRODUCT PORTFOLIO
            * ====================================================================================
            */            
            case 'DanhMucSanPham':
                if (isset($_GET['idCategory']) && !empty($_GET['idCategory'])) {
                    $idCategory = $_GET['idCategory'];
                    $dataProductPortfolio = productPortfolio_GetAllProduct($idCategory);
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        extract($_POST);
                        $GetAllProductAsRequested = productPortfolio_GetAllProductAsRequested($price, $product, $idCategory);
                    }
                    include_once 'views/ProductPortfolio.php';
                } else {
                    if($_SESSION['user']['Role']==3){
                        include_once 'views/ProductPortfolio.php';
                    }else{include_once 'views/Home.php';}
                }
                break;
        /**
            * ====================================================================================
            *                                CHI TIET SAN PHAM
            * ====================================================================================
            */     
            case 'LoadChiTietSanPham':
                $id = $_GET['id'];
                $pro = chiTietSanPham_LoadAll($id);
                $proSize = chiTietSanPham_LoadSizePro($id);
                $proDetails = chiTietSanPham_LoadDetails($id);
                // lấy danh mục và danh mục phụ của $pro để tìm ra được các sản phẩm Cùng loại
                $pro_LienQuan = chiTietSanPham_ProCungLoai($pro['IdCategory'],$pro['NameProduct']);

                // lấy top 3 sản phẩm bán chạy
                    // $top3_Pro = top3_SanPham() ;

                // Thêm vào giỏ hàng user
                if(isset($_POST['add_to_cart'])){
                    extract($_POST);
                    $priceQuantity = $pro['PriceProduct'] * $Quantity;
                    chiTietSanPham_Add_To_Cart($_SESSION['user']['IdAccount'],$SizeProduct,$Quantity,$priceQuantity);
                }
                include_once 'views/ChiTietSanPham.php';
                break;
        /**
            * ====================================================================================
            *                                     BILL
            * ====================================================================================
            */     
                case 'GioHang':
                    $dataCart = cart_GetAllCartByIdAccount($idAccountUser);
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        cart_UpdateCart($_POST["quantity"]);
                        $_SESSION['dataCarts'] = cart_GetAllCartByIdAccount($idAccountUser);
                        // chuyển sang chọn bàn 
                    }
                    if (isset($_GET['Delete']) && ($_GET['Delete'] != '')) {
                        if(cart_Delete($_GET['Delete']) === null){
                            $alert = "Xóa sản phẩm thành công";
                            header("location: UserController.php?act=GioHang");
                        }
                    }
                    include_once 'views/Cart.php';
                    break;
                case 'LoginNhanh_GioHang':
                    $dataCart = cart_GetAllCartByIdAccount($_SESSION['user']['IdAccount']);
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        cart_UpdateCart($_POST["quantity"]);
                        $_SESSION['dataCarts'] = cart_GetAllCartByIdAccount($idAccountUser);
                        // chuyển sang chọn bàn 
                    }
                    if (isset($_GET['Delete']) && ($_GET['Delete'] != '')) {
                        if(cart_Delete($_GET['Delete']) === null){
                            $alert = "Xóa sản phẩm thành công";
                            header("location: UserController.php?act=LoginNhanh_GioHang");
                        }
                    }
                    include_once 'views/LoginNhanh_Cart.php';
                    break;
        /**
            * ====================================================================================
            *                                     BILL
            * ====================================================================================
            */        
            case 'billthanhtoan':
                include_once 'views/BillPayment.php' ;
                break; 
           
        /**
            * ====================================================================================
            *                                 BAN
            * ====================================================================================
            */
            case 'ListBan':
                $arrBanFull = list_BanCoNguoiNgoi();
                If($_SERVER['REQUEST_METHOD']==='POST'){
                    extract($_POST);
                    if(!isset($ban_check)){
                        echo "<script>alert('Vui lòng chọn bàn')</script>";
                        header("loaction:UserController?act=ListBan");
                    }else{
                        echo"<pre>";
                        print_r($_POST);
                        echo"</pre>";   
                    }
                }
                include_once 'views/DatBan.php';    

            default:
                include_once 'views/Home.php';
                break;
        }
    }
} else {
    include_once 'views/Home.php';
}

include_once '../assets/global/Footer.php';