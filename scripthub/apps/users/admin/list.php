<?php
/**
 * Copyright (c) 2018.
 * KarmaTechs
 * Evan Karma Alias MADSkill
 * madskill.madskill@gmail.com
 * https://sociamater.com
 */

_setView ( __FILE__ );
_setTitle ( $langArray ['list'] );

	if(isset($_POST['q'])) {
		$_GET['q'] = $_POST['q'];
	}
	if(!isset($_GET['q'])) {
		$_GET['q'] = '';
	}
	if(!isset($_GET['order'])) {
		$_GET['order'] = '';
	}
	if(!isset($_GET['dir'])) {
		$_GET['dir'] = '';
	}

	$cms = new users ( );

	$whereQuery = '';
	if(trim($_GET['q']) != '') {
		$whereQuery = " `username` LIKE '%".sql_quote($_GET['q'])."%' ";
	}
	
	$orderQuery = '';
	switch($_GET['order']) {
		case 'money': 
			$orderQuery = "`total`";
			break;
			
		case 'sales': 
			$orderQuery = "`sales`";
			break;
			
		case 'sold': 
			$orderQuery = "`sold`";
			break;
			
		case 'items': 
			$orderQuery = "`items`";
			break;
			
		case 'referals': 
			$orderQuery = "`referals`";
			break;
			
		case 'referal_money': 
			$orderQuery = "`referal_money`";
			break;
			
		default:
			$orderQuery = "`username`";
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
	
	$data = $cms->getAll(START, LIMIT, $whereQuery, $orderQuery); 
	
	if(is_array($data)) {
		#LOAD COMMISSION
		require_once ROOT_PATH.'/scripthub/apps/percents/models/percents.class.php';
		$percentsClass = new percents();
		#LOAD BALANCE
		require_once ROOT_PATH.'/scripthub/apps/users/models/balance.class.php';
		$balanceClass = new balance();
	
		$percents = $percentsClass->getAll();
		
		foreach($data as $k=>$d) {
			
			$comision = $percentsClass->getPercentRow($d);
			$data[$k]['commission'] = $comision['percent'];
			
//			if($data[$k]['commission_percent'] < 1) {
//				foreach($percents as $p) {
//					if($d['sold'] >= $p['from'] && ($d['sold'] < $p['to'] || $p['to'] == '0')) {
//						$data[$k]['commission'] = $p['percent'];
//						break;
//					}
//				}
//			} else {
//				$data[$k]['commission'] = $data[$k]['commission_percent'];
//			}
			$data[$k]['sum'] = $balanceClass->getTotalUserBalanceByType($d['user_id']);
		}		
	} 
	abr('data', $data);

	$p = paging ( "?m=" . $_GET ['m'] . "&c=list&p=", "&q=".$_GET['q']."&order=".$_GET['order']."&dir=".$_GET['dir'], PAGE, LIMIT, $cms->foundRows );
	abr ( 'paging', $p );
			
?>