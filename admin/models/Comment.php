<?php

function getCmProduct(){
    $sql= "select * from product";
    return query_All($sql);  
}

function getCmAccount(){
    $sql= "select * from account";
    return query_All($sql);  
}


// Toàn văn
// IdComment	
// IdAccount	
// IdProduct	
// Content	
// StatusComment	
// DateEditComment	
//IdComment	IdAccount	IdProduct	Content	StatusComment	DateEditComment	

function getListComment(){
    
    $sql ='
    select cm.*,pr.*,ac.* from comment cm 
     join product pr on cm.IdProduct = pr.IdProduct
     join account ac on cm.IdAccount = ac.IdAccount;
    ';
    return query_All($sql);
}

/**
 * $idProduct: Id của sản phẩm được truyền vào 

 * */ 
function deleteComment($IdComment){
    $sql = "delete from comment where IdComment = $IdComment";
    return pdo_Execute($sql);
}

function updateComment($dataComment, $IdComment){
    extract($dataComment);

    $sqlComment = "
    update comment set IdAccount  = '$IdAccount',IdProduct = '$IdProduct', Content = '$Content',
    StatusComment = '$StatusComment'
    where IdComment = '$IdComment'
    ";
    
    return pdo_Execute($sqlComment);
}

function getComment($IdComment){
    $sql = " select cm.*,pr.*,ac.* from comment cm 
    join product pr on cm.IdProduct = pr.IdProduct
    join account ac on cm.IdAccount = ac.IdAccount;
     where cm.IdComment = $IdComment
    ";
    
    return query_All($sql);
}



?>