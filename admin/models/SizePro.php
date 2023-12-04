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
function pushSizePro($IdProduct,$addSizePro_IdSize,$addSizePro_Price,$img){
    

    $sql= "insert into size_pro values ('','$IdProduct','$addSizePro_IdSize','$addSizePro_Price','$img')";

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

    update size_pro set  IdProduct = '$IdProduct' , IdSize = '$IdSize' ,Price = '$Price'where IdSizePro = '$IdSizePro'

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

function check_SizePro($IdProduct,$IdSize,$Price){

    $sql = "SELECT * FROM  size_pro  WHERE IdProduct = '$IdProduct' AND IdSize ='$IdSize' AND Price = '$Price' ";
    
    return query_One($sql);
}

function getOne_Pro($id){
    $sql = "SELECT * FROM size_pro WHERE IdProduct = $id";
    return query_All($sql);
}

function check_Size_ConLai($arr_Data){

    if(!empty($arr_Data)){
        $resultString = implode(', ', $arr_Data);
        $sql = "SELECT * FROM size WHERE IdSize NOT IN ($resultString)";
    }else{
        $sql = "SELECT * FROM size";
    }
    unset($arr_Data);
    return query_All($sql);
}

function check_Het_Size($id_Pro){
    $sql = "SELECT COUNT(IdSize) as 'soluong' FROM size_pro WHERE IdProduct = $id_Pro";
    $check_SizePro = query_One($sql);

    $sql = "SELECT COUNT(IdSize) as 'soluong' FROM size";
    $check_Size = query_One($sql);

    if($check_Size['soluong'] == $check_SizePro['soluong']){
        return false;
    }else{
        return true;
    }

}

function Delete_SizePro($id){
    $sql = "DELETE FROM size_pro WHERE IdSizePro = '$id'";
    return pdo_Execute($sql);
}