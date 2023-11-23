<?php
function updateBan($id,$NumberPeople,$NumberTable,$StatusTable){
    $sql = "UPDATE tables SET NumberPeople ='$NumberPeople',NumberTable='$NumberTable',StatusTable='$StatusTable' WHERE IdTables = '$id'";
    return pdo_Execute($sql);
}   