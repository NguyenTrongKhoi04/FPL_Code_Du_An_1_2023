<?php
session_start();
ob_start();
include_once '../app/Pdo.php';
include_once '../assets/global/User.php';
include_once '../assets/global/url_Path.php';
include_once 'models/TaiKhoan.php';
include_once 'models/Ban.php';

if (empty($_SESSION['user'])) {
    header('location: ../user/UserController.php');
} else {
    if (isset($_GET['act']) && ($_GET['act'] != '')) {
        $act = $_GET['act'];
        switch ($act) {
            /**
             * ====================================================================================
             *                                 TÀI KHOẢN
             * ====================================================================================
             */
            case 'ListBan':
                $listBan = select_All('tables');
                include_once "views/ban/ListBan.php";
                break;

            case 'UpdateBan':
                $id = $_GET['id'];
                $ban_One = select_One('tables', null, "IdTable = $id");
                if (isset($_POST['update']) && ($_POST['update'] != '')) {
                    extract($_POST);
                    //xử lý timestamp trong sql
                    $_POST['Date'] = strtotime($_POST['Date']);
                    updateBan($id, $NumberPeopleInTables, $NumberTables, $StatusTables, $Date);
                    $error = "Update Thành Công";
                    header("location:" . $adminAction . "ListBan");
                }
                include_once "views/ban/UpdateBan.php";
                break;
            default:
                // include_once 'views/Home.php';
                break;
        }
    } else {
        include_once 'views/taikhoan/ListAccount.php';
    }
}
