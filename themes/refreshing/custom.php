<?php
function realpressRefreshHead()
{

?>
	<script type="text/javascript" src="<?php  echo get_option('siteurl'); ?>/wp-includes/js/jquery/ui.core.js"></script>
	<script type="text/javascript" src="<?php  echo get_option('siteurl'); ?>/wp-includes/js/jquery/ui.tabs.js"></script>

<?php
	echo '<script type="text/javascript" src="'.get_option('siteurl').'/wp-content/plugins/'.BASE_DIR.'/jquery.cookie.js"></script>';
	echo "<script type='text/javascript'>jQuery(document).ready(function(){jQuery('#tabs').tabs({cookie:{ expires: 30 }})});</script>";
	$m_googlekey = get_option('realgooglekey');
	?>
		<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=<?php echo $m_googlekey; ?>"
      			type="text/javascript"></script>	
	<script type='text/javascript'>
	function realTabsGetSingleMap(p_postid)
	{
	
		
		rp_check_maps = 'postid='+p_postid;
		
		jQuery.ajax
		(
		{
			type: "post",
			url: "<?php echo bloginfo("url") ?>/wp-content/plugins/<?=BASE_DIR;?>/realmapsajax.php",
			dataType: "json",
			data: rp_check_maps,
	
			success: function(ajax_result)
			{
				if ('1000' == ajax_result)
				{
					//document.getElementById("rp_contactInfo").innerHTML = 'We will contact you soon,Thank you.';
					//document.getElementById("rp_contactInfo").style.display='block' ;				
				}
				else
				{
					realTabsShowSingleMap(ajax_result);
				}
			}

		}
		)		
	}
	
	function realTabsShowSingleMap(p_ajax_result)
	{
		var m_lng = p_ajax_result['lng'];
		var m_lat = p_ajax_result['lat'];
		var m_postid = p_ajax_result['postid'];
		
		jQuery(document).ready(nowinitialize());
		
		var now_map ;
    	function nowinitialize()
    	{
   			if (GBrowserIsCompatible()) 
    		{
    			now_map = new GMap2(document.getElementById("realpressMapCanvas"+m_postid));
    			gdir = new GDirections(now_map, document.getElementById("realDirections"+m_postid));
    			GEvent.addListener(gdir, "error", handleErrors);
				  document.getElementById('realInputSE'+m_postid).style.display = "block";
    			
				
    			now_map.setCenter(new GLatLng(m_lat,m_lng), 15,G_NORMAL_MAP );
				  now_map.addControl(new GOverviewMapControl());
				  now_map.addControl(new GLargeMapControl());
				  now_map.addControl(new GHierarchicalMapTypeControl());
        						
				  now_map.enableGoogleBar();
				  GEvent.addListener(now_map, "dblclick", function(a,b,c) 
				  {
						now_map.setCenter(new GLatLng(b.lat(),b.lng()));
				  });
        						
				var blueIcon = new GIcon(G_DEFAULT_ICON);
				blueIcon.image = "http://www.google.cn/intl/en_us/mapfiles/ms/micons/blue-dot.png";
				var markerOptions = { icon:blueIcon };

				var latlng = new GLatLng(m_lat, m_lng,markerOptions);
				var marker = new GMarker(latlng,markerOptions);
				now_map.addOverlay(marker);
    		}
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
	
	echo "<script type='text/javascript'>jQuery(document).ready(function(){jQuery('#tabs$realPostId').tabs({cookie:{ expires: 30 }})});</script>";	
	echo "<script type='text/javascript'>jQuery(document).ready(function(){jQuery('#tabs$realPostId > ul > li').css('list-style','none')});</script>";		
	//show layout
	echo '<br />';
	echo '<div >'; // all content begin from here

	echo '<div class="ui-tabs ui-widget ui-widget-content ui-corner-all" id = "tabs'.$realPostId.'">';
	
	echo '<ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">';
	echo '<li class="ui-state-default ui-corner-top ui-tabs-selected ui-state-active">';
	echo '<a href="#tabs'.$realPostId.'-1"><span>Description</span></a>';
	echo '</li>';
	echo '<li class="ui-state-default ui-corner-top">';
	echo '<a href="#tabs'.$realPostId.'-2"><span>Photos</span></a>';
	echo '</li>';

	echo '<li class="ui-state-default ui-corner-top">';
	if ((is_single()) || (is_page()))
	{
		echo '<a href="#tabs'.$realPostId.'-3" onclick="window.location.reload();"><span>Maps</span></a>';
	}
	else 
	{
		echo '<a href="#tabs'.$realPostId.'-3" onclick="realTabsGetSingleMap(\''.$realPostId.'\')"><span>Maps</span></a>';
	}
	echo '</li>';	

	echo '<li class="ui-state-default ui-corner-top">';
	echo '<a href="#tabs'.$realPostId.'-4"><span>Contact</span></a>';
	echo '</li>';	
	echo '</ul>';	
	
	
	echo '<div id="tabs'.$realPostId.'-1" class="ui-tabs-panel ui-widget-content ui-corner-bottom">';
	
	realShowDescription($realPostId,$p_houseID);
	echo "</div>";
	
	echo '<div id="tabs'.$realPostId.'-2" class="ui-tabs-panel ui-widget-content ui-corner-bottom">';
	realShowImage($realPostId);
	echo "</div>";

	echo '<div id ="tabs'.$realPostId.'-3" class="ui-tabs-panel ui-widget-content ui-corner-bottom">';
	realShowGoogleMaps($realPostId,$p_houseID);
	echo '</div>';
	

	echo "<div id='tabs$realPostId-4' class='ui-tabs-panel ui-widget-content ui-corner-bottom'>";
	realShowContact($realPostId,$p_houseID);
	echo "</div>";
	echo '</div>'; //rp_wholeContent
	echo "<div id='rp_bottomContent'>";
	realShowContent($realPostId,$p_houseID);
	echo "</div>";

	echo '</div>'; //realLayout
}


function realShowContact($realPostId,$p_houseID)
{
		echo "<div id='rp_contactInfo'>";
		echo "</div>";
		
		echo '<form action="" method="POST" id="rp_contactform" name = "rp_contactform">';
		realShowListingData('more about this house?','','contacttitle');
		realShowListingData('Your Name (<i>required</i>) ','','contactname');
		echo "<input type='text' id='rp_text_contactname' name='rp_text_contactname'>";
		realShowListingData('Your Email (<i>required</i>) ','','contactemail');
		echo "<input type='text' id='rp_text_contactemail' name='rp_text_contactemail'>";
		realShowListingData('Telephone Number (<i>required</i>) ','','contactphone');
		echo "<input type='text' id='rp_text_contactphone' name='rp_text_contactphone'>";
		realShowListingData('Subject','','contactsubject');
		echo "<input type='text' id='rp_text_contactsubject' name='rp_text_contactsubject'>";
		realShowListingData('Your Message','','contactmessage');
		echo '<textarea id="rp_text_contactmessage" name="rp_text_contactmessage" cols="20" rows="5">';
		echo '</textarea>';
		realShowListingData('please fill in this verification ','','contactcheck');
		echo "<input type='text' id='rp_text_spaminput' name='rp_text_spaminput'>";
		echo '<img src="'. get_option('siteurl'). '/wp-content/plugins/'.BASE_DIR.'/realspamcheck.php" id="rp_spamBox" />';
		realShowListingData('','','contactsubmit');
		echo "<input type= 'button' id='rp_submitcontact' value='Send it' name='rp_submitcontact' onclick='rpSubmitForm();return false;' >";
		echo '</form>';
		realShowListingData('','','contacttail');
}
	
function realShowContent($realPostId,$p_houseID)
{

	global $wpdb,$table_prefix,$wp_version,$userdata,$current_user, $user_ID,$post,$wp_rewrite;
	global $currency_arr;
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
	$m_fullAddress = $m_addressnumber." ".$m_stree;
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
	$m_price_total = number_format(realGetHouseDetails($p_houseID,'price_total'));
	$m_saled_price = realGetHouseDetails($p_houseID,'saled_price');
	$m_yearbuild = realGetHouseDetails($p_houseID,'yearbuild');
	$m_beds = realGetHouseDetails($p_houseID,'beds');
	$m_baths = realGetHouseDetails($p_houseID,'baths');
	$m_garages = realGetHouseDetails($p_houseID,'garages');
	$m_acres = realGetHouseDetails($p_houseID,'acres');
	$m_listdate = realGetHouseDetails($p_houseID,'listdate');
	$m_saledateTemp = split(" ",$m_listdate);
	$m_listdate = $m_saledateTemp[0];		
	$m_saledate = realGetHouseDetails($p_houseID,'saledate');
	$m_saledateTemp = split(" ",$m_saledate);
	$m_saledate = $m_saledateTemp[0];	
	$m_currencyid = realGetHouseDetails($p_houseID,'currencyid');
	
	if (!$m_currencyid)
    $m_currencyid=get_option("realCurrency");

  if ($m_currencyid)    
    $m_currencyid = (($currency_arr[$m_currencyid]["spc"]!="")?$currency_arr[$m_currencyid]["spc"]:$currency_arr[$m_currencyid]["value"]);
	
	$m_featured = realGetHouseDetails($p_houseID,'featured');
	$m_agentid = realGetHouseDetails($p_houseID,'agentid');
	$m_status = realGetHouseDetails($p_houseID,'status');
	$m_description = realGetHouseDetails($p_houseID,'description');	
	$m_title = get_the_title($realPostId);
	

	realShowBF('before','HouseDetails');

	echo "<div id='realpressHouseDetails'>";

	$m_featuredArray = array($m_featured,'Featured');
	$m_featuredAfterArray = array('<br />');
	if ($m_featured == 'YES')
	{
		realShowListingData('','','featured','showFeature',$m_featuredArray,'','','afterFeature',$m_featuredAfterArray);
	}
	
	realShowListingData($m_title,'','title');
	realShowListingData('Listing Details','','frontendListingDetails');
	realShowListingData($m_currencyid.$m_price_total,'Price total:','price_total','','','realpressClearDiv');
//	realShowListingData($m_currencyid,'Currency:','currencyid','','','realpressClearDiv');	
	realShowListingData($m_status,'Status:','status','','','realpressClearDiv');
	realShowListingData($m_listingtype,'Listing type:','listingtype','','','realpressClearDiv');
	$m_setting_real_address = get_option('real_address');
	if ($m_setting_real_address != 'disable')
	realShowListingData($m_fullAddress,'Property Address:','street','','','realpressClearDiv');
	//realShowListingData($m_stree,'Street:','street','','','realpressClearDiv');
	realShowListingData($m_city,'City:','city','','','realpressClearDiv');
	realShowListingData($m_state,'State:','state','','','realpressClearDiv');
	realShowListingData($m_country,'Country:','country','','','realpressClearDiv');
	realShowListingData($m_postcode,'Postcode:','postcode','','','realpressClearDiv');
	realShowListingData($m_beds,'Beds:','beds','','','realpressClearDiv');
	realShowListingData($m_baths,'Baths:','baths','','','realpressClearDiv');
	realShowListingData($m_garages,'Garages:','garages','','','realpressClearDiv');
	realShowListingData($m_sqft,'Sqft:','sqft','','','realpressClearDiv');
	realShowListingData($m_acres,'Acres:','acres','','','realpressClearDiv');
	realShowListingData($m_yearbuild,'Year build:','yearbuild','','','realpressClearDiv');
	realShowListingData($m_listingfeatures,'Listing features:','listingfeatures','','','realpressClearDiv');
	realShowListingData($m_propertyfeatures,'Property features:','propertyfeatures','','','realpressClearDiv');
	realShowListingData($m_neighborhood,'Neighborhood:','neighborhood','','','realpressClearDiv');

	realShowListingData($m_price_sqft,'Price sqft:','price_sqft','','','realpressClearDiv');
	realShowListingData($m_saled_price,'Saled price:','saled_price','','','realpressClearDiv');
	realShowListingData($m_listdate,'List date:','listdate','','','realpressClearDiv');
	realShowListingData($m_saledate,'Sale date:','saledate','','','realpressClearDiv');
	realShowListingData($m_mls,'Mls/Source id:','mls','','','realpressClearDiv');
	realShowListingData($m_agentid,'Agent id:','agentid','','','realpressClearDiv');
	//realShowListingData($m_title,'Title:','indetailtitle','','','realpressClearDiv');
	realShowListingData($m_propertytype,'Property type:','propertytype','','','realpressClearDiv');
	echo "</div>"; // realpressHouseDetails

	realShowBF('after','HouseDetails');
}

function realShowImage($p_realPostId,$p_width = '',$p_height = '',$p_model = '',$p_title = '')
{
	// is use nextgen gallery?
	$m_alt = get_the_title($p_realPostId);
	if (empty($m_alt)) $m_alt = '';
	
	$m_nextgenGallery = get_post_meta($p_realPostId,'nextgen_gallery');

	if (empty($m_nextgenGallery))
	{
		$m_realImage =  get_post_meta($p_realPostId,'realImage');
		echo "<div id='rp_showImage'>";
		if (empty($m_realImage))
		{
			realShowListingData('Sorry, no any photo for this house found yet.','ERROR:','errorImage');
		}
		else 
		{
			if ($p_title!='NO')
			{			
				echo "<div id='rp_ImageArea'>";
				echo '<h2>Listing Picture</h2>';
				echo "<div id='rp_ImageDiv'>";
				$m_img =  "<img src='".$m_realImage[0][0]."' alt='".$m_alt;
				if ((!(empty($p_width))) && (!(empty($p_height))))
				{
					$m_img .= "' style='";
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
				
				echo "</div>"; //rp_ImageDiv
				echo "<div id='rp_ImageBig'>";
				echo "View <a href='".$m_realImage[0][0]."' title='$m_alt' class='thickbox'>larger photos</a>";
			
				echo "</div>"; //rp_ImageBig
				echo "</div>"; //rp_ImageArea
			}
			else
			{
				echo "<div id='rp_desImageArea'>";
				echo "<div id='rp_desImageDiv'>";
				//echo "<img src='".$m_realImage[0][0]."' alt='".$m_alt."'>";
				$m_img =  "<img src='".$m_realImage[0][0]."' alt='".$m_alt;
				if ((!(empty($p_width))) && (!(empty($p_height))))
				{
					$m_img .= "' style='";
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
				echo "</div>"; //rp_ImageDiv
				echo "<div id='rp_ImageBig'>";

				echo "View <a href='".$m_realImage[0][0]."' title='$m_alt' class='thickbox'>larger photos</a>";
				echo "</div>"; //rp_ImageBig
				echo "</div>"; //rp_ImageArea				
			}
			
		}
		echo "</div>"; //rp_showImage
	}
	else 
	{
		// use nextgen-gallery
		if (function_exists('nggShowImageBrowser'))
		{
			echo "<div id='rp_showGallery'>";
			if ($p_title!='NO')
			echo '<h2>Listing Gallery</h2>';
			echo "<div id='rp_GalleryArea'>";
			
			if ($p_model == 'firstImg' )
			{
				$m_galleryResult = realGetGalleryFirstImg($m_nextgenGallery[0],$p_width,$p_height);
			}
			else
			{
				//!!!$m_galleryResult = nggShowSimpleViewer($m_nextgenGallery[0],580,540);
				$m_galleryResult = nggShowSimpleViewer($m_nextgenGallery[0],460,460);
			}
			echo $m_galleryResult;
			echo "</div>"; //rp_GalleryArea
			echo "</div>"; //rp_showGallery
		}
	}
}

function realShowGoogleMaps($realPostId,$p_houseID)
{
	global $wpdb,$table_prefix,$wp_version,$userdata,$current_user, $user_ID,$post,$wp_rewrite;
	get_currentuserinfo();

	$realPostCode = realGetHousePostCode($p_houseID);
	if (!(empty($realPostCode)) && ((is_single()) || (is_page())))
	{
		//$realPostCode = str_replace(" ","%20",$realPostCode);	
		echo '<div id="realInputSE">';
		echo '<h2>Google Map</h2>';
		echo '<div id="rp_googlecontent">';
		echo '<div id="rp_googledirection">';
		echo '<form action="#" onsubmit="setDirections(this.from.value, this.to.value, this.locale.value); return false">';
		echo 'From: ';
		echo '<input type="text" size="15" id="fromAddress" name="from" value="e.g 123 Main st" onclick="realClearClick()"/>';
		echo ' To: ';
		echo '<input type="text" size="15" id="toAddress" name="to" value="'.$realPostCode.'" />';
		echo "&nbsp;&nbsp;&nbsp;";
		echo '<select id="reallocale" name="locale">';
		echo '<option value="en" selected>English</option>';
    	echo '<option value="fr">French</option>';
    	echo '<option value="de">German</option>';
    	echo '<option value="ja">Japanese</option>';
    	echo '<option value="es">Spanish</option>';
    	echo '</select>';
    	echo "&nbsp;&nbsp;&nbsp;";
    	echo '<input name="submit" type="submit" value="Get Directions!" />';
		echo '</form>';
		echo '</div>';// rp_googledirection
	
		echo '<div id="realpressMapCanvas" ></div>';
		echo '<div id="realDirections"></div>';
		echo '</div>';//rp_googlecontent
		
		echo '</div>'; //realInputSE
		echo '<br />';
	}

	

	if (!(empty($realPostCode)) && ((is_home()) || (is_archive())))
	{
		//$realPostCode = str_replace(" ","%20",$realPostCode);	
		echo '<div id="realInputSE'.$realPostId.'">';
		echo '<h2>Google Map</h2>';
		echo '<div id="rp_googlecontent">';
		echo '<div id="rp_googledirection">';
		echo '<form action="#" name="realGoogleD'.$realPostId.'" id="realGoogleFormD'.$realPostId.'" onsubmit="setDirections(this.from.value, this.to.value, this.locale.value); return false">';
		echo 'From: ';
		echo '<input type="text" size="15" id="fromAddress" name="from" value="e.g 123 Main st" onclick="realClearClick()"/>';
		echo ' To: ';
		echo '<input type="text" size="15" id="toAddress" name="to" value="'.$realPostCode.'" />';
		echo "&nbsp;&nbsp;&nbsp;";
		echo '<select id="reallocale" name="locale">';
		echo '<option value="en" selected>English</option>';
    	echo '<option value="fr">French</option>';
    	echo '<option value="de">German</option>';
    	echo '<option value="ja">Japanese</option>';
    	echo '<option value="es">Spanish</option>';
    	echo '</select>';
    	echo "&nbsp;&nbsp;&nbsp;";
    	echo '<input name="submit'.$realPostId.'" type="submit" value="Get Directions!" />';
		echo '</form>';
		echo '</div>';// rp_googledirection
	
		echo '<div id="realpressMapCanvas'.$realPostId.'" ></div>';
		echo '<div id="realDirections'.$realPostId.'"></div>';
		echo '</div>';//rp_googlecontent
		
		echo '</div>'; //realInputSE
		echo '<br />';
	}

}

function showFeature($p_model,$p_memo)
{
	if ($p_model == 'YES')
	{
		echo "&nbsp;&nbsp;".$p_memo;
	}
}

function afterFeature($p_echo)
{
	echo $p_echo;
}



function realShowDescription($realPostId,$p_houseID)
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
	$m_description = realGetHouseDetails($p_houseID,'description');	
	$m_title = get_the_title($realPostId);
	$m_featured = realGetHouseDetails($p_houseID,'featured');
	

	realShowBF('before','HouseDetails');

	echo "<div id='realpressTabsDescription'>";
	realShowListingData($m_title,'','descriptionTitle');
	echo "<div id='realpressLeftDescription'>";
	realShowImage($realPostId,'','','firstImg','NO');
	realShowListingData($m_description,'','description');
	
	echo "</div>"; 
	realShowBF('after','HouseDetails');
	echo "<div style='clear:both;'></div>";
	echo "</div>"; 
	
}


function realGetGalleryFirstImg($p_galleryID,$p_width='',$p_height='')
{
	global $wpdb,$table_prefix,$wp_version,$userdata,$current_user, $user_ID,$post,$wp_rewrite,$nggdb;
	get_currentuserinfo();

	if (empty($p_width ))
	{
		$p_width = 250;
	}
	if (empty($p_height ))
	{
		$p_height = 250;
	}	
	
	$m_return = false;
	$m_galleryID = (is_array($p_galleryID)?$p_galleryID[0]:$p_galleryID);
		
//	if (!(empty($m_galleryID)))
	if (!(empty($p_galleryID)))
	{
		if (function_exists('nggSinglePicture'))
		{
			$m_photoTable =$table_prefix.'ngg_pictures';
//			$m_photoSql = 'select `filename` from `'.$m_photoTable."` where `galleryid` = '".$m_galleryID[0]."' limit 1";
			$m_photoSql = 'select `filename` from `'.$m_photoTable."` where `galleryid` = '".$m_galleryID."' limit 1";
			$m_photoResult = $wpdb->get_var($m_photoSql);

			$m_pathTable =$table_prefix.'ngg_gallery';
//			$m_pathSql = 'select `path` from `'.$m_pathTable."` where `gid` = '".$m_galleryID[0]."' limit 1";
			$m_pathSql = 'select `path` from `'.$m_pathTable."` where `gid` = '".$m_galleryID."' limit 1";
			$m_pathResult = $wpdb->get_var($m_pathSql);

			if ((!(empty($m_pathResult))) && (!(empty($m_photoResult))))
			$m_hadImgNow = get_option('siteurl')."/".$m_pathResult."/".$m_photoResult;
				
			if (!(empty($m_hadImgNow)))
			{
				$m_bigImage = 'images3.jpeg';
				$m_secreenshotPath = realpressGetSystemPic($m_bigImage);
				$m_return =  '<div><div> <img style="margin-left:15px;padding-bottom:10px;width:'.$p_width.'px;height:'.$p_height.'px; " src ="'.$m_hadImgNow.'"  ></div>';
				$m_return .= "<div id='rp_ImageBig'>";
				$m_return .=   " View <a href='".$m_hadImgNow."' title='Listing Picture' class='thickbox'><font color='blue'>larger photos</font></a>";
				$m_return .= "</div></div>";
			}
			else 
			{
				$m_return = false;
			}
		}
	}
	return $m_return;
}

add_action('wp_head','realpressRefreshHead',100);
?>