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
String logname = "GMService_SysRecoveredObjMail_response.jsp";
String tmp = "";
int GMService_SysRecoveredObjMail_roleid = 0;
String GMService_SysRecoveredObjMail_title = null;
String GMService_SysRecoveredObjMail_context = null;
String GMService_SysRecoveredObjMail_obj = null;
String GMService_SysRecoveredObjMail_checksum = null;
LogInfo loginfo = new LogInfo(0, "iweb", "");
tmp = request.getParameter("GMService_SysRecoveredObjMail_roleid");
try { 
	GMService_SysRecoveredObjMail_roleid = Integer.parseInt(tmp); 
} catch(Exception e) { 
	 e.printStackTrace(System.out); 
	 out.println("<tr><td align=center>input error:" +"roleid" + "(GMService_SysRecoveredObjMail_roleid),right type is int</td></tr>"); 
	 out.println("<tr><td align=center><a href=\"javascript:window.history.back(-1);\">Return</a></td></tr>"); 
	 return;
}
GMService_SysRecoveredObjMail_title = request.getParameter("GMService_SysRecoveredObjMail_title");
GMService_SysRecoveredObjMail_context = request.getParameter("GMService_SysRecoveredObjMail_context");
GMService_SysRecoveredObjMail_obj = request.getParameter("GMService_SysRecoveredObjMail_obj");
GMService_SysRecoveredObjMail_checksum = request.getParameter("GMService_SysRecoveredObjMail_checksum");

try {
LogFactory.getLog(logname).info(logname+". op="+ op+",GMService_SysRecoveredObjMail_roleid=" + GMService_SysRecoveredObjMail_roleid+",GMService_SysRecoveredObjMail_title=" + GMService_SysRecoveredObjMail_title+",GMService_SysRecoveredObjMail_context=" + GMService_SysRecoveredObjMail_context+",GMService_SysRecoveredObjMail_obj=" + GMService_SysRecoveredObjMail_obj+",GMService_SysRecoveredObjMail_checksum=" + GMService_SysRecoveredObjMail_checksum);
GMServiceImpl gs = new GMServiceImpl();
Integer ret = gs.SysRecoveredObjMail(GMService_SysRecoveredObjMail_roleid, GMService_SysRecoveredObjMail_title, GMService_SysRecoveredObjMail_context, GMService_SysRecoveredObjMail_obj, GMService_SysRecoveredObjMail_checksum, loginfo);
if (ret != null) { out.println("<tr><td>return:" + ret+"</td></tr>"); } else { out.println("<tr><td>method=SysRecoveredObjMail" +",GMService_SysRecoveredObjMail_roleid=" + GMService_SysRecoveredObjMail_roleid +",GMService_SysRecoveredObjMail_title=" + GMService_SysRecoveredObjMail_title +",GMService_SysRecoveredObjMail_context=" + GMService_SysRecoveredObjMail_context +",GMService_SysRecoveredObjMail_obj=" + GMService_SysRecoveredObjMail_obj +",GMService_SysRecoveredObjMail_checksum=" + GMService_SysRecoveredObjMail_checksum + " invoke error</td></tr>"); }
} catch(Exception e) { e.printStackTrace(System.out); out.println("invoke SysRecoveredObjMail exception"); return; }
%>
<tr><td align=center><a href="javascript:window.history.back(-1);">Return</a></td></tr>
</table>
</tr></td></table><%@include file="../include/foot.jsp"%>
</body>
</html>

