#!/usr/bin/perl -w

use CGI qw(fatalsToBrowser);

my $gQ = new CGI;
print $gQ->header( -type=>'text/html', -charset=>'gb2312');

my $action = $gQ->param('action');

$gQ->print( "<html><head><title>��������-��Ϸ���й���</title>" );
$gQ->print( "<META HTTP-EQUIV=\"Pragma\" CONTENT=\"no-cache\"></head>" );
$gQ->print( "<body>\n<br>&nbsp;<br>" );
$gQ->print( "<table border=0 cellpadding=0 width=750 align=center><tr><td>" );

if( $action eq 'status' )
{
	$gQ->print( "<P align=left>��������״̬��</P><br><PRE>" );
	$gQ->print( "uniquename:" );	system( "/usr/bin/snmpwalk -Oqv backup 1.3.6.1.4.1.2021.2.1.5.8" );
	$gQ->print( "database:  " );	system( "/usr/bin/snmpwalk -Oqv database 1.3.6.1.4.1.2021.2.1.5.2" );
	$gQ->print( "gacd:      " );	system( "/usr/bin/snmpwalk -Oqv delivery 1.3.6.1.4.1.2021.2.1.5.7" );
	$gQ->print( "faction:   " );	system( "/usr/bin/snmpwalk -Oqv delivery 1.3.6.1.4.1.2021.2.1.5.3" );
	$gQ->print( "delivery:  " );	system( "/usr/bin/snmpwalk -Oqv delivery 1.3.6.1.4.1.2021.2.1.5.4" );
	$gQ->print( "link1:     " );	system( "/usr/bin/snmpwalk -Oqv link1 1.3.6.1.4.1.2021.2.1.5.5" );
	#$gQ->print( "link2:     " );	system( "/usr/bin/snmpwalk -Oqv link2 1.3.6.1.4.1.2021.2.1.5.5" );
	$gQ->print( "game1:     " );	system( "/usr/bin/snmpwalk -Oqv game1 1.3.6.1.4.1.2021.2.1.5.6" );
	$gQ->print( "game2:     " );	system( "/usr/bin/snmpwalk -Oqv game2 1.3.6.1.4.1.2021.2.1.5.6" );
	$gQ->print( "game3:     " );	system( "/usr/bin/snmpwalk -Oqv game3 1.3.6.1.4.1.2021.2.1.5.6" );
	#$gQ->print( "game4:     " );	system( "/usr/bin/snmpwalk -Oqv game4 1.3.6.1.4.1.2021.2.1.5.6" );
	#$gQ->print( "game5:     " );	system( "/usr/bin/snmpwalk -Oqv game5 1.3.6.1.4.1.2021.2.1.5.6" );
	#$gQ->print( "game6:     " );	system( "/usr/bin/snmpwalk -Oqv game6 1.3.6.1.4.1.2021.2.1.5.6" );
	#$gQ->print( "game7:     " );	system( "/usr/bin/snmpwalk -Oqv game7 1.3.6.1.4.1.2021.2.1.5.6" );
	$gQ->print( "</PRE><br><P align=left>��ɡ�</P><br>" );
}
elsif( $action eq 'psstatus' )
{
	$gQ->print( "<P align=left>���н���״̬��</P><br><PRE>" );
	logps( 'psstatus' );
	system( "/usr/sbin/rshrun --loadall /bin/ps -aux 2>/dev/null" );
	system( "/usr/sbin/rshrun --loadall /bin/ps -lxf 2>/dev/null" );
	system( "/usr/sbin/rshrun --loadall /bin/ps -antp 2>/dev/null" );
	$gQ->print( "</PRE><br><P align=left>��ɡ�</P><br>" );
}
elsif( $action eq 'ipenable' )
{
	$gQ->print( "<P align=left>ִ�н����</P><br><PRE>" );
	system( "/root/bin/ipenable.sh" );
	$gQ->print( "</PRE><br><P align=left>��ɡ�</P><br>" );
}
elsif( $action eq 'ipdisable' )
{
	$gQ->print( "<P align=left>ִ�н����</P><br><PRE>" );
	system( "/root/bin/ipdisable.sh" );
	$gQ->print( "</PRE><br><P align=left>��ɡ�</P><br>" );
}
elsif( $action eq 'restarttomcat' )
{
	$gQ->print( "<P align=left>ִ�н����</P><br><PRE>" );
	if( 0 == fork() )
	{
		exec( "/root/bin/restarttomcat.sh &" );
		exit;
	}
	$gQ->print( "</PRE><br><P align=left>��ɡ�</P><br>" );
}
elsif( $action eq 'shutdowngame' )
{
	$gQ->print( "<P align=left>���ڹر���Ϸ����......</P><br><PRE>" );
	logps( 'shutdowngame' );
	if( 0 == fork() )
	{
		system( "/usr/bin/killall -w -9 servicerun >/dev/null 2>&1" );
		sleep( 1 );
		exec( "/usr/sbin/servicerun --graceful >/dev/null 2>&1 &" );
		exit;
	}
	$gQ->print( "</PRE><br><P align=left>��Ϸ�����ѹرա�</P><br>" );
}
elsif( $action eq 'restartgame' )
{
	$gQ->print( "<P align=left>��������������Ϸ����......</P><br><PRE>" );
	logps( 'restartgame' );
	if( 0 == fork() )
	{
		system( "/usr/bin/killall -w -9 servicerun >/dev/null 2>&1" );
		sleep( 1 );
		system( "/usr/sbin/servicerun --graceful >/dev/null 2>&1 &" );
		sleep( 60 );
		system( "/usr/bin/killall -w -9 servicerun >/dev/null 2>&1" );
		sleep( 1 );
#		system( "/usr/sbin/rshrun --loadall /usr/bin/killall -w -9 loader >/dev/null 2>&1" );
#		system( "/usr/sbin/rshrun --loadall /usr/bin/killall -w -9 gs >/dev/null 2>&1" );
#		system( "/usr/sbin/rshrun --loadall /usr/bin/killall -w -9 glinkd >/dev/null 2>&1" );
#		system( "/usr/sbin/rshrun --loadall /usr/bin/killall -w -9 gdeliveryd >/dev/null 2>&1" );
#		system( "/usr/sbin/rshrun --loadall /usr/bin/killall -w -9 gfactiond >/dev/null 2>&1" );
#		system( "/usr/sbin/rshrun --loadall /usr/bin/killall -w -9 gacd >/dev/null 2>&1" );
		sleep( 1 );
		exec( "/usr/sbin/servicerun --restart >/dev/null 2>&1 &" );
		exit;
	}
	$gQ->print( "</PRE><br><P align=left>��Ϸ����������������</P><br>" );
}
elsif( $action eq 'repairgame' )
{
	$gQ->print( "<P align=left>�����޸�������Ϸ����......</P><br><PRE>" );
	logps( 'repairgame' );
	if( 0 == fork() )
	{
		system( "/usr/bin/killall -w -9 servicerun >/dev/null 2>&1" );
		sleep( 1 );
		exec( "/usr/sbin/servicerun --start >/dev/null 2>&1 &" );
		exit;
	}
	$gQ->print( "</PRE><br><P align=left>��Ϸ����������������</P><br>" );
}
elsif( $action eq 'shutdowndb' )
{
	$gQ->print( "<P align=left>���ڹر����ݿ����......</P><br><PRE>" );
	logps( 'shutdowndb' );
	if( 0 == fork() )
	{
		system( "/usr/bin/rsh database /bin/touch /tmp/.quitgamedbd" );
		sleep( 80 );
		system( "/usr/bin/rsh database /usr/bin/killall -SIGHUP gamedbd >/dev/null 2>&1" );
		sleep( 15 );
		system( "/usr/bin/rsh database /usr/bin/killall -SIGABRT gamedbd >/dev/null 2>&1" );
		sleep( 3 );
		system( "/usr/bin/rsh database /usr/bin/killall -SIGUSR1 gamedbd >/dev/null 2>&1" );
		sleep( 3 );
		system( "/usr/bin/rsh database /bin/rm -f /tmp/.quitgamedbd" );
		exec( "/usr/bin/rsh database /usr/bin/killall -w -9 gamedbd >/dev/null 2>&1" );
		exit;
	}
	$gQ->print( "</PRE><br><P align=left>���ݿ�����ѹرա�</P><br>" );
}
elsif( $action eq 'restartdb' )
{
	$gQ->print( "<P align=left>���������������ݿ����......</P><br><PRE>" );
	logps( 'restartdb' );
	if( 0 == fork() )
	{
		system( "/usr/bin/rsh database /bin/touch /tmp/.quitgamedbd" );
		sleep( 80 );
		system( "/usr/bin/rsh database /usr/bin/killall -SIGHUP gamedbd >/dev/null 2>&1" );
		sleep( 15 );
		system( "/usr/bin/rsh database /usr/bin/killall -SIGABRT gamedbd >/dev/null 2>&1" );
		sleep( 3 );
		system( "/usr/bin/rsh database /usr/bin/killall -SIGUSR1 gamedbd >/dev/null 2>&1" );
		sleep( 3 );
		system( "/usr/bin/rsh database /usr/bin/killall -w -9 gamedbd >/dev/null 2>&1" );
		sleep( 1 );
		system( "/usr/bin/rsh database /bin/rm -f /tmp/.quitgamedbd" );
		exec( "/usr/bin/rsh database 'cd /root/gamedbd;/root/gamedbd/gamedbd /root/gamedbd/gamesys.conf' >/dev/null 2>&1 &" );
		exit;
	}
	$gQ->print( "</PRE><br><P align=left>���ݿ����������������</P><br>" );
}
elsif( $action eq 'shutdownuniquename' )
{
	$gQ->print( "<P align=left>���ڹر�Ψһ������......</P><br><PRE>" );
	logps( 'shutdownuniquename' );
	if( 0 == fork() )
	{
		system( "/usr/bin/rsh backup /usr/bin/killall -SIGUSR1 uniquenamed >/dev/null 2>&1" );
		sleep( 5 );
		exec( "/usr/bin/rsh backup /usr/bin/killall -w -9 uniquenamed >/dev/null 2>&1" );
		exit;
	}
	$gQ->print( "</PRE><br><P align=left>Ψһ�������ѹرա�</P><br>" );
}
elsif( $action eq 'restartuniquename' )
{
	$gQ->print( "<P align=left>������������Ψһ������......</P><br><PRE>" );
	logps( 'restartuniquename' );
	if( 0 == fork() )
	{
		system( "/usr/bin/rsh backup /usr/bin/killall -SIGUSR1 uniquenamed >/dev/null 2>&1" );
		sleep( 5 );
		system( "/usr/bin/rsh backup /usr/bin/killall -w -9 uniquenamed >/dev/null 2>&1" );
		sleep( 1 );
		exec( "/usr/bin/rsh backup 'cd /root/uniquenamed;/root/uniquenamed/uniquenamed /root/uniquenamed/gamesys.conf' >/dev/null 2>&1 &" );
		exit;
	}
	$gQ->print( "</PRE><br><P align=left>���ݿ����������������</P><br>" );
}

elsif( $action eq 'redist' )
{
	$gQ->print( "<P align=left>�������·�����Ϸ......</P><br><PRE>" );
	logps( 'redist' );
	if( 0 == fork() )
	{
		exec( "/root/bin/redist.sh  >/var/log/control.log 2>&1 &" );
		exit;
	}
	$gQ->print( "</PRE><br><P align=left>����Ϸ�汾���ڲ��𣬴����Ҫ3���ӡ�</P><br>" );
}
elsif( $action eq 'restartmanager' )
{
	$gQ->print( "<P align=left>������������manager����......</P><br><PRE>" );
	#system( "/sbin/reboot" );
	$gQ->print( "</PRE><br><P align=left>Ŀǰ��δ���š�</P><br>" );
}
else
{
	$gQ->print( "<P align=left>��֧�ִ˲�����</P><br>" );
}

$gQ->print("</td></tr><tr><td align=center><br><a href=\"javascript:window.history.back(-1);\">����</a><br>");
$gQ->print( "</td></tr></table>" );
$gQ->print( "</body></html>\n" );

sub logps
{
	my ($title) = @_;
	my $cmd = "/bin/date +%Y%m%d-%H%M%S";
	my $t = qx/$cmd/;
	chomp($t);
	system( "/bin/echo \"\" >> /var/log/status.log" );
	system( "/bin/echo $title >> /var/log/status.log" );
	system( "/bin/echo $t >> /var/log/status.log" );
	system( "/usr/sbin/rshrun --loadall /bin/ps -aux >> /var/log/status.log 2>/dev/null" );
	system( "/usr/sbin/rshrun --loadall /bin/ps -lxf >> /var/log/status.log 2>/dev/null" );
	system( "/usr/sbin/rshrun --loadall /bin/ps -antp >> /var/log/status.log 2>/dev/null" );
}

