<?php
/*
Plugin Name: realpress
Plugin URI: http://realpress.net/wordpress
Description: Build your site as a powerful real estate site, you can easy publish your property listing , change the skin of your interface..., 
Version: 1.0.2
Author: 
Author URI: http://realpress.net/wordpress
*/

/*
Copyright 2010 realpress.net  (contribution by Maxim Denisov - email : mpdenisov@rhinoda.com, web: http://www.rhinoda.com  
*/

@session_start();
require_once(ABSPATH.'wp-settings.php');
require_once(ABSPATH.'wp-admin/includes/post.php');
require_once(ABSPATH.'wp-admin/includes/template.php');
//delete_option('realInstalled');

/***************************************************************/
/******function:loadLanguages                           ********/
/******usage:Load customize languages of this plugin          **/
/***************************************************************/
function loadLanguages()
{
  global $wpdb;
  

  //if change language from the form
	if (isset($_POST["realLangguage"]))
			update_option('realLangguage',$m_languages =$wpdb->escape($_POST['realLangguage']));	
  else	     
      $m_languages =  get_option("realLangguage");
  
	if (empty($m_languages))
	{
		$m_languages = 'en';
	}
	require_once (dirname (__FILE__) . "/language/$m_languages-language.php" );
	return $admin_messages;
}
$m_allLanguage = loadLanguages();
require_once("realfunctions.php");
//realRunCustomTheme();

/***************************************************************/
/****  function:realMenu                                ********/
/****  usage:Menu of this plugin                        ********/
/***************************************************************/

function realMenu()
{
	add_menu_page(__('Real Press','RealPress'), __('Real Press','RealPress'), 10, 'realfunctions.php','realManager');
	add_submenu_page('realfunctions.php',__('System Guide','RealPress'), __('System Guide','RealPress'),10, 'realfunctions.php','realManager');
	add_submenu_page('realfunctions.php',__('List Management','RealPress'), __('List Management','RealPress'),10, basename(dirname(__FILE__)).'/listManagement.php');
	add_submenu_page('realfunctions.php',__('List Editor','RealPress'), __('List Editor','RealPress'),10, basename(dirname(__FILE__)).'/listEditor.php');
	add_submenu_page('realfunctions.php', __('Options Management','RealPress'), __('Options Management','RealPress'), 10 , basename(dirname(__FILE__)).'/optionsManagement.php');
	add_submenu_page('realfunctions.php', __('Theme Editor','RealPress'), __('Theme Editor','RealPress'), 10 , basename(dirname(__FILE__)).'/themeManagement.php');
}

/***************************************************************/
/******function:realpress_activate                      ********/
/******usage:Install database,update options when installing  **/
/***************************************************************/
function realpress_activate( ) 
{
	realpress_db( );
	realpress_options( );
	
	$m_hadSelectedTheme = get_option('realpressTheme');
	if (empty($m_hadSelectedTheme))
	{
		$m_hadSelectedTheme = "refreshing";
		update_option('realpressTheme',$m_hadSelectedTheme);
	}
	
	update_option( 'realpress_version', '1.0.2' );
	update_option( 'realpress_ispro', 'NO' );
}


/***************************************************************/
/******function:realpress_options                      *********/
/******usage:Install database and init setting for the system **/
/***************************************************************/
function realpress_options()
{
	$m_getRealPressPro = update_option( 'realProURL','http://realpress.net/pro' );
	
}

/***************************************************************/
/********function realpress_db     *****************************/
 /*******usage:Install database and init setting for the system*/
/***************************************************************/
function realpress_db()
{
	require_once(ABSPATH . 'wp-admin/upgrade-functions.php');
	global $table_prefix, $wpdb,$wp_version,$wp_rewrite;	
	
	$table_name = $table_prefix . "realpresslist";
	if ($wpdb->get_var("SHOW TABLES LIKE '{$table_name}'") !== $table_name)
	{
		$sql = "CREATE TABLE " . $table_name . " (
			id INT(11) NOT NULL auto_increment,
			houseid INT(11) NOT NULL,
			postid int(10) NOT NULL default '0',
			wp_userid int(10) NOT NULL default '0',
			total_view int(10) NOT NULL default '0',
	  		PRIMARY KEY  (`id`)
		) TYPE=MyISAM;";
	}
	dbDelta($sql);

	
	$table_name = $table_prefix . "realpresshouse";
	if ($wpdb->get_var("SHOW TABLES LIKE '{$table_name}'") !== $table_name)
	{
		$sql = "CREATE TABLE " . $table_name . " (
			id INT(11) NOT NULL auto_increment,
			postid int(10) NOT NULL default '0',
			addressnumber VARCHAR(255),
			stree VARCHAR(255),
			city VARCHAR(255),
			state VARCHAR(255),
			country VARCHAR(255),
			postcode VARCHAR(255),
			propertytype VARCHAR(255),
			listingtype VARCHAR(255),
			listingfeatures TEXT NULL DEFAULT NULL,
			propertyfeatures VARCHAR(255) NULL DEFAULT NULL,
			neighborhood VARCHAR(255),
			mls VARCHAR(255),
			sqft int(10),
			price_sqft int(10),
			price_total int(10),
			saled_price int(10),
			wp_userid int(10) NOT NULL default '0',
			yearbuild int(10),
			beds int(10),
			baths int(10),
			garages int(10),
			acres int(10),
			listdate datetime NOT NULL default '0000-00-00 00:00:00',
			saledate datetime NOT NULL default '0000-00-00 00:00:00',
			currencyid VARCHAR(10),
			featured VARCHAR(30) NOT NULL default 'NO',
			agentid VARCHAR(255),
			status VARCHAR(255),
			valid VARCHAR(20) NOT NULL default 'YES',
			description  TEXT NOT NULL,			
	  		PRIMARY KEY  (`id`)
		) TYPE=MyISAM;";
	}
	dbDelta($sql);
	

	$table_name = $table_prefix . "realpresshistory";
	if ($wpdb->get_var("SHOW TABLES LIKE '{$table_name}'") !== $table_name)
	{
		$sql = "CREATE TABLE " . $table_name . " (
			id INT(11) NOT NULL auto_increment,
			actionid INT(11) NOT NULL,
			listid INT(11) NOT NULL,
			wp_userid int(10) NOT NULL default '0',
			actionname VARCHAR(255),
			actionvalue VARCHAR(255),
			comments TEXT NOT NULL,
			actiondate datetime NOT NULL default '0000-00-00 00:00:00',
	  		PRIMARY KEY  (`id`)
		) TYPE=MyISAM;";
	}
	dbDelta($sql);

	$table_name = $table_prefix . "realpresscountry";
	
	if ($wpdb->get_var("SHOW TABLES LIKE '{$table_name}'") !== $table_name)
	{
		$sql = "CREATE TABLE ".$table_name." (
				`country_code` char(2) NOT NULL DEFAULT '',
				`country_name` varchar(255) NOT NULL DEFAULT '',
				`time_zone` int(11) NOT NULL DEFAULT 0,
				`have_state` varchar(255) NOT NULL DEFAULT 'NO',
				`postcodeformat` varchar(255) NOT NULL DEFAULT 'NO',
	  		PRIMARY KEY  (`country_code`)
		) TYPE=MyISAM;";
		
		dbDelta($sql);
		
		$m_sql = "INSERT INTO `".$table_name."` (`country_code`,`country_name`,`time_zone`,`have_state`,`postcodeformat`) VALUES  
		('AD', 'Andorra', 1,'NO','NO'),
		('AE', 'United Arab Emirates', 2,'NO','NO'),
		('AG', 'Antigua and Barbuda', 2,'NO','NO'),
		('AI', 'Anguilla', 2,'NO','NO'),
		('AL', 'Albania', 1,'NO','NO'),
		('AM', 'Armenia', 1,'NO','NO'),
		('AN', 'Netherlands Antilles', 2,'NO','NO'),
		('AO', 'Angola', 2,'NO','NO'),
		('AR', 'Argentina', 2,'NO','NO'),
		('AT', 'Austria', 1,'NO','NO'),
		('AU', 'Australia', 3,'NO','NO'),
		('AW', 'Aruba', 2,'NO','NO'),
		('AZ', 'Azerbaijan Republic', 1,'NO','NO'),
		('BA', 'Bosnia and Herzegovina', 1,'NO','NO'),
		('BB', 'Barbados', 2,'NO','NO'),
		('BE', 'Belgium', 1,'NO','NO'),
		('BF', 'Burkina Faso', 2,'NO','NO'),
		('BG', 'Bulgaria', 1,'NO','NO'),
		('BH', 'Bahrain', 2,'NO','NO'),
		('BI', 'Burundi', 2,'NO','NO'),
		('BJ', 'Benin', 2,'NO','NO'),
		('BM', 'Bermuda', 2,'NO','NO'),
		('BN', 'Brunei', 2,'NO','NO'),
		('BO', 'Bolivia', 2,'NO','NO'),
		('BR', 'Brazil', 2,'NO','NO'),
		('BS', 'Bahamas', 2,'NO','NO'),
		('BT', 'Bhutan', 2,'NO','NO'),
		('BW', 'Botswana', 2,'NO','NO'),
		('BZ', 'Belize', 2,'NO','NO'),
		('CA', 'Canada', 2,'NO','NO'),
		('CD', 'Democratic Republic of the Congo', 2,'NO','NO'),
		('CG', 'Republic of the Congo', 2,'NO','NO'),
		('CH', 'Switzerland', 1,'NO','NO'),
		('CK', 'Cook Islands', 3,'NO','NO'),
		('CL', 'Chile', 2,'NO','NO'),
		('CN', 'China', 3,'NO','NO'),
		('CO', 'Colombia', 2,'NO','NO'),
		('CR', 'Costa Rica', 2,'NO','NO'),
		('CV', 'Cape Verde', 2,'NO','NO'),
		('CY', 'Cyprus', 1,'NO','NO'),
		('CZ', 'Czech Republic', 1,'NO','NO'),
		('DE', 'Germany', 1,'NO','NO'),
		('DJ', 'Djibouti', 2,'NO','NO'),
		('DK', 'Denmark', 1,'NO','NO'),
		('DM', 'Dominica', 2,'NO','NO'),
		('DO', 'Dominican Republic', 2,'NO','NO'),
		('DZ', 'Algeria', 2,'NO','NO'),
		('EC', 'Ecuador', 2,'NO','NO'),
		('EE', 'Estonia', 1,'NO','NO'),
		('ER', 'Eritrea', 2,'NO','NO'),
		('ES', 'Spain', 1,'NO','NO'),
		('ET', 'Ethiopia', 2,'NO','NO'),
		('FI', 'Finland', 1,'NO','NO'),
		('FJ', 'Fiji', 3,'NO','NO'),
		('FK', 'Falkland Islands', 2,'NO','NO'),
		('FM', 'Federated States of Micronesia', 3,'NO','NO'),
		('FO', 'Faroe Islands', 1,'NO','NO'),
		('FR', 'France', 1,'NO','NO'),
		('GA', 'Gabon Republic', 2,'NO','NO'),
		('GB', 'United Kingdom', 1,'NO','NO'),
		('GD', 'Grenada', 2,'NO','NO'),
		('GF', 'French Guiana', 2,'NO','NO'),
		('GI', 'Gibraltar', 1,'NO','NO'),
		('GL', 'Greenland', 1,'NO','NO'),
		('GM', 'Gambia', 2,'NO','NO'),
		('GN', 'Guinea', 2,'NO','NO'),
		('GP', 'Guadeloupe', 3,'NO','NO'),
		('GR', 'Greece', 1,'NO','NO'),
		('GT', 'Guatemala', 2,'NO','NO'),
		('GW', 'Guinea Bissau', 2,'NO','NO'),
		('GY', 'Guyana', 2,'NO','NO'),
		('HK', 'Hong Kong', 2,'NO','NO'),
		('HN', 'Honduras', 2,'NO','NO'),
		('HR', 'Croatia', 1,'NO','NO'),
		('HU', 'Hungary', 1,'NO','NO'),
		('ID', 'Indonesia', 2,'NO','NO'),
		('IE', 'Ireland', 1,'NO','NO'),
		('IL', 'Israel', 2,'NO','NO'),
		('IN', 'India', 2,'NO','NO'),
		('IS', 'Iceland', 1,'NO','NO'),
		('IT', 'Italy', 1,'NO','NO'),
		('JM', 'Jamaica', 2,'NO','NO'),
		('JO', 'Jordan', 2,'NO','NO'),
		('JP', 'Japan', 3,'NO','NO'),
		('KE', 'Kenya', 2,'NO','NO'),
		('KG', 'Kyrgyzstan', 1,'NO','NO'),
		('KH', 'Cambodia', 2,'NO','NO'),
		('KI', 'Kiribati', 3,'NO','NO'),
		('KM', 'Comoros', 2,'NO','NO'),
		('KN', 'St. Kitts and Nevis', 2,'NO','NO'),
		('KR', 'South Korea', 3,'NO','NO'),
		('KW', 'Kuwait', 2,'NO','NO'),
		('KY', 'Cayman Islands', 2,'NO','NO'),
		('KZ', 'Kazakhstan', 1,'NO','NO'),
		('LA', 'Laos', 3,'NO','NO'),
		('LC', 'St. Lucia', 2,'NO','NO'),
		('LI', 'Liechtenstein', 1,'NO','NO'),
		('LK', 'Sri Lanka', 2,'NO','NO'),
		('LS', 'Lesotho', 2,'NO','NO'),
		('LT', 'Lithuania', 1,'NO','NO'),
		('LU', 'Luxembourg', 1,'NO','NO'),
		('LV', 'Latvia', 1,'NO','NO'),
		('MA', 'Morocco', 2,'NO','NO'),
		('MG', 'Madagascar', 2,'NO','NO'),
		('MH', 'Marshall Islands', 3,'NO','NO'),
		('ML', 'Mali', 2,'NO','NO'),
		('MN', 'Mongolia', 3,'NO','NO'),
		('MQ', 'Martinique', 3,'NO','NO'),
		('MR', 'Mauritania', 2,'NO','NO'),
		('MS', 'Montserrat', 2,'NO','NO'),
		('MT', 'Malta', 1,'NO','NO'),
		('MU', 'Mauritius', 2,'NO','NO'),
		('MV', 'Maldives', 2,'NO','NO'),
		('MW', 'Malawi', 2,'NO','NO'),
		('MX', 'Mexico', 2,'NO','NO'),
		('MY', 'Malaysia', 2,'NO','NO'),
		('MZ', 'Mozambique', 2,'NO','NO'),
		('NA', 'Namibia', 2,'NO','NO'),
		('NC', 'New Caledonia', 3,'NO','NO'),
		('NE', 'Niger', 2,'NO','NO'),
		('NF', 'Norfolk Island', 3,'NO','NO'),
		('NI', 'Nicaragua', 2,'NO','NO'),
		('NL', 'Netherlands', 1,'NO','NO'),
		('NO', 'Norway', 1,'NO','NO'),
		('NP', 'Nepal', 2,'NO','NO'),
		('NR', 'Nauru', 3,'NO','NO'),
		('NU', 'Niue', 3,'NO','NO'),
		('NZ', 'New Zealand', 3,'NO','NO'),
		('OM', 'Oman', 2,'NO','NO'),
		('PA', 'Panama', 2,'NO','NO'),
		('PE', 'Peru', 2,'NO','NO'),
		('PF', 'French Polynesia', 3,'NO','NO'),
		('PG', 'Papua New Guinea', 3,'NO','NO'),
		('PH', 'Philippines', 3,'NO','NO'),
		('PL', 'Poland', 1,'NO','NO'),
		('PM', 'St. Pierre and Miquelon', 2,'NO','NO'),
		('PN', 'Pitcairn Islands', 3,'NO','NO'),
		('PT', 'Portugal', 1,'NO','NO'),
		('PW', 'Palau', 3,'NO','NO'),
		('QA', 'Qatar', 2,'NO','NO'),
		('RE', 'Reunion', 2,'NO','NO'),
		('RO', 'Romania', 1,'NO','NO'),
		('RU', 'Russia', 1,'NO','NO'),
		('RW', 'Rwanda', 2,'NO','NO'),
		('SA', 'Saudi Arabia', 2,'NO','NO'),
		('SB', 'Solomon Islands', 3,'NO','NO'),
		('SC', 'Seychelles', 2,'NO','NO'),
		('SE', 'Sweden', 1,'NO','NO'),
		('SG', 'Singapore', 2,'NO','NO'),
		('SH', 'St. Helena', 2,'NO','NO'),
		('SI', 'Slovenia', 1,'NO','NO'),
		('SJ', 'Svalbard and Jan Mayen Islands', 3,'NO','NO'),
		('SK', 'Slovakia', 1,'NO','NO'),
		('SL', 'Sierra Leone', 2,'NO','NO'),
		('SM', 'San Marino', 1,'NO','NO'),
		('SN', 'Senegal', 2,'NO','NO'),
		('SO', 'Somalia', 2,'NO','NO'),
		('SR', 'Suriname', 2,'NO','NO'),
		('ST', 'Sao Tome and Principe', 2,'NO','NO'),
		('SV', 'El Salvador', 2,'NO','NO'),
		('SZ', 'Swaziland', 2,'NO','NO'),
		('TC', 'Turks and Caicos Islands', 2,'NO','NO'),
		('TD', 'Chad', 2,'NO','NO'),
		('TG', 'Togo', 2,'NO','NO'),
		('TH', 'Thailand', 2,'NO','NO'),
		('TJ', 'Tajikistan', 1,'NO','NO'),
		('TM', 'Turkmenistan', 1,'NO','NO'),
		('TN', 'Tunisia', 2,'NO','NO'),
		('TO', 'Tonga', 3,'NO','NO'),
		('TR', 'Turkey', 1,'NO','NO'),
		('TT', 'Trinidad and Tobago', 2,'NO','NO'),
		('TV', 'Tuvalu', 3,'NO','NO'),
		('TW', 'Taiwan', 3,'NO','NO'),
		('TZ', 'Tanzania', 2,'NO','NO'),
		('UA', 'Ukraine', 1,'NO','NO'),
		('UG', 'Uganda', 2,'NO','NO'),
		('US', 'United States', 2,'yes','NO'),
		('UY', 'Uruguay', 2,'NO','NO'),
		('VA', 'Vatican City State', 1,'NO','NO'),
		('VC', 'Saint Vincent and the Grenadines', 2,'NO','NO'),
		('VE', 'Venezuela', 2,'NO','NO'),
		('VG', 'British Virgin Islands', 2,'NO','NO'),
		('VN', 'Vietnam', 2,'NO','NO'),
		('VU', 'Vanuatu', 3,'NO','NO'),
		('WF', 'Wallis and Futuna Islands', 3,'NO','NO'),
		('WS', 'Samoa', 3,'NO','NO'),
		('YE', 'Yemen', 2,'NO','NO'),
		('YT', 'Mayotte', 3,'NO','NO'),
		('ZA', 'South Africa', 2,'NO','NO'),
		('ZM', 'Zambia', 2,'NO','NO');";
		$wpdb->query($m_sql);
	}
}

/***************************************************************/
/***********function : realUpdate                      *********/
/*******usage:this moudle is for update, now we do not used it**/
/***We can use this model later, so we keep this function here.*/
/***************************************************************/
function realUpdate()
{

	require_once(ABSPATH . 'wp-admin/upgrade-functions.php');
	global $table_prefix, $wpdb,$wp_version,$wp_rewrite;
	
	$table_name = $table_prefix . "realpresshouse";
	$alterRealSql = "ALTER  TABLE ".$table_name." CHANGE `currencyid` `currencyid` VARCHAR( 255 ) NULL DEFAULT NULL ";
	$wpdb->query($alterRealSql);

	
	/*
	$table_name = $table_prefix . "realpresslist";
	$alterRealSql = "ALTER  TABLE ".$table_name." ADD `postid` INT(10) NOT NULL default 0";
	$wpdb->query($alterRealSql);	

	$table_name = $table_prefix . "realpresshouse";
	$alterRealSql = "ALTER  TABLE ".$table_name." CHANGE `property` `propertytype` VARCHAR( 255 ) NULL DEFAULT NULL ";
	$wpdb->query($alterRealSql);
	$alterRealSql = "ALTER  TABLE ".$table_name." ADD `propertyfeatures` VARCHAR(255) NULL default NULL";
	$wpdb->query($alterRealSql);
	$alterRealSql = "ALTER  TABLE ".$table_name." CHANGE `listingfeatures` `listingfeatures` TEXT NULL DEFAULT NULL";
	$wpdb->query($alterRealSql);
	
	$alterRealSql = "ALTER  TABLE ".$table_name." ADD `postid` INT(11) NOT NULL default 0";
	$wpdb->query($alterRealSql);
	
	$table_name = $table_prefix . "realpresshistory";
	if ($wpdb->get_var("SHOW TABLES LIKE '{$table_name}'") !== $table_name)
	{
		$sql = "CREATE TABLE " . $table_name . " (
			id INT(11) NOT NULL auto_increment,
			actionid INT(11) NOT NULL,
			listid INT(11) NOT NULL,
			wp_userid int(10) NOT NULL default '0',
			actionname VARCHAR(255),
			actionvalue VARCHAR(255),
			comments TEXT NOT NULL,
			actiondate datetime NOT NULL default '0000-00-00 00:00:00',
	  		PRIMARY KEY  (`id`)
		) TYPE=MyISAM;";
	}
	dbDelta($sql);
	*/
}

//------------------------------------------
register_activation_hook( __FILE__, 'realpress_activate' );

add_action('admin_menu', 'realMenu');
add_action('wp_head','realMetaSEO');
add_action('wp_head','realPressHead');
add_action('admin_head','realPressAdminHead');
add_action('admin_footer','realPressFooter');
add_filter('the_content', 'realpressContentFilter');
add_filter('the_content_rss', 'realpressContentFilter');
add_filter('the_title','realTitleSEO');
add_filter('the_content', 'realpressIndexListing');
add_filter('the_excerpt', 'realpressExcerpt');

$m_update6 = get_option('realpress_update6');
if (empty($m_update6))
{
	realUpdate();	
	update_option('realpress_update6','YES');
}


//add_action('admin_head','realPressFooter');
?>