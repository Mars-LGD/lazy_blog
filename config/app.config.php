<?php
// db配置
$GLOBALS ['config'] ['db'] ['default'] = array (
		"user" => "root",
		"password" => "",
		"host" => "localhost",
		"port" => "3306",
		"db_name" => "lazy_blog" 
);

$GLOBALS ['config'] ['db'] ['test'] = array (
		"user" => "root",
		"password" => "",
		"host" => "localhost",
		"port" => "3306",
		"db_name" => "lazy_blog" 
);

// 静态文件生成地址
$GLOBALS ['config'] ['article'] ['dir'] = AROOT . 'article/';
$GLOBALS ['config'] ['category'] ['dir'] = AROOT . 'category/';
// 文章详情模板
$GLOBALS ['config'] ['article'] ['detail_template'] = 'article.static.detail';
// 文章列表模板
$GLOBALS ['config'] ['article'] ['list_template'] = 'article.static.list';
// category js template
$GLOBALS ['config'] ['category'] ['js_template'] = 'category.static.js';
// 模板article list大小
$GLOBALS ['config'] ['article'] ['list_size'] = 5;

// 首页标语
$GLOBALS ['config'] ['index'] ['category_name'] = 'Lazy Blog';
$GLOBALS ['config'] ['index'] ['description'] = '懒人博客，聚沙成塔，积少成多';
$GLOBALS ['config'] ['index'] ['template_address'] = AROOT . 'view/index.html';

// 文章发布、回收、草稿
define ( 'ARTICLE_PUBLISH', 1 );
define ( 'ARTICLE_TRASH', - 1 );
define ( 'ARTICLE_DRAFT', 0 );
