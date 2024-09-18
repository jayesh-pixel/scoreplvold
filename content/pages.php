<?php
	$smarty->assign('hidesidebar', true);
	$smarty->assign('meta', array(
		'title' => "Users Terms And Conditions",
		'description' => "$sitename_caps",
		'keywords' => $sitename_caps
	));

	require('content/header.php');
	require('content/footer.php');
	if($page = getRecord($query = "select * from urls where url='" . tspl_escape_string($urlparts[0]) . "' and active=1;"))
	{
		if($pageContent = getRecord($query = "select * from {$page['otype']} where id='{$page['oid']}';"))
		{
			$smarty->assign('pageContent', $pageContent);
			$smarty->display('pages.tpl');
		}
		else
			home('notfound');
	}
	else
		home('notfound');
	
?>