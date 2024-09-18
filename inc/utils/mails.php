<?php
	if(defined('DAPP'))
	{
		function mymailer($emails, $template, $values, $attachments = null, $from = null, $replyTo = null, $lang = null)
		{
		}
	}
	else
	{
		if(!defined('global_tags'))
			define('global_tags', 'site_name, site_tagline, site_url, site_email, site_logo');

		$SMTP_SENDER_EMAIL = $from;
		$SMTP_SENDER_NAME = $sitename_caps;

		if(strstr(@$_SERVER['HTTP_HOST'], 'localhost'))
		{
			$SMTP_HOST = '192.168.1.102'; // put the SMTP Server IP here
			$SMTP_PORT = 25; // usually 25
			$SMTP_SECURE = ''; // "", "ssl" or "tls"

			$SMTP_USERNAME = 'support@meratemplate.in';
			$SMTP_PASS = 'support';
		}
		elseif(is_array(@$custom_smtp))
		{
			$SMTP_HOST = (@$custom_smtp['host']?$custom_smtp['host']:''); // put the SMTP Server IP here
			$SMTP_PORT = (@$custom_smtp['port']?$custom_smtp['port']:25); // usually 25
			$SMTP_SECURE = (@$custom_smtp['secure']?$custom_smtp['secure']:''); // "", "ssl" or "tls"

			$SMTP_USERNAME = (@$custom_smtp['user']?$custom_smtp['user']:'');
			$SMTP_PASS = (@$custom_smtp['pass']?$custom_smtp['pass']:'');
		}
		else
		{
			$SMTP_HOST = '';
			$SMTP_PORT = 25;
			$SMTP_SECURE = '';

			$SMTP_USERNAME = '';
			$SMTP_PASS = '';
		}

    	function sanitizeEmailAddresses($emails, $template = "")
    	{
			if(!is_array($emails)) $emails = array($emails);
			$template = tspl_escape_string($template);

			foreach($emails as $k => $email)
			{
			    if(!filter_var($email, FILTER_VALIDATE_EMAIL))
                    continue;

				$blocked = 0;
				$email = tspl_escape_string($email);

				$query = "select id, blocked from email_addresses where email='{$email}';";
				$result = tspl_query($query);
				if($row = mysqli_fetch_assoc($result))
                {
                    if(@$_REQUEST['debug'] == 'smtp')
                        echo '<pre>' . print_r($row, true) . '</pre>' . $query;
					$blocked = intval($row['blocked']);
                }
				else
				{
					$query = "insert into email_addresses(email) values('{$email}');";
					tspl_query($query);

					$emailID = tspl_insert_id();
				}

				$query = "insert ignore into email_addresses_sites(email, site) values('{$emailID}', 0);";
				tspl_query($query);

				if($blocked)
				{
				    if(@$_REQUEST['debug'] == 'smtp')
                        echo '<h1>' . $email . ' found blocked</h1>' . $query;
					unset($emails[$k]);
                }
			}

			return $emails;
    	}

		function mymailer($emails, $template, $values, $attachments = null, $from = null, $replyTo = null, $lang = null)
		{
			if(!$emails)
				return;

			global $testsite, $sitename_caps, $server_url, $site_description, $site_logo, $conn, $SMTP_SENDER_EMAIL, $SMTP_SENDER_NAME, $SMTP_HOST, $SMTP_PORT, $SMTP_SECURE, $SMTP_USERNAME, $SMTP_PASS, $logs_dir;

			if(!class_exists('PHPMailer'))
				require_once(SCRIPTS_DIR . 'PHPMailer/class.phpmailer.php');

			$mailer = new PHPMailer();
			$mailer->PluginDir = SCRIPTS_DIR . 'PHPMailer/';
			$mailer->AddReplyTo($replyTo?(is_array($replyTo)?$replyTo['email']:$replyTo):$SMTP_SENDER_EMAIL, $replyTo?(is_array($replyTo)?$replyTo['name']:$replyTo):$SMTP_SENDER_NAME);
			$mailer->SetFrom($from?(is_array($from)?$from['email']:$from):$SMTP_SENDER_EMAIL, $from?(is_array($from)?$from['name']:$from):$SMTP_SENDER_NAME);
			if($from)
				$mailer->SetSender($SMTP_SENDER_EMAIL, $SMTP_SENDER_NAME);
			$mailer->Sender = "abuse@meratemplate.in";

	//		die("Setting from to $SMTP_SENDER_NAME &lt;$SMTP_SENDER_EMAIL&gt;");

			if($SMTP_HOST)
			{
				$mailer->isSMTP();
				$mailer->Host = $SMTP_HOST;
				$mailer->Port = $SMTP_PORT;
				$mailer->SMTPSecure = $SMTP_SECURE;

				if($SMTP_USERNAME)
				{
					$mailer->SMTPAuth = true;
					$mailer->Username = $SMTP_USERNAME;
					$mailer->Password = $SMTP_PASS;
				}

                if(@$_REQUEST['debug'] == 'smtp')
                {
	               $mailer->SMTPDebug = true;
                   $mailer->debug = 5;
                }
			}
			else
				$mailer->isMail();

			if(!$conn)
			{
				opendb();
				$newConnection = true;
			}
			$return = false;

			$emails = sanitizeEmailAddresses($emails, $template);

			$query = "select *" . ($lang?", subject_$lang as subject, message_$lang as message":"") . " from template where id='$template' or shortname='$template';";
			$result = tspl_query($query);
			if($template = mysqli_fetch_assoc($result))
			{
				$values['site_name'] = $sitename_caps;
				$values['site_tagline'] = $site_description;
				$values['site_url'] = $server_url;
				$values['site_email'] = $from;
				$values['site_logo'] = '<img src="' . $server_url . $site_logo . '" border="0" alt="' . $sitename_caps . '" />';

				if($template['html'])
					$mailer->IsHTML();

				$subject = ($testsite?"Test Site - ":"") . $template['subject'];
				$message = $template['message'];

				foreach ($values as $k => $v)
				{
					$subject = str_replace(array("{{{$k}}}", "%7B%7B{$k}%7D%7D"), $v, $subject);
					$message = str_replace(array("{{{$k}}}", "%7B%7B{$k}%7D%7D"), $v, $message);
				}
				$subject = preg_replace('#{{([a-zA-Z_]*)}}#','__',$subject);
				$message = preg_replace('#{{([a-zA-Z_]*)}}#','__',$message);

				if(is_array($emails))
				{
					foreach ($emails as $email)
						$mailer->AddAddress($email);
				}
				else
					$mailer->AddAddress($emails);

				$mailer->Subject = $subject;
				$mailer->Body = $message;

				if($attachments)
					if(is_array($attachments))
						foreach ($attachments as $filename)
							$mailer->AddAttachment($filename);
					else
						$mailer->AddAttachment($attachments);

				$mailsent = $mailer->Send();

				$return = $mailsent;
			}
			else
			{
				$file = fopen(((isset($logs_dir) && $logs_dir)?$logs_dir:'') . 'log.txt','a');
				$page = $_SERVER['REQUEST_URI'];
				fwrite($file, "At: " . date("Y-m-d H:i:s") . "\nPage: $page\nMail Template: {$template['shortname']}\nError: Missing Template for mail to " . ($emails && is_array($emails)?join(',', $emails):$emails) . "\n");
				fclose($file);
			}

			if(@$newConnection)
				closedb();

			if(!$return)
			{
				if(false && $testsite)
				{
					echo ($mailer->IsError()?'Error Sending Email: ' . $mailer->ErrorInfo:'Mail failed. PHPMailer recorded no errors.');
					die();
				}
				else
				{
					$file = fopen(((isset($logs_dir) && $logs_dir)?$logs_dir:'') . 'log.txt','a');
					$page = @$_SERVER['REQUEST_URI'];
					fwrite($file, "At: " . date("Y-m-d H:i:s") . "\nPage: $page\nMail Template: {$template['shortname']}\nError: " . ($mailer->IsError()?'Error Sending Email: ' . $mailer->ErrorInfo:'Mail failed. PHPMailer recorded no errors.') . "\n");
					fclose($file);
				}
			}
			elseif (function_exists('post_mymailer'))
				call_user_func_array('post_mymailer', array($emails, $template['id'], $values));
			elseif (function_exists('log_mymailer'))
				call_user_func_array('log_mymailer', array($emails, $subject, $message, $attachments));

			return $return;
		}
	}
?>