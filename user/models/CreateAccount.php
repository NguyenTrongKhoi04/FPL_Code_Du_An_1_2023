<?php
function CreateAccount_CreateAccount($data){
    extract($data);
    $date = date("d/m/Y H:i:s");
    $sql = "insert into account values(null, $name, $email,  null ,$password, null,0,'KH', '$date' )";
    if(pdo_Execute($sql) === null){
        return true;
    }else{
        return "505";
    }
}
?>