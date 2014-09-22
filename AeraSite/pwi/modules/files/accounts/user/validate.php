<?php
	if (isset($_REQUEST[email]) || isset($_POST[email]))
	{
		if (isset($_REQUEST[email]))
			$validatemail = $_REQUEST[email];
		if (isset($_POST[email]))
			$validatemail = $_POST[email];
		$validateSQL = "SELECT * FROM users WHERE email='$validatemail' LIMIT 0,1";
		$validateQ = mysql_query($validateSQL);
		if ($validateQ)
		{
			$validateRow = mysql_fetch_array($validateQ);
			if ($_REQUEST[email] == "username@email.com")
				$validateMsg = "You cannot validate this email. Please make sure you login then change your email first before asking to resending the validation code to your valid email.";
			else if ($validateRow[regsuccess] == 1)
				$validateMsg = "You already validate your account. You may login to your game to proceed.";
			else if (!isset($validateRow[email]))
				$validateMsg = "You cannot validate this email. Please make sure you login then change your email first before asking to resending the validation code to your valid email.";
			else
			{
				$uWeb_mailto = $validateRow[email];
				$uWeb_mailfrom = "support@perfectworld.my"; //sender 
				$uWeb_mailhead = "PWAera Validation System <support@perfectworld.my>";
				$subject = 'Validating PWAera Account';
				$message = 'Thank you for registering and supporting Perfect World:Aera Malaysia (EuBo) 2012 edition. Please validate your account '. $validateRow[fname] .' '.$validateRow[lname] .' (username '. str_replace("PWAT","",$validateRow[name]).') by clicking here at http://www.perfectworld.my/?op=accounts&type=validate&auth='.$validateRow[regcode].' '. "\r\n" .''. "\r\n" .''. "\r\n" .'Your username is: '.$validateRow[name].' '. "\r\n" .' Your validate code is: '.$validateRow[regcode].' '. "\r\n" .''. "\r\n" .' More info, visit http://www.perfectworld.my/ for more information, for forum visit http://forum.perfectworld.my/';
				include "modules/mailer.php";
				echo "<p>Successfully send the validation code to your email. Please validate your account via your email ($uWeb_mailto) to validated. Thank you.</p>";
			}
		}
		else
			$validateMsg = "Error to send the validatation code. Email is not exists. Please make sure you login then change your email first before asking to resending the validation code to your valid email.";
	}
	if (isset($_REQUEST[auth]))
	{
		$validatecode = $_REQUEST[auth];
		$validateSQL = "SELECT * FROM users WHERE regcode='$validatecode' LIMIT 0,1";
		$validateQ = mysql_query($validateSQL);
		if ($validateQ)
		{
			$validateRow = mysql_fetch_array($validateQ);
			if ($validateRow[regsuccess] == 1)
				$validateMsg = "You already validate your account. You may login to your game to proceed.";
			else if ($validateRow[regsuccess] == 2)
			{
				$validateSQL = "UPDATE users SET regsuccess=1, claimaeracoin=5000 locked=0 WHERE regcode='$validatecode'";
				$validateQ = mysql_query($validateSQL);
				if ($validateQ)
				{
					$uWeb_mailto = $validateRow[email];
					$uWeb_mailfrom = "support@perfectworld.my"; //sender 
					$uWeb_mailhead = "PWAera Validation System <support@perfectworld.my>";
					$subject = 'Validating PWAera Account Complete';
$message = 'Thank you for registering and supporting Perfect World:Aera Malaysia (EuBo) 2012 edition. You account has been successfully validated. '. "\r\n" .''. "\r\n" .''. "\r\n" .'Your username is: '.str_replace("PWAT","",$validateRow[name]).' '. "\r\n" .''. "\r\n" .' More info, visit http://www.perfectworld.my/ for more information, for forum visit http://forum.perfectworld.my/';
					include "modules/mailer.php";
					//$details = aerapointAddcode($null, $validateRow[ID], 5000, "X", "EMAIL VALIDATION", 0);
					//$validateMsg = "Your account has been validated and get free 50 Aerapoint Topup-Code. You may start and login to your game.";
					$validateMsg = "Your account has been validated and get free <B>50 Unclaimed Account AeraGold (UAA)</b>. You may start and login to your game.";
				}
				else
					$validateMsg = "Error to validate. Please contact administrator or report at forum about the issues.";
			}
			else
			{
				$uWeb_mailto = $validateRow[email];
				$uWeb_mailfrom = "support@perfectworld.my"; //sender 
				$uWeb_mailhead = "PWAera Validation System <support@perfectworld.my>";
				$subject = 'Validating PWAera Account Complete';
$message = 'Thank you for registering and supporting Perfect World:Aera Malaysia (EuBo) 2012 edition. '. "\r\n" .''. "\r\n" .''. "\r\n" .'Your username is: '.str_replace("PWAT","",$validateRow[name]).' '. "\r\n" .'Your Promoter ID is: '.$validateRow[ID].''. "\r\n" .''. "\r\n" .' You can invite your friends or family by giving your Promoter ID to them so that you can claim a Mentor Reward from us. More info, visit http://www.perfectworld.my/ for more information, for forum visit http://forum.perfectworld.my/';
				include "modules/mailer.php";
				$validateSQL = "UPDATE users SET name='".$validateRow[realuname]."', regsuccess=1, locked=0, claimaeracoin=5000 WHERE regcode='$validatecode'";
				//$validateSQL = "UPDATE users SET name=ID, regsuccess=1, locked=1 WHERE regcode='$validatecode'";
				$validateQ = mysql_query($validateSQL);
				if ($validateQ)
				{
					//$details = aerapointAddcode($null, $validateRow[ID], 5000, "X", "EMAIL VALIDATION", 0);
					$validateMsg = "Your account has been validated and get free <B>50 Unclaimed Account AeraGold (UAA)</b>. You may start and login to your game to proceed the character creation.";
					//$validateMsg = "Your account has been validated. You may start and login to your game to proceed the character creation.";
				}
				else
					$validateMsg = "Error to validate. Please contact administrator or report at forum about the issues.";
			}
		}
		else
			$validateMsg = "Error to validate. Invalid or unknown validation code. Please re-register your account with a valid email address.";
	}
?>

<h1><?php echo $validateMsg;?></h1>

<form name="form1" method="post" action="?op=accounts&type=validate">
  <p>Enter your Validation Code to validate your account:</p>
  <p>Validation Code :
  <input name="auth" type="text" id="auth" size="50">
  <input type="submit" name="opchk" id="opchk" value="Validate">
  <input type="reset" name="button2" id="button2" value="Reset">
  </p>
  </form>
  <form name="form1" method="post" action="?op=accounts&type=validate">
    <p>Or, resend your Validation Code to your valid email:</p>
  <p>Your valid Email :
  <input name="email" type="text" id="auth" size="50">
  <input type="submit" name="opchk" id="opchk" value="Send">
  <input type="reset" name="button2" id="button2" value="Reset">
  </p>
</form>
<p>&nbsp;</p>
