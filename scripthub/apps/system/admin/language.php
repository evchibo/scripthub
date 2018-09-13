<?php
/**
 * Copyright (c) 2018.
 * KarmaTechs
 * Evan Karma Alias MADSkill
 * madskill.madskill@gmail.com
 * https://sociamater.com
 */

_setView ( __FILE__ );
_setTitle ( $langArray ['language'] );

	$cms = new system ( );
	
	$buff = scandir(ROOT_PATH.'/scripthub/lang/');
	$languages = array();
	if(is_array($buff)) {
		foreach($buff as $f) {
			if(is_file(ROOT_PATH.'/scripthub/lang/'.$f)) {
				$f = basename($f, '.php');
				$languages[$f] = $f;
			} 
		}
	}
	abr('languages', $languages);
	
	$filename = ROOT_PATH.'/scripthub/config/current.txt';
	if(is_file($filename)) {
		$handle = fopen($filename, "r");
		$currentLanguage = fread($handle, filesize($filename));
		abr('currentLanguage', $currentLanguage);
		fclose($handle);
	}
	
	if(isset($_POST['save']) && isset($_POST['lang'])) {
		if(is_file(ROOT_PATH.'/scripthub/lang/'.$_POST['lang'].'.php')) {
			copy(ROOT_PATH.'/scripthub/lang/'.$_POST['lang'].'.php', ROOT_PATH.'/scripthub/config/lang.php');
			
			$handle = fopen($filename, 'w');
			fwrite($handle, $_POST['lang']);
			fclose($handle);
			
			refresh('?m='.$_GET['m'].'&c='.$_GET['c'], $langArray['complete_change_language'], 'complete');
		} 
	}
	
?>