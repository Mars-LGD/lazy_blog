<?php
/**
 * 创建连接
 */
function db($name = 'default') {
	if (PRODUCTION == false) {
		$config = $GLOBALS ['config'] ['db'] ['test'];
	} else {
		$config = $GLOBALS ['config'] ['db'] [$name];
	}
	$host = $config ['host'];
	$port = $config ['port'];
	$user = $config ['user'];
	$password = $config ['password'];
	$db_name = $config ['db_name'];
	$db_key = MD5 ( $host . '-' . $port . '-' . $user . '-' . $password . '-' . $db_name );
	if (! isset ( $GLOBALS ['DB_' . $db_key] )) {
		$con = mysql_connect ( $host . ':' . $port, $user, $password, true );
		if ($con && mysql_selectdb ( $db_name )) {
			@mysql_query ( 'SET NAMES UTF8' );
			$GLOBALS ['DB_' . $db_key] = $con;
		} else {
			throw new Exception ( "Cannot connect to db" );
		}
	}
	return $GLOBALS ['DB_' . $db_key];
}
/**
 * 格式化sql语句中的特殊字符
 */
function s($str, $db = NULL) {
	if ($db == NULL)
		$db = db ();
	return mysql_real_escape_string ( $str, $db );
}
/**
 * 获取多行数据，返回二维数组
 */
function get_data($sql, $db = NULL) {
	if ($db == NULL)
		$db = db ();
	
	$data = Array ();
	$i = 0;
	$result = mysql_query ( $sql, $db );
	
	if (mysql_errno () != 0)
		echo mysql_error () . ' ' . $sql;
	
	while ( $Array = mysql_fetch_array ( $result, MYSQL_ASSOC ) ) {
		$data [$i ++] = $Array;
	}
	
	if (mysql_errno () != 0)
		echo mysql_error () . ' ' . $sql;
	
	mysql_free_result ( $result );
	
	if (count ( $data ) > 0)
		return $data;
	else
		return false;
}
/**
 * 获取单行数据
 */
function get_line($sql, $db = NULL) {
	$data = get_data ( $sql, $db );
	return @reset ( $data );
}
/**
 * 获取变量值
 */
function get_var($sql, $db = NULL) {
	$data = get_line ( $sql, $db );
	return $data [@reset ( @array_keys ( $data ) )];
}
/**
 * 获取最新id
 */
function last_id($db = NULL) {
	if ($db == NULL)
		$db = db ();
	return get_var ( "SELECT LAST_INSERT_ID() ", $db );
}
/**
 * 执行sql语句
 */
function run_sql($sql, $db = NULL) {
	if ($db == NULL)
		$db = db ();
	return mysql_query ( $sql, $db );
}
function db_errno($db = NULL) {
	if ($db == NULL)
		$db = db ();
	return mysql_errno ( $db );
}
function db_error($db = NULL) {
	if ($db == NULL)
		$db = db ();
	return mysql_error ( $db );
}

?>
