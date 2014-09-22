<?php
    $dirname = ".";
    $dh = opendir($dirname);
    while (!is_bool($file = readdir($dh)))
    {
        if (is_dir("$dirname/$file"))
        {
            if (!file_exists("$dirname/$file/.htaccess")    )
            {
                $path = "$file/.htaccess";
                copy(".htaccess",$path);
            }
        }
    }
    closedir($dh);
    ?>