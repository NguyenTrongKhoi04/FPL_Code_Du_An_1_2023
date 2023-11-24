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