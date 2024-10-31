<?php

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
		//$m_vOrderArray[3] = '4'; //4 is Contact
		$m_hOrderArray = 'detail';		
	}
	
	//show layout
	echo '<div id="realLayout">'; // all content begin from here
	foreach ($m_vOrderArray as $m_nowShow)
	{
		if ($m_nowShow == '3')
		{
			echo "<div id = 'rp_wholeContent'>";
			if (($m_hOrderArray == 'detail') || ($m_hOrderArray == 'none'))
			{
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
		}
		if ($m_nowShow == '2')
		{
			realShowGoogleMaps($realPostId,$p_houseID); // show Google Map
		}

	}
	echo '</div>'; //realLayout
	// generate listing details
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
	$m_price_total = realGetHouseDetails($p_houseID,'price_total');
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
		realShowListingData($m_title,'','title','','','showFeature',$m_featuredArray,'afterFeature',$m_featuredAfterArray);
	}
	else 
	{
		realShowListingData($m_title,'','title','','','realpressClearDiv','','realpressClearDiv');
	}
	realShowListingData($m_description,'','description');
	realShowListingData('Listing Details','','frontendListingDetails');
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
	realShowListingData($m_price_total,'Price total:','price_total','','','realpressClearDiv');
	realShowListingData($m_listingfeatures,'Listing features:','listingfeatures','','','realpressClearDiv');
	realShowListingData($m_propertyfeatures,'Property features:','propertyfeatures','','','realpressClearDiv');
	realShowListingData($m_neighborhood,'Neighborhood:','neighborhood','','','realpressClearDiv');
	realShowListingData($m_currencyid,'Currency:','currencyid','','','realpressClearDiv');
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

function realShowImage($p_realPostId,$p_houseID)
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
			echo "<div id='rp_ImageArea'>";
			echo '<h2>Listing Picture</h2>';
			echo "<div id='rp_ImageDiv'>";
			echo "<img src='".$m_realImage[0][0]."' alt='".$m_alt."'>";
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
		if (function_exists('nggShowImageBrowser'))
		{
			echo "<div id='rp_showGallery'>";
			echo '<h2>Listing Gallery</h2>';
			echo "<div id='rp_GalleryArea'>";
			$m_galleryResult = nggShowImageBrowser($m_nextgenGallery[0]);
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


?>