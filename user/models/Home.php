<?php
include_once "../app/Pdo.php";

function home_GetAllProduct() {
    $sql = "select p.*, d.* from product p
    join details d on p.IdDetails = d.IdDetails
    where StatusProducts = 0";
    
   return query_All($sql);
}

function home_GetAllTable() {
    $sql = "select * from  tables where StatusTables != 0 and StatusTables = 1 ";
    return query_All($sql);
}

function home_BookingTable($data){
    extract($data);
    // kiểm tra dữ liệu người dùng nhập số số lượng người ngồi trên bàn có hợp lệ hay không.
    $dataById = query_One("select NumberPeopleDefaultInTables from tables where IdTable = $IdTable")["NumberPeopleDefaultInTables"];
    if($NumberPeopleInTables >= $dataById ){
        $sql = "update tables set  NumberPeopleInTables = $NumberPeopleInTables, Date = '$Date', StatusTables = 3 where IdTable = $IdTable";
        pdo_Execute($sql);
        
        return "Đã đặt bàn thành công";
    }else{
        return "Đã vượt quá số lượng người trên bàn đã chọn";
    }

}
?>