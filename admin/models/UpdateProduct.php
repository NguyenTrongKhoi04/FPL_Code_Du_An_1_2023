<?php 
function updateListProduct($data, $dataImage, $IdProduct, $IdDetails){
    extract($data);
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


    
?>