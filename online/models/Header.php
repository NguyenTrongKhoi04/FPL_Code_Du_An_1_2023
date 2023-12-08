<?php 

function home_GetCategory(){
    return query_All("select * from category where StatusCategory = 0");
}
?>