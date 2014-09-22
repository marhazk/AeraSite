<? 
    include "/root/configs.tools.php"; //Path to your config file 
         
    if (isset($_POST['login'])) 
        { 
            $Link = MySQL_Connect($DBHost, $DBUser, $DBPassword) or die (); 
            MySQL_Select_Db($DBName, $Link) or die ("Database ".$DBName." does not exists."); //Connect to the database, or "die" and give the error message 
             

             
            $Login = StrToLower(Trim($Login)); 
            $Pass = StrToLower(Trim($Pass)); 
            $Repass = StrToLower(Trim($Repass)); 
            
     
        if (empty($Login) || empty($Pass) || empty($Repass) //Checks if any of the fields were left empty 
            { 
                echo "<br /><font color='red'>Please complete all fields.</font><br />"; 
            } 
         
         
        elseif (ereg("[^0-9a-zA-Z_-]", $Login, $Txt)) //Checks to see if any of the characters entered in the login field were "illegal" which could cause sql injection. 
            { 
                echo "<br /><font color='red'>Username contains illegal characters.</font><br />"; 
            }             
        elseif (ereg("[^0-9a-zA-Z_-]", $Pass, $Txt)) //Checks to see if any of the characters entered in the password field were "illegal" which could cause sql injection. 
            { 
                echo "<br /><font color='red'>Password contains illegal characters.</font><br />";     
            } 
         
        elseif (ereg("[^0-9a-zA-Z_-]", $Repass, $Txt)) //Checks to see if any of the characters entered in the repeat password field were "illegal" which could cause sql injection. 
            { 
                echo "<br /><font color='red'>Password contains illegal characters.</font><br />";     
            } 
    
        else 
            { 
                $Result = MySQL_Query("SELECT name FROM users WHERE name='$Login'") or ("Can't execute username check."); //Checks if the username was already registered. 
                 
        if (MySQL_Num_Rows($Result)) 
            { 
                echo "<br /><font color='red'>Username <b>".$Login."</b> has already been registered.</font><br />"; 
            } 
        elseif ((StrLen($Login) < 4) or (StrLen($Login) > 10)) //Limits the amount of characters in the username field. 
         
            { 
                echo "<br /><font color='red'>Username is too short. Must be between 4 and 10 characters.</font><br />"; 
            } 
        elseif ((StrLen($Pass) < 4) or (StrLen($Pass) > 10)) //Limits the amount of characters in the password field. 
         
            { 
                echo "<br /><font color='red'>Password is too short. Must be between 4 and 10 characters.</font><br />"; 
            } 
             
        elseif ((StrLen($Repass) < 4) or (StrLen($Repass) > 10)) //Limits the amount of characters in the repeat password field. 
            { 
                echo "<br /><font color='red'>Password is too short. Must be between 4 and 10 characters.</font><br />"; 
            } 
             
 
         
        elseif ($Pass != $Repass) //Checks to see if the password and repeat password fields match. 
            { 
                echo "<br /><font color='red'>Passwords do not match.</font><br />"; 
            }         
        else 
            { 
                $Salt = $Login.$Pass; 
                $Salt = md5($Salt); 
                $Salt = "0x".$Salt; //Encrypts the password 
                MySQL_Query("call adduser('$Login', $Salt, '0', '0', '0', '0', 'history@history', '0', '0', '0', '0', '0', '0', '0', '', '0', $Salt)") or die ("Can't execute query."); //Enters the information into the database 
                echo "<br /><font color='Green'>Username <b>".$Login."</b> created successfully!</font><br />"; 
            }         
        }     
    } 

     
?> 
