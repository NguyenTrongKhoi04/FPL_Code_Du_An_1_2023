    <link rel="stylesheet" href="../assets/css/user/CreateAccount.css">
    <section class="page">
        <section class="main">
            <article class="headerMain">
                <h1>Xác nhận Tài khoản</h1>
            </article>

            <form action="UserController.php?act=TaoTaiKhoan" method="post" class="main">
                <label for="">Nhập mã xác nhận *</label>
                <input title="Không được để trống" type="text" name="confirmCodeGmail">

                <input type="submit" value="Đăng nhập">
            </form>
            <section class="footerMain">
                <section class="itemContent">
                    <p>Tôi đã có tải khoản</p>
                    <p> Đăng nhập</p>
                </section>
            </section>
        </section>
        <article class="banner">
            <img src="<?= $img_Path ?>banner1.png" alt="banner1">
        </article>
    </section>
    <?php
    if (isset($alert)) {
        echo "
        <script> alert('$alert') </script>
        ";
    }
    ?>