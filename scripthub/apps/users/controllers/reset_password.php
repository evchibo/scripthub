<?php
/**
 * Copyright (c) 2018.
 * KarmaTechs
 * Evan Karma Alias MADSkill
 * madskill.madskill@gmail.com
 * https://sociamater.com
 */

_setView(__FILE__);
_setTitle($langArray['reset_password_setTitle']);


if(check_login_bool()) {
	refresh('/'.$languageURL.'edit/');
}

	if(isset($_POST['send'])) {
		$usersClass = new users();
		
		$s = $usersClass->changePassword();
		if($s === true) {
			refresh('/'.$languageURL.'reset_password/', $langArray['complete_reset_password'], 'complete');
		}
		else {
			addErrorMessage($langArray[$s], '', 'error');
		}
	}

#BREADCRUMB	
	abr('breadcrumb', '<a href="/'.$languageURL.'" title="">'.$langArray['home'].'</a> \ <a href="/'.$languageURL.'users/reset_password/" title="">'.$langArray['reset_password'].'</a>');		
	
	
?>