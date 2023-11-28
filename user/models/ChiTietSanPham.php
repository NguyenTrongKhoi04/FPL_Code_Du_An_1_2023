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

function chiTietSanPham_Add_To_Order_Pro($idAccount,$IdProduct,$NameSize,$quantityProduct,$priceProduct){
    $sql = "SELECT * FROM orders WHERE IdAccount = '$idAccount' AND StatusOrders =0";
    $oneOrder = query_One($sql);
    $oneOrder_IdOrder = $oneOrder['IdOrder'];
    $sql = "INSERT INTO order_pro(IdOrder,IdProduct,NameSize,QuantityOrderPro) VALUES ('$oneOrder_IdOrder','$IdProduct','$NameSize','$quantityProduct')";
    return pdo_Execute($sql);
}

function chiTietSanPham_LoadDetails($id){
    $sql ="SELECT * FROM details WHERE IdDetails = $id";
    return query_One($sql);
}





function loginNhanh_Check_Order_Pro($idAccount,$idProduct,$SizeProduct){
    $sql="SELECT order_pro.* 
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
function loginNhanh_Cart_Update_Price_The_SameAs($IdOrder_Pro,$SizeProduct,$Quantity,$PriceProduct){
    $sql = "SELECT * FROM order_pro WHERE IdOrder_Pro = $IdOrder_Pro";
    $arrOneOrderPro = query_One($sql);
    $New_Quantity = $arrOneOrderPro['QuantityOrderPro'] + $Quantity ;
    
    $sql = "UPDATE order_pro SET QuantityOrderPro = '$New_Quantity' WHERE IdOrder_Pro = $IdOrder_Pro";
    return pdo_Execute($sql);
}

function loginNhanh_Add_To_Order($idAccount){
    $sql = " SELECT * FROM cart WHERE IdAccount = '$idAccount'";
    $arrOrder_IdAccount = query_All($sql) ;

    $orderPrice = 0;
    foreach($arrOrder_IdAccount as $i){
        $orderPrice += $i['PriceCard'];
    }

    $sql = "INSERT INTO orders(PriceOrders) VALUE ($orderPrice) ";
    return pdo_Execute($sql);
}

function loginNhanh_Update_Order($idAccount){
    $sql = " SELECT * FROM cart WHERE IdAccount = '$idAccount'";
    $arrOrder_IdAccount = query_All($sql) ;

    $orderPrice = 0;
    foreach($arrOrder_IdAccount as $i){
        $orderPrice += $i['PriceCard'];
    }

    $sql = "UPDATE orders SET PriceOrders = '$orderPrice' WHERE IdAccount = $idAccount ";
    return pdo_Execute($sql);
}

function loginNhanh_Check_Order($idAccount){
    $sql = " SELECT * FROM orders WHERE IdAccount = '$idAccount'";
    return query_One($sql);
}


