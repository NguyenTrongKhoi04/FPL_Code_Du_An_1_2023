<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/user/Footer.css">
    <link rel="stylesheet" href="../assets/css/user/Header.css">
    <link rel="stylesheet" href="../assets/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=FontName&display=swap">
</head>

<body>
<div class="wrapper">
    <div class="header">
        <div class="logo">
            <a class="logo_link" href=""><img src="<?= $img_Path?>LogoTest-removebg-preview.png" alt=""></a>
            <ul>
            <?php 
                        if(!empty(home_GetCategory())){
                            foreach(home_GetCategory() as $valuesCategory){
                                echo "
                                <li>
                                    <a href='OnlineController.php?act=DanhMucSanPham&idCategory={$valuesCategory['IdCategory']}'> {$valuesCategory['NameCategory']} </a>
                                </li>
                                ";
                            }
                        }
                    ?>
            </ul>
        </div>
        <div class="information">
            <?php if (!empty($_SESSION['user'])) { ?>
                <a href=""><img src="<?= $img_Path?>Vector.png" alt=""></a>
                <a href=""><img src="<?= $img_Path?>out.png" alt=""></a>
                <a href=""><img src="<?= $img_Path?>Glyph_ undefined.png" alt=""></a>
                <a href="">
                    <div class="avatar">
                        <img src="<?= $img_Path?>Login.png" width="10px" alt="">
                    </div>
                </a>
            <?php } else { ?>
                <div class="login">
                    <button class="button_login"><a href="<?= $onlineAction ?>dangnhap">Đăng nhập</a></button>
                    <button class="button_login"><a href="<?= $onlineAction ?>TaoTaiKhoan">Đăng Ký</a></button>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
