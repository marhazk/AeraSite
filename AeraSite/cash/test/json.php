<?php
header('Content-Type: text/html; charset=utf-8');
include('Net/SSH2.php');

$ssh = new Net_SSH2('192.168.1.103');
if (!$ssh->login('root', 'ff190388')) {
    exit('Login Failed');
}

$test = $ssh->exec('cd /FWServer/gamedbd; ./gamedbd gamesys.conf listrole;');


$parts = preg_split('/\n/', $test);
$i = 0;
$header_e;
$data = array();
foreach ($parts as $row) {
    if ($i > 0 && $i < 27) {
    } else {

        if ($i == 0) {
            $header_e = explode(",", $row);
        } else {
            $data[] = explode(',', $row);
        }

    }
    $i++;
}
foreach ($header_e as $row2) {
    //header
}

$farr = array();
$m = 0;
$j = 0;
foreach ($data as $row3)
{
    $m = 0;
    $arr = array();
    if ($j < sizeof($data) - 1) {
        foreach ($row3 as $row4) {
            $arr[$header_e[$m]] = $row4;
            $m++;
        }
        array_push($farr, $arr);
    }
    $j++;
}
echo json_encode($farr);
?>