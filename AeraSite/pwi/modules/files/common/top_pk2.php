<?php
	$DB[roles] = new GameDBD();
	$DB[roles]->connect("roles");
	$DB[cities] = new GameDBD();
	$DB[cities]->connect("cities");
	$DB[factioncolors] = new GameDBD();
	$DB[factioncolors]->connect("factioncolors");
	$DB[pvp] = new GameDBD();
	$chk = mysql_query("FLUSH TABLES;");
	$DB[pvp]->connect("pvp", "SELECT r.*, p.*, f.fname as fname FROM (SELECT attacker, COUNT(attacker) AS ckills, MAX(pdate) AS pdate FROM pkmode WHERE type>=1 AND attacker >= 1 AND roleid>=1 GROUP BY attacker HAVING ( COUNT(attacker) > 0 )) AS p, roles r, factionusers fu, factions f WHERE r.roleid=p.attacker AND fu.rid=r.roleid AND f.fid=fu.fid ORDER BY r.level DESC, r.bounty DESC, p.ckills DESC, r.reputation DESC;");
	$chk = mysql_query("FLUSH TABLES;");

	$DB[factions] = new GameDBD();
	$DB[factions]->connect("factions", "SELECT fid, fname, flevel, masterid, masterrole, member_size, fid AS afid, fid AS efid FROM factions");
	//$DB[factions]->addToDB("challenger", $DB[cities], "challenger");
	//$DB[factionchallengers]->merge("challenger", $DB[factions], "fid");
	$DB[factionenemies] = new GameDBD();
	$DB[factionenemies]->connect("factionenemies", "SELECT cfid as did, ctid, ctid AS cid, ctid AS eid1, ctid AS eid2 FROM factionenemies");
	$DB[factionenemies]->merge("ctid", $DB[factions], "fid");
	$DB[factionallies] = new GameDBD();
	$DB[factionallies]->connect("factionallies", "SELECT cfid as did, ctid, ctid AS cid, ctid AS aid1, ctid AS aid2 FROM factionallies");
	$DB[factionallies]->merge("ctid", $DB[factions], "fid");
	$DB[factionusers] = new GameDBD();
	$DB[factionusers]->connect("factionusers");
	///$DB[pvp]->merge("attacker", $DB[roles], "roleid");
	//$DB[pvp]->merge("attacker", $DB[factionusers], "rid");
	//$DB[pvp]->merge("fid", $DB[factions], "fid");
?>
<h1>TOP 50 PvP / PKERS / KILLERS</h1>
<table width="100%" bgcolor="#FFFFFF" border="1" cellpadding="3" cellspacing="0" >
<?php
	//foreach ($DB[guild]->retrieve() as $row)
	//{
	//	$num++;
	//
	
	$sortBy = $_REQUEST["sort"];
	if ($sortBy == "")
		$sortBy = "ckills";
	$sortlink = '<a href="?op=common/top_pk&sort=__value__">__value2__</a>';
	$DB[pvp]->printRows("<tr><td>","</td><td>","</td></tr>",
		array(
			"order"=>"bounty desc",
			"displayID"=>true
		), 
		array(
			"name"=>array(
				name=>"Character Name",
				allowsort=>true,
				sortlink=>$sortlink,
				links=>'<a href="?op=common/character&rid=__roleid__">__value__</a>'
			),
			"level"=>array(
				name=>"Level",
				allowsort=>true,
				sortlink=>$sortlink
			),
			"bounty"=>array(
				name=>"Head Bounty",
				allowsort=>true,
				type=>int,
				sortlink=>$sortlink
			),
			"ckills"=>array(
				name=>"Total Kills",
				allowsort=>true,
				sortlink=>$sortlink
			),
			"pdate"=>array(
				name=>"Last PvP",
				allowsort=>true,
				sortlink=>$sortlink
			),
			"fname"=>array(
				name=>"Guild Name",
				allowsort=>true,
				sortlink=>$sortlink,
				links=>'<a href="?op=common/faction&gid=__fid__">__value__</a>',
			)
		)
	);
?>
</table>


<h1>TOP FACTIONS</h1>
<table width="100%" bgcolor="#FFFFFF" border="1" cellpadding="3" cellspacing="0" >
<?php
	//foreach ($DB[guild]->retrieve() as $row)
	//{
	//	$num++;
	//
	$DB[factions]->printRows("<tr><td>","</td><td>","</td></tr>",
		array(
			"order"=>"member_size desc",
			"displayID"=>true
		), 
		array(
			"fname"=>array(
				name=>"Guild Name",
				links=>'<a href="?op=common/faction&gid=__fid__">__value__</a>'
				),
			"flevel"=>"Level",
			"masterid"=>array(
				db=>$DB[roles],
				attr=>"roleid",
				displayAttr=>"name",
				name=>"Guild Master",
				links=>'<a href="?op=common/character&rid=__roleid__">__value__</a>'
			),
			"member_size"=>"Guild Members",
			"afid"=>array(
				db=>$DB[factionallies],
				attr=>"did",
				displayAttr=>"fname",
				name=>"Guild Allies(s)",
				multiDB=>"<BR>",
				links=>'<a href="?op=common/faction&gid=__fid__">__value__</a>'
			),
			"efid"=>array(
				db=>$DB[factionenemies],
				attr=>"did",
				displayAttr=>"fname",
				name=>"Guild Enemy(s)",
				multiDB=>"<BR>",
				links=>'<a href="?op=common/faction&gid=__fid__">__value__</a>'
			))
		);
?>
</table>

<h1>LIST OF CONQUERED CITIES</h1>
<table width="100%%" bgcolor="#FFFFFF" border="1" cellpadding="3" cellspacing="0" >
<?php
	//foreach ($DB[guild]->retrieve() as $row)
	//{
	//	$num++;
	//
	$DB[cities]->printRows("<tr><td>","</td><td>","</td></tr>",
		array(
			"order"=>"level desc",
			"displayID"=>true
		), 
		array(
			"cname"=>"City Name",
			"level"=>"Level",
			"owner"=>array(
				db=>$DB[factions],
				attr=>"fid",
				displayAttr=>"fname",
				name=>"City Owner",
				links=>'<a href="?op=common/faction&gid=__fid__">__value__</a>'
			),
			"challenger"=>array(
				db=>$DB[factions],
				attr=>"fid",
				displayAttr=>"fname",
				name=>"Challenger",
				links=>'<a href="?op=common/faction&gid=__fid__">__value__</a>'
				)
			),
		1);
?>
</table>

