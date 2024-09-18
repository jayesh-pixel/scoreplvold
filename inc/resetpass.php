<?php
	session_start();
	require('../configs/config.php');
	opendb();

	$password = md5($_REQUEST['pass']);

	$userid = intval($_REQUEST['userid']);
	$email = $_REQUEST['email'];

	$query = "select userid from remindpass where userid=$userid and email='$email' and code='" . $_REQUEST['code'] . "';";
	$result = tspl_query($query);
	if($row = mysqli_fetch_assoc($result))
	{
		$userid = intval($row['userid']);

		$query = "update user set pass='$password' where id=$userid;";
		tspl_query($query);

		$query = "delete from remindpass where code='" . $_REQUEST['code'] . "';";
		tspl_query($query);

		$_SESSION[$session]['ip_processed'] = true;
		$_SESSION[$session]['userid'] = $userid;
		$_SESSION[$session]['email'] = $email;
		$_SESSION[$session]['lastaccess'] = time();

		closedb();
		header("Location: {$server_url}inc/login.php?id=$userid");
	}
	else
	{
		closedb();
		
		$status = 'failed';
		header("Location: {$server_url}reset-pass?status=$status");
	}
?>