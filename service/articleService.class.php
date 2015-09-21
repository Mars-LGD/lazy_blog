<?php
require_once (LROOT . 'db.function.php');

/**
 * Article Management
 *
 * @author zhanghengmao
 *        
 */
class ArticleService {
	
	//=============================文章保存、修改、删除操作===================================
	
	/**
	 * 添加文章，保存为草稿
	 */
	function save($title, $abstract, $content, $cid, $type) {
		$sql = "insert into article (title,abstract,content,status,cid,type,utime) values('$title','" . $abstract . "','" . s ( $content ) . "',0,$cid,$type,current_timestamp())";
		return run_sql ( $sql );
	}
	
	/**
	 * 更新文章内容，但不会更新状态（草稿、发表）
	 */
	function update($id, $title, $abstract, $content, $cid,$type) {
		$sql = "update article set title='$title',abstract='$abstract',content='".s($content)."',cid='$cid',type=$type,utime=current_timestamp() where id=$id";
		return run_sql ( $sql );
	}
	
	/**
	 * 彻底删除文章
	 */
	function delete($id) {
		$sql = "delete from article where id=$id";
		return run_sql ( $sql );
	}
	
	//=============================文章状态（草稿、发表、回收站）更改接口===================================
	
	/**
	 * 删除文章，文章自动进入回收站
	 */
	function trash($id) {
		$sql = "update article set status=-1 where id=$id";
		return run_sql ( $sql );
	}
	
	/**
	 * 发表草稿，更新文章状态
	 */
	function publish($id) {
		$sql = "update article set status=1 where id=$id";
		return run_sql ( $sql );
	}
	
	/**
	 * 将文章状态修改为草稿
	 */
	function draft($id) {
		$sql = "update article set status=0 where id=$id";
		return run_sql ( $sql );
	}
	
	
	//=============================获取文章列表===================================
	/**
	 * 获取文章列表
	 */
	function getAll($status, $cid = null, $page = null) { $sql = "select id,cid,title,abstract,ctime,utime from article where status=$status";
		if (isset ( $cid )) {
			$sql .= " and cid=$cid";
		}
		$sql .= ' order by id desc';
		if (isset ( $page )) {
			$size = $GLOBALS ['config'] ['article'] ['list_size'];
			$start = $page * $size;
			$sql .= " limit $start,$size";
		}
		return get_data ( $sql );
	}
	
	/**
	 * 搜索文章(只针对已发表文章)
	 */
	function search($keywords, $cid = null) {
        foreach($keywords as $keyword){
           $q1.=" content like '%$keyword%' and"; 
           $q2.=" abstract like '%$keyword%' and"; 
           $q3.=" title like '%$keyword%' and"; 
        }
        $q1=substr($q1, 0, -3);
        $q2=substr($q2, 0, -3);
        $q3=substr($q3, 0, -3);
		$sql = "select id,cid,title,abstract,ctime,utime from article where (($q3) or ($q2) or ($q1))";
		if (isset ( $cid )) {
			$sql .= " and cid=$cid";
        }
		$sql .= " order by ((CASE WHEN ($q3) THEN 5 ELSE 0 END) + (CASE WHEN ($q2) THEN 2 ELSE 0 END) + (CASE WHEN ($q3) THEN 1 ELSE 0 END)) DESC";
        return get_data($sql);
    }
	/**
	 * 根据文章Id获取文章详情
	 */
	function findById($id) {
		$sql = "select * from article where id=$id";
		return get_line ( $sql );
	}
	
	
	//=============================文章静态化===================================
	/**
	 * 静态化文章列表页
	 */
	function staticArticleList($category) {
		$cid = $category ['id'];
		$article_list = $this->getAll ( 1, $cid, 0 );
		// 静态化分类文章
		$data = array (
				'cid' => $cid,
				'category_name' => $category ['name'],
				'description' => $category ['description'] 
		);
        if($article_list){
            $data['article_list']=$article_list;
        }
		staticTemplate ( $GLOBALS ['config'] ['article'] ['list_template'], $GLOBALS ['config'] ['category'] ['dir'] . $cid . '.html', $data );
	}
	
	/**
	 * 静态化首页
	 */
	function staticIndex() {
		// 静态化首页
		$article_list = $this->getAll ( 1, null, 0 );
		$data = array (
				'category_name' => $GLOBALS ['config'] ['index'] ['category_name'],
				'description' => $GLOBALS ['config'] ['index'] ['description'] 
		);
        if($article_list){
            $data['article_list']=$article_list;
        }
		staticTemplate ( $GLOBALS ['config'] ['article'] ['list_template'], $GLOBALS ['config'] ['index'] ['template_address'], $data );
	}
	
	/**
	 * 静态化文章详情页
	 */
	function staticArticle($id) {
		$data = $this->findById ( $id );
        if($data){
            staticTemplate ( $GLOBALS ['config'] ['article'] ['detail_template'], $GLOBALS ['config'] ['article'] ['dir'] . $id . '.html', $data );
        }
    }
}
?>
