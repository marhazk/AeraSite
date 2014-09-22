
<div><strong>Patches Download</strong></div>
  <br />
  <table border="1" cellpadding="3" cellspacing="0" width="90%" align="center">
    <tbody>
      <tr>
        <td><div align="center"><strong>File Name</strong></div></td>
        <td><div align="center"><strong>Size</strong></div></td>
        <td><div align="center"><strong>Date</strong></div></td>
        <td><div align="center"><strong>Contents</strong></div></td>
      </tr>
      <?php
	
	$firstPatchVer = 75;
	$endPatchVer = $latestPatch[version];
	$patchList = "";
	$npatchcur = $firstPatchVer;
	$sqlPatch = "SELECT * FROM patches WHERE id>$firstPatchVer AND id<=$endPatchVer ORDER BY id ASC";
	$qPatch = mysql_query($sqlPatch);
	while ($rowPatch = mysql_fetch_array($qPatch))
	{
		$patch = getpatch($rowPatch);
		if ($patch[enable] >= 1) {
			$patchListcurr = '
    <tr>
      <td><div align="center">';
	  		if ($patch[linkable] >= 1) {
		  		$patchListcurr = $patchListcurr.'<a href="'.$patch[url].'">1.4.7 PreOfficial '.$firstPatchVer.'-'.$patch[version].'  (v'.$patch[version].')</a>';
			}
			else
			{
		  		$patchListcurr = $patchListcurr.'1.4.7 PreOfficial '.$firstPatchVer.'-'.$patch[version];
			}
			$npatchcur = $patch[version];
			$patchListcurr = $patchListcurr.'</div></td>
      <td><div align="center">'.$patch[size].'</div></td>
      <td><div align="center">'.$patch[mdate].'</div></td>
      <td><div align="center"> <a href="'.$patch[details].'">Detail</a></div></td>
    </tr>';
	$patchList = $patchListcurr.$patchList;
	if ($patch[linkable] >= 1) {	$firstPatchVer = $patch[version]; } } } 
	
	
	$npatch[size] = _format_bytes(filesize("./patches/new.rar"));
	$npatch[url] = "http://patches.perfectworld.com.my/new.rar";
	$npatch[mdate] = date("d/M/Y", filemtime("./patches/new.rar"));
	$npatchshow = '
    <tr>
      <td><div align="center"><a href="'.$npatch[url].'">1.4.7 '.$firstPatchVer.'-pre'.date("md",filemtime("./patches/new.rar")).'</a></div></td>
      <td><div align="center">'.$npatch[size].'</div></td>
      <td><div align="center">'.$npatch[mdate].'</div></td>
      <td><div align="center">N/a</div></td>
    </tr>';
	
	//$patchList = $npatchshow.$patchList;
	echo $patchList;
	?>
      <tr>
        <td><div align="center">
          <p><a href="http://patches.perfectworld.com.my/Aera147v75.exe">1.4.7 PreOfficial 01-75 (v75)</a></p>
          <p>(required, for first time install 1.4.6/1.4.7/1.4.8 client)</p>
        </div></td>
        <td><div align="center">26.5 MB </div></td>
        <td><div align="center"> 05/Aug/2013 </div></td>
        <td><div align="center"> Detail</div></td>
      </tr>
    </tbody>
  </table>
  <p>&nbsp;</p>