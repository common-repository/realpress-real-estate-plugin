<?php
include_once (ABSPATH.'/wp-content/plugins/nextgen-gallery/nggfunctions.php');
include_once (ABSPATH. '/wp-content/plugins/nextgen-gallery/admin/functions.php');
global $wpdb,$table_prefix,$wp_version,$userdata,$current_user, $user_ID,$post,$wp_rewrite,$nggdb;
	
if (isset($_POST['realpresshiddendelete']))
{
	$m_postDeleteId = $wpdb->escape($_POST['realpresshiddendelete']);
	$m_houseDeleteId = realGetPostHoustID($m_postDeleteId);
	
	$m_table = $table_prefix."posts";
	$m_sql = "delete from `".$m_table."` where `ID` = $m_postDeleteId";
	$m_result = $wpdb->query($m_sql);
	$m_table = $table_prefix."realpresshouse";

	if ($m_houseDeleteId)
		$m_sql = "delete from `".$m_table."` where `id` = $m_houseDeleteId";
	else
		$m_sql = "delete from `".$m_table."` where `postid` = $m_postDeleteId";
	
	$m_result = $wpdb->query($m_sql);	
	realMessage("This post have been deleted !");
}
listingManager();

/***************************************************************/
/****  function:listingManager                          ********/
/****  usage: listing Manager in plugin menu            ********/
/***************************************************************/
function listingManager()
{
	global $wpdb,$table_prefix,$wp_version,$userdata,$current_user, $user_ID,$post,$wp_rewrite,$nggdb;
	get_currentuserinfo();

	$m_table = $table_prefix."realpresshouse";
	if ((isset($_GET['realsort'])) && ($_GET['realsort'] == 'agengid'))
	{
		$m_sql = "select * from `".$m_table."` order by `agentid`";
	}
	else 
	{
		$m_sql = "select * from `".$m_table."`";
	}
	
	$m_result = $wpdb->get_results($m_sql);
	
	if (empty($m_result))
	{
		realMessage('Sorry, no any house listing found yet.');
		return;
	}
	

?>
	<div class="wrap">
	<h2>Listings Management</h2>
	<ul class="subsubsub"><li>All Listings(<I>click link to  edit</I>)</li></ul>

	<table class="widefat">
	<thead>
	<tr>
	<th scope="col">Published</th>
	<th scope="col">Thumbnail</th>
	<th scope="col">Title</th>
	<th><a href="<?php  echo get_option('siteurl').'/wp-admin/admin.php?page='.BASE_DIR.'/listManagement.php&realsort=agengid';  ?>">Agent ID  </a></th>
	<th scope="col">Valid</th>

	<th scope="col">Featured</th>
	<th scope="col">Sold</th>
	</tr>
	</thead>
	<tbody>
	<?php
		$i = 0;
		foreach ($m_result as $m_now)
		{
			$m_hadImgNow = '';
			$m_published = '';
			$m_postID = '';
			$m_galleryID = '';
			$m_houseID = '';
			
			if (empty($m_now->postid)) continue;
			$m_postID=$m_now->postid;
			$m_houseID=$m_now->id;
			
			$m_published =  get_post_status($m_postID);
			if ('publish' == $m_published)
			{
				$m_published = 'Published';
			}

			$m_galleryID = get_post_meta($m_postID,'nextgen_gallery');
			
			if (empty($m_galleryID))
			{
				$m_hadImgNow = get_post_meta($m_postID,'realImage');
				if ((is_array($m_hadImgNow)) && (sizeof($m_hadImgNow)>0))
				{
					$m_hadImgNow = $m_hadImgNow[0][0];
				}
				else 
				{
					$m_hadImgNow = '';
				}
			}
			
			$m_rp_menuTitleSEO = get_post_meta($m_postID,'realMetaDescriptionSEO');
			if (empty($m_rp_menuTitleSEO))
			{
				$m_title = get_the_title($m_postID);
			}
			else 
			{
				$m_title = $m_rp_menuTitleSEO[0];
			}
			
			$m_status = $m_now->valid;
			if ($m_status == 'YES')
			{
				$m_status = 'actived';
			}
			else 
			{
				$m_status = 'inactived';
			}

			$m_featured = $m_now->featured;
			if ($m_featured == 'YES')
			{
				$m_featured = 'Featured';
			}
			else 
			{
				$m_featured = 'No';
			}
			
			$m_saled_price = $m_now->saled_price;

	?>
			<tr><td><a href="#publishbox" onclick='realActive(<?php echo $m_houseID ; ?>,"<?php echo 'publish';  ?>",<?php echo $i; ?>)'><div id='rp_show_publish<?php echo $i; ?>'><?php echo $m_published; ?></div></a></td>
			<td>
			<?php
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
						echo '<img src ="'.$m_hadImgNow.'" width="60px" height="40px" >';
						if (is_int($i/2))
						{
							$m_bigImage = 'images5.jpg';
						}
						else
						{
							$m_bigImage = 'images3.jpeg';
						}
						$m_secreenshotPath = realpressGetSystemPic($m_bigImage);
						echo "<a href='".$m_hadImgNow."' title='Listing Picture' alt='Click me to see big picture' class='thickbox'>".' <img style="margin-left:15px;padding-bottom:10px;" src ="'.$m_secreenshotPath.'" width="15px" height="15px" ></a>';
					}
				}
			}
			else 
			{
				if (!(empty($m_hadImgNow)))
				{
					echo '<img src ="'.$m_hadImgNow.'" width="60px" height="40px" >';
					if (is_int($i/2))
					{
						$m_bigImage = 'images5.jpg';
					}
					else
					{
						$m_bigImage = 'images3.jpeg';
					}
					$m_secreenshotPath = realpressGetSystemPic($m_bigImage);
					echo "<a href='".$m_hadImgNow."' title='Listing Picture' alt='Click me to see big picture' class='thickbox'>".' <img style="margin-left:15px;padding-bottom:10px;" src ="'.$m_secreenshotPath.'" width="15px" height="15px" ></a>';
				}
			}
			
			?>
			</td>
			<td>
			<a href="<?php $m_nowUrl = get_option('siteurl').'/?p='.$m_postID; echo $m_nowUrl; ?>" target="_blank"><?Php echo $m_title ?></a>
			<br />
			<form method="POST" id="reaphiddendeleteform<?php echo $i;  ?>" name="reaphiddendeleteform<?php echo $i;  ?>" action="">
			<input type="hidden" name="realpresshiddendelete" value="<?php echo $m_postID; ?>">
			</form>
			<?php
			$m_listModifyURL = get_option('siteurl')."/wp-admin/admin.php?page=".BASE_DIR."/listEditor.php&modifyid=$m_postID";
			?>
			<a href='<?php echo $m_listModifyURL; ?>' target="_blank"> <i><font color="Gray">edit</font></i> </a>&nbsp;&nbsp;&nbsp;
			<a href="#" onclick="document.forms['reaphiddendeleteform<?php echo $i;  ?>'].submit()"> <i><font color="Gray">delete</font></i> </a>
			</td>
			<td><?php echo $m_now->agentid; ?></td>
			<td><a href="#statusbox"  onclick='realActive(<?php echo $m_houseID ; ?>,"<?php echo 'housestatus';  ?>",<?php echo $i; ?>)'><div id='rp_show_valid<?php echo $i; ?>'><?php echo $m_status;  ?></div></a></td>
			<td><a href= "#thickbox"  onclick='realActive(<?php echo $m_houseID ; ?>,"<?php echo 'feature';  ?>",<?php echo $i; ?>)'><div id='rp_show_featured<?php echo $i; ?>'><?php echo $m_featured; ?></div></a><br /></td>
			<td>
			<?php
				$m_realPluginURL = plugins_url();
				$m_realPluginURL .= "/realpress";
				if (empty($m_saled_price))
				{
					$m_realEditorurl = "<a href='".$m_realPluginURL ."/saleEditor.php"."?salehouse=$m_houseID&keepThis=true&TB_iframe=true&height=180&width=400' title='Input Your Sold Amount' class='thickbox'>N/A, click to input the price</a>";
				}
				else 
				{
					$m_realEditorurl = "<a href='".$m_realPluginURL ."/saleEditor.php"."?salehouse=$m_houseID&keepThis=true&TB_iframe=true&height=180&width=400' title='Input Your Sold Amount' class='thickbox'>$m_saled_price</a>";
				}
				echo $m_realEditorurl;
			?>
			</td></tr>
		<?php
			$i++;
		}
		?>
	</tbody>
	</table>

	<ul class="subsubsub">
	<?php $m_editPath = get_option('siteurl')."/wp-admin/admin.php?page=".BASE_DIR."/"; ?>
	<li><a href="<?php echo $m_editPath.'listEditor.php';?>" target="_blank">Add a listing</a></li>
	</ul>
	</div>

<div class="clear"></div></div><!-- wpbody-content -->
<div class="clear"></div></div><!-- wpbody -->

<div class="clear"></div></div><!-- wpcontent -->
</div><!-- wpwrap -->
<?php		
	
	
}

?>