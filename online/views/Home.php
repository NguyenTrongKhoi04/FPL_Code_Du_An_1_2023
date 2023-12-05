<section class="page">
    <link rel="stylesheet" href="<?= $userStyle ?>Home.css">
    <main>
        <section class="seoProduct">
            <section class="containerItem1">
                <section class="contentItem1">
                    <h1>Ăn uống lành mạnh là quan trọng một phần của lối sống</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Neque congue arcu</p>
                </section>
                <section class="contentItemImg">
                    <img src="<?= $img_Path  ?>Image.png" alt="img">
                    <article class="lisstImg">
                        <img src="<?= $img_Path ?>spices1.png" alt="img">
                        <img src="<?= $img_Path ?>spices2.png" alt="img">
                        <img src="<?= $img_Path ?>spices3.png" alt="img">
                    </article>
                </section>
            </section>
            <section class="containerItem2">
                <section class="product">
                    <img src="<?= $img_Path ?>Image1.png" alt="img">
                    <h1>Bắt đầu lên kế hoạch ăn kiêng ngay hôm nay</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Neque congue arcu</p>
                </section>
                <section class="product">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Neque congue arcu</p>
                    <img src="<?= $img_Path ?>Image2.png" alt="img">
                </section>
            </section>
        </section>
        <section class="myProduct">
            <section class="contentMyProduct">
                <h1>Sản phẩm của chúng tôi</h1>
            </section>
        
            <section class="listProduct">
                <?php if (empty(home_GetAllProduct())) {
                    echo "<h1>Không có sản phẩm </h1>";
                } else {
                    foreach (home_GetAllProduct() as $itemProduct) {
                        // dieu_huong sang chi tiết sản phẩm
                        echo "
                                <a href= 'OnlineController.php?act=LoadChiTietSanPham&id={$itemProduct['IdProduct']}&index=1' class='contentListProduct'>
                                    <article class='image'>
                                    <img src='{$imgPathAdmin}{$itemProduct['ImageProduct']}' alt='img'>
                                    </article>
                                    <article class='title'>
                                        <h1>{$itemProduct['NameProduct']}</h1>
                                    </article>
                                    <article class='description'>
                                        <p>{$itemProduct['ProductDetails']}</p>
                                    </article>
                                    <article class='price'>
                                        <h1>{$itemProduct['PriceProduct']}$</h1>
                                    </article>      
                                </a>                         
                                ";
                    }
                }
                ?>
            </section>

        </section>
        <section class="chef">
            <img src="<?= $img_Path ?>Image4.png" alt="img">
            <img src="<?= $img_Path ?>Leaf1.png" alt="img">
            <img src="<?= $img_Path ?>Leaf.png" alt="img">
            <article class="contentChef">
                <h1>Đầu bếp xuất sắc</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Purus lorem id penatibus imperdiet. Turpis
                    egestas ultricies purus auctor tincidunt lacus nunc. </p>
            </article>

        </section>
        <section class="seoIngredient">
            <section class="Ingredient">
                <img src="<?= $img_Path ?>CircleIcon.png" alt="img">
                <h1>Chất lượng cao</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Neque congue arcu</p>
            </section>
            <section class="Ingredient">
                <img src="<?= $img_Path ?>CircleIcon1.png" alt="img">
                <h1>Rau theo mùa</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Neque congue arcu</p>
            </section>
            <section class="Ingredient">
                <img src="<?= $img_Path ?>CircleIcon2.png" alt="img">
                <h1>Hoa quả tươi</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Neque congue arcu</p>
            </section>

        </section>
        <section class="bestProducts">
            <article class="contentTitileBestProduct">
                <h1>Các sản phẩm bán chạy nhất</h1>
            </article>
            <i class="ti-arrow-left" id="leftBestProducts"></i>
            <i class="ti-arrow-right" id="rightBestProducts"></i>
            <section class="contentLisstBestProducts" id="contentLisstBestProducts">
                <?php
                if (empty(home_GetAllProduct())) {
                    echo "<h1 style='color: 'while';'>Không có sản phẩm </h1>";
                } else {
                ?>
            </section>
        </section>
        <section class="book">
            <section class="contentBook">
                <article class="headerBook">
                    <h1>Đặt bàn</h1>
                    <p>Liên hệ với nhà hàng</p>
                </article>
                <form action="OnlineController.php?act=trangchu" method="post">
                    <section class="contentForm">
                        <input required type="datetime-local" name="Date">
                        <select required name="IdTable" class="time">
                            <option value=''>Chọn số bàn</option>
                            <?php
                            
                            if (!empty(home_GetAllTable()["Tables"])) {
                                foreach (home_GetAllTable()["Tables"] as $itemTable) {
                                    echo "<option value='{$itemTable['IdTables']}'>
                                        Bàn: {$itemTable['NumberTable']} _ 
                                        Số lượng người tối đa: {$itemTable['DefaultNumberPeople']}
                                        </option>";
                                }
                            }
                            ?>
                        </select>
                        <select required name="NumberPeopleInTables" class="persion">
                            <option value="">Chọn số lượng người</option>
                            <?php
                                $maxTable = home_GetAllTable()["TableMax"]["max(DefaultNumberPeople)"];
                            if (!empty(home_GetAllTable()["TableMax"])) {
                                for ($i = 1; $i <= $maxTable ; $i++) {
                                    echo "<option value='{$i}'>{$i} Người </option>";
                                }
                            }
                            ?>
                        </select>
                    </section>
                    <article class="footerBook">
                        <button type="submit">Đặt Ngay</button>
                    </article>
                </form>
            </section>
        </section>
        <section class="calorieBalance">
            <article class="contentCalorieBalance">
                <h1>Cân bằng năng lượng calo</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            </article>
            <i class="ti-arrow-left" id="leftContentCalorieBalance"></i>
            <i class="ti-arrow-right" id="rightContentCalorieBalance"></i>
            <section class="productCalorieBalance" id="productCalorieBalance">
                <?php
                    if (empty(home_GetAllProduct())) {
                        echo "<h1>Không có sản phẩm </h1>";
                    } else {
                ?>
            </section>
        </section>
        <section class="displayCommet" id="displayCommet">
            <section class="containerDisplayCommet" id="containerDisplayCommet">
                <?php
                        if (empty(home_GetComment())) {
                            echo "<h1 style='color: white'>Không có bình luận</h1>";
                        } else {
                ?>

            </section>

            <nav class="Nav">
                <i id="leftDispayComment" class="ti-arrow-left"></i>
                <article class="contentNav">
                    <h3 id="indexComment"></h3>
                    <h3>/</h3>
                    <h3 id="dataComment"></h3>
                </article>
                <i id="rightDispayComment" class="ti-arrow-right"></i>
            </nav>

        </section>
    </main>
</section>
</section>
<script src="../assets/js/Home.js"></script>
<?php
if(isset($alert) && !empty($alert)){
    echo "<script> alert('$alert') </script>";
};
                            $products = json_encode(home_GetAllProduct());
                            $dataComment = json_encode(home_GetComment());
                            foreach (home_GetComment() as $itemComment);
                            // dieu_huong sang chi tiết sản phẩm
                            echo '
    <script>
    onloadProductBest(' . $products . ', "leftBestProducts", "rightBestProducts",  "contentLisstBestProducts", 2);
    </script>';

                            // dieu_huong sang chi tiết sản phẩm
                            echo '
                            <script>
                                onloadProductCalorieBalance(' . $products . ', "leftContentCalorieBalance", "rightContentCalorieBalance",  "productCalorieBalance", 3);
                            </script>';

                            echo '
    <script>
    displayComment(' . $dataComment . ', "leftDispayComment", "rightDispayComment", "containerDisplayCommet", "indexComment", "dataComment")
    </script>
    ';



                            if (isset($alert)  && !empty($alert)) {
                                echo "<script> alert('$alert') </script>";
                            }
                        }
                    }
                }

?>