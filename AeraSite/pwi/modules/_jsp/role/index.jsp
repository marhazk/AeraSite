<%@ page contentType="text/html; charset=UTF-8" %>
<%@page import="java.util.*"%>
<%@page import="com.goldhuman.util.LocaleUtil"%>
    <%
    String _output = request.getParameter("msg");
    String _roleid = request.getParameter("rid");
    if (_roleid == null)
        _roleid = "";
    if (_output == null)
        _output = "";
    %>
<html>
<head>
<link href="../include/style.css" rel="stylesheet" type="text/css">
<title><%= LocaleUtil.getMessage(request,"role_index_title") %></title>
<script language=javascript>
    function onqueryrolexml()
    {
    document.myquery.action = "modrolexml.jsp";
    document.myquery.submit()
    return true;
    }
    function onqueryrolexmlexport()
    {
    document.myquery.action = "modrolexmlexport.jsp";
    document.myquery.submit()
    return true;
    }

</script>
</head>
<body>
<%@include file="../include/header.jsp"%>
<table width="100%" height="350"  border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF"><tr><td>

<table width="550" height="200" align="center" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td><%= LocaleUtil.getMessage(request,"role_index_discript") %></td>
  </tr>
  <tr>
    <td><a href="modrole.jsp?roleid=16"><%= LocaleUtil.getMessage(request,"role_index_wuxia") %></a></td>
  </tr>
  <tr>
    <td><a href="modrole.jsp?roleid=19"><%= LocaleUtil.getMessage(request,"role_index_fashi") %></a></td>
  </tr>
  <tr>
    <td><a href="modrole.jsp?roleid=20"><%= LocaleUtil.getMessage(request,"role_index_senglv") %></a></td>
  </tr>
  <tr>
    <td><a href="modrole.jsp?roleid=23"><%= LocaleUtil.getMessage(request,"role_index_yaojing") %></a></td>
  </tr>
  <tr>
    <td><a href="modrole.jsp?roleid=24"><%= LocaleUtil.getMessage(request,"role_index_yaoshou") %></a></td>
  </tr>
  <tr>
    <td><a href="modrole.jsp?roleid=27"><%= LocaleUtil.getMessage(request,"role_index_meiling") %></a></td>
  </tr>
  <tr>
    <td><a href="modrole.jsp?roleid=28"><%= LocaleUtil.getMessage(request,"role_index_yumang") %></a></td>
  </tr>
  <tr>
    <td><a href="modrole.jsp?roleid=31"><%= LocaleUtil.getMessage(request,"role_index_yuling") %></a></td>
  </tr>
  <tr>
    <td>
&nbsp;<br>
        <%= LocaleUtil.getMessage(request,"role_index_query") %>
    <BR><BR>MESAGE:
        <%= _output %>
    <BR><BR>
<form action="modrole.jsp" name="myquery" method="post">
<%= LocaleUtil.getMessage(request,"role_index_inputid") %>&nbsp;&nbsp;<input type="text" name="roleid" value="<%= _roleid %>" size="16" maxlength="10"><br>
<%= LocaleUtil.getMessage(request,"role_index_inputname") %><input type="text" name="name" value="" size="20" maxlength="64">
<input type="submit" value="<%= LocaleUtil.getMessage(request,"role_index_querybase")%>" >
&nbsp;&nbsp;<a href="javascript:onqueryrolexml();"><%= LocaleUtil.getMessage(request,"role_index_queryxml") %></a>

    <a href="javascript:onqueryrolexmlexport();">Export XML to DB</a>
</form>
    </td>
  </tr>
</table>

</td></tr></table>
<%@include file="../include/foot.jsp"%>
</body>
</html>

