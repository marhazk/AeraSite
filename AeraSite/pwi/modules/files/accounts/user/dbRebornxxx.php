<?php
$DB[roles] = new GameDBD();
$DB[roles]->connect("roles", "SELECT * FROM roles WHERE userid=$chkid AND reborn=0 AND online=0 AND online2=0 AND (level2=22 OR level2=32) AND level>=100");
$roles = $DB[roles]->retrieve();
$resultQuery = "Please choose any of your character to reborn";
$resultQuery2 = "";
$success = false;
if (($_POST[opchk] == "Reborn Now!") || ($_REQUEST[rid] >= 32))
{
    $rid      = $_REQUEST[rid];
    $RoleInfo = $DB[roles]->searchBy("roleid", $rid);
    if (($RoleInfo['reborn'] == 0) && ($RoleInfo['online'] == 0) && ($RoleInfo['online2'] == 0))
    {
        $chknore = mysql_query("SELECT * FROM roles WHERE userid=$chkid AND reborn>=1 AND roleid=$rid AND level<=130");
        if ((mysql_num_rows($chknore) >= 1) || ($RoleInfo[roleid] == ""))
            $resultQuery = "Fail to Reborn! You cannot Celestial Reborn twice unless your character is level 130 and above";
        else
        {
            $rb = "UPDATE roles r, users u SET r.reborn=1, u.realuname=u.name, u.name=u.ID WHERE r.roleid='" . $RoleInfo[roleid] . "' AND u.ID='" . $chkid . "' AND r.userid=u.ID AND r.reborn=0";
            //$itemsql = "INSERT INTO uwebitems (userid, roleid, status, iid, icount, imaxcount, sender, msg, iproctype, iexpiredate, imask, idata, isdate) VALUES ('".$chkid."', '".$RoleInfo[roleid]."', '0', '130017', '1', '1', 'Celestial Reborn', 'Congratulation, you have been Celestial Reborn', '0', '0', '0', '', NOW());";
            //$itemQuery = mysql_query($itemsql);
            $rbq = mysql_query($rb);

            if ($rbq)
            {
                $success      = true;
                $resultQuery  = "You have reborned " . $RoleInfo[name] . ". Wait for 5 minutes to login";
                $resultQuery2 = $resultQuery;
                $_aeragold    = "0 AeraGold";
            }
            else if ($gmuser)
                $resultQuery = "Fail to Reborn! Contact GM for assistances.<BR>" . $coinSql;
            else
                $resultQuery = "Fail to Reborn! Contact GM for assistances.";
        }
    }
    else if ($RoleInfo['online'] == 1)
        $resultQuery = "Fail to Reborn! You cannot reborn while your account is online.";
    else
        $resultQuery = "Fail to Reborn! You cannot reborn twice.";
}
?>
<center><p></p>

    <h1>Celestial Reborn</h1>
    <?php if (strlen($resultQuery2) > 1)
    { ?>
        <script>alert("<?php echo $resultQuery2; ?>");</script>
    <?php } ?>

    <p><?php echo $resultQuery; ?></p>

    <p><?php if ($gmuser)
        {
            echo $rb;
        } ?></p>

    <p><i>Note: How to Celestial Reborn? Make sure you are Celestial Demon or Celestial Sage. Once you are Celestial
            Reborned, you will level 1 but you will become the opposite of cultivation (Sage become Demon, or Demon
            become Sage)</i></p>
    <?php
    if ((!$success) && (count($roles) >= 1))
    {
    ?>
    <table align="center" bgcolor="#FFFFFF" border="1" cellpadding="3" cellspacing="0">
        <tr>
            <th colspan="4" bgcolor="#000000"><b><font color="#ffffff">Character List</font></b></th>
        </tr>
        <tr>
            <td width="100%" align="center">
                    <form method="post" name="form1" id="form1">
                    <table cellpadding="0" cellspacing="0">
                        <tr>
                            <td width="30%"><span id="result_box" lang="en"
                                                  xml:lang="en">Enter the character name</span>:
                            </td>
                            <td width="70%"><select name="rid" id="rid">
                                    <option value="0">-</option>
                                    <?php
                                    foreach ($roles as $role)
                                    {
                                        ?>
                                        <option value="<?php echo $role[roleid] ?>"><?php echo $role[name]?></option>
                                    <?php }?>
                                </select>

                            </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td colspan="2">
                                <div style="text-align: left;">
                                    <input type="submit" name="opchk" value="Reborn Now!" id="opchk"/>
                                </div>
                            </td>
                        </tr>
                    </table>
                    </form>
        </tr>
    </table>
    <?php }?></td>
</center>