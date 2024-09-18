<?php
	session_start();
	require_once('../../configs/config.php');

	check_login();
	require_once(SCRIPTS_DIR . "tspl/DB3.php");
	require_once("../../content/urls.php");
	define('DB_PREFIX', "");
		
	opendb();
	global $userid;
	$query = "insert into terms(vendor, terms, app, vendor_specific) values('{$userid}', '" . tspl_escape_string(@$_REQUEST['app_terms']) . "', '1', '" . intval(@$_REQUEST['vendor_specific']) . "') on duplicate key update terms='" . tspl_escape_string(@$_REQUEST['app_terms']) . "', app=1, vendor_specific='" . intval(@$_REQUEST['vendor_specific']) . "', id=LAST_INSERT_ID(id);";
	tspl_query($query);
	$appId = tspl_insert_id();
	
	if($url = urls::validateURL('terms', $appId, urls::cleanURL('terms/' . $appId)))
	{
		$query = "update terms set url='$url' where id='" . abs($appId) . "';";
		tspl_query($query);
	}
	
	if(@$_REQUEST['vendor_specific'])
		$query = "insert into terms(vendor, terms) values('" . intval(@$_REQUEST['vendor']) . "', '" . tspl_escape_string(@$_REQUEST['vendor_terms']) . "') on duplicate key update terms='" . tspl_escape_string(@$_REQUEST['vendor_terms']) . "', id=LAST_INSERT_ID(id);";
	else
		$query = "insert into terms(vendor, terms, vendor_terms) values('{$userid}', '" . tspl_escape_string(@$_REQUEST['vendor_terms']) . "', '1') on duplicate key update terms='" . tspl_escape_string(@$_REQUEST['vendor_terms']) . ", vendor_terms=1', id=LAST_INSERT_ID(id);";
		
	tspl_query($query);
		
	$vId = tspl_insert_id();
	
	if($url = urls::validateURL('terms', $vId, urls::cleanURL('terms/' . $vId)))
	{
		$query = "update terms set url='$url' where id='" . abs($vId) . "';";
		tspl_query($query);
	}
	
	
	home('users/terms');
?>