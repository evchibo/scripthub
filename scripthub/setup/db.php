<?php
/**
 * Copyright (c) 2018.
 * KarmaTechs
 * Evan Karma Alias MADSkill
 * madskill.madskill@gmail.com
 * https://sociamater.com
 */

function sql_quote($value, $toStrip = true) {
	$value = str_replace('<x>', '', $value);
	if(get_magic_quotes_gpc()) {
		$value = stripslashes($value);
	}
	$value = addslashes($value);
	
	return $value;
}


	mysql_query("
		ALTER DATABASE `" . $_POST['mysql_db'] . "` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci
	");
	
	mysql_query("
		CREATE TABLE IF NOT EXISTS `attributes` (
		  `id` int(11) NOT NULL auto_increment,
		  `category_id` int(11) NOT NULL,
		  `name` varchar(255) NOT NULL,
		  `photo` varchar(255) NOT NULL,
		  `visible` enum('true','false') NOT NULL default 'false',
		  `order_index` int(11) NOT NULL default '0',
		  PRIMARY KEY  (`id`)
		) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=172 ;
	");
	
	mysql_query("
(33, 7, 'IE6', '', 'true', 1),
(34, 7, 'IE7', '', 'false', 2),
(35, 7, 'IE8', '', 'false', 3),
(36, 7, 'IE9', '', 'false', 4),
(37, 7, 'IE10', '', 'false', 5),
(38, 7, 'Firefox', '', 'false', 6),
(39, 7, 'Safari', '', 'false', 7),
(40, 7, 'Opera', '', 'false', 8),
(41, 7, 'Chrome', '', 'false', 9),
(42, 8, 'JavaScript JS', '', 'false', 1),
(43, 8, 'JavaScript JSON', '', 'false', 2),
(44, 8, 'HTML', '', 'false', 3),
(45, 8, 'XML', '', 'false', 4),
(46, 8, 'CSS', '', 'false', 5),
(47, 8, 'PHP', '', 'false', 6),
(48, 8, 'SWF/FLV', '', 'false', 7),
(49, 8, 'SQL', '', 'false', 8),
(50, 8, 'LESS', '', 'false', 9),
(51, 8, 'Layered PSD', '', 'false', 10),
(52, 8, 'Layered PNG', '', 'false', 11),
(53, 9, 'jQuery', '', 'false', 1),
(54, 9, 'MooTools 1.2', '', 'false', 2),
(55, 9, 'MooTools 1.3', '', 'false', 3),
(56, 9, 'MooTools 1.4', '', 'false', 4),
(57, 9, 'MooTools 1.4.5', '', 'false', 5),
(58, 9, 'YUI 2', '', 'false', 6),
(59, 9, 'YUI 3', '', 'false', 7),
(60, 9, 'EXT JS 3', '', 'false', 8),
(61, 9, 'EXT JS 4', '', 'false', 9),
(62, 9, 'Other', '', 'false', 10),
(63, 10, 'CodeIgniter', '', 'false', 1),
(64, 10, 'Kohana', '', 'false', 2),
(65, 10, 'CakePHP', '', 'false', 3),
(66, 10, 'Zend', '', 'false', 4),
(67, 10, 'Symfony', '', 'false', 5),
(68, 10, 'Yii', '', 'false', 6),
(69, 10, 'Lithium', '', 'false', 7),
(70, 10, 'Solar', '', 'false', 8),
(71, 11, 'PHP 4.x', '', 'false', 1),
(72, 11, 'PHP 5.x', '', 'false', 2),
(73, 11, 'PHP 5.0-5.2', '', 'false', 3),
(74, 11, 'PHP 5.3', '', 'false', 4),
(75, 11, 'PHP 5.4', '', 'false', 5),
(76, 11, 'MySQL 4.x ', '', 'false', 6),
(77, 11, 'MySQL 5.x ', '', 'false', 7),
(78, 11, 'Other', '', 'false', 8),
(79, 12, '.Net 2.0', '', 'false', 1),
(80, 12, '.Net 3.0', '', 'false', 2),
(81, 12, '.Net 3.5', '', 'false', 3),
(82, 12, '.Net 3.7', '', 'false', 4),
(83, 12, '.Net 4.0', '', 'false', 5),
(84, 12, '.Net 4.5', '', 'false', 6),
(85, 12, 'Other', '', 'false', 7),
(86, 8, 'Active Server Control ASCX', '', 'false', 12),
(87, 8, 'Active Server Page ASPX', '', 'false', 13),
(88, 8, 'Visual Basic VB', '', 'false', 14),
(89, 8, 'C# CS', '', 'false', 15),
(90, 13, 'WordPress 3.0', '', 'false', 1),
(91, 13, 'WordPress 3.1', '', 'false', 2),
(92, 13, 'WordPress 3.2', '', 'false', 3),
(93, 13, 'WordPress 3.3', '', 'false', 4),
(94, 13, 'WordPress 3.4', '', 'false', 5),
(95, 13, 'WordPress 3.5', '', 'false', 6),
(96, 13, 'WordPress 3.6', '', 'false', 7),
(97, 13, 'Other', '', 'false', 8),
(98, 14, 'BuddyPress 1.5.x', '', 'false', 1),
(100, 14, 'BuddyPress 1.6.x', '', 'false', 3),
(101, 14, 'BuddyPress 1.7.x', '', 'false', 4),
(102, 14, 'WP e-Commerce 3.8.x', '', 'false', 5),
(103, 14, 'WooCommerce 1.3.x', '', 'false', 6),
(104, 14, 'WooCommerce 1.4.x', '', 'false', 7),
(105, 14, 'WooCommerce 1.5.x', '', 'false', 8),
(106, 14, 'WooCommerce 1.6.x', '', 'false', 9),
(107, 14, 'WooCommerce 2.0.x', '', 'false', 10),
(108, 14, 'Jigoshop 1.0', '', 'false', 11),
(109, 14, 'Jigoshop 1.2', '', 'false', 12),
(110, 14, 'Jigoshop 1.4.x', '', 'false', 13),
(111, 14, 'Jigoshop 1.5.x', '', 'false', 14),
(112, 14, 'Jigoshop 1.6.x', '', 'false', 15),
(113, 14, 'Bootstrap 1.x', '', 'false', 16),
(114, 14, 'Bootstrap 2.0.x', '', 'false', 17),
(115, 14, 'Bootstrap 2.1.x', '', 'false', 18),
(116, 14, 'Bootstrap 2.2.x', '', 'false', 19),
(117, 14, 'Bootstrap 2.3.x', '', 'false', 20),
(118, 15, 'CSS2', '', 'false', 1),
(119, 15, 'CSS3', '', 'false', 2),
(120, 15, 'Other', '', 'false', 3),
(121, 16, '.h', '', 'false', 1),
(122, 16, '.m', '', 'false', 2),
(123, 16, '.pch', '', 'false', 3),
(124, 16, '.xib/.nib', '', 'false', 4),
(125, 16, 'Layered PSD', '', 'false', 5),
(126, 16, 'Layered PNG', '', 'false', 6),
(127, 17, 'IOS 3.1', '', 'false', 1),
(128, 17, 'IOS 4.1', '', 'false', 2),
(129, 17, 'IOS 4.2', '', 'false', 3),
(130, 17, 'IOS 4.3', '', 'false', 4),
(131, 17, 'IOS 5.0', '', 'false', 5),
(132, 17, 'IOS 6.0', '', 'false', 6),
(133, 17, 'IOS 6.1.x', '', 'false', 7),
(134, 18, 'Windows XP', '', 'false', 1),
(135, 18, 'Windows Vista', '', 'false', 2),
(136, 18, 'Windows 7', '', 'false', 3),
(137, 18, 'Windows 8', '', 'false', 4),
(138, 19, 'Native', '', 'false', 1),
(139, 19, 'Java', '', 'false', 2),
(140, 19, 'Adobe AIR', '', 'false', 3),
(141, 19, '.NET 2', '', 'false', 4),
(142, 19, '.NET 3', '', 'false', 5),
(143, 19, '.NET 4', '', 'false', 6),
(144, 20, 'Bootstrap 2.0.2', '', 'false', 1),
(145, 20, 'Bootstrap 2.1.1', '', 'false', 2),
(146, 20, 'Bootstrap 2.2.1', '', 'false', 3),
(147, 20, 'Bootstrap 2.2.2', '', 'false', 4),
(148, 20, 'Bootstrap 2.3.x', '', 'false', 5),
(149, 20, 'Other', '', 'false', 6),
(150, 17, 'Android OS  1.x', '', 'false', 8),
(151, 17, 'Android OS  2.x', '', 'false', 9),
(152, 17, 'Android OS  3.x', '', 'false', 10),
(153, 17, 'Android OS  4.x', '', 'false', 11),
(154, 16, '.apk', '', 'false', 7),
(155, 18, 'Mac OS X 10.4', '', 'false', 5),
(156, 18, 'Mac OS X 10.5', '', 'false', 6),
(157, 18, 'Mac OS X 10.6', '', 'false', 7),
(158, 18, 'Mac OS X 10.7', '', 'false', 8),
(159, 7, 'N/A', '', 'false', 10),
(160, 9, 'N/A', '', 'false', 11),
(161, 10, 'N/A', '', 'false', 9),
(162, 11, 'N/A', '', 'false', 9),
(163, 12, 'N/A', '', 'false', 8),
(164, 13, 'N/A', '', 'false', 9),
(165, 14, 'N/A', '', 'false', 21),
(166, 15, 'N/A', '', 'false', 4),
(167, 16, 'N/A', '', 'false', 8),
(168, 17, 'N/A', '', 'false', 12),
(169, 18, 'N/A', '', 'false', 9),
(170, 19, 'N/A', '', 'false', 7),
(171, 20, 'N/A', '', 'false', 7);
	");

	mysql_query("
		CREATE TABLE IF NOT EXISTS `attributes_categories` (
		  `id` int(11) NOT NULL auto_increment,
		  `name` varchar(255) NOT NULL,
          `type` enum('select','multiple','check','radio','input') COLLATE utf8_unicode_ci NOT NULL,
		  `categories` TEXT NOT NULL,
		  `visible` enum('true','false') NOT NULL default 'false',
		  `order_index` int(11) NOT NULL,
		  PRIMARY KEY  (`id`)
		) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;
	");

	mysql_query("
		INSERT INTO `attributes_categories` (`id`, `name`, `type`, `categories`, `visible`, `order_index`) VALUES
           (7, 'Compatible Browsers', 'multiple', ',205,206,207,208,209,210,211,377,', 'true', 1),
           (8, 'Files Included', 'multiple', ',205,206,207,208,209,210,211,377,', 'true', 2),
           (9, 'Software Version', 'multiple', ',205,', 'true', 3),
           (10, 'Software Framework', 'multiple', ',206,', 'true', 4),
           (11, 'Software Version', 'multiple', ',206,', 'true', 5),
           (12, 'Software Version', 'multiple', ',207,', 'true', 6),
           (13, 'Software Version', 'multiple', ',208,', 'true', 7),
           (14, 'Compatible With', 'multiple', ',208,', 'true', 8),
           (15, 'Software Version', 'multiple', ',210,', 'true', 9),
           (16, 'Files Included', 'multiple', ',212,', 'true', 10),
           (17, 'Mobile OS', 'multiple', ',212,', 'true', 11),
           (18, 'Compatible OS Versions', 'multiple', ',376,', 'true', 12),
           (19, ' Application Runtime', 'select', ',376,', 'true', 13),
           (20, 'Software Version', 'multiple', ',377,', 'true', 14);
	");
	
	mysql_query("
		CREATE TABLE IF NOT EXISTS `bulletin` (
		  `id` int(11) NOT NULL auto_increment,
		  `name` varchar(255) NOT NULL,
		  `text` longtext NOT NULL,
		  `datetime` datetime NOT NULL,
		  `send_to` varchar(20) NOT NULL,
		  `send_id` int(11) NOT NULL,
		  `readed` int(11) NOT NULL default '0',
		  PRIMARY KEY  (`id`)
		) ENGINE=MyISAM;
	");

	mysql_query("
		CREATE TABLE IF NOT EXISTS `bulletin_emails` (
		  `id` int(11) NOT NULL auto_increment,
		  `firstname` varchar(255) NOT NULL,
		  `lastname` varchar(255) NOT NULL,
		  `email` varchar(255) NOT NULL,
		  `bulletin_subscribe` enum('true','false') NOT NULL default 'true',
		  PRIMARY KEY  (`id`)
		) ENGINE=MyISAM;
	");

	mysql_query("
		CREATE TABLE IF NOT EXISTS `bulletin_template` (
		  `id` int(11) NOT NULL auto_increment,
		  `template` longtext NOT NULL,
		  PRIMARY KEY  (`id`)
		) ENGINE=MyISAM;
	");

	mysql_query('
		INSERT INTO `bulletin_template` (`id`, `template`) VALUES
		(1, \'<html>\r\n<head>\r\n</head>\r\n<body>\r\n<img src="http://{$DOMAIN}/bulletin/read/?bulletin_id={$BULLETINID}" alt="" />\r\n<br /><br />\r\n\r\n{$CONTENT}\r\n\r\n<br /><br />\r\n<a href="http://{$DOMAIN}/bulletin/delete/?email={$EMAIL}">Отпиши</a>\r\n</body>\r\n</html>\');
	');

	mysql_query("
		CREATE TABLE IF NOT EXISTS `categories` (
		  `id` int(11) NOT NULL auto_increment,
		  `sub_of` int(11) NOT NULL,
		  `meta_title` varchar(255) NOT NULL,
		  `meta_keywords` varchar(255) NOT NULL,
		  `meta_description` text NOT NULL,
		  `name` varchar(255) NOT NULL,
		  `text` longtext NOT NULL,
		  `visible` enum('true','false') NOT NULL default 'false',
		  `order_index` int(11) NOT NULL,
		  PRIMARY KEY  (`id`),
		  KEY `category_id` (`sub_of`)
		) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=386 ;
	");

	mysql_query("
		INSERT INTO `categories` (`id`, `sub_of`, `meta_title`, `meta_keywords`, `meta_description`, `name`, `text`, `visible`, `order_index`) VALUES
(205, 0, 'JavaScript', 'JavaScript', 'JavaScript', 'JavaScript', '<br />\r\n', 'true', 4),
(206, 0, 'PHP Scripts', 'PHP Scripts', 'PHP Scripts', 'PHP Scripts', '<br />\r\n', 'true', 2),
(207, 0, '.NET', '.NET', '.NET', '.NET', '<br />\r\n', 'true', 5),
(208, 0, 'WordPress', 'WordPress', 'WordPress', 'WordPress', '<br />\r\n', 'true', 3),
(209, 0, 'Plugins', 'Plugins', 'Plugins', 'Plugins', '<br />\r\n', 'true', 6),
(210, 0, 'CSS', 'CSS', 'CSS', 'CSS', '<br />\r\n', 'true', 7),
(211, 0, 'HTML5', 'HTML5', 'HTML5', 'HTML5', '<br />\r\n', 'true', 9),
(212, 0, 'Mobile', 'Mobile', 'Mobile', 'Mobile', '<br />\r\n', 'true', 8),
(213, 205, 'Calendars', 'Calendars', 'Calendars', 'Calendars', '<br />\r\n', 'true', 1),
(214, 205, 'Countdowns', 'Countdowns', 'Countdowns', 'Countdowns', '<br />\r\n', 'true', 2),
(215, 205, 'Database Abstractions', 'Database Abstractions', 'Database Abstractions', 'Database Abstractions', '<br />\r\n', 'true', 3),
(216, 205, 'Forms', 'Forms', 'Forms', 'Forms', '<br />\r\n', 'true', 4),
(217, 205, 'Images and Media', 'Images and Media', 'Images and Media', 'Images and Media', '<br />\r\n', 'true', 5),
(218, 205, 'Loaders and Uploaders', 'Loaders and Uploaders', 'Loaders and Uploaders', 'Loaders and Uploaders', '<br />\r\n', 'true', 6),
(219, 205, 'Media', 'Media', 'Media', 'Media', '<br />\r\n', 'true', 7),
(220, 205, 'Navigation', 'Navigation', 'Navigation', 'Navigation', '<br />\r\n', 'true', 8),
(221, 205, 'News Tickers', 'News Tickers', 'News Tickers', 'News Tickers', '<br />\r\n', 'true', 9),
(222, 205, 'Project Management Tools', 'Project Management Tools', 'Project Management Tools', 'Project Management Tools', '<br />\r\n', 'true', 10),
(223, 205, 'Ratings and Charts', 'Ratings and Charts', 'Ratings and Charts', 'Ratings and Charts', '<br />\r\n', 'true', 11),
(224, 205, 'Shopping Carts', 'Shopping Carts', 'Shopping Carts', 'Shopping Carts', '<br />\r\n', 'true', 12),
(225, 205, 'Sliders', 'Sliders', 'Sliders', 'Sliders', '<br />\r\n', 'true', 13),
(226, 205, 'Social Networks', 'Social Networks', 'Social Networks', 'Social Networks', '<br />\r\n', 'true', 14),
(227, 205, 'Miscellaneous', 'Miscellaneous', 'Miscellaneous', 'Miscellaneous', '<br />\r\n', 'true', 15),
(228, 206, 'Calendars', 'Calendars', 'Calendars', 'Calendars', '<br />\r\n', 'true', 1),
(229, 206, 'Countdowns', 'Countdowns', 'Countdowns', 'Countdowns', '<br />\r\n', 'true', 2),
(230, 206, 'Database Abstractions', 'Database Abstractions', 'Database Abstractions', 'Database Abstractions', '<br />\r\n', 'true', 3),
(231, 206, 'Forms', 'Forms', 'Forms', 'Forms', '<br />\r\n', 'true', 4),
(232, 206, 'Help and Support Tools', 'Help and Support Tools', 'Help and Support Tools', 'Help and Support Tools', '<br />\r\n', 'true', 5),
(233, 206, 'Images and Media', 'Images and Media', 'Images and Media', 'Images and Media', '<br />\r\n', 'true', 6),
(234, 206, 'Loaders and Uploaders', 'Loaders and Uploaders', 'Loaders and Uploaders', 'Loaders and Uploaders', '<br />\r\n', 'true', 7),
(235, 206, 'Navigation', 'Navigation', 'Navigation', 'Navigation', '<br />\r\n', 'true', 8),
(236, 206, 'News Tickers', 'News Tickers', 'News Tickers', 'News Tickers', '', 'true', 9),
(237, 206, 'Polls', 'Polls', 'Polls', 'Polls', '<br />\r\n', 'true', 10),
(238, 206, 'Project Management Tools', 'Project Management Tools', 'Project Management Tools', 'Project Management Tools', '<br />\r\n', 'true', 11),
(239, 206, 'Ratings and Charts', 'Ratings and Charts', 'Ratings and Charts', 'Ratings and Charts', '<br />\r\n', 'true', 12),
(240, 206, 'Shopping Carts', 'Shopping Carts', 'Shopping Carts', 'Shopping Carts', '<br />\r\n', 'true', 13),
(241, 206, 'Search', 'Search', 'Search', 'Search', '<br />\r\n', 'true', 14),
(242, 206, 'Social Networking', 'Social Networking', 'Social Networking', 'Social Networking', '<br />\r\n', 'true', 15),
(243, 206, 'Add-ons', 'Add-ons', 'Add-ons', 'Add-ons', '<br />\r\n', 'true', 16),
(244, 206, 'Miscellaneous', 'Miscellaneous', 'Miscellaneous', 'Miscellaneous', '<br />\r\n', 'true', 17),
(245, 207, 'Calendars', 'Calendars', 'Calendars', 'Calendars', '<br />\r\n', 'true', 1),
(246, 207, 'Communication Tools', 'Communication Tools', 'Communication Tools', 'Communication Tools', '<br />\r\n', 'true', 2),
(247, 207, 'Content Management', 'Content Management', 'Content Management', 'Content Management', '<br />\r\n', 'true', 3),
(248, 207, 'Database Abstractions', 'Database Abstractions', 'Database Abstractions', 'Database Abstractions', '<br />\r\n', 'true', 4),
(249, 207, 'eCommerce', 'eCommerce', 'eCommerce', 'eCommerce', '<br />\r\n', 'true', 5),
(250, 207, 'Forms', 'Forms', 'Forms', 'Forms', '<br />\r\n', 'true', 6),
(251, 207, 'Images and Media', 'Images and Media', 'Images and Media', 'Images and Media', '<br />\r\n', 'true', 7),
(252, 207, 'Membership or Authentication Tools', 'Membership or Authentication Tools', 'Membership or Authentication Tools', 'Membership or Authentication Tools', '<br />\r\n', 'true', 8),
(253, 207, 'Polls', 'Polls', 'Polls', 'Polls', '<br />\r\n', 'true', 9),
(254, 207, 'Project Management Tools', 'Project Management Tools', 'Project Management Tools', 'Project Management Tools', '<br />\r\n', 'true', 10),
(255, 207, 'Ratings and Charts', 'Ratings and Charts', 'Ratings and Charts', 'Ratings and Charts', '<br />\r\n', 'true', 11),
(256, 207, 'Shopping Carts', 'Shopping Carts', 'Shopping Carts', 'Shopping Carts', '<br />\r\n', 'true', 12),
(257, 207, 'Social Networking', 'Social Networking', 'Social Networking', 'Social Networking', '<br />\r\n', 'true', 13),
(258, 207, 'Add-ons', 'Add-ons', 'Add-ons', 'Add-ons', '<br />\r\n', 'true', 14),
(259, 207, 'Miscellaneous', 'Miscellaneous', 'Miscellaneous', 'Miscellaneous', '<br />\r\n', 'true', 15),
(260, 208, 'Forms', 'Forms', 'Forms', 'Forms', '<br />\r\n', 'true', 1),
(261, 208, 'Galleries', 'Galleries', 'Galleries', 'Galleries', '<br />\r\n', 'true', 2),
(262, 208, 'eCommerce', 'eCommerce', 'eCommerce', 'eCommerce', '<br />\r\n', 'true', 3),
(263, 208, 'SEO', 'SEO', 'SEO', 'SEO', '<br />\r\n', 'true', 4),
(264, 208, 'Newsletters', 'Newsletters', 'Newsletters', 'Newsletters', '<br />\r\n', 'true', 5),
(265, 208, 'Auctions', 'Auctions', 'Auctions', 'Auctions', '<br />\r\n', 'true', 6),
(266, 208, 'Forums', 'Forums', 'Forums', 'Forums', '<br />\r\n', 'true', 7),
(267, 208, 'Advertising', 'Advertising', 'Advertising', 'Advertising', '<br />\r\n', 'true', 8),
(268, 208, 'Social Networking', 'Social Networking', 'Social Networking', 'Social Networking', '<br />\r\n', 'true', 9),
(269, 208, 'Media', 'Media', 'Media', 'Media', '<br />\r\n', 'true', 10),
(270, 208, 'Membership', 'Membership', 'Membership', 'Membership', '<br />\r\n', 'true', 11),
(271, 208, 'Calendars', 'Calendars', 'Calendars', 'Calendars', '<br />\r\n', 'true', 12),
(272, 208, 'Utilities', 'Utilities', 'Utilities', 'Utilities', '<br />\r\n', 'true', 13),
(273, 208, 'Add-ons', 'Add-ons', 'Add-ons', 'Add-ons', '<br />\r\n', 'true', 14),
(274, 208, 'Widgets', 'Widgets', 'Widgets', 'Widgets', '<br />\r\n', 'true', 15),
(275, 208, 'Miscellaneous', 'Miscellaneous', 'Miscellaneous', 'Miscellaneous', '<br />\r\n', 'true', 16),
(276, 208, 'Interface Elements', 'Interface Elements', 'Interface Elements', 'Interface Elements', '<br />\r\n', 'true', 17),
(277, 262, 'WP e-Commerce', 'WP e-Commerce', 'WP e-Commerce', 'WP e-Commerce', '<br />\r\n', 'true', 1),
(278, 262, 'WooCommerce', 'WooCommerce', 'WooCommerce', 'WooCommerce', '<br />\r\n', 'true', 2),
(279, 262, 'Jigoshop', 'Jigoshop', 'Jigoshop', 'Jigoshop', '<br />\r\n', 'true', 3),
(280, 262, 'Standalone', 'Standalone', 'Standalone', 'Standalone', '<br />\r\n', 'true', 4),
(281, 262, 'Miscellaneous', 'Miscellaneous', 'Miscellaneous', 'Miscellaneous', '<br />\r\n', 'true', 5),
(282, 276, 'Menus', 'Menus', 'Menus', 'Menus', '<br />\r\n', 'true', 1),
(283, 276, 'Sliders', 'Sliders', 'Sliders', 'Sliders', '<br />\r\n', 'true', 2),
(284, 276, 'Tables', 'Tables', 'Tables', 'Tables', '<br />\r\n', 'true', 3),
(285, 276, 'Buttons', 'Buttons', 'Buttons', 'Buttons', '<br />\r\n', 'true', 4),
(286, 276, 'Accordions', 'Accordions', 'Accordions', 'Accordions', '<br />\r\n', 'true', 5),
(287, 276, 'Miscellaneous', 'Miscellaneous', 'Miscellaneous', 'Miscellaneous', '<br />\r\n', 'true', 6),
(288, 209, 'Magento Extensions', 'Magento Extensions', 'Magento Extensions', 'Magento Extensions', '<br />\r\n', 'true', 1),
(289, 209, 'ExpressionEngine', 'ExpressionEngine', 'ExpressionEngine', 'ExpressionEngine', '<br />\r\n', 'true', 2),
(290, 209, 'Joomla', 'Joomla', 'Joomla', 'Joomla', '<br />\r\n', 'true', 3),
(291, 209, 'Concrete5', 'Concrete5', 'Concrete5', 'Concrete5', '<br />\r\n', 'true', 4),
(292, 209, 'Drupal', 'Drupal', 'Drupal', 'Drupal', '<br />\r\n', 'true', 5),
(293, 209, 'OpenCart', 'OpenCart', 'OpenCart', 'OpenCart', '<br />\r\n', 'true', 6),
(294, 209, 'VirtueMart', 'VirtueMart', 'VirtueMart', 'VirtueMart', '<br />\r\n', 'true', 7),
(295, 209, 'osCommerce', 'osCommerce', 'osCommerce', 'osCommerce', '<br />\r\n', 'true', 8),
(296, 209, 'Prestashop', 'Prestashop', 'Prestashop', 'Prestashop', '<br />\r\n', 'true', 9),
(297, 209, 'Zen Cart', 'Zen Cart', 'Zen Cart', 'Zen Cart', '<br />\r\n', 'true', 10),
(298, 209, 'Ubercart', 'Ubercart', 'Ubercart', 'Ubercart', '<br />\r\n', 'true', 11),
(299, 210, 'Navigation and Menus', 'Navigation and Menus', 'Navigation and Menus', 'Navigation and Menus', '<br />\r\n', 'true', 1),
(300, 210, 'Layouts', 'Layouts', 'Layouts', 'Layouts', '<br />\r\n', 'true', 2),
(301, 210, 'Animations and Effects', 'Animations and Effects', 'Animations and Effects', 'Animations and Effects', '<br />\r\n', 'true', 3),
(302, 210, 'Charts and Graphs', 'Charts and Graphs', 'Charts and Graphs', 'Charts and Graphs', '<br />\r\n', 'true', 4),
(303, 210, 'Tabs and Sliders', 'Tabs and Sliders', 'Tabs and Sliders', 'Tabs and Sliders', '<br />\r\n', 'true', 5),
(304, 210, 'Forms', 'Forms', 'Forms', 'Forms', '<br />\r\n', 'true', 6),
(305, 210, 'Buttons', 'Buttons', 'Buttons', 'Buttons', '<br />\r\n', 'true', 7),
(306, 210, 'Pricing Tables', 'Pricing Tables', 'Pricing Tables', 'Pricing Tables', '<br />\r\n', 'true', 8),
(307, 210, 'Miscellaneous', 'Miscellaneous', 'Miscellaneous', 'Miscellaneous', '<br />\r\n', 'true', 9),
(308, 211, '3D', '3D', '3D', '3D', '<br />\r\n', 'true', 1),
(309, 211, 'Canvas', 'Canvas', 'Canvas', 'Canvas', '<br />\r\n', 'true', 2),
(310, 211, 'Charts and Graphs', 'Charts and Graphs', 'Charts and Graphs', 'Charts and Graphs', '<br />\r\n', 'true', 3),
(311, 211, 'Forms', 'Forms', 'Forms', 'Forms', '<br />\r\n', 'true', 4),
(312, 211, 'Games', 'Games', 'Games', 'Games', '<br />\r\n', 'true', 5),
(313, 211, 'Libraries', 'Libraries', 'Libraries', 'Libraries', '<br />\r\n', 'true', 6),
(314, 211, 'Media', 'Media', 'Media', 'Media', '<br />\r\n', 'true', 7),
(315, 211, 'Presentations', 'Presentations', 'Presentations', 'Presentations', '<br />\r\n', 'true', 8),
(316, 211, 'Sliders', 'Sliders', 'Sliders', 'Sliders', '<br />\r\n', 'true', 9),
(317, 211, 'Storage', 'Storage', 'Storage', 'Storage', '<br />\r\n', 'true', 10),
(318, 211, 'Templates', 'Templates', 'Templates', 'Templates', '<br />\r\n', 'true', 11),
(319, 211, 'Miscellaneous', 'Miscellaneous', 'Miscellaneous', 'Miscellaneous', '<br />\r\n', 'true', 12),
(320, 212, 'iOS', 'iOS', 'iOS', 'iOS', '<br />\r\n', 'true', 1),
(321, 212, 'Android', 'Android', 'Android', 'Android', '<br />\r\n', 'true', 2),
(322, 212, 'Native Web', 'Native Web', 'Native Web', 'Native Web', '<br />\r\n', 'true', 3),
(323, 212, 'Titanium', 'Titanium', 'Titanium', 'Titanium', '<br />\r\n', 'true', 4),
(324, 320, 'Audio/Video', 'Audio/Video', 'Audio/Video', 'Audio/Video', '<br />\r\n', 'true', 1),
(325, 320, 'Custom Controls', 'Custom Controls', 'Custom Controls', 'Custom Controls', '<br />\r\n', 'true', 2),
(326, 320, 'Data Models', 'Data Models', 'Data Models', 'Data Models', '<br />\r\n', 'true', 3),
(327, 320, 'Forms', 'Forms', 'Forms', 'Forms', '<br />\r\n', 'true', 4),
(328, 320, 'Full Applications', 'Full Applications', 'Full Applications', 'Full Applications', '<br />\r\n', 'true', 5),
(329, 320, 'Frameworks and Libraries', 'Frameworks and Libraries', 'Frameworks and Libraries', 'Frameworks and Libraries', '<br />\r\n', 'true', 6),
(330, 320, 'Galleries', 'Galleries', 'Galleries', 'Galleries', '<br />\r\n', 'true', 7),
(331, 320, 'Games', 'Games', 'Games', 'Games', '<br />\r\n', 'true', 8),
(332, 320, 'Miscellaneous', 'Miscellaneous', 'Miscellaneous', 'Miscellaneous', '<br />\r\n', 'true', 9),
(333, 320, 'Network / Connectivity', 'Network / Connectivity', 'Network / Connectivity', 'Network / Connectivity', '<br />\r\n', 'true', 10),
(334, 320, 'Templates', 'Templates', 'Templates', 'Templates', '<br />\r\n', 'true', 11),
(335, 320, 'UI Elements', 'UI Elements', 'UI Elements', 'UI Elements', '<br />\r\n', 'true', 12),
(336, 320, 'Utilities', 'Utilities', 'Utilities', 'Utilities', '<br />\r\n', 'true', 13),
(337, 321, 'Audio/Video', 'Audio/Video', 'Audio/Video', 'Audio/Video', '<br />\r\n', 'true', 1),
(338, 321, 'Custom Controls', 'Custom Controls', 'Custom Controls', 'Custom Controls', '<br />\r\n', 'true', 2),
(339, 321, 'Data Models', 'Data Models', 'Data Models', 'Data Models', '<br />\r\n', 'true', 3),
(340, 321, 'Forms', 'Forms', 'Forms', 'Forms', '<br />\r\n', 'true', 4),
(341, 321, 'Full Applications', 'Full Applications', 'Full Applications', 'Full Applications', '<br />\r\n', 'true', 5),
(342, 321, 'Frameworks and Libraries', 'Frameworks and Libraries', 'Frameworks and Libraries', 'Frameworks and Libraries', '<br />\r\n', 'true', 6),
(343, 321, 'Galleries', 'Galleries', 'Galleries', 'Galleries', '<br />\r\n', 'true', 7),
(344, 321, 'Games', 'Games', 'Games', 'Games', '<br />\r\n', 'true', 8),
(345, 321, 'Miscellaneous', 'Miscellaneous', 'Miscellaneous', 'Miscellaneous', '<br />\r\n', 'true', 9),
(346, 321, 'Network / Connectivity', 'Network / Connectivity', 'Network / Connectivity', 'Network / Connectivity', '<br />\r\n', 'true', 10),
(347, 321, 'Templates', 'Templates', 'Templates', 'Templates', '<br />\r\n', 'true', 11),
(348, 321, 'UI Elements', 'UI Elements', 'UI Elements', 'UI Elements', '<br />\r\n', 'true', 12),
(349, 321, 'Utilities', 'Utilities', 'Utilities', 'Utilities', '<br />\r\n', 'true', 13),
(350, 322, 'Audio/Video', 'Audio/Video', 'Audio/Video', 'Audio/Video', '<br />\r\n', 'true', 1),
(351, 322, 'Custom Controls', 'Custom Controls', 'Custom Controls', 'Custom Controls', '<br />\r\n', 'true', 2),
(352, 322, 'Data Models', 'Data Models', 'Data Models', 'Data Models', '<br />\r\n', 'true', 3),
(353, 322, 'Forms', 'Forms', 'Forms', 'Forms', '<br />\r\n', 'true', 4),
(354, 322, 'Full Applications', 'Full Applications', 'Full Applications', 'Full Applications', '<br />\r\n', 'true', 5),
(355, 322, 'Frameworks and Libraries', 'Frameworks and Libraries', 'Frameworks and Libraries', 'Frameworks and Libraries', '<br />\r\n', 'true', 6),
(356, 322, 'Galleries', 'Galleries', 'Galleries', 'Galleries', '<br />\r\n', 'true', 7),
(357, 322, 'Games', 'Games', 'Games', 'Games', '<br />\r\n', 'true', 8),
(358, 322, 'Miscellaneous', 'Miscellaneous', 'Miscellaneous', 'Miscellaneous', '<br />\r\n', 'true', 9),
(359, 322, 'Network / Connectivity', 'Network / Connectivity', 'Network / Connectivity', 'Network / Connectivity', '<br />\r\n', 'true', 10),
(360, 322, 'Templates', 'Templates', 'Templates', 'Templates', '<br />\r\n', 'true', 11),
(361, 322, 'UI Elements', 'UI Elements', 'UI Elements', 'UI Elements', '<br />\r\n', 'true', 12),
(362, 322, 'Utilities', 'Utilities', 'Utilities', 'Utilities', '<br />\r\n', 'true', 13),
(363, 323, 'Audio/Video', 'Audio/Video', 'Audio/Video', 'Audio/Video', '<br />\r\n', 'true', 1),
(364, 323, 'Custom Controls', 'Custom Controls', 'Custom Controls', 'Custom Controls', '<br />\r\n', 'true', 2),
(365, 323, 'Data Models', 'Data Models', 'Data Models', 'Data Models', '<br />\r\n', 'true', 3),
(366, 323, 'Forms', 'Forms', 'Forms', 'Forms', '<br />\r\n', 'true', 4),
(367, 323, 'Full Applications', 'Full Applications', 'Full Applications', 'Full Applications', '<br />\r\n', 'true', 5),
(368, 323, 'Frameworks and Libraries', 'Frameworks and Libraries', 'Frameworks and Libraries', 'Frameworks and Libraries', '<br />\r\n', 'true', 6),
(369, 323, 'Galleries', 'Galleries', 'Galleries', 'Galleries', '<br />\r\n', 'true', 7),
(370, 323, 'Games', 'Games', 'Games', 'Games', '<br />\r\n', 'true', 8),
(371, 323, 'Miscellaneous', 'Miscellaneous', 'Miscellaneous', 'Miscellaneous', '<br />\r\n', 'true', 9),
(372, 323, 'Network / Connectivity', 'Network / Connectivity', 'Network / Connectivity', 'Network / Connectivity', '<br />\r\n', 'true', 10),
(373, 323, 'Templates', 'Templates', 'Templates', 'Templates', '<br />\r\n', 'true', 11),
(374, 323, 'UI Elements', 'UI Elements', 'UI Elements', 'UI Elements', '<br />\r\n', 'true', 12),
(375, 323, 'Utilities', 'Utilities', 'Utilities', 'Utilities', '<br />\r\n', 'true', 13),
(376, 0, 'Apps', 'Apps', 'Apps', 'Apps', '<br />\r\n', 'true', 10),
(377, 0, 'Skins', 'Skins', 'Skins', 'Skins', '<br />\r\n', 'true', 11),
(378, 376, 'Windows', 'Windows', 'Windows', 'Windows', '<br />\r\n', 'true', 1),
(379, 376, 'Mac', 'Mac', 'Mac', 'Mac', '<br />\r\n', 'true', 2),
(380, 377, 'Bootstrap', 'Bootstrap', 'Bootstrap', 'Bootstrap', '<br />\r\n', 'true', 1),
(381, 377, 'Miscellaneous', 'Miscellaneous', 'Miscellaneous', 'Miscellaneous', '<br />\r\n', 'true', 2),
(385, 208, 'WP Themes', 'WP Themes', 'WP Themes', 'WP Themes', '<br />\r\n', 'true', 18);
	");
	
	mysql_query("
		CREATE TABLE IF NOT EXISTS `collections` (
		  `id` int(11) NOT NULL auto_increment,
		  `user_id` int(11) NOT NULL,
		  `name` varchar(255) NOT NULL,
		  `text` text NOT NULL,
		  `photo` varchar(255) NOT NULL,
		  `items` int(11) NOT NULL default '0',
		  `rating` int(11) NOT NULL default '0',
		  `votes` int(11) NOT NULL default '0',
		  `score` int(11) NOT NULL default '0',
		  `datetime` datetime NOT NULL,
		  `public` enum('true','false') NOT NULL default 'false',
		  PRIMARY KEY  (`id`),
		  KEY `user_id` (`user_id`)
		) ENGINE=MyISAM;
	");

	mysql_query("
		CREATE TABLE IF NOT EXISTS `collections_rates` (
		  `id` int(11) NOT NULL auto_increment,
		  `collection_id` int(11) NOT NULL,
		  `user_id` int(11) NOT NULL,
		  `rate` int(11) NOT NULL,
		  `datetime` datetime NOT NULL,
		  PRIMARY KEY  (`id`),
		  KEY `collection_id` (`collection_id`,`user_id`)
		) ENGINE=MyISAM;
	");

	mysql_query("
		CREATE TABLE IF NOT EXISTS `contacts` (
		  `id` int(11) NOT NULL auto_increment,
		  `name` varchar(255) NOT NULL,
		  `email` varchar(255) NOT NULL,
		  `issue_id` int(11) NOT NULL default '0',
		  `issue` varchar(255) NOT NULL,
		  `short_text` longtext NOT NULL,
		  `datetime` datetime NOT NULL,
		  `answer` longtext NOT NULL,
		  `answer_datetime` datetime NOT NULL,
		  PRIMARY KEY  (`id`)
		) ENGINE=InnoDB;
	");
	
	mysql_query("
        INSERT INTO `contacts` (`id`, `name`, `email`, `issue_id`, `issue`, `short_text`, `datetime`, `answer`, `answer_datetime`) VALUES
          (1, 'scripthub', 'clonecodes@gmail.com', 1, '', 'Hi there, thanks for purchasing our script!\r\n		', '2013-01-01 00:00:00', '', '0000-00-00 00:00:00');
");

	mysql_query("
		CREATE TABLE IF NOT EXISTS `contacts_categories` (
	  `id` int(11) NOT NULL auto_increment,
	  `name` varchar(255) NOT NULL,
	  `text` longtext NOT NULL,
	  `visible` enum('true','false') NOT NULL default 'false',
	  `order_index` int(11) NOT NULL default '0',
	  PRIMARY KEY  (`id`)
	) ENGINE=MyISAM;
	");
	
	
    mysql_query("
      INSERT INTO `contacts_categories` (`id`, `name`, `text`, `visible`, `order_index`) VALUES
        (1, 'File Issue', '', 'true', 1),
        (2, 'Payment Issue', '', 'true', 2),
        (3, 'License Inquiry', '', 'true', 3),
        (4, 'Copyright', '', 'true', 4),
        (5, 'Large Deposit', '<br />\r\n', 'true', 5),
        (6, 'Suggestion', '<br />\r\n', 'true', 6);
      ");
	
	mysql_query("
		CREATE TABLE IF NOT EXISTS `countries` (
		  `id` int(11) NOT NULL auto_increment,
		  `name` varchar(255) NOT NULL,
		  `photo` varchar(255) NOT NULL,
		  `visible` enum('true','false') NOT NULL default 'false',
		  `order_index` int(11) NOT NULL default '0',
		  PRIMARY KEY  (`id`)
		) ENGINE=InnoDB;
	");

	mysql_query("
		CREATE TABLE IF NOT EXISTS `currency` (
		  `code` varchar(3) NOT NULL,
		  `name` varchar(100) NOT NULL,
		  `symbol` varchar(50) NOT NULL,
		  `active` enum('yes','no') NOT NULL default 'no',
		  PRIMARY KEY  (`code`)
		) ENGINE=MyISAM;
	");
	
	mysql_query("
		INSERT INTO `currency` (`code`, `name`, `symbol`, `active`) VALUES
			('AUD', 'Australian Dollar ', '$', 'no'),
			('CAD', 'Canadian Dollar ', '$', 'no'),
			('CZK', 'Czech Koruna ', 'Kč', 'no'),
			('DKK', 'Danish Krone', 'kr', 'no'),
			('EUR', 'Euro', '&euro;', 'yes'),
			('HKD', 'Hong Kong Dollar ', '$', 'no'),
			('HUF', 'Hungarian Forint ', 'Ft', 'no'),
			('ILS', 'Israeli New Sheqel ', '₪', 'no'),
			('JPY', 'Japanese Yen ', '¥', 'no'),
			('MXN', 'Mexican Peso ', '$', 'no'),
			('NOK', 'Norwegian Krone ', 'kr', 'no'),
			('NZD', 'New Zealand Dollar ', '$', 'no'),
			('PHP', 'Philippine Peso', 'Php', 'no'),
			('PLN', 'Polish Zloty ', 'zł', 'no'),
			('GBP', 'Pound Sterling ', '£', 'no'),
			('SGD', 'Singapore Dollar ', '$', 'no'),
			('SEK', 'Swedish Krona ', 'kr', 'no'),
			('CHF', 'Swiss Franc ', 'CHF', 'no'),
			('TWD', 'Taiwan New Dollar', 'NT$', 'no'),
			('THB', 'Thai Baht ', '฿', 'no'),
			('USD', 'U.S. Dollar ', '$', 'no');
	");

	mysql_query("
		CREATE TABLE IF NOT EXISTS `deposit` (
		  `id` int(11) NOT NULL auto_increment,
		  `user_id` int(11) NOT NULL,
		  `deposit` float NOT NULL,
		  `paid` enum('true','false') NOT NULL default 'false',
		  `datetime` datetime NOT NULL,
		  PRIMARY KEY  (`id`),
		  KEY `user_id` (`user_id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
	");
	
	
	mysql_query("
		CREATE TABLE IF NOT EXISTS `history` (
		  `id` int(11) NOT NULL auto_increment,
		  `user_id` int(11) NOT NULL,
		  `action` varchar(255) NOT NULL,
		  `transaction_id` varchar(255) NOT NULL,
		  `datetime` datetime NOT NULL,
		  PRIMARY KEY  (`id`),
		  KEY `user_id` (`user_id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
	");
	
	
	mysql_query("
		CREATE TABLE IF NOT EXISTS `items` (
		  `id` int(11) NOT NULL auto_increment,
		  `user_id` int(11) NOT NULL,
		  `name` varchar(50) NOT NULL,
		  `description` text NOT NULL,
		  `thumbnail` varchar(255) NOT NULL,
		  `theme_preview` varchar(255) NOT NULL,
		  `main_file` varchar(255) NOT NULL,
		  `main_file_name` varchar(255) NOT NULL,
		  `categories` varchar(100) NOT NULL,
		  `demo_url` varchar(255) NOT NULL,
		  `price` float NOT NULL default '0',
		  `sales` int(11) NOT NULL default '0',
		  `earning` float NOT NULL default '0',
		  `rating` int(11) NOT NULL default '0',
		  `votes` int(11) NOT NULL default '0',
		  `score` int(11) NOT NULL default '0',
		  `comments` int(11) NOT NULL default '0',
		  `free_request` enum('true','false') NOT NULL default 'false',
		  `free_file` enum('true','false') NOT NULL default 'false',
		  `weekly_to` date default NULL,
		  `reviewer_comment` text NOT NULL,
		  `datetime` datetime NOT NULL,
		  `status` enum('active','queue','unapproved','extended_buy','deleted') NOT NULL default 'queue',
		  PRIMARY KEY  (`id`),
		  KEY `user_id` (`user_id`,`categories`)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
	");
	
	mysql_query("
		CREATE TABLE IF NOT EXISTS `items_attributes` (
		  `item_id` int(11) NOT NULL,
		  `attribute_id` VARCHAR(255) NOT NULL,
		  `category_id` int(11) NOT NULL,
		  KEY `item_id` (`item_id`,`attribute_id`)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;
	");
	
	mysql_query("
		CREATE TABLE IF NOT EXISTS `items_collections` (
		  `item_id` int(11) NOT NULL,
		  `collection_id` int(11) NOT NULL,
		  PRIMARY KEY  (`item_id`,`collection_id`)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;
	");
	
	mysql_query("
		CREATE TABLE IF NOT EXISTS `items_comments` (
	  `id` int(11) NOT NULL auto_increment,
	  `owner_id` int(11) NOT NULL,
	  `item_id` int(11) NOT NULL,
	  `item_name` varchar(255) NOT NULL,
	  `user_id` int(11) NOT NULL,
	  `comment` text NOT NULL,
	  `datetime` datetime NOT NULL,
	  `notify` enum('true','false') NOT NULL default 'false',
	  `reply_to` int(11) NOT NULL default '0',
	  `report_by` int(11) NOT NULL default '0',
	  PRIMARY KEY  (`id`),
	  KEY `item_id` (`item_id`,`user_id`),
	  KEY `owner_id` (`owner_id`),
	  KEY `report_by` (`report_by`)
	) ENGINE=MyISAM;
	");
	
	mysql_query("
		CREATE TABLE IF NOT EXISTS `items_faqs` (
		  `id` int(11) NOT NULL auto_increment,
		  `item_id` int(11) NOT NULL,
		  `user_id` int(11) NOT NULL,
		  `question` text NOT NULL,
		  `answer` text NOT NULL,
		  `datetime` datetime NOT NULL,
		  PRIMARY KEY  (`id`),
		  KEY `item_id` (`item_id`,`user_id`)
		) ENGINE=MyISAM;
	");
	
	mysql_query("
		CREATE TABLE IF NOT EXISTS `items_rates` (
		  `id` int(11) NOT NULL auto_increment,
		  `item_id` int(11) NOT NULL,
		  `user_id` int(11) NOT NULL,
		  `rate` int(11) NOT NULL,
		  `datetime` datetime NOT NULL,
		  PRIMARY KEY  (`id`),
		  KEY `collection_id` (`item_id`,`user_id`)
		) ENGINE=MyISAM;
	");
	
	mysql_query("
		CREATE TABLE IF NOT EXISTS `items_tags` (
		  `item_id` int(11) NOT NULL,
		  `tag_id` int(11) NOT NULL,
		  `type` enum('usage','style','features') NOT NULL,
		  PRIMARY KEY  (`item_id`,`tag_id`,`type`),
		  KEY `tag_id` (`tag_id`),
		  KEY `item_id` (`item_id`)
		) ENGINE=MyISAM;
	");
	
	mysql_query("
		CREATE TABLE IF NOT EXISTS `orders` (
		  `id` int(11) NOT NULL auto_increment,
		  `user_id` int(11) NOT NULL,
		  `owner_id` int(11) NOT NULL,
		  `item_id` int(11) NOT NULL,
		  `item_name` varchar(255) NOT NULL,
		  `price` float NOT NULL,
		  `receive` float NOT NULL default '0',
		  `datetime` datetime NOT NULL,
		  `paid` enum('true','false') NOT NULL default 'false',
		  `paid_datetime` datetime NOT NULL,
		  `extended` enum('true','false') NOT NULL default 'false',
		  `type` enum('buy','referal') NOT NULL default 'buy',
		  PRIMARY KEY  (`id`),
		  KEY `user_id` (`user_id`,`item_id`),
		  KEY `owner_id` (`owner_id`)
		) ENGINE=MyISAM;
	");
	
	mysql_query("
		CREATE TABLE IF NOT EXISTS `pages` (
		  `id` int(11) NOT NULL auto_increment,
		  `sub_of` int(11) NOT NULL,
		  `key` varchar(255) NOT NULL,
		  `meta_title` varchar(255) NOT NULL,
		  `meta_keywords` varchar(255) NOT NULL,
		  `meta_description` text NOT NULL,
		  `name` varchar(255) NOT NULL,
		  `text` longtext NOT NULL,
		  `menu` enum('true','false') NOT NULL default 'false',
		  `visible` enum('true','false') NOT NULL default 'false',
		  `order_index` int(11) NOT NULL,
		  PRIMARY KEY  (`id`),
		  KEY `category_id` (`sub_of`),
		  KEY `key` (`key`)
		) ENGINE=InnoDB;
	");
	
	mysql_query("
		CREATE TABLE IF NOT EXISTS `percents` (
		  `id` int(11) NOT NULL auto_increment,
		  `percent` int(11) NOT NULL,
		  `from` int(11) NOT NULL,
		  `to` int(11) NOT NULL,
		  PRIMARY KEY  (`id`)
		) ENGINE=MyISAM;
	");
	
	mysql_query("
		INSERT INTO `percents` (`id`, `percent`, `from`, `to`) VALUES
			(1, 90, 0, 5000);
	");
	
	mysql_query("
		CREATE TABLE IF NOT EXISTS `quiz` (
		  `id` int(11) NOT NULL auto_increment,
		  `name` varchar(255) NOT NULL,
		  `order_index` int(11) NOT NULL,
		  PRIMARY KEY  (`id`)
		) ENGINE=InnoDB;
	");
	
	mysql_query("
        INSERT INTO `quiz` (`id`, `name`, `order_index`) VALUES
         (1, '5 + 5 = ?', 4),
         (2, '10 - 7 = ?', 1),
         (3, '2 * 2 = ?', 2),
         (4, '15 : 3 = ?', 3),
         (5, '10 * 10 = ?', 5);
	");
	
	mysql_query("
		CREATE TABLE IF NOT EXISTS `quiz_answers` (
		  `id` int(11) NOT NULL auto_increment,
		  `quiz_id` int(11) NOT NULL,
		  `name` varchar(255) NOT NULL,
		  `right` enum('true','false') NOT NULL default 'false',
		  PRIMARY KEY  (`id`)
		) ENGINE=InnoDB;
	");
	
	mysql_query("
        INSERT INTO `quiz_answers` (`id`, `quiz_id`, `name`, `right`) VALUES
         (1, 1, '11', 'false'),
         (2, 1, '8', 'false'),
         (3, 1, '10', 'true'),
         (4, 1, '5', 'false'),
         (5, 2, '7', 'false'),
         (6, 2, '3', 'true'),
         (7, 2, '8', 'false'),
         (8, 2, '4', 'false'),
         (9, 3, '5', 'false'),
         (10, 3, '1', 'false'),
         (11, 3, '6', 'false'),
         (12, 3, '4', 'true'),
         (13, 4, '5', 'true'),
         (14, 4, '4', 'false'),
         (15, 4, '6', 'false'),
         (16, 4, '7', 'false'),
         (17, 5, '200', 'false'),
         (18, 5, '100', 'true'),
         (19, 5, '20', 'false'),
         (20, 5, '10', 'false');
	");
	
	mysql_query("
		CREATE TABLE IF NOT EXISTS `system` (
		  `id` int(11) NOT NULL auto_increment,
		  `key` varchar(255) NOT NULL,
		  `value` text NOT NULL,
		  PRIMARY KEY  (`id`)
		) ENGINE=MyISAM;	
	");
	
	mysql_query("
		INSERT INTO `system` (`id`, `key`, `value`) VALUES
			(1, 'meta_title', '".sql_quote($_POST['meta_title'])."'),
			(2, 'meta_keywords', '".sql_quote($_POST['meta_keywords'])."'),
			(3, 'meta_description', '".sql_quote($_POST['meta_description'])."'),
			(4, 'admin_mail', '".sql_quote($_POST['admin_mail'])."'),
			(8, 'report_mail', '".sql_quote($_POST['report_mail'])."'),
			(9, 'paypal_email', '".sql_quote($_POST['paypal_email'])."');
	");
	
	mysql_query("
		CREATE TABLE IF NOT EXISTS `tags` (
		  `id` int(11) NOT NULL auto_increment,
		  `name` varchar(255) NOT NULL,
		  PRIMARY KEY  (`id`),
		  KEY `id` (`id`)
		) ENGINE=MyISAM;
	");
	
	mysql_query("
		CREATE TABLE IF NOT EXISTS `temp_items` (
		  `id` int(11) NOT NULL auto_increment,
		  `item_id` int(11) NOT NULL,
		  `name` varchar(255) NOT NULL,
		  `thumbnail` varchar(255) NOT NULL,
		  `theme_preview` varchar(255) NOT NULL,
		  `main_file` varchar(255) NOT NULL,
		  `main_file_name` varchar(255) NOT NULL,
		  `reviewer_comment` text NOT NULL,
		  `datetime` datetime NOT NULL,
		  PRIMARY KEY  (`id`),
		  KEY `user_id` (`item_id`)
		) ENGINE=MyISAM;
	");
	
	mysql_query("
		CREATE TABLE IF NOT EXISTS `temp_items_tags` (
		  `item_id` int(11) NOT NULL,
		  `tag_id` int(11) NOT NULL,
		  `type` enum('usage','style','features') NOT NULL,
		  PRIMARY KEY  (`item_id`,`tag_id`,`type`),
		  KEY `tag_id` (`tag_id`),
		  KEY `item_id` (`item_id`)
		) ENGINE=MyISAM;
	");
	
	mysql_query("
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `featured_item_id` int(11) NOT NULL DEFAULT '0',
  `exclusive_author` enum('true','false') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'true',
  `license` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'a:1:{s:8:\"personal\";s:8:\"personal\";}',
  `avatar` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `homeimage` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `firmname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `profile_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `profile_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `live_city` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `country_id` int(11) NOT NULL DEFAULT '0',
  `freelance` enum('true','false') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'false',
  `social` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `quiz` enum('false','true') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'false',
  `deposit` float NOT NULL DEFAULT '0',
  `earning` float NOT NULL DEFAULT '0',
  `total` float NOT NULL DEFAULT '0',
  `sold` float NOT NULL DEFAULT '0',
  `items` int(11) NOT NULL DEFAULT '0',
  `sales` int(11) NOT NULL DEFAULT '0',
  `buy` int(11) NOT NULL DEFAULT '0',
  `rating` int(11) NOT NULL DEFAULT '0',
  `score` int(11) NOT NULL DEFAULT '0',
  `votes` int(11) NOT NULL DEFAULT '0',
  `referals` int(11) NOT NULL DEFAULT '0',
  `referal_money` float NOT NULL DEFAULT '0',
  `featured_author` enum('true','false') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'false',
  `power_elite_author` enum('true','false') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'false',
  `elite_author` enum('true','false') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'false',
  `register_datetime` datetime DEFAULT NULL,
  `last_login_datetime` datetime DEFAULT NULL,
  `ip_address` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` enum('waiting','banned','activate') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'waiting' COMMENT 'kakav e momentniat status na potrebitelq',
  `groups` text COLLATE utf8_unicode_ci COMMENT 'grupi kam koito prinadleji potrebitelq',
  `remember_key` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activate_key` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `referal_id` int(11) NOT NULL DEFAULT '0',
  `commission_percent` int(2) NOT NULL DEFAULT '0',
  `badges` text COLLATE utf8_unicode_ci NOT NULL,
  `behance` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `deviantart` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `digg` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `dribbble` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `facebook` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `flickr` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `forrst` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `github` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `googleplus` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `lastfm` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `linkedin` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `myspace` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `reddit` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `tumblr` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `twitter` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `vimeo` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `youtube` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `status` (`status`),
  KEY `featured_item_id` (`featured_item_id`),
  KEY `referal_id` (`referal_id`)
		) ENGINE=InnoDB;
	");
	
	mysql_query("
		INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `firstname`, `lastname`, `featured_item_id`, `exclusive_author`, `license`, `avatar`, `homeimage`, `firmname`, `profile_title`, `profile_desc`, `live_city`, `country_id`, `freelance`, `social`, `quiz`, `deposit`, `earning`, `total`, `sold`, `items`, `sales`, `buy`, `rating`, `score`, `votes`, `referals`, `referal_money`, `featured_author`, `power_elite_author`, `elite_author`, `register_datetime`, `last_login_datetime`, `ip_address`, `status`, `groups`, `remember_key`, `activate_key`, `referal_id`, `commission_percent`, `badges`, `behance`, `deviantart`, `digg`, `dribbble`, `facebook`, `flickr`, `forrst`, `github`, `googleplus`, `lastfm`, `linkedin`, `myspace`, `reddit`, `tumblr`, `twitter`, `vimeo`, `youtube`) VALUES
		(1, '".sql_quote($_POST['admin_username'])."', '".md5(md5($adminPassword))."', '".sql_quote($_POST['admin_mail'])."', 'admin', 'scripthub', 0, 'false', 'a:2:{s:8:\"extended\";s:8:\"extended\";s:8:\"personal\";s:8:\"personal\";}', '', '', '', '', '', '', 260, 'true', '', 'true', 500, 0, 500, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'false', 'true', 'false', '2013-06-06 00:00:00', '2013-06-06 00:00:00', '127.0.0.1', 'activate', 'a:1:{i:2;s:2:\"on\";}', '', NULL, 0, 0, '45,47', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
	");
	
	mysql_query("
		CREATE TABLE IF NOT EXISTS `users_emails` (
		  `id` int(11) NOT NULL auto_increment,
		  `from_id` int(11) NOT NULL,
		  `from_email` varchar(255) NOT NULL,
		  `to_id` int(11) NOT NULL,
		  `message` text NOT NULL,
		  `datetime` datetime NOT NULL,
		  PRIMARY KEY  (`id`),
		  KEY `from_id` (`from_id`,`to_id`)
		) ENGINE=MyISAM;
	");
	
	mysql_query("
		CREATE TABLE IF NOT EXISTS `users_followers` (
		  `user_id` int(11) NOT NULL,
		  `follow_id` int(11) NOT NULL,
		  PRIMARY KEY  (`user_id`,`follow_id`)
		) ENGINE=MyISAM;	
	");
	
	mysql_query("
		CREATE TABLE IF NOT EXISTS `user_groups` (
		  `ug_id` int(11) NOT NULL auto_increment,
		  `name` varchar(30) NOT NULL,
		  `description` varchar(255) NOT NULL,
		  `rights` text NOT NULL,
		  PRIMARY KEY  (`ug_id`)
		) ENGINE=InnoDB;
	");
	
	mysql_query("
		INSERT INTO `user_groups` (`ug_id`, `name`, `description`, `rights`) VALUES
		(2, 'Administrator', '<p>\r\n	full administration panel</p>\r\n', 'a:20:{s:6:\"system\";s:2:\"on\";s:5:\"admin\";s:2:\"on\";s:10:\"attributes\";s:2:\"on\";s:8:\"bulletin\";s:2:\"on\";s:10:\"categories\";s:2:\"on\";s:11:\"collections\";s:2:\"on\";s:8:\"contacts\";s:2:\"on\";s:9:\"countries\";s:2:\"on\";s:5:\"error\";s:2:\"on\";s:4:\"help\";s:2:\"on\";s:5:\"items\";s:2:\"on\";s:10:\"make_money\";s:2:\"on\";s:5:\"pages\";s:2:\"on\";s:8:\"payments\";s:2:\"on\";s:8:\"percents\";s:2:\"on\";s:5:\"qnews\";s:2:\"on\";s:4:\"quiz\";s:2:\"on\";s:7:\"reports\";s:2:\"on\";s:4:\"tags\";s:2:\"on\";s:5:\"users\";s:2:\"on\";}');
	");
	
	mysql_query("
		CREATE TABLE `users_status` (
	    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
	    `user_id` INT NOT NULL ,
	    `status` ENUM( 'freefile', 'featured' ) NOT NULL ,
	    `datetime` DATETIME NOT NULL ,
	    INDEX ( `user_id` )
	  ) ENGINE = MYISAM;
  ");
	
	mysql_query("
		CREATE TABLE IF NOT EXISTS `withdraw` (
	  `id` int(11) NOT NULL auto_increment,
	  `user_id` int(11) NOT NULL,
	  `amount` varchar(255) NOT NULL,
	  `method` varchar(255) NOT NULL,
	  `text` text NOT NULL,
	  `australian` enum('false','iam','iamnot') NOT NULL default 'false',
	  `abn` varchar(255) NOT NULL,
	  `acn` varchar(255) NOT NULL,
	  `datetime` datetime NOT NULL,
	  `paid` enum('true','false') NOT NULL default 'false',
	  `paid_datetime` datetime default NULL,
	  PRIMARY KEY  (`id`),
	  KEY `user_id` (`user_id`)
	) ENGINE=MyISAM;
	");
	
	mysql_query("
		CREATE TABLE IF NOT EXISTS `users_status` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `user_id` int(11) NOT NULL,
		  `status` enum('freefile','featured') NOT NULL,
		  `datetime` datetime NOT NULL,
		  PRIMARY KEY (`id`),
		  KEY `user_id` (`user_id`)
		) ENGINE=MyISAM;
	");
	
	mysql_query("
        INSERT INTO `contacts_categories` (`id`, `name`, `text`, `visible`, `order_index`) VALUES
         (1, 'File Issue', '', 'true', 1),
         (2, 'Payment Issue', '', 'true', 2),
         (3, 'License Inquiry', '', 'true', 3),
         (4, 'Copyright', '', 'true', 4),
         (5, 'Large Deposit', '', 'true', 5),
         (6, 'Suggestion', '', 'true', 6);
	");

	mysql_query("
		ALTER TABLE `deposit` ADD `from_admin` TINYINT( 1 ) NOT NULL , ADD INDEX ( `from_admin` );
	");
	
	mysql_query("
		CREATE TABLE IF NOT EXISTS `users_referals_count` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `user_id` int(11) NOT NULL,
		  `timestamp` int(11) NOT NULL,
		  PRIMARY KEY (`id`),
		  KEY `user_id` (`user_id`)
		) ENGINE=MyISAM;
	");
	
	mysql_query("
		INSERT INTO `system` (`id`, `key`, `value`) VALUES (NULL, 'referal_sum', '10'), (NULL, 'referal_percent', '60');
	");
	
	mysql_query("
		ALTER TABLE `system` ADD `system` TINYINT( 1 ) NOT NULL DEFAULT '0';
	");
	
	mysql_query("
		INSERT INTO `system` (`id`, `key`, `value`, `system`) VALUES (NULL, 'prepaid_price_discount', '2', '1'), (NULL, 'extended_price', '50', '1');
	");
	
	mysql_query("
		INSERT INTO `system` (`id`, `key`, `value`, `system`) VALUES (NULL, 'no_exclusive_author_percent', '30', '1'), (NULL, 'exclusive_author_percent', '40', '1');
	");
	
	mysql_query("
		INSERT INTO `system` (`id`, `key`, `value`, `system`) VALUES (NULL, 'site_logo', '', '1');
	");
	
	mysql_query("
		UPDATE `system` SET `system` = 1 WHERE `key` IN ('meta_title','meta_keywords','meta_description','admin_mail','report_mail','paypal_email','referal_sum','referal_percent','prepaid_price_discount','extended_price','no_exclusive_author_percent','exclusive_author_percent','site_logo');
	");
	
	mysql_query("
		ALTER TABLE `users` ADD `commission_percent` INT( 2 ) NOT NULL DEFAULT '0';
	");
	
	mysql_query("
		CREATE TABLE IF NOT EXISTS `items_to_category` (
		  `item_id` int(11) NOT NULL,
		  `categories` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
		  KEY `item_id` (`item_id`,`categories`)
		) ENGINE=MyISAM;
	");
	
	mysql_query("
		INSERT INTO `items_to_category` (`item_id`, `categories`) SELECT `id`, `categories` FROM `items`;
	");
	
	mysql_query("
		CREATE TABLE IF NOT EXISTS `badges` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
		  `photo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
		  `visible` enum('true','false') COLLATE utf8_unicode_ci NOT NULL,
		  `from` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
		  `to` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
		  `type` enum('other','buyers','authors','referrals','system') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'other',
		  PRIMARY KEY (`id`)
		) ENGINE=MyISAM;
	");
	
	mysql_query("
		ALTER TABLE `badges` ADD `sys_key` VARCHAR( 64 ) NOT NULL;
	");
	
	mysql_query("
INSERT INTO `badges` (`id`, `name`, `photo`, `visible`, `from`, `to`, `type`, `sys_key`) VALUES
(19, 'Has sold between $1,000 - $5,000 worth of items', 'sold_between_1000_and_5000_dollars.png', 'true', '1000', '5000', 'authors', ''),
(18, 'Has sold between $100 - $1,000 worth of items', 'sold_between_100_and_1000_dollars.png', 'true', '100', '1000', 'authors', ''),
(17, 'Has sold between $1 - $100 worth of items', 'sold_between_1_and_100_dollars.png', 'true', '1', '100', 'authors', ''),
(28, 'Has bought between 100 and 499 items', 'bought_between_100_and_499_items.png', 'true', '100', '499', 'buyers', ''),
(27, 'Has bought between 50 and 99 items', 'bought_between_50_and_99_items.png', 'true', '50', '99', 'buyers', ''),
(26, 'Has bought between 10 and 49 items', 'bought_between_10_and_49_items.png', 'true', '10', '49', 'buyers', ''),
(25, 'Has bought between 1 and 9 items', 'bought_between_1_and_9_items.png', 'true', '1', '9', 'buyers', ''),
(7, 'Has won a competition', 'won_a_competition.png', 'true', '0', '0', 'other', ''),
(39, 'Has been a beta tester', 'beta_tester.png', 'true', '0', '0', 'other', ''),
(5, 'Has had an item featured', 'item_was_featured.png', 'true', '0', '0', 'system', 'has_had_item_featured'),
(4, 'Is an exclusive author', 'exclusive_author.png', 'true', '0', '0', 'system', 'is_exclusive_author'),
(3, 'Location', '', 'true', '0', '0', 'system', 'location_global_community'),
(2, 'Has been featured', 'author_was_featured.png', 'true', '0', '0', 'system', 'has_been_featured'),
(1, 'Has contributed a Free File of the Month', 'author_had_free_file.png', 'true', '0', '0', 'system', 'has_free_file_month'),
(20, ' Has sold between $5,000 - $10,000 worth of items', 'sold_between_5000_and_10000_dollars.png', 'true', '5000', '10000', 'authors', ''),
(21, 'Has sold between $10,000 - $50,000 worth of items', 'sold_between_10000_and_50000_dollars.png', 'true', '10000', '500000', 'authors', ''),
(22, 'Has sold between $50,000 - $100,000 worth of items', 'sold_between_50000_and_100000_dollars.png', 'true', '50000', '100000', 'authors', ''),
(23, 'Has sold between $100,000 - $250,000 worth of items', 'sold_between_100000_and_250000_dollars.png', 'true', '100000', '250000', 'authors', ''),
(24, 'Has sold between $250,000 - $1,000,000 worth of items ', 'sold_between_250000_and_1000000_dollars.png', 'true', '250000', '1000000', 'authors', ''),
(29, 'Has bought between 500 and 999 items', 'bought_between_500_and_999_items.png', 'true', '500', '999', 'buyers', ''),
(30, 'Has bought more than 1000 items ', 'bought_between_1000_and_4999_items.png', 'true', '1000', '4999', 'buyers', ''),
(31, 'Has referred between 1 - 9 members', 'referred_between_1_and_9_users.png', 'true', '1', '9', 'referrals', ''),
(32, 'Has referred between 10 - 49 members', 'referred_between_10_and_49_users.png', 'true', '10', '49', 'referrals', ''),
(33, 'Has referred between 50 - 99 members', 'referred_between_50_and_99_users.png', 'true', '50', '99', 'referrals', ''),
(34, 'Has referred between 100 - 199 members', 'referred_between_100_and_199_users.png', 'true', '100', '199', 'referrals', ''),
(35, 'Has referred between 200 - 499 members', 'referred_between_200_and_499_users.png', 'true', '200', '499', 'referrals', ''),
(36, 'Has referred between 500 - 999 members', 'referred_between_500_and_999_users.png', 'true', '500', '999', 'referrals', ''),
(37, 'Has referred between 1,000 - 1999 members', 'referred_between_1000_and_1999_users.png', 'true', '1000', '1999', 'referrals', ''),
(38, 'Has referred 2,000+ members', 'referred_more_than_2000_users.png', 'true', '2000', '4999', 'referrals', ''),
(40, 'Power Elite Author', 'power_elite_author.png', 'true', '0', '0', 'system', 'power_elite_author'),
(41, 'Elite Author', 'elite_author.png', 'true', '0', '0', 'system', 'elite_author'),
(42, 'The Marketplace Manager', 'marketplace_manager.png', 'true', '0', '0', 'other', ''),
(43, 'Item Reviewer', 'reviewer.png', 'true', '0', '0', 'other', ''),
(44, 'Has had an item featured in an Marketplace Bundle', 'author_had_bundled_file.png', 'true', '0', '0', 'other', ''),
(45, 'Support Staff', 'support.png', 'true', '0', '0', 'other', ''),
(46, 'One of our elite developers', 'developer.png', 'true', '0', '0', 'other', ''),
(47, 'Community Ambassador', 'community_ambassador.png', 'true', '0', '0', 'other', ''),
(48, 'Has helped protect the marketplaces against copyright violations', 'violation.png', 'true', '0', '0', 'other', ''),
(49, 'Super copyright sheriff!', 'violation_gold.png', 'true', '0', '0', 'other', ''),
(50, 'Has contributed a tutorial', 'contributed_a_tutorial.png', 'true', '0', '0', 'other', ''),
(51, 'Marketplace Blogger', 'blog_editor.png', 'true', '0', '0', 'other', ''),
(52, 'Our Community Manager', 'community_manager.png', 'true', '0', '0', 'other', ''),
(53, 'One of our exclusive Community Superstars', 'community_superstar.png', 'true', '0', '0', 'other', ''),
(54, 'Community Moderator', 'community_mod.png', 'true', '0', '0', 'other', '');
	");
	
	mysql_query("
		ALTER TABLE `users` ADD `badges` TEXT NOT NULL;
	");
	
	mysql_query("
		ALTER TABLE `pages` ADD `footer` ENUM( 'true', 'false' ) NOT NULL AFTER `menu` , ADD INDEX ( `footer` );
	");
	
	mysql_query("
		ALTER TABLE `users_referals_count` ADD `referal_id` INT( 11 ) NOT NULL , ADD INDEX ( `referal_id` ); 
	");
	
	mysql_query("
		ALTER TABLE `users_referals_count` CHANGE `timestamp` `datetime` DATETIME NOT NULL;
	");
	
	mysql_query("
		ALTER TABLE `items` ADD `suggested_price` FLOAT NOT NULL AFTER `price`;
	");
	
	mysql_query("
		CREATE TABLE IF NOT EXISTS `qnews` (
		  `id` int(6) NOT NULL auto_increment,
		  `name` varchar(250) character set utf8 NOT NULL default '',
		  `description` varchar(255) character set utf8 NOT NULL default '',
		  `url` varchar(255) character set utf8 NOT NULL default '',
		  `photo` varchar(255) character set utf8 NOT NULL,
		  `visible` enum('true','false') character set utf8 NOT NULL default 'true',
		  `order_index` int(11) NOT NULL default '0',
		  PRIMARY KEY  (`id`)
		) ENGINE=InnoDB;
	");
	
	mysql_query("
     INSERT INTO `qnews` (`id`, `name`, `description`, `url`, `photo`, `visible`, `order_index`) VALUES
     (1, scripthub, 'This is sample newscripthubyou can change clicking in news title.', '/admin/?m=qnews&c=list', 'fd80c3904925cc129c975db0d348e8e1.jpg', 'true', 1);
	");
	
	
	mysql_query("
		INSERT INTO `countries` (`id`, `name`, `photo`, `visible`, `order_index`) VALUES
(247, 'Afghanistan', 'ac5e36e99755bab5320b4a88724c5768.png', 'true', 1),
(248, 'Aland', '599da07a1e87bbf5907835108cd67a88.png', 'true', 2),
(249, 'Albania', 'ed8a070d3ebaa2381b9d8cc34df0c306.png', 'true', 3),
(250, 'Algeria', '0ec8713c6a12456254efea0ef0238707.png', 'true', 4),
(251, 'American Samoa', 'e2cf4e2595710901c5edf8e936c23788.png', 'true', 5),
(252, 'Andorra', '2530c8d0e5c2dd7d06d27d1f939049cd.png', 'true', 6),
(253, 'Angola', 'c5799377b2d0738b554f43ff73ecbac3.png', 'true', 7),
(254, 'Anguilla', 'ab2235e198b6316d0a4392dbd022e7c0.png', 'true', 8),
(255, 'Antarctica', '6a506459a01f9b6db04c651d63405b9d.png', 'true', 9),
(256, 'Antigua and Barbuda', '35ae0a4faf6f286e161b7dc12266a690.png', 'true', 10),
(257, 'Argentina', 'edb827d4e236487376738aa9b7e3d17a.png', 'true', 11),
(258, 'Armenia', '2e23b4f6207a492ac6418bc5c79d1b13.png', 'true', 12),
(259, 'Aruba', '49acac8a947550492ddac546034f29ca.png', 'true', 13),
(260, 'Australia', '8cf0dc1da87fcb880f14cd45c14442fb.png', 'true', 14),
(261, 'Austria', '1f9b4dd1f676d0823d395cd64369dee1.png', 'true', 15),
(262, 'Azerbaijan', 'ff2df99bfd0ef426ec8288b99709fec6.png', 'true', 16),
(263, 'Bahamas', '76ee396f323f941375ea4d50e2a3327e.png', 'true', 17),
(264, 'Bahrain', '0d27c230d1322fbf3c529433275917e9.png', 'true', 18),
(265, 'Bangladesh', '0a2a2e4b226341115c860e12ea45f250.png', 'true', 19),
(266, 'Barbados', '959838faa172ad4cd6605d2c04e238ef.png', 'true', 20),
(267, 'Belarus', 'b3e6f08c7aa4411cc96b5888f3d76c0b.png', 'true', 21),
(268, 'Belgium', '76c51b6feb986e15705a720188f5a7c0.png', 'true', 22),
(269, 'Benin', '8183fe47b2a521eed6f5b007142418f3.png', 'true', 23),
(270, 'Bermuda', 'b90a7a9a6f60599da6f8538f90a0f4be.png', 'true', 24),
(271, 'Bhutan', '25f83542e92439a383adb381cd7d3b7e.png', 'true', 25),
(272, 'Bolivia', '3844baf46f451e0d1677c949d362e953.png', 'true', 26),
(273, 'Bosnia and Herzegovina', 'ddf97be1d94133ef77074035083920a2.png', 'true', 27),
(274, 'Botswana', 'cf704f971cdbbd83737f144962504fbf.png', 'true', 28),
(275, 'Bouvet Island', 'de01c52f556f48e14696a9e0e7cbffbb.png', 'true', 29),
(276, 'Brazil', '51c74a0733959d3db78e319161b8d752.png', 'true', 30),
(277, 'British Indian Ocean Territory', '820afa9676df54af23bc697cf6ef0ccb.png', 'true', 31),
(278, 'Brunei Darussalam', 'b448261fe06d607320a3caaf95e03b30.png', 'true', 32),
(279, 'Bulgaria', 'ba653389781a917dd967e4b76742316a.png', 'true', 33),
(280, 'Burkina Faso', '1f4aeb26b44abac3c2b5ea8b3ff8449d.png', 'true', 34),
(281, 'Burundi', '6643dc70509ff618b7f2308c1ef7dc65.png', 'true', 35),
(282, 'Cambodia', '0a92efebbae4100500ab7245d99bc219.png', 'true', 36),
(283, 'Cameroon', '2d392a2d19f44d88003bd4159a4399f7.png', 'true', 37),
(284, 'Canada', '1afe266f30faaa9882b21b700f855ac0.png', 'true', 38),
(285, 'Cape Verde', '9a8fcf7f90d3bd24b73373c0d665c262.png', 'true', 39),
(286, 'Cayman Islands', '134dd09b6eb93654179ab11350055482.png', 'true', 40),
(287, 'Central African Republic', '1d9a139fed0ee12d47f83b36f2ffa65c.png', 'true', 41),
(288, 'Chad', '8e5ab5821984fd56f9ec3abcd3913488.png', 'true', 42),
(289, 'Chile', '3c50dfe95008ebf12356af69ceab89d3.png', 'true', 43),
(290, 'China', '63cadd8952ab573352234346da208bc2.png', 'true', 44),
(291, 'Christmas Island', '5821b8caeec4b659df9ee8f0c02a773f.png', 'true', 45),
(292, 'Cocos (Keeling) Islands', '129224d4d75358f4a707e3ff0740d6a8.png', 'true', 46),
(293, 'Colombia', 'c390fb6e19fa8d4e79460ee6831e65a5.png', 'true', 47),
(294, 'Comoros', '9432170b8552943b6e822314a4728dd3.png', 'true', 48),
(295, 'Congo (Brazzaville)', '94672791ea6a9a099dbe750eca6717a1.png', 'true', 49),
(296, 'Congo (Kinshasa)', 'a98492138cb2128ea8925c945845ee36.png', 'true', 50),
(297, 'Cook Islands', '878c9a852898a48b1bc08febde65dc55.png', 'true', 51),
(298, 'Costa Rica', '3c03bce55c484c6a76cd1e639694548d.png', 'true', 52),
(299, 'Côte d''Ivoire', '8dfcc64a1da45c6d7846f99151936ef4.png', 'true', 53),
(300, 'Croatia', '0b6a00f890d9b59630220d206f2186ec.png', 'true', 54),
(301, 'Cuba', '6866e2c5c4afe2311df44655b2be5c3a.png', 'true', 55),
(302, 'Cyprus', 'b91a0a523bff3570e728fe34ee3276e6.png', 'true', 56),
(303, 'Czech Republic', '11a40895eeb3b08b15a7f10ab1444501.png', 'true', 57),
(304, 'Denmark', 'ce53629f7eb6fb48e8fb4e89e079937c.png', 'true', 58),
(305, 'Djibouti', '057e340cd456a72bf6563d6ede03b355.png', 'true', 59),
(306, 'Dominica', '956a4c0a13861050185d0177a819add9.png', 'true', 60),
(307, 'Dominican Republic', 'a83d332c42b01a55131fe846512c0182.png', 'true', 61),
(308, 'Ecuador', 'f8a02d7957d089da2f275321f1e83ccd.png', 'true', 62),
(309, 'Egypt', '62c5e475a3d13209430139f469b25d62.png', 'true', 63),
(310, 'El Salvador', '9188276fd72f8b08f5b11b12fb1fae53.png', 'true', 64),
(311, 'Equatorial Guinea', '772b05028aec5f98cc265dada71f7ad4.png', 'true', 65),
(312, 'Eritrea', '5c753921a485c6e0a388e97d236b2634.png', 'true', 66),
(313, 'Estonia', 'c88bbb0610924eb3db9c4d05d6a363ad.png', 'true', 67),
(315, 'Falkland Islands', 'f066c693e0da4c29134c64a812338902.png', 'true', 69),
(316, 'Faroe Islands', '4ef176c79a5045b153b4e19edd272623.png', 'true', 70),
(317, 'Fiji', '3d3c37666f3c68bf9bc1da725a6d8231.png', 'true', 71),
(318, 'Finland', '136837e5583553aafa13e35495239503.png', 'true', 72),
(319, 'France', '66281fbe2977201d846e8f48faa8882e.png', 'true', 73),
(320, 'French Guiana', 'decb0ca93c5c81cedf8fd9486606aa12.png', 'true', 74),
(321, 'French Polynesia', '16140e32255ace023a754a6f95f37093.png', 'true', 75),
(322, 'French Southern Lands', 'e97c5f90266aa402f66a5878f274ffaf.png', 'true', 76),
(323, 'Gabon', 'fbc9650ef3ac3d1dfe2311ab2158a3be.png', 'true', 77),
(324, 'Gambia', '88768e24872885e2dc2b214826cbbd01.png', 'true', 78),
(325, 'Georgia', '527d156d98fb7ac754afc29a8e593fda.png', 'true', 79),
(326, 'Germany', 'dea07c3d312aa47ae52a170fee899b8a.png', 'true', 80),
(327, 'Ghana', 'ac1372ea0b9f5f7bd63ab76daa6411a8.png', 'true', 81),
(328, 'Gibraltar', '67f9aec652acd558d055c80dd5e4904c.png', 'true', 82),
(329, 'Greece', '641876cc6cfd2fbf33c62e4d4607b1b4.png', 'true', 83),
(330, 'Greenland', '8bcb233fa9a7cc6db6a79ce12f301ee4.png', 'true', 84),
(331, 'Grenada', '6d7297fdf9e769fbfe65dc8065d90805.png', 'true', 85),
(332, 'Guadeloupe', '0c594e35d2abe3c93b0f72a5eb8bcd71.png', 'true', 86),
(333, 'Guam', '21f0f9c012f38877f205e3b4ae844064.png', 'true', 87),
(334, 'Guatemala', '8d0ca1448a4e1a06008e6b2a78e191ae.png', 'true', 88),
(335, 'Guinea', 'dc845edbdd1c7d5d5588eb615c7f846d.png', 'true', 89),
(336, 'Guinea-Bissau', 'c21d2c16b126fe817bba94fe26bbbea2.png', 'true', 90),
(337, 'Guyana', 'f35d4c1ceaa29d3e34015db00d928629.png', 'true', 91),
(338, 'Haiti', 'e07d4cf93a7e8c5984f4cf4d9a09f101.png', 'true', 92),
(339, 'Heard and McDonald Islands', 'b8693fc1a735df087a109e91b8bcd120.png', 'true', 93),
(340, 'Honduras', '4e8acefe119fce7d9e0d607dd60bd4d7.png', 'true', 94),
(341, 'Hong Kong', 'f9f9d3a4c7ed220cc64c4c1b86bce5ea.png', 'true', 95),
(342, 'Hungary', 'c45826b5f12705fd19a330b507d7dd49.png', 'true', 96),
(343, 'Iceland', 'adcc462eef8b7df0f9afcad9c63fb21e.png', 'true', 97),
(344, 'India', 'd262cbfda35a7db713645be398ca67d9.png', 'true', 98),
(345, 'Indonesia', '90770a88d51ebb81dd1e437e10ec0153.png', 'true', 99),
(346, 'Iran', '64f81d739b492b3ca552be6ab0e9f72c.png', 'true', 100),
(347, 'Iraq', '7885a92e23f36f092d8845aa3117e786.png', 'true', 101),
(348, 'Ireland', 'f47d949f7b10c0a495e8414382627aa4.png', 'true', 102),
(349, 'Israel', '3da9f3b4934ef5807519b55316ad47bb.png', 'true', 103),
(350, 'Italy', 'a765872d1a6008ea19078f0ae634d68a.png', 'true', 104),
(351, 'Jamaica', 'fe917bc2f6b6ea2e45709733dd19dd10.png', 'true', 105),
(352, 'Japan', '45f51e155e0ab42c03e0844d0a520a65.png', 'true', 106),
(353, 'Jordan', '4e1916c490d8d7c17a35746fa34bca10.png', 'true', 107),
(354, 'Kazakhstan', 'f2102e58b296eeb20918a0e0ddcdfdc4.png', 'true', 108),
(355, 'Kenya', '73b50b0fb92fc2ea50cf013f07ca2216.png', 'true', 109),
(356, 'Kiribati', '8c4586d5328020fdb286e2121da66f19.png', 'true', 110),
(357, 'Korea, North', 'ee64a49a2c02aae4efa9bc485cb28322.png', 'true', 111),
(358, 'Korea, South', '869444f04f7e8e74a753371d8b19f8cf.png', 'true', 112),
(359, 'Kuwait', '10af667c863d1913b9e16333be5e2d3b.png', 'true', 113),
(360, 'Kyrgyzstan', '3473fb56c8bb7016ae716c0eee1b6dcf.png', 'true', 114),
(361, 'Laos', '1061fbbd1cf1871fc8b63b7bc3db0267.png', 'true', 115),
(362, 'Latvia', 'f6356dfa28889fb281d2edb049b416d3.png', 'true', 116),
(363, 'Lebanon', 'c328d9dcf7b7e6569ca144089ec39779.png', 'true', 117),
(364, 'Lesotho', '79cb143803fad05165c028dbe91783f4.png', 'true', 118),
(365, 'Liberia', '49ab2f20dda58c2033b5c18422a64e78.png', 'true', 119),
(366, 'Libya', 'b8ea37a5f4855937581054f7e6d57826.png', 'true', 120),
(367, 'Liechtenstein', '6a9a62b1c4d9feccc1f38c05e141b5de.png', 'true', 121),
(368, 'Lithuania', '155d7584db498a797d84e63a8c55c7d1.png', 'true', 122),
(369, 'Luxembourg', '76fc1589b025ede029c3c6824d831136.png', 'true', 123),
(370, 'Macau', 'fac514f82b7ee8891884552213eb4878.png', 'true', 124),
(371, 'Macedonia', 'ba387e8e9563def7cd653aebf0576094.png', 'true', 125),
(372, 'Madagascar', 'cd35fb9b2ad1fe3798b052b848dfb4fd.png', 'true', 126),
(373, 'Malawi', 'd01b7d30fadb3419f227f83050d3acbe.png', 'true', 127),
(374, 'Malaysia', 'c0866e2b4f09928c3dfd78947e5c2788.png', 'true', 128),
(375, 'Maldives', '33fed0a2f49d5f9e65a67818d489bb35.png', 'true', 129),
(377, 'Mali', '0bbf4120c90571a8187dcea445ff0c01.png', 'true', 130),
(378, 'Malta', '54c87eced7aebe7f564d46b2879897d0.png', 'true', 131),
(379, 'Marshall Islands', '8baa301fde6cf9cace135f70e966e35c.png', 'true', 132),
(380, 'Martinique', 'c51c8a4e00c1c11840c1d17f3b23b8f6.png', 'true', 133),
(381, 'Mauritania', '50b46c69ca83976f2e4bf36a6ec8cdf8.png', 'true', 134),
(382, 'Mauritius', '12cade54b694b98f2796b29324c28396.png', 'true', 135),
(383, 'Mayotte', 'd5dcca5b181f1e55f53c8c1eae9750a2.png', 'true', 136),
(384, 'Mexico', '769683a4a9b5963be0e34e0e695744e9.png', 'true', 137),
(385, 'Micronesia', '0a58e26f53f8236d2a59eec022ced7b1.png', 'true', 138),
(386, 'Moldova', '5921a73d8584a683982e04d098360669.png', 'true', 139),
(387, 'Monaco', '6ca8a5baf46e4cf654d59f84ddf018fa.png', 'true', 140),
(388, 'Mongolia', '65d5ad9104338b8126f8cbf15c09159f.png', 'true', 141),
(389, 'Montenegro', '50223c7336cd4027b11a087326f6eaea.png', 'true', 142),
(390, 'Montserrat', '4b65f95146dddca56967e75fb8d14475.png', 'true', 143),
(391, 'Morocco', 'c1aa1feb1dd03e0713ea7482d702cb2c.png', 'true', 144),
(392, 'Mozambique', 'd46989bdf9d075862f8fb5521f179604.png', 'true', 145),
(393, 'Myanmar', 'e5042ea24fa9c395027afabada77a36a.png', 'true', 146),
(394, 'Namibia', '6ea05252a428d0335df87df3511d0f5e.png', 'true', 147),
(395, 'Nauru', 'b9ed8d8682ed037a7daef9f10785dfd5.png', 'true', 148),
(396, 'Nepal', '66800c380f67527973d7dfce6fa06a1e.png', 'true', 149),
(397, 'Netherlands', '8040d8d1cac78c8e46dbaab5bfd0dfee.png', 'true', 150),
(398, 'New Caledonia', '99289ba263e70886d482680e2bb3e364.png', 'true', 151),
(399, 'New Zealand', '96794dea038883c3f0a46958ab6432f5.png', 'true', 152),
(400, 'Nicaragua', '9e1b9058ee0b5ef6f074fb7ea36374ef.png', 'true', 153),
(401, 'Niger', 'f22e7809cafb0886646526f8046c6834.png', 'true', 154),
(402, 'Nigeria', 'daef34c20802492bf2f9dd1a94a701c1.png', 'true', 155),
(403, 'Niue', 'a675b0abdba489d810cd22c1209afd54.png', 'true', 156),
(404, 'Norfolk Island', '5efd7062153653397cd7916a1dede1b8.png', 'true', 157),
(405, 'Northern Mariana Islands', 'c0ecf0ce43469b4ebeb76a257750c3f3.png', 'true', 158),
(406, 'Norway', '8b560f217bf0674167ffa3068bde7187.png', 'true', 159),
(407, 'Oman', '556faf82b4bb21453bbc495c48cd132a.png', 'true', 160),
(408, 'Pakistan', 'cd78b3f6f0923558a431e344e3f0e919.png', 'true', 161),
(409, 'Palau', 'c96ad17c4ff8b439b448ebbc02a4e36a.png', 'true', 162),
(410, 'Palestine', '052b37a5517a13535a48ebdbf6e5fd80.png', 'true', 163),
(411, 'Panama', 'c956584779fa85b50578b966ef05f4a6.png', 'true', 164),
(412, 'Papua New Guinea', '14b12d2aec82aabeb507956a9dcb82a1.png', 'true', 165),
(413, 'Paraguay', 'b712a98a96caa4d063747fec147b0c39.png', 'true', 166),
(414, 'Peru', 'f74545940011c7c230b535d9644ea433.png', 'true', 167),
(415, 'Philippines', '20ae0b5a8f55ae5e158fef462f2dac67.png', 'true', 168),
(416, 'Pitcairn', 'ea94d859adc6a71c2c4549c86d087659.png', 'true', 169),
(417, 'Poland', 'abbf76c8e1b6bb0d7b308deba8bc6205.png', 'true', 170),
(418, 'Portugal', '7f6db344ef8f552b5ea8ea1404324432.png', 'true', 171),
(419, 'Puerto Rico', '5af41bb7871f137b32f2f602f31ed244.png', 'true', 172),
(420, 'Qatar', '466e21a09326c7f38b99f3f1abb2a89b.png', 'true', 173),
(421, 'Reunion', '5734e756a00967801a15bdf0a609d8d2.png', 'true', 174),
(422, 'Romania', '52a423782f699de431d7f98075265881.png', 'true', 175),
(423, 'Russian Federation', 'e9710cb3d07143061b9861bbc07ce242.png', 'true', 176),
(424, 'Rwanda', 'fc9eb0acea90001d5fe1cf5db4dbfd3b.png', 'true', 177),
(425, 'Saint Kitts and Nevis', 'd0deb31b0c275a3380185c12f512939f.png', 'true', 178),
(426, 'Saint Lucia', 'ad493280396f9e6134bb62a0209ec0da.png', 'true', 179),
(427, 'Saint Pierre and Miquelon', '77065776976139303823245fe6d2d102.png', 'true', 180),
(428, 'Saint Vincent and the Grenadines', 'f153cf82e9bd0d86e54d087cd0bc66de.png', 'true', 181),
(429, 'Samoa', '6e7da53219501d612d95c896ec2a8a96.png', 'true', 182),
(430, 'San Marino', 'a7d3e8c561c21a5d49861387c04e25db.png', 'true', 183),
(431, 'Sao Tome and Principe', '96767d83641ac91bab1302cad974a261.png', 'true', 184),
(432, 'Saudi Arabia', '241c1fb9d5cdf5c99283d990bec180ef.png', 'true', 185),
(433, 'Senegal', '5bf3a3f68bfbd50f15822f584dac143c.png', 'true', 186),
(434, 'Serbia', 'e1c33d5d92e76947ad08d41da94c0498.png', 'true', 187),
(435, 'Seychelles', '1246db42010e4f0b182dd54b0d9bd6af.png', 'true', 188),
(436, 'Sierra Leone', '5214d38d8d362e04a193f6322603155e.png', 'true', 189),
(437, 'Singapore', '4e29e75f1c18404206b840a494745f12.png', 'true', 190),
(438, 'Slovakia', '60ad4c17b92864b6e2d04cf48a83b95a.png', 'true', 191),
(439, 'Slovenia', 'a911e56016edfca2e9974a93124f7cc1.png', 'true', 192),
(440, 'Solomon Islands', '18e93ea4eee552e2a0c2ff75951fa4ec.png', 'true', 193),
(441, 'Somalia', 'd2356b6e1111577622ae6c9811432d07.png', 'true', 194),
(442, 'South Africa', '8566a6d97f180a83ca43355117656945.png', 'true', 195),
(443, 'South Georgia and South Sandwich Islands', '41fae36c27e33040347489fd7605ef24.png', 'true', 196),
(444, 'Spain', 'e0ac07fa6d7f53291bc67270a162afac.png', 'true', 197),
(445, 'Sri Lanka', 'ccbcefb3b2d115ab06ccbffe961118c4.png', 'true', 198),
(446, 'Sudan', '3bbc521b23a8493db22580a64233c610.png', 'true', 199),
(447, 'Suriname', 'f8c00d6360a26ef339b30805fdc2a6c7.png', 'true', 200),
(448, 'Svalbard and Jan Mayen Islands', '95d871bceea62851946ceb55080ca041.png', 'true', 201),
(449, 'Swaziland', '611cb05b04992df3933130f4d2523ad0.png', 'true', 202),
(450, 'Sweden', 'ac7934944b54fd8a457f3dd79b536192.png', 'true', 203),
(451, 'Switzerland', '8fc4dfa622058e95113b8854fd49949b.png', 'true', 204),
(452, 'Syria', 'a1ab2ece2fd0df77654c1033439299ef.png', 'true', 205),
(453, 'Taiwan', '8fafec67ee81a414ea4cf555758697e7.png', 'true', 206),
(454, 'Tajikistan', '3b624f18afa8c6e7570ea2a00339244e.png', 'true', 207),
(455, 'Tanzania', 'a461305e20378d03d973e7704885fba8.png', 'true', 208),
(456, 'Thailand', '15cc52b924ffdce590842f9c15b7043c.png', 'true', 209),
(457, 'Timor-Leste', 'ca4ba167e957aeff1dd21f296495d437.png', 'true', 210),
(458, 'Togo', '17031ad462258659ac571aacd19a05ad.png', 'true', 211),
(459, 'Tokelau', '051d1bd12aaead8777123f965a338813.png', 'true', 212),
(460, 'Tonga', 'a9f4791adf85f3ed0c37c796d6603fdb.png', 'true', 213),
(461, 'Trinidad and Tobago', '6dccbb898b6367e3eddc3babdebbb9f3.png', 'true', 214),
(462, 'Tunisia', '7de0bb302da904b7b9a34cc50054f30a.png', 'true', 215),
(463, 'Turkey', 'c3fec7b661338849b17faa913b26d4fc.png', 'true', 216),
(464, 'Turkmenistan', '0cdca1b1ea629996f45bd1215b931ae7.png', 'true', 217),
(465, 'Turks and Caicos Islands', 'cd62fecfce8566f9b17ea585df5743ae.png', 'true', 218),
(466, 'Tuvalu', 'd557da0199dcbc94c6186946c5cd6a2d.png', 'true', 219),
(467, 'Uganda', '9fdf509faf770d77d23522542c37a698.png', 'true', 220),
(468, 'Ukraine', '060f848c9b17b047ddf827fa2e1a91cb.png', 'true', 221),
(469, 'United Arab Emirates', 'e50ddab12a509f5b771f7f39f2f2b094.png', 'true', 222),
(470, 'United Kingdom', '2f87cff2c952982e406736a256fd9e61.png', 'true', 223),
(471, 'United States Minor Outlying Islands', '98e23f23b2e9b61853198440df3552fe.png', 'true', 224),
(472, 'United States of America', '2aa9a73686c023b965817746082e3239.png', 'true', 225),
(473, 'Uruguay', '476e793bd9509023ca54b923fe93f6be.png', 'true', 226),
(474, 'Uzbekistan', '55ddb3d8115bbdc0e4e295ff9faffddf.png', 'true', 227),
(475, 'Vanuatu', '8ddac65cb614b22fff79311212fab82e.png', 'true', 228),
(476, 'Venezuela', '792406547c8c3ddc331b09c1cbbd960c.png', 'true', 229),
(477, 'Vietnam', '3dae53414d554b396a4a0293e1eaac4c.png', 'true', 230),
(478, 'Virgin Islands, British', '69faf31e956c01c1302a660407b6855e.png', 'true', 231),
(479, 'Virgin Islands, U.S.', '5074b86713f5474afc11e6cade4e7f3b.png', 'true', 232),
(480, 'Wallis and Futuna Islands', '1c9840b39b9eaf5a7325fc399859afe3.png', 'true', 233),
(481, 'Western Sahara', 'f0f48b2d50713a5e65adc832f6574fe8.png', 'true', 234),
(482, 'Yemen', '6e6e268603fab01355a2e5a3f7f25473.png', 'true', 235),
(483, 'Zambia', 'b4411177c502c48f6bafe68396881285.png', 'true', 236),
(484, 'Zimbabwe', '11d23665e2c3a116b38fd2ce558a5145.png', 'true', 237),
(485, 'Europe', '4d21782056f63f7c43746775dce400c5.png', 'true', 68);
	");
	
	mysql_query("	
           INSERT INTO `deposit` (`id`, `user_id`, `deposit`, `paid`, `datetime`, `from_admin`) VALUES
            (1, 1, 500, 'true', '2013-06-06 00:00:00', 0),
            (2, 1, 500, 'true', '2013-07-21 18:17:49', 1);
	");
	
	mysql_query("
       INSERT INTO `history` (`id`, `user_id`, `action`, `transaction_id`, `datetime`) VALUES
        (1, 1, 'Deposit 500$', '1', '0000-00-00 00:00:00');
	");
	
	mysql_query("ALTER TABLE `system` ADD `group` VARCHAR( 128 ) NOT NULL ,ADD INDEX ( `group` );");
	mysql_query("UPDATE `system` SET `group` = 'config';");
	mysql_query("UPDATE `system` SET `group`='paypal' WHERE `key` = 'paypal_email';");
	mysql_query("INSERT INTO `system` (`key`, `value`, `system`, `group`) VALUES ('paypal_status', '1', '1', 'paypal'), ('paypal_order', '1', '1', 'paypal');");
	mysql_query("UPDATE `system` SET `group`='images', `system` = 0 WHERE `key` = 'site_logo';");

	
?>