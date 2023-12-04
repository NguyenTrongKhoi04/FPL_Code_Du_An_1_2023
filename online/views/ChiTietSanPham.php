

   <div class="ChiTietSanPham">
        <link rel="stylesheet" href="../assets/css/user/ChiTietSanPham.css">
        <div class="ProductDetail">
            <div class="img"><img id="sizeImage" src="<?= $adminImg?>" height="100%"></div>
            <div class="form">

          
                <?php if ($_SESSION['user']['Role'] == 3) { ?>
                        <form action="<?= $userAction ?>LoginNhanh_Add_To_CartAndOrder&id=<?= $pro['IdProduct'] ?>" method="POST">
                    <?php } else { ?>
                        <form action="OnlineController.php?act=LoadChiTietSanPham&id=<?= $_GET['id']?>&index=1" method="POST">
                    <input type="hidden" name="IdProduct" value="<?=$pro['IdProduct']?>">
                    <input type="hidden" name="PriceProduct" value="<?=$pro['PriceProduct']?>">
                    <h2><?=$pro['NameProduct']?></h2>
                    <?php } ?>
                    <input type="hidden" name="IdProduct" value="<?= $pro['IdProduct'] ?>">
                    <input type="hidden" name="PriceProduct" value="<?= $pro['PriceProduct'] ?>">
                    <div class="hr"></div>
                    <ul>
                        <!-- <del>40.000</del> -->
                        <li>Giá: <span style="color: red;opacity: 90%;" id="displayPrice"></span> VNĐ</li>
                        <li><?= $pro['ProductDetails'] ?></li>
                        <li><?= $pro['ProductDescription'] ?></li>
                    </ul>
                    <div class="soluong">
                        <div class="tanggiam">
                            <p>Số lượng mua&nbsp;&nbsp;</p>

                            <button type="button" id="decrease">-</button>
                            <input type="number" value="1" name="Quantity" id="quantity" min="1" required max="<?= $pro['QuantityProduct']?>" data-max="<?= $pro['QuantityProduct'] ?>">
                            <button type="button" id="increase">+</button>

                        </div>
                        <div class="tanggiam">
                            <p>Size&nbsp;&nbsp;</p>

                            <select name="SizeProduct" style="font-size: 40px;" id="selectSize">
                            <?php foreach ($proSize as $i) : ?>
                                    <option value="<?= $i['NameSize'] ?>" data-image="<?= $i['ImgSizePro'] ?>" data-price="<?= $i['Price']?>" ><?= $i['NameSize'] ?></option>
                                <?php endforeach ?>
                                

                            </select>
                        </div>

                    </div>

                    <?php if ($_SESSION['user']['Role'] == 3) { ?>
                        <button name="loginNhanh_add_to_cart_bill">Order</button>
                    <?php } else { ?>
                        <button name="add_to_cart">THÊM VÀO GIỎ HÀNG</button>
                        <button name="add_to_bill">THANH TOÁN LUÔN</button>
                    <?php } ?>
                    </form>
            </div>
        </div>
        <div class="list">
            <?php foreach ($pro_LienQuan as $i) : ?>
                <div class="pro">
                    <a href="OnlineController.php?act=LoadChiTietSanPham&id=<?= $i['IdProduct'] ?>">
                        <div class="img">
                            <img src="<?= $adminImg . $i['ImageProduct'] ?>" alt="">
                        </div>
                        <p style="color: white;"><?= $i['NameProduct'] ?></p>
                    </a>

                </div>
            <?php endforeach ?>
        </div>
        <div class="top">
            <h2>TOP MUA NHIỀU NHẤT</h2>
            <a href="">
                <div class="list_item">
                    <?php for ($i = 0; $i < 3; $i++) : ?>
                        <div class="item">
                            <img src="<?= $img_Path ?>Rectangle 33.png" alt="">
                            <p>Combo fast food 66k</p>
                            <h3>100.000 Sẩn phẩm đã bán</h3>
                        </div>
                    <?php endfor ?>
                </div>
            </a>
        </div>
        <div class="comment">
            <div class="list_comment" id="list_comment" data-value = "<?= $dataComment["TotalRecords"] ?>">
                    <div class="content">
                        <div class="img">

                            <img src="<?= $img_Path ?>Rectangle 33.png" alt="">
                        </div>
                        <?= $i ?>
                        <p>dfasfdafdsafsafdsfsdafsafdsafsadfsdafsdfsdafdsafdsfdsfsadfsdfdsfdsfdsffs</p>

                    </div>
                
            </div>
            <div class="tang_giam">

                <!-- <button name="tang">
                   
                        <div class="position-display"><?= $totalContents ?> / <?= $totalContents ?></div>
                        <button name="giam">></button> -->

            </div>
        </div>
    </div>
    <?php 
    if(isset($alert) && !empty($alert)){
        echo "<script> alert('$alert') </script>";
    }
    ?>
    <script src="../assets/js/ChiTietSanPham.js"></script>
    <script>
        // Chọn giá trị mặc định là giá trị của option đầu tiên
        var defaultPrice = <?= reset($proSize)['Price'] ?>;
        var sizeImage = document.getElementById('sizeImage');
        var defaultImage = '<?= $adminImg.reset($proSize)['ImgSizePro'] ?>';
        document.getElementById('displayPrice').innerText = defaultPrice;
        
        sizeImage.src = defaultImage;
        // Xử lý sự kiện khi thay đổi option
        document.getElementById('selectSize').addEventListener('change', function() {
            var selectedOption = this.options[this.selectedIndex];
            var price = selectedOption.getAttribute('data-price');

            document.getElementById('displayPrice').innerText = price;
            sizeImage.src = '<?= $adminImg ?>' +selectedOption.getAttribute('data-image');

        });
    </script>