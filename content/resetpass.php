<?php
	// SEO Tags
	$smarty->assign('meta', array(
		'title' => $sitename_caps,
		'description' => $site_description,
		'keywords' => $sitename_caps
	));

	// Render Layout
	require('content/header.php');
	require('content/footer.php');

	// Render Page
	$query = "select userid from remindpass where email='" . tspl_escape_string(@$_REQUEST['email']) . "' and code='" . intval(@$_REQUEST['code']) . "';";
	$result = tspl_query($query);
	if($row = mysqli_fetch_assoc($result))
	{
		$smarty->assign('row', $row);
		$smarty->assign('userid', intval($row['userid']));
	}
	
	$smarty->display('resetpass.tpl');
?>
