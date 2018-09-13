<?php
/**
 * Copyright (c) 2018.
 * KarmaTechs
 * Evan Karma Alias MADSkill
 * madskill.madskill@gmail.com
 * https://sociamater.com
 */

_setView(__FILE__);
_setTitle($langArray['edit_profile']);	
	
if(!check_login_bool()) {
		$_SESSION['temp']['golink'] = '/'.$languageURL.'edit/';
		refresh('/'.$languageURL.'sign_in/');
}

#LOAD USER ITEMS
	require_once ROOT_PATH.'/scripthub/apps/items/models/items.class.php';
	$itemsClass = new items();

	$items = $itemsClass->getAll(0, 0, " `status` = 'active' AND `user_id` = '".intval($_SESSION['user']['user_id'])."' ");
	abr('items', $items);

#CHANGE PASSWORD
	if(isset($_POST['change_password'])) {		
		$usersClass = new users();
		$s = $usersClass->editNewPassword();
		if($s === true) {
			refresh('/'.$languageURL.'edit/', $langArray['complete_change_password'], 'complete');
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

#FEATURE ITEM
	if(isset($_POST['feature_save'])) {		
		$usersClass = new users();
		$usersClass->editFeatureItem();
		refresh('/'.$languageURL.'edit/', $langArray['complete_save_feature'], 'complete');
	}
	
#EXCLUSIVE AUTHOR
	if(isset($_POST['exclusive_false'])) {		
		$usersClass = new users();
		$usersClass->editExclusiveAuthor('false');
		refresh('/'.$languageURL.'edit/', $langArray['complete_exclusive_author_off'], 'complete');		
	}
	elseif(isset($_POST['exclusive_true'])) {		
		$usersClass = new users();
		$usersClass->editExclusiveAuthor('true');
		refresh('/'.$languageURL.'edit/', $langArray['complete_exclusive_author_on'], 'complete');		
	}
	
#CHANGE LICENSE
	if(isset($_POST['save_license'])) {
		$usersClass = new users();
		$s = $usersClass->editSaveLicense();
		if($s === true) {
			refresh('/'.$languageURL.'edit/', $langArray['complete_save_license'], 'complete');	
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
	
#CHANGE AVATAR AND HOMEPAGE IMAGE
	if(isset($_POST['change_avatar_image'])) {
		$usersClass = new users();
		$usersClass->editChangeAvatarImage();
		$message = '';
		if($usersClass->avatarError) {
			$message .= '<li>'.$usersClass->avatarError.'</li>';
		}
		if($usersClass->homeimageError) {
			$message .= '<li>'.$usersClass->homeimageError.'</li>';
		}
		if($message != '') {
			$message = '<ul>'.$message.'</li>';
			addErrorMessage($message, '', 'error');
		}
		else {
			refresh('/'.$languageURL.'edit/', $langArray['complete_change_avatar_image'], 'complete');
		}		
	}
	
#SAVE PERSONAL INFORMATION
	if(isset($_POST['personal_edit'])) {
		$usersClass = new users();
		$s = $usersClass->editPersonalInformation();
		if($s === true) {
			refresh('/'.$languageURL.'edit/', $langArray['complete_update_personal_info'], 'complete');	
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
	else {
		$_POST['firstname'] = $_SESSION['user']['firstname'];
		$_POST['lastname'] = $_SESSION['user']['lastname'];
		$_POST['email'] = $_SESSION['user']['email'];
		$_POST['firmname'] = $_SESSION['user']['firmname'];
		$_POST['profile_title'] = $_SESSION['user']['profile_title'];
		$_POST['profile_desc'] = $_SESSION['user']['profile_desc'];
		$_POST['live_city'] = $_SESSION['user']['live_city'];
		$_POST['country_id'] = $_SESSION['user']['country_id'];
		$_POST['freelance'] = $_SESSION['user']['freelance'];
	}
	

#SAVE SOCIAL INFORMATION
	if(isset($_POST['social_edit'])) {
		$usersClass = new users();
		$s = $usersClass->editSocialInformation();
		if($s === true) {
			refresh('/'.$languageURL.'edit/', $langArray['complete_update_personal_info'], 'complete');	
		}
	}	
	else {
		$_POST['behance'] = $_SESSION['user']['behance'];
		$_POST['deviantart'] = $_SESSION['user']['deviantart'];
		$_POST['digg'] = $_SESSION['user']['digg'];
		$_POST['dribbble'] = $_SESSION['user']['dribbble'];
		$_POST['facebook'] = $_SESSION['user']['facebook'];
		$_POST['flickr'] = $_SESSION['user']['flickr'];
		$_POST['forrst'] = $_SESSION['user']['forrst'];
		$_POST['github'] = $_SESSION['user']['github'];
		$_POST['googleplus'] = $_SESSION['user']['googleplus'];
		$_POST['lastfm'] = $_SESSION['user']['lastfm'];
		$_POST['linkedin'] = $_SESSION['user']['linkedin'];
		$_POST['myspace'] = $_SESSION['user']['myspace'];
		$_POST['reddit'] = $_SESSION['user']['reddit'];
		$_POST['tumblr'] = $_SESSION['user']['tumblr'];
		$_POST['twitter'] = $_SESSION['user']['twitter'];
		$_POST['vimeo'] = $_SESSION['user']['vimeo'];
		$_POST['youtube'] = $_SESSION['user']['youtube'];
	}
	

#LOAD COUNTRIES
	require_once ROOT_PATH.'/scripthub/apps/countries/models/countries.class.php';
	$countriesClass = new countries();

	$countries = $countriesClass->getAll(0, 0, " `visible` = 'true' ");
	abr('countries', $countries);
	
#BREADCRUMB	
	abr('breadcrumb', '<a href="/'.$languageURL.'" title="">'.$langArray['home'].'</a> \ <a href="/'.$languageURL.'users/dashboard/" title="">'.$langArray['my_account'].'</a> \ <a href="/'.$languageURL.'edit/" title="">'.$langArray['settings'].'</a>');		
	
	
?>