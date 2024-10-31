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

feature_Modify();
function feature_Modify()
{
	global $wpdb,$table_prefix,$wp_version,$userdata,$current_user, $user_ID,$post,$wp_rewrite,$nggdb;
	get_currentuserinfo();
	
	if (!(empty($_POST['realFeatureHidden'])))
	{
		$m_editFeatureID = $wpdb->escape($_POST['realFeatureHidden']);
		$m_realFeatureInput = $wpdb->escape($_POST['realFeatureInput']);
		
		$m_waitEditFeatures = get_option('realpressFeatures');
		if ((!(empty($m_waitEditFeatures))) && (count($m_waitEditFeatures)>0))
		{
			$m_waitEditFeatures[($m_editFeatureID-1)] = $m_realFeatureInput;
			update_option('realpressFeatures',$m_waitEditFeatures);
			echo '<script type="text/javascript">';
			echo 'top.window.location.reload()';
			echo '</script>';
			realMessage("Save changes, thank you.");			
		}
		realShowCloseIcon('Operation completed ,Click me to close the window.','text');
		die('');		
	}
	
	$m_featureGetID = '';
	$m_result = '';
	if (!(empty($_GET['featureID'])))
	{
		$m_featureGetID = $wpdb->escape($_GET['featureID']);
		$m_waitEditFeatures = get_option('realpressFeatures');
		
		if ((!(empty($m_waitEditFeatures))) && (count($m_waitEditFeatures)>0))
		{
			$m_result = $m_waitEditFeatures[($m_featureGetID-1)];
		}
	}
	else
	{
		realShowCloseIcon('Sorry, the feature ID is error,Click me to close the window.','text');
		die('');
	}
?>
	<div id='themeEditorMain'>
	<form id='formRealFeatureModify' id='formRealFeatureModify' action="" method="POST">
<?php 
	echo "<div id='realSoldUpdate'>";
	echo "Please input new feature: ";
	echo "</div>";
	echo '<br />';
	echo "<input type='text' id='realFeatureInput' name='realFeatureInput' value='$m_result'>";	
	echo '<br />';
	echo '<br />';
	echo "<input type='hidden' id='realFeatureHidden' name='realFeatureHidden' value='$m_featureGetID'>";
	echo "<input type='submit' id='realFeatureEditorSubmit' name='realFeatureEditorSubmit' value='Save Changes'>";
?>	
	</div> <!-- themeEditorMain -->
	</form>
	</div><!-- wpwrap -->
<?php		
}

echo "</body>";
echo "</html>";
?>