<?php
	session_start();
	require_once('../../configs/config.php');

	check_login();
	
	require_once(SCRIPTS_DIR . "tspl/DB3.php");
	
	global $userid, $admin;
		
	opendb();
	
	if($userid)
	{
		$query = "update user set error_reviewed=NOW() where id=$userid;";
		tspl_query($query);
		
		$_SESSION[$session]['pending_errors'] = 0;
	}
	
	closedb();		
	
	if(@$_SESSION[$session]['clientsite_url'])
		homeJS($_SESSION[$session]['clientsite_url'], true);
	
	if(@$_REQUEST['referer'])
		$referer = urldecode($_REQUEST['referer']);
	elseif(@$_SESSION[$session]['referer'])
		$referer = urldecode($_SESSION[$session]['referer']);
	
	if($referer)
		header("Location: " . $referer);
	else
		header("Location: {$server_url}users/dashboard");
?>