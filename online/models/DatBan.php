<?php 

/**
 * Trả về 1 mảng gồm các ID của bàn có người ngồi
 */
function datBan_ListTables(){
    $listTables = query_All("SELECT * FROM tables where StatusTable = 0");
    $maxDefaulTables = query_One("select max(DefaultNumberPeople) from tables")["max(DefaultNumberPeople)"];
    
    $arrFull =[
        "listTables" => $listTables,
        "maxDefaulTables" => $maxDefaulTables
    ]; 
    return $arrFull;
}

/**
 * Hàm có tác dụng kiểm thời gian và chuyển dữ liệu sang thanh toán 
 * data: du lieu tu nguoi dung
 */
function datBan_CheckBookingTables($data)
{
    extract($data);
    $message = "";
    if(validateAll(null, "$contentTable") === true){
        $checkDefaultTables = query_One("select DefaultNumberPeople from tables where IdTables = '$contentTable'");
        if($NumberInPeople <= $checkDefaultTables["DefaultNumberPeople"]){
            if(validateAll("dateBooking", "$timeBooking") === true){
                // kiểm tra nếu trước 2h bàn trên database thì k được đặt bàn 
                $checkDate = date('Y-m-d\TH:i', (strtotime($timeBooking)-7200));
    
                $sqlCheckOrder = "select count(*) from orders where IdTable = '$contentTable' and (OrderDate = '$timeBooking' or OrderDate = '$checkDate')";
         
    
                if(query_All($sqlCheckOrder)[0]["count(*)"] == 0){
    
                    if(isset($_SESSION['dataOrderCart']) || isset($_SESSION['payNowDetails']) ){
                        $_SESSION['dataOrderTables'] = [
                            "IdTable" => $contentTable,
                            "TimeOrder" => $timeBooking,
                            "NumberInPeople" => $NumberInPeople
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
            $message = "Vui lòng chọn bàn lớn hơn";
        }

    }else{
        $message = validateAll(null, "$contentTable");
    }

    return $message;
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
function list_BanCoNguoiNgoi(){
    $sql = "SELECT * FROM tables WHERE StatusTable =1";
    $arrFull =query_All($sql); 

    $arrFull_Id = [];
    foreach($arrFull as $i){
        array_push($arrFull_Id,$i['IdTables']); 
    }
    return $arrFull_Id;
}