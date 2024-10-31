<?php

if (!(empty($_REQUEST['sessioni'])))
{
	$m_sessionid = $_REQUEST['sessioni'];
	session_id($m_sessionid);


}


session_start();
usleep(10000);
$m_session_spam = $_SESSION['spamcheck'];
/*
checkFirst($_REQUEST['spam'],'verification code');
checkFirst($_REQUEST['name'],'name');
checkFirst($_REQUEST['email'],'email');
checkFirst($_REQUEST['phone'],'phone');
*/

//if ((!empty($_REQUEST['spam'])) && (!empty($_REQUEST['name'])) && (!empty($_REQUEST['email'])) && (!empty($_REQUEST['phone'])))
{
	$m_name = '';
	$m_email = '';
	$m_phone = '';
	$m_subject = '';
	$m_message = '';
	$m_verify = '';

	$m_name = $_REQUEST['name'];
	$m_email = $_REQUEST['email'];
	$m_phone = $_REQUEST['phone'];
	$m_subject = $_REQUEST['subject'];
	$m_message = $_REQUEST['message'];
	$m_verify = $_REQUEST['spam'];

	if (empty($m_verify) || ($m_verify != $m_session_spam))
	{
		$m_realReturn = "error verification code,retry or refresh";
		realpressResponse($m_realReturn);
		return;
	}
	
    if (empty($m_email))
    {
		$m_realReturn = "sorry, Please input your email!";
		realpressResponse($m_realReturn);
		return;
    }

    if(!eregi("^[_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,4}$",$m_email))
    {
		$m_realReturn = "sorry, invalid email !";
		realpressResponse($m_realReturn);
		return;
	}
		
	$m_email=filter_var($m_email, FILTER_SANITIZE_EMAIL);
  	if(filter_var($m_email, FILTER_VALIDATE_EMAIL))
    {
    	
    }
  	else
    {
		$m_realReturn = "sorry, this email is not a valid email!";
		realpressResponse($m_realReturn);
		return;
    }

    if (!empty($m_name))
    {
    	if(!preg_match('|^[\.0-9a-zA-Z]+$|', trim($m_name)))
    	{
			$m_realReturn = "sorry, we only allow 0-9, . ,a-z , A-Z filled in name!";
			realpressResponse($m_realReturn);
			return;
		}
    }
	
	
	if (!empty($m_phone))
	{
    	if(!preg_match('|^[0-9]+$|', trim($m_phone)))
    	{
			$m_realReturn = "sorry, we only allow 0-9 filled in Telephone Number!";
			realpressResponse($m_realReturn);
			return;
		}
	}
    
require_once("../../../wp-config.php");

   	realpressSendMail($m_email,$m_subject,$m_message);

	$m_realReturn = "100";
	realpressResponse($m_realReturn);
	return;
}

function realpressResponse($message)
{
	if (function_exists('json_encode'))
	{
		echo json_encode($message);
		return;
	}
	else
	{
		require_once("JSON_php4.php");
		$json = new Services_JSON;
		echo $json->encode($message);
		return;
	}
}

function realpressSendMail($p_email,$p_subject= '',$p_message = '')
{

	global $wpdb,$table_prefix,$wp_version,$userdata,$current_user, $user_ID,$post,$wp_rewrite;
	get_currentuserinfo();		

	if (isset($p_email))
	{
$m_realMailMessage = "
New Contact Request Recived from $p_email:

  $p_subject:

  $p_message

";
		$m_adminInfo = get_userdata(1);
		$m_realAdminMail = $m_adminInfo->user_email;
		$headers = "From: ". get_option("blogname") ." <" . $p_email . ">\r\n";
		$real_title = " - Real estate new contact request recived - ".$p_subject;
		mail($m_realAdminMail,$real_title,$m_realMailMessage,$headers);
	}
}

function checkFirst($p_check,$p_message)
{
	$m_verifynow = $p_check;
	if (empty($m_verifynow))
	{
		$m_realReturn = "sorry found, error $p_message,please try again!";
		realpressResponse($m_realReturn);
		return;
	}
}
?>