<?php
include_once "../app/Pdo.php";
include_once '../assets/global/url_Path.php';
function getAllProduct(){
    $sql= "select * from product";
    return query_All($sql);
     
}
// IdAccompanyingFood	IdProduct	
// NameAccompanyingFood	QuantityAccompanyingFood	
// PriceAccompanyingFood	ImageAccompanyingFood	StatusAccompanyingFood	

                                                   
function pushAccompanyingfood($IdProduct, $NameAccompanyingFood, $QuantityAccompanyingFood, $PriceAccompanyingFood, $ImageAccompanyingFood){
    
    $sql= "insert into accompanyingfood values ('', '$IdProduct', '$NameAccompanyingFood', '$QuantityAccompanyingFood', '$PriceAccompanyingFood', '$ImageAccompanyingFood', '')";
    return pdo_Execute($sql);
}

function getAccompanyingfood(){
    // $sql = '
    //     select size.* , sizedefault.* , product.* from size s
    //     join  sizedefault d on s.IdSizeDefault = d.IdSizeDefault
    //     join product p on s.IdProduct = p.IdProduct;
    // ';
    $sql ='
    select af.*,pr.* from accompanyingfood af 
    join product pr on af.IdProduct = pr.IdProduct
    ';
    return query_All($sql);
}

/**
 * $idProduct: Id của sản phẩm được truyền vào 

 * */ 
function deleteAccompanyingfood($IdAccompanyingFood){
    $sql = "delete from accompanyingfood where IdAccompanyingFood = $IdAccompanyingFood";
    return pdo_Execute($sql);
}

function updateAccompanyingfood($IdAccompanyingFood, $IdProduct, $NameAccompanyingFood, $QuantityAccompanyingFood, $PriceAccompanyingFood, $ImageAccompanyingFood, $StatusAccompanyingFood){


    $sqlSize = "
    update accompanyingfood set IdProduct = '$IdProduct' ,NameAccompanyingFood = '$NameAccompanyingFood', QuantityAccompanyingFood = '$QuantityAccompanyingFood', PriceAccompanyingFood = '$PriceAccompanyingFood',
    ImageAccompanyingFood = '$ImageAccompanyingFood',StatusAccompanyingFood = '$StatusAccompanyingFood' where IdAccompanyingFood = '$IdAccompanyingFood'
    ";
    
    return query_All($sqlSize);
}

function getAllAccompanyingfood($IdAccompanyingFood){
    $sql = "select af.*,pr.* from accompanyingfood af 
    join product pr on af.IdProduct = pr.IdProduct
    where af.IdAccompanyingFood = $IdAccompanyingFood
    ";
    return query_All($sql);
}

?>