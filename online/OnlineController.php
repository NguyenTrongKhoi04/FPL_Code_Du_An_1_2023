<?php
session_start();
ob_start();
include_once '../app/Pdo.php';
include_once '../assets/global/User.php';
include_once '../assets/global/url_Path.php';
include_once 'models/Header.php';
include_once '../assets/global/Header.php';
include_once "../assets/global/Validate.php";
include_once "../assets/global/SendGmail.php";
include_once 'models/Home.php';
include_once 'models/Login.php';
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
include_once 'models/PersonalPage.php';

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
                        header('location: OnlineController.php');
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
                header('location: OnlineController.php');
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
                        header("Location: OnlineController.php?act=VerifyAccount");
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
                if(isset($_GET['index']) && isset($_GET['id'])){
                    $id = $_GET['id'];
                    $pro = chiTietSanPham_LoadAll($id);
                    $proSize = chiTietSanPham_LoadSizePro($id);
                    $proDetails = chiTietSanPham_LoadDetails($id);
                    $dataComment = chiTietSanPham_GetComment($_GET['index']);
                    // lấy danh mục và danh mục phụ của $pro để tìm ra được các sản phẩm Cùng loại
                    $pro_LienQuan = chiTietSanPham_ProCungLoai($pro['IdCategory'],$pro['NameProduct']);
    
                        // $top3_Pro = top3_SanPham() ;
    
                    // Thêm vào giỏ hàng user
                          
                    if(isset($_POST['add_to_cart'])){
                        extract($_POST);
                        $priceQuantity = $pro['PriceProduct'] * $Quantity;
                        $alert = chiTietSanPham_Add_To_Cart($IdProduct, $_SESSION['user']['IdAccount'],$SizeProduct,$Quantity,$priceQuantity);
                    }
                    if(isset($_POST['pay_now'])){
                        $_SESSION['payNowDetails'] = $_POST;
                        header("Location: OnlineController.php?act=ListBan");
    
                    }

                }else{
                    header("Location: OnlineController.php");
                }
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
                        header("Location: OnlineController.php?act=ListBan");
 
                    }
                    if (isset($_GET['Delete']) && ($_GET['Delete'] != '')) {
                        if(cart_Delete($_GET['Delete']) === null){
                            $alert = "Xóa sản phẩm thành công";
                            header("Location: OnlineController.php?act=GioHang");
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
                $dataProfile = PersonalPage_GetProfileUser($_SESSION['user']['IdAccount'])[0];
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
                if($_SERVER['REQUEST_METHOD']==='POST'){ 
                    extract($_POST);
                    if(!isset($contentTable)){
                        echo "<script>alert('Vui lòng chọn bàn...')</script>";
                    }else{
                        $alert = datBan_CheckBookingTables($_POST);
                        if($alert === true){
                            header("Location: OnlineController.php?act=CashViSa");
                        }else{
                            echo "<script>alert('$alert')</script>";
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
                $toatl =  cart_Totail($listOrderUser)['totail'];
                if($_SERVER['REQUEST_METHOD']==='POST'){ 
                    $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
                    $partnerCode = 'MOMOBKUN20180529';
                    $accessKey = 'klm05TvNBzhg7h7j';
                    $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
                    $orderInfo = "Thanh toán qua MoMo";
                    // số tiền cần thanh toán
                    $amount = "10000";
                    // $amount = $toatl;
                    $orderId = time() ."";
                    // trả về trang web sau khi thanh toán xong
                    $redirectUrl = "https://webhook.site/b3088a6a-2d17-4f8d-a383-71389a6c600b";
                    $ipnUrl = "https://webhook.site/b3088a6a-2d17-4f8d-a383-71389a6c600b";
                    $extraData = "";
                    
                    if (!empty($_POST)) {
                        $partnerCode = $partnerCode;
                        $accessKey = $accessKey;
                        $serectkey = $secretKey ;
                        $orderId = $orderId; // Mã đơn hàng
                        $orderInfo = $orderInfo;
                        $amount = $amount;
                        $ipnUrl = $ipnUrl;
                        $redirectUrl = $redirectUrl;
                        $extraData = $extraData;
                    
                        $requestId = time() . "";
                        $requestType = "payWithATM";
                        // $extraData = ($_POST["extraData"] ? $_POST["extraData"] : "");
                        //before sign HMAC SHA256 signature
                        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
                        $signature = hash_hmac("sha256", $rawHash, $serectkey);
                        $data = array('partnerCode' => $partnerCode,
                            'partnerName' => "Test",
                            "storeId" => "MomoTestStore",
                            'requestId' => $requestId,
                            'amount' => $amount,
                            'orderId' => $orderId,
                            'orderInfo' => $orderInfo,
                            'redirectUrl' => $redirectUrl,
                            'ipnUrl' => $ipnUrl,
                            'lang' => 'vi',
                            'extraData' => $extraData,
                            'requestType' => $requestType,
                            'signature' => $signature);
                        $result = execPostRequest($endpoint, json_encode($data));
                        $jsonResult = json_decode($result, true);  // decode json

                        header('Location: ' . $jsonResult['payUrl']);
                        CashViSa_PushOrderUser();
                    }
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
                $dataProfile = PersonalPage_GetProfileUser($_SESSION['user']['IdAccount'])[0];

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
                $dataProfile = PersonalPage_GetProfileUser($_SESSION['user']['IdAccount'])[0];

                if($_SERVER['REQUEST_METHOD']==='POST' && isset($_GET['IdComment'])){ 
                    $IdComment = $_GET['IdComment'];
                    if(isset($_POST["delete"])){
                        ListComment_DeleteComment($IdComment);
                        header("Location: OnlineController.php?act=ListComment");
                    }else{
                        extract($_POST);
                        ListComment_UpdateComment($IdComment, $content);
                        header("Location: OnlineController.php?act=ListComment");
                        
                    }
                }
                include_once 'views/ListComment.php';
                break;

            case "PersonalPage":
                $dataProfile = PersonalPage_GetProfileUser($_SESSION['user']['IdAccount'])[0];
                if($_SERVER['REQUEST_METHOD']==='POST' && isset($_GET['IdAccount'])) {
                    $IdAccount = $_GET['IdAccount'];
                    PersonalPage_PushProfileUser($_POST, $_FILES["ImageAccounts"], $IdAccount);
                    header("Location: OnlineController.php?act=PersonalPage");

                }
                include_once 'views/PersonalPage.php';
                break;

                default:
                include_once 'views/Home.php';
                break;
        }
    }
} else {
    include_once 'views/Home.php';
}


// echo "<script>
// setTimeout(function(){
//     location.reload();
//   }, 60000); 
// </script>";

include_once '../assets/global/Footer.php';


