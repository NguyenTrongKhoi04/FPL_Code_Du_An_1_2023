<?php 
function getListProduct(){
    $sql = '
        select p.* , c.* , d.* from product p
        join category c on p.IdCategory = c.IdCategory
        join details d on p.IdDetails = d.IdDetails;
    ';
    return query_All($sql);
}

/**
 * $idProduct: Id của sản phẩm được truyền vào 

 * */ 
function deleteProduct($idProduct){
    $sql = "update product set Status = 1 where IdProduct = $idProduct";
    return pdo_Execute($sql);
}

?>