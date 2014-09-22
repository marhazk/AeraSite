<?php
	$DB[roles] = new GameDBD();
	$DB[roles]->connect("roles", "SELECT * FROM roles ORDER BY roleid ASC");
	$DB[usersX] = new GameDBD();
	$DB[usersX]->connect("users", "SELECT ID, claimaeracoin AS UAA FROM users");
	$DB[usersDB] = new GameDBD();
	$DB[usersDB]->connect("users", "SELECT ID, name FROM users ORDER BY name ASC");
	$DB[roles]->merge("userid", $DB[usersX], "ID");
	$roles = $DB[roles]->retrieve();
	$DB[roles2] = new GameDBD();
	$DB[roles2]->connect("roles", "SELECT * FROM roles ORDER BY name ASC");
	$roles2 = $DB[roles2]->retrieve();
	$userDB = $DB[usersDB]->retrieve();
	$resultQuery = "Please fill in the blank below";
	if (($_POST[opchk] == "View Info") || ($_REQUEST[rid] >= 32) || ($_REQUEST[uid] >= 32))
	{
		if ($gmuser)
		{
			if (strlen($_REQUEST[rid]) >= 2)
				$rid = $_REQUEST[rid];
			else if ($_REQUEST[rid2] >= 1)
				$rid = $_REQUEST[rid2];
			else if ($_REQUEST[rid3] >= 1)
				$rid = $_REQUEST[rid3];
			else if ($_REQUEST[rid4] >= 1)
				$rid = $_REQUEST[rid4];
			else
				$rid = $_POST[rid5];
			if (strlen($_REQUEST[uid]) >= 2)
				$uid = $_REQUEST[uid];
			else if ($_REQUEST[uid2] >= 1)
				$uid = $_REQUEST[uid2];
			else
				$uid = $_POST[uid3];
			if ($rid >= 32)
			{
				$RoleInfo = $DB[roles]->searchBy("roleid",$rid);
				$DB[users] = new GameDBD();
				$DB[users]->connect("roles", "SELECT * FROM users WHERE ID='".$RoleInfo[userid]."'");
				$DB[rolescur] = new GameDBD();
				$DB[rolescur]->connect("roles", "SELECT * FROM roles WHERE userid='".$RoleInfo[userid]."'");
				$rolescur = $DB[rolescur]->retrieve();
				$success = true;
				$successrole = true;
			}
			else if ($uid >= 32)
			{
				$RoleInfo = $DB[roles]->searchBy("userid",$uid);
				$DB[users] = new GameDBD();
				$DB[users]->connect("users", "SELECT * FROM users WHERE ID='".$RoleInfo[userid]."'");
				$DB[rolescur] = new GameDBD();
				$DB[rolescur]->connect("roles", "SELECT * FROM roles WHERE userid='".$RoleInfo[userid]."'");
				$rolescur = $DB[rolescur]->retrieve();
				$success = true;
			}
		}
		else
			$resultQuery = "You are not Game Master. Only GM is allowed to use this session.";
	}
?>
<center>
<p><?php echo $resultQuery; ?></p>
<table align="center" bgcolor="#FFFFFF" border="1" cellpadding="3" cellspacing="0" >
  <tr>
    <th colspan="4" bgcolor="#000000"><b><font color="#ffffff">Send items for a particular character:</font></b></th>
  </tr>
  <tr>
    <td width="100%" align="center"><form method="post" name="form1" id="form1">
      <table  cellpadding="0" cellspacing="0">
        <tr>
          <td width="30%"><span id="result_box" lang="en" xml:lang="en">Enter the ID of the character</span>:</td>
          <td width="70%"><input type="text" name="rid" value="" size="30" maxlength="10" class="text_field"/><BR /><select name="rid2" id="rid2">
          <option value="0">-</option>
          <?php
		  	foreach ($roles as $role)
			{
		  ?>
          <option value="<?php echo $role[roleid]?>"><?php echo $role[name]?></option>
          <?php } ?>
          </select><BR /><select name="rid3" id="rid2">
          <option value="0">-</option>
          <?php
		  	foreach ($roles2 as $role)
			{
		  ?>
          <option value="<?php echo $role[roleid]?>"><?php echo $role[name]?></option>
          <?php } ?>
          </select>
          
<?php if ($success) {?>
<BR />Related to : <?php echo $RoleInfo[name]?> (<?php echo $RoleInfo[roleid]?>)
<BR />
<select name="rid4" id="rid2">
          <option value="0">-</option>
          <?php
		  	foreach ($rolescur as $role)
			{
		  ?>
          <option value="<?php echo $role[roleid]?>"><?php echo $role[name]?></option>
          <?php } ?>
          </select>

<?php } ?>
          </td>
        </tr>
        <tr>
          <td width="30%"><span id="result_box" lang="en" xml:lang="en">Enter the ID of the Account</span>:</td>
          <td width="70%"><input type="text" name="uid" value="" size="30" maxlength="10" class="text_field" id="uid"/><BR /><select name="uid2" id="uid2">
          <option value="0">-</option>
          <?php
		  	foreach ($userDB as $user)
			{
				if ($user[ID] == $uid)
				{
		  ?>
          <option selected value="<?php echo $user[ID]?>"><?php echo $user[name]?></option>
          <?php } else { ?>
          <option value="<?php echo $user[ID]?>"><?php echo $user[name]?></option>
          <?php } } ?>
          </select></td>
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
<?php if ($success) {
	if ($successrole) {
	?>

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
<p>&nbsp; </p>
<h1>USER ACCOUNT INFORMATION</h1>
<table width="100%" bgcolor="#FFFFFF" border="1" cellpadding="3" cellspacing="0" >
<?php
	//foreach ($DB[guild]->retrieve() as $row)
	//{
	//	$num++;
	//
	$DB[users]->printRows("<tr><td width=30%>","</td><td>","</td></tr>",
		array(
			order=>"ID desc",
			displayID=>false,
			horizontal=>true,
			column=>2
		), 
		array(
			name=>"User Name",
			idnumber=>"ID Number",
			email=>"Email",
			mobilenumber=>"Mobile Number",
			province=>"Province",
			city=>"City",
			phonenumber=>"Phone Number",
			address=>"Address",
			postalcode=>"Postal Code",
			fname=>"First Name",
			lname=>"Last Name",
			state=>"State",
			ncdpoint=>"NCD Point"
		),
		array("ID","==",$role[userid]));
?>
</table>
<?php } ?>
</center>
