<?php

/**
 * return 4 bảng được join (product + details + category + subcategories) 
 * $id: Điều kiện Where 
 */
function chiTietSanPham_LoadAll($id)
{
    $sql = "SELECT details.*,product.*,category.*
        FROM details
        INNER JOIN product ON details.IdDetails = product.IdDetails
        INNER JOIN category ON product.IdCategory = category.IdCategory
        WHERE product.IdProduct = '$id'    
    ";
    return query_One($sql);
}

function chiTietSanPham_LoadSizePro($id)
{
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
function chiTietSanPham_ProCungLoai($idDanhMuc, $NameLoaiTru)
{
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
function chiTietSanPham_Top3_SanPham()
{
    // lấy số Id của 3 đối tượng xuất hiện nhiều nhất =>> cho ID 3 đối tượng vào 1 mảng
    $sql = "SELECT IdProduct ,COUNT(IdProduct) AS 'dem' FROM bill GROUP BY IdProduct ORDER BY COUNT(IdProduct) DESC LIMIT 3";
    $arrDem = query_All($sql);
    $arr_ID_Top3 = [];
    for ($i = 0; $i < 3; $i++) {
        $pro_ID = $arrDem[$i]['IdProduct'];
        array_push($arr_ID_Top3, $pro_ID);
    }

    // Lấy thông tin 3 đối tượng đó thông qua ID
    $arr_Top3 = [];
    for ($i = 0; $i < 3; $i++) {
        $arr_ID_Top3[$i];
        $pro = select_One('product', null, "IdProduct = '$arr_ID_Top3[$i]'");
        array_push($arr_Top3, $pro);
    }

    return $arr_Top3;
}


function chiTietSanPham_Add_To_Order_Pro($idAccount, $IdProduct, $NameSize, $quantityProduct, $priceProduct)
{
    $sql = "SELECT * FROM orders WHERE IdAccount = '$idAccount' AND StatusOrders =0";
    $oneOrder = query_One($sql);
    $oneOrder_IdOrder = $oneOrder['IdOrder'];
    $sql = "INSERT INTO order_pro(IdOrder,IdProduct,NameSize,QuantityOrderPro) VALUES ('$oneOrder_IdOrder','$IdProduct','$NameSize','$quantityProduct')";
    return pdo_Execute($sql);
}

function chiTietSanPham_LoadDetails($id)
{
    $sql = "SELECT * FROM details WHERE IdDetails = $id";
    return query_One($sql);
}

/**
 * Lấy tất cả comment
 */
function chiTietSanPham_GetComment($pages){
    $row = 1; 
    $from = ($pages - 1) * $row;
    return query_One("SELECT co.IdComment , co.Content, ac.ImageAccounts, 
    (SELECT COUNT(*) FROM comment WHERE StatusComment = 0) AS TotalRecords
    FROM comment co
    JOIN account ac ON ac.IdAccount = co.IdAccount 
    WHERE co.StatusComment = 0 
    ORDER BY RAND() 
    LIMIT $from ,$row;");
}

/**
 * hàm có tác dụng lấy ra top các sản phẩm
 */
function chiTietSanPham_GetTopProduct(){
    return query_All("SELECT p.IdProduct, p.NameProduct, p.ImageProduct, p.PriceProduct
    FROM product p
    WHERE p.StatusProduct = 0
    ORDER BY p.IdProduct DESC
    LIMIT 3");

}
function chiTietSanPham_Add_To_Cart($idProduct,$idAccount,$idSize,$quantityProduct,$priceProduct){
    $sql = "";
    $sqlCheckProductInCart = query_All("select QuantityCard from cart where IdProduct = '$idProduct' and IdAccount = '$idAccount' and NameSize = '$idSize'" );
    if(empty($sqlCheckProductInCart)){
        $sql = "INSERT INTO cart(IdProduct,IdAccount,NameSize,QuantityCard,PriceCard) VALUES ('$idProduct','$idAccount','$idSize','$quantityProduct','$priceProduct')";
    }else{
        $totailQuantity = (int)$sqlCheckProductInCart[0]["QuantityCard"] + (int)$quantityProduct;
        $sql = "update cart set QuantityCard = '$totailQuantity' where IdProduct = '$idProduct' and IdAccount = '$idAccount' ";
    }
    pdo_Execute($sql);
    return "Sản phẩm đã được thêm vào giỏ hàng";
}
/**
 * ====================================================================================
 *                                LOGIN NHANH _ LUỒNG OFF
 * ====================================================================================
 */

function loginNhanh_Check_Order_Pro($idAccount, $idProduct, $SizeProduct)
{
    $sql = "SELECT order_pro.* 
            FROM order_pro 
            INNER JOIN orders ON orders.IdOrder = order_pro.IdOrder
            WHERE IdAccount ='$idAccount' 
                AND IdProduct = '$idProduct'
                AND NameSize = '$SizeProduct'
                AND orders.StatusOrders = 0
          ";
    return query_One($sql);
}

/**
 * Dành cho Đặt trực tiếp tại quán
 * update lại số lượng, giá, tên size khi sản phẩm đã có trong giỏ hàng
 *    => ví dụ người dùng mua có và giờ người dùng tiếp tục mua cá 
 * check qua 2 trường IdAccount và IdProduct. ko cần check time vì khi thanh toán xong thì giỏ hàng sẽ bị xóa
 * 
 */
function loginNhanh_Cart_Update_Price_The_SameAs($IdOrder_Pro, $SizeProduct, $Quantity, $PriceProduct)
{
    $sql = "SELECT * FROM order_pro WHERE IdOrder_Pro = $IdOrder_Pro";
    $arrOneOrderPro = query_One($sql);
    $New_Quantity = $arrOneOrderPro['QuantityOrderPro'] + $Quantity;

    $sql = "UPDATE order_pro SET QuantityOrderPro = '$New_Quantity' WHERE IdOrder_Pro = $IdOrder_Pro";
    return pdo_Execute($sql);
}

function loginNhanh_Add_To_Order($idAccount)
{
    $sql = " SELECT * FROM cart WHERE IdAccount = '$idAccount'";
    $arrOrder_IdAccount = query_All($sql);

    $orderPrice = 0;
    foreach ($arrOrder_IdAccount as $i) {
        $orderPrice += $i['PriceCard'];
    }

    $sql = "INSERT INTO orders(PriceOrders) VALUE ($orderPrice) ";
    return pdo_Execute($sql);
}

function loginNhanh_Update_Order($idAccount)
{
    $sql = " SELECT * FROM cart WHERE IdAccount = '$idAccount'";
    $arrOrder_IdAccount = query_All($sql);

    $orderPrice = 0;
    foreach ($arrOrder_IdAccount as $i) {
        $orderPrice += $i['PriceCard'];
    }

    $sql = "UPDATE orders SET PriceOrders = '$orderPrice' WHERE IdAccount = $idAccount ";
    return pdo_Execute($sql);
}

function loginNhanh_Check_Order($idAccount)
{
    $sql = " SELECT * FROM orders WHERE IdAccount = '$idAccount'";
    return query_One($sql);
}

function loginNhanh_DangXacNhan_Account($idAccount){
    $sql = "SELECT * FROM orders WHERE IdAccount ='$idAccount' AND StatusOrders=5";
    return query_One($sql);
}

function loginNhanh_Check_SoLuong($id){
    $sql = "SELECT * FROM product  WHERE IdProduct = $id";
    return query_One($sql);
}

function loginNhanh_TruSoLuong_Pro($IdProduct){
    $sql = "UPDATE product SET QuantityProduct = QuantityProduct-1 WHERE IdProduct=$IdProduct ";
    return pdo_Execute($sql);

}
/**
 * Lấy toàn bộ comment 
*/
function chiTietSanPham__GetComment($IdProduct)
{
    $sql = "select c.Content, ac.ImageAccounts, ac.NameAccount, ac.Role from comment c
    join account ac on c.IdAccount = ac.IdAccount where StatusComment = 0 and IdProduct = '$IdProduct'";
    return query_All($sql);
}