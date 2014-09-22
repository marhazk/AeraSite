<?php
	if ($serverUp)
	{
		$wsql = mysql_query("SELECT * FROM webdb WHERE addr='".$_REQUEST[op]."'");
		if ($wsql)
		{
			$pagenum = 0;
			while ($wlistrow = mysql_fetch_array($wsql))
			{
				
				$wpagedb[$pagenum] = $wlistrow;
				if (!empty($wlistrow[title]))
					$pagedb[$wlistrow[addr]] = $wlistrow[title];
				$pagenum++;
			}
		}
	}
	$includefilemain = 1;
	if (!empty($_REQUEST[op]))
	{
		if ($serverUp)
		{
			$wsql = mysql_query("SELECT * FROM webdb WHERE addr='".$_REQUEST[op]."'");
			if ($wsql)
			{
				$wrow = mysql_fetch_array($wsql);
			}
		}
		$includefile = "modules/files/".$_REQUEST[op2].".php";
		$includefile2 = "modules/files/".$_REQUEST[op].".php";
		$includefile3 = "modules/files/".$_REQUEST[op]."/index.php";
		$includefile4 = "modules/files/".$_REQUEST[op]."/1.php";
		if (file_exists($includefile))
		{
			$includefilemain = 0;
		}
		else if (file_exists($includefile2))
		{
			$includefile = $includefile2;
			$includefilemain = 0;
		}
		else if (file_exists($includefile3))
		{
			$includefile = $includefile3;
			$includefilemain = 0;
		}
		else if (file_exists($includefile4))
		{
			$includefile = $includefile4;
			$includefilemain = 0;
		}
		else
		{
			$includefilemain = 0;
			if ($wrow)
				$includefile = "modules/sqlpage.php";
			else
				$includefile = "modules/files/common/notfound.php";
		}
	}
	//
	// TOP
	if ($includefilemain)
		include "modules/topmain.php";
	else
		include "modules/topcontent.php";

	//CONTENT
	include "modules/links/topmenu2.php";
	if ($includefilemain)
		include "modules/topmain2.php";
	else
		include "modules/topcontent2.php";
		
	if ($includefilemain)
		include "modules/body.php";
	else
		include "modules/default.php";
	
	//BOTTOM
	if ($includefilemain)
		include "modules/bottommain.php";
	else
		include "modules/bottomcontent.php";

?>