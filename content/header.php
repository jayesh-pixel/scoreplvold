<?php
	global $server_url;
	$smarty->assign('userid', $userid);
	$smarty->assign('session', $session);
	$smarty->assign('settings', $settings = getRecord($query = "select * from site_settings where deleted=0 limit 1;"));
	
	if(file_exists(BASE_PATH . ASSETS_DIR . '/js/js.js') && !@$_REQUEST['update'])
		$smarty->assign('jsfile', $server_url . ASSETS_DIR . '/js/js.js');
	
	if(file_exists(BASE_PATH . ASSETS_DIR . '/css/css.css') && !@$_REQUEST['update'])
		$smarty->assign('cssfile', $server_url . ASSETS_DIR . '/css/css.css');
	
	if(@$_REQUEST['ajax'] || @$_REQUEST['byajax'])
		$smarty->assign('header', '');
	else
		$smarty->assign('header', $smarty->fetch('header.tpl'));
?>