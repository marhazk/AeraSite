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
<a name=top></a>
<table align=center>
<%
String op = AuthFilter.getRemoteUser(session);
String logname = "GMService_getRole_StorehousePWDlist_response.jsp";
String tmp = "";
int GMService_getRole_StorehousePWDlist_userid = 0;
LogInfo loginfo = new LogInfo(0, "iweb", "");
tmp = request.getParameter("GMService_getRole_StorehousePWDlist_userid");
try { 
	GMService_getRole_StorehousePWDlist_userid = Integer.parseInt(tmp); 
} catch(Exception e) { 
	 e.printStackTrace(System.out); 
	 out.println("<tr><td align=center>input error:" +LocaleUtil2.getMessage(request,"RoleControl_getRoleList_userid_title") + "(GMService_getRole_StorehousePWDlist_userid),right type is int</td></tr>"); 
	 out.println("<tr><td align=center><a href=\"javascript:window.history.back(-1);\">Return</a></td></tr>"); 
	 return;
}

try {
LogFactory.getLog(logname).info(logname+". op="+ op);
GMServiceImpl gs = new GMServiceImpl();
Vector ret = gs.getRole_StorehousePWDlist(GMService_getRole_StorehousePWDlist_userid, loginfo);
if (ret != null) { out.println("<tr><td>return:" + ret+"</td></tr>"); } else { out.println("<tr><td>method=getRole_StorehousePWDlist" + "" + " invoke error</td></tr>"); }
} catch(Exception e) { e.printStackTrace(System.out); out.println("invoke getRole_StorehousePWDlist exception"); return; }
%>
<tr><td align=center><a href="javascript:window.history.back(-1);">Return</a></td></tr>
</table>
</tr></td></table><%@include file="../include/foot.jsp"%>
</body>
</html>

