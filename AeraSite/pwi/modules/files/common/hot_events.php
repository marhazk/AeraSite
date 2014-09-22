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
<center>
<h1>TOP 50 WEST DRAGON CITY IDLER (Free 1-10 AeraCoin every 10 minutes)<BR />Above level 100 only</h1>
<p><strong>The first 10 minute will get 0.10 AeraGold. The longer you idle inside the West City Free Gold PKZone Box, the less AeraGold you will gained till 0.01 AeraGold</strong></p>
<table width="100%%" bgcolor="#FFFFFF" border="1" cellpadding="3" cellspacing="0" >
<?php
	//foreach ($DB[guild]->retrieve() as $row)
	//{
	//	$num++;
	//
	$sortBy = $_REQUEST["sort"];
	if ($sortBy == "")
		$sortBy = "idlenum";
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
			idlenum=>array(
				name=>"AeraGold/Minutes",
				calcPKZone=>1
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
		),
		array("AND",
			array(
				array("online2","==",3),
				array("level",">=",100)
			)
		)
	);
?>
</table>
<p><a href="http://www.perfectworld.my/?op=photos/view&cat=1&name=926a85ce4193eda3dd8e6de48339c80b"><img src="http://www.perfectworld.my/?op=gfx&file=926a85ce4193eda3dd8e6de48339c80b" width=100% /></a>
<p><a href="http://www.perfectworld.my/?op=photos/view&cat=1&name=3f10328deec48d6eb4c61e355c9bcfe4"><img src="http://www.perfectworld.my/?op=gfx&file=3f10328deec48d6eb4c61e355c9bcfe4" width=100% /></a>
<p><a href="http://www.perfectworld.my/?op=photos/view&name=b50b40320bdf6d0f1568b3030e8f3c2e"><img src="http://www.perfectworld.my/?op=gfx&file=b50b40320bdf6d0f1568b3030e8f3c2e" width=100% /></a>
<p><a href="http://www.perfectworld.my/?op=photos/view&cat=1&name=abbb49ef3b4d4db5fabde16e5d8911c0"><img src="http://www.perfectworld.my/?op=gfx&file=abbb49ef3b4d4db5fabde16e5d8911c0" width=100% /></a>

<h1>TOP 50 WEST DRAGON CITY IDLER (Free 2 Aeracoin every 10 minutes)<BR />Above level 100 only</h1>
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
		),
		array("AND",
			array(
				array("online2","==",2),
				array("level",">=",100)
			)
		)
	);
?>
</table>
<p><strong>5 AeraCoin per 10 minutes for PK Zone Spot 2</strong></p>
<p><a href="http://www.perfectworld.my/?op=photos/view&cat=1&name=6ab9188840dfc9639604ed9c1b218d5c"><img src="http://www.perfectworld.my/?op=gfx&file=6ab9188840dfc9639604ed9c1b218d5c" width="100%" /></a></p>
<p><a href="http://www.perfectworld.my/?op=photos/view&cat=1&name=bd2e5c12c8dfd6e7b34f88e357ad8c01"><img src="http://www.perfectworld.my/?op=gfx&file=bd2e5c12c8dfd6e7b34f88e357ad8c01" width="100%" /></a></p>
<p><a href="http://www.perfectworld.my/?op=photos/view&cat=1&name=493d18b89453651ba70fa878e5b0bc10"><img src="http://www.perfectworld.my/?op=gfx&file=493d18b89453651ba70fa878e5b0bc10" width="100%" /></a></p>
<p><a href="http://www.perfectworld.my/?op=photos/view&cat=1&name=2783c0b4593abec892970a9d1b6c57c4"><img src="http://www.perfectworld.my/?op=gfx&file=2783c0b4593abec892970a9d1b6c57c4" width="100%" /></a></p>

</center>