<?php
	class urls {
	    static function cleanURL($url, $exception = '', $replace = "-")
		{
			$clean = preg_replace("/[^a-z0-9A-Z" . $exception . "]/", $replace, strtolower(trim($url)));
			if($replace)
			{
				$clean = preg_replace("/[" . $replace . "]+/", $replace, $clean);
				$clean = preg_replace("/{$replace}$/", "", $clean);
			}
			return $clean;
		}

		static function cleanURLMinimal($url, $exception = '', $replace = "-")
	    {
	    	$url = str_replace(array('�', '�', 'u', '�', '�', 'o', '�', '�', '�', '�'), array('i', 'u', 'u', 'u', 'o', 'o', 'o', 'a', 'e', 'o'), iconv('UTF-8','ISO-8859-1', urldecode(stripslashes($url))));
	        $clean = preg_replace("/[\;\/\?,:@=\&\"\ \!\.]/", $replace, strtolower(trim($url)));
	        if($replace)
	        {
	            $clean = preg_replace("/[" . $replace . "]+/", $replace, $clean);
	            $clean = preg_replace("/{$replace}$/", "", $clean);
	        }
	        return $clean;
	    }

	    static function cleanFileName($url, $exception = '')
		{
			$clean = preg_replace("/[^a-z0-9A-Z" . $exception . "]/", "_", strtolower(trim($url)));
			$clean = preg_replace("/[\_]+/", "_", $clean);
			return preg_replace("/_$/", "", $clean);
		}

	    static function updateURL($otype, $oid, $url, $dbTable = null)
		{
			if(!$url)
				return $url;

			if(!$dbTable)
				$dbTable = DB_PREFIX . $otype;

			if($url = urls::validateURL($otype, $oid, $url))
			{
				$query = "update {$dbTable} set url='$url' where id='" . abs($oid) . "';";
				tspl_query($query);
			}
			return $url;
		}

	    static function validateURL($otype, $oid, $url)
		{
			$query = "select id from " . DB_PREFIX . "urls where otype='$otype' and oid='$oid' and url='$url' and active=1;";
			$result = tspl_query($query);
			if(mysqli_num_rows($result))
				return $url;
			else
			{
				try
				{
					//If duplicate url occur first time....'
					$query = "select url from " . DB_PREFIX . "urls where url like '$url' and active=1 order by url desc limit 1;";
					$result = tspl_query($query);
					if(!mysqli_num_rows($result))
						$url = $url;
					else
					{
						//If duplicate url occur first time....'
						$query = "select url from " . DB_PREFIX . "urls where url like '$url-%' and active=1 order by url desc limit 1;";
						$result = tspl_query($query);
						if(!mysqli_num_rows($result))
							$url = $url . "-1";
						else
						{
							$query = "select id, url from " . DB_PREFIX . "urls where url like '$url-%' and active=1 order by url desc limit 1;";
							$result = tspl_query($query);
							if(mysqli_num_rows($result))
							{
								if($row = mysqli_fetch_assoc($result))
								{
									$lastid = str_ireplace($url . "-", "", $row['url']);
									if(intval($lastid))
										$url .= '-' . (intval($lastid) + 1);
								}
							}
						}
					}

					//URL update query
					$query = "update " . DB_PREFIX . "urls set active=0 where otype='$otype' and oid='$oid';";
					tspl_query($query);

					$query = "insert into " . DB_PREFIX . "urls(otype, oid, url, active) values('$otype', '$oid', '$url', 1);";
					tspl_query($query);
				}
				catch (Exception  $e)
				{
					// die(print_r($e));
					return null;
				}
			}
			return $url;
		}
	}
?>
