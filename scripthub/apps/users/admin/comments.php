<?php
/**
 * Copyright (c) 2018.
 * KarmaTechs
 * Evan Karma Alias MADSkill
 * madskill.madskill@gmail.com
 * https://sociamater.com
 */

_setView ( __FILE__ );
_setTitle ( $langArray ['report_comments'] );

	require_once ROOT_PATH.'/scripthub/apps/items/models/comments.class.php';
	$commentsClass = new comments();
	
#CHECK COMMENT
	if(isset($_GET['check']) && is_numeric($_GET['check'])) {
		$commentsClass->reported($_GET['check']);
		refresh('?m='.$_GET['m'].'&c=comments');
	}	
	
	$data = $commentsClass->getAll(START, LIMIT, " `report_by` <> '0' ");
	abr('data', $data);

	$p = paging ( "?m=" . $_GET ['m'] . "&c=comments&p=", "", PAGE, LIMIT, $commentsClass->foundRows );
	abr ( 'paging', $p );
	
	if(is_array($data)) {
		
		$usersClass = new users();
		
		$usersWhere = '';
		foreach($data as $d) {
			$usersWhere[$d['report_by']] = $d['report_by'];
		}
		
		$usersWhere = '`user_id` = '.implode(' OR `user_id` = ', $usersWhere);
		
		$users = $usersClass->getAll(0, 0, $usersWhere);
		abr('users', $users);
	}
	
?>