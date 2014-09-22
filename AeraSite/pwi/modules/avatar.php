<?php
header("Content-type: image/jpeg charset: utf-8");
$textImage = imagecreatefromjpeg("./images/avatar.jpg");
$white = imagecolorallocate($textImage, 255, 255, 255);
$red = imagecolorallocate($textImage, 255, 0, 0);
$black = imagecolorallocate($textImage, 0, 0, 0);

$udb = getuserdb("forumuname", $_REQUEST["name"]);
if ($udb["forumroleid"] >= 32)
{
	$rdb = getroledb("roleid", $udb["forumroleid"]);
	imagestring($textImage, 2, 64, 78, $rdb["rolelevel"], $white);
}
else
{
	imagestring($textImage, 3, 63, 78, "N/A", $white);
}
imagejpeg($textImage);
imagedestroy($textImage);
die();
?>