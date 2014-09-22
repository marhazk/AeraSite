<?php
header("Content-type: image/jpeg charset: utf-8");
//header("Content-type: image/png charset: utf-8");

$sql_server = "perfectworld.sytes.net";  // localhost or your IP
$sql_user = "root";  // Database user
$sql_pass = "5449";  // Database password
$sql_data = "dbo";  // Database name
$conn=mysql_connect($sql_server,$sql_user,$sql_pass);
mysql_set_charset('gd',$conn);
$xadb = mysql_select_db($sql_data,$conn);
//$maxhours = 604800; //7 days not online
$maxhours = 60*60*24*1; //1 day not online
$hoursonline = time()-$maxhours;

function _isroleonline($uid)
{
    //$ruid = (int)($uid/16)*16;
    $funcq = "SELECT Id FROM Online WHERE Id=$ruid";
    if ($uid)
    {
        if ($funcr = mysql_query($funcq))
        {
            if ($funcrow = mysql_fetch_array($funcr))
            {
                $funcuq = "SELECT onlineID FROM users WHERE ID='".$funcrow[Id]."'";
                if ($funcur = mysql_query($funcuq))
                {
                    if ($funcurow = mysql_fetch_array($funcur))
                    {
                        if ($funcurow[onlineID] == $uid)
                            return 1;
                        else
                            return 0;
                    }
                    else
                        return 0;
                }
                else
                    return 0;
            }
            else
                return 0;
        }
        else
            return 0;
    }
    else
        return 0;
}
function isroleonline($uid)
{
    //$ruid = (int)($uid/16)*16;
    $funcq = "SELECT ID FROM users WHERE online=1 AND onlineid='".$uid."'";
    if ($uid)
    {
        if ($funcr = mysql_query($funcq))
        {
            if ($funcrow = mysql_fetch_array($funcr))
            {
                return 1;
            }
            else
                return 0;
        }
        else
            return 0;
    }
    else
        return 0;
}

$type = $_REQUEST[postype];
$value = $_REQUEST[posvalue];
if ($type == 1)
{
    $maxvalue = $value+15;
    //$uWeb_gamemapr = mysql_query("SELECT * FROM uWebplayers WHERE roleid>=$value AND roleid<=$maxvalue AND updated=1");
    $uWeb_gamemapnote = "YOUR CHARACTERS";
    $uWeb_gamemapr = mysql_query("SELECT * FROM roles WHERE roleid='$value'");
    $uWeb_gamemapr2 = mysql_query("SELECT * FROM roles WHERE roleid='$value'");
    $textImage = imagecreatefromjpeg("./gamemapv5.jpg");
}
elseif ($type == 2)
{
    $maxvalue = $value+15;
    $uWeb_gamemapr = mysql_query("SELECT * FROM roles WHERE roleid>=$value AND roleid<=$maxvalue");
    $uWeb_gamemapr2 = mysql_query("SELECT * FROM roles WHERE roleid>=$value AND roleid<=$maxvalue");
    $uWeb_gamemapnote = "YOUR MULTIPLE CHARACTERS LIST";
    //$uWeb_gamemapr = mysql_query("SELECT * FROM uWebplayers WHERE roleid=$value");
    $textImage = imagecreatefromjpeg("./gamemapv5.jpg");
}
elseif ($type == 3)
{
    $maxvalue = $value+15;
    $uWeb_gamemapr = mysql_query("SELECT * FROM roles WHERE online2>=1 ORDER BY level DESC");
    $uWeb_gamemapr2 = mysql_query("SELECT * FROM roles WHERE online2>=1 ORDER BY level DESC");
    $uWeb_gamemapnote = "ONLINE PLAYERS LIST";
    //$uWeb_gamemapr = mysql_query("SELECT * FROM uWebplayers WHERE roleid=$value");
    $textImage = imagecreatefromjpeg("./gamemapv5.jpg");
}
else
{
    //$uWeb_gamemapr = mysql_query("SELECT * FROM roles WHERE roleid>=48 AND lastlogin>=$hoursonline ORDER BY level DESC");
    $uWeb_gamemapr = mysql_query("SELECT * FROM roles WHERE roleid>=32 ORDER BY level DESC");
    $uWeb_gamemapnote = "ALL PLAYERS LIST";
    $textImage = imagecreatefromjpeg("./gamemapv5.jpg");
}

$white = imagecolorallocate($textImage, 255, 255, 255);
$yellow = imagecolorallocate($textImage, 255, 255, 0);
$red = imagecolorallocate($textImage, 255, 0, 0);
$black = imagecolorallocate($textImage, 0, 0, 0);
$yOffset = 510;
$i = 7;
$gamemapnum = 0;
$bigfont = 7;
$colornum = 255;
//imagestring($textImage, $i, 5, $yOffset, "www.java2s.com $i", $white);
//imagestring($textImage, $i, 80, 1, ".", $white); //ORI

$divWeb = 5.5;
imagestring($textImage, 10, 145, $yOffset, "$uWeb_gamemapnote", $white);
$yOffset = $yOffset+50;


while ($uWeb_gamemaprow = mysql_fetch_array($uWeb_gamemapr))
{
    $gamemapnum++;

    //CHECK CLOSE OR NOT
    $closenum = 0;
    $pX = (int)$uWeb_gamemaprow[posx];
    $pZ = (int)$uWeb_gamemaprow[posz];
    $xX = $pX-10;
    $yX = $pX+10;
    $xZ = $pZ-10;
    $yZ = $pZ+10;
    $level = $uWeb_gamemaprow[level];
    $name = $uWeb_gamemaprow[name];
    if ($type >= 1)
    {
        while ($uWeb_gamemaprow2 = mysql_fetch_array($uWeb_gamemapr2))
        {
            $aX = (int)$uWeb_gamemaprow2[posx];
            $aZ = (int)$uWeb_gamemaprow2[posz];
            if ((($xX >= $aX) && ($yX <= $aX)) & (($xZ >= $aZ) && ($yZ <= $aZ)))
            {
                $closenum++;
            }
        }
        //$uWeb_gamemapx = 0 + (int)($uWeb_gamemaprow[posx] - 4242.5) / 14.784506666666666666666666666667;
        //$uWeb_gamemapz = 0 - (int)($uWeb_gamemaprow[posz] - 5000 + 2600) / 10;
        //$uWeb_gamemapx = (int)($uWeb_gamemaprow[posx] * (-13.498826666666666666666666666667));
        //$uWeb_gamemapz = (int)($uWeb_gamemaprow[posz] * (-4.6144679089026915113871635610766));
        $uWeb_gamemapx = (int)(($uWeb_gamemaprow[posx] +4078) / 2);
        $uWeb_gamemapz = (int)(($uWeb_gamemaprow[posz] + 3542) / 2);
        //$uWeb_gamemapx = 115 + (int)($uWeb_gamemaprow[posx] - 5000 + 3071) / 10;
        //$uWeb_gamemapz = 725 - (int)($uWeb_gamemaprow[posz] - 5000 + 2600) / 10;
        //$uWeb_gamemapx = (int)($uWeb_gamemaprow[posx] -4096) / 2;
        //$uWeb_gamemapz = (-(int)($uWeb_gamemaprow[posz] + 5632)) / 2;
    }
    else
    {

        $uWeb_gamemapx = (int)(($uWeb_gamemaprow[posx] +4078) / 2);
        $uWeb_gamemapz = (int)(($uWeb_gamemaprow[posz] + 3542) / 2);
        //$uWeb_gamemapx = 220 + (int)($uWeb_gamemaprow[posx] - 5000 + 3071) / $divWeb;
        //$uWeb_gamemapz = 1325 - (int)($uWeb_gamemaprow[posz] - 5000 + 2600) / $divWeb;
    }
    $utf8str = $uWeb_gamemaprow[name];
    //utf8_decode
    $uWeb_gamemap_name = preg_replace('/([\200-\277])/e', "'&#'.(ord('\\1')).';'", $utf8str);
    //$uWeb_gamemap_name = utf8_decode($utf8str);
    //$uWeb_gamemap_name = mb_convert_encoding($uWeb_gamemap_name, 'HTML-ENTITIES',"UTF-8");
    //$uWeb_gamemap_name = html_entity_decode($uWeb_gamemap_name,ENT_NOQUOTES, "ISO-8859-1");


    $uWeb_gamemap_id = $uWeb_gamemaprow[roleid];
    if (($uWeb_gamemap_name == "Aera") || ($uWeb_gamemap_name == "Elfy") || ($uWeb_gamemap_name == "CENTER"))
        $color = $red;
    else
        $color = $white;

    mt_srand((double)microtime() * 1000000);
    $rand_r = mt_rand(50, 255);
    $rand_g = mt_rand(50, 255);
    $rand_b = mt_rand(50, 255);
    //$rand_r = mt_rand(0, 100);

    $color = imagecolorallocate($textImage, $rand_r, $rand_g, $rand_b);
    $color2 = imagecolorallocate($textImage, 255, 255, 255);

    if ($type == 1)
        imagestring($textImage, $bigfont, $uWeb_gamemapx, $uWeb_gamemapz, ".  $uWeb_gamemap_name (L$level)", $white);
    elseif ($type == 2)
        imagestring($textImage, $bigfont, $uWeb_gamemapx, $uWeb_gamemapz, ".  $uWeb_gamemap_name (L$level)", $color);
    elseif ($type == 3)
    {
        imagestring($textImage, $bigfont, $uWeb_gamemapx, $uWeb_gamemapz, ".", $black);
        //imagestring($textImage, $bigfont, $uWeb_gamemapx, $uWeb_gamemapz, ".  $uWeb_gamemap_name (L$level)", $color);
    }
    else
    {
        imagestring($textImage, $i, $uWeb_gamemapx, $uWeb_gamemapz, ".", $color);
    }
    //$randx = mt_rand($uWeb_gamemapx+5, $uWeb_gamemapx+55);
    $randx = $uWeb_gamemapx+5;
    $randz = $uWeb_gamemapz+3;
    $font = 'The Courier TTF font';
    $font = 'Arial.ttf';

    if ($type == 1)
    {
        //imagettftext($textImage, 6, 145, $yOffset, $color, $font, "$gamemapnum - $uWeb_gamemap_name (L$level)");
        imagestring($textImage, 6, 145, $yOffset, "$gamemapnum - $uWeb_gamemap_name (L$level)", $color);
    }
    elseif ($type == 2)
    {
        //imagettftext($textImage, 6, 145, $yOffset, $color, $font, "$gamemapnum - $uWeb_gamemap_name (L$level)");
        imagestring($textImage, 6, 145, $yOffset, "$gamemapnum - $uWeb_gamemap_name (L$level)", $color);
    }
    elseif ($type == 3)
    {
        //imagettftext($textImage, 6, 145, $yOffset, $color, $font, "$gamemapnum - $uWeb_gamemap_name (L$level)");
        imagestring($textImage, 6, 145, $yOffset, "$gamemapnum - $uWeb_gamemap_name (L$level)", $color);
    }
    else
    {
        //imagettftext($textImage, 6, 145, $yOffset, $color, $font, "$gamemapnum - $uWeb_gamemap_name (L$level)");
        imagestring($textImage, 6, 145, $yOffset, "$gamemapnum - $uWeb_gamemap_name (L$level)", $color);
    }
    $yOffset = $yOffset+20;
    $colornum = $colornum-50;

}
//$yOffset += imagefontheight($i);

//$uWeb_setr = mysql_query("SELECT * FROM uWebsettings WHERE ID=1");
//$uWeb_setrow = mysql_fetch_array($uWeb_setr);
//$uWeb_gamemap_lastdate = date($uWeb_tzformat, $uWeb_almt);
$copyright = "GameMap Database v2.0 Beta 3 originally developed by MarHazK";

//imagestring($textImage, 5, 2535, 2183, ".YYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYY", $yellow);
//imagestring($textImage, 5, $_REQUEST[x], $_REQUEST[y], ".zzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz", $yellow);

if ($type >= 1)
{
    imagestring($textImage, 150, 1746, 396, $copyright, $white);
}
else
{
    imagestring($textImage, 150, 1746, 396, $copyright, $white);
}

imagejpeg($textImage);
//imagepng($textImage);
imagedestroy($textImage);
?>