<?php
	function tsplrmdir($dirname)
	{
		if(!file_exists($dirname))
			return;

		debug('Deleting directory ' . $dirname . '<br />');
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
					debug('Deleting file ' . $dirname . "/" . $file . '<br />');
					unlink($dirname."/".$file);
				}
				else
					tsplrmdir($dirname.'/'.$file);
			}
		}
		closedir($dir_handle);
		rmdir($dirname);
		return true;
	}
?>