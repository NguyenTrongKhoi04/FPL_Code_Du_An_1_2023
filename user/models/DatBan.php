<?php 

/**
 * Trả về 1 mảng gồm các ID của bàn có người ngồi
 */
function list_BanCoNguoiNgoi(){
    $sql = "SELECT * FROM tables WHERE StatusTable =1";
    $arrFull =query_All($sql); 

    $arrFull_Id = [];
    foreach($arrFull as $i){
        array_push($arrFull_Id,$i['IdTables']); 
    }
    return $arrFull_Id;
}

function loginNhanh_DatBan($Id_Ban,$Id_Account){
    $sql = "INSERT INTO orders(IdTable,IdAccount) VALUE ('$Id_Ban','$Id_Account')";
    var_dump($sql);
    return pdo_Execute($sql);
}

function update_Status_Ban($so_Ban){
    $sql="UPDATE `tables` SET `StatusTable`=1 WHERE `IdTables`= $so_Ban";
    return pdo_Execute($sql);
}