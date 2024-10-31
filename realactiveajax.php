<?php
session_start();
require_once("../../../wp-config.php");
global $wpdb,$table_prefix,$wp_version,$userdata,$current_user, $user_ID,$post,$wp_rewrite;
get_currentuserinfo();	

checkFirst($_REQUEST['houseid'],'');


if (!empty($_REQUEST['houseid']))
{
	$m_houseid = '';
	
	$m_houseid = $wpdb->escape($_REQUEST['houseid']);
	$m_type = $wpdb->escape($_REQUEST['type']);
	
	
    
    if ('feature' == $m_type)
    {
    	$m_table = $table_prefix."realpresshouse";
    	$m_sql = "select `featured` from `".$m_table."` where `id` = '".$m_houseid."' limit 1";
    }
    if ('housestatus' == $m_type)
    {
    	$m_table = $table_prefix."realpresshouse";
    	$m_sql = "select `valid` from `".$m_table."` where `id` = '".$m_houseid."' limit 1";
    }
    if ('publish' == $m_type)
    {
    	$m_table = $table_prefix."realpresshouse";
    	$m_sql = "select `postid` from `".$m_table."` where `id` = '".$m_houseid."' limit 1";
    	$m_id = $wpdb->get_var($m_sql);
    	if (empty($m_id))
    	{
    		$m_realReturn = "error";
			realpressResponse($m_realReturn);
			return;    		
    	}
    	$m_table = $table_prefix."posts";
    	$m_sql = "select `post_status` from `".$m_table."` where `id` = '".$m_id."' limit 1";
    }
    
    $m_result = $wpdb->get_var($m_sql);
    if (empty($m_result))
    {
    	$m_realReturn = "error";
		realpressResponse($m_realReturn);
		return;
    }
    
    if ('publish' == $m_type)
    {
    	$m_table = $table_prefix."posts";
    	if ($m_result != 'publish')
    	{
	    	$m_sql = "update `".$m_table."` set `post_status` = 'publish' where `id` = '".$m_id."'";
    		$m_realReturn = "120";
    	}
    	else 
    	{
	    	$m_sql = "update `".$m_table."` set `post_status` = 'pending' where `id` = '".$m_id."'";
    		$m_realReturn = "121";
    	}
    }
    
    if ('feature' == $m_type)
    {
    	$m_table = $table_prefix."realpresshouse";
    	if ($m_result == 'NO')
    	{
	    	$m_sql = "update `".$m_table."` set `featured` = 'YES' where `id` = '".$m_houseid."'";
    		$m_realReturn = "100";
    	}
    	else 
    	{
	    	$m_sql = "update `".$m_table."` set `featured` = 'NO' where `id` = '".$m_houseid."'";
    		$m_realReturn = "101";
    	}
    }
    
    if ('housestatus' == $m_type)
    {
    	$m_table = $table_prefix."realpresshouse";
    	if ($m_result == 'NO')
    	{
	    	$m_sql = "update `".$m_table."` set `valid` = 'YES' where `id`='".$m_houseid."'";
    		$m_realReturn = "110";
    	}
    	else 
    	{
	    	$m_sql = "update `".$m_table."` set `valid` = 'NO' where `id`='".$m_houseid."'";
    		$m_realReturn = "111";
    	}
    }
        
    $m_result = $wpdb->query($m_sql);

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


function checkFirst($p_check,$p_message)
{
	$m_verify = $p_check;
	if (empty($m_verify))
	{
		$m_realReturn = "sorry, error $p_message,please try again!";
		realpressResponse($m_realReturn);
		return;
	}
}
?>