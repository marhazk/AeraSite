<body bgcolor="#161616">
<font color=white>
<?php
			$DBHost = "localhost"; // ip
			$DBUser = "root";  	     //user
			$DBPassword = "5449";  	//pass
			$DBName = "dbo";		//database

			$Link = MySQL_Connect($DBHost, $DBUser, $DBPassword) or die ("Can't connect to MySQL");
			MySQL_Select_Db($DBName, $Link) or die ("Database ".$DBName." do not exists.");

$query="SELECT killerid, COUNT(killerid) AS ckills FROM kills GROUP BY killerid HAVING ( COUNT(killerid) > 0 )";
$result=mysql_query($query);

$querydeaths="SELECT corpseid, COUNT(corpseid) AS cdeaths FROM kills GROUP BY corpseid HAVING ( COUNT(corpseid) > 0 )";
$resultdeaths=mysql_query($querydeaths);

$num=mysql_num_rows($result);

$i=0;
while ($i < $num) {
// get killerid
$PlayerName=mysql_result($result,$i,"killerid");
//get kils result
$ckills=mysql_result($result,$i,"ckills");
//get deaths result
$cdeaths=mysql_result($resultdeaths,$i,"cdeaths");


$SearchifexistQuery = Mysql_Query("SELECT kills,deaths FROM pkrank WHERE userid = '$PlayerName'");
$SearchifexistNum = Mysql_Num_Rows($SearchifexistQuery);
IF ($SearchifexistNum == 1 OR $SearchifexistNum > 1) {
    $SearchifexistFetch = Mysql_Fetch_Array($SearchifexistQuery);
    $CharacterKills = $SearchifexistFetch['kills'];
    $Characterdeaths = $SearchifexistFetch['deaths'];
    $NewCharacterKills = $CharacterKills + $ckills;
    $NewCharacterdeaths = $Characterdeaths + $cdeaths;
    Mysql_Query("UPDATE pkrank SET kills = '$NewCharacterKills' WHERE userid = '$PlayerName'");
    Mysql_Query("UPDATE pkrank SET deaths = '$NewCharacterdeaths' WHERE userid = '$PlayerName'");
}
ELSE {
    Mysql_Query("INSERT INTO pkrank (userid, name, clasa, level, kills, reputation, deaths, gender) VALUES ('$PlayerName', 'Upcoming...', 'Upcoming...', '1', '1' , '1', '1', 'Upcoming...')");
}
$i++;
}
echo "Successfully Updated Tables!<br>";
//delete table
/* Mysql_Query("DELETE FROM kills"); */
//close conection
mysql_close($Link);

?>