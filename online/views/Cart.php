<link rel="stylesheet" href="<?=$userStyle?>/Cart.css">
<form action="UserController.php?act=GioHang" method="post" class="page" id="formCart" >
    <main>
        <section class="containerMain">
            <section class="listProduct">
                <table>
                    <tr>
                        <th>Ảnh </th>
                        <th>Tên </th>
                        <th>Kích cỡ</th>
                        <th>Giá</th>
                        <th>Số lượng </th>
                        <th>Chức năng</th>
                    </tr>
                    
                    <?php
                    foreach($dataCart as $valuesCart){
                        echo "
                            <tr>
                                <td><img src='$imgPathAdmin{$valuesCart['ImageProduct']}' alt='img'></td>
                                <td>{$valuesCart['NameProduct']}</td>
                                <td>{$valuesCart['NameSize']}</td>
                                <td>{$valuesCart['PriceProduct']}</td>
                                <td><input type='number' name='quantity[{$valuesCart['IdCart']}]'   min=1 max={$valuesCart['QuantityProduct']} value='{$valuesCart['QuantityCard']}'></td>
        
                                <td> <a href='UserController.php?act=GioHang&Delete={$valuesCart['IdCart']}'><i class='ti-trash'></i></a> </td>
                            </tr>
                        ";
                    }
                    ?>
                </table>
            </section>
        </section>
        <aside>
            <section class="mainAside">
                <h1>Thông tin đơn hàng</h1>
                <ul>
                    <li>Tổng tiền <?= cart_Totail($dataCart)["qualityProduct"] ?> sản phẩm: <?= cart_Totail($dataCart)["totailPrice"] ?> VND</li>
                    <li>Phí dịch vụ 1% : <?= cart_Totail($dataCart)["ServiceCharge"] ?>     VND</li>
                    <li>Thuế VAT 10% : <?= cart_Totail($dataCart)["vat"] ?> VND</li>
                </ul>
            </section>
            <section class="footerAside">
                <h1>Tổng cộng: <?= cart_Totail($dataCart)["totail"] ?> VND</h1>
                <button type="submit" name="ThanhToan">Chọn Bàn</button>
            </section>
        </aside>
    </main>
    </section>
    <?php 
    if(isset($alert)){
        echo "<script> alert('$alert') </script>";
    }
    ?>
    <!-- <script src="../assets/js/Cart.js"></script> -->