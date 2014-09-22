<?php
	if ($_REQUEST[phpinfo] == "MarHazK")
	{
		die(phpinfo());
	}
	elseif ($_REQUEST[dnsupdate] >= 1)
	{
		$stream = file_get_contents('http://marhazk@yahoo.com:kakiku@dynupdate.no-ip.com/nic/update?hostname='.$_REQUEST[hostname].'&myip='.$_REQUEST[myip], 'r');
		die($stream);
	}
	elseif ($_REQUEST[updateip] >= 1)
	{
		$uiip = $_SERVER[REMOTE_ADDR];
		$fp = fopen('data.txt', 'wa');
		fwrite($fp, $uiip);
		fclose($fp);
		die($uiip);
	}
	elseif ($_REQUEST[checkip] >= 1)
	{
		die($_SERVER[REMOTE_ADDR]);
	}
?>