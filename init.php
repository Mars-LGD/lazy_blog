<?php
define( 'DS' , DIRECTORY_SEPARATOR );
define( 'AROOT' , dirname( __FILE__ ) . DS  );
define( 'LROOT' , dirname( __FILE__ ) . DS . 'lib' .DS  );
define( 'CROOT' , dirname( __FILE__ ) . DS . 'config' .DS  );
define( 'SROOT' , dirname( __FILE__ ) . DS . 'service' .DS  );

// environment handle
define( 'PRODUCTION' ,false);

// error handle
error_reporting(E_ALL^E_NOTICE);
PRODUCTION ==true?ini_set( 'display_errors' , false ):ini_set( 'display_errors' , true );

// include config file
include CROOT.'app.config.php';
// include app funtion
include LROOT.'app.function.php';
