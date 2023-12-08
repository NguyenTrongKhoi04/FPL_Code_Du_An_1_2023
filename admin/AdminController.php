<?php
session_start();
ob_start();

include_once '../app/Pdo.php';
include_once '../assets/global/User.php';
include_once '../assets/global/url_Path.php';
include_once '../assets/global/Validate.php';
include_once 'models/Account.php';
include_once 'models/Ban.php';
include_once 'models/Product.php';
include_once 'models/QuanLyOrder.php';
include_once './models/Size.php';
include_once './models/Category.php';
include_once './models/SizePro.php';
include_once './models/Account.php';
include_once './models/Order.php';
include_once './models/OrderPro.php';
include_once './models/Comment.php';

include_once './models/ThongKe.php';


// include_once 'models/TaiKhoan.php';



if(empty($_SESSION['user'])){
    header('location: ../online/OnlineController.php');
}else{
        if(isset($_GET['act'])&&($_GET['act'] !='' )){
        $act = $_GET['act'];
        switch($act){
        /**
            * ====================================================================================
            *                                 LOGIN - LOGOUT
            * ====================================================================================
            */
            case 'dangxuat':
                session_destroy();
                header('location: AdminController.php');
                break;
        /**
             * ====================================================================================
             *                                     SIZE 
             * ====================================================================================
             */
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
                    }}
                    include_once "views/size/addSize.php";
                    break;
        /**
             * ====================================================================================
             *                                     TABLES 
             * ====================================================================================
             */
            case 'ListBan':
                        $listBan = select_All('tables');
                        include_once "views/ban/ListBan.php";
                        break;
            case 'UpdateBan':
                $id = $_GET['id'];
                $ban_One = select_One('tables', null, "IdTables = $id");
                if (isset($_POST['update']) && ($_POST['update'] != '')) {
                    extract($_POST);
                    updateBan($id, $NumberPeople, $NumberTable, $StatusTable);
                    header("location:" . $adminAction . "ListBan");
                }
                include_once "views/ban/UpdateBan.php";
                break;
            case 'TrangThaiBanDay':
                $id =$_GET['id'];
                updateBan_Day($id);
                header("location:" . $adminAction . "ListBan");
                break;
            case 'TrangThaiBanTrong':
                $id =$_GET['id'];
                updateBan_Trong($id);
                header("location:" . $adminAction . "ListBan");
                break;
            case 'XoaBan':
                $id =$_GET['id'];
                khong_Dung_Ban($id);
                header("location:" . $adminAction . "ListBan");
                break;
            case 'AddBan':
                if($_SERVER['REQUEST_METHOD']==='POST'){
                    extract($_POST);
                    if(empty(check_Ban($NumberTable))){
                        add_Ban($_POST);
                        header("location:" . $adminAction . "ListBan");
                    }else{
                        echo "<script>alert('Số bàn này đã tồn tại')</script>";
                    }
                }
                include_once "views/ban/AddBan.php";
                break;
        /**
             * ====================================================================================
             *                                    PRODUCT
             * ====================================================================================
             */
            case 'ListProduct':
                $listPro = loadAll_Product();
                $listProCategory = loadAll_Product_Category();
                $listProDetails = loadAll_Product_Details();
                include_once 'views/product/ListProduct.php';
                break;
                case 'AddProduct':
                    $listProCategory = loadAll_Product_Category();
                    if(isset($_POST['AddProduct'])){
                        extract($_POST);
                        extract($_FILES);
                        if($ImageProduct['name'] != ''){
                            $img=$ImageProduct['name'];
                            move_uploaded_file($ImageProduct['tmp_name'], $adminImg . $img);
                        }
    
                        add_Product($NameProduct,$QuantityProduct,$PriceProduct,$ImageProduct['name'], $IdCategory,$ProductDetails, $ProductDescription);
    
                    }
                    include_once 'views/product/AddProduct.php';
                    break;
            case 'UpdateProduct':
                $id = $_GET['id'];
                $oneProduct= loadOne_Product($id);
                $listProCategory = loadAll_Product_Category();
                extract($oneProduct);
                $oneProDetails = loadOne_Product_Details($IdDetails);
                extract($oneProDetails);

                if(isset($_POST['UpdateProduct'])){
                  
                    extract($_POST);
                    extract($_FILES);

                    $imgNameProduct = (isset($imgProduct)) ? $imgProduct['name'] : $ImageProduct ;
    
                    if(isset($imgProduct)){
                        $img=$imgProduct['name'];
                        move_uploaded_file($imgProduct['tmp_name'], $adminImg . $img);
                    }

                    update_Product($id,$NameProduct,$QuantityProduct,$PriceProduct,$imgNameProduct, $IdCategory,$ProductDetails, $ProductDescription);
                }
                include_once 'views/product/UpdateProduct.php';
                break;
            case 'DeleteProduct':
                $id = $_GET['id'];
                delete_Product($id);
                header('location: AdminController.php?act=ListProduct');
                break;
            case 'RestoreProduct':
                    $id = $_GET['id'];
                    restore_Product($id);
                    header('location: AdminController.php?act=ListProduct');
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
                if(isset($_GET['restore'])&&($_GET['restore'] !='' )){
                    restoreCategory($_GET['restore']);
                } 
                include_once "views/danhmuc/ListCategory.php";
                break;
            case 'UpdateCategory':
                if($_SERVER['REQUEST_METHOD'] === 'POST' ){
                    $data = $_POST;
               
                    $IdCategory = $_GET["IdCategory"];
                    
                    updateCategory($data, $IdCategory);
                } 
                include_once "views/danhmuc/UpdateCategory.php";
                break;
             /**
             * ====================================================================================
             *                                   SIZEPRO
             * ====================================================================================
             */
            case 'DeleteSizePro':
                $id = $_GET['id'];
                $idSizePro = $_GET['idSizePro'];
                Delete_SizePro($idSizePro);
                header("location: AdminController.php?act=UpdateSizePro&mes=$mes&id=".$_GET['id']);
                break;
            case 'AddSizePro':
                if($_SERVER['REQUEST_METHOD'] === "POST"){
                    extract($_POST);
                    extract($_FILES["ImgSizePro"]);
                    
                    if(check_SizePro($IdProduct,$IdSize,$Price)["count(*)"] === 0){
                        if(validateImg($_FILES["ImgSizePro"]) === true){
                            move_uploaded_file($tmp_name, $adminImg . $name);
                            pushSizePro($IdProduct,$IdSize,$Price,$name);
                            $mes = 'Thành công';
                        }else{
                            $mes = validateImg($_FILES);
                        }
                        
                    }else{

                        $mes = 'Dữ Liệu Đã Tồn Tại';
                    }
                }
                include_once "views/sizepro/AddSizePro.php";

                break;
            case 'OneSizePro':
                $id = $_GET['id'] ;
                getSizePro($id);
                include_once "views/sizepro/UpdateSizePro.php";
                break;
            case 'ListSizePro':
                if(isset($_GET['delete'])&&($_GET['delete'] !='' )){
                    
                    deleteSizePro($_GET['delete']);
                }
                include_once "views/sizepro/ListSizePro.php";
                break;
            case 'UpdateSizePro':
                if(isset($_GET['IdSizePro']) && !empty($_GET['IdSizePro'])){
                    $dataSizePro = getSizePro($_GET['IdSizePro'])[0];
                    // thêm size_pro mới
                    if($_SERVER['REQUEST_METHOD'] === "POST"){
                        echo "<pre>";
                        var_dump($_POST); die();
                    }
                    

                } 
           include_once "views/sizepro/UpdateSizePro.php";
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
                                        $mes = 'Thêm tài khoản thành công';
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
                    $IdAccount = $_GET['IdAccount'];
                    $dataAccount = select_One('account','*',"IdAccount = $IdAccount") ;
                    extract($_POST);
                    extract($_FILES);

                    $img = ($ImageAccounts['size'] != 0) ? $ImageAccounts['name'] : $dataAccount['ImageAccounts'] ;
    
                    if($ImageAccounts['size'] != 0){
                        $img=$ImageAccounts['name'];
                        move_uploaded_file($ImageAccounts['tmp_name'], $adminImg . $img);
                    }
                    updateAccount($IdAccount, $NameAccount, $Gmail, $Gender , $Password, $img, $StatusAccount,$Role);
                   

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
                    if(check_Order($IdTable,$IdAccount)["count(*)"] === 1){
                           
                            $mes = 'Bàn đã được đặt trước ';
                        }
                        else{
                             pushOrder($data);  
                            
                            $mes = 'Đặt bàn thành công';
                        }
                      
                        
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
                if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET["IdOrder_Pro"]) ){
                      $data = $_POST;
                    //   echo $IdOrder_Pro; die();
                
                      updateOrderPro($data, $_GET["IdOrder_Pro"]);

                    }
                    include_once "views/orderpro/UpdateOrderPro.php";
                    break;


            /**
             * ====================================================================================
             *                                   THỐNG KÊ
             * ====================================================================================
             */
            case 'ThongKe':
            $thongKe = Load_thong_ke();
            include_once "views/thongke/ListTK.php";
            break;
            case 'BieuDo';
            $thongKe = Load_thong_ke();
            include_once "views/thongke/BieuDo.php";
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



        /**
             * ====================================================================================
             *                                 NHAN VIEN ORDER
             * ====================================================================================
             */
            case 'QuanLyOrder_Order':
                $list_CanXacNhan = list_OrderChuaXacNhan();

                include_once 'views/QuanLyOrder/QuanLyOrder_List_XacNhan.php';
                break;
            case  'QuanLyOrder_Order_Xac_Nhan':
 
                $idOrder= isset($_GET['id']) ? $_GET['id'] : ''  ;
                if(isset($_POST['XacNhan_CheckBox_DuocChon'])){
                    extract($_POST);
                    var_dump($arr_XacNhan);
                    foreach($arr_XacNhan as $i){
                        xacNhanOrder($i);
                    }
                }

                if($idOrder !=''){

                    xacNhanOrder($idOrder);
                }
                header('location: AdminController.php?act=QuanLyOrder_Order');
                break;
            case 'QuanLyOrder_Order_Add':
                    $list_Product = list_product();            
                    $list_Size_Pro = list_Size_Pro();
                    $list_Size = list_Size();
                if($_SERVER['REQUEST_METHOD']=='POST'){
                    echo"<pre>";
                    print_r($_POST);
                    echo"</pre>";
                }
                include_once 'views/QuanLyOrder/QuanLyOrder_Add_Order.php';
                break;

            default:
                include_once 'views/Home.php';
                break;
        }

    }else{
        include_once 'views/size/AddSize.php';
    
    }
}
