#!/usr/bin/perl -w

use CGI qw(fatalsToBrowser);

my $gQ = new CGI;
print $gQ->header( -type=>'text/html', -charset=>'gb2312');

$gQ->print( "<html><head><title>服务运行状态</title>" );
$gQ->print( "<META HTTP-EQUIV=\"Pragma\" CONTENT=\"no-cache\"></head>" );
$gQ->print( "<body>\n<br>&nbsp;<br>" );
$gQ->print( "<table border=0 cellpadding=0 width=750 align=center><tr><td>" );

	$gQ->print( "服务运行状态。<br>" );
	my $cmd;

	$cmd = "/usr/bin/snmpwalk -Oqv backup 1.3.6.1.4.1.2021.2.1.5.8";
	my $uniquename = qx/$cmd/;
	$uniquename = "<font color=red>$uniquename</font>" if( substr($uniquename,0,1) eq '0' );

	$cmd = "/usr/bin/snmpwalk -Oqv database 1.3.6.1.4.1.2021.2.1.5.2";
	my $database = qx/$cmd/;
	$database = "<font color=red>$database</font>" if( substr($database,0,1) eq '0' );

	$cmd = "/usr/bin/snmpwalk -Oqv delivery 1.3.6.1.4.1.2021.2.1.5.7";
	my $gacd = qx/$cmd/;
	$gacd = "<font color=red>$gacd</font>" if( substr($gacd,0,1) eq '0' );

	$cmd = "/usr/bin/snmpwalk -Oqv delivery 1.3.6.1.4.1.2021.2.1.5.3";
	my $faction = qx/$cmd/;
	$faction = "<font color=red>$faction</font>" if( substr($faction,0,1) eq '0' );

	$cmd = "/usr/bin/snmpwalk -Oqv delivery 1.3.6.1.4.1.2021.2.1.5.4";
	my $delivery = qx/$cmd/;
	$delivery = "<font color=red>$delivery</font>" if( substr($delivery,0,1) eq '0' );

	$cmd = "/usr/bin/snmpwalk -Oqv link1 1.3.6.1.4.1.2021.2.1.5.5";
	my $link1 = qx/$cmd/;
	$link1 = "<font color=red>$link1</font>" if( substr($link1,0,1) eq '0' );

	$cmd = "/usr/bin/snmpwalk -Oqv link2 1.3.6.1.4.1.2021.2.1.5.5";
	my $link2 = qx/$cmd/;
	$link2 = "<font color=red>$link2</font>" if( substr($link2,0,1) eq '0' );

	$cmd = "/usr/bin/snmpwalk -Oqv game1 1.3.6.1.4.1.2021.2.1.5.6";
	my $game1 = qx/$cmd/;
	$game1 = "<font color=red>$game1</font>" if( substr($game1,0,1) eq '0' );

	$cmd = "/usr/bin/snmpwalk -Oqv game2 1.3.6.1.4.1.2021.2.1.5.6";
	my $game2 = qx/$cmd/;
	$game2 = "<font color=red>$game2</font>" if( substr($game2,0,1) eq '0' );

	$cmd = "/usr/bin/snmpwalk -Oqv game3 1.3.6.1.4.1.2021.2.1.5.6";
	my $game3 = qx/$cmd/;
	$game3 = "<font color=red>$game3</font>" if( substr($game3,0,1) eq '0' );

	$cmd = "/usr/bin/snmpwalk -Oqv game4 1.3.6.1.4.1.2021.2.1.5.6";
	my $game4 = qx/$cmd/;
	$game4 = "<font color=red>$game4</font>" if( substr($game4,0,1) eq '0' );

	$cmd = "/usr/bin/snmpwalk -Oqv game5 1.3.6.1.4.1.2021.2.1.5.6";
	my $game5 = qx/$cmd/;
	$game5 = "<font color=red>$game5</font>" if( substr($game5,0,1) eq '0' );

	$cmd = "/usr/bin/snmpwalk -Oqv game6 1.3.6.1.4.1.2021.2.1.5.6";
	my $game6 = qx/$cmd/;
	$game6 = "<font color=red>$game6</font>" if( substr($game6,0,1) eq '0' );

	$cmd = "/usr/bin/snmpwalk -Oqv game7 1.3.6.1.4.1.2021.2.1.5.6";
	my $game7 = qx/$cmd/;
	$game7 = "<font color=red>$game7</font>" if( substr($game7,0,1) eq '0' );

	$gQ->print( "uniquename:$uniquename<br>" );
	$gQ->print( "database:$database<br>" );
	$gQ->print( "gacd:$gacd<br>" );
	$gQ->print( "faction:$faction<br>" );
	$gQ->print( "delivery:$delivery<br>" );
	$gQ->print( "link1:   $link1<br>" );
	$gQ->print( "link2:   $link2<br>" );
	$gQ->print( "game1:   $game1<br>" );
	$gQ->print( "game2:   $game2<br>" );
	$gQ->print( "game3:   $game3<br>" );
	$gQ->print( "game4:   $game4<br>" );
	$gQ->print( "game5:   $game5<br>" );
	$gQ->print( "game6:   $game6<br>" );
	$gQ->print( "game7:   $game7<br>" );

#	if( substr($database,0,1) eq '0' or substr($faction,0,1) eq '0' or substr($delivery,0,1) eq '0'
#		or substr($link1,0,1) eq '0' or substr($link2,0,1) eq '0' or substr($game1,0,1) eq '0'
#		or substr($game2,0,1) eq '0' or substr($game3,0,1) eq '0' or substr($game4,0,1) eq '0' )
#	{
#		$gQ->print(<<EOF);
#<script language=javascript >
#alert("警告！有服务当了！");
#</script>
#EOF
#	}

$gQ->print( "</td></tr></table>" );
$gQ->print( "</body></html>\n" );

