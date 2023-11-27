<link rel="stylesheet" href="<?=$userStyle?>/CashViSa.css">
<form action="" method="post" class="page">
    <section class="containerVisa">
        <section class="contentVisa">
            <article class="logo">
                <article class="title">
                    <h1>Vui lòng nhập mã số thẻ</h1>
                </article>
                <article class="img">
                    <img src="../assets/img/html/LogoMastercard.png" alt="LogoMastercard">
                    <img src="../assets/img/html/LogoViSa.png" alt="LogoViSa">
                </article>
            </article>
            <section class="itemVisa">
                <article class="titleItemVisa">
                    <h3>Số thẻ</h3>
                    <p>Vui lòng nhập 16 ký tự trên thẻ của bạn</p>
                </article>
                <article class="contentTitleItemVisa">
                    <input type="number" name="CardNumber">
                </article>
            </section>
            <section class="itemVisa">
                <article class="titleItemVisa">
                    <h3>Chủ thẻ</h3>
                    <p>Vui lòng nhập tên chủ thẻ</p>
                </article>
                <article class="contentTitleItemVisa">
                    <input type="text" name="CardName">
                </article>
            </section>
            <section class="itemVisa">
                <article class="titleItemVisa">
                    <h3>Ngày hết hạn</h3>
                    <p>Vui lòng nhập ngày hết hạn của thẻ</p>
                </article>
                <article class="contentTitleItemVisas">
                    <input type="number" name="CardDateMonth">
                    <p>/</p>
                    <input type="number" name="CardDateYear" value="23">
                </article>
            </section>
        <input type="submit" value="Thanh toán">
        </section>
    </section>
    <section class="bill">
        <section class="containerBill">
            <article class="headerBill">
                <h1>Danh sách mua sắm</h1>
            </article>
            <section class="contentBill">
                <table>
                    <tr>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                    </tr>
                    <?php 
                    if(isset($listOrderUser) && !empty($listOrderUser)){
                        foreach($listOrderUser as $dataListOrderUser){
                            echo "
                            <tr>
                                <td>
                                    <img src='../assets/img/admin/{$dataListOrderUser['ImageProduct']}' alt=''>    
                                    {$dataListOrderUser['NameProduct']}
                                </td>
                                <td>{$dataListOrderUser['Quantity']}</td>
                                <td>{$dataListOrderUser['PriceProduct']}VND</td>
                            </tr>
                            
                            ";
                        }

                    }else{
                        echo "<h1>Không có sản phẩm nào</h1>";
                    }
                    ?>
                </table>
            </section>
            <article class="footerBill">
                <?php 
                    if(isset($listOrderUser) && !empty($listOrderUser)){
                ?>
                <article class="itemFooterBill">
                    <h3>Phí dịch vụ 1%: </h3>
                    <h1><?= cart_Totail($listOrderUser)['ServiceCharge'] ?>VND</h1>
                </article>
                <article class="itemFooterBill">
                    <h3>VAT 10%: </h3>
                    <h1><?= cart_Totail($listOrderUser)['vat'] ?>VND</h1>
                </article>
                <article class="itemFooterBill">
                    <h3>Tổng: </h3>
                    <h1><?= cart_Totail($listOrderUser)['totail'] ?>VND</h1>
                </article>
            <?php }else{
                echo "<h1>Không có sản phẩm nào</h1>";
            } ?>
            </article>
        </section>
    </section>
</form>