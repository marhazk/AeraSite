<table width=80%>
<tr>
  <td colspan="2" align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td valign="top" width="20%" align="right"><strong>Name :</strong></td><td valign="top" width="30%"><?php echo $vinfo[name]; ?></td>
<td valign="top" width="20%" align="right"><b>Cultivation :</b></td><td valign="top" width="30%"> <?php echo $vinfo[culti]; ?></td>
</tr>
    <tr>
<td valign="top" width="20%" align="right"><b>BattlePower :</b></td>
<td valign="top" width="30%"> <?php echo $vinfo[battlepower]; ?></td>
<td valign="top" width="20%" align="right"><b>Level :</b></td>
<td valign="top" width="30%"> <?php echo $vinfo[level]; ?></td>
	</tr>
    <tr>
<td valign="top" width="20%" align="right"><b>Money :</b></td><td width="30%" valign="top"><?php echo $vinfo[money]; ?></td>
<td valign="top" width="20%" align="right"><b>Bank :</b></td><td valign="top" width="30%"> <?php echo $vinfo[storehouse_money]; ?></td>
    </tr>
    </table>
  </td>
</tr>
<tr>
  <td colspan="2" align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
<td valign="top" width="20%" align="right"><b>Agility/Dex :</b></td><td valign="top" width="5%"> <?php echo $vinfo[agility]; ?></td>
<td valign="top" width="20%" align="right"><b>Vitality :</b></td><td valign="top" width="5%"> <?php echo $vinfo[vitality]; ?></td>
<td valign="top" width="20%" align="right"><b>Int/Mag :</b></td><td valign="top" width="5%"> <?php echo $vinfo[energy]; ?></td>
<td valign="top" width="20%" align="right"><b>Strength :</b></td><td valign="top" width="5%"> <?php echo $vinfo[strength]; ?></td>
    </tr>
  </table></td>
  </tr>
<tr><td valign="top" width="40%" align="right"><b>Experience :</b></td><td valign="top" width="60%"> <?php echo $vinfo[exp1]; ?>% completed (<?php echo $vinfo[exp2]; ?>% more to gain level <?php echo $vinfo[level]+1; ?>) </td></tr>
<tr><td valign="top" width="40%" align="right"><b>Class :</b></td><td valign="top" width="60%"><?php echo $vinfo[roleclass2]; ?></td></tr>
<tr><td valign="top" width="40%" align="right"><b>Task Completion :</b></td><td valign="top" width="60%"> <?php echo $vinfo[tc1]; ?> (<?php echo $vinfo[tc2]; ?> quests out of <?php echo $vinfo[quests]; ?> quests)</td></tr>
<tr><td valign="top" width="40%" align="right"><b>Task Taken :</b></td><td valign="top" width="60%"> <?php echo $vinfo[tt1]; ?> (<?php echo $vinfo[tt2]; ?> quests out of <?php echo $vinfo[quests]; ?> quests)</td></tr>
<tr><td valign="top" width="40%" align="right"><b>Reputation :</b></td><td valign="top" width="60%"> RepUser <?php echo $vinfo[repuser]; ?> + RepBasic 35000</td></tr>
<tr><td valign="top" width="40%" align="right"><b>Skill Points :</b></td><td valign="top" width="60%"> <?php echo $vinfo[sp]; ?></td></tr>
<tr><td valign="top" width="40%" align="right"><b>Gender :</b></td><td valign="top" width="60%"> <?php echo $vinfo[gender]; ?></td></tr>
<tr><td valign="top" width="40%" align="right"><b>Last Login:</b></td><td valign="top" width="60%"> <?php echo $vinfo[lastlogin_time]; ?></td></tr>
<tr><td valign="top" width="40%" align="right"><b>Create Time:</b></td><td valign="top" width="60%"> <?php echo $vinfo[create_time]; ?></td></tr>
<tr>
  <td valign="top" colspan=2 align="center"><form method=post><b>Buy Point:</b> <select name=point>
  <option value="" selected>--------------------------------------------------------</option>
  <option value="<?php $currBpoint = 10; echo ($currBpoint); ?>" selected><?php echo ($currBpoint); ?> Aerapoint (Costs <?php echo ($requireGold*$currBpoint); ?> gold, <?php echo ($requireSP*$currBpoint); ?> SP, <?php echo ($requireRepUser*$currBpoint); ?> rep-user)</option>
  <option value="<?php $currBpoint = 50; echo ($currBpoint); ?>" selected><?php echo ($currBpoint); ?> Aerapoint (Costs <?php echo ($requireGold*$currBpoint); ?> gold, <?php echo ($requireSP*$currBpoint); ?> SP, <?php echo ($requireRepUser*$currBpoint); ?> rep-user)</option>
  <option value="<?php $currBpoint = 100; echo ($currBpoint); ?>" selected><?php echo ($currBpoint); ?> Aerapoint (Costs <?php echo ($requireGold*$currBpoint); ?> gold, <?php echo ($requireSP*$currBpoint); ?> SP, <?php echo ($requireRepUser*$currBpoint); ?> rep-user)</option>
  <option value="<?php $currBpoint = 500; echo ($currBpoint); ?>" selected><?php echo ($currBpoint); ?> Aerapoint (Costs <?php echo ($requireGold*$currBpoint); ?> gold, <?php echo ($requireSP*$currBpoint); ?> SP, <?php echo ($requireRepUser*$currBpoint); ?> rep-user)</option>
  </select>
  <input type=Submit name=opchk2 value=Buy></form></td>
</tr>
<tr><td valign="top" width="40%" align="right"><b>AeraPoint Rewards:</b></td><td valign="top" width="60%"> <?php echo $vinfo[rewards]; ?></td></tr>
<tr><td valign="top" width="40%" align="right"><b>Celestial Reborning (CR) (Requires Level 130 and BattlePower 200):</b></td><td valign="top" width="60%"> <?php echo $vinfo[cr]; ?></td></tr>
</table>