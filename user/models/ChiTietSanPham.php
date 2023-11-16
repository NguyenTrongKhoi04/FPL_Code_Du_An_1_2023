<?php
/**
 * return 4 bảng được join (product + details + category + subcategories) 
 * $id: Điều kiện Where 
 */
function chiTietSanPham_LoadAll($id){
    $sql = "SELECT details.*,product.*,category.*,subcategories.*
        FROM details
        INNER JOIN product ON details.IdDetails = product.IdDetails
        INNER JOIN category ON product.IdCategory = category.IdCategory
        INNER JOIN subcategories ON subcategories.IdCategory = category.IdCategory
        WHERE product.IdProduct = '$id'    
    ";   
    var_dump($sql);
    return query_One($sql);
}

/**
 * return những sản phẩm cùng loại
 * Join 3 bảng (product + category + subcategories) 
 */
function sanPhamCungLoai($danhmuc,$danhmucphu){
    $sql = "SELECT product.*
        FROM product 
        INNER JOIN category ON product.IdCategory = category.IdCategory
        INNER JOIN subcategories ON subcategories.IdCategory = category.IdCategory
        WHERE category.NameCategory ='$danhmuc' AND subcategories.SubCategories = '$danhmucphu'  
    ";
    var_dump($sql);
    return query_One($sql);
}