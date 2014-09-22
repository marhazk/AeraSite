<?php
	if (($_POST[opchk] == "Save") || ($_POST[opchk] == "Validate and Save"))
	{
		//http://www.perfectworld.my/?op=
		//$_POST[addr] = str_replace("http://www.perfectworld.my/?op=","",$_POST[addr]);
		
		$chkValq1 = mysql_query("SELECT * FROM users WHERE email='".$_POST[email]."' AND ID!=$chkid");
		$chkValq2 = mysql_query("SELECT * FROM users WHERE idnumber='".$_POST[idnumber]."' AND ID!=$chkid");
		if (mysql_num_rows($chkValq1))
		{
			echo "<P>ERROR: The email ".$_POST[email]." is reserved or already validated or already existed in our system. Please choose another valid email address.</p>";
		}
		else if (mysql_num_rows($chkValq2))
		{
			echo "<P>ERROR: The ID number ".$_POST[idnumber]." is reserved or already validated or already existed in our system. Please choose another valid ID Number (IC number).</p>";
		}
		else
		{
			$wmgrtime = time();
			$uWeb_validatecode = md5($uWeb_vinfo[name].$uWeb_vinfo[ID].time());
			$wmgrsql = "UPDATE users SET";
			if ($uWeb_vinfo[regsuccess] == 2)
			{
				$wmgrsql .= " email='".$_POST[email]."',";
				$wmgrsql .= " regcode='".$uWeb_validatecode."',";
			}
			$wmgrsql .= " Prompt='".$_POST[Prompt]."',";
			$wmgrsql .= " answer='".$_POST[answer]."',";
			$wmgrsql .= " idnumber='".$_POST[idnumber]."',";
			$wmgrsql .= " mobilenumber='".$_POST[mobilenumber]."',";
			$wmgrsql .= " phonenumber='".$_POST[phonenumber]."',";
			$wmgrsql .= " address='".$_POST[address]."',";
			$wmgrsql .= " state='".$_POST[state]."',";
			$wmgrsql .= " city='".$_POST[city]."',";
			$wmgrsql .= " postalcode='".$_POST[postalcode]."',";
			$wmgrsql .= " province='".$_POST[province]."',";
			$wmgrsql .= " fname='".$_POST[fname]."',";
			$wmgrsql .= " lname='".$_POST[lname]."',";
			$wmgrsql .= " dobday='".$_POST[dobday]."',";
			$wmgrsql .= " dobmonth='".$_POST[dobmonth]."',";
			$wmgrsql .= " dobyear='".$_POST[dobyear]."',";
			$wmgrsql .= " forumuname='".$_POST[forumuname]."',";
			$wmgrsql .= " forumemail='".$_POST[forumemail]."',";
			$wmgrsql .= " forumroleid='".$_POST[forumroleid]."'";
			$wmgrsql .= " WHERE id='".$chkid."'";
			$wmgr = mysql_query($wmgrsql);
			if ($wmgr)
			{
				$uWeb_vinfo = getuserdb("ID", $uWeb_vinfo[ID]);
				if ($uWeb_vinfo[regsuccess] == 2)
				{
					$uWeb_mailto = $uWeb_vinfo[email];
					$uWeb_mailfrom = "support@perfectworld.my"; //sender 
					$uWeb_mailhead = "PWAera Validation System <support@perfectworld.my>";
					$subject = 'Validating PWAera Account';
	$message = 'Thank you for registering and supporting Perfect World:Aera Malaysia (EuBo) 2012 edition. Please validate your account '. $_POST[fname] .' '.$_POST[lname] .' (username '. $uWeb_vinfo[name].') by clicking here at http://www.perfectworld.my/?op=accounts&type=validate&auth='.$uWeb_validatecode.' '. "\r\n" .''. "\r\n" .''. "\r\n" .'Your username is: '.$uWeb_vinfo[name].' '. "\r\n" .' Your validate code is: '.$uWeb_validatecode.' '. "\r\n" .''. "\r\n" .' More info, visit http://www.perfectworld.my/ for more information, for forum visit http://forum.perfectworld.my/';
					include "modules/mailer.php";
					echo "<p>Successfully saved. Please validate your account via your email ($uWeb_mailto) to get a free Aerapoint.</p>";
				}
				else
					echo "<p>Successfully saved.</p>";
	
			}
			else
				echo "<p>Fail to saved. Please fill all forms correctly.</p>";
		}
	}
	$_POST = getuserdb("ID", $uWeb_vinfo[ID]);
	if ($_POST[forumroleid] >= 32)
	{
		$roledetail = getroledb("roleid", $_POST[forumroleid]); 
		$_POST["forumrolename"] = $roledetail["rolename"];
	}
	else
		$_POST["forumrolename"] = "N/A";
?>

<form name="form1" method="post">
  <table width="100%" border="0">
    <tr>
      <td colspan="2" align="left" valign="top"> <strong>PLAYER INFORMATION</strong></td>
    </tr>
    <tr>
      <td align="right" valign="top"> First Name :</td>
      <td align="left" valign="top"><input name="fname" type="text" id="linkname23" value="<?php echo $_POST[fname];?>" size="50" /></td>
    </tr>
    <tr>
      <td align="right" valign="top"> Last Name :</td>
      <td align="left" valign="top"><input name="lname" type="text" id="linkname22" value="<?php echo $_POST[lname];?>" size="50" /></td>
    </tr>
    <tr>
      <td align="right" valign="top">Email : </td>
      <td align="left" valign="top"><?php if ($uWeb_vinfo[regsuccess] == 2) { ?><label for="title3"></label>
        <input name="email" type="text" id="title3" value="<?php echo $_POST[email];?>" size="50" /><?php } else { echo $_POST[email]; }?></td>
    </tr>
    <tr>
      <td align="right" valign="top"> Date of Birth :</td>
      <td align="left" valign="top"><select name=dobday id=dd class= tabindex=4>
	<option selected><?php echo $_POST[dobday];?></option>
	<option value=blank>- Day -</option>
	<option>1</option>
	<option>2</option>
	<option>3</option>
	<option>4</option>
	<option>5</option>
	<option>6</option>
	<option>7</option>
	<option>8</option>
	<option>9</option>
	<option>10</option>
	<option>11</option>
	<option>12</option>
	<option>13</option>
	<option>14</option>
	<option>15</option>
	<option>16</option>
	<option>17</option>
	<option>18</option>
	<option>19</option>
	<option>20</option>
	<option>21</option>
	<option>22</option>
	<option>23</option>
	<option>24</option>
	<option>25</option>
	<option>26</option>
	<option>27</option>
	<option>28</option>
	<option>29</option>
	<option>30</option>
	<option>31</option></select>
        /
        <select name=dobmonth id=mm class= tabindex=4>
	<option value=<?php echo $_POST[dobmonth];?> selected><?php echo $_POST[dobmonth];?></option>
	<option>- Month -</option>
	<option value=1>January</option>
	<option value=2>February</option>
	<option value=3>March</option>
	<option value=4>April</option>
	<option value=5>May</option>
	<option value=6>June</option>
	<option value=7>July</option>
	<option value=8>August</option>
	<option value=9>September</option>
	<option value=10>October</option>
	<option value=11>November</option>
	<option value=12>December</option></select>
        /
        <select name=dobyear id=dd class= tabindex=4>
	<option value=<?php echo $_POST[dobyear];?> selected><?php echo $_POST[dobyear];?></option>
	<option value=blank >- Year -</option>
	<option>1971</option>
	<option>1972</option>
	<option>1973</option>
	<option>1974</option>
	<option>1975</option>
	<option>1976</option>
	<option>1977</option>
	<option>1978</option>
	<option>1979</option>
	<option>1980</option>
	<option>1981</option>
	<option>1982</option>
	<option>1983</option>
	<option>1984</option>
	<option>1985</option>
	<option>1986</option>
	<option>1987</option>
	<option>1988</option>
	<option>1989</option>
	<option>1990</option>
	<option>1991</option>
	<option>1992</option>
	<option>1993</option>
	<option>1994</option>
	<option>1995</option>
	<option>1996</option>
	<option>1997</option>
	<option>1998</option>
	<option>1999</option>
	<option>2000</option>
	<option>2001</option>
	<option>2002</option>
	<option>2003</option>
	<option>2004</option>
	<option>2005</option></select>
        (dd/mm/yyyy)</td>
    </tr>
    <tr>
      <td align="right" valign="top"> Prompt (Sec. Question):</td>
      <td align="left" valign="top"><input name="Prompt" type="text" id="linkname6" value="<?php echo $_POST[Prompt];?>" size="50" /></td>
    </tr>
    <tr>
      <td align="right" valign="top"> Answer (Sec. Answer):</td>
      <td align="left" valign="top"><input name="answer" type="text" id="linkname5" value="<?php echo $_POST[answer];?>" size="50" /></td>
    </tr>
    <tr>
      <td align="right" valign="top"> Identification Number :</td>
      <td align="left" valign="top"><input name="idnumber" type="text" id="linkname14" value="<?php echo $_POST[idnumber];?>" size="50" /></td>
    </tr>
    <tr>
      <td align="right" valign="top"> Mobile Number :</td>
      <td align="left" valign="top"><input name="mobilenumber" type="text" id="linkname13" value="<?php echo $_POST[mobilenumber];?>" size="50" /></td>
    </tr>
    <tr>
      <td align="right" valign="top"> Phone Number :</td>
      <td align="left" valign="top"><input name="phonenumber" type="text" id="linkname12" value="<?php echo $_POST[phonenumber];?>" size="50" /></td>
    </tr>
    <tr>
      <td align="right" valign="top"> Address :</td>
      <td align="left" valign="top"><input name="address" type="text" id="linkname11" value="<?php echo $_POST[address];?>" size="50" /></td>
    </tr>
    <tr>
      <td align="right" valign="top"> City :</td>
      <td align="left" valign="top"><input name="city" type="text" id="linkname10" value="<?php echo $_POST[city];?>" size="50" /></td>
    </tr>
    <tr>
      <td align="right" valign="top"> State :</td>
      <td align="left" valign="top"><input name="state" type="text" id="linkname9" value="<?php echo $_POST[state];?>" size="50" /></td>
    </tr>
    <tr>
      <td align="right" valign="top"> Postal Code:</td>
      <td align="left" valign="top"><input name="postalcode" type="text" id="linkname4" value="<?php echo $_POST[postalcode];?>" size="50" /></td>
    </tr>
    <tr>
      <td align="right" valign="top"> Province/Country:</td>
      <td align="left" valign="top"><p>
        <select name="province" id="select">
<option selected><?php echo $_POST[province];?></option>
<option ="" >-</option>
	<option af >Afghanistan</option>

	<option ax >Aland Islands</option>
	<option al >Albania</option>
	<option dz >Algeria</option>
	<option as >American Samoa</option>
	<option ad >Andorra</option>
	<option ao >Angola</option>

	<option ai >Anguilla</option>
	<option aq >Antarctica</option>
	<option ag >Antigua and Barbuda</option>
	<option ar >Argentina</option>
	<option am >Armenia</option>
	<option aw >Aruba</option>

	<option au >Australia</option>
	<option at >Austria</option>
	<option az >Azerbaijan</option>
	<option bs >Bahamas</option>
	<option bh >Bahrain</option>
	<option bd >Bangladesh</option>

	<option bb >Barbados</option>
	<option by >Belarus</option>
	<option be >Belgium</option>
	<option bz >Belize</option>
	<option bj >Benin</option>
	<option bm >Bermuda</option>

	<option bt >Bhutan</option>
	<option bo >Bolivia</option>
	<option ba >Bosnia and Herzegovina</option>
	<option bw >Botswana</option>
	<option bv >Bouvet Island</option>
	<option br >Brazil</option>

	<option io >British Indian Ocean Territory</option>
	<option vg >British Virgin Islands</option>
	<option bn >Brunei</option>
	<option bg >Bulgaria</option>
	<option bf >Burkina Faso</option>
	<option bi >Burundi</option>

	<option kh >Cambodia</option>
	<option cm >Cameroon</option>
	<option ca >Canada</option>
	<option cv >Cape Verde</option>
	<option ky >Cayman Islands</option>
	<option cf >Central African Republic</option>

	<option td >Chad</option>
	<option cl >Chile</option>
	<option cn >China</option>
	<option cx >Christmas Island</option>
	<option cc >Cocos (Keeling) Islands</option>
	<option co >Colombia</option>

	<option km >Comoros</option>
	<option cg >Congo</option>
	<option ck >Cook Islands</option>
	<option cr >Costa Rica</option>
	<option hr >Croatia</option>
	<option cy >Cyprus</option>

	<option cz >Czech Republic</option>
	<option cd >Democratic Republic of Congo</option>
	<option dk >Denmark</option>
	<option xx >Disputed Territory</option>
	<option dj >Djibouti</option>
	<option dm >Dominica</option>

	<option do >Dominican Republic</option>
	<option tl >East Timor</option>
	<option ec >Ecuador</option>
	<option eg >Egypt</option>
	<option sv >El Salvador</option>
	<option gq >Equatorial Guinea</option>

	<option er >Eritrea</option>
	<option ee >Estonia</option>
	<option et >Ethiopia</option>
	<option fk >Falkland Islands</option>
	<option fo >Faroe Islands</option>
	<option fm >Federated States of Micronesia</option>

	<option fj >Fiji</option>
	<option fi >Finland</option>
	<option fr >France</option>
	<option gf >French Guyana</option>
	<option pf >French Polynesia</option>
	<option tf >French Southern Territories</option>

	<option ga >Gabon</option>
	<option gm >Gambia</option>
	<option ge >Georgia</option>
	<option de >Germany</option>
	<option gh >Ghana</option>
	<option gi >Gibraltar</option>

	<option gr >Greece</option>
	<option gl >Greenland</option>
	<option gd >Grenada</option>
	<option gp >Guadeloupe</option>
	<option gu >Guam</option>
	<option gt >Guatemala</option>

	<option gn >Guinea</option>
	<option gw >Guinea-Bissau</option>
	<option gy >Guyana</option>
	<option ht >Haiti</option>
	<option hm >Heard Island and Mcdonald Islands</option>
	<option hn >Honduras</option>

	<option hk >Hong Kong</option>
	<option hu >Hungary</option>
	<option is >Iceland</option>
	<option in >India</option>
	<option id >Indonesia</option>
	<option iq >Iraq</option>

	<option xe >Iraq-Saudi Arabia Neutral Zone</option>
	<option ie >Ireland</option>
	<option il >Israel</option>
	<option it >Italy</option>
	<option ci >Ivory Coast</option>
	<option jm >Jamaica</option>

	<option jp >Japan</option>
	<option jo >Jordan</option>
	<option kz >Kazakhstan</option>
	<option ke >Kenya</option>
	<option ki >Kiribati</option>
	<option kw >Kuwait</option>

	<option kg >Kyrgyzstan</option>
	<option la >Laos</option>
	<option lv >Latvia</option>
	<option lb >Lebanon</option>
	<option ls >Lesotho</option>
	<option lr >Liberia</option>

	<option ly >Libya</option>
	<option li >Liechtenstein</option>
	<option lt >Lithuania</option>
	<option lu >Luxembourg</option>
	<option mo >Macau</option>
	<option mk >Macedonia</option>

	<option mg >Madagascar</option>
	<option mw >Malawi</option>
	<option my >Malaysia</option>
	<option mv >Maldives</option>
	<option ml >Mali</option>
	<option mt >Malta</option>

	<option mh >Marshall Islands</option>
	<option mq >Martinique</option>
	<option mr >Mauritania</option>
	<option mu >Mauritius</option>
	<option yt >Mayotte</option>
	<option mx >Mexico</option>

	<option md >Moldova</option>
	<option mc >Monaco</option>
	<option mn >Mongolia</option>
	<option ms >Montserrat</option>
	<option ma >Morocco</option>
	<option mz >Mozambique</option>

	<option mm >Myanmar</option>
	<option na >Namibia</option>
	<option nr >Nauru</option>
	<option np >Nepal</option>
	<option nl >Netherlands</option>
	<option an >Netherlands Antilles</option>

	<option nc >New Caledonia</option>
	<option nz >New Zealand</option>
	<option ni >Nicaragua</option>
	<option ne >Niger</option>
	<option ng >Nigeria</option>
	<option nu >Niue</option>

	<option nf >Norfolk Island</option>
	<option kp >North Korea</option>
	<option mp >Northern Mariana Islands</option>
	<option no >Norway</option>
	<option om >Oman</option>
	<option pk >Pakistan</option>

	<option pw >Palau</option>
	<option ps >Palestinian Occupied Territories</option>
	<option pa >Panama</option>
	<option pg >Papua New Guinea</option>
	<option py >Paraguay</option>
	<option pe >Peru</option>

	<option ph >Philippines</option>
	<option pn >Pitcairn Islands</option>
	<option pl >Poland</option>
	<option pt >Portugal</option>
	<option pr >Puerto Rico</option>
	<option qa >Qatar</option>

	<option re >Reunion</option>
	<option ro >Romania</option>
	<option ru >Russia</option>
	<option rw >Rwanda</option>
	<option sh >Saint Helena and Dependencies</option>
	<option kn >Saint Kitts and Nevis</option>

	<option lc >Saint Lucia</option>
	<option pm >Saint Pierre and Miquelon</option>
	<option vc >Saint Vincent and the Grenadines</option>
	<option ws >Samoa</option>
	<option sm >San Marino</option>
	<option st >Sao Tome and Principe</option>

	<option sa >Saudi Arabia</option>
	<option sn >Senegal</option>
	<option cs >Serbia and Montenegro</option>
	<option sc >Seychelles</option>
	<option sl >Sierra Leone</option>
	<option sg >Singapore</option>

	<option sk >Slovakia</option>
	<option si >Slovenia</option>
	<option sb >Solomon Islands</option>
	<option so >Somalia</option>
	<option za >South Africa</option>
	<option gs >South Georgia and South Sandwich Islands</option>

	<option kr >South Korea</option>
	<option es >Spain</option>
	<option pi >Spratly Islands</option>
	<option lk >Sri Lanka</option>
	<option sr >Suriname</option>
	<option sj >Svalbard and Jan Mayen</option>

	<option sz >Swaziland</option>
	<option se >Sweden</option>
	<option ch >Switzerland</option>
	<option sy >Syria</option>
	<option tw >Taiwan</option>
	<option tj >Tajikistan</option>

	<option tz >Tanzania</option>
	<option th >Thailand</option>
	<option tg >Togo</option>
	<option tk >Tokelau</option>
	<option to >Tonga</option>
	<option tt >Trinidad and Tobago</option>

	<option tn >Tunisia</option>
	<option tr >Turkey</option>
	<option tm >Turkmenistan</option>
	<option tc >Turks And Caicos Islands</option>
	<option tv >Tuvalu</option>
	<option ug >Uganda</option>

	<option ua >Ukraine</option>
	<option ae >United Arab Emirates</option>
	<option uk >United Kingdom</option>
	<option xd >United Nations Neutral Zone</option>
	<option us >United States</option>
	<option um >United States Minor Outlying Islands</option>

	<option uy >Uruguay</option>
	<option vi >US Virgin Islands</option>
	<option uz >Uzbekistan</option>
	<option vu >Vanuatu</option>
	<option va >Vatican City</option>
	<option ve >Venezuela</option>

	<option vn >Vietnam</option>
	<option wf >Wallis and Futuna</option>
	<option eh >Western Sahara</option>
	<option ye >Yemen</option>
	<option zm >Zambia</option>
	<option zw >Zimbabwe</option></select>
      </p></td>
    </tr>
    <tr>
      <td align="right" valign="top"> Mentor ID :</td>
      <td align="left" valign="top"><?php echo $_POST[mentorid];?></td>
    </tr>
    <tr>
      <td align="right" colspan=2 valign="top"><HR /></td>
    </tr>
    <tr>
      <td align="right" valign="top"> Registered Forum Username :</td>
      <td align="left" valign="top"><input name="forumuname" type="text" id="linkname11" value="<?php echo $_POST[forumuname];?>" size="50" /></td>
    </tr>
    <tr>
      <td align="right" valign="top"> Registered Forum Email :</td>
      <td align="left" valign="top"><input name="forumemail" type="text" id="linkname" value="<?php echo $_POST[forumemail];?>" size="50" /></td>
    </tr>
    <tr>
      <td align="right" valign="top"> Your Main Character :</td>
      <td align="left" valign="top"><select name="forumroleid" id="select">
<option value="<?php echo $_POST[forumroleid];?>" selected><?php echo $_POST[forumrolename];?></option>
<option =0 >-</option>
<?php
$rolesql = "SELECT * FROM uwebplayers WHERE roleid>=".$_POST["ID"]." AND roleid<=".(int)($_POST["ID"]+15)." ORDER BY rolelevel DESC";
$rolequery = mysql_query($rolesql);
if ($rolequery)
{
	while ($roleinfo = mysql_fetch_array($rolequery) )
	{
?>
	<option value="<?php echo $roleinfo["roleid"];?>"><?php echo $roleinfo[rolename];?></option>
<?php
}}
?>
    </select></td>
    </tr>
    <tr>
      <td width="20%" align="right" valign="top"></td>
      <td width="80%" align="left" valign="top"><p>
      <?php if ($uWeb_vinfo[regsuccess] == 2) {?>
        <input type="submit" name="opchk" id="opchk" value="Validate and Save">
      <?php } else {?>
        <input type="submit" name="opchk" id="opchk" value="Save">
      <?php }?>
      </p></td>
    </tr>
  </table>
</form>