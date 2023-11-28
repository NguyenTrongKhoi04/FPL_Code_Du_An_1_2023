<?php 

/**
 * Trả về 1 mảng gồm các ID của bàn có người ngồi
 */
function datBan_ListTables(){
    $sql = "SELECT * FROM tables where StatusTable != 0";
    $arrFull =query_All($sql); 
    return $arrFull;
}

/**
 * Hàm có tác dụng kiểm thời gian và chuyển dữ liệu sang thanh toán 
 * data: du lieu tu nguoi dung
 */
function datBan_CheckBookingTables($data){
    extract($data);
    $message = "";
    if(validateAll(null, "$contentTable") === true){
        if(validateAll("dateBooking", "$timeBooking") === true){
            // kiểm tra nếu trước 2h bàn trên database thì k được đặt bàn 
            $checkDate = date('Y-m-d\TH:i', (strtotime($timeBooking)-7200));

            $sqlCheckOrder = "select count(*) from orders where IdTable = '$contentTable' and (OrderDate = '$timeBooking' or OrderDate = '$checkDate')";
            $sqlCheckWatingOrder = "select count(*) from orders where IdTable = '$contentTable' and(OrderDate = '$timeBooking' or OrderDate = '$checkDate')";

            if(query_All($sqlCheckOrder)[0]["count(*)"] == 0 && 
                query_All($sqlCheckWatingOrder)[0]["count(*)"] == 0){

                if(isset($_SESSION['dataOrderCart']) || isset($_SESSION['payNowDetails']) ){
                    $_SESSION['dataOrderTables'] = [
                        "IdTable" => $contentTable,
                        "TimeOrder" => $timeBooking
                    ];
                    $message = true;
                }else{
                    $message = "404 Not fout";
                }
            }else{
                $message = "Bàn và thời gian bạn đã chọn hiện tại đã có người đặt vui lòng chọn bàn và khung thời gian khác";
            }
        }else{
            $message = validateAll("dateBooking", "$timeBooking");
        }

    }else{
        $message = validateAll(null, "$contentTable");

    }
    return $message; 
}