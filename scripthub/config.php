<?php
/**
 * Copyright (c) 2018.
 * KarmaTechs
 * Evan Karma Alias MADSkill
 * madskill.madskill@gmail.com
 * https://sociamater.com
 */

include_once $_SERVER['DOCUMENT_ROOT'] . '/scripthub/config/config.php';

$config = array (

'scripthub_core' => $configArr['scripthub_core'],
'root_path' => $configArr['root_path'], 
'domain' => $configArr['domain'],  
'site_title' => 'scripthub',
'use_language' => false,
'default_language' => 'en',
'langs' => array('en'),

'debug' => false,
'debug_ips' => array (
	'localhost',  
), 

'mysql_host' => $configArr['mysql_host'], 
'mysql_user' => $configArr['mysql_user'], 
'mysql_pass' => $configArr['mysql_pass'], 
'mysql_db' => $configArr['mysql_db'], 

'max_file_size' => 1024 * 1024 * 10,  //10 MB
'file_ext' => array (
	'pdf',
	'xls',
	'xlsx',
	'doc',
	'docx',
	'txt',
	'rtf',
	'png',
	'jpg' 
),

'max_upload_size' => 1024 * 1024 * 500,  //500 MB
'upload_ext' => array(
	'jpg',
	'png',
	'zip',
	'mp3',
	'wma'
),

'max_photo_size' => 1024 * 1024 * 10,  //10 MB
'photo_ext' => array (
	'jpg', 
	'gif', 
	'png' 
), 

'photo_sizes' => array (
	'A' => '50x50' 
),

'avatar_photo_sizes' => array (
	'A' => '80x80' 
),

'homeimage_photo_sizes' => array (
	'A' => '590x242' 
),
	
	
);

$config['data_server_path'] = $config['root_path'].'static/';

if(substr($_SERVER['SERVER_NAME'], 0, 4) == 'www.') {
	$config['data_server'] = 'http://www.'.$config['domain'].'/static/';
}
else {
	$config['data_server'] = 'http://'.$config['domain'].'/static/';
}

$config['recaptcha_public_key'] = $configArr['recaptcha_public_key'];
$config['recaptcha_private_key'] = $configArr['recaptcha_private_key'];

$config['emoticons'] = array(
':happy:' => 'happy.png',
':sad:' => 'sad.png',
':tongue:' => 'tongue.png',
':wink:' => 'wink.png',
':angry:' => 'angry.png',
':expressionless:' => 'expressionless.png',
':laugh:' => 'laugh.png',
':puzzled:' => 'puzzled.png',
':cool:' => 'cool.png',
':surprised:' => 'surprised.png',
':asleep:' => 'asleep.png',
':bashful:' => 'bashful.png',
':bashfulcute:' => 'bashfulcute.png',
':bigevilgrin:' => 'bigevilgrin.png',
':bigsmile:' => 'bigsmile.png',
':bigwink:' => 'bigwink.png',
':chuckle:' => 'chuckle.png',
':crying:' => 'crying.png',
':confused:' => 'confused.png',
':confusedsad:' => 'confusedsad.png',
':dead:' => 'dead.png',
':delicious:' => 'delicious.png',
':depressed:' => 'depressed.png',
':evil:' => 'evil.png',
':evilgrin:' => 'evilgrin.png',
':grin:' => 'grin.png',
':impatient:' => 'impatient.png',
':inlove:' => 'inlove.png',
':kiss:' => 'kiss.png',
':mad:' => 'mad.png',
':nerdy:' => 'nerdy.png',
':notfunny:' => 'notfunny.png',
':ohrly:' => 'ohrly.png',
':reallyevil:' => 'reallyevil.png',
':sarcasm:' => 'sarcasm.png',
':shocked:' => 'shocked.png',
':sick:' => 'sick.png',
':silly:' => 'silly.png',
':sing:' => 'sing.png',
':smitten:' => 'smitten.png',
':smug:' => 'smug.png',
':stress:' => 'stress.png',
':sunglasses:' => 'sunglasses.png',
':sunglasses2:' => 'sunglasses2.png',
':superbashfulcute:' => 'superbashfulcute.png',
':tired:' => 'tired.png',
':whistle:' => 'whistle.png',
':winktongue:' => 'winktongue.png',
':yawn:' => 'yawn.png',
':zipped:' => 'zipped.png',
);

?>