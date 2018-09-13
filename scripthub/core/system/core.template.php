<?
/**
 * Copyright (c) 2018.
 * KarmaTechs
 * Evan Karma Alias MADSkill
 * madskill.madskill@gmail.com
 * https://sociamater.com
 */

/*
 * Set the view file
 */
function _setView($path) {
	_setTemplate($path);
	return true;
}

/*
 * Set template from /scripthub/apps/<module>/views/<template>.html
 */
function _setTemplate($path, $prefix = "") {
	global $_templateFile;
	
	$dir = dirname ( $path );
	$file = basename ( $path, '.php' ) . '.html'; //file name template.tmpl
	$num = strlen ( ROOT_PATH );
	
	$template_file = substr ( $dir, $num ) . '/' . $prefix . $file;
	
	$template_file = ROOT_PATH . str_ireplace ( "controllers", "views", $template_file );
	
	if (! file_exists ( $template_file )) {
		die ( "template not exist! function: " . __FUNCTION__ . " file: " . $template_file );
	}
	
	$_templateFile = $template_file;
	
	abr ( 'content_template', $template_file );
	
	return true;
}

/*
 * Set template header title <title>$title</title>
 */
function _setTitle($title) {
	abr ( 'title', $title );
}

/*
 * Change default layout
 */
function _setLayout($layout) {
	global $_layoutFile;
	
	$_layoutFile = $layout;
	
	return true;
}


?>