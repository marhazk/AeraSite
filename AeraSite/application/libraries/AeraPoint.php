<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
//
// fully originally written by Marhazli / marhazk ... marhazk@yahoo.com
//
class AeraPoint
{

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
    var $adb = NULL;
    var $tblName = "ae_topups";


    //Versioning
    var $ver = "A";
    var $beta = "A";
    var $alpha = "A";

    function __construct()
    {
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
        //parent::__construct();
    }

    function db($xdb)
    {
        $this->adb = $xdb;
    }

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

    function GenCode()
    {
        $code = str_replace($this->ver, "", "ABCDEFGHIJKLMNOPQRSTUVWXYZ");
        $code = str_replace($this->beta, "", $code);
        $code = str_replace($this->alpha, "", $code);

        $length1 = 4;
        $length2 = 4;
        $length3 = 4;
        $length4 = 4;

        $randomString = substr(str_shuffle($code), 0, $length1) . "-" . substr(str_shuffle($code), 0, $length2) . "-" . substr(str_shuffle($code), 0, $length3) . "-" . substr(str_shuffle($code), 0, $length4);
        return $randomString;
    }

    function Addcode($details, $bid = 0, $cash = 0, $amount = 0, $cgroup = "A", $banreason = "", $cby = 0, $status = 0, $code = "")
    {
        //$code, $serial, $cash, $payment, $ctime, $cby, $bid, $btime, $status, $transfer, $banreason, $cgroup
        if (empty($details))
        {
            $serial = strtoupper($cgroup . time() . substr(md5(time() . $bid . $cash), 0, 4));
            if (strlen($code) == 0)
            {
                $code = strtoupper(md5(md5(time() . $bid . $cash)));
            }
            $code               = $this->GenCode();
            $details["code"]    = $code;
            $details["serial"]  = $serial;
            $details["cash"]    = $cash;
            $details["payment"] = $amount;
            $details["ctime"]   = time();
            $details["claimed"]  = 1;

            if (is_array($bid))
            {
                $details["datecode"] = $bid['datecode'];
                $details["timecode"] = $bid['timecode'];
                $details["claimed"]  = 0;
                $details["bid"]      = $bid['bid'];
            }
            elseif (isset($bid))
                $details["bid"] = $bid;
            else
                $details["bid"] = 0;
            if (isset($cby))
                $details["cby"] = $cby;
            else
                $details["cby"] = 0;
            $details["btime"]     = 0;
            $details["status"]    = $status;
            $details["transfer"]  = 0;
            $details["banreason"] = $banreason;
            $details["cgroup"]    = $cgroup;
            $details["success"]   = 0;
        }
        $sql = "INSERT INTO " . $this->tblName . " (code, serial, cash, payment, ctime, cby, bid, btime, status, transfer, banreason, cgroup, datecode, timecode, claimed) VALUES ('" . $details["code"] . "', '" . $details["serial"] . "', " . $details["cash"] . ", " . $details["payment"] . ", " . $details["ctime"] . ", " . $details["cby"] . ", " . $details["bid"] . ", " . $details["btime"] . ", " . $details["status"] . ", " . $details["transfer"] . ", '" . $details["banreason"] . "', '" . $details["cgroup"] . "', '" . $details["datecode"] . "', '" . $details["timecode"] . "', '" . $details["claimed"] . "');";
        //die("PASS1: ".$sql);

        $q = $this->adb->query($sql);
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

    function AddPWcode($details, $bid = 0, $cash = 0, $amount = 0, $cgroup = "A", $banreason = "", $cby = 0, $status = 0, $code = "")
    {
        //$code, $serial, $cash, $payment, $ctime, $cby, $bid, $btime, $status, $transfer, $banreason, $cgroup
        if (empty($details))
        {
            $serial = strtoupper($cgroup . time() . substr(md5(time() . $bid . $cash), 0, 4));
            if (strlen($code) == 0)
            {
                $code = strtoupper(md5(md5(time() . $bid . $cash)));
            }
            $code               = 'PWA0-' . $this->GenCode();
            $details["code"]    = $code;
            $details["serial"]  = $serial;
            $details["cash"]    = $cash;
            $details["payment"] = $amount;
            $details["ctime"]   = time();
            if (isset($bid))
                $details["bid"] = $bid;
            else
                $details["bid"] = 0;
            if (isset($cby))
                $details["cby"] = $cby;
            else
                $details["cby"] = 0;
            $details["btime"]     = 0;
            $details["status"]    = $status;
            $details["transfer"]  = 0;
            $details["banreason"] = $banreason;
            $details["cgroup"]    = $cgroup;
            $details["success"]   = 0;
        }
        $sql = "INSERT INTO uwebcubis (code, serial, cash, payment, ctime, cby, bid, btime, status, transfer, banreason, cgroup) VALUES ('" . $details["code"] . "', '" . $details["serial"] . "', " . $details["cash"] . ", " . $details["payment"] . ", " . $details["ctime"] . ", " . $details["cby"] . ", " . $details["bid"] . ", " . $details["btime"] . ", " . $details["status"] . ", " . $details["transfer"] . ", '" . $details["banreason"] . "', '" . $details["cgroup"] . "');";
        //die("PASS1: ".$sql);

        $q = $this->adb->query($sql);
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

    function Editcode($details)
    {
        $q = $this->adb->query("UPDATE " . $this->tblName . " SET cash='" . $details["cash"] . "', payment='" . $details["payment"] . "', ctime='" . $details["ctime"] . "', cby='" . $details["cby"] . "', bid='" . $details["bid"] . "', btime='" . $details["btime"] . "', status='" . $details["status"] . "', transfer='" . $details["transfer"] . "', banreason='" . $details["banreason"] . "', cgroup='" . $details["cgroup"] . "' WHERE cid=" . $details["cid"]);
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

    function Delcode($details)
    {
        $q = $this->adb->query("DELETE FROM " . $this->tblName . " WHERE cid=" . $details["cid"]);
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

    function Search($apsearchBy, $apValue = 0)
    {
        if ($apsearchBy == 1)
        {
            $qmsg = "SELECT * FROM " . $this->tblName . " ORDER BY cid DESC";
        }
        else
        {
            $qmsg = "SELECT * FROM " . $this->tblName . " WHERE $apsearchBy='$apValue' ORDER BY cid DESC";
        }

        //die("TEST: $qmsg");
        return $qmsg;
    }

    function Addcash($apcby, $aptargetrid, $apcash)
    {
        if ($aptargetrid >= 32)
        {
            $apcash = $apcash * 100;
            //$apid = $this->getuidbyrole($aptargetrid);
            $apid               = 32;
            $details            = $this->Addcode($null, $aptargetrid, $apcash, 0, "B", "N/A", $apcby);
            $details["success"] = 1;
        }
        else
            $details["success"] = 0;
        return $details;
    }

    function Topup($apid, $apcode)
    {
        $apquery = $this->adb->query($this->Search("code", $apcode));
        if ($apquery)
        {
            $details = $apquery->row_array();
            if (isset($details['cgroup']))
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
                $details["bid"]    = $apid;
                $details["btime"]  = time();
                $details           = $this->Editcode($details);
                if ($details["success"])
                {
                    //$transfer = $this->adb->query("call usecash($apid,1,0,1,0,".$details["cash"].",1,@error);");
                    $sql      = "INSERT IGNORE INTO ae_balances (uid, total,pbalance, pdate) VALUES ($apid, " . $details["cash"] . ", " . $details["cash"] . ", " . time() . ") ON DUPLICATE KEY UPDATE total=total+VALUES(total), pbalance=pbalance+VALUES(pbalance), pdate=" . time() . ";";
                    $transfer = $this->adb->query($sql);
                    if ($transfer)
                        $details["success"] = 10;
                    else
                        $details["success"] = 9;
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
        $targetid    = $uid;
        $buypointQgm = $this->adb->query("SELECT ID FROM users");
        if ($buypointQgm)
        {
            while ($buypointRgm = $this->result_array($buypointQgm))
            {
                $buypointminID = $buypointRgm[ID];
                $buypointmaxID = $buypointRgm[ID] + 15;
                if (($targetid >= $buypointminID) && ($targetid <= $buypointmaxID))
                {
                    //$buypointQuery2 = $this->adb->query("call usecash($buypointminID,1,0,1,0,$_cash*100,1,@error);");
                    $temp = $this->Addcash($buypointminID, $buypointminID, $_cash);
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
}

?>