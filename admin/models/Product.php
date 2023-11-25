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
    return pdo_Execute($sql);
}

function loadOne_Product($id){
    $sql ="SELECT * FROM product WHERE IdProduct = '$id'";
    return query_One($sql);
}

function loadOne_Product_Details($id){
    $sql ="SELECT * FROM details WHERE IdDetails = '$id'";
    return query_One($sql);
}

function update_Product($id,$NameProduct,$QuantityProduct,$PriceProduct,$ImageProduct, $IdCategory,$ProductDetails, $ProductDescription){
    $sql ="SELECT * FROM product WHERE IdProduct = '$id'";
    $onePro = query_One($sql);
    $idOneDetails =$onePro['IdDetails'];

    $sql ="UPDATE details SET ProductDetails='$ProductDetails', ProductDescription='$ProductDescription' WHERE IdDetails = $idOneDetails";
    pdo_Execute($sql);

    $sql = "UPDATE product SET IdCategory='$IdCategory',NameProduct='$NameProduct',QuantityProduct='$QuantityProduct',PriceProduct='$PriceProduct',ImageProduct='$ImageProduct' WHERE IdProduct = $id";
    pdo_Execute($sql);
}

function delete_Product($id){
    $sql ="DELETE FROM product WHERE IdProduct = '$id'";
    return pdo_Execute($sql);
}

