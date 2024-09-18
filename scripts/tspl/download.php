<?php
	if(defined('DAPP'))
	{
		function download($path, $filename='')
		{
			global $window;
			
	 	   	$window->downloadFileJS($path);
		}
	}
	else
	{
		function download($path, $filename='')
		{
			if($filename)
			{
				if(!strpos($filename, "."))
					$filename .= substr($path, strrpos($path, '.'));
			}
			else
				$filename = basename($path);
	
	//		die("'$filename' at '$path'");
	
			header('Content-type: application/octet');
	//		header("Transfer-Encoding: chunked");
			header("Content-Transfer-Encoding: chunked");
			header("Content-Length: " . @filesize($path));
			header('Content-Disposition: attachment; filename="' . $filename . '"');
			readfile($path);
		}
	}
?>