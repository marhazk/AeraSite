<?

//Function --

function rose_test($name,$ip,$port){

    $fp=fsockopen($ip, $port, &$errno, &$errmsg,1);
    if(!$fp){
        
        if(stristr($errmsg,'refused')){
            return "<font color='#0f5caa'><b>$name</b>:</font>&nbsp;<font color=orange><i>$errmsg</i>.</font><br>";
        }else{
            return "<font color='#0f5caa'><b>$name</b>:</font>&nbsp;<font color=red><i>$errmsg</i>.</font><br>";
        };

    }else{

        return "<font color='#0f5caa'><b>$name</b>:</font>&nbsp;<font color=green><i>Online</i>.</font><br>";
        
    };
};

//--Server IP

$server_names=array('Login Server', 'Account Server', 'Map Server', 'Web Server');
$server_ips=array('127.0.0.1','127.0.0.1','127.0.0.1','127.0.0.1');
$server_ports=array('29000','29100','29200','80');

//--HTML Result

echo "<title>Rose Online Server Status - Auto Refresh Every 60 Seconds</title>";
echo "<style>body{font-family:verdana; font-size:11px; background-color:#c0c0c0;}</style>";

echo "<b><i>Login Server</b></i><br>";
echo rose_test($server_names[0],$server_ips[0],$server_ports[0]);
echo "<br><br>";
echo "<b><i>Account Server</b></i><br>";
echo rose_test($server_names[1],$server_ips[1],$server_ports[1]);
echo "<br><br>";
echo "<b><i>Map Server</b></i><br>";
echo rose_test($server_names[2],$server_ips[2],$server_ports[2]);
echo "<br><br>";
echo "<b><i>Web Server</b></i><br>";
for($i=3;$i<4;$i++){
    echo rose_test($server_names[$i],$server_ips[$i],$server_ports[$i]);
};
echo "<meta http-equiv='refresh' content='60'>";
?> 