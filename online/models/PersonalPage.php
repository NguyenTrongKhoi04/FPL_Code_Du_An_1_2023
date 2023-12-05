<?php 
function PersonalPage_PushProfileUser($data, $dataImage, $IdAccount){
    extract($data);
    extract($dataImage);  

    if($name === ""){
        pdo_Execute("update account set NameAccount = '$NameAccount', Gmail = '$Gmail', Gender = '$Gender', Password = '$Password' where IdAccount = $IdAccount");
    }else{
        pdo_Execute("update account set NameAccount = '$NameAccount', Gmail = '$Gmail', Gender = '$Gender', Password = '$Password', ImageAccounts = '$name' where IdAccount = $IdAccount");
        move_uploaded_file($tmp_name, "../assets/img/admin/".$name);
    }
    
}

function PersonalPage_GetProfileUser($IdAccount){
    return query_All("select * from account where IdAccount = $IdAccount");
}
?>