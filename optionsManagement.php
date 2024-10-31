<?php
ob_start();

?>
<script type="text/javascript">
function reAppearance()
{
	  //window.location.reload();	
	
}
</script>
<?php

realOptionManager();
/***************************************************************/
/****  function:realOptionManager                       ********/
/****  usage: option Manager in plugin menu             ********/
/***************************************************************/
function realOptionManager()
{
	global $m_allLanguage;
	ob_start();

	echo '<br />';
	echo '<div id = "realTab">';
	echo '<div id = "realsubTab">';
	echo '<ul>';
	echo '<li>';
	echo '<a href="#realFeatures"><span>'.$m_allLanguage['listingsFeatures'].'</span></a>';
	echo '</li>';
	echo '<li>';
	echo '<a href="#realRssSettings"><span>RSS Settings</span></a>';
	echo '</li>';
	echo '<li>';
	echo '<a href="#realFieldSettings"><span>Field Settings</span></a>';
	echo '</li>';

	/*
	echo '<li>';
	echo '<a href="#realCountrySetting"><span>Country Settings</span></a>';
	echo '</li>';	
	*/
	echo '<li>';
	echo '<a href="#realappearance"  onclick="reAppearance()"><span>Appearance</span></a>';
	//echo '<a href="#realappearance" ><span>Appearance</span></a>';
	echo '</li>';	

		/*	
	echo '<li>';
	echo '<a href="#realFeatureGallery"><span>Feature Gallery</span></a>';
	echo '</li>';

	echo '<li>';
	echo '<a href="#realCurrencySetting"><span>Currency Converter</span></a>';
	echo '</li>';	

	echo '<li>';
	echo '<a href="#realXMLImport"><span>XML Import</span></a>';
	echo '</li>';
	echo '</ul>';
//	*/
	echo '</div>';
	
	echo '<div style="clear:both;"></div>';

	echo '<div id="realFeatures">';
	realListingFeatures();
	echo "</div>";
	
	echo '<div id="realRssSettings">';
	realRssSettings();
	echo "</div>";

	echo '<div id="realFieldSettings">';
	realFieldSettings();
	echo "</div>";

	/*
	echo '<div id ="realCountrySetting">';
	realCountrySettings();
	echo '</div>';
	*/

	//echo '<div id="realAppearance">';
	echo "<div id='realappearance'>";
	realAppearance();
	echo "</div>";
	/*	
	echo '<div id="realFeatureGallery">';
	realGallery();
	echo "</div>";	


	echo '<div id="realXMLImport">';
	realListingFeeds();
	echo "</div>";		
	
	echo '<div id="realCurrencySetting">';
	realCurrencyShow();
	echo "</div>";
	*/
	echo '</div>'; //realTab
}

/*******************************************************/
/*** function realCurrencyShow version 1.0  ************/
/*** config the Currency Converter in admin area   *****/
/*******************************************************/

function realCurrencyShow()
{
	global $m_allLanguage;
	if (!(function_exists('currency_table_check_schedule')))
	{
		echo "<br />";
		echo "Please <a href='http://wordpress.org/extend/plugins/fx-currencyconverter-plugin-for-wordpress/' target='_blank'> download the currency converter plugin </a>" ;
		echo "<br />";
		echo "Please <a href='http://wordpress.org/extend/plugins/fx-currency-tables/' target='_blank'> download the currency table plugin </a>" ;
		return;
	}
	if (isset($_POST['CLSD']))
	{
		update_option('real_currencies_default',$_POST['CLSD']);
	}
	$options = get_option('ZDGlobalCurrencyConverter_options');
	$zplugin_info = array('name'=>'FX-CurrencyConverter Plugin for Wordpress',
						 'version'=>'1.0',
						 'date'=>'2009-05-25',
						 'pluginhome'=>'http://www.proloy.me/projects/wordpress-plugins/fx-currencyconverter-plugin-for-wordpress/',
						 'authorhome'=>'http://www.proloy.me/',
						 'rateplugin'=>'http://wordpress.org/extend/plugins/fx-currencyconverter-plugin-for-wordpress/',
						 'support'=>'mailto:support@proloy.me',
						 'more'=>'http://www.proloy.me/projects/wordpress-plugins/');	
	$imgpath = get_option('siteurl').'/wp-content/plugins/fx-currencyconverter-plugin-for-wordpress/images/';
?>
<div class="wrap">
	<h2><?php echo $zplugin_info['name']; ?></h2>
    
    <div id="poststuff">
  	
    <!--Admin Page Right Column //start-->
    <div class="inner-sidebar" id="side-infomation">
		<div style="position: relative;" id="side-sortables" class="meta-box-sortables ui-sortable">
        
        <!--Information Box //start-->
        <div id="sm_pnres" class="postbox">
			<h3 class="hndle"><span>Information:</span></h3>
			<div class="inside">
                <ul>
                	<li><strong>Version:&nbsp;</strong><?php echo $zplugin_info['version']; ?></li>
                    <li><strong>Release Date:&nbsp;</strong><?php echo $zplugin_info['date']; ?></li>
                    <li><a href="<?php echo $zplugin_info['pluginhome']; ?>" target="_blank">Plugin Homepage</a></li>
                    <li><a href="<?php echo $zplugin_info['rateplugin']; ?>" target="_blank">Rate this plugin</a></li>
                    <li><a href="<?php echo $zplugin_info['support']; ?>">Support and Help</a></li>
                    <li><a href="<?php echo $zplugin_info['authorhome']; ?>" target="_blank">Author Homepage</a></li>
                    <li><a href="<?php echo $zplugin_info['more']; ?>" target="_blank">More WordPress Plugins</a></li>
                </ul>
			</div>
        </div>        
        <!--Information Box //end-->
       
        <!--Follow me on Box //start-->
        <div id="sm_pnres" class="postbox">
			<h3 class="hndle"><span>Follow me on:</span></h3>
			<div class="inside">
                <ul class="zdinfo">
                    <li class="fb"><a href="http://www.facebook.com/people/Proloy-Chakroborty/1424058392" title="Follow me on Facebook" target="_blank">Facebook</a></li>
                    <li class="ms"><a href="http://www.myspace.com/proloy" title="Follow me on MySpace" target="_blank">MySpace</a></li>
                    <li class="tw"><a href="http://twitter.com/proloyc" title="Follow me on Twitter" target="_blank">Twitter</a></li>
                    <li class="lin"><a href="http://www.linkedin.com/in/proloy" title="Follow me on LinkedIn" target="_blank">LinkedIn</a></li>
                    <li class="plx"><a href="http://proloy.myplaxo.com/" title="Follow me on Plaxo" target="_blank">Plaxo</a></li>
                </ul>
			</div>
        </div>
        <!--Follow me on Box //end-->
        
        <!--Donate Box //start-->
		<div id="sm_pnres" class="postbox">
			<h3 class="hndle"><span>Advance Services:</span></h3>
			<div class="inside">
                <ul>
                  <li><a href="http://www.proloy.me/services/wordpress/wordpress-themes/" title="Get Custom Wordpress Themes" target="_blank">Get a Custom Wordpress Theme</a></li>
                </ul>
		  </div>
        </div>
        <!--Donate Box //end-->
        
        <!--Donate Box //start-->
		<div id="sm_pnres" class="postbox">
			<h3 class="hndle"><span>Donate:</span></h3>
			<div class="inside">
                <p>Please support me by donating as such as you can, so that I get motivation to develop this plugin and more plugins.</p>
                <p align="center"><a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=5675100" target="_blank"><img src="<?php echo $imgpath ?>paypal.gif" alt="Donate to Support Me" /></a></p>
			</div>
        </div>
        <!--Donate Box //end-->
      </div>
    </div>    
    <!--Admin Page Right Column //end-->
    
    <!--Admin Page Left Column //start-->    
	<div class="has-sidebar sm-padded">
		<div id="post-body-content" class="has-sidebar-content">
			<div class="meta-box-sortabless">
          		<form action="<?php echo 'options-general.php?page=zdg-currency-conterver.php'; ?>" method="post" name="ZDGlobalCurrencyConverter" id="ZDGlobalCurrencyConverter">
				<input type="hidden" name="submitted" value="1" />
				<?php wp_nonce_field('zdgcc-nonce'); ?>
				<!--Widget Options //start-->
				<div id="sm_rebuild" class="postbox">
					<h3 class="hndle"><span>Options:</span></h3>
              		<div class="inside">
						<p><strong>Set default Options for the Currency Converter</strong></p>
                        <ul>
                        	<li><label for="zplayer">Landing Page Option:&nbsp;
                            <select id="landingpageoption" name="landingpageoption">
                            	<?php if($options['landingpageoption'] == "link") { ?>
                            	<option value="link" selected="selected">With a link to Foreign Exchange</option>
                                <?php } else { ?>
                                <option value="link">With a link to Foreign Exchange</option>
                                <?php } ?>
                                
                                <?php if($options['landingpageoption'] == "branded") { ?>
                                <option value="branded" selected="selected">Branded with a capture details</option>
                                <?php } else { ?>
                                <option value="branded">Branded with a capture details</option>
                                <?php } ?>
                            </select>
                            </label></li>
                            <li><label for="ztheme">Referral Code:&nbsp;
                            <input type="text" name="referralcode" id="referralcode" style="width:100px;" value="<?php echo $options['referralcode']; ?>" />
                            </label></li>
                        </ul>
                        <p class="submit">
        					<input type="button" name="updtlst" id="updtlst" value="Sign-up for referral code" onclick="window.open('<?php echo $options['referralurl']; ?>', '_blank');" />
      					</p>
              		</div>
            	</div>
            	<!--Widget Options //end-->
				
                <!--Widget CSS //start-->
                <div id="sm_rebuild" class="postbox">
					<h3 class="hndle"><span>Widget CSS:</span></h3>
              		<div class="inside">
						<p><strong>Widget CSS for both Sidegar and Shortcode</strong></p>
                        <textarea id="widgetcss" name="widgetcss" cols="5" rows="5" style="width:100%; height:250px"><?php echo $options['widgetcss']; ?></textarea>
              		</div>
            	</div>
                <!--Widget CSS //emd-->
                
      			<div class="submit">
      				<input type="hidden" id="rp_hiddenAdmin" name="rp_hiddenAdmin" value="YES">;
        			<input type="submit" name="Submit" value="Update Options" />
      			</div>
    			</form>
                
   
          	</div>
        	</div>
		</div>
    <!--Admin Page Left Column //end-->
  </div>
</div>
<?php	
	echo "<br />";
	echo "<hr />";
	echo "<br />";

	//print currency_table_show();
	//currency_table_options_page();
	
  global $wpdb;

  if (!current_user_can('manage_options'))
    wp_die(__('Sorry, but you have no permissions to change settings.'));

  $table_name = $wpdb->prefix . 'currency_table';
  $query = 'UPDATE `' . $table_name . '` SET `old_cur1` = `cur1`';

  $wpdb->query($query);

  // save data
  if ( isset($_POST['currency_table_save']) ) {

    //Array ( [CLS1] => [CLS2] => [CLS3] => [CLS4] => [CLS5] => [CLS6] => [currency_table_save] => Save Changes )
    	
    //print_r($_POST);

    $query = 'UPDATE `' . $table_name . '` SET `cur1` = \'\'';

    $wpdb->query($query);

    for ($i = 1; $i - 7 < 0; $i++) {

      $name = 'CLS' . $i;

      //print $name . ' :: ';

      if (strlen($_POST[$name]) == 0) {

        break;
      }

      $cur = $_POST[$name];

      //print $cur . ' :!: ';

      if (strlen($cur) - 3 == 0) {

        $query = 'UPDATE `' . $table_name . '` SET `cur1` = \'' . $cur . '\' WHERE `id` = ' . $i;

        $wpdb->query($query);
      }
    }

    //
    // Delete some old rartes
    //
    $query = 'UPDATE `' . $table_name . '` SET `old_rate` = 0 WHERE `old_cur1` <> `cur1`';

    $wpdb->query($query);
  }
  else {

  }

  //
  // Check cron. May be it failed.
  //
  currency_table_check_schedule(1);

  // show page

  ?>

<div class="wrap">
  

  <?php

$myjson = real_get_json(CURRENCYTABLEJSONURL);
/*
if (empty($myjson))
{
	echo "<br />";
	echo "sorry, we can not get connect the data source of currency.";
	return;
	//exit;
}
*/
$query = 'SELECT `cur1`, `old_cur1`, `old_rate`, `new_rate`, `cron_update` FROM `' . $table_name . '` ORDER BY id';

//print $query; exit;

$curs = $wpdb->get_results($query);

$currencies_selected_list    = array();
$currencies_rates_list       = array();
$currencies_old_rates_list   = array();
$currencies_cron_update_list = array();

if ($curs) {
  foreach($curs as $cur) {

    $currencies_selected_list[]    = $cur->cur1;
    $currencies_rates_list[]       = $cur->new_rate;
    $currencies_old_rates_list[]   = $cur->old_rate;
    $currencies_cron_update_list[] = $cur->cron_update;
  }
}

// {"AED":"5.1282051282051277","ALL":"133.33333333333334","ANG":"2.478929102627665","

if (preg_match_all("/(\"([A-Z]{3})\"\:\"([0-9\.]+)\")/", $myjson, $matches)) {

  //print_r($matches);
  //print_r($matches[3]);

  $currencies = $matches[2];

  $rates = $matches[3];
  
  $currencies_default_list = '<option value="">Not selected</option>';
  $currencies_list1 = '<option value="">Not selected</option>';
  $currencies_list2 = '<option value="">Not selected</option>';
  $currencies_list3 = '<option value="">Not selected</option>';
  $currencies_list4 = '<option value="">Not selected</option>';
  $currencies_list5 = '<option value="">Not selected</option>';
  $currencies_list6 = '<option value="">Not selected</option>';

  for ($j = 0; $j - count($currencies) < 0; $j++) {

    $val = $currencies[$j];
    $rate = $rates[$j];

    for ($i = 1; $i - 7 < 0; $i++) {

      if ($currencies_selected_list[$i - 1] == $val) {

        $currencies_rates_list[$i - 1] = $rate;

        $query = 'UPDATE `' . $table_name . '` SET `new_rate` = \'' . $rate . '\' WHERE `id` = ' . $i;

        $wpdb->query($query);
      }
    }
  }

  //
  // Prepare Select lists
  //
  
  $old_currencies_default_list = get_option('real_currencies_default');
  //var_dump($old_currencies_default_list);
  
  foreach ($currencies as $val) {

    $currencies_default_list .= '<option vlaue="' . $val . '"';
    
    if ($old_currencies_default_list == $val) {
	
      $currencies_default_list .= ' selected="selected"';
    }
    
    $currencies_default_list .= '>' . $val . '</option>' . "\n";
  }
    
  foreach ($currencies as $val) {

    $currencies_list1 .= '<option vlaue="' . $val . '"';
    
    if ($currencies_selected_list[0] == $val) {
	
      $currencies_list1 .= ' selected="selected"';
    }
    
    $currencies_list1 .= '>' . $val . '</option>' . "\n";
  }
  foreach ($currencies as $val) {

    $currencies_list2 .= '<option vlaue="' . $val . '"';
    
    if ($currencies_selected_list[1] == $val) {

      $currencies_list2 .= ' selected="selected"';
    }
    
    $currencies_list2 .= '>' . $val . '</option>' . "\n";
  }
  foreach ($currencies as $val) {

    $currencies_list3 .= '<option vlaue="' . $val . '"';

    if ($currencies_selected_list[2] == $val) {

      $currencies_list3 .= ' selected="selected"';
    }
    
    $currencies_list3 .= '>' . $val . '</option>' . "\n";
  }
  foreach ($currencies as $val) {

    $currencies_list4 .= '<option vlaue="' . $val . '"';
    
    if ($currencies_selected_list[3] == $val) {

      $currencies_list4 .= ' selected="selected"';
    }
    
    $currencies_list4 .= '>' . $val . '</option>' . "\n";
  }
  foreach ($currencies as $val) {

    $currencies_list5 .= '<option vlaue="' . $val . '"';
    
    if ($currencies_selected_list[4] == $val) {

      $currencies_list5 .= ' selected="selected"';
    }
    
    $currencies_list5 .= '>' . $val . '</option>' . "\n";
  }
  foreach ($currencies as $val) {

    $currencies_list6 .= '<option vlaue="' . $val . '"';
    
    if ($currencies_selected_list[5] == $val) {

      $currencies_list6 .= ' selected="selected"';
    }
    
    $currencies_list6 .= '>' . $val . '</option>' . "\n";
  }

  // 0000-00-00 00:00:00
  
	echo "<H2><I>Currencies to use </I></H2>";
	echo '<form action="" method="post">';
	echo "Select Default ";
	echo "&nbsp;&nbsp;";
	echo '<select name="CLSD">';
	echo "$currencies_default_list";
	echo '</select>';
	echo "&nbsp;&nbsp;";
	echo '<input type="hidden" id="rp_hiddenAdmin" name="rp_hiddenAdmin" value="YES">';
	echo '<input type="submit" name="submitDefaultC" id="submitDefaultC" value="Update">';
	echo '</form>';
	echo "<br />";
	echo "<br />";
  ?>
  <form action="options-general.php?page=currency-table" method="post">
  <input type="hidden" value="currency-table-submit" value="1" />
  Please, select up to 6 currencies<br/><br/>

  <table border="0">
  <tr>
  <td><b>Currency</b></td>
  <td style="width: 150px"><b>Rate<b></td>
  <td style="width: 150px"><b>Old Rate<b></td>
  <td style="width: 150px"><b>Rate updated<b></td>
  </tr>
  <tr>
  <td>
  <select name="CLS1">
  <?php print $currencies_list1; ?>
  </select>
  </td>
  <td>
  &nbsp;<?php print  realCurrency('1','new_rate');  //$currencies_rates_list[0]; ?>
  </td>
  <td>
  &nbsp;<?php print realCurrency('1','old_rate');  //$currencies_old_rates_list[0]; ?>
  </td>
  <td>
  &nbsp;<?php print realCurrency('1','cron_update');  //if ( $currencies_cron_update_list[0] == '0000-00-00 00:00:00' ) { print 'never'; } else { print $currencies_cron_update_list[0]; } ?>
  </td>
  </tr>
  <tr>
  <td>
  <select name="CLS2">
  <?php print $currencies_list2; ?>
  </select>
  </td>
  <td>
  &nbsp;<?php print realCurrency('2','new_rate'); //$currencies_rates_list[1]; ?>
  </td>
  <td>
  &nbsp;<?php print realCurrency('2','old_rate'); ?>
  </td>
  <td>
  &nbsp;<?php print   realCurrency('2','cron_update'); //if ( $currencies_cron_update_list[1] == '0000-00-00 00:00:00' ) { print 'never'; } else { print $currencies_cron_update_list[1]; } ?>
  </td>
  </tr>
  <tr>
  <td>
  <select name="CLS3">
  <?php print $currencies_list3; ?>
  </select>
  </td>
  <td>
  &nbsp;<?php print  realCurrency('3','new_rate'); //print $currencies_rates_list[2]; ?>
  </td>
  <td>
  &nbsp;<?php  print  realCurrency('3','old_rate'); //print $currencies_old_rates_list[2]; ?>
  </td>
  <td>
  &nbsp;<?php  print  realCurrency('3','cron_update'); // if ( $currencies_cron_update_list[2] == '0000-00-00 00:00:00' ) { print 'never'; } else { print $currencies_cron_update_list[2]; } ?>
  </td>
  </tr>
  <tr>
  <td>
  <select name="CLS4">
  <?php print $currencies_list4; ?>
  </select>
  </td>
  <td>
  &nbsp;<?php  print realCurrency('4','new_rate'); //print $currencies_rates_list[3]; ?>
  </td>
  <td>
  &nbsp;<?php  print realCurrency('4','old_rate'); //print $currencies_old_rates_list[3]; ?>
  </td>
  <td>
  &nbsp;<?php  print realCurrency('4','cron_update'); //if ( $currencies_cron_update_list[3] == '0000-00-00 00:00:00' ) { print 'never'; } else { print $currencies_cron_update_list[3]; } ?>
  </td>
  </tr>
  <tr>
  <td>
  <select name="CLS5">
  <?php print $currencies_list5; ?>
  </select>
  </td>
  <td>
  &nbsp;<?php  print realCurrency('5','new_rate'); //print $currencies_rates_list[4]; ?>
  </td>
  <td>
  &nbsp;<?php  print realCurrency('5','old_rate'); //print $currencies_old_rates_list[4]; ?>
  </td>
  <td>
  &nbsp;<?php  print realCurrency('5','cron_update'); //if ( $currencies_cron_update_list[4] == '0000-00-00 00:00:00' ) { print 'never'; } else { print $currencies_cron_update_list[4]; } ?>
  </td>
  </tr>
  <tr>
  <td>
  <select name="CLS6">
  <?php print $currencies_list6; ?>
  </select>
  </td>
  <td>
  &nbsp;<?php  print realCurrency('6','new_rate'); // print $currencies_rates_list[5]; ?>
  </td>
  <td>
  &nbsp;<?php  print realCurrency('6','old_rate'); //print $currencies_old_rates_list[5]; ?>
  </td>
  <td>
  &nbsp;<?php  print realCurrency('6','cron_update'); // if ( $currencies_cron_update_list[5] == '0000-00-00 00:00:00' ) { print 'never'; } else { print $currencies_cron_update_list[5]; } ?>
  </td>
  </tr>
  </table>
  <br/>

  <?php //print currency_table_show(); ?>
  
    <br/><br/>
    <p class="submit">
	  <input type="hidden" id="rp_hiddenAdmin" name="rp_hiddenAdmin" value="YES">;
      <input name="currency_table_save" class="button-primary" value="<?php _e('Save Changes'); ?>" type="submit" />
    </p>
    </form>
</div>

<?php
  }
	else 
	{
		echo "<br />";
		echo "can not get data yet";
		echo "<br />";
	}
}

/*******************************************************/
/*** function realGallery version 1.0       ************/
/*** used for config the gallery     in admin area *****/
/*******************************************************/

function realGallery()
{
	global $m_allLanguage;
	ob_start();
	//wp_safe_redirect("http://127.0.0.1/wp-admin/options-general.php?page=featured-content-gallery/options.php");
	//echo '<iframe src="http://127.0.0.1/wp-admin/options-general.php?page=featured-content-gallery/options.php" width="100%"></iframe>';
	
$options_page = get_option('siteurl') . '/wp-admin/admin.php?page=featured-content-gallery/options.php';
$location = $options_page; // Form Action URI
/* 
<form method="post" action="<?php echo $options_page ?>"><?php wp_nonce_field('update-options'); ?>
 
*/
?>

<div class="wrap">
	<h2>Featured Content Gallery Configuration</h2>
	<p>Use the options below to select the content for your gallery, to style your gallery, and to configure the gallery slides and transitions.<br /> 
    Visit the <a href="http://www.featuredcontentgallery.com">Featured Content Gallery Plugin</a> website for more information.</p>
	<form method="post" action="options.php"><?php wp_nonce_field('update-options'); ?>        
		<fieldset name="general_options" class="options">
        <div style="padding-top: 15px"></div>
        <u><strong>Featured Content Gallery Code</strong></u> - If not already included, add this code to your template file where you want the Featured Content Gallery to be displayed:<br />
        <blockquote>&lt;&#63;php include &#40;ABSPATH &#46; '/wp-content/plugins/featured-content-gallery/gallery.php'&#41;&#59; &#63;&#62;</blockquote>
        <div style="padding-top: 10px"></div>
        <?php  $galleryoldway = (get_option('gallery-way') == 'old' || get_option('gallery-way') == '') ? "checked" : ""; 
        		   $gallerynewway = get_option('gallery-way') == 'new' ? "checked" : ""; 
        ?>
        <u><strong>Featured Content Selection</strong></u> - Select either a blog category or individual post/page IDs for your featured content:<br />
        <div style="padding-top: 5px"></div>
        <table width="690" border="0" cellpadding="0" cellspacing="7">
        <tr>
    	<td width="330">
        <input type="radio" name="gallery-way" id="gallery-way" size="25" value="old"  <?php print $galleryoldway; ?>>
        			Select here to use category selection
        </td>
  		<td width="360">
        <input type="radio" name="gallery-way" id="gallery-way" size="25" value="new"  <?php print $gallerynewway; ?>>
        			Select here to use individual post or page IDs
        </td>
		</tr>
  	    <tr>
    	<td>
        Category Name:<br />
                    <input name="gallery-category" id="gallery-category" size="25" value="<?php echo get_option('gallery-category'); ?>"></input> 
        </td>
    	<td>
        Post or Page IDs <span class="style1">(comma separated no spaces)</span>:<br />
                    <input name="gallery-items-pages" id="gallery-items-pages" size="25" value="<?php echo get_option('gallery-items-pages'); ?>"></input>
        </td>
  	    </tr>
  	    <tr>
        <td>
        Number of Items to Display:<br />
        			<input name="gallery-items" id="gallery-items" size="25" value="<?php echo get_option('gallery-items'); ?>"></input> 
        </td>
        <td>
        <?php $checked3 = get_option('gallery-randomize-pages') ? "checked" : ""; ?>
                    <input type="checkbox" name="gallery-randomize-pages" id="gallery-randomize-pages" <?php print $checked3 ?>> 
        Check here to randomize post/page ID display
        </td>
  	    </tr>
		</table>
        <div style="padding-top: 10px"></div>
        <u><strong>Gallery Style</strong></u> - Choose your gallery size and colors:<br />
        <div style="padding-top: 10px"></div>
        <table width="690" border="0" cellpadding="0" cellspacing="7">
        <tr>
    	<td width="330">
        Gallery Width in Pixels:<br />
        <input name="gallery-width" id="gallery-width" size="25" value="<?php echo get_option('gallery-width'); ?>"></input>
        </td>
  		<td width="360">
        Gallery Border Color (#hex or color name):<br />
        <input name="gallery-border-color" id="gallery-border-color" size="25" value="<?php echo get_option('gallery-border-color'); ?>"></input> 
        </td>
		</tr>
  	    <tr>
    	<td>
        Gallery Height in Pixels:<br />
        <input name="gallery-height" id="gallery-height" size="25" value="<?php echo get_option('gallery-height'); ?>"></input>
        </td>
    	<td>
        Gallery Background Color (#hex or color name):<br />
        <input name="gallery-bg-color" id="gallery-bg-color" size="25" value="<?php echo get_option('gallery-bg-color'); ?>"></input>   
        </td>
  	    </tr>
  	    <tr>
        <td>
        Text Overlay Height in Pixels:<br />
        <input name="gallery-info" id="gallery-info" size="25" value="<?php echo get_option('gallery-info'); ?>"></input> 
        </td>
        <td>
        Gallery Text Color (#hex or color name):<br />
        <input name="gallery-text-color" id="gallery-text-color" size="25" value="<?php echo get_option('gallery-text-color'); ?>"></input> 
        </td>
  	    </tr>
		</table>
        <div style="padding-top: 10px"></div>
        <u><strong>Slide Transition Times and Other Options</strong></u> - Choose your slide and fade duration, carousel button name and text overlay word quantity:<br />
        <div style="padding-top: 10px"></div>
        <table width="690" border="0" cellpadding="0" cellspacing="10">
        <tr>
    	<td width="330">
        Slide Display Duration (milliseconds):<br />
        <input name="gallery-delay" id="gallery-delay" size="25" value="<?php echo get_option('gallery-delay'); ?>"></input><br />
        (Default: 9000 milliseconds / 9 seconds)
        </td>
  		<td width="360">
        Carousel Button Name:<br />
        <input name="gallery-fcg-button" id="gallery-fcg-button" size="25" value="<?php echo get_option('gallery-fcg-button'); ?>"></input><br />
        (Default: "Featured Content")
        </td>
		</tr>
  	    <tr>
    	<td>
        Slide Fade Duration (milliseconds):<br />
        <input name="gallery-fade-duration" id="gallery-fade-duration" size="25" value="<?php echo get_option('gallery-fade-duration'); ?>"></input><br />
        (Default: 500 milliseconds / .5 seconds)
        </td>
    	<td>
        Number of Words in Text Overlay:<br />
        <input name="gallery-rss-word-quantity" id="gallery-rss-word-quantity" size="25" value="<?php echo get_option('gallery-rss-word-quantity'); ?>"></input><br />
        (Default: 100 words)
        </td>
  	    </tr>
		</table>
        <div style="padding-top: 10px"></div>
        <u><strong>Slide Transition Type</strong></u> - Choose your slide transition effect:<br />
        <div style="padding-top: 10px"></div>
        <?php  $galleryfade = (get_option('gallery-default-transaction') == 'fade' || get_option('gallery-default-transaction') == '') ? "checked" : ""; 
        	   $galleryfadeslideleft = get_option('gallery-default-transaction') == 'fadeslideleft' ? "checked" : "";
        	   $gallerycontinuoushorizontal = get_option('gallery-default-transaction') == 'continuoushorizontal' ? "checked" : "";  
        	   $gallerycontinuousvertical = get_option('gallery-default-transaction') == 'continuousvertical' ? "checked" : ""; 
        ?>
        <table width="500" border="0" cellpadding="0" cellspacing="10">
        <tr>
    	<td width="250">
        <input type="radio" name="gallery-default-transaction" id="gallery-default-transaction" size="25" value="fade"  <?php print $galleryfade; ?>> Simple Fade
        </td>
  		<td width="250">
		<input type="radio" name="gallery-default-transaction" id="gallery-default-transaction" size="25" value="fadeslideleft"  <?php print $galleryfadeslideleft; ?>> Slide Left with Fade
        </td>
		</tr>
  	    <tr>
    	<td>
		<input type="radio" name="gallery-default-transaction" id="gallery-default-transaction" size="25" value="continuoushorizontal"  <?php print $gallerycontinuoushorizontal; ?>> Continuous Horizontal
        </td>
    	<td>
		<input type="radio" name="gallery-default-transaction" id="gallery-default-transaction" size="25" value="continuousvertical"  <?php print $gallerycontinuousvertical; ?>> Continuous Vertical
        </td>
  	    </tr>
		</table>
        <div style="padding-top: 10px"></div>
        <u><strong>Required Custom Fields</strong></u>
        <div style="padding-top: 5px"></div>
        For each post or page you want to display in your gallery, regardless of your selections above, you <strong>must</strong> include a custom field. For the main gallery image, use the key <strong>articleimg</strong> and the full url of your image in the value. You <strong>must</strong> have at least two (2) items featured for the gallery to work.
        <div style="padding-top: 10px"></div>
        <u><strong>Advanced Custom Fields</strong></u>
        <div style="padding-top: 5px"></div>
		<?php $checked1 = get_option('gallery-use-featured-content') ? "checked" : ""; ?>
        <input type="checkbox" name="gallery-use-featured-content" id="gallery-use-featured-content" <?php print $checked1 ?>> 
        Check here if you want to use custom text under the post/page title.<br />
        Key: <strong>featuredtext</strong> - Insert custom text in the value. HTML is allowed.
        <div style="padding-top: 10px"></div>
        <?php $checked2 = get_option('gallery-use-thumb-image') ? "checked" : ""; ?>
        <input type="checkbox" name="gallery-use-thumb-image" id="gallery-use-thumb-image" <?php print $checked2 ?>> 
        Check here if you want to use a custom thumbnail image in your gallery.<br />
        Key: <strong>thumbnailimg</strong> - Insert the url of the image in the value.
        <div style="padding-top: 5px"></div>
		You can also add alt text to your gallery images with a custom field.<br />
        Key: <strong>alttext</strong> - Insert the alt text in the value.
        <div style="padding-top: 15px"></div>
        For more information, please visit the <a href="http://www.featuredcontentgallery.com/install-setup">Featured Content Gallery Install & Setup</a> page.
                        
        <input type="hidden" name="action" value="update" />
        <input type="hidden" name="page_options" value="gallery-width,gallery-height,gallery-info,gallery-items,gallery-border-color,gallery-bg-color,gallery-text-color,gallery-use-featured-content,gallery-use-thumb-image,gallery-way,gallery-items-pages,gallery-category,gallery-fcg-button,gallery-fade-duration,gallery-delay,gallery-randomize-pages,gallery-rss-word-quantity,gallery-default-transaction" />

		</fieldset>
		<input type="hidden" id="rp_hiddenAdmin" name="rp_hiddenAdmin" value="YES">;
		<p class="submit"><input type="submit" name="Submit" value="<?php _e('Update Options') ?>" /></p>
        <p><em>Featured Content Gallery WordPress Plugin v3.2.0 by <a href="http://www.ieplexus.com">iePlexus</a></em></p>
	</form>      
</div>
<?php	
}

/*******************************************************/
/*** function realAppearance version 1.0    ************/
/*** used for Set listing Appearance in admin area *****/
/*******************************************************/

function realAppearance()
{
	global $m_allLanguage,$wpdb,$table_prefix,$wp_version,$userdata,$current_user, $user_ID,$post,$wp_rewrite;
	get_currentuserinfo();
	
	if (!(empty($_POST['submitrealorder'])))
	{
		$m_orderArray = array();
		$m_newOrder = $_POST['realorder'];

		if (!(empty($m_newOrder)))
		{
			$m_newOrder = str_replace('realpress[]=','',$m_newOrder);
			if (strpos($m_newOrder,'&') === false )
			{
				$m_orderArray[0] = $m_newOrder;
			}
			else 
			{
				$m_orderArray = split('&',$m_newOrder);
			}
			update_option('real_vorder',$m_orderArray);
		}
		if (!empty($_POST['leftside']))
		{
			update_option('real_horder',$_POST['leftside']);
		}
		update_option('real_titlefont',$_POST['titlefont']);
		update_option('real_titlefontsize',$_POST['titlefontsize']);
		update_option('real_featuresfont',$_POST['featuresfont']);
		update_option('real_titlefontcolor',$_POST['titlefontcolor']);
		update_option('real_featuresfontcolor',$_POST['featuresfontcolor']);
		update_option('real_pricefont',$_POST['pricefont']);
		update_option('real_address',$_POST['address']);
		update_option('real_linkcolor',$_POST['linkcolor']);
		update_option('realpressTheme',$_POST['realThemeChoice']);

		realCheckCustomCss();
		$m_sendmessage = $m_allLanguage['Listing Appearance Saved'];
		realMessage("$m_sendmessage");
	}
	
	$m_real_titlefont =	get_option('real_titlefont');
	$m_real_titlefontsize = get_option('real_titlefontsize');
	$m_real_featuresfont = get_option('real_featuresfont');
	$m_real_titlefontcolor = get_option('real_titlefontcolor');
	$m_real_featuresfontcolor = get_option('real_featuresfontcolor');
	$m_real_pricefont = get_option('real_pricefont');
	$m_real_address = get_option('real_address');
	$m_real_linkcolor = get_option('real_linkcolor');
			
	echo "<div id='appearance'>";
	echo '<form method="POST" id="realFormOrder" name="realFormOrder" action="#realappearance">';	
	echo "<h2>".$m_allLanguage['Listing Appearance']."</h2>";
		echo "<div id='listleft'>";
		echo "<h3>".$m_allLanguage['Layout']."</h3>";
		echo "</div>";
		
		echo "<div id='listmiddle'>";
		echo $m_allLanguage['Drag and drop sections in to your listing'];
		echo "<ul>";
		echo "<li id='realpress_1'>";
		echo "<p>".$m_allLanguage['Image Gallery']."</p>";
		echo "</li>";
		echo "<li id='realpress_2'>";
		echo $m_allLanguage['Google maps'];
		echo "</li>";
			echo "<div id='realpress_3'>";
			echo "<li id='listdetail'>";
			echo $m_allLanguage['Listing details'];
			echo "</li>";
			echo "<li id='contact'>";
			echo $m_allLanguage['Contact'];
			echo "</li>";
			echo "</div>";
		echo "</ul>";
		echo "<table border='0' cellpadding='5' width='100%'>";
	
		echo "<tr height='30' align='left'>";
		echo "<td width='50%'>";
		echo $m_allLanguage['Title font'];
		echo "</td>";
		echo "<td>";
		echo "<select name='titlefont' style='width:100'>";
		realShowFont($m_real_titlefont,'Arial,sans-serif');
		realShowFont($m_real_titlefont,'Arial,Black');
		realShowFont($m_real_titlefont,'Arial,Bold');
		realShowFont($m_real_titlefont,'Arial,Bold Italic');
		realShowFont($m_real_titlefont,'Arial,Italic');
		realShowFont($m_real_titlefont,'Arial,Narrow');
		realShowFont($m_real_titlefont,'Arial,Narrow Bold');
		realShowFont($m_real_titlefont,'Arial,Narrow Bold Italic');
		realShowFont($m_real_titlefont,'Arial,Rounded MT Bold');
		realShowFont($m_real_titlefont,'Arial,Unicode MS');
		echo "</select>";
		echo "</td>";
		echo "</tr>";
	
		echo "<tr height='30' align='left'>";
		echo "<td width='50%'>";
		echo $m_allLanguage['Title font size'];
		echo "</td>";
		echo "<td>";
		if (empty($m_real_titlefontsize))
		{
			echo "<input type='text' name='titlefontsize' id='titlefontsize' size='18' value='36px'>";
		}
		else 
		{
			echo "<input type='text' name='titlefontsize' id='titlefontsize' size='18' value='$m_real_titlefontsize'>";
		}
		echo "</td>";
		echo "</tr>";
	
	
		echo "<tr>";
		echo "<td>";
		echo $m_allLanguage['Features font'];
		echo "</td>";
		echo "<td>";
		echo "<select name='featuresfont' style='width:100'>";
		realShowFont($m_real_featuresfont,'Arial,sans-serif');
		realShowFont($m_real_featuresfont,'Arial,Black');
		realShowFont($m_real_featuresfont,'Arial,Bold');
		realShowFont($m_real_featuresfont,'Arial,Bold Italic');
		realShowFont($m_real_featuresfont,'Arial,Italic');
		realShowFont($m_real_featuresfont,'Arial,Narrow');
		realShowFont($m_real_featuresfont,'Arial,Narrow Bold');
		realShowFont($m_real_featuresfont,'Arial,Narrow Bold Italic');
		realShowFont($m_real_featuresfont,'Arial,Rounded MT Bold');
		realShowFont($m_real_featuresfont,'Arial,Unicode MS');
		echo "</select>";
		echo "</td>";
		echo "</tr>";
	
		echo "<tr height='30' align='left'>";
		echo "<td width='50%'>";
		echo $m_allLanguage['Title font color'];
		echo "</td>";
		echo "<td>";
		if (empty($m_real_titlefontcolor))
		{
			echo "<input type='text' name='titlefontcolor' id='titlefontcolor' size='18' value='#ffffff'>";
		}
		else 
		{
			echo "<input type='text' name='titlefontcolor' id='titlefontcolor' size='18' value='$m_real_titlefontcolor'>";
		}
		echo "</td>";
		echo "</tr>";
		
		echo "<tr height='30' align='left'>";
		echo "<td width='50%'>";
		echo $m_allLanguage['Features font color'];
		echo "</td>";
		echo "<td>";
		if (empty($m_real_featuresfontcolor))
		{
			echo "<input type='text' name='featuresfontcolor' id='fontcolor' size='18' value='#c0c0c0'>";
		}
		else 
		{
			echo "<input type='text' name='featuresfontcolor' id='fontcolor' size='18' value='$m_real_featuresfontcolor'>";
		}
		echo "</td>";
		echo "</tr>";
		
		echo "<tr height='30' align='left'>";
		echo "<td width='50%'>";
		echo $m_allLanguage['Price Font size'];
		echo "</td>";
		echo "<td>";
		if (empty($m_real_pricefont))
		{
			echo "<input type='text' name='pricefont' id='pricefont' size='18' value='24px'>";
		}
		else 
		{
			echo "<input type='text' name='pricefont' id='pricefont' size='18' value='$m_real_pricefont'>";
		}
		echo "</td>";
		echo "</tr>";
		
		echo "<tr>";
		echo "<td>";
		echo $m_allLanguage['Property Address'];
		echo "</td>";
		echo "<td>";
		echo "<select name='address' style='width:100'>";
		if ($m_real_address == 'visible')
		{
			echo "<option selected>visible</option>";
		}
		else 
		{
			echo "<option>visible</option>";
		}
		
		if ($m_real_address == 'disable')
		{
			echo "<option selected>disable</option>";
		}
		else 
		{
			echo "<option>disable</option>";
		}
		echo "</td>";
		echo "</tr>";
		
		echo "<tr height='30' align='left'>";
		echo "<td width='50%'>";
		echo $m_allLanguage['Link color'];
		echo "</td>";
		echo "<td>";
		if (empty($m_real_linkcolor))
		{
			echo "<input type='text' name='linkcolor' id='linkcolor' size='18' value='#ffffff'>";
		}
		else 
		{
			echo "<input type='text' name='linkcolor' id='linkcolor' size='18' value='$m_real_linkcolor'>";
		}
		echo "</td>";
		echo "</tr>";

		echo '<a name="realThemeSelect"></a>';
		$m_result = realpressGetThemes();
		if (empty($m_result))
		{
			echo "<tr height='30' align='left'>";
			echo "<td width='50%'>";
			echo "No Theme Found";
			echo "</td>";
			echo "<td>";			
			echo "You can go <a href='". get_option('siteurl'). "/wp-admin/admin.php?page=".BASE_DIR."/themeManagement.php'>here</a>to create a new theme";
			echo "</td>";
			echo "</tr>";
		}
		else 
		{
			if (is_array($m_result) && (sizeof($m_result)>0))
			{
				echo "<tr height='30' align='left'>";
				echo "<td width='50%'>";				
				echo "Select Your Theme";
				echo "</td>";
				echo "<td>";							
				$m_hadSelectedTheme = get_option('realpressTheme');
				echo "<select id='realThemeChoice' name = 'realThemeChoice'>";
				foreach($m_result as $m_nowThemeLoop)
				{
					if ($m_hadSelectedTheme == $m_nowThemeLoop)
					{
						echo "<option id='realThemeChoiceOption' value='$m_nowThemeLoop' selected>$m_nowThemeLoop</option>";
					}
					else 
					{
						echo "<option id='realThemeChoiceOption' value='$m_nowThemeLoop'>$m_nowThemeLoop</option>";
					}
				}
				echo "</select>";
				echo "</td>";
				echo "</tr>";				
			}
			else 
			{
				echo "<tr height='30' align='left'>";
				echo "<td width='50%'>";
				echo "No Theme Found";
				echo "</td>";
				echo "<td>";			
				echo "You can go <a href='". get_option('siteurl'). "/wp-admin/admin.php?page=".BASE_DIR."/themeManagement.php'>here</a>to create a new theme";
				echo "</td>";
				echo "</tr>";
			}
		}

		echo "<tr>";
		echo "<td>";
		echo "<input type='button' id='featurebutton' value='".$m_allLanguage['Update Options']."' onclick='realSortSubmit();'>";
		echo "</td>";
		echo "</tr>";

		echo "</table>";
		echo "</div>"; //<!--end listmiddle-->
	
		echo "<div id='listright'>";
		echo "<ul id='listpage'>";
		echo $m_allLanguage['Your listing pages'];
		echo "</ul>";
		echo "<input type='text' id='imagehidden' name='imagehidden' value=0>";
		echo "<input type='text' id='googlehidden' name='googlehidden' value=0>";
		echo "<input type='text' id='detailshidden' name='detailshidden' value=0>";
		echo "<input type='text' id='contacthidden' name='contacthidden' value=0>";
		echo "<input type='text' id='totalhidden' name='totalhidden' value=0>";
		echo "<input type='text' id='hiddenrealpress_3' name='hiddenrealpress_3' value=0>";
		echo "<input type='text' id='leftside' name='leftside' value='none'>";
		echo "<input type='hidden' id='realorder' name='realorder' value=''>";
		echo "<input type='hidden' id='submitrealorder' name='submitrealorder' value='YES'>";
		echo '<input type="hidden" id="rp_hiddenAdmin" name="rp_hiddenAdmin" value="YES">';
		echo "</div>";
		echo "<div style='clear:both;'></div>";
	echo "</form>";
	echo "</div>";
	echo "<div style='clear:both;'></div>";
}
function realRssSettings()
{
  global $m_allLanguage;
  
  $DB_option="realpressRSS";
  
  $rss_options= array(
    "feed_title"=>array ("title"=>"Feed Title","type"=>"input"),
    "description"=>array ("title"=>"Description","type"=>"input"),
    "brokerage_name"=>array ("title"=>"Brokerage Name","type"=>"input"),
    "agent_name"=>array ("title"=>"Agent Name","type"=>"input"),
    "agent_phone"=>array ("title"=>"Agent Phone","type"=>"input"),
    "mls_name"=>array ("title"=>"MLS Name","type"=>"input"),
  );
  $rss_keys=array_keys($rss_options);
  
  if (isset($_POST[$rss_keys[0]]))
    update_option($DB_option, json_encode($_POST));
  
  $rss_values=realpressGetRSSOptions();
       
  echo '<form name="listfeature" method="post" action="#realRssSettings">';
	
// End get Listing Features
  echo "<h2>RSS Settings</h2>";
    //To use the custom listing feed templates, see the user guide. You'll need to activate Feed Wrangler to work with the custom RSS stylesheets supplied.
  
	echo '<table border="0" cellpadding="5" width="100%">';
  foreach ($rss_options as $k => $d)
  {
  ?>
			 <tr height="28">
				<td valign="top"  width="25%"><?=$d["title"];?></td>
				<td><input type="text" name="<?=$k;?>" id="<?=$k;?>" value="<?=$rss_values[$k]?>" size="70" /></td>
			</tr>
  <?  
  }
  


			

			echo '<tr>';
				echo '<td>';
					echo '<input type="hidden" id="rp_hiddenAdmin" name="rp_hiddenAdmin" value="YES">';
					echo '<input type="submit" id="featurebutton" value="'.$m_allLanguage['Save Changes'].'">';
				echo '</td>';
			echo '</tr>';
			
	echo '</table>';
  echo '</form>';

}
	
/**********************************************/
/*** function realGallerySetting version 1.0***/
/***     used for Set Gallery in admin area ***/
/**********************************************/
function realGallerySetting()
{

}


/**********************************************/
/*** function realListingFeeds   version 1.0***/
/***     used for Set Listing Feeds in admin***/
/**********************************************/
function realListingFeeds()
{
	global $m_allLanguage,$wpdb,$table_prefix,$wp_version,$userdata,$current_user, $user_ID,$post,$wp_rewrite;
	get_currentuserinfo();
	//begin deal with post methods
	
	if (!(empty($_POST['hiddenFeed'])))
	{
		$m_sendMessage = $m_allLanguage['Listing Feeds Saved'];
		realMessage($m_sendMessage);
	}
	if (!(empty($_POST['importFeed'])))
	{
		if (!(empty($_POST['kyeroFeed'])))
		{
			$m_kyeroFeed = $wpdb->escape($_POST['kyeroFeed']);
			update_option('kyeroFeed',$m_kyeroFeed);
		}
		
		if (!(empty($_POST['enormoFeed'])))
		{
			$m_enormoFeed = $wpdb->escape($_POST['enormoFeed']);
			update_option('enormoFeed',$m_enormoFeed);
		}
		
		if (!(empty($_POST['customFeed'])))
		{
			$m_customFeed = $wpdb->escape($_POST['customFeed']);
			update_option('customFeed',$m_customFeed);
		}
		realpressImportFeeds();	// now we can begin import feeds
	}
	
	// end deal with post methods
	// begin get options of Feeds
	$m_kyeroFeed = get_option('kyeroFeed');
	if (empty($m_kyeroFeed )) $m_kyeroFeed = '';
	$m_enormoFeed = get_option('enormoFeed');
	if (empty($m_enormoFeed)) $m_enormoFeed = '';
	$m_allCustomFeed = get_option('customFeed');
	if (empty($m_allCustomFeed)) $m_allCustomFeed = '';
	
	$m_realpress_ispro =  get_option( 'realpress_ispro');
	if ('NO' == $m_realpress_ispro)
	{
		$m_getRealPressPro = get_option( 'realProURL' );
		echo '<p>';
		echo $m_allLanguage['sorryXML'];
		echo "&nbsp;";
		echo "<a href='$m_getRealPressPro'> ".$m_allLanguage['Get RealPressPro']. " </a>";
		echo '</p>';
	}
	echo "<h2>Listing Feeds (RSS)</h2>";
	echo "<form name='listingFeeds' method='post' action=''>";
	echo "<p>";
	echo $m_allLanguage['createFeeds'];
	echo "</p>";
	echo "<table width='100%' border='0' cellspacing='1' cellpadding='4'>";
	echo "<tr>";
	echo "<td width='15%'>";
	echo $m_allLanguage['Kyero feed Url'];
	echo "</td>";
	echo "<td width='60%'>";
	echo "<input type='text' name='kyeroFeed' id='kyeroFeed' size='50%' value='$m_kyeroFeed'>";
	echo "</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td width='15%'>";
	echo $m_allLanguage['Enormo feed URL'];
	echo "</td>";
	echo "<td width='60%'>";
	echo "<input type='text' name='enormoFeed' id='enormoFeed' size='50%' value='$m_enormoFeed'>";
	echo "</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td width='15%'>";
	echo $m_allLanguage['Customs Feed Url'];
	echo "</td>";
	echo "<td width='60%'>";
	echo "<input type='text' name='customFeed' id='customFeed' size='50%' value='$m_allCustomFeed'>";
	echo "</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td>";
	echo "<br />";
	echo "<input type='hidden' id='hiddenFeed' name='hiddenFeed' value='YES'>";
	echo '<input type="hidden" id="rp_hiddenAdmin" name="rp_hiddenAdmin" value="YES">';
	echo "<input type='submit' name ='importFeed' id= 'importFeed' value=".$m_allLanguage['import'].">";
	echo "</td>";
	echo "</tr>";
	echo "</table>";
	echo "</form>";
}


/**********************************************/
/***function realFieldSettings   version 1.0***/
/***this is used for Field Settings in admin***/
/**********************************************/
function realCountrySettings()
{
	global $m_allLanguage,$wpdb,$table_prefix,$wp_version,$userdata,$current_user, $user_ID,$post,$wp_rewrite;
	get_currentuserinfo();
//begin deal with post method
	
	// begin search country
	if (!(empty($_POST['selectEditCountry'])))
	{
		if ($_POST['selectEditCountry'] != 'NOHERE')
		{
			$m_selectEditCountry = $wpdb->escape($_POST['selectEditCountry']);
			$m_selectRealCountry = get_option('realSearchCountries');
			if (empty($m_selectRealCountry))
			{
				$m_selectRealCountry = array();
			}
			$m_selectRealCountry[] = $m_selectEditCountry;
			update_option('realSearchCountries',$m_selectRealCountry);
		}
	}
	// end search country
	if (!empty($_POST['defaultCountry']))
	{
		if (!(empty($_POST['selectDefaultCountry'])))
		{
			//selectDefaultCountry
			if ($_POST['selectDefaultCountry'] != 'NOHERE')
			{
				$m_selectEditCountry = $wpdb->escape($_POST['selectDefaultCountry']);
				update_option('defaultCodeCountry',$m_selectEditCountry);
			}
		}
	}
	
	if (!(empty($_POST['hiddencountry'])))
	{
		$m_sendMessage = $m_allLanguage['Country Settings Saved'];
		realMessage($m_sendMessage);
	}
//end deal with post method


	//begin get search country
	$m_realSearchCountries = get_option('realSearchCountries');
	$m_showSearchCountries = '';
	if (empty($m_realSearchCountries))
	{
		$m_showSearchCountries = 'Sorry, no any country had been choiced for search yet!';
	}
	else 
	{
		foreach ($m_realSearchCountries as $m_realSearch)
		{
			$m_showSearchCountries .= "<p>&nbsp;&nbsp;".realCountryCodeToName($m_realSearch)."</p>";
		}
	}
	//end get search country
	$m_notice = $m_allLanguage['Please select country'];
	echo '<h2>'.$m_allLanguage['Country Settings'].'</h2>';
	echo '<table border="0" cellpadding="5" width="100%">';
	echo '<form name="countrysettings" method="post" action="">';
	echo '<input type = "hidden" id="hiddencountry" name="hiddencountry" value="YES">';
	echo '<tr height="28">';
	echo '<td valign="top">'.$m_allLanguage['Set Countries in Search'].'</td>';
	echo '<td>';
	echo '<table width="70%">';
	echo '<tr style="background: #fcfeec;width:150px;">';
	echo '<td width="50%">';
	echo $m_showSearchCountries;
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>';
	realGetCountry("selectEditCountry",$m_notice);
	echo '</td>';
	echo '</tr>';
	echo '</table>';
	echo '</td>';
	echo '</tr>';

	echo '<tr height="28">';
	echo '<td>'.$m_allLanguage['Use single country as default'].'</td>';
	echo '<td>';
	echo '<table width="100%">';
	echo '<tr>';
	echo '<td width="10%">';
	$m_defaultCountry = get_option("defaultCountry");
	$m_defaultCodeCountry = get_option("defaultCodeCountry");
	
	if ($m_defaultCountry == 'YES')
	{
		$m_defaultCountry ='<input type="checkbox" name="defaultCountry" value="YES" checked>';
	}
	else 
	{
		$m_defaultCountry ='<input type="checkbox" name="defaultCountry" value="YES">';
	}
	echo $m_defaultCountry;
	echo '</td>';
	echo '<td align="left">';
	
	if (!(empty($m_defaultCodeCountry)))
	{
		realGetCountry("selectDefaultCountry",$m_notice,$m_defaultCodeCountry);
	}
	else 
	{
		realGetCountry("selectDefaultCountry",$m_notice);
	}
	echo '</td>';
	echo '</tr>';
	echo '</table>';
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>';
	echo '<input type="hidden" id="rp_hiddenAdmin" name="rp_hiddenAdmin" value="YES">';
	echo '<input type="submit" name="countrysetbutton" value="'.$m_allLanguage['Save Changes'].'">';
	echo '</td>';
	echo '</tr>';
	echo '</form>';
	echo '</table>';
}

/**********************************************/
/***function realFieldSettings   version 1.0***/
/***this is used for Field Settings in admin***/
/**********************************************/
function realFieldSettings()
{
	global $m_allLanguage,$wpdb,$table_prefix,$wp_version,$userdata,$current_user, $user_ID,$post,$wp_rewrite;
	get_currentuserinfo();
// begin deal with post method	
	if (isset($_POST['hiddenfield']))
	{
		$m_sendMessage = $m_allLanguage['Field Settings Saved'];
		realMessage($m_sendMessage);
	
	// begin Property Feature Fields
		if (isset($_POST['featureBedrooms']))
		{
			update_option('featureBedrooms','YES');
		}
		else 
		{
			update_option('featureBedrooms','NO');
		}
	
		if (isset($_POST['featureBathrooms']))
		{
			update_option('featureBathrooms','YES');
		}
		else 
		{
			update_option('featureBathrooms','NO');
		}
	
		if (isset($_POST['featureGarage']))
		{
			update_option('featureGarage','YES');
		}
		else 
		{
			update_option('featureGarage','NO');
		}
		
		// end Property Feature Fields
		
		// begin deal add new property
		if (!(empty($_POST['addnewproperty'])))
		{
			$m_propertyTypes = get_option('realpropertyTypes');
			if (empty($m_propertyTypes))
			{
				$m_propertyTypes = array();
			}
			$m_propertyTypes[] = $wpdb->escape($_POST['addnewproperty']);
			update_option('realpropertyTypes',$m_propertyTypes);
		}
		// end deal add new property
	
		// begin deal add new type
		if (!(empty($_POST['addnewtype'])))
		{
			$m_listingTypes = get_option('realpresstypes');
			if (empty($m_listingTypes))
			{
				$m_listingTypes = array();
			}
			$m_listingTypes[] = $wpdb->escape($_POST['addnewtype']);
			update_option('realpresstypes',$m_listingTypes);
		}
		// end deal add new type

		// begin deal add new trade type
		if (!(empty($_POST['addnewtrade'])))
		{
			$m_soldTypes = get_option('realsaletypes');
			if (empty($m_soldTypes))
			{
				$m_soldTypes = array();
			}
			$m_soldTypes[] = $wpdb->escape($_POST['addnewtrade']);
			update_option('realsaletypes',$m_soldTypes);
		}
		// end deal add new trade type
	}
	
	

	if (isset($_POST['realpresspropertydelete']))
	{
		$m_deleteFeatureID = $wpdb->escape($_POST['realpresspropertydelete']);
		$m_waitDeleteFeatures = get_option('realpropertyTypes');
		if ((!(empty($m_waitDeleteFeatures))) && (count($m_waitDeleteFeatures)>0))
		{
			array_splice($m_waitDeleteFeatures,($m_deleteFeatureID-1),1);
		}
		update_option('realpropertyTypes',$m_waitDeleteFeatures);
		realMessage('This property types has been deleted !');
	}	
	
	if (isset($_POST['realpresslistingtydelete']))
	{
		$m_deleteFeatureID = $wpdb->escape($_POST['realpresslistingtydelete']);
		$m_waitDeleteFeatures = get_option('realpresstypes');
		if ((!(empty($m_waitDeleteFeatures))) && (count($m_waitDeleteFeatures)>0))
		{
			array_splice($m_waitDeleteFeatures,($m_deleteFeatureID-1),1);
		}
		update_option('realpresstypes',$m_waitDeleteFeatures);
		realMessage('This listing types has been deleted !');
	}

	if (isset($_POST['realpresssaledelete']))
	{
		$m_deleteFeatureID = $wpdb->escape($_POST['realpresssaledelete']);
		$m_waitDeleteFeatures = get_option('realsaletypes');
		if ((!(empty($m_waitDeleteFeatures))) && (count($m_waitDeleteFeatures)>0))
		{
			array_splice($m_waitDeleteFeatures,($m_deleteFeatureID-1),1);
		}
		update_option('realsaletypes',$m_waitDeleteFeatures);
		realMessage('This trade types has been deleted !');
	}



// end deal with post method


// bein get Property Types
/*
	$m_propertyTypes = get_option('realpropertyTypes');
	if ((!(empty($m_propertyTypes))) && (is_array($m_propertyTypes)))
	{
		$m_propertys = '';
		foreach ($m_propertyTypes as $m_temppropertyTypes)
		{
			$m_propertys .= "<p>&nbsp;&nbsp;$m_temppropertyTypes</p>";
		}
	}
*/
	$m_propertyTypes = get_option('realpropertyTypes');
	if ((!(empty($m_propertyTypes))) && (is_array($m_propertyTypes)))
	{
		$m_propertys = '';
		$m = 1;
		$m_realPluginURL = plugins_url();
		$m_realPluginURL .= "/".BASE_DIR;
		
		foreach ($m_propertyTypes as $m_temppropertyTypes)
		{
		?>
			<form method="POST" action="#realFieldSettings" id="realpropertydeleteform<?php echo $m;  ?>" name="realpropertydeleteform<?php echo $m;  ?>" action="">
			<input type="hidden" name="realpresspropertydelete" value="<?php echo $m; ?>">
			</form>
		<?php
			$m_propertys .= "<div><div style='float:left'>&nbsp;&nbsp;$m_temppropertyTypes</div>"
			."<div style='float:right;color:gray;font-style:italic;margin-right:6px;'>"
			."<a href='".$m_realPluginURL ."/propertyModify.php"."?featureID=$m&keepThis=true&TB_iframe=true&height=180&width=400' title='Edit feature ' class='thickbox'><i><font color='Gray'>Edit</font></i></a>"
			."&nbsp;&nbsp;"
			."<a href='#' onclick=\"document.forms['realpropertydeleteform$m'].submit()\"> <i><font color='Gray'>delete</font></i> </a>"
			."</div><div style='clear:both;'></div>";
			$m++;
		}
	}
	else 
	{
		$m_propertys = "<p>&nbsp;&nbsp;Sorry,no any property types found in here yet!</p>";
	}
// End get Property Types
/*
	$m_listingTempTypes = get_option('realpresstypes');
	if ((!(empty($m_listingTempTypes))) && (is_array($m_listingTempTypes)))
	{
		$m_listingTypes = '';
		foreach ($m_listingTempTypes as $m_temppropertyTypes)
		{
			$m_listingTypes .= "<p>&nbsp;&nbsp;$m_temppropertyTypes</p>";
		}
	}
*/
	$m_listingTempTypes = get_option('realpresstypes');
	if ((!(empty($m_listingTempTypes))) && (is_array($m_listingTempTypes)))
	{
		$m_listingTypes = '';
		$n = 1;
		$m_realPluginURL = plugins_url();
		$m_realPluginURL .= "/".BASE_DIR;
		
		foreach ($m_listingTempTypes as $m_tempListingTypes)
		{
		?>
			<form method="POST" action="#realFieldSettings" id="reallistingdeletetyform<?php echo $n;  ?>" name="reallistingdeletetyform<?php echo $n;  ?>" action="">
			<input type="hidden" name="realpresslistingtydelete" value="<?php echo $n; ?>">
			</form>
		<?php
			$m_listingTypes .= "<div><div style='float:left'>&nbsp;&nbsp;$m_tempListingTypes</div>"
			."<div style='float:right;color:gray;font-style:italic;margin-right:6px;'>"
			."<a href='".$m_realPluginURL ."/listingTypeModify.php"."?featureID=$n&keepThis=true&TB_iframe=true&height=180&width=400' title='Edit feature ' class='thickbox'><i><font color='Gray'>Edit</font></i></a>"
			."&nbsp;&nbsp;"
			."<a href='#' onclick=\"document.forms['reallistingdeletetyform$n'].submit()\"> <i><font color='Gray'>delete</font></i> </a>"
			."</div><div style='clear:both;'></div>";
			$n++;
		}
	}	
	else 
	{
		$m_listingTypes = "<p>&nbsp;&nbsp;Sorry,no any listing types found in here yet!</p>";
	}
	
// begin sale type
	$m_saleTempTypes = get_option('realsaletypes');
	if (empty($m_saleTempTypes))
	{
		$m_saleTempTypes = array();
	}
	if ((!(empty($m_saleTempTypes))) && (is_array($m_saleTempTypes)))
	{
		$m_soldTypes = '';
		$l = 1;
		$m_realPluginURL = plugins_url();
		$m_realPluginURL .= "/".BASE_DIR;
		
		foreach ($m_saleTempTypes as $m_tempSoldTypes)
		{
		?>
			<form method="POST" action="#realFieldSettings" id="reallistingsaleform<?php echo $l;  ?>" name="reallistingsaleform<?php echo $l;  ?>" action="">
			<input type="hidden" name="realpresssaledelete" value="<?php echo $l; ?>">
			</form>
		<?php
			$m_soldTypes .= "<div><div style='float:left'>&nbsp;&nbsp;$m_tempSoldTypes</div>"
			."<div style='float:right;color:gray;font-style:italic;margin-right:6px;'>"
			."<a href='".$m_realPluginURL ."/tradeModify.php"."?featureID=$l&keepThis=true&TB_iframe=true&height=180&width=400' title='Edit feature ' class='thickbox'><i><font color='Gray'>Edit</font></i></a>"
			."&nbsp;&nbsp;"
			."<a href='#' onclick=\"document.forms['reallistingsaleform$l'].submit()\"> <i><font color='Gray'>delete</font></i> </a>"
			."</div><div style='clear:both;'></div>";
			$l++;
		}
	}	
	else 
	{
		$m_soldTypes = "<p>&nbsp;&nbsp;Sorry,no any trade types found in here yet!</p>";
	}

// end sale type
// begin get property feature fields

	$m_propertyFeatureFields = '';
	$m_featureBedrooms = get_option('featureBedrooms');
	$m_featureBathrooms = get_option('featureBathrooms');
	$m_featureGarage = get_option('featureGarage');

	
	$m_propertyFeatureFields .='<table width="100%">';
	$m_propertyFeatureFields .='<tr>';
	$m_propertyFeatureFields .='<td width="10%">';
	if ($m_featureBedrooms == 'YES')
	{
		$m_propertyFeatureFields .='<input type="checkbox" name="featureBedrooms" value="YES" checked>';
	}
	else 
	{
		$m_propertyFeatureFields .='<input type="checkbox" name="featureBedrooms" value="YES">';
	}
	$m_propertyFeatureFields .='</td>';
	$m_propertyFeatureFields .='<td align="left">';
	$m_propertyFeatureFields .='Bedrooms';
	$m_propertyFeatureFields .='</td>';
	$m_propertyFeatureFields .='</tr>';
	$m_propertyFeatureFields .='<tr>';
	$m_propertyFeatureFields .='<td width="10%">';
	if ($m_featureBathrooms == 'YES')
	{
		$m_propertyFeatureFields .='<input type="checkbox" name="featureBathrooms" value="YES" checked>';
	}
	else 
	{
		$m_propertyFeatureFields .='<input type="checkbox" name="featureBathrooms" value="YES">';
	}
	$m_propertyFeatureFields .='</td>';
	$m_propertyFeatureFields .='<td align="left">';
	$m_propertyFeatureFields .='Bathrooms';
	$m_propertyFeatureFields .='</td>';
	$m_propertyFeatureFields .='</tr>';
	$m_propertyFeatureFields .='<tr>';
	$m_propertyFeatureFields .='<td width="10%">';
	if ($m_featureGarage == 'YES')
	{
		$m_propertyFeatureFields .='<input type="checkbox" name="featureGarage" value="YES" checked>';
	}
	else 
	{
		$m_propertyFeatureFields .='<input type="checkbox" name="featureGarage" value="YES">';
	}
	$m_propertyFeatureFields .='</td>';
	$m_propertyFeatureFields .='<td align="left">';
	$m_propertyFeatureFields .='Garage Spaces';
	$m_propertyFeatureFields .='</td>';
	$m_propertyFeatureFields .='</tr>';
	$m_propertyFeatureFields .='</table>';

// end get property feature fields

	echo "<h2>".$m_allLanguage['Field Settings']."</h2>";
	echo '<table border="0" cellpadding="5" width="100%">';
	echo '<form name="fieldsettings" method="post" action="#realFieldSettings">';
	echo '<input type = "hidden" id="hiddenfield" name="hiddenfield" value="YES">';
	// begin property
	echo '<tr height="28">';
	echo '<td valign="top">'.$m_allLanguage['Property Types'].'</td>';
	echo '<td>';
	echo '<table width="70%">';
	echo '<tr  style="background: #fcfeec;width:150px;">';
	echo '<td>';
	echo $m_propertys;
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '	<td>';
	echo '<input type="text" name="addnewproperty" id="addnewfield" size="18"> ';
	echo $m_allLanguage['addNewField'];
	echo '</td>';
	echo '</tr>	';
	echo '</table>';
	echo '</td>';
	echo '</tr>';
	// end property
	echo '<tr><td>&nbsp;</td></tr>';
	// begin types
	echo '<tr height="28">';
	echo '<td valign="top">'.$m_allLanguage['Listing Types'].'</td>';
	echo '<td>';
	echo '<table width="70%">';
	echo '<tr style="background: #fcfeec;width:150px;">';
	echo '<td >';
	echo $m_listingTypes;
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>';
	echo '<input type="text" name="addnewtype" id="addnewfield" size="18"> ';
	echo $m_allLanguage['addNewField'];
	echo '</td>';
	echo '</tr>	';
	echo '</table>';
	echo '</td>';
	echo '</tr>';
	echo '<tr><td>&nbsp;</td></tr>';
	// end types

	// begin trade
	echo '<tr height="28">';
	echo '<td valign="top">'.$m_allLanguage['Trade Types'].'</td>';
	echo '<td>';
	echo '<table width="70%">';
	echo '<tr  style="background: #fcfeec;width:150px;">';
	echo '<td>';
	echo $m_soldTypes;
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '	<td>';
	echo '<input type="text" name="addnewtrade" id="addnewfield" size="18"> ';
	echo $m_allLanguage['addNewField'];
	echo '</td>';
	echo '</tr>	';
	echo '</table>';
	echo '</td>';
	echo '</tr>';
	// end trade
	echo '<tr><td>&nbsp;</td></tr>';
	
	//	begin Property Feature Fields
	echo '<tr height="28">';
	echo '<td valign="top">'.$m_allLanguage['Property Feature Fields'].'</td>';
	echo '<td>';
	echo $m_propertyFeatureFields;
	echo '</td>';
	echo '</tr>';
	//	end Property Feature Fields
	
			echo '<tr>';
				echo '<td>';
					echo '<input type="hidden" id="rp_hiddenAdmin" name="rp_hiddenAdmin" value="YES">';
					echo '<input type="submit" name="fieldsetbutton" value="'.$m_allLanguage['Save Changes'].'">';
				echo '</td>';
			echo '</tr>';
			
		echo '</form>';
	echo '</table>	';
}

/**********************************************/
/***function realListingFeatures version 1.0***/
/***used to setting listing features in admin**/
/**********************************************/
function realListingFeatures()
{
	global $m_allLanguage,$wpdb,$table_prefix,$wp_version,$userdata,$current_user, $user_ID,$post,$wp_rewrite;
	get_currentuserinfo();
	$REW_options = array ("realLangguage"=>array(),"realCurrency"=>array());;
  $lang_array= array("en","es");	
  //$currency_array= array("$","€");	
  global $currency_arr;

	foreach ($REW_options as $k => $v)
	 {
      $REW_options[$k]["value"]=get_option($k);
//      var_dump("got from db",$REW_options[$k]["value"]);
   }
      	
// deal with submited post	method
	if(!empty($_POST['rp_hiddenAdmin']))
	{
	
    foreach ($REW_options as $k => $v)
    {
      $REW_options[$k]["value"]=get_option($k);
      if (isset($_POST[$k]))
      {

      
        $REW_options[$k]["value"]= $wpdb->escape($_POST[$k]);
			 update_option($k,$REW_options[$k]["value"]);
      }   
    }
/*       if (isset($_POST["realLangguage"]))
	  {
			$REW_options["realLangguage"]["value"]= $wpdb->escape($_POST['realLangguage']);
			update_option('realLangguage',$REW_options["realLangguage"]["value"]);
    }
*/       
	// list features
		if (!(empty($_POST['addnewfeature'])))
		{
			$m_listingFeatures = get_option('realpressFeatures');
			if (empty($m_listingFeatures))
			{
				$m_listingFeatures = array();
			}
			$m_listingFeatures[] = $wpdb->escape($_POST['addnewfeature']);
			update_option('realpressFeatures',$m_listingFeatures);
		}
	
		//main listing
		if (!(empty($_POST['mainlisting'])))
		{
			$m_mainListing = $wpdb->escape($_POST['mainlisting']);
			update_option('realmainlisting',$m_mainListing);
		}
	
		//list summary
		if (!(empty($_POST['listsummary'])))
		{
			$m_mainListing = $wpdb->escape($_POST['listsummary']);
			update_option('reallistsummary',$m_mainListing);
		}
		else
		{
			update_option('reallistsummary','NO');
		}
		//list page
		if (!(empty($_POST['listpage'])))
		{
			$m_listpage = $wpdb->escape($_POST['listpage']);
			update_option('reallistpage',$m_listpage);
		}	
		else 
		{
			update_option('reallistpage','NO');
		}
	
	//google map api key
		if (!(empty($_POST['googlekey'])))
		{
			$m_googlekey = $wpdb->escape($_POST['googlekey']);
			update_option('realgooglekey',$m_googlekey);
		}	

		//maximum listing
	
		if (!(empty($_POST['maximumlisting'])))
		{
			$m_maximumlisting = $wpdb->escape($_POST['maximumlisting']);
			update_option('realmaximumlisting',$m_maximumlisting);
			$m_sendMessage = $m_allLanguage['Listings Features Saved'];
			realMessage($m_sendMessage);
		}
	}
	if (isset($_POST['realpressfeaturedelete']))
	{
		$m_deleteFeatureID = $wpdb->escape($_POST['realpressfeaturedelete']);
		$m_waitDeleteFeatures = get_option('realpressFeatures');
		if ((!(empty($m_waitDeleteFeatures))) && (count($m_waitDeleteFeatures)>0))
		{
			array_splice($m_waitDeleteFeatures,($m_deleteFeatureID-1),1);
		}
		update_option('realpressFeatures',$m_waitDeleteFeatures);
		realMessage('This feature has been deleted !');
	}
// end deal with submited post	method

// get Listing Features
	$m_listingFeatures = get_option('realpressFeatures');
	if ((!(empty($m_listingFeatures))) && (is_array($m_listingFeatures)))
	{
		$m_features = '';
		$i = 1;
		$m_realPluginURL = plugins_url();
		$m_realPluginURL .= "/".BASE_DIR;
		
		foreach ($m_listingFeatures as $m_tempListingFeatures)
		{
			//$m_features .= "<p>&nbsp;&nbsp;$m_tempListingFeatures</p>";
		?>
			<form method="POST" id="realfeaturedeleteform<?php echo $i;  ?>" name="realfeaturedeleteform<?php echo $i;  ?>" action="">
			<input type="hidden" name="realpressfeaturedelete" value="<?php echo $i; ?>">
			</form>
		<?php
			$m_features .= "<div><div style='float:left'>&nbsp;&nbsp;$m_tempListingFeatures</div>"
			."<div style='float:right;color:gray;font-style:italic;margin-right:6px;'>"
			."<a href='".$m_realPluginURL ."/featureModify.php"."?featureID=$i&keepThis=true&TB_iframe=true&height=180&width=400' title='Edit feature ' class='thickbox'><i><font color='Gray'>Edit</font></i></a>"
			."&nbsp;&nbsp;"
			."<a href='#' onclick=\"document.forms['realfeaturedeleteform$i'].submit()\"> <i><font color='Gray'>delete</font></i> </a>"
			."</div><div style='clear:both;'></div>";
			$i++;
		}
	}
	else 
	{
		$m_features = "<p>&nbsp;&nbsp;Sorry,no any features here yet!</p>";
	}
	

  echo '<form name="listfeature" method="post" action="#realFeatures">';	
// End get Listing Features
  echo "<h2>Options</h2>";
/*".$m_allLanguage['Language Settings']."*/  
  
	echo '<table border="0" cellpadding="5" width="100%">';
			echo '<tr height="28">';
				echo '<td valign="top"  width="25%">'.$m_allLanguage['Current Language'].'</td>';
				echo '<td>';
        echo '<select name="realLangguage" >';				
        foreach ($lang_array as $key=>$v) {
            echo '<option value="'.$v.'" '.(($REW_options["realLangguage"]["value"]==$v)?'selected="selected"':"").'>'.$v.'</option>';
        }
        echo '</select>';
				echo '</td>';
			echo '</tr>';
			echo '<tr height="28">';
				echo '<td valign="top"  width="25%">Default Currency</td>';
				echo '<td>';
        echo '<select name="realCurrency" >';				
//        foreach ($currency_array as $key=>$v) {
//            echo '<option value="'.$v.'" '.(($REW_options["realCurrency"]["value"]==$v)?'selected="selected"':"").'>'.$v.'</option>';
//        }
        foreach ($currency_arr as $key=>$d) {
            echo '<option value="'.$key.'" '.(($REW_options["realCurrency"]["value"]==$key)?'selected="selected"':"").'>'.(($d["spc"]!="")?$d["spc"]:$d["value"]).'</option>';
        }
        echo '</select>';
				echo '</td>';
			echo '</tr>';
	echo '</table>';
  
	echo "<h2>".$m_allLanguage['listingsFeaturesTitle']."</h2>";
	echo '<table border="0" cellpadding="5" width="100%">';
//		echo '<form name="listfeature" method="post" action="#realFeatures">';
// show Listing Features
			echo '<tr height="28">';
				echo '<td valign="top">'.$m_allLanguage['listingsFeaturesTitle'].'</td>';
				echo '<td>';
					echo '<table width="70%">';
						echo '<tr style="background: #fcfeec;width:150px;">';
							echo '<td width="50%" >';
								echo "$m_features";
							echo '</td>';
						echo '</tr>';
						echo '<tr>';
							echo '<td>';
								echo '<input type="text" name="addnewfeature" id="addnewfield" size="28" style="background:yellow"> ';
								echo $m_allLanguage['addNewField'];
							echo '</td>';
						echo '</tr>	';
					echo '</table>';
				echo '</td>';
			echo '</tr>';
//end show Listing Features

// begin show main listing
			echo '<tr>';
				echo '<td>';
					echo $m_allLanguage['mainListingsPage'];
				echo '</td>';
				echo '<td>';
					if (get_pages())
					{ 
						$m_mainListing = get_option('realmainlisting');
						if (empty($m_mainListing))
						{
							wp_dropdown_pages("name=mainlisting&show_option_none=Please Select Your Main Listing");
						}
						else 
						{
							wp_dropdown_pages("name=mainlisting&show_option_none=Please Select Your Main Listing&selected=".$m_mainListing);
						}
					}
					else 
					{
						echo "<br />".$m_allLanguage['notpage']." <a href='".get_option('siteurl')."/wp-admin/page-new.php' target='_blank'>".$m_allLanguage['here']."</a> ".$m_allLanguage['writePage']."<br />";
					}
				echo '</td>';
			echo '</tr>';
			
			echo '<tr>';
				echo '<td>';
				echo '&nbsp;';
				echo '</td>';
				echo '<td>';
					echo '<p>'.$m_allLanguage['noticeSelectPage'].'</p>';
					//echo '<p>'.$m_allLanguage['noticeSubPage'].'</p>';
				echo '</td>';
			echo '</tr>';
// end show main listing


// begin show listing summary
			$m_listSummary = get_option('reallistsummary');
			echo '<tr>';
				echo '<td valign="top">';
					echo $m_allLanguage['Listings Summary'];
				echo '</td>';
				echo '<td>';
					if ($m_listSummary == 'YES')
					{
						echo '<input type="checkbox" name="listsummary" value="YES" checked>';
					}
					else 
					{
						echo '<input type="checkbox" name="listsummary" value="YES">';
					}
					echo '<p>'.$m_allLanguage['checkSummary'].'</p>';
				echo '</td>';
			echo '</tr>';
// end show listing summary

/* Begin Individual Listing Pages
			$m_listpage = get_option('reallistpage');
			echo '<tr>';
				echo '<td valign="top">';
					echo 'Individual Listings Pages';
				echo '</td>';
				echo '<td>';
					if ($m_listpage == 'YES')
					{
						echo '<input type="checkbox" name="listpage" value="YES" checked>';
					}
					else 
					{
						echo '<input type="checkbox" name="listpage" value="YES">';
					}
					echo '<p>'.$m_allLanguage['checkTabbed'].'</p>';
				echo '</td>';
			echo '</tr>';
// End Individual Listing Pages */
			
// Begin Google Api Key
			$m_googlekey = get_option('realgooglekey');
			if (empty($m_googlekey))
			{
				$m_googlekey = '';
			}
			echo '<tr>';
				echo '<td valign="top">';
					echo $m_allLanguage['Google API Key'];
				echo '</td>';
				echo '<td>';
					echo '<input type="text" name="googlekey" size="50" value="'.$m_googlekey.'">';
					echo '<p>'.$m_allLanguage['getGoogleAPIKey'].'</p>';
				echo '</td>';
			echo '</tr>';
// End Google Api Key
			
//Begin Maximum Listings
			$m_maximumlisting = get_option('realmaximumlisting');
			echo '<tr>';
				echo '<td valign="top">';
					echo $m_allLanguage['Maximum Listings Featured'];
				echo '</td>';
				echo '<td>';
					if (empty($m_maximumlisting))
					{
						echo '<input type="text" name="maximumlisting" size="10" value="5">';
					}
					else 
					{
						echo '<input type="text" name="maximumlisting" size="10" value="'.$m_maximumlisting.'">';
					}
					echo '<p>'.$m_allLanguage['noticeMaxNumber'].'</p>';
				echo '</td>';
			echo '</tr>';
//End Maximum Listings

			echo '<tr>';
				echo '<td>';
					echo '<input type="hidden" id="rp_hiddenAdmin" name="rp_hiddenAdmin" value="YES">';
					echo '<input type="submit" id="featurebutton" value="'.$m_allLanguage['Save Changes'].'">';
				echo '</td>';
			echo '</tr>';
			
	echo '</table>';
  echo '</form>';
	return;
}
?>