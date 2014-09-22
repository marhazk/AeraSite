<%@ page contentType="text/html; charset=UTF-8" %>
<%@page import="java.lang.*"%>
<%@page import="protocol.*"%>
<%@page import="com.goldhuman.auth.*"%>
<%@page import="org.apache.commons.logging.Log"%>
<%@page import="org.apache.commons.logging.LogFactory"%>
<%
String status = request.getParameter("doubleexp");
boolean success = false;
try {
	Double experience = new Double(status);
	com.goldhuman.service.GMServiceImpl gm = new com.goldhuman.service.GMServiceImpl();
	success = gm.setw2iexperience(experience, new com.goldhuman.service.interfaces.LogInfo());
	//int exp = new Double(new Double(status).doubleValue() * 10).intValue();
	//success = DeliveryDB.GMSetDoubleExp(exp);
	LogFactory.getLog("setdoubleexp.jsp").info("setdoubleexp, status=" + status + ",result=" + success + ",operator=" + AuthFilter.getRemoteUser(session) );
} catch (Exception e) {
	e.printStackTrace();
}
%>
<html>
<head>
<link href="../include/style.css" rel="stylesheet" type="text/css">
<title><%= LocaleUtil.getMessage(request,"manage_sde_title") %></title>
</head>

<body>
<%@include file="../include/header.jsp"%>
<table width="100%" height="350" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF"><tr><td>

<table width="30%" height="200" align="center" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td height="350">
<%
	if( success )
		out.print( LocaleUtil.getMessage(request,"manage_sde_ok") + " status = " + status + "&nbsp;&nbsp;&nbsp;&nbsp;" );
	else
		out.print(  LocaleUtil.getMessage(request,"manage_sde_fail") + "&nbsp;&nbsp;&nbsp;&nbsp;" );
%>
    </td>
  </tr>
</table>

</td></tr></table>
<%@include file="../include/foot.jsp"%>
</body>
</html>

