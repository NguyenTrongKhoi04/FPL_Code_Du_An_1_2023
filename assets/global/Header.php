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
                <a href="<?= $onlineAction ?>Home">
                    <img src="<?= $img_Path?>Logo.png" alt="">

                </a>
                <?php if (empty($_SESSION['user'])) { ?>
                    <ul>
                        <li><a href="OnlineController.php?act=DanhMucSanPham&idCategory=1">Các Sản Phẩm</a></li>
                    </ul>
                <?php } else { ?>
                    <?php if ($_SESSION['user']['Role'] == 3) { ?>
                        <?php if (isset($_SESSION['ban'])) { ?>
                            <ul>
                            <li><a href="OnlineController.php?act=DanhMucSanPham&idCategory=1">Các Sản Phẩm</a></li>
                            </ul>
                        <?php } ?>
                    <?php } else { ?>
                        <ul>
                        <li><a href="OnlineController.php?act=DanhMucSanPham&idCategory=1">Các Sản Phẩm</a></li>
                        </ul>
                    <?php } ?>
                <?php } ?>
            </div>
            <?php if (empty($_SESSION['user'])) { ?>
                <div class="login">

                    <button class="button_Login"><a href="<?= $onlineAction ?>dangnhap">Đăng nhập</a></button>
                    <button class="button_Login"><a href="<?= $onlineAction ?>TaoTaiKhoan">Đăng Ký</a></button>

                </div>
            <?php } else { ?>
                <div class="login">

                    <a href="OnlineController.php?act=billthanhtoan" class="login_success"><img src="<?= $img_Path ?>Glyph_ undefined.png" alt=""></a>
                    <a href="OnlineController.php?act=GioHang" class="login_success"><img src="<?= $img_Path ?>Vector.png" alt=""></a>
                    <a href="<?= $onlineAction ?>dangxuat" class="login_success"><img src="<?= $img_Path ?>out.png" alt=""></a>
            
                        <div class="avatar">
                            <img src="<?= $img_Path ?><?=$_SESSION['user']['ImageAccounts'] ?>" alt="">
                        </div>
                    </a>
                </div>
            <?php } ?>
        </div>
    </header>