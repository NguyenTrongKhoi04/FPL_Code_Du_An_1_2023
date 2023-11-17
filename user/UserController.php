<?php
session_start();
ob_start();
include_once '../app/Pdo.php';
include_once '../assets/global/User.php';
include_once '../assets/global/url_Path.php';
include_once 'models/Login.php';
include_once '../assets/global/Header.php'; 
include_once 'models/ChiTietSanPham.php';
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
                if ($_SESSION['user']['Type'] == 1) {
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

                // lấy danh mục và danh mục phụ của $pro để tìm ra được các sản phẩm Cùng loại
                $pro_LienQuan = chiTietSanPham_ProCungLoai($pro['NameCategory'],$pro['SubCategories']);
                
                // lấy top 3 sản phẩm bán chạy
                    //$top3_Pro = top3_SanPham() ;

                // Thêm vào giỏ hàng user
                if(isset($_POST['add_to_cart'])){
                    extract($_POST);
                    chiTietSanPham_Add_To_Cart($_SESSION['user']['IdAccount'],$idProduct,0,$quantityProduct,$priceProduct);
                }
                include_once 'views/ChiTietSanPham.php';
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
