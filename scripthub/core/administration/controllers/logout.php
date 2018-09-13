<?php
/**
 * Copyright (c) 2018. 
 * KarmaTechs
 * Evan Karma Alias MADSkill
 * madskill.madskill@gmail.com
 * https://sociamater.com
 */

if (isset ( $_SESSION ['user'] )) {
	unset ( $_SESSION ['user'] );
}

if (isset ( $_COOKIE ['user_id'] ) || isset ( $_COOKIE ['verifyKey'] )) {
	setcookie ( "user_id", "", time () - 2592000, "/", "." . $config ['domain'] );
	setcookie ( "verifyKey", "", time () - 2592000, "/", "." . $config ['domain'] );
}

refresh ( '/' . $languageURL . adminURL . '/login/' );

?>