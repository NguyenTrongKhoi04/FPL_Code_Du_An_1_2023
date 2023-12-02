<?php
session_start();
ob_start();
include_once '../app/Pdo.php';
include_once '../assets/global/User.php';
include_once '../assets/global/url_Path.php';
include_once '../assets/global/Header.php';
include_once "../assets/global/Validate.php";
include_once "../assets/global/SendGmail.php";
include_once 'models/Login.php';
include_once 'models/Home.php';
include_once 'models/ProductPortfolio.php';
include_once 'models/Cart.php';
include_once 'models/CreateAccount.php';
include_once 'models/ChiTietSanPham.php';
include_once 'models/DatBan.php';
include_once 'models/CashViSa.php';
include_once 'models/BillPayment.php';
include_once 'models/AddComments.php';
include_once 'models/ListComment.php';
include_once 'models/LoginNhanh.php';
include_once 'models/LoginNhanh_Bill.php';

check_LoginNhanh();
check_Login();

home_checkAndOrderAuto();

if(isset($_GET['act'])&&($_GET['act'] !='' )){
    if(empty($_SESSION['user'])){
        if($_GET['act']=='dangnhap_AnTaiQuan'){
            include_once 'views/LoginNhanh.php';
        }else{
            include_once 'views/LoginThuong.php';
        }
    } else {
        $act = $_GET['act'];
        $idAccountUser = $_SESSION['user']["IdAccount"];
        switch($act){
        /**
            * ====================================================================================
            *                                 LOGIN - LOGOUT
            * ====================================================================================
            */
            case 'dangnhap':
                if ($_SESSION['user']['Role'] == 1) {
                    header('location: ../admin/AdminController.php');
                }elseif($_SESSION['user']['Role'] == 2) {
                     header('location: ../admin/AdminController.php?act=QuanLyOrder_Order');
                }else {
                    $loadHeader = 0;
                    if ($loadHeader == 0) {
                        header('location: UserController.php');
                        include_once 'views/Home.php';
                        $loadHeader = 1;
                    }
                }
                break;
            
            case 'dangnhap_AnTaiQuan':
                header('location: UserController.php?act=ListBan');
                break;
            case 'dangxuat':
                session_destroy();
                header('location: UserController.php');
                break;
        /**
            * ====================================================================================
            *                                 DANG KY
            * ====================================================================================
            */
            case 'TaoTaiKhoan':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $dataAccount = $_POST;
                    $alert = CreateAccount_CreateAccount($dataAccount);
                    if ($alert === "") {
                        header("Location: UserController.php?act=VerifyAccount");

                    }
                }
                include_once 'views/CreateAccount.php';
                break;
            case "VerifyAccount":
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $dataVerifyAccount = $_POST;
                    $alert = CreateAccount_CreateAccount1($dataVerifyAccount);
                }
                include_once 'views/VerifyAccount.php';
                break;
        /**
            * ====================================================================================
            *                                     HOME
            * ====================================================================================
            */     
            case 'trangchu':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $dataBooking = $_POST;
                    $alert = home_BookingTable($dataBooking);
                }
                include_once 'views/Home.php';

        /**
            * ====================================================================================
            *                                PRODUCT PORTFOLIO
            * ====================================================================================
            */            
            case 'DanhMucSanPham':
                if (isset($_GET['idCategory']) && !empty($_GET['idCategory'])) {
                    $idCategory = $_GET['idCategory'];
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        extract($_POST);
                        $GetAllProductAsRequested = productPortfolio_GetAllProductAsRequested($price, $product, $idCategory);
                    } else {
                        $dataProductPortfolio = productPortfolio_GetAllProduct($idCategory);
                    }
                                    

                    include_once 'views/ProductPortfolio.php';
                } else {
                    if($_SESSION['user']['Role']==3){
                        include_once 'views/ProductPortfolio.php';
                    }else{
                        include_once 'views/ProductPortfolio.php';
                    }
                }
                break;
         /**
            * ====================================================================================
            *                                 ORDER
            * ====================================================================================
            */

            // thêm vào cả cart và order
            case 'LoginNhanh_Add_To_CartAndOrder':
                extract($_POST);
                $check_SoLuong_Pro = loginNhanh_Check_SoLuong($IdProduct);
                // echo'<pre>';
                // print_r($_POST);
                // echo'</pre>';;
                if($Quantity > $check_SoLuong_Pro['QuantityProduct'] ){
                    $mes = "Sản phẩm hiện tại còn: ".$check_SoLuong_Pro['QuantityProduct'];
                }else{
                    
                $priceQuantity = $Quantity * $PriceProduct;
                
                // Check xem order này có trong giỏ hàng hay chưa
                $check_Order_Pro = loginNhanh_Check_Order_Pro($_SESSION['user']['IdAccount'],$IdProduct,$SizeProduct);

                //xem tài khaorn có đang xác nhạn không
                $check_Order_DangXacNhan =loginNhanh_DangXacNhan_Account($_SESSION['user']['IdAccount']);
             
                if(is_array($check_Order_DangXacNhan)){
                    $mes= 'Không Thể Order Được Tiếp. Đang Trong Quá Trình Xác Nhận Thanh Toán ';
                }else{
                    if(is_array($check_Order_Pro)){
                        loginNhanh_Cart_Update_Price_The_SameAs($check_Order_Pro['IdOrder_Pro'],$SizeProduct,$Quantity,$PriceProduct);
                        loginNhanh_TruSoLuong_Pro($IdProduct);
                        $mes ='Order Thành công';
                    }else{
                        loginNhanh_TruSoLuong_Pro($IdProduct);
                        chiTietSanPham_Add_To_Order_Pro($_SESSION['user']['IdAccount'],$IdProduct,$SizeProduct,$Quantity,$priceQuantity);
                        $mes ='Order Thành Công';
                    }
                }
                }
                header('location: UserController.php?act=LoadChiTietSanPham&id='.$_GET['id'].'&mes='.$mes);
                break;

        /**
            * ====================================================================================
            *                                CHI TIET SAN PHAM
            * ====================================================================================
            */     
            case 'LoadChiTietSanPham':

                if(isset($_GET['mes'])){
                    $mes = $_GET['mes'];
                    echo"<script>alert('$mes')</script>";
                };
                $id = $_GET['id'];
                $pro = chiTietSanPham_LoadAll($id);
         
                $proSize = chiTietSanPham_LoadSizePro($id);

                $proDetails = chiTietSanPham_LoadDetails($id);
                // lấy danh mục và danh mục phụ của $pro để tìm ra được các sản phẩm Cùng loại
                $pro_LienQuan = chiTietSanPham_ProCungLoai($pro['IdCategory'],$pro['NameProduct']);

                // lấy top 3 sản phẩm bán chạy
                    // $top3_Pro = top3_SanPham() ;

                include_once 'views/ChiTietSanPham.php';
                break;
        /**
            * ====================================================================================

            *                                     CART
            * ====================================================================================
            */     
            case 'GioHang':
                    $dataCart = cart_GetAllCartByIdAccount($idAccountUser);
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        cart_UpdateCart($_POST["quantity"]);
                        $_SESSION['dataOrderCart'] = cart_GetAllCartByIdAccount($idAccountUser);
                        header("Location: UserController.php?act=ListBan");
 
                    }
                    if (isset($_GET['Delete']) && ($_GET['Delete'] != '')) {
                        if(cart_Delete($_GET['Delete']) === null){
                            $alert = "Xóa sản phẩm thành công";


                            header("location: UserController.php?act=GioHang");
                        }
                    }
                    include_once 'views/Cart.php';
                    break;

        /**
            * ====================================================================================
            *                                     BILL
            * ====================================================================================
            */        
            case 'billthanhtoan':
                $listOrderPayMent = BillPayment_GetOrderPayment($idAccountUser);
                include_once 'views/BillPayment.php' ;
                break; 
           


                case 'LoginNhanh_ListOrder':

                    if(empty( loginNhanh_ChuaThanhToan_GetAll_Order_ByIdAccount($_SESSION['user']['IdAccount'])) 
                        && empty(loginNhanh_Order_DangXacNhan($_SESSION['user']['IdAccount']))){
                           
                            $arrOrder = loginNhanh_ChuaThanhToan_GetAll_Order_ByIdAccount($_SESSION['user']['IdAccount']);
                            $tienTong = 0;
                            foreach($arrOrder as $i){
                               $one_In_Order = $i['QuantityOrderPro']*$i['PriceProduct'];
                                $tienTong +=$one_In_Order;
                            }
                            include_once 'views/LoginNhanh_Cart.php';
                    }else{
                    // Các Đơn hàng chưa được xác nhận
                    $arrOrder = loginNhanh_ChuaThanhToan_GetAll_Order_ByIdAccount($_SESSION['user']['IdAccount']);

                    if(empty($arrOrder)){
                        // Các đơn hàng đã được xác nhận rồi
                        $arrOrder = loginNhanh_Order_DangXacNhan($_SESSION['user']['IdAccount']);
                        if(empty($arrOrder)){
                            unset($_SESSION['user']);
                            
                        }else{
                            $mes_ChoXacNhan = 'Đơn Hàng Đang Chờ Được Xác Nhận. Danh Sách Các Món Đã Order Sẽ Được Xóa Khi Xác Nhận Xong. 
                                Sau khi được xác nhận, vui lòng đăng nhập lại để đặt tiếp';
                            
                        }
                    }else{
                        $mes_ChoXacNhan ='' ;
                    }
                    // var_dump($arrOrder[0]['IdOrder']);
                    // echo '<pre>';
                    // print_r($arrOrder);
                    // echo '</pre>';

                    if(isset($_POST['Pay_Truc_Tiep'])&&$_POST['Pay_Truc_Tiep'] !=''){
                        loginNhanh_Update_TrangThai_ThanhToan_Orders($_SESSION['user']['IdAccount']);
                        header('location: UserController.php?act=LoginNhanh_ListOrder');
                    }

                    $tienTong = 0;
                    foreach($arrOrder as $i){
                       $one_In_Order = $i['QuantityOrderPro']*$i['PriceProduct'];
                        $tienTong +=$one_In_Order;
                    }
                    
                    include_once 'views/LoginNhanh_Cart.php';}
                    break;

        /**
            * ====================================================================================
            *                                 BAN
            * ==============================    ======================================================
            */
            case 'ListBan':
                
$arrBanFull = list_BanCoNguoiNgoi();
If($_SERVER['REQUEST_METHOD']==='POST'){
    extract($_POST);
    if(!isset($so_Ban)){
        echo "<script>alert('Vui lòng chọn bàn')</script>";
        header("loaction:UserController?act=ListBan");
    }else{
        if($_SESSION['user']['Role']==3){
            $_SESSION['ban']=$so_Ban;
            loginNhanh_DatBan($so_Ban,$_SESSION['user']['IdAccount']);
            update_Status_Ban($so_Ban);
            header('location: UserController.php?act=DanhMucSanPham');
        }
    }
}
include_once 'views/DatBan.php'; 
break;    

        /**
            * ====================================================================================
            *                                 CashViSa
            * ====================================================================================
            */            
            case "CashViSa":
                $listOrderUser = CashViSa_GetAllOrderUser();
                if($_SERVER['REQUEST_METHOD']==='POST'){ 
                    $alert = CashViSa_PushOrderUser();
                    echo "<script> alert('$alert') </script>";
                    // header("Location: UserController.php?act=BillPayment");
                }
                include_once 'views/CashViSa.php' ;
                break;
        /**
            * ====================================================================================
            *                                 CashPayment
            * ====================================================================================
            */  
            case "AddComment":
                $listOrderPayMent = BillPayment_GetOrderPayment($idAccountUser);
                $listComment = AddComments_GetComment($idAccountUser);
                if($_SERVER['REQUEST_METHOD']==='POST'){ 
                    if(isset($_GET['idProduct']) && isset($_GET['IdOrder'])){
                        $IdProduct = $_GET['idProduct'];
                        $IdOrder = $_GET['IdOrder'];
                        $alert = AddComments_AddComment($IdProduct, $idAccountUser, $_POST, $IdOrder);
                        if($alert === null){
                            echo " <script> alert('$alert') </script> ";
                        }else{
                            echo " <script> alert('Hệ thống đang bảo trì') </script> ";

                        }
                    }
                }
                include_once 'views/AddComments.php';
                break;
            case "ListComment":
                $listOrderPayMent = BillPayment_GetOrderPayment($idAccountUser);
                $listComment = ListComment_GetAllComment($idAccountUser);
                if($_SERVER['REQUEST_METHOD']==='POST' && isset($_GET['IdComment'])){ 
                    $IdComment = $_GET['IdComment'];
                    if(isset($_POST["delete"])){
                        ListComment_DeleteComment($IdComment);
                        header("Location: UserController.php?act=ListComment");
                    }else{
                        extract($_POST);
                        ListComment_UpdateComment($IdComment, $content);
                        header("Location: UserController.php?act=ListComment");
                        
                    }
                }
                include_once 'views/ListComment.php';
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
echo "<script>
setTimeout(function(){
    location.reload();
  }, 60000); 
</script>";



