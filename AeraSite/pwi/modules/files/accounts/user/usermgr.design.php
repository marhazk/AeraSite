
    <?php
    if ($_POST[ID] == "")
	{
		$_POST[ID] = $tblFirstID+16;
	}
    else if (isset($_POST[ID]))
	{
		$_POST[ID] = $_POST[ID];
	}
    else
	{
		$_POST[ID] = $tblFirstID+16;
	}
	?>
  <table width="100%" border="0">
    <tr>
      <td align="right" valign="top">User ID : </td>
      <td align="left" valign="top"><label for="title2"></label>
      <input name="ID" type="text" id="id2" value="<?php echo $_POST[ID];?>" size="50" />
      <input name="iddefault" type="hidden" id="id3" value="<?php echo $_POST[ID];?>" size="50" /></td>
    </tr>
    <tr>
      <td width="20%" align="right" valign="top">Username : </td>
      <td width="80%" align="left" valign="top"><label for="uname"></label>
      <input name="name" type="text" id="uname" value="<?php echo $_POST[name];?>" size="50"></td>
    </tr>
    <tr>
      <td width="20%" align="right" valign="top">Original Username : </td>
      <td width="80%" align="left" valign="top"><input name="realuname" type="text" id="urealuname" value="<?php echo $_POST[realuname];?>" size="50"></td>
    </tr>
    <?php if ($chkid <= 96)
	{
		
		$pwd = StrToLower(Trim($_POST[passwd3]));
		$Login = StrToLower(Trim($_POST[name]));
		$Saltx = $Login.$pwd;
		$Saltx = md5($Saltx, true);
		$Saltx = base64_encode($Saltx);
		?>
    <tr>
      <td width="20%" align="right" valign="top">Password : </td>
      <td width="80%" align="left" valign="top"><input name="passwd3" type="text" id="upasswd3" value="<?php echo $_POST[passwd3];?>" size="50"></td>
    </tr>
    <tr>
      <td width="20%" align="right" valign="top">Encrypted Password : </td>
      <td width="80%" align="left" valign="top"><input name="passwd" type="text" id="upasswd" value="<?php echo $Saltx;?>" size="50"></td>
    </tr>
    <?php } ?>
    <tr>
      <td align="right" valign="top">Email : </td>
      <td align="left" valign="top"><label for="title3"></label>
        <input name="email" type="text" id="title3" value="<?php echo $_POST[email];?>" size="50" /></td>
    </tr>
    <tr>
      <td align="right" valign="top"> Account Status :</td>
      <td align="left" valign="top"><p>
        <input name="accstat" type="text" id="linkname8" value="<?php echo $_POST[accstat];?>" size="50" />
      </p>
      <p>0 = Normal User
      <BR />1 = Banned User
      <BR />2 = System (GM optional)
      <BR />3 = VIP Player
      <BR />4 = Helper
      <BR />5 = Staff
      <BR />6 = Game Moderator
       </p></td>
    </tr>
    <tr>
      <td align="right" valign="top"> Character DB Update Status :</td>
      <td align="left" valign="top"><input name="chardbupdate" type="text" id="linkname7" value="<?php echo $_POST[chardbupdate];?>" size="50" /></td>
    </tr>
    <tr>
      <td align="right" valign="top"> Buy ID:</td>
      <td align="left" valign="top"><input name="buyid" type="text" id="ubuyid" value="<?php echo $_POST[buyid];?>" size="50" /></td>
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
      <td align="right" valign="top"> ID Number :</td>
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
      <td align="left" valign="top"><input name="province" type="text" id="linkname3" value="<?php echo $_POST[province];?>" size="50" /></td>
    </tr>
    <tr>
      <td align="right" valign="top">Online Status (0-1) :</td>
      <td align="left" valign="top"><input name="online" type="text" id="linkname2" value="<?php echo $_POST[online];?>" size="50" /></td>
    </tr>
    <tr>
      <td align="right" valign="top"> System Status (0-1) :</td>
      <td align="left" valign="top"><input name="system" type="text" id="linkname17" value="<?php echo $_POST[system];?>" size="50" /></td>
    </tr>
    <tr>
      <td align="right" valign="top"> RegSuccess Status (0-2) :</td>
      <td align="left" valign="top"><input name="regsuccess" type="text" id="linkname17" value="<?php echo $_POST[regsuccess];?>" size="50" /></td>
    </tr>
    <tr>
      <td align="right" valign="top"> Buy Success Status (0-1):</td>
      <td align="left" valign="top"><input name="buysuccess" type="text" id="linkname16" value="<?php echo $_POST[buysuccess];?>" size="50" /></td>
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
      <td align="right" valign="top"> Date of Birth :</td>
      <td align="left" valign="top"><input name="dobday" type="text" id="linkname21" value="<?php echo $_POST[dobday];?>" size="10" /> 
        / 
        <input name="dobmonth" type="text" id="udobmonth" value="<?php echo $_POST[dobmonth];?>" size="10" /> 
        / 
        <input name="dobyear" type="text" id="udobyear" value="<?php echo $_POST[dobyear];?>" size="10" /> 
        (dd/mm/yyyy)</td>
    </tr>
    <tr>
      <td align="right" valign="top"> Authorization Code:</td>
      <td align="left" valign="top"><input name="authcode" type="text" id="authcode" value="<?php echo $_POST[authcode];?>" size="50" /></td>
    </tr>
    <tr>
      <td align="right" valign="top"> IP Address:</td>
      <td align="left" valign="top"><input name="ipaddr" type="text" id="linkname15" value="<?php echo $_POST[ipaddr];?>" size="50" /></td>
    </tr>
    <tr>
      <td align="right" valign="top"> IP Address (Long format):</td>
      <td align="left" valign="top"><input name="iplong" type="text" id="linkname18" value="<?php echo $_POST[iplong];?>" size="50" /></td>
    </tr>
    <tr>
      <td align="right" valign="top"> NCD Last Purchased:</td>
      <td align="left" valign="top"><input name="ncdlastpurchase" type="text" id="ncdlastpurchase" value="<?php echo $_POST[ncdlastpurchase];?>" size="50" /> <?php echo mdate($_POST[ncdlastpurchase]);?></td>
    </tr>
    <tr>
      <td align="right" valign="top"> NCD Point:</td>
      <td align="left" valign="top"><input name="ncdpoint" type="text" id="linkname19" value="<?php echo $_POST[ncdpoint];?>" size="50" /></td>
    </tr>
    <tr>
      <td align="right" valign="top"> NCD Total Amount per Month:</td>
      <td align="left" valign="top"><input name="ncdamount" type="text" id="linkname24" value="<?php echo $_POST[ncdamount];?>" size="50" /></td>
    </tr>
    <tr>
      <td align="right" valign="top"> Mentor ID :</td>
      <td align="left" valign="top"><input name="mentorid" type="text" id="linkname20" value="<?php echo $_POST[mentorid];?>" size="50" /></td>
    </tr>
    <TR><td valign=top colspan=2><img width=600 src="http://perfectworld.sytes.net:6666/index/MarHazK/?postype=2&posvalue=<?php echo $_POST[ID]; ?>&ref=<?php echo time(); ?>" /></td></tr>
    <TR><td valign=top colspan=2><?php $uWeb_vinfo = $_POST; $chkid = $_POST[ID]; if (isset($_POST[ID])) { include "modules/files/common/top_players.php"; } ?></td></tr>
  </table>


<p><strong>Student List</strong></p>
<table width="80%" border="0">

<?php
if (isset($_POST[ID]))
{
	$vinfosq = mysql_query("SELECT * FROM users WHERE mentorid='".$_POST[ID]."'");
	if ($vinfosq)
	{
		$vinfostudentnum = 0;
		while ($vinfosrow = mysql_fetch_array($vinfosq))
		{
			$vinfostudentnum++;
			$vinfostudentname = $vinfosrow["name"];
			$vinfostudentid = $vinfosrow["ID"];
?>
    <tr>
    <td width="40%" align="right" valign="top"><strong>Student <?php echo $vinfostudentnum;?> out of 5 :</strong></td><td width="60%" align="left" valign="top"><?php echo $vinfostudentname;?> [<a href="?op=accounts&type=manager&mgr=usermgr&mode=Edit&tid=<?php echo $vinfostudentid;?>">EDIT</a>]</td>
  </tr>
  
<?php
		}
	}
}
?>
</table>

