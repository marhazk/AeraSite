<?php
	//-------------DATABASE SESSION-----------------------//
    $sql_server = "127.0.0.1";								//<-- MSSQL server address/ip
    $sql_user = "sa";										//<-- MSSQL username
    $sql_pass = "SET-YOUR-PASSWORD-HERE";					//<-- MSSQL password
    $sql_data = "dbo";										//<-- MSSQL database
	$conn=mssql_connect($sql_server,$sql_user,$sql_pass);
	$xadb = mssql_select_db($sql_data,$conn) or die("$uwebmsg_cerr");

	$uweb_toplvlq = "SELECT * FROM uWebplayers ORDER BY rolelevel DESC";
	$uweb_toplvlr = mssql_query($uweb_toplvlq);
	$uweb_toplvl_num = 0;
	echo "<p><b>TOP PLAYERS<b></p><p>";
	echo "<Table width=100% border=1><TR><TD><B>RANK NUMBER</B></td><TD><B>PLAYER NAME</B></td><TD><B>PLAYER LEVEL</B></td></tr>";
	while ($uweb_toplvlrow = mssql_fetch_array($uweb_toplvlr))
	{
		$uweb_toplvl_num++;
		echo "<TR><TD>$uweb_toplvl_num</td><TD>".$uweb_toplvlrow[rolename]."</td><TD>".$uweb_toplvlrow[rolelevel]."</td>";
		if ($uweb_toplvl_num >= 500) break;
	}
	echo "</table></p>";
?>