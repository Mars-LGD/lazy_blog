<?php
include '../init.php';
require_once(SROOT.'articleService.class.php');
require_once(SROOT.'categoryService.class.php');

$as=new ArticleService();
$as->staticIndex();

$cs=new CategoryService();
$cs->staticCategoryJs();
$cList=$cs->getAll();
foreach($cList as $row){
    $as->staticArticleList($row);
}
$aList=$as->getAll(1);
foreach($aList as $row){
    $as->staticArticle($row['id']);
}
