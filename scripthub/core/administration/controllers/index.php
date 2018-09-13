<?php
/**
 * Copyright (c) 2018. 
 * KarmaTechs
 * Evan Karma Alias MADSkill
 * madskill.madskill@gmail.com
 * https://sociamater.com
 */

require_once 'init.php';

//define ( 'LIMIT', 50 );

//load admin template
if(!isset($_GET['m']) && !isset($_GET['c'])) {
	require_once ROOT_PATH.'scripthub/apps/admin/index.php';
}
$_templateFile = ROOT_PATH.'scripthub/apps/admin/index.html';
abr ( 'content_template', $_templateFile );

_setLayout ( 'admin' );

require_once 'system/checkInstalledModules.php';


?>