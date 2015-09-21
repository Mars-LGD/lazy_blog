<?php
include '..' . DIRECTORY_SEPARATOR . 'init.php';
include SROOT . 'articleService.class.php';

$article_service = new ArticleService ();
$article_list = $article_service->getAll ( ARTICLE_PUBLISH, v ( 'cid' ) ? v ( 'cid' ) : null, v ( 'page' ) ? v ( 'page' ) : null );
if($article_list){
    send_result ( 1, $article_list );
}else{
    send_result (0,'empty data');
}
