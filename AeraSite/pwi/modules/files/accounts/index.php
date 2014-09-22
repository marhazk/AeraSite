
<?php
	if ($serverUp)
	{
		$uWeb_chardb[epoint] = 1;
		$includeUser = 0;
		
		if ($userWebID == 5)
		{
			include "modules/files/accounts/user/topmenu.php";
			$chkid = $uWeb_vinfo[ID];
		}
		if ($op2 == "vinfo")
		{
			include "modules/files/accounts/user/vinfo.php";
		}
		else if ($op2 == "validate")
		{
			include "modules/files/accounts/user/validate.php";
		}
		else if ($op2 == "online")
		{
			include "modules/files/accounts/user/online.php";
		}
		else if ($userWebID == 5)
		{
			if ($op2 == "einfo")
			{
				include "modules/files/accounts/user/einfo.php";
				$includeUser = 0;
			}
			else if ($op2 == "characters")
			{
				include "modules/files/accounts/user/characters.php";
				$includeUser = 0;
			}
			else if ($op2 == "guilds")
			{
				include "modules/files/accounts/user/guilds.php";
				$includeUser = 0;
			}
			else if ($op2 == "photos")
			{
				include "modules/files/accounts/user/photos.php";
				$includeUser = 0;
			}
			else if ($op2 == "buy")
			{
				include "modules/files/accounts/user/buy.php";
				$includeUser = 0;
			}
			else if ($op2 == "broadcast")
			{
				include "modules/files/accounts/user/broadcast.php";
				$includeUser = 1;
			}
			else if ($op2 == "gamemap")
			{
				include "modules/files/accounts/user/gamemap.php";
				$includeUser = 1;
			}
			else if ($op2 == "chgpwd")
			{
				include "modules/files/accounts/user/chgpwd.php";
				$includeUser = 1;
			}
			else if ($op2 == "voteus")
			{
				include "modules/files/accounts/user/voteus.php";
				$includeUser = 0;
			}
			else if ($op2 == "buypoint")
			{
				include "modules/files/accounts/user/buypoint.php";
				$includeUser = 0;
			}
			else if ($op2 == "buygold")
			{
				include "modules/files/accounts/user/buygold.php";
				$includeUser = 1;
			}
			else if ($op2 == "claim")
			{
				include "modules/files/accounts/user/claim.php";
				$includeUser = 0;
			}
			else if ($op2 == "reborn")
			{
				include "modules/files/accounts/user/reborn.php";
				$includeUser = 0;
			}
			else if ($op2 == "webmgr")
			{
				include "modules/files/accounts/user/webmgr.php";
				$includeUser = 0;
			}
			else if ($op2 == "manager")
			{
				include "modules/files/accounts/user/manager.php";
				$includeUser = 0;
			}
			else if ($op2 == "broadcastmsg")
			{
				include "modules/files/accounts/user/broadcastmsg.php";
				$includeUser = 0;
			}
			else if ($op2 == "eventmgr")
			{
				include "modules/files/accounts/user/eventmgr.php";
				$includeUser = 0;
			}
			else if ($op2 == "usermgr")
			{
				include "modules/files/accounts/user/usermgr.php";
				$includeUser = 1;
			}
			else if ($op2 == "topup")
			{
				include "modules/files/accounts/user/topup.php";
				$includeUser = 0;
			}
			else if (strlen($op2) >= 1)
			{
				include "modules/files/accounts/user/db".$op2.".php";
				$includeUser = 0;
			}
			else
				$includeUser = 1;
			if (($includeUser) && ($userWebID == 5))
				include "modules/files/accounts/user/user.php";
		}
		else
		{
			include "modules/files/accounts/user/login.php";
		}
	}
	else
	{
		maintainance();
	}
?>
