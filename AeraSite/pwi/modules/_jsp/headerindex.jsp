<%@ page contentType="text/html; charset=UTF-8" %>
<%@page import="java.util.*"%>
<%@page import="com.goldhuman.util.LocaleUtil2"%>
<html>
<head>
<link href="include/style.css" rel="stylesheet" type="text/css">
<title>header index</title>
<script language=javascript>
</script>
</head>
<body>
<%@include file="include/header.jsp"%>
<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF"><tr><td>
<table border cellpadding=2 align=center width=900>
<tr> <td><a href=newmanager/index.jsp>newmanager:<%=LocaleUtil2.getMessage(request,"interface_WGMService_title")%></a> </td> <td> </td></tr>
<tr> <td><a href=newrole/index.jsp>newrole:<%=LocaleUtil2.getMessage(request,"interface_WGMService_title")%></a> </td> <td> </td></tr>
</table>
</td></tr></table>
<%@include file="include/foot.jsp"%>
</body>
</html>
