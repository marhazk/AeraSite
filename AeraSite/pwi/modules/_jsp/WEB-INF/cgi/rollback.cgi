#!/usr/bin/perl -w

use CGI qw(fatalsToBrowser);
use Time::Local 'timelocal_nocheck';

my %backups;
my $backup_dir = "/home/sunzhenyu/game_qq/gamedbd/backup";


my $gQ = new CGI;

my $rollbacktime = $gQ->param("rollbacktime");
my $rollbacksubdir = $gQ->param("backup");
my $confirmed = $gQ->param("confirmed");

print $gQ->header( -type=>'text/html', -charset=>'gb2312');

$gQ->print( "<html><head><title>完美世界-游戏运行管理</title>" );
$gQ->print( "<META HTTP-EQUIV=\"Pragma\" CONTENT=\"no-cache\"></head>" );
$gQ->print( "<body>\n<br>&nbsp;<br>" );
$gQ->print( "<table border=0 cellpadding=0 width=750 align=center><tr><td>" );

if( $rollbacksubdir and $confirmed )
{
	$gQ->print( "<P align=left>正在回档$rollbacksubdir ......</P><br><PRE>" );
	system( "/usr/bin/rsh database /usr/bin/killall -w -9 gamedbd" );
	sleep( 1 );
	system( "/usr/bin/rsh backup 'cd /export/backup; /bin/tar xvjf $rollbacksubdir.tar.bz'" );
	sleep( 1 );
	system( "/usr/bin/rsh database '/usr/bin/rsync -avve rsh --delete backup:/export/backup/$rollbacksubdir/ /dbf/dbhome/'" );
	$gQ->print( "</PRE><br><P align=left>回档完成。</P><br>" );
	$gQ->print( "<P align=left><a href=\"./control.cgi?action=restartdb\">重启数据库服务点击这里</a></P><br>" );
}
elsif( $rollbacksubdir )
{
	print ( <<EOF);
<form method="post" action="./rollback.cgi" name="rollbackform">
<P>确认回档如下备份:</P>
&nbsp;<br>
$rollbacksubdir
&nbsp;<br>
<input type=hidden name="backup" value="$rollbacksubdir">
<input type=hidden name="confirmed" value="1">
&nbsp;<br>
<input type=submit value="确认执行回档">
</form>
EOF
}
elsif( $rollbacktime )
{
	my $cmd = "/usr/bin/rsh backup '/root/cgi/listbackups /export/backup $rollbacktime'";
	$rollbacksubdir = qx/$cmd/;

	if( not $rollbacksubdir )
	{
	print ( <<EOF);
<P>没有找到合适以下时间的备份文件.</P>
&nbsp;<br>
$rollbacktime
&nbsp;<br>
EOF
	}
	else
	{
	print ( <<EOF);
<form method="post" action="./rollback.cgi" name="rollbackform">
<P>找到最合适的备份文件如下:</P>
&nbsp;<br>
$rollbacksubdir
&nbsp;<br>
<input type=hidden name="backup" value="$rollbacksubdir">
<input type=hidden name="confirmed" value="1">
&nbsp;<br>
<input type=submit value="确认执行回档">
</form>
EOF
	}
}
else
{
	print ( <<EOF);
<form method="post" action="./rollback.cgi" name="rollbackform">
<P>输入回档时间</P>
&nbsp;<br>
(格式:YYYYMMDD-HHMMSS, 例如:20050305-193000)
&nbsp;<br>
<input type="text" maxlength="17" size="24" name="rollbacktime" value="">
<input type=submit value="提交">
</form>
EOF
}

$gQ->print("</td></tr><tr><td align=center><br><a href=\"javascript:window.history.back(-1);\">返回</a><br>");
$gQ->print( "</td></tr></table>" );
$gQ->print( "</body></html>\n" );

