<%@ page contentType="text/html; charset=UTF-8" %>
<%@page import="java.util.*"%>
<%@page import="com.goldhuman.util.*"%>
<%@page import="common.*"%>
<%@page import="com.goldhuman.auth.*"%>
<%@page import="com.goldhuman.util.*"%>
<%@page import="com.goldhuman.Common.*"%>
<%@page import="org.apache.commons.logging.Log"%>
<%@page import="org.apache.commons.logging.LogFactory"%>
<%@page import="com.goldhuman.service.interfaces.*"%>
<%@page import="com.goldhuman.service.*"%>
<%@page import="javax.management.*"%>
<%@page import="javax.management.remote.*"%>
<%@page import="java.rmi.*"%>

<html>
<head>
<link href="../include/style.css" rel="stylesheet" type="text/css">
<title></title>
<script language=javascript>
</script>
</head>
<body>
<%@include file="../include/header.jsp"%>
<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF"><tr><td>
<% request.setCharacterEncoding("UTF-8"); %>
<form action=GMService_GetOnlineNum_response.jsp method=post>
<table align=center border cellpadding=2>
<tr><th colspan=2 align=center><%=LocaleUtil2.getMessage(request,"WGMService_GetOnlineNum_title")%></th></tr>
<tr><th align=center>Argument</th><th>Comment</th></tr>
<tr><th colspan=2 align=center><input type=submit value=submit></th></tr>
<tr><td colspan=2 align=center><a href="javascript:window.history.back(-1);">Return</a></td></tr>
</table>
</form>
</tr></td></table><%@include file="../include/foot.jsp"%>
</body>
</html>

