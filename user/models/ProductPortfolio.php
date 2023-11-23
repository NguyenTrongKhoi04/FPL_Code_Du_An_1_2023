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
 * $dataPrice: dữ liệu giá nhận từ khách hàng yêu cầu cần tìm
 * $dataProducte: dữ liệu danh mục nhận từ khách hàng yêu cầu cần tìm
 * $idCategory: id danh mục. Được dùng để tìm dữ liệu trong khoảng danh mục đó
 */
function productPortfolio_GetAllProductAsRequested($dataPrice, $dataProduct, $idCategory)
{
    $sql = "";
    if ($dataPrice != "" && $dataProduct === "") {
        $contentPrice = explode("-", $dataPrice);
        $priceStart = $contentPrice[0];
        $priceEnd = $contentPrice[1];
        $sql = "SELECT p.IdProduct, p.NameProduct, p.ImageProduct, p.PriceProduct, d.ProductDetails
        FROM product p
        JOIN details d ON p.IdDetails = d.IdDetails
        WHERE p.StatusProduct = 0
          AND p.IdCategory = $idCategory
          AND p.PriceProduct BETWEEN $priceStart AND $priceEnd
        LIMIT 12;
        ";
    } elseif ($dataPrice === "" && $dataProduct != "") {
        $sql = "select
        p.IdProduct,p.NameProduct,p.ImageProduct, p.PriceProduct, d.ProductDetails 
        from product p
       join details d on p.IdDetails = d.IdDetails 
       where p.StatusProduct = 0 and p.IdCategory = $dataProduct limit 12 ";
    } elseif ($dataPrice != "" && $dataProduct != "") {
        $contentPrice = explode("-", $dataPrice);
        $priceStart = $contentPrice[0];
        $priceEnd = $contentPrice[1];
        $sql = "select
        p.IdProduct,p.NameProduct,p.ImageProduct, p.PriceProduct, d.ProductDetails 
        from product p
        join details d on p.IdDetails = d.IdDetails 
        where p.StatusProduct = 0 and p.IdCategory = $dataProduct 
        PriceProduct between $priceStart and $priceEnd
        limit 12 ";
    } else {
        return 505;
    }
    return query_All($sql);
}
/**
 * Thêm sản phẩm vào giỏ hàng
 */
function productPortfolio_addToCard($idProduct, $idAccount)
{
}
