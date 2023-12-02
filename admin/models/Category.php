<?php
include_once "../app/Pdo.php";

/**
 * $data: dữ liệu từ form post
 * $dataImage: dữ liệu ảnh từ from file
 * */ 

// Toàn văn
// IdCategory
// NameCategory
// StatusCategory



function pushCategory($data){
    extract($data);
    $sql= "insert into category values ('','$NameCategory','')";
    return pdo_Execute($sql);
}

function getListCategory(){
    $sql= "select * from category ";
    return query_All($sql);
}

function deleteCategory($idcategory){
    $sql = "UPDATE product SET StatusProduct= 1 WHERE IdCategory = $idcategory ";
    pdo_Execute($sql);
$sql = "update category set StatusCategory = 1 where IdCategory = $idcategory";
return pdo_Execute($sql);
}

function restoreCategory($idcategory){
    $sql = "UPDATE product SET StatusProduct= 0 WHERE IdCategory = $idcategory ";
    pdo_Execute($sql);
$sql = "update category set StatusCategory = 0 where IdCategory = $idcategory";
return pdo_Execute($sql);
}

function updateCategory($dataCategory, $IdCategory){
    extract($dataCategory);   
    $sqlCategory = "update category set NameCategory = '$Name', StatusCategory = '$Status' where IdCategory = '$IdCategory' ";
    return query_All($sqlCategory);
}

function getCategory($IdCategory){
    $sql = "select * from category where IdCategory = $IdCategory";
    return query_All($sql);
}

function check_Category($NameCategory){

    $sql = "SELECT * FROM category WHERE NameCategory = '$NameCategory'";
    
    return query_One($sql);
}
?>