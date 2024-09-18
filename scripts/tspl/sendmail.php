<?php
	// TODO: Add email templates' database ID to their common name here.
	define('global_tags', 'site_name, site_tagline, site_url, site_email, site_logo');

	$SMTP_SENDER_EMAIL = $from;
	$SMTP_SENDER_NAME = $sitename_caps;

	if(strstr($_SERVER['HTTP_HOST'], 'localhost'))
	{
		$SMTP_HOST = '192.168.1.102'; // put the SMTP Server IP here
		$SMTP_PORT = 25; // usually 25
		$SMTP_SECURE = ''; // "", "ssl" or "tls"

		$SMTP_USERNAME = 'support@triyama.com';
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

	function mymailer($emails, $template, $values, $attachments = null)
	{
		global $testsite, $sitename_caps, $server_url, $site_description, $from, $site_logo, $conn, $SMTP_SENDER_EMAIL, $SMTP_SENDER_NAME, $SMTP_HOST, $SMTP_PORT, $SMTP_SECURE, $SMTP_USERNAME, $SMTP_PASS;

		$headers = "From: $SMTP_SENDER_NAME <" . $SMTP_SENDER_EMAIL . ">\r\nReply-To: " . $SMTP_SENDER_EMAIL . "\r\nSender: " . $SMTP_SENDER_EMAIL . "";

		if(!$conn)
		{
			opendb();
			$newConnection = true;
		}
		$return = false;

		$query = "select * from template where id='$template' or shortname='$template';";
		$result = mysql_query($query) or db_fail($query);
		if($template = mysql_fetch_assoc($result))
		{
			$values['site_name'] = $sitename_caps;
			$values['site_tagline'] = $site_description;
			$values['site_url'] = $server_url;
			$values['site_email'] = $from;
			$values['site_logo'] = '<img src="' . $server_url . $site_logo . '" border="0" alt="' . $sitename_caps . '" />';

			if($template['html'])
				$headers .= "\r\nContent-type: text/html";

			$subject = $template['subject'];
			$message = $template['message'];

			foreach ($values as $k => $v)
			{
				$subject = str_replace(array("{{{$k}}}", "%7B%7B{$k}%7D%7D"), $v, $subject);
				$message = str_replace(array("{{{$k}}}", "%7B%7B{$k}%7D%7D"), $v, $message);
			}
			$subject = preg_replace('#{{([a-zA-Z_]*)}}#','__',$subject);
			$message = preg_replace('#{{([a-zA-Z_]*)}}#','__',$message);

			$return = @mail($emails, $subject, $message, $headers);
		}

		if(@$newConnection)
			closedb();

		return $return;
	}
?>