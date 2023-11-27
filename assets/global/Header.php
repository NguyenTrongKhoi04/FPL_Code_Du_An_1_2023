<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/user/Footer.css">
    <link rel="stylesheet" href="../assets/css/user/Header.css">
    <link rel="stylesheet" href="../assets/themify-icons/themify-icons.css">
</head>

<body>
    <header>
        <div class="content_header">
            <div class="menu">
                <a href="<?= $userAction ?>">
                    <img src="<?= $img_Path ?>Logo.png" alt="">
                </a>
                <ul>
                    <li><a href="">Đồ Ăn</a></li>
                    <li><a href="">Đồ Uống</a></li>
                    <li><a href="">Combo</a></li>
                    <li><a href="">Đồ Ăn Nhanh</a></li>
                </ul>
            </div>
            <?php if (empty($_SESSION['user'])) { ?>
                <div class="login">
                    <button class="button_Login"><a href="<?= $userAction ?>dangnhap_AnTaiQuan">Đặt trực tiếp</a></button>
                    <button class="button_Login"><a href="<?= $userAction ?>dangnhap">Đăng nhập</a></button>
                    <button class="button_Login"><a href="<?= $userAction ?>TaoTaiKhoan">Đăng Ký</a></button>
                </div>
            <?php } else { ?>
                <div class="login">
                    <?php if ($_SESSION['user']['Role'] == 3) { ?>
                        <button class="button_Login"><a href="<?= $userAction ?>LoginNhanh_GioHang">Danh Sách Order</a></button>
                    <?php }  ?>
                        
                    <a href="" class="login_success"><img src="<?= $img_Path ?>Glyph_ undefined.png" alt=""></a>
                    <?php if ($_SESSION['user']['Role'] == 3) { ?>

                    <?php } else { ?>
                        <a href="" class="login_success"><img src="<?= $img_Path ?>Vector.png" alt=""></a>
                    <?php } ?>
                    <a href="<?= $userAction ?>dangxuat" class="login_success"><img src="<?= $img_Path ?>out.png" alt=""></a>

                    <div class="avatar">
                        <img src="<?= $img_Path ?><?= $_SESSION['user']['ImageAccounts'] ?>" alt="">
                    </div>
                    </a>
                </div>
            <?php } ?>
        </div>
    </header>