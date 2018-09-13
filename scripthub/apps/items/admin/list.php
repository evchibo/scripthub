<?php
/**
 * Copyright (c) 2018.
 * KarmaTechs
 * Evan Karma Alias MADSkill
 * madskill.madskill@gmail.com
 * https://sociamater.com
 */

_setView(__FILE__);
_setTitle($langArray['items']);

	if(isset($_POST['q'])) {
		$_GET['q'] = $_POST['q'];
	}
	if(!isset($_GET['q'])) {
		$_GET['q'] = '';
	}
	if(!isset($_GET['order'])) {
		$_GET['order'] = '';
	}
	if(!isset($_GET['dir'])) {
		$_GET['dir'] = '';
	}
	
	$cms = new items ( );
	
	$whereQuery = '';
	if(trim($_GET['q']) != '') {
		$whereQuery = " AND `name` LIKE '%".sql_quote($_GET['q'])."%' ";
	}
	
	$orderQuery = '';
	switch($_GET['order']) {
		case 'name': 
			$orderQuery = "`name`";
			break;
			
		case 'price': 
			$orderQuery = "`price`";
			break;
			
		case 'sales': 
			$orderQuery = "`sales`";
			break;
			
		case 'earning': 
			$orderQuery = "`earning`";
			break;
			
		case 'free': 
			$orderQuery = "`free_request`";
			break;
			
		case 'freefile': 
			$orderQuery = "`free_file`";
			break;
			
		case 'weekly': 
			$orderQuery = "`weekly_to`";
			break;
			
		default:
			$orderQuery = "`datetime`";
	}
	switch($_GET['dir']) {
		case 'desc':
			$orderQuery .= " DESC";
			abr('orderDir', 'asc');
			break;
		
		default:
			$orderQuery .= " ASC";
			abr('orderDir', 'desc');
	}
	
	if(isset($_POST['user'])) {
		$_GET['user'] = $_POST['user'];
	}
	if(!isset($_GET['user'])) {
		$_GET['user'] = '';
	}
	
	if(is_numeric($_GET['user'])) {
		$whereQuery .= " AND `user_id` = '".intval($_GET['user'])."' ";
	}
	
	$data = $cms->getAll(START, LIMIT, " `status` = 'active' ".$whereQuery, $orderQuery);
	abr('data', $data);

	$p = paging ( "?m=" . $_GET ['m'] . "&c=list&p=", "&q=".$_GET['q']."&order=".$_GET['order']."&dir=".$_GET['dir']."&user=".$_GET['user'], PAGE, LIMIT, $cms->foundRows );
	abr ( 'paging', $p );
	
#LOAD USERS
	require_once ROOT_PATH.'/scripthub/apps/users/models/users.class.php';
	$usersClass = new users();

	$users = $usersClass->getAll(0, 0, '', '`username` ASC');
	abr('users', $users);
	
?>