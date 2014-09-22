<html>
<body>
<?php
$link = mysql_connect('localhost', 'aera', '870830');
if ($link)
{
    $db = mysql_select_db("dbo", $link);
    echo "DB connected";
}
else
    die('FAIL');

// DEFAULT VARS
$maxindex = 30;
$index = 0;


//
//
// PK MODE
//
//

$query = mysql_query("SELECT * FROM pkmode ORDER BY pdate DESC LIMIT 0,1", $link);
$latestrow = mysql_fetch_array($query);

$x = 0;
//die:roleid=
//$file = popen("tac world2.chat.log | grep chl=0",'r');
$file = popen("tac logs/game/world2.formatlog | grep :attacker", 'r');
$arr = array();
$values = array();
$newdata = 0;
while ($line = fgets($file))
{
    //echo $line;
    $arr[0] = explode(" ", $line);
    $arr[1] = explode(":", $line);
    //$x++;
    //if ($x > 5)
    //    break;
    //echo 'Date : ' . $arr[0][0] . ' ' . $arr[0][1] . ' roleid:' . $arr[1][6] . ' attacker:' . $arr[1][8];
    $values  = array(
        'pdate'    => $arr[0][0] . ' ' . $arr[0][1],
        'roleid'   => str_replace("roleid=", "", $arr[1][6]),
        'type'     => str_replace("type=", "", $arr[1][7]),
        'attacker' => str_replace(array("\r\n", "\n", "\r"), "", str_replace("attacker=", "", $arr[1][8]))
    );
    $tmp1    = "";
    $tmp2    = "";
    $tmp3    = "";
    $sql     = "";
    $index   = 0;
    $newdata = 1;
    if (strlen($values['attacker']) <= 7)
    {
        foreach ($values as $att => $val)
        {
            if ($index >= 1)
            {
                $tmp1 .= ", ";
                $tmp2 .= ", ";
                $tmp3 .= ", ";
            }
            $tmp1 .= $att . "=VALUES(" . $att . ")";
            $tmp2 .= $att;
            $tmp3 .= "'" . $val . "'";
            if ($val == $latestrow['pdate'])
            {
                $newdata = 0;
                break;
            }
            $index++;
        }
        echo "<BR> PK : OLD: " . $latestrow['pdate'] . " NEW:" . $values['pdate'] . " type=" . $values['type'] . " - atk=" . $values['attacker'] . "  die=" . $values['roleid'] . " -";
        if ($newdata)
        {
            $pkquery = mysql_query("SELECT a.roleid as aroleid,a.name as aname,a.bounty as abounty,a.level as alevel,a.hp as ahp,a.skills_size as askills_size,b.roleid as broleid,b.name as bname,b.bounty as bbounty,b.level as blevel,b.hp as bhp,b.skills_size as bskills_size FROM roles a, roles b WHERE a.roleid=" . $values['roleid'] . " AND b.roleid=" . $values['attacker'] . " LIMIT 0,1;", $link);
            $pkrow   = mysql_fetch_array($pkquery);
            $btotal  = ($pkrow['alevel'] / $pkrow['blevel']) + ($pkrow['ahp'] / $pkrow['bhp']) + ($pkrow['askills_size'] / $pkrow['bskills_size']);
            if ($pkrow['abounty'] > 1)
            {
                $sql = "UPDATE roles SET bounty=(bounty-1) WHERE roleid=" . $pkrow['aroleid'] . ";";
                mysql_query($sql);
            }
            $sql = "UPDATE roles SET bounty=bounty+" . $btotal . " WHERE roleid=" . $pkrow['broleid'] . ";";
            mysql_query($sql);
            $sql = "INSERT INTO pkmode (" . $tmp2 . ") VALUES (" . $tmp3 . ") ON DUPLICATE KEY UPDATE " . $tmp1 . ";";
            mysql_query($sql);

            $url = "http://www.perfectworld.com.my/?/System/UpdateSQLYeh";
            $sqlTemp = "INSERT INTO ae_activities (amsg) VALUES ('PWI: ".$pkrow['bname']." has killed ".$pkrow['aname']."');";
		    $url64 = base64_encode($sqlTemp);
            $_temp = file_get_contents($url."/".$url64);
            echo " (ADDED) $btotal ".$pkrow['bname']."";
        }
        else
        {
            echo " (SKIP)";
            break;
        }
    }
}
//
//
// CHAT - 2013-07-18 00:54:42 dbserver glinkd-1: chat : Chat: src=1024 chl=0 msg=aABhAA==
//
//

$query = mysql_query("SELECT * FROM chats ORDER BY cdate DESC LIMIT 0,1", $link);
$latestrow = mysql_fetch_array($query);

$x = 0;
//die:roleid=
//$file = popen("tac world2.chat.log | grep chl=0",'r');
$file = popen("tac logs/game/world2.chat | grep src=", 'r');
$arr = array();
$values = array();
$newdata = 0;
while ($line = fgets($file))
{
    //echo $line;
    $arr[0] = explode(" ", $line);
    //$x++;
    //if ($x > 5)
    //    break;
    //echo 'Date : ' . $arr[0][0] . ' ' . $arr[0][1] . ' roleid:' . $arr[1][6] . ' attacker:' . $arr[1][8];
    $values  = array(
        'cdate' => $arr[0][0] . ' ' . $arr[0][1],
        'type'  => str_replace(":", "", $arr[0][6]),
        'src'   => str_replace("src=", "", $arr[0][7]),
        'dst'   => str_replace("chl=", "", str_replace("fid=", "", $arr[0][8])),
        'msg'   => str_replace(array("\r\n", "\n", "\r"), "", str_replace("msg=", "", $arr[0][9]))
    );
    $tmp1    = "";
    $tmp2    = "";
    $tmp3    = "";
    $sql     = "";
    $index   = 0;
    $newdata = 1;
    foreach ($values as $att => $val)
    {
        if ($index >= 1)
        {
            $tmp1 .= ", ";
            $tmp2 .= ", ";
            $tmp3 .= ", ";
        }
        $tmp1 .= $att . "=VALUES(" . $att . ")";
        $tmp2 .= $att;
        $tmp3 .= "'" . $val . "'";
        if ($val == $latestrow['cdate'])
        {
            $newdata = 0;
            break;
        }
        $index++;
    }
    echo "<BR> CHATS: OLD: " . $latestrow['cdate'] . " NEW:" . $values['cdate'];
    if ($newdata)
    {
        $sql = "INSERT INTO chats (" . $tmp2 . ") VALUES (" . $tmp3 . ") ON DUPLICATE KEY UPDATE " . $tmp1 . ";";
        //echo $sql;
        mysql_query($sql);
    }
    else
        break;

}
//
//
// World Checker
//
//
if ($_REQUEST['gs'] == 1)
{
    $file = popen("tac logs/maps/gs01.log | grep Starting", 'r');
    $x    = 0;
    $y    = 0;
    $z    = 0;
    while ($line = fgets($file))
    {
        //$line = str_replace(array("\r\n", "\n", "\r"), "", $line);
        //echo "<BR>" . $line;
        $x++;
    }
    $file = popen("tac logs/maps/gs01.log | grep dispatcher", 'r');
    while ($line = fgets($file))
    {
        //$line = str_replace(array("\r\n", "\n", "\r"), "", $line);
        //echo "<BR>" . $line;
        $y++;
    }
    $file = popen("tac logs/maps/gs01.log | grep receiver", 'r');
    while ($line = fgets($file))
    {
        //$line = str_replace(array("\r\n", "\n", "\r"), "", $line);
        //echo "<BR>" . $line;
        $z++;
    }
    $ypct   = ((round(($y / ($x * $x)) * 100) / 102) * 100);
    $zpct   = (((($z / ($x * $x)) * 100) / 92.28650137741) * 100);
    $mappct = ($x * 100) * 2;
    $mpct   = (($ypct + $zpct) / 200) * $x;
    echo "<BR>World Status - Dispatcher: " . $ypct . "% loaded! Total: ".$y;
    echo "<BR>World Status - Receiver: " . $zpct . "% loaded! Total: ".$z;
    echo "<BR>World Status - Loaded: TOTAL: " . $x . " maps";
    echo "<BR>World Status - OVERALL: " . round($mpct) . " maps successfully loaded!";
}
//
//
// CHAT
//
//
if ($_REQUEST['gs'] == 2)
{
    $index = 0;
    $file  = popen("tac logs/game/world2.formatlog | grep formatlog:getroledata:", 'r');
    echo "<BR>Latest RoleUPDATE GET Status";
    while ($line = fgets($file))
    {
        if ($index >= $maxindex)
            break;
        //$line = str_replace(array("\r\n", "\n", "\r"), "", $line);
        echo "<BR>" . $line;
        $index++;
    }
    $index = 0;
    $file  = popen("tac logs/game/world2.formatlog | grep formatlog:putroledata:", 'r');
    echo "<BR>Latest RoleUPDATE PUT Status";
    while ($line = fgets($file))
    {
        if ($index >= $maxindex)
            break;
        //$line = str_replace(array("\r\n", "\n", "\r"), "", $line);
        echo "<BR>" . $line;
        $index++;
    }
}
//
//
// LAST  PK
//
//
if ($_REQUEST['gs'] == 3)
{
    $index = 0;
    $file  = popen("tac logs/game/world2.formatlog | grep :attacker", 'r');
    echo "<BR>Latest PK status";
    while ($line = fgets($file))
    {
        if ($index >= $maxindex)
            break;
        //$line = str_replace(array("\r\n", "\n", "\r"), "", $line);
        echo "<BR>" . $line;
        $index++;
    }
}
//
//
// LAST  logs
//
//
if ($_REQUEST['gs'] == 4)
{
    $index = 0;
    $file  = popen("tac logs/game/world2.formatlog", 'r');
    echo "<BR>Latest PK status";
    while ($line = fgets($file))
    {
        if ($index >= $maxindex)
            break;
        //$line = str_replace(array("\r\n", "\n", "\r"), "", $line);
        echo "<BR>" . $line;
        $index++;
    }
}







mysql_close($link);

?>
</body>
</html>