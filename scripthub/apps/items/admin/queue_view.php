<?php
/**
 * Copyright (c) 2018.
 * KarmaTechs
 * Evan Karma Alias MADSkill
 * madskill.madskill@gmail.com
 * https://sociamater.com
 */

_setView(__FILE__);
_setTitle($langArray['queue']);

	if(!isset($_GET['id']) || !is_numeric($_GET['id'])) {
		refresh('?m='.$_GET['m'].'&c=queue', 'WRONG ID', 'error');
	}

	if(!isset($_GET['p'])) {
		$_GET['p'] = '';
	}
	
	$cms = new items ( );
	
	require_once ROOT_PATH.'/scripthub/apps/users/models/users.class.php';
	$usersClass = new users();
	
	$data = $cms->get($_GET['id'], false);
	$data['user'] = $usersClass->get($data['user_id']);
	abr('data', $data); 
	
	if(isset($_POST['submit'])) {
		
		if($_POST['action'] == 'approve') {
			$s = $cms->approve($_GET['id']);
			if($s === true) {
				refresh("?m=".$_GET['m']."&c=queue&p=".$_GET['p'], $langArray['complete_approve_item']);
			}
			else {
				addErrorMessage($s, '', 'error');
			}
		}
		elseif($_POST['action'] == 'unapprove') {
			$s = $cms->unapprove($_GET['id']);
			if($s === true) {
				refresh("?m=".$_GET['m']."&c=queue&p=".$_GET['p'], $langArray['complete_unapprove_item']);
			}
			else {
				addErrorMessage($s, '', 'error');
			}
		}
		elseif($_POST['action'] == 'delete') {
			$s = $cms->unapproveDelete($_GET['id']);
			if($s === true) {
				refresh("?m=".$_GET['m']."&c=queue&p=".$_GET['p'], $langArray['complete_delete_item']);
			}
			else {
				addErrorMessage($s, '', 'error');
			}
		}		
	}
	
#LOAD CATEGORIES
	require_once ROOT_PATH.'/scripthub/apps/categories/models/categories.class.php';
	$categoriesClass = new categories();

	$categories = $categoriesClass->getAll();
	abr('categories', $categories);
	
?>