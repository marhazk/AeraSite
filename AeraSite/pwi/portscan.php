<html>
<pre>
<?php
//$host = $_SERVER['REMOTE_ADDR'];
$host = "37.221.163.12";
for($i=10;$i<30000;$i++) {
	$fp = fsockopen($host,$i,$errno,$errstr,10);
	if($fp)
	{
		echo "port " . $i . " open on " . $host . "\n";
		fclose($fp);
	}
	else
	{
		echo "port " . $i . " closed on " . $host . "\n";
	}
	flush();
}


?>
</pre>
</html>