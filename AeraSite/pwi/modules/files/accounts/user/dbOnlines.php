<?php
	$gid = $_REQUEST["gid"];
	$DB[roles] = new GameDBD();
	$DB[roles]->connect("roles", "SELECT u.ID, u.name AS uname, u.email, r.*, o.* FROM (SELECT * FROM roles ORDER BY lastlogin_time DESC) AS r, online o, users u WHERE r.userid=o.Id AND u.ID=r.userid GROUP BY r.userid");
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
<h1>Online Roles</h1>
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
	$sortlink = '<a href="?op=accounts&type=Onlines&sort=__value__&asort='.$asort.'">__value2__</a>';
	$DB[roles]->printRows("<tr><td>","</td><td>","</td></tr>",
		array(
			order=>"$sortBy $asort",
			limit=>50,
			displayID=>true
		), 
		array(
			
			/*uname=>array(
				name=>"Username",
				allowsort=>true,
				sortlink=>$sortlink
			),*/
			email=>array(
				name=>"Email",
				allowsort=>true,
				sortlink=>$sortlink,
				links=>'<a href="http://www.facebook.com/search.php?init=s:email&q=__value__&type=user">__value__</a>'
			),
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
			/*level2=>array(
				db=>$DB[cultivations],
				attr=>"id",
				displayAttr=>"name",
				allowsort=>true,
				sortlink=>$sortlink,
				name=>"Cultivation"
			),*/
			battlepower=>array(
				name=>"Battle Power (BP)",
				allowsort=>true,
				sortlink=>$sortlink
			),
			train=>array(
				name=>"Train Point",
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
<br />
<?php
	$gid = $_REQUEST["gid"];
	$DB[roles] = new GameDBD();
	$trainingarea[tsrt][0][x]	= 1263;
	$trainingarea[tsrt][0][y]	= 1042;
	$trainingarea[tsrt][1][x]	= 1240;
	$trainingarea[tsrt][1][y]	= 1116;
	$trainingarea[tsrt][2][x]	= 1274;
	$trainingarea[tsrt][2][y]	= 1105;
	$trainingarea[tend][0][x]	= 1276;
	$trainingarea[tend][0][y]	= 1169;
	$trainingarea[tend][1][x]	= 1260;
	$trainingarea[tend][1][y]	= 1164;
	$trainingarea[tend][2][x]	= 1292;
	$trainingarea[tend][2][y]	= 1168;
	$trainingsql = "SELECT u.ID, u.name AS uname, u.email, r.* FROM (SELECT * FROM roles ORDER BY lastlogin_time DESC) AS r, users u, online o WHERE (((r.posx>=".$trainingarea[tsrt][0][x]." AND r.posx<=".$trainingarea[tend][0][x].") AND (r.posz>=".$trainingarea[tsrt][0][y]." AND r.posz<=".$trainingarea[tend][0][y].")) OR ((r.posx>=".$trainingarea[tsrt][1][x]." AND r.posx<=".$trainingarea[tend][1][x].") AND (r.posz>=".$trainingarea[tsrt][1][y]." AND r.posz<=".$trainingarea[tend][1][y].")) OR ((r.posx>=".$trainingarea[tsrt][2][x]." AND r.posx<=".$trainingarea[tend][2][x].") AND (r.posz>=".$trainingarea[tsrt][2][y]." AND r.posz<=".$trainingarea[tend][2][y]."))) AND r.userid=o.Id AND u.ID=o.Id GROUP BY r.userid";
	$DB[roles]->connect("roles", $trainingsql);
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
<h1>Training Roles</h1>
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
	$sortlink = '<a href="?op=accounts&type=Onlines&sort=__value__&asort='.$asort.'">__value2__</a>';
	$DB[roles]->printRows("<tr><td>","</td><td>","</td></tr>",
		array(
			order=>"$sortBy $asort",
			limit=>50,
			displayID=>true
		), 
		array(
			
			/*uname=>array(
				name=>"Username",
				allowsort=>true,
				sortlink=>$sortlink
			),*/
			email=>array(
				name=>"Email",
				allowsort=>true,
				sortlink=>$sortlink,
				links=>'<a href="http://www.facebook.com/search.php?init=s:email&q=__value__&type=user">__value__</a>'
			),
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
			/*level2=>array(
				db=>$DB[cultivations],
				attr=>"id",
				displayAttr=>"name",
				allowsort=>true,
				sortlink=>$sortlink,
				name=>"Cultivation"
			),*/
			battlepower=>array(
				name=>"Battle Power (BP)",
				allowsort=>true,
				sortlink=>$sortlink
			),
			train=>array(
				name=>"Train Point",
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
<br />

<?php
	$gid = $_REQUEST["gid"];
	$DB[roles] = new GameDBD();
	$DB[roles]->connect("roles", "SELECT u.ID, u.name AS uname, u.email, r.* FROM roles r, users u WHERE u.ID=r.userid ORDER BY r.lastlogin_time DESC LIMIT 0,50;");
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
<h1>Last Login</h1>
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
	$sortlink = '<a href="?op=accounts&type=Onlines&sort=__value__&asort='.$asort.'">__value2__</a>';
	$DB[roles]->printRows("<tr><td>","</td><td>","</td></tr>",
		array(
			order=>"$sortBy $asort",
			limit=>50,
			displayID=>true
		), 
		array(
			
			/*uname=>array(
				name=>"Username",
				allowsort=>true,
				sortlink=>$sortlink
			),*/
			email=>array(
				name=>"Email",
				allowsort=>true,
				sortlink=>$sortlink,
				links=>'<a href="http://www.facebook.com/search.php?init=s:email&q=__value__&type=user">__value__</a>'
			),
			name=>array(
				name=>"Character Name",
				allowsort=>true,
				sortlink=>$sortlink,
				links=>'<a href="?op=common/character&rid=__roleid__">__value__</a>'
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
			online2=>array(
				name=>"Status",
				allowsort=>true,
				sortlink=>$sortlink,
				links=>'<a href="http://www.perfectworld.com.my/gamemap/?postype=1&posvalue=__roleid__"><img src="images/status/__value__.gif"/></a>'
			),
			/*level2=>array(
				db=>$DB[cultivations],
				attr=>"id",
				displayAttr=>"name",
				allowsort=>true,
				sortlink=>$sortlink,
				name=>"Cultivation"
			),*/
			battlepower=>array(
				name=>"Battle Power (BP)",
				allowsort=>true,
				sortlink=>$sortlink
			),
			train=>array(
				name=>"Train Point",
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

