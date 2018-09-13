<?php
/**
 * Copyright (c) 2018.
 * KarmaTechs
 * Evan Karma Alias MADSkill
 * madskill.madskill@gmail.com
 * https://sociamater.com
 */

_setView(__FILE__);
_setTitle($langArray['signup_setTitle']);

if(check_login_bool()) {
	refresh('/'.$languageURL.'edit/');
}

	if(get_id(2) == 'verify') {
		abr('verify', 'yes');
	}
	elseif(get_id(2) == 'complete') {
		abr('complete', 'yes');
	}
	else {

		require_once ROOT_PATH.'/scripthub/apps/pages/models/pages.class.php';
		$pagesClass = new pages();
		
		$terms = $pagesClass->getByKey('terms');
		abr('terms', $terms);
		
#LOAD RE-CAPTCHA	
		require_once ROOT_PATH.'/scripthub/classes/recaptchalib.php';
		
		abr('recaptcha', recaptcha_get_html($config['recaptcha_public_key']));
		
		if(isset($_POST['add'])) {
			$usersClass = new users();
			
			$s = $usersClass->add();
			if($s === true) {
				refresh('/'.$languageURL.'sign_up/verify/');
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
		
	}
	
#BREADCRUMB	
	abr('breadcrumb', '<a href="/'.$languageURL.'" title="">'.$langArray['home'].'</a> \ <a href="/'.$languageURL.'users/registration/" title="">'.$langArray['sign_up'].'</a>');		
	
	
?>