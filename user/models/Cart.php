<?php 
    function cart_GetAllCartByIdAccount($idAccount){
        $sql = "select car.*, p.NameProducts, p.PriceProducts, zd.SizeDefault 
        from card car
        join product AS p on p.IdProduct = car.IdProduct
        join sizedefault AS zd on zd.IdSizeDefault = car.IdSizeDefault
        where car.IdAccount = $idAccount";

        return query_All($sql);
    }
?>