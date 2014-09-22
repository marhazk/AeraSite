<?php
error_reporting(0);
//change connection & password to your suits
$conn=mysql_connect('192.168.1.5','aera','870830') or die('mysql_error()');

mysql_select_db('dbo', $conn);

if (!$conn) 
{
    die('Could not connect: ' . mysql_error());
}

?>