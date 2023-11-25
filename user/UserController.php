<?php
session_start();
ob_start();
include_once '../app/Pdo.php';
include_once '../assets/global/User.php';
include_once '../assets/global/url_Path.php';
include_once '../assets/global/Header.php';
include_once "../assets/global/Validate.php";
include_once "../assets/global/SendGmail.php";
include_once 'models/Login.php';
include_once 'models/Home.php';
include_once 'models/ProductPortfolio.php';
include_once 'models/Cart.php';
include_once 'models/CreateAccount.php';

check_Login();
if (isset($_GET['act']) && ($_GET['act'] != '')) {
    $idAccountUser = $_SESSION['user']["IdAccount"];
    if (empty($_SESSION['user'])) {
        include_once 'views/LoginThuong.php';
    } else {
        $act = $_GET['act'];
        switch ($act) {
             /**
         * ====================================================================================
         *                                 LOGIN - LOGOUT
         * ====================================================================================
         */
            case 'dangnhap':
                if ($_SESSION['user']['Type'] == 1) {
                    header('location: ../admin/AdminController.php');
                } else
                    include_once 'views/Home.php';
                break;
            case 'TaoTaiKhoan':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $dataAccount = $_POST;
                    $alert = CreateAccount_CreateAccount($dataAccount);
                    if ($alert === "") {
                        header("location: http://localhost:3000/user/UserController.php?act=VerifyAccount");
                    }
                }
                include_once 'views/CreateAccount.php';
                break;
         /**
            * ====================================================================================
            *                                 bill
            * ====================================================================================
            */        
            case "VerifyAccount":
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $dataVerifyAccount = $_POST;
                    $alert = CreateAccount_CreateAccount1($dataVerifyAccount);
                }
                include_once 'views/VerifyAccount.php';
                break;
            case 'trangchu':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $dataBooking = $_POST;
                    $alert = home_BookingTable($dataBooking);
                }
                include_once 'views/Home.php';
                break;
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
                        header("loaclhost: UserController.php?act=GioHang");
                    }
                }
                include_once 'views/Cart.php';
                break;
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
            default:
                include_once 'views/Home.php';
                break;
        }
    }
} else {
    include_once 'views/Home.php';
}

include_once '../assets/global/Footer.php';
