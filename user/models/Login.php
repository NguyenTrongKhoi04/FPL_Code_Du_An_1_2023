<?php

function checkTaiKhoan($user,$pass){
    $check = select_One('account',null,'Name = $user, Password = 1');
}