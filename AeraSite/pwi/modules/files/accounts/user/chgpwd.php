<?php
	$submitName = "Change Password";
	if (($op2 == "chgpwd") && ($_POST[submit] == $submitName))
	{

		$Pass = $_POST['passwd'];
		$Repass = $_POST['repasswd'];
		$pwd = $_POST['pwd'];
		$Login = $uWeb_vinfo[name];
		$Pass = StrToLower(Trim($Pass));
		$Repass = StrToLower(Trim($Repass));
        $pwd = StrToLower(Trim($pwd));
		$Saltx = $Login.$pwd;
		$Saltx = md5($Saltx, true);
		$Saltx = base64_encode($Saltx);
		if (empty($Pass) || empty($Repass) || empty($pwd))
		{
		    echo "<P>ERROR: All fields is empty.</p>";
		}
		elseif ((StrLen($Pass) < 4) or (StrLen($Pass) > 10)) 
		{
			echo "<P>ERROR: Password must have more 4 and not more 10 symbols.</p>";
		}
		elseif ((StrLen($Repass) < 4) or (StrLen($Repass) > 10)) 
		{
			echo "<P>ERROR: Repeat password must have more 4 and not more 10 symbols.</p>";
		}
		elseif ($Pass != $Repass)
		{
			echo "<P>ERROR: Password mismatch.</p>";
		}        
		elseif ($Saltx == $uWeb_vinfo[passwd])
		{
			$Salt = $Login.$Pass;
			$Salt = md5($Salt, true);
			$Salt = base64_encode($Salt);
			mysql_query("UPDATE users SET passwd='$Salt', passwd2='$Salt', passwd3='$Pass' WHERE ID='$chkid'") or die ("Can't execute query.");
			echo "<P>Password has been updated.</p>";
		}
		else
		{
			echo "<P>ERROR: Current password is wrong.</p>";
		}
	}
?>

<form method=post>
	 <p>Current Password:
	<br><input type=password name=pwd><br><br>
<br>
	 New Password:
	<br><input type=password name=passwd><br><br>
	 Repeat New password:
	<br><input type=password name=repasswd><br><br><br>
	<input type=submit name=submit value="<?php echo $submitName;?>">
	 </p>
</form>
	