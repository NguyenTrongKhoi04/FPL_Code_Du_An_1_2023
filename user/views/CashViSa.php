<link rel="stylesheet" href="<?=$userStyle?>/CashViSa.css">
<form action="" method="post" class="page">
    <section class="containerVisa">
        <section class="contentVisa">
            <article class="logo">
                <article class="title">
                    <h1>Vui lòng nhập mã số thẻ</h1>
                </article>
                <article class="img">
                    <img src="../assets/img/html/LogoMastercard.png" alt="LogoMastercard">
                    <img src="../assets/img/html/LogoViSa.png" alt="LogoViSa">
                </article>
            </article>
            <section class="itemVisa">
                <article class="titleItemVisa">
                    <h3>Số thẻ</h3>
                    <p>Vui lòng nhập 16 ký tự trên thẻ của bạn</p>
                </article>
                <article class="contentTitleItemVisa">
                    <input type="number" name="CardNumber">
                </article>
            </section>
            <section class="itemVisa">
                <article class="titleItemVisa">
                    <h3>Chủ thẻ</h3>
                    <p>Vui lòng nhập tên chủ thẻ</p>
                </article>
                <article class="contentTitleItemVisa">
                    <input type="text" name="CardName">
                </article>
            </section>
            <section class="itemVisa">
                <article class="titleItemVisa">
                    <h3>Ngày hết hạn</h3>
                    <p>Vui lòng nhập ngày hết hạn của thẻ</p>
                </article>
                <article class="contentTitleItemVisas">
                    <input type="number" name="CardDateMonth">
                    <p>/</p>
                    <input type="number" name="CardDateYear" value="23">
                </article>
            </section>

        </section>
    </section>
    <section class="bill"></section>
</form>