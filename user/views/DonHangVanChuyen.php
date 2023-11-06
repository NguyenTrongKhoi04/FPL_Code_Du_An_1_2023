<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<link rel="stylesheet" href="../../assets/css/user/DonHangVanChuyen.css">
<div class="DonHangVanChuyen">
    <h1>Thanh Toán Đơn Hàng</h1>
    <div class="donhang">
        <h2>Hóa đơn của bạn</h2>
        <table class="bang_so_luong" border="1">
            <tr>
                <th>PRODUCT</th>
                <th>QUANTITY</th>
                <th>PRICE</th>
            </tr>
            <?php for($i=0;$i<100;$i++) :?>
                <tr>
                    <td>Quần</td>
                    <td>Quần</td>
                    <td>Quần</td>
                </tr>
            <?php endfor ?>
        </table>
    </div>
    <div class="tinhtien">
    <table >
            <tr>
                <th class="total_th_left">Total</th>
                <th class="total_th_right">25$</th>
            </tr>
            <?php for($i=0;$i<5;$i++) :?>
                <tr>
                    <td >thong tin khách hàng</td>
                    <td class="total">NGuyễn trọng khoi</td>
                </tr>
            <?php endfor ?>
        </table>
    </div>
</div>
</body>
</html>