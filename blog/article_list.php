<?php
include '..' . DIRECTORY_SEPARATOR . 'init.php';
include SROOT . 'articleService.class.php';
include SROOT . 'categoryService.class.php';

$article_service = new ArticleService ();
$article_list = $article_service->getAll ( ARTICLE_PUBLISH, v ( 'cid' ) ? v ( 'cid' ) : null, v ( 'page' ) ? v ( 'page' ) : 0 );
$data = Array (
		'article_list' => $article_list 
);
render ( $GLOBALS ['config'] ['article'] ['list_template'], $data );
