<?php
    include "config.php";
    
    $Data = '<form action=index.php method=post>
     Login:  
    <input type=text name=login>
     Password:
    <input type=password name=passwd>
     Repeat password:
    <input type=password name=repasswd>
    Email:
    <input type=text name=email>
    <input type=submit name=submit value="Registration">
    </form>';
        
    if (isset($_POST['login']))
        {
            $Link = MySQL_Connect($DBHost, $DBUser, $DBPassword) or die ("Can't connect to MySQL");
            MySQL_Select_Db($DBName, $Link) or die ("Database ".$DBName." do not exists.");
            
            $Login = $_POST['login'];
            $Pass = $_POST['passwd'];
            $Repass = $_POST['repasswd'];
            $Email = $_POST['email'];
            
            $Login = StrToLower(Trim($Login));
            $Pass = StrToLower(Trim($Pass));
            $Repass = StrToLower(Trim($Repass));
            $Email = Trim($Email);
    
        if (empty($Login) || empty($Pass) || empty($Repass) || empty($Email))
            {
                echo "All fields is empty.";
            }
        
        elseif (ereg("[^0-9a-zA-Z_-]", $Login, $Txt))
            {
                echo "Login have a incorrect format.";
            }
            
        elseif (ereg("[^0-9a-zA-Z_-]", $Pass, $Txt))
            {
                echo "Password have a incorrect format.";    
            }
        
        elseif (ereg("[^0-9a-zA-Z_-]", $Repass, $Txt))
            {
                echo "Repeat password have a incorrect format.";    
            }
        elseif (StrPos('\'', $Email))
            {
                echo "Email have a incorrect format.";    
            }    
        else
            {
                $Result = MySQL_Query("SELECT name FROM users WHERE name='$Login'") or  die(mysql_error());
                
        if (MySQL_Num_Rows($Result))
            {
                echo "Account <b>".$Login."</b> is exists";
            }
        
        elseif ((StrLen($Login) < 4) or (StrLen($Login) > 10)) 
        
            {
                echo "Login must have more 4 and not more 10 symbols.";
            }
            
        elseif ((StrLen($Pass) < 4) or (StrLen($Pass) > 10)) 
        
            {
                echo "Password must have more 4 and not more 10 symbols.";
            }
            
        elseif ((StrLen($Repass) < 4) or (StrLen($Repass) > 10)) 
            {
                echo "Repeat password must have more 4 and not more 10 symbols.";
            }
            
        elseif ((StrLen($Email) < 4) or (StrLen($Email) > 25)) 
            {
                echo "Email must have more 4 and not more 25 symbols.";
            }
        
        elseif ($Pass != $Repass)
            {
                echo "Password mismatch.";
            }        
        else
            {
                $Salt = "0x".md5($Login.$Pass);
                MySQL_Query("call adduser('$Login', '$Salt', '0', '0', '0', '0', '$Email', '0', '0', '0', '0', '0', '0', '0', '', '', '$Pass')") or die ("Can't execute query.".mysql_error());
		$mysqlresult=MySQL_Query("select * from `users` WHERE `name`='$Login'");
		$User_ID=MySQL_result($mysqlresult,0,'ID');
		MySQL_Query("call usecash('$User_ID',1,0,19,0,50000,1,@error)") or die ("usecash failed!");
                echo "Account <b>".$Login."(".$User_ID.")"."</b> has been registered.";
            }        
        }    
    }
    
    echo $Data;    
    
?> 