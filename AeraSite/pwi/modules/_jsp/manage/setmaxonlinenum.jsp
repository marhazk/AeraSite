<%@ page contentType="text/html; charset=UTF-8" %>
<%@page import="java.lang.*"%>
<%@page import="protocol.*"%>
<%@page import="com.goldhuman.auth.*"%>
<%@page import="org.apache.commons.logging.Log"%>
<%@page import="org.apache.commons.logging.LogFactory"%>
<%@page import="com.goldhuman.util.LocaleUtil" %>

<%
int maxnum = Integer.parseInt(request.getParameter("maxnum"));
int fakemaxnum = Integer.parseInt(request.getParameter("fakemaxnum"));

boolean success = DeliveryDB.SetMaxOnlineNum( maxnum, fakemaxnum );
LogFactory.getLog("setmaxonlinenum.jsp").info("setmaxonlinenum, maxnum=" + maxnum + ",fakemaxnum=" + fakemaxnum + ",result=" + success + ",operator=" + AuthFilter.getRemoteUser(session) );
%>

<html>
<head>
<link href="../include/style.css" rel="stylesheet" type="text/css">
<title><%= LocaleUtil.getMessage(request,"manage_smo_title") %>ý</title>
</head>

<body>
<%@include file="../include/header.jsp"%>
<table width="100%" height="350"  border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF"><tr><td>

<table width="30%" height="200" align="center" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td height="350">
<%
	if( success )
		out.print( LocaleUtil.getMessage(request,"manage_smo_ok") + "&nbsp;&nbsp;&nbsp;&nbsp;" );
	else
		out.print( LocaleUtil.getMessage(request,"manage_smo_fail") +  "&nbsp;&nbsp;&nbsp;&nbsp;" );
	if( fakemaxnum > maxnum )
	{
		out.print( "<br><font color=red>" + LocaleUtil.getMessage(request,"manage_smo_fail2") + "</font>" );
	}
%>
    </td>
  </tr>
</table>

</td></tr></table>
<%@include file="../include/foot.jsp"%>
</body>
</html>

