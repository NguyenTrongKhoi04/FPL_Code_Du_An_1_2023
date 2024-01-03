<?php 

function home_GetCategory(){
    return query_All("select * from category where StatusCategory = 0 order by IdCategory limit 5");
}
?>