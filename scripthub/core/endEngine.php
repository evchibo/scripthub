<?
/**
 * Copyright (c) 2018.
 * KarmaTechs
 * Evan Karma Alias MADSkill
 * madskill.madskill@gmail.com
 * https://sociamater.com
 */

if (isset ( $_GET ['module'] ) && isset ( $_GET ['controller'] )) {
	
	//load administration...
	if (isAdministration ( $_GET ['module'] )) {
		define ( "inc", ENGINE_PATH . '/administration/controllers/' . $_GET ['controller'] . '.php' );
	} else {
		define ( "inc", ROOT_PATH . '/scripthub/apps/' . $_GET ['module'] . '/controllers/' . $_GET ['controller'] . '.php' );
	}
	
	if (file_exists ( inc )) {
		include_once (inc);
	} else {		
		//load index.php
		define ( "inc2", ROOT_PATH . '/scripthub/apps/' . $_GET ['module'] . '/controllers/index.php' );
		if (file_exists ( inc2 )) {
			include_once (inc2);
		} else {
		header("HTTP/1.0 404 Not Found");
        header("Location: http://". DOMAIN ."/error");			 
		}
	}
} elseif (isset ( $_GET ['module'] )) {
	
	//load administration
	if (isAdministration ( $_GET ['module'] )) {
		define ( "inc", ENGINE_PATH . '/administration/controllers/index.php' );
	} else {
		define ( "inc", ROOT_PATH . '/scripthub/apps/' . $_GET ['module'] . '/controllers/index.php' );
	}
	
	if (file_exists ( inc )) {
		
		include_once (inc);
	
	} else {		
	/**
	 * redirect to 404 page
	 */
		header("HTTP/1.0 404 Not Found");
        header("Location: http://". DOMAIN ."/error");
	}
} else {

	$_GET ['module'] = 'index';
	include_once (ROOT_PATH . "/scripthub/apps/index/controllers/index.php");
}

/*
 * smarty display
 */

if($_templateFile == '') {
	$_templateFile = ROOT_PATH.'scripthub/apps/index/views/index.html';
	abr ( 'content_template', $_templateFile );		
}

if ($_templateFile != '') {	
	restore_error_handler ();
	flush ();

	$smarty->display ( TEMPLATE_PATH . $_layoutFile . ".html" );
	
} else {

}
#END;


/*
 * debug
 */
include_once ('system/debug.php');

/*
 * close mysql connection
 */
if (isset ( $mysql )) {
	$mysql->close ();
}
?>