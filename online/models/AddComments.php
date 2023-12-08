<?php 
function AddComments_GetComment($IdAccount)
{   
    return query_All("select 
                p.NameProduct,  p.ImageProduct,  p.IdProduct, op.IdOrder_Pro
                from orders o
                join order_pro op on op.IdOrder = o.IdOrder
                join product p on op.IdProduct = p.IdProduct
                where o.IdAccount = '$IdAccount' and o.StatusOrders = 3 and o.PaymentMethod != 0 and op.StatusOrders = 0 ");
}

function AddComments_AddComment($IdProduct, $IdAccount, $data, $IdOrder)
{
    extract($data);
    $time = new DateTime();
    $time->setTimezone(new DateTimeZone("Asia/Ho_Chi_Minh"));
    $realTime = $time->format('Y-m-d\TH:i');
    pdo_Execute("insert into comment values(null, '$IdAccount', '$IdProduct', '$content', 0, '$realTime')");
    pdo_Execute("update order_pro set StatusOrders = 1 where IdOrder_Pro = $IdOrder");

}
?>