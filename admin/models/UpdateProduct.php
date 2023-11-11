<?php 
/**
 * $idProduct: Id của sản phẩm được truyền vào 
 * $IdDetails: Id của bảng chi tiết sản phẩm
 * dataImage: Dữ liệu ảnh sản phẩm cần update
 * $dataProducr: Dữ liệu sản phẩm cần update

 * */ 
function updateListProduct($dataProducr, $dataImage, $IdProduct, $IdDetails){
    extract($dataProducr);
    extract($dataImage);
    $sqlProduct = "
    update product set 	IdCategory = '$IdCategory', Name = '$Name',  Quantity = '$Quantity', Price = '$Price', 	Image = '$name', Status = '$Status' where IdProduct = '$IdProduct'
    ";
    $sqlDetails = "
        update details  set  ProductDetails = '$ProductDetails', ProductDescription = '$ProductDescription' where IdDetails = '$IdDetails' 
    ";
    
    move_uploaded_file($tmp_name, "../assets/upload/".$name);
    query_All($sqlDetails);
    return query_All($sqlProduct);
}
function getProductById($IdProduct){
    $sql = "select p.* , c.* , d.* from product p
    join category c on p.IdCategory = c.IdCategory
    join details d on p.IdDetails = d.IdDetails
    where p.IdProduct = $IdProduct
    ";
    return query_All($sql);
}

    
?>