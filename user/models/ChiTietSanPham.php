<?php
/**
 * return 4 bảng được join (product + details + category + subcategories) 
 * $id: Điều kiện Where 
 */
function chiTietSanPham_LoadAll($id){
    $sql = "SELECT details.*,product.*,category.*
        FROM details
        INNER JOIN product ON details.IdDetails = product.IdDetails
        INNER JOIN category ON product.IdCategory = category.IdCategory
        WHERE product.IdProduct = '$id'    
    ";   
    return query_One($sql);
}

function chiTietSanPham_LoadSizePro($id){
    $sql = "SELECT size.*,size_pro.*,product.*
        FROM product
        INNER JOIN size_pro ON size_pro.IdProduct = product.IdProduct
        INNER JOIN size ON size.IdSize = size_pro.IdSize
        WHERE product.IdProduct = '$id'
    ";
    return query_All($sql);
}

/**
 * return những sản phẩm cùng loại
 * Join 3 bảng (product + category + subcategories) 
 */
function chiTietSanPham_ProCungLoai($idDanhMuc,$NameLoaiTru){
    $sql = "SELECT product.*
        FROM product 
        INNER JOIN category ON product.IdCategory = category.IdCategory
        WHERE category.IdCategory ='$idDanhMuc' AND NOT product.NameProduct='$NameLoaiTru';  
    ";
    return query_All($sql);
}

/**
 * Return top 3 product dưới dạng array
 */
function chiTietSanPham_Top3_SanPham(){
    // lấy số Id của 3 đối tượng xuất hiện nhiều nhất =>> cho ID 3 đối tượng vào 1 mảng
    $sql = "SELECT IdProduct ,COUNT(IdProduct) AS 'dem' FROM bill GROUP BY IdProduct ORDER BY COUNT(IdProduct) DESC LIMIT 3";
    $arrDem = query_All($sql);
    $arr_ID_Top3 = [];
    for($i=0;$i<3;$i++){
        $pro_ID = $arrDem[$i]['IdProduct'];
        array_push($arr_ID_Top3,$pro_ID);
    } 

    // Lấy thông tin 3 đối tượng đó thông qua ID
    $arr_Top3 = [];
    for($i=0;$i<3;$i++){
        $arr_ID_Top3[$i];
        $pro = select_One('product',null,"IdProduct = '$arr_ID_Top3[$i]'");
        array_push($arr_Top3,$pro);
    }

    return $arr_Top3;
}

function chiTietSanPham_Add_To_Cart($idProduct,$idAccount,$idSize,$quantityProduct,$priceProduct){
    $sql = "";
    $sqlCheckProductInCart = query_All("select Quantity from cart where IdProduct = '$idProduct' and IdAccount = '$idAccount' " );
    if(empty($sqlCheckProductInCart)){
        $sql = "INSERT INTO cart(IdProduct,IdAccount,Size,Quantity,PriceCard) VALUES ('$idProduct','$idAccount','$idSize','$quantityProduct','$priceProduct')";
    }else{
        $totailQuantity = (int)$sqlCheckProductInCart[0]["Quantity"] + (int)$quantityProduct;
        $sql = "update cart set Quantity = '$totailQuantity' where IdProduct = '$idProduct' and IdAccount = '$idAccount' ";
    }
    pdo_Execute($sql);
    return "Sản phẩm đã được thêm vào giỏ hàng";
}

function chiTietSanPham_LoadDetails($id){
    $sql ="SELECT * FROM details WHERE IdDetails = $id";
    return query_One($sql);
}