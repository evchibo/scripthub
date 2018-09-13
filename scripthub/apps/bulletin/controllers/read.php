<?php
/**
 * Copyright (c) 2018.
 * KarmaTechs
 * Evan Karma Alias MADSkill
 * madskill.madskill@gmail.com
 * https://sociamater.com
 */

_setView(__FILE__);

	if(!isset($_GET['bulletin_id'])) {
		$_GET['bulletin_id'] = '0';
	}
	
	if(!isset($_COOKIE['bulletin'.$_GET['bulletin_id']])) {
		require_once ROOT_PATH . "/scripthub/apps/bulletin/models/bulletin.class.php";
		$bulletinClass = new bulletin();
		
		$bulletinClass->incRead($_GET['bulletin_id']);
	
		setcookie('bulletin'.$_GET['bulletin_id'], 'read', time()+2592000, "/", ".".$config['domain']);
	}

	header ( "Content-type: image/png" );
	
	//create image
	$image = imagecreate ( 1, 1 ) or die ( 'image create error' );
	$background_color = imagecolorallocate ( $image, 255, 255, 255 );
	imagepng ( $image );
	
?>