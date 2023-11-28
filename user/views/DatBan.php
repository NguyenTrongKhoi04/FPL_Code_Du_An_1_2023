<link rel="stylesheet" href="../assets/css/user/DatBan.css">
<form action="" method="post" class="datban">
    <article class="header">
        <h1>Chọn bàn mà bạn muốn</h1>
    </article>
    <section class="containerTable">
    <section class="listTable">
        <?php
        foreach(datBan_ListTables() as $valuesListTables){
            if($valuesListTables["StatusTable"] === 2){
                echo "
                <label class='contentTable ' style='background-color: #CA0910;'>
                    <span>{$valuesListTables['NumberTable']}</span>
                </label>                
                ";
            }else{
                echo "
                <label class='contentTable'>
                    <input type='radio' name='contentTable' value='{$valuesListTables['IdTables']}' hidden>
                    <span>{$valuesListTables['NumberTable']}</span>
                </label>                
                ";
            }
        }
        ?>

    </section>
    <article class="timeBooking">
        <input type="datetime-local" name="timeBooking" id="">
        <article class="footer">
            <button type="submit">Thanh toán</button>
        </article>
    </article>
    </section>

</form>
<script src="../assets/js/DatBan.js"></script>