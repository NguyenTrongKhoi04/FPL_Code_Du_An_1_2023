<link rel="stylesheet" href="../assets/css/user/Cart.css">
<form action="" method="post" class="page">
    <main>
        <section class="containerMain">
            <section class="listProduct">
                <section class="selectAllProducts">
                    <input type="checkbox" name="" id="checkAll">
                    <h5>Chọn tất cả (3 sản phẩm)</h5>
                    <i class="ti-trash"></i>
                </section>
                <table>
                    <tr>
                        <th></th>
                        <th>Ảnh sản phẩm</th>
                        <th>Tên sản phẩm</th>
                        <th>Kích cỡ</th>
                        <th>Giá</th>
                        <th>Số lượng </th>
                        <th>Chức năng</th>
                    </tr>
                    <tr>
                        <td><input required type="checkbox" name="selected" id=""></td>
                        <td><img src="../assets/img/admin/anhdoi.jpg" alt="img"></td>
                        <td>Thị bò mỹ cao cấp</td>
                        <td>1 người</td>
                        <td>150$</td>
                        <td><input type="number" name="quantity" id="" min=1 max=10 value="1"></td>

                        <td> <i class="ti-trash"></i> </td>
                    </tr>
                </table>
            </section>
        </section>

        <aside>
            <section class="mainAside">
                <h1>Thông tin đơn hàng</h1>
                <ul>
                    <li>Tổng tiền 3 sản phẩm: 105$</li>
                    <li>Phí dịch vụ: 1%</li>
                    <li>Thuế VAT: 10%</li>
                </ul>
            </section>
            <section class="footerAside">
                <h1>Tổng cộng: 1001$</h1>
                <button type="submit">Thanh Toán</button>
            </section>
        </aside>
    </main>
    </section>
    <script src="../assets/js/Cart.js"></script>