<?php
session_start();
ob_start();
include_once '../app/Pdo.php';
include_once '../assets/global/User.php';
include_once '../assets/global/url_Path.php';
include_once 'models/TaiKhoan.php';
include_once 'models/Ban.php';
include_once 'models/Product.php';

if (empty($_SESSION['user'])) {
    header('location: ../user/UserController.php');
} else {
    if (isset($_GET['act']) && ($_GET['act'] != '')) {
        $act = $_GET['act'];
        switch ($act) {
            /**
             * ====================================================================================
             *                                 TÀI KHOẢN
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
                    var_dump($_FILES);
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
echo"<pre>";
print_r($_POST);
echo"</pre>";
                    if($ImageProduct['name'] != ''){
                        $img=$ImageProduct['name'];
                        move_uploaded_file($ImageProduct['tmp_name'], $adminImg . $img);
                    }

                    add_Product($NameProduct,$QuantityProduct,$PriceProduct,$ImageProduct['name'], $IdCategory,$ProductDetails, $ProductDescription);

                }
                include_once 'views/product/AddProduct.php';
                break;
            default:
                // include_once 'views/Home.php';
                break;
        }
    } else {
        include_once 'views/taikhoan/ListAccount.php';
    }
}
