
<section class="page">
    <link rel="stylesheet" href="<?= $userStyle?>Home.css">
    <link rel="stylesheet" href="../assets/themify-icons/themify-icons.css">
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
                        <?php if(empty(home_GetAllProduct())){
                            echo "<h1>Không có sản phẩm </h1>";
                        }else{
                            foreach(home_GetAllProduct() as $itemProduct) {
                                // link sang chi tiết sản phẩm
                                echo "
                                <a href= '?act=ChiTietSanPham&id={$itemProduct['IdProduct']}' class='contentListProduct'>
                                    <article class='image'>
                                    <img src='{$imgPathAdmin}{$itemProduct['ImageProducts']}' alt='img'>
                                    </article>
                                    <article class='title'>
                                        <h1>{$itemProduct['NameProducts']}</h1>
                                    </article>
                                    <article class='description'>
                                        <p>{$itemProduct['ProductDetails']}</p>
                                    </article>
                                    <article class='price'>
                                        <h1>{$itemProduct['PriceProducts']}$</h1>
                                    </article>
            
                                    <article class='buttonAction'>
                                        <button>Thêm vào giỏ hàng</button>
                                        <button>Mua ngay</button>
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
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Purus lorem id penatibus imperdiet. Turpis egestas ultricies purus auctor tincidunt lacus nunc. </p>
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
                <i class="ti-arrow-left" id="leftBestProducts" ></i>
                <i class="ti-arrow-right" id="rightBestProducts" ></i>
                <section class="contentLisstBestProducts" id="contentLisstBestProducts">
                    <?php 
                        if (empty(home_GetAllProduct())) {
                            echo "<h1>Không có sản phẩm </h1>";
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
                    <form action="" method="post">
                        <section class="contentForm">
                            <input type="date" name="" id="">
                            <select name="" id="" class="time">
                                <option value="">Time</option>
                            </select>
                            <select name="" id="" class="persion">
                                <option value="">Time</option>
    
                            </select>
                        </section>
                        <article class="footerBook">
                            <button>Đặt Ngay</button>
                        </article>
                    </form>
                </section>
            </section>
            <section class="calorieBalance">
                <article class="contentCalorieBalance">
                    <h1>Cân bằng năng lượng calo</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </article>
                <i class="ti-arrow-left"></i>
                <i class="ti-arrow-right"></i>
                <section class="productCalorieBalance">
                    <article class="contentProductCalorieBalance">
                        <img src="<?= $img_Path ?>Image5.png" alt="img">
                        <h1>Starters</h1>
                    </article>
                    <article class="contentProductCalorieBalance">
                        <img src="<?= $img_Path ?>MenuCategory.png" alt="img">
                        <h1>Mains</h1>
                    </article>
                    <article class="contentProductCalorieBalance">
                        <img src="<?= $img_Path ?>Image6.png" alt="img">
                        <h1>Soups</h1>
                    </article>
                    <article class="contentProductCalorieBalance">
                        <img src="<?= $img_Path ?>Image6.png" alt="img">
                        <h1>Soups</h1>
                    </article>
                
                </section>
            </section>
            <section class="displayCommet">
                <article class="contentDispayComment">
                    <h1> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Purus lorem id penatibus imperdiet. Turpis egestas ultricies purus  Lorem ipsum dolor sit amet.</h1>
                </article>
                <section class="itemDispayComment">
                    <section class="persion">
                        <img src="<?= $img_Path ?>Avatar.svg" alt="img">
                        <article class="title">
                            <h1>John Doe</h1>
                            <p>Bloger</p>
                        </article>
                    </section>
                    <nav class="Nav">
                    <i class="ti-arrow-left"></i>
                        <article class="contentNav">
                            <h3>2</h3>
                            <h3>/</h3>
                            <h3>3</h3>
                        </article>
                    <i class="ti-arrow-right"></i>
                    </nav>
                </section>
            </section>
        </main>

    </section>
    <script src="../assets/js/Home.js"></script>
    <?php
    $products = json_encode(home_GetAllProduct());
      
    echo "<script>onloadProduct($products, 'leftBestProducts', 'rightBestProducts',  'contentLisstBestProducts', 2);</script>";

}

?>