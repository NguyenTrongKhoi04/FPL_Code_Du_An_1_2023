<?php
include_once "../app/Pdo.php";

/**
 * $data: dữ liệu từ form post
 * $dataImage: dữ liệu ảnh từ from file
 * */ 



function pushSize($data){
         extract($data);
         $sql = "insert into size values ('','$NameSize')";
         return pdo_Execute($sql);
}

function getListSize(){
        $sql= "select * from size";
        return query_All($sql);
}

function deleteSize($IdSize){
    $sql = "DELETE FROM size_pro WHERE IdSize = $IdSize";
    pdo_Execute($sql);

    $sql = "delete from size where IdSize = $IdSize";
    return pdo_Execute($sql);
}

/**
 * $idAccount: Id của sản phẩm được truyền vào 
 * dataImage: Dữ liệu ảnh sản phẩm cần update
 * $dataAccount: Dữ liệu sản phẩm cần update

 * */ 
function updateSize($dataSize, $IdSize){
    extract($dataSize);  
    
    $sqlSize = "update size set NameSize = '$NameSize' where IdSize = '$IdSize' ";
   
    return pdo_Execute($sqlSize);
}

function getSize($IdSize){
    
    $sql = "select * from size where IdSize = $IdSize";
    return query_All($sql);
}

function check_Size($NameSize){

    $sql = "SELECT * FROM  size  WHERE NameSize = '$NameSize'";
    
    return query_One($sql);
}
// $a ='khoi';
// var_dump($a);