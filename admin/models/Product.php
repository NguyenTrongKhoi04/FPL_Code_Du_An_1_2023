<?php
include_once "../app/Pdo.php";
include_once "../assets/global/Validate.php";

/**
 * $data: dữ liệu từ form post
 * */ 
function pushProductDetails($data){
    extract($data);
    // tiến hành validate dữ liệu nhập vào 
    $ProductDetailsValidate = validateAll(null, $ProductDetails) === true ? 0 :  validateAll(null, $ProductDetails) ;
    $ProductDescriptionValidate = validateAll(null, $ProductDescription) === true ? 0 :  validateAll(null, $ProductDescription);

    if($ProductDetailsValidate !== 0 && $ProductDescriptionValidate !== 0 ) {
        return false;
    }else{
        $sql= "insert into details values(null, '$ProductDetails' ,'$ProductDescription')";
        return pdo_Execute_Return_LastinsertID($sql);

    }
}

function getAllCategory(){
    $sql= "select * from category";
   return query_All($sql);
     
}
/**
 * $data: dữ liệu từ form post
 * $IdDetails: Lấy IdDetails mới được thêm vào
 * $dataImage: dữ liệu ảnh từ from file
 * */ 
function pushProduct($data, $dataImage, $IdDetails){
    extract($data);
    extract($dataImage);
    $message ="" ;
   

    $NameValidate = validateAll(null, $Name) === true ? 0 :  validateAll(null, $Name);
    $QuantityValidate = validateAll('quality', $Quantity)  === true ? 0 :   validateAll('quality', $Quantity);
    $PriceValidate = validateAll('price', $Price) === true ? 0 :  validateAll('price', $Price);
    $dataImageValidate = validateImg($dataImage) === true ? 0 :  validateImg($dataImage);
    


    if($NameValidate === 0){
        if($QuantityValidate === 0){
            if($PriceValidate === 0){
                if($dataImageValidate === 0){

                    $sql= "insert into product values ('', '$IdCategory', '$IdDetails', '$Name', '$Quantity', '$Price', '$name', '', '')";

                    move_uploaded_file($tmp_name, "../assets/upload/".$name);   

                    if(pdo_Execute($sql) === null){
                        $message =  true;
                    }else{
                        $message =  "505";
                    }
                    
                }else{
                    $message = $dataImageValidate;
                }
            }else{
                $message = $PriceValidate;
            }
        }else{
            $message = $QuantityValidate;
        }
    }else{
        $message = $NameValidate;
    }

    return $message;
}

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
    $sql = "update product set StatusProducts = 1 where IdProduct = $idProduct";
    
    if(pdo_Execute($sql) === null){
        return true;
    }else{
        return "505";
    }
}

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
    update product set 	IdCategory = '$IdCategory', NameProducts = '$Name',  QuantityProducts = '$Quantity', PriceProducts = '$Price', 	ImageProducts = '$name', StatusProducts = '$Status' where IdProduct = '$IdProduct'
    ";
    $sqlDetails = "
        update details  set  ProductDetails = '$ProductDetails', ProductDescription = '$ProductDescription' where IdDetails = '$IdDetails' 
    ";
    
    move_uploaded_file($tmp_name, "../assets/img/admin/".$name);
    pdo_Execute($sqlDetails);
    if(pdo_Execute($sqlProduct) === null){
        return true;
    }else{
        return "505";
    }
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