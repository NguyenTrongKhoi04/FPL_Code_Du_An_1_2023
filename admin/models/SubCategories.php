<?php
include_once "../app/Pdo.php";


/**
 * $data: dữ liệu từ form post
 * */ 


function getAllCategory(){
    $sql= "select * from category";
   return query_All($sql);
     
}
/**
 * $data: dữ liệu từ form post
 * $IdDetails: Lấy IdDetails mới được thêm vào
 * $dataImage: dữ liệu ảnh từ from file
 * */ 

//  Toàn văn
//  IdSubCategories	
//  IdCategory	
//  SubCategories	
//  StatusSubCategories	

function pushSubCategories($data){
    extract($data);
    var_dump($data);

    $sql= "insert into subcategories values('','$IdCategory','$SubCategories','')";
    var_dump($sql);
    return pdo_Execute($sql);
}


function getSubCategories(){
    $sql = '
        select sb.*,ct.* from subcategories sb
        join category ct on sb.IdCategory = ct.IdCategory;
    ';
    return query_All($sql);
}

/**
 * $idProduct: Id của sản phẩm được truyền vào 

 * */ 
// Toàn văn
// IdSubCategories	
// IdCategory	
// SubCategories	
// StatusSubCategories
function deleteSubCategories($idSubCategories){
    $sql = "update subcategories set StatusSubCategories = 1 where IdSubCategories = $idSubCategories";
    return pdo_Execute($sql);
}


function updateSubCategories($dataSubCategories, $IdCategory){
    extract($dataSubCategories);
    // var_dump($dataSubCategories);
    // die;
    $sqlSubCategories = "
    update subcategories set IdCategory = '$IdCategory' ,SubCategories = '$Name',
    StatusSubCategories='$StatusSubCategories'  where IdSubCategories = '$IdSubCategories'
    ";
   
    return pdo_Execute($sqlSubCategories);
}

function getAllSubCategories($IdSubCategories){
    $sql = "select sb.*,ct.* from subcategories sb
    join category ct on sb.IdCategory = ct.IdCategory;
    where sb.IdSubCategories = $IdSubCategories
    ";
    return query_All($sql);
}
?>
