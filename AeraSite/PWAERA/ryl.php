<?php
	//NameList Checker
	$ryl2top = json_decode(file_get_contents('http://local.ryl2.perfectworld.com.my/ryl/stat2.php'));
	$chk = "";
	foreach ($ryl2top as $row)
	{
		$chk .= "INSERT INTO rylfame (cid,name,fame,medal) VALUES (".$row->CID.", '".$row->Name."', ".$row->Fame.", ".$row->Medal.") ON DUPLICATE KEY UPDATE fame = VALUES(fame), medal = VALUES(medal);\r\n";
	}
	
	//Online Checker
	$val = json_decode(file_get_contents('http://local.ryl2.perfectworld.com.my/ryl/o_char.php'));
	if (count($val) >= 1)
	{
		$num = 0;
		$temp = "";
		foreach ($val as $row)
		{
			if ($num > 0)
				$temp .= " OR ";
			$temp .= "cid=".$row->cid;
			$num++;
		}
		$chk .= "UPDATE rylfame SET online=1 WHERE $temp".";\r\n";
	}
	die($chk);
?>