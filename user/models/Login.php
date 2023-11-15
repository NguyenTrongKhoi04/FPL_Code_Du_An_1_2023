<?php

function checkTaiKhoan($user,$pass){
    $check = select_One('account',null,'NameAccounts = $user, Password = 1');
}