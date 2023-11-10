<div class="datban">
    <link rel="stylesheet" href="../assets/css/user/DatBan.css">
    <div class="sodo">
        <h1>SƠ ĐỒ NHÀ HÀNG</h1>
        <div class="door_kitchen">
            <div class="cua_ra_vao">
                <p>của ra vào</p>
            </div>
            <div class="kitchen">
                <p>Bếp</p>
            </div>
        </div>
        <?php $arr=[1,2,5,6]?>
        <div class="so_do_cho_ngoi">
            <form action="">
                <div>
                    <table>
                        <?php $dem=0; ?>
                        <?php for($n=0;$n<4;$n++) {?>
                        <tr>
                                <?php for($i=0;$i<5;$i++) { $dem++;?>
                            <td>
                                <div class="ban">
                                    <input type="checkbox" name="ban_<?=$dem?>" value="1" id="checkbox1" <?php echo (in_array($dem, $arr) ? "checked disabled" : ""); ?>>
                                    <label for="checkbox1"><?=$dem ?></label>
                                </div>
                            </td>
                                <?php }?>
                        </tr>
                        <?php } ?>
                        <?php $dem_ban_to=20; for($n=0;$n<2;$n++) {?>
                            <tr>
                                <?php for($i=0;$i<4;$i++) { $dem_ban_to++;?>
                                    <td>
                                        <div class="ban_to">
                                            <input type="checkbox" name="ban_<?=$dem_ban_to?>" value="1" id="checkbox1" <?php echo (in_array($dem_ban_to, $arr) ? "checked disabled" : ""); ?>>
                                            <label for="checkbox1"><?= $dem_ban_to?></label>
                                        </div>
                                    </td>
                                    <?php }?>
                                </tr>
                        <?php }?>
                    </table>
                </div>
                <div></div>
            </form>
            <div class="QuayLeTan">
                <div class="thanhtoan"><p>Quầy Thanh Toán</p></div>
            </div>
        </div>
        
    </div>
</div>