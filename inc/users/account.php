<?php
	session_start();
	require_once('../../configs/config.php');

	check_login();
	require_once(SCRIPTS_DIR . "tspl/DB3.php");
		
	opendb();
	global $userid, $session;
	$_REQUEST['id'] = $userid;
	$fields = array('name', 'email', 'pass', 'newpass', 'imgpath');
	
	if(@$_FILES['imgpath'])
	{
		require_once(SCRIPTS_DIR . 'tspl/upload.php');
		$tmp = uploadFile('imgpath', '', BASE_PATH . "upload/profile/", array("png", "jpg", "jpeg", "gif"));
		if(@$tmp['_main'])
			$_SESSION[$session]['imgpath'] = $_REQUEST['imgpath'] = str_replace(BASE_PATH, "", $tmp['_main']);
	}
	
	$values = array();
	foreach ($fields as $f) {
		if($_REQUEST[$f])
			$values[$f] = $_REQUEST[$f];
	}
	$values['id'] = $userid;
	if(@$_REQUEST['newpass'])
		$fields['pass'] = $_REQUEST['newpass'];
	
	DB3::updateObject('user', $values);
	closedb();		
	
	header("Location: {$server_url}users/account?status=updated");
?>