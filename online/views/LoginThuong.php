<link rel="stylesheet" href="../assets/css/user/LoginThuong.css">
<div class="Login_thuong">
    <div class="img"><img src="<?= $img_Path?>Login.png" alt=""></div>
    <div class="content_login_thuong">
        <form action="../online/UserController.php?act=dangnhap" method="POST">
            <h2>ĐĂNG NHẬP</h2>
            <p>Tài Khoản</p>
            <input type="text" placeholder="" name="tk">
            <p>Mật Khẩu</p>
            <input type="password" placeholder="" name="mk">
            <button type="submit">Đăng nhập</button>
            <div class="option">
                <a href="">Quên mật khẩu</a>
                <a href="">Đăng ký</a>
            </div>
        </form>
    </div>
</div>