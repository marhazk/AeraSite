<?php
	if ($gmuser >= 3)
	{
		$sql = "SELECT * from users WHERE online=1 ORDER BY accstat DESC";
		$online_text = "";
	}
	else
	{
		$sql = "SELECT * from users WHERE online=1 ORDER BY accstat DESC LIMIT 0,10";
		$online_text = "Top 10 ";
	}
	//$sql = "SELECT onlineid, (level+accstat), mentorid INTO onlineid, accstat, mentorid  from users WHERE online=1 ORDER BY accstat DESC LIMIT 0,10";
?>
<BR><BR>
<h1><?php echo $online_text;?>Online Player List</h1>
<table width="100%" border="0" cellspacing="0" cellpadding="0" border="1">
  <tr>
    <td align="left" valign="top"><strong>#</strong></td>
    <td align="left" valign="top"><strong>Character Name</strong></td>
    <td align="left" valign="top"><strong>Access Level</strong></td>
    <td align="left" valign="top"><strong>Mentor Name</strong></td>
    <?php if (isgm($chkid))
	{
		?>
    <td align="left" valign="top"><strong>User Name</strong></td>
    <?php } ?>
    <td align="left" valign="top"><strong>BP</strong></td>
    <td align="left" valign="top"><strong>Level</strong></td>
  </tr>
<?php

	$q = mysql_query($sql);
	$num = 0;
	if ($q)
	{
		while ($row = mysql_fetch_array($q))
		{
			$num++;
			$rrow = getroledb("roleid", $row["onlineid"]);
			if ($onrow["mentorid"] >= 32)
			{
				$mentorrow = getroledb("ID", $onrow["mentorid"]);
				$rmentorrow = getroledb("roleid", $mentorrow["onlineid"]);
			}
			else
			{
				$rmentorrow["rolename"] = "N/A";
				$rmentorrow["roleid"] = 0;
			}
?>
  <tr>
    <td align="left" valign="top"><?php echo $num;?></td>
    <td align="left" valign="top"><img height=12 width=18 src="?op=gfx&type=country&rid=<?php	echo $rrow["roleid"]; ?>"/> <a href="?op=accounts&redirect=0&type=vinfo&tid=<?php echo $rrow["roleid"];?>"><?php echo $rrow["name"];?></a>
    </td>
    <td align="left" valign="top"><?php echo getaccstat2($row["accstat"]);?></td>
    <td align="left" valign="top"><?php echo $rrow["fname"];?></a></td>
    <?php if (isgm($chkid))
	{
		?>
    <td align="left" valign="top"><a href="?op=accounts&redirect=0&type=vinfo&tid=<?php echo $row["ID"];?>"><?php echo $row["name"];?></a></td>
    <?php }
	$ocupation = occupation($rrow[occupation]);
	$ocupationtit = str_replace(".png", "", $ocupation);
				?>
    <td align="left" valign="top"><?php echo $rrow["level"];?></td>
    <td align="left" valign="top"><?php echo '<img src="WEB-INF/img/'.$ocupation.'" title="'.$ocupationtit.'" alt="'.$ocupationtit.'" height="17" width="17" />';?></td>
  </tr>
  <?php
		}
	}
	if ($num == 0)
	{
		?>
  <tr>
    <td align="center" valign="top" colspan=6>No any player online</td>
  </tr>
        
	<?php } ?>
</table>
