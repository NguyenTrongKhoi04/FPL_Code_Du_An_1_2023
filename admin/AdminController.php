<?php
session_start();
ob_start();
include_once '../app/Pdo.php';
include_once '../assets/global/User.php';
include_once '../assets/global/url_Path.php';
include_once 'models/Account.php';
include_once 'models/Ban.php';
include_once 'models/Product.php';
include_once 'models/QuanLyOrder.php';

if (empty($_SESSION['user'])) {
    header('location: ../user/UserController.php');
} else {
    if (isset($_GET['act']) && ($_GET['act'] != '')) {
        $act = $_GET['act'];
        switch ($act) {
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
             *                                 BAN
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

        /**
             * ====================================================================================
             *                                 PRODUCT
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

                    $imgNameProduct = ($imgProduct['size'] != 0) ? $imgProduct['name'] : $ImageProduct ;
    
                    if($imgProduct['size'] != 0){
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
                $idOrder= $_GET['id'];
                xacNhanOrder($idOrder);
                header('location: AdminController.php?act=QuanLyOrder_Order');
                break;
            case 'QuanLyOrder_Order_Add':
                    $list_Product = list_product();            
                    $list_Size_Pro = list_Size_Pro();
                    $list_Size = list_Size();
                    echo"<pre>";
print_r($list_Product);
echo"</pre>";
                    echo"<pre>";
print_r($list_Size_Pro);
echo"</pre>";
                    echo"<pre>";
print_r($list_Size);
echo"</pre>";
                if($_SERVER['REQUEST_METHOD']=='POST'){
                    echo"<pre>";
                    print_r($_POST);
                    echo"</pre>";
                }
                include_once 'views/QuanLyOrder/QuanLyOrder_Add_Order.php';
                break;
            default:
                // include_once 'views/Home.php';
                break;
        }
    } else {
        include_once 'views/taikhoan/ListAccount.php';
    }
}
