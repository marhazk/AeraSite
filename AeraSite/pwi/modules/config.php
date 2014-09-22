<?php
	$auth_aus = 0;
	$auth_aps = 0;
	$leftHeight = 400;
	$flashheight = 579;
	$uWeb_chardb[uid] = 0;
	$uWeb_roleidmin = 0;
	$serverUp = 0;
	$dbuhost = 'hazdns.sytes.net';
	$dbuname = 'aera';
	$dbupass = '870830';
	$emailHost = "perfectworld.com.my";
	$Link = @mysql_connect($dbuhost, $dbuname, $dbupass);
	if ($Link)
	{
		mysql_set_charset('utf8',$Link); 
		$dbsel = @mysql_select_db('dbo', $Link) or die ("Database do not exists.");	
		$serverUp = 1;	
	}
	// Account Settings
	$cookienameID = "PWAeraDBuser2u";
	$cookienameAuth = "PWAeraDBuser2a";
	//session_start();
	//$cookieAuthID = $_SESSION[$cookienameID];
	//$cookieAuth = $_SESSION[$cookienameAuth];
	$cookieAuthID = $_COOKIE[$cookienameID];
	$cookieAuth = $_COOKIE[$cookienameAuth];
	//setcookie($cookienameID, "", time()-3600);
	//setcookie($cookienameAuth,"", time()-3600);
	$chkiplong = abs(ip2long($_SERVER[REMOTE_ADDR]));
	$chkip = $_SERVER[REMOTE_ADDR];
	$chk_host = $_SERVER[HTTP_HOST];
	$conf["login"] = 5;
	$conf["logout"] = 0;
	$conf["logingout"] = 6;
	
	$op2 = $_REQUEST['type'];
	$cookievalue = "";
	$userWebID = 0;
	if (isset($_REQUEST[tid]))
		$roleid = $_REQUEST[tid];
	if (isset($_REQUEST[roleid]))
		$roleid = $_REQUEST[roleid];	
	///////////////
	// AErapoint Requirements
	$requireRepUser = 1;
	//$requireSP = 1000;
	//$requireGold = 1000;
	//$requireSP = 10000000;
	//$requireGold = 5000000;
	$requireSP = 50000;
	$requireGold = 15000;
	//////////////////
	$op = $_REQUEST["op"];
?>