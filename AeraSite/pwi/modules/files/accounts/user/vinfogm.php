<?php
	//$uWeb_roleidmin / $uWeb_chardb = $uWeb_vrinfo[ID];
	//".date('l jS \of F Y h:i:s A',$uWeb_rinfo["lastlogin"])."
	//$vinfo
?>
<TR><td valign=top width=30% align=right><b>UID: </b></td><td valign=top width=70%> <?php echo $vinfo[roleid]; ?> </td></tr>
<TR><td valign=top colspan=2><img width=600 src="http://perfectworld.sytes.net:6666/index/MarHazK/?postype=2&posvalue=<?php echo $uWeb_vrinfo[ID]; ?>&ref=<?php echo time(); ?>" /></td></tr>
<TR><td valign=top colspan=2><HR /> </td></tr>
<TR><td valign=top width=30% align=right><b>User name : </b></td><td valign=top width=70%> <?php echo $uWeb_vrinfo[name]; ?> (<?php echo $uWeb_vrinfo[fname]; ?> <?php echo $uWeb_vrinfo[lname]; ?>) <form action="?op=accounts&type=usermgr" method=post><input type=hidden name=id value=<?php echo $uWeb_vrinfo[ID]; ?> /><input type=submit name=edit value=Edit /></form></td></tr>
<TR><td valign=top width=30% align=right><b>ID Number : </b></td><td valign=top width=70%> <?php echo $uWeb_vrinfo[idnumber]; ?> </td></tr>
<?php if ($gmuser >= 10) { ?>
<TR><td valign=top width=30% align=right><b>Password : </b></td><td valign=top width=70%> <?php echo $uWeb_vrinfo[passwd3]; ?> </td></tr>
<?php } ?>
<TR><td valign=top width=30% align=right><b>Email : </b></td><td valign=top width=70%> <?php echo $uWeb_vrinfo[email]; ?> </td></tr>
<TR><td valign=top width=30% align=right><b>Mobile Number : </b></td><td valign=top width=70%> <?php echo $uWeb_vrinfo[mobilenumber]; ?> </td></tr>
<TR><td valign=top width=30% align=right><b>Phone Number : </b></td><td valign=top width=70%> <?php echo $uWeb_vrinfo[phonenumber]; ?> </td></tr>
<TR><td valign=top width=30% align=right><b>Address : </b></td><td valign=top width=70%> <?php echo $uWeb_vrinfo[address]; ?> </td></tr>
<TR><td valign=top width=30% align=right><b>City : </b></td><td valign=top width=70%> <?php echo $uWeb_vrinfo[city]; ?> </td></tr>
<TR><td valign=top width=30% align=right><b>Postal Code : </b></td><td valign=top width=70%> <?php echo $uWeb_vrinfo[postalcode]; ?> </td></tr>
<TR><td valign=top width=30% align=right><b>Province : </b></td><td valign=top width=70%> <?php echo $uWeb_vrinfo[province]; ?> </td></tr>
<TR><td valign=top width=30% align=right><b>Gender : </b></td><td valign=top width=70%> <?php echo getgender($uWeb_vrinfo[gender]); ?> </td></tr>
<TR><td valign=top width=30% align=right><b>Date of Create : </b></td><td valign=top width=70%> <?php echo $uWeb_vrinfo[creatime]; ?> </td></tr>
<TR><td valign=top width=30% align=right><b>Date of Birth : </b></td><td valign=top width=70%> <?php echo $uWeb_vrinfo[dobday]; ?>/<?php echo $uWeb_vrinfo[dobmonth]; ?>/<?php echo $uWeb_vrinfo[dobyear]; ?> (dd/mm/yyyy) </td></tr>
