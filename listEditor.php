<?php


if ( defined('NGGALLERY_ABSPATH') )
{
	include_once (NGGALLERY_ABSPATH. 'admin/functions.php');
}

if (isset($_GET['modifyid']))
{
	listingModifyNow();
}
else
{
	listingManager();
}
/***************************************************************/
/****  function:listingManager                          ********/
/****  usage: input the content of listing              ********/
/***************************************************************/
function listingManager()
{
	global $wpdb,$table_prefix,$wp_version,$userdata,$current_user, $user_ID,$post,$wp_rewrite,$nggdb;
	get_currentuserinfo();

	//init var
	$m_category = '';
	$m_currentPublishUser = $current_user->ID;
	$m_hadImgNow = '';
	$m_rp_menuTitleSEO = '';
	$m_rp_metaDescriptionSEO = '';
	$m_rp_metaTitleSEO = '';
	$m_temp_tags = '';
	$m_rp_listingagentid = '';
	$m_rp_listingcurrencyid = '';
	$m_rp_listingacres = '';
	$m_rp_listingyearbuild = '';
	$m_rp_listingsaled_price = '';
	$m_rp_listingprice_total = '';
	$m_rp_listingprice_sqft = '';
	$m_rp_listingsqft = '';
	$m_rp_listingmlsid = '';
	$m_rp_listingneighborhood = '';
	$m_rpSelectPostCountry = '';
	$m_rp_listingstate = '';
	$m_rp_listingcity = '';
	$m_rp_listingstree = '';
	$m_rp_listPostCode = '';
	$m_rp_listingaddressnumber = '';
	$m_realFeatures = '';
	$m_rp_featureGarage = '';
	$m_rp_featureBathrooms = '';
	$m_rp_featureBedrooms = '';
	$m_rpSelectListingTypes = '';
	$m_rpSelectPropertyTypes = '';
	$m_rp_listDescription = '';
	$m_rp_listTitle = '';
	$m_hadImgNow = '';
	$m_listingTempProperty = '';
	$m_listingPropertyArray	= '';
	$m_realFeaturesString = '';
	$m_galleryID = '';
	$m_rp_listingstatus = '';
	$m_rp_listingfeatured = '';
	

	// begin deal with user submit
	if (isset($_POST['rp_ListingHidden']))
	{
		// deal with category
		if (isset($_POST['category_news']))
		{
			//$m_category = $wpdb->escape($_POST['category_news']);
			$m_category = $wpdb->escape($_POST['category_news']);
		}
		
		// deal with upload image
		if ($_POST['uploadimage'])
		{
			if (class_exists('nggAdmin'))
			{
				check_admin_referer('ngg_addgallery');
				if ( $_FILES['imagefiles']['error'][0] == 0 )
				{
					if (isset($_POST['galleryselect']))
					{
						$galleryID = (int) $_POST['galleryselect'];
						if ($galleryID == 0) 
						{
							nggGallery::show_error(__('No gallery selected !','nggallery'));
							return;	
						}

						// get the path to the gallery	
						$gallery = $nggdb->find_gallery($galleryID);

						if ( empty($gallery->path) )
						{
							nggGallery::show_error(__('Failure in database, no gallery path set !','nggallery'));
							return;
						} 						
					}
					$messagetext = nggAdmin::upload_images();
					$m_galleryID = $wpdb->escape($_POST['galleryselect']);
				}
				/*
				else
					nggGallery::show_error( __('Upload failed!','nggallery') );	
				*/
			}
			else 
			{
				$m_currentPublishUser = $current_user->ID;
				$imagefiles = $_FILES['imagefiles'];
				if (is_array($imagefiles)) 
				{
					foreach ($imagefiles['name'] as $key => $value) 
					{
						if (!(preg_match("/\.(png|jp(e)*g|gif){1}$/i",$value)))
						{
							realMessage("Sorry, we only allow upload png,jp(e)g,gig files,please try again.");
							delete_usermeta($current_user->ID,'realListImgTemp');
							return;
						}
						// look only for uploded files
						if ($imagefiles['error'][$key] == 0)
						{
							$temp_file = $imagefiles['tmp_name'][$key];

							$file_name = $imagefiles["name"][$key];
							$new_file_name = md5(uniqid(rand())) . "_". $file_name;
							
							if(@is_uploaded_file($imagefiles["tmp_name"][$key]))
							{
								$imgDirs = wp_upload_dir();
								if(move_uploaded_file($imagefiles["tmp_name"][$key],$imgDirs['path']."/".$new_file_name))
								{
									$m_image_path = $imgDirs['url']."/".$new_file_name;
									$m_hadImgNow = get_usermeta($current_user->ID,'realListImgTemp');
									if (!empty($m_hadImgNow))
									{
										$m_hadImgNow[] = $m_image_path;
									}
									else 
									{
										$m_hadImgNow = array();
										$m_hadImgNow[0] = $m_image_path;
									}
									update_usermeta($current_user->ID,'realListImgTemp',$m_hadImgNow);
									realMessage("<br /><I>The picture($new_file_name) upload success!</I><br />");
								}
								else
								{
									realMessage("File upload error($new_file_name),maybe you did not create 'uploads' in direction 'wp-content' or can not write in this directory.");
								}
							}							
						}
					}
				}
			}
		}
		// end upload image
		
		// title
		if (isset($_POST['rp_listTitle']))
		{
			$m_rp_listTitle = $wpdb->escape($_POST['rp_listTitle']);
		}
		
		// description
		if (isset($_POST['rp_listDescription']))
		{
			$m_rp_listDescription = $wpdb->escape($_POST['rp_listDescription']);
		}
		
		// property types
		if (isset($_POST['rpSelectPropertyTypes']))
		{
			$m_rpSelectPropertyTypes = $wpdb->escape($_POST['rpSelectPropertyTypes']);
		}
		
		// listing types
		if (isset($_POST['rpSelectListingTypes']))
		{
			$m_rpSelectListingTypes = $wpdb->escape($_POST['rpSelectListingTypes']);
		}
		
		// property features bedroom
		if (isset($_POST['rp_featureBedrooms']))
		{
			$m_rp_featureBedrooms = $wpdb->escape($_POST['rp_featureBedrooms']);
			$m_listingTempProperty = $m_rp_featureBedrooms." Bedrooms";
			if (empty($m_listingPropertyArray))
			{
				$m_listingPropertyArray = array();
			}
			$m_listingPropertyArray[] = $m_rp_featureBedrooms;
		}
		// status
		if (isset($_POST['rp_listingstatus']))
		{
			if ($_POST['rp_listingstatus'] == 'NONE') 
			{
				$m_rp_listingstatus = '';
			}
			else 
			{
				$m_rp_listingstatus = $wpdb->escape($_POST['rp_listingstatus']);
			}
			
		}
		// featured?
		if (isset($_POST['rp_listingfeatured']))
		{
			$m_rp_listingfeatured = $wpdb->escape($_POST['rp_listingfeatured']);
		}
				
		// property features bathroom
		if (isset($_POST['rp_featureBathrooms']))
		{
			$m_rp_featureBathrooms = $wpdb->escape($_POST['rp_featureBathrooms']);
			if (empty($m_listingTempProperty))
			{
				$m_listingTempProperty = $m_rp_featureBathrooms;
			}
			else 
			{
				$m_listingTempProperty .= " , ".$m_rp_featureBathrooms." Bathrooms";
			}
			if (empty($m_listingPropertyArray))
			{
				$m_listingPropertyArray = array();
			}
			$m_listingPropertyArray[] = $m_rp_featureBathrooms;
		}

		// property features garage
		if (isset($_POST['rp_featureGarage']))
		{
			$m_rp_featureGarage = $wpdb->escape($_POST['rp_featureGarage']);
			if (empty($m_listingTempProperty))
			{
				$m_listingTempProperty = $m_rp_featureGarage;
			}
			else 
			{
				$m_listingTempProperty .= " , ".$m_rp_featureGarage." Garage Spaces";
			}
			if (empty($m_listingPropertyArray))
			{
				$m_listingPropertyArray = array();
			}
			$m_listingPropertyArray[] = $m_rp_featureGarage;
		}
		
		//Listing Features
		$m_listingTempTypes = get_option('realpressFeatures');
		if (!(empty($m_listingTempTypes)))
		{
			$m_realFeatures = array();
			$di = 0;
			foreach ($m_listingTempTypes as $m_listingFeaturesNow)
			{
				if (isset($_POST['realFeatures'.$di]))
				{
					$m_realFeatures[] = $di;
					if (($_POST['realFeatures'.$di]) == 'YES')
					{
						if (empty($m_realFeaturesString))
						{
							$m_realFeaturesString = $m_listingFeaturesNow;
						}
						else 
						{
							$m_realFeaturesString .= " , ".$m_listingFeaturesNow;
						}
					}
				}
				//$m_listingFeaturesNow;
				$di++;
			}
		}
		//listing details
		if (!(empty($_POST['rp_listingaddressnumber'])))
		{
			$m_rp_listingaddressnumber = $wpdb->escape($_POST['rp_listingaddressnumber']);
		}
		if (!(empty($_POST['rp_listPostCode'])))
		{
			$m_rp_listPostCode = $wpdb->escape($_POST['rp_listPostCode']);
		}
		if (!(empty($_POST['rp_listingstree'])))
		{
			$m_rp_listingstree = $wpdb->escape($_POST['rp_listingstree']);
		}
		if (!(empty($_POST['rp_listingcity'])))
		{
			$m_rp_listingcity = $wpdb->escape($_POST['rp_listingcity']);
		}
		if (!(empty($_POST['rp_listingstate'])))
		{
			$m_rp_listingstate = $wpdb->escape($_POST['rp_listingstate']);
		}
		if (!(empty($_POST['rpSelectPostCountry'])))
		{
			$m_rpSelectPostCountry = $wpdb->escape($_POST['rpSelectPostCountry']);
		}
		if (!(empty($_POST['rp_listingneighborhood'])))
		{
			$m_rp_listingneighborhood = $wpdb->escape($_POST['rp_listingneighborhood']);
		}
		if (!(empty($_POST['rp_listingmlsid'])))
		{
			$m_rp_listingmlsid = $wpdb->escape($_POST['rp_listingmlsid']);
		}
		if (!(empty($_POST['rp_listingsqft'])))
		{
			$m_rp_listingsqft = $wpdb->escape($_POST['rp_listingsqft']);
		}
		if (!(empty($_POST['rp_listingprice_sqft'])))
		{
			$m_rp_listingprice_sqft = $wpdb->escape($_POST['rp_listingprice_sqft']);
		}
		if (!(empty($_POST['rp_listingprice_total'])))
		{
			$m_rp_listingprice_total = $wpdb->escape($_POST['rp_listingprice_total']);
		}
		if (!(empty($_POST['rp_listingsaled_price'])))
		{
			$m_rp_listingsaled_price = $wpdb->escape($_POST['rp_listingsaled_price']);
		}
		if (!(empty($_POST['rp_listingyearbuild'])))
		{
			$m_rp_listingyearbuild = $wpdb->escape($_POST['rp_listingyearbuild']);
		}
		if (!(empty($_POST['rp_listingacres'])))
		{
			$m_rp_listingacres = $wpdb->escape($_POST['rp_listingacres']);
		}
		if (!(empty($_POST['rp_listingcurrencyid'])))
		{
			
			$m_rp_listingcurrencyid = $wpdb->escape($_POST['rp_listingcurrencyid']);
		}

		if (!(empty($_POST['rp_listingagentid'])))
		{
			$m_rp_listingagentid = $wpdb->escape($_POST['rp_listingagentid']);
		}
		
		//tags
		if (!(empty($_POST['rp_listTags'])))
		{
			$m_temp_tags  = $wpdb->escape($_POST['rp_listTags']);
		}

		if (!(empty($_POST['rp_metaTitleSEO'])))
		{
			$m_rp_metaTitleSEO = $wpdb->escape($_POST['rp_metaTitleSEO']);
		}
		
		if (!(empty($_POST['rp_metaDescriptionSEO'])))
		{
			$m_rp_metaDescriptionSEO = $wpdb->escape($_POST['rp_metaDescriptionSEO']);
		}		
		
		if (!(empty($_POST['rp_menuTitleSEO'])))
		{
			$m_rp_menuTitleSEO = $wpdb->escape($_POST['rp_menuTitleSEO']);
		}
    
		// insert into house table
		$table_name = $table_prefix . "realpresshouse";
		$sqlUpdateIt ="INSERT INTO $table_name(addressnumber, stree, city, state
		, country , postcode , propertytype , listingtype , propertyfeatures , listingfeatures , neighborhood , mls ,
		sqft ,price_sqft ,price_total ,saled_price ,wp_userid ,yearbuild ,beds ,baths ,garages ,
		acres ,listdate ,currencyid ,agentid ,status ,featured, valid ,description )
		VALUES	('".$m_rp_listingaddressnumber."', '".$m_rp_listingstree."','"
		.$m_rp_listingcity."','".$m_rp_listingstate."','".$m_rpSelectPostCountry
		."','".$m_rp_listPostCode."','".$m_rpSelectPropertyTypes
		."','".$m_rpSelectListingTypes."','".$m_listingTempProperty
		."','".$m_realFeaturesString."','".$m_rp_listingneighborhood
		."','".$m_rp_listingmlsid."','".$m_rp_listingsqft
		."','".$m_rp_listingprice_sqft."','".$m_rp_listingprice_total
		."','".$m_rp_listingsaled_price."','".$current_user->ID
		."','".$m_rp_listingyearbuild."','".$m_rp_featureBedrooms
		."','".$m_rp_featureBathrooms."','".$m_rp_featureGarage
		."','".$m_rp_listingacres."','".date("Y-m-d H:i:s")
		."', '".$m_rp_listingcurrencyid."','".$m_rp_listingagentid."','".$m_rp_listingstatus
		."','".$m_rp_listingfeatured."','YES','".$m_rp_listDescription."')";
		
		$wpdb->query($sqlUpdateIt);
		$m_realHouseInsertID = mysql_insert_id();

		$table_name = $table_prefix . "realpresslist";
		$sqlUpdateIt ="INSERT INTO $table_name(houseid, wp_userid, total_view) 
		VALUES ('".$m_realHouseInsertID."','".$current_user->ID."','0')";
		$wpdb->query($sqlUpdateIt);
		$m_realListingInsertID = mysql_insert_id();
		
		// insert into post table
		$now_excerpt = str_replace(']]>', ']]&gt;', $m_rp_listDescription);
		$now_excerpt = wp_html_excerpt($now_excerpt, 252) . '...';		
		$table_name = $table_prefix . "posts";
		$postStatus='publish';
		$m_realContent = "[tag] begin rpList [/tag]".$m_realListingInsertID."[tag] end rpList [/tag]";
		$sql ="INSERT INTO $table_name(post_author, post_date, post_date_gmt, post_content, post_content_filtered, post_title,post_excerpt,  post_status, comment_status, ping_status, post_password, post_name, to_ping, pinged, post_modified, post_modified_gmt, post_parent, menu_order, post_type)
		VALUES	('".$current_user->ID."', '".date("Y-m-d H:i:s")."', '".gmdate("Y-m-d H:i:s")."', '".addslashes($m_realContent)."', '', '".$m_rp_listTitle."','".addslashes($now_excerpt)."', '".$postStatus."', 'open', 'open', '', '".$m_rp_listTitle."', '', '', '".date("Y-m-d H:i:s")."', '".gmdate("Y-m-d H:i:s")."', '0', '0', 'post')";
		$wpdb->query($sql);
		$realPostId = $wpdb->insert_id;

		$m_table_name = $table_prefix . "realpresshouse";
		$m_updatePostInfoSQL = "update `".$m_table_name."` set `postid` = '".$realPostId."' where `id` = '".$m_realHouseInsertID."'";
		$m_updatePostInfoResult = $wpdb->query($m_updatePostInfoSQL);

		$m_table_name = $table_prefix . "realpresslist";
		$m_updatePostInfoSQL = "update `".$m_table_name."` set `postid` = '".$realPostId."' where `id` = '".$m_realListingInsertID."'";
		$m_updatePostInfoResult = $wpdb->query($m_updatePostInfoSQL);
		
		//mark it is real post
		update_post_meta($realPostId,'realListing','realListing');
		//pphoto
		if (!(class_exists('nggAdmin')))
		{
			update_post_meta($realPostId,'realImage',$m_hadImgNow);
		}
		if ((!(empty($m_realFeatures))) && (sizeof($m_realFeatures)>0))
		{
			update_post_meta($realPostId,'realFeatures',$m_realFeatures);
		}
		$m_realMapPostCode = '';
		if (!(empty($m_rp_listingaddressnumber)))
		{
			$m_realMapPostCode .= " ".$m_rp_listingaddressnumber;
		}
		if (!(empty($m_rp_listingstree)))
		{
			$m_realMapPostCode .= " ".$m_rp_listingstree;
		}
		if (!(empty($m_rp_listingcity)))
		{
			$m_realMapPostCode .= " ".$m_rp_listingcity;
		}
		if (!(empty($m_rp_listingstate)))
		{
			$m_realMapPostCode .= " ".$m_rp_listingstate;
		}
		if (!(empty($m_rpSelectPostCountry)))
		{
			$m_realMapPostCode .= " ".$m_rpSelectPostCountry;
		}
		if (!(empty($m_rp_listPostCode)))
		{
			$m_realMapPostCode .= " ".$m_rp_listPostCode;
		}
		
		if (!(empty($m_realMapPostCode)))
		{
			$m_realMapPostCode = str_replace(" ","%20",$m_realMapPostCode);
			update_post_meta($realPostId,'realMap',$m_realMapPostCode);
		}

		if (!(empty($m_galleryID)))
		{
			update_post_meta($realPostId,'nextgen_gallery',$m_galleryID);
			
		}
		//SEO
		if(!empty($m_rp_menuTitleSEO))
		{
			update_post_meta($realPostId,'realMenuTitleSEO',$m_rp_menuTitleSEO);
		}
		if(!empty($m_rp_metaDescriptionSEO))
		{
			update_post_meta($realPostId,'realMetaDescriptionSEO',$m_rp_metaDescriptionSEO);
		}
		if(!empty($m_rp_metaTitleSEO))
		{
			update_post_meta($realPostId,'realMetaTitleSEO',$m_rp_metaTitleSEO);
		}
		
		//permalimk
		$temp_realPermalink = @get_option('permalink_structure');
		if (!empty($temp_realPermalink))
		{
			$m_newLink = get_the_title($realPostId);
			$m_newLink = sanitize_title($m_newLink);
			$m_newLink = str_replace(' ','-',$m_newLink);
			//$wpdb->query("UPDATE $table_name SET guid = '" . get_permalink($realPostId) . "' WHERE ID = '$realPostId'");
			$wpdb->query("UPDATE $table_name SET guid = '" . $m_newLink . "' WHERE ID = '$realPostId'");
			$wpdb->query("UPDATE $table_name SET post_name = '" . $m_newLink . "' WHERE ID = '$realPostId'");
			$wp_rewrite->flush_rules();
		}

		// setting post tags
		if (!(empty($m_temp_tags)))
		{
			wp_set_post_tags($realPostId,$m_temp_tags,true);
		}
		
		// setting post category
		if (!empty($m_category))
		wp_set_post_categories($realPostId,$m_category);
		realMessage(" <I> Congratulations, The listing published success!</I><br />");

		
	}

	echo '<div id="rp_postform" class="wrap">';
	echo '<div id="rp_head"><Strong>Write your listing</strong></div>';
		
	echo '<form  id="rp_newListingForm" action="" method="POST"  enctype="multipart/form-data" >';
	echo '<div id="rp_postBox">';
	echo '<h5>1. Choose Listing Category:</h5>';
	wp_dropdown_categories(array('hide_empty' => 0,'class' => 'rp_listingcategory', 'name' => 'category_news', 'orderby' => 'name', 'selected' => $m_set_news, 'hierarchical' => true, 'show_option_none' => __('None')));
	echo '</div>';
	

	echo '<div id="rp_postBox">';
	echo '<h5>2. Upload Listing Picture(Optional)</h5>';
	//echo "<input type='file' name='listImage' id='listImage' value='' size=50>";
	//echo "<input type='file' name='rp_ListingPic[]' class='multifiles' id='rp_filebox' accept='gif|jpg|png|jpeg' size='40' />";
	echo '<input type="file" name="imagefiles[]" id="imagefiles" size="35" class="imagefiles"/>';
	echo "<input type='hidden' name='MAX_FILE_SIZE' value='500000000' />";
	echo '</div>';

	echo '<div id="rp_postBox">';
	echo '<h5>3. Use nextgen gallery as simpleviewer?(Optional , <a href="'.get_option('siteurl').'/wp-admin/admin.php?page=nggallery-add-gallery" target="_blank">Create <I>new</I></a> gallery?)</h5>';	
	
	if (class_exists('nggLoader'))
	{
		wp_nonce_field('ngg_addgallery');
		global  $nggdb, $ngg;
		//include_once (NGGALLERY_ABSPATH. 'admin/functions.php');
		$gallerylist = $nggdb->find_all_galleries('gid', 'DESC');
	?>
		<select name="galleryselect" id="galleryselect">
		<option value="0" ><?php _e('Choose gallery : each house use an unique gallery', 'nggallery') ?></option>
		<?php
			foreach($gallerylist as $gallery) 
			{
				if ( !nggAdmin::can_manage_this_gallery($gallery->author) )
					continue;
				$name = ( empty($gallery->title) ) ? $gallery->name : $gallery->title;
				echo '<option value="' . $gallery->gid . '" >' . $gallery->gid . ' - ' . $name . '</option>' . "\n";
			}				
		?>
		</select>
		<?php
	}
	else 
	{
		echo "<I>You did not active nextgen-gallery, go <a href='http://alexrabe.boelinger.com/' target='_blank'>here</a> to download it.</I>";
		echo "<br />";
	}
	echo '</div>';
	
	echo '<div id="rp_postBox">';
	echo '<h5>4. Input Listing Title Here:</h5>';
	echo '<input type="text" id="rp_listTitle" name="rp_listTitle" size="50" >';
	echo '</div>';

	echo '<div id="rp_postBox">';
	echo '<h5>5. Input Listing Description Here <I><font color="Gray">(no HTML)</font></I>:</h5>';
	echo '<textarea id="rp_listDescription" name="rp_listDescription" cols="40" rows="8" ></textarea>';
	echo '</div>';

	echo '<div id="rp_postBox">';
	echo '<h5>6. Select Property Types:</h5>';
	$m_propertyType = realShowPropertyType();
	if ($m_propertyType !== false)
	{
		echo "$m_propertyType";
	}
	else 
	{
		echo "No Any Property Type Found Yet.";
	}	
	echo " <a href = '".get_option('siteurl')."/wp-admin/admin.php?page=".BASE_DIR."/optionsManagement.php#realFieldSettings
'> Add new</a> property types ";	
	echo '</div>';
	
	echo '<div id="rp_postBox">';
	echo '<div id="mapshown"><h5>7. Select Listing Types:</h5></div>';
	$m_listingTyoe = realShowListingType();
	if ($m_listingTyoe !== false)
	{
		echo "$m_listingTyoe";
	}
	else 
	{
		echo "No Any Listing Type Found Yet.";
	}
	echo " <a href = '".get_option('siteurl')."/wp-admin/admin.php?page=".BASE_DIR."/optionsManagement.php#realFieldSettings
'> Add new</a> listing types ";	
	echo '</div>';

	
	echo '<div id="rp_postBox">';
	echo '<h5>8. Input Property Feature Fields:</h5>';
	$m_featureBedrooms = get_option('featureBedrooms');
	if ($m_featureBedrooms == 'YES')
	{
		echo "<input type = 'text' id='rp_featureBedrooms' name='rp_featureBedrooms'  size='3'> Bedrooms";
		echo "<br />";
	}
	$m_featureBathrooms = get_option('featureBathrooms');
	if ($m_featureBathrooms == 'YES')
	{
		echo "<input type = 'text' id='rp_featureBathrooms' name='rp_featureBathrooms'  size='3'> Bathrooms";
		echo "<br />";
	}
	$m_featureGarage = get_option('featureGarage');
	if ($m_featureGarage == 'YES')
	{
		echo "<input type = 'text' id='rp_featureGarage' name='rp_featureGarage'  size='3'> Garage Spaces";
		echo "<br />";
	}
	echo '</div>';

	
	echo '<div id="rp_postBox">';
	echo '<h5>9. Choose Listing Features:</h5>';
	$m_propertyType = realShowListingFeatures();
	if ($m_propertyType !== false)
	{
		echo "$m_propertyType";
	}
	else 
	{
		echo "No Any Property Type Found Yet.";
	}	
	echo '</div>';
	
	echo '<div id="rp_postBox">';
	echo '<h5>10. Input Listing Details:</h5>';
	$m_propertyType = realShowListingDetails();
	if ($m_propertyType !== false)
	{
		echo "$m_propertyType";
	}
	else 
	{
		echo "No Any Property Type Found Yet.";
	}	
	echo '</div>';

	
	echo '<div id="rp_postBox">';
	echo '<h5>11. Add Your Tags Here(comma to split):</h5>';
	echo '<input type="text" id="rp_listTags" name="rp_listTags"> ';
	echo '</div>';

	echo '<div id="rp_postBox">';
	echo '<h5>12. Meta title(Optional):</h5>';
	echo '<input type="text" id="rp_metaTitleSEO" name="rp_metaTitleSEO">';
	echo '</div>';
	
	echo '<div id="rp_postBox">';
	echo '<h5>13. Meta description(Optional):</h5>';
	echo '<input type="text" id="rp_metaDescriptionSEO" name="rp_metaDescriptionSEO">';
	echo '</div>';
	
	echo '<div id="rp_postBox">';
	echo '<h5>14. Menu Title(Optional):</h5>';
	echo '<input type="text" id="rp_menuTitleSEO" name="rp_menuTitleSEO">';
	echo '</div>';
	
	echo '<input type="hidden" id="rp_ListingHidden" name="rp_ListingHidden" value="NONE">';
	echo '<input type="hidden" name="uploadimage" value="NONE" />';
	echo '<br />';
	echo '<br />';

	echo '<div id="rp_listingSubmitDiv">';
	echo '<input type="submit" id="rp_listingSubmit" name="rp_listingSubmit" value="Publish now" style="background:#4682b4;color:#fff;margin-left:220px;">';
	echo '</div>';

	echo '</form>';
	echo '<br />';
	echo '<br />';		
	echo '</div>';
	
	// clear temp tags
	delete_usermeta($current_user->ID,'realListImgTemp');
}



function listingModifyNow()
{
	global $wpdb,$table_prefix,$wp_version,$userdata,$current_user, $user_ID,$post,$wp_rewrite,$nggdb;
	get_currentuserinfo();
	
	$m_modifyPostID = '';
	//init var
	$m_category = '';
	$m_currentPublishUser = $current_user->ID;
	$m_hadImgNow = '';
	$m_rp_menuTitleSEO = '';
	$m_rp_metaDescriptionSEO = '';
	$m_rp_metaTitleSEO = '';
	$m_temp_tags = '';
	$m_rp_listingagentid = '';
	$m_rp_listingcurrencyid = '';
	$m_rp_listingacres = '';
	$m_rp_listingyearbuild = '';
	$m_rp_listingsaled_price = '';
	$m_rp_listingprice_total = '';
	$m_rp_listingprice_sqft = '';
	$m_rp_listingsqft = '';
	$m_rp_listingmlsid = '';
	$m_rp_listingneighborhood = '';
	$m_rpSelectPostCountry = '';
	$m_rp_listingstate = '';
	$m_rp_listingcity = '';
	$m_rp_listingstree = '';
	$m_rp_listPostCode = '';
	$m_rp_listingaddressnumber = '';
	$m_realFeatures = '';
	$m_rp_featureGarage = '';
	$m_rp_featureBathrooms = '';
	$m_rp_featureBedrooms = '';
	$m_rpSelectListingTypes = '';
	$m_rpSelectPropertyTypes = '';
	$m_rp_listDescription = '';
	$m_rp_listTitle = '';
	$m_hadImgNow = '';
	$m_listingTempProperty = '';
	$m_listingPropertyArray	= '';
	$m_realFeaturesString = '';
	$m_galleryID = '';
	$m_rp_listingstatus = '';
	$m_rp_listingfeatured = '';
	

	// begin deal with user submit
	if (isset($_POST['rp_UpdateHidden']))
	{
		$m_updateNowID = $wpdb->escape($_POST['rp_UpdateHidden']);
		$m_updateHouseID = realGetPostHoustID($m_updateNowID);
		if (empty($m_updateHouseID))
		{
			realMessage("Sorry, we can not find this house id");
			die("Please contact administrator, thanks");
		}
		// deal with category
		if (isset($_POST['category_news']))
		{
			//$m_category = $wpdb->escape($_POST['category_news']);
			$m_category = $wpdb->escape($_POST['category_news']);
		}
		
		// deal with upload image
		if ($_POST['uploadimage'])
		{
			if (class_exists('nggAdmin'))
			{
				check_admin_referer('ngg_addgallery');
				if ( $_FILES['imagefiles']['error'][0] == 0 )
				{
					if (isset($_POST['galleryselect']))
					{
						$galleryID = (int) $_POST['galleryselect'];
						if ($galleryID == 0) 
						{
							nggGallery::show_error(__('No gallery selected !','nggallery'));
							return;	
						}

						// get the path to the gallery	
						$gallery = $nggdb->find_gallery($galleryID);

						if ( empty($gallery->path) )
						{
							nggGallery::show_error(__('Failure in database, no gallery path set !','nggallery'));
							return;
						} 						
					}
					$messagetext = nggAdmin::upload_images();
					$m_galleryID = $wpdb->escape($_POST['galleryselect']);
				}
				/*
				else
					nggGallery::show_error( __('Upload failed!','nggallery') );	
				*/
			}
			else 
			{
				$m_currentPublishUser = $current_user->ID;
				$imagefiles = $_FILES['imagefiles'];
				if (is_array($imagefiles)) 
				{
					foreach ($imagefiles['name'] as $key => $value) 
					{
						if (!(preg_match("/\.(png|jp(e)*g|gif){1}$/i",$value)))
						{
							realMessage("Sorry, we only allow upload png,jp(e)g,gig files,please try again.");
							delete_usermeta($current_user->ID,'realListImgTemp');
							return;
						}
						// look only for uploded files
						if ($imagefiles['error'][$key] == 0)
						{
							$temp_file = $imagefiles['tmp_name'][$key];

							$file_name = $imagefiles["name"][$key];
							$new_file_name = md5(uniqid(rand())) . "_". $file_name;
							
							if(@is_uploaded_file($imagefiles["tmp_name"][$key]))
							{
								$imgDirs = wp_upload_dir();
								if(move_uploaded_file($imagefiles["tmp_name"][$key],$imgDirs['path']."/".$new_file_name))
								{
									$m_image_path = $imgDirs['url']."/".$new_file_name;
									$m_hadImgNow = get_usermeta($current_user->ID,'realListImgTemp');
									if (!empty($m_hadImgNow))
									{
										$m_hadImgNow[] = $m_image_path;
									}
									else 
									{
										$m_hadImgNow = array();
										$m_hadImgNow[0] = $m_image_path;
									}
									update_usermeta($current_user->ID,'realListImgTemp',$m_hadImgNow);
									realMessage("<br /><I>The picture($new_file_name) upload success!</I><br />");
								}
								else
								{
									realMessage("File upload error($new_file_name),maybe you did not create 'uploads' in direction 'wp-content' or can not write in this directory.");
								}
							}							
						}
					}
				}
			}
		}
		// end upload image
		
		// title
		if (isset($_POST['rp_listTitle']))
		{
			$m_rp_listTitle = $wpdb->escape($_POST['rp_listTitle']);
		}
		
		// description
		if (isset($_POST['rp_listDescription']))
		{
			$m_rp_listDescription = $wpdb->escape($_POST['rp_listDescription']);
		}
		
		// property types
		if (isset($_POST['rpSelectPropertyTypes']))
		{
			$m_rpSelectPropertyTypes = $wpdb->escape($_POST['rpSelectPropertyTypes']);
		}
		
		// listing types
		if (isset($_POST['rpSelectListingTypes']))
		{
			$m_rpSelectListingTypes = $wpdb->escape($_POST['rpSelectListingTypes']);
		}
		
		// property features bedroom
		if (isset($_POST['rp_featureBedrooms']))
		{
			$m_rp_featureBedrooms = $wpdb->escape($_POST['rp_featureBedrooms']);
			$m_listingTempProperty = $m_rp_featureBedrooms." Bedrooms";
			if (empty($m_listingPropertyArray))
			{
				$m_listingPropertyArray = array();
			}
			$m_listingPropertyArray[] = $m_rp_featureBedrooms;
		}
		// status
		if (isset($_POST['rp_listingstatus']))
		{
			if ($_POST['rp_listingstatus'] == 'NONE') 
			{
				$m_rp_listingstatus = '';
			}
			else 
			{
				$m_rp_listingstatus = $wpdb->escape($_POST['rp_listingstatus']);
			}
			
		}
		// featured?
		if (isset($_POST['rp_listingfeatured']))
		{
			$m_rp_listingfeatured = $wpdb->escape($_POST['rp_listingfeatured']);
		}
				
		// property features bathroom
		if (isset($_POST['rp_featureBathrooms']))
		{
			$m_rp_featureBathrooms = $wpdb->escape($_POST['rp_featureBathrooms']);
			if (empty($m_listingTempProperty))
			{
				$m_listingTempProperty = $m_rp_featureBathrooms;
			}
			else 
			{
				$m_listingTempProperty .= " , ".$m_rp_featureBathrooms." Bathrooms";
			}
			if (empty($m_listingPropertyArray))
			{
				$m_listingPropertyArray = array();
			}
			$m_listingPropertyArray[] = $m_rp_featureBathrooms;
		}

		// property features garage
		if (isset($_POST['rp_featureGarage']))
		{
			$m_rp_featureGarage = $wpdb->escape($_POST['rp_featureGarage']);
			if (empty($m_listingTempProperty))
			{
				$m_listingTempProperty = $m_rp_featureGarage;
			}
			else 
			{
				$m_listingTempProperty .= " , ".$m_rp_featureGarage." Garage Spaces";
			}
			if (empty($m_listingPropertyArray))
			{
				$m_listingPropertyArray = array();
			}
			$m_listingPropertyArray[] = $m_rp_featureGarage;
		}
		
		//Listing Features
		$m_listingTempTypes = get_option('realpressFeatures');
		if (!(empty($m_listingTempTypes)))
		{
			$m_realFeatures = array();
			$di = 0;
			foreach ($m_listingTempTypes as $m_listingFeaturesNow)
			{
				if (isset($_POST['realFeatures'.$di]))
				{
					$m_realFeatures[] = $di;
					if (($_POST['realFeatures'.$di]) == 'YES')
					{
						if (empty($m_realFeaturesString))
						{
							$m_realFeaturesString = $m_listingFeaturesNow;
						}
						else 
						{
							$m_realFeaturesString .= " , ".$m_listingFeaturesNow;
						}
					}
				}
				//$m_listingFeaturesNow;
				$di++;
			}
		}
		//listing details		
		/*
		//Listing Features
		$m_listingTempTypes = get_option('realpressFeatures');
		if (!(empty($m_listingTempTypes)))
		{
			$m_realFeatures = array();
			$di = 0;
			foreach ($m_listingTempTypes as $m_listingFeaturesNow)
			{
				if (isset($_POST['realFeatures'.$di]))
				{
					$m_realFeatures[] = $di;
					if (empty($m_realFeaturesString))
					{
						$m_realFeaturesString = $wpdb->escape($_POST['realFeatures'.$di]);
					}
					else 
					{
						$m_realFeaturesString .= " , ".$wpdb->escape($_POST['realFeatures'.$di]);
					}
				}
				//$m_listingFeaturesNow;
				$di++;
			}
		}
		
		//listing details
		*/
		if (!(empty($_POST['rp_listingaddressnumber'])))
		{
			$m_rp_listingaddressnumber = $wpdb->escape($_POST['rp_listingaddressnumber']);
		}
		if (!(empty($_POST['rp_listPostCode'])))
		{
			$m_rp_listPostCode = $wpdb->escape($_POST['rp_listPostCode']);
		}
		if (!(empty($_POST['rp_listingstree'])))
		{
			$m_rp_listingstree = $wpdb->escape($_POST['rp_listingstree']);
		}
		if (!(empty($_POST['rp_listingcity'])))
		{
			$m_rp_listingcity = $wpdb->escape($_POST['rp_listingcity']);
		}
		if (!(empty($_POST['rp_listingstate'])))
		{
			$m_rp_listingstate = $wpdb->escape($_POST['rp_listingstate']);
		}
		if (!(empty($_POST['rpSelectPostCountry'])))
		{
			$m_rpSelectPostCountry = $wpdb->escape($_POST['rpSelectPostCountry']);
		}
		if (!(empty($_POST['rp_listingneighborhood'])))
		{
			$m_rp_listingneighborhood = $wpdb->escape($_POST['rp_listingneighborhood']);
		}
		if (!(empty($_POST['rp_listingmlsid'])))
		{
			$m_rp_listingmlsid = $wpdb->escape($_POST['rp_listingmlsid']);
		}
		if (!(empty($_POST['rp_listingsqft'])))
		{
			$m_rp_listingsqft = $wpdb->escape($_POST['rp_listingsqft']);
		}
		if (!(empty($_POST['rp_listingprice_sqft'])))
		{
			$m_rp_listingprice_sqft = $wpdb->escape($_POST['rp_listingprice_sqft']);
		}
		if (!(empty($_POST['rp_listingprice_total'])))
		{
			$m_rp_listingprice_total = $wpdb->escape($_POST['rp_listingprice_total']);
		}
		if (!(empty($_POST['rp_listingsaled_price'])))
		{
			$m_rp_listingsaled_price = $wpdb->escape($_POST['rp_listingsaled_price']);
		}
		if (!(empty($_POST['rp_listingyearbuild'])))
		{
			$m_rp_listingyearbuild = $wpdb->escape($_POST['rp_listingyearbuild']);
		}
		if (!(empty($_POST['rp_listingacres'])))
		{
			$m_rp_listingacres = $wpdb->escape($_POST['rp_listingacres']);
		}
		if (!(empty($_POST['rp_listingcurrencyid'])))
		{
			$m_rp_listingcurrencyid = $wpdb->escape($_POST['rp_listingcurrencyid']);
		}
		if (!(empty($_POST['rp_listingagentid'])))
		{
			$m_rp_listingagentid = $wpdb->escape($_POST['rp_listingagentid']);
		}
		
		//tags
		if (!(empty($_POST['rp_listTags'])))
		{
			$m_temp_tags  = $wpdb->escape($_POST['rp_listTags']);
		}

		if (!(empty($_POST['rp_metaTitleSEO'])))
		{
			$m_rp_metaTitleSEO = $wpdb->escape($_POST['rp_metaTitleSEO']);
		}
		
		if (!(empty($_POST['rp_metaDescriptionSEO'])))
		{
			$m_rp_metaDescriptionSEO = $wpdb->escape($_POST['rp_metaDescriptionSEO']);
		}		
		
		if (!(empty($_POST['rp_menuTitleSEO'])))
		{
			$m_rp_menuTitleSEO = $wpdb->escape($_POST['rp_menuTitleSEO']);
		}
		
		// update into house table
		//$m_updateNowID
		$table_name = $table_prefix . "realpresshouse";
		$sqlUpdateIt ="UPDATE `$table_name` 
		SET `addressnumber` = '$m_rp_listingaddressnumber', `stree` = '$m_rp_listingstree', 
		`city` = '$m_rp_listingcity', `state` = '$m_rp_listingstate',
		`country` = '$m_rpSelectPostCountry' , `postcode` = '$m_rp_listPostCode' , 
		`propertytype` = '$m_rpSelectPropertyTypes' , `listingtype` =  '$m_rpSelectListingTypes', 
		`propertyfeatures` = '$m_listingTempProperty' , `listingfeatures` =  '$m_realFeaturesString', 
		`neighborhood` = '$m_rp_listingneighborhood' , `mls` =  '$m_rp_listingmlsid',
		`sqft` = '$m_rp_listingsqft' ,`price_sqft` = '$m_rp_listingprice_sqft' ,
		`price_total` = '$m_rp_listingprice_total' ,`saled_price` = '$m_rp_listingsaled_price' ,
		`wp_userid` = '$current_user->ID' ,`yearbuild` = '$m_rp_listingyearbuild' ,
		`beds` = '$m_rp_featureBedrooms' ,`baths` =  '$m_rp_featureBathrooms',
		`garages` = '$m_rp_featureGarage' ,`acres` =  '$m_rp_listingacres',
		`listdate` = date('Y-m-d H:i:s') ,`currencyid` =  '$m_rp_listingcurrencyid',
		`agentid` = '$m_rp_listingagentid' ,`status` = '$m_rp_listingstatus' ,
		`featured` = '$m_rp_listingfeatured', `valid` =  'YES',
		`description` = '$m_rp_listDescription' WHERE `id` = '$m_updateHouseID'";
		$wpdb->query($sqlUpdateIt);
		$m_realHouseInsertID = mysql_insert_id();

		/*
		$table_name = $table_prefix . "realpresslist";
		$sqlUpdateIt ="INSERT INTO $table_name(houseid, wp_userid, total_view) 
		VALUES ('".$m_realHouseInsertID."','".$current_user->ID."','0')";
		$wpdb->query($sqlUpdateIt);
		$m_realListingInsertID = mysql_insert_id();
		*/
		// insert into post table
		$now_excerpt = str_replace(']]>', ']]&gt;', $m_rp_listDescription);
		$now_excerpt = wp_html_excerpt($now_excerpt, 252) . '...';		
		$table_name = $table_prefix . "posts";
		$postStatus='publish';
		//$m_realContent = "[tag] begin rpList [/tag]".$m_realListingInsertID."[tag] end rpList [/tag]";
//		$sql ="INSERT INTO $table_name(post_author, post_date, post_date_gmt, post_content, post_content_filtered, post_title,post_excerpt,  post_status, comment_status, ping_status, post_password, post_name, to_ping, pinged, post_modified, post_modified_gmt, post_parent, menu_order, post_type)
		//VALUES	('".$current_user->ID."', '".date("Y-m-d H:i:s")."', '".gmdate("Y-m-d H:i:s")."', '".addslashes($m_realContent)."', '', '".$m_rp_listTitle."','".addslashes($now_excerpt)."', '".$postStatus."', 'open', 'open', '', '".$m_rp_listTitle."', '', '', '".date("Y-m-d H:i:s")."', '".gmdate("Y-m-d H:i:s")."', '0', '0', 'post')";
		$sql ="UPDATE `$table_name` SET `post_author` = '$current_user->ID', 
		`post_date` = '".date("Y-m-d H:i:s")."', `post_date_gmt` = '".gmdate("Y-m-d H:i:s")."'
		,`post_title` = '$m_rp_listTitle',`post_excerpt` = 'addslashes($now_excerpt)',  
		`post_status` = '$postStatus', `post_name` = '$m_rp_listTitle' WHERE `ID` = '$m_updateNowID'";
		if (!empty($m_updateNowID))
		{
			$wpdb->query($sql);
		}
		$realPostId = $m_updateNowID;
/*
		$m_table_name = $table_prefix . "realpresshouse";
		$m_updatePostInfoSQL = "update `".$m_table_name."` set `postid` = '".$realPostId."' where `id` = '".$m_realHouseInsertID."'";
		$m_updatePostInfoResult = $wpdb->query($m_updatePostInfoSQL);

		$m_table_name = $table_prefix . "realpresslist";
		$m_updatePostInfoSQL = "update `".$m_table_name."` set `postid` = '".$realPostId."' where `id` = '".$m_realListingInsertID."'";
		$m_updatePostInfoResult = $wpdb->query($m_updatePostInfoSQL);
*/		
		//mark it is real post
		update_post_meta($realPostId,'realListing','realListing');
		//pphoto
		if (!(class_exists('nggAdmin')))
		{
			update_post_meta($realPostId,'realImage',$m_hadImgNow);
		}
		
		$m_realMapPostCode = '';
		if (!(empty($m_rp_listingaddressnumber)))
		{
			$m_realMapPostCode .= " ".$m_rp_listingaddressnumber;
		}
		if (!(empty($m_rp_listingstree)))
		{
			$m_realMapPostCode .= " ".$m_rp_listingstree;
		}
		if (!(empty($m_rp_listingcity)))
		{
			$m_realMapPostCode .= " ".$m_rp_listingcity;
		}
		if (!(empty($m_rp_listingstate)))
		{
			$m_realMapPostCode .= " ".$m_rp_listingstate;
		}
		if (!(empty($m_rpSelectPostCountry)))
		{
			$m_realMapPostCode .= " ".$m_rpSelectPostCountry;
		}
		if (!(empty($m_rp_listPostCode)))
		{
			$m_realMapPostCode .= " ".$m_rp_listPostCode;
		}
		
		if (!(empty($m_realMapPostCode)))
		{
			$m_realMapPostCode = str_replace(" ","%20",$m_realMapPostCode);
			update_post_meta($realPostId,'realMap',$m_realMapPostCode);
		}

		if (!(empty($m_galleryID)))
		{
			update_post_meta($realPostId,'nextgen_gallery',$m_galleryID);
			
		}
		//SEO
		if(!empty($m_rp_menuTitleSEO))
		{
			update_post_meta($realPostId,'realMenuTitleSEO',$m_rp_menuTitleSEO);
		}
		if(!empty($m_rp_metaDescriptionSEO))
		{
			update_post_meta($realPostId,'realMetaDescriptionSEO',$m_rp_metaDescriptionSEO);
		}
		if(!empty($m_rp_metaTitleSEO))
		{
			update_post_meta($realPostId,'realMetaTitleSEO',$m_rp_metaTitleSEO);
		}
		
		//permalimk
		$temp_realPermalink = @get_option('permalink_structure');
		if (!empty($temp_realPermalink))
		{
			$table_name = $table_prefix."posts";
			$m_newLink = get_the_title($realPostId);
			$m_newLink = sanitize_title($m_newLink);
			$m_newLink = str_replace(' ','-',$m_newLink);
			//$wpdb->query("UPDATE $table_name SET guid = '" . get_permalink($realPostId) . "' WHERE ID = '$realPostId'");
			$wpdb->query("UPDATE $table_name SET guid = '" . $m_newLink . "' WHERE ID = '$realPostId'");
			$wpdb->query("UPDATE $table_name SET post_name = '" . $m_newLink . "' WHERE ID = '$realPostId'");
			$wp_rewrite->flush_rules();
		}

		// setting post tags
		if (!(empty($m_temp_tags)))
		{
			wp_set_post_tags($realPostId,$m_temp_tags,true);
		}
		
		// setting post category
		if (!empty($m_category))
		wp_set_post_categories($realPostId,$m_category);
		realMessage(" <I> Congratulations, The listing updated success!</I><br />");
		
	}

	
	if (isset($_GET['modifyid']))
	{
		$m_modifyPostID = $wpdb->escape($_GET['modifyid']);
		$m_modifyHouseID = realGetPostHoustID($m_modifyPostID);
		if (empty($m_modifyHouseID))
		{
			die("Error House ID");
		}
		$p_houseID = $m_modifyHouseID;
		$m_category = wp_get_post_categories($m_modifyPostID);
		if ((!(empty($m_category))) && (count($m_category)>0))
		{
			$m_category = $m_category[0];
		}
		$m_rp_menuTitleSEO = get_post_meta($m_modifyPostID,'realMenuTitleSEO');
		$m_rp_metaDescriptionSEO = get_post_meta($m_modifyPostID,'realMetaDescriptionSEO');
		$m_rp_metaTitleSEO = get_post_meta($m_modifyPostID,'realMetaTitleSEO');
		
		$m_temp_tags = '';
		$m_temp_tagsArray = get_the_tags($m_modifyPostID);
		if ($m_temp_tagsArray)
		{
			foreach ($m_temp_tagsArray as $m_temp_tagsArray)
			{
				if (empty($m_temp_tags))
				{
					$m_temp_tags = $m_temp_tagsArray->name;
				}
				else 
				{
					$m_temp_tags .= ",".$m_temp_tagsArray->name;
				}
			}
		}
		$m_rp_listingagentid = realGetHouseDetails($p_houseID,'agentid');
		$m_rp_listingcurrencyid = realGetHouseDetails($p_houseID,'currencyid');
		$m_rp_listingacres = realGetHouseDetails($p_houseID,'acres');		
		$m_rp_listingyearbuild = realGetHouseDetails($p_houseID,'yearbuild');
		$m_rp_listingsaled_price = realGetHouseDetails($p_houseID,'saled_price');		
		$m_rp_listingprice_total = realGetHouseDetails($p_houseID,'price_total');		
		$m_rp_listingprice_sqft = realGetHouseDetails($p_houseID,'price_sqft');
		$m_rp_listingsqft = realGetHouseDetails($p_houseID,'sqft');
		$m_rp_listingmlsid = realGetHouseDetails($p_houseID,'mls');
		$m_rp_listingneighborhood = realGetHouseDetails($p_houseID,'neighborhood');		
		$m_rpSelectPostCountry = realGetHouseDetails($p_houseID,'country');		
		$m_rp_listingstate = realGetHouseDetails($p_houseID,'state');
		$m_rp_listingcity = realGetHouseDetails($p_houseID,'city');
		$m_rp_listingstree = realGetHouseDetails($p_houseID,'stree');
		$m_rp_listPostCode = realGetHouseDetails($p_houseID,'postcode');
		$m_rp_listingaddressnumber = realGetHouseDetails($p_houseID,'addressnumber');
		//$m_realFeatures = realGetHouseDetails($p_houseID,'listingfeatures');
		$m_realFeatures = get_post_meta($m_modifyPostID,'realFeatures');
		$m_realFeaturesString = realGetHouseDetails($p_houseID,'listingfeatures');
		$m_rp_featureGarage = realGetHouseDetails($p_houseID,'garages');
		$m_rp_featureBathrooms = realGetHouseDetails($p_houseID,'baths');
		$m_rp_featureBedrooms = realGetHouseDetails($p_houseID,'beds');
		$m_rpSelectListingTypes = realGetHouseDetails($p_houseID,'listingtype');
		$m_rpSelectPropertyTypes = realGetHouseDetails($p_houseID,'propertytype');
		$m_rp_listDescription = realGetHouseDetails($p_houseID,'description');	
		$m_rp_listTitle = realGetTrueTitle($m_modifyPostID);
		//$m_rp_listTitle = get_the_title($m_modifyPostID);
		//$m_hadImgNow =
		//$m_listingTempProperty
		$m_propertyfeatures = realGetHouseDetails($p_houseID,'propertyfeatures');
		$m_galleryID = get_post_meta($realPostId,'nextgen_gallery');
		$m_rp_listingstatus = realGetHouseDetails($p_houseID,'status');
		$m_rp_listingfeatured = realGetHouseDetails($p_houseID,'featured');
		//$m_listdate = realGetHouseDetails($p_houseID,'listdate');
		//$m_saledate = realGetHouseDetails($p_houseID,'saledate');
	}	
	
	echo '<div id="rp_postform" class="wrap">';
	echo '<div id="rp_head"><Strong>Edit your listing</strong></div>';
		
	echo '<form  id="rp_newListingForm" action="" method="POST"  enctype="multipart/form-data" >';
	echo '<div id="rp_postBox">';
	echo '<h5>1. Choose Listing Category:</h5>';
	
	if (!(empty($m_category)))
	{
		wp_dropdown_categories(array('hide_empty' => 0,'class' => 'rp_listingcategory', 'selected' => $m_category ,'name' => 'category_news', 'orderby' => 'name',  'hierarchical' => true, 'show_option_none' => __('None')));
	}
	else 
	{
		wp_dropdown_categories(array('hide_empty' => 0,'class' => 'rp_listingcategory', 'name' => 'category_news', 'orderby' => 'name',  'hierarchical' => true, 'show_option_none' => __('None')));
	}
	
	echo '</div>';
	

	echo '<div id="rp_postBox">';
	echo '<h5>2. Upload Listing Picture(Optional)</h5>';
	//echo "<input type='file' name='listImage' id='listImage' value='' size=50>";
	//echo "<input type='file' name='rp_ListingPic[]' class='multifiles' id='rp_filebox' accept='gif|jpg|png|jpeg' size='40' />";
	echo '<input type="file" name="imagefiles[]" id="imagefiles" size="35" class="imagefiles"/>';
	echo "<input type='hidden' name='MAX_FILE_SIZE' value='500000000' />";
	echo '</div>';

	echo '<div id="rp_postBox">';
	echo '<h5>3. Use nextgen gallery as simpleviewer?(Optional , <a href="'.get_option('siteurl').'/wp-admin/admin.php?page=nggallery-add-gallery" target="_blank">Create <I>new</I></a> gallery?)</h5>';	
	
	if (class_exists('nggLoader'))
	{
		wp_nonce_field('ngg_addgallery');
		global  $nggdb, $ngg;
		//include_once (NGGALLERY_ABSPATH. 'admin/functions.php');
		$gallerylist = $nggdb->find_all_galleries('gid', 'DESC');
	?>
		<select name="galleryselect" id="galleryselect">
		<option value="0" ><?php _e('Choose gallery : each house use an unique gallery', 'nggallery') ?></option>
		<?php
			foreach($gallerylist as $gallery) 
			{
				if ( !nggAdmin::can_manage_this_gallery($gallery->author) )
					continue;
				$name = ( empty($gallery->title) ) ? $gallery->name : $gallery->title;
				echo '<option value="' . $gallery->gid . '" >' . $gallery->gid . ' - ' . $name . '</option>' . "\n";
			}				
		?>
		</select>
		<?php
	}
	else 
	{
		echo "<I>You did not active nextgen-gallery, go <a href='http://alexrabe.boelinger.com/' target='_blank'>here</a> to download it.</I>";
		echo "<br />";
	}
	echo '</div>';
	
	echo '<div id="rp_postBox">';
	echo '<h5>4. Input Listing Title Here:</h5>';
	echo '<input type="text" id="rp_listTitle" name="rp_listTitle" size="50" value="'.$m_rp_listTitle.'">';
	echo '</div>';

	echo '<div id="rp_postBox">';
	echo '<h5>5. Input Listing Description Here <I><font color="Gray">(no HTML)</font></I>:</h5>';
	echo '<textarea id="rp_listDescription" name="rp_listDescription" cols="40" rows="8" >'.$m_rp_listDescription.'</textarea>';
	echo '</div>';

	echo '<div id="rp_postBox">';
	echo '<h5>6. Select Property Types:</h5>';
	$m_propertyType = realShowPropertyType($m_rpSelectPropertyTypes);
	if ($m_propertyType !== false)
	{
		echo "$m_propertyType";
	}
	else 
	{
		echo "No Any Property Type Found Yet.";
	}
	echo " <a href = '".get_option('siteurl')."/wp-admin/admin.php?page=".BASE_DIR."/optionsManagement.php#realFieldSettings
'> Add new</a> property types ";
	echo '</div>';
	
	echo '<div id="rp_postBox">';
	echo '<div id="mapshown"><h5>7. Select Listing Types:</h5></div>';
	$m_listingTyoe = realShowListingType($m_rpSelectListingTypes);
	if ($m_listingTyoe !== false)
	{
		echo "$m_listingTyoe";
	}
	else 
	{
		echo "No Any Listing Type Found Yet.";
	}
	echo " <a href = '".get_option('siteurl')."/wp-admin/admin.php?page=".BASE_DIR."/optionsManagement.php#realFieldSettings
'> Add new1</a> listing types ";		
	echo '</div>';

	
	echo '<div id="rp_postBox">';
	echo '<h5>8. Input Property Feature Fields:</h5>';
	$m_featureBedrooms = get_option('featureBedrooms');
	if ($m_featureBedrooms == 'YES')
	{
		echo "<input type = 'text' id='rp_featureBedrooms' name='rp_featureBedrooms'  size='3' value='$m_rp_featureBedrooms'> Bedrooms";
		echo "<br />";
	}
	$m_featureBathrooms = get_option('featureBathrooms');
	if ($m_featureBathrooms == 'YES')
	{
		echo "<input type = 'text' id='rp_featureBathrooms' name='rp_featureBathrooms'  size='3' value='$m_rp_featureBathrooms'> Bathrooms";
		echo "<br />";
	}
	$m_featureGarage = get_option('featureGarage');
	if ($m_featureGarage == 'YES')
	{
		echo "<input type = 'text' id='rp_featureGarage' name='rp_featureGarage'  size='3' value='$m_rp_featureGarage'> Garage Spaces";
		echo "<br />";
	}
	echo '</div>';
	
	echo '<div id="rp_postBox">';
	echo '<h5>9. Choose Listing Features:</h5>';
	if ((is_array($m_realFeatures)) && (sizeof($m_realFeatures) > 0))
	{
		$m_propertyType = realShowListingFeatures($m_realFeatures[0]);
	}
	else 
	{
		$m_propertyType = realShowListingFeatures();
	}
	if ($m_propertyType !== false)
	{
		echo "$m_propertyType";
	}
	else 
	{
		echo "No Any Property Type Found Yet.";
	}	
	echo '</div>';
	
	echo '<div id="rp_postBox">';
	echo '<h5>10. Input Listing Details:</h5>';
	$m_propertyType = realShowListingDetails($p_houseID);
	if ($m_propertyType !== false)
	{
		echo "$m_propertyType";
	}
	else 
	{
		echo "No Any Property Type Found Yet.";
	}	
	echo '</div>';

	
	echo '<div id="rp_postBox">';
	echo '<h5>11. Add Your Tags Here(comma to split):</h5>';
	echo '<input type="text" id="rp_listTags" name="rp_listTags" value="'.$m_temp_tags.'"> ';
	echo '</div>';

	echo '<div id="rp_postBox">';
	echo '<h5>12. Meta title(Optional):</h5>';
	echo '<input type="text" id="rp_metaTitleSEO" name="rp_metaTitleSEO" value="'.$m_rp_metaTitleSEO[0].'">';
	echo '</div>';
	
	echo '<div id="rp_postBox">';
	echo '<h5>13. Meta description(Optional):</h5>';
	echo '<input type="text" id="rp_metaDescriptionSEO" name="rp_metaDescriptionSEO" value="'.$m_rp_metaDescriptionSEO[0].'">';
	echo '</div>';
	
	echo '<div id="rp_postBox">';
	echo '<h5>14. Menu Title(Optional):</h5>';
	echo '<input type="text" id="rp_menuTitleSEO" name="rp_menuTitleSEO" value="'.$m_rp_menuTitleSEO[0].'">';
	echo '</div>';
	
	echo '<input type="hidden" id="rp_UpdateHidden" name="rp_UpdateHidden" value="'.$m_modifyPostID.'">';
	echo '<input type="hidden" name="uploadimage" value="NONE" />';
	echo '<br />';
	echo '<br />';

	echo '<div id="rp_listingSubmitDiv">';
	echo '<input type="submit" id="rp_listingSubmit" name="rp_listingSubmit" value="Update now" style="background:#4682b4;color:#fff;margin-left:220px;">';
	echo '</div>';

	echo '</form>';
	echo '<br />';
	echo '<br />';		
	echo '</div>';
	
	// clear temp tags
	delete_usermeta($current_user->ID,'realListImgTemp');
}



?>