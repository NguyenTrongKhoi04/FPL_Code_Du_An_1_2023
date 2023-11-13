<?php
include_once "../app/Pdo.php";

/**
 * $data: dữ liệu từ form post
 * $dataImage: dữ liệu ảnh từ from file
 * */ 
function pushAcount($data, $dataImage){
    extract($data);
    extract($dataImage);

    $sql= "insert into account values ('', '$Name','$Gmail', '$Gender','$Password','$name', '','$Type', '')";
    move_uploaded_file($tmp_name, "../assets/img/admin/".$name);
    return pdo_Execute($sql);
}

function getListAccount(){
    $sql = 'select * from account';
    return query_All($sql);
}

/**
 * $idAccount: Id của sản phẩm được truyền vào 

 * */ 
function deleteAccount($idAccount){
    $sql = "update account set StatusAccount = 1 where IdAccount = $idAccount";
    return pdo_Execute($sql);
}

 /**
 * $idAccount: Id của sản phẩm được truyền vào 
 * dataImage: Dữ liệu ảnh sản phẩm cần update
 * $dataAccount: Dữ liệu sản phẩm cần update

 * */ 
function updateListAccount($dataAccount, $dataImage, $IdAccount){
    extract($dataAccount);
    extract($dataImage);
    $sqlAccount = "
    update account set  NameAccounts = '$Name',  Gmail = '$Gmail', Gender = '$Gender', 	Password = '$Password',	ImageAccounts = '$name', StatusAccount = '$Status', Type = '$Type' where IdAccount = '$IdAccount'";
    
    move_uploaded_file($tmp_name, "../assets/img/admin/".$name);
    return query_All($sqlAccount);
}

function getAccountById($IdAccount){
    $sql = "select * from account where IdAccount = $IdAccount";
    return query_All($sql);
}

?>