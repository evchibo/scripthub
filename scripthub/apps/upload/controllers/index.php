<?php
/**
 * Copyright (c) 2018.
 * KarmaTechs
 * Evan Karma Alias MADSkill
 * madskill.madskill@gmail.com
 * https://sociamater.com
 */

_setView(__FILE__);

if(!check_login_bool()) {
		$_SESSION['temp']['golink'] = '/'.$languageURL.'upload/index/';
		refresh('/'.$languageURL.'sign_in/');
}

	if($_SESSION['user']['quiz'] != 'true') {
		refresh('/'.$languageURL.'quiz/');
	} 
	
?>