<?php
$msgoutput = "";
	if ($serverUp)
	{
?>

	<?php //=====Script by trash=====//  //=====For MySQL Database=====//

	

if (strlen($_REQUEST[authid]) >= 32)
{
	if ($_POST['fastreg'] == 0)
	{
		$_POST['login'] = NULL;
		unset($_POST['login']);
		$msgoutput = "Fail to register, you have not agree our term and condition. To successfully get registered, make sure you are AGREE with our term and condition.";
		$noerror = 0;
	}
}
if (isset($_POST['login']))
	{

			$Login = $_POST['login'];
			$Pass = $_POST['passwd'];
			$Repass = $_POST['repasswd'];
			$Email = $_POST['email'];
			$pos0 = $_POST['pos0']; //fname
			$pos1 = $_POST['pos1']; //lname
			$pos2 = $_POST['pos2']; //idnumber
			$pos3 = $_POST['pos3']; //phonenumber
			$pos4 = $_POST['pos4']; //mobilenumber
			$pos5 = $_POST['pos5']; //city
			$pos6 = $_POST['pos6']; //state
			$pos7 = $_POST['pos7']; //postalcode
			$pos8 = $_POST['pos8']; //country/province
			$pos9 = $_POST['pos9']; //dob-day
			$pos10 = $_POST['pos10']; //dob-month
			$pos11 = $_POST['pos11']; //dob-year
			if (empty($_POST['pos12'])) //mentorid
				$pos12 = 0;
			else
				$pos12 = $_POST['pos12'];
			if ($_POST['pos13'])
				$pos13 = $_POST['pos13']; //gender 0=male , 1=female
			else
				$pos13 = 0;
			
			if ($_POST[fastreg])
			{
				$reserved = "Reserved";
				$pos0 = $reserved; //fname
				$pos1 = $reserved; //lname
				$pos2 = time(); //idnumber
				$pos3 = time(); //phonenumber
				$pos4 = time(); //mobilenumber
				$pos5 = $reserved; //city
				$pos6 = $reserved; //state
				$pos7 = $reserved; //postalcode
				$pos8 = $reserved; //country/province
				$pos9 = 1; //dob-day
				$pos10 = 1; //dob-month
				$pos11 = 1930; //dob-year
				$pos12 = 0; //Metor
				$pos13 = 0; //gender 0=male , 1=female
			}
			$Login = StrToLower(Trim($Login));
			$Pass = StrToLower(Trim($Pass));
			$Repass = StrToLower(Trim($Repass));
			$Email = Trim($Email);
	
        if (empty($Login) || empty($Pass) || empty($Repass) || empty($Email) || empty($pos0) || empty($pos1) || empty($pos2) || empty($pos3) || empty($pos4) || empty($pos5) || empty($pos6) || empty($pos7) || empty($pos8) || empty($pos9) || empty($pos10) || empty($pos11))
            {
                $msgoutput .= "ERROR: Failed to register. All/certain fields is empty.";
            }
        elseif (StrPos('\'', $Email))
            {
                $msgoutput .=  "ERROR: Failed to register. Email have a incorrect format.";    
            }    
        		elseif (@mysql_num_rows(MySQL_Query("SELECT name FROM users WHERE name='$Login' OR realuname='$Login' OR backupname='$Login'")))
				{
					$msgoutput .=  "ERROR: Failed to register. Username <b>".$Login."</b> is exists - username in our system. Please choose another username instead of using ".$Login;
				}
				elseif (@mysql_num_rows(MySQL_Query("SELECT name FROM users WHERE email='$Email'")))
				{
					$msgoutput .=  "ERROR: Failed to register. Email <b>".$Email."</b> is exists in our system- email. Please choose another email instead of using ".$Email;
				}
				elseif (@mysql_num_rows(MySQL_Query("SELECT name FROM users WHERE idnumber='$pos2'")))
				{
					$msgoutput .=  "ERROR: Failed to register. ID number <b>".$pos2."</b> is exists - ID Number in our system. Please choose another ID/IC Number instead of using ".$pos2;
				}
			
			elseif ((StrLen($Login) < 4) or (StrLen($Login) > 14)) 
			
				{
					$msgoutput .=  "ERROR: Failed to register. Username must have more 4 and not more 14 symbols.";
				}
				
			elseif ((StrLen($Pass) < 6) or (StrLen($Pass) > 14)) 
			
				{
					$msgoutput .=  "ERROR: Failed to register. Password must have more 6 and not more 14 symbols.";
				}
				
			elseif ((StrLen($Repass) < 6) or (StrLen($Repass) > 14)) 
				{
					$msgoutput .=  "ERROR: Failed to register. Repeat password must have more 6 and not more 14 symbols.";
				}
				
			elseif ((StrLen($Email) < 4) or (StrLen($Email) > 100)) 
				{
					$msgoutput .=  "ERROR: Failed to register. Email must have more 4 and not more 100 symbols.";
				}
			
			elseif ($Pass != $Repass)
				{
					$msgoutput .=  "ERROR: Failed to register. Password mismatch.";
				}        
			else
				{
					$noerror = 1;
					if (isset($pos12) && ($pos12 >= 33))
					{
						if (@mysql_num_rows(MySQL_Query("SELECT name FROM users WHERE ID='$pos12'")))
						{
							if (@mysql_num_rows(MySQL_Query("SELECT name FROM users WHERE mentorid='$pos12'")) >= 5)
							{
								$noerror = 0;
								$errormsg = "Your mentor/promoter ID already reach his/her limits. Please use another limit.";
							}
							else
								$noerror = 1;
						}
						else
						{
							$noerror = 0;
							$errormsg = "Your mentor/promoter ID is invalid. Please try again later or register without the promoter id.";
						}
					}
					else
						$pos12 = 0;
					if ($noerror)
					{
						
						$Salt = StrToLower(Trim($Login)).StrToLower(Trim($Pass));
						$Salt = md5($Salt, true);
						$Salt = base64_encode($Salt);
						$uWeb_validatecode = md5($Login.$Pass.time());
						mysql_query("call adduser('$Login', '$Salt', '0', '0', '0', '$pos2', '$Email', '$pos4', '$pos8', '$pos5', '$pos3', '0', '$pos7', '$pos13', now(), '', '$Salt', '$Pass', '$pos0', '$pos1', '$pos6', '$pos9', '$pos10', '$pos11', '$pos12', '$Login', '$uWeb_validatecode');") or die ("Can't execute query.");
						//mysql_query("call adduser('PWAT$Login', '$Salt', '0', '0', '0', '$pos2', '$Email', '$pos4', '$pos8', '$pos5', '$pos3', '0', '$pos7', '$pos13', now(), '', '$Salt', '$Pass', '$pos0', '$pos1', '$pos6', '$pos9', '$pos10', '$pos11', '$pos12', '$Login', '$uWeb_validatecode');") or die ("Can't execute query.");
						$uWeb_mailto = $Email;
						$uWeb_mailfrom = "support@".$emailHost; //sender 
						$uWeb_mailhead = "PWAera Registration System <support@".$emailHost.">";
						$subject = 'Validating PWAera Account';
$message = 'Thank you for registering and supporting Perfect World:Aera Malaysia (EuBo) 2012 edition. Please validate your account '. $_POST[fname] .' '.$_POST[lname] .' (username '. $Login.') by clicking here at http://www.perfectworld.com.my/?op=accounts&type=validate&auth='.$uWeb_validatecode.' '. "\r\n" .''. "\r\n" .''. "\r\n" .'Your username is: '.$Login.' '. "\r\n" .' Your validate code is: '.$uWeb_validatecode.' '. "\r\n" .''. "\r\n" .' More info, visit http://www.perfectworld.com.my/ for more information, for forum visit http://forum.perfectworld.com.my/';
						include "modules/mailer.php";
						$msgoutput = "Account <b>".$Login."</b> has been registered. Please check your email address $Email to validate your account.";
						for ($numadd = 0; $numadd < 16; $numadd++)
						{
							$tempadduweb = mysql_query("INSERT INTO uwebplayers (updated) VALUES (0)");
						}
					}
					else
					{
						echo "ERROR: $errormsg";
						if ($_POST[fastreg])
						{
							$msgoutput = "ERROR: ".$errormsg;
						}
					}
				}
	}

	
?>
	<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
	<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
	
<?php
if (strlen($msgoutput) >= 1)
{
	echo $msgoutput;
	echo "<script>alert('".strip_tags($msgoutput)."');</script>";
	if ($noerror == 0)
	{
		echo '<meta http-equiv="Refresh" content="0; url=/">';
	}
}
else
{
?>


 <form method=post>
  <table width="80%" border="0">
    <tr>
      <td colspan="2" valign="top"><strong>CONTACT INFORMATIONS</strong></td>
    </tr>
    <tr>
      <td width="30%" align="right" valign="top">First Name :</td>
      <td width="70%" valign="top"><span id="sprytextfield1">
        <input type="text" name="pos0" id="pos0" />
        <span class="textfieldRequiredMsg">A value for first name is required.</span></span>
        (ie: STEFANIE)</td>
    </tr>
    <tr>
      <td width="30%" align="right" valign="top">Last Name :</td>
      <td width="70%" valign="top"><span id="sprytextfield2">
        <input type="text" name="pos1" id="pos1" />
        <span class="textfieldRequiredMsg">A value for last name is required.</span></span>
        (ie: SAMUEL)</td>
    </tr>
    <tr>
      <td width="30%" align="right" valign="top">Identification Card Number :</td>
      <td width="70%" valign="top"><span id="sprytextfield3">
        <input type="text" name="pos2" id="pos2" />
        <span class="textfieldRequiredMsg">A value for IC number is required.</span></span>
        (ie: 881913-13-1234)</td>
    </tr>
    <tr>
      <td width="30%" align="right" valign="top">Phone Number (home):</td>
      <td width="70%" valign="top"><span id="sprytextfield4">
        <input type="text" name="pos3" id="pos3" />
        <span class="textfieldRequiredMsg">A value for home phone number is required.</span></span>
        (ie: +69123456789)</td>
    </tr>
    <tr>
      <td align="right" valign="top">Phone Number (mobile):</td>
      <td valign="top"><span id="sprytextfield5">
        <input type="text" name="pos4" id="pos4" />
        <span class="textfieldRequiredMsg">A value is for mobile phone number required.</span></span>
        (ie: +601234567890)</td>
    </tr>
    <tr>
      <td align="right" valign="top">Gender :</td>
      <td valign="top"><label for="pos12"></label>
        <select name="pos13" id="pos13">
          <option value="0" selected="selected">MALE</option>
          <option value="1">FEMALE</option>
        </select>
        (ie: Male)</td>
    </tr>
    <tr>
      <td align="right" valign="top">City :</td>
      <td valign="top"><span id="sprytextfield6">
        <input type="text" name="pos5" id="pos5" />
        <span class="textfieldRequiredMsg">A value for city is required.</span></span>
        (ie: SELAYANG)</td>
    </tr>
    <tr>
      <td align="right" valign="top">State :</td>
      <td valign="top"><span id="sprytextfield7">
        <input type="text" name="pos6" id="pos6" />
        <span class="textfieldRequiredMsg">A value for state is required.</span></span>
        (ie: SELANGOR)</td>
    </tr>
    <tr>
      <td align="right" valign="top">Postal Code :</td>
      <td valign="top"><span id="sprytextfield8">
        <input type="text" name="pos7" id="pos7" />
        <span class="textfieldRequiredMsg">A value for postal code is required.</span></span>
        (ie: 12345)</td>
    </tr>
    <tr>
      <td align="right" valign="top">Country :</td>
      <td valign="top"><select name=pos8><option value=blank  selected>Select One</option>
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
	<option my selected >Malaysia</option>
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
	<option zw >Zimbabwe</option></select></td>
    </tr>
    <tr>
      <td align="right" valign="top">Date of Birth :</td>
      <td valign="top"><select name="pos9" id="pos9">
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
        <option>31</option>
      </select>
        /
        <select name="pos10" id="pos10">
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
        </select>
        /
        <select name="pos11" id="pos11">
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
          <option>2005</option>
          <option>2006</option>
          <option>2007</option>
        </select>
        (day/month/year)</td>
    </tr>
    <tr>
      <td width="30%" align="right" valign="top">&nbsp;</td>
      <td width="70%" valign="top">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2" valign="top"><strong>ACCOUNT INFORMATIONS</strong></td>
    </tr>
    <tr>
      <td width="30%" align="right" valign="top">Username :</td>
      <td width="70%" valign="top"><span id="sprytextfield9">
        <input type="text" name="login" value="<?php echo $_POST["login"];?>" />
        <span class="textfieldRequiredMsg">A value for username is required.</span></span>
        (ie: myname)</td>
    </tr>
    <tr>
      <td width="30%" align="right" valign="top">E-Mail address :</td>
      <td width="70%" valign="top"><span id="sprytextfield10">
      <input type="text" name="email" />
      <span class="textfieldRequiredMsg">A value for email is required.</span><span class="textfieldInvalidFormatMsg">Invalid format for email address.</span></span>
        (ie: myname@myemail.com)<BR /><i>NOTES: Please make sure your email is valid and active so that you can validate your PWAera account once you have completed your registeration.</i></td>
    </tr>
    <tr>
      <td width="30%" align="right" valign="top">Password :</td>
      <td width="70%" valign="top"><span id="sprytextfield11">
        <input type="password" name="passwd" />
        <span class="textfieldRequiredMsg">A value for password is required.</span></span>
        (ie: Abcd1234)</td>
    </tr>
    <tr>
      <td width="30%" align="right" valign="top">Prompt Password :</td>
      <td width="70%" valign="top"><span id="sprytextfield12">
        <input type="password" name="repasswd" />
        <span class="textfieldRequiredMsg">A value for prompt password is required.</span></span>
        (ie: Abcd1234)</td>
    </tr>
    <tr>
      <td align="right" valign="top">Your Mentor/Promoter ID</td>
      <td valign="top"><p>
        <input type="text" name="pos12" id="pos12" />
        (ie: 123456)<BR />
        <em>NOTES: * Leave blank the &quot;Promoter ID&quot; if no one promote you this game</em></p></td>
    </tr>
    <tr>
      <td align="right" valign="top">&nbsp;</td>
      <td valign="top"><p>&nbsp;</p>
        <p>
          <input type="submit" name="submit" value="Register" />
        </p></td>
    </tr>
  </table></form>
  
<?php
		}
	}
	else
	{
		maintainance();
	}
?>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4");
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5");
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6");
var sprytextfield7 = new Spry.Widget.ValidationTextField("sprytextfield7");
var sprytextfield8 = new Spry.Widget.ValidationTextField("sprytextfield8");
var sprytextfield9 = new Spry.Widget.ValidationTextField("sprytextfield9");
var sprytextfield10 = new Spry.Widget.ValidationTextField("sprytextfield10", "email");
var sprytextfield11 = new Spry.Widget.ValidationTextField("sprytextfield11");
var sprytextfield12 = new Spry.Widget.ValidationTextField("sprytextfield12");
</script>
	