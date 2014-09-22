<?php
$fp = fsockopen("192.168.1.5", 29300);
if ($fp) {
    $rdata = fread($fp, 2056);
    $data = explode('\|', $rdata);
        
    foreach ($data as $value) {
        $row = explode(':', $value);
        switch ($row[0]) {
        case 'usercount':
            echo 'There are currently <b>' . $row[1] . '</b> users connected:<br />';
            break;
        case 'users':
            $users = split(',', $row[1]);
            $first = true;
            foreach ($users as $user) {
                if (!$first) echo ', ';
                if (substr($user, 0, 4) == '[GM]') {
                    echo '<span style="color: green"><b>' . $user . '</b></span>';
                }else{
                    echo $user;
                }
                $first = false;
            }
            break;
        }
    }
   
    fclose($fp);
}
?>