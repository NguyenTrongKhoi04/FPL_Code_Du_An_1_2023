<?php 
function getListAccount(){
    $sql = 'select * from account';
    return query_All($sql);
}

/**
 * $idAccount: Id của sản phẩm được truyền vào 

 * */ 
function deleteAccount($idAccount){
    $sql = "update account set Status = 1 where IdAccount = $idAccount";
    return pdo_Execute($sql);
}

?>