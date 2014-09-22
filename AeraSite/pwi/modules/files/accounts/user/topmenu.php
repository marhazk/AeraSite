<table bgcolor="#FFFFFF" border="1" cellpadding="3" cellspacing="0" width="90%" align="center">
  <tbody>
  <tr>
    <td width="20%" align="center" valign="middle"><a href="?op=accounts">Your Account</a></td>
    <td width="20%" align="center" valign="middle"><a href="?op=accounts&type=characters" title="Want More Fun, vote for Us">Your Characters</a></td>
    <td width="20%" align="center" valign="middle"><a href="?op=accounts&type=topup">Top-up Aerapoint</a></td>
    <td width="20%" align="center" valign="middle"><a href="?op=accounts&type=Guild">Your Guild</a></td>
    <td width="20%" align="center" valign="middle"><a href="?op=accounts&type=Reborn">Celestial Reborn</a></td>
  </tr>
  <tr>
    <td width="20%" align="center" valign="middle"><a href="?op=accounts&type=voteus">Vote For AeraGold</a></td>
    <td width="20%" align="center" valign="middle">Claim TP</td>
    <td width="20%" align="center" valign="middle"><a href="?op=accounts&amp;type=ClaimUCA">Claim UCA</a></td>
    <td width="20%" align="center" valign="middle"><a href="?op=accounts&amp;type=ClaimUAA">Claim UAA</a></td>
    <td width="20%" align="center" valign="middle"><a href="?op=accounts&type=logout">Logout Account</a></td>
  </tr>
  <?php if ($gmuser >= 4) { ?>
    <tr>
    <td colspan=5 width=100% valign=top align=center><strong>Helper Sessions</strong></td>
    </tr>      
    <tr>
    <td width="20%" align="center" valign="middle"><a href="?op=accounts&type=gamemap&postype=0">All Players GameMap</a></td>
    <td width="20%" align="center" valign="middle"><a href="?op=accounts&type=gamemap&postype=2&posvalue=<?php echo $chkid;?>">Your Character GameMap</a></td>
    <td width="20%" align="center" valign="middle"><a href="?op=accounts&type=gamemap&postype=3">Online Players GameMap</a></td>
    <td width="20%" align="center" valign="middle"><a href="?op=accounts&type=Onlines">Online Roles</a></td>
    <td width="20%" align="center" valign="middle"></td>
  </tr>
  <?php } ?>
  <?php if ($gmuser >= 5) { ?>
    <tr>
    <td colspan=5 width=100% valign=top align=center><strong>Game Moderator and Staff Sessions</strong></td>
    </tr>      
    <tr>
    <td width="20%" align="center" valign="middle"><a href="?op=accounts&type=manager&mgr=topupmgr">Top-Up Manager</a></td>
    <td width="20%" align="center" valign="middle"><a href="?op=accounts&type=manager&mgr=eventmgr">Event Manager</a></td>
    <td width="20%" align="center" valign="middle"><a href="?op=accounts&type=manager&mgr=broadcastmsg">Broadcast Manager</a></td>
    <td width="20%" align="center" valign="middle"><a href="?op=accounts&type=manager&mgr=usermgr">User Manager</a></td>
    <td width="20%" align="center" valign="middle"><a href="?op=accounts&type=manager&mgr=webmgr">Web Manager</a></td>
  </tr>      
    <tr>
    <td width="20%" align="center" valign="middle"><a href="?op=accounts&amp;type=ListSent">GInventory Sent Item</a></td>
    <td width="20%" align="center" valign="middle"><a href="?op=accounts&amp;type=AddItem">GInventory Item</a></td>
    <td width="20%" align="center" valign="middle"><a href="?op=accounts&amp;type=RoleInfo">RoleInfo DB</a></td>
    <td width="20%" align="center" valign="middle"><a href="?op=accounts&amp;type=manager&amp;mgr=ncd">NCD Manager</a></td>
    <td width="20%" align="center" valign="middle"><a href="?op=accounts&type=manager&mgr=photomgr">Photo Manager</a></td>
  </tr>
    <tr>
    <td width="20%" align="center" valign="middle"><a href="?op=accounts&amp;type=FastMail">FastMail Item</a></td>
    <td width="20%" align="center" valign="middle"><a href="?op=accounts&amp;type=AddItem"></a></td>
    <td width="20%" align="center" valign="middle"><a href="?op=accounts&amp;type=RoleInfo"></a></td>
    <td width="20%" align="center" valign="middle"><a href="?op=accounts&amp;type=manager&amp;mgr=ncd"></a></td>
    <td width="20%" align="center" valign="middle"><a href="?op=accounts&type=manager&mgr=photomgr"></a></td>
  </tr>
  <?php } ?>
  </tbody>
</table>

