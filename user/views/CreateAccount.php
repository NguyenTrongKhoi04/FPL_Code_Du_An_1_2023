    <link rel="stylesheet" href="../assets/css/user/CreateAccount.css">
    <section class="page">
        <section class="main">
            <article class="headerMain">
                <h1>Đăng ký </h1>
            </article>
            
            <form action="" method="post" class="main">
                <article class="nameAge">
                    <article class="name">
                        <label for="">Tên *</label>
                        <input required title= "Không được để trống" type="text"  name = "name">
                    </article>
                    <article class="age">
                        <label for="">Tuổi *</label>
                        <input required title= "Không được để trống"  type = "number" name = "age" min="0" max = "100">
                    </article>
                  </article>
                <label for="">Địa chỉ *</label>
                <input required title= "Không được để trống" type="text"  name = "address">
                <label for="">Email *</label>
                <input required title= "Không được để trống" type="email"  name = "email">
                <label for="">Tài khoản  *</label>
                <input required title= "Không được để trống"  type = "text" name = "account">
                <label for="">Mật khẩu *</label>
                <input required title= "Không được để trống"  type = "password" name = "password">
                <input  type = "submit" name="submit" value="Đăng nhập">
            </form>
            <section class="footerMain">
                <section class="itemContent">
                    <p>Tôi đã có tải khoản</p>
                    <p> Đăng nhập</p>
                </section>
            </section>
        </section>
        <article class="banner">
            <img src="<?= $img_path ?>banner1.png" alt="banner1">
        </article>
    </section>
