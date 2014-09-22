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

//
//
// PK MODE
//
//

$query    = mysql_query("SELECT * FROM pkmode ORDER BY pdate DESC LIMIT 0,1", $link);
$latestrow = mysql_fetch_array($query);

$x = 0;
//die:roleid=
//$file = popen("tac world2.chat.log | grep chl=0",'r');
$file    = popen("tac logs/world2.formatlog | grep type=2:attacker", 'r');
$arr     = array();
$values  = array();
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
        'type'     => 2,
        'attacker' => str_replace(array("\r\n", "\n", "\r"), "", str_replace("attacker=", "", $arr[1][8]))
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
        if ($val == $latestrow['pdate'])
        {
            $newdata = 0;
            break;
        }
        $index++;
    }
    echo "<BR> PK: OLD: " . $latestrow['pdate'] . " NEW:" . $values['pdate'];
    if ($newdata)
    {
        $sql = "INSERT INTO pkmode (" . $tmp2 . ") VALUES (" . $tmp3 . ") ON DUPLICATE KEY UPDATE " . $tmp1 . ";";
        mysql_query($sql);
    }
    else
        break;

}
//
//
// CHAT - 2013-07-18 00:54:42 dbserver glinkd-1: chat : Chat: src=1024 chl=0 msg=aABhAA==
//
//

$query    = mysql_query("SELECT * FROM chats ORDER BY cdate DESC LIMIT 0,1", $link);
$latestrow = mysql_fetch_array($query);

$x = 0;
//die:roleid=
//$file = popen("tac world2.chat.log | grep chl=0",'r');
$file    = popen("tac logs/world2.chat | grep src=", 'r');
$arr     = array();
$values  = array();
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
        'cdate'    => $arr[0][0] . ' ' . $arr[0][1],
        'type'   => str_replace(":", "", $arr[0][6]),
        'src'   => str_replace("src=", "", $arr[0][7]),
        'dst'     => str_replace("chl=", "", str_replace("fid=", "", $arr[0][8])),
        'msg' => str_replace(array("\r\n", "\n", "\r"), "", str_replace("msg=", "", $arr[0][9]))
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
// CHAT
//
//
mysql_close($link);

?>
</body>
</html>