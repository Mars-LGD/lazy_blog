<?php
include '..' . DIRECTORY_SEPARATOR . 'init.php';
include SROOT . 'articleService.class.php';

$article_service = new ArticleService ();
$keyword=v('keyword');
if ($keyword && !empty($keyword)){
    // 替代空格,换行,tab,中文空格
    $keyword = preg_replace("/(\s+)|(　+)+/",' ', $keyword);
    // 去除首尾空格
    $keyword = preg_replace( "/(^\s*)|(\s*$)/", "",$keyword);
    // 枚举关键字
    $keywords = explode(' ',$keyword);
    $article_list = $article_service->search ( $keywords,v ( 'cid' ) ? v ( 'cid' ):null);
}else{
    send_result(0,'no keyword');
}
if($article_list){
    send_result ( 1, $article_list );
}else{
    send_result (0,'empty data');
}
