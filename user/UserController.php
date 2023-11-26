<?php
session_start();
ob_start();
include_once '../app/Pdo.php';
include_once '../assets/global/User.php';
include_once '../assets/global/url_Path.php';
include_once '../assets/global/Header.php';
include_once "../assets/global/Validate.php";
include_once "../assets/global/SendGmail.php";
include_once 'models/ChiTietSanPham.php';
include_once 'models/Login.php';
include_once 'models/Home.php';
include_once 'models/ProductPortfolio.php';
include_once 'models/Cart.php';
include_once 'models/CreateAccount.php';
include_once 'models/DatBan.php';

check_Login();


if(isset($_GET['act'])&&($_GET['act'] !='' )){
    if(empty($_SESSION['user'])){
        include_once 'views/LoginThuong.php';
        // }
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
                        header("Location: UserController.php?act=VerifyAccount");
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
                    include_once 'views/Home.php';
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
                    $alert = chiTietSanPham_Add_To_Cart($IdProduct, $_SESSION['user']['IdAccount'],$SizeProduct,$Quantity,$priceQuantity);
                }
                include_once 'views/ChiTietSanPham.php';
                break;
        /**
            * ====================================================================================
            *                                     Gio Hang
            * ====================================================================================
            */     
                case 'GioHang':
                    $idAccountUser = $_SESSION['user']["IdAccount"];
                    $dataCart = cart_GetAllCartByIdAccount($idAccountUser);
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        cart_UpdateCart($_POST["quantity"]);
                        $_SESSION['dataOrderCart'] = cart_GetAllCartByIdAccount($idAccountUser);
                        header("Location: UserController.php?act=ListBan");
 
                    }
                    if (isset($_GET['Delete']) && ($_GET['Delete'] != '')) {
                        if(cart_Delete($_GET['Delete']) === null){
                            $alert = "Xóa sản phẩm thành công";
                            header("Location: UserController.php?act=GioHang");
                        }
                    }
                    include_once 'views/Cart.php';
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
                If($_SERVER['REQUEST_METHOD']==='POST'){ 
                    extract($_POST);
                    if(!isset($contentTable)){
                        echo "<script>alert('Vui lòng chọn bàn...')</script>";
                    }else{
                        $alert = datBan_CheckBookingTables($_POST);
                        if($alert === true){
                            header("Location: UserController.php?act=billthanhtoan");
                        }else{
                            echo "<script>alert($alert)</script>";
                        }
                    }
                }
                include_once 'views/DatBan.php';    

                break;
                case "CashViSa":
                    include_once 'views/CashViSa.php' ;
                    break;
                case "CashPayment":
                    break;


            default:
                include_once 'views/Home.php';
                break;
        }
    }
} else {
    include_once 'views/Home.php';
}

include_once '../assets/global/Footer.php';
