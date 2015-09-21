<?php

/**
 * 用户管理
 * 
 * @author zhanghengmao
 *
 */
class UserService {
	
	/**
	 * 登录，返回是否成功
	 */
	function login($username, $pwd) {
		if ($username == 'admin' && $pwd == 'admin') {
			$_SESSION ['level'] = 1;
			return true;
		} else {
			return false;
		}
	}
}
?>
