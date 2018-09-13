<?php
/**
 * Copyright (c) 2018.
 * KarmaTechs
 * Evan Karma Alias MADSkill
 * madskill.madskill@gmail.com
 * https://sociamater.com
 */

_setView(__FILE__);
_setTitle($langArray['signin_setTitle']);


if(check_login_bool()) {
	refresh('/'.$languageURL.'edit/');
}

#ACTICVATE PROFILE	
	if(isset($_GET['command']) && $_GET['command'] == 'activate' && isset($_GET['user']) && isset($_GET['key'])) {
		$usersClass = new users();
		
		$s = $usersClass->activateUser($_GET['user'], $_GET['key']);
		if($s === true) {
			refresh('/'.$languageURL.'sign_up/complete/');
		}
		else {
			addErrorMessage($s['valid'], '', 'error');
		}
	}
	
#LOGIN	
	if(isset($_POST['login'])) {
		$usersClass = new users();
		$s = $usersClass->login();
		if($s === true) {
			if(isset($_SESSION['temp']['golink'])) {
				$web = $_SESSION['temp']['golink'];
				unset($_SESSION['temp']['golink']);
				refresh($web);
			}
			refresh('/'.$languageURL);
		}
		else {
			addErrorMessage($langArray[$s], '', 'error');
		}
	}
	
#BREADCRUMB	
	abr('breadcrumb', '<a href="/'.$languageURL.'" title="">'.$langArray['home'].'</a> \ <a href="/'.$languageURL.'users/login/" title="">'.$langArray['login'].'</a>');		
	

?>