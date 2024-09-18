<?php

	if($_SESSION[$session]['userid'])
	{
		$query = "update logged set logged=0, tlogout=NOW() where userid=$userid and session='" . session_id() . "' and logged=1;";
		tspl_query($query);
	}

	unset($_SESSION[$session]);
	session_destroy();
	session_cache_limiter('private');
	if(@$login_life)
		session_cache_expire($login_life);
	session_start();

	$_SESSION[$session]['logout'] = true;
    $_SESSION[$session]['glogin_attempt'] = true;
    $_SESSION[$session]['fblogin_attempt'] = true;

	setcookie($session, null, time() - 3600, "/", $_SERVER['HTTP_HOST'], null, true);

	home('login');
?>