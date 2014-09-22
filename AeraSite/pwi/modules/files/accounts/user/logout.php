<?php
if (isset($cookieAuthID) && ($cookieAuthID >= 32) && ($op2 == "logout"))
{
	mysql_query("UPDATE users SET authcode=NULL WHERE ID='".$userRow['ID']."'");
	setcookie("$cookienameID", "", 0);
	setcookie("$cookienameAuth","", 0);
	//$_SESSION[$cookienameID] = 0;
	//$_SESSION[$cookienameAuth] = 0;
	//echo "You have been logged out. Please login to continue.";
	$webauth = $conf["logingout"];
	$userWebID = $webauth;
}
?>