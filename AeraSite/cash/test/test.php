<?php
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

?>

<table border="1">
    <tr>
        <?php
        foreach ($header_e as $row2) {
            echo '<td>' . $row2 . '</td>';
        }
        ?>

    </tr>

    <?php
    $j = 0;
    foreach ($data as $row3) {

        if ($j < sizeof($data) - 1) {
            echo '<tr>';
            foreach ($row3 as $row4) {

                echo '<td>' . $row4 . '</td>';
            }
            echo '</tr>';
        }
        $j++;
    }
    ?>
</table>