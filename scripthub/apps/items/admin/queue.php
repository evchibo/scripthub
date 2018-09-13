<?php
/**
 * Copyright (c) 2018.
 * KarmaTechs
 * Evan Karma Alias MADSkill
 * madskill.madskill@gmail.com
 * https://sociamater.com
 */

_setView(__FILE__);
_setTitle($langArray['queue']);

	$cms = new items ( );
	
	if(!isset($_GET['order'])) {
		$_GET['order'] = '';
	}
	if(!isset($_GET['dir'])) {
		$_GET['dir'] = '';
	}
	
	$orderQuery = '';
	switch($_GET['order']) {		
		default:
			$orderQuery = "`datetime`";
	}
	switch($_GET['dir']) {
		case 'desc':
			$orderQuery .= " DESC";
			abr('orderDir', 'asc');
			break;
		
		default:
			$orderQuery .= " ASC";
			abr('orderDir', 'desc');
	}
	
	$data = $cms->getAll(START, LIMIT, " `status` = 'queue' ", $orderQuery);
	abr('data', $data);

	$p = paging ( "?m=" . $_GET ['m'] . "&c=queue&p=", "&order=".$_GET['order']."&dir=".$_GET['dir'], PAGE, LIMIT, $cms->foundRows );
	abr ( 'paging', $p );
	
?>