<?php
include '..' . DIRECTORY_SEPARATOR . 'init.php';

session_set_cookie_params(60*60*6);
@session_start ();

if (! isLogin ()) {
	render ( 'login' );
}
