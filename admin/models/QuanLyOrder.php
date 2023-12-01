<?php
function list_OrderChuaXacNhan(){
    $sql = "SELECT orders.*,account.NameAccount, SUM(order_pro.QuantityOrderPro) as 'SoMonGoi'
            FROM orders
            INNER JOIN order_pro ON order_pro.IdOrder = orders.IdOrder
            INNER JOIN account ON account.IdAccount = orders.IdAccount 
            WHERE orders.StatusOrders = 5
                GROUP BY IdTable
            ";
    return query_All($sql) ;
}

function xacNhanOrder($IdOrder){
    $sql ="UPDATE orders SET StatusOrders = 6, PaymentMethod = 1 WHERE IdOrder = $IdOrder";
    pdo_Execute($sql);
    // set bàn trống
    $sql = "SELECT * FROM orders WHERE IdOrder = $IdOrder";
    $one_Orders = query_One($sql);
    $one_Orders_IdTable = $one_Orders['IdTable'];
    $sql = "UPDATE tables SET StatusTable = 0 WHERE IdTables = $one_Orders_IdTable";
    return pdo_Execute($sql);
}

function list_product(){
    $sql = "SELECT * FROM product ";
    return query_All($sql);
}

function list_Size_Pro(){
    $sql = "SELECT * FROM size_pro";
    return query_All($sql);
}

function list_Size(){
    $sql = "SELECT * FROM size";
    return query_All($sql);
}