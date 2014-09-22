<?php
$textImage = imagecreatefromjpeg("gamemapv1.jpg");

$white = imagecolorallocate($textImage, 255, 255, 255);
$red = imagecolorallocate($textImage, 255, 0, 0);
$black = imagecolorallocate($textImage, 0, 0, 0);
$yOffset = 0;
$i = 10;
//imagestring($textImage, $i, 5, $yOffset, "www.java2s.com $i", $white);
//imagestring($textImage, $i, 80, 1, ".", $white); //ORI

include "../config.php";
$conn=mysql_connect($sql_server,$sql_user,$sql_pass);
$xadb = mysql_select_db($sql_data,$conn);

$uWeb_gamemapr = mysql_query("SELECT * FROM uWebplayers WHERE updated=1");
while ($uWeb_gamemaprow = mysql_fetch_array($uWeb_gamemapr))
{
	$uWeb_gamemapx = 120 + (int)($uWeb_gamemaprow[posx] - 5000 + 3071) / 10;
	$uWeb_gamemapz = 725 - (int)($uWeb_gamemaprow[posz] - 5000 + 2600) / 10;
	$uWeb_gamemap_name = $uWeb_gamemaprow[rolename];
	$uWeb_gamemap_id = $uWeb_gamemaprow[roleid];
	if (($uWeb_gamemap_name == "Aera") || ($uWeb_gamemap_name == "Elfy") || ($uWeb_gamemap_name == "CENTER"))
		$color = $red;
	else
		$color = $white;

	imagestring($textImage, $i, $uWeb_gamemapx, $uWeb_gamemapz, ".", $color);
	$randx = $uWeb_gamemapx+5;
	$randz = $uWeb_gamemapz+3;
	imagestring($textImage, 1, $randx, $randz, "$uWeb_gamemap_id", $color);
	
}
//$yOffset += imagefontheight($i);

header("Content-type: image/jpeg");
imagejpeg($textImage);
imagedestroy($textImage);
?>