<?php 
function BillPayment_GetOrderPayment($IdAccount)
{   
    return query_All("select 
                o.IdOrder, o.IdTable, o.PaymentMethod, o.OrderDate, o.PriceOrders,
                op.IdProduct, op.QuantityOrderPro,
                p.NameProduct,  p.PriceProduct,  
                t.NumberTable, ac.NameAccount
                from orders o
                join order_pro op on op.IdOrder = o.IdOrder
                join product p on op.IdProduct = p.IdProduct
                join tables t on o.IdTable = t.IdTables
                join account ac on ac.IdAccount = o.IdAccount
                where o.IdAccount = '$IdAccount' and o.StatusOrders = 2 and o.PaymentMethod != 0");
     
}
?>