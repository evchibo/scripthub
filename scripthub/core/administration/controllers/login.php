<?php
/**
 * Copyright (c) 2018. 
 * KarmaTechs
 * Evan Karma Alias MADSkill
 * madskill.madskill@gmail.com
 * https://sociamater.com
 */

require_once 'init.php';

//load admin template
$_templateFile = ENGINE_PATH . '/administration/views/login.html';
abr ( 'content_template', $_templateFile );

_setLayout ( "admin_login" );

require_once ROOT_PATH . '/scripthub/apps/users/models/users.class.php';
$cms = new users ( );

/*
 * CHECK COOKIE FOR LOGIN
 */
if (isset ( $_COOKIE ['user_id'] ) && isset ( $_COOKIE ['verifyKey'] )) {
	if ($cms->isValidVerifyKey ( $_COOKIE ['user_id'], $_COOKIE ['verifyKey'] )) {
		$_SESSION ['user'] = $cms->get ( $_COOKIE ['user_id'] );
		
		setcookie ( "user_id", $_COOKIE ['user_id'], time () + 2592000, "/", "." . $config ['domain'] );
		setcookie ( "verifyKey", $_COOKIE ['verifyKey'], time () + 2592000, "/", "." . $config ['domain'] );
		
		if (isset ( $_SESSION ['redirectUrl'] )) {
			$refreshURL = $_SESSION ['redirectUrl'];
			unset ( $_SESSION ['redirectUrl'] );
		} else {
			$refreshURL = '/' . $languageURL . adminURL . '/';
		}
		
		refresh ( $refreshURL );
	}
}

if (isset ( $_POST ['login'] )) {
	$status = $cms->login ( true );
	if ($status === true) {
		if (isset ( $_SESSION ['redirectUrl'] )) {
			$refreshURL = $_SESSION ['redirectUrl'];
			unset ( $_SESSION ['redirectUrl'] );
		} else {
			$refreshURL = '/' . $languageURL . adminURL . '/';
		}
		
		refresh ( $refreshURL );
	} else {
		addErrorMessage ( $langArray [$status], "", "error" );
	}
}

if(isset($_POST['send'])) {
	$status = $cms->changePassword ( true );
	if ($status === true) {
		if (isset ( $_SESSION ['redirectUrl'] )) {
			$refreshURL = '/' . $languageURL . adminURL . '/login/';		
		}
		
		refresh ( $refreshURL );
	} else {
		addErrorMessage ( $langArray [$status], "", "error" );
	}
}

?>