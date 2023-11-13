<?php
session_start();
ob_start();
include_once '../app/Pdo.php';
include_once '../assets/global/User.php';
include_once '../assets/global/url_Path.php';
include_once './models/Product.php';
include_once './models/Account.php';

// include_once 'models/TaiKhoan.php';


if(!empty($_SESSION['user'])){
    // include_once 'views/LoginThuong.php';
}else{
        if(isset($_GET['act'])&&($_GET['act'] !='' )){
        $act = $_GET['act'];
        switch($act){
            /**
             * ====================================================================================
             *                                 Thêm product
             * ====================================================================================
             */
            case 'AddProduct':
                if($_SERVER['REQUEST_METHOD'] === "POST"){
                    $data = $_POST;
                    $imgData = $_FILES['Image'];
                    $IdDetails = pushProductDetails($data);
                    $alert= pushProduct($data, $imgData, $IdDetails);
                    
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
                    $alert = deleteProduct($_GET['delete']);
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
                    $alert= updateListProduct($data, $dataImg, $IdProduct, $IdDetails);
                } 
                include_once "views/sanpham/UpdateProduct.php";
            break;
            /**
             * ====================================================================================
             *                                 Thêm account
             * ====================================================================================
             */
            case 'AddAccount':
                if($_SERVER['REQUEST_METHOD'] === 'POST' ){
                    $dataProduct = $_POST;
                    $dataImg = $_FILES['Image'];

                    pushAcount($dataProduct, $dataImg);
                } 
                include_once "views/taikhoan/AddAccount.php";
            break;

            case "ListAccount":
                /**
                 * ====================================================================================
                 *                                 Xoa account
                 * ====================================================================================
                 */
                if(isset($_GET['delete'])&&($_GET['delete'] !='' )){
                    deleteAccount($_GET['delete']);
                }                
                include_once "views/taikhoan/ListAccount.php";
            break;

            /**
             * ====================================================================================
             *                                 Sửa account
             * ====================================================================================
             */
            case "UpdateAccount":
                if($_SERVER['REQUEST_METHOD'] === 'POST' ){
                    $data = $_POST;
                    $dataImg = $_FILES['Image'];
                    $IdAccount = $_GET["IdAccount"];
                    updateListAccount($data, $dataImg, $IdAccount);
                } 
                include_once "views/taikhoan/UpdateAccount.php";
            break;            
            default:
            // include_once 'views/Home.php';
                break;
        }
    }else{
        include_once 'views/Home.php';
    }    
    }
