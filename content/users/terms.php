<?php
	$smarty->assign('meta', array(
		'title' => "Users Terms And Conditions",
		'description' => "$sitename_caps",
		'keywords' => $sitename_caps
	));

	require('content/header.php');
	require('content/footer.php');
	global $userid;
	
	$smarty->assign('vendors', getRecords($query = "select id, name from user where usertype='Vendor' and deleted=0;"));
	
	$smarty->assign('appTerms', getRecord($query = "select terms, vendor_specific from terms where vendor='{$userid}' and app=1;"));
	$smarty->assign('vTerms', getRecord($query = "select terms, vendor_specific from terms where vendor='{$userid}' and vendor_terms=1;"));
	
	$smarty->display('users/terms.tpl');
?>