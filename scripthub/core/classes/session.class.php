<?
/**
 * Copyright (c) 2018. 
 * KarmaTechs
 * Evan Karma Alias MADSkill
 * madskill.madskill@gmail.com
 * https://sociamater.com
 */

class session {
	
	function __construct($expire_time = '') {
		/*
		 * fix errors
		 */
		if (! isset ( $_SERVER ['HTTP_USER_AGENT'] ) || $_SERVER ['HTTP_USER_AGENT'] == '') {
			//die ( 'Your user agent is not set!' );
		}
		
		session_start ();// or die ( "Session start error!" );
		
		return true;
	}
	
	function logout() {
		global $cache;
		/*
		 * @todo fix this!
		 */
		session_regenerate_id ();
		$_SESSION = array ();
		session_unset ();
		@session_destroy ();
		
		return true;
	}

}
?>