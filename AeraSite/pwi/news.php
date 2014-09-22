<?php
if (strlen($_REQUEST["op"]) > 0)
{
	header("location: http://www.perfectworld.my");
	
}
include "../modules/config.php";
include "../modules/functions.php";
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style>
ul.ppt {
	position: relative;
}

.ppt li {
	list-style-type: none;
	position: absolute;
	top: 0;
	left: 0;
}

.ppt img {
	border: 0px;
	padding: 5px;
}
</style>
</head>

<body bgcolor=#dbcfb9 leftmargin="0" bottommargin="0" marginheight="0" rightmargin="0" topmargin="0">

<center>

          <table width=100% border=1 cellspacing="0" cellpadding="0">
          <tr>
          <td width=100%>
          
          
<div><strong>Patches Download</strong></div>
<br>
<table border="1" cellpadding="3" cellspacing="0" width="90%" align="center">
  <tbody>
    <tr>
      <td><div align="center"><strong>File Name</strong></div></td>
      <td><div align="center"><strong>Size</strong></div></td>
      <td><div align="center"><strong>Date</strong></div></td>
      <td><div align="center"><strong>Contents</strong></div></td>
    </tr>
    <?php
	
	$firstPatchVer = 55;
	$endPatchVer = $latestPatch[version];
	$patchList = "";
	$sqlPatch = "SELECT * FROM patches WHERE id>$firstPatchVer AND id<=$endPatchVer AND patcher=1 ORDER BY id ASC";
	$qPatch = mysql_query($sqlPatch);
	while ($rowPatch = mysql_fetch_array($qPatch))
	{
		$patch = getpatch($rowPatch);
		if ($patch[enable] >= 1) {
			$patchListcurr = '
    <tr>
      <td><div align="center">';
	  		if ($patch[linkable] >= 1) {
		  		$patchListcurr = $patchListcurr.'<a href="'.$patch[url].'">1.4.5 Beta 3'.$firstPatchVer.'-3'.$patch[version].'</a>';
			}
			else
			{
		  		$patchListcurr = $patchListcurr.'1.4.5 Beta 3'.$firstPatchVer.'-3'.$patch[version];
			}
			$patchListcurr = $patchListcurr.'</div></td>
      <td><div align="center">'.$patch[size].'</div></td>
      <td><div align="center">'.$patch[mdate].'</div></td>
      <td><div align="center"> <a href="'.$patch[details].'">Detail</a></div></td>
    </tr>';
	$patchList = $patchListcurr.$patchList;
	$firstPatchVer = $patch[version]; } } echo $patchList; ?>
    <tr>
      <td><div align="center"><a href="http://patches.perfectworld.my/FixBeta3a55.zip">1.4.5 Beta 318-355</a></div></td>
      <td><div align="center">11.6 MB </div></td>
      <td><div align="center"> 24/Dec/2012 </div></td>
      <td><div align="center"> <a href="https://www.facebook.com/media/set/?set=a.433849286668821.106339.336851746368576&amp;type=3">Detail</a></div></td>
    </tr>
    <tr>
      <td><div align="center">
        <p><a href="http://patches.perfectworld.my/PWAeraBeta3a18.exe">1.4.5 Beta 301-318</a></p>
        <p>(required, for first time install)</p>
      </div></td>
      <td><div align="center">9.46 MB </div></td>
      <td><div align="center"> 7/Nov/2012 </div></td>
      <td><div align="center"> <a href="?op=318">Detail</a></div></td>
    </tr>
    <tr>
      <td colspan="4"><div align="right"><a href="?op=download/patches">More&gt;&gt;</a></div></td>
    </tr>
  </tbody>
</table>
<p>&nbsp;</p>

          <table>
<?php
if ($serverUp)
{
	// TYPE (0: normal, 1: HOT)
		$wsql = mysql_query("SELECT * FROM webdb WHERE posttype=1 ORDER BY datetime DESC LIMIT 0,2", $Link);
		if ($wsql)
		{
			while ($news = mysql_fetch_array($wsql))
			{
				print '<tr><td><a href="?op='.$news[addr].'" title="'.$news[title].'" target="_blank"><font color="red">'.$news[linkname].'</font></a></td><td><img src="http://www.perfectworld.my/src/hot.gif"></td></tr>';
			}
		}
?>
              
<?php
	// TYPE (0: normal, 1: HOT)
		$wsql = mysql_query("SELECT * FROM webdb WHERE posttype=2 ORDER BY datetime DESC LIMIT 0,8", $Link);
		if ($wsql)
		{
			$newsnum = 0;
			while ($news = mysql_fetch_array($wsql))
			{
				$uWeb_file_date = date('m-d',$news[datetime]);
				if ($newsnum < 4)
				{
					print '<tr><td><a href="?op='.$news[addr].'" title="'.$news[title].'" target="_blank"><font color="red">'.$news[linkname].'</font></a></td><td> ['.$uWeb_file_date.']</td></tr>';
				}
				else if ($newsnum < 8)
				{
					print '<tr><td><a href="?op='.$news[addr].'" title="'.$news[title].'" target="_blank">'.$news[linkname].'</a></td><td> ['.$uWeb_file_date.']</td></tr>';
				}
				else
				{
					break;
				}
				$newsnum++;
			}
		}
}
?>
</table>

</td>
</tr></table>
</center>
</body>