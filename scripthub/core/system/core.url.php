<?
/**
 * Copyright (c) 2018.
 * KarmaTechs
 * Evan Karma Alias MADSkill
 * madskill.madskill@gmail.com
 * https://sociamater.com
 */

/*
 * Sets module and controller
 */
if (isset ( $_GET ['url'] )) {
	$_GET ['array_url'] = explode ( "/", $_GET ['url'] );
	
	//This sets language in URL /bg/module/page
	if (! isset ( $_GET ['array_url'] [0] ) || strlen ( $_GET ['array_url'] [0] ) != 2) {
		$_moduleOffset = 0;
		$_controllerOffset = 1;
	} else {
		$_GET ['language'] = $_GET ['array_url'] [0];
		$_moduleOffset = 1;
		$_controllerOffset = 2;
	}
	#####################################################################
	
	//Check if not set module, set the default module /scripthub/apps/index/
	if (isset ( $_GET ['array_url'] [$_moduleOffset] )) {
		if ($_GET ['array_url'] [$_moduleOffset] != "") {
			$_GET ['module'] = $_GET ['array_url'] [$_moduleOffset];
		} else {
			$_GET ['module'] = "index";
		}
	
	}
	
	//Check if not set controller, set the default controller to index
	if (isset ( $_GET ['array_url'] [$_controllerOffset] )) {
		if ($_GET ['array_url'] [$_controllerOffset] != "") {
			$_GET ['controller'] = $_GET ['array_url'] [$_controllerOffset];
		} else {
			$_GET ['controller'] = 'index';
		}
	}	
}

//Pre-check module and controller
if (! isset ( $_GET ['module'] )) {
	$_GET ['module'] = 'index';
}
if (! isset ( $_GET ['controller'] )) {
	$_GET ['controller'] = 'index';
}

//Clear module and controller input from hacks
if (isset ( $_GET ['module'] )) {
	if (! (preg_match ( "/[a-z_0-9.\/-]*/i", $_GET ['module'] ) && ! preg_match ( "/\\.\\./", $_GET ['module'] ))) {
		die ( "Invalid request for MODULE" );
	}
}
if (isset ( $_GET ['controller'] )) {
	if (! (preg_match ( "/[a-z_ а-я0-9.\/-]*/iu", $_GET ['controller'] ) && ! preg_match ( "/\\.\\./", $_GET ['controller'] ))) {
		die ( "Invalid request for CONTROLLER" );
	}
}

?>