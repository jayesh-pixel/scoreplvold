<?php
	$currentPage = str_replace("-", "", $currentPage);
	$smarty->assign('currentPage', $currentPage);

	$query = "select name, displayname, contents, seotitle, seodescription, seokeywords from page where name='$currentPage' or name='{$_REQUEST['page']}' limit 1;";
	$result = tspl_query($query);
	if($staticPage = mysqli_fetch_assoc($result))
	{
		$smarty->assign('object', $staticPage);
		$smarty->assign('meta', array(
			'title' => ($staticPage['displayname']?$staticPage['displayname']:($staticPage['seotitle']?$staticPage['seotitle']:$sitename_caps . ' ' . $staticPage['displayname'])),
			'description' => $staticPage['seodescription'],
			'keywords' => $staticPage['seokeywords']
		));

		if(in_array($currentPage, array('contactus')))
			check_login();

		if(file_exists($smarty->template_dir[0] . $currentPage . '.tpl'))
			$nf_template = $currentPage . '.tpl';
		else
			if($_REQUEST['ajax'])
				$nf_template = 'popups/static.tpl';
			else
				$nf_template = 'static.tpl';
	}
	elseif(file_exists($smarty->template_dir[0] . $currentPage . '.tpl'))
	{
		if(in_array($currentPage, array('login', 'forgotpassword', 'resetpass')))
			dashboard();

		$smarty->assign('meta', array(
			'title' => $sitename_caps,
			'description' => $sitename_caps,
			'keywords' => $sitename_caps
		));

		$nf_template = $currentPage . '.tpl';
	}
	else
	{
		$smarty->assign('meta', array(
			'title' =>  "Page Not Found",
			'description' => 'Error 404: Page Not found on ' . $sitename_caps
		));

		header("HTTP/1.0 404 Not Found");

		if($mail_enable && strtolower(substr($_SERVER['HTTP_REFERER'],0,strlen($server_url))) == $server_url)
			mail($from, '404 Error: URL Missing On ' . $sitename_caps, 'Visitor Hit A URL which was not found on the server. URL: ' . $_SERVER['REQUEST_URI'] . ($url?' converted to ' . $url:'') . '

DATE/TIME: ' . date('r') . '
SESSION:
' . print_r($_SESSION, true) . '

REQUEST:
' . print_r($_REQUEST, true) . '

SERVER:
' . print_r($_SERVER, true), $headers);

		$query = "insert into elog(etype, shortdesc, fulldesc, data) values('404', '" . addslashes($_SERVER['HTTP_REFERER']) . "', '404 Error: URL Missing On $sitename_caps, Visitor Hit A URL which was not found on the server. URL: " . addslashes($_SERVER['REQUEST_URI'] . ($url?" converted to " . $url:"")) . "', '" . addslashes(stripslashes(serialize(array('session' => $_SESSION, 'request' => $_REQUEST, 'server' => $_SERVER)))) . "');";
		mysqli_query($conn, $query) or die($query . ' Error: ' . mysqli_error($conn));

		$nf_template = 'notfound.tpl';
	}

	require('content/header.php');
	require('content/footer.php');

	$smarty->caching = false;
	$smarty->display($nf_template);
?>