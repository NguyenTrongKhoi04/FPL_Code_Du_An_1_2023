<?php
session_start();
ob_start();
include_once '../app/Pdo.php';
include_once '../assets/global/User.php';
include_once '../assets/global/url_Path.php';
include_once 'models/TaiKhoan.php';
include_once '../assets/global/Header.php';

check_Login();

if(isset($_GET['act'])&&($_GET['act'] !='' )){
    if(empty($_SESSION['user'])){
        include_once 'views/LoginThuong.php';
    }else{
        $act = $_GET['act'];
        switch($act){
            case 'dangnhap':
                if($_SESSION['user']['Type']==1){
                    header('location: ../admin/AdminController.php');
                }else
                include_once 'views/Home.php';
                break;

            case 'billthanhtoan':
                include_once 'views/BillPayment.php' ;
                break; 
            default:
            include_once 'views/Home.php';
                break;
        }
    }
    }else{
        include_once 'views/Home.php';
    }    

include_once '../assets/global/Footer.php';