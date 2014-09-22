<?php
	//aerapointAddcash (roleID, cash)
	//aerapointAddcode (ID
	//
	// STATUS
	// 0 = Pending/wait for topup
	// 1 = topup success
	//
	// CGROUP
	// A - Normal
	// B - Reserved
	// C - Locked/Expired
	// D - Banned
	//
	function getapstatus($type)
	{
		if ($type == 1)
			return "USED";
		else if ($type == 2)
			return "PENDING";
		else if ($type == 3)
			return "UNAUTHORIZED";
		else
			return "UNUSED";
	}
	function aerapointAddcode($details, $bid = 0, $cash = 0, $amount = 0, $cgroup = "A", $banreason = "", $cby = 0, $status = 0, $code = "")
	{
		//$code, $serial, $cash, $payment, $ctime, $cby, $bid, $btime, $status, $transfer, $banreason, $cgroup
		if (empty($details))
		{
			$serial = strtoupper($cgroup.time().substr(md5(time().$bid.$cash),0,4));
			if (strlen($code) == 0)
			{
				$code = strtoupper(md5(md5(time().$bid.$cash)));
			}
			$code = str_replace(" ","",$code);
			$details["code"] = $code;
			$details["serial"] = $serial;
			$details["cash"] = $cash;
			$details["payment"] = $amount;
			$details["ctime"] = time();
			if (isset($bid))
				$details["bid"] = $bid;
			else
				$details["bid"] = 0;
			if (isset($cby))
				$details["cby"] = $cby;
			else
				$details["cby"] = 0;
			$details["btime"] = 0;
			$details["status"] = $status;
			$details["transfer"] = 0;
			$details["banreason"] = $banreason;
			$details["cgroup"] = $cgroup;
			$details["success"] = 0;
		}
		$q = mysql_query("INSERT INTO uwebcubis (code, serial, cash, payment, ctime, cby, bid, btime, status, transfer, banreason, cgroup) VALUES ('".$details["code"]."', '".$details["serial"]."', ".$details["cash"].", ".$details["payment"].", ".$details["ctime"].", ".$details["cby"].", ".$details["bid"].", ".$details["btime"].", ".$details["status"].", ".$details["transfer"].", '".$details["banreason"]."', '".$details["cgroup"]."');");
		if ($q)
		{
			$details["success"] = 1;
		}
		else
		{
			$details["success"] = 0;
		}
		return $details;
	}
	function aerapointEditcode($details)
	{
		$q = mysql_query("UPDATE uwebcubis SET cash='".$details["cash"]."', payment='".$details["payment"]."', ctime='".$details["ctime"]."', cby='".$details["cby"]."', bid='".$details["bid"]."', btime='".$details["btime"]."', status='".$details["status"]."', transfer='".$details["transfer"]."', banreason='".$details["banreason"]."', cgroup='".$details["cgroup"]."' WHERE cid=".$details["cid"]);
		if ($q)
		{
			$details["success"] = 1;
		}
		else
		{
			$details["success"] = 0;
		}
		return $details;
	}
	function aerapointDelcode($details)
	{
		$q = mysql_query("DELETE FROM uwebcubis WHERE cid=".$details["cid"]);
		if ($q)
		{
			$details["success"] = 1;
		}
		else
		{
			$details["success"] = 0;
		}
		return $details;
	}
	function aerapointSearch($apsearchBy, $apValue = 0)
	{
		if ($apsearchBy == 1)
		{
			$qmsg = "SELECT * FROM uwebcubis ORDER BY cid DESC";
		}
		else
		{
			$qmsg = "SELECT * FROM uwebcubis WHERE $apsearchBy='$apValue' ORDER BY cid DESC";
		}
		return $qmsg;
	}
	function aerapointAddcash($apcby, $aptargetrid, $apcash)
	{
		if ($aptargetrid >= 32)
		{
			$apcash = $apcash*100;
			$apid = getuidbyrole($aptargetrid);
			$details = aerapointAddcode($null, $aptargetrid, $apcash, 0, "B", "N/A", $apcby);
			$details["success"] = 1;
		}
		else
			$details["success"] = 0;
		return $details;
	}
	
	function aerapointTopup($apid, $apcode)
	{
		$apquery = mysql_query(aerapointSearch("code", $apcode));
		if ($apquery)
		{
			$details = mysql_fetch_array($apquery);
			if ($details)
			{
				if ($details["cgroup"] == "D")
				{
					$details["success"] = 2;
					return $details;
				}
				// Already topup by someone else
				// DEFAULT: 1
				if ($details["status"] == 1)
				{
					$details["success"] = 1;
					return $details;
				}
				// Restrict the topup
				// DEFAULT : 0
				//if (($details["bid"] != $apid) && ($details["bid"] != 0))
				//{
				//	$details["success"] = 5;
				//	return $details;
				//}
				$details["status"] = 1;
				$details["bid"] = $apid;
				$details["btime"] = time();
				$details = aerapointEditcode($details);
				if ($details["success"])
				{
					$transfer = mysql_query("call usecash($apid,1,0,1,0,".$details["cash"].",1,@error);");
					$details["success"] = 10;
				}
				else
				{
					$details["success"] = 4;
				}
			}
			else
				$details["success"] = 3;
		}
		else
			$details["success"] = 0;
		return $details;
	}
	function addcashbyroleid($uid, $_cash)
	{
		$targetid = $uid;
		$buypointQgm = mysql_query("SELECT ID FROM users");
		if ($buypointQgm)
		{
			while ($buypointRgm = mysql_fetch_array($buypointQgm))
			{
				$buypointminID = $buypointRgm[ID];
				$buypointmaxID = $buypointRgm[ID]+15;
				if (($targetid >= $buypointminID) && ($targetid <= $buypointmaxID))
				{
					//$buypointQuery2 = mysql_query("call usecash($buypointminID,1,0,1,0,$_cash*100,1,@error);");
					$temp = aerapointAddcash($buypointminID, $buypointminID, $_cash);
					if ($temp["success"])
						return 1;
					else
						return 0;
				}
				//echo "<BR>(($buypointminID >= $targetid) && ($buypointmaxID <= $targetid))";
			}
			return 2;
		}
		else
			return 0;
	}
?>