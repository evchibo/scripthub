<?php
/**
 * Copyright (c) 2018.
 * KarmaTechs
 * Evan Karma Alias MADSkill
 * madskill.madskill@gmail.com
 * https://sociamater.com
 */

_setView(ROOT_PATH.'/scripthub/apps/users/controllers/login.php');

	unset($_SESSION['user']);
	refresh('/'.$languageURL);
	
?>