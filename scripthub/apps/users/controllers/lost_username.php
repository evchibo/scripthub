<?php
/**
 * Copyright (c) 2018.
 * KarmaTechs
 * Evan Karma Alias MADSkill
 * madskill.madskill@gmail.com
 * https://sociamater.com
 */

_setView(__FILE__);
_setTitle($langArray['lost_usernames_setTitle']);


if(check_login_bool()) {
	refresh('/'.$languageURL.'edit/');
}

	if(isset($_POST['send'])) {
		$usersClass = new users();
		
		$s = $usersClass->lostUsername();
		if($s === true) {
			refresh('/'.$languageURL.'lost_username/', $langArray['complete_send_username'], 'complete');
		}
		else {
			addErrorMessage($langArray[$s], '', 'error');
		}
	}
	
#BREADCRUMB	
	abr('breadcrumb', '<a href="/'.$languageURL.'" title="">'.$langArray['home'].'</a> \ <a href="/'.$languageURL.'users/lost_username/" title="">'.$langArray['lost_username'].'</a>');		
	

?>