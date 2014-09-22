<?php
require "marshalling.php";

function hexdump($data, $htmloutput = true, $uppercase = false, $return = false)
{
        $hexi   = '';
        $ascii  = '';
        $dump   = ($htmloutput === true) ? '<pre>' : '';
        $offset = 0;
        $len    = strlen($data);
        $x = ($uppercase === false) ? 'x' : 'X';

        for ($i = $j = 0; $i < $len; $i++)
        {
                $hexi .= sprintf("%02$x ", ord($data[$i]));     // Convert to hexidecimal
                if (ord($data[$i]) >= 32)                       // Replace non-viewable bytes with '.'
                        $ascii .= ($htmloutput === true) ? htmlentities($data[$i]) : $data[$i];
                else
                        $ascii .= '.';

                if (++$j === 16 || $i === $len - 1)
                {
                        $dump .= sprintf("%04$x  %-49s  %s", $offset, $hexi, $ascii); // Join the hexi / ascii output

                        $hexi   = $ascii = '';
                        $offset += 16;
                        $j      = 0;

                        if ($i !== $len - 1)
                                $dump .= "\n";
                }
        }

        $dump .= $htmloutput === true ? '</pre>' : '';
        $dump .= "\n";

        if ($return === false) {
                echo $dump;
        } else {
                return $dump;
        }
}


// interaction logic
$sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP); // http://ru.php.net/manual/en/function.socket-create.php
if(!$sock)
        die(socket_strerror(socket_last_error()));

// 127.0.0.1:29100 - Deliveryd
// 127.0.0.1:29400 - GameDbd
// 127.0.0.1:29401 - UniqueNamed
// 127.0.0.1:29500 - Factiond
if(socket_connect($sock, "192.168.1.5", "29400")) // http://ru.php.net/manual/en/function.socket-connect.php
{
        $debug = true;
        socket_set_block($sock); // blocking script

// GetUserRoles --// GameDbd
        $data = mUInt32(3032) . mByte(8) . mShort(32768) . mShort(0x2076) . mInt(32);

// GetUserInfo --// GameDbd
        //$data = mUInt32(3002) . mByte(8) . mShort(32768) . mShort(0x2076) . mInt(64);

// GetUserIdByName --// GameDbd
        //$msg = "gouranga";
        //$data2 = mShort(32768) . mShort(0x2076) . mString($msg);
        //$data = mUInt32(3033) . mUInt32(strlen($data2)) . $data2;

// WorldChat --// Deliveryd
        //$msg = "test";
        //$data2 = mByte(9) . mByte(0) . mInt(-1) . mInt(0) . mString($msg);
        //$data = mUInt32(79) . mUInt32(strlen($data2)) . $data2;

        if ($debug && false !== ($sbytes = socket_send($sock, $data, 8192, 0))) {
                echo "<p>Sended $sbytes bytes from socket_send():</p>";
                hexdump($data);
        } else {
                die("socket_send() failed; reason: " . socket_strerror(socket_last_error($socket)));
        }

        if ($debug && false !== ($rbytes = socket_recv($sock, $buf, 8192, 0))) {
                echo "<p>Readed $rbytes bytes from socket_recv():</p>";
                hexdump($buf);
        } else {
                die("socket_recv() failed; reason: " . socket_strerror(socket_last_error($socket)));
        }

        socket_set_nonblock($sock);
        socket_close($sock);
}
else
{
        die(socket_strerror(socket_last_error()));
} 
?>