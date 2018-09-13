<?php
/**
 * Copyright (c) 2018.
 * KarmaTechs
 * Evan Karma Alias MADSkill
 * madskill.madskill@gmail.com
 * https://sociamater.com
 */

_setView ( __FILE__ );
_setTitle ( $langArray ['issue_categories'] );

	$cms = new ccategories ( );
	
	if(isset($_GET['up']) || isset($_GET['down'])) {		
		$cms->tableName = 'contacts_categories';
		$cms->idColumn = 'id';
	
		if(isset($_GET['up']) && is_numeric($_GET['up'])) {
			$cms->moveUp($_GET['up']);
		}
		elseif(isset($_GET['down']) && is_numeric($_GET['down'])) {
			$cms->moveDown($_GET['down']);
		}
	}
	
	$data = $cms->getAll(START, LIMIT);
	abr('data', $data);

	$p = paging ( "?m=" . $_GET ['m'] . "&c=categories&p=", "", PAGE, LIMIT, $cms->foundRows );
	abr ( 'paging', $p );
	
?>