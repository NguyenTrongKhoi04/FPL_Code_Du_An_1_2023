<?php
function updateBan($id,$NumberPeopleInTables,$NumberTables,$StatusTables,$Date){
    $sql = "UPDATE tables SET NumberPeopleInTables ='$NumberPeopleInTables',NumberTables='$NumberTables',StatusTables='$StatusTables',Date = '$Date' WHERE IdTable = '$id'";
    return pdo_Execute($sql);
}