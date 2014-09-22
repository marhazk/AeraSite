<?php
	$DB[roles] = new GameDBD();
	$DB[roles]->connect("roles", "SELECT * FROM roles WHERE userid='$chkid' ORDER BY name ASC");
	$roles = $DB[roles]->retrieve();
	$resultQuery = "Please fill in the blank below";
	$success = false;
	if (($_POST[opchk] == "View Info") || ($_REQUEST[rid] >= 32))
	{
	
			$rid = $_REQUEST[rid];
			$RoleInfo = $DB[roles]->searchBy("roleid",$rid);
			$DB[users] = new GameDBD();
			$DB[users]->connect("roles", "SELECT * FROM users WHERE ID='".$RoleInfo[userid]."'");
			$DB[rolescur] = new GameDBD();
			$DB[rolescur]->connect("roles", "SELECT * FROM roles WHERE userid='".$RoleInfo[userid]."'");
			$rolescur = $DB[rolescur]->retrieve();
			$success = true;
	}
?>
<center><p></p><h1>Your Character List</h1>

<table align="center" bgcolor="#FFFFFF" border="1" cellpadding="3" cellspacing="0" >
  <tr>
    <th colspan="4" bgcolor="#000000"><b><font color="#ffffff">Character List</font></b></th>
  </tr>
  <tr>
    <td width="100%" align="center"><form method="post" name="form1" id="form1">
      <table  cellpadding="0" cellspacing="0">
        <tr>
          <td width="30%"><span id="result_box" lang="en" xml:lang="en">Enter the character name</span>:</td>
          <td width="70%"><select name="rid" id="rid">
          <option value="0">-</option>
          <?php
		  	foreach ($roles as $role)
			{
		  ?>
          <option value="<?php echo $role[roleid]?>"><?php echo $role[name]?></option>
          <?php } ?>
          </select>
          
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="2"><div style="text-align: left;">
            <input type="submit" name="opchk" value="View Info" id="opchk" />
          </div></td>
        </tr>
      </table>
    </form></td>
  </tr>
</table>
<?php if ($success) { ?>

<?php
	$DB[gender] = new GameDBD();
	$DB[gender]->connect("gender");
	$DB[cultivations] = new GameDBD();
	$DB[cultivations]->connect("cultivations");
	$DB[occupations] = new GameDBD();
	$DB[occupations]->connect("occupations");
	$role = $RoleInfo;
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
				links=>'__value__ AeraCoin <form method=post action="?op=accounts&type=ClaimUCA"><input type=submit name=opchk value="Claim Now!"><input type=hidden name=rid value="__roleid__"></form>'
			),
			online2=>array(
				name=>"Status",
				allowsort=>true,
				sortlink=>$sortlink,
				links=>'<a href="http://www.perfectworld.my/gamemap/?postype=1&posvalue=__roleid__"><img src="images/status/__value__.gif"/></a>'
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

<?php } ?>
</center>