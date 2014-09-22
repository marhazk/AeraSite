<?php
$udb = getuserdb("forumuname", $_REQUEST["name"]);
if ($udb["forumroleid"] >= 32)
{
	$rdb = getroledb("roleid", $udb["forumroleid"]);
	header("location: http://www.perfectworld.my/?op=accounts&type=vinfo&tid=".$rdb[roleid]);
}
else
{
	header("location: http://www.perfectworld.my/");
}
die();
?>