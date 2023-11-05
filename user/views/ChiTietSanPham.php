<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <link rel="stylesheet" href="../../assets/css/user/ChiTietSanPham.css">
    <div class="ChiTietSanPham">
        <div class="ProductDetail">
            <div class="img"><img src="../../assets/img/Rectangle 33.png" alt=""></div>
            <div class="form">
                <form>
                    <h2>Hambegur bò bít tết</h2>
                    <div class="hr"></div>
                    <ul>
                        <li>Giá: <del>40.000</del> <span>20.000VNĐ</span></li>
                        <li>Top 10 fast food bán chạy</li>
                        <li>Sản phẩm được khách hàng đánh giá cao</li>
                    </ul>
                    <div class="soluong">
                        <div class="tanggiam">
                            <p>Số lượng mua&nbsp;&nbsp;</p>
                            <button type="button" id="increase">+</button>
                            <input type="number" value="1" id="quantity" value="0" min="1" max="10">
                            <button type="button" id="decrease">-</button>     
                        </div>
                        <span>20.000VNĐ</span>
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
                    <img src="../../assets/img/Rectangle 33.png" alt="">
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
                    <img src="../../assets/img/Rectangle 33.png" alt="">
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
                            <img src="../../assets/img/Rectangle 33.png" alt="">
                        </div>
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
</body>
<script src="../../assets/js/ChiTietSanPham.js"></script>
</html>