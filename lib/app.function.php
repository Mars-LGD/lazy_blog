<?php
/**
 * 获取请求变量
 */
function v($str) {
	return isset ( $_REQUEST [$str] ) ? $_REQUEST [$str] : false;
}

/**
 * 页面渲染
 */
function render($layout = NULL, $data = NULL, $termination = true) {
	if ($layout == NULL) {
		send_result ( 0, "html template dose not exist" );
	}
	$layout_file = AROOT . 'view/' . $layout . '.tpl.html';
	if (file_exists ( $layout_file )) {
		@extract ( $data );
		require ($layout_file);
		if ($termination) {
			die ();
		}
	} else {
		send_result ( 0, "html template dose not exist" );
	}
}

/**
 * 重定向
 */
function forward($url) {
	header ( "Location:$url" );
	die ();
}

/**
 * 检查是否登录
 */
function isLogin() {
	return @$_SESSION ['level'] > 0 ? true : false;
}

/**
 * 注销
 */
function logout() {
	@$_SESSION ['level'] = 0;
}

/**
 * 返回json结果
 */
function send_result($status, $result) {
	$obj = array ();
	$obj ['status'] = $status;
	$obj ['result'] = $result;
	die ( json_encode ( $obj ) );
}
/**
 * 静态化
 */
function staticTemplate($template, $dest, $data = array()) {
	ob_start ();
	render ( $template, $data, false );
	$out = ob_get_contents ();
	ob_end_clean ();
	$fp = fopen ( $dest, "w" );
	fwrite ( $fp, $out );
	fclose ( $fp );
}
