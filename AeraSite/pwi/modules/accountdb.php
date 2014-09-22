<?php
	// 0 = Not Logged in
	// 1 = Unexisted user - unknown user
	// 2 = Unexisted user - fail auth
	// 3 = Invalid auth
	// 5 = Logged in
	$cookieidDetail = 0;
	$cookieExpiry = 3600*24; //expired in 1 day

	// EOF

	function reAuthcode($uid, $auth)
	{
		return substr(md5(time().$uid.$auth),0,20);
	}
	if (isset($cookieAuthID) && ($cookieAuthID >= 16) && ($serverUp))
	{
		//die("ID=$cookieAuthID AND authcode='$cookieAuth'");
		$userQuery = mysql_query("SELECT * FROM users WHERE (ID=$cookieAuthID) LIMIT 0,1");
		//$userQuery = mysql_query("SELECT * FROM users WHERE (ID=$cookieAuthID AND authcode = '$cookieAuth') LIMIT 0,1");
		if ($userQuery)
		{
			$userRow = mysql_fetch_array($userQuery);
			if ($userRow)
			{
				if ($cookieAuth == $userRow["authcode"])
				{
					//die("ID=$cookieAuthID AND authcode='$cookieAuth' - auth:".$userRow['authcode']);
					$userWebID=5;
					//$userRow['authcode'] = reAuthcode($userRow['ID'], $userRow['authcode']);
					$chkid = $userRow["ID"];
					$uWeb_vinfo = $userRow;
					include "modules/ipexception.php";
					$userIPcountry = getipdb($chkiplong);
					$usercountry = strtolower($userIPcountry[country2]);
                    mysql_query("UPDATE users SET ipaddr='$chkip', iplong='$chkiplong', ipcountry='$usercountry' WHERE ID='".$userRow['ID']."'");
                    //mysql_query("UPDATE users SET authcode='".$userRow['authcode']."', ipaddr='$chkip', iplong='$chkiplong', ipcountry='$usercountry' WHERE ID='".$userRow['ID']."'");
					setcookie($cookienameID,$userRow['ID'], time()+$cookieExpiry);
					setcookie($cookienameAuth,$userRow['authcode'], time()+$cookieExpiry);
					//echo "AUTHCODE: ".$userRow['authcode'];
					//$_SESSION[$cookienameID] = $userRow['ID'];
					//$_SESSION[$cookienameAuth] = $userRow['authcode'];
					$gmuser = isgm($userRow["ID"]);
				}
				else
				{
					setcookie($cookienameID, "", time()-3600);
					setcookie($cookienameAuth,"", time()-3600);
					//$_SESSION[$cookienameID] = 0;
					//$_SESSION[$cookienameAuth] = 0;
					$userWebID=3;
				}
			}
		}
		else
		{
			setcookie($cookienameID, "", time()-3600);
			setcookie($cookienameAuth,"", time()-3600);
			//$_SESSION[$cookienameID] = 0;
			//$_SESSION[$cookienameAuth] = 0;
			$userWebID=1;
		}
	}	
	else if (isset($_POST['login']) && ($serverUp))
	{
		setcookie($cookienameID, "", time()-3600);
		setcookie($cookienameAuth,"", time()-3600);
		//$_SESSION[$cookienameID] = 0;
		//$_SESSION[$cookienameAuth] = 0;
		$Login = str_replace("PWAT","",$_POST['login']);
		$pwd = $_POST['pwd'];
		//$Login = StrToLower(Trim($Login));
		//$pwd = Trim($pwd);
        $Login = StrToLower(Trim($Login));
        $pwd = StrToLower(Trim($pwd));
				
		$Saltx = $Login.$pwd;
		//$Saltx = md5($Saltx);
		//$Saltx = "0x".$Saltx;
		$Saltx = md5($Saltx, true);
		$Saltx = base64_encode($Saltx);

		if (empty($Login) || empty($pwd))
		{
			$uWeb_accountdbmsg = " - All fields is empty.";
		}
		else if ($userRow = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE (name='$Login' OR realuname='$Login') AND passwd='$Saltx' LIMIT 0,1")))
		{
			if ((StrLen($Login) < 3) or (StrLen($Login) > 15))
			{
				$uWeb_accountdbmsg = " - Login must have more 4 and not more 10 symbols.";
			}
			else if ((StrLen($pwd) < 4) or (StrLen($pwd) > 15)) 
			{
				$uWeb_accountdbmsg = " - Password must have more 4 and not more 10 symbols.";
			}
			else if ((StrLen($pwd) < 4) or (StrLen($pwd) > 15))
			{
				$uWeb_accountdbmsg = " - Repeat password must have more 4 and not more 10 symbols.";
			}
			/*else if ($userRow["chardbupdate"] >= 2)
			{
				$uWeb_accountdbmsg = " - Your Aerapoint Transaction still under progress. Please wait for 5-10 minutes to re-login this system or/and in-game.";
			}*/
			else if ($userRow["locked"] >= 1)
			{
				$uWeb_accountdbmsg = " - Your account is currently locked due Beta 3 Maintainance. Please come back on 8 July 2012. Sorry for your inconvenience.";
			}
			/*else if ($userRow["regsuccess"] == 0)
			{
				$uWeb_accountdbmsg = " - Please validate your account first via your registered email (".$userRow[email].") before proceed to this website or game.";
			}*/
			else if ($userRow["ID"] >= 16)
			{		

				$userWebID=5;
				$userRow['authcode'] = reAuthcode($userRow['ID'], $userRow['authcode']);
				include "modules/ipexception.php";
				$userIPcountry = getipdb($chkiplong);
				$usercountry = strtolower($userIPcountry[country2]);
				$accdbsql = "UPDATE users SET authcode='".$userRow['authcode']."', ipaddr='$chkip', iplong='$chkiplong', ipcountry='$usercountry' WHERE ID='".$userRow['ID']."'";
				$accdbchk = mysql_query($accdbsql);
				if ($accdbchk)
				{
					$chkid = $userRow["ID"];
					$uWeb_vinfo = $userRow;
					setcookie("$cookienameID",$userRow['ID'], time()+$cookieExpiry);
					setcookie("$cookienameAuth",$userRow['authcode'], time()+$cookieExpiry);
					//$_SESSION[$cookienameID] = $userRow['ID'];
					//$_SESSION[$cookienameAuth] = $userRow['authcode'];
					$gmuser = isgm($userRow["ID"]);
				}
				else
				{
					$userWebID=6;
					//die("TEST".$userRow["ID"]);
				}
			}
			else
			{
				$userWebID=4;
				//die("TEST".$userRow["ID"]);
			}
		}
	}
	include "modules/files/accounts/user/logout.php";
?>