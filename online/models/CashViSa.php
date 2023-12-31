<?php 
function CashViSa_GetAllOrderUser(){

    $message = "";
    if(isset($_SESSION['dataOrderCart']) && isset($_SESSION['dataOrderTables'])){
        $message = $_SESSION['dataOrderCart'];
    }
    if(isset($_SESSION['payNowDetails']) && !empty($_SESSION['payNowDetails']) && isset($_SESSION['dataOrderTables'])){
        $idProductUser = $_SESSION['payNowDetails']["IdProduct"];
        $sql = "select NameProduct, ImageProduct from product where IdProduct = $idProductUser";

        $dataProducts = query_One($sql);
        $dataProductsDetails = $_SESSION['payNowDetails'];
        $idAccountUser = $_SESSION['user']["IdAccount"];
        // Gộp các mảng lại thành một mảng duy nhất
        $result = [
            "IdAccount" => $idAccountUser,
            "IdProduct" => $dataProductsDetails["IdProduct"],
            "PriceProduct" => $dataProductsDetails["PriceProduct"],
            "QuantityCard" => $dataProductsDetails["Quantity"],
            "SizeProduct" => $dataProductsDetails["SizeProduct"],
            "NameProduct" => $dataProducts["NameProduct"],
            "ImageProduct" => $dataProducts["ImageProduct"],
        ];
        $message = array($result);
    }
    return $message;
}

function CashViSa_PushOrderUser(){
    $message = "";
    $IdAccount = $_SESSION['user']["IdAccount"];
    $totailPriceOrders = $_SESSION['totailPrice'];
    if(isset($_SESSION['dataOrderCart']) && isset($_SESSION['dataOrderTables']) && !empty($_SESSION['dataOrderTables'])){
        $dataOrderCart = $_SESSION['dataOrderCart'];
        $dataOrderTables = $_SESSION['dataOrderTables'];

        extract($dataOrderTables);
        // thêm dữ liệu vào bảng order
        $IdOrder = pdo_Execute_Return_LastinsertID("insert into orders values(null, '$IdTable',  '$IdAccount', 2, '$totailPriceOrders', '$NumberInPeople','3', '$TimeOrder')") ;
        foreach($dataOrderCart as $valueDataOrder){
            // thêm dữ liệu vào bảng order_pro
            pdo_Execute("insert into order_pro values(null, '$IdOrder', '$valueDataOrder[IdProduct]','$valueDataOrder[NameSize]','$valueDataOrder[QuantityCard]',0)");
            // xóa sản phẩm khỏi giỏ hàng
            pdo_Execute("delete from cart where IdAccount = '$valueDataOrder[IdAccount]'");
            // update lại  lượng product 
            pdo_Execute("update product set QuantityProduct = QuantityProduct - $valueDataOrder[QuantityCard] where IdProduct = $valueDataOrder[IdProduct] ");
        }
        $recipientGmail = $_SESSION['user']["Gmail"];
        $nameRecipientGmail = $_SESSION['user']["NameAccount"];
        $titleGamil = "Xác nhận đơn hàng đăng ký dịch vụ tại Terrace Restaurant";
        $contentGmail = "<h1>Kính gửi: $nameRecipientGmail !</h1> <br/> 
        <p'>xin gửi lời cám ơn đến Quý khách đã tin tưởng sử dụng dịch vụ của chúng tôi.</p> 
        <h3>Số bàn của Quý khách là: $IdTable</h3>  
        <h3>Mã đơn hàng của Quý khách là: $IdOrder</h3>  
        <p> Vui lòng cung cấp mã đơn hàng cho nhân viên khi bạn đến nhà hàng. Xin Cảm ơn !</p>
        ";
        if(SendGmailConfirmation($recipientGmail, $nameRecipientGmail, $titleGamil, $contentGmail) === true){
            $_SESSION['dataOrderCart'] = "";
            $_SESSION['dataOrderTables'] = "";
            $message = "Đơn hàng đã được thanh toán";
        }

    }elseif(isset($_SESSION['payNowDetails']) && isset($_SESSION['dataOrderTables']) && !empty($_SESSION['dataOrderTables'])){
        $payNowDetails = array($_SESSION['payNowDetails']);
        $dataOrderTables = $_SESSION['dataOrderTables'];
        extract($dataOrderTables);
        // thêm dữ liệu vào bảng order
        $IdOrder = pdo_Execute_Return_LastinsertID("insert into orders values(null, '$IdTable',  '$IdAccount', 2, '$totailPriceOrders', '$NumberInPeople','3', '$TimeOrder')") ;
        foreach($payNowDetails as $valueDataOrder){
            // thêm dữ liệu vào bảng order_pro
            pdo_Execute("insert into order_pro values(null, '$IdOrder', '$valueDataOrder[IdProduct]','$valueDataOrder[SizeProduct]','$valueDataOrder[Quantity]',0)"); 
            // update lại  lượng product 
            pdo_Execute("update product set QuantityProduct = QuantityProduct - $valueDataOrder[Quantity] where IdProduct = $valueDataOrder[IdProduct] ");                
        }
        $recipientGmail = $_SESSION['user']["Gmail"];
        $nameRecipientGmail = $_SESSION['user']["NameAccount"];
        $titleGamil = "Xác nhận đơn hàng đăng ký dịch vụ tại Terrace Restaurant";
        $contentGmail = "<h1>Kính gửi: $nameRecipientGmail !</h1> <br/> 
        <p'>xin gửi lời cám ơn đến Quý khách đã tin tưởng sử dụng dịch vụ của chúng tôi.</p> 
        <h3>Số bàn của Quý khách là: $IdTable</h3>  
        <h3>Mã đơn hàng của Quý khách là: $IdOrder</h3>  
        <p> Vui lòng cung cấp mã đơn hàng cho nhân viên khi bạn đến nhà hàng. Xin Cảm ơn !</p>
        ";
        if(SendGmailConfirmation($recipientGmail, $nameRecipientGmail, $titleGamil, $contentGmail) === true){
            $_SESSION['payNowDetails'] = "";
            $_SESSION['dataOrderTables'] = "";
            $message = "Đơn hàng đã được thanh toán";
        }
        
    }

    return $message;

}
function execPostRequest($url, $data)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data))
    );
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    //execute post
    $result = curl_exec($ch);
    //close connection
    curl_close($ch);
    return $result;
}

/**
 * Test momo
 * NGUYEN VAN A
 * 9704 0000 0000 0018
 * 03/07
 * OTP
 */
?>