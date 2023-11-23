<section class="page">
    <link rel="stylesheet" href="../assets/css/user/ProductPortfolio.css">
    <section class="banner">
        <img src="<?= $img_Path ?>banner.png" alt="banner">
    </section>
    <main>
        <form action="?act=DanhMucSanPham&idCategory=<?= $_GET['idCategory'] ?>" method="post" class="nav">
            <select name="price" id="priceSelect" onchange="this.form.submit()">
                <option value="">Giá</option>
                <option value="10-30">10$ - 30$</option>
                <option value="30-60">30$ - 60$</option>
                <option value="60-100">60$ - 100$</option>
                <option value="150-1000">150$ - 1000$</option>
            </select>
            <select name="product" id="priceSelect" onchange="this.form.submit()">
                <option value="">Sản phẩm</option>

                <?php
                if (!empty(productPortfolio_GetAllCateogry())) {
                    foreach (productPortfolio_GetAllCateogry() as $itemGetAllCateogry) {
                        echo "<option value='{$itemGetAllCateogry['IdCategory']}'>{$itemGetAllCateogry['NameCategory']}</option>";
                    }
                } else {
                    echo "<option value=''>Không có danh mục</option>";
                }
                ?>
            </select>
        </form>

        <section class="lisstProduct">
            <?php
            if (isset($GetAllProductAsRequested) && !empty($GetAllProductAsRequested)) {
                foreach ($GetAllProductAsRequested as $itemProductAsRequested) {
                    echo "
                    <section class='product'>
                        <article class='img'>
                            <img src=' $imgPathAdmin{$itemProductAsRequested['ImageProduct']}' alt='Image'>
                        </article>
                        <article class='title'>
                            <h1>{$itemProductAsRequested['NameProduct']}</h1>
                        </article>
                        <article class='description'>
                            <p>{$itemProductAsRequested['ProductDetails']}</p>
                        </article>
                        <article class='price'>
                            <h1>{$itemProductAsRequested['PriceProduct']}$</h1>
                        </article>
                        <article class='AddToCart'>
                            <button>
                                <a href= '?act=ChiTietSanPham&id={$itemProductAsRequested['IdProduct']}'>Xem chi tiết sản</a>
                            </button>
                        </article>
                    </section>
                    ";
                }
            } else {
                if (empty($dataProductPortfolio)) {
                    echo "<h1 style='color: #FFFFFF; font-size: 40px;'>Không có sản phẩm </h1>";
                } else {
                    foreach ($dataProductPortfolio as $itemProductPortfolio) {
                        echo "
                        <section class='product'>
                            <article class='img'>
                                <img src=' $imgPathAdmin{$itemProductPortfolio['ImageProduct']}' alt='Image'>
                            </article>
                            <article class='title'>
                                <h1>{$itemProductPortfolio['NameProduct']}</h1>
                            </article>
                            <article class='description'>
                                <p>{$itemProductPortfolio['ProductDetails']}</p>
                            </article>
                            <article class='price'>
                                <h1>{$itemProductPortfolio['PriceProduct']}$</h1>
                            </article>
                            <article class='AddToCart'>
                                <button>
                                    <a href= '?act=ChiTietSanPham&id={$itemProductPortfolio['IdProduct']}'>Xem chi tiết sản</a>
                                </button>
                            </article>
                        </section>
                        ";
                    }
                }
            }
            ?>

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