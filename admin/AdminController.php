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
include_once './models/accompanyingfood.php';
include_once './models/Order.php';
include_once './models/Bill.php';
include_once './models/Card.php';
include_once './models/Comment.php';
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
                    if(isset($_GET["IdSize"])) {
                        $IdSize = $_GET["IdSize"];   
                    }else{
                        $IdSize = $data['IdSize'];
                    }
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
            /**
             * ====================================================================================
             *                                  ACCOMPANYINGFOOD
             * ====================================================================================
             */  
            case 'AddAccompanyingfood':
                if($_SERVER['REQUEST_METHOD'] === "POST"){
                    extract($_POST);
                    extract($_FILES);
               
                    $imgName = $ImageAccompanyingFood['name'];
                    move_uploaded_file($ImageAccompanyingFood['tmp_name'],$adminImg.$imgName);
                    pushAccompanyingfood($IdProduct, $NameAccompanyingFood, $QuantityAccompanyingFood, $PriceAccompanyingFood,  $imgName);
                        
                }
                include_once "views/accompanyingfood/AddAccompanyingfood.php";
                break;
            case 'ListAccompanyingfood':
                if(isset($_GET['delete'])&&($_GET['delete'] !='')){

                    deleteAccompanyingfood($_GET['delete']);
                }
                include_once "views/accompanyingfood/ListAccompanyingfood.php";
                break;
            case 'UpdateAccompanyingfood':
                if($_SERVER['REQUEST_METHOD'] === "POST"){
                    extract($_POST);
                    extract($_FILES);
               
                    $imgName = $ImageAccompanyingFood['name'];
               
                    if(isset($_GET["IdAccompanyingFood"])) {
                        $IdAccompanyingFood = $_GET["IdAccompanyingFood"];   
                    }//else{
                    //     $IdAccompanyingFood = 'IdAccompanyingFood';
                    // } 
                     move_uploaded_file($ImageAccompanyingFood['tmp_name'],$adminImg.$imgName);
                    pushAccompanyingfood($IdAccompanyingFood, $IdProduct, $NameAccompanyingFood, $QuantityAccompanyingFood, $PriceAccompanyingFood, $imgName, $StatusAccompanyingFood );
                        
                }
                include_once "views/accompanyingfood/AddAccompanyingfood.php";
            /**
             * ====================================================================================
             *                                  ACCOMPANYINGFOOD
             * ====================================================================================
             */ 
            case 'AddOrders':
                if($_SERVER['REQUEST_METHOD'] === "POST"){
                    $data = $_POST;    
                   
                    pushOrder($data);
                }
                include_once "views/orders/AddOrders.php";
                break;
            case 'ListOrders':
                if(isset($_GET['delete'])&&($_GET['delete'] !='')){
                    deleteOrder($_GET['delete']);
                 }
                include_once "views/orders/ListOrders.php";
                break;
            case 'UpdateOrders':
                if($_SERVER['REQUEST_METHOD'] === 'POST' ){
                    $data = $_POST;
              
                    if(isset($_GET["IdOder"])) {
                        $IdOder = $_GET["IdOder"];   
                    }else{
                        $IdOder = $data['IdOder'];
                    }
                    updateOrder($data, $IdOder);
                }
                include_once "views/orders/UpdateOrders.php";
                break;
            /**
             * ====================================================================================
             *                                 BILL
             * ====================================================================================
             * IdBill	IdAccount	IdProduct	IdTable	IdAccompanyingFood	QuantityBill	PriceBill	StatusBill	DateEditBill	NoteBill	PaymentsBill	
             */
            case 'AddBill':
                if($_SERVER['REQUEST_METHOD'] === "POST"){
                    $data = $_POST;    
                   
                    pushBill($data);
                }
                include_once "views/bill/AddBill.php";
                break;
            case 'ListBill':
                if(isset($_GET['delete'])&&($_GET['delete'] !='')){
                    deleteBill($_GET['delete']);
                 }
                include_once "views/bill/ListBill.php";
                break;
            case 'UpdateBill':
                if($_SERVER['REQUEST_METHOD'] === 'POST' ){
                    $data = $_POST;
                  
                    if(isset($_GET["IdBill"])) {
                         $IdBill = $_GET["IdBill"];   
                    }else{
                        $IdBill = $data['IdBill'];
                    }
                    updateBill($data, $IdBill);
                    }
                 include_once "views/bill/UpdateBill.php";
                 break;   
            /**
             * ====================================================================================
             *                                 CARD
             * ====================================================================================
             * 	IdCart	IdAccount	IdProduct	IdSize	Quantity	Price	
             */
            case 'AddCard':
                if($_SERVER['REQUEST_METHOD'] === "POST"){
                    $data = $_POST;    
                    
                    pushCard($data);

                }
                include_once "views/card/AddCard.php";
                break;
            case 'ListCard':
                if(isset($_GET['delete'])&&($_GET['delete'] !='')){
                       deleteBill($_GET['delete']);
                 }
                include_once "views/card/ListCard.php";
                break;
            case 'UpdateCard':
                if($_SERVER['REQUEST_METHOD'] === 'POST' ){
                   $data = $_POST;
                      
                    if(isset($_GET["IdCart"])) {
                         $IdCart = $_GET["IdCart"];   
                   }else{
                        $IdCart = $data['IdCart'];
                   }
                   updateCard($data, $IdCart);
                    }
                 include_once "views/card/UpdateCard.php";
                 break;
            
            /**
             * ====================================================================================
             *                                 COMMENT
             * ====================================================================================
             * 	  //IdComment	IdAccount	IdProduct	Content	StatusComment	DateEditComment	
             */
            case 'ListComment':
                if(isset($_GET['delete'])&&($_GET['delete'] !='')){
                    deleteComment($_GET['delete']);
                 }
                include_once "views/comment/ListComment.php";
                break;
             case 'UpdateComment':
                if($_SERVER['REQUEST_METHOD'] === 'POST' ){
                   $data = $_POST;
                          
                    if(isset($_GET["IdComment"])) {
                         $IdComment = $_GET["IdComment"];   
                   }else{
                        $IdComment = $data['IdComment'];
                   }
                   updateComment($data, $IdComment);
                    }
                 include_once "views/comment/UpdateComment.php";
            default:
            // include_once 'views/Home.php';
                break;
        }
    }else{
        include_once 'views/sizedefault/addSizeDefault.php';
    }    
    }
  // IdOder	IdTable	IdAccompanyingFood	IdProduct	IdAccount	PriceOrders	StatusOrders	QuantityOrders	NoteOrders	