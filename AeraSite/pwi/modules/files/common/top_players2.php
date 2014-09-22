<?php
	$gid = $_REQUEST["gid"];
	$DB[roles] = new GameDBD();
	$DB[roles]->connect("roles");
	$DB[gender] = new GameDBD();
	$DB[gender]->connect("gender");
	$DB[occupations] = new GameDBD();
	$DB[occupations]->connect("occupations");
	$DB[cultivations] = new GameDBD();
	$DB[cultivations]->connect("cultivations");
	$DB[cities] = new GameDBD();
	$DB[cities]->connect("cities");
	$DB[factions] = new GameDBD();
	$DB[factions]->connect("factions");
	$DB[factionusers] = new GameDBD();
	$DB[factionusers]->connect("factionusers");
	$DB[roles]->merge("roleid", $DB[factionusers], "rid");
?>
<h1>TOP 50 PLAYERS - BATTLEPOWER</h1>
<table width="100%%" bgcolor="#FFFFFF" border="1" cellpadding="3" cellspacing="0" >
<?php
	//foreach ($DB[guild]->retrieve() as $row)
	//{
	//	$num++;
	//
	$sortBy = $_REQUEST["sort"];
	if ($sortBy == "")
		$sortBy = "battlepower";
	$asort = $_REQUEST[asort];
	if ($asort == "desc")
		$asort = "asc";
	else
		$asort = "desc";
	$sortlink = '<a href="?op=common/top_players&sort=__value__&asort='.$asort.'">__value2__</a>';
	$DB[roles]->printRows("<tr><td>","</td><td>","</td></tr>",
		array(
			order=>"$sortBy $asort",
			limit=>50,
			displayID=>true
		), 
		array(
			name=>array(
				name=>"Character Name",
				allowsort=>true,
				sortlink=>$sortlink,
				links=>'<a href="?op=common/character&rid=__roleid__">__value__</a>'
			),
			occupation=>array(
				db=>$DB[occupations],
				attr=>"id",
				displayAttr=>"name",
				name=>"Class",
				allowsort=>true,
				sortlink=>$sortlink,
				links=>'<img src="WEB-INF/img/__value__.png" title="__value__" alt="__value__" height="17" width="17" />'
			),
			gender=>array(
				db=>$DB[gender],
				attr=>"id",
				displayAttr=>"name",
				name=>"Sex",
				allowsort=>true,
				sortlink=>$sortlink,
				links=>'<img src="images/__value__2.png" title="__value__" alt="__value__" height="17" width="17" />'
			),
			level=>array(
				name=>"Level",
				allowsort=>true,
				sortlink=>$sortlink
			),
			level2=>array(
				db=>$DB[cultivations],
				attr=>"id",
				displayAttr=>"name",
				allowsort=>true,
				sortlink=>$sortlink,
				name=>"Cultivation"
			),
			battlepower=>array(
				name=>"Battle Power (BP)",
				allowsort=>true,
				sortlink=>$sortlink
			),
			fid=>array(
				db=>$DB[factions],
				attr=>"fid",
				displayAttr=>"fname",
				name=>"Guild",
				allowsort=>true,
				sortlink=>$sortlink,
				links=>'<a href="?op=common/faction&gid=__fid__">__value__</a>'
			)
		)
		,array(
		array("userid",">=",48),
		array("ver",">=",4),
		"AND"
		)
	);
?>
</table>

<h1>TOP 50 PLAYERS - LEVEL</h1>
<table width="100%%" bgcolor="#FFFFFF" border="1" cellpadding="3" cellspacing="0" >
<?php
	//foreach ($DB[guild]->retrieve() as $row)
	//{
	//	$num++;
	//
	$sortBy = $_REQUEST["sort"];
	if ($sortBy == "")
		$sortBy = "level";
	$sortlink = '<a href="?op=common/top_players&sort=__value__">__value2__</a>';
	$DB[roles]->printRows("<tr><td>","</td><td>","</td></tr>",
		array(
			order=>"$sortBy desc",
			limit=>50,
			displayID=>true
		), 
		array(
			name=>array(
				name=>"Character Name",
				allowsort=>true,
				sortlink=>$sortlink,
				links=>'<a href="?op=common/character&rid=__roleid__">__value__</a>'
			),
			occupation=>array(
				db=>$DB[occupations],
				attr=>"id",
				displayAttr=>"name",
				name=>"Class",
				allowsort=>true,
				sortlink=>$sortlink,
				links=>'<img src="WEB-INF/img/__value__.png" title="__value__" alt="__value__" height="17" width="17" />'
			),
			gender=>array(
				db=>$DB[gender],
				attr=>"id",
				displayAttr=>"name",
				name=>"Sex",
				allowsort=>true,
				sortlink=>$sortlink,
				links=>'<img src="images/__value__2.png" title="__value__" alt="__value__" height="17" width="17" />'
			),
			level=>array(
				name=>"Level",
				allowsort=>true,
				sortlink=>$sortlink
			),
			level2=>array(
				db=>$DB[cultivations],
				attr=>"id",
				displayAttr=>"name",
				allowsort=>true,
				sortlink=>$sortlink,
				name=>"Cultivation"
			),
			money=>array(
				name=>"Money",
				allowsort=>true,
				sortlink=>$sortlink
			),
			fid=>array(
				db=>$DB[factions],
				attr=>"fid",
				displayAttr=>"fname",
				name=>"Guild",
				allowsort=>true,
				sortlink=>$sortlink,
				links=>'<a href="?op=common/faction&gid=__fid__">__value__</a>'
			)
		)
		,array(
		array("userid",">=",48),
		array("ver",">=",4),
		"AND"
		)
	);
?>
</table>
<h1>TOP 50 PLAYERS - NEW PLAYERS</h1>
<table width="100%%" bgcolor="#FFFFFF" border="1" cellpadding="3" cellspacing="0" >
<?php
	//foreach ($DB[guild]->retrieve() as $row)
	//{
	//	$num++;
	//
	$sortBy = $_REQUEST["sort"];
	if ($sortBy == "")
		$sortBy = "create_time";
	$sortlink = '<a href="?op=common/top_players&sort=__value__">__value2__</a>';
	$DB[roles]->printRows("<tr><td>","</td><td>","</td></tr>",
		array(
			order=>"$sortBy desc",
			limit=>50,
			displayID=>true
		), 
		array(
			name=>array(
				name=>"Character Name",
				allowsort=>true,
				sortlink=>$sortlink,
				links=>'<a href="?op=common/character&rid=__roleid__">__value__</a>'
			),
			occupation=>array(
				db=>$DB[occupations],
				attr=>"id",
				displayAttr=>"name",
				name=>"Class",
				allowsort=>true,
				sortlink=>$sortlink,
				links=>'<img src="WEB-INF/img/__value__.png" title="__value__" alt="__value__" height="17" width="17" />'
			),
			gender=>array(
				db=>$DB[gender],
				attr=>"id",
				displayAttr=>"name",
				name=>"Sex",
				allowsort=>true,
				sortlink=>$sortlink,
				links=>'<img src="images/__value__2.png" title="__value__" alt="__value__" height="17" width="17" />'
			),
			create_time=>array(
				name=>"Created on",
				allowsort=>true,
				sortlink=>$sortlink
			),
			level=>array(
				name=>"Level",
				allowsort=>true,
				sortlink=>$sortlink
			),
			online2=>array(
				name=>"Status",
				allowsort=>true,
				sortlink=>$sortlink,
				links=>'<a href="http://www.perfectworld.com.my/gamemap/?postype=1&posvalue=__roleid__"><img src="images/status/__value__.gif"/></a>'
			),
			fid=>array(
				db=>$DB[factions],
				attr=>"fid",
				displayAttr=>"fname",
				name=>"Guild",
				allowsort=>true,
				sortlink=>$sortlink,
				links=>'<a href="?op=common/faction&gid=__fid__">__value__</a>'
			)
		)
		,array(
		array("userid",">=",48),
		array("ver",">=",4),
		"AND"
		)
	);
?>
</table>

<h1>TOP 50 PLAYERS - LAST LOGGED IN</h1>
<table width="100%%" bgcolor="#FFFFFF" border="1" cellpadding="3" cellspacing="0" >
<?php
	//foreach ($DB[guild]->retrieve() as $row)
	//{
	//	$num++;
	//
	$sortBy = $_REQUEST["sort"];
	if ($sortBy == "")
		$sortBy = "lastlogin_time";
	$sortlink = '<a href="?op=common/top_players&sort=__value__">__value2__</a>';
	$DB[roles]->printRows("<tr><td>","</td><td>","</td></tr>",
		array(
			order=>"$sortBy desc",
			limit=>50,
			displayID=>true
		), 
		array(
			name=>array(
				name=>"Character Name",
				allowsort=>true,
				sortlink=>$sortlink,
				links=>'<a href="?op=common/character&rid=__roleid__">__value__</a>'
			),
			occupation=>array(
				db=>$DB[occupations],
				attr=>"id",
				displayAttr=>"name",
				name=>"Class",
				allowsort=>true,
				sortlink=>$sortlink,
				links=>'<img src="WEB-INF/img/__value__.png" title="__value__" alt="__value__" height="17" width="17" />'
			),
			gender=>array(
				db=>$DB[gender],
				attr=>"id",
				displayAttr=>"name",
				name=>"Sex",
				allowsort=>true,
				sortlink=>$sortlink,
				links=>'<img src="images/__value__2.png" title="__value__" alt="__value__" height="17" width="17" />'
			),
			lastlogin_time=>array(
				name=>"Logged on",
				allowsort=>true,
				sortlink=>$sortlink
			),
			level=>array(
				name=>"Level",
				allowsort=>true,
				sortlink=>$sortlink
			),
			fid=>array(
				db=>$DB[factions],
				attr=>"fid",
				displayAttr=>"fname",
				name=>"Guild",
				allowsort=>true,
				sortlink=>$sortlink,
				links=>'<a href="?op=common/faction&gid=__fid__">__value__</a>'
			)
		)
		,array(
		array("userid",">=",48),
		array("ver",">=",4),
		"AND"
		)
	);
?>
</table>

