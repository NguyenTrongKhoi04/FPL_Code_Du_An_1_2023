<?php
function updateBan($id,$NumberPeople,$NumberTable,$StatusTable){
    $sql = "UPDATE tables SET DefaultNumberPeople ='$NumberPeople',NumberTable='$NumberTable',StatusTable='$StatusTable' WHERE IdTables = '$id'";
    return pdo_Execute($sql);
}   

function updateBan_Day($id){
    $sql = "UPDATE tables SET StatusTable= 1 WHERE IdTables = '$id'";
    return pdo_Execute($sql);
}

function updateBan_Trong($id){
    $sql = "UPDATE tables SET StatusTable= 0 WHERE IdTables = '$id'";
    return pdo_Execute($sql);
}

function khong_Dung_Ban($id){
    $sql = "UPDATE tables SET StatusTable= 3 WHERE IdTables = '$id'";
    var_dump($sql);
    return pdo_Execute($sql);
}

function add_Ban($data){
    extract($data);
    $sql = "INSERT INTO `tables`(`NumberTable`,'DefaultNumberPeople') VALUES ('$NumberTable','$DefaultNumberPeople')";
    return pdo_Execute($sql);
}

function check_Ban($NumberTable){
    $sql ="SELECT * FROM tables WHERE NumberTable = $NumberTable";
    return query_All($sql);
}