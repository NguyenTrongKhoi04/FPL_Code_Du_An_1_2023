<?php 
include_once "../app/Pdo.php";
// Toàn văn
// IdOrder_Pro	
// IdOrder	
// IdProduct	
// StatusOrders	

/**
 * $data: dữ liệu từ form post
 * */ 

//  Toàn văn

// Toàn văn
// IdOrder
// IdOrder_Pro
// IdProduct
// NameSize
// QuantityOrderPro
// StatusOrders

 
function getIdOrderPro(){
    $sql= "select * from orders";
    return query_All($sql);  
}

function getOrProduct(){
    $sql= "select * from product";
    return query_All($sql);  
}

function pushOrderPro($data){
    extract($data);

    $sql= "insert into order_pro values ('','$IdOrder', '$IdProduct' ,'$NameSize', '$QuantityOrderPro' ,'' )";

    return pdo_Execute($sql);
}

function getListOrderPro(){

    $sql ='
    select op.*,od.IdOrder,pr.* from order_pro op 
    join orders od on op.IdOrder = od.IdOrder
     join product pr on op.IdProduct = pr.IdProduct';
    return query_All($sql);
}

/**
 * $idProduct: Id của sản phẩm được truyền vào 

 * */ 
function deleteOrderPro($IdOrder_Pro){
    $sql = "delete from order_pro where IdOrder_Pro = $IdOrder_Pro";
    return pdo_Execute($sql);
}

function updateOrderPro($dataOrderPro, $IdOrder_Pro){
    extract($dataOrderPro);

    $sqlOrderPro = "
    update order_pro set IdOrder = '$IdOrder', IdProduct  = '$IdProduct',NameSize='$NameSize',QuantityOrderPro = '$QuantityOrderPro',
    StatusOrders = '$StatusOrders' where IdOrder_Pro = '$IdOrder_Pro'
    ";
    
    return pdo_Execute($sqlOrderPro);
}

function getOrderPro($IdOrder_Pro){
    $sql = " select op.*,od.*,pr.* from order_pro op 
    join orders od on op.IdOrder = od.IdOrder
     join product pr on op.IdProduct = pr.IdProduct
     where op.IdOrder_Pro = $IdOrder_Pro
    ";

    return query_All($sql);
}

?>