<?php
include_once "../app/Pdo.php";


/**
 * $data: dữ liệu từ form post
 * */ 
function pushProductDetails($data){
    extract($data);
    $sql= "insert into details values(null, '$ProductDetails' ,'$ProductDescription')";
    return pdo_Execute_Return_LastinsertID($sql);
   
}

function getAllCategory(){
    $sql= "select * from category";
   return query_All($sql);
     
}
/**
 * $data: dữ liệu từ form post
 * $IdDetails: Lấy IdDetails mới được thêm vào
 * $dataImage: dữ liệu ảnh từ from file
 * */ 
function pushProduct($data, $dataImage, $IdDetails){
    extract($data);
    extract($dataImage);

    $sql= "insert into product values ('', '$IdCategory', '$IdDetails', '$Name', '$Quantity', '$Price', '$name', '', '')";

    move_uploaded_file($tmp_name, "../assets/upload/".$name);
    return pdo_Execute($sql);
}

 
?>