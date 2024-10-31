<?php

/*
checkFirst($_REQUEST['spam'],'verification code');
checkFirst($_REQUEST['name'],'name');
checkFirst($_REQUEST['email'],'email');
checkFirst($_REQUEST['phone'],'phone');
*/

if (!empty($_REQUEST['postid']))
{
	$m_postid = '';

	$m_postid = $_REQUEST['postid'];

	if (empty($m_postid))
	{
		$m_realReturn = "error verification code,retry or refresh";
		realpressResponse($m_realReturn);
		return;
	}
    
	require_once("../../../wp-config.php");
	
	$m_realGoogleLngLat = realpressGetPostCode($m_postid);
	
	if (false == $m_realGoogleLngLat)
	{
		realpressResponse('1000');
		return;
	}
	
	$m_realGoogleLngLat['postid'] = $m_postid;
	realpressResponse($m_realGoogleLngLat);
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