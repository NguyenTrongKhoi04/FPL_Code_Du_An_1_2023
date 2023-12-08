    <link rel="stylesheet" href="../assets/css/user/CreateAccount.css">
    <div class="box_login">
        <div class="layer"></div>
        <div class="login">
            <div class="img_login">
                <img src="../img/HazelnutFettuccinewitSautéedMushrooms_Adventures in Cooking1.png" width="100%" alt="">
            </div>
            <form action="OnlineController.php?act=TaoTaiKhoan" method="post" class="main" class="content_login">
                <article class="nameAge">
                    <article class="name">
                        <label for="">Tên *</label>
                        <input title="Không được để trống" type="text" name="name">
                    </article>
                    <article class="age">
                        <label for="">Giới tính *</label>
                        <select title="Không được để trống" name="gender" id="">
                            <option value="0" selected>Giới tính</option>
                            <option value="0">Nam</option>
                            <option value="1">Nữ</option>
                            <option value="2">Khác</option>
                        </select>

                    </article>
                </article>
                <label for="">Địa chỉ *</label>
                <input title="Không được để trống" type="text" name="address">
                <label for="">Email *</label>
                <input title="Không được để trống" type="text" name="email">
                <label for="">Mật khẩu *</label>
                <input title="Không được để trống" type="password" name="password">
                <label for="">Nhập Lại Mật khẩu *</label>
                <input title="Không được để trống" type="password" name="confirmPassword">

                <input type="submit" value="Đăng nhập">
            </form>
        </div>
    </div>