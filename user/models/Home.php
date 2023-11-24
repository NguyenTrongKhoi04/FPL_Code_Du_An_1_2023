<?php
include_once "../app/Pdo.php";
/**
 * lấy tất cả dữ liệu sản phẩm
 */
function home_GetAllProduct()
{
    $sql = "select p.*, d.* from product p
    join details d on p.IdDetails = d.IdDetails
    where p.StatusProduct = 0";

    return query_All($sql);
}
/**
 * lấy tất cả bàn
 */
function home_GetAllTable()
{
    $sql = "select * from  tables where StatusTable != 0 and StatusTable = 1 ";
    return query_All($sql);
}
/**
 * đặt bàn onlien chỉ hoạt động khi khách hàng đăng nhập
 * $data: Dữ liệu nhận về từ khách hàng
 */
function home_BookingTable($data)
{
    extract($data);
    $message = "";
    if(isset($_SESSION['user']["IdAccount"]) && !empty($_SESSION['user']["IdAccount"])){
        $idAccount = $_SESSION['user']["IdAccount"];
        if (validateAll("dateBooking", "$Date") === true) {
            $message = "Đặt bàn thành công";
            $time = new DateTime();
            $time->setTimezone(new DateTimeZone("Asia/Ho_Chi_Minh"));
            $realTime = $time->format('Y-m-d\TH:i');
            // kiểm tra xem người dùng đã order hay chưa, nếu đã đặt bàn rồi thì không cho đặt
            $dataReallyExists = query_All("select * from waitingorder where IdAccount = '$idAccount' and 	StatusWaitingOrder = 0");
            if(empty($dataReallyExists)){
                $sqlOrder = "insert into waitingorder values(null, '$IdTable', '$idAccount', null, '$NumberPeopleInTables','$realTime', 0)";
                pdo_Execute($sqlOrder);
            }else{
                $message = "Bạn đã đặt bàn...";
            }   
        } else {
            $message = validateAll("dateBooking", "$Date");
        }
    }else{
        $message = "Vui lòng đăng nhập để sử dụng dịch vụ";
    }
    return $message;
}

/**
 * Lấy toàn bộ comment 
*/
function home_GetComment()
{
    $sql = "select c.Content, ac.ImageAccounts, ac.NameAccount, ac.Role from comment c
    join account ac on c.IdAccount = ac.IdAccount where StatusComment = 0";
    return query_All($sql);
}

/**
 * Hàm có tác dụng kiểm tra tình và order bàn 
 * 
 */
function home_checkOrderTable(){
    // Tiến hành kiểm tra xem ngày tháng người dùng đã order bàn
    $time = new DateTime();
    $time->setTimezone(new DateTimeZone("Asia/Ho_Chi_Minh"));
    $realTime = $time->format('Y-m-d\TH:i');

    $dataCheckBooking = query_All('select * from waitingorder where StatusWaitingOrder = 0');

    foreach($dataCheckBooking as $valuesCheck){
        $dataTimesBefore = (int)$valuesCheck["OrderDateWaitingOrder"] + 3600;
        if($dataTimesBefore === $realTime){
                $sqlOrder = "insert into orders values(null, '{$valuesCheck["IdTable"]}', '{$valuesCheck["IdAccount"]}', null, 0, '{$valuesCheck["OrderDateWaitingOrder"]}')";

                $sqlTable = "update tables set StatusTable = 1, NumberPeople = '{$valuesCheck["QuantityWaitingOrder"]}' where IdTables = {$valuesCheck["IdTable"]}"; 
                pdo_Execute($sqlTable);
                pdo_Execute($sqlOrder);
        }
    }

}