<?php
include 'init.php';
require_once (SROOT . 'articleService.class.php');
require_once (SROOT . 'categoryService.class.php');

$method = v ( 'method' );
if (! $method) {
	send_result ( 0, "request does not have method parame" );
}

$service = new ArticleService ();
$categoryService = new CategoryService ();
if ($method == 'delete') {
	if (v ( 'id' ) && isset($_REQUEST['status'])) {
		if ($_REQUEST['status'] == -1) {
			$flag = $service->delete ( v ( 'id' ) );
		} else {
			$flag = $service->trash ( v ( 'id' ) );
		}
		
		if ($flag) {
			// 静态化文章，及更新列表
			$service->staticArticle ( $id );
			$category = $categoryService->findById ( v ( 'cid' ) );
			$service->staticArticleList ( $category );
			$service->staticIndex ();
		}
		forward ( 'article_list.php?status='.$_REQUEST['status'] );
	} else {
		send_result ( 0, 'request does not have id ro status parame' );
	}
} else if ($method == 'draft') {
	if (v ( 'cid' ) && v ( 'type' ) && v ( 'title' ) && v ( 'content' ) && v ( 'abstract' )) {
		if (v ( 'id' )) {
			// 文章更新
			$id = v ( 'id' );
			if ($service->update ( $id, v ( 'title' ), v ( 'abstract' ), v ( 'content' ), v ( 'cid' ), v ( 'type' ) )) {
				if ($service->draft ( $id )) {
					// 静态化文章，及更新列表
					$service->staticArticle ( $id );
					$category = $categoryService->findById ( v ( 'cid' ) );
					$service->staticArticleList ( $category );
					$service->staticIndex ();
				}
			}
		} else {
			if ($service->save ( v ( 'title' ), v ( 'abstract' ), v ( 'content' ), v ( 'cid' ), v ( 'type' ) )) {
				// 静态化文章，及更新列表
				$service->staticArticle ( $id );
				$category = $categoryService->findById ( v ( 'cid' ) );
				$service->staticArticleList ( $category );
				$service->staticIndex ();
			}
		}
		forward ( 'article_list.php?status=0' );
	} else {
		send_result ( 0, 'request does not have title,abstract,content,id,cid parames' );
	}
} else if ($method == 'edit') {
	if (v ( 'id' )) {
		$article = $service->findById ( v ( 'id' ) );
		$result = $categoryService->getAll ();
		$data = Array (
				'category_data' => $result 
		);
		if ($article) {
            // 避免pre中的<>字符与编辑器冲突
            $article['content']=str_replace('&gt;','&amp;gt;',$article['content']);
            $article['content']=str_replace('&lt;','&amp;lt;',$article['content']);
			$data ['article'] = $article;
		}
		render ( 'article.edit', $data );
	} else {
		$result = $categoryService->getAll ();
		$data = Array (
				'category_data' => $result 
		);
		render ( 'article.edit', $data );
	}
} else if ($method == 'publish') {
	if (v ( 'cid' ) && v ( 'type' ) && v ( 'title' ) && v ( 'content' ) && v ( 'abstract' )) {
		if (v ( 'id' )) {
			// 文章更新
			$id = v ( 'id' );
			if ($service->update ( $id, v ( 'title' ), v ( 'abstract' ), v ( 'content' ), v ( 'cid' ), v ( 'type' ) )) {
				if ($service->publish ( $id )) {
					// 静态化文章，及更新列表
					$service->staticArticle ( $id );
					$category = $categoryService->findById ( v ( 'cid' ) );
					$service->staticArticleList ( $category );
					$service->staticIndex ();
				}
			}
		} else {
			if ($service->save ( v ( 'title' ), v ( 'abstract' ), v ( 'content' ), v ( 'cid' ), v ( 'type' ) )) {
				$id = last_id ();
				if ($service->publish ( $id )) {
					// 静态化文章，及更新列表
					$service->staticArticle ( $id );
					$category = $categoryService->findById ( v ( 'cid' ) );
					$service->staticArticleList ( $category );
					$service->staticIndex ();
				}
			}
		}
		forward ( 'article_list.php' );
	} else {
		send_result ( 0, 'request does not have title,abstract,content,id,cid parames' );
	}
}
send_result ( 0, "request does not have correct method parame" );
