<?php
session_start();
ob_start();

include_once '../app/Pdo.php';
include_once '../assets/global/User.php';
include_once '../assets/global/url_Path.php';
include_once './models/Size.php';
include_once './models/Category.php';
include_once './models/SizePro.php';
include_once './models/SubCategories.php';
include_once './models/Account.php';
include_once './models/Order.php';
include_once './models/OrderPro.php';
include_once './models/Bill.php';
include_once './models/Cart.php';
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
             *                                     SIZE 
             * ====================================================================================
             */
            case 'AddSize':
                if($_SERVER['REQUEST_METHOD'] === "POST"){

                    $data = $_POST;
                    extract($data);
                    $checkSize = check_Size($NameSize);
                    if(is_array($checkSize)){
                        $mes = 'Size đã tồn tại ';
                    }
                    else{
                        pushSize($data);
                        $mes = 'Thêm size thành công' ;
                    }

                    
                }
                include_once "views/size/addSize.php";

                break;
            case 'ListSize':
                if(isset($_GET['delete'])&&($_GET['delete'] !='' )){
                    deleteSize($_GET['delete']);
                } 
                include_once "views/size/listSize.php";
                break;
            case 'UpdateSize':
                if($_SERVER['REQUEST_METHOD'] === 'POST' ){
                    $data = $_POST;
                    
                    $IdSize = $_GET["IdSize"];  
                                   
                    updateSize($data, $IdSize);
                } 
                include_once "views/size/updateSize.php";
                break;
            /**
             * ====================================================================================
             *                                   CATEGORY
             * ====================================================================================
             */
            case 'AddCategory':
                if($_SERVER['REQUEST_METHOD'] === "POST"){

                    $data = $_POST;
                    extract($data);

                    $CheckCategory = check_Category($NameCategory);
                        if(is_array($CheckCategory)){
                            $mes = 'Danh mục đã tồn tại';
                        }else{
                            pushCategory($data);
                            $mes = 'Thêm thành công danh mục ';
                        }
                    
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
             *                                   SIZEPRO
             * ====================================================================================
             */
            case 'AddSizePro':
                if($_SERVER['REQUEST_METHOD'] === "POST"){

                    $data = $_POST;
                    extract($data);
                    
                    $checkSizePro = check_SizePro($IdProduct,$IdSize);

                    if(is_array($checkSizePro)){
                        $mes = 'Size này đã tồn tại mời chọn lại ';
                    }
                    else{
                            pushSizePro($data);
                            $mes = 'Thêm thành công ';
                    }


                    
                }
                include_once "views/sizepro/AddSizePro.php";
                break;
            break;
            case 'ListSizePro':
                if(isset($_GET['delete'])&&($_GET['delete'] !='' )){
                    deleteSize($_GET['delete']);
                }
                include_once "views/sizepro/ListSizePro.php";
                break;
            case 'UpdateSizePro':
                if($_SERVER['REQUEST_METHOD'] === 'POST' ){
                    $data = $_POST;
                    
                    if(isset($_GET["IdSizePro"])) {
                        $IdSizePro = $_GET["IdSizePro"];   
                    }else{
                        $IdSizePro = $data['IdSizePro'];
                    }
                    updateSizePro($data, $IdSizePro);
                } 
                include_once "views/sizepro/UpdateSizePro.php";
                break;
            /**
             * ====================================================================================
             *                                   SUB CATEGORY
             * ====================================================================================
             */
            case 'AddSubCategories':
                if($_SERVER['REQUEST_METHOD'] === "POST"){

                    $data = $_POST;
                    extract($data);
                    $checkSubCategories = check_subcategories($NameSubCategories);
                    if(is_array($checkSubCategories)){
                        $mes = ' Danh mục phụ đã tồn tại';
                    }else{
                        pushSubCategories($data);
                        $mes = 'Thêm danh mục phụ thành công';
                    }
                    
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
             *                                           ACCOUNT	
             * ====================================================================================
             */  
            case 'AddAccount':
                if($_SERVER['REQUEST_METHOD'] === "POST"){
                    extract($_POST);
                    extract($_FILES);
                    $check_Gmail = check_Gmail_Account($Gmail);// nếu tồn tại => chứa dữ liệu (mảng)
                    $imgName = isset($ImageAccounts['name']) ? $ImageAccounts['name'] :'';
                    if (is_array($check_Gmail)) {
                        $mes = "Tài khoản này đã tồn tại";
                    } else {
                            if(!preg_match("/^(?=.*[A-Z-a-z])(?=.*[0-9])(?=.*[a-z].*)(?=.*[a-z].*)(?=.*[!@#\$%\^\*\(\)-\+]).{8,}$/", $Password) ){
                                 $mes = 'Sai định dạng mật khẩu (có ít nhất 1 số, 1 chữ cái viết thường và hoa, 1 ký tự đặc biệt)';
                            }else{
                               if($imgName != ''){//nếu nộp ảnh
                            
                                $duoianh = pathinfo($imgName, PATHINFO_EXTENSION);
                                    if (($duoianh != 'png') && ($duoianh != 'jpg') && ($duoianh != 'jpeg')) {
                                        $mes = 'Chọn đúng định dạng file ảnh';
                                    }else{
                                         move_uploaded_file($ImageAccounts['tmp_name'], $adminImg . $imgName);
                                        pushAccount($NameAccount, $Gmail, $Password,  $imgName);
                                        $mes = 'Thêm ảnh thành công';
                                    }   
                               }else{
                                pushAccount($NameAccount, $Gmail, $Password,  $imgName);
                                $mes = 'Thêm tài khoản thành công';
                               } 
                            }
                         
                        // header (location : acmincontroller?act=....&mes=''.$mes)
                           
                        
                    }
                }
                include_once "views/account/AddAccount.php";
                break;
            case 'ListAccount':
                if(isset($_GET['delete'])&&($_GET['delete'] !='')){

                    deleteAccount($_GET['delete']);
                }
                include_once "views/account/ListAccount.php";
                break;
            case 'UpdateAccount':
                if($_SERVER['REQUEST_METHOD'] === "POST"){
                    extract($_POST);
                    extract($_FILES);
               
                    $imgName = $ImageAccounts['name'];
               
                    if(isset($_GET["IdAccount"])) {
                        $IdAccount = $_GET["IdAccount"];   
                    }//else{
                    //     $IdAccompanyingFood = 'IdAccompanyingFood';
                    // } 
                     move_uploaded_file($ImageAccounts['tmp_name'],$adminImg.$imgName);
                     updateAccount($IdAccount, $NameAccount, $Gmail, $Gender , $Password, $imgName, $StatusAccount,$Role);         
                }
                include_once "views/account/UpdateAccount.php";
                break;
            /**
             * ====================================================================================
             *                                    ORDERS
             * ====================================================================================
             */ 
            case 'AddOrders':
                if($_SERVER['REQUEST_METHOD'] === "POST"){

                    $data = $_POST;    
                    extract($data);
                
                    // if(1>0){
                    //     $mes
                    // }
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
              
                    if(isset($_GET["IdOrder"])) {
                        $IdOrder = $_GET["IdOrder"];   
                    }else{
                        $IdOrder = $data['IdOrder'];
                    }
                    updateOrder($data, $IdOrder);
                }
                include_once "views/orders/UpdateOrders.php";
                break;

             /**
             * ====================================================================================
             *                                    ORDERPRO
             * ====================================================================================
             */ 
            case 'AddOrderPro':
                if($_SERVER['REQUEST_METHOD'] === "POST"){
                    $data = $_POST;    
                    extract($data);

                    pushOrderPro($data);
                }
                include_once "views/orderpro/AddOrderPro.php";
                break;
            case 'ListOrderPro':
                if(isset($_GET['delete'])&&($_GET['delete'] !='')){
                    deleteOrderPro($_GET['delete']);
                 }
                include_once "views/orderpro/ListOrderPro.php";
                break;
            case 'UpdateOrderPro':
                if($_SERVER['REQUEST_METHOD'] === 'POST' ){
                      $data = $_POST;
                
                      if(isset($_GET["IdOrder_Pro"])) {
                        $IdOrder_Pro = $_GET["IdOrder_Pro"];   
                     }else{
                         $IdOrder_Pro = $data['IdOrder_Pro'];
                    }
                    updateOrderPro($data, $IdOrder_Pro);
                    }
                    include_once "views/orderpro/UpdateOrderPro.php";
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
                   extract($data);
                   if(!preg_match("/^\d+(\.\d+)?$/", $PriceBill)){
                    $mes = 'Giá không hợp lệ';
                   }
                   else{
                    pushBill($data);
                    $mes = 'Thêm thành công ';
                   }
                    
                }
                include_once "views/bill/AddBill.php";
                break;
            case 'ListBill':
                if(isset($_GET['delete'])&&($_GET['delete'] !='')){
                    deleteBill($_GET['delete']);
                 }
                include_once "views/bill/ListBill.php";
                break;
            // case 'UpdateBill':
            //     if($_SERVER['REQUEST_METHOD'] === 'POST' ){
            //         $data = $_POST;
                  
            //         if(isset($_GET["IdBill"])) {
            //              $IdBill = $_GET["IdBill"];   
            //         }else{
            //             $IdBill = $data['IdBill'];
            //         }
            //         updateBill($data, $IdBill);
            //         }
            //      include_once "views/bill/UpdateBill.php";
            //      break;   
            /**
             * ====================================================================================
             *                                 CART
             * ====================================================================================
             * 	IdCart	IdAccount	IdProduct	IdSize	Quantity	Price	
             */
            case 'AddCart':
                if($_SERVER['REQUEST_METHOD'] === "POST"){
                    $data = $_POST;    
                    
                    pushCart($data);

                }
                include_once "views/cart/AddCart.php";
                break;
            case 'ListCart':
                if(isset($_GET['delete'])&&($_GET['delete'] !='')){
                       deleteCart($_GET['delete']);
                 }
                include_once "views/cart/ListCart.php";
                break;
            case 'UpdateCart':
                if($_SERVER['REQUEST_METHOD'] === 'POST' ){
                   $data = $_POST;
                      
                    if(isset($_GET["IdCart"])) {
                         $IdCart = $_GET["IdCart"];   
                   }else{
                        $IdCart = $data['IdCart'];
                    }
                    updateCart($data, $IdCart);
                }
                 include_once "views/cart/UpdateCart.php";
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