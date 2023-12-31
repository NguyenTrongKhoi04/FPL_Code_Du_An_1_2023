<?php 
    /**
     *Hàm nhận  về $idAccount và trả ra những sản phẩm tương ứng với trong giỏ hàng của họ
     */
    function cart_GetAllCartByIdAccount($idAccount)
    {
        $sql = "select car.*, p.NameProduct,p.ImageProduct, p.PriceProduct, p.QuantityProduct
        from cart car
        join product AS p on p.IdProduct = car.IdProduct
        where car.IdAccount = $idAccount";

        return query_All($sql);
    }

    /**
     * Hàm tính toán số tiền khách hàng phải trả 
     * Data: Dữ liệu được lấy trên database 
     */
    function cart_Totail($data)
    {
        // echo "<pre>";
        // var_dump($data); die();
        $qualityProduct = count($data);
        $totailPrices = 0;
        $totailQuality = 0;

        foreach($data as $values){
            $totailPrices += $values['PriceProduct'];
            $totailQuality += $values['QuantityCard'];
        }
        $totailPrice = $totailPrices * $totailQuality;

        $vat = $totailPrice * 0.1;
        $ServiceCharge = $vat * 0.01;
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
    function cart_Delete($IdCard)
    {
        $sqlCart = "delete from cart where IdCart  = $IdCard ";
        return pdo_Execute($sqlCart);
    }
    /**
     * Hàm có tác dụng cập nhật lại số lượng do người dùng muốn thêm
     * $data: Mảng các sản phẩm cần chỉnh sả
     */
    function cart_UpdateCart($data){
        foreach($data as $key => $values){
            pdo_Execute("update cart set QuantityCard = $values where IdCart  = $key ");
           
        }
        return null;
        
    }



    function loginNhanh_ListCart($idAccount){
        $sql = "SELECT product.NameProduct,product.ImageProduct,product.QuantityProduct,product.PriceProduct, cart.*
                FROM cart
                INNER JOIN product ON cart.IdProduct = product.IdProduct
                WHERE cart.IdAccount = $idAccount 
                ";
        return query_All($sql);
    }

    function loginNhanh_ChuaThanhToan_GetAll_Order_ByIdAccount($idAccount){
        $sql ="SELECT  orders.*,order_pro.*,product.*
            FROM orders 
            INNER JOIN order_pro ON orders.IdOrder= order_pro.IdOrder
            INNER JOIN product ON product.IdProduct= order_pro.IdProduct
            WHERE IdAccount = $idAccount 
                AND orders.StatusOrders = 0  
            ";
        return query_All($sql);
    }

    function loginNhanh_Update_TrangThai_ThanhToan_Orders($id_User){
        $sql = "UPDATE orders SET StatusOrders = 5 WHERE IdAccount = $id_User ";
        return pdo_Execute($sql);
    }

    function loginNhanh_Order_DangXacNhan($idAccount){
        $sql ="SELECT  orders.*,order_pro.*,product.*
        FROM orders 
        INNER JOIN order_pro ON orders.IdOrder= order_pro.IdOrder
        INNER JOIN product ON product.IdProduct= order_pro.IdProduct
        WHERE IdAccount = $idAccount 
            AND orders.StatusOrders = 5  
        ";
    return query_All($sql);
    }
    