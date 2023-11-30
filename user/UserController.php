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
include_once 'models/CashViSa.php';
include_once 'models/BillPayment.php';
include_once 'models/AddComments.php';
include_once 'models/ListComment.php';

check_Login();
home_checkAndOrderAuto();

if(isset($_GET['act'])&&($_GET['act'] !='' )){
    if(empty($_SESSION['user'])){
        include_once 'views/LoginThuong.php';
    } else {
        $act = $_GET['act'];
        $idAccountUser = $_SESSION['user']["IdAccount"];
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
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        extract($_POST);
                        $GetAllProductAsRequested = productPortfolio_GetAllProductAsRequested($price, $product, $idCategory);
                    } else {
                        $dataProductPortfolio = productPortfolio_GetAllProduct($idCategory);
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
                if(isset($_GET['index']) && isset($_GET['id'])){
                    $id = $_GET['id'];
                    $pro = chiTietSanPham_LoadAll($id);
                    $proSize = chiTietSanPham_LoadSizePro($id);
                    $proDetails = chiTietSanPham_LoadDetails($id);
                    $dataComment = chiTietSanPham_GetComment($_GET['index']);
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
                    if(isset($_POST['pay_now'])){
                        $_SESSION['payNowDetails'] = $_POST;
                        header("Location: UserController.php?act=ListBan");
    
                    }

                }else{
                    header("Location: UserController.php");
                }
                include_once 'views/ChiTietSanPham.php';
                break;
        /**
            * ====================================================================================
            *                                     Gio Hang
            * ====================================================================================
            */     
            case 'GioHang':
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
                $listOrderPayMent = BillPayment_GetOrderPayment($idAccountUser);
                include_once 'views/BillPayment.php' ;
                break; 
           
        /**
            * ====================================================================================
            *                                 BAN
            * ====================================================================================
            */
            case 'ListBan':
                if($_SERVER['REQUEST_METHOD']==='POST'){ 
                    extract($_POST);
                    if(!isset($contentTable)){
                        echo "<script>alert('Vui lòng chọn bàn...')</script>";
                    }else{
                        $alert = datBan_CheckBookingTables($_POST);
                        if($alert === true){
                            header("Location: UserController.php?act=CashViSa");
                        }else{
                            echo "<script>alert('$alert')</script>";
                        }
                    }
                }
                include_once 'views/DatBan.php';    
                    break;

        /**
            * ====================================================================================
            *                                 CashViSa
            * ====================================================================================
            */            
            case "CashViSa":
                $listOrderUser = CashViSa_GetAllOrderUser();
                if($_SERVER['REQUEST_METHOD']==='POST'){ 
                    $alert = CashViSa_PushOrderUser();
                    echo "<script> alert('$alert') </script>";
                    // header("Location: UserController.php?act=BillPayment");
                }
                include_once 'views/CashViSa.php' ;
                break;
        /**
            * ====================================================================================
            *                                 CashPayment
            * ====================================================================================
            */  
            case "CashPayment":
                break;
            case "AddComment":
                $listOrderPayMent = BillPayment_GetOrderPayment($idAccountUser);
                $listComment = AddComments_GetComment($idAccountUser);
                if($_SERVER['REQUEST_METHOD']==='POST'){ 
                    if(isset($_GET['idProduct']) && isset($_GET['IdOrder'])){
                        $IdProduct = $_GET['idProduct'];
                        $IdOrder = $_GET['IdOrder'];
                        $alert = AddComments_AddComment($IdProduct, $idAccountUser, $_POST, $IdOrder);
                        if($alert === null){
                            echo " <script> alert('$alert') </script> ";
                        }else{
                            echo " <script> alert('Hệ thống đang bảo trì') </script> ";

                        }
                    }
                }
                include_once 'views/AddComments.php';
                break;
            case "ListComment":
                $listOrderPayMent = BillPayment_GetOrderPayment($idAccountUser);
                $listComment = ListComment_GetAllComment($idAccountUser);
                if($_SERVER['REQUEST_METHOD']==='POST' && isset($_GET['IdComment'])){ 
                    $IdComment = $_GET['IdComment'];
                    if(isset($_POST["delete"])){
                        ListComment_DeleteComment($IdComment);
                        header("Location: UserController.php?act=ListComment");
                    }else{
                        extract($_POST);
                        ListComment_UpdateComment($IdComment, $content);
                        header("Location: UserController.php?act=ListComment");
                        
                    }
                }
                include_once 'views/ListComment.php';
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
echo "<script>
setTimeout(function(){
    location.reload();
  }, 60000); 
</script>"
?>
