<?php
header("Content-type: image/jpeg charset: utf-8");
//header("Content-type: image/png charset: utf-8");

error_reporting(1);

$sql_server = "perfectworld.sytes.net"; // localhost or your IP
$sql_user   = "aera"; // Database user
$sql_pass   = "870830"; // Database password
$sql_data   = "dbo"; // Database name
$conn       = mysql_connect($sql_server, $sql_user, $sql_pass);
mysql_set_charset('utf8', $conn);
$xadb = mysql_select_db($sql_data, $conn);
//$maxhours = 604800; //7 days not online
$maxhours    = 60 * 60 * 24 * 1; //1 day not online
$hoursonline = time() - $maxhours;

$sql           = "SELECT r.roleid, r.name, r.level, s.sdate, s.posx, s.posz FROM roles r, stats s WHERE r.roleid>=32 AND r.roleid=s.roleid AND s.mid=1 AND r.userid!=32 GROUP BY s.posx, s.posy , s.posz ORDER BY s.roleid DESC, s.sdate DESC";
$uWeb_gamemapr = mysql_query($sql);
//$uWeb_gamemapr = mysql_query("SELECT r.roleid, r.name, r.level, s.posx, s.posz FROM roles r, stats s WHERE r.roleid>=32 AND r.roleid=s.roleid AND s.mid=1 AND r.online2>=2 GROUP BY s.posx, s.posy , s.posz ORDER BY s.sdate DESC LIMIT 0,2");
//$uWeb_gamemapx = (int)(($uWeb_gamemaprow[posx] + 4078) / 2);
//$uWeb_gamemapz = (int)(($uWeb_gamemaprow[posz] + 3542) / 2);

$dbgraph = array();
while ($data = mysql_fetch_array($uWeb_gamemapr))
{
    $start = 0;
    if ($oldid != $data['roleid'])
    {
        $oldid = $data['roleid'];

        $oldx = 0;
        $oldz = 0;
    }
    $role = array();
    $role = $data;

    $oldx = round($data['posx']);
    $oldz = round($data['posz']);
    array_push($dbgraph, array('role' => $role, 'posx' => $oldx, 'posy' => $oldz));
    //echo "LINE 1:" . $oldid . " " . $oldx . ", " . $oldz . " : " . round($data['posx']) . ", " . round($data['posz']) . "<BR><hr>";
    /*
    if ((round($oldx) != round($data['posx'])) || (round($oldz) != round($data['posz'])))
    {
        if (($oldx == 0) && ($oldz == 0))
        {
            $oldx = round($data['posx']);
            $oldz = round($data['posz']);
            array_push($dbgraph, array('role' => $role, 'posx' => $oldx, 'posy' => $oldz));
            //array_push($dbx, $oldx);
            //array_push($dbz, $oldz);
            continue;
        }
        $reach     = 0;
        $reachmode = 0;


        if (round($oldx) > round($data['posx']))
            $reachmode = 1;
        else if (round($oldx) < round($data['posx']))
            $reachmode = 2;
        else if (round($oldz) > round($data['posz']))
            $reachmode = 3;
        else
            $reachmode = 4;

        $grm = ((round($data['posz']) - round($oldz)) / (round($data['posx']) - round($oldx))); //(y2-y1)/(x2-x1) = m
        $grc = (round($data['posz']) - ($grm * round($data['posx']))); // y=mx-c == y-mx=c


        while ((round($oldx) >= round($data['posx']) || (round($oldx) <= round($data['posx']))) && ((round($oldz) >= round($data['posz'])) || (round($oldz) <= round($data['posz']))))
        {
            if ((round($oldx) > round($data['posx'])) && ($reachmode == 1))
            {
                $oldx = round($oldx) - 1;
                $oldz = ($grm * $oldx) + $grc;
            }
            else if ((round($oldx) <= round($data['posx'])) && ($reachmode == 1))
            {
                $oldz = ($grm * $oldx) + $grc;
                break;
            }
            else if ((round($oldx) < round($data['posx'])) && ($reachmode == 2))
            {
                $oldx = round($oldx) + 1;
                $oldz = ($grm * $oldx) + $grc;
            }
            else if ((round($oldx) >= round($data['posx'])) && ($reachmode == 2))
            {
                $oldz = ($grm * $oldx) + $grc;
                break;
            }
            else if ((round($oldz) > round($data['posz'])) && ($reachmode == 3))
            {
                $oldz = round($oldz) - 1;
                $oldx = ($grm * $oldz) + $grc;
            }
            else if ((round($oldz) <= round($data['posz'])) && ($reachmode == 3))
            {
                $oldx = ($grm * $oldz) + $grc;
                break;
            }
            else if ((round($oldz) < round($data['posz'])) && ($reachmode == 4))
            {
                $oldz = round($oldz) + 1;
                $oldx = ($grm * $oldz) + $grc;
            }
            else
            {
                $oldx = ($grm * $oldz) + $grc;
                break;
            }

            //echo "LINE 2:" . $oldid . " " . $oldx . ", " . $oldz . " : " . round($data['posx']) . ", " . round($data['posz']) . "<BR>";
            array_push($dbgraph, array('role' => $role, 'posx' => $oldx, 'posy' => $oldz));

        }
        //array_push($dbgraph, array('role' => $role, 'posx' => $oldx, 'posy' => $oldz));
    }*/
}
$num              = 0;
$uWeb_gamemapnote = "ALL PLAYERS LIST";
$textImage        = imagecreatefromjpeg("./gamemapv5.jpg");


$white      = imagecolorallocate($textImage, 255, 255, 255);
$yellow     = imagecolorallocate($textImage, 255, 255, 0);
$red        = imagecolorallocate($textImage, 255, 0, 0);
$black      = imagecolorallocate($textImage, 0, 0, 0);
$yOffset    = 510;
$i          = 3;
$gamemapnum = 0;
$bigfont    = 7;
$colornum   = 255;
$fontFile   = 'verdana.ttf';

//imagestring($textImage, $i, 5, $yOffset, "www.java2s.com $i", $white);
//imagestring($textImage, $i, 80, 1, ".", $white); //ORI

$divWeb = 5.5;
//imagestring($textImage, 10, 145, $yOffset, "$uWeb_gamemapnote", $white);
//imagettftext($textImage, $fontSize, 0, $x, $y, $color, $fontFile, $string);
$yOffset = $yOffset + 50;
$oldx    = 0;
$oldy    = 0;
$oldid   = 0;

$color  = imagecolorallocate($textImage, 0, 0, 0);
$sdate  = "";
$rsdate = "";
foreach ($dbgraph as $val)
{ //echo $val['role']['name'].": ".$val['posx'].", ".$val['posy']."<BR>";
    $num++;
    $rsdate = $val['role']['sdate'];
    if ($oldid != $val['role']['roleid'])
    {
        $sdate = "";
        $gamemapnum++;
        //$oldid = $val['role']['roleid'];
        mt_srand((double)microtime() * 1000000);
        $rand_r = mt_rand(50, 255);
        $rand_g = mt_rand(50, 255);
        $rand_b = mt_rand(50, 255);
        //$rand_r = mt_rand(0, 100);

        $oldx = 0;
        $oldy = 0;

        $level = $val['role']['level'];
        $name  = $val['role']['name'];

        $color  = imagecolorallocate($textImage, $rand_r, $rand_g, $rand_b);
        $color2 = imagecolorallocate($textImage, 255, 255, 255);

        $xPos = 145;
        $yPos = $yOffset;

        imagettftext($textImage, 10, 0, $xPos, $yPos, $color, $fontFile, $gamemapnum . " - $name (L" . $level . ")");
        $yOffset = $yOffset + 20;
    }

    //total game coor x : 5604.638
    //total img coor x : 2800

    // img 2042, 2815   = game 0,0

    //img 0,0           = game -4096, 5632
    //img 4092,5627     = game 4096, -5632

    // 8192, 11264

    // game (4095,5630) = img (0, 5627)
    // ir (0,0) =          ir (0,0)
    // diff (4095, 5630 )= diff (0, 5627)
    //x/x+
    $a = -4095;
    $b = 4095;
    $c = 5630;
    $d = -5630;

    //$x = (($val['posx'] - 4095 ));
    //$y = ((($val['posy']) - 3));
    //$x = (($val['posx'] + 4095)/8190)*4092;
    //$y = (($val['posy'] - 5630)/11260)*5627;
    //$x = (($val['posx'] + 4095)/8190)*8192;
    //$y = ((-$val['posy'] + 5630)/11260)*11264;

    //$x = (($val['posx'] + 4096)/8192)*4092;
    //$y = ((-$val['posy'] + 5632)/11264)*5627;

    //$x = (($val['posx'] + 4096)/8192)*4085;
    //$y = ((-$val['posy'] + 5632)/11264)*5620;

    $x = ((($val['posx']) * 0.49951171875) + 2042);
    $y = (-(($val['posy']) * 0.49955610795454545454545454545455) + 2805);

    if ($oldid != $val['role']['roleid'])
    {
        $oldid = $val['role']['roleid'];
        $oldx  = ($xPos + 200);
        $oldy  = ($yPos + 2);
        $sdate = $rsdate;
        imageline($textImage, $xPos, ($yPos + 2), ($xPos + 200), ($yPos + 2), $color);
        imagedashedline($textImage, ($xPos + 200), ($yPos + 2), $x, $y, $color);

        $displayText = $name . " (L" . $level . ") (" . $sdate . ": START) " . $val['posx'] . ", " . $val['posy'];
        imagefilledrectangle($textImage, ($x - 4), ($y - 10), ($x + 140 + (strlen($displayText) * 2)), ($y + 8), $black);
        //imagestring($textImage, ($i + 10), $x, $y, ". (" . $sdate . ": START) " . $val['posx'] . ", " . $val['posy'], $color);
        imagettftext($textImage, 6, 0, $x, $y, $color, $fontFile, $displayText);
    }
    else
    {
        //imagestring($textImage, ($i + 10), $x, $y, ". (" . $sdate . " : JUMP) " . $val['posx'] . ", " . $val['posy'], $color);

        $sdate = $rsdate;
        //imagestring($textImage, ($i + 10), $x, $y, ". (" . $sdate . ") " . $val['posx'] . ", " . $val['posy'], $color);
        imagedashedline($textImage, $oldx, $oldy, $x, $y, $color);
        imagestring($textImage, $i, $x, $y, ".", $color);

        $oldx = $x;
        $oldy = $y;
    }
}

$copyright = "GameMap Database v2.0 Beta 4 originally developed by Aera Gaming International (www.perfectworld.com.my). Total:" . $num;
imagestring($textImage, 150, 1746, 396, $copyright, $white);
//imagedashedline($textImage, 0, 0, 4085, 5627,  $color);
//imageline($textImage, 0, 0, 4085, 5627,  $color);

imagejpeg($textImage);
//imagepng($textImage);
imagedestroy($textImage);
?>