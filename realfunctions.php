<?php
session_start();

$arr=explode("/",dirname(__FILE__));
define("BASE_DIR",$arr[count($arr)-1]);

realRunCustomTheme();
//REW - Real Estate Wordpress(Widget) - get data from plugin tables
//WPnative - get data from native WP tables 
  $arr_search_form= array (
  "realpresstypes"    => array("db_field" =>"listingtype"    ,"value" =>"Listing Type"  ,"type"=>"select","style"=>"","data_type"=>"WPnative"),
  "realpropertyTypes" => array("db_field" =>"propertytype"   , "value" =>"Property Type","type"=>"select","style"=>"","data_type"=>"WPnative"),
  "country"           => array("db_field" =>"country"        , "value" =>"Country"      ,"type"=>"select","style"=>"","data_type"=>"REW"),
  "city"              => array("db_field" =>"city"           , "value" =>"City"         ,"type"=>"select","style"=>"","data_type"=>"REW"),
  "bedrooms"          => array("db_field" =>"beds"           , "value" =>"Bedrooms"     ,"type"=>"select","style"=>"width:115px;","data_type"=>"REW"),
  "realpressFeatures" => array("db_field" =>"listingfeatures", "value" =>"Features"     ,"type"=>"select","style"=>"","data_type"=>"WPnative"),//, "expr" => "like"
  "price_from"        => array("db_field" =>"price_total"    , "value" =>"Price From:"   ,"type"=>"input","style"=>"width:110px;", "expr"=>">=","prefix"=>"$"),
  "price_to"          => array("db_field" =>"price_total"    , "value" =>"Price To:"     ,"type"=>"input","style"=>"width:110px;", "expr"=>"<=","prefix"=>"$"),
);
$currency_arr = array ("GBP" => array("value" => "British Pound","spc"=>"£"),"EUR" => array("value" => "Euro","spc"=>"€"),"AED" => array("value" => "United Arab Emirates Dirham","spc"=>""),"USD" => array("value" => "United States Dollar","spc"=>"$"),"ALL" => array("value" => "Albanian Lek","spc"=>""),"DZD" => array("value" => "Algerian Dinar","spc"=>""),"ARS" => array("value" => "Argentine Peso","spc"=>""),"AWG" => array("value" => "Aruba","spc"=>""),"AUD" => array("value" => "Australian Dollar","spc"=>""),"BSD" => array("value" => "Bahamian Dollar","spc"=>""),"BHD" => array("value" => "Bahraini Dinar","spc"=>""),"BDT" => array("value" => "Bangladesh Taka","spc"=>""),"BBD" => array("value" => "Barbados Dollars","spc"=>""),"BYR" => array("value" => "Belarus Ruble","spc"=>""),"BYR" => array("value" => "Belarus Ruble","spc"=>""),"BZD" => array("value" => "Belize Dollar","spc"=>""),
"BMD" => array("value" => "Bermuda Dollar","spc"=>""),"BTN" => array("value" => "Bhutan Ngultrum","spc"=>""),"BOB" => array("value" => "Bolivia Boliviano","spc"=>""),"BWP" => array("value" => "Botswana Pula","spc"=>""),"BRL" => array("value" => "Brazilian Real","spc"=>""),"BND" => array("value" => "Brunei Dollar","spc"=>""),"BGN" => array("value" => "Bulgarian Lev","spc"=>""),"BIF" => array("value" => "Burundi Franc","spc"=>""),"KHR" => array("value" => "Cambodia Riel","spc"=>""),"CAD" => array("value" => "Canadian Dollar","spc"=>""),"CVE" => array("value" => "Cape Verde Escudo","spc"=>""),"KYD" => array("value" => "Cayman Islands Dollar","spc"=>""),"XOF" => array("value" => "Central African Republic","spc"=>""),"CLP" => array("value" => "Chilean Peso","spc"=>""),"CNY" => array("value" => "Chinese Yuan","spc"=>""),"COP" => array("value" => "Columbian Peso","spc"=>""),"KMF" => array("value" => "Comoros Franc","spc"=>""),"CRC" => array("value" => "Costa Rica Colon","spc"=>""),"HRK" => array("value" => "Croatian Kuna","spc"=>""),
"CUP" => array("value" => "Cuban Peso","spc"=>""),"CYP" => array("value" => "Cyprus Pound","spc"=>""),"CZK" => array("value" => "Czech Koruna","spc"=>""),"DKK" => array("value" => "Denmark Krone","spc"=>""),"DJF" => array("value" => "Djibouti Franc","spc"=>""),"DOP" => array("value" => "Dominican Peso","spc"=>""),"XCD" => array("value" => "East Caribbean Dollar","spc"=>""),"ECS" => array("value" => "Ecuador Sucre","spc"=>""),"EGP" => array("value" => "Egyptian Pound","spc"=>""),"SVC" => array("value" => "El Salvador Colon","spc"=>""),"ERN" => array("value" => "Eritrea Nakfa","spc"=>""),"EEK" => array("value" => "Estonian Kroon","spc"=>""),"ETB" => array("value" => "Ethiopian Birr","spc"=>""),"FKP" => array("value" => "Falkland Islands Pound","spc"=>""),"FJD" => array("value" => "Fiji Dollar","spc"=>""),"GMD" => array("value" => "Gambian Dalasi","spc"=>""),"GHC" => array("value" => "Ghanian Cedi","spc"=>""),"GIP" => array("value" => "Gibraltar Pound","spc"=>""),"GTQ" => array("value" => "Guatemala Quetzal","spc"=>""),"GNF" => array("value" => "Guinea Franc","spc"=>""),"GYD" => array("value" => "Guyana Dollar","spc"=>""),
"HTG" => array("value" => "Haiti Gourde","spc"=>""),"HNL" => array("value" => "Honduras Lempira","spc"=>""),"HKD" => array("value" => "Hong Kong Dollar","spc"=>""),"HUF" => array("value" => "Hungarian Forint","spc"=>""),"ISK" => array("value" => "Iceland Krona","spc"=>""),"INR" => array("value" => "Indian Rupee","spc"=>""),"IDR" => array("value" => "Indonesian Rupiah","spc"=>""),"IRR" => array("value" => "Iran Rial","spc"=>""),"IQD" => array("value" => "Iraqi Dinar","spc"=>""),"ILS" => array("value" => "Israeli Shekel","spc"=>""),"JMD" => array("value" => "Jamaican Dollar","spc"=>""),"JPY" => array("value" => "Japanese Yen","spc"=>""),"JOD" => array("value" => "Jordanian Dinar","spc"=>""),"KZT" => array("value" => "Kazakhstan Tenge","spc"=>""),"KES" => array("value" => "Kenyan Shilling","spc"=>""),"KRW" => array("value" => "Korean Won","spc"=>""),"KWD" => array("value" => "Kuwaiti Dinar","spc"=>""),"LAK" => array("value" => "Laos Kip","spc"=>""),"LVL" => array("value" => "Latvian Lat","spc"=>""),"LBP" => array("value" => "Lebanese Pound","spc"=>""),"LSL" => array("value" => "Lesotho Loti","spc"=>""),
"LRD" => array("value" => "Liberian Dollar","spc"=>""),"LYD" => array("value" => "Libyan Dinar","spc"=>""),"LTL" => array("value" => "Lithuanian Lita","spc"=>""),"MOP" => array("value" => "Macau Pataca","spc"=>""),"MKD" => array("value" => "Macedoniab Dinar","spc"=>""),"MWK" => array("value" => "Malawi Kwacha","spc"=>""),"MYR" => array("value" => "Malaysian Ringgit","spc"=>""),"MVR" => array("value" => "Maldives Rufiyaa","spc"=>""),"MTL" => array("value" => "Maltese Lira","spc"=>""),"MRO" => array("value" => "Mauritania Ougulya","spc"=>""),"MUR" => array("value" => "Mauritius Rupee","spc"=>""),"MXN" => array("value" => "Mexican Peso","spc"=>""),"MDL" => array("value" => "Moldovan Leu","spc"=>""),"MNT" => array("value" => "Mongolian Tugrik","spc"=>""),"MAD" => array("value" => "Moroccan Dirham","spc"=>""),"MMK" => array("value" => "Myanmar Kyat(Burma)","spc"=>""),
"NAD" => array("value" => "Namibian Dollar","spc"=>""),"NPR" => array("value" => "Nepalese Rupee","spc"=>""),"ANG" => array("value" => "Netherlands Antilles Guilder","spc"=>""),"TRY" => array("value" => "New Turkish Lira","spc"=>""),"NZD" => array("value" => "New Zealand Dollar","spc"=>""),"ZWN" => array("value" => "New Zimbabwe Dollar","spc"=>""),"NIO" => array("value" => "Nicaragua Cordoba","spc"=>""),"NGN" => array("value" => "Nigerian  Naira","spc"=>""),"KPW" => array("value" => "North Korean Won","spc"=>""),"NOK" => array("value" => "Norwegian Krone","spc"=>""),"OMR" => array("value" => "Omani Rial","spc"=>""),"XPF" => array("value" => "Pacific Franc","spc"=>""),"PKR" => array("value" => "Pakistani Rupee","spc"=>""),"PAB" => array("value" => "Panama Balboa","spc"=>""),"PGK" => array("value" => "Papua New Guinea Kina","spc"=>""),"PYG" => array("value" => "Paraguayan Guarani","spc"=>""),"PEN" => array("value" => "Peruvian Nuevo Sol","spc"=>""),"PHP" => array("value" => "Philippine Peso","spc"=>""),
"PLN" => array("value" => "Polish Zloty","spc"=>""),"QAR" => array("value" => "Qatar Rial","spc"=>""),"RON" => array("value" => "Romanian New Leu","spc"=>""),"RUB" => array("value" => "Russian Rouble","spc"=>""),"RWF" => array("value" => "Rwanda Franc","spc"=>""),"WST" => array("value" => "Samoa Tala","spc"=>""),"STD" => array("value" => "Sao Tome Dobra","spc"=>""),"SAR" => array("value" => "Saudi Arabian Rial","spc"=>""),"SCR" => array("value" => "Seychelles Rupee","spc"=>""),"SLL" => array("value" => "Sierra Leone Leone","spc"=>""),"SGD" => array("value" => "Singapore Dollar","spc"=>""),"SKK" => array("value" => "Slovak Koruna","spc"=>""),"SIT" => array("value" => "Slovenian Tolar","spc"=>""),"SBD" => array("value" => "Solomon Islands Dollar","spc"=>""),"SOS" => array("value" => "Somali Shilling","spc"=>""),"ZAR" => array("value" => "South African Rand","spc"=>""),"KRW" => array("value" => "South Korea Won","spc"=>""),"LKR" => array("value" => "Sri Lanka Rupee","spc"=>""),"SHP" => array("value" => "St Helena Pound","spc"=>""),"SDD" => array("value" => "Sudanese Dinar","spc"=>""),"SZL" => array("value" => "Swaziland Lilageni","spc"=>""),
"SEK" => array("value" => "Swedish Krona","spc"=>""),"CHF" => array("value" => "Swiss Franc","spc"=>""),"SYP" => array("value" => "Syrian Pound","spc"=>""),"TWD" => array("value" => "Taiwan Dollar","spc"=>""),"TZS" => array("value" => "Tanzanian Shilling","spc"=>""),"THB" => array("value" => "Thai Baht","spc"=>""),"TOP" => array("value" => "Tonga Pa\'anga","spc"=>""),"TTD" => array("value" => "Trinidad And Tobago Dollar","spc"=>""),"TND" => array("value" => "Tunisian Dinar","spc"=>""),"UGX" => array("value" => "Ugandan Shilling","spc"=>""),"UAH" => array("value" => "Ukraine Hrynvia","spc"=>""),"AED" => array("value" => "United Arab Emirates Dirham","spc"=>""),"UYU" => array("value" => "Uruguayan New Peso","spc"=>""),"VUV" => array("value" => "Vanuatu Vatu","spc"=>""),"VEB" => array("value" => "Venezuelan Bolivar","spc"=>""),"VND" => array("value" => "Vietnam Dong","spc"=>""),"YER" => array("value" => "Yemen Riyal","spc"=>""),"ZMK" => array("value" => "Zambian Kwacha","spc"=>""));




function functionLoader()
{
	
}



 
/***************************************************************/
/****  function:realManager                             ********/
/****  usage:Show system guide of real press            ********/
/***************************************************************/

function realManager()
{
	echo "<br />";
	?>
	<div class="wrap">
		<h2><?php _e('Welcome to Realpress', 'realpress') ?></h2>
		<div id="dashboard-widgets-wrap">
		    <div id="dashboard-widgets" class="metabox-holder">
				<div id="post-body">
					<div id="dashboard-widgets-main-content">
						<div class="postbox-container" style="width:90%;">
							<div class="postbox">
								<h3 class='hndle'><span>
									System Guide
								</span>
								</h3>
							
								<div class="inside" style='padding-left:5px;'>
									<br />
									<I>Currently</I>, you have <font size="+1"><a href="<?php echo get_option('siteurl')."/wp-admin/admin.php?page=".BASE_DIR."/listManagement.php" ?>"><?php  echo realListingNumber('all'); ?></a></font> Listings:
									<?php echo realListingNumber('active'); ?> actived and <?php echo realListingNumber('inactived'); ?> inactived
									<br />
									<br />
									<I>New Listing</I>? go to  <a href="<?php echo get_option('siteurl')."/wp-admin/admin.php?page=".BASE_DIR."/listEditor.php" ?>">Real Estate Editor</a>, step by step , it is easy.
									<br />
									<br />
									<I>Current Skin</I>: <?php echo get_option('realpressTheme'); ?>, you can change skin at <a href="<?php echo get_option('siteurl')."/wp-admin/admin.php?page=".BASE_DIR."/optionsManagement.php#realappearance" ?>">here</a>, or edit skin at <a href="<?php echo get_option('siteurl')."/wp-admin/admin.php?page=".BASE_DIR."/themeManagement.php" ?>">here</a>
									<br />
									<br />
									<br />
								</div>
							</div>
						</div>
					</div>
				</div>
		    </div>
		</div>
	</div>
	<div style="clear:both"></div>
	<br />
    
    <div id="dashboard-widgets-wrap">
		    <div id="dashboard-widgets" class="metabox-holder">
				<div id="post-body">
					<div id="dashboard-widgets-main-content">
						<div class="postbox-container" style="width:90%;">
							<div class="postbox">
								<h3 class='hndle'><span>
									Support
								</span>
								</h3>
							
								<div class="inside" style='padding-left:5px;'>
									<br />
									<I>Realpress</I> is a plugin that allows you to create a powerful real estate site using your wordpress as a CMS. <br />
									<br />Any questions please contact Support <a href='http://realpress.net/groups/realpress-pro-support' target="_blank"> HERE </a>
									<br />
									<br />
									<br />
								</div>
							</div>
						</div>
					</div>
				</div>
		    </div>
		</div>
<div style="clear:both"></div>
	<br />
    
     <div id="dashboard-widgets-wrap">
		    <div id="dashboard-widgets" class="metabox-holder">
				<div id="post-body">
					<div id="dashboard-widgets-main-content">
						<div class="postbox-container" style="width:90%;">
							<div class="postbox">
								<h3 class='hndle'><span>
									Search Tools
								</span>
								</h3>
							
								<div class="inside" style='padding-left:5px;'>
									<br />
									You can now download a custom search widget from <a href='http://realpress.net/plugins/' target="_blank"> HERE </a> 
									<br />
									<br />
                                    The Widget provides a flixible tool in the sidebar allowing visitors to search and find you property listings by various field you preset in the widget settings.
                                    <br />
									<br />
                                    Screenshots: <a href='http://realpress.net/screenshots/search-tool.gif' target="_blank">Search Tool</a> / <a href='http://realpress.net/screenshots/widget_settings.gif' target="_blank">Widget Settings</a>
                                     <br />
									<br />
									<br />
								</div>
							</div>
						</div>
					</div>
				</div>
		    </div>
		</div>
<div style="clear:both"></div>
	<br />
    
     <div id="dashboard-widgets-wrap">
		    <div id="dashboard-widgets" class="metabox-holder">
				<div id="post-body">
					<div id="dashboard-widgets-main-content">
						<div class="postbox-container" style="width:90%;">
							<div class="postbox">
								<h3 class='hndle'><span>
									Feature Widgets
								</span>
								</h3>
							
								<div class="inside" style='padding-left:5px;'>
									<br />
									You can now download an advanced Featured Listings widget from <a href='http://realpress.net/plugins/' target="_blank"> HERE </a> 
									<br />
									<br />
                                    The Widget provides two styles of Feature Property Widgets for your sidebar; a slideshow displaying individual listings, and a multi feature widget and displays all the listings you have selected as featured in your Realpress options.
                                    <br />
									<br />
                                    Screenshots: <a href='http://realpress.net/screenshots/feature-tool.gif' target="_blank">Feature Properties Tool</a> / <a href='http://realpress.net/screenshots/feature-property-settings.gif' target="_blank">Feature Listings Widget Settings</a>
                                     <br />
									<br />
									<br />
								</div>
							</div>
						</div>
					</div>
				</div>
		    </div>
		</div>
<div style="clear:both"></div>
	<br />
    
     <div id="dashboard-widgets-wrap">
		    <div id="dashboard-widgets" class="metabox-holder">
				<div id="post-body">
					<div id="dashboard-widgets-main-content">
						<div class="postbox-container" style="width:90%;">
							<div class="postbox">
								<h3 class='hndle'><span>
									Additional Plugins Required
								</span>
								</h3>
							
								<div class="inside" style='padding-left:5px;'>
									<br />
								<br />
	
		<span style="color:#F00">Important!</span> A number of additional plugins are required to be installed and actived in order for the advanced features of this plugin to be fully operational.
		<br />
		Please see the <a href='<?php echo get_option("siteurl")."/wp-content/plugins/".BASE_DIR."/readme.txt"  ?>' target="_blank">Read Me</a> file for more details.<br />
		<br />
                                    
									<br />
								</div>
							</div>
						</div>
					</div>
				</div>
		    </div>
		</div>
    
	
	<?php
}

/***************************************************************/
/****  function:realCountryCodeToName	                ********/
/****  usage:From country code to get full name         ********/
/***************************************************************/
function realCountryCodeToName($m_postCountryCode)
{
	global $wpdb,$table_prefix,$wp_version,$userdata,$current_user, $user_ID,$post,$wp_rewrite;

	$table_name = $table_prefix . "realpresscountry";
	$m_nameSQL = "select `country_name` from `".$table_name."` where `country_code` = '".$m_postCountryCode."' limit 1";
	$m_nameResult = $wpdb->get_var($m_nameSQL);
	if (empty($m_nameResult))
	{
		return false;
	}
	else 
	{
		return $m_nameResult;
	}
}

/***************************************************************/
/****  function:realGetCountry                          ********/
/****  usage:All country name show in  a select box     ********/
/***************************************************************/
function realGetCountry($p_name,$p_notice= null,$p_now = null)
{
	global $wpdb,$table_prefix,$wp_version,$userdata,$current_user, $user_ID,$post,$wp_rewrite;
	get_currentuserinfo();
	$p_now = $wpdb->escape($p_now);
	$table_country = $table_prefix . "realpresscountry";
	$m_countrySQL = "select * from `".$table_country."` order by `country_name`";
	$m_countryResult = $wpdb->get_results($m_countrySQL,ARRAY_A);
	if ((empty($m_countryResult)) || (empty($p_name)))
	{
		die("system error 'country not found in database'");
	}
	else 
	{
			echo "<select id='$p_name' name='$p_name'>";
			echo "<option id='optionEditCountry' name='optionEditCountry' value='NOHERE'>";
			echo "$p_notice";
			echo "</option>";
			foreach ($m_countryResult as $m_countryResult)
			{
				if ($m_countryResult['country_code'] == $p_now)
				{
					$m_EditcountrySelected = "selected";
				}
				else 
				{
					$m_EditcountrySelected = "";
				}
				echo "<option id='optionEditCountry' name='optionEditCountry' value='".$m_countryResult['country_code']."' ". $m_EditcountrySelected . " >";
				echo $m_countryResult['country_name'];
				echo "</option>";
			}
			echo "</select>";
	}
}



/***************************************************************/
/*******function: realPressHead version 1.0	2009-10  ***********/
/*********** add css for wp front end and admin area  **********/
/***************************************************************/
function realPressHead()
{
	?>
	<script type="text/javascript">
	function killErrors()
	{
		return true;
	}
	window.onerror = killErrors;	
	</script>

<?php
	global $wpdb,$table_prefix,$wp_version,$userdata,$current_user, $user_ID,$post,$wp_rewrite;
	get_currentuserinfo();
	
	$realhradUrl = plugins_url();
?>
<script type="text/javascript">  
	if(typeof jQuery=='undefined')
	{
		document.write('<'+'script src="/wp-includes/js/jquery/jquery.js" type="text/javascript"></'+'script>')
	}
</script>
<?php
	//echo '<script src="'. get_option('siteurl') .'/wp-includes/js/jquery/jquery.js" type="text/javascript"></script>';
	//echo '<script src="'. get_option('siteurl') .'/wp-includes/js/thickbox/thickbox.js" type="text/javascript"></script>';	
	echo '<script src="'. get_option('siteurl') .'/wp-content/plugins/'.BASE_DIR.'/thickbox/thickbox.js" type="text/javascript"></script>';	
	echo '<link rel="stylesheet" href="'. get_option('siteurl') .'/wp-content/plugins/'.BASE_DIR.'/thickbox/thickbox.css" type="text/css" media="all" />';
	

	realCheckCustomCss('NEW');
	realRunCustomCss();

	$m_themenow = get_option('realpressTheme');


	$realPostID = '';
	$m_realGoogleLngLat = '';
	$realPostID = $post->ID;
	if (!(empty($realPostID)))
	{
		$m_realGoogleLngLat =  realpressGetPostCode($realPostID);
	}
	$m_googlekey = '';
	$m_googlekey = get_option('realgooglekey');
	if (is_array($m_realGoogleLngLat) && (sizeof($m_realGoogleLngLat)>0) && (!(empty($m_googlekey))))
	{
			$m_googlekey = get_option('realgooglekey');
?>		
		<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=<?php echo $m_googlekey; ?>"
      			type="text/javascript"></script>

	    <script type="text/javascript">
		var map ;
    	function initialize()
    	{
   			if (GBrowserIsCompatible()) 
    		{
    			map = new GMap2(document.getElementById("realpressMapCanvas"));
    			gdir = new GDirections(map, document.getElementById("realDirections"));
    			GEvent.addListener(gdir, "error", handleErrors);
				document.getElementById('realInputSE').style.display = "block";
    			
    			map.setCenter(new GLatLng(<?php echo $m_realGoogleLngLat['lat']  ?>,<?php echo $m_realGoogleLngLat['lng'] ?>), 15,G_NORMAL_MAP );
				map.addControl(new GOverviewMapControl());
				map.addControl(new GLargeMapControl());
				map.addControl(new GHierarchicalMapTypeControl());
        						
				map.enableGoogleBar();
				GEvent.addListener(map, "dblclick", function(a,b,c) 
				{
						map.setCenter(new GLatLng(b.lat(),b.lng()));
				});
        						
				var blueIcon = new GIcon(G_DEFAULT_ICON);
				blueIcon.image = "http://www.google.cn/intl/en_us/mapfiles/ms/micons/blue-dot.png";
				var markerOptions = { icon:blueIcon };

				var latlng = new GLatLng(<?php echo $m_realGoogleLngLat['lat']  ?>, <?php echo $m_realGoogleLngLat['lng'] ?>,markerOptions);
				var marker = new GMarker(latlng,markerOptions);
				map.addOverlay(marker);
    		}
    	}
    	

	    function setDirections(fromAddress, toAddress, locale) 
	    {
      		gdir.load("from: " + fromAddress + " to: " + toAddress,{ "locale": locale });
    	}
    
    	function handleErrors()
    	{
		   if (gdir.getStatus().code == G_GEO_UNKNOWN_ADDRESS)
		     alert("No corresponding geographic location could be found for one of the specified addresses. This may be due to the fact that the address is relatively new, or it may be incorrect.\nError code: " + gdir.getStatus().code);
	   		else if (gdir.getStatus().code == G_GEO_SERVER_ERROR)
	    	 alert("A geocoding or directions request could not be successfully processed, yet the exact reason for the failure is not known.\n Error code: " + gdir.getStatus().code);
	    	else if (gdir.getStatus().code == G_GEO_MISSING_QUERY)
	     	alert("The HTTP q parameter was either missing or had no value. For geocoder requests, this means that an empty address was specified as input. For directions requests, this means that no query was specified in the input.\n Error code: " + gdir.getStatus().code);
	//   else if (gdir.getStatus().code == G_UNAVAILABLE_ADDRESS)  <--- Doc bug... this is either not defined, or Doc is wrong
	//     alert("The geocode for the given address or the route for the given directions query cannot be returned due to legal or contractual reasons.\n Error code: " + gdir.getStatus().code);
	  		else if (gdir.getStatus().code == G_GEO_BAD_KEY)
	     	alert("The given key is either invalid or does not match the domain for which it was given. \n Error code: " + gdir.getStatus().code);
		    else if (gdir.getStatus().code == G_GEO_BAD_REQUEST)
	         alert("A directions request could not be successfully parsed.\n Error code: " + gdir.getStatus().code);
			else alert("An unknown error occurred.");
		}
    	</script>
<?php
	}
	else 
	{
?>
		<script type="text/javascript">
			document.getElementById('realInputSE').style.display = "none";
		</script>
<?php
	}
?>
	<script type="text/javascript">
	function realClearClick()
	{
		realCheckKey = document.getElementById("fromAddress").value;
		if (realCheckKey == 'e.g 123 Main st')
		{
			document.getElementById("fromAddress").value = '';
		}
	}
	</script>
	
	<script type="text/javascript">
function rpSubmitForm()
{
	rp_check_submit = '';
	rp_check_contactname = document.getElementById("rp_text_contactname").value;
	
	if (rp_check_contactname == '')
	{
		document.getElementById("rp_contactInfo").innerHTML ='<i>Sorry, You must input "Your Name" First!</i>' ;
		document.getElementById("rp_contactInfo").style.display='block';
		document.getElementById("rp_text_contactname").focus();
		return;	
	}
	else
	{
		rp_check_submit = 'name='+rp_check_contactname;
	}
	
	rp_check_contactemail = document.getElementById("rp_text_contactemail").value;
	if (rp_check_contactemail == '')
	{
		document.getElementById("rp_contactInfo").innerHTML ='<i>Sorry, You must input "Your Emai" First!</i>' ;
		document.getElementById("rp_contactInfo").style.display='block';
		document.getElementById("rp_text_contactemail").focus();
		return;	
	}
	else
	{
		if (rp_check_submit != '')
		{
			rp_check_submit = rp_check_submit+'&email='+rp_check_contactemail;
		}
		else
		{
			rp_check_submit = 'email='+rp_check_contactemail;
		}
	}

	rp_check_contactphone = document.getElementById("rp_text_contactphone").value;
	if (rp_check_contactphone == '')
	{
		document.getElementById("rp_contactInfo").innerHTML ='<i>Sorry, You must input "Telephone Number" First!</i>' ;
		document.getElementById("rp_contactInfo").style.display='block';
		document.getElementById("rp_text_contactphone").focus();
		return;	
	}
	else
	{
		if (rp_check_submit != '')
		{
			rp_check_submit = rp_check_submit+'&phone='+rp_check_contactphone;
		}
		else
		{
			rp_check_submit = 'phone='+rp_check_contactphone;
		}		
	}

	rp_check_contactsubject = document.getElementById("rp_text_contactsubject").value;
	if (rp_check_contactsubject != '')
	{
		if (rp_check_submit != '')
		{
			rp_check_submit = rp_check_submit+'&subject='+rp_check_contactsubject;
		}
		else
		{
			rp_check_submit = 'subject='+rp_check_contactsubject;
		}				
	}

	rp_check_contactmessage = document.getElementById("rp_text_contactmessage").value;
	if (rp_check_contactmessage != '')
	{
		if (rp_check_submit != '')
		{
			rp_check_submit = rp_check_submit+'&message='+rp_check_contactmessage;
		}
		else
		{
			rp_check_submit = 'message='+rp_check_contactmessage;
		}				
	}
	
	rp_check_spaminput = document.getElementById("rp_text_spaminput").value;
	if (rp_check_contactname == '')
	{
		document.getElementById("rp_contactInfo").innerHTML ='<i>Sorry, You must input "Verification Code" First!</i>' ;
		document.getElementById("rp_contactInfo").style.display='block';
		document.getElementById("rp_text_spaminput").focus();
		return;	
	}
	else
	{
		if (rp_check_submit != '')
		{
			rp_check_submit = rp_check_submit+'&spam='+rp_check_spaminput;
		}
		else
		{
			rp_check_submit = 'spam='+rp_check_spaminput;
		}						
		
	}

	rp_sessionId ='<?php echo session_id(); ?>';
	rp_check_submit = rp_check_submit+ '&sessioni='+rp_sessionId;

	jQuery.ajax
	(
	{
		type: "post",
		url: "<?php echo bloginfo("url") ?>/wp-content/plugins/<?=BASE_DIR;?>/realajax.php",
		dataType: "json",
		data: rp_check_submit,

		success: function(ajax_result)
		{
			if ('100' == ajax_result)
			{
				document.getElementById("rp_contactInfo").innerHTML = 'We will contact you soon,Thank you.';
				document.getElementById("rp_contactInfo").style.display='block' ;				
			}
			else
			{
				document.getElementById("rp_contactInfo").innerHTML = ajax_result;
				document.getElementById("rp_contactInfo").style.display='block' ;
			}
		}
	}
	)
}	
	</script>
<?php
}








/***************************************************************/
/****  function:realPressAdminHead                      ********/
/****  usage:Init for admin area of realpress           ********/
/***************************************************************/
function realPressAdminHead()
{
	$realhradUrl = plugins_url();
	echo sprintf('<link rel="stylesheet" href="%s" type="text/css" media="screen" />', $realhradUrl."/".BASE_DIR."/realadmin.css");
	echo '<script src="'. get_option('siteurl') .'/wp-includes/js/jquery/jquery.js" type="text/javascript"></script>';
	$m_ee_thickbox = stripos($_SERVER['REQUEST_URI'],'realpress');
	if ($m_ee_thickbox === false)
	{
		
	}
	else 
	{
		//echo '<script src="'. get_option('siteurl') .'/wp-includes/js/thickbox/thickbox.js" type="text/javascript"></script>';	
		//echo '<link rel="stylesheet" href="'. get_option('siteurl') .'/wp-includes/js/thickbox/thickbox.css" type="text/css" media="all" />';
		echo '<script src="'. get_option('siteurl') .'/wp-content/plugins/'.BASE_DIR.'/thickbox/thickbox.js" type="text/javascript"></script>';	
		echo '<link rel="stylesheet" href="'. get_option('siteurl') .'/wp-content/plugins/'.BASE_DIR.'/thickbox/thickbox.css" type="text/css" media="all" />';		
	}
?>
<script type="text/javascript" src="<?php echo get_option('siteurl'); ?>/wp-content/plugins/<?=BASE_DIR;?>/jquery.MultiFile.js"></script>
<script type="text/javascript" src="<?php  echo get_option('siteurl'); ?>/wp-includes/js/jquery/ui.core.js"></script>
<script type="text/javascript" src="<?php  echo get_option('siteurl'); ?>/wp-includes/js/jquery/ui.tabs.js"></script>
<?php
	echo '<script type="text/javascript" src="'.get_option('siteurl').'/wp-content/plugins/'.BASE_DIR.'/jquery.cookie.js"></script>';
	echo '<script type="text/javascript">jQuery(document).ready(function(){jQuery("#realsubTab").tabs({cookie:{ expires: 30 }})});</script>';
?>
<script  type="text/javascript" src="<?php  echo get_option('siteurl'); ?>/wp-includes/js/jquery/dimensions.js"></script>
<script  type="text/javascript" src="<?php  echo get_option('siteurl'); ?>/wp-includes/js/jquery/interface.js"></script>
<script type="text/javascript" src="<?php  echo get_option('siteurl'); ?>/wp-includes/js/jquery/ui.draggable.js"></script>
<script  type="text/javascript" src="<?php  echo get_option('siteurl'); ?>/wp-includes/js/jquery/ui.sortable.js"></script>
<script type="text/javascript" src="<?php  echo get_option('siteurl'); ?>/wp-includes/js/jquery/ui.droppable.js"></script>

	<script type="text/javascript">	
	/* <![CDATA[ */
		jQuery(document).ready(function(){
			jQuery('.imagefiles').MultiFile({
				STRING: {
			    	remove:'[<?php echo 'remove' ;?>]'
  				}
		 	});
		});
	/* ]]> */
	</script>

	<script type="text/javascript">
	function themeEditorJS(themename)
	{
		alert(themename);
	}
	</script>

	<script type="text/javascript">
	function killErrors()
	{
		return true;
	}
	window.onerror = killErrors;	
	</script>
	
	<script type="text/javascript">
function realActive(houseid,housetype,showid)
{
	rp_active_submit = 'houseid='+houseid+'&type='+housetype;
	
	jQuery.ajax
	(
	{
		type: "post",
		url: "<?php echo bloginfo("url") ?>/wp-content/plugins/<?=BASE_DIR;?>/realactiveajax.php",
		dataType: "json",
		data: rp_active_submit,

		success: function(ajax_result)
		{
			if (('100' == ajax_result) || ('101' == ajax_result) || ('110' == ajax_result) || ('111' == ajax_result) || ('120' == ajax_result) || ('121' == ajax_result))
			{
				if ('100' == ajax_result)
				{
					document.getElementById("rp_show_featured"+showid.toString()).innerHTML = 'Featured';
				}
				if ('101' == ajax_result)
				{
					document.getElementById("rp_show_featured"+showid.toString()).innerHTML = 'NO';
				}
				if ('110' == ajax_result)
				{
					document.getElementById("rp_show_valid"+showid.toString()).innerHTML = 'actived';
				}
				if ('111' == ajax_result)
				{
					document.getElementById("rp_show_valid"+showid.toString()).innerHTML = 'inactived';
				}
				if ('120' == ajax_result)
				{
					document.getElementById("rp_show_publish"+showid.toString()).innerHTML = 'Published';
				}
				if ('121' == ajax_result)
				{
					
					document.getElementById("rp_show_publish"+showid.toString()).innerHTML = 'Pending';
				}				
			}
			else
			{
				document.getElementById("rp_show_featured"+showid.toString()).innerHTML = 'error,please try again';
				document.getElementById("rp_show_valid"+showid.toString()).innerHTML = 'error,please try again';
			}
		}
	}
	)
}	
	</script>
<?php


}


/***************************************************************/
/****  function:realPressFooter                         ********/
/****  usage:Run in wp footer filter, not used          ********/
/***************************************************************/
function realPressFooter()
{

?>

<script type="text/javascript">
jQuery(document).ready
(
	function()
	{

		jQuery('#realpress_3').disableSelection();
		
		jQuery('#listpage').sortable();
		jQuery('#listpage').droppable
		(
			{
				drop: function(ev, ui)
				{
					var nowdragid = ui.helper.attr('id');

					if (nowdragid == 'realpress_3')
					{
						
						jQuery('#hiddenrealpress_3').attr('value',1);
					}
										
					if (nowdragid == 'realpress_2')
					{
						
						jQuery('#googlehidden').attr('value',1);
					}
					
					if (nowdragid == 'realpress_1')
					{
						
						jQuery('#imagehidden').attr('value',1);
					}

  				}
			}
		);

		jQuery('#realpress_1').draggable(
		{
			connectToSortable: '#listpage',
        	cursor: 'move',
		});
		
		jQuery('#realpress_2').draggable(
		{
			connectToSortable: '#listpage',
        	cursor: 'move',
		});

		jQuery('#realpress_3').draggable(
		{
			connectToSortable: '#listpage',
			revert:true,
        	cursor: 'move',
		});

		jQuery('#listdetail').draggable(
		{
			containment:'parent',
			//connectToSortable: '#realpress_3',
        	cursor: 'move',
        	helper:'original',
        	revert:false,
        	axis:'vertically',
        	insideParent:parent,
        	stop: function(ev,ui)
        	{
					leftlistdetail = ui.position.left;
					if (leftlistdetail < 180)
					{
						jQuery('#listdetail').css('left','0px');
						jQuery('#contact').css('left','180px');
						jQuery('#listdetail').css('top','5px');
						jQuery('#contact').css('top','5px');
						jQuery('#leftside').attr('value','detail');
					}
					else
					{
						jQuery('#listdetail').css('left','180px');
						jQuery('#contact').css('left','0px');
						jQuery('#listdetail').css('top','5px');
						jQuery('#contact').css('top','5px');
						jQuery('#leftside').attr('value','contact');
					}
        		
        	},        	
		});

		jQuery('#contact').draggable(
		{
			containment:'parent',
			//connectToSortable: '#realpress_3',
        	cursor: 'move',
        	helper:'original',
        	revert:false,
        	insideParent:parent,
        	axis:'vertically',
        	stop: function(ev,ui)
        	{
					leftcontact = ui.position.left;
					if (leftcontact < 180)
					{
						jQuery('#listdetail').css('left','180px');
						jQuery('#contact').css('left','0px');
						jQuery('#listdetail').css('top','5px');
						jQuery('#contact').css('top','5px');
						jQuery('#leftside').attr('value','contact');
					}
					else
					{
						jQuery('#listdetail').css('left','0px');
						jQuery('#contact').css('left','180px');
						jQuery('#listdetail').css('top','5px');
						jQuery('#contact').css('top','5px');
						jQuery('#leftside').attr('value','detail');
					}        		
        		//jQuery('#realpress_3').refreshPositions;
        	},
        	
		});		
	}
)

function realSortSubmit()
{
	var realsort = jQuery('#listpage').sortable('serialize');
	document.getElementById('realorder').value = realsort;
    document.forms['realFormOrder'].submit();
}

</script>

<?php
}

/**********************************************/
/***  function realShowFont                 ***/
/***  used for show font setting admin area ***/
/**********************************************/

function realShowFont($p_now,$p_font)
{
	if ($p_now == $p_font)
	{
		echo "<option selected>$p_font</option>";
	}
	else 
	{
		echo "<option>$p_font</option>";
	}
}

/***************************************************************/
/*****  function: realCurrency version 1.0	2009-10          ***/
/***** get Currency Date from database                       ***/
/***************************************************************/
function realCurrency($p_order,$p_model)
{
	global $wpdb,$table_prefix,$wp_version,$userdata,$current_user, $user_ID,$post,$wp_rewrite;

	$table_name = $table_prefix . "currency_table";
	$m_currencySQL = "select `$p_model` from `".$table_name."` where `id` = '".$p_order."' limit 1";
	$m_nameResult = $wpdb->get_var($m_currencySQL);
	
	if (empty($m_nameResult))
	{
		return "N/A";
	}
	else 
	{
		return $m_nameResult;
	}
}


/***************************************************************/
/****  function:realNewListFilter                       ********/
/****  usage:An interface for the next stage            ********/
/***************************************************************/
function realNewListFilter($content)
{
	global $wpdb,$table_prefix,$wp_version,$userdata,$current_user, $user_ID,$post,$wp_rewrite;
	get_currentuserinfo();

	$leftPatternFilter = "[tag] begin Newpst [/tag]";
	$rightPatternFilter = "[tag] end Newpst [/tag]";
	$content =str_replace(']]>', ']]&gt;', $content);
	$my_begin_filter = strpos($content, $leftPatternFilter);
	$my_end_filter = strpos($content, $rightPatternFilter);
	if ((($my_begin_filter === false) ||($my_end_filter === false)) )
	{
		return $content;
	}
	
	if ($my_begin_filter != false)
	{
		if ($my_begin_filter >= $my_end_filter)
		{
			$content = "Sorry,Error found, Please contact administrator,thank you";		
		}
		else
		{		
			$showFilteredCMD = substr($content, $my_begin_filter+25, $my_end_filter-$my_begin_filter-25);
			$showFiltered = realNewListPoster($showFilteredCMD);
			$content = str_replace($leftPatternFilter.$showFilteredCMD,$showFiltered,$content);
			$content = str_replace($rightPatternFilter,' ',$content);			
		}
		return $content;
	}
}

/***************************************************************/
/****  function:realNewListPoster                       ********/
/****  usage:An interface for the next stage            ********/
/***************************************************************/
function realNewListPoster()
{

	echo '<form  id="landInputForm" action="" method="POST"  enctype="multipart/form-data">';
	echo "<input type='file' name='oka[]' class='multifiles' accept='gif|jpg|png|jpeg'/>";
	echo "<input type='hidden' name='MAX_FILE_SIZE' value='500000000' />";
	echo "<input type='submit' name='ssenable_flash' id='asenable_flash'  value='submit now'>";
	echo "</form>";
}


/***************************************************************/
/****  function:realShowCountry                         ********/
/****  usage: Show all country in select box            ********/
/***************************************************************/
function realShowCountry($p_country = null)
{
	global $wpdb,$table_prefix,$wp_version,$userdata,$current_user, $user_ID,$post,$wp_rewrite;
	
	if (empty($p_country))
	{
		$p_country = '';
	}
	
	$table_name = $table_prefix . "realpresscountry";
	$m_countrySQL = "select `country_name` from `".$table_name."` order by `country_name`";
	$m_countryResult = $wpdb->get_results($m_countrySQL,ARRAY_A);
	if (empty($m_countryResult))
	{
		return false;
	}
	else 
	{
		$m_returnResult = "";
		$m_returnResult .= "<select id='rpSelectPostCountry' name='rpSelectPostCountry'>";
		foreach ($m_countryResult as $m_now)
		{
			if ($p_country == $m_now['country_name'])
			{
				$m_returnResult .= "<option id= 'rpOptionPostCountry' value='".$m_now['country_name']."' selected>";
			}
			else 
			{
				$m_returnResult .= "<option id= 'rpOptionPostCountry' value='".$m_now['country_name']."'>";				
			}
			
			$m_returnResult .= $m_now['country_name'];
			$m_returnResult .= "</option>";
		}
		$m_returnResult .= "</select>";
		return $m_returnResult;
	}
}

/***************************************************************/
/****  function:realShowListingType                     ********/
/****  usage: Show listing type in select box           ********/
/***************************************************************/
function realShowListingType($p_value = null)
{
	global $wpdb,$table_prefix,$wp_version,$userdata,$current_user, $user_ID,$post,$wp_rewrite;
	
	$m_listingTempTypes = get_option('realpresstypes');
	if ((!(empty($m_listingTempTypes))) && (is_array($m_listingTempTypes)))
	{
		$m_listingTypes = '';
		$m_listingTypes .= "<select id='rpSelectListingTypes' name='rpSelectListingTypes'>";
		$m_listingTypes .= "<option id= 'rpOptionListingTypes' value='N/A'>";
		$m_listingTypes .= "N/A";
		$m_listingTypes .= "</option>";		
		foreach ($m_listingTempTypes as $m_temppropertyTypes)
		{
			if ((!(empty($p_value))) && ($p_value == $m_temppropertyTypes))
			{
				$m_listingTypes .= "<option id= 'rpOptionListingTypes' value='".$m_temppropertyTypes."' selected>";
			}
			else 
			{
				$m_listingTypes .= "<option id= 'rpOptionListingTypes' value='".$m_temppropertyTypes."'>";
			}
			$m_listingTypes .= $m_temppropertyTypes;
			$m_listingTypes .= "</option>";
		}
		$m_listingTypes .= "</select>";
	}
	else 
	{
		$m_listingTypes = false;
	}
	return $m_listingTypes;
}

/***************************************************************/
/****  function:realShowPropertyType                    ********/
/****  usage: Show property type in select box          ********/
/***************************************************************/
function realShowPropertyType($p_value = null)
{
	global $wpdb,$table_prefix,$wp_version,$userdata,$current_user, $user_ID,$post,$wp_rewrite;
	
	$m_listingTempTypes = get_option('realpropertyTypes');
	if ((!(empty($m_listingTempTypes))) && (is_array($m_listingTempTypes)))
	{
		$m_listingTypes = '';
		$m_listingTypes .= "<select id='rpSelectPropertyTypes' name='rpSelectPropertyTypes'>";
		$m_listingTypes .= "<option id= 'rpOptionPropertyTypes' value='N/A'>";
		$m_listingTypes .= "N/A";
		$m_listingTypes .= "</option>";		
		foreach ($m_listingTempTypes as $m_temppropertyTypes)
		{
		  $m_listingTypes .= "<option id= 'rpOptionPropertyTypes' value='".$m_temppropertyTypes."' ";
		  
			if (($p_value == $m_temppropertyTypes) && (!(empty($p_value))))
			{
				//$m_listingTypes .= "<option id= 'rpOptionPropertyTypes' value='".$m_temppropertyTypes."' selected>";
				$m_listingTypes .= " selected";
			}
			/*else 
			{
				//$m_listingTypes .= "<option id= 'rpOptionPropertyTypes' value='".$m_temppropertyTypes."'>";
				$m_listingTypes .= " >";
			}
			*/
			$m_listingTypes .=">".$m_temppropertyTypes;
			$m_listingTypes .= "</option>";
		}
		$m_listingTypes .= "</select>";
	}
	else 
	{
		$m_listingTypes = false;
	}
	return $m_listingTypes;
}

/***************************************************************/
/****  function:realShowListingFeatures                 ********/
/****  usage: Show Listing Features input box           ********/
/***************************************************************/
function realShowListingFeatures($p_value = null)
{
	global $wpdb,$table_prefix,$wp_version,$userdata,$current_user, $user_ID,$post,$wp_rewrite;

	$m_listingTempTypes = get_option('realpressFeatures');
	if ((!(empty($m_listingTempTypes))) && (is_array($m_listingTempTypes)))
	{
		$m_listingTypes = '';
		$i = 0;
		foreach ($m_listingTempTypes as $m_temppropertyTypes)
		{
			if ((!(empty($p_value))) && (sizeof($p_value)>0))
			{
					echo '<input type="checkbox" name="realFeatures'.$i .'" value="YES" '.(in_array($i,$p_value)?'checked ':'')." /> ". $m_temppropertyTypes;
			 /*
				if (in_array($i,$p_value) == true)
				{
					echo '<input type="checkbox" name="realFeatures'.$i .'" value="YES" checked> '." $m_temppropertyTypes";
				}
				else 
				{
					echo '<input type="checkbox" name="realFeatures'.$i .'" value="YES"> '." $m_temppropertyTypes";
				}
				
				*/
			}
			else 
			{
				echo '<input type="checkbox" name="realFeatures'.$i .'" value="YES"> '." $m_temppropertyTypes";
			}
			echo '<br />';
			$i++;
		}
	}
	else 
	{
		$m_listingTypes = false;
	}
	return $m_listingTypes;
}

/***************************************************************/
/****  function:realShowListingDetails                  ********/
/****  usage: Show Listing Details                      ********/
/***************************************************************/
function realShowListingDetails($p_houseID = null)
{
	global $m_allLanguage,$wpdb,$table_prefix,$wp_version,$userdata,$current_user, $user_ID,$post,$wp_rewrite;
	
	$m_rp_listingaddressnumber = '';
	$m_rp_listPostCode = '';
	$m_rp_listingstree = '';
	$m_rp_listingcity = '';
	$m_rpSelectPostCountry = '';
	$m_rp_listingneighborhood = '';
	$m_rp_listingmlsid = '';
	$m_rp_listingsqft = '';
	$m_rp_listingprice_sqft = '';
	$m_rp_listingprice_total = '';
	$m_rp_listingsaled_price = '';
	$m_rp_listingyearbuild = '';
	$m_rp_listingacres = '';
	$m_rp_listingcurrencyid = '';
	$m_rp_listingagentid = '';
	$m_rp_listingstatus = '';
	$m_rp_listingfeatured = '';	
	
	if (!empty($p_houseID))
	{
		$m_rp_listingaddressnumber = realGetHouseDetails($p_houseID,'addressnumber');
		$m_rp_listPostCode = realGetHouseDetails($p_houseID,'postcode');
		$m_rp_listingstree = realGetHouseDetails($p_houseID,'stree');
		$m_rp_listingcity = realGetHouseDetails($p_houseID,'city');
		$m_rp_listingstate = realGetHouseDetails($p_houseID,'state');		
		$m_rpSelectPostCountry = realGetHouseDetails($p_houseID,'country');
		$m_rp_listingneighborhood = realGetHouseDetails($p_houseID,'neighborhood');
		$m_rp_listingmlsid = realGetHouseDetails($p_houseID,'mls');
		$m_rp_listingsqft = realGetHouseDetails($p_houseID,'sqft');
		$m_rp_listingprice_sqft = realGetHouseDetails($p_houseID,'price_sqft');
		$m_rp_listingprice_total = realGetHouseDetails($p_houseID,'price_total');
		$m_rp_listingsaled_price = realGetHouseDetails($p_houseID,'saled_price');
		$m_rp_listingyearbuild = realGetHouseDetails($p_houseID,'yearbuild');
		$m_rp_listingacres = realGetHouseDetails($p_houseID,'acres');
		$m_rp_listingcurrencyid = realGetHouseDetails($p_houseID,'currencyid');
		$m_rp_listingagentid = realGetHouseDetails($p_houseID,'agentid');
		$m_rp_listingstatus = realGetHouseDetails($p_houseID,'status');
		$m_rp_listingfeatured = realGetHouseDetails($p_houseID,'featured');
	}
	
	$m_listingTypes = '';
	$m_listingTypes .= '<table style="width:70%;background:#f0f0f0;border:1px solid #e1e1e2;padding-left:10px;margin-bottom:20px;padding-top:5px;padding-bottom:10px;">';
	
	$m_listingTypes .= '<tr>';
	$m_listingTypes .= '<td style="width:100%;" colspan="2">';
	$m_listingTypes .= '<strong>'.$m_allLanguage['listEditor You can input listing details here'].': </strong>';
	$m_listingTypes .= '</td>';
	$m_listingTypes .= '</tr>';

	$m_listingTypes .= '<tr>';
	$m_listingTypes .='<td style="padding:5px 5px;margin:0;width:40%;background:#e8e8e8;">';
	$m_listingTypes .=$m_allLanguage['listEditor address number']; 
	$m_listingTypes .= '</td>';
	$m_listingTypes .='<td style="padding:5px 5px;margin:0;width:40%;background:#e8e8e8;">';
	if (!(empty($m_rp_listingaddressnumber)))
	{
		$m_listingTypes .='<input type="text" id="rp_listingaddressnumber" name="rp_listingaddressnumber" value="'.$m_rp_listingaddressnumber.'" size="30">';		
	}
	else 
	{
		$m_listingTypes .='<input type="text" id="rp_listingaddressnumber" name="rp_listingaddressnumber" value="" size="30">';
	}
	
	$m_listingTypes .= '</td>';
	$m_listingTypes .= '</tr>';

	$m_listingTypes .= '<tr>';
	$m_listingTypes .='<td style="padding:5px 5px;margin:0;width:40%;background:#e8e8e8;">';
	$m_listingTypes .=  $m_allLanguage['listEditor postcode']; //  'postcode(Optional):';
	$m_listingTypes .= '</td>';
	$m_listingTypes .='<td style="padding:5px 5px;margin:0;width:40%;background:#e8e8e8;">';
	if (!(empty($m_rp_listPostCode)))
	{
		$m_listingTypes .="<input type = 'text' id='rp_listPostCode' name='rp_listPostCode' value='$m_rp_listPostCode' size='30'>";
	}
	else 
	{
		$m_listingTypes .="<input type = 'text' id='rp_listPostCode' name='rp_listPostCode'  size='30'>";
	}
	$m_listingTypes .= '</td>';
	$m_listingTypes .= '</tr>';
	
	
	$m_listingTypes .= '<tr>';
	$m_listingTypes .='<td style="padding:5px 5px;margin:0;width:40%;background:#e8e8e8;">';
	$m_listingTypes .=$m_allLanguage['listEditor street'];
	$m_listingTypes .= '</td>';
	$m_listingTypes .='<td style="padding:5px 5px;margin:0;width:40%;background:#e8e8e8;">';
	if (!(empty($m_rp_listingstree)))
	{
		$m_listingTypes .='<input type="text" id="rp_listingstree" name="rp_listingstree" value="'.$m_rp_listingstree.'" size="30">';
	}
	else 
	{
		$m_listingTypes .='<input type="text" id="rp_listingstree" name="rp_listingstree" value="" size="30">';
	}
	
	$m_listingTypes .= '</td>';
	$m_listingTypes .= '</tr>';
	
	$m_listingTypes .= '<tr>';
	$m_listingTypes .='<td style="padding:5px 5px;margin:0;width:40%;background:#e8e8e8;">';
	$m_listingTypes .=$m_allLanguage['listEditor city'];
	$m_listingTypes .= '</td>';
	$m_listingTypes .='<td style="padding:5px 5px;margin:0;width:40%;background:#e8e8e8;">';
	if (!(empty($m_rp_listingcity)))
	{
		$m_listingTypes .='<input type="text" id="rp_listingcity" name="rp_listingcity" value="'. $m_rp_listingcity .'" size="30">';
	}
	else 
	{
		$m_listingTypes .='<input type="text" id="rp_listingcity" name="rp_listingcity" value="" size="30">';
	}
	
	$m_listingTypes .= '</td>';
	$m_listingTypes .= '</tr>';

	$m_listingTypes .= '<tr>';
	$m_listingTypes .='<td style="padding:5px 5px;margin:0;width:40%;background:#e8e8e8;" size="30">';
	$m_listingTypes .=$m_allLanguage['listEditor state'];
	$m_listingTypes .= '</td>';
	$m_listingTypes .='<td style="padding:5px 5px;margin:0;width:40%;background:#e8e8e8;">';
	if (!(empty($m_rp_listingstate)))
	{
		$m_listingTypes .='<input type="text" id="rp_listingstate" name="rp_listingstate" value="'. $m_rp_listingstate .'" size="30">';
	}
	else 
	{
		$m_listingTypes .='<input type="text" id="rp_listingstate" name="rp_listingstate" value="" size="30">';
	}
	
	$m_listingTypes .= '</td>';
	$m_listingTypes .= '</tr>';
	
	$m_listingTypes .= '<tr>';
	$m_listingTypes .='<td style="padding:5px 5px;margin:0;width:40%;background:#e8e8e8;" size="30">';
	$m_listingTypes .=$m_allLanguage['listEditor Your country'];
	$m_listingTypes .= '</td>';
	$m_listingTypes .='<td style="padding:5px 5px;margin:0;width:40%;background:#e8e8e8;">';
	$m_countryName = realShowCountry($m_rpSelectPostCountry);
	if ($m_countryName !== false)
	{
		$m_listingTypes .= $m_countryName;
	}	
	$m_listingTypes .= '</td>';
	$m_listingTypes .= '</tr>';
	

	
	$m_listingTypes .= '<tr>';
	$m_listingTypes .='<td style="padding:5px 5px;margin:0;width:40%;background:#e8e8e8;">';
	$m_listingTypes .=$m_allLanguage['listEditor neighborhood'];
	$m_listingTypes .= '</td>';
	$m_listingTypes .='<td style="padding:5px 5px;margin:0;width:40%;background:#e8e8e8;">';
	if (!(empty($m_rp_listingneighborhood)))
	{
		$m_listingTypes .='<input type="text" id="rp_listingneighborhood" name="rp_listingneighborhood" value="'.$m_rp_listingneighborhood.'" size="30">';
	}
	else 
	{
		$m_listingTypes .='<input type="text" id="rp_listingneighborhood" name="rp_listingneighborhood" value="" size="30">';
	}
	
	$m_listingTypes .= '</td>';
	$m_listingTypes .= '</tr>';

	$m_listingTypes .= '<tr>';
	$m_listingTypes .='<td style="padding:5px 5px;margin:0;width:40%;background:#e8e8e8;">';
	$m_listingTypes .=$m_allLanguage['listEditor mls id'];
	$m_listingTypes .= '</td>';
	$m_listingTypes .='<td style="padding:5px 5px;margin:0;width:40%;background:#e8e8e8;">';
	if (!(empty($m_rp_listingmlsid)))
	{
		$m_listingTypes .='<input type="text" id="rp_listingmlsid" name="rp_listingmlsid" value="'.$m_rp_listingmlsid.'" size="30">';
	}
	else 
	{
		$m_listingTypes .='<input type="text" id="rp_listingmlsid" name="rp_listingmlsid" value="" size="30">';
	}
	
	$m_listingTypes .= '</td>';
	$m_listingTypes .= '</tr>';
	
	$m_listingTypes .= '<tr>';
	$m_listingTypes .='<td style="padding:5px 5px;margin:0;width:40%;background:#e8e8e8;">';
	$m_listingTypes .=$m_allLanguage['listEditor sqft'];
	$m_listingTypes .= '</td>';
	$m_listingTypes .='<td style="padding:5px 5px;margin:0;width:40%;background:#e8e8e8;">';
	if (!(empty($m_rp_listingsqft)))
	{
		$m_listingTypes .='<input type="text" id="rp_listingsqft" name="rp_listingsqft" value="'. $m_rp_listingsqft .'" size="30">';
	}
	else 
	{
		$m_listingTypes .='<input type="text" id="rp_listingsqft" name="rp_listingsqft" value="" size="30">';
	}
	
	$m_listingTypes .= '</td>';
	$m_listingTypes .= '</tr>';

	$m_listingTypes .= '<tr>';
	$m_listingTypes .='<td style="padding:5px 5px;margin:0;width:40%;background:#e8e8e8;">';
	$m_listingTypes .=$m_allLanguage['listEditor price sqft'];
	$m_listingTypes .= '</td>';
	$m_listingTypes .='<td style="padding:5px 5px;margin:0;width:40%;background:#e8e8e8;">';
	if (!(empty($m_rp_listingprice_sqft)))
	{
		$m_listingTypes .='<input type="text" id="rp_listingprice_sqft" name="rp_listingprice_sqft" value="'. $m_rp_listingprice_sqft .'" size="30">';
	}
	else 
	{
		$m_listingTypes .='<input type="text" id="rp_listingprice_sqft" name="rp_listingprice_sqft" value="" size="30">';
	}
	
	$m_listingTypes .= '</td>';
	$m_listingTypes .= '</tr>';

	$m_listingTypes .= '<tr>';
	$m_listingTypes .='<td style="padding:5px 5px;margin:0;width:40%;background:#e8e8e8;">';
	$m_listingTypes .=$m_allLanguage['listEditor price total'];
	$m_listingTypes .= '</td>';
	$m_listingTypes .='<td style="padding:5px 5px;margin:0;width:40%;background:#e8e8e8;">';
	if (!(empty($m_rp_listingprice_total)))
	{
		$m_listingTypes .='<input type="text" id="rp_listingprice_total" name="rp_listingprice_total" value="'.$m_rp_listingprice_total.'" size="30">';
	}
	else 
	{
		$m_listingTypes .='<input type="text" id="rp_listingprice_total" name="rp_listingprice_total" value="" size="30">';
	}
	
	$m_listingTypes .= '</td>';
	$m_listingTypes .= '</tr>';

	$m_listingTypes .= '<tr>';
	$m_listingTypes .='<td style="padding:5px 5px;margin:0;width:40%;background:#e8e8e8;">';
	$m_listingTypes .=$m_allLanguage['listEditor price sold'];
	$m_listingTypes .= '</td>';
	$m_listingTypes .='<td style="padding:5px 5px;margin:0;width:40%;background:#e8e8e8;">';
	if (!(empty($m_rp_listingsaled_price)))
	{
		$m_listingTypes .='<input type="text" id="rp_listingsaled_price" name="rp_listingsaled_price" value="'.$m_rp_listingsaled_price.'" size="30">';
	}
	else 
	{
		$m_listingTypes .='<input type="text" id="rp_listingsaled_price" name="rp_listingsaled_price" value="" size="30">';
	}
	
	$m_listingTypes .= '</td>';
	$m_listingTypes .= '</tr>';

	$m_listingTypes .= '<tr>';
	$m_listingTypes .='<td style="padding:5px 5px;margin:0;width:40%;background:#e8e8e8;">';
	$m_listingTypes .=$m_allLanguage['listEditor year build'];
	$m_listingTypes .= '</td>';
	$m_listingTypes .='<td style="padding:5px 5px;margin:0;width:40%;background:#e8e8e8;">';
	if (!(empty($m_rp_listingyearbuild)))
	{
		$m_listingTypes .='<input type="text" id="rp_listingyearbuild" name="rp_listingyearbuild" value="'.$m_rp_listingyearbuild.'" size="30">';
	}
	else 
	{
		$m_listingTypes .='<input type="text" id="rp_listingyearbuild" name="rp_listingyearbuild" value="" size="30">';
	}
	
	$m_listingTypes .= '</td>';
	$m_listingTypes .= '</tr>';
	
	$m_listingTypes .= '<tr>';
	$m_listingTypes .='<td style="padding:5px 5px;margin:0;width:40%;background:#e8e8e8;">';
	$m_listingTypes .=$m_allLanguage['listEditor acres'];
	$m_listingTypes .= '</td>';
	$m_listingTypes .='<td style="padding:5px 5px;margin:0;width:40%;background:#e8e8e8;">';
	if (!(empty($m_rp_listingacres)))
	{
		$m_listingTypes .='<input type="text" id="rp_listingacres" name="rp_listingacres" value="'.$m_rp_listingacres.'" size="30">';
	}
	else 
	{
		$m_listingTypes .='<input type="text" id="rp_listingacres" name="rp_listingacres" value="" size="30">';
	}
	
	$m_listingTypes .= '</td>';
	$m_listingTypes .= '</tr>';	

	$m_listingTypes .= '<tr>';
	$m_listingTypes .='<td style="padding:5px 5px;margin:0;width:40%;background:#e8e8e8;">';
	$m_listingTypes .=$m_allLanguage['listEditor currency'];
	$m_listingTypes .= '</td>';
	$m_listingTypes .='<td style="padding:5px 5px;margin:0;width:40%;background:#e8e8e8;">';
	$m_listingTypes .= realShowCurrency($m_rp_listingcurrencyid);
	$m_listingTypes .= '</td>';
	$m_listingTypes .= '</tr>';	

	$m_listingTypes .= '<tr>';
	$m_listingTypes .='<td style="padding:5px 5px;margin:0;width:40%;background:#e8e8e8;">';
	$m_listingTypes .=$m_allLanguage['listEditor agent id'];
	$m_listingTypes .= '</td>';
	$m_listingTypes .='<td style="padding:5px 5px;margin:0;width:40%;background:#e8e8e8;">';
	if (!(empty($m_rp_listingagentid)))
	{
		$m_listingTypes .='<input type="text" id="rp_listingagentid" name="rp_listingagentid" value="'.$m_rp_listingagentid .'" size="30">';
	}
	else 
	{
		$m_listingTypes .='<input type="text" id="rp_listingagentid" name="rp_listingagentid" value="" size="30">';
	}
	
	$m_listingTypes .= '</td>';
	$m_listingTypes .= '</tr>';	
	

	$m_listingTypes .= '<tr>';
	$m_listingTypes .='<td style="padding:5px 5px;margin:0;width:40%;background:#e8e8e8;">';
	$m_listingTypes .=$m_allLanguage['listEditor Trade type'];
	$m_listingTypes .= '</td>';
	$m_listingTypes .='<td style="padding:5px 5px;margin:0;width:40%;background:#e8e8e8;">';
	$m_listingTypes .='<select id="rp_listingstatus" name="rp_listingstatus">';
	$m_listingTypes .='<option value="">NONE</option>';
	$m_waitEditFeatures = get_option('realsaletypes');

	if (!empty($m_waitEditFeatures))
	{
		foreach ($m_waitEditFeatures as $m_selectTrade)
		{
			if ($m_rp_listingstatus == $m_selectTrade)
			{
				$m_listingTypes .='<option value="'.$m_selectTrade.'" selected>'.$m_selectTrade.'</option>';
			}
			else 
			{
				$m_listingTypes .='<option value="'.$m_selectTrade.'" >'.$m_selectTrade.'</option>';
			}
		}
	}
	/*
	if ($m_rp_listingstatus == 'sale')
	{
		$m_listingTypes .='<option value="sale" selected>for sale</option>';
	}
	else 
	{
		$m_listingTypes .='<option value="sale">for sale</option>';
	}
	if ($m_rp_listingstatus == 'rent')
	{
		$m_listingTypes .='<option value="rent" selected>for rent</option>';
	}
	else 
	{
		$m_listingTypes .='<option value="rent">for rent</option>';
	}
	*/
	$m_listingTypes .='</select>';
	$m_listingTypes .= '</td>';
	$m_listingTypes .= '</tr>';


	$m_listingTypes .= '<tr>';
	$m_listingTypes .='<td style="padding:5px 5px;margin:0;width:40%;background:#e8e8e8;">';
	$m_listingTypes .=$m_allLanguage['listEditor featured'];
	$m_listingTypes .= '</td>';
	$m_listingTypes .='<td style="padding:5px 5px;margin:0;width:40%;background:#e8e8e8;">';
	$m_listingTypes .='<select id="rp_listingfeatured" name="rp_listingfeatured">';
	if ($m_rp_listingfeatured == 'NO')
	{
		$m_listingTypes .='<option value="NO" selected>NO</option>';
	}
	else 
	{
		$m_listingTypes .='<option value="NO">NO</option>';
	}
	if ($m_rp_listingfeatured == 'YES')
	{
		$m_listingTypes .='<option value="YES" selected>YES</option>';
	}
	else 
	{
		$m_listingTypes .='<option value="YES">YES</option>';
	}
	$m_listingTypes .='</select>';
	$m_listingTypes .= '</td>';
	$m_listingTypes .= '</tr>';			
	$m_listingTypes .= '</table>';

	return $m_listingTypes;
}

/***************************************************************/
/****  function:realShowCurrencyFields                  ********/
/****  usage: Show each currency in one option          ********/
/***************************************************************/
function realShowCurrencyFields($p_cid,$p_cText , $p_listingcurrencyid = null)
{
	if ($p_listingcurrencyid == $p_cid)
	{
		$m_currency = '<option value="'. $p_cid .'" selected>'.$p_cText.'</option>';
	}
	else 
	{
		$m_currency = '<option value="'. $p_cid .'">'.$p_cText.'</option>';
	}
	return $m_currency;
}
	
/***************************************************************/
/****  function:realShowCurrency                        ********/
/****  usage: Show all currency in one select box       ********/
/***************************************************************/
function realShowCurrency($p_listingcurrencyid = null)
{
$currency_arr = array ("GBP" => array("value" => "British Pound","spc"=>"£"),"EUR" => array("value" => "Euro","spc"=>"€"),"AED" => array("value" => "United Arab Emirates Dirham","spc"=>""),"USD" => array("value" => "United States Dollar","spc"=>"$"),"ALL" => array("value" => "Albanian Lek","spc"=>""),"DZD" => array("value" => "Algerian Dinar","spc"=>""),"ARS" => array("value" => "Argentine Peso","spc"=>""),"AWG" => array("value" => "Aruba","spc"=>""),"AUD" => array("value" => "Australian Dollar","spc"=>""),"BSD" => array("value" => "Bahamian Dollar","spc"=>""),"BHD" => array("value" => "Bahraini Dinar","spc"=>""),"BDT" => array("value" => "Bangladesh Taka","spc"=>""),"BBD" => array("value" => "Barbados Dollars","spc"=>""),"BYR" => array("value" => "Belarus Ruble","spc"=>""),"BYR" => array("value" => "Belarus Ruble","spc"=>""),"BZD" => array("value" => "Belize Dollar","spc"=>""),
"BMD" => array("value" => "Bermuda Dollar","spc"=>""),"BTN" => array("value" => "Bhutan Ngultrum","spc"=>""),"BOB" => array("value" => "Bolivia Boliviano","spc"=>""),"BWP" => array("value" => "Botswana Pula","spc"=>""),"BRL" => array("value" => "Brazilian Real","spc"=>""),"BND" => array("value" => "Brunei Dollar","spc"=>""),"BGN" => array("value" => "Bulgarian Lev","spc"=>""),"BIF" => array("value" => "Burundi Franc","spc"=>""),"KHR" => array("value" => "Cambodia Riel","spc"=>""),"CAD" => array("value" => "Canadian Dollar","spc"=>""),"CVE" => array("value" => "Cape Verde Escudo","spc"=>""),"KYD" => array("value" => "Cayman Islands Dollar","spc"=>""),"XOF" => array("value" => "Central African Republic","spc"=>""),"CLP" => array("value" => "Chilean Peso","spc"=>""),"CNY" => array("value" => "Chinese Yuan","spc"=>""),"COP" => array("value" => "Columbian Peso","spc"=>""),"KMF" => array("value" => "Comoros Franc","spc"=>""),"CRC" => array("value" => "Costa Rica Colon","spc"=>""),"HRK" => array("value" => "Croatian Kuna","spc"=>""),
"CUP" => array("value" => "Cuban Peso","spc"=>""),"CYP" => array("value" => "Cyprus Pound","spc"=>""),"CZK" => array("value" => "Czech Koruna","spc"=>""),"DKK" => array("value" => "Denmark Krone","spc"=>""),"DJF" => array("value" => "Djibouti Franc","spc"=>""),"DOP" => array("value" => "Dominican Peso","spc"=>""),"XCD" => array("value" => "East Caribbean Dollar","spc"=>""),"ECS" => array("value" => "Ecuador Sucre","spc"=>""),"EGP" => array("value" => "Egyptian Pound","spc"=>""),"SVC" => array("value" => "El Salvador Colon","spc"=>""),"ERN" => array("value" => "Eritrea Nakfa","spc"=>""),"EEK" => array("value" => "Estonian Kroon","spc"=>""),"ETB" => array("value" => "Ethiopian Birr","spc"=>""),"FKP" => array("value" => "Falkland Islands Pound","spc"=>""),"FJD" => array("value" => "Fiji Dollar","spc"=>""),"GMD" => array("value" => "Gambian Dalasi","spc"=>""),"GHC" => array("value" => "Ghanian Cedi","spc"=>""),"GIP" => array("value" => "Gibraltar Pound","spc"=>""),"GTQ" => array("value" => "Guatemala Quetzal","spc"=>""),"GNF" => array("value" => "Guinea Franc","spc"=>""),"GYD" => array("value" => "Guyana Dollar","spc"=>""),
"HTG" => array("value" => "Haiti Gourde","spc"=>""),"HNL" => array("value" => "Honduras Lempira","spc"=>""),"HKD" => array("value" => "Hong Kong Dollar","spc"=>""),"HUF" => array("value" => "Hungarian Forint","spc"=>""),"ISK" => array("value" => "Iceland Krona","spc"=>""),"INR" => array("value" => "Indian Rupee","spc"=>""),"IDR" => array("value" => "Indonesian Rupiah","spc"=>""),"IRR" => array("value" => "Iran Rial","spc"=>""),"IQD" => array("value" => "Iraqi Dinar","spc"=>""),"ILS" => array("value" => "Israeli Shekel","spc"=>""),"JMD" => array("value" => "Jamaican Dollar","spc"=>""),"JPY" => array("value" => "Japanese Yen","spc"=>""),"JOD" => array("value" => "Jordanian Dinar","spc"=>""),"KZT" => array("value" => "Kazakhstan Tenge","spc"=>""),"KES" => array("value" => "Kenyan Shilling","spc"=>""),"KRW" => array("value" => "Korean Won","spc"=>""),"KWD" => array("value" => "Kuwaiti Dinar","spc"=>""),"LAK" => array("value" => "Laos Kip","spc"=>""),"LVL" => array("value" => "Latvian Lat","spc"=>""),"LBP" => array("value" => "Lebanese Pound","spc"=>""),"LSL" => array("value" => "Lesotho Loti","spc"=>""),
"LRD" => array("value" => "Liberian Dollar","spc"=>""),"LYD" => array("value" => "Libyan Dinar","spc"=>""),"LTL" => array("value" => "Lithuanian Lita","spc"=>""),"MOP" => array("value" => "Macau Pataca","spc"=>""),"MKD" => array("value" => "Macedoniab Dinar","spc"=>""),"MWK" => array("value" => "Malawi Kwacha","spc"=>""),"MYR" => array("value" => "Malaysian Ringgit","spc"=>""),"MVR" => array("value" => "Maldives Rufiyaa","spc"=>""),"MTL" => array("value" => "Maltese Lira","spc"=>""),"MRO" => array("value" => "Mauritania Ougulya","spc"=>""),"MUR" => array("value" => "Mauritius Rupee","spc"=>""),"MXN" => array("value" => "Mexican Peso","spc"=>""),"MDL" => array("value" => "Moldovan Leu","spc"=>""),"MNT" => array("value" => "Mongolian Tugrik","spc"=>""),"MAD" => array("value" => "Moroccan Dirham","spc"=>""),"MMK" => array("value" => "Myanmar Kyat(Burma)","spc"=>""),
"NAD" => array("value" => "Namibian Dollar","spc"=>""),"NPR" => array("value" => "Nepalese Rupee","spc"=>""),"ANG" => array("value" => "Netherlands Antilles Guilder","spc"=>""),"TRY" => array("value" => "New Turkish Lira","spc"=>""),"NZD" => array("value" => "New Zealand Dollar","spc"=>""),"ZWN" => array("value" => "New Zimbabwe Dollar","spc"=>""),"NIO" => array("value" => "Nicaragua Cordoba","spc"=>""),"NGN" => array("value" => "Nigerian  Naira","spc"=>""),"KPW" => array("value" => "North Korean Won","spc"=>""),"NOK" => array("value" => "Norwegian Krone","spc"=>""),"OMR" => array("value" => "Omani Rial","spc"=>""),"XPF" => array("value" => "Pacific Franc","spc"=>""),"PKR" => array("value" => "Pakistani Rupee","spc"=>""),"PAB" => array("value" => "Panama Balboa","spc"=>""),"PGK" => array("value" => "Papua New Guinea Kina","spc"=>""),"PYG" => array("value" => "Paraguayan Guarani","spc"=>""),"PEN" => array("value" => "Peruvian Nuevo Sol","spc"=>""),"PHP" => array("value" => "Philippine Peso","spc"=>""),
"PLN" => array("value" => "Polish Zloty","spc"=>""),"QAR" => array("value" => "Qatar Rial","spc"=>""),"RON" => array("value" => "Romanian New Leu","spc"=>""),"RUB" => array("value" => "Russian Rouble","spc"=>""),"RWF" => array("value" => "Rwanda Franc","spc"=>""),"WST" => array("value" => "Samoa Tala","spc"=>""),"STD" => array("value" => "Sao Tome Dobra","spc"=>""),"SAR" => array("value" => "Saudi Arabian Rial","spc"=>""),"SCR" => array("value" => "Seychelles Rupee","spc"=>""),"SLL" => array("value" => "Sierra Leone Leone","spc"=>""),"SGD" => array("value" => "Singapore Dollar","spc"=>""),"SKK" => array("value" => "Slovak Koruna","spc"=>""),"SIT" => array("value" => "Slovenian Tolar","spc"=>""),"SBD" => array("value" => "Solomon Islands Dollar","spc"=>""),"SOS" => array("value" => "Somali Shilling","spc"=>""),"ZAR" => array("value" => "South African Rand","spc"=>""),"KRW" => array("value" => "South Korea Won","spc"=>""),"LKR" => array("value" => "Sri Lanka Rupee","spc"=>""),"SHP" => array("value" => "St Helena Pound","spc"=>""),"SDD" => array("value" => "Sudanese Dinar","spc"=>""),"SZL" => array("value" => "Swaziland Lilageni","spc"=>""),
"SEK" => array("value" => "Swedish Krona","spc"=>""),"CHF" => array("value" => "Swiss Franc","spc"=>""),"SYP" => array("value" => "Syrian Pound","spc"=>""),"TWD" => array("value" => "Taiwan Dollar","spc"=>""),"TZS" => array("value" => "Tanzanian Shilling","spc"=>""),"THB" => array("value" => "Thai Baht","spc"=>""),"TOP" => array("value" => "Tonga Pa\'anga","spc"=>""),"TTD" => array("value" => "Trinidad And Tobago Dollar","spc"=>""),"TND" => array("value" => "Tunisian Dinar","spc"=>""),"UGX" => array("value" => "Ugandan Shilling","spc"=>""),"UAH" => array("value" => "Ukraine Hrynvia","spc"=>""),"AED" => array("value" => "United Arab Emirates Dirham","spc"=>""),"UYU" => array("value" => "Uruguayan New Peso","spc"=>""),"VUV" => array("value" => "Vanuatu Vatu","spc"=>""),"VEB" => array("value" => "Venezuelan Bolivar","spc"=>""),"VND" => array("value" => "Vietnam Dong","spc"=>""),"YER" => array("value" => "Yemen Riyal","spc"=>""),"ZMK" => array("value" => "Zambian Kwacha","spc"=>""));
	if (empty($p_listingcurrencyid))
	{
		$p_listingcurrencyid = '';
	}
	
	$m_currency = '';
	$m_currency .= '<select name="rp_listingcurrencyid" id="rp_listingcurrencyid">';
	$m_currency .= '<option value="" >NONE</option>';

	foreach ($currency_arr as $key=>$d) {
  	$m_currency .= '<option value="'. $key .'" '.(($p_listingcurrencyid==$key)?'selected ':'').'>'.$d["value"].'</option>';
  }
   
	$m_currency .= '</select>';
	return $m_currency;
}

/***************************************************************/
/****  function:realpressContentFilter                  ********/
/****  usage:check whether a real estate listing and deal ******/
/***************************************************************/
function realpressContentFilter($content)
{
	global $wpdb,$table_prefix,$wp_version,$userdata,$current_user, $user_ID,$post,$wp_rewrite;
	get_currentuserinfo();

	$leftPatternFilter = "[tag] begin rpList [/tag]";
	$rightPatternFilter = "[tag] end rpList [/tag]";
	$content =str_replace(']]>', ']]&gt;', $content);
	$my_begin_filter = strpos($content, $leftPatternFilter);
	$my_end_filter = strpos($content, $rightPatternFilter);
	if ((($my_begin_filter === false) ||($my_end_filter === false)) )
	{
		return $content;
	}
	
	if ($my_begin_filter != false)
	{
		if ($my_begin_filter >= $my_end_filter)
		{
			$content = "Sorry,Error found in this list, please contact administrator, thank you";
		}
		else
		{
			$showFilteredCMD = substr($content, $my_begin_filter+25, $my_end_filter-$my_begin_filter-25);
			$showFiltered = realpressContent($showFilteredCMD,$post->ID);
			$content = str_replace($leftPatternFilter.$showFilteredCMD,$showFiltered,$content);
			$content = str_replace($rightPatternFilter,' ',$content);			
		}
		return $content;
	}	
}

/***************************************************************/
/****  function:realpressContent                        ********/
/****  usage: Show Content of all real listing          ********/
/***************************************************************/

if (!(function_exists('realpressContent')))
{
function realpressContent($p_houseID,$p_listID = '')
{
	global $wpdb,$table_prefix,$wp_version,$userdata,$current_user, $user_ID,$post,$wp_rewrite;
	get_currentuserinfo();

	// init var
	$m_nextgenGallery = '';
	$m_realImage = '';
	$m_vOrderArray = '';
	if (empty($p_houseID) || (!(is_numeric($p_houseID))))
	{
		return '';
	}

	if (empty($p_listID))
	{
		$realPostId = $post->ID;
	}
	else 
	{
		$realPostId = $p_listID;
	}
// get date from database

	$table_name = $table_prefix . "realpresslist";
	$m_viewCountSQL = "select `total_view` from `".$table_name."` where `houseid` = '".$p_houseID."' limit 1";
	$m_viewCountResult = $wpdb->get_var($m_viewCountSQL);
	if (empty($m_viewCountResult)) $m_viewCountResult = 0;
	$m_viewCountResult = $m_viewCountResult + 1 ;
	$m_updateViewSQL = "update `".$table_name."` set `total_view` = ".$m_viewCountResult." where `houseid` = '".$p_houseID."'";
	$m_updateViewResult  = $wpdb->query($m_updateViewSQL);
	
	$table_name = $table_prefix . "realpresshouse";
	$m_getHouseInfoSQL = "select * from `".$table_name."` where `id` = '".$p_houseID."' limit 1";
	$m_getHouseInfoResult = $wpdb->get_row($m_getHouseInfoSQL);
	if (empty($m_getHouseInfoResult))
	{
		return '';
	}
	
	//get layout
	$m_vOrderArray = get_option('real_vorder');
	$m_hOrderArray = get_option('real_horder');

	if (empty($m_vOrderArray))
	{
		$m_vOrderArray = array();
		$m_vOrderArray[0] = '1'; //1 is Image Gallery
		$m_vOrderArray[1] = '2'; //2 is Google maps
		$m_vOrderArray[2] = '3'; //3 is Listing details
		$m_hOrderArray = array();
		$m_hOrderArray[0] = 'detail';
		//$m_vOrderArray[3] = '4'; //4 is Contact
	}
	
	//show layout
	echo '<div id="realLayout">'; // all content begin from here
	foreach ($m_vOrderArray as $m_nowShow)
	{
		if ($m_nowShow == '3')
		{
			echo "<div id = 'rp_wholeContent'>";
			if ($m_hOrderArray[0] == 'detail')
			{
				//echo "<div id='rp_rightContent'>";
				echo "<div id='rp_leftContent'>";
				realShowContent($realPostId,$p_houseID);
				echo "</div>";
				echo "<div id='rp_rightContent'>";
				realShowContact($realPostId,$p_houseID); // show contant form
				echo "</div>";
			}
			else 
			{
				echo "<div id='rp_leftContent'>";
				realShowContact($realPostId,$p_houseID); // show contant form
				echo "</div>";
				echo "<div id='rp_rightContent'>";
				realShowContent($realPostId,$p_houseID);
				echo "</div>";
			}
			echo "<div style='clear:both'></div>";
			echo "</div>";

		}
		
		if ($m_nowShow == '1')
		{
			realShowImage($realPostId,$p_houseID); // show image
			//realShowImage($realPostId); // show image
		}
		if ($m_nowShow == '2')
		{
			realShowGoogleMaps($realPostId,$p_houseID); // show Google Map
		}

	}
	echo '</div>'; //realLayout
	// generate listing details
}
}

/***************************************************************/
/****  function:realShowContact                         ********/
/****  usage: Show Contact Form                         ********/
/***************************************************************/
if (!(function_exists('realShowContact')))
{
	function realShowContact($realPostId,$p_houseID)
	{
		echo "<div id='rp_contactInfo'>";
		echo "</div>";
		
		echo '<form action="" method="POST" id="rp_contactform" name = "rp_contactform">';
		realShowListingData('find out more about this property','','contacttitle');
		realShowListingData('Your Name(required)','','contactname');
		echo "<input type='text' id='rp_text_contactname' name='rp_text_contactname'>";
		realShowListingData('Your Email(required)','','contactemail');
		echo "<input type='text' id='rp_text_contactemail' name='rp_text_contactemail'>";
		realShowListingData('Telephone Number(required)','','contactphone');
		echo "<input type='text' id='rp_text_contactphone' name='rp_text_contactphone'>";
		realShowListingData('Subject','','contactsubject');
		echo "<input type='text' id='rp_text_contactsubject' name='rp_text_contactsubject'>";
		realShowListingData('Your Message','','contactmessage');
		echo '<textarea id="rp_text_contactmessage" name="rp_text_contactmessage" cols="20" rows="5">';
		echo '</textarea>';
		realShowListingData('Sorry to ask but please fill in this verification','','contactcheck');
		echo "<input type='text' id='rp_text_spaminput' name='rp_text_spaminput'>";
		echo '<img src="'. get_option('siteurl'). '/wp-content/plugins/'.BASE_DIR.'/realspamcheck.php" id="rp_spamBox" />';
		realShowListingData('','','contactsubmit');
		echo "<input type= 'button' id='rp_submitcontact' value='Send' name='rp_submitcontact' onclick='rpSubmitForm();return false;' >";
		echo '</form>';
		realShowListingData('','','contacttail');
	}
}


/***************************************************************/
/****  function:realShowImage                           ********/
/****  usage: Show Image of this listing                ********/
/***************************************************************/
if (!(function_exists('realShowImage')))
{
function realShowImage($p_realPostId,$p_houseID)
{
	//include_once (NGGALLERY_ABSPATH. 'nggfunctions.php');

	// is use nextgen gallery?
	
	$m_alt = get_the_title($p_realPostId);
	if (empty($m_alt)) $m_alt = '';
	
	$m_nextgenGallery = get_post_meta($p_realPostId,'nextgen_gallery');
	if (empty($m_nextgenGallery))
	{
		$m_realImage =  get_post_meta($p_realPostId,'realImage');
	//!!! we need float it? or may be need more hurge image
		echo "<div id='rp_showImage'>";
		if (empty($m_realImage))
		{
			realShowListingData('Sorry, no any photo for this house found yet.','ERROR:','errorImage');
		}
		else 
		{
			echo "<div id='rp_ImageArea'>";
			echo "<div id='rp_ImageDiv'>";
			echo "<img src='".$m_realImage[0][0]."' alt='".$m_alt."' id='rp_firstImage'>";
			echo "</div>"; //rp_ImageDiv
			
			echo "<div id='rp_ImageBig'>";
			echo "View <a href='".$m_realImage[0][0]."' title='$m_alt' class='thickbox'>larger photos</a>";
			echo "</div>"; //rp_ImageBig
			echo "</div>"; //rp_ImageArea
			
		}
		echo "</div>"; //rp_showImage
	}
	else 
	{
		// use nextgen-gallery
	
		if (function_exists('nggShowSimpleViewer'))
		{
			echo "<div id='rp_showGallery'>";
			echo "<div  class='simpleviewer' id='ngg_simpleviewer".$m_nextgenGallery[0]."'>";
			//!!! $m_galleryResult = nggShowSimpleViewer($m_nextgenGallery[0],540,540);
			$m_galleryResult = nggShowSimpleViewer($m_nextgenGallery[0],460,460);
			echo $m_galleryResult;
			echo "</div>";
			echo "</div>"; //rp_showGallery
		}
	}
}
}

/***************************************************************/
/****  function:realMetaSEO                             ********/
/****  usage: SEO in meta area for listing              ********/
/***************************************************************/
function realMetaSEO()
{
	global $wpdb,$table_prefix,$wp_version,$userdata,$current_user, $user_ID,$post,$wp_rewrite;
	get_currentuserinfo();

	if ((is_single()) || is_page())
	{
		$realPostId = $post->ID;
		$m_rp_menuTitleSEO = get_post_meta($realPostId,'realMetaDescriptionSEO');
		if (!(empty($m_rp_menuTitleSEO)))
		{
			echo sprintf("<meta name=\"description\" content=\"%s\" />", $m_rp_menuTitleSEO[0]);
		}
		
		$m_rp_metaTitleSEO = get_post_meta($realPostId,'realMetaTitleSEO');
		if (!(empty($m_rp_metaTitleSEO)))
		{
			echo sprintf("<meta name=\"title\" content=\"%s\" />", $m_rp_metaTitleSEO[0]);
		}		
	}
}

/***************************************************************/
/****  function:realTitleSEO                            ********/
/****  usage: SEO in title area for listing             ********/
/***************************************************************/
function realTitleSEO($p_title)
{
	global $wpdb,$table_prefix,$wp_version,$userdata,$current_user, $user_ID,$post,$wp_rewrite;
	get_currentuserinfo();
	if (is_admin())
	{
		return $p_title;
	}
	if (is_single())
	{
		$realPostId = $post->ID;
		$m_rp_menuTitleSEO = get_post_meta($realPostId,'realMenuTitleSEO');
		if (!(empty($m_rp_menuTitleSEO)))
		{
			return $m_rp_menuTitleSEO[0];
		}
		else 
		{
			return $p_title;
		}
	}
	else 
	{
		return $p_title;
	}
}


/***************************************************************/
/****  function:realShowGoogleMaps                      ********/
/****  usage: Show google maps in listing               ********/
/***************************************************************/
if (!(function_exists('realShowGoogleMaps')))
{
function realShowGoogleMaps($realPostId,$p_houseID)
{
	global $wpdb,$table_prefix,$wp_version,$userdata,$current_user, $user_ID,$post,$wp_rewrite;
	get_currentuserinfo();
	
	$realPostCode = realGetHousePostCode($p_houseID);
	if (!(empty($realPostCode)) && ((is_single()) || (is_page())))
	{
		//$realPostCode = str_replace(" ","%20",$realPostCode);	
		echo '<div id="realInputSE">';
		echo '<form action="#" onsubmit="setDirections(this.from.value, this.to.value, this.locale.value); return false">';
		echo '<table width="90%">';
		echo '<tr>';
		echo '<td>';
		echo 'From:';
		echo '</td>';
		echo '<td>';
		echo '<input type="text" size="15" id="fromAddress" name="from" value="e.g 123 Main st" onclick="realClearClick()"/>';
		echo '</td>';
		echo '<td>';
		echo 'To:';
		echo '</td>';		
		echo '<td>';
		echo '<input type="text" size="15" id="toAddress" name="to" value="'.$realPostCode.'" />';
		echo '</td>';
		echo '<td>';
		echo '<select id="reallocale" name="locale">';
		echo '<option value="en" selected>English</option>';
    	echo '<option value="fr">French</option>';
    	echo '<option value="de">German</option>';
    	echo '<option value="ja">Japanese</option>';
    	echo '<option value="es">Spanish</option>';
    	echo '</select>';
    	echo '</td>';
    	echo '<td>';
    	echo '<input name="submit" type="submit" value="Get Directions!" />';
		echo '</td>';
    	echo '</tr>';
		echo '</table>';
		echo '</form>';
		echo '</div>';
	
		echo '<div id="realpressMapCanvas" ></div>';
		echo '<div id="realDirections"></div>';
	}
}
}

/***************************************************************/
/****  function:realpressGetPostCode                    ********/
/****  usage: get PostCode from a listing               ********/
/***************************************************************/
function realpressGetPostCode($realPostID)
{
	global $wpdb,$table_prefix,$wp_version,$userdata,$current_user, $user_ID,$post,$wp_rewrite;
	get_currentuserinfo();

	$m_googlekey = get_option('realgooglekey');
	if (empty($m_googlekey))
	{
		return false; // need setting google maps api key at admin area first
	}
	$realHouseId = '';
	$realHouseId =  realGetPostHoustID($realPostID);
	if ($realHouseId === false)
	{
		return false; // no house in this listing
	}
	$realPostCode = realGetHousePostCode($realHouseId);
	if (empty($realPostCode)) return false;
	$realPostCode = str_replace(" ","%20",$realPostCode);

	$m_realReturnLngLat = '';
	//!!!!!!$m_realGoogleMapsDate = "http://maps.google.com/maps/geo?q=".$realPostCode."&output=json&oe=utf8&sensor=false&key=$realPostCode";
	$m_realGoogleMapsDate = "http://maps.google.com/maps/geo?q=".$realPostCode."&output=json&oe=utf8&sensor=false&key=$m_googlekey";


	$curl = curl_init(); 
	curl_setopt($curl, CURLOPT_URL, $m_realGoogleMapsDate);
	curl_setopt($curl, CURLOPT_HEADER, 0);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	$data = curl_exec($curl);
	curl_close($curl);
				
	if (function_exists('json_decode'))
	{
		$m_googleMapTemp = json_decode($data);
		if ('200' == $m_googleMapTemp->Status->code)
		{
			$m_googleMapStatu = $m_googleMapTemp;
			$m_realReturnLngLat = array();
			$m_realReturnLngLat['lng'] = $m_googleMapStatu->Placemark[0]->Point->coordinates[0];
			$m_realReturnLngLat['lat'] = $m_googleMapStatu->Placemark[0]->Point->coordinates[1];
		}
	}
	else
	{
		require_once("JSON_php4.php");
		$json = new Services_JSON;
		$m_googleMapTemp = json_decode($data);
		if ('200' == $m_googleMapTemp->Status->code)
		{
			$m_googleMapStatu = $m_googleMapTemp;
			$m_realReturnLngLat = array();
			$m_realReturnLngLat['lng'] = $m_googleMapStatu->Placemark[0]->Point->coordinates[0];
			$m_realReturnLngLat['lat'] = $m_googleMapStatu->Placemark[0]->Point->coordinates[1];
		}					
	}
	return $m_realReturnLngLat;
}

/***************************************************************/
/****  function:realGetHousePostCode                    ********/
/****  usage: get PostCode from a house                 ********/
/***************************************************************/
function realGetHousePostCode($p_houseID)
{
	global $wpdb,$table_prefix,$wp_version,$userdata,$current_user, $user_ID,$post,$wp_rewrite;
	get_currentuserinfo();

	$table_name = $table_prefix."realpresshouse";
	$getHousePostSQL = "select * from `".$table_name."` where `id` = '".$p_houseID."' limit 1";
	$getHousePostResult = $wpdb->get_results($getHousePostSQL,ARRAY_A);
	
	if (empty($getHousePostResult)) return false;
	
	$returnPostCode = '';
	
	if (!(empty($getHousePostResult[0]['postcode']))) 
	{
		$returnPostCode .= $getHousePostResult[0]['postcode'];
		return $returnPostCode;
	}
		
	if (!(empty($getHousePostResult[0]['addressnumber']))) 
	{
		$returnPostCode .= $getHousePostResult[0]['addressnumber'];
	}
	
	if (!(empty($getHousePostResult[0]['stree']))) 
	{
		$returnPostCode .= ", " . $getHousePostResult[0]['stree'];
	}

	if (!(empty($getHousePostResult[0]['city']))) 
	{
		$returnPostCode .= ", " . $getHousePostResult[0]['city'];
	}

	if (!(empty($getHousePostResult[0]['state']))) 
	{
		$returnPostCode .= ", " . $getHousePostResult[0]['state'];
	}

	if (!(empty($getHousePostResult[0]['country']))) 
	{
		$returnPostCode .= ", " . $getHousePostResult[0]['country'];
	}

	if (empty($returnPostCode)) return false;
	return $returnPostCode;
}

/***************************************************************/
/****  function:realGetPostHoustID                      ********/
/****  usage: get house id from a lising                ********/
/***************************************************************/
function realGetPostHoustID($p_listID)
{
	global $wpdb,$table_prefix,$wp_version,$userdata,$current_user, $user_ID,$post,$wp_rewrite;
	get_currentuserinfo();

	$table_name = $table_prefix."posts";
	$getContentSQL = "select `post_content` from `".$table_name."` where `ID` = '".$p_listID."' limit 1";
	$getContentResult = $wpdb->get_var($getContentSQL);
	
	
	if (empty($getContentResult))
	{
		return false;
	}
	$leftPatternFilter = "[tag] begin rpList [/tag]";
	$rightPatternFilter = "[tag] end rpList [/tag]";
	$getContentResult =str_replace(']]>', ']]&gt;', $getContentResult);
	$my_begin_filter = strpos($getContentResult, $leftPatternFilter);
	$my_end_filter = strpos($getContentResult, $rightPatternFilter);
	if ((($my_begin_filter === false) ||($my_end_filter === false)) )
	{
		return false;
	}
	
	{
		if ($my_begin_filter >= $my_end_filter)
		{
			return false;
		}
		else
		{
			$returnHouseID = substr($getContentResult, $my_begin_filter+25, $my_end_filter-$my_begin_filter-25);
			if (empty($returnHouseID)) 
			{
				return false;
			}
			else 
			{
				return $returnHouseID;
			}
		}
		return false;
	}
}

/***************************************************************/
/****  function:realShowContent                         ********/
/****  usage: show content of one listing               ********/
/***************************************************************/
if (!(function_exists('realShowContent')))
{
function realShowContent($realPostId,$p_houseID)
{
	global $wpdb,$table_prefix,$wp_version,$userdata,$current_user, $user_ID,$post,$wp_rewrite;
	get_currentuserinfo();
	if (empty($p_houseID)) return false;
	if (empty($realPostId)) return false;
	
	// var init
	$m_addressnumber = '';
	$m_stree  = '';
	$m_city  = '';
	$m_state  = '';
	$m_country  = '';
	$m_postcode  = '';
	$m_propertytype  = '';
	$m_listingtype  = '';
	$m_listingfeatures  = '';
	$m_propertyfeatures  = '';
	$m_neighborhood  = '';
	$m_mls  = '';
	$m_sqft  = '';
	$m_price_sqft  = '';
	$m_price_total  = '';
	$m_saled_price  = '';
	$m_yearbuild  = '';
	$m_beds  = '';
	$m_baths  = '';
	$m_garages  = '';
	$m_acres  = '';
	$m_listdate  = '';
	$m_saledate  = '';
	$m_currencyid  = '';
	$m_featured  = '';
	$m_agentid  = '';
	$m_status  = '';
	$m_description  = '';
	
	
	// get all details
	$m_addressnumber = realGetHouseDetails($p_houseID,'addressnumber');
	$m_stree = realGetHouseDetails($p_houseID,'stree');
	$m_city = realGetHouseDetails($p_houseID,'city');
	$m_state = realGetHouseDetails($p_houseID,'state');
	$m_country = realGetHouseDetails($p_houseID,'country');
	$m_postcode = realGetHouseDetails($p_houseID,'postcode');
	$m_propertytype = realGetHouseDetails($p_houseID,'propertytype');
	$m_listingtype = realGetHouseDetails($p_houseID,'listingtype');
	$m_listingfeatures = realGetHouseDetails($p_houseID,'listingfeatures');
	$m_propertyfeatures = realGetHouseDetails($p_houseID,'propertyfeatures');
	$m_neighborhood = realGetHouseDetails($p_houseID,'neighborhood');
	$m_mls = realGetHouseDetails($p_houseID,'mls');
	$m_sqft = realGetHouseDetails($p_houseID,'sqft');
	$m_price_sqft = realGetHouseDetails($p_houseID,'price_sqft');
	$m_price_total = realGetHouseDetails($p_houseID,'price_total');
	$m_saled_price = realGetHouseDetails($p_houseID,'saled_price');
	$m_yearbuild = realGetHouseDetails($p_houseID,'yearbuild');
	$m_beds = realGetHouseDetails($p_houseID,'beds');
	$m_baths = realGetHouseDetails($p_houseID,'baths');
	$m_garages = realGetHouseDetails($p_houseID,'garages');
	$m_acres = realGetHouseDetails($p_houseID,'acres');
	$m_listdate = realGetHouseDetails($p_houseID,'listdate');
	$m_saledate = realGetHouseDetails($p_houseID,'saledate');
	$m_currencyid = realGetHouseDetails($p_houseID,'currencyid');
	$m_featured = realGetHouseDetails($p_houseID,'featured');
	$m_agentid = realGetHouseDetails($p_houseID,'agentid');
	$m_status = realGetHouseDetails($p_houseID,'status');
	$m_description = realGetHouseDetails($p_houseID,'description');	
	$m_title = get_the_title($realPostId);
	

	realShowBF('before','HouseDetails');

	echo "<div id='realpressHouseDetails'>";

	realShowListingData($m_featured,'','featured');
	realShowListingData($m_title,'','title');
	realShowListingData($m_description,'description','description');
	realShowListingData($m_status,'status','status','','','realpressClearDiv');
	realShowListingData($m_listingtype,'listing type','listingtype');
	realShowListingData($m_stree,'stree','stree');
	realShowListingData($m_city,'city','city');
	realShowListingData($m_state,'state','state');
	realShowListingData($m_country,'country','country');
	realShowListingData($m_postcode,'postcode','postcode');
	realShowListingData($m_beds,'beds','beds');
	realShowListingData($m_baths,'baths','baths');
	realShowListingData($m_garages,'garages','garages');
	realShowListingData($m_sqft,'sqft','sqft');
	realShowListingData($m_acres,'acres','acres');
	realShowListingData($m_yearbuild,'yearbuild','yearbuild');
	realShowListingData($m_listingfeatures,'listing features','listingfeatures');
	realShowListingData($m_propertyfeatures,'property features','propertyfeatures');
	realShowListingData($m_neighborhood,'neighborhood','neighborhood');

	
	
	realShowListingData($m_currencyid,'currency','currencyid');
	
	realShowListingData($m_price_sqft,'price sqft','price_sqft');
	realShowListingData($m_price_total,'price total','price_total');
	realShowListingData($m_saled_price,'saled price','saled_price');
	realShowListingData($m_listdate,'list date','listdate');
	realShowListingData($m_saledate,'sale date','saledate');
	
	realShowListingData($m_mls,'mls/source id','mls');
	realShowListingData($m_agentid,'agent id','agentid');
	realShowListingData($m_title,'title','');
	realShowListingData($m_propertytype,'property type','propertytype');

	echo "</div>"; // realpressHouseDetails

	realShowBF('after','HouseDetails');
}
}

/***************************************************************/
/****  function:realpressDiv                            ********/
/****  usage: show one customize div                    ********/
/***************************************************************/
function realpressDiv($p_style)
{
	echo "<div style='$p_style;'>";
	echo '</div>';	
}

/***************************************************************/
/****  function:realpressClearDiv                       ********/
/****  usage: show one clear div                        ********/
/***************************************************************/
function realpressClearDiv()
{
	realpressDiv('clear:both');
}

/***************************************************************/
/****  function:realShowBF                              ********/
/****  usage: show a div and run an function in skin    ********/
/***************************************************************/
function realShowBF($p_direction,$p_name,$p_action = '')
{
	echo "<div id='rp_".$p_direction."_".$p_name."'>";
	if (!empty($p_action)) $p_action();
	echo "</div>";	
}

/***************************************************************/
/****  function:realShowListingData                     ********/
/****  usage: show one field, customize style and action********/
/***************************************************************/
function realShowListingData($p_data = '',$p_title = '',$p_style_name = '',$p_before_action = '' , $p_before_arg = '' , $p_inner_action = '', $p_inner_arg = '',$p_after_action = '', $p_after_arg = '')
{
	{
		if (!(empty($p_before_action)))
		{
			echo "<div id='rp_before_$p_style_name'>";
			//$p_before_action($p_before_arg);
			if (!empty($p_before_arg))
			{
		 		call_user_func_array($p_before_action,$p_before_arg);
			}
			else 
			{
				call_user_func($p_before_action);
			}
			echo "</div>";
		}
		
		echo "<div id='rp_$p_style_name'>";

		if (!empty($p_title))
		{
			echo "<div id='rp_title_".$p_style_name."'>";
			echo $p_title;
			echo "</div>";
		}
		
		if (!empty($p_data))
		{
			echo "<div id='rp_content_$p_style_name'>";
			echo $p_data;
			echo "</div>";
		}
		
		if (!(empty($p_inner_action))) 
		{
			echo "<div id='rp_inner_$p_style_name'>";
			if (!empty($p_inner_arg))
			{
		 		call_user_func_array($p_inner_action,$p_inner_arg);
			}
			else 
			{
				call_user_func($p_inner_action);
			}			
			echo "</div>";
		}
		
		echo "</div>"; //rp_$p_style_name
		
		if (!(empty($p_after_action)))
		{
			echo "<div id='rp_end_$p_style_name'>";
			//$p_after_action();
			if (!empty($p_after_arg))
			{
		 		call_user_func_array($p_after_action,$p_after_arg);
			}
			else 
			{
				call_user_func($p_after_action);
			}						
			echo "</div>";
		}
	}
}

/***************************************************************/
/****  function:realGetHouseDetails                     ********/
/****  usage: get one house field from database         ********/
/***************************************************************/
function realGetHouseDetails($p_houseID, $p_Details)
{
	global $wpdb,$table_prefix,$wp_version,$userdata,$current_user, $user_ID,$post,$wp_rewrite;
	get_currentuserinfo();

	if (empty($p_houseID)) return false;
	if (empty($p_Details)) return false;
	$table_name = $table_prefix."realpresshouse";
	$getHousePostSQL = "select `".$p_Details."` from `".$table_name."` where `id` = '".$p_houseID."' and `valid` = 'YES' limit 1";
	$getHousePostResult = $wpdb->get_var($getHousePostSQL);
	
	if (empty($getHousePostResult)) return false;
	return $getHousePostResult;
}

/***************************************************************/
/****  function:realCheckCustomCss                     ********/
/****  usage: check realpress admin css or write to file********/
/***************************************************************/
function realCheckCustomCss($p_model = '')
{
	global $wpdb,$table_prefix,$wp_version,$userdata,$current_user, $user_ID,$post,$wp_rewrite;
	get_currentuserinfo();	
	
	$file = ABSPATH . '/wp-content/plugins/'.BASE_DIR.'/custom.css';
	
	if ($p_model == 'NEW')
	{
		if (file_exists($file))
		{
			return;
		}
	}
$m_real_titlefont = get_option('real_titlefont');
if (empty($m_real_titlefont))
{
	$m_real_titlefont = "Arail,Bold";
}

$m_real_titlefontsize = get_option('real_titlefontsize');
if (empty($m_real_titlefontsize))
{
	$m_real_titlefontsize = "36px";
}

$m_real_featuresfont = get_option('real_featuresfont');
if (empty($m_real_featuresfont))
{
	$m_real_featuresfont = "Arail,Black";
}

$m_real_titlefontcolor = get_option('real_titlefontcolor');
if (empty($m_real_titlefontcolor))
{
	$m_real_titlefontcolor = "#000";
}

$m_real_featuresfontcolor = get_option('real_featuresfontcolor');
if (empty($m_real_featuresfontcolor))
{
	$m_real_featuresfontcolor = "#000";
}

$m_real_pricefont = get_option('real_pricefont');
if (empty($m_real_pricefont))
{
	$m_real_pricefont = "24px";
}

$m_real_linkcolor = get_option('real_linkcolor');
if (empty($m_real_linkcolor))
{
	$m_real_linkcolor = "blue";
}
	
	$f = fopen($file,'w');
	$data = "#rp_title{font-family: $m_real_titlefont;font-size:$m_real_titlefontsize;color : $m_real_titlefontcolor;}";
	$data .= "#rp_features{font-family: $m_real_featuresfont;color : $m_real_featuresfontcolor;}";
	$data .= "#rp_price{font-size: $m_real_pricefont;}";
	$data .= "#realpressHouseDetails a{color: $m_real_linkcolor;}";
	@fwrite($f,$data);
	fclose($f);
}

/***************************************************************/
/****  function:realpressIndexListing                   ********/
/****  usage: show all  listing in one index page       ********/
/***************************************************************/
function realpressIndexListing($content)
{

	global $wpdb,$table_prefix,$wp_version,$userdata,$current_user, $user_ID,$post,$wp_rewrite;
	
  //search form data
	global $arr_search_form;
	get_currentuserinfo();
	
	$m_mainListing = get_option('realmainlisting');
	$m_listingSummary  = get_option('reallistsummary');
	
	if (empty($m_mainListing))
	{
		return $content;
	}
	
	if (is_page($m_mainListing))
	{
		$house_table = $table_prefix . "realpresshouse";
		$post_table = $table_prefix . "posts";
		$m_sql = "select `postid` from `".$house_table."` where `valid` = 'YES'";
		
      foreach ($arr_search_form as $k => $d)
      {
        if (isset($_GET[$k])&&$_GET[$k]!="")
          {
            //$m_sql.=" and `".$d["db_field"]."` = '".$_GET[$k]."'";      
            $m_sql.=" and `".$d["db_field"]."` ".(isset($d["expr"])?$d["expr"]:"=")." '".$_GET[$k]."'";
            //save search form variables into session
            $_SESSION["REW"][$k]=$_GET[$k];
          }
        else
          unset($_SESSION["REW"][$k]);   
      }
     //var_dump($m_sql); 		  
		$m_result = $wpdb->get_results($m_sql);
		if (!empty($m_result))
		{
			foreach ($m_result as $m_now)
			{
				if (empty($m_now->postid)) continue;
				$m_rp_menuTitleSEO = get_post_meta($m_now->postid,'realMenuTitleSEO');
				if (!(empty($m_rp_menuTitleSEO)))
				{
					$m_title = $m_rp_menuTitleSEO[0];
					$m_arg = array($m_now->postid,$m_title);
				}
				else
				{
					$m_titleSQL = "select `post_title` from `".$post_table."` where `ID` = '". $m_now->postid  ."' limit 1";
					$m_title = $wpdb->get_var($m_titleSQL);
					$m_arg = array($m_now->postid,$m_title);
				}
				realShowListingData('','','indexposttitle','realpreShowEveryTitle',$m_arg);
				if ($m_listingSummary == 'YES')
				{
					$m_expertSQL = "select `post_excerpt` from `".$post_table."` where `ID` = '". $m_now->postid  ."' limit 1";
					$m_expertResult = $wpdb->get_var($m_expertSQL);
					$m_arg = array($m_now->postid,$m_expertResult);
					realShowListingData('','','indexpostcontent','realpreShowEveryExpert',$m_arg);
				}
			}
		}
	}
	return $content;
}

//query for googlebase
function realpressAvailableListings()
{

	global $wpdb,$table_prefix,$wp_version,$userdata,$current_user, $user_ID,$post,$wp_rewrite;
	
  //search form data
	global $arr_search_form;
	get_currentuserinfo();
	
	$m_mainListing = get_option('realmainlisting');
	$m_listingSummary  = get_option('reallistsummary');
	

		$house_table = $table_prefix . "realpresshouse";
		$post_table = $table_prefix . "posts";
		$m_sql = "select `postid` from `".$house_table."` where `valid` = 'YES'";
		$m_sql = "select pt.`post_title`,ht.*  from `".$house_table."` ht, `".$post_table."` pt  where pt.`ID`= ht.`postid` and ht.`valid` = 'YES'";
		$m_result = $wpdb->get_results($m_sql);
		return $m_result;
    /* 
		if (!empty($m_result))
		{
			foreach ($m_result as $m_now)
			{
				if (empty($m_now->postid)) continue;
				$m_rp_menuTitleSEO = get_post_meta($m_now->postid,'realMenuTitleSEO');
				if (!(empty($m_rp_menuTitleSEO)))
				{
					$m_title = $m_rp_menuTitleSEO[0];
					$m_arg = array($m_now->postid,$m_title);
				}
				else
				{
					$m_titleSQL = "select `post_title` from `".$post_table."` where `ID` = '". $m_now->postid  ."' limit 1";
					$m_title = $wpdb->get_var($m_titleSQL);
					$m_arg = array($m_now->postid,$m_title);
				}
				var_dump($m_arg);
				
				if ($m_listingSummary == 'YES')
				{
					$m_expertSQL = "select `post_excerpt` from `".$post_table."` where `ID` = '". $m_now->postid  ."' limit 1";
					$m_expertResult = $wpdb->get_var($m_expertSQL);
					$m_arg = array($m_now->postid,$m_expertResult);
				}
				var_dump($m_arg);				
			}
			
		}*/
}

/***************************************************************/
/****  function:realpressGetAllListing                  ********/
/****  usage: get  all  listing in one system           ********/
/***************************************************************/
function realpressGetAllListing($p_number)
{
	global $wpdb,$table_prefix,$wp_version,$userdata,$current_user, $user_ID,$post,$wp_rewrite;
	get_currentuserinfo();
	
	$m_listingSummary  = get_option('reallistsummary');
	

		$house_table = $table_prefix . "realpresshouse";
		$post_table = $table_prefix . "posts";
		$m_sql = "select `postid` from `".$house_table."` where `valid` = 'YES' limit ".$p_number;
		$m_result = $wpdb->get_results($m_sql);
		if (!empty($m_result))
		{
			foreach ($m_result as $m_now)
			{
				if (empty($m_now->postid)) continue;
				$m_rp_menuTitleSEO = get_post_meta($m_now->postid,'realMenuTitleSEO');
				if (!(empty($m_rp_menuTitleSEO)))
				{
					$m_title = $m_rp_menuTitleSEO[0];
					$m_arg = array($m_now->postid,$m_title);
				}
				else
				{
					$m_titleSQL = "select `post_title` from `".$post_table."` where `ID` = '". $m_now->postid  ."' limit 1";
					$m_title = $wpdb->get_var($m_titleSQL);
					$m_arg = array($m_now->postid,$m_title);
				}
				realShowListingData('','','indexposttitle','realpreShowEveryTitle',$m_arg);
				if ($m_listingSummary == 'YES')
				{
					$m_expertSQL = "select `post_excerpt` from `".$post_table."` where `ID` = '". $m_now->postid  ."' limit 1";
					$m_expertResult = $wpdb->get_var($m_expertSQL);
					$m_arg = array($m_now->postid,$m_expertResult);
					realShowListingData('','','indexpostcontent','realpreShowEveryExpert',$m_arg);
				}
			}
		}

	return $content;
}

/***************************************************************/
/****  function:realpreShowEveryTitle                   ********/
/****  usage: show listing title and link               ********/
/***************************************************************/
function realpreShowEveryTitle($p_postid,$p_title)
{
	echo "<a href = '".get_option('siteurl')."/?p=".$p_postid."' target = '_blank'>".$p_title."</a>";
}

/***************************************************************/
/****  function:realpreShowEveryExpert                  ********/
/****  usage: show listing except                       ********/
/***************************************************************/
function realpreShowEveryExpert($p_postid,$p_content)
{
	//echo "<a href = '".get_option('siteurl')."/?p=".$p_postid."' target = '_blank'>".$p_content."</a>";
	echo $p_content;
	echo "<br />";
	echo "<br />";
}

/***************************************************************/
/****  function:realpressGetSystemPic                   ********/
/****  usage: return specify image in realpress system  ********/
/***************************************************************/
function realpressGetSystemPic($p_img)
{
	return plugins_url()."/".BASE_DIR."/images/".$p_img;
}

/***************************************************************/
/****  function:realpressGetThemesRoot                  ********/
/****  usage: return skin root path in system           ********/
/***************************************************************/
function realpressGetThemesRoot()
{
	$m_pluginUrl = ABSPATH."/wp-content/plugins";
	$m_themeDirectory = $m_pluginUrl."/".BASE_DIR."/themes";
	return 	$m_themeDirectory;
}

/***************************************************************/
/****  function:realpressGetThemes                      ********/
/****  usage: return all skins in one array             ********/
/***************************************************************/
function realpressGetThemes()
{
	$m_themeDirectory = realpressGetThemesRoot();
	$m_subThemeDirectoryHandle = @opendir( $m_themeDirectory);
	if (empty($m_subThemeDirectoryHandle))
	{
		@closedir( $m_themeDirectory );
		return false; // no any themes found;
	}
	$m_allThemesDirectory = array();
	while (false !== ($m_checkSubThemeDirectory = readdir( $m_subThemeDirectoryHandle ) ))
	{
		if (substr($m_checkSubThemeDirectory,0,1) == '.') continue;
		if ( is_dir( $m_themeDirectory.'/'.$m_checkSubThemeDirectory ) )
		{
			$m_checkThemesMainFile = $m_themeDirectory.'/'.$m_checkSubThemeDirectory.'/custom.php';
			if (is_readable($m_checkThemesMainFile))
			{
				$m_allThemesDirectory[] = $m_checkSubThemeDirectory;
			}
		}
	}
	
	if (is_array($m_allThemesDirectory) && (sizeof($m_allThemesDirectory)>0))
	{
		@closedir( $m_themeDirectory );
		return $m_allThemesDirectory;
	}
	else 
	{
		@closedir( $m_themeDirectory );
		return false; // no any themes found;		
	}
	@closedir( $m_themeDirectory );
	return false; // no any themes found;
}

/***************************************************************/
/****  function:realpressGetThemes                      ********/
/****  usage: check one skin is existed                 ********/
/***************************************************************/
function realCheckThemeExist($p_themeName)
{
	$m_themeDirectory = realpressGetThemesRoot();
	$m_themeDirectory = $m_themeDirectory . "/".$p_themeName;
	$m_subThemeDirectoryHandle = is_dir($m_themeDirectory);

	if ($m_subThemeDirectoryHandle == false)
	{
		return false;
	}
	else 
	{
		return true;
	}
}

/***************************************************************/
/****  function:realCreateThemeDirectory                ********/
/****  usage: create a skin direcroty                   ********/
/***************************************************************/
function realCreateThemeDirectory($m_savingTheme)
{
	if (!empty($m_savingTheme))
	{
		if (realCheckThemeExist($m_savingTheme) == false)
		{
			$m_themeDirectory = realpressGetThemesRoot();
			$m_themeDirectory = $m_themeDirectory . "/".$m_savingTheme;
			$m_newDir = mkdir($m_themeDirectory);
			if (is_dir($m_themeDirectory))
			{
				return true;
			}
			else 
			{
				return false;
			}
		}
	}
	else 
	{
		return false;
	}
}

/***************************************************************/
/****  function:realGetThemeScreenshot                  ********/
/****  usage: return a skin screenshot image            ********/
/***************************************************************/
function realGetThemeScreenshot($p_themeName)
{
	if (empty($p_themeName))
	{
		return false;
	}
	
	$m_themeDirectory = realpressGetThemesRoot()."/".$p_themeName;
	
	$m_subThemeDirectoryHandle = @opendir( $m_themeDirectory);
	if (empty($m_subThemeDirectoryHandle))
	{
		@closedir( $m_themeDirectory );
		return false; // no any themes found;
	}

	while (false !== ($m_checkSubThemeDirectory = readdir( $m_subThemeDirectoryHandle ) ))
	{
		
		$m_checkName = strtolower($m_checkSubThemeDirectory);

		if (('screenshot.png' != $m_checkName) && ('screenshot.jpg' != $m_checkName) && ('screenshot.jpeg' != $m_checkName) )
		{
			continue;
		}
		else 
		{
			$m_nowThemeJPG =  $m_themeDirectory.'/'.$m_checkSubThemeDirectory;
			if ((is_file($m_nowThemeJPG)) && (is_readable($m_nowThemeJPG)))
			{
				return get_option('siteurl')."/wp-content/plugins/".BASE_DIR."/themes/".$p_themeName."/".$m_checkSubThemeDirectory;
			}
		}
		return false;
	}
}

/***************************************************************/
/****  function:realpressGetCustomCode                  ********/
/****  usage: return skin php code or css code          ********/
/***************************************************************/
function realpressGetCustomCode($p_model,$p_theme)
{
	$m_themeDirectory = realpressGetThemesRoot();
	if ($p_model == 'php')
	{
		$m_file =  $m_themeDirectory."/".$p_theme."/custom.php";
	}
	if ($p_model == 'css')
	{
		$m_file =  $m_themeDirectory."/".$p_theme."/realpress.css.php";
	}	
	
	if(!(is_file($m_file)))
	{
		return 'filefalse';
	}
	
	if(!(is_writeable($m_file)))
	{
		return 'writefalse';
	}
	$m_fileSize = 0;
	$m_fileSize = filesize($m_file);
	if ( $m_fileSize > 0 )
	{
		$m_fileHandle = fopen($m_file, 'r');
		$m_content = fread($m_fileHandle, $m_fileSize);
		return htmlspecialchars($m_content);
	}
	else 
	{
		return 'zerofalse';
	}
}


/***************************************************************/
/****  function:realpresWriteTheme                      ********/
/****  usage: write php code or css code of a skin      ********/
/***************************************************************/
function realpresWriteTheme($p_model,$p_savingTheme,$p_themePhpCode)
{

	$m_themeDirectory = realpressGetThemesRoot();
	if ($p_model == 'php')
	{
		if (empty($p_themePhpCode))
		{
			return "Sorry, you did not submit anything in custom.php";
		}		
		$m_file =  $m_themeDirectory."/".$p_savingTheme."/custom.php";
		if (is_file($m_file))
		{
		if(!(is_writeable($m_file)))
		{
			return 'Sorry, custom.php is not writeable';
		}
		}
	}
	if ($p_model == 'css')
	{
		if (empty($p_themePhpCode))
		{
			return "Sorry, you did not submit anything in realpress.css.php";
		}		
		$m_file =  $m_themeDirectory."/".$p_savingTheme."/realpress.css.php";
		if (is_file($m_file))
		{
		if(!(is_writeable($m_file)))
		{
			return 'Sorry, realpress.css.php is not writeable';
		}
		}
	}

	$m_fileHandle = fopen($m_file, 'w+');
	if ($m_fileHandle !== FALSE) 
	{
		$p_themePhpCode = stripslashes($p_themePhpCode);
		fwrite($m_fileHandle, $p_themePhpCode);
		fclose($m_fileHandle);
		return "Your change has been saved, thank you.";
	}
	fclose($m_fileHandle);
}

/***************************************************************/
/****  function:realRunCustomTheme                      ********/
/****  usage: run a skin                                ********/
/***************************************************************/
function realRunCustomTheme()
{
	$m_theme = get_option('realpressTheme');
	
	if (realCheckThemeExist($m_theme))
	{
		$m_themeDirectory = realpressGetThemesRoot();
		$m_themeDirectory = $m_themeDirectory . "/".$m_theme."/custom.php";

		if (is_file($m_themeDirectory))
		{
			require_once($m_themeDirectory);
		}
	}
}

/***************************************************************/
/****  function:realRunCustomCss                        ********/
/****  usage: load  skin css                            ********/
/***************************************************************/
function realRunCustomCss()
{
	$m_theme = get_option('realpressTheme');
	if (realCheckThemeExist($m_theme))
	{
		//$m_themeDirectory = plugins_url() ."/realpress";
		$m_themeDirectory = plugins_url() ."/".BASE_DIR;
		
		$m_themeDirectory = $m_themeDirectory . "/themes/".$m_theme."/realpress.css.php";
		$m_themeAbsPath = ABSPATH."/wp-content/plugins/".BASE_DIR."/themes/".$m_theme."/realpress.css.php";
		if (is_file($m_themeAbsPath))
		{
			echo sprintf('<link rel="stylesheet" href="%s" type="text/css" media="screen" />', $m_themeDirectory);
		}
		else
		{
			$realhradUrl = plugins_url();
			echo sprintf('<link rel="stylesheet" href="%s" type="text/css" media="screen" />', $realhradUrl."/".BASE_DIR."/realpress.css.php");
		}
	}
}


/***************************************************************/
/****  function:realShowCloseIcon                       ********/
/****  usage: show close icon                           ********/
/***************************************************************/
function realShowCloseIcon($p_tips,$p_model = '',$p_width = '', $p_height = '')
{
	$m_closeIcon = plugins_url()."/".BASE_DIR."/images/images-save2.gif";
	
	if (empty($p_model))
	{
		echo "<div id= 'realSaveTips'>";
		echo '<img src="'.$m_closeIcon.'" width="50%" height="50%" alt="click me to close the window" border="0" onclick="javascript:self.parent.tb_remove();">';
	}
	else
	{
		echo "<div id= 'realSaveTips' onclick='javascript:self.parent.tb_remove();'>";
	}
	echo '<br />';
	echo $p_tips;
	echo "</div>";
}

/***************************************************************/
/*******function: realpressImportFeeds version 1.0	2009-10  ***/
/***** import feeds as listing (interface for the next stage)***/
/***************************************************************/
function realpressImportFeeds()
{

}



/***************************************************************/
/*******function: real_get_json version 1.0	2009-10          ***/
/***** get json data from fx                                 ***/
/***************************************************************/
function real_get_json($url) {

  $res = '';


  if (ini_get('allow_url_fopen')) {
  
    $res = @file_get_contents($url);

  }

  if (function_exists('curl_version') && (strlen($res) == 0)) {
    //
    // try CURL
    //
    
    //Initialize the Curl session
    $ch = curl_init();

    //Set curl to return the data instead of printing it to the browser.
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    //Set the URL
    curl_setopt($ch, CURLOPT_URL, $url);
    //Execute the fetch
    $res = curl_exec($ch);
    //Close the connection
    curl_close($ch);
    
    //print 'Curl working: ' . $res . ' :: ' . $url;
  }

  //ob_end_clean();

  return $res;
}

/***************************************************************/
/****  function:showRealExcerpt                         ********/
/****  usage: rewrite excerpt of listing                ********/
/***************************************************************/
function showRealExcerpt($p_width,$p_height)
{
	global $wpdb,$table_prefix,$wp_version,$userdata,$current_user, $user_ID,$post,$wp_rewrite;
	get_currentuserinfo();
	
	$p_content = '';
	
	echo "<div>";
	echo "<div>";
	realShowExcerptImage($post->ID,$p_width,$p_height,'firstImg','NO');
	echo "</div>";
	echo "<div style='margin-left:".($p_width+45)."px;margin-top:20px;padding-top:20px;'>";
	
	$post_table = $table_prefix."posts";
	$m_expertSQL = "select `post_excerpt` from `".$post_table."` where `ID` = '". $post->ID  ."' limit 1";
	$p_content = $wpdb->get_var($m_expertSQL);
	if (!(empty($p_content)))
	echo $p_content;
	echo "</div>";

	echo "</div>";
	
}

/***************************************************************/
/****  function:realpressExcerpt                        ********/
/****  usage: filter and rewrite excerpt of listing     ********/
/***************************************************************/
function realpressExcerpt($p_content)
{
	global $wpdb,$table_prefix,$wp_version,$userdata,$current_user, $user_ID,$post,$wp_rewrite;
	get_currentuserinfo();
	
	echo "<div>";
	echo "<div>";
	realShowExcerptImage($post->ID,'150','150','firstImg','NO');
	echo "</div>";
	echo "<div style='margin-left:180px;margin-top:20px;padding-top:20px;'>";
	$p_content = strip_tags($p_content,'<p><a>');
	echo $p_content;
	echo "</div>";

	echo "</div>";

}

/***************************************************************/
/****  function:realShowExcerptImage                    ********/
/****  usage: show excerpt image in slide php           ********/
/***************************************************************/
//if (!(function_exists('realShowImage')))
{
function realShowExcerptImage($p_realPostId,$p_width = '',$p_height = '',$p_model = '',$p_title = '',$custom_style="")
{
	$m_alt = get_the_title($p_realPostId);
	if (empty($m_alt)) $m_alt = '';
	
	$m_nextgenGallery = get_post_meta($p_realPostId,'nextgen_gallery');
	if (empty($m_nextgenGallery))
	{
		$m_realImage =  get_post_meta($p_realPostId,'realImage');
		if (empty($m_realImage))
		{
			realShowListingData('Sorry, no any photo for this house found yet.','ERROR:','errorImage');
		}
		else 
		{
			$m_img =  "<img src='".$m_realImage[0][0]."' alt='".$m_alt;
			if ((!(empty($p_width))) && (!(empty($p_height))))
			{
				$m_img .= "' style='".$custom_style;
				if (!(empty($p_width)))
				{
					$m_img .= " width:$p_width"."px;";
				}
				if (!(empty($p_height)))
				{
					$m_img .= " height:$p_height"."px;";
 				}
 				
			}
			$m_img .= "' >";
			echo $m_img;
		}
	}
	else 
	{
		// use nextgen-gallery
		if (function_exists('nggShowImageBrowser'))
		{
			if ($p_model == 'firstImg')
			{
				$m_galleryResult = realShowExcerptGalleryFirstImg($m_nextgenGallery[0],$p_width,$p_height);
				echo $m_galleryResult;
			}
		}
	}
}
}
//get images array for current post 
function realpress_get_post_images($post_id,$max_pics)
{
  global $table_prefix,$wpdb;
  $pics_arr= array();
  
	$m_nextgenGallery = get_post_meta($post_id,'nextgen_gallery');
	//var_dump($m_nextgenGallery);
	//if has been loaded single image
	if (empty($m_nextgenGallery))
	{
		$m_realImage =  get_post_meta($post_id,'realImage');

		if (!empty($m_realImage))
		{
      $pics_arr[]=$m_realImage[0][0];
		}
	}
	else 
	{
	 // return $m_nextgenGallery[0];
    $galerry_id=$m_nextgenGallery[0];

    //get path to gallery id	   
    $m_pathTable =$table_prefix.'ngg_gallery';
    $m_pathSql = 'select `path` from `'.$m_pathTable."` where `gid` = '".$galerry_id."' limit 1";
    $m_pathResult = $wpdb->get_var($m_pathSql);

    //if have path to the gallery
    if (!(empty($m_pathResult)))
    {
      $siteurl=get_option('siteurl');
      //get array of photos for current gallery
      $m_photoTable =$table_prefix.'ngg_pictures';
      $m_photoSql = 'select `filename` from `'.$m_photoTable."` where `galleryid` = '".$galerry_id."' limit ".$max_pics;
      $m_photoResult = $wpdb->get_results($m_photoSql);
      //var_dump($m_photoResult);
      foreach ($m_photoResult as $k => $d)
      {
        if (!(empty($d)))
          $pics_arr[]=$siteurl."/".$m_pathResult."/".$d->filename;
      }
	  }
	}

  return $pics_arr;
}
/***************************************************************/
/****  function:realShowExcerptGalleryFirstImg          ********/
/****  usage: show excerpt first image from gallery     ********/
/***************************************************************/
//if (!(function_exists('realGetGalleryFirstImg')))
{
function realShowExcerptGalleryFirstImg($p_galleryID,$p_width='',$p_height='')
{
	global $wpdb,$table_prefix,$wp_version,$userdata,$current_user, $user_ID,$post,$wp_rewrite,$nggdb;
	get_currentuserinfo();

	if (empty($p_width)) $p_width = 250;
	if (empty($p_height)) $p_height = 250;
	
	$m_return = false;
	$m_galleryID = $p_galleryID;
			if (!(empty($m_galleryID)))
			{
				if (function_exists('nggSinglePicture'))
				{
					$m_photoTable =$table_prefix.'ngg_pictures';
					$m_photoSql = 'select `filename` from `'.$m_photoTable."` where `galleryid` = '".$m_galleryID[0]."' limit 1";
					$m_photoResult = $wpdb->get_var($m_photoSql);
					
					$m_pathTable =$table_prefix.'ngg_gallery';
					$m_pathSql = 'select `path` from `'.$m_pathTable."` where `gid` = '".$m_galleryID[0]."' limit 1";
					$m_pathResult = $wpdb->get_var($m_pathSql);
					
					if ((!(empty($m_pathResult))) && (!(empty($m_photoResult))))
					$m_hadImgNow = get_option('siteurl')."/".$m_pathResult."/".$m_photoResult;
					if (!(empty($m_hadImgNow)))
					{
						$m_return =  ' <img style="margin-left:15px;padding-bottom:10px;width:'.$p_width.'px;height:'.$p_height.'px;" src ="'.$m_hadImgNow.'" >';
					}
					else 
					{
						$m_return = false;
					}
				}
			}
			return $m_return;
}

}

/***************************************************************/
/****  function:realListingNumber                       ********/
/****  usage: number of all listing or active, inactive ********/
/***************************************************************/
function realListingNumber($p_model)
{
	global $wpdb,$table_prefix,$wp_version,$userdata,$current_user, $user_ID,$post,$wp_rewrite;
	get_currentuserinfo();
	
	if (empty($p_model))
	{
		return 0;
	}

	$m_count = 0;
	$m_table = $table_prefix."realpresshouse";
	
	if ('all' == $p_model)
	{
		$m_sql = "select count(*) from `".$m_table."`";
	}

	else if ('active' == $p_model)
	{
		$m_sql = "select count(*) from `".$m_table."` where `valid` = 'YES'";
	}
	
	else if ('inactived' == $p_model)
	{
		$m_sql = "select count(*) from `".$m_table."` where `valid` <> 'YES'";
	}

	$m_result = $wpdb->get_var($m_sql);
	
	if (empty($m_result))
	{
		$m_count = 0;
	}
	else
	{
		$m_count = $m_result;
	}
	
	return $m_count;
}

function realGetTrueTitle($p_postID)
{
	global $wpdb,$table_prefix,$wp_version,$userdata,$current_user, $user_ID,$post,$wp_rewrite;
	get_currentuserinfo();

	$table_name = $table_prefix."posts";
	$m_sql = "select `post_title` from `".$table_name."` where `ID` = '".$p_postID."' limit 1";
	$m_result = $wpdb->get_var($m_sql);
	return $m_result;
}
/***************************************************************/
/*******function: realMessage version 1.0	                 ***/
/***** show responser messages                               ***/
/***************************************************************/
function realMessage($p_message,$p_model = null)
{
	echo "<div id='realmessagetop' style='background:#fffbcc;color:#000;border:1px solid #e6db55;width:100%;margin:10px 5px;padding:5px;'>";
	echo "$p_message";
	echo "</div>";
}

//DB options for RSS
function realpressGetRSSOptions($DB_option="realpressRSS")
{
  $rss_values_default = array(    
    "feed_title"=>"",
    "description"=>"",
    "brokerage_name"=>"",
    "agent_name"=>"",
    "agent_phone"=>"",
    "mls_name"=>"",
  );


  $data=json_decode(get_option($DB_option), true);
  //if havent data in the DB
  if (is_null($data)) $data=array();

  //$rss_values = array_merge($rss_values_default,$data);
  return array_merge($rss_values_default,$data);
}

?>