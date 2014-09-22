<?php
	
	$ForumDB = new DBConfig();
	$ForumDB -> config();
	$forumconn = $ForumDB -> conn();
	$body[qa] = "";
	$body[st] = "";
	if ($forumconn)
	{
		/*if (isset($uWeb_vinfo["forumuname"]))
		{
			$fsqltext = "UPDATE bb_users SET aerauser=".$uWeb_vinfo["ID"]." WHERE username='".$uWeb_vinfo["forumuname"]."' AND  user_email='".$uWeb_vinfo["email"]."'";
			$fsqlset = mysql_query($fsqltext, $forumconn);
			//die($fsqltext);
		}
		else if (isset($uWeb_vinfo["email"]))
		{
			$fsqltext = "UPDATE bb_users SET aerauser=".$uWeb_vinfo["ID"]." WHERE user_email='".$uWeb_vinfo["email"]."'";
			$fsqlset = mysql_query($fsqltext, $forumconn);
			//die($fsqltext);
		}*/
		include "modules/defaultforum.php";
	}
	else
	{
		include "modules/defaultnonforum.php";
	}
	$ForumDB -> close();
?>