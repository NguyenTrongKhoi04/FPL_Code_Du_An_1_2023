<?php
session_start();
ob_start();
include_once '../app/Pdo.php';
include_once '../assets/global/User.php';
include_once '../assets/global/url_Path.php';
// include_once 'models/TaiKhoan.php';


if(empty($_SESSION['user'])){
    // include_once 'views/LoginThuong.php';
}else{
        if(isset($_GET['act'])&&($_GET['act'] !='' )){
        $act = $_GET['act'];
        switch($act){
            case '':
        
                break;

            default:
            // include_once 'views/Home.php';
                break;
        }
    }else{
        include_once 'views/Home.php';
    }    
    }
