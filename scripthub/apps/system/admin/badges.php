<?php
/**
 * Copyright (c) 2018.
 * KarmaTechs
 * Evan Karma Alias MADSkill
 * madskill.madskill@gmail.com
 * https://sociamater.com
 */

if(!isset($_GET['type']) || !in_array($_GET['type'], array('other','buyers','authors','referrals', 'system'))) {
	refresh('?m='.$_GET['m'].'&c=badges&type=system', '', 'error');
}

_setView ( __FILE__ );
_setTitle ( $langArray ['badges'].' › '. ucfirst($_GET['type']) );

$types = array('system', 'other','buyers','authors','referrals');

$tmp = array();
foreach($types AS $type) {
	$tmp[] = array(
		'name' => ucfirst($type),
		'href' => '?m='.$_GET['m'].'&c=badges&type=' . $type
	);	
}
abr('types', $tmp);

require_once ROOT_PATH.'/scripthub/apps/system/models/badges.class.php';
$badges = new badges();

//echo '<pre>';
//var_dump($badges->getAllFront());exit;

$data = $badges->getAll(START, LIMIT, "`type`='" . $_GET['type'] . "'");
abr('data', $data);

$p = paging ( "?m=" . $_GET ['m'] . "&c=badges&type=" . $_GET['type'] . "&p=", "", PAGE, LIMIT, $badges->foundRows );
abr ( 'paging', $p );