<?php
include 'init.php';
include SROOT . 'articleService.class.php';

$service = new ArticleService ();
$status = isset($_GET['status']) ? v('status') : 1;
$result = $service->getAll ( $status );
if($result){
    $data = Array (
        'result' => $result,
    	'status' => $status 
    );
    render ( 'article.list', $data );
}else{
    $data = Array ('status' => $status);
    render ('article.list',$data);
}
