<?php
/**
 * Copyright (c) 2018.
 * KarmaTechs
 * Evan Karma Alias MADSkill
 * madskill.madskill@gmail.com
 * https://sociamater.com
 */

_setView(__FILE__);

	$command = get_id(2);
	
	//if($command == 'success') {
		
		$ordersClass = new orders();
		$s = $ordersClass->success();
		if($s === true) {
			refresh('/'.$languageURL.'download/', $langArray['complete_buy_theme'], 'complete');
		}
		else {
			refresh('/'.$languageURL, $langArray['error_paing'], 'error');
		}
	/*}
	else {
		refresh('/'.$languageURL, $langArray['error_paing'], 'error');
	}*/

?>