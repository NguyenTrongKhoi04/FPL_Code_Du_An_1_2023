
<section class="page">
<link rel="stylesheet" href="../assets/css/user/ProductDetails.css">
    <section class="banner">
        <img src="<?= $img_Path?>banner.png" alt="banner">
    </section>
    <main>
        <nav class="nav">
            <select name="price" id="">
                <option value="">Giá</option>
                <option value="30">10$ - 30$</option>
                <option value="60">30$ - 60$</option>
                <option value="100">60$ - 100$</option>
                <option value="1000">150$ - 1000$</option>
            </select>
            <select name="product" id="">
                <option value="">Sản phẩm</option>
                <option value="top10">Top 10 sản phẩm bán chạy nhất</option>
                <option value="Bò mỹ nướng">Bò mỹ nướng</option>
                <option value="Thị gà hầm">Thị gà hầm</option>
            </select>
        </nav>

        <section class="lisstProduct">
            <?php for($i=0;$i<10;$i++) :?>
            <section class="product">
                <article class="img">
                    <img src="<?= $img_Path?>Image2.png" alt="Image">
                </article>
                <article class="title">
                    <h1>Bít tết với kim chi nướng</h1>
                </article>
                <article class="description">
                    <p>Thị bò được nhập khẩu từ mĩ. Với các cô bò hành phúc, đem lại trải nhiệm tuyệt vời</p>
                </article>
                <article class="price">
                    <h1>145$</h1>
                </article>
                <article class="AddToCart">
                    <button>Thêm vào giỏ hàng</button>
                </article>
            </section>
            <?php endfor ?>
        </section>

        <section class="navigationBar">
            <section class="contentNavigationBar">
                <i class="ti-arrow-left"></i>
                <button>1</button>
                <button>2</button>
                <button>3</button>
                <i class="ti-arrow-right"></i>
            </section>
        </section>
    </main>
</section>