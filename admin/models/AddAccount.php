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
    move_uploaded_file($tmp_name, "../assets/upload/".$name);
    return pdo_Execute($sql);
}

 
?>