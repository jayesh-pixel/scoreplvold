<?php
	require('dbFunctions.php');
	
	if(!function_exists('cleanURL'))
	{
		function cleanURL($url, $exception = '', $replace = "-")
		{
			$clean = preg_replace("/[^a-z0-9A-Z" . $exception . "]/", $replace, strtolower(trim($url)));
			if($replace)
			{
				$clean = preg_replace("/[" . $replace . "]+/", $replace, $clean);
				$clean = preg_replace("/{$replace}$/", "", $clean);
			}
			return $clean;
		}

		function cleanURLMinimal($url, $exception = '', $replace = "-")
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

		function cleanFileName($url, $exception = '')
		{
			$clean = preg_replace("/[^a-z0-9A-Z" . $exception . "]/", "_", strtolower(trim($url)));
			$clean = preg_replace("/[\_]+/", "_", $clean);
			return preg_replace("/_$/", "", $clean);
		}

		function updateURL($otype, $oid, $url)
		{
			global $dbPrefix, $globalTableFilter;
			global $$globalTableFilter;

			if($globalTableFilter)
				$strWhere = " and $globalTableFilter='{$$globalTableFilter}'";

			if($url = validateURL($otype, $oid, $url))
				dbUpdate("update {$dbPrefix}{$otype} set url='$url' where id='$oid' $strWhere;");
			return $url;
		}

		function validateURL($otype, $oid, $url)
		{
			global $window, $dbPrefix;
			
			global $globalTableFilter;
			global $$globalTableFilter;

			if($globalTableFilter)
				$strWhere = " and $globalTableFilter='{$$globalTableFilter}'";

			if(getRecord("select id from {$dbPrefix}urls where otype='$otype' and oid='$oid' and url='$url' and active=1 $strWhere;"))
				return $url;
			else
			{
				try
				{
					//If duplicate url occur first time....'
					if(!getRecord("select url from {$dbPrefix}urls where url like '$url' and active=1 $strWhere order by url desc limit 1;"))
						$url = $url;
					else
					{
						//If duplicate url occur first time....'
						if(!getRecord("select url from {$dbPrefix}urls where url regexp '$url-[0-9]+' and active=1 $strWhere order by url desc limit 1;"))
							$url = $url . "-1";
						else
						{
							if($record = getRecord("select id, url from {$dbPrefix}urls where url regexp '$url-[0-9]+' and active=1 $strWhere order by url desc limit 1;"))
							{
								$lastid = str_ireplace($url . "-", "", $record['url']);
								if(intval($lastid))
									$url .= '-' . (intval($lastid) + 1);
								else
									$url .= $record['url'] . '-1';
							}
						}
					}

					dbUpdate("update {$dbPrefix}urls set active=0 where otype='$otype' and oid='$oid' $strWhere;");

					if($globalTableFilter)
						dbInsert("insert into {$dbPrefix}urls(otype, oid, url, active, $globalTableFilter) values('$otype', '$oid', '$url', 1, {$$globalTableFilter});");
					else
						dbInsert("insert into {$dbPrefix}urls(otype, oid, url, active) values('$otype', '$oid', '$url', 1);");
				}
				catch (Exception  $e)
				{
					return null;
				}
			}
			return $url;
		}
	}
?>