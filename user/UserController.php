<?php
session_start();
ob_start();
include_once '../app/Pdo.php';
include_once '../assets/global/User.php';
include_once '../assets/global/url_Path.php';
include_once 'models/Login.php';
include_once '../assets/global/Header.php'; 
include_once 'models/ChiTietSanPham.php';
include_once 'models/DatBan.php';
check_Login();

if (isset($_GET['act']) && ($_GET['act'] != '')) {
    if (empty($_SESSION['user'])) {
        include_once 'views/LoginThuong.php';
    } else {
        $act = $_GET['act'];
        switch ($act) {
        /**
         * ====================================================================================
         *                                 LOGIN - LOGOUT
         * ====================================================================================
         */
            case 'dangnhap':
                if ($_SESSION['user']['Role'] == 1) {
                    header('location: ../admin/AdminController.php');
                } else {
                    $loadHeader = 0;
                    if ($loadHeader == 0) {
                        header('location: UserController.php');
                        include_once 'views/Home.php';
                        $loadHeader = 1;
                    }
                }
                break;

            case 'dangxuat':
                session_destroy();
                header('location: UserController.php');
                break;
                
        /**
            * ====================================================================================
            *                                 CHI TIẾT SẢN PHẨM
            * ====================================================================================
            */
            case 'LoadChiTietSanPham':
                $id = $_GET['id'];
                $pro = chiTietSanPham_LoadAll($id);
                $proSize = chiTietSanPham_LoadSizePro($id);
                $proDetails = chiTietSanPham_LoadDetails($id);
                // lấy danh mục và danh mục phụ của $pro để tìm ra được các sản phẩm Cùng loại
                $pro_LienQuan = chiTietSanPham_ProCungLoai($pro['IdCategory'],$pro['NameProduct']);

                // lấy top 3 sản phẩm bán chạy
                    // $top3_Pro = top3_SanPham() ;

                // Thêm vào giỏ hàng user
                if(isset($_POST['add_to_cart'])){
                    extract($_POST);
                    $priceQuantity = $pro['PriceProduct'] * $Quantity;
                    chiTietSanPham_Add_To_Cart($_SESSION['user']['IdAccount'],$SizeProduct,$Quantity,$priceQuantity);
                }
                include_once 'views/ChiTietSanPham.php';
                break;
            
        /**
            * ====================================================================================
            *                                 BAN
            * ====================================================================================
            */
            case 'ListBan':
               
                $arrBanFull = list_BanCoNguoiNgoi();
                If($_SERVER['REQUEST_METHOD']==='POST'){
                    extract($_POST);
                    if(!isset($ban_check)){
                        echo "<script>alert('Vui lòng chọn bàn')</script>";
                        header("loaction:UserController?act=ListBan");
                    }else{
                        echo"<pre>";
                        print_r($_POST);
                        echo"</pre>";   
                    }
                }
                include_once 'views/DatBan.php';
                break;
            default:
                include_once 'views/Home.php';
                break;
        }
    }
} else {
    include_once 'views/Home.php';
}

include_once '../assets/global/Footer.php';
