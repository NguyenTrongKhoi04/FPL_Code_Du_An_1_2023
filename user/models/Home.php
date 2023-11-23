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
            $_SESSION['bookingTable'] = [
                "idAccount" => $idAccount,
                "data" => $data
            ];
        } else {
            $message = validateAll("dateBooking", "$Date");
        }
    }else{
        $message = "Vui lòng đăng nhập để sử dụng dịch vụ";
    }
    return $message;
}

function home_GetComment()
{
    $sql = "select c.Content, ac.ImageAccounts, ac.NameAccount, ac.Role from comment c
    join account ac on c.IdAccount = ac.IdAccount where StatusComment = 0";
    return query_All($sql);
}
