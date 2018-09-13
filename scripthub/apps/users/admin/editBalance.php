<?php
/**
 * Copyright (c) 2018.
 * KarmaTechs
 * Evan Karma Alias MADSkill
 * madskill.madskill@gmail.com
 * https://sociamater.com
 */

_setView ( __FILE__ );

if(!isset($_GET['id']) || !is_numeric($_GET['id'])) {
	refresh('?m='.$_GET['m'].'&c=list', 'INVALID ID', 'error');
}

#LOAD BALANCE
require_once ROOT_PATH.'/scripthub/apps/users/models/balance.class.php';
$balanceClass = new balance();

$row = $balanceClass->get($_GET['id']);

if(!$row) {
	refresh('?m='.$_GET['m'].'&c=list', 'INVALID ID', 'error');
}

$_GET['user_id'] = $row['user_id'];
if (!isset ( $_POST ['edit'] )) {
	$_POST['balance'] = $row['deposit'];
}

if(!isset($_GET['user_id']) || !is_numeric($_GET['user_id'])) {
	refresh('?m='.$_GET['m'].'&c=list', 'INVALID ID', 'error');
}

$cms = new users();
$user = $cms->get($_GET['user_id']);
if(!$user) {
	refresh('?m='.$_GET['m'].'&c=list', 'INVALID ID', 'error');
}

_setTitle ( $user['username'] . ' › ' . $langArray ['balance1'] );

if (isset ( $_POST ['edit'] )) {
	
	$status = $balanceClass->edit ();
	if ($status !== true) {
		abr('error', $status);
	} else {
		refresh ( "?m=" . $_GET ['m'] . "&c=balance&id=" . $_GET['user_id'], $langArray ['add_complete'] );
	}	
}