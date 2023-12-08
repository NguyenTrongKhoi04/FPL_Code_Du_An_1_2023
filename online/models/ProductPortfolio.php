<?php

/**
 * Hàm có tác dụng trả ra sản phẩm dựa theo danh mục khách hàng chọn
 * $idCategory: Id của danh mục cần tìm
 */
function productPortfolio_GetAllProduct($idCategory)
{
    $sql = "select
     p.IdProduct,p.NameProduct,p.ImageProduct, p.PriceProduct, d.ProductDetails 
     from product p
    join details d on p.IdDetails = d.IdDetails 
    where p.StatusProduct = 0 and p.IdCategory = $idCategory limit 12 ";
    return query_All($sql);
}
/**
 * Hàm có tác dụng trả ra các danh mục
 */
function productPortfolio_GetAllCateogry()
{
    $sql = "select * from category where StatusCategory = 0";
    return query_All($sql);
}
/**
 * Hàm trả về sản phẩm dựa theo giá và danh mục khách hàng yêu cầu
 * $data: dữ liệu giá nhận từ khách hàng yêu cầu cần tìm

 */
function productPortfolio_GetAllProductAsRequested($data, $idCategory)
{
    extract($data);
    $message = query_All("
    SELECT
    p.IdProduct, p.NameProduct, p.ImageProduct, p.PriceProduct, d.ProductDetails 
    FROM product p
    JOIN details d ON p.IdDetails = d.IdDetails WHERE
    p.StatusProduct = 0 AND p.IdCategory = $idCategory AND
    p.NameProduct LIKE '%$contentShearch%' 
    LIMIT 12;
    ");
    if(count($message) == 0){
        $message = false;
    }
    return $message ;
}
/**
 * Thêm sản phẩm vào giỏ hàng
 */
function productPortfolio_addToCard($idProduct, $idAccount)
{
}
