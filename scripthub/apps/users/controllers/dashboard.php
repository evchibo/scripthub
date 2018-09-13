<?php
/**
 * Copyright (c) 2018.
 * KarmaTechs
 * Evan Karma Alias MADSkill
 * madskill.madskill@gmail.com
 * https://sociamater.com
 */

_setView(__FILE__);
_setTitle($langArray['author_dashboard']);	

if(!check_login_bool()) {
		$_SESSION['temp']['golink'] = '/'.$languageURL.'author_dashboard/';
		refresh('/'.$languageURL.'sign_in/');
}

	if($_SESSION['user']['quiz'] != 'true') {
		refresh('/'.$languageURL.'make_money/become_an_author/');
	} 	

	require_once ROOT_PATH.'/scripthub/apps/items/models/orders.class.php';
	$ordersClass = new orders();
	
	$weekStats = $ordersClass->getWeekStats();
	abr('weekStats', $weekStats);

#RECENT COMMENTS
	require_once ROOT_PATH.'/scripthub/apps/items/models/comments.class.php';
	$commentsClass = new comments();
	
	$comments = $commentsClass->getAll(0, 100, " `owner_id` = '".intval($_SESSION['user']['user_id'])."' AND `reply_to` = '0' ", true, '`datetime` DESC');
	if(is_array($comments)) {
		$usersClass = new users();
		
		$users = $usersClass->getAll(0, 0, $commentsClass->usersWhere);
		abr('users', $users);		
	}
	abr('comments', $comments);
	
#BREADCRUMB	
	abr('breadcrumb', '<a href="/'.$languageURL.'" title="">'.$langArray['home'].'</a> \ <a href="/'.$languageURL.'users/dashboard/" title="">'.$langArray['my_account'].'</a>');		
	
?>