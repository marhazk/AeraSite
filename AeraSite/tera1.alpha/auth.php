<?php
include "config.php"; // the database configuration file. Update this to connect to your databse

//Gets Input from launcher
$username = $_REQUEST['username']; //username
$password = $_REQUEST['password']; //password

//check if the form was submitted
if((isset($_REQUEST['username']) && $_REQUEST['password'] != ""))
{
        //check whether the username and e-mail exist or not
        $sql="select *from accounts where (Username='".$_REQUEST['username']."')";
        $results=mysql_query($sql) or die(mysql_error());
        if(mysql_num_rows($results)>0)
		{
                $row=mysql_fetch_array($results);
                //check the username
				if($_REQUEST['username']==$row['Username'])
				{
                    if($_REQUEST['password']==$row['Password'])
                    {
                        //echo 'username='.$_REQUEST['username'].'&password='.$_REQUEST['password'];
                        echo $_REQUEST['username'].';'
                            .'OK;'
                            .$row['Coins'].';'
                            .$row['ver'].';'
                            .'NA;'
                            .'NA;'
                            .'NA;'
                            .'NA;';
                    }
                    else
                    {

                        echo $_REQUEST['username'].';'
                            .'WRONGPASS;'
                            .$row['Coins'].';'
                            .$row['ver'].';'
                            .'NA;'
                            .'NA;'
                            .'NA;'
                            .'NA;';
                    }
                }
				else
				{
				//somethings wrong return empty string
				echo ("username=&password=");
                }
        }
}
?> 