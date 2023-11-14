<?php
session_start();
ob_start();
include_once '../app/Pdo.php';
include_once '../assets/global/User.php';
include_once '../assets/global/url_Path.php';
include_once './models/SizeDefault.php';
include_once './models/Category.php';
include_once './models/Size.php';
include_once './models/SubCategories.php';
// include_once 'models/TaiKhoan.php';


if(!empty($_SESSION['user'])){
    // include_once 'views/LoginThuong.php';
}else{
        if(isset($_GET['act'])&&($_GET['act'] !='' )){
        $act = $_GET['act'];
        switch($act){
            /**
             * ====================================================================================
             *                                 SIZE DEFAULT
             * ====================================================================================
             */
            case 'AddSizeDefault':
                if($_SERVER['REQUEST_METHOD'] === "POST"){
                    $data = $_POST;
                    pushSizeDefault($data);
                }
                include_once "views/sizedefault/addSizeDefault.php";

                break;
            case 'ListSizeDefault':
                if(isset($_GET['delete'])&&($_GET['delete'] !='' )){
                    deleteSizeDefault($_GET['delete']);
                } 
                include_once "views/sizedefault/listSizeDefault.php";
                break;
            case 'UpdateSizeDefault':
                if($_SERVER['REQUEST_METHOD'] === 'POST' ){
                    $data = $_POST;
                    
                    $IdSizeDefault = $_GET["IdSizeDefault"];  
                                   
                    updateSizeDefault($data, $IdSizeDefault);
                } 
                include_once "views/sizedefault/updateSizeDefault.php";
                break;
            /**
             * ====================================================================================
             *                                   CATEGORY
             * ====================================================================================
             */
            case 'AddCategory':
                if($_SERVER['REQUEST_METHOD'] === "POST"){
                    $data = $_POST;
                    pushCategory($data);
                }
                include_once "views/danhmuc/AddCategory.php";
                break;
            case 'ListCategory':
                if(isset($_GET['delete'])&&($_GET['delete'] !='' )){
                    deleteCategory($_GET['delete']);
                } 
                include_once "views/danhmuc/ListCategory.php";
                break;
            case 'UpdateCategory':
                if($_SERVER['REQUEST_METHOD'] === 'POST' ){
                    $data = $_POST;
                    var_dump($data);
                    $IdCategory = $_GET["IdCategory"];
                    var_export($IdCategory);              
                    updateCategory($data, $IdCategory);
                } 
                include_once "views/danhmuc/UpdateCategory.php";
                break;
             /**
             * ====================================================================================
             *                                   SIZE
             * ====================================================================================
             */
            case 'AddSize':
                if($_SERVER['REQUEST_METHOD'] === "POST"){
                    $data = $_POST;
                    
                    pushSize($data);

                }
                include_once "views/size/AddSize.php";
                break;
            break;
            case 'ListSize':
                if(isset($_GET['delete'])&&($_GET['delete'] !='' )){
                    deleteSize($_GET['delete']);
                }
                include_once "views/size/ListSize.php";
                break;
            case 'UpdateSize':
                if($_SERVER['REQUEST_METHOD'] === 'POST' ){
                    $data = $_POST;
                    
                    $IdSize = $_GET["IdSize"];
                    
                    updateSize($data, $IdSize);
                } 
                include_once "views/size/UpdateSize.php";
                break;
            /**
             * ====================================================================================
             *                                   SUBCATEGORY
             * ====================================================================================
             */
            case 'AddSubCategories':
                if($_SERVER['REQUEST_METHOD'] === "POST"){
                    $data = $_POST;
                    pushSubCategories($data);
                }
                include_once "views/subcategories/AddSubCategories.php";
                break;
            case 'ListSubCategories':
 
                if(isset($_GET['delete'])&&($_GET['delete'] !='')){
                    deleteSubCategories($_GET['delete']);
                }
                include_once "views/subcategories/ListSubCategories.php";
                break;
             case 'UpdateSubCategories':
                if($_SERVER['REQUEST_METHOD'] === 'POST' ){
                    $data = $_POST;
                   
                    if(isset($_GET["IdSubCategories"])) {
                        $IdSubCategories = $_GET["IdSubCategories"];   
                    }else{
                        $IdSubCategories = $data['IdSubCategories'];
                    }

                    updateSubCategories($data, $IdSubCategories);
                }
                include_once "views/subcategories/UpdateSubCategories.php";
                break;    
            default:
            // include_once 'views/Home.php';
                break;
        }
    }else{
        include_once 'views/sizedefault/addSizeDefault.php';
    }    
    }
