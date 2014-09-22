<?php
$vhour = 4;
$maxvote = (60*60*$vhour);
$sqlxda = "UPDATE users SET votelasttime='".time()."', votetotal=(votetotal+1), claimaeracoin=(claimaeracoin+500) WHERE ID='".$chkid."'";
if ($uWeb_vinfo[votelasttime] < (time()-$maxvote))
{
	$sqlset = mysql_query($sqlxda);
?>
<meta http-equiv="Refresh" content="5; url=http://www.xtremetop100.com/in.php?site=1132345826">
<h1>&nbsp;</h1>
<h1>Vote for AeraGold</h1>
<p>&nbsp;</p>
<p><a href="http://www.xtremetop100.com/in.php?site=1132345826"><img src="http://www.xtremeTop100.com/votenew.jpg" border="0" alt="Perfect World Private Server"></a></p>
<p><a href="http://www.arena-top100.com/&u=aera&id=<?php echo $chkid; ?>"><img src="http://www.arena-top100.com/button.php?u=aera&buttontype=static&id=<?php echo $chkid; ?>" alt="Best Private Servers Top 100 Rankings" /></a></p>
<p><a target="_blank" href="http://www.top100zone.com/in.aspx?i=54379" title="Vote for us now!">
<img src="http://www.top100zone.com/imgs/button_.jpg" border="0" alt="Perfect World servers" /></a></p>
<p>Please wait or press two button with new windows tab to vote now and claim your Aeragold reward into UAA (Unclaimed Account AeraGold). Note that, claiming your Aeragold is only valid for <?php echo $vhour;?> hours per vote.<br></p>
<?php
}
else
{
	$totalvote = time()-$uWeb_vinfo[votelasttime];
	$remain = $maxvote - $totalvote;
?>
<meta http-equiv="Refresh" content="30; url=http://www.xtremetop100.com/in.php?site=1132345826">
<h1>&nbsp;</h1>
<h1>Vote for AeraGold (<?php echo round($remain/60/60);?> hours left)</h1>
<p>&nbsp;</p>
<p><a href="http://www.xtremetop100.com/in.php?site=1132345826"><img src="http://www.xtremeTop100.com/votenew.jpg" border="0" alt="Perfect World Private Server"></a></p>
<p><a href="http://www.arena-top100.com/&u=aera&id=<?php echo $chkid; ?>"><img src="http://www.arena-top100.com/button.php?u=aera&buttontype=static" alt="Best Private Servers Top 100 Rankings" /></a></p>
<p><a target="_blank" href="http://www.top100zone.com/in.aspx?i=54379" title="Vote for us now!">
<img src="http://www.top100zone.com/imgs/button_.jpg" border="0" alt="Perfect World servers" /></a></p>
<p>Please wait or press two button with new windows tab to vote now and claim your Aeragold reward into UAA (Unclaimed Account AeraGold). Note that, claiming your Aeragold is only valid for <?php echo $vhour;?> hours per vote.<br><br>
Note: You current vote will not increase your UAA since you have already vote for <?php echo $vhour;?> hours ago</p>
<?php
}
?>
