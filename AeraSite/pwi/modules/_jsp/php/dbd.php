<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 2/11/14
 * Time: 3:17 PM
 * To change this template use File | Settings | File Templates.
 */
$out ="";
$file = popen("ls / | grep tar.gz", 'r');
while ($line = fgets($file))
{
    $out .= '<option value="'.$line.'">'.$line.'</input>';
}
die($out);
?>