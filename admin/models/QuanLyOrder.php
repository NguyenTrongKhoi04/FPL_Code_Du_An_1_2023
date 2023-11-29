<?php
function list_OrderChuaXacNhan(){
    $sql = "SELECT orders.*,account.NameAccount, COUNT(IdOrder_Pro) as 'SoMonGoi'
            FROM order_pro
            INNER JOIN orders ON order_pro.IdOrder = orders.IdOrder
            INNER JOIN account ON account.IdAccount = orders.IdAccount 
            WHERE orders.StatusOrders = 5
                GROUP BY order_pro.IdOrder_Pro
            ";
    return query_All($sql) ;
}

function xacNhanOrder($IdOrder){
    $sql ="UPDATE orders SET StatusOrders = 1 WHERE IdOrder = $IdOrder";
    return pdo_Execute($sql);
}