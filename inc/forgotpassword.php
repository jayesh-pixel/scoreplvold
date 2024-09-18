<?php
	session_start();

	require_once('../configs/config.php');
	opendb();
	require_once("utils/mails.php");

	if(@$_REQUEST['session'])
	{
		$email = tspl_escape_string($_SESSION['signup']['email']);
	}
	else
	{
		$email = tspl_escape_string($_REQUEST["email"]);

		require(SCRIPTS_DIR . 'tspl/recaptchalib.php');
		if(!validate()) //strtolower($_SESSION['security_code']) != strtolower($_REQUEST['code']))
			$status = 'captcha';
	}
	if(@$email && !@$status)
	{
		$query = "select id, name from user where email='" . $email . "';";
		$result = tspl_query($query);
		if($row = mysqli_fetch_assoc($result))
		{
			$code = "" . rand(100000,10000000);

			$query = "insert into remindpass(userid, email, code, ip) values(" . $row['id'] . ",'" . $email . "','" . $code . "','" . $_SERVER['REMOTE_ADDR'] . "')";
			tspl_query($query);

			if(@$_REQUEST['session'])
				mymailer($email, 'account_activation', array(
					'activation_url' => $server_url . 'reset-pass?email=' . $email . '&code=' . $code,
					'code' => $code
				));
			else
				mymailer($email, 'forgot_password_notification', array(
					'user_name' =>  $row['name'],
					'reminder_url' => $server_url . 'reset-pass?email=' . $email . '&code=' . $code
				));

			$status = 'success';
		}
		else
			$status = 'failed';
		closedb();
	}

	if(@$_REQUEST['session'])
		header('Location: ../signup?status=success#login');
	else
		header('Location: ../forgot-password?status=' . $status . '&email=' . $email);
?>