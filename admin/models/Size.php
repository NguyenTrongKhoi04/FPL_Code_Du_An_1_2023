<?php
include_once "../app/Pdo.php";


/**
 * $data: dữ liệu từ form post
 * */ 
// function pushSizeDefault($data){
//     extract($data);
//     $sql= "insert into sizedefault values(null, '$SizeDefault' )";
//     return pdo_Execute_Return_LastinsertID($sql);
   
// }
function getAllSizeDefault(){
    $sql= "select * from sizedefault";
    return query_All($sql);  
}

function getProduct(){
    $sql= "select * from product";
    return query_All($sql);  
}
/**
 * $data: dữ liệu từ form post
 * $IdDetails: Lấy IdDetails mới được thêm vào
 * $dataImage: dữ liệu ảnh từ from file
 * */ 
function pushSize($data){
    extract($data);

    $sql= "insert into size values ('','$IdSizeDefault', '$IdProduct')";
var_dump($sql);
    return pdo_Execute($sql);
}


function getListSize(){
    // $sql = '
    //     select size.* , sizedefault.* , product.* from size s
    //     join  sizedefault d on s.IdSizeDefault = d.IdSizeDefault
    //     join product p on s.IdProduct = p.IdProduct;
    // ';
    $sql ='
    select sz.*,sd.*,pr.* from size sz 
    join sizedefault sd on sz.IdSizeDefault = sd.IdSizeDefault
     join product pr on sz.IdProduct = pr.IdProduct;
    ';
    return query_All($sql);
}

/**
 * $idProduct: Id của sản phẩm được truyền vào 

 * */ 
function deleteSize($IdSize){
    $sql = "delete from size where IdSize = $IdSize";
    return pdo_Execute($sql);
}
 
function updateSize($dataSize, $IdSize){
    extract($dataSize);

    $sqlSize = "
    update size set IdSizeDefault = '$IdSizeDefault', IdProduct = '$IdProduct' where IdSize = '$IdSize'
    ";
    
    return query_All($sqlSize);
}

function getSizeID($IdSize){
    $sql = "select sz.*, sd.*,pr.* from size sz 
    join sizedefault sd on sz.IdSizeDefault = sd.IdSizeDefault
     join product pr on sz.IdProduct = pr.IdProduct;
    where sz.IdSize = $IdSize
    ";
    return query_All($sql);
}

?>