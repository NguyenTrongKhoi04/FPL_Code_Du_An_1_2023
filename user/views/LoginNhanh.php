<link rel="stylesheet" href="../assets/css/user/LoginThuong.css">
<div class="Login_thuong">
    <div class="img"><img src="<?= $img_Path?>Login.png" alt=""></div>
    <div class="content_login_thuong">
        <form action="../user/UserController.php?act=dangnhap_AnTaiQuan" method="POST">
            <h2 style="font-size: 65px;">Khách Hàng Ăn Tại Quán</h2>
            <p>Nhập Gmail</p>
            <input type="email"  required placeholder="" name="tk_nhanh">
            <button type="submit">Bắt Đầu Order</button>
        </form>
    </div>
</div>