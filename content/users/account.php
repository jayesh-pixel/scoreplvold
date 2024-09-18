<?php
	check_login();
	
	$smarty->assign('meta', array(
		'title' => "Account Settings",
		'description' => "$sitename_caps",
		'keywords' => $sitename_caps
	));
	
	require('content/header.php');
	require('content/footer.php');
	global $session;
	
	$smarty->assign('user', $user = getRecord("select u.* from user u where u.id='{$userid}' and usertype='{$_SESSION[$session]['usertype']}';"));
	// debug($_SESSION[$session]);
	// debug($user); die;
	$smarty->display('users/account.tpl');
?>
