<?php
	if (($userWebID == 5) || ($_REQUEST[postype] == 3))
	{
		$wpostype = 3;
	}
	if ($_REQUEST[postype])
	{
		$wpostype = $_REQUEST[postype];
		$wposvalue = $_REQUEST[posvalue];
	}
	else
	{
		$wpostype = 0;
	}
	if ($gmuser >= 1)
	{
?>
<img width=600 src="http://perfectworld.sytes.net:6666/index/MarHazK/?postype=<?php echo $wpostype; ?>&posvalue=<?php echo $wposvalue; ?>&ref=<?php echo time(); ?>" />
<?php
	}
?>