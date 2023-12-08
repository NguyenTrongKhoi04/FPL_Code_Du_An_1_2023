    <div class="home">
        <link rel="stylesheet" href="<?= $userStyle ?>Home.css">
        <!-- BANNER -->
        <div class="banner">
            <div class="content_banner">
                <p>Chào Mừng Đến Với</p>
                <hr>
                <h1>TERRACE RESTAURANT</h1>
                <hr>
                <div class="p_phu">
                    <p>Nơi Hội Tụ Của Sự Sáng Tạo và Hương Vị Truyền Thống</p>
                    <p>Mỗi Bữa Ăn Là Một Hành Trình Đặc Sắc</p>
                </div>
                <button>khám Phá Ngay</button>
                <img class="footer_banner" src="<?=$img_Path?>snapedit_1701874146870.png" alt="">
            </div>
        </div>
        <!-- Introduce -->
        <div class="content">
            <h1>Sản Phẩm Mới nhất</h1>
            <div class="intro">
                <div class="intro1">
                    <div class="img">
                        <img src="<?=$imgPathAdmin.home_GetNewTwoProduct()[0]["ImageProduct"]?>" alt="<?= home_GetNewTwoProduct()[0]["ImageProduct"]?>">
                    </div>
                    <div class="content_intro1">
                    <h1> <?= home_GetNewTwoProduct()[0]["NameProduct"] ?> </h1>
                        <p>
                            <?= home_GetNewTwoProduct()[0]["ProductDetails"] ?>
                        </p>
                        <p>
                            <?= home_GetNewTwoProduct()[0]["ProductDescription"] ?>
                        </p>
                        <div class="button_intro1">
                            <a href='?act=LoadChiTietSanPham&id=<?= home_GetNewTwoProduct()[0]["IdProduct"] ?>&index=1' class='button_div'>
                                <button>Chi tiết sản phẩm</button>
                             </a>
                        </div>
                    </div>

                </div>
                <div class="intro2">
                    <div class="content_intro2">
                        <h1> <?= home_GetNewTwoProduct()[1]["NameProduct"] ?> </h1>
                        <p>
                            <?= home_GetNewTwoProduct()[1]["ProductDetails"] ?>
                        </p>
                        <p>
                            <?= home_GetNewTwoProduct()[1]["ProductDescription"] ?>
                        </p>
                        <div class="button_intro2">
                            <a href='?act=LoadChiTietSanPham&id=<?= home_GetNewTwoProduct()[1]["IdProduct"] ?>&index=1' class='button_div'>
                                <button>Chi tiết sản phẩm</button>
                             </a>
                        </div>
                    </div>
                    <div class="img">
                        <img src="<?=$imgPathAdmin.home_GetNewTwoProduct()[1]["ImageProduct"]?>" alt="<?= home_GetNewTwoProduct()[1]["ImageProduct"]?>">
                    </div>
                </div>
            </div>
            <h1 style="margin-top: 80px;">Món Ăn Hấp Dẫn</h1>
            <div class="Slideshow_Product" id="slideshow">
                <?php 
                foreach(home_GetAllProduct() as $itemProduct) {
                    echo "
                    <div class='content_pro'>       
                        <img src='../assets/img/admin/{$itemProduct['ImageProduct']} ' alt='img'>
                        <article class='titile'>
                          <h1> {$itemProduct['NameProduct']} </h1>
                        </article>
                        <article class='description'>
                          <p> {$itemProduct['ProductDetails']} </p>
                        </article>
                        <a href='?act=LoadChiTietSanPham&id={$itemProduct['IdProduct']}' class='button_div'>
                            <button>Chi tiết sản phẩm</button>
                        </a>
                    </div>
                    ";
                }
               ?>
            </div>
            <form action="OnlineController.php?act=trangchu" method="POST">
                <div class="choose_table">
                    <h1>Đặt Bàn</h1>
                    <div class="pick_option">
                        <input type="datetime-local" name="Date">
                        <select name="IdTable" id="">
                            <option value="" disabled selected hidden>Chọn Bàn</option>
                            <?php
                            
                            foreach(home_GetAllTable()['Tables'] as $valuesTables){
                                echo "
                                <option value='{$valuesTables['IdTables']}'>Bàn:{$valuesTables['NumberTable']}-Tối đa {$valuesTables['DefaultNumberPeople']} người </option>
                                ";
                            }
                            ?>

                        </select>
                        <select name="NumberPeopleInTables" id="">
                            <option value="" disabled selected hidden>Số Lượng Người</option>
                            <?php 
                            for($i = 1; $i <= home_GetAllTable()['TableMax']['max(DefaultNumberPeople)']; $i++){
                                echo "
                                <option value='{$i}'>{$i}</option>
                                ";
                            }
                            ?>
                        </select>
                    </div>
                    <button type="submit">Xác Nhận</button>
                </div>
            </form>
            <div class="three_icon_div">
                <img src="<?=$img_Path?>snapedit_1701911483904.png" alt="">
                <div class="content_certificate">
                    <h1>Chứng Nhận</h1>
                    <div class="certificate">
                        <div class="content">
                            <img src="<?=$img_Path?>1CircleIcon.png" alt="">
                            <h2>Chất Lượng Cao</h2>
                            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Tempora voluptates laudantium quod nemo quo quos illum nihil possimus iure pariatur?</p>
                        </div>
                        <div class="content">
                            <img src="<?=$img_Path?>2CircleIcon.png" alt="">
                            <h2>Chất Lượng Cao</h2>
                            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Tempora voluptates laudantium quod nemo quo quos illum nihil possimus iure pariatur?</p>
                        </div>
                        <div class="content">
                            <img src="<?=$img_Path?>CircleIcon.png" alt="">
                            <h2>Chất Lượng Cao</h2>
                            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Tempora voluptates laudantium quod nemo quo quos illum nihil possimus iure pariatur?</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="lienhe">
                <div class="nhap">
                    <p style="margin-top:0px ;">Nhập Họ Tên</p>
                    <input type="text" placeholder="Nhập họ tên của bạn...">
                    <input type="text" placeholder="số điện thoại...">
                    <input type="text" placeholder="email..." name="" id="">
                    <button>Gửi Liên Hệ</button>
                </div>
                <div class="info_shop">
                    <h2 style="margin-bottom: 15px;">Liên Hệ Với Chúng Tôi</h2>
                    <p>Để không ngừng nâng cao chất lượng dịch vụ và đáp ứng tốt hơn nữa các yêu cầu sử dụng sách của
                        Quý khách, chúng tôi mong muốn nhận được các thông tin phản hồi. Nếu Quý khách có bất kỳ thắc
                        mắc hoặc đóng góp nào, xin vui lòng liên hệ với chúng tôi theo thông tin dưới đây. Chúng tôi sẽ
                        phản hồi lại Quý khách trong thời gian sớm nhất.</p>
                    <h2 style="margin-bottom: 15px;">Thông tin liên hệ</h2>
                    <p>SĐT: 0989330932</p>
                    <p>GMAIL: restaurant_tphcm_vietNam46813@gmail.com</p>
                    <p>ĐỊA CHỈ: Số 78 Đường Phạm Văn Đồng, Bắc Từ Liêm, Hà Nội, Việt Nam</p>
                </div>
            </div>

        </div>

    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/hammer.js/2.0.8/hammer.min.js"></script>
<script>
    let currentIndex = 0;
    const slides = document.querySelectorAll('.content_pro');
    const totalSlides = slides.length;
    const slideshow = document.getElementById('slideshow');

    function showSlide(index) {
        slides.forEach((slide, i) => {
            const offset = (i - index) * 280; // 300px width + 40px margin
            slide.style.transform = `translateX(${offset}px)`;
        });
    }

    function nextSlide() {
        currentIndex = (currentIndex + 1) % totalSlides;
        showSlide(currentIndex);
    }

    const mc = new Hammer(slideshow);
    mc.on('swipeleft', nextSlide);
    mc.on('swiperight', () => {
        currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
        showSlide(currentIndex);
    });

    setInterval(nextSlide, 3000); // Change slide every 2 seconds
</script>

</html>