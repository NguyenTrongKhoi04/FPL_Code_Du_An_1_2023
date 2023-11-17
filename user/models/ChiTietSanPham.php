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

function top3_SanPham(){
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

    // echo"<pre>";
    // print_r($arr_Top3);
    // echo"</pre>";

    return $arr_Top3;
}