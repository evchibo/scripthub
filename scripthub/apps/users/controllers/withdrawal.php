<?php
/**
 * Copyright (c) 2018.
 * KarmaTechs
 * Evan Karma Alias MADSkill
 * madskill.madskill@gmail.com
 * https://sociamater.com
 */

_setView(__FILE__);
_setTitle($langArray['withdrawal_setTitle']); 

if(!check_login_bool()) {
	$_SESSION['temp']['golink'] = '/'.$languageURL.'withdrawal/';
	refresh('/'.$languageURL.'sign_in/');
}
	
	$usersClass = new users();
	
	$user = $usersClass->get($_SESSION['user']['user_id']);
	abr('user', $user);
	
	$date['year'] = date('Y');
	$date['month'] = date('n');
	$date['day'] = date("t");
	abr('date', $date);	
	
	if(isset($_POST['submit'])) {
		$depositClass = new deposit();
		
		$s = $depositClass->addWithdraw();
		if($s === true) {
			refresh('/'.$languageURL.'withdrawal/', $langArray['complete_add_withdrawal'], 'complete');
		}
		else {
			$message = '<ul>';
			foreach($s as $e) {
				$message .= '<li>'.$e.'</li>';
			}
			$message .= '</ul>';
			addErrorMessage($message, '', 'error');
		}
	}
	
#BREADCRUMB	
	abr('breadcrumb', '<a href="/'.$languageURL.'" title="">'.$langArray['home'].'</a> \ <a href="/'.$languageURL.'users/dashboard/" title="">'.$langArray['my_account'].'</a> \ <a href="/'.$languageURL.'users/withdrawal/" title="">'.$langArray['withdrawal'].'</a>');		
	


?>