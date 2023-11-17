<?php
session_start();
ob_start();
include_once '../app/Pdo.php';
include_once '../assets/global/User.php';
include_once '../assets/global/url_Path.php';
include_once 'models/Login.php';
include_once 'models/Home.php';
include_once 'models/ProductPortfolio.php';
include_once '../assets/global/Header.php';

check_Login();
$_SESSION['user']= "test";
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
            case 'trangchu':
                if($_SERVER['REQUEST_METHOD'] === 'POST' ){
                    $dataBooking = $_POST;
                    $alert = home_BookingTable($dataBooking);
                } 
                include_once 'views/Home.php';                
                break;

            case 'billthanhtoan':
                include_once 'views/BillPayment.php' ;
                break; 

            case 'ChiTietSanPham':
                include_once 'views/ChiTietSanPham.php' ;
                break; 
            case 'TaoTaiKhoan':
                include_once 'views/CreateAccount.php' ;
                break; 
            case 'DanhMucSanPham':
                if(isset($_GET['idCategory'])&&!empty($_GET['idCategory'])){
                    $idCategory = $_GET['idCategory'];
                    $dataProductPortfolio = productPortfolio_GetAllProduct($idCategory);
                    if($_SERVER['REQUEST_METHOD'] === 'POST' ){
                        extract($_POST);
                        $GetAllProductAsRequested = productPortfolio_GetAllProductAsRequested($price, $product, $idCategory); 
                        

                    } 
                    include_once 'views/ProductPortfolio.php' ;

                }else{
                    include_once 'views/Home.php';
                }
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