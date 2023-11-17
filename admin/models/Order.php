<?php
include_once "../app/Pdo.php";

/**
 * $data: dữ liệu từ form post
 * */ 
function getIdTable(){
    $sql= "select * from tables";
    return query_All($sql);  
}

function getIdAccompanyingfood(){
    $sql= "select * from accompanyingfood";
    return query_All($sql);  
}

function getIdProduct(){
    $sql= "select * from product";
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
// IdOder	IdTable	IdAccompanyingFood	IdProduct	IdAccount	PriceOrders	StatusOrders	QuantityOrders	NoteOrders	

function pushOrder($data){
    extract($data);

    $sql= "insert into orders values ('','$IdTable','$IdAccompanyingFood','$IdProduct', '$IdAccount','$PriceOrders', '' ,'$QuantityOrders', '$NoteOrders')";

    return pdo_Execute($sql);
}


function getListOrder(){
    // $sql = '
    //     select size.* , sizedefault.* , product.* from size s
    //     join  sizedefault d on s.IdSizeDefault = d.IdSizeDefault
    //     join product p on s.IdProduct = p.IdProduct;
    // ';
    
    $sql ='
    select od.*,tb.*,af.*,pr.*,ac.* from orders od 
    join tables tb on od.IdTable = tb.IdTable
    join accompanyingfood af on od.IdAccompanyingFood = af.IdAccompanyingFood
     join product pr on od.IdProduct = pr.IdProduct
     join account ac on od.IdAccount = ac.IdAccount;
    ';
    return query_All($sql);
}

/**
 * $idProduct: Id của sản phẩm được truyền vào 

 * */ 
function deleteOrder($IdOder){
    $sql = "delete from orders where IdOder = $IdOder";
    return pdo_Execute($sql);
}
 
function updateOrder($dataOrder, $IdOder){
    extract($dataOrder);

    $sqlOrder = "
    update orders set IdTable = '$IdTable',IdAccompanyingFood = '$IdAccompanyingFood',IdProduct = '$IdProduct',
    IdAccount  = '$IdAccount',PriceOrders = '$PriceOrders',StatusOrders = '$StatusOrders' ,QuantityOrders = '$QuantityOrders',
     NoteOrders= '$NoteOrders' where IdOder = '$IdOder'
    ";
    
    return pdo_Execute($sqlOrder);
}

function getOrder($IdOder){
    $sql = "select od.*,tb.*,af.*,pr.*,ac.* from orders od 
    join tables tb on od.IdTable = tb.IdTable
    join accompanyingfood af on od.IdAccompanyingFood = af.IdAccompanyingFood
     join product pr on od.IdProduct = pr.IdProduct
     join account ac on od.IdAccount = ac.IdAccount ;
     where od.IdOder = $IdOder
    ";
    
    return query_All($sql);
}

?>