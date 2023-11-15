<?php
include_once "../app/Pdo.php";

function getAllProduct(){
    $sql= "select * from product";
    return query_All($sql);
     
}
// IdAccompanyingFood	IdProduct	
// NameAccompanyingFood	QuantityAccompanyingFood	
// PriceAccompanyingFood	ImageAccompanyingFood	StatusAccompanyingFood	

function pushAccompanyingfood($data, $dataImage){
    extract($data);
    extract($dataImage);

    $sql= "insert into accompanyingfood values ('', '$IdProduct', '$NameAccompanyingFood', '$QuantityAccompanyingFood', '$PriceAccompanyingFood', '$name', '')";

    move_uploaded_file($tmp_name, "../assets/upload/".$name);   
    return pdo_Execute($sql);
}
echo '123';
?>