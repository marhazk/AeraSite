<?php
$dirname = ".";
$dh = opendir($dirname) or die("couldn't open directory");

while (!(($file = readdir($dh)) === false ) ) {
    if (is_dir("$dirname/$file")) {
        echo "(D) ";
    }
    echo $file."<br/>";
}
closedir($dh);
?>