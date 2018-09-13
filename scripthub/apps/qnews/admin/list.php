<?php
/**
 * Copyright (c) 2018.
 * KarmaTechs
 * Evan Karma Alias MADSkill
 * madskill.madskill@gmail.com
 * https://sociamater.com
 */

_setView ( __FILE__ );

$cms = new qnews ( );

if(isset($_GET['up']) || isset($_GET['down'])) {
	$cms->tableName = 'qnews';
	$cms->idColumn = 'id';

	if(isset($_GET['up']) && is_numeric($_GET['up'])) {
		$cms->moveUp($_GET['up']);
	}
	elseif(isset($_GET['down']) && is_numeric($_GET['down'])) {
		$cms->moveDown($_GET['down']);
	}
}

require_once ENGINE_PATH.'/classes/image.class.php';
$imageClass = new Image();

$data = $cms->getAll(START, LIMIT);
$tmp = array();
if($data) {
	foreach($data AS $key => $d) {
		$tmp[$key] = $d;
		$tmp[$key]['thumb'] = '/static/uploads/qnews/192x64/' . $d['photo'];
	}
}

abr('data', $tmp);

$p = paging ( "?m=" . $_GET ['m'] . "&c=list&p=", "", PAGE, LIMIT, $cms->foundRows );
abr ( 'paging', $p );
	
?>