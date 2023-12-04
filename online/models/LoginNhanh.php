<?php
function tao_TaiKhoan_LoginNhanh($NameAccount,$gmail){
    $sql = "INSERT INTO account(NameAccount,Gmail,Role) VALUES ('$NameAccount','$gmail',3) ";
    return pdo_Execute($sql);
}