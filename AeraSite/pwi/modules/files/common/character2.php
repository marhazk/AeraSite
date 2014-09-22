<?php
	$rid = $_REQUEST["rid"];
	$DB[roles] = new GameDBD();
	$DB[roles]->connect("roles");
	$DB[users] = new GameDBD();
	$DB[users]->connect("users", "SELECT ID, claimaeracoin AS UAA FROM users");
	$DB[gender] = new GameDBD();
	$DB[gender]->connect("gender");
	$DB[cultivations] = new GameDBD();
	$DB[cultivations]->connect("cultivations");
	$DB[occupations] = new GameDBD();
	$DB[occupations]->connect("occupations");
	$DB[roles]->merge("userid", $DB[users], "ID");
	$role = $DB[roles]->searchBy("roleid",$rid);
?>
<h1>BASIC DETAIL FOR <?php echo $role[name];?></h1>
<table width="100%" bgcolor="#FFFFFF" border="1" cellpadding="3" cellspacing="0" >
<?php
	//foreach ($DB[guild]->retrieve() as $row)
	//{
	//	$num++;
	//
	$DB[roles]->printRows("<tr><td width=30%>","</td><td>","</td></tr>",
		array(
			order=>"level desc",
			displayID=>false,
			horizontal=>true,
			column=>1
		), 
		array(
			name=>"Character Name",
			claimaeracoin=>array(
				name=>"<B>Unclaimed Character AeraCoin (UCA)</B>",
				links=>'__value__ AeraCoin'
			),
			UAA=>array(
				name=>"<B>Unclaimed Account AeraCoin (UAA)</B>",
				links=>'__value__ AeraCoin'
			),
			online2=>array(
				name=>"Status",
				allowsort=>true,
				sortlink=>$sortlink,
				links=>'<a href="http://www.perfectworld.com.my/gamemap/?postype=1&posvalue=__roleid__"><img src="images/status/__value__.gif"/></a>'
			),
			train=>array(
				name=>"<B>Training Point (TP)</B>",
				links=>'__value__ TP'
			)
		),
		array("roleid","==",$rid));
?>
</table>
<p>&nbsp; </p>
<table width="100%" bgcolor="#FFFFFF" border="1" cellpadding="3" cellspacing="0" >
<?php
	//foreach ($DB[guild]->retrieve() as $row)
	//{
	//	$num++;
	//
	$DB[roles]->printRows("<tr><td width=30%>","</td><td>","</td></tr>",
		array(
			order=>"level desc",
			displayID=>false,
			horizontal=>true,
			column=>2
		), 
		array(
			name=>"Character Name",
			race=>"Race",
			occupation=>array(
				db=>$DB[occupations],
				attr=>"id",
				displayAttr=>"name",
				name=>"Class"
			),
			gender=>array(
				db=>$DB[gender],
				attr=>"id",
				displayAttr=>"name",
				name=>"Gender"
			),
			create_time=>"Last Created Time",
			lastlogin_time=>"Last Logged In Time",
			level=>"Level",
			level2=>array(
				db=>$DB[cultivations],
				attr=>"id",
				displayAttr=>"name",
				name=>"Cultivation"
			)
		),
		array("roleid","==",$rid));
?>
</table>

<h1>ADVANCED DETAILS FOR <?php echo $role[name];?></h1>
<table width="100%" bgcolor="#FFFFFF" border="1" cellpadding="3" cellspacing="0" >
<?php
	//foreach ($DB[guild]->retrieve() as $row)
	//{
	//	$num++;
	//
	$DB[roles]->printRows("<tr><td width=30%>","</td><td>","</td></tr>",
		array(
			order=>"level desc",
			displayID=>false,
			horizontal=>true,
			column=>3
		), 
		array(
			exp=>"Experiences",
			sp=>"Skill Points",
			skills_size=>"Skills Level",
			hp=>"Hit Point",
			mp=>"Magic Point",
			posx=>"Position X",
			posy=>"Position Y",
			posz=>"Position Z",
			pariah_time=>"PK Point",
			money=>"Pocket Money",
			storehouse_money=>"Bank Money",
			reputation=>"Reputation",
			vitality=>"Vitality",
			energy=>"Inteligence",
			strength=>"Strength",
			agility=>"Agility",
			max_hp=>"Max HP",
			max_mp=>"Max MP"
		),
		array("roleid","==",$rid));
?>
</table>

<h1>RATING DETAILS FOR <?php echo $role[name];?></h1>
<table width="100%" bgcolor="#FFFFFF" border="1" cellpadding="3" cellspacing="0" >
<?php
	//foreach ($DB[guild]->retrieve() as $row)
	//{
	//	$num++;
	//
	$DB[roles]->printRows("<tr><td width=30%>","</td><td>","</td></tr>",
		array(
			order=>"level desc",
			displayID=>false,
			horizontal=>true,
			column=>3
		), 
		array(
			hp_gen=>"HP Generating Speeds",
			mp_gen=>"MP Generating Speeds",
			walk_speed=>"Walk Speeds",
			run_speed=>"Run Speeds",
			swim_speed=>"Swim Speeds",
			flight_speed=>"Flight Speeds",
			damage_low=>"Damage Low",
			damage_high=>"Damage High",
			attack_speed=>"Attack Speeds",
			attack_range=>"Attack Range",
			attack=>"Attack Level",
			defense=>"Defences Level"
		),
		array("roleid","==",$rid));
?>
</table>