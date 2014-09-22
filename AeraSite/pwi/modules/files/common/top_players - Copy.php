
<?php
	$uWeb_addmodules .= "Top Player Module v1.0; ";
	
	//
	// OLD (Still exists/in use)
	// $uWeb_roleidmin					= User ID			Default:NULL
	// $uWeb_roleidmax					= User ID + 15		Default:NULL
	// $uWeb_vinfo						= 0 or 1			Default:0
	//
	// NEW
	// $uWeb_chardb[uid]				= User ID
	// $uWeb_chardb[epoint]				= 0 or 1			Default:0			Desc:For E-Point System
	// $uWeb_chardb[output]				= 0 or 1			Default:1			Desc:Display the outputs
	// $uWeb_chardb[orioutput]			= 0 or 1			Default:1			Desc:Display the real outputs
	// $uWeb_chardb[vdis][id]			= 0 or 1			Default:1			Desc:-
	// $uWeb_chardb[vdis][level]		= 0 or 1			Default:1			Desc:-
	// $uWeb_chardb[vdis][money]		= 0 or 1			Default:1			Desc:-
	// $uWeb_chardb[vdis][bank]			= 0 or 1			Default:1			Desc:-
	// $uWeb_chardb[vdis][rep]			= 0 or 1			Default:1			Desc:-
	// $uWeb_chardb[vdis][sp]			= 0 or 1			Default:1			Desc:-
	// $uWeb_chardb[vdis][redname]		= 0 or 1			Default:1			Desc:-
	// $uWeb_chardb[vdis][rednametime]	= 0 or 1			Default:1			Desc:-
	// $uWeb_chardb[vdis][devil]		= 0 or 1			Default:1			Desc:-
	// $uWeb_chardb[vdis][battlepower]	= 0 or 1			Default:1			Desc:-
	// $uWeb_chardb[vdis][name]			= 0 or 1			Default:1			Desc:-
	// $uWeb_chardb[vdis][cls]			= 0 or 1			Default:1			Desc:-
	// $uWeb_chardb[vdis][sex]			= 0 or 1			Default:1			Desc:-
	// $uWeb_chardb[vdis][x]			= 0 or 1			Default:1			Desc:-
	// $uWeb_chardb[vdis][y]			= 0 or 1			Default:1			Desc:-
	// $uWeb_chardb[vdis][z]			= 0 or 1			Default:1			Desc:-
	//
	// $uWeb_chardb[totaladdon]			= Total of Columns
	// $uWeb_chardb[addon][title][N]	= Title
	// $uWeb_chardb[addon][url][N]		= URL's Variable
	// $uWeb_chardb[addon][text][N]		= Text for URL
	
	//
	// Declaration begin
	//
	if (!$uWeb_roleidmin)
	{
		if (!$uWeb_chardb[uid]) $uWeb_chardb[uid] = $chkid;
		$uWeb_roleidmin = $uWeb_chardb[uid];
		$uWeb_roleidmax = $uWeb_roleidmin+15;
	}
	if ($chkid == 32)
		$gmuser = 1;
	//$uWeb_vinfo = 1;
	if (!$uWeb_chardb[epoint])			$uWeb_chardb[epoint]		= 0;
	if (!$uWeb_chardb[orioutput])		$uWeb_chardb[orioutput]		= 0;
	if ($uWeb_chardb[epoint])
	{
		$uWeb_vinfo						= 1;
		$uWeb_chardb[orioutput] 		= 1;
		$uWeb_chardb[output]			= 1;
		$uWeb_chardb[totaladdon]		= 2;
		$uWeb_chardb[addon][title][0]	= "<B>E-Point</b>";
		$uWeb_chardb[addon][url][0]		= "op=view&module=02Account&redirect=0&type=buypoint";
		$uWeb_chardb[addon][text][0]	= "BUY POINT";
		$uWeb_chardb[addon][title][1]	= "<B>CLAIM REWARDS</b>";
		$uWeb_chardb[addon][url][1]		= "op=view&module=02Account&redirect=0&type=vinfo";
		$uWeb_chardb[addon][text][1]	= "CLAIM REWARDS";
		$uWeb_chardb[vdis][name]		= 1;
		$uWeb_chardb[vdis][level]		= 1;
		$uWeb_chardb[vdis][money]		= 1;
		$uWeb_chardb[vdis][bank]		= 1;
		$uWeb_chardb[vdis][rep]			= 1;
		$uWeb_chardb[vdis][sp]			= 1;
	}
	if (!$uWeb_chardb[output])
	{
		$uWeb_chardb[output]			= 1;
		$uWeb_chardb[orioutput]			= 1;
		$uWeb_chardb[vdis][id]			= 1;
		$uWeb_chardb[vdis][level]		= 1;
		$uWeb_chardb[vdis][money]		= 1;
		$uWeb_chardb[vdis][bank]		= 1;
		$uWeb_chardb[vdis][rep]			= 1;
		$uWeb_chardb[vdis][sp]			= 1;
		$uWeb_chardb[vdis][redname]		= 1;
		$uWeb_chardb[vdis][rednametime]	= 1;
		$uWeb_chardb[vdis][devil]		= 1;
		$uWeb_chardb[vdis][battlepower] = 1;
		$uWeb_chardb[vdis][name]		= 1;
		$uWeb_chardb[vdis][cls]			= 1;
		$uWeb_chardb[vdis][sex]			= 1;
		$uWeb_chardb[vdis][x]			= 1;
		$uWeb_chardb[vdis][y]			= 1;
		$uWeb_chardb[vdis][z]			= 1;
	}
	//
	// Declaration end
	//
	if ($uWeb_chardb[orioutput])
	{
		if ($userWebID == 0)
		{
			$uweb_toplvlurl = "?op=view&module=".$_REQUEST[module]."&type=".$_REQUEST[type];
			echo "<p align=center><a href=$uweb_toplvlurl><img src=gamemap/?auth=".rand()." width=100%><BR>[Click here to refresh]</a></p>";
		}
		elseif ($userWebID == 5)
		{
			if ($_REQUEST[postype])
			{
				$uweb_toplvlurl = "?op=view&module=".$_REQUEST[module]."&type=".$_REQUEST[type]."&postype=".$_REQUEST[postype]."&posvalue=".$_REQUEST[posvalue];
				echo "<p align=center><a href=$uweb_toplvlurl><img src=gamemap/?postype=".$_REQUEST[postype]."&posvalue=".$_REQUEST[posvalue]."&auth=".rand()." width=100%><BR>[Click here to refresh]</a></p>";
			}
			else
			{
				$uweb_toplvlurl = "?op=view&module=".$_REQUEST[module]."&type=".$_REQUEST[type]."&postype=3";
				echo "<p align=center><a href=$uweb_toplvlurl><img src=gamemap/?postype=3&auth=".rand()." width=100%><BR>[Click here to refresh]</a></p>";
			}
		}
	}

	
	if ($_REQUEST[type]) {
		if ($_REQUEST[type] == "redname")
		{
			$topplayer_name = strtoupper($_REQUEST[type]);
			$topplayer_type = strtolower($_REQUEST[type]);
		}
		else if ($_REQUEST[type] == "rednametime")
		{
			$topplayer_name = strtoupper($_REQUEST[type]);
			$topplayer_type = strtolower($_REQUEST[type]);
		}
		else if ($_REQUEST[type] == "devil")
		{
			$topplayer_name = strtoupper($_REQUEST[type]);
			$topplayer_type = "pinknametime";
		}
		else if ($_REQUEST[type] == "battlepower")
		{
			$topplayer_name = strtoupper($_REQUEST[type]);
			$topplayer_type = "battlepower";
		}
		else
		{
			$topplayer_name = strtoupper($_REQUEST[type]);
			$topplayer_type = "role".strtolower($_REQUEST[type]);
		}
		$topplayer_add = "";
	}
	else {
		$topplayer_name = "LEVEL - Only level 149 and below";
		$topplayer_type = "rolelevel";
		if ($uWeb_vinfo)
			$topplayer_add = "AND rolelevel<=149";
		elseif ($gmuser >= 1)
			$topplayer_add = "";
		else
			$topplayer_add = "AND rolelevel<=149";
	}
	if (($uWeb_vinfo) && ($viewfile != "03Top_Players"))
		$uweb_toplvlq = "SELECT * FROM uWebplayers WHERE roleid>=$uWeb_roleidmin AND roleid<=$uWeb_roleidmax AND updated=1 $topplayer_add LIMIT 0,50";
	elseif ($gmuser >= 1)
		$uweb_toplvlq = "SELECT * FROM uWebplayers WHERE updated=1 $topplayer_add ORDER BY $topplayer_type DESC LIMIT 0,50";
	else
		$uweb_toplvlq = "SELECT* FROM uWebplayers WHERE updated=1 $topplayer_add AND (accstat=0 OR accstat>=3) AND accstat!=6 ORDER BY $topplayer_type DESC LIMIT 0,50";
	$uweb_toplvlr = mysql_query($uweb_toplvlq);
	//die($uweb_toplvlq);
	$uweb_toplvl_num = 0;
	//
	// 
	if ($_REQUEST[id])
		$tp_chkid = "id=".$_REQUEST[id];
	if ($_REQUEST[h])
		$tp_h = "h=".$realcode;
	if ($_REQUEST[op])
		$tp_op = "op=".$_REQUEST[op];
	if ($_REQUEST[module])
		$tp_mod = "module=".$_REQUEST[module];
	if ($_REQUEST[redirect])
		$tp_direct = "redirect=".$_REQUEST[redirect];
	$topplayer_path = "?$tp_chkid&$tp_h&$tp_op&$tp_mod&$tp_direct";
	//

	if ($uWeb_chardb[output])
	{
		if ($uWeb_chardb[orioutput])
			echo "<p><b>TOP PLAYERS ($topplayer_name)<b></p><p>";
		if ($gmuser >= 1)
		{
			echo "<table border=0>";
			echo "<TR><TD><a href=$topplayer_path&type=id>Rated by UID</a></td></tr>";
			echo "<TR><TD><a href=$topplayer_path&type=level>Rated by Level (Only level 149 and below)</a></td></tr>";
			echo "<TR><TD><a href=$topplayer_path&type=money>Rated by Money Inventory</a></td></tr>";
			echo "<TR><TD><a href=$topplayer_path&type=bank>Rated by Money Bank</a></td></tr>";
			echo "<TR><TD><a href=$topplayer_path&type=rep>Rated by Reputation</a></td></tr>";
			echo "<TR><TD><a href=$topplayer_path&type=sp>Rated by Skill Point</a></td></tr>";
			echo "<TR><TD><a href=$topplayer_path&type=redname>Rated by Red Type</a></td></tr>";
			echo "<TR><TD><a href=$topplayer_path&type=rednametime>Rated by Redname time</a></td></tr>";
			echo "<TR><TD><a href=$topplayer_path&type=devil>Rated by Devil (PKP/PK Point)</a></td></tr>";
			echo "<TR><TD><a href=$topplayer_path&type=battlepower>Rated by BATTLEPOWER (BP)</a></td></tr>";
			echo "</table>";
			echo "<Table width=100% border=1><TR><TD><B>RANK</B></td>";
			if ($uWeb_chardb[vdis][id])
				echo "<TD><B><a href=$topplayer_path&type=id>UID</a></B></td>";
			if ($uWeb_chardb[vdis][name])
				echo "<TD><B>PLAYER NAME</B></td>";
			if ($uWeb_chardb[vdis][level])
				echo "<TD><B><a href=$topplayer_path&type=level>LEVEL</a></B></td>";
			if ($uWeb_chardb[vdis][cls])
				echo "<TD>CLASS</TD>";
			if ($uWeb_chardb[vdis][sex])
				echo "<TD><B>SEX</B></td>";
			if ($uWeb_chardb[vdis][rep])
				echo "<TD><B><a href=$topplayer_path&type=rep>REP</a></B></td>";
			if ($uWeb_chardb[vdis][money])
				echo "<TD><B><a href=$topplayer_path&type=money>MONEY</a></B></td>";
			if ($uWeb_chardb[vdis][bank])
				echo "<TD><B><a href=$topplayer_path&type=bank>BANK</a></B></td>";
			if ($uWeb_chardb[vdis][sp])
				echo "<TD><B><a href=$topplayer_path&type=sp>SP</a></B></td>";
			if ($uWeb_chardb[vdis][redname])
				echo "<TD><B><a href=$topplayer_path&type=redname>REDNAME</a></B></td>";
			if ($uWeb_chardb[vdis][rednametime])
				echo "<TD><B><a href=$topplayer_path&type=rednametime>RED TIME</a></B></td>";
			if ($uWeb_chardb[vdis][devil])
				echo "<TD><B><a href=$topplayer_path&type=devil>PKP</a></B></td>";
			if ($uWeb_chardb[vdis][battlepower])
				echo "<TD><B><a href=$topplayer_path&type=battlepower>(BP)</a></B></td>";
			if ($uWeb_chardb[vdis][x])
				echo "<TD><B>Pos X</B></td>";
			if ($uWeb_chardb[vdis][y])
				echo "<TD><B>Pos Y</B></td>";
			if ($uWeb_chardb[vdis][z])
				echo "<TD><B>Pos Z</B></td>";
			if ($uWeb_chardb[totaladdon])
			{
				for ($uWeb_chardb_tempnum = 0; $uWeb_chardb_tempnum < $uWeb_chardb[totaladdon]; $uWeb_chardb_tempnum++)
				{
					echo "<TD>".$uWeb_chardb[addon][title][$uWeb_chardb_tempnum]."</td>";
				}
			}
			echo "</tr>";
		}
		else
		{
			echo "<table border=0>";
			echo "<TR><TD><a href=$topplayer_path&type=level>Rated by Level (Only level 149 and below)</a></td></tr>";
			echo "<TR><TD><a href=$topplayer_path&type=money>Rated by Money Inventory</a></td></tr>";
			echo "<TR><TD><a href=$topplayer_path&type=bank>Rated by Money Bank</a></td></tr>";
			echo "<TR><TD><a href=$topplayer_path&type=rep>Rated by Reputation</a></td></tr>";
			echo "<TR><TD><a href=$topplayer_path&type=sp>Rated by Skill Point</a></td></tr>";
			echo "<TR><TD><a href=$topplayer_path&type=devil>Rated by Devil (PKP/PK Point)</a></td></tr>";
			echo "<TR><TD><a href=$topplayer_path&type=battlepower>Rated by BATTLEPOWER (BP)</a></td></tr>";
			echo "</table>";
			echo "<Table width=100% border=1><TR><TD><B>RANK</B></td>";
			if ($uWeb_chardb[vdis][name])
				echo "<TD><B>PLAYER NAME</B></td>";
			if ($uWeb_chardb[vdis][level])
				echo "<TD><B><a href=$topplayer_path&type=level>LEVEL</a></B></td>";
			if ($uWeb_chardb[vdis][cls])
				echo "<TD>CLASS</TD>";
			if ($uWeb_chardb[vdis][sex])
				echo "<TD><B>SEX</B></td>";
			if ($uWeb_chardb[vdis][rep])
				echo "<TD><B><a href=$topplayer_path&type=rep>REP</a></B></td>";
			if ($uWeb_chardb[vdis][money])
				echo "<TD><B><a href=$topplayer_path&type=money>MONEY</a></B></td>";
			if ($uWeb_chardb[vdis][bank])
				echo "<TD><B><a href=$topplayer_path&type=bank>BANK</a></B></td>";
			if ($uWeb_chardb[vdis][sp])
				echo "<TD><B><a href=$topplayer_path&type=sp>SP</a></B></td>";
			if ($uWeb_chardb[vdis][devil])
				echo "<TD><B><a href=$topplayer_path&type=devil>PKP</a></B></td>";
			if ($uWeb_chardb[vdis][battlepower])
				echo "<TD><B><a href=$topplayer_path&type=battlepower>(BP)</a></B></td>";
			if ($uWeb_chardb[totaladdon])
			{
				for ($uWeb_chardb_tempnum = 0; $uWeb_chardb_tempnum < $uWeb_chardb[totaladdon]; $uWeb_chardb_tempnum++)
				{
					echo "<TD>".$uWeb_chardb[addon][title][$uWeb_chardb_tempnum]."</td>";
				}
			}
			echo "</tr>";
		}
	}
	
	//
	// Get the results!
	//
	while ($uweb_toplvlrow = mysql_fetch_array($uweb_toplvlr))
	{
		//$uweb_toplvlrow["battlepower"] = (int)(($uweb_toplvlrow["taskcomplete"]/10000)*500)+(int)($uweb_toplvlrow["roleculti"])+(int)($uweb_toplvlrow["rolelevel"]);
		if ($uweb_toplvlrow[rolename] == "Hikari")
			continue;
		if ($uweb_toplvlrow[rolename] == "sen_pwned")
			continue;
		if ($uweb_toplvlrow[rolename] == "cased")
			continue;
		if (($uweb_toplvlrow[roleid] < 48) && ($gmuser < 1))
			continue;
		$uweb_toplvl_num++;
		//if ((isroleonline($uweb_toplvlrow[roleid])) && ($gmuser >= 1))
		if (isroleonline($uweb_toplvlrow[roleid]))
		{
			if ($webauth == $conf["login"])
				$uweb_toplvl_online = "<img src=images/online.gif>";
			else
				$uweb_toplvl_online = "";
		}
		else
			$uweb_toplvl_online = "";
		if ($uweb_toplvlrow[rolename])
		{
			if ($uWeb_chardb[output])
			{
				//$uweb_toplvlurl = "?&op=view&module=".$_REQUEST[module]."&type=".$_REQUEST[type]."&postype=1&posvalue=".$uweb_toplvlrow[roleid];
				$uweb_toplvlurl = "?op=view&module=02Account&redirect=0&type=vinfo&tid=".$uweb_toplvlrow[roleid];
				$uweb_addonurl = "?op=view&module=02Account&redirect=0&roleid=".$uweb_toplvlrow[roleid];
				$uWeb_gamemapx = (int)($uweb_toplvlrow[posx] - 5000 + 3071) / 10;
				$uWeb_gamemapy = (int)($uweb_toplvlrow[posy] - 5000) / 10;
				$uWeb_gamemapz = 721 - (int)($uweb_toplvlrow[posz] - 5000 + 2600) / 10;
				if ($gmuser >= 1)
				{
					echo "<TR><TD>$uweb_toplvl_num</td>";
					if ($uWeb_chardb[vdis][id])
						echo "<TD>".$uweb_toplvlrow[roleid]."</td>";
					if ($uWeb_chardb[vdis][name])
						echo "<TD><a href=$uweb_toplvlurl>".$uweb_toplvlrow[rolename]."</a> $uweb_toplvl_online</td>";
					if ($uWeb_chardb[vdis][level])
						echo "<TD>".$uweb_toplvlrow[rolelevel]."</td>";
					if ($uWeb_chardb[vdis][cls])
						echo "<TD>".getclass($uweb_toplvlrow[roleclass])."</td>";
					if ($uWeb_chardb[vdis][sex])
						echo "<TD>".getgender($uweb_toplvlrow[rolegender])."</TD>";
					if ($uWeb_chardb[vdis][rep])
						echo "<TD>".$uweb_toplvlrow[rolerep]."</TD>";
					if ($uWeb_chardb[vdis][money])
						echo "<TD>".$uweb_toplvlrow[rolemoney]."</TD>";
					if ($uWeb_chardb[vdis][bank])
						echo "<TD>".$uweb_toplvlrow[rolebank]."</TD>";
					if ($uWeb_chardb[vdis][sp])
						echo "<TD>".$uweb_toplvlrow[rolesp]."</TD>";
					if ($uWeb_chardb[vdis][redname])
						echo "<TD>".$uweb_toplvlrow[redname]."</TD>";
					if ($uWeb_chardb[vdis][rednametime])
						echo "<TD>".$uweb_toplvlrow[rednametime]."</TD>";
					if ($uWeb_chardb[vdis][devil])
						echo "<TD>".$uweb_toplvlrow[pinknametime]."</TD>";
					if ($uWeb_chardb[vdis][battlepower])
						echo "<TD>".$uweb_toplvlrow[battlepower]."</TD>";
					if ($uWeb_chardb[vdis][x])
						echo "<TD>$uWeb_gamemapx</TD>";
					if ($uWeb_chardb[vdis][y])
						echo "<TD>$uWeb_gamemapy</TD>";
					if ($uWeb_chardb[vdis][z])
						echo "<TD>$uWeb_gamemapz</TD>";
					if ($uWeb_chardb[totaladdon])
					{
						for ($uWeb_chardb_tempnum = 0; $uWeb_chardb_tempnum < $uWeb_chardb[totaladdon]; $uWeb_chardb_tempnum++)
						{
							echo "<TD><a href=$uweb_addonurl&".$uWeb_chardb[addon][url][$uWeb_chardb_tempnum].">".$uWeb_chardb[addon][text][$uWeb_chardb_tempnum]."</a></td>";
						}
					}
					echo "</TR>";
				}
				else
				{
					echo "<TR><TD>$uweb_toplvl_num</td>";
					if ($uWeb_chardb[vdis][name])
						echo "<TD><a href=$uweb_toplvlurl>".$uweb_toplvlrow[rolename]."</a> $uweb_toplvl_online</td>";
					if ($uWeb_chardb[vdis][level])
						echo "<TD>".$uweb_toplvlrow[rolelevel]."</td>";
					if ($uWeb_chardb[vdis][cls])
						echo "<TD>".getclass($uweb_toplvlrow[roleclass])."</td>";
					if ($uWeb_chardb[vdis][sex])
						echo "<TD>".getgender($uweb_toplvlrow[rolegender])."</TD>";
					if ($uWeb_chardb[vdis][rep])
						echo "<TD>".$uweb_toplvlrow[rolerep]."</TD>";
					if ($uWeb_chardb[vdis][money])
						echo "<TD>".$uweb_toplvlrow[rolemoney]."</TD>";
					if ($uWeb_chardb[vdis][bank])
						echo "<TD>".$uweb_toplvlrow[rolebank]."</TD>";
					if ($uWeb_chardb[vdis][sp])
						echo "<TD>".$uweb_toplvlrow[rolesp]."</TD>";
					if ($uWeb_chardb[vdis][devil])
						echo "<TD>".$uweb_toplvlrow[pinknametime]."</TD>";
					if ($uWeb_chardb[vdis][battlepower])
						echo "<TD>".$uweb_toplvlrow[battlepower]."</TD>";
					if ($uWeb_chardb[totaladdon])
					{
						for ($uWeb_chardb_tempnum = 0; $uWeb_chardb_tempnum < $uWeb_chardb[totaladdon]; $uWeb_chardb_tempnum++)
						{
							echo "<TD><a href=$uweb_addonurl&".$uWeb_chardb[addon][url][$uWeb_chardb_tempnum].">".$uWeb_chardb[addon][text][$uWeb_chardb_tempnum]."</a></td>";
						}
					}
					echo "</TR>";
				}
			}
		}
		if ($uweb_toplvl_num >= 500) break;
	}
	if ($uWeb_chardb[output])
		echo "</table></p>";
?>