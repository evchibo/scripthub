<?
/**
 * Copyright (c) 2018.
 * KarmaTechs
 * Evan Karma Alias MADSkill
 * madskill.madskill@gmail.com
 * https://sociamater.com
 */

/*
 * Check is site config file loaded?
 */
if (!isset($config)) {
	die(" error: Please set up your config file!");
}

/*
 * System defines
 */
define("DOMAIN", $config['domain']);
define("ENGINE_PATH", $config['scripthub_core']);
define("ROOT_PATH", $config['root_path']);
define("CACHE", ENGINE_PATH . "/data/cache/");
define("DATA_SERVER_PATH", $config['data_server_path']);
define("DATA_SERVER", $config['data_server']);
define("TEMPLATE_PATH", ROOT_PATH . "/scripthub/HTML/");
define("VERSION", '2.2.2b');
#END;


/*
 * php ini sets
 */
ini_set ( "session.cookie_domain", "." . DOMAIN );
ini_set ( "session.save_path", CACHE . "/session/" );
ini_set ( "session.use_only_cookies", true );
ini_set ( "session.use_trans_sid", false );
ini_set ( "arg_separator.output", "&amp;" );
ini_set ( 'register_globals', "Off" );
ini_set ( 'allow_url_fopen', "Off" );
ini_set ( 'magic_quotes_gpc', "Off" );
ini_set ( 'magic_quotes_runtime', "Off" );
date_default_timezone_set ( "Europe/Sofia" );

error_reporting ( E_ALL );
#END;


/*
 * INCLUDE FILES
 */
include_once ENGINE_PATH . '/system/functions.php';
include_once ENGINE_PATH . '/system/core.functions.php';
include_once ENGINE_PATH . '/system/core.security.php';
include_once ENGINE_PATH . '/system/core.template.php';
#END;


/**
 * execute time php debug
 */
if (check_debug ()) {
	$execute = new execute();
	$execute->start(1);
	
	/*
	 * Debug container!
	 */
	$debug = '<B>Debug container:</B><BR />';	
}
#END;

/*
 * CACHE
 */
$cache = new cache ( );
$cache->cacheDir = CACHE;
global $cache;

/*
 * SESSION
 */
$session = new session ( );

/*
 * MySQL Connect
 */
$mysql = new mysql ( $config ['mysql_user'], $config ['mysql_pass'], $config ['mysql_db'], $config ['mysql_host'] );
global $mysql;


/*
 * Smarty Settings
 */
$_layoutFile = 'index'; 
$_templateFile = ''; 

define ( 'SMARTY_DIR', ENGINE_PATH . "classes/Smarty/" );

include_once (SMARTY_DIR . "Smarty.class.php");
$smarty = new Smarty ( );
$smarty->compile_dir = CACHE . "/templates_cache/";
$smarty->compile_check = true;
$smarty->debugging = false;

abr ( 'domain', DOMAIN );
abr ( "root_path", ROOT_PATH );
abr ( "data_server", $config ['data_server'] );
$smarty->register_function ( 'createEditor', 'createTextAreaEditor' ); 

global $smarty;
#END;

/*
 * Read flash message in $_SESSION
 */
if ($message = getRefreshMessage ()) {
	addErrorMessage ( $message['title'], $message['text'], $message['type'] );
}

/*
 * Set the default paging variables
 * LIMIT = 10 
 */
if (! defined ( 'LIMIT' )) {
	define ( 'LIMIT', 10, true );
}
if (isset ( $_GET ['p'] ) && is_numeric ( $_GET ['p'] ) && $_GET ['p'] > 1) {
	define ( 'PAGE', intval ( $_GET ['p'] ) );
	define ( 'START', (PAGE - 1) * LIMIT );
} else {
	define ( 'PAGE', 1 );
	define ( 'START', 0 );
}
#END;

define ( 'adminURL', 'admin' );

include_once ENGINE_PATH . '/system/core.url.php';
include_once ENGINE_PATH . '/system/core.languages.php';

?>