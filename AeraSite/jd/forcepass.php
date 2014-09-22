<?
include "/root/configs.tools.php";
{
$Link = MySQL_Connect($DBHost, $DBUser, $DBPassword) or die("SQL à répondu : $query".mysql_error());
MySQL_Select_Db($DBName, $Link) or die("SQL à répondu : $query".mysql_error());



$Login = StrToLower(Trim($Login));
$Pass = StrToLower(Trim($Pass));


if (ereg("[^0-9a-zA-Z_-]", $Login, $Txt))
{
echo "Login have a incorrect format.";exit;
}

elseif (ereg("[^0-9a-zA-Z_-]", $Pass, $Txt))
{
echo "Password have a incorrect format."; exit;
}

elseif ((StrLen($Login) < 4) or (StrLen($Login) > 12))

{
echo "Login must have more 4 and not more 10 symbols.";exit;
}

elseif ((StrLen($Pass) < 4) or (StrLen($Pass) > 12))

{
echo "Password must have more 4 and not more 15 symbols.";exit;
}

$Result = MySQL_Query("SELECT name FROM users WHERE name='$Login'") or die("SQL à répondu : $query".mysql_error());

if (MySQL_Num_Rows($Result))
{	
$Salt = $Login.$Pass;
$Salt = md5($Salt);
$Salt = "0x".$Salt;
MySQL_Query("call changePasswd('$Login', $Salt)") or die("SQL à répondu : $query".mysql_error());
$result2 = mysql_query("SELECT * FROM users WHERE name='$Login'") or die("SQL à répondu : $query".mysql_error());
}

$Result = MySQL_Query("SELECT name FROM users WHERE name='$Login'") or die("SQL à répondu : $query".mysql_error());

if (MySQL_Num_Rows($Result))
{
echo "Changing password for the account <b>".$Login."</b> has <font color=lightgreen>sucess</font><br>";exit;
}

else

{
echo "Changing password for the account <b>".$Login."</b> has <font color=red>failed</font><br>"; exit;

}

}

echo $Data;
	
?>