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

    function loginNhanh_Check_Cart($idAccount,$idProduct){
        $sql="SELECT * FROM `cart` WHERE IdAccount ='$idAccount' AND IdProduct = '$idProduct' ";
        return query_One($sql);
    }
    /**
     * Dành cho Đặt trực tiếp tại quán
     * update lại số lượng, giá, tên size khi sản phẩm đã có trong giỏ hàng
     *    => ví dụ người dùng mua có và giờ người dùng tiếp tục mua cá 
     * check qua 2 trường IdAccount và IdProduct. ko cần check time vì khi thanh toán xong thì giỏ hàng sẽ bị xóa
     * 
     */
    function loginNhanh_Cart_Update_Price_The_SameAs($IdCart,$SizeProduct,$Quantity,$PriceProduct){
        $sql = "SELECT * FROM cart WHERE IdCart = $IdCart";
        $arrOneCart = query_One($sql);
        $New_Quantity = $arrOneCart['Quantity'] + $Quantity ;
        $New_PriceProduct= $arrOneCart['PriceCard'] + $PriceProduct;
        // xem Name của size có ch, nếu chưa thì nối chuỗi vào Size (VARCHAR) =>> vào kiểu dữ liệu Size trong bảng Cart
        if(strstr($arrOneCart['Size'],$SizeProduct)== false){
            $New_Size = $arrOneCart['Size'].','.$SizeProduct;
        }else{
            $New_Size =$arrOneCart['Size'];
        }
        
        $sql = "UPDATE cart SET Size = '$New_Size', PriceCard ='$New_PriceProduct', Quantity = '$New_Quantity' WHERE IdCart = $IdCart";
        var_dump($sql);
        return pdo_Execute($sql);
    }

    function loginNhanh_Add_To_Order($idAccount){
        $sql = " SELECT * FROM cart WHERE IdAccount = '$idAccount'";
        $arrOrder_IdAccount = query_All($sql) ;

        $orderPrice = 0;
        foreach($arrOrder_IdAccount as $i){
            $orderPrice += $i['PriceCard'];
        }

        $sql = "INSERT INTO orders(PriceOrders) VALUE ($orderPrice) ";
        return pdo_Execute($sql);
    }

    function loginNhanh_Update_Order($idAccount){
        $sql = " SELECT * FROM cart WHERE IdAccount = '$idAccount'";
        $arrOrder_IdAccount = query_All($sql) ;

        $orderPrice = 0;
        foreach($arrOrder_IdAccount as $i){
            $orderPrice += $i['PriceCard'];
        }

        $sql = "UPDATE orders SET PriceOrders = '$orderPrice' WHERE IdAccount = $idAccount ";
        return pdo_Execute($sql);
    }

    function loginNhanh_Check_Order($idAccount){
        $sql = " SELECT * FROM orders WHERE IdAccount = '$idAccount'";
        return query_One($sql);
    }

    function loginNhanh_Cart_GetAllCartByIdAccount($idAccount){
        $sql ="SELECT * FROM cart WHERE IdAccount = $idAccount ";
        return query_One($sql);
    }