<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 2/11/14
 * Time: 11:59 AM
 * To change this template use File | Settings | File Templates. completed
 */
$fp = fsockopen('127.0.0.1',$_REQUEST['port'],$errno,$errstr,60);
if ($fp) {
    $status = '1';
    //the following line was not originally here
    fclose($fp);
} else {
    fclose($fp);
    $status = '0';
}
die($status)
?>