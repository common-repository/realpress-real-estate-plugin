<?php
require_once("../../../wp-blog-header.php");
require_once("../../../wp-settings.php");
require_once(ABSPATH.'/wp-admin/includes/media.php');
require_once("realfunctions.php");

$realhradUrl = plugins_url();
echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
echo '<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US">';

echo '<head profile="http://gmpg.org/xfn/11">';
echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
echo sprintf('<link rel="stylesheet" href="%s" type="text/css" media="screen" />', $realhradUrl."/".BASE_DIR."/style.css");
echo sprintf('<link rel="stylesheet" href="%s" type="text/css" media="screen" />', $realhradUrl."/".BASE_DIR."/realadmin.css");
echo '</head>';
echo '<body id="themeEditorBody">';

sale_Editor();
function sale_Editor()
{
	global $wpdb,$table_prefix,$wp_version,$userdata,$current_user, $user_ID,$post,$wp_rewrite,$nggdb;
	get_currentuserinfo();
	
	if (!(empty($_POST['realSoldHidden'])))
	{
		$m_table = $table_prefix."realpresshouse";
		$m_houseID = $wpdb->escape($_POST['realSoldHidden']);
		if (empty($m_houseID))
		{
			realMessage("sorry, you must input house id first, please try again, thank you.");			
			realShowCloseIcon('Operation completed ,Click me to close the window.');
			die('');
		}
		
		if (!(empty($_POST['realSoldInput'])))
		{
			$m_houseAmount = $_POST['realSoldInput'];
			$m_sql = "update `".$m_table."` set `saled_price` = '".$m_houseAmount."' where `id` = '".$m_houseID."' ";
			$m_result = $wpdb->query($m_sql);
			echo '<script type="text/javascript">';
			echo 'top.window.location.reload()';
			echo '</script>';
			realMessage("Save changes, thank you.");			
		}
		realShowCloseIcon('Operation completed ,Click me to close the window.','text');
		die('');
	}
	

	if (empty($_GET['salehouse']))
	{
		realMessage('Sorry, you must input house id first.');
		realShowCloseIcon('Click me to close the window.');
		die('');
	}
	$m_salehouse = $wpdb->escape($_GET['salehouse']);
	$m_table = $table_prefix."realpresshouse";
	$m_sql = "select `saled_price` from `".$m_table."` where `id` = '".$m_salehouse."' limit 1";
	$m_result = $wpdb->get_var($m_sql);
	
	if (empty($m_result))
	{
		$m_result = 0;
	}

	
	
?>
	<div id='themeEditorMain'>
	<form id='formRealMainEditor' id='formRealMainEditor' action="" method="POST">
<?php 
	echo "<div id='realSoldUpdate'>";
	echo "Please input sold amount for this house: ";
	echo "</div>";
	echo '<br />';
	echo "<input type='text' id='realSoldInput' name='realSoldInput' value='$m_result'>";	
	echo '<br />';
	echo '<br />';
	echo "<input type='hidden' id='realSoldHidden' name='realSoldHidden' value='$m_salehouse'>";
	echo "<input type='submit' id='realThemeEditorSubmit' name='realThemeEditorSubmit' value='Save Changes'>";
?>	
	</div> <!-- themeEditorMain -->
	</form>
	</div><!-- wpwrap -->
<?php		
}

echo "</body>";
echo "</html>";
?>