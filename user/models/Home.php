<?php
include_once "../app/Pdo.php";

function home_GetAllProduct() {
    $sql = "select p.*, d.* from product p
    join details d on p.IdDetails = d.IdDetails
    where StatusProducts = 0";
    
   return query_All($sql);

}

?>