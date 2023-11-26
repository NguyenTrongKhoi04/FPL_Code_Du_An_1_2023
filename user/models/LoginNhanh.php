<?php
function tao_TaiKhoan_LoginNhanh($gmail){
    $sql = "INSERT INTO account(NameAccount,Gmail,Role) VALUES ('$gmail','$gmail',3) ";
    return pdo_Execute($sql);
}