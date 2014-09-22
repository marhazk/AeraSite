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

$gQ->print( "<html><head><title>��������-��Ϸ���й���</title>" );
$gQ->print( "<META HTTP-EQUIV=\"Pragma\" CONTENT=\"no-cache\"></head>" );
$gQ->print( "<body>\n<br>&nbsp;<br>" );
$gQ->print( "<table border=0 cellpadding=0 width=750 align=center><tr><td>" );

if( $rollbacksubdir and $confirmed )
{
	$gQ->print( "<P align=left>���ڻص�$rollbacksubdir ......</P><br><PRE>" );
	system( "/usr/bin/rsh database /usr/bin/killall -w -9 gamedbd" );
	sleep( 1 );
	system( "/usr/bin/rsh backup 'cd /export/backup; /bin/tar xvjf $rollbacksubdir.tar.bz'" );
	sleep( 1 );
	system( "/usr/bin/rsh database '/usr/bin/rsync -avve rsh --delete backup:/export/backup/$rollbacksubdir/ /dbf/dbhome/'" );
	$gQ->print( "</PRE><br><P align=left>�ص���ɡ�</P><br>" );
	$gQ->print( "<P align=left><a href=\"./control.cgi?action=restartdb\">�������ݿ����������</a></P><br>" );
}
elsif( $rollbacksubdir )
{
	print ( <<EOF);
<form method="post" action="./rollback.cgi" name="rollbackform">
<P>ȷ�ϻص����±���:</P>
&nbsp;<br>
$rollbacksubdir
&nbsp;<br>
<input type=hidden name="backup" value="$rollbacksubdir">
<input type=hidden name="confirmed" value="1">
&nbsp;<br>
<input type=submit value="ȷ��ִ�лص�">
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
<P>û���ҵ���������ʱ��ı����ļ�.</P>
&nbsp;<br>
$rollbacktime
&nbsp;<br>
EOF
	}
	else
	{
	print ( <<EOF);
<form method="post" action="./rollback.cgi" name="rollbackform">
<P>�ҵ�����ʵı����ļ�����:</P>
&nbsp;<br>
$rollbacksubdir
&nbsp;<br>
<input type=hidden name="backup" value="$rollbacksubdir">
<input type=hidden name="confirmed" value="1">
&nbsp;<br>
<input type=submit value="ȷ��ִ�лص�">
</form>
EOF
	}
}
else
{
	print ( <<EOF);
<form method="post" action="./rollback.cgi" name="rollbackform">
<P>����ص�ʱ��</P>
&nbsp;<br>
(��ʽ:YYYYMMDD-HHMMSS, ����:20050305-193000)
&nbsp;<br>
<input type="text" maxlength="17" size="24" name="rollbacktime" value="">
<input type=submit value="�ύ">
</form>
EOF
}

$gQ->print("</td></tr><tr><td align=center><br><a href=\"javascript:window.history.back(-1);\">����</a><br>");
$gQ->print( "</td></tr></table>" );
$gQ->print( "</body></html>\n" );

