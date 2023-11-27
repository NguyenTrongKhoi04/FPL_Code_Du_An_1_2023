<?php 
function CashViSa_GetAllOrderUser(){
    $message = "";
    if(isset($_SESSION['dataOrderCart']) && isset($_SESSION['dataOrderTables'])){
        $message = $_SESSION['dataOrderCart'];

    }
    return $message;
}

function CashViSa_PushOrderUser(){
    $message = "";
    $sql = "";
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

    }

    return $message;

}
?>