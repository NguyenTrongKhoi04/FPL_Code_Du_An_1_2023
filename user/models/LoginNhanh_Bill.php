<?php 
function LoginNhanh_update_MethodPay_PricePay($IdOrder,$PriceOrders,$method_Pay){
    $sql ="UPDATE orders SET StatusOrders=5, PriceOrders='$PriceOrders' WHERE IdOrder = $IdOrder";
    return pdo_Execute($sql);
}