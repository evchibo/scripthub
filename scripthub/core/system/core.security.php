<?
/**
 * Copyright (c) 2018.
 * KarmaTechs
 * Evan Karma Alias MADSkill
 * madskill.madskill@gmail.com
 * https://sociamater.com
 */

/**
 * SECURITE FOR CROSS SITE SCRIPTING!
 */
function removeXSS($val) {
	// remove all non-printable characters. CR(0a) and LF(0b) and TAB(9) are allowed
	// this prevents some character re-spacing such as <java\0script>
	// note that you have to handle splits with \n, \r, and \t later since they *are* allowed in some inputs
	$val = preg_replace ( '/([\x00-\x08][\x0b-\x0c][\x0e-\x20])/', '', $val );
	
	// straight replacements, the user should never need these since they're normal characters
	// this prevents like <IMG SRC=&#X40&#X61&#X76&#X61&#X73&#X63&#X72&#X69&#X70&#X74&#X3A&#X61&#X6C&#X65&#X72&#X74&#X28&#X27&#X58&#X53&#X53&#X27&#X29>
	$search = 'abcdefghijklmnopqrstuvwxyz';
	$search .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$search .= '1234567890!@#$%^&*()';
	$search .= '~`";:?+/={}[]-_|\'\\';
	for($i = 0; $i < strlen ( $search ); $i ++) {
		// ;? matches the ;, which is optional
		// 0{0,7} matches any padded zeros, which are optional and go up to 8 chars
		

		// &#x0040 @ search for the hex values
		$val = preg_replace ( '/(&#[x|X]0{0,8}' . dechex ( ord ( $search [$i] ) ) . ';?)/i', $search [$i], $val ); // with a ;
		// &#00064 @ 0{0,7} matches '0' zero to seven times
		$val = preg_replace ( '/(&#0{0,8}' . ord ( $search [$i] ) . ';?)/', $search [$i], $val ); // with a ;
	}
	
	// now the only remaining whitespace attacks are \t, \n, and \r
	$ra1 = Array (
		
		'javascript', 
		'vbscript', 
		'expression', 
		'applet', 
		'meta', 
		'xml', 
		'blink', 
		//'link', 
		'style', 
		'script', 
		'embed', 
		'object', 
		'iframe', 
		'frame', 
		'frameset', 
		'ilayer', 
		'layer', 
		'bgsound', 
		'title', 
		'base' 
	);
	$ra2 = Array (
		
		'onabort', 
		'onactivate', 
		'onafterprint', 
		'onafterupdate', 
		'onbeforeactivate', 
		'onbeforecopy', 
		'onbeforecut', 
		'onbeforedeactivate', 
		'onbeforeeditfocus', 
		'onbeforepaste', 
		'onbeforeprint', 
		'onbeforeunload', 
		'onbeforeupdate', 
		'onblur', 
		'onbounce', 
		'oncellchange', 
		'onchange', 
		'onclick', 
		'oncontextmenu', 
		'oncontrolselect', 
		'oncopy', 
		'oncut', 
		'ondataavailable', 
		'ondatasetchanged', 
		'ondatasetcomplete', 
		'ondblclick', 
		'ondeactivate', 
		'ondrag', 
		'ondragend', 
		'ondragenter', 
		'ondragleave', 
		'ondragover', 
		'ondragstart', 
		'ondrop', 
		'onerror', 
		'onerrorupdate', 
		'onfilterchange', 
		'onfinish', 
		'onfocus', 
		'onfocusin', 
		'onfocusout', 
		'onhelp', 
		'onkeydown', 
		'onkeypress', 
		'onkeyup', 
		'onlayoutcomplete', 
		'onload', 
		'onlosecapture', 
		'onmousedown', 
		'onmouseenter', 
		'onmouseleave', 
		'onmousemove', 
		'onmouseout', 
		'onmouseover', 
		'onmouseup', 
		'onmousewheel', 
		'onmove', 
		'onmoveend', 
		'onmovestart', 
		'onpaste', 
		'onpropertychange', 
		'onreadystatechange', 
		'onreset', 
		'onresize', 
		'onresizeend', 
		'onresizestart', 
		'onrowenter', 
		'onrowexit', 
		'onrowsdelete', 
		'onrowsinserted', 
		'onscroll', 
		'onselect', 
		'onselectionchange', 
		'onselectstart', 
		'onstart', 
		'onstop', 
		'onsubmit', 
		'onunload' 
	);
	$ra = array_merge ( $ra1, $ra2 );
	
	$found = true; // keep replacing as long as the previous round replaced something
	while ( $found == true ) {
		$val_before = $val;
		for($i = 0; $i < sizeof ( $ra ); $i ++) {
			$pattern = '/';
			for($j = 0; $j < strlen ( $ra [$i] ); $j ++) {
				if ($j > 0) {
					$pattern .= '(';
					$pattern .= '(&#[x|X]0{0,8}([9][a][b]);?)?';
					$pattern .= '|(&#0{0,8}([9][10][13]);?)?';
					$pattern .= ')?';
				}
				$pattern .= $ra [$i] [$j];
			}
			$pattern .= '/i';
			$replacement = substr ( $ra [$i], 0, 2 ) . '<x>' . substr ( $ra [$i], 2 ); // add in <> to nerf the tag
			$val = preg_replace ( $pattern, $replacement, $val ); // filter out the hex tags
			if ($val_before == $val) {
				// no replacements were made, so exit the loop
				$found = false;
			}
		}
	}
	return $val;
}


/**
 * Kodirane na URL
 *
 * @param string $string
 * @return string
 */
function urlsafe_b64encode($string) {
	//$rand = rand(1,9);
	//$string = $rand . $string . $rand;
	//return $string;
	$data = base64_encode ( $string );
	$data = str_replace ( array (
		
		'+', 
		'/', 
		'=' 
	), array (
		
		'-', 
		'_', 
		'' 
	), $data );
	return $data;
}

/**
 * Dekodirane na URL
 *
 * @param string $string
 * @return string
 */
function urlsafe_b64decode($string) {
	//return $string;
	$data = str_replace ( array (
		
		'-', 
		'_' 
	), array (
		
		'+', 
		'/' 
	), $string );
	$mod4 = strlen ( $data ) % 4;
	if ($mod4) {
		$data .= substr ( '====', $mod4 );
	}
	$data = base64_decode ( $data );
	// return substr($data,1,-1);
	return $data;
}

/**
 * escape chars!
 *
 * @param string $value
 * @return string
 */
function strip_html_tags($text) {
	$text = preg_replace ( array (
		
		// Remove invisible content
		'@<head[^>]*?>.*?</head>@siu', 
		'@<style[^>]*?>.*?</style>@siu', 
		'@<script[^>]*?.*?</script>@siu', 
		'@<object[^>]*?.*?</object>@siu', 
		'@<embed[^>]*?.*?</embed>@siu', 
		'@<applet[^>]*?.*?</applet>@siu', 
		'@<noframes[^>]*?.*?</noframes>@siu', 
		'@<noscript[^>]*?.*?</noscript>@siu', 
		'@<noembed[^>]*?.*?</noembed>@siu', 
		// Add line breaks before and after blocks
		'@</?((address)|(blockquote)|(center)|(del)|(marquee)|(map))@iu', 
		'@</?((div)|(ins)|(isindex)|(pre))@iu', 
		'@</?((dir)|(dl)|(dt)|(dd)|(menu))@iu', 
		'@</?((form)|(button)|(fieldset)|(legend)|(input))@iu', 
		'@</?((label)|(select)|(optgroup)|(option)|(textarea))@iu', 
		'@</?((frameset)|(frame)|(iframe))@iu' 
	), array (
		
		' ', 
		' ', 
		' ', 
		' ', 
		' ', 
		' ', 
		' ', 
		' ', 
		' ', 
		"\n\$0", 
		"\n\$0", 
		"\n\$0", 
		"\n\$0", 
		"\n\$0", 
		"\n\$0", 
		"\n\$0", 
		"\n\$0" 
	), $text );
	//    return strip_tags( $text );
	return $text;
}

function sql_quote($value, $toStrip = true) {
	
	$value = str_replace('<x>', '', $value);
	
	if ($toStrip) {
		$value = strip_html_tags ( $value );
	}
	if (get_magic_quotes_gpc ()) {
		$value = stripslashes ( $value );
	}
	//check if this function exists
	$value = addslashes ( $value );
	
	return $value;
}

/*
 * check users (Agent) is bot?
 */
function isBot() {
	
	$botlist = array (
		
		"Teoma", 
		"diri", 
		"alexa", 
		"froogle", 
		"Gigabot", 
		"inktomi", 
		"looksmart", 
		"URL_Spider_SQL", 
		"Firefly", 
		"NationalDirectory", 
		"Ask Jeeves", 
		"TECNOSEEK", 
		"InfoSeek", 
		"WebFindBot", 
		"girafabot", 
		"crawler", 
		"www.galaxy.com", 
		"Googlebot", 
		"Scooter", 
		"Slurp", 
		"msnbot", 
		"appie", 
		"FAST", 
		"WebBug", 
		"Spade", 
		"ZyBorg", 
		"rabaz", 
		"Baiduspider", 
		"Feedfetcher-Google", 
		"TechnoratiSnoop", 
		"Rankivabot", 
		"Mediapartners-Google", 
		"Sogou web spider", 
		"WebAlta Crawler" 
	);
	
	foreach ( $botlist as $bot ) {
		if (ereg ( $bot, $_SERVER ['HTTP_USER_AGENT'] )) {
			return true;
		}
	}
	
	return false;
}

?>