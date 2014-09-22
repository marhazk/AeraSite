<?php
	//Check the latest patch version
	$sqlChkVersion = "SELECT revision FROM files ORDER BY revision DESC LIMIT 0,1";
	$qChkVersion = mysql_query($sqlChkVersion);
	$rowChkVersion = mysql_fetch_array($qChkVersion);
	
	//
	$sqlPatch = "SELECT * FROM patches WHERE id='".$rowChkVersion[revision]."' LIMIT 0,1";
	$qPatch = mysql_query($sqlPatch);
	$rowPatch = mysql_fetch_array($qPatch);
	
	//Change the broadcast msg for patch
	$updateBroadcastmsg = "NEWSFEED: Currect patch is Beta 3 Alpha ".$rowChkVersion[revision].". If you dont have this patch yet, you may install it with our patcher or manually download at website.";
	$sqlBroadcastmsg = "UPDATE uwebautobroadcast SET bmsg='".$updateBroadcastmsg."' WHERE bid=40";
	$qBroadcastmsg = mysql_query($sqlBroadcastmsg);
	
	//Set the Download >> INDEX
	$latestPatch = getpatch($rowPatch);
	
	//Set the announcement
	$chkWebTitle = "Released Patch 3".$rowChkVersion[revision]." (3 Beta ".$rowChkVersion[revision].")";
	$sqlChkWeb = "SELECT * FROM webdb WHERE linkname = '".$chkWebTitle."'";
	$qChkWeb = mysql_query($sqlChkWeb);
	if (mysql_num_rows($qChkWeb) < 1)
	{
		$ChkWeb[datetime] = time();
		$ChkWeb[addr] = "common/news/".$ChkWeb[datetime];
		$ChkWeb[title] = $chkWebTitle;
		$sqliChkWeb = "INSERT INTO webdb (addr, linkname, datetime, title, posttype, redirect, redirectaddr) VALUES ('".$ChkWeb[addr]."', '".$ChkWeb[title]."', '".$ChkWeb[datetime]."', '".$ChkWeb[title]."', 1, 1, '".$latestPatch[details]."')";
		$qiChkWeb = mysql_query($sqliChkWeb);
	}
?>