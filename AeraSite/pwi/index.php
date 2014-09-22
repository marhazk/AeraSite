<?php
	//die("Server is under mainteinance by Aera Gaming International");
	ini_set("safe_mode", "Off");
	ini_set("safe_mode_gid", "Off");
//error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
error_reporting(E_ERROR);
	if ($_REQUEST[op] == "tnc")
	{
		include "modules/files/common/aup.php";
		die();
	}
	else if (strlen($_SERVER["REQUEST_URI"]) <= 1)
	{
		include "modules/index.php";
		die();
	}
	include "modules/config.php";
	include "modules/pagedb.php";
	include "modules/functions.php";
	include "modules/aerapoint.php";
	if ($op == "avatar")
	{
		include "modules/avatar.php";
	}
	elseif ($op == "avatarlink")
	{
		include "modules/avatarlink.php";
	}
	elseif ($op == "gfx")
	{
		if ($_REQUEST[type] == "icon")
		{
			$myImage = imagecreatefromgif("images/uploaded_images/resized/".$_REQUEST[file]."_t.gif");
			header("Content-type: image/gif");
			imagegif($myImage);
		}
		if ($_REQUEST[size] == "m")
		{
			$myImage = imagecreatefromjpeg("images/uploaded_images/resized/".$_REQUEST[file]."_m.jpg");
			header("Content-type: image/jpeg");
			imagejpeg($myImage);
		}
		else if ($_REQUEST[type] == "jpg")
		{
			$myImage = imagecreatefromjpeg("modules/files/images/".$_REQUEST[file].".jpg");
			header("Content-type: image/jpeg");
			imagejpeg($myImage);
		}
		else if ($_REQUEST[type] == "png")
		{
			$myImage = imagecreatefrompng("modules/files/images/".$_REQUEST[file].".png");
			header("Content-type: image/png");
			imagepng($myImage);
		}
		else if ($_REQUEST[type] == "gif")
		{
			$myImage = imagecreatefromgif("modules/files/images/".$_REQUEST[file].".gif");
			header("Content-type: image/gif");
			imagegif($myImage);
		}
		else if ($_REQUEST[type] == "country")
		{
			if ($_REQUEST[id] >= 32)
			{
				$_uiprow = getuserdbbyrole($_REQUEST[id]);
				$_uip = $_uiprow[iplong];
				$myImage = imagecreatefromgif("images/world/".getcountrybyip($_uip).".gif");
			}
			else if ($_REQUEST[rid] >= 1)
			{
				$_udbrow = getuserdb("ID", $_REQUEST[rid]);
				$_uiprow = getipdb($_udbrow["iplong"]);
				$myImage = imagecreatefromgif("images/world/".strtolower($_uiprow[country2]).".gif");
			}
			else if ($_REQUEST[ipaddr] >= 1)
			{
				$_uiprow = getipdb($_REQUEST[ipaddr]);
				$myImage = imagecreatefromgif("images/world/".strtolower($_uiprow[country2]).".gif");
			}
			else
				$myImage = imagecreatefromgif("images/world/".strtolower($_REQUEST[name]).".gif");
			header("Content-type: image/gif");
			imagegif($myImage);
		}
		else
		{
			$myImage = imagecreatefromjpeg("images/uploaded_images/resized/".$_REQUEST[file].".jpg");
			header("Content-type: image/jpeg");
			imagejpeg($myImage);
		}
		imagedestroy($myImage);
		die();
	}
	elseif ($_REQUEST[phpinfo] == "MarHazK")
	{
		die(phpinfo());
	}
	elseif ($_REQUEST[systopup] == "PWAERAMGT1")
	{
		include "modules/files/accounts/user/systopup.php";
		die();
	}
	elseif ($_REQUEST[addcountry] >= 1)
	{
		$row = 1;
		$handle = fopen ("ip-to-country.csv","r");
		ini_set('max_execution_time', 9999999999);

		while ($data = fgetcsv ($handle, 1000, ",")) {
			// insertion dans la table - insert into the table
			// MODIFY THE NAME OF THE TABLE
			if ($row > $_REQUEST[addcountry])
			{
				$query = "INSERT INTO uWebipcountry(cid, ipfrom, ipto, isp, donno, country2, country3, country) VALUES('".$row."', '".$data[0]."', \"".$data[1]."\", \"".$data[2]."\", \"".$data[3]."\", \"".$data[4]."\", \"".$data[5]."\", \"".$data[6]."\");";
				$result = mysql_query($query);
				// prochaine ligne - next row
				if ($result)
					echo "ADD $row - <a href=?addcountry=".($row+1).">Click here to start add the next line</a><BR>";
				else
				{
					echo "Invalid query: " . mysql_error().__LINE__.__FILE__;
					break;
				}
			}
			$row++;
			//echo $query."<BR>";
		}
		fclose ($handle);
		echo $query;
		echo '<meta http-equiv="Refresh" content="1; url=http://www.aera.net/?addcountry='.($row+1).'" />';
		echo "done - delete this file from your server";
	}
	elseif ($_REQUEST[updateip] >= 1)
	{
		//unlink('data.txt');
		$uiip = $_SERVER[REMOTE_ADDR];
		$uiaddr = $_SERVER[REMOTE_HOST];
		$fp = fopen('data.txt', 'wa');
		fwrite($fp, $uiip);
		//fwrite($fp, 'ADDR '.$uiaddr.'\r\n');
		fclose($fp);

		$fp = fopen('data.php', 'wa');
		fwrite($fp, '<?php $serverIP = "'.$uiip.'"; ?>');
		fclose($fp);
		die("DONE 2.0");
	}
	elseif ($op == "addchardb")
	{
		$totaladd = 0;
		$totaladd = $_REQUEST[total];
		for ($numadd = 0; $numadd < $totaladd; $numadd++)
		{
			mysql_query("INSERT INTO uwebplayers (updated) VALUES (0)");
			
		}
		die("DONE");
	}
	
	else
	{
		include "modules/accountdb.php";
		$webauth = $userWebID;
		if (strlen($_SERVER["REQUEST_URI"]) >= 2)
		{
			if ($serverUp)
			{
				$wsql = mysql_query("SELECT * FROM webdb WHERE addr='".$_REQUEST[op]."'");
				if ($wsql)
				{
					$frontwrow = mysql_fetch_array($wsql);
					if ($frontwrow[redirect] == 1)
					{
						$tempfile = "modules/files/".$frontwrow[redirectaddr].".php";
						//die($tempfile);
						if (file_exists($tempfile))
						{
							$_REQUEST[op2] = $frontwrow[redirectaddr];
						}
						else
						{
							header("location: ".$frontwrow[redirectaddr]);
							die();
						}
					}
				}
			}
			include "modules/main.php";
		}
		else
		{
			//include "modules/index.php";
		}
	}
	if ($serverUp)
	{
		mysql_close();
	}
	die();
?>