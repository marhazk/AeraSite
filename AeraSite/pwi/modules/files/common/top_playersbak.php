
<?php

if ($serverUp)
{
	$uWeb_addmodules .= "Top Player Module v2.0; ";
	$maxDisplay = 100;
	
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
	}
	$maxhours = 60*60*24*7; //3 days not online
	$hoursonline = time()-$maxhours;
	$uWeb_roleidmax = $uWeb_roleidmin+15;
	//$uWeb_vinfo = 1;
	if (!$uWeb_chardb[epoint])			$uWeb_chardb[epoint]		= 0;
	if (!$uWeb_chardb[orioutput])		$uWeb_chardb[orioutput]		= 0;
	if ($uWeb_chardb[epoint])
	{
		$uWeb_vinfo						= 1;
		$uWeb_chardb[orioutput] 		= 1;
		$uWeb_chardb[output]			= 1;
		$uWeb_chardb[totaladdon]		= 1;
		$uWeb_chardb[addon][title][0]	= "<B>CLAIM REWARDS</b>";
		$uWeb_chardb[addon][url][0]		= "op=accounts&redirect=0&type=vinfo";
		$uWeb_chardb[addon][text][0]	= "CLAIM REWARDS";
		$uWeb_chardb[addon][title][1]	= "<B>E-Point</b>";
		$uWeb_chardb[addon][url][1]		= "op=accounts&redirect=0&type=buypoint";
		$uWeb_chardb[addon][text][1]	= "BUY POINT";
		$uWeb_chardb[vdis][name]		= 1;
		$uWeb_chardb[vdis][battlepower]	= 0;
		$uWeb_chardb[vdis][level]		= 1;
		$uWeb_chardb[vdis][money]		= 1;
		$uWeb_chardb[vdis][bank]		= 1;
		$uWeb_chardb[vdis][rep]			= 1;
		$uWeb_chardb[vdis][sp]			= 1;
		$uWeb_chardb[vdis][guild]		= 1;
	}
	if (!$uWeb_chardb[output])
	{
		$uWeb_chardb[output]			= 1;
		$uWeb_chardb[orioutput]			= 1;
		$uWeb_chardb[vdis][id]			= 1;
		$uWeb_chardb[vdis][level]		= 1;
		$uWeb_chardb[vdis][guild]		= 1;
		$uWeb_chardb[vdis][money]		= 1;
		$uWeb_chardb[vdis][lastlogin]	= 0;
		$uWeb_chardb[vdis][rep]			= 1;
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
		if ($gmuser >= 5)
		{
			$uWeb_chardb[vdis][bank]		= 1;
			$uWeb_chardb[vdis][sp]			= 1;
		}
	}
	//
	// Declaration end
	//
	if ($uWeb_chardb[orioutput])
	{
		if ($userWebID == 0)
		{
			$uweb_toplvlurl = "?op=view&module=".$_REQUEST[module]."&type=".$_REQUEST[type];
			//echo "<p align=center><a href=$uweb_toplvlurl><img src=gamemap/?auth=".rand()." width=100%><BR>[Click here to refresh]</a></p>";
		}
		elseif ($userWebID == 5)
		{
			if ($_REQUEST[postype])
			{
				$uweb_toplvlurl = "?op=view&module=".$_REQUEST[module]."&type=".$_REQUEST[type]."&postype=".$_REQUEST[postype]."&posvalue=".$_REQUEST[posvalue];
				//echo "<p align=center><a href=$uweb_toplvlurl><img src=gamemap/?postype=".$_REQUEST[postype]."&posvalue=".$_REQUEST[posvalue]."&auth=".rand()." width=100%><BR>[Click here to refresh]</a></p>";
			}
			else
			{
				$uweb_toplvlurl = "?op=view&module=".$_REQUEST[module]."&type=".$_REQUEST[type]."&postype=3";
				//echo "<p align=center><a href=$uweb_toplvlurl><img src=gamemap/?postype=3&auth=".rand()." width=100%><BR>[Click here to refresh]</a></p>";
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
		else if ($_REQUEST[type] == "lastlogin")
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
		$topplayer_name = "Only level 150 and below and 7 DAYS active players";
		$topplayer_type = "roles.level";
		if ($uWeb_vinfo)
			$topplayer_add = "AND roles.level<=150 AND roles.roleid>=28";
		elseif ($gmuser >= 5)
			$topplayer_add = "";
		else
			$topplayer_add = "AND roles.level<=150 AND roles.level>=28";
	}
	if (($uWeb_vinfo) && ($op != "common/top_players"))
		$uweb_toplvlq = "SELECT * FROM roles,factionusers, factions WHERE roles.roleid>=$uWeb_roleidmin AND roles.level>=5 AND roles.roleid<=$uWeb_roleidmax AND roles.roleid=factionusers.rid AND factionusers.fid=factions.fid $topplayer_add GROUP BY roles.roleid";
	elseif ($gmuser >= 5)
		$uweb_toplvlq = "SELECT * FROM roles,factionusers, factions WHERE roles.roleid=factionusers.rid AND factionusers.fid=factions.fid AND roles.level>=5 $topplayer_add GROUP BY roles.roleid ORDER BY $topplayer_type DESC";
	else
		$uweb_toplvlq = "SELECT * FROM roles,factionusers, factions WHERE roles.roleid=factionusers.rid AND factionusers.fid=factions.fid AND roles.level>=5 $topplayer_add AND roles.lastlogin_time>=$hoursonline GROUP BY roles.roleid ORDER BY $topplayer_type DESC";
		//$uweb_toplvlq = "SELECT * FROM roles WHERE level>=5 $topplayer_add AND (accstat=0 OR accstat>=3) AND accstat!=6 AND lastlogin_time>=$hoursonline ORDER BY $topplayer_type DESC";
		
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
			echo "<h1><b>TOP $maxDisplay PLAYERS ($topplayer_name)<b></h1><p>";
		if ($gmuser >= 5)
		{
			
			echo "<Table width=100% border=1><TR><TD><B>No</B></td>";
			if ($uWeb_chardb[vdis][id])
				echo "<TD><B><a href=$topplayer_path&type=id>UID</a></B></td>";
			if ($uWeb_chardb[vdis][name])
				echo "<TD><B>PLAYER NAME</B></td>";
			if ($uWeb_chardb[vdis][level])
				echo "<TD><B><a href=$topplayer_path&type=level>LVL</a></B></td>";
			if ($uWeb_chardb[vdis][guild])
				echo "<TD><B><a href=$topplayer_path&type=battlepower>Guild</a></B></td>";
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
			if ($uWeb_chardb[vdis][lastlogin])
				echo "<TD width=100><B><a href=$topplayer_path&type=lastlogin>LAST LOGIN</a></B></td>";
			if ($uWeb_chardb[vdis][sp])
				echo "<TD><B><a href=$topplayer_path&type=sp>SP</a></B></td>";
			if ($uWeb_chardb[vdis][redname])
				echo "<TD><B><a href=$topplayer_path&type=redname>REDNAME</a></B></td>";
			if ($uWeb_chardb[vdis][rednametime])
				echo "<TD><B><a href=$topplayer_path&type=rednametime>RED TIME</a></B></td>";
			if ($uWeb_chardb[vdis][devil])
				echo "<TD><B><a href=$topplayer_path&type=devil>PKP</a></B></td>";
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

			echo "<Table width=100% border=1><TR><TD><B>No</B></td>";
			if ($uWeb_chardb[vdis][name])
				echo "<TD><B>PLAYER NAME</B></td>";
			if ($uWeb_chardb[vdis][level])
				echo "<TD><B><a href=$topplayer_path&type=level>LVL</a></B></td>";
			if ($uWeb_chardb[vdis][guild])
				echo "<TD><B><a href=$topplayer_path&type=battlepower>Guild</a></B></td>";
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
			if ($uWeb_chardb[vdis][lastlogin])
				echo "<TD><B><a href=$topplayer_path&type=lastlogin>LAST LOGIN</a></B></td>";
			if ($uWeb_chardb[vdis][sp])
				echo "<TD><B><a href=$topplayer_path&type=sp>SP</a></B></td>";
			if ($uWeb_chardb[vdis][devil])
				echo "<TD><B><a href=$topplayer_path&type=devil>PKP</a></B></td>";
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
		//$uweb_toplvlrow["battlepower"] = (int)(($uweb_toplvlrow["taskcomplete"]/10000)*500)+(int)($uweb_toplvlrow["level2"])+(int)($uweb_toplvlrow["rolelevel"]);
		if ($gmuser <= 3)
		{
			if ($uweb_toplvlrow[name] == "Hikari")
				continue;
			if ($uweb_toplvlrow[name] == "sen_pwned")
				continue;
			if ($uweb_toplvlrow[name] == "cased")
				continue;
			if ($uweb_toplvlrow[name] == "sen")
				continue;
			if ($uweb_toplvlrow[name] == "Nirvana")
				continue;
			if ($uweb_toplvlrow[name] == "Sprite")
				continue;
			if ($uweb_toplvlrow[roleid] < 48)
				continue;
			//if ((($uweb_toplvlrow[accstat] == 0) || ($uweb_toplvlrow[accstat]>=3)) && ($uweb_toplvlrow[accstat] != 6))
			//	continue;
		}
		$uweb_toplvl_num++;
		//if ((isroleonline($uweb_toplvlrow[roleid])) && ($gmuser >= 1))
		$uweb_toplvl_country = "<img height=12 width=18 src=\"?op=gfx&type=country&rid=".$uweb_toplvlrow[roleid]."\" alt=\"".strtolower($ipdb[country])."\"/>";
		if (isroleonline($uweb_toplvlrow[roleid]))
		{
			if ($webauth == $conf["login"])
				$uweb_toplvl_online = "<img src=images/online.gif> ".getstar1($uweb_toplvlrow[accstat]);
			else
				$uweb_toplvl_online = getstar1($uweb_toplvlrow[accstat]);
		}
		else
			$uweb_toplvl_online = getstar1($uweb_toplvlrow[accstat]);
		//<img height=12 width=18 src=\"?op=gfx&type=country&name=".strtolower($ipdb[country2])."\" alt=\"".strtolower($ipdb[country])."\"/>
		
		if ($uweb_toplvlrow[name])
		{
			if ($uweb_toplvlrow[level2] == 8) //NIRVANA
				$uWeb_namecolor = "#c600c8";
			elseif ($uweb_toplvlrow[level2] == 7)
				$uWeb_namecolor = "#711e72";
			elseif ($uweb_toplvlrow[level2] == 6)
				$uWeb_namecolor = "#ff0000";
			elseif ($uweb_toplvlrow[level2] == 5)
				$uWeb_namecolor = "#5b125c";
			elseif ($uweb_toplvlrow[level2] == 4)
				$uWeb_namecolor = "#121e5c";
			elseif ($uweb_toplvlrow[level2] == 3)
				$uWeb_namecolor = "#0222c6";
			elseif ($uweb_toplvlrow[level2] == 2)
				$uWeb_namecolor = "#596cce";
			elseif ($uweb_toplvlrow[level2] == 30)
				$uWeb_namecolor = "#0000ff";
			elseif ($uweb_toplvlrow[level2] == 31)
				$uWeb_namecolor = "#b12020";
			elseif ($uweb_toplvlrow[level2] == 32)
				$uWeb_namecolor = "#6d2727";
			elseif ($uweb_toplvlrow[level2] == 20)
				$uWeb_namecolor = "#00cacc";
			elseif ($uweb_toplvlrow[level2] == 21)
				$uWeb_namecolor = "#008486";
			elseif ($uweb_toplvlrow[level2] == 22)
				$uWeb_namecolor = "#004647";
			else
				$uWeb_namecolor = "";
			//(accstat=0 OR accstat>=3) AND accstat!=6 AND 
			if ($uWeb_chardb[output])
			{
				//$uweb_toplvlurl = "?&op=view&module=".$_REQUEST[module]."&type=".$_REQUEST[type]."&postype=1&posvalue=".$uweb_toplvlrow[roleid];
				$uweb_toplvlurl = "?op=accounts&redirect=0&type=vinfo&tid=".$uweb_toplvlrow[roleid];
				$uweb_addonurl = "?op=accounts&redirect=0&roleid=".$uweb_toplvlrow[roleid];
				$uWeb_gamemapx = (int)($uweb_toplvlrow[posx] - 5000 + 3071) / 10;
				$uWeb_gamemapy = (int)($uweb_toplvlrow[posy] - 5000) / 10;
				$uWeb_gamemapz = 721 - (int)($uweb_toplvlrow[posz] - 5000 + 2600) / 10;
				
				$ocupation = occupation($uweb_toplvlrow[occupation]);
				$ocupationtit = str_replace(".png", "", $ocupation);
	
				if ($gmuser >= 5)
				{
					echo "<TR><TD>$uweb_toplvl_num</td>";
					if ($uWeb_chardb[vdis][id])
						echo "<TD>$uweb_toplvl_country ".$uweb_toplvlrow[roleid]."</td>";
					if ($uWeb_chardb[vdis][name])
						echo "<TD><a href=$uweb_toplvlurl><font color=".$uWeb_namecolor.">".$uweb_toplvlrow[name]."</a> $uweb_toplvl_online</font></td>";
					if ($uWeb_chardb[vdis][level])
						echo "<TD>".$uweb_toplvlrow[level]."</td>";
					if ($uWeb_chardb[vdis][guild])
						echo "<TD>".$uweb_toplvlrow[fname]."</TD>";
					if ($uWeb_chardb[vdis][cls])
						echo '<td><img src="WEB-INF/img/'.$ocupation.'" title="'.$ocupationtit.'" alt="'.$ocupationtit.'" height="17" width="17" /></td>';
					if ($uWeb_chardb[vdis][sex])
						echo "<TD>".getgenderimg($uweb_toplvlrow[gender])."</TD>";
					if ($uWeb_chardb[vdis][rep])
						echo "<TD>".$uweb_toplvlrow[reputation]."</TD>";
					if ($uWeb_chardb[vdis][money])
						echo "<TD>".$uweb_toplvlrow[money]."</TD>";
					if ($uWeb_chardb[vdis][bank])
						echo "<TD>".$uweb_toplvlrow[storehouse_money]."</TD>";
					if ($uWeb_chardb[vdis][lastlogin])
						echo "<TD>".mdate($uweb_toplvlrow[lastlogin])."</TD>";
					if ($uWeb_chardb[vdis][sp])
						echo "<TD>".$uweb_toplvlrow[sp]."</TD>";
					if ($uWeb_chardb[vdis][redname])
						echo "<TD>".$uweb_toplvlrow[invader_state]."</TD>";
					if ($uWeb_chardb[vdis][rednametime])
						echo "<TD>".$uweb_toplvlrow[invader_time]."</TD>";
					if ($uWeb_chardb[vdis][devil])
						echo "<TD>".$uweb_toplvlrow[pariah_time]."</TD>";
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
						echo "<TD>$uweb_toplvl_country <a href=$uweb_toplvlurl><font color=".$uWeb_namecolor.">".$uweb_toplvlrow[name]."</font></a> $uweb_toplvl_online </td>";
					if ($uWeb_chardb[vdis][level])
						echo "<TD>".$uweb_toplvlrow[level]."</td>";
					if ($uWeb_chardb[vdis][guild])
						echo "<TD>".$uweb_toplvlrow[fname]."</TD>";
					if ($uWeb_chardb[vdis][cls])
						echo '<td><img src="WEB-INF/img/'.$ocupation.'" title="'.$ocupationtit.'" alt="'.$ocupationtit.'" height="17" width="17" /></td>';
					if ($uWeb_chardb[vdis][sex])
						echo "<TD>".getgenderimg($uweb_toplvlrow[gender])."</TD>";
					if ($uWeb_chardb[vdis][rep])
						echo "<TD>".$uweb_toplvlrow[reputation]."</TD>";
					if ($uWeb_chardb[vdis][money])
						echo "<TD>".$uweb_toplvlrow[money]."</TD>";
					if ($uWeb_chardb[vdis][bank])
						echo "<TD>".$uweb_toplvlrow[storehouse_money]."</TD>";
					if ($uWeb_chardb[vdis][lastlogin])
						echo "<TD>".mdate($uweb_toplvlrow[lastlogin_time])."</TD>";
					if ($uWeb_chardb[vdis][sp])
						echo "<TD>".$uweb_toplvlrow[sp]."</TD>";
					if ($uWeb_chardb[vdis][devil])
						echo "<TD>".$uweb_toplvlrow[pariah_time]."</TD>";
					if ($uWeb_chardb[totaladdon])
					{
						for ($uWeb_chardb_tempnum = 0; $uWeb_chardb_tempnum < $uWeb_chardb[totaladdon]; $uWeb_chardb_tempnum++)
						{
							echo "<TD><a href=$uweb_addonurl&".$uWeb_chardb[addon][url][$uWeb_chardb_tempnum].">".$uWeb_chardb[addon][text][$uWeb_chardb_tempnum]."</a></td>";
						}
					}
					echo "</TR>";
					if (($uweb_toplvl_num == $maxDisplay) && ($gmuser < 1))
						break;
				}
			}
		}
		if ($uweb_toplvl_num >= 500) break;
	}
	if ($uWeb_chardb[output])
		echo "</table></p></b></b></b>";
}
else
	include "modules/files/common/maintainance.php";
?>