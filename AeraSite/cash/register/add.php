<?php
include "config.php";

if (isset($_REQUEST['login'])) {
    $Link = MySQL_Connect($DBHost, $DBUser, $DBPassword) or die ("Can't connect to MySQL");
    MySQL_Select_Db($DBName, $Link) or die ("Database " . $DBName . " do not exists.");

    $Login = $_REQUEST['login'];
    $Pass = $_REQUEST['passwd'];
    $Repass = $_REQUEST['passwd'];
    $Email = $_REQUEST['email'];

    $Login = StrToLower(Trim($Login));
    $Pass = StrToLower(Trim($Pass));
    $Repass = StrToLower(Trim($Repass));
    $Email = Trim($Email);

    if (empty($Login) || empty($Pass) || empty($Repass) || empty($Email)) {
        echo 0; //echo "All fields is empty.";
    } else {
        $Result = MySQL_Query("SELECT name FROM users WHERE name='$Login'") or  die(mysql_error());

        if (MySQL_Num_Rows($Result)) {
            echo 1; //echo "Account <b>" . $Login . "</b> is exists";
        } else {
            $Salt = "0x" . md5($Login . $Pass);
            MySQL_Query("call adduser('$Login', '$Salt', '0', '0', '0', '0', '$Email', '0', '0', '0', '0', '0', '0', '0', '', '', '$Pass')") or die ("Can't execute query." . mysql_error());
            $mysqlresult = MySQL_Query("select * from `users` WHERE `name`='$Login'");
            $User_ID = MySQL_result($mysqlresult, 0, 'ID');
            MySQL_Query("call usecash('$User_ID',1,0,19,0,50000,1,@error)") or die ("usecash failed!");
            echo $User_ID;
        }
    }
}
?> 