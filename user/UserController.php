<?php
session_start();
ob_start();
include_once '../app/Pdo.php';
include_once '../assets/global/User.php';
include_once '../assets/global/Img_Path.php';
include_once 'models/TaiKhoan.php';
include_once '../assets/global/Header.php';

if(isset($_GET['act'])&&($_GET['act'] !='' )){
    if(empty($_SESSION['user'])){
        header('location: views/LoginThuong.php');
    }else{
        $act = $_GET['act'];
        switch($act){
            case 'dangnhap':
                checkTaiKhoan($_POST['tk'],$_POST['mk']);
                break;
            default:
            include_once 'views/Home.php';
                break;
        }
    }
    }else{
        include_once 'views/BillPayment.php';
    }    

include_once '../assets/global/Footer.php';