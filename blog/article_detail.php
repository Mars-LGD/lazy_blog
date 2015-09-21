<?php
include '..' . DIRECTORY_SEPARATOR . 'init.php';
include SROOT . 'articleService.class.php';

$service = new ArticleService ();
if (v ( 'id' )) {
	$data = $service->findById ( v ( 'id' ) );
	render ( $GLOBALS ['config'] ['article'] ['detail_template'], $data );
} else {
	send_result ( 0, 'request does not have id parames' );
}
