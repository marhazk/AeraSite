<%@ page contentType="text/html; charset=UTF-8" %>
<%@page import="java.lang.*"%>
<%@page import="protocol.*"%>
<%@page import="com.goldhuman.auth.*"%>
<%@page import="org.apache.commons.logging.Log"%>
<%@page import="org.apache.commons.logging.LogFactory"%>

<%
int lambda = Integer.parseInt(request.getParameter("lambda"));
boolean	success = DeliveryDB.GMSetLambda( lambda );
LogFactory.getLog("setlambda.jsp").info("setlambda, lambda=" + lambda + ",result=" + success + ",operator=" + AuthFilter.getRemoteUser(session) );
%>

<html>
<head>
<link href="../include/style.css" rel="stylesheet" type="text/css">
<title><%= LocaleUtil.getMessage(request,"manage_sld_title") %></title>
</head>

<body>
<%@include file="../include/header.jsp"%>
<table width="100%" height="350" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF"><tr><td>

<table width="30%" height="200" align="center" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td height="350">
<%
	if( success )
		out.print( LocaleUtil.getMessage(request,"manage_sld_ok") + " lambda = " + lambda + "&nbsp;&nbsp;&nbsp;&nbsp;" );
	else
		out.print( LocaleUtil.getMessage(request,"manage_sld_fail") + "&nbsp;&nbsp;&nbsp;&nbsp;" );
%>
    </td>
  </tr>
</table>

</td></tr></table>
<%@include file="../include/foot.jsp"%>
</body>
</html>

