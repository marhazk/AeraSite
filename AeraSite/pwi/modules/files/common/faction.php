<?php
	$gid = $_REQUEST["gid"];
	$DB[roles] = new GameDBD();
	$DB[roles]->connect("roles");
	$DB[cities] = new GameDBD();
	$DB[cities]->connect("cities");
	$DB[chats] = new GameDBD();
	$DB[chats]->connect("chats", "SELECT * FROM chats WHERE dst='$gid' AND type='Guild' ORDER BY cid DESC LIMIT 0,250");
	$DB[factions] = new GameDBD();
	$DB[factions]->connect("factions");
	$DB[factionusers] = new GameDBD();
	$DB[factionusers]->connect("factionusers");
	$DB[factionusers]->merge("rid", $DB[roles], "roleid");
	$guild = $DB[factions]->searchBy("fid",$gid);
?>
<h1>FACTION DETAIL FOR <?php echo $guild[fname];?></h1>
<table width="100%%" bgcolor="#FFFFFF" border="1" cellpadding="3" cellspacing="0" >
<?php
	//foreach ($DB[guild]->retrieve() as $row)
	//{
	//	$num++;
	//
	$DB[factions]->printRows("<tr><td width=30%>","</td><td width=70%>","</td></tr>",
		array(
			order=>"member_size desc",
			displayID=>true,
			horizontal=>true
		), 
		array(
			"fname"=>"Guild Name",
			"masterid"=>array(
				db=>$DB[roles],
				attr=>"roleid",
				displayAttr=>name,
				name=>"Guild Master",
				links=>'<a href="?op=common/character&rid=__roleid__">__value__</a>'
			),
			"flevel"=>"Level",
			"member_size"=>"Guild Members",
			"attackerid"=>array(
				db=>$DB[factions],
				attr=>"fid",
				displayAttr=>"fname",
				name=>"Guild Attacker(s)",
				multi=>"<BR>",
				links=>'<a href="?op=common/faction&gid=__fid__">__value__</a>'),
			"enemyid"=>array(
				db=>$DB[factions],
				attr=>"fid",
				displayAttr=>"fname",
				name=>"Guild Enemy(s)",
				multi=>"<BR>",
				links=>'<a href="?op=common/faction&gid=__fid__">__value__</a>')
		),
		array("fid","==",$gid));
?>
</table>

<h1>LIST OF CONQUERED CITIES BY <?php echo $guild[fname];?></h1>
<table width="100%%" bgcolor="#FFFFFF" border="1" cellpadding="3" cellspacing="0" >
<?php
	//foreach ($DB[guild]->retrieve() as $row)
	//{
	//	$num++;
	//
	$DB[cities]->printRows("<tr><td>","</td><td>","</td></tr>",
		array(
			order=>"level desc",
			displayID=>true
		), 
		array(
			"cname"=>"City Name",
			"level"=>"Level",
			"challenger"=>array(
				db=>$DB[factions],
				attr=>"fid",
				displayAttr=>"fname",
				name=>"Challenger",
				links=>'<a href="?op=common/faction&gid=__fid__">__value__</a>'
			)
		),
		array("owner","==",$gid));
?>
</table>

<h1>LIST OF <?php echo $guild[fname];?> GUILD MEMBERS</h1>
<table width="100%%" bgcolor="#FFFFFF" border="1" cellpadding="3" cellspacing="0" >
<?php
	//foreach ($DB[guild]->retrieve() as $row)
	//{
	//	$num++;
	//
	$DB[factionusers]->printRows("<tr><td>","</td><td>","</td></tr>",
		array(
			order=>"level desc",
			displayID=>true
		), 
		array(
			name=>array(
				name=>"Character Name",
				links=>'<a href="?op=common/character&rid=__rid__">__value__</a>'
			),
			rid=>array(
				db=>$DB[roles],
				attr=>"roleid",
				displayAttr=>"level",
				name=>"Character Level"
			),
			nickname=>"Nickname"),
		array("fid","==",$gid));
?>
</table>

<?php if ($chkid >= 32) { ?>
<h1><?php echo $guild[fname];?> GUILD CHATS</h1>
<table width="100%%" bgcolor="#FFFFFF" border="1" cellpadding="3" cellspacing="0" >
<?php
	//foreach ($DB[guild]->retrieve() as $row)
	//{
	//	$num++;
	//
	$DB[chats]->printRows("<tr><td>","</td><td>","</td></tr>",
		array(
			order=>"cid desc",
			limit=>200,
			displayID=>true
		), 
		array(
			cdate=>"Date",
			src=>array(
				db=>$DB[roles],
				attr=>"roleid",
				displayAttr=>"name",
				name=>"Character Name",
				links=>'<a href="?op=common/character&rid=__src__">__value__</a>'
			),
			msg=>array(
				name=>"Message",
				base64=>true
			)
		),
		//array("dst","==",$gid));
		array(
			"AND",
			array
			(
				array("dst","==",$gid),
				array("dst","!=",9),
				array("type","==","Guild")
			)
		)
	);
?>
</table>
<?php } ?>