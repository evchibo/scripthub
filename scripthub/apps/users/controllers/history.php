<?php
/**
 * Copyright (c) 2018.
 * KarmaTechs
 * Evan Karma Alias MADSkill
 * madskill.madskill@gmail.com
 * https://sociamater.com
 */

_setView(__FILE__);
_setTitle($langArray['deposit_history_setTitle']);
if(!check_login_bool()) {
	$_SESSION['temp']['golink'] = '/'.$languageURL.'invoices/';
	refresh('/'.$languageURL.'users/login/');
}

	require_once ROOT_PATH.'/scripthub/classes/history.class.php';
	$historyClass = new history();
	
	$history = $historyClass->getAll(0, 0, " `user_id` = '".intval($_SESSION['user']['user_id'])."' ");
	abr('history', $history);

#BREADCRUMB	
	abr('breadcrumb', '<a href="/'.$languageURL.'" title="">'.$langArray['home'].'</a> \ <a href="/'.$languageURL.'users/dashboard/" title="">'.$langArray['my_account'].'</a> \ <a href="/'.$languageURL.'users/history/" title="">'.$langArray['history'].'</a>');		
	
	
?>