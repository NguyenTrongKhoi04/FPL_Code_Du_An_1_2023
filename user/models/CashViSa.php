<?php 
function CashViSa_GetAllOrderUser(){
    $message = "";
    if(isset($_SESSION['dataOrderCart']) && isset($_SESSION['dataOrderTables'])){
        $message = $_SESSION['dataOrderCart'];
    }elseif(isset($_SESSION['payNowDetails']) && isset($_SESSION['dataOrderTables'])){
        $idProductUser = $_SESSION['payNowDetails']["IdProduct"];
        $sql = "select NameProduct, ImageProduct from product where IdProduct = $idProductUser";

        $dataProducts = query_All($sql)[0];
        $dataProductsDetails = $_SESSION['payNowDetails'];
        $idAccountUser = $_SESSION['user']["IdAccount"];
        // Gộp các mảng lại thành một mảng duy nhất
        $result = [
            "IdAccount" => $idAccountUser,
            "IdProduct" => $dataProductsDetails["IdProduct"],
            "PriceProduct" => $dataProductsDetails["PriceProduct"],
            "Quantity" => $dataProductsDetails["Quantity"],
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
    if(isset($_SESSION['dataOrderCart']) && isset($_SESSION['dataOrderTables'])){
        $dataOrderCart = $_SESSION['dataOrderCart'];
        $dataOrderTables = $_SESSION['dataOrderTables'];
        extract($dataOrderTables);

        foreach($dataOrderCart as $valueDataOrder){
            $sqlWaytingOrder = "insert into waytingorder values(null, '$IdTable', '$valueDataOrder[IdProduct]', '$valueDataOrder[IdAccount]', '$valueDataOrder[Quantity]', '1', '$TimeOrder')";
            // xóa sản phẩm khỏi giỏ hàng
            $sqlCart = "delete from cart where IdAccount = '$valueDataOrder[IdAccount]'"; 
            pdo_Execute($sqlWaytingOrder);
            pdo_Execute($sqlCart);
        }
        $_SESSION['dataOrderCart'] = "";
        $_SESSION['dataOrderTables'] = "";
        $message = "Đơn hàng đã được thanh toán";

    }elseif(isset($_SESSION['payNowDetails']) && isset($_SESSION['dataOrderTables'])){
        $payNowDetails = array($_SESSION['payNowDetails']);
        $dataOrderTables = $_SESSION['dataOrderTables'];
        $idAccountUser = $_SESSION['user']["IdAccount"];
        extract($dataOrderTables);

        foreach($payNowDetails as $valueDataOrder){
            $sqlWaytingOrder = "insert into waytingorder values(null, '$IdTable', '$valueDataOrder[IdProduct]', '$idAccountUser', '$valueDataOrder[Quantity]', '1', '$TimeOrder')";
            pdo_Execute($sqlWaytingOrder);
        }
        $_SESSION['payNowDetails'] = "";
        $_SESSION['dataOrderTables'] = "";
        $message = "Đơn hàng đã được thanh toán";
    }

    return $message;

}
?>