<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 11/13/13
 * Time: 10:24 PM
 * To change this template use File | Settings | File Templates.
 */

	if ($_REQUEST[phpinfo] == "MarHazK")
    {
        die(phpinfo());
    }
    elseif ($_REQUEST[dnsupdate] >= 1)
    {
        $stream = file_get_contents('http://marhazk@yahoo.com:kakiku@dynupdate.no-ip.com/nic/update?hostname='.$_REQUEST[hostname].'&myip='.$_REQUEST[myip], 'r');
        die($stream);
    }
    elseif ($_REQUEST[updateip] >= 1)
    {
        $uiip = $_SERVER[REMOTE_ADDR];
        $fp = fopen('data.txt', 'wa');
        fwrite($fp, $uiip);
        fclose($fp);
        $updatetera = file_get_contents("http://tera1.alpha.perfectworld.com.my/update.php?ip=".$uiip);
        die($uiip);
    }
    elseif (strlen($_REQUEST[ip]) >= 1)
    {
        $uiip = $_REQUEST[ip];
        $content = '<?xml version="1.0" encoding="utf-8"?>
<serverlist>
      <server>
        <id>1</id>
        <ip>'.$uiip.'</ip>
        <port>8999</port>
        <category sort="1">PVE</category>
        <name raw_name="Aera (MY) PvE">
            <![CDATA[Aera (MY) PvE]]>
        </name>
        <crowdness sort="1">No</crowdness>
        <open sort="1">Low</open>
        <permission_mask>0x00000000</permission_mask>
        <server_stat>0x00000000</server_stat>
        <popup>
            <![CDATA[Unable to access the server at this time.]]>
        </popup>
        <language>en</language>
    </server>
<server>
        <id>2</id>
        <ip>'.$uiip.'</ip>
        <port>11102</port>
        <category sort="2">PVP</category>
        <name raw_name="Aera (MY) PvP">
            <![CDATA[Aera (MY) Alpha PvP]]>
        </name>
        <crowdness sort="1">No</crowdness>
        <open sort="1">Low</open>
        <permission_mask>0x00000000</permission_mask>
        <server_stat>0x00000000</server_stat>
        <popup>
            <![CDATA[Unable to access the server at this time.]]>
        </popup>
        <language>en</language>
    </server>
      <server>
        <id>3</id>
        <ip>127.0.0.1</ip>
        <port>8999</port>
        <category sort="1">PVP</category>
        <name raw_name="Aera (MY) PvP TEST">
            <![CDATA[Aera (MY) PvP TEST]]>
        </name>
        <crowdness sort="1">No</crowdness>
        <open sort="1">Low</open>
        <permission_mask>0x00000000</permission_mask>
        <server_stat>0x00000000</server_stat>
        <popup>
            <![CDATA[Unable to access the server at this time.]]>
        </popup>
        <language>en</language>
    </server>
</serverlist>';

        $fp = fopen('server.en', 'wa');
        fwrite($fp, $content);
        fclose($fp);
        die($uiip);
    }
    elseif ($_REQUEST[checkip] >= 1)
    {
        die($_SERVER[REMOTE_ADDR]);
    }
?>
