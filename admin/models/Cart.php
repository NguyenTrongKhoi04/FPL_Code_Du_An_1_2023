<?php
include_once "../app/Pdo.php";

/**
 * $data: dữ liệu từ form post
 * */ 

function getCAccount(){
    $sql= "select * from account";
    return query_All($sql);  
}

function getCProduct(){
    $sql= "select * from product";
    return query_All($sql);  
}



// Toàn văn
// IdCart	
// IdProduct	
// IdAccount	
// Size	
// PriceCard	
// Quantity	
// DateCart
function pushCart($data){
    extract($data);

    $sql= "insert into cart values ('','$IdProduct','$IdAccount','$Size','$PriceCard','$Quantity' ,'')";

    return pdo_Execute($sql);
}
	

function getListCart(){
    
    $sql ='
    select cr.*,ac.*,pr.* from cart cr
    
     join product pr on cr.IdProduct = pr.IdProduct
     join account ac on cr.IdAccount = ac.IdAccount
    ';
    return query_All($sql);
}

/**
 * $idProduct: Id của sản phẩm được truyền vào 
*	IdCart	IdAccount	IdProduct	IdSize	Quantity	Price	
 * */ 
function deleteCart($IdCart){
    $sql = "delete from cart where IdCart = $IdCart";
    return pdo_Execute($sql);
}

function updateCart($dataCart, $IdCart){
     extract($dataCart);

    $sqlCart = "
    update cart set IdAccount = '$IdAccount', IdProduct = '$IdProduct' , Size = '$Size',
     PriceCard = '$PriceCard', Quantity = '$Quantity' where IdCart = '$IdCart'
    ";
    
    return pdo_Execute($sqlCart);
}

function getCart($IdCart){
    $sql = " select cr.*,ac.*,pr.* from cart cr 
     join account ac on cr.IdAccount = ac.IdAccount  
    join product pr on cr.IdProduct = pr.IdProduct
     where cr.IdCart = $IdCart
    ";
    
    return query_All($sql);
}
?>