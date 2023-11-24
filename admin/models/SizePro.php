<?php
include_once "../app/Pdo.php";


/**
 * $data: dữ liệu từ form post
 * */ 

function getAllSize(){
    $sql= "select * from size";
    return query_All($sql);  
}

function getSPProduct(){
    $sql= "select * from product";
    return query_All($sql);  
}
/**
 * $data: dữ liệu từ form post
 * $IdDetails: Lấy IdDetails mới được thêm vào
 * $dataImage: dữ liệu ảnh từ from file
 * */ 
function pushSizePro($data){
    extract($data);

    $sql= "insert into size_pro values ('','$IdProduct','$IdSize')";

    return pdo_Execute($sql);
}


function getListSizePro(){

    $sql ='
    select sp.*,sz.*,pr.* from size_pro sp 
     join product pr on sp.IdProduct = pr.IdProduct
    join size sz on sp.IdSize = sz.IdSize;
    
    ';
    return query_All($sql);
}

/**
 * $idProduct: Id của sản phẩm được truyền vào 

 * */ 
function deleteSizePro($IdSizePro){
    $sql = "delete from size_pro where IdSizePro = $IdSizePro";
    return pdo_Execute($sql);
}
 
function updateSizePro($dataSizePro, $IdSizePro){
    extract($dataSizePro);

    $sqlSizePro = "

    update size_pro set  IdProduct = '$IdProduct' , IdSize = '$IdSize' where IdSizePro = '$IdSizePro'

    ";
    
    return pdo_Execute($sqlSizePro);
    
}

function getSizePro($IdSizePro){
    $sql = "  select sp.*, sz.*,pr.* from size_pro sp 
    join product pr on sp.IdProduct = pr.IdProduct
    join size sz on sp.IdSize = sz.IdSize;
    
    where sp.IdSizePro = $IdSizePro
    ";
    return query_All($sql);
}

function check_SizePro($IdProduct,$IdSize){

    $sql = "SELECT * FROM  size_pro  WHERE IdProduct = '$IdProduct' AND IdSize ='$IdSize' ";
    
    return query_One($sql);
}

?>