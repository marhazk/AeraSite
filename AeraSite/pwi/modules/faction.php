<?php error_reporting (E_ALL ^ E_NOTICE); error_reporting(0); ?><?
<?php header ('Content-type: text/html; charset=utf-8');

function cuint($data)
{
        if($data < 64)
                return strrev(pack("C", $data));
        else if($data < 16384)
                return strrev(pack("S", ($data | 0x8000)));
        else if($data < 536870912)
                return strrev(pack("I", ($data | 0xC0000000)));
        return strrev(pack("c", -32) . pack("I", $data));
}
if(isset($_GET['fid'])){
$fid = $_GET['fid'];
$sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
if(!$sock)
        die(socket_strerror(socket_last_error()));
if(socket_connect($sock, "192.168.1.5", "29400"))
{
    socket_set_block($sock);
    $data= cuint(4608)."\x08\x80\x00\x00\x01".strrev(pack("I",$fid));
    socket_send($sock, $data, 8192, 0);
    socket_recv($sock, $buf, 8192, 0);
    socket_set_nonblock($sock);
    socket_close($sock);
        $pos14 = ord(substr($buf, 14, 1));

        if (ereg("[^0-9a-zA-Z_-]", $pos14, $pos14)){
        $fnamelen = ord(substr($buf, 15, 1));
        $pholder = 15;
        }else{
        $fnamelen = ord(substr($buf, 16, 1));
        $pholder = 16;}
        $fname = iconv("UCS-2LE", "UTF-8", substr($buf, $pholder+1, $fnamelen));
        $flvl = ord(substr($buf, $pholder+$fnamelen+1, 1))+1;
        $fmasterid = hexdec(bin2hex(substr($buf, $pholder+$fnamelen+2, 4)));
        $fcommentlen = ord(substr($buf, $pholder+$fnamelen+6, 1));
        $fcomment = iconv("UCS-2LE", "UTF-8", substr($buf, $pholder+$fnamelen+7, $fcommentlen));
        $fcount = ord(substr($buf, $pholder+$fnamelen+$fcommentlen+8, 1));
        echo "<b>Faction id:</b> ".$fid."<br><b>Faction name:</b> ".$fname."<br><b>Faction level:</b> ".$flvl."<br><b>Faction master id:</b> ".$fmasterid."<br><b>Faction info:</b> ".$fcomment."<br><b>Faction members count:</b> ".$fcount;
        echo "<br><br><b>Faction members:</b><br><table width=60% border=1><tr><td align='center'><b>Role id</b></td><td align='center'><b>Role name</b></td><td align='center'><b>Role rank</b></td><td align='center'><b>Role title</b></td><td align='center'><b>Role level</b></td><td align='center'><b>Role class</b></td></tr>";
        $holder = $pholder+$fnamelen+$fcommentlen+9;
        for($i = 0; $i < $fcount; $i++){            
            $rid = hexdec(bin2hex(substr($buf, $holder, 4)));
            $rlvl = ord(substr($buf, $holder+4, 1));
            $rcls = ord(substr($buf, $holder+5, 1));
            if ($rcls == 0){$rcls='Blademaster';}else{
            if ($rcls == 1){$rcls='Wizard';}else{
            if ($rcls == 2){$rcls='Monk';}else{
            if ($rcls == 3){$rcls='Venomancer';}else{
            if ($rcls == 4){$rcls='Barbarian';}else{
            if ($rcls == 6){$rcls='Archer';}else{
            if ($rcls == 7){$rcls='Cleric';}else{$rcls='IDK';}}}}}}}
            $rrank = ord(substr($buf, $holder+6, 1));
            if ($rrank == 2){$rrank='Guild Master';}else{
            if ($rrank == 3){$rrank='Vice GM';}else{
            if ($rrank == 4){$rrank='Commander';}else{
            if ($rrank == 5){$rrank='Captain';}else{
            if ($rrank == 6){$rrank='Normal';}}}}}
            $rnamelen = ord(substr($buf, $holder+10, 1));
            $rname = iconv("UCS-2LE", "UTF-8", substr($buf, $holder+11, $rnamelen));
            $rtitlelen = ord(substr($buf, $holder+$rnamelen+11, 1));
            $rtitle = iconv("UCS-2LE", "UTF-8", substr($buf, $holder+$rnamelen+12, $rtitlelen));
            echo "<tr><td align='center'>".$rid."</td><td align='center'>".$rname."</td><td align='center'>".$rrank."</td><td align='center'>".$rtitle."</td><td align='center'>".$rlvl."</td><td align='center'>".$rcls."</td></tr>";
            $holder = $holder+$rnamelen+$rtitlelen+12;}
            echo "</table>";                    
}else{die(socket_strerror(socket_last_error()));}}else {echo "Please Enter Fid like this: test.php?fid=4 ";}
?> 