<?php 
    /**
     *Hàm nhận  về $idAccount và trả ra những sản phẩm tương ứng với trong giỏ hàng của họ
     */
    function cart_GetAllCartByIdAccount($idAccount){
        $sql = "select car.*, p.NameProduct,p.ImageProduct, p.PriceProduct, p.QuantityProduct
        from cart car
        join cart_pro as car_p on car.IdCart  = car_p.IdCart 
        join product AS p on p.IdProduct = car_p.IdProduct
        where car.IdAccount = $idAccount";

        return query_All($sql);
    }

    /**
     * Hàm tính toán số tiền khách hàng phải trả 
     * Data: Dữ liệu được lấy trên database 
     */
    function cart_Totail($data){
        $qualityProduct = count($data);
        $totailPrice = 0;

        foreach($data as $values){
            $totailPrice += $values['PriceProduct'];
        }

        $vat = $totailPrice * 0.1;
        $ServiceCharge = $totailPrice * 0.01;
        $totail = $totailPrice + $vat + $ServiceCharge;

        return([
            "qualityProduct" => $qualityProduct,
            "totailPrice" => $totailPrice,
            "vat" => $vat,
            "ServiceCharge" => $ServiceCharge,
            "totail" => $totail
        ]);

    }
    /**
     * Hàm có tác dụng xóa từng sản phẩm trong giỏ hàng
     * IdCard: Xóa sản phẩm cụ thể
     */
    function cart_Delete($IdCard){
        $sqlCart_pro = "delete from cart_pro where IdCart  = $IdCard ";
        $sqlCart = "delete from cart where IdCart  = $IdCard ";
        pdo_Execute($sqlCart_pro);
        return pdo_Execute($sqlCart);

    }
    /**
     * Hàm có tác dụng cập nhật lại số lượng do người dùng muốn thêm
     * $data: Mảng các sản phẩm cần chỉnh sả
     */
    function cart_UpdateCart($data){
        foreach($data as $key => $values){
            pdo_Execute("update cart set Quantity = $values where IdCart  = $key ");
           
        }
        return null;
        
    }
?>