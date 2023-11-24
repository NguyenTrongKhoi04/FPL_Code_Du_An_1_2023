<?php
include_once "../app/Pdo.php";
include_once '../assets/global/url_Path.php';

// IdAccompanyingFood	IdProduct	
// Gmail	QuantityAccompanyingFood	
// PriceAccompanyingFood	ImageAccompanyingFood	StatusAccompanyingFood	
// Toàn văn

                                                   
function pushAccount($NameAccount, $Gmail, $Password, $ImageAccounts){
    
    $sql= "insert into account values ('', '$NameAccount', '$Gmail', '' , '$Password','$ImageAccounts', '' , '' ,'')";
    return pdo_Execute($sql);
}

function getListAccount(){

    $sql ='
    select * from account
    ';

    return query_All($sql);
}

/**
 * $idProduct: Id của sản phẩm được truyền vào 

 * */ // IdAccount	
// NameAccount	
// Gmail	
// Gender	
// Password	
// ImageAccounts	
// StatusAccount	
// Role	
// DateEditAccount
function deleteAccount($IdAccount){
    $sql = "update account set StatusAccount = 1 where IdAccount = $IdAccount";
    return pdo_Execute($sql);
}

function updateAccount($IdAccount, $NameAccount, $Gmail, $Gender , $Password, $ImageAccounts, $StatusAccount,$Role){

    $sqlAccount = "
    update account set NameAccount = '$NameAccount' ,Gmail = '$Gmail', Gender = '$Gender', Password = '$Password',
    ImageAccounts = '$ImageAccounts',StatusAccount = '$StatusAccount' ,Role = '$Role'  where IdAccount = '$IdAccount'
    ";

    return pdo_Execute($sqlAccount);
}

function getUAcount($IdAccount){
    $sql = "select * from account where IdAccount = $IdAccount";
    return query_All($sql);
}

function check_Gmail_Account($gmail){
    $sql = "SELECT * FROM account WHERE Gmail = '$gmail'";
    return query_One($sql);
    
}