<?php if ($gmuser >= 5) {
	
?>
<h1><?php
	$bstat = -1;
    function broadcast($message){
		//include "data.php";
            $sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
            if($sock){
                    if(socket_connect($sock, "perfectworld.sytes.net", 29100)){
                            socket_set_block($sock);
                            $data2 = mByte(9) . mByte(0) . mInt(-1) . mInt(0) . mString($message);
                            $data = mUInt32(79) . mUInt32(strlen($data2)) . $data2;
                            socket_send($sock, $data, 8192, 0);
							$bstat = 5;
                            socket_set_nonblock($sock);
                            socket_close($sock);
                            return 5;
                    } else {
                            return 1;
                    }
            }
    }
    
    // pack - http://ru2.php.net/pack
    function mByte($p) { return pack('C', $p & 0xFF); }
    
    function mf($i, $j) { return ($i >> $j) & 0xFF; }
    function mBytes($p, $from)
    {
            $packed = '';
            for ($i = $from; $i >= 0; $i -= 8)
                    $packed .= mByte(mf($p,$i));
            return $packed;
    }
    
    function mChar($p) { return mByte(mf($p,0)) . mByte(mf($p,8)); }
    function mString($s)
    {
            $s=iconv('utf-8','utf-16le',$s);
            $ret = mUInt32(mb_strlen($s));//mUInt32(count($s) * 2);
            $s=array_merge(unpack("n*",$s));
            for ($i = 0;$i < count($s); $i++)
            {
                    $ret .= mByte(($s[$i]) >> 8);
                    $ret .= mByte($s[$i]);
            }
            return $ret;
    }
    
    function mShort($p) { return mBytes($p,8); }
    function mInt($p) { return mBytes($p,24); }
    function mLong($p) { return mBytes($p,56); }
    
    function mUInt32($p) {
            if ($p < 64)
                    return mByte($p);
            if ($p < 16384)
                    return mShort($p | 0x8000);
            if ($p < 536870912)
                    return mInt($p | 0xC0000000);
            return mInt(-32) . mInt($p);
    }
    function mSInt32($p) {
            if ($p >= 0)
                    return mUInt32($p);
            $t=-$p;
            if ($t < 64)
                    return mByte($p | 0x40);
            if ($t < 16384)
                    return mShort($p | 0xA000);
            if ($t < 536870912)
                    return mInt($p | 0xD0000000);
            return mInt(-16). mInt($p);
    }
    
    function mOctets($p) {
            $packed = mUInt32(count($p));
            for ($i = 0; $i < count($p); $i++)
                    $packed .= mByte($p[$i]);
            return $packed;
    }
	if ($_POST[opchk] == "SEND")
	{
			$bstat = broadcast($_POST["bmsg"]);
			$_REQUEST[bstat] = $bstat;
	}
	if ($_REQUEST[bstat] == 5)
		echo "Your message has successfully broadcasted";
	else if ($_REQUEST[bstat] == 1)
		echo "Error to broadcast, your messages is too long or empty. Please try again later.";
	else
		echo "Please fill the blank below to broadcast";
?></h1>
<form method=post>
<table width="100%%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="100%" colspan=2 align="center" valign="top"><B>BROADCAST NOW</b></td>
    </tr>
    <tr>
      <td width="30%" align="right" valign="top">Broadcast Message :</td>
      <td width="70%" align="left" valign="top"><p>
        <textarea name="bmsg" cols="50" rows="10" id="bmsg"><?php echo $_POST["bmsg"];?></textarea><BR>
        <input type=submit name=opchk value="SEND" />
      </p>
</td>
    </tr>

  </table>
  </form>
  <?php } ?>