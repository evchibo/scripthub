<?php
/**
 * Copyright (c) 2018.
 * KarmaTechs
 * Evan Karma Alias MADSkill
 * madskill.madskill@gmail.com
 * https://sociamater.com
 */

$lang_file_for_module = null;
	if($_GET['module'] == 'admin') {
		if(isset($_GET['m'])) {
			$lang_file_for_module = ROOT_PATH.'/scripthub/apps/' . $_GET['m'] . '/language/lang.php';
		}
	} else { 
		$lang_file_for_module = ROOT_PATH.'/scripthub/apps/' . $_GET['module'] . '/language/lang.php';
	}

	require_once ROOT_PATH.'scripthub/config/lang.php';
	
	if($lang_file_for_module && file_exists($lang_file_for_module)) {
		require_once $lang_file_for_module;
	}

	abr("lang", $langArray);
	$languageURL = '';
	
	abr("languageURL", $languageURL);
?>