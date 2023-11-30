
   <div class="ChiTietSanPham">
        <link rel="stylesheet" href="../assets/css/user/ChiTietSanPham.css">
        <div class="ProductDetail">
            <div class="img"><img src="<?= $imgPathAdmin?><?=$pro['ImageProduct']?>"  height="100%"></div>
            <div class="form">
                <form action="UserController.php?act=LoadChiTietSanPham&id=<?= $_GET['id']?>" method="POST">
                    <input type="hidden" name="IdProduct" value="<?=$pro['IdProduct']?>">
                    <input type="hidden" name="PriceProduct" value="<?=$pro['PriceProduct']?>">
                    <h2><?=$pro['NameProduct']?></h2>
                    <div class="hr"></div>
                    <ul>
                            <!-- <del>40.000</del> -->
                        <li>Giá:<span><?= $pro['PriceProduct']?> VNĐ</span></li>
                        <li><?= $pro['ProductDetails']?></li>
                        <li><?= $pro['ProductDescription']?></li>
                    </ul>
                    <div class="soluong">
                        <div class="tanggiam">
                            <p>Số lượng mua&nbsp;&nbsp;</p>
                            <button type="button" id="decrease">-</button>   
                            <input required type="number" value="1"  name="Quantity" id="quantity"  min="1" max="<?= $proSize[0]["QuantityProduct"] ?>">
                            <button type="button" id="increase" value="<?= $proSize[0]["QuantityProduct"] ?>" >+</button>
                          
                        </div>
                        <div class="tanggiam">
                            <p>Size&nbsp;&nbsp;</p>
                            <select name="SizeProduct" style="font-size: 40px;">
                            <?php foreach($proSize as $i) :?>
                                <option value="<?=$i['NameSize'] ?>"><?= $i['NameSize']?></option>
                            <?php endforeach ?>
                            </select>
                        </div>
                        
                    </div>
                    <button name="add_to_cart">THÊM VÀO GIỎ HÀNG</button>
                    <button name="pay_now">THANH TOÁN LUÔN</button>
                </form>
            </div>
        </div>
        <div class="list">
            <?php foreach($pro_LienQuan as $i) :?>
            <div class="pro">
                <a href="<?= $userAction?>LoadChiTietSanPham&id=<?=$i['IdProduct']?>">
                <div class="img">
                    <img src="<?= $adminImg.$i['ImageProduct']?>" alt="">
                </div>
                <p style="color: white;"><?= $i['NameProduct']?></p>
                </a>
            </div>
            <?php endforeach?>
        </div>
        <div class="top">
            <h2>TOP MUA NHIỀU NHẤT</h2>
            <a href=""><div class="list_item">
                <?php for($i=0;$i<3;$i++) : ?>
                    <div class="item">
                        <img src="<?= $img_Path?>Rectangle 33.png" alt="">
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
                            <img src="<?= $imgPathAdmin.$dataComment["ImageAccounts"]?>" alt="">
                            </div>
                        
                        <p><?= $dataComment["Content"] ?></p>
                    </div>
                
            </div>
            <div class="tang_giam">
                <button id="giam"><</button>
                <div class="position-display" id="displaComment">
                    <?= $_GET["index"] ?> / <?= $dataComment["TotalRecords"] ?>
                </div>
                <button id="tang">></button>
            </div>
        </div>
    </div>
    <?php 
    if(isset($alert) && !empty($alert)){
        echo "<script> alert('$alert') </script>";
    }
    ?>
    <script src="../assets/js/ChiTietSanPham.js"></script>
