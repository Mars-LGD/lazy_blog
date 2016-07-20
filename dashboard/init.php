<?php
include '..' . DIRECTORY_SEPARATOR . 'init.php';

@session_start ();

if (! isLogin ()) {
	render ( 'login' );
}
