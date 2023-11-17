<?php
include_once "../app/Pdo.php";

/**
 * $data: dữ liệu từ form post
 * */ 
function getBTable(){
    $sql= "select * from tables";
    return query_All($sql);  
}

function getBAccompanyingfood(){
    $sql= "select * from accompanyingfood";
    return query_All($sql);  
}

function getBProduct(){
    $sql= "select * from product";
    return query_All($sql);  
}

function getBAccount(){
    $sql= "select * from account";
    return query_All($sql);  
}

// IdBill	IdAccount	IdProduct	IdTable	IdAccompanyingFood	QuantityBill	PriceBill	StatusBill	DateEditBill	NoteBill	PaymentsBill	
function pushBill($data){
    extract($data);

    $sql= "insert into bill values ('','$IdAccount','$IdProduct','$IdTable','$IdAccompanyingFood' ,'$QuantityBill', '$PriceBill','' ,'','$NoteBill', '')";

    return pdo_Execute($sql);
}

function getListBill(){
    
    $sql ='
    select bl.*,tb.*,af.*,pr.*,ac.* from bill bl 
    join tables tb on bl.IdTable = tb.IdTable
    join accompanyingfood af on bl.IdAccompanyingFood = af.IdAccompanyingFood
     join product pr on bl.IdProduct = pr.IdProduct
     join account ac on bl.IdAccount = ac.IdAccount;
    ';
    return query_All($sql);
}

/**
 * $idProduct: Id của sản phẩm được truyền vào 

 * */ 
function deleteBill($IdBill){
    $sql = "delete from bill where IdBill = $IdBill";
    return pdo_Execute($sql);
}
// IdBill	IdAccount	IdProduct	IdTable	IdAccompanyingFood	
//QuantityBill	PriceBill	StatusBill	DateEditBill	NoteBill	PaymentsBill	
function updateBill($dataBill, $IdBill){
    extract($dataBill);

    $sqlBill = "
    update bill set IdAccount  = '$IdAccount',IdProduct = '$IdProduct', IdTable = '$IdTable',
    IdAccompanyingFood = '$IdAccompanyingFood',
    QuantityBill = '$QuantityBill',PriceBill = '$PriceBill',StatusBill = '$StatusBill',
    NoteBill= '$NoteBill' where IdBill = '$IdBill'
    ";
    
    return pdo_Execute($sqlBill);
}

function getBill($IdBill){
    $sql = "    select bl.*,tb.*,af.*,pr.*,ac.* from bill bl 
    join tables tb on bl.IdTable = tb.IdTable
    join accompanyingfood af on bl.IdAccompanyingFood = af.IdAccompanyingFood
     join product pr on bl.IdProduct = pr.IdProduct
     join account ac on bl.IdAccount = ac.IdAccount;
     where bl.IdBill = $IdBill
    ";
    
    return query_All($sql);
}
?>