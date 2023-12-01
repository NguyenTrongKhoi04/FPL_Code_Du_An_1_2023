<?php
include_once "../app/Pdo.php";

/**
 * $data: dữ liệu từ form post
 * */ 
function getIdTable(){
    $sql= "select * from  tables";
    return query_All($sql);  
}




function getIdAccount(){
    $sql= "select * from account";
    return query_All($sql);  
}




/**
 * $data: dữ liệu từ form post
 * $IdDetails: Lấy IdDetails mới được thêm vào
 * $dataImage: dữ liệu ảnh từ from file
 * */ 

//  Toàn văn
//  IdOrder	
//  IdTable	
//  IdAccount	
//  PaymentMethod	
//  PriceOrders	
//  NumberInPeople	
//  StatusOrders	
//  OrderDate

function pushOrder($data){
    extract($data);

    $sql= "insert into orders values ('','$IdTable', '$IdAccount','', '$PriceOrders','$NumberInPeople','' ,'')";

    return pdo_Execute($sql);
}

function getListOrder(){

    $sql ='
    select od.*,tb.*,ac.* from orders od 
    join tables tb on od.IdTable = tb.IdTables
     join account ac on od.IdAccount = ac.IdAccount;
    ';
    return query_All($sql);
}

/**
 * $idProduct: Id của sản phẩm được truyền vào 

 * */ // Toàn văn
// IdOrder
// IdTable
// IdAccount
// PaymentMethod
// PriceOrders
// NumberInPeople
// StatusOrders
// OrderDate
function deleteOrder($IdOrder){
    $sql = "delete from orders where IdOrder = $IdOrder";
    return pdo_Execute($sql);
}
 
function updateOrder($dataOrder, $IdOrder){
    extract($dataOrder);

    $sqlOrder = "
    update orders set IdTable = '$IdTable', IdAccount  = '$IdAccount',PaymentMethod = '$PaymentMethod',PriceOrders = '$PriceOrders',NumberInPeople= '$NumberInPeople',
    StatusOrders = '$StatusOrders' where IdOrder = '$IdOrder' 
    ";
    
    return pdo_Execute($sqlOrder);
}

function getOrder($IdOrder){
    $sql = "select od.*,tb.*,ac.* from orders od 
    join tables tb on od.IdTable = tb.IdTables
     join account ac on od.IdAccount = ac.IdAccount ;
     where od.IdOrder = $IdOrder
    ";
    
    return query_All($sql);
}

function check_Order($IdTable,$IdAccount){


        $sql = "SELECT * FROM  orders  WHERE IdTable = '$IdTable' AND IdAccount ='$IdAccount' ";
  
        return query_One($sql);
    
}
?>