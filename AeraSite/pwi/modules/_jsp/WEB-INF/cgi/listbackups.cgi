#!/usr/bin/perl -w

my $cmd = "/usr/bin/rsh backup '/root/cgi/listbackups /export/backup'";
print qx/$cmd/;

