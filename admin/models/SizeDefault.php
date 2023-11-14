<?php
include_once "../app/Pdo.php";

/**
 * $data: dữ liệu từ form post
 * $dataImage: dữ liệu ảnh từ from file
 * */ 


// function getSizeDefault($data){
//     extract($data);
//     $sql= "select * from sizedefault values(null, '$SizeDefault')";
//     return pdo_Execute_Return_LastinsertID($sql);   
// }

// function 

// function pushSize($data){
//     extract($data);
//     $sql= "insert into size values ('','$IdSizeDefault','$IdProduct')";
//     return pdo_Execute($sql);
// }

function pushSizeDefault($data){
         extract($data);
         $sql = "insert into sizedefault values ('','$SizeDefault')";
         var_dump($sql);
         return pdo_Execute($sql);
}

function getListSizeDefault(){
        $sql= "select * from sizedefault";
        return query_All($sql);
}

function deleteSizeDefault($idSizeDefault){
    $sql = "delete from sizedefault where IdSizeDefault = $idSizeDefault";
    return pdo_Execute($sql);
}

/**
 * $idAccount: Id của sản phẩm được truyền vào 
 * dataImage: Dữ liệu ảnh sản phẩm cần update
 * $dataAccount: Dữ liệu sản phẩm cần update

 * */ 
function updateSizeDefault($dataSizeDefault, $IdSizeDefault){
    extract($dataSizeDefault);  
    
    $sqlSizeDefault = "update sizedefault set SizeDefault = '$Name' where IdSizeDefault = '$IdSizeDefault' ";
   
    return pdo_Execute($sqlSizeDefault);
}

function getSizeDefault($IdSizeDefault){
    
    $sql = "select * from sizedefault where IdSizeDefault = $IdSizeDefault";
    return query_All($sql);
}

// $a ='khoi';
// var_dump($a);