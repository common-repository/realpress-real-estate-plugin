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
?>
<script type="text/javascript">
function close_this(nowclose)
{
	window.close();
}
</script>
<?php
echo '</head>';

echo '<body id="themeEditorBody">';

realpress_themeEditor();
/***************************************************************/
/****  function:realpress_themeEditor                   ********/
/****  usage: theme editor in plugin menu               ********/
/***************************************************************/
function realpress_themeEditor()
{
	global $wpdb,$table_prefix,$wp_version,$userdata,$current_user, $user_ID,$post,$wp_rewrite,$nggdb;
	get_currentuserinfo();
	
	if (!(empty($_POST['realThemeEditorHidden'])))
	{
		$m_savingTheme = $_POST['realThemeEditorHidden'];
		if (empty($m_savingTheme))
		{
			realMessage("sorry, you must input theme first, please try again, thank you.");			
			realShowCloseIcon('Operation completed ,Click me to close the window.');
			die('');
		}

		$m_checkThisThemeExist = realCheckThemeExist($m_savingTheme);
		if (empty($m_checkThisThemeExist))
		{
			$m_newDir =  realCreateThemeDirectory($m_savingTheme);
			if (false == $m_newDir)
			{
				realMessage("sorry, We can not create theme directory, please check your hosting setting, thank you.");
				realShowCloseIcon('Operation completed ,Click me to close the window.');
				die('');
			}
		}
		
		if (!(empty($_POST['realtextareaphp'])))
		{
			$m_themePhpCode = $_POST['realtextareaphp'];
			$m_themeStatus =  realpresWriteTheme('php',$m_savingTheme,$m_themePhpCode);
			realMessage($m_themeStatus);
		}
		if (!(empty($_POST['realtextareacss'])))
		{
			$m_themePhpCode = $_POST['realtextareacss'];
			$m_themeStatus =  realpresWriteTheme('css',$m_savingTheme,$m_themePhpCode);
			realMessage($m_themeStatus);
		}
		realShowCloseIcon('Operation completed ,Click me to close the window.');
		die('');
	}
	
	if (empty($_GET['realpresstheme']))
	{
		realMessage('Sorry, you did not select any theme yet.');
	}
	$m_realpressnew = false;
	if (!(empty($_GET['realpressnew'])))
	{
		$m_realpressnew = true;
	}

	$m_result = realpressGetThemes();
	if (empty($m_result) && (!(empty($m_realpressnew))))
	{
		realMessage('Sorry, no any theme found in system yet.');
		return;
	}

	if ($m_realpressnew == false)
	{
		$m_themeName = $_GET['realpresstheme'];
	}
	else 
	{
		$m_themeName = 'creat new';
	}
	
	$m_themeCustomCode = realpressGetCustomCode('php',$m_themeName);
	$m_themeCustomCSS = realpressGetCustomCode('css',$m_themeName);

	if ($m_themeCustomCSS == 'filefalse')
	{
		$m_themeCustomCSS = '';
		realMessage('Sorry, we can not find "realpress.css.php" in this theme');
	}
	if ($m_themeCustomCSS == 'writefalse')
	{
		$m_themeCustomCSS = '';
		realMessage('Sorry, it seems "realpress.css.php" is not writeable');
	}	
	if ($m_themeCustomCSS == 'zerofalse')
	{
		$m_themeCustomCSS = '';
	}
	
	if ($m_themeCustomCode == 'filefalse')
	{
		$m_themeCustomCode = '';
		realMessage('Sorry, we can not find custom.php in this theme');
	}
	if ($m_themeCustomCode == 'writefalse')
	{
		$m_themeCustomCode = '';
		realMessage('Sorry, it seems custom.php is not writeable');
	}	
	if ($m_themeCustomCode == 'zerofalse')
	{
		$m_themeCustomCode = '';
	}			
	
?>
	<div id='themeEditorMain'>
	<form id='formRealMainEditor' id='formRealMainEditor' action="" method="POST">
<?php 

	echo "<div id='realThemeNewName'>";
	if ($m_realpressnew == false)
	{

	}
	else 
	{
		$m_themeName = 'creat new';
		echo '<B>Please input the name of this theme</B>';
		echo "<br />";
		echo "<br />";
		echo "<input type = 'text' id='realThemeEditorHidden' name='realThemeEditorHidden' value='' size='30'>";
		echo "<br />";
		echo "<br />";
	}
	echo "</div>";
	
	
	echo "<div id='realThemeCode'>";
	echo "custom.php(<I>$m_themeName</I>)";
	echo "</div>";
	
	echo "<textarea id='realtextareaphp' name='realtextareaphp' cols='50' rows='15'>";
	echo $m_themeCustomCode;
	echo "</textarea>";

	echo '<br />';
	if ($m_realpressnew == false)
	{
		echo "<input type='hidden' id='realThemeEditorHidden' name='realThemeEditorHidden' value='$m_themeName'>";
	}
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