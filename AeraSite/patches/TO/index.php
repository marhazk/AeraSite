<?php
$dirname = "./";
$files = scandir($dirname) or die("couldn't open directory");
$sfiles = array();
foreach ($files as $file)
{
    // your code here
    if (!is_dir($file))
    {
        if ($file != "index.php")
        {
            //$out = base64_encode($file);
            array_push($sfiles, $file);
        }
    }
}
if (isset($_REQUEST['v']))
{
    for ($i = count($sfiles) - 1; $i >= 0; $i--)
    {
        //$out = base64_encode($file);
        $out = (int)str_replace(".zip", "", $sfiles[$i]);
        echo $out . "\r\n";
        if ((int)$_REQUEST['v'] >= (int)$sfiles[$i])
            break;
    }
}
if (isset($_REQUEST['p']))
{
    for ($i = count($sfiles) - 1; $i >= 0; $i--)
    {

        $iout = (int)str_replace(".zip", "", $sfiles[$i]);
        if ($iout == (int)$_REQUEST['p'])
        {
            $out = $sfiles[$i];
            echo $out;
            break;
        }
        //$out = base64_encode($file);
    }
}
?>