<?php
	check_login();

	$smarty->assign('meta', array(
		'title' => "Dashboard",
		'description' => "$sitename_caps",
		'keywords' => $sitename_caps
	));

	require('content/header.php');
	require('content/footer.php');

	global $testsite,$userid;
	$errors = 0;
	
	$smarty->assign('customers', getRecordField($query = "select count(id) as cnt from user where usertype='user' and deleted=0 and status=1;"));
	$smarty->assign('wrequest', getRecordField($query = "select count(id) as cnt from withdraw_requests where deleted=0 and paid=0;"));
	$smarty->assign('kyc', getRecordField($query = "select count(id) as cnt from kyc where deleted=0 and approved=0;"));
	$smarty->assign('contests', getRecordField($query = "select count(id) as cnt from contests where deleted=0;"));
	$smarty->assign('banners', getRecordField($query = "select count(id) as cnt from banners where deleted=0;"));
	$smarty->assign('upcomings', getRecordField($query = "select count(id) as cnt from matches where deleted=0 and status_str='Scheduled';"));
	
	$smarty->display('users/dashboard.tpl');
?>