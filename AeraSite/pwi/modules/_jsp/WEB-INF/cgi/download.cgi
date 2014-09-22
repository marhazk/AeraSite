#!/usr/bin/perl -w

use CGI qw(fatalsToBrowser);
use FileHandle;

my $gQ = new CGI;

my $backup = $gQ->param('backup');

if( $backup )
{
	my $randdir = 'dltmp.' . $backup . rand;
	system( "mkdir -p /export/tmp/$randdir" );

	system( "/usr/bin/rcp backup:/export/backup/$backup.tar.bz /export/tmp/$randdir/ >/dev/null 2>&1" );
	if( not -f "/export/tmp/$randdir/$backup.tar.bz" )
	{
		system( "/usr/bin/rcp -r backup:/export/backup/$backup /export/tmp/$randdir/ >/dev/null 2>&1" );
		system( "cd /export/tmp/$randdir; /bin/tar cvjf $backup.tar.bz $backup/ >/dev/null 2>&1" );
	}

	my $length = -s "/export/tmp/$randdir/$backup.tar.bz";
	print $gQ->header( -type=>'application/x-gzip',
						-content_disposition => "attachment; filename=$backup.tar.bz;",
						-content_length => "$length" );


	eval
	{
		local $SIG{ALRM} = sub { die; };
		alarm (7200);

		my $fh = new FileHandle;
		if ($fh->open("< /export/tmp/$randdir/$backup.tar.bz"))
		{
			my $buf;
			while( read($fh, $buf, 4096) > 0 )
			{
				print $buf;
			}
			$fh->close;
		}
	};

	system( "rm -rf /export/tmp/$randdir >/dev/null 2>&1" );
}
else
{
	print $gQ->header( -type=>'text/html', -charset=>'gb2312');

	$gQ->print( "<html><head><title>完美世界-游戏运行管理</title>" );
	$gQ->print( "<META HTTP-EQUIV=\"Pragma\" CONTENT=\"no-cache\"></head>" );
	$gQ->print( "<body>\n<br>&nbsp;<br>" );
	$gQ->print( "<table border=0 cellpadding=0 width=750 align=center><tr><td>" );

	$gQ->print( "<P align=left>错误:没有指定备份文件.</P><br>" );

	$gQ->print("</td></tr><tr><td align=center><br><a href=\"javascript:window.history.back(-1);\">返回</a><br>");
	$gQ->print( "</td></tr></table>" );
	$gQ->print( "</body></html>\n" );
}


