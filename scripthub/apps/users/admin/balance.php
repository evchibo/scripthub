<?php
/**
 * Copyright (c) 2018.
 * KarmaTechs
 * Evan Karma Alias MADSkill
 * madskill.madskill@gmail.com
 * https://sociamater.com
 */

_setView ( __FILE__ );

require_once ROOT_PATH.'/scripthub/apps/users/models/users.class.php';
$usersClass = new users();

$users = $usersClass->getAll(0, 0, $cms->usersWhere);
abr('users', $users);
		

if(!isset($_GET['id']) || !is_numeric($_GET['id'])) {
	refresh('?m='.$_GET['m'].'&c=list', 'INVALID ID', 'error');
}

$cms = new users();
$user = $cms->get($_GET['id']);
if(!$user) {
	refresh('?m='.$_GET['m'].'&c=list', 'INVALID ID', 'error');
}

_setTitle ( $user['username'] . ' › ' . $langArray ['balance1'] );

#LOAD BALANCE
require_once ROOT_PATH.'/scripthub/apps/users/models/balance.class.php';
$balanceClass = new balance();

$data = $balanceClass->getUserBalance($_GET['id'], null);

abr('data', $data); 


?>