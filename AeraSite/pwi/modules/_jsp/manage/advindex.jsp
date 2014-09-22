<%@ page contentType="text/html; charset=UTF-8" %>
<%@page import="java.util.*"%>
<%@page import="com.goldhuman.util.LocaleUtil" %>
<html>
<head>
<link href="../include/style.css" rel="stylesheet" type="text/css">
<title><%= LocaleUtil.getMessage(request,"manage_advindex_title") %></title>
</head>
<body>
<%@include file="../include/header.jsp"%>
<table width="100%" height="350"  border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF"><tr><td>

<table border cellpadding=2 align="center" width=600>
<tr><th align=left width=40%><%= LocaleUtil.getMessage(request,"manage_advindex_application") %></th><th align=left><%= LocaleUtil.getMessage(request,"manage_advindex_explain")%></th></tr>
<tr><td><a href="../cgi-bin/control.cgi?action=status"><%= LocaleUtil.getMessage(request,"manage_advindex_serverstatus") %></a></td><td>&nbsp;<%= LocaleUtil.getMessage(request,"manage_advindex_DBstatus") %></td></tr>
<tr><td><a href="../cgi-bin/control.cgi?action=psstatus"><%= LocaleUtil.getMessage(request,"manage_advindex_listallproc") %></a></td><td>&nbsp;</td></tr>
<tr><td><a href="../cgi-bin/listbackups.cgi"><%= LocaleUtil.getMessage(request,"manage_advindex_DBbackups") %></a></td><td>&nbsp;<%= LocaleUtil.getMessage(request,"manage_advindex_listbackups") %></td></tr>
<tr><td colspan=2>&nbsp;</td></tr>

<tr><td><a href="../cgi-bin/control.cgi?action=shutdowngame"><%= LocaleUtil.getMessage(request,"manage_advindex_forceshutdown") %><font size=3><%= LocaleUtil.getMessage(request,"manage_advindex_game") %></font><%= LocaleUtil.getMessage(request,"manage_advindex_server") %></a></td><td>&nbsp;<%= LocaleUtil.getMessage(request,"manage_advindex_nobroadcast") %>&nbsp;<font color=red><%= LocaleUtil.getMessage(request,"manage_advindex_careful")%></font></td></tr>

<tr><td><a href="../cgi-bin/control.cgi?action=restartgame"><%= LocaleUtil.getMessage(request,"manage_advindex_forcereboot") %><font size=3><%= LocaleUtil.getMessage(request,"manage_advindex_game") %></font><%= LocaleUtil.getMessage(request,"manage_advindex_server") %></a></td><td>&nbsp;<%= LocaleUtil.getMessage(request,"manage_advindex_nobroadcast2") %>&nbsp;<font color=red><%= LocaleUtil.getMessage(request,"manage_advindex_careful") %></font></td></tr>

<tr><td><a href="../cgi-bin/control.cgi?action=repairgame"><%= LocaleUtil.getMessage(request,"manage_advindex_repairstart") %><font size=3><%= LocaleUtil.getMessage(request,"manage_advindex_game") %></font><%= LocaleUtil.getMessage(request,"manage_advindex_server") %></a></td><td>&nbsp;<%= LocaleUtil.getMessage(request,"manage_advindex_repairstart2") %>&nbsp;<font color=red></font></td></tr>

<tr><td colspan=2>&nbsp;</td></tr>
<tr><td><a href="../cgi-bin/control.cgi?action=shutdowndb"><%= LocaleUtil.getMessage(request,"manage_advindex_forceshutdown") %><font size=3><%= LocaleUtil.getMessage(request,"manage_advindex_DB") %></font><%= LocaleUtil.getMessage(request,"manage_advindex_server") %></a></td><td>&nbsp;<%= LocaleUtil.getMessage(request,"manage_advindex_DB2") %>&nbsp;<font color=red><%= LocaleUtil.getMessage(request,"manage_advindex_careful") %></font></td></tr>

<tr><td><a href="../cgi-bin/control.cgi?action=restartdb"><%= LocaleUtil.getMessage(request,"manage_advindex_forcereboot") %><font size=3><%= LocaleUtil.getMessage(request,"manage_advindex_DB") %></font><%= LocaleUtil.getMessage(request,"manage_advindex_server") %></a></td><td>&nbsp;<%= LocaleUtil.getMessage(request,"manage_advindex_playerlostdata") %>&nbsp;<font color=red><%= LocaleUtil.getMessage(request,"manage_advindex_careful") %></font></td></tr>

<tr><td colspan=2>&nbsp;</td></tr>
<tr><td><a href="../cgi-bin/control.cgi?action=shutdownuniquename"><%= LocaleUtil.getMessage(request,"manage_advindex_forceshutdown") %><font size=3><%= LocaleUtil.getMessage(request,"manage_advindex_uniquename") %></font><%= LocaleUtil.getMessage(request,"manage_advindex_server") %></a></td><td>&nbsp;&nbsp;<font color=red><%= LocaleUtil.getMessage(request,"manage_advindex_careful") %></font></td></tr>

<tr><td><a href="../cgi-bin/control.cgi?action=restartuniquename"><%= LocaleUtil.getMessage(request,"manage_advindex_forcereboot") %>¯<font size=3<%= LocaleUtil.getMessage(request,"manage_advindex_unique") %></font><%= LocaleUtil.getMessage(request,"manage_advindex_server") %></a></td><td>&nbsp;&nbsp;<font color=red><%= LocaleUtil.getMessage(request,"manage_advindex_careful") %></font></td></tr>
<tr><td colspan=2>&nbsp;</td></tr>

<tr><td><a href="../cgi-bin/control.cgi?action=redist"><%= LocaleUtil.getMessage(request,"manage_advindex_releasegame") %></a></td><td>&nbsp;<%= LocaleUtil.getMessage(request,"manage_advindex_careful2") %><font color=red><%= LocaleUtil.getMessage(request,"manage_advindex_careful") %></font></td></tr>
</table>
&nbsp;<br>

<table border cellpadding=2 align="center" width=600>
<tr><th align=left width=40%><%= LocaleUtil.getMessage(request,"manage_advindex_other") %></th><th align=left><%= LocaleUtil.getMessage(request,"manage_advindex_explain") %></th></tr>

<tr><td>
<form action="../cgi-bin/control.cgi" method="post">
<input type="hidden" name="action" value="ipdisable">
<input type="submit" value="<%= LocaleUtil.getMessage(request,"manage_advindex_forbidIP") %>"></form>
</td><td>&nbsp;<%= LocaleUtil.getMessage(request,"manage_advindex_attention") %></td></tr>

<tr><td>
<form action="../cgi-bin/control.cgi" method="post">
<input type="hidden" name="action" value="ipenable">
<input type="submit" value="<%= LocaleUtil.getMessage(request,"manage_advindex_uncord") %>"></form>
</td><td>&nbsp;<%= LocaleUtil.getMessage(request,"manage_advindex_attention") %></td></tr>

</table>
&nbsp;<br>

<table width="450" height="200" align="center" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td><%= LocaleUtil.getMessage(request,"manage_advindex_help") %></td>
  </tr>
  <tr>
    <td>
&nbsp;<br>
&nbsp;&nbsp;<%= LocaleUtil.getMessage(request,"manage_advindex_help1") %><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<%= LocaleUtil.getMessage(request,"manage_advindex_help2") %><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<%= LocaleUtil.getMessage(request,"manage_advindex_help3") %><br>
&nbsp;&nbsp;<%= LocaleUtil.getMessage(request,"manage_advindex_help4") %><br>
&nbsp;&nbsp;<%= LocaleUtil.getMessage(request,"manage_advindex_help5") %><br>
&nbsp;&nbsp;<%= LocaleUtil.getMessage(request,"manage_advindex_help6") %><br>
&nbsp;&nbsp;<%= LocaleUtil.getMessage(request,"manage_advindex_help7") %><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<%= LocaleUtil.getMessage(request,"manage_advindex_help8") %><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<%= LocaleUtil.getMessage(request,"manage_advindex_help9") %><br>
&nbsp;&nbsp;<br>
    </td>
  </tr>
</table>


</td></tr></table>
<%@include file="../include/foot.jsp"%>
</body>
</html>

