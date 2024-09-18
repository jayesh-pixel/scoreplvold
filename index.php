<?php
	session_start();
	ini_set('magic_quotes_gpc', 'off');

	error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE & !E_DEPRECATED);
	ini_set('display_errors', 'on');

	require_once("configs/config.php");

	if(@$_REQUEST['page'])
	{
		$currentPage = str_replace(array('_'),array('/'),$_REQUEST['page']);
		if(@$_SESSION[$session]['ignore'])
			$currentPage = str_ireplace(array("{$_SESSION[$session]['ignore']}/", "{$_SESSION[$session]['ignore']}"), "", $currentPage);
	}
	if(!@$currentPage)
		$currentPage = 'login';

	if(strpos($_SERVER['REQUEST_URI'],'?'))
	{
		$params = substr($_SERVER['REQUEST_URI'],strpos($_SERVER['REQUEST_URI'],'?')+1);
		$params = explode('&',$params);
		foreach ($params as $key => $value)
		{
			$tmp = explode('=',$value);
			$_REQUEST[$tmp[0]] = $tmp[1];
		}
	}

	if(@$_REQUEST['debug'])
		error_reporting(E_ALL);

	opendb();

	if(@$_REQUEST['pagesize'])
		$pagesize = $_SESSION[$session]['pagesize'] = intval($_REQUEST['pagesize']);
	elseif(!@$_SESSION[$session]['pagesize'])
		$pagesize = $_SESSION[$session]['pagesize'] = 10;
	else
		$pagesize = intval(@$_SESSION[$session]['pagesize']);
/*
	if(!$userid && @$_COOKIE[$session] && $_REQUEST['page'] != 'logout' && !@$_SESSION['cookie'])
	{
		@$_SESSION['cookie'] = true;
		home('inc/login.php?referer=' . urlencode(@$_SERVER['REQUEST_URI']) . '&' . @$_COOKIE[$session]);
	}
	elseif($userid && $currentPage != 'logout')
	{
		$query = "select id from logged where userid='{$userid}' and ip='{$_SERVER['REMOTE_ADDR']}' and session='" . session_id() . "' and logged=1;";
		$result = tspl_query($query);
		if(!mysqli_num_rows($result))
			home('logout?redirect=login&reason=locations');
	}
	*/
	$time = $_SERVER['REQUEST_TIME'];
	$timeout_duration = 1800;
	if (isset($_SESSION['LAST_ACTIVITY']) && ($time - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) 
	{
	    session_unset();
	    session_destroy();
	    session_start();
	}
   	$_SESSION['LAST_ACTIVITY'] = $time;

	define('SMARTY_ROOT', str_replace("\\","/",getcwd()) . "/");
	define('SMARTY_DIR', SCRIPTS_DIR . "smarty.new/");

	// define('SMARTY_RESOURCE_DATE_FORMAT', '%d / %m / %Y');
	require_once(SCRIPTS_DIR . 'TSPLSmarty.class.php');
	$smarty = new TSPLSmarty();
	$smarty->compile_dir = $smarty->cache_dir = SMARTY_ROOT . "upload/tmp/";

	$smarty->caching = 0;
	if($testsite || @$_REQUEST['nocache'])
		$smarty->force_compile = true;

	$smarty->config_vars = array_merge($smarty->config_vars, array(
		'server_url' => $server_url,
		'scripts_url' => $scripts_url,
		'sitename_caps' => $sitename_caps,
		'testsite' => $testsite,
		'fb_app_id' => $fb_app_id,
		'format_date' => "%d / %m / %Y",
		'format_datetime' => "%d / %m / %Y %r"
	));

	if(@$_REQUEST['ajax'])
	{
		header('Content-Type:text/html;charset=utf-8');
		header('Content-Language:en');
	}

	$urlparts = explode('/', $currentPage);
	
	if(in_array('crons', $urlparts))
	{
		require_once("content/crons.php");
		$handler = new crons();
		$handler->{$urlparts[1]}();
	}
	elseif(in_array('api', $urlparts))
	{
		require_once("content/" . $urlparts[0] . ".php");
		$handler = new $urlparts[0]();
		$handler->{$urlparts[1]}();
	}
	elseif(file_exists("content/" . $currentPage . ".php"))
	{
		require_once("content/" . $currentPage . ".php");
	}
	elseif(file_exists("content/" . str_replace(array('-'),array(''),$currentPage) . ".php"))
	{
		$currentPage = str_replace(array('-'),array(''),$currentPage);
		require_once("content/" . $currentPage . ".php");
	}
	elseif(getRecord($query = "select * from urls where url='" . tspl_escape_string($urlparts[0]) . "' and active=1;"))
	{
		require_once("content/pages.php");
	}
	else
		require("content/notfound.php");
		

    unset($_SESSION[$session]['status']);
	closedb();
?>