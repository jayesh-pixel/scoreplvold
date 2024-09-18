<?php
	session_start();

	require_once('../configs/config.php');

	if(@$_REQUEST['referer'])
		$referer = urldecode($_REQUEST['referer']);
	elseif (@$_SESSION[$session]['referer'])
		$referer = urldecode($_SESSION[$session]['referer']);
	else
		$referer = "";

	opendb();

    if($referer == 'CLIENT_SITE')
    {
        $CLIENT_SITE = array(
            'referer' => $_SESSION['referer'],
            'dbname' => getRecordField("select concat(db_database, '.', db_prefix) from {$dbname}.clients where id='{$_SESSION['site']}';"),
            'dbname_test' => getRecordField("select concat(test_db_database, '.', test_db_prefix) from {$dbname}.clients where id='{$_SESSION['site']}' and length(test_db_database) > 5 and test_server_url like 'http%';")
        );
    }

	$_REQUEST['email'] = tspl_escape_string(trim(@$_REQUEST['email']));
	$_REQUEST['pass'] = trim(@$_REQUEST['pass']);

	if(@$_REQUEST['pass'])
		$password = trim($_REQUEST['pass']); //md5(trim($_REQUEST['pass']));
	else
		$password = @$_REQUEST['auth'];

	$userid = intval(@$_REQUEST['id']);
	if(isset($_REQUEST['auth']))
	{
		$_SESSION[$session]['logout'] = true;
		setcookie($session, null, time() - 3600, "/", $_SERVER['HTTP_HOST'], null, true);
	}

	$finds = array("1=0");
	if(@$_REQUEST['email'])
		$finds[] = "u.usertype in('Vendor', 'Administrator') and u.deleted=0 and (u.email='" . $_REQUEST['email'] . "' or u.email like '" . $_REQUEST['email'] . "@%')";
	elseif($userid)
	{
		if(@$_SESSION[$session]['email'])
			$finds[] = "(u.id=$userid and u.email='" . @$_SESSION[$session]['email'] . "')";
		elseif(@$_REQUEST['auth'])
			$finds[] = "(u.id=$userid)";
	}

	$query = "select u.* from user u where
	(
		" . join(" or ", $finds) . "
	)
	;";
// debug($query);	
	// mail("support@meratemplate.in", time() . " Tracking User Query" . $query, print_r($_REQUEST, true) . PHP_EOL . print_r($_SESSION, true) . PHP_EOL . print_r($_SERVER, true));

	$result = tspl_query($query);
	if($row = mysqli_fetch_assoc($result))
	{
		$securityCheckPass = false;
		if(
			($userid && @$_SESSION[$session]['email'] && @$_SESSION[$session]['email'] == $row['email'])
			||
			($password && ($row['pass'] == $password || $row['newpass'] == $password || $row['pass'] == md5($password)))
		)
			$securityCheckPass = true;
// debug($row);die($password);
		if($securityCheckPass && $row['status'])
		{
			if($row['newpass'] && $row['newpass'] == $password)
			{
				$query = "update user set pass='$password', newpass='' where id=" . intval($row['id']) . ";";
				tspl_query($query);

				$row['pass'] = $row['newpass'];
			}
			elseif($row['pass'] && $row['pass'] == $password && $row['newpass'])
			{
				$query = "update user set newpass='' where id=" . intval($row['id']) . ";";
				tspl_query($query);

				$row['newpass'] = '';
			}

			$wasadmin = @$_SESSION[$session]['wasadmin'];

			unset($_SESSION[$session]);
			session_destroy();
			session_cache_limiter('private');
			if(@$login_life)
				session_cache_expire($login_life);
			if(session_status() == PHP_SESSION_NONE)
				session_start();

			$_SESSION[$session]['wasadmin'] = ($row['usertype'] == 'Administrator');
			$_SESSION[$session]['ip_processed'] = true;
			$userid = $_SESSION[$session]['userid'] = $row['id'];
			$_SESSION[$session]['usertype'] = $row['usertype'];

			if($row['usertype'] == 'Administrator')
				$_SESSION[$session]['admin'] = true;

			$_SESSION[$session]['email'] = $row['email'];
			$_SESSION[$session]['name'] = $row['name'];
			$_SESSION[$session]['imgpath'] = $row['imgpath'];
			$_SESSION[$session]['lastaccess'] = time();

			$query = "update logged set logged=0 where userid='" . $row['id'] . "' and logged=1;";
			tspl_query($query);

			$query = "select tlogin from logged where userid='" . $row['id'] . "' order by id desc limit 1;";
			$result = tspl_query($query);
			if($login = mysqli_fetch_row($result))
				$_SESSION[$session]['lastlogin'] = $login[0];
			else
				$_SESSION[$session]['lastlogin'] = date('Y-m-d H:i:s');

			$query = "insert into logged(userid, ip, session) values('" . $row['id'] . "','" . $_SERVER['REMOTE_ADDR'] . "','" . session_id() . "');";
			tspl_query($query);

			if($row['id'] && $row['pass'])
				setcookie($session, 'id=' . $row['id'] . '&auth=' . $row['pass'], time() + (365 * 24 * 3600), "/", $_SERVER['HTTP_HOST'], null, true);

			// if(@$CLIENT_SITE)
				// mail("support@meratemplate.in", time() . " Tracking User Login - SNS Master Login - AFTER", print_r($_REQUEST, true) . PHP_EOL . print_r($_SESSION, true) . PHP_EOL . print_r($_SERVER, true));

			$_SESSION[$session]['pending_errors'] = ($row['error_reviewed'] != date("Y-m-d")) ? 1 : 0;

            if($referer == 'CLIENT_SITE' && $CLIENT_SITE && $CLIENT_SITE['referer'] && $CLIENT_SITE['dbname'])
            {
                $date = time();
                $query = "insert into {$CLIENT_SITE['dbname']}remote_login(remote_userid, tlogin, tlogout, ip, name) values('{$row['id']}', null, null, '" . $_SERVER['REMOTE_ADDR'] . "', '" . tspl_escape_string($row['name']) . "');";
                tspl_query($query);
                $remote1 = tspl_insert_id();

                if(@$CLIENT_SITE['dbname_test'])
                {
                    $query = "insert into {$CLIENT_SITE['dbname_test']}remote_login(remote_userid, tlogin, tlogout, ip, name) values('{$row['id']}', null, null, '" . $_SERVER['REMOTE_ADDR'] . "', '" . tspl_escape_string($row['name']) . "');";
                    @mysqli_query($conn, $query);
                    $remote2 = tspl_insert_id();
                }

                // if($_SERVER['REMOTE_ADDR'] == '223.30.145.234')
                    // die("<h1>" . $remote2 . "</h1><h2>{$query}</h1><pre>" . print_r($CLIENT_SITE, true));

				// mail("support@meratemplate.in", time() . "Query - " . $query, print_r($_REQUEST, true) . PHP_EOL . print_r($_SESSION, true) . PHP_EOL . print_r($_SERVER, true));

				$url = preg_replace("/admin\/?.*$/", "", $CLIENT_SITE['referer']) . "admin/account/login?source=login1&remoteid=" . $remote1 . "&remoteid2=" . $remote2 . "&remote=true&via=local&ts={$date}";
                if($_SESSION[$session]['pending_errors'])
                {
                	$_SESSION[$session]['clientsite_url'] = $url;
                	homeJS("users/dashboard");
				}
                else
                    homeJS($url, true);
            }

			closedb();

			// mail("support@meratemplate.in", time() . "Login through referer", print_r($_REQUEST, true) . PHP_EOL . print_r($_SESSION, true) . PHP_EOL . print_r($_SERVER, true));

            if($_SESSION[$session]['pending_errors'])
                home("users/dashboard");
			elseif(@$referer && !strstr($referer, 'login'))
				header("Location: " . $referer);
			else
				dashboard();

			exit;
		}
		elseif (!$securityCheckPass)
			$reason = "password";
		elseif(!$row['status'])
			$reason = "inactive";
		else
			$reason = "technical";
		closedb();

		$_SESSION[$session]['logout'] = true;
		$_SESSION[$session]['userid'] = 0;

		header("Location: ../login?email=" . $_REQUEST['email'] . "&reason=" . $reason);
		exit();
	}
	closedb();

	if(@$_REQUEST['auth'])
	{
		$_SESSION[$session]['logout'] = true;
		setcookie($session, null, time() - 3600, "/", $_SERVER['HTTP_HOST'], null, true);
	}

	if($_REQUEST['email'])
		header("Location: ../login?email=" . $_REQUEST['email'] . "&reason=nonexistent");
	elseif($referer)
		header("Location: " . $referer);
	else
		header("Location: ../login");
?>