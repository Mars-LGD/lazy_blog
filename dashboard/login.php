<?php
include '..' . DIRECTORY_SEPARATOR . 'init.php';
include SROOT . 'userService.class.php';

session_set_cookie_params(60*60*6);
@session_start();

if (v ( "username" ) && v ( "password" )) {
	$service = new UserService ();
	if ($service->login ( v ( "username" ), v ( "password" ) )) {
		header ( "Location: category_list.php" );
    }else{
        render('login');
    }
} else {
	render ( "login" );
}
