<link rel="stylesheet" href="../assets/css/user/BillPayment.css">
<section class="page">
        <main>
            <aside class="aside">
                <section class="headerAside">
                    <article class="img">
                        <img src="<?= $img_path?>Image.png" alt="">
                    </article>
                    <article class="content">
                        <h1>Nguyễn Trọng Khôi</h1>
                    </article>
                </section>
                <section class="mainAside">
                    <ul>
                        <li>  Tổng số lượng sản phẩm đã sử dụng: 10 </li>
                        <li> Tổng số lượng sản phẩm thanh toán tiền mặt: 10 </li>
                        <li>  Tổng số lượng sản phẩm thanh toán chuyển khoản: 10 </li>
                        <li>  Tổng số lượng bàn đã sử dụng: 10 </li>
                        <li>  Tổng tiền: 10$ </li>
                    </ul>
                </section>
            </aside>
            <section class="containerMain">
                <section class="headerMain">
                    <section class="titleMain">
                        <h1>LỊCH SỬ  THANH TOÁN</h1>
                    </section>
                    
                    <form method="post"  action="" class="search">
                        <input type="text">
                        <i class="ti-search"></i>
                    </form>
                </section>
                <section class="contentMain">
                    <table>
                        <?php for($i=0;$i<10;$i++) :?>
                        <tr>
                            <th>Tên khách hàng</th>
                            <th>Tên sản phẩm</th>
                            <th>Giá</th>
                            <th>Thanh toán</th>
                            <th>Bàn</th>
                            <th>Loại order</th>
                        </tr>
                        <?php endfor ?>
                    </table>
                </section>
            </section>
        </main>
  
    </section>