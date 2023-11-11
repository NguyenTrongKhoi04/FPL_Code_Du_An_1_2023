<?php
session_start();
ob_start();
include_once '../app/Pdo.php';
include_once '../assets/global/User.php';
include_once '../assets/global/url_Path.php';
include_once './models/AddProduct.php';
include_once './models/ListProduct.php';
include_once './models/UpdateProduct.php';
// include_once 'models/TaiKhoan.php';


if(!empty($_SESSION['user'])){
    // include_once 'views/LoginThuong.php';
}else{
        if(isset($_GET['act'])&&($_GET['act'] !='' )){
        $act = $_GET['act'];
        switch($act){
            case 'AddProduct':
                if($_SERVER['REQUEST_METHOD'] === "POST"){
                    $data = $_POST;
                    $imgData = $_FILES['Image'];
/**
 * ====================================================================================
 *                                 Thêm details
 * ====================================================================================
 */
                $IdDetails = pushProductDetails($data);
/**
 * ====================================================================================
 *                                 Thêm product
 * ====================================================================================
 */
                    pushProduct($data, $imgData, $IdDetails);
                }
                include_once "views/sanpham/AddProduct.php";
            break;
            case 'ListProduct':
/**
 * ====================================================================================
 *                                 Xoa product
 * ====================================================================================
 */
                if(isset($_GET['delete'])&&($_GET['delete'] !='' )){
                    deleteProduct($_GET['delete']);
                }
                include_once "views/sanpham/ListProduct.php";
            break;
            case 'UpdateProduct':
/**
 * ====================================================================================
 *                                 Sửa product
 * ====================================================================================
 */
                if($_SERVER['REQUEST_METHOD'] === 'POST' ){
                    $data = $_POST;
                    $dataImg = $_FILES['Image'];
                    $IdProduct = $_GET["IdProduct"];
                    $IdDetails = $_GET["IdDetails"];
                    updateListProduct($data, $dataImg, $IdProduct, $IdDetails);
                } 

                include_once "views/sanpham/UpdateProduct.php";
            break;


            default:
            // include_once 'views/Home.php';
                break;
        }
    }else{
        include_once 'views/Home.php';
    }    
    }
