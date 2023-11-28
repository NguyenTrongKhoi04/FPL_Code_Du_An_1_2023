<link rel="stylesheet" href="../assets/css/user/BillPayment.css">
<section class="page">
        <main>
            <aside class="aside">
                <section class="headerAside">
                    <article class="img">
                        <img src="<?= $img_Path?>Image.png" alt="">
                    </article>
                    <article class="content">
                        <h1>Nguyễn Trọng Khôi</h1>
                    </article>
                </section>
                <section class="mainAside">
                    <ul>
                        <li>  Tổng tiền: 10$ </li>
                        <li> <a href="">Bình luận sản phẩm</a> <i class="ti-angle-down"></i> </li>
                        <li> <a href="">Sản phẩm đã bình luận</a> <i class="ti-angle-down"></i> </li>
                        <li>  Tổng số lượng sản phẩm đã sử dụng: 10 </li>
                    </ul>
                </section>
            </aside>
            <section class="containerMain">
                <section class="headerMain">
                    <section class="titleMain">
                        <h1>Viết đánh giá</h1>
                    </section>
                </section>
                <section class="contentMain">
                    <table>
                        <tr>
                            <th>Tên sản phẩm</th>
                            <th>Tên sản phẩm</th>
                            <th>Giá</th>
                            <th>Thanh toán</th>
                            <th>Bàn</th>
                            <th>Loại order</th>
                        </tr>
                        <?php for($i=0;$i<5;$i++) : ?>
                        <tr>
                            <td>Nguyễn Trọng Khôi</td>
                            <td>Chickend</td>
                            <td>245$</td>
                            <td>Bank pay</td>
                            <td>16</td>
                            <td>Online</td>
                        </tr>
                        <?php endfor ?>
                       
                    </table>
                </section>
            </section>
        </main>
  
    </section>