<?php
/**
 * Copyright (c) 2018.
 * KarmaTechs
 * Evan Karma Alias MADSkill
 * madskill.madskill@gmail.com
 * https://sociamater.com
 */

_setView ( __FILE__ );
_setTitle ( $langArray ['withdraws'] );

	$cms = new deposit ( );

	$data = $cms->getWithdraws(START, LIMIT);
	if(is_array($data)) {
		require_once ROOT_PATH.'/scripthub/apps/users/models/users.class.php';
		$usersClass = new users();
		
		$users = $usersClass->getAll(0, 0, $cms->usersWhere);
		abr('users', $users);
	}
	abr('data', $data);

	$p = paging ( "?m=" . $_GET ['m'] . "&c=withdraws&p=", "", PAGE, LIMIT, $cms->foundRows );
	abr ( 'paging', $p );
?>