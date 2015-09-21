<?php
include '..' . DIRECTORY_SEPARATOR . 'init.php';
include SROOT . 'userService.class.php';

if (v ( "username" ) && v ( "password" )) {
	$service = new UserService ();
	@session_start ();
	if ($service->login ( v ( "username" ), v ( "password" ) )) {
		header ( "Location: category_list.php" );
	}
} else {
	render ( "login" );
}
