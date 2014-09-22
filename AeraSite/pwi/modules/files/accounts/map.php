<?php
	$postype = $_REQUEST[postype];
	$posvalue = $_REQUEST[posvalue];
	if (empty($postype) || ($uWeb_vinfo))
		$postype = 3;
	else
		$postype = 0;
	$gamemapurl = "http://perfectworld.sytes.net/index/gamemap/?postype=$postype&posvalue=$posvalue&ref=".time();
?>
<a href="<?php echo $gamemapurl;?>"><img src="<?php echo $gamemapurl;?>" width=100%></a>