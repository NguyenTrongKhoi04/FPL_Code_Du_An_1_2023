<?php

function Load_thong_ke(){
    $sql = "SELECT ct.IdCategory, ct.NameCategory , COUNT(*) 'soluong', MIN(PriceProduct) 'gia_min', 
    MAX(PriceProduct) 'gia_max', AVG(PriceProduct) 'gia_tb ' FROM category ct JOIN product pr ON 
    ct.IdCategory = pr.IdCategory GROUP BY ct.IdCategory, ct.NameCategory ORDER BY soluong DESC";

    return query_All($sql);
}
