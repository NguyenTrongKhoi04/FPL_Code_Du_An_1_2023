<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/user/Home.css">
    <link rel="stylesheet" href="../assets/css/user/Header.css">
    <link rel="stylesheet" href="../assets/themify-icons/themify-icons.css">

</head>
<body>
    <header>
        <div class="content_header">
            <div class="menu">
                <img src="../img/Logo.png" alt="">
                <ul>
                    <li><a href="">Đồ Ăn</a></li>
                    <li><a href="">Đồ Uống</a></li>
                    <li><a href="">Combo</a></li>
                    <li><a href="">Đồ Ăn Nhanh</a></li>
                </ul>
            </div>
            <?php if(isset($_SESSION['user'])) {?>
                <div class="login">
                    <button class="button_Login"><a href="">Đăng nhập</a></button>
                    <button class="button_Login"><a href="">Đăng Ký</a></button>
                </div>
            <?php }else{ ?>
                <div class="login">
                    <a href="" class="login_success"><img src="../img/Glyph_ undefined.png" alt=""></a>
                    <a href="" class="login_success"><img src="../img/Vector.png" alt=""></a>
                    <a href="" class="login_success"><img src="../img/out.png" alt=""></a>
                    <a href="" class="img_avatar">
                        <div class="avatar">
                            <img src="../img/Rectangle 33.png" alt="">
                        </div>
                    </a>
                </div>
            <?php }?>
        </div>
    </header>
