<?php
$uwebmsg_qerr = "ERROR";
	if ($_POST[upload] == 1)
	{
		$eubo_temp_b = 100;
		define ("FILEREPOSITORY","./images/uploaded_images/");
		if (isset($_FILES['gfx'])) {
			if (is_uploaded_file($_FILES['gfx']['tmp_name'])) {
				if (! is_dir(FILEREPOSITORY))
				{
					mkdir(FILEREPOSITORY);
				}
				$uWeb_gfxfile = $_FILES;
				$result = move_uploaded_file($_FILES['gfx']['tmp_name'], FILEREPOSITORY."/".$_FILES['gfx']['name']);
			}
		}
			
		$uWeb_path = "./images/uploaded_images/";
		function aspect_ratio($x,$y,$z)
		{
			return (int)(($z/$x)*$y);
		}
		function createImage($uploadedfile,$newWidth,$name,$dirpath)
		{
			// Capture the original size of the uploaded image
			if(!$info=getimagesize($uploadedfile))
			return false;
	       
			switch ($info['mime'])
			{
				case 'image/bmp':
					$src = imagecreatefrombmp($uploadedfile);
					break;
				case 'image/jpeg':
					$src = imagecreatefromjpeg($uploadedfile);
					break;
				case 'image/gif':
					$src = imagecreatefromgif($uploadedfile);
					break;
				case 'image/png':
					$src = imagecreatefrompng($uploadedfile);
					break;
				default:
					return false;
			}
	       
			//Change the filename to add the filetype
			$mime=split("image/",$info['mime']);
			//$filename= "./uploaded_images/$dirpath/resized/".$name.".".$mime[1];
			$filename= "./images/uploaded_images/resized/".$name."_t.gif";
	       
			$size = getimagesize($uploadedfile);
			//$newHeight=aspect_ratio($size[0],$newWidth,$size[1]);
			$newHeight=135;
			$newWidth=180;
	       
			$tmp=imagecreatetruecolor($newWidth,$newHeight);
	       
			// this line actually does the image resizing, copying from the original
			// image into the $tmp image
			imagecopyresampled($tmp,$src,0,0,0,0,$newWidth,$newHeight,$info[0], $info[1]);
	       
			switch ($info['mime'])
			{
				case 'image/bmp':
					imagegif($tmp,$filename,100); //100 is the quality settings, values range from 0-100.
					//imagejpeg($tmp,$filename,100); //100 is the quality settings, values range from 0-100.
					break;
				case 'image/jpeg':
					imagegif($tmp,$filename,100); //100 is the quality settings, values range from 0-100.
					//imagejpeg($tmp,$filename,100); //100 is the quality settings, values range from 0-100.
					break;
				case 'image/gif':
					imagegif($tmp,$filename,100); //100 is the quality settings, values range from 0-100.
					//imagejpeg($tmp,$filename,100); //100 is the quality settings, values range from 0-100.
					break;
				case 'image/png':
					imagegif($tmp,$filename,100); //100 is the quality settings, values range from 0-100.
					//imagepng($tmp,$filename); //100 is the quality settings, values range from 0-100.
					break;
			}
	           
			imagedestroy($src);
			imagedestroy($tmp); // NOTE: PHP will clean up the temp file it created when the request
			// has completed.
			return true;
		}
		function convertImage($uploadedfile,$newWidth,$name,$dirpath)
		{
			// Capture the original size of the uploaded image
			if(!$info=getimagesize($uploadedfile))
			return false;
	       
			switch ($info['mime'])
			{
				case 'image/bmp':
					$src = imagecreatefrombmp($uploadedfile);
					break;
				case 'image/jpeg':
					$src = imagecreatefromjpeg($uploadedfile);
					break;
				case 'image/gif':
					$src = imagecreatefromgif($uploadedfile);
					break;
				case 'image/png':
					$src = imagecreatefrompng($uploadedfile);
					break;
				default:
					return false;
			}
	       
			//Change the filename to add the filetype
			$mime=split("image/",$info['mime']);
			//$filename= "./uploaded_images/$dirpath/resized/".$name.".".$mime[1];
			$filename= "./images/uploaded_images/resized/".$name.".jpg";
			$filename2= "./images/uploaded_images/resized/".$name."_m.jpg";
			$filename3= "./images/uploaded_images/resized/".$name."_b.jpg";
	       
			$size = getimagesize($uploadedfile);
			$newWidth=500;
			$newHeight=aspect_ratio($size[0],$newWidth,$size[1]);
			$newWidth3=1000;
			$newHeight3=aspect_ratio($size[0],$newWidth3,$size[1]);
			//$newHeight=100;

	       
			$tmp=imagecreatetruecolor($size[0],$size[1]);
			$tmp2=imagecreatetruecolor($newWidth,$newHeight);
			$tmp3=imagecreatetruecolor($newWidth3,$newHeight3);
	       
			// this line actually does the image resizing, copying from the original
			// image into the $tmp image
			imagecopyresampled($tmp,$src,0,0,0,0,$size[0],$size[1],$info[0], $info[1]);
			imagecopyresampled($tmp2,$src,0,0,0,0,$newWidth,$newHeight,$info[0], $info[1]);
			imagecopyresampled($tmp3,$src,0,0,0,0,$newWidth3,$newHeight3,$info[0], $info[1]);
	       
			switch ($info['mime'])
			{
				case 'image/bmp':
					imagejpeg($tmp,$filename,100); //100 is the quality settings, values range from 0-100.
					imagejpeg($tmp2,$filename2,100); //100 is the quality settings, values range from 0-100.
					imagejpeg($tmp3,$filename3,100); //100 is the quality settings, values range from 0-100.
					break;
				case 'image/jpeg':
					imagejpeg($tmp,$filename,100); //100 is the quality settings, values range from 0-100.
					imagejpeg($tmp2,$filename2,100); //100 is the quality settings, values range from 0-100.
					imagejpeg($tmp3,$filename3,100); //100 is the quality settings, values range from 0-100.
					break;
				case 'image/gif':
					imagejpeg($tmp,$filename,100); //100 is the quality settings, values range from 0-100.
					imagejpeg($tmp2,$filename2,100); //100 is the quality settings, values range from 0-100.
					imagejpeg($tmp3,$filename3,100); //100 is the quality settings, values range from 0-100.
					break;
				case 'image/png':
					imagejpeg($tmp,$filename,100); //100 is the quality settings, values range from 0-100.
					imagejpeg($tmp2,$filename2,100); //100 is the quality settings, values range from 0-100.
					imagejpeg($tmp3,$filename3,100); //100 is the quality settings, values range from 0-100.
					//imagepng($tmp,$filename); //100 is the quality settings, values range from 0-100.
					break;
			}
	           
			imagedestroy($src);
			imagedestroy($tmp); // NOTE: PHP will clean up the temp file it created when the request
			imagedestroy($tmp2); // NOTE: PHP will clean up the temp file it created when the request
			imagedestroy($tmp3); // NOTE: PHP will clean up the temp file it created when the request
			// has completed.
		
			return true;
		}
		
		function ConvertBMP2GD($src, $dest = false) {
			if(!($src_f = fopen($src, "rb"))) {
				return false;
			}
			if(!($dest_f = fopen($dest, "wb"))) {
				return false;
			}
			$header = unpack("vtype/Vsize/v2reserved/Voffset", fread($src_f,14));
			$info = unpack("Vsize/Vwidth/Vheight/vplanes/vbits/Vcompression/Vimagesize/Vxres/Vyres/Vncolor/Vimportant", fread($src_f, 40));

			extract($info);
			extract($header);

			if($type != 0x4D42)
			{
				// signature "BM"
				return false;
			}

			$palette_size = $offset - 54;
			$ncolor = $palette_size / 4;
			$gd_header = "";
			// true-color vs. palette
			$gd_header .= ($palette_size == 0) ? "\xFF\xFE" : "\xFF\xFF";
			$gd_header .= pack("n2", $width, $height);
			$gd_header .= ($palette_size == 0) ? "\x01" : "\x00";
			if($palette_size) {
				$gd_header .= pack("n", $ncolor);
			}
			// no transparency
			$gd_header .= "\xFF\xFF\xFF\xFF";

			fwrite($dest_f, $gd_header);

			if($palette_size) {
				$palette = fread($src_f, $palette_size);
				$gd_palette = "";
				$j = 0;
				while($j < $palette_size) {
					$b = $palette{$j++};
					$g = $palette{$j++};
					$r = $palette{$j++};
					$a = $palette{$j++};
					$gd_palette .= "$r$g$b$a";
				}
				$gd_palette .= str_repeat("\x00\x00\x00\x00", 256 - $ncolor);
				fwrite($dest_f, $gd_palette);
			}

			$scan_line_size = (($bits * $width) + 7) >> 3;
			$scan_line_align = ($scan_line_size & 0x03) ? 4 - ($scan_line_size & 0x03) : 0;

			for($i = 0, $l = $height - 1; $i < $height; $i++, $l--) {

				// BMP stores scan lines starting from bottom
				fseek($src_f, $offset + (($scan_line_size + $scan_line_align) * $l));
				$scan_line = fread($src_f, $scan_line_size);
				if($bits == 24) {
					$gd_scan_line = "";
					$j = 0;
					while($j < $scan_line_size) {
						$b = $scan_line{$j++};
						$g = $scan_line{$j++};
						$r = $scan_line{$j++};
						$gd_scan_line .= "\x00$r$g$b";
					}
				}
				else if($bits == 8) {
					$gd_scan_line = $scan_line;
				}
				else if($bits == 4) {
					$gd_scan_line = "";
					$j = 0;
					while($j < $scan_line_size) {
						$byte = ord($scan_line{$j++});
						$p1 = chr($byte >> 4);
						$p2 = chr($byte & 0x0F);
						$gd_scan_line .= "$p1$p2";
					}
					$gd_scan_line = substr($gd_scan_line, 0, $width);
				}
				else if($bits == 1) {
					$gd_scan_line = "";
					$j = 0;
					while($j < $scan_line_size) {
						$byte = ord($scan_line{$j++});
						$p1 = chr((int) (($byte & 0x80) != 0));
						$p2 = chr((int) (($byte & 0x40) != 0));
						$p3 = chr((int) (($byte & 0x20) != 0));
						$p4 = chr((int) (($byte & 0x10) != 0));
						$p5 = chr((int) (($byte & 0x08) != 0));
						$p6 = chr((int) (($byte & 0x04) != 0));
						$p7 = chr((int) (($byte & 0x02) != 0));
						$p8 = chr((int) (($byte & 0x01) != 0));
						$gd_scan_line .= "$p1$p2$p3$p4$p5$p6$p7$p8";
					}
					$gd_scan_line = substr($gd_scan_line, 0, $width);
				}

				fwrite($dest_f, $gd_scan_line);
			}
			fclose($src_f);
			fclose($dest_f);
			return true;
		}

		function imagecreatefrombmp($filename) {
			$tmp_name = tempnam("./modules/uploaded_images/tmp", "GD");
			if(ConvertBMP2GD($filename, $tmp_name))
			{
				$img = imagecreatefromgd($tmp_name);
				unlink($tmp_name);
				return $img;
			}
			return false;
		}

		//if(!createImage($uploadedfile,100, "uploaded_images/imgname"))

		$uWeb_file = $uWeb_gfxfile['gfx']['name'];
		$gfx_filename = FILEREPOSITORY."/".$_FILES['gfx']['name'];
		$eubo_temp_a = "$uWeb_path/$uWeb_file";
		$eubo_temp_c = str_replace(".jpeg","",$uWeb_file);
		$eubo_temp_c = str_replace(".jpg","",$uWeb_file);
		$eubo_temp_c = str_replace(".png","",$uWeb_file);
		$eubo_temp_c = str_replace(".gif","",$uWeb_file);
		$eubo_temp_c = str_replace(".bmp","",$uWeb_file);
		$eubo_temp_c = $eubo_temp_c."_".time();
		$eubo_temp_c = md5($eubo_temp_c);
		createImage($eubo_temp_a, $eubo_temp_b, $eubo_temp_c, $uWeb_p); 
		convertImage($eubo_temp_a, $eubo_temp_b, $eubo_temp_c, $uWeb_p);
		
		$gfx_size = getimagesize($gfx_filename);
		$gfx_width = $gfx_size[0];
		$gfx_height = $gfx_size[1];
		$gfx_desc = $_POST[desc];
		$gfx_desc = str_replace("'","",$gfx_desc);
		$gfx_desc = str_replace('"',"",$gfx_desc);
		
		$uWeb_gfxtime = time();
		$uWeb_gfx2q = "INSERT INTO uwebphotos (pby, pfile, pdate, pcat, porifile, poritype, pdesc, pwidth, pheight) values ($chkid, '$eubo_temp_c', '".$uWeb_gfxtime."', '".$_POST[cat]."', '".$_FILES['gfx']['name']."', '".$_FILES['gfx']['type']."', '$gfx_desc', $gfx_width, $gfx_height);";
		$uWeb_gfx2r = mysql_query($uWeb_gfx2q) or die("$uwebmsg_qerr 2 $uWeb_gfx2q");
		//$uWeb_gfx2r = mysql_query($uWeb_gfx2q) or die("Arif, Copy ko msg tok: $uWeb_gfx2q");

		unlink($gfx_filename);
		
		if (($uWeb_vinfo["uphototime"]+(60*60)) <= $uWeb_gfxtime)
		{
			$uWeb_gfxuser1 = mysql_query("UPDATE users SET uphototime='".$uWeb_gfxtime."', claimaeracoin=(claimaeracoin+1000) WHERE ID=".$chkid);
			echo "<BR>Your picture has been successfully uploaded and you have gain 10 AeraGold under your UAA. You will get extra 10 AeraGold if you upload another photo in the next 1 hour. Your photo can be viewed by <a href=\"?op=photos/view&cat=".$_POST[cat]."&name=".$eubo_temp_c."\">clicking here</a>";
		}
		else
		{
			echo "<BR>Your picture has been successfully uploaded. You can view them by <a href=\"?op=photos/view&cat=".$_POST[cat]."&name=".$eubo_temp_c."\">clicking here</a>";
		}
	}
	include "modules/files/accounts/user/photos.design.php";
?>
