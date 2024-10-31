<?php

realpress_themeManager();
/***************************************************************/
/****  function:realpress_themeManager                  ********/
/****  usage: theme Manager in plugin menu              ********/
/***************************************************************/
function realpress_themeManager()
{
	global $wpdb,$table_prefix,$wp_version,$userdata,$current_user, $user_ID,$post,$wp_rewrite,$nggdb;
	get_currentuserinfo();
	

	$m_result = realpressGetThemes();
	if (empty($m_result))
	{
		realMessage('Sorry, no any theme found in system yet.');
		return;
	}
	

?>
	<div class="wrap">
	<h2>Theme Editor</h2>
	<ul class="subsubsub"><li>All Themes</li></ul>

	<table class="widefat">
	<thead>
	<tr>
	<th scope="col">Theme name</th>
	<th scope="col">Screenshot(Click to big)</th>
	<th scope="col">Current active</th>
	<th scope="col">Edit it</th>
	</tr>
	</thead>
	<tbody>
	<?php
		$i = 0;
		
		foreach ($m_result as $m_now)
		{
			$m_nowUsed = '';
			$m_themeScreenshot = '';
			
			$m_themeName = $m_now;
			$m_nowTheme =  get_option('realpressTheme');
			$m_activeThemeUrl = get_option('siteurl')."/wp-admin/admin.php?page=".BASE_DIR."/optionsManagement.php#realThemeSelect";
			if ($m_nowTheme == $m_themeName)
			{
				$m_nowUsed = 'YES';
			}
			else 
			{
				$m_nowUsed = 'NO';
			}
			$m_themeScreenshot = realGetThemeScreenshot($m_themeName);
			

	?>
			<tr><td><?php echo $m_themeName; ?></td>
			<td>
			<?php
			if (!(empty($m_themeScreenshot)))
			{
				echo '<img src ="'.$m_themeScreenshot.'" width="60px" height="40px" > ';
				if (is_int($i/2))
				{
					$m_bigImage = 'images5.jpg';
				}
				else
				{
					$m_bigImage = 'images3.jpeg';
				}
				$m_secreenshotPath = realpressGetSystemPic($m_bigImage);
				echo "<a href='".$m_themeScreenshot."' title='$m_themeName' alt='Click me to see big picture' class='thickbox'>".' <img style="margin-left:15px;padding-bottom:10px;" src ="'.$m_secreenshotPath.'" width="15px" height="15px" ></a>';
			}
			else 
			{
				echo '<i>n/a</i>';
			}
			?>
			</td>
			<td><?php echo $m_nowUsed; ?></td>
			<td>
			<?php
				$m_realPluginURL = plugins_url();
		    $m_realPluginURL .= "/".BASE_DIR;
				$m_realEditorurl = "<a href='".$m_realPluginURL ."/themeEditor.php/"."?realpresstheme=$m_themeName&keepThis=true&TB_iframe=true&height=450&width=600' title='Theme Editor' class='thickbox'>Edit this theme</a>";
				echo $m_realEditorurl;
			?>

			</td>
		<?php
			$i++;
		}
		?>
	</tbody>
	</table>

	<ul class="subsubsub">
	<?php 
		/*
		$m_realPluginURL = plugins_url();
		$m_realPluginURL .= "/realpress";
		$m_realEditorurl = "<I><a href='".$m_realPluginURL ."/themeEditor.php/"."?realpressnew=yes&realpresstheme=none&keepThis=true&TB_iframe=true&height=450&width=600' title='Theme Editor' class='thickbox'>Create new theme</a></I>";
		echo $m_realEditorurl;
		*/
	?>
	
	</ul>
	</div>


<div class="clear"></div></div><!-- wpcontent -->
</div><!-- wpwrap -->
<?php		
	
	
}

?>