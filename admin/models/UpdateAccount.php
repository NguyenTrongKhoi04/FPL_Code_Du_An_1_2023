<?php 
/**
 * $idAccount: Id của sản phẩm được truyền vào 
 * dataImage: Dữ liệu ảnh sản phẩm cần update
 * $dataAccount: Dữ liệu sản phẩm cần update

 * */ 
function updateListAccount($dataAccount, $dataImage, $IdAccount){
    extract($dataAccount);
    extract($dataImage);
    $sqlAccount = "
    update account set  Name = '$Name',  Gmail = '$Gmail', Gender = '$Gender', 	Password = '$Password',	Image = '$name', Status = '$Status', Type = '$Type' where IdAccount = '$IdAccount'
    ";
    
    move_uploaded_file($tmp_name, "../assets/upload/".$name);
    return query_All($sqlAccount);
}

function getAccountById($IdAccount){
    $sql = "select * from account where IdAccount = $IdAccount";
    return query_All($sql);
}


    
?>