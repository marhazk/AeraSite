<?php
	$rid = $_REQUEST["rid"];
	$DB[roles] = new GameDBD();
	$DB[roles]->connect("roles");
	$DB[gender] = new GameDBD();
	$DB[gender]->connect("gender");
	$DB[cultivations] = new GameDBD();
	$DB[cultivations]->connect("cultivations");
	$DB[occupations] = new GameDBD();
	$DB[occupations]->connect("occupations");
	$role = $DB[roles]->searchBy("roleid",$rid);
?>
<h1>CHARACTER DETAIL FOR <?php echo $guild[name];?></h1>
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
			),
			exp=>"Experiences",
			sp=>"Skill Points",
			hp=>"Hit Point",
			mp=>"Magic Point",
			posx=>"Position X",
			posy=>"Position Y",
			posz=>"Position Z",
			money=>"Pocket Money",
			storehouse_money=>"Bank Money",
			pariah_time=>"PK Point",
			reputation=>"Reputation",
			vitality=>"Vitality",
			energy=>"Inteligence",
			strength=>"Strength",
			agility=>"Agility",
			max_hp=>"Max HP",
			max_mp=>"Max MP",
			hp_gen=>"HP Generating Speeds",
			mp_gen=>"MP Generating Speeds",
			walk_speed=>"Walk Speeds",
			run_speed=>"Run Speeds",
			swim_speed=>"Swim Speeds",
			flight_speed=>"Flight Speeds",
			attack=>"Attack Rate",
			damage_low=>"Damage Low",
			damage_high=>"Damage High",
			attack_speed=>"Attack Speeds",
			attack_range=>"Attack Range",
			defense=>"Defences Level",
			armor=>"Armor Level",
			skills_size=>"Skills Level",
		),
		array("roleid","==",$rid));
?>
</table>

<h1>CHARACTER DETAIL FOR <?php echo $guild[name];?></h1>
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
			),
			exp=>"Experiences",
			sp=>"Skill Points",
			hp=>"Hit Point",
			mp=>"Magic Point",
			posx=>"Position X",
			posy=>"Position Y",
			posz=>"Position Z",
			money=>"Pocket Money",
			storehouse_money=>"Bank Money",
			pariah_time=>"PK Point",
			reputation=>"Reputation",
			vitality=>"Vitality",
			energy=>"Inteligence",
			strength=>"Strength",
			agility=>"Agility",
			max_hp=>"Max HP",
			max_mp=>"Max MP",
			hp_gen=>"HP Generating Speeds",
			mp_gen=>"MP Generating Speeds",
			walk_speed=>"Walk Speeds",
			run_speed=>"Run Speeds",
			swim_speed=>"Swim Speeds",
			flight_speed=>"Flight Speeds",
			attack=>"Attack Rate",
			damage_low=>"Damage Low",
			damage_high=>"Damage High",
			attack_speed=>"Attack Speeds",
			attack_range=>"Attack Range",
			defense=>"Defences Level",
			armor=>"Armor Level",
			skills_size=>"Skills Level",
		),
		array("roleid","==",$rid));
?>
</table>
