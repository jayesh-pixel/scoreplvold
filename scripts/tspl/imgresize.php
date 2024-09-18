<?php
	function smart_resize_image($file, $width = 0, $height = 0, $proportional = false, $output = 'file', $delete_original = true, $use_linux_commands = false, $enlarge = false, $crop = false)
  	{
    	if ( $height <= 0 && $width <= 0 )
      		return false;

    	$info = getimagesize($file);
    	$image = '';
		
    	$final_width = 0;
    	$final_height = 0;
    	list($width_old, $height_old) = $info;

    	if(!$enlarge && ($width_old < $width) && ($height_old < $height))
    		return false;

		$src_x = 0;
		$src_y = 0;

		// echo "Original: (null, null, 0, 0, $src_x, $src_y, $final_width, $final_height, $width_old, $height_old);<br />";
		if($crop)
		{
			$aspect_old = ($width_old / $height_old);
			$aspect_new = ($width / $height);
			 
			if($aspect_old > $aspect_new)
			{
				$src_x = ($width_old - ($height_old * $aspect_new)) / 2;
				$width_old -= (2 * $src_x);
			}
			elseif($aspect_old < $aspect_new)
			{
				$src_y = ($height_old - ($width_old / $aspect_new)) / 2;
				$height_old -= (2 * $src_y);
			}
			// echo "CROP: (null, null, 0, 0, $src_x, $src_y, $final_width, $final_height, $width_old, $height_old);<br />";
		}
		
		if ($proportional)
		{
			if ($width == 0)
				$factor = $height/$height_old;
			else
				if ($height == 0)
					$factor = $width/$width_old;
				else
					$factor = min ( $width / $width_old, $height / $height_old);

			$final_width = round ($width_old * $factor);
			$final_height = round ($height_old * $factor);
			
			// echo "ASPECT: (null, null, 0, 0, $src_x, $src_y, $final_width, $final_height, $width_old, $height_old);<br /><hr />";
		}
		else
		{
			$final_width = ( $width <= 0 ) ? $width_old : $width;
			$final_height = ( $height <= 0 ) ? $height_old : $height;
		}
		
		if(strstr(strtolower($file), '.bmp'))
			$info[2] = IMAGETYPE_BMP;

		switch ($info[2])
		{
			case IMAGETYPE_GIF:
				$image = imagecreatefromgif($file);
				break;
			case IMAGETYPE_JPEG:
				$image = imagecreatefromjpeg($file);
				break;
			case IMAGETYPE_PNG:
				$image = imagecreatefrompng($file);
				break;
			case IMAGETYPE_BMP:
				$image = imagecreatefromwbmp($file);
				break;
			default:
				return false;
		}

		$image_resized = imagecreatetruecolor( $final_width, $final_height );

		if (($info[2] == IMAGETYPE_GIF) || ($info[2] == IMAGETYPE_PNG))
		{
			$trnprt_indx = imagecolortransparent($image);

			// If we have a specific transparent color
			if ($trnprt_indx >= 0)
			{

				// Get the original image's transparent color's RGB values
				$trnprt_color    = imagecolorsforindex($image, $trnprt_indx);

				// Allocate the same color in the new image resource
				$trnprt_indx    = imagecolorallocate($image_resized, $trnprt_color['red'], $trnprt_color['green'], $trnprt_color['blue']);

				// Completely fill the background of the new image with allocated color.
				imagefill($image_resized, 0, 0, $trnprt_indx);

				// Set the background color for new image to transparent
				imagecolortransparent($image_resized, $trnprt_indx);
			}
			// Always make a transparent background color for PNGs that don't have one allocated already
			elseif ($info[2] == IMAGETYPE_PNG)
			{

				// Turn off transparency blending (temporarily)
				imagealphablending($image_resized, false);

				// Create a new transparent color for image
				$color = imagecolorallocatealpha($image_resized, 0, 0, 0, 127);

				// Completely fill the background of the new image with allocated color.
				imagefill($image_resized, 0, 0, $color);

				// Restore transparency blending
				imagesavealpha($image_resized, true);
			}
		}

		imagecopyresampled($image_resized, $image, 0, 0, $src_x, $src_y, $final_width, $final_height, $width_old, $height_old);

		if($delete_original)
		{
			if($use_linux_commands)
				exec('rm '.$file);
			else
				@unlink($file);
		}

		switch(strtolower($output))
		{
			case 'browser':
				$mime = image_type_to_mime_type($info[2]);
				header("Content-type: $mime");
				$output = NULL;
				break;
			case 'file':
				$output = $file;
				break;
			case 'return':
				return $image_resized;
				break;
			default:
				break;
		}

		switch ($info[2])
		{
			case IMAGETYPE_GIF:
				imagegif($image_resized, $output);
				break;
			case IMAGETYPE_JPEG:
				imagejpeg($image_resized, $output);
				break;
			case IMAGETYPE_PNG:
				imagepng($image_resized, $output);
				break;
			case IMAGETYPE_BMP:
				image2wbmp($image_resized, $output);
				break;
			default:
				return false;
		}
		return true;
	}
?>