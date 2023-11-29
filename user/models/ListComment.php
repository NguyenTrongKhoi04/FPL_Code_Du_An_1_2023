<?php 
function ListComment_GetAllComment($idAccountUser){
    return query_All("select 
    p.NameProduct,  p.ImageProduct,
    co.IdComment, co.Content
    from comment co
    join product p on co.IdProduct = p.IdProduct
    where co.StatusComment = 0
    ");
}

function ListComment_DeleteComment($IdComment){
    return query_One("update comment set StatusComment = 1 where IdComment = $IdComment");
}
function ListComment_UpdateComment($IdComment, $Content){
    return query_One("update comment set Content = $Content where IdComment = $IdComment");
}
?>