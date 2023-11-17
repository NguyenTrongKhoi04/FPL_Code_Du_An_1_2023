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

function getCSize(){
    $sql= "select * from size";
    return query_All($sql);  
}

function pushCard($data){
    extract($data);

    $sql= "insert into card values ('','$IdAccount','$IdProduct','$IdSize','$Quantity' ,'$Price')";

    return pdo_Execute($sql);
}
	

function getListCard(){
    
    $sql ='
    select cr.*,ac.*,pr.*,sz.* from card cr
    
     join product pr on cr.IdProduct = pr.IdProduct
     join account ac on cr.IdAccount = ac.IdAccount
     join size sz on cr.IdSize = sz.IdSize;
    ';
    return query_All($sql);
}

/**
 * $idProduct: Id của sản phẩm được truyền vào 
*	IdCart	IdAccount	IdProduct	IdSize	Quantity	Price	
 * */ 
function deleteCard($IdCart){
    $sql = "delete from card where IdCart = $IdCart";
    return pdo_Execute($sql);
}

function updateCard($dataCard, $IdCart){
     extract($dataCard);

    $sqlCard = "
    update card set IdAccount = '$IdAccount', IdProduct = '$IdProduct' , IdSize = '$IdSize',
    Quantity = '$Quantity', Price = '$Price' where IdCart = '$IdCart'
    ";
    
    return pdo_Execute($sqlCard);
}

function getCard($IdCart){
    $sql = " select cr.*,ac.*,pr.*,sz.* from card cr 
     join account ac on cr.IdAccount = ac.IdAccount  
    join product pr on cr.IdProduct = pr.IdProduct
   
    join size sz on cr.IdSize = sz.IdSize;
     where cr.IdCart = $IdCart
    ";
    
    return query_All($sql);
}
?>