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
$_SESSION['user'] = [
    "IdAccount" => 6,
    "NameAccount" => "Vu Hong Diep",
    "Gmail" => "diepvhph36272@fpt.edu.vn",
    "Gender" => 0,
    "Password" => "diepvhph36272@fpt.edu.vn",
    "ImageAccounts" => "z4419639034081_72f3de1996280290798889601b1c9568.jpg",
    "StatusAccount" => 0,
    "Role" => 0,
    "DateEditAccount" => "0000-00-00 00:00:00"
];
// Tiến hành kiểm tra xem ngày tháng người dùng đã order bàn
if (isset($_SESSION['bookingTable']) && !empty($_SESSION['bookingTable'])) {
    $time = new DateTime();
    $time->setTimezone(new DateTimeZone("Asia/Ho_Chi_Minh"));
    $realTime = $time->format('Y-m-d\TH:i');

    $Date = $_SESSION['bookingTable']["data"]["Date"];
    $IdTable = $_SESSION['bookingTable']["data"]["IdTable"];
    $NumberPeopleInTables = $_SESSION['bookingTable']["data"]["NumberPeopleInTables"];
    $idAccountBooking = $_SESSION['bookingTable']["idAccount"];
    $dataTimesBefore = (int)$_SESSION['bookingTable']["data"]["Date"] + 3600;

    if (strtotime($realTime) === strtotime($dataTimesBefore)) {
        $sqlOrder = "insert into order values(null, '$IdTable', '$idAccountBooking', null, 0,'$Date')";
        $sqlTable = "update tables set StatusTable = 0, NumberPeople = '$NumberPeopleInTables 'where IdTable = $IdTable"; 
        pdo_Execute($sqlTable);
        pdo_Execute($sqlOrder);
        $_SESSION['bookingTable'] = '';
    }
}

if (isset($_GET['act']) && ($_GET['act'] != '')) {
    $idAccountUser = $_SESSION['user']["IdAccount"];
    if (empty($_SESSION['user'])) {
        include_once 'views/LoginThuong.php';
    } else {
        $act = $_GET['act'];
        switch ($act) {
            case 'dangnhap':
                if ($_SESSION['user']['Type'] == 1) {
                    header('location: ../admin/AdminController.php');
                } else
                    include_once 'views/Home.php';
                break;
            case 'trangchu':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $dataBooking = $_POST;
                    $alert = home_BookingTable($dataBooking);
                }
                include_once 'views/Home.php';
                break;

            case 'billthanhtoan':
                include_once 'views/BillPayment.php';
                break;

            case 'ChiTietSanPham':
                include_once 'views/ChiTietSanPham.php';
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
            case "VerifyAccount":
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $dataVerifyAccount = $_POST;
                    $alert = CreateAccount_CreateAccount1($dataVerifyAccount);
                }
                include_once 'views/VerifyAccount.php';
                break;
            case 'GioHang':
                $dataCart = cart_GetAllCartByIdAccount($idAccountUser);
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    echo "<pre>";
                    var_dump($_POST); die();
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
