<?php
function loadAll_Product(){
    $sql = "SELECT * FROM product";
    return query_All($sql);
}

function loadAll_Product_Category(){
    $sql = "SELECT * FROM category";
    return query_All($sql);
}

function loadAll_Product_Details(){
    $sql = "SELECT * FROM details";
    return query_All($sql);
}

function add_Product($NameProduct,$QuantityProduct,$PriceProduct,$ImageProduct, $IdCategory,$ProductDetails, $ProductDescription){
    $sql ="INSERT INTO details VALUES ('','$ProductDetails', '$ProductDescription') ";    
    $last_Id_Details = pdo_Execute_Return_LastinsertID($sql);

    $sql =" INSERT INTO product (IdCategory,IdDetails,NameProduct,QuantityProduct,PriceProduct,ImageProduct) VALUES('$IdCategory','$last_Id_Details','$NameProduct','$QuantityProduct','$PriceProduct','$ImageProduct')";
    var_dump($sql);
    return pdo_Execute($sql);
}