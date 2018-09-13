<?php
/**
 * Copyright (c) 2018.
 * KarmaTechs
 * Evan Karma Alias MADSkill
 * madskill.madskill@gmail.com
 * https://sociamater.com
 */

function check_email($address) {
		return (preg_match ( '/^[-!#$%&\'*+\\.\/0-9=?A-Z^_`{|}~]+' . '@' . '([-0-9A-Z]+\.)+' . '([0-9A-Z]){2,4}$/i', trim ( $address ) ));
	}
	
	function phpinfo_array($return=false, $subname = false) {
		ob_start();
		phpinfo(-1);
	 	$data = ob_get_clean();
		
	 	$data = str_replace('&nbsp;', ' ', $data);
	 	
		$pi = preg_replace(
			array(	'#^.*<body>(.*)</body>.*$#ms', '#<h2>PHP License</h2>.*$#ms',
					'#<h1>Configuration</h1>#',  "#\r?\n#", "#</(h1|h2|h3|tr)>#", '# +<#',
					"#[ \t]+#", '#&nbsp;#', '#  +#', '# class=".*?"#', '%&#039;%',
					'#<tr>(?:.*?)" src="(?:.*?)=(.*?)" alt="PHP Logo" /></a>'
						.'<h1>PHP Version (.*?)</h1>(?:\n+?)</td></tr>#',
					'#<h1><a href="(?:.*?)\?=(.*?)">PHP Credits</a></h1>#',
					'#<tr>(?:.*?)" src="(?:.*?)=(.*?)"(?:.*?)Zend Engine (.*?),(?:.*?)</tr>#',
					"# +#", '#<tr>#', '#</tr>#'),
			array(	'$1', '', '', '', '</$1>' . "\n", '<', ' ', ' ', ' ', '', ' ',
					'<h2>PHP Configuration</h2>'."\n".'<tr><td>PHP Version</td><td>$2</td></tr>'.
					"\n".'<tr><td>PHP Egg</td><td>$1</td></tr>',
					'<tr><td>PHP Credits Egg</td><td>$1</td></tr>',
					'<tr><td>Zend Engine</td><td>$2</td></tr>' . "\n" .
					'<tr><td>Zend Egg</td><td>$1</td></tr>', ' ', '%S%', '%E%'),
			$data);
	
		$sections = explode('<h2>', strip_tags($pi, '<h2><th><td>'));
		unset($sections[0]);
	
		$pi = array();
	 	foreach($sections as $section){
			$n = substr($section, 0, strpos($section, '</h2>'));
			preg_match_all('#%S%(?:<td>(.*?)</td>)?(?:<td>(.*?)</td>)?(?:<td>(.*?)</td>)?%E%#', $section, $askapache, PREG_SET_ORDER);
			foreach($askapache as $m) {
				$pi[preg_replace('/([ ]{1,})/','_',strtolower($n))][preg_replace('/([ ]{1,})/','_',strtolower($m[1]))] = (!isset($m[3]) || $m[2]==$m[3]) ? (isset($m[2]) ? $m[2] : '') : array_slice($m,2);
			}
			
		}
	
		if(isset($pi['zend_optimizer'])) {
			if(preg_match('/with Zend Optimizer v([0-9.]{1,})/i', $data, $match)) {
				$pi['zend_optimizer']['version'] = $match[1];
			}
			if(preg_match('/with Zend Extension Manager v([0-9.]{1,})/i', $data, $match)) {
				$pi['zend_optimizer']['extension_manager'] = $match[1];
			}
		}
		
		if(preg_match('/with the ionCube PHP Loader v([0-9.]{1,})/i', $data, $match)) {
			$pi['ioncube']['version'] = $match[1];
		}
		
		if($return && $subname) {
			return isset($pi[$return][$subname]) ? $pi[$return][$subname] : '';
		} elseif($return && !$subname) {
			return isset($pi[$return]) ? $pi[$return] : array();
		} else {
			return $pi;
		}
		
	}
	

	$isInstalled = false;
	if(file_exists($_SERVER['DOCUMENT_ROOT'].'/scripthub/config/config.php')) {
		$isInstalled = true;
	}

	$languages = array();
	if(function_exists('scandir')) {
		$buff = scandir($_SERVER['DOCUMENT_ROOT'].'/scripthub/lang/');
		if(is_array($buff)) {
			foreach($buff as $f) {
				if(is_file($_SERVER['DOCUMENT_ROOT'].'/scripthub/lang/'.$f)) {
					$f = basename($f, '.php');
					$languages[$f] = $f;
				} 
			}
		}	
	}
	
	
	if(isset($_POST['install']) && !$isInstalled) {
		
		$error = '';
		
		/// new
		
		if(substr(sprintf('%o', fileperms($_SERVER['DOCUMENT_ROOT'].'/scripthub/core/data/cache/')), -4) != '0777') {
			$error .= 'You must set writing permission (0777) on /scripthub/core/data/cache/ and all subfolders<br />';
		} else {
			if(substr(sprintf('%o', fileperms($_SERVER['DOCUMENT_ROOT'].'/scripthub/core/data/cache/session/')), -4) != '0777') {
				$error .= 'You must set writing permission (0777) on /scripthub/core/data/cache/session/<br />';
			}
			if(substr(sprintf('%o', fileperms($_SERVER['DOCUMENT_ROOT'].'/scripthub/core/data/cache/templates_cache/')), -4) != '0777') {
				$error .= 'You must set writing permission (0777) on /scripthub/core/data/cache/templates_cache/<br />';
			}
		}
		
		if(substr(sprintf('%o', fileperms($_SERVER['DOCUMENT_ROOT'].'/scripthub/core/data/logs/')), -4) != '0777') {
			$error .= 'You must set writing permission (0777) on /scripthub/core/data/logs/<br />';
		}
		
		if(substr(sprintf('%o', fileperms($_SERVER['DOCUMENT_ROOT'].'/static/uploads/')), -4) != '0777') {
			$error .= 'You must set writing permission (0777) on /static/uploads/<br />';
		}
		
		if(substr(sprintf('%o', fileperms($_SERVER['DOCUMENT_ROOT'].'/scripthub/config/')), -4) != '0777') {
			$error .= 'You must set writing permission (0777) on /scripthub/config/<br />';
		}
		
		if(!$error && (!file_exists($_SERVER['DOCUMENT_ROOT'].'/scripthub/config/') || !is_dir($_SERVER['DOCUMENT_ROOT'].'/scripthub/config/'))) {
			if(!@mkdir($_SERVER['DOCUMENT_ROOT'].'/scripthub/config/', 0777, true)) {
				$error .= 'Folder "' . $_SERVER['DOCUMENT_ROOT'] . '/scripthub/config/" can not be created<br />';
			}
		}
		
		if(!in_array('zlib', get_loaded_extensions())) {
			$error .= 'The ZipArchive class uses the functions of Â» zlib<br />';
		}
		
		if(!function_exists('fopen')) {
			$error .= 'Function "fopen" should be active<br />';
		}
		
		if(!function_exists('curl_init')) {
			$error .= 'Function "curl" should be active<br />';
		}
		
		if(!function_exists('scandir')) {
			$error .= 'Function "scandir" should be active<br />';
		}
		
		if(!function_exists('mysql_connect')) {
			$error .= 'Function "mysql_connect" should be active<br />';
		}
		
		if(!version_compare("5.2", phpversion(), "<=")) {
			$error .= 'PHP 5 >= 5.2 is required<br />';
		}
		
		
		if(phpinfo_array('apache2handler') && phpinfo_array('apache2handler', 'loaded_modules') && strpos(phpinfo_array('apache2handler', 'loaded_modules'), 'mod_rewrite') === false) {
			$error .= 'Apache mod_rewrite is required<br />';
		}
		
		if(!version_compare("2.0", preg_replace('/([^0-9.]{1,})/i', '$2', phpinfo_array('gd', 'gd_version')), "<=")) {
			$error .= 'PHP GD2 >= 2.0 is required<br />';
		}
		
		//end new error
		
		if(!isset($_POST['mysql_host']) || trim($_POST['mysql_host']) == '') {
			$error .= 'Please fill MySQL host<br />';
		}
		if(!isset($_POST['mysql_user']) || trim($_POST['mysql_user']) == '') {
			$error .= 'Please fill MySQL username<br />';
		}
		if(!isset($_POST['mysql_pass']) || trim($_POST['mysql_pass']) == '') {
			$error .= 'Please fill MySQL password<br />';
		}
		if(!isset($_POST['mysql_db']) || trim($_POST['mysql_db']) == '') {
			$error .= 'Please fill MySQL database<br />';
		}
		if(!isset($_POST['admin_mail']) || !check_email($_POST['admin_mail'])) {
			$error .= 'Please fill administrator e-mail<br />';
		}
		if(!isset($_POST['report_mail']) || !check_email($_POST['report_mail'])) {
			$error .= 'Please fill e-mail for reports<br />';
		}
		if(!isset($_POST['paypal_email']) || !check_email($_POST['paypal_email'])) {
			$error .= 'Please fill e-mail for PayPal payments<br />';
		}
		if(!isset($_POST['recaptcha_public_key']) || trim($_POST['recaptcha_public_key']) == '') {
			$error .= 'Please fill reCAPTCHA public key<br />';
		}
		if(!isset($_POST['recaptcha_private_key']) || trim($_POST['recaptcha_private_key']) == '') {
			$error .= 'Please fill reCAPTCHA private key<br />';
		}
		if(!isset($_POST['meta_title']) || trim($_POST['meta_title']) == '') {
			$error .= 'Please fill meta title<br />';
		}
		if(!isset($_POST['meta_keywords']) || trim($_POST['meta_keywords']) == '') {
			$error .= 'Please fill meta keywords<br />';
		}
		if(!isset($_POST['meta_description']) || trim($_POST['meta_description']) == '') {
			$error .= 'Please fill meta description<br />';
		}
		if(!isset($_POST['lang']) || trim($_POST['lang']) == '') {
			$error .= 'Please choose language<br />';
		}
		
		if($error == '') {
			
			$dbl = mysql_connect($_POST['mysql_host'], $_POST['mysql_user'], $_POST['mysql_pass']);
			if($dbl === FALSE) {
				$error .= 'Cannot connect to MySQL. Please fill correct data<br />';
			}
			else {
				$s = mysql_select_db($_POST['mysql_db']);
				if($s === FALSE) {
					$error .= 'Wrong database. Please fill correct database<br />';
				}
			}
			
			if($error == '') {
				
				$dm = $_SERVER['HTTP_HOST'];
				if(substr($dm, 0, 4) == 'www.') {
					$dm = substr($dm, 4);
				}
				
				mysql_set_charset('utf8');
				
				copy($_SERVER['DOCUMENT_ROOT'].'/scripthub/lang/'.$_POST['lang'].'.php', $_SERVER['DOCUMENT_ROOT'].'/scripthub/config/lang.php');
			
				$handle = fopen($_SERVER['DOCUMENT_ROOT'].'/scripthub/config/current.txt', 'w');
					fwrite($handle, $_POST['lang']);
				fclose($handle);
			
				$fp = fopen($_SERVER['DOCUMENT_ROOT'].'/scripthub/config/config.php', 'w');
					fwrite($fp, "<?php \n\n");
					fwrite($fp, '$configArr = array('."\n");
					fwrite($fp, '	\'scripthub_core\' => \''. preg_replace('/[\/]{2,}/','/', $_SERVER['DOCUMENT_ROOT'].'/scripthub/core/') . '\', '."\n");
					fwrite($fp, '	\'root_path\' => \''.preg_replace('/[\/]{2,}/','/',$_SERVER['DOCUMENT_ROOT'].'/') . '\', '."\n");
					fwrite($fp, '	\'domain\' => \''.$dm.'\', '."\n");
					fwrite($fp, '	\'mysql_host\' => \''.$_POST['mysql_host'].'\', '."\n");
					fwrite($fp, '	\'mysql_user\' => \''.$_POST['mysql_user'].'\', '."\n");
					fwrite($fp, '	\'mysql_pass\' => \''.$_POST['mysql_pass'].'\', '."\n");
					fwrite($fp, '	\'mysql_db\' => \''.$_POST['mysql_db'].'\', '."\n");
					fwrite($fp, '	\'recaptcha_public_key\' => \''.$_POST['recaptcha_public_key'].'\', '."\n");
					fwrite($fp, '	\'recaptcha_private_key\' => \''.$_POST['recaptcha_private_key'].'\', '."\n");
					fwrite($fp, '); '."\n\n");
					fwrite($fp, '?>');											
				fclose($fp);

				$adminPassword = rand(0,9999).rand(0,9999).rand(0,9999);
				
				require_once 'db.php';
				
				mysql_close($dbl);
				
				$complete = 'yes';
				
			}
			
		}
		
	}
	else {
		$_POST['mysql_host'] = '';
		$_POST['mysql_user'] = '';
		$_POST['mysql_pass'] = '';
		$_POST['mysql_db'] = '';
		$_POST['admin_mail'] = '';
		$_POST['report_mail'] = '';
		$_POST['paypal_email'] = '';
		$_POST['meta_title'] = '';
		$_POST['meta_keywords'] = '';
		$_POST['meta_description'] = '';
		$_POST['lang'] = '';
		$_POST['recaptcha_public_key'] = '';
		$_POST['recaptcha_private_key'] = '';
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
	<title>Installation</title>
	<link rel="stylesheet" type="text/css" href="/static/css/style.css"/>
</head>
<body>
<header>
  <div class="container">
  <a href="/" class="marketplace"><img alt="zipmarket.net" src="/static/logo/logo-dark.png" title="zipmarket.net"></a>
  <div class="account-wrapper">
    <ul id="user-account-nav">
        <li><a href="/sign_up/"><span>Create Account</span></a></li>
        <li>
          <a href="/sign_in/" rel="nofollow">Sign In</a>
        </li>
    </ul>
  </div>
  <ul class="info-nav">
  <li><a href="/make_money/become_an_author">Make Money</a>
      <div class="dropdown">
        <ul>
          <li><a href="/make_money/become_an_author">Become an Author</a></li>
          <li><a href="/make_money/payment_rates">Payment Rates</a></li>
        </ul>
      </div>
    </li>
	<li><a href="#">Community</a>
      <div class="dropdown">
        <ul>
          <li><a href="/collections/">Public Collections</a></li>
          <li><a href="/feature/">Featured Files</a></li>
          <li><a href="/top_sellers/">Popular Files</a></li>
          <li><a href="/top_authors/">Top Authors</a></li>
        </ul>
      </div>
    </li>
<li><a href="/make_money/affiliate_program">Affiliates</a>
      <div class="dropdown">
        <ul>
          <li><a href="/make_money/affiliate_program">Affiliate Program</a></li>
          <li><a href="/make_money/banners_and_logos">Banners &amp; Logos</a></li>
        </ul>
      </div>
    </li>
  
  <li><a href="/support/">Help</a>
      <div class="dropdown">
        <ul>
          <li><a href="/help/getting_started/">Getting Started</a></li>
          <li><a href="/support/">Support Contact</a></li>
          <li><a href="/help/licenses">Licenses</a></li>
          <li><a href="/help/legal/">Legal Agreements</a></li>
            <li><a href="/categories/">Sitemap</a></li>
        </ul>
      </div>
    </li>
  </ul>
  </div> <!-- end .container -->
</header>
<div class="page-info">
    <div class="container">
      <div id="breadcrumbs">
        <a href="/" class="first">Home</a>\</div>
       <h1 class="page-title">Installation</h1>
    </div>
      <div id="tabsy">
          <ul>
		    <li class="selected"><div></div><a href="#">Installation</a></li>
            <li class=""><div></div><a href="#">Dashboard</a></li>
			<li class=""><div></div><a href="#">Profile</a></li>
		    <li class=""><div></div><a href="#">My Settings</a></li>
			<li class=""><div></div><a href="#">Downloads</a></li>
			<li class=""><div></div><a href="#">Bookmarks</a></li>
			<li class=""><div></div><a href="#">Deposit</a></li>
			<li class=""><div></div><a href="#">History</a></li>
			<li class=""><div></div><a href="#">Withdrawal</a></li>
			<li class=""><div></div><a href="#">Earnings</a></li>
			<li class="last"><div></div><a href="#">Statement</a><div class="last"></div></li>
          </ul>
      </div>
  </div>
	<div id="content">
	    <div class="container">
<?php 
	if($isInstalled) {
?>		
			<div class="notice error">
					<strong>Your system has been installed!</strong>
					<br /><br />
					<strong>PLEASE REMEMBER TO DELETE THE "/zipmarket/setup/" FOLDER.</strong>
			</div>		
<?php 			
	}
	elseif(isset($complete)) {
?>		
			<div class="notice flash">
					<strong>Congratulations! System installed successfully!!!</strong>
					<br /><br />
					Username: <strong><?php echo $_POST['admin_username']; ?></strong>
					<br /><br />
					Password: <strong><?php echo $adminPassword; ?></strong>
					<br /><br />
					<a href="/" title="" target="_blank">Go to the Site</a>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<a href="/admin/" title=""  target="_blank">Go to admin panel</a>
			</div>
<?php						
	}
	else {
?>

<?php 
	if(isset($error) && $error != '') {
?>		
			<div class="box2">
				<div class="box_error"><?php echo $error; ?></div>
			</div>
<?php						
	}
	
	$fas_error = false;
?>

			
			<?php if(substr(sprintf('%o', fileperms($_SERVER['DOCUMENT_ROOT'].'/scripthub/core/data/cache/')), -4) != '0777') { ?>
			<div class="box2">
				<div class="box_error">
					<strong>Error! </strong>You must set writing permission (0777) on <strong>/zipmarket/core/data/cache/</strong> and all subfolders
				</div>
			</div>
			<?php $fas_error = true; } else { ?>
			
			<?php if(substr(sprintf('%o', fileperms($_SERVER['DOCUMENT_ROOT'].'/scripthub/core/data/cache/session/')), -4) != '0777') { ?>
			<div class="box2">
				<div class="box_error">
					<strong>Error! </strong>You must set writing permission (0777) on <strong>/zipmarket/core/data/cache/session/</strong>
				</div>
			</div>
			<?php $fas_error = true; } ?>
			
			<?php if(substr(sprintf('%o', fileperms($_SERVER['DOCUMENT_ROOT'].'/scripthub/core/data/cache/templates_cache/')), -4) != '0777') { ?>
			<div class="box2">
				<div class="box_error">
					<strong>Error! </strong>You must set writing permission (0777) on <strong>/zipmarket/core/data/cache/templates_cache/</strong>
				</div>
			</div>
			<?php $fas_error = true; } ?>
			<?php } ?>
			
			<?php if(substr(sprintf('%o', fileperms($_SERVER['DOCUMENT_ROOT'].'/scripthub/core/data/logs/')), -4) != '0777') { ?>
			<div class="box2">
				<div class="box_error">
					<strong>Error! </strong>You must set writing permission (0777) on <strong>/zipmarket/core/data/logs/</strong>
				</div>
			</div>
			<?php $fas_error = true; } ?>
			
			<?php if(substr(sprintf('%o', fileperms($_SERVER['DOCUMENT_ROOT'].'/static/uploads/')), -4) != '0777') { ?>
			<div class="box2">
				<div class="box_error">
					<strong>Error! </strong>You must set writing permission (0777) on <strong>/static/uploads/</strong>
				</div>
			</div>
			<?php $fas_error = true; } ?>
			
			<?php if(substr(sprintf('%o', fileperms($_SERVER['DOCUMENT_ROOT'].'/scripthub/config/')), -4) != '0777') { ?>
			<div class="box2">
				<div class="box_error">
					<strong>Error! </strong>You must set writing permission (0777) on <strong>/zipmarket/config/</strong>
				</div>
			</div>
			<?php $fas_error = true; } ?>
			
			<?php if(!in_array('zlib', get_loaded_extensions())) { ?>
			<div class="box2">
				<div class="box_error">
					<strong>Error! </strong>The ZipArchive class uses the functions of Â» zlib
				</div>
			</div>
			<?php $fas_error = true; } ?>
			
			<?php if(!function_exists('fopen')) { ?>
			<div class="box2">
				<div class="box_error">
					<strong>Error! </strong>Function "fopen" should be active
				</div>
			</div>
			<?php $fas_error = true; } ?>
			
			<?php if(!function_exists('scandir')) { ?>
			<div class="box2">
				<div class="box_error">
					<strong>Error! </strong>Function "scandir" should be active
				</div>
			</div>
			<?php $fas_error = true; } ?>
			
			<?php if(!function_exists('curl_init')) { ?>
			<div class="box2">
				<div class="box_error">
					<strong>Error! </strong>Function "curl" should be active
				</div>
			</div>
			<?php $fas_error = true; } ?>
			
			<?php if(!function_exists('mysql_connect')) { ?>
			<div class="box2">
				<div class="box_error">
					<strong>Error! </strong>Function "mysql_connect" should be active
				</div>
			</div>
			<?php $fas_error = true; } ?>
			
			<?php if(!version_compare("5.2", phpversion(), "<=")) { ?>
			<div class="box2">
				<div class="box_error">
					<strong>Error! </strong>PHP 5 >= 5.2 is required
				</div>
			</div>
			<?php $fas_error = true; } ?>
			
			<?php if(phpinfo_array('apache2handler') && phpinfo_array('apache2handler', 'loaded_modules') && strpos(phpinfo_array('apache2handler', 'loaded_modules'), 'mod_rewrite') === false) { ?>
			<div class="box2">
				<div class="box_error">
					<strong>Error! </strong>Apache mod_rewrite is required
				</div>
			</div>
			<?php $fas_error = true; } ?>
			
			<?php if(!version_compare("2.0", preg_replace('/([^0-9.]{1,})/i', '$2', phpinfo_array('gd', 'gd_version')), "<=")) { ?>
			<div class="box2">
				<div class="box_error">
					<strong>Error! </strong>PHP GD2 >= 2.0 is required
				</div>
			</div>
			<?php $fas_error = true; } ?>
			
			<?php if(!$fas_error) { ?>
			<div class="content-s">
				
		
					<form class="horizontal-form disable-on-submit" method="post" action="">
					<div class="content-box">
<fieldset>

        <div class="input-group">
          <label for="mysql_host">Database Host</label>
          <div class="inputs">
            <input id="mysql_host" name="mysql_host" required="true" value="<?php echo htmlspecialchars($_POST['mysql_host']); ?>" type="text">
          </div>
        </div>
		
		
        <div class="input-group">
          <label for="mysql_user">DB Username</label>
          <div class="inputs">
            <input id="mysql_user" required="true" name="mysql_user" value="<?php echo htmlspecialchars($_POST['mysql_user']); ?>" type="text">
          </div>
        </div>

        <div class="input-group">
          <label for="mysql_pass">DB Password</label>
          <div class="inputs">
            <input id="mysql_pass" required="true" name="mysql_pass" value="<?php echo htmlspecialchars($_POST['mysql_pass']); ?>" type="text">
          </div>
        </div>
		
		
        <div class="input-group">
          <label for="mysql_db">DB Name</label>
          <div class="inputs">
            <input id="mysql_db" required="true" name="mysql_db" value="<?php echo htmlspecialchars($_POST['mysql_db']); ?>" type="text">
          </div>
        </div>
		
</div>
<div class="content-box">

        <div class="input-group">
          <label for="admin_username">Admin username</label>
          <div class="inputs">
            <input id="admin_username" required="true" name="admin_username" value="<?php echo htmlspecialchars($_POST['admin_username']); ?>" type="text">
          </div>
        </div>
		
		
        <div class="input-group">
          <label for="admin_mail">Admin e-mail</label>
          <div class="inputs">
            <input id="admin_mail" required="true" name="admin_mail" value="<?php echo htmlspecialchars($_POST['admin_mail']); ?>" type="text">
          </div>
        </div>
		
		
        <div class="input-group">
          <label for="report_mail">E-mail for reports</label>
          <div class="inputs">
            <input id="report_mail" required="true" name="report_mail" value="<?php echo htmlspecialchars($_POST['report_mail']); ?>" type="text">
          </div>
        </div>

        <div class="input-group">
          <label for="paypal_email">PayPal e-mail</label>
          <div class="inputs">
            <input id="paypal_email" required="true" name="paypal_email" value="<?php echo htmlspecialchars($_POST['paypal_email']); ?>" type="text">
          </div>
        </div>
		
</div>
<div class="content-box">
        <div class="input-group">
          <label for="recaptcha_public_key">reCAPTCHA Public Key</label>
          <div class="inputs">
            <input id="recaptcha_public_key" required="true" name="recaptcha_public_key" value="<?php echo htmlspecialchars($_POST['recaptcha_public_key']); ?>" type="text">
			<small><a href="https://www.google.com/recaptcha/admin/create" title="" target="_blank">Generate </a>reCaptcha Keys</small>
          </div>
        </div>

        <div class="input-group">
          <label for="recaptcha_private_key">reCAPTCHA Private Key</label>
          <div class="inputs">
            <input id="recaptcha_private_key" required="true" name="recaptcha_private_key" value="<?php echo htmlspecialchars($_POST['recaptcha_private_key']); ?>" type="text">
          </div>
        </div>
		
</div>
<div class="content-box">
     
	 <div class="input-group">
          <label for="meta_title">Meta title</label>
          <div class="inputs">
            <input id="meta_title" required="true" name="meta_title" value="<?php echo htmlspecialchars($_POST['meta_title']); ?>" type="text">
          </div>
        </div>
		
        <div class="input-group">
          <label for="meta_keywords">Meta keywords</label>
          <div class="inputs">
            <input id="meta_keywords" required="true" name="meta_keywords" value="<?php echo htmlspecialchars($_POST['meta_keywords']); ?>" type="text">
          </div>
        </div>

        <div class="input-group">
          <label for="meta_description">Meta description</label>
          <div class="inputs">
            <input id="meta_description" required="true" name="meta_description" value="<?php echo htmlspecialchars($_POST['meta_description']); ?>" type="text">
          </div>
        </div>
		
<div class="input-group" style="display:none;">
          <label for="country">Language</label>
          <div class="inputs">
						<select name="lang">
<?php 
						if(isset($languages)) {
							foreach($languages as $l) {
								echo '<option value="'.$l.'"';
								if($_POST['lang'] == $l) echo ' selected="selected" ';
								echo '>'.$l.'</option>';									
							}
						}
?>						
						</select>
          </div>
        </div>
		
		<div class="form-submit">
          <button id="personal_info_submit_button" name="install" class="btn-icon save" type="submit">Install</button>
        </div>
</div>		


     	</fieldset>
					</form>										
			</div>
				
				
<div class="sidebar-l sidebar-right">

		<h2 class="box-heading">Finding and Buying Items</h2>
	<div class="content-box">
	
<p>There are lots of ways to find the items you want:</p>
<ol class="text-list decimal">
  <li><strong><a href="/categories/">Category List</a></strong> – Browse zipmarket.net extensive category list here.</li>
  <li><strong>Keyword Search</strong>– Access the search field on the top right of any page.</li>
  <li><strong><a href="/items/top_sellers/">Popular Files</a></strong> – Check out our weekly summary of the most popular items</li>
  <li><strong><a href="/collections/">Collections</a></strong> – Browse our user-compiled item collections on a variety of themes</li>
  <li><strong><a href="/items/feature/">Featured Files</a></strong> – Handx-picked by our site editors each week</li>
  <li><strong><a href="/users/top/">Top Authors</a></strong> – Look through the portfolios of our top authors</li>
</ol>
	
       </div>

	</div>
				
			<?php } ?>
			
<?php 
	}
?>			
		
		</div>		
	</div> <!-- end of content -->
	
<div id="footer" class="large">
  <div class="container">
    <div class="left">
          <div class="follow-us">
  <h3>Follow us</h3>
  <a href="#" class="blog" rel="nofollow">Subscribe to Blog</a>
  <br>
  <a href="#" class="twitter" rel="nofollow">Follow us on Twitter</a>
  <br>
  <a href="#" class="facebook" rel="nofollow">Be a fan on Facebook</a>
  <br>
  <a href="/rss/" class="rss" rel="nofollow">RSS Feed</a>
</div>
    </div>
    
    <div class="middle">
      <div class="top">
        <div class="content-left" style="margin-top:-15px;">
<div class="newsletter">
  <h3>Monthly Newsletter  </h3>
  <form action="" method="post">
                		<input name="subscribe" value="yes" type="hidden">
					<input class="fname" name="bulletin_fname" value="Name" onfocus="this.value='';" id="mce-FNAME" type="text">
					<input class="lname" name="bulletin_lname" value="Last name" onfocus="this.value='';" id="mce-LNAME" type="text">
					<input class="newsletter-mail" name="bulletin_email" value="E-mail" onfocus="this.value='';" id="mce-EMAIL" type="text">							
                       <button type="submit" name="subscribe" id="mc-embedded-subscribe" class="btn-icon submit">Subscribe</button>
                </form>
                
</div>
        </div>
        <div class="content-right" style="margin-top:-15px;">
<div class="stats">
   <h3> Marketplace Members  </h3>
  <p class="file-count">
    0
  </p>

   <h3> Total Marketplace Items  </h3>
  <p class="file-count">
    0
  </p>
</div> 
        </div>
        <div class="clear"></div>
      </div>
      <div>
        <div class="content-left">

        </div>
        <div class="content-right">

		</div>
        <div class="clear"></div>
      </div>
    </div>

    <div class="right">
          <div class="help-and-support">
  <h3>Help and Support</h3>
  <a href="/support/">Contact Support</a>
  <br>
  <a href="/help/legal/">Terms Of Usage</a>
</div>
    </div>
  </div>
</div>
<div id="copyright">
  <div class="container">
    <div class="copyright">
      <p>
        <span>COPYRIGHT © 2013 <a href="/"> SITENAME</a></span>|
        <span><a href="/help/legal/" rel="nofollow">TERMS OF USAGE</a></span>|
        <span><a href="/support/">SUPPORT/HELP</a></span>|
        <span>ICONS BY <a href="http://tango.freedesktop.org" rel="nofollow">TANGO</a> + <a href="http://wefunction.com" rel="nofollow">WEFUNCTION</a> + <a href="http://famfamfam.com" rel="nofollow">FAMFAMFAM</a></span>
      </p>
      <p class="trademarks">Adobe®, Flash®, Flex®, Fireworks®, Photoshop®, Illustrator®, InDesign® and After Effects® are registered trademarks of Adobe Systems Incorporated.</p>
    </div>
  </div>
</div>
</body>
</html>