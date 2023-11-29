<link rel="stylesheet" href="../assets/css/user/BillPayment.css">
<section class="page">
        <main>
            <aside class="aside">
                <section class="headerAside">
                    <article class="img">
                        <img src="<?= $img_Path;$_SESSION['user']["ImageAccounts"] ?>Image.png" alt="">
                    </article>
                    <article class="content">
                        <h1><?= $_SESSION['user']["NameAccount"] ?></h1>
                    </article>
                </section>
                <section class="mainAside">
                    <?php 
                    $totailPrice = 0;
                    foreach ($listOrderPayMent as $key =>  $valueListOrderPayMent) {
                        $totailPrice += (int)$valueListOrderPayMent['PriceOrders'];
                    }
                    ?>
                    <ul>
                        <li>  Tổng tiền: <?= $totailPrice ?> VND </li>
                        <li> <a href="">Bình luận sản phẩm</a> <i class="ti-angle-down"></i> </li>
                        <li> <a href="">Sản phẩm đã bình luận</a> <i class="ti-angle-down"></i> </li>
                        <li>  Tổng số lượng sản phẩm đã sử dụng: <?= count($listOrderPayMent) ?> </li>
                    </ul>
                </section>
            </aside>
            <section class="containerMain">
                <section class="headerMain">
                    <section class="titleMain">
                        <h1>LỊCH SỬ  THANH TOÁN</h1>
                    </section>
                    
                </section>
                <section class="contentMain">
                    <table>
                        <tr>
                            <th>Tên khách hàng</th>
                            <th>Tên sản phẩm</th>
                            <th>Giá</th>
                            <th>Thanh toán</th>
                            <th>Bàn</th>
                            <th>Loại order</th>
                            <th>Thời gian</th>
                        </tr>
                        <?php 
                        foreach ($listOrderPayMent as  $valueListOrderPayMent) {
                            $PayMentMethod = $valueListOrderPayMent['PaymentMethod'] === 2 ? "Online" : "Trực tiếp";
                            echo "
                                <tr>
                                    <td>{$valueListOrderPayMent['NameAccount']}</td>
                                    <td>{$valueListOrderPayMent['NameProduct']}</td>
                                    <td>{$valueListOrderPayMent['PriceProduct']} VND</td>
                                    <td>{$PayMentMethod}</td>
                                    <td>{$valueListOrderPayMent['NumberTable']}</td>
                                    <td>{$PayMentMethod}</td>
                                    <td>{$valueListOrderPayMent['OrderDate']}</td>
                                </tr>                            
                            ";
                        } ?>
               
                       
                    </table>
                </section>
            </section>
        </main>
  
    </section>