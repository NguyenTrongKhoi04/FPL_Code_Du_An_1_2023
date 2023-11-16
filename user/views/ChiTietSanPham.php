    <div class="ChiTietSanPham">
        <link rel="stylesheet" href="../assets/css/user/ChiTietSanPham.css">
        <div class="ProductDetail">
            <div class="img"><img src="<?= $img_Path?><?=$pro['ImageProducts']?>" alt=""></div>
            <div class="form">
                <form action="" method="POST">
                    <h2>Hambegur bò bít tết</h2>
                    <div class="hr"></div>
                    <ul>
                            <!-- <del>40.000</del> -->
                        <li>Giá:<span><?= $pro['PriceProducts']?> VNĐ</span></li>
                        <li><?= $pro['ProductDetails']?></li>
                        <li><?= $pro['ProductDescription']?></li>
                    </ul>
                    <div class="soluong">
                        <div class="tanggiam">
                            <p>Số lượng mua&nbsp;&nbsp;</p>
                            <button type="button" id="increase">+</button>
                            <input type="number" value="1" id="quantity" value="0" min="1" max="10">
                            <button type="button" id="decrease">-</button>     
                        </div>
                        <span><?= $pro['PriceProducts']?>VNĐ</span>
                    </div>
                    <button name="">THÊM VÀO GIỎ HÀNG</button>
                    <button name="">THANH TOÁN LUÔN</button>
                </form>
            </div>
        </div>
        <div class="list">
            <?php for($i=0;$i<10;$i++) :?>
            <div class="pro">
                <div class="img">
                    <img src="<?= $img_Path?>Rectangle 33.png" alt="">
                </div>
                <p>Hambegur Thập cẩmdsdsadsadsdsadsa</p>
            </div>
            <?php endfor?>
        </div>
        <div class="top">
            <h2>TOP MUA NHIỀU NHẤT</h2>
            <div class="list_item">
                <?php for($i=0;$i<3;$i++) : ?>
                <div class="item">
                    <img src="<?= $img_Path?>Rectangle 33.png" alt="">
                    <p>Combo fast food 66k</p>
                    <h3>100.000 Sẩn phẩm đã bán</h3>
                </div>
                <?php endfor ?>
            </div>
        </div>
        <div class="comment">
            <div class="list_comment">
                <?php for ($i = 0; $i < 10; $i++) : ?>
                    <div class="content" style="display: <?= $i === 0 ? 'flex' : 'none'; ?>">
                        <div class="img">
                            <img src="<?= $img_Path?>Rectangle 33.png" alt="">
                            </div>
                        <?= $i ?>
                        <p>dfasfdafdsafsafdsfsdafsafdsafsadfsdafsdfsdafdsafdsfdsfsadfsdfdsfdsfdsffs</p>
                    </div>
                <?php endfor ?>
            </div>
            <div class="tang_giam">
                <button name="tang"><</button>
                <div class="position-display"><?= $totalContents ?> / <?= $totalContents ?></div>
                <button name="giam">></button>
            </div>
        </div>
    </div>
    <script src="../assets/js/ChiTietSanPham.js"></script>
