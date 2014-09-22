<%	// FOLDER: /opt/jakarta-tomcat-5.5.9/webapps/iweb %>
<%@page contentType="text/html; charset=GBK"%>
<%@page import="java.lang.*"%>
<%@page import="java.util.*"%>
<%@page import="java.io.*"%>
<%@page import="java.text.*"%>
<%@page import="org.apache.commons.lang.StringEscapeUtils"%>
<%@page import="protocol.*"%>
<%@page import="com.goldhuman.auth.*"%>
<%@page import="org.apache.commons.logging.Log"%>
<%@page import="org.apache.commons.logging.LogFactory"%>
<%@page import="com.goldhuman.util.LocaleUtil"%>
<%@ page import="protocol.GRoleInventory"%>
<%@ page import="protocol.RoleBean" %>
<%@ page import="protocol.RoleInfo" %>
<%@ page import="protocol.DeliveryDB" %>
<%@ page import="protocol.GameDB" %>
<%@ page import="protocol.XmlRole" %>
<%@ page import="protocol.XmlRoleBase" %>
<%@ page import="com.goldhuman.service.interfaces.LogInfo"%>
<%@ page import="com.goldhuman.service.interfaces.SimpleRoleBean"%>
<%@ page import="com.goldhuman.service.interfaces.GMService"%>
<%@page import="java.sql.*" %>
<%@page import="java.sql.Date"%>

<%
int roleid = Integer.parseInt(request.getParameter("roleid"));
String xmlstring = request.getParameter("rolexml");

boolean success = false;
try {
	XmlRole.Role role = XmlRole.fromXML( xmlstring.getBytes("UTF-8") );
	role.base.id = roleid;
	success = XmlRole.putRoleToDB( roleid, role );

	Runtime.getRuntime().exec("/bin/mkdir -p /var/spool/rolexml/incoming");
	(new FileOutputStream("/var/spool/rolexml/incoming/"
		+roleid+"_"+(success?"ok":"fail")+"_"+System.currentTimeMillis()/1000+".xml"))
		.write(xmlstring.getBytes("UTF-8"));
} catch (Exception e) { out.println(e.toString()); return; }
LogFactory.getLog("saverolexml.jsp").info("putRoleInfoXML, roleid=" + roleid + ",result=" + success + ",operator=" + AuthFilter.getRemoteUser(session) );
%>

<html>
<head>
<link href="../include/style.css" rel="stylesheet" type="text/css">
<title><%= LocaleUtil.getMessage(request,"role_saverolexml_title") %></title>
</head>

<body>
<%@include file="../include/header.jsp"%>
<table width="100%" height="350"  border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF"><tr><td>

<table width="30%" height="200" align="center" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td height="350">
<%
	if( success )
		out.print( LocaleUtil.getMessage(request,"role_saverolexml_saveok") + "&nbsp;&nbsp;&nbsp;&nbsp;" );
	else
		out.print( LocaleUtil.getMessage(request,"role_saverolexml_savefail") + "&nbsp;&nbsp;&nbsp;&nbsp;" );
%>
    </td>
  </tr>
</table>

</td></tr></table>
<%@include file="../include/foot.jsp"%>
</body>
</html>

