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

function home_GetNewTwoProduct(){
    return query_All("SELECT p.IdProduct, p.NameProduct, p.ImageProduct, d.*
    FROM product p
    JOIN details d ON p.IdDetails = d.IdDetails
    WHERE p.StatusProduct = 0
    ORDER BY p.IdProduct DESC
    LIMIT 2");
}

/**
 * lấy tất cả bàn
 */
function home_GetAllTable()
{
    $Tables = query_All("select * from  tables where  StatusTable = 0");
    $TableMax = query_One("select max(DefaultNumberPeople) from tables");
    $returnDataTables = [
        "Tables" => $Tables,
        "TableMax" => $TableMax
    ];
    return $returnDataTables;
}

/**
 * đặt bàn onlien chỉ hoạt động khi khách hàng đăng nhập
 * $data: Dữ liệu nhận về từ khách hàng
 */
function home_BookingTable($data)
{
    extract($data);
    $message = "";
    // kiểm tra xem lượng người khách đi có trong giới hạn của bàn hay không
    $checkPeopleDefalut = query_One("select DefaultNumberPeople from tables where IdTables = $IdTable");
    if($NumberPeopleInTables <=  $checkPeopleDefalut) {
        if(isset($_SESSION['user']["IdAccount"]) && !empty($_SESSION['user']["IdAccount"])){
            $idAccount = $_SESSION['user']["IdAccount"];
            if (validateAll("dateBooking", "$Date") === true) {
                $message = "Đặt bàn thành công";
                $time = new DateTime();
                $time->setTimezone(new DateTimeZone("Asia/Ho_Chi_Minh"));
                $realTime = $time->format('Y-m-d\TH:i');
                // kiểm tra xem người dùng đã order hay chưa, nếu đã đặt bàn rồi thì không cho đặt
                $dataReallyExists = query_All("select * from orders where IdAccount = '$idAccount' and ( StatusOrders = 4 or StatusOrders = 3 )");
                if(empty($dataReallyExists)){
                    $sqlOrder = "insert into orders values(null, '$IdTable', '$idAccount',0, null, '$NumberPeopleInTables',4,'$realTime')";
                    $IdOrder = pdo_Execute_Return_LastinsertID($sqlOrder);
                    $sqlOrderPro = "insert into order_pro values(null, '$IdOrder',null ,null ,null, 0)";
                    pdo_Execute($sqlOrderPro);
                    $message = "Đã đặt bàn thành công";
                }else{
                    $message = "Bàn đã được đặt vui lòng chọn khung giờ hoặc bàn khác...";
                }   
            } else {
                $message = validateAll("dateBooking", "$Date");
            }
        }else{
            $message = "Vui lòng đăng nhập để sử dụng dịch vụ";
        }
    }else{
        $message = "Vui lòng chọn bàn lớn hơn";
    }
    return $message;
}


/**
 * Hàm có tác dụng kiểm tra  và order bàn tự động
 * 
 */
function home_checkAndOrderAuto()
{
    // Tiến hành kiểm tra xem ngày tháng người dùng đã order bàn
    $time = new DateTime();
    $time->setTimezone(new DateTimeZone("Asia/Ho_Chi_Minh"));
    $realTime = $time->format('Y-m-d\TH:i');

    $dataCheckBooking = query_All('select * from orders where StatusOrders = 3');

    foreach($dataCheckBooking as $valuesCheck){
        $dataTimesBefore = (int)$valuesCheck["OrderDate"] + 3600;
        if($dataTimesBefore === $realTime){
                $sqlOrder = "update orders set StatusOrders = 0 where IdOrder = {$valuesCheck['IdOrder']}"; 
                $sqlTables = "update tables set StatusTable = 2 where IdTables = {$valuesCheck['IdTable']}"; 
                pdo_Execute($sqlTables);
                pdo_Execute($sqlOrder);
        }
    }

}