<HR /><h1>
<?php
	$tblLastID = 0;
	$tblFirstID = 0;
	function getlist($tbl, $attr, $val, $showAttr, $sqlval, $sqlorder)
	{
		$x = "";
		$y = "";
		$z = "";
		if (!empty($sqlval))
			$sqlval = " WHERE ".$sqlval;
		if (!empty($sqlorder))
			$sqlorder = " ORDER BY ".$sqlorder;
		$sql = "SELECT * FROM ".$tbl.$sqlval.$sqlorder;
		$result = mysql_query($sql);
		if ($result)
		{
			if (empty($val) || ($val == 0))
				$x .= '<option value="0" selected>------</option>';
			else
				$x .= '<option value="0">------</option>';
			while ($row = mysql_fetch_array($result))
			{
				$y = "";
				foreach ($showAttr as $showAttrVal)
				{
					$y .= $row[$showAttrVal]." : ";
				}
				$y = substr($y, 0, -3);
				if ($row[$attr] == $val)
					$z .= '<option value="'.$row[$attr].'" selected>'.$y.'</option>';
				else
					$z .= '<option value="'.$row[$attr].'">'.$y.'</option>';
			}
		}
		return $x.$z;
	}
	$mgrfilemain = 0;
	$mgrfile = "modules/files/accounts/user/".$_REQUEST[mgr].".php";
	$mgrfile2 = "modules/files/".$_REQUEST[mgr].".php";
	
	if (file_exists($mgrfile))
	{
		$mgrfilemain = 1;
	}
	else if (file_exists($mgrfile2))
	{
		$mgrfile = $mgrfile2;
		$mgrfilemain = 1;
	}
	else
	{
		$mgrfilemain = 0;
	}
	if ($mgrfilemain)
		include $mgrfile;
			
	$tblButton = "Add";
	$tblOutput = $tblTitle." Manager";
	$tblMsgSuccess = $tblOutput;
	$tblMsgFail = $tblOutput;
	
	// $tblName			Table name								uWebevents
	// $tblAttr			Array of $tblName's attributes			array((PRIMARY)attr1, attr2, attr3, attr4, ..., attrN)
	// $tblTitle		Title of Tablet							Event Server
	// $tblList1		Local Attributes and Values
	// $tblList2		Local Attributes and Values
	// $tblMsgSuccess	Set/Get a worked QUERY message output	Data has been saved
	// $tblMsgFail		Set/Get a failed QUERY message output	Data fail to saved
	// $tblButton		Set/Get a button value on opchk			Save (or) Add
	// $tbl
	// $tbl
	// $tbl
	// $tbl
	// $tbl
	// $tbl
	// $tbl
	if ($gmuser >= 5)
	{
		if (isset($_POST["opchk"]) || (isset($_REQUEST["mode"]) && isset($_REQUEST["tid"])))
		{
			if (isset($_POST["sType"]) && (isset($_POST["sVal"])))
				$tblExtraSQL = " OR ".$_POST["sType"]." LIKE '%".$_POST["sVal"]."%'";
			if (isset($_REQUEST["mode"]) && isset($_REQUEST["tid"]))
			{
				$_POST["opchk"] = $_REQUEST["mode"];
				$_POST[$tblAttr[0]."1"] = $_REQUEST["tid"];
				$_POST[$tblAttr[0]."2"] = $_REQUEST["tid"];
				if (empty($_POST["sType"]))
					$_POST["sType"] = $tblAttr[0];
				if (empty($_POST["sVal"]))
				$_POST["sVal"] = $_REQUEST["tid"];
				$tblExtraSQL = " OR ".$_POST["sType"]."='".$_POST["sVal"]."'";
			}
			$tblList1 = "";
			$tblList2 = "";
			if ($_POST[$tblAttr[0]."gm"] >= 999)
			{
				$sql = "SELECT * FROM ".$tblName." WHERE (".$tblAttr[0]."='".$_POST[$tblAttr[0]."1"]."' OR ".$tblAttr[0]."='".$_POST[$tblAttr[0]."2"]."' OR ".$tblAttr[0]."='".$_POST[$tblAttr[0]]."')";
				$tblMsgSuccess = "If you put the ".$tblTitle." ID, please make sure you enter it correctly...";
				$tblMsgFail = $tblMsgSuccess;
				$tblButton = "Save";
			}
			else if ($_POST[$tblAttr[0]."gm1"] >= 999)
			{
				$sql = "SELECT * FROM ".$tblName." WHERE (".$tblAttr[0]."='".$_POST[$tblAttr[0]."1"]."' OR ".$tblAttr[0]."='".$_POST[$tblAttr[0]."2"]."' OR ".$tblAttr[0]."='".$_POST[$tblAttr[0]]."')";
				$tblMsgSuccess = "If you put the ".$tblTitle." ID, please make sure you enter it correctly...";
				$tblMsgFail = $tblMsgSuccess;
				$tblButton = "Save";
			}
			else if ($_POST[$tblAttr[0]."gm2"] >= 999)
			{
				$sql = "SELECT * FROM ".$tblName." WHERE (".$tblAttr[0]."='".$_POST[$tblAttr[0]."1"]."' OR ".$tblAttr[0]."='".$_POST[$tblAttr[0]."2"]."' OR ".$tblAttr[0]."='".$_POST[$tblAttr[0]]."')";
				$tblMsgSuccess = "If you put the ".$tblTitle." ID, please make sure you enter it correctly...";
				$tblMsgFail = $tblMsgSuccess;
				$tblButton = "Save";
			}
			else if ($_POST["opchk"] == "Add")
			{
				foreach ($tblAttr as $tblAttrVal)
				{
					$tblList1 .= $tblAttrVal.", ";
					$tblList2 .= "'".$_POST[$tblAttrVal]."', ";
				}
				$tblList1 = substr($tblList1, 0, -2);
				$tblList2 = substr($tblList2, 0, -2);
				$sql = "INSERT INTO ".$tblName." (".$tblList1.") VALUES (".$tblList2.");";
				$tblMsgSuccess = "Successfully added into our ".$tblTitle." system";
				$tblMsgFail = "Fail to added, please try again";
				$tblButton = "Save";
			}
			else if ($_POST["opchk"] == "Search")
			{
				$tblSql3 = "SELECT * FROM ".$tblName." WHERE ".$_POST["sType"]." LIKE '%".$_POST["sVal"]."%' ORDER BY ".$tblAttr[0]." DESC";
				$tblResult3 = mysql_query($tblSql3);
				$tblSql4 = "SELECT * FROM ".$tblName." WHERE ".$_POST["sType"]." LIKE '%".$_POST["sVal"]."%' ORDER BY ".$tblAttr[1]." ASC";
				$tblResult4 = mysql_query($tblSql4);
				$tblTotal = mysql_num_rows($tblResult3);
			}
			else if ($_POST["opchk"] == "Save")
			{
				foreach ($tblAttr as $tblAttrVal)
				{
					$tblList1 .= $tblAttrVal."='".$_POST[$tblAttrVal]."', ";
				}
				$tblList1 = substr($tblList1, 0, -2);
				$sql = "UPDATE ".$tblName." SET ".$tblList1." WHERE ".$tblAttr[0]."='".$_POST[$tblAttr[0]]."'";
				$tblMsgSuccess = "Successfully saved into our ".$tblTitle." system";
				$tblMsgFail = "Fail to saved, please try again";
				$tblButton = "Save";
			}
			else if ($_POST["opchk"] == "Edit")
			{
				$sql = "SELECT * FROM ".$tblName." WHERE (".$tblAttr[0]."='".$_POST[$tblAttr[0]."1"]."' OR ".$tblAttr[0]."='".$_POST[$tblAttr[0]."2"]."'".$tblExtraSQL.") ORDER BY ".$tblAttr[0]." DESC LIMIT 0,1";
				$tblMsgSuccess = "";
				$tblMsgFail = "";
				$tblButton = "Save";
			}
			else if ($_POST["opchk"] == "Remove")
			{
				$sql = "DELETE FROM ".$tblName." WHERE (".$tblAttr[0]."='".$_POST[$tblAttr[0]."1"]."' OR ".$tblAttr[0]."='".$_POST[$tblAttr[0]."2"]."')";
				$tblMsgSuccess = "Successfully removed from our ".$tblTitle." system";
				$tblMsgFail = "Fail to removed";
				$tblButton = "Add";
			}
			$query = mysql_query($sql);
			if ($query)
			{
				$tblOutput = $tblMsgSuccess;
				if ((strlen($tblOutput) == 0) || ($tblMsgSuccess == $tblMsgFail))
					$_POST = mysql_fetch_array($query);
			}
			else
				$tblOutput = $tblMsgFail."<BR>".$sql;
		}
		else
		{
			$tblButton = "Add";
		}
		$tblSql1 = "SELECT * FROM ".$tblName." ORDER BY ".$tblAttr[0]." DESC";
		$tblResult1 = mysql_query($tblSql1);
		$tblSql2 = "SELECT * FROM ".$tblName." ORDER BY ".$tblAttr[1]." ASC";
		$tblResult2 = mysql_query($tblSql2);
	}
	//echo $tblOutput . "<BR>". $sql;
	echo $tblOutput ."<BR>";
?></h1>

<form id="form1" name="form1" method="post" action="?op=accounts&type=manager&mgr=<?php echo $_REQUEST[mgr]; ?>">
<table width="100%%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="30%" align="right" valign="top">Select <?php echo $tblTitle; ?> by ID : </td>
      <td width="70%" align="left" valign="top"><select name="<?php echo $tblAttr[0]; ?>1" id="select">
      <option value="" selected>-</option>
      <?php 
	  if ($tblResult1) { while ($row = mysql_fetch_array($tblResult1)) {
		  if ($tblFirstID == 0)
		  {
			  $tblFirstID = $row[$tblAttr[0]];
		  }
		  $tblLastID = $row[$tblAttr[0]];
		  ?>
      <option value="<?php echo $row[$tblAttr[0]]; ?>"><?php echo $row[$tblAttr[0]]; ?>: <?php echo substr($row[$tblAttr[1]], 0, 70); ?></option>
      <?php }} ?>
      </select>
      </td>
      </tr>
    <tr>
      <td width="30%" align="right" valign="top">Select <?php echo $tblTitle; ?> by Name : </td>
      <td width="70%" align="left" valign="top"><select name="<?php echo $tblAttr[0];?>2" id="select">
      <option value="" selected>-</option>
      <?php 
	  if ($tblResult2) { while ($row = mysql_fetch_array($tblResult2)) { ?>
      <option value="<?php echo $row[$tblAttr[0]]; ?>"><?php echo substr($row[$tblAttr[1]], 0, 70); ?></option>
      <?php }} ?>
      </select><BR /><input type="submit" name="opchk" id="opchk" value="Edit" />
      <input type="submit" name="opchk" id="opchk" value="Remove" />
      <input type="reset" name="opchk" id="opchk" value="Reset" /></td>
    </tr>
    </table>
    </form>
    <hr />
    <form id="form1" name="form1" method="post" action="?op=accounts&type=manager&mgr=<?php echo $_REQUEST[mgr]; ?>">
	<table width="100%%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="30%" align="right" valign="top">Search for :</td>
      <td width="70%" align="left" valign="top"><input name="sVal" type="text" size="50" value="<?php echo $_POST["sVal"];?>"> 
      <select name=sType>
      <?php
      foreach ($tblAttr as $tblAttrVal)
		{
			?>
            <option value="<?php echo $tblAttrVal;?>"><?php echo $tblAttrVal;?></option>
      <?php
      }?></select><br>
      <input type="submit" name="opchk" id="opchk" value="Edit" />
      <input type="submit" name="opchk" id="opchk" value="Search" />
      <input type="reset" name="opchk" id="opchk" value="Reset"  /></td>
    </tr>
    <?php 
	  if (($tblResult3) && ($tblResult4)) {
		  if ($tblTotal > 0)
		  {
		  ?>
    <tr>
      <td width="30%" align="right" valign="top">Select <?php echo $tblTitle; ?> by ID : </td>
      <td width="70%" align="left" valign="top"><select name="<?php echo $tblAttr[0]; ?>1" id="select">
      <option value="" selected>-</option>
      <?php 
	  if ($tblResult3) { while ($row = mysql_fetch_array($tblResult3)) { ?>
      <option value="<?php echo $row[$tblAttr[0]]; ?>"><?php echo $row[$tblAttr[0]]; ?>: <?php echo substr($row[$tblAttr[1]], 0, 70); ?></option>
      <?php }} ?>
      </select>
      </td>
      </tr>
    <tr>
      <td width="30%" align="right" valign="top">Select <?php echo $tblTitle; ?> by Name : </td>
      <td width="70%" align="left" valign="top"><select name="<?php echo $tblAttr[0]; ?>2" id="select">
      <option value="" selected>-</option>
      <?php 
	  if ($tblResult4) { while ($row = mysql_fetch_array($tblResult4)) { ?>
      <option value="<?php echo $row[$tblAttr[0]]; ?>"><?php echo substr($row[$tblAttr[1]], 0, 70); ?></option>
      <?php }} ?>
      </select><BR /><input type="submit" name="opchk" id="opchk" value="Edit" />
      <input type="submit" name="opchk" id="opchk" value="Remove" />
      <input type="reset" name="opchk" id="opchk" value="Reset" />
      </td>
      </tr>
      <?php } else {?>
      <tr>
      <td colspan="2" align=center>No result found
      </td>
      </tr>
      <?php }}?>
    <tr>
      <td width="100%" colspan=2 align="left" valign="top">&nbsp;</td>
    </tr>
  </table>
</form>
<p><hr /></p>
<form id="form1" name="form1" method="post" action="?op=accounts&type=manager&mgr=<?php echo $_REQUEST[mgr]; ?>">
<?php 
		$mgrfile = "modules/files/accounts/user/".$_REQUEST[mgr].".design.php";
		$mgrfile2 = "modules/files/".$_REQUEST[mgr].".design.php";
		$mgrfilemain = 0;
		if (file_exists($mgrfile))
		{
			$mgrfilemain = 1;
		}
		else if (file_exists($mgrfile2))
		{
			$mgrfile = $mgrfile2;
			$mgrfilemain = 1;
		}
		else
		{
			$mgrfilemain = 1;
			$mgrfile = "modules/files/common/notfound.php";
		}
		if ($mgrfilemain)
			include $mgrfile;
?>
  <table width=100%>
    <tr>
      <td width="30%" align="right" valign="top"></td>
      <td width="70%" align="left" valign="top">
      <p>
        <input type="submit" name="opchk" id="opchk" value="<?php echo $tblButton; ?>" />
        <?php if ($tblButton == "Save") { ?>
        <input type="submit" name="opchk" id="opchk" value="Remove" />
        <input type="submit" name="opchk" id="opchk" value="Add" />
        <?php }?>
      </p></td>
    </tr>
    <tr>
      <td width="30%" align="right" valign="top">&nbsp;</td>
      <td width="70%" align="left" valign="top">&nbsp;</td>
    </tr>
  </table>
</form>
<p>&nbsp;</p>
