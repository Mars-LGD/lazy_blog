<?php
include 'init.php';
include SROOT . 'categoryService.class.php';
include SROOT . 'articleService.class.php';

$method = v ( 'method' );
if (! $method) {
	send_result ( 0, "request does not have method parame" );
}

$service = new CategoryService ();
if ($method == 'delete') {
	if (v ( 'id' )) {
		$service->delete ( v ( 'id' ) );
		$service->staticCategoryJs ();
		forward ( 'category_list.php' );
	} else {
		send_result ( 0, 'request does not have id parame' );
	}
} else if ($method == 'add') {
	if (v ( 'name' ) && v ( 'description' )) {
		$service->insert ( v ( 'name' ), v ( 'description' ) );
		$service->staticCategoryJs ();
		forward ( 'category_list.php' );
	} else {
		send_result ( 0, 'request does not have name or description parames' );
	}
} else if ($method == 'update') {
	if (v ( 'id' ) && v ( 'name' ) && v ( 'description' )) {
		if ($service->update ( v ( 'id' ), v ( 'name' ), v ( 'description' ) )) {
			$service->staticCategoryJs ();
			$categoryData = array (
					'id' => v ( 'id' ),
					'name' => v ( 'name' ),
					'description' => v ( 'description' ) 
			);
			$articleService = new ArticleService ();
			$articleService->staticArticleList ( $categoryData );
		}
		forward ( 'category_list.php' );
	} else {
		send_result ( 0, 'request does not have name or description or id parames' );
	}
}
send_result ( 0, "request does not have correct method parame" );
