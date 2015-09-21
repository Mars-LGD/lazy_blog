<?php
require_once (LROOT . 'db.function.php');

/**
 * Category Management
 *
 * @author zhanghengmao
 *        
 */
class CategoryService {
	
	/**
	 * add category
	 */
	function insert($name, $description) {
		$sql = "insert into category (name,description,utime) values('$name','$description',current_timestamp())";
		return run_sql ( $sql );
	}
	
	/**
	 * update category
	 */
	function update($id, $name, $description) {
		$sql = "update category set name='$name',description='$description',utime=current_timestamp() where id=$id";
		return run_sql ( $sql );
	}

	/**
	 * get category detail by id
	 */
	function findById($id) {
		$sql = "select * from category where id=$id";
		return get_line ( $sql );
	}
	
	/**
	 * delete category
	 */
	function delete($id) {
		$sql = "delete from category where id=$id";
		return run_sql ( $sql );
	}
	
	/**
	 * get category list
	 */
	function getAll() {
		$sql = "select * from category";
		return get_data ( $sql );
	}
	
	/**
	 * sattic category list
	 */
	function staticCategoryJs() {
		$category_list = $this->getAll ();
		// 静态化文章
		$data = array (
				'category_list' => $category_list 
		);
		staticTemplate ( $GLOBALS ['config'] ['category'] ['js_template'], $GLOBALS ['config'] ['category'] ['dir'] . 'category.js', $data );
	}
}
?>
