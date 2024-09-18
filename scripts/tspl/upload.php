<?php
	if(defined('DAPP'))
	{
		function uploadFile($fieldName, $strBasePath = '', $strFilePath = 'upload/', $arrExtensions = null, $arrResize = null, $newFileName = '', $crop = false)
		{
			global $window;
			return $window->uploadFileJS($filedName, true, $strFilePath);
		}
	}
	else
	{
		function createDirectory($dirName)
		{
			if(!file_exists($dirName))
			{
				$parent = dirname($dirName);
				if(!file_exists($parent))
					createDirectory($parent);

				mkdir($dirName, 0775, true);
				@chmod($dirName, 0775);
				
				if(@$_REQUEST['debug'])
					echo "created " . $dirName . "<br />";
			}
			elseif(@$_REQUEST['debug'])
				echo $dirName . " exists<br />";
		}
		
		function uploadFile($fieldName, $strBasePath = '', $strFilePath = 'upload/', $arrExtensions = null, $arrResize = null, $newFileName = '', $crop = false)
		{
			global $server_url;
			$arrReturn = array();
			
			// Upload Index Photo Here
			if($_FILES[$fieldName]['name'])
			{
				$strFileName = basename($_FILES[$fieldName]['name']);
				createDirectory($strBasePath . $strFilePath);
	
				$array = explode(".", $strFileName);
		    	$ext = strtolower($array[count($array)-1]);
	
		    	if(is_array($arrExtensions) && count($arrExtensions))
		    	{
			    	if(!in_array($ext, $arrExtensions))
						return $error = "File extension $ext not supported";
		    	}
	
		    	if(!$newFileName)
		    		$strFileName = $newFileName = $_FILES[$fieldName]['name'];
		    	else
			    	$strFileName = $newFileName . '.' . $ext;
	
			    require_once(dirname(__FILE__) . '/urls.php');
			   	$strFileName = $tmpFileName = cleanURL($strFileName, '\.\-');
	
				$intCount = '';
				do
				{
					if($intCount)
					{
						$intPosition = strrpos($strFileName,'.');
						$tmpFileName = substr($strFileName,0,$intPosition) . '_' . $intCount . '' . substr($strFileName,$intPosition);
					}
					$tmpFileName = $strBasePath . $strFilePath . str_replace("'","",$tmpFileName);
					$intCount++;
				}while(file_exists($tmpFileName));
	
				$strUploadPath = $tmpFileName;
	
				$arrReturn['_main'] = str_replace($strBasePath, "", $tmpFileName);
	
				if(!move_uploaded_file($_FILES[$fieldName]['tmp_name'],$strUploadPath))
				{
					if(!copy($_FILES[$fieldName]['tmp_name'],$strUploadPath))
						return $error = "File can not be uploaded";
				}
	
				if (is_array($arrResize))
				{
					chmod($strUploadPath, 0666);
					$imageExtensions = array('jpeg','jpg','gif','png');
					if(in_array($ext,$imageExtensions))
					{
						require_once(dirname(__FILE__) . '/imgresize.php');
	
						foreach($arrResize as $arr)
						{
							if(@$arr['suffix'])
							{
								$strResizedImagePath = str_ireplace('.' . $ext, '_' . $arr['suffix'] . '.' . $ext, $strUploadPath);
								copy($strUploadPath,$strResizedImagePath);
							}
							elseif(@$arr['prefix'])
							{
								$strResizedImagePath = str_ireplace($strBasePath . $strFilePath, $strBasePath . $strFilePath . $arr['prefix'] . "/", $strUploadPath);
								if(!file_exists($strBasePath . $strFilePath))
								{
									mkdir($strBasePath . $strFilePath . $arr['prefix'], 1755, true);
									if(!chmod($strBasePath . $strFilePath . $arr['prefix'], 1755))
										return $error = "File Permission Not Set.";
								}
								copy($strUploadPath, $strResizedImagePath);
							}
							else
								$strResizedImagePath = $strUploadPath;
	
							list($icon_width, $icon_height) = smart_resize_image($strResizedImagePath , $arr['width'], $arr['height'], true, 'file', true, false, (@$arr['enlarge']?true:false), $crop);
	
							if(@$arr['suffix'] || @$arr['prefix'])
							{
								$strResizedImagePath  = str_replace($strBasePath, "", $strResizedImagePath);
								$arrReturn[(@$arr['suffix']?$arr['suffix']:@$arr['prefix'])] = str_replace($strBasePath, "", $strResizedImagePath);
							}
						}
					}
				}
			}
			return $arrReturn;
		}
	
		function makeReadable($dirname)
		{
			if(!file_exists($dirname))
				return;
	
			print('Making directory ' . $dirname . ' readable<br />');
			$dir_handle = null;
	
			if (is_dir($dirname))
				$dir_handle = opendir($dirname);
			if (!$dir_handle)
				return false;
			while($file = readdir($dir_handle))
			{
				if ($file != "." && $file != "..")
				{
					if (!is_dir($dirname."/".$file))
					{
						print('Making file ' . $dirname . "/" . $file . ' readable<br />');
						chmod($dirname."/".$file, 0666);
					}
					else
						makeReadable($dirname.'/'.$file);
				}
			}
			closedir($dir_handle);
			chmod($dirname, 0777);
			return true;
		}
	}
?>