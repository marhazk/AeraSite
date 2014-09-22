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
<%
com.goldhuman.Common.Octets.setDefaultCharset("UTF-16LE");
String strRoleId = request.getParameter("roleid");
String strRoleName = request.getParameter("name");

LogFactory.getLog("modrolexml.jsp").info("request xml for roleid=" + strRoleId + ",name=" + strRoleName + ",operator=" + AuthFilter.getRemoteUser(session) );

int roleid = -1;
if( null != strRoleId && strRoleId.length() > 0 )
	roleid = Integer.parseInt(request.getParameter("roleid"));

if( -1 == roleid && null != strRoleName && strRoleName.length() > 0 )
{
	try{ roleid = GameDB.getRoleIdByName( strRoleName ); }
	catch (Exception e) { out.println(e.toString()); return; }
	if( -1 == roleid )
	{
		out.println("�޷��鵽�ý�ɫ��" + strRoleName + "������û�иý�ɫ����ʳ�ʱ��" );
		return;
	}
}
if( -1 == roleid )
{
	out.println("�������ɫID���߽�ɫ���ơ�");
	return;
}

String xmlstring = null;
byte[] xmlbytes = null;
try{
	XmlRole.Role role = XmlRole.getRoleFromDB(roleid);
	if( null == role )
	{
		out.println("�����ݿ��ȡ��ɫ��Ϣʧ�ܣ�����û�иý�ɫ����ʳ�ʱ�������ԡ�");
		return;
	}
	xmlbytes = XmlRole.toXMLByteArray(role);
	if( null == xmlbytes )
	{
		out.println("����ɫ��Ϣת����xmlʧ�ܡ�");
		return;
	}
	xmlstring = new String( xmlbytes, "UTF-8" );

	Runtime.getRuntime().exec("/bin/mkdir -p /var/spool/rolexml/outcoming");
	(new FileOutputStream("/var/spool/rolexml/outcoming/" 
		+roleid+"_"+System.currentTimeMillis()/1000+".xml"))
		.write(xmlstring.getBytes("UTF-8"));
}
catch (Exception e) { out.println(e.toString()); return; }
LogFactory.getLog("modrolexml.jsp").info("getRoleInfoXML success, roleid=" + roleid + ",name=" + strRoleName + ",operator=" + AuthFilter.getRemoteUser(session) );
%>

<html>
<head>
<link href="../include/style.css" rel="stylesheet" type="text/css">
<title>��ɫ��Ϣ����-�޸�</title>
</head>

<body>
<%@include file="../include/header.jsp"%>
<table width="100%" height="350"  border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF"><tr><td>

<form action="saverolexml.jsp" method="post">
<input type="hidden" name="roleid" value="<%=roleid%>">
<table width="80%" height="300" align="center" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td height="30" class="table_title"><%=StringEscapeUtils.escapeHtml(strRoleName)%>(roleid=<%=strRoleId%>)&nbsp;&nbsp;--&nbsp;��ɫ��ʼ��Ϣ</td>
  </tr>
  <tr>
    <td><textarea cols=80 rows=20 name="rolexml" style="width: 100%; word-break: break-all; background-color:D7F8AB"><%=xmlstring%></textarea></td>
  </tr>
  <tr>
    <td height="50" align="center">
    &nbsp;<font color=red>���棺�˴�������ܻᵼ�·�����崻������벻���Ĵ�������</font><br>
	<input type="submit" class="button" value="����" />&nbsp;&nbsp;&nbsp;&nbsp;
  </tr>
</table>
</form>

</td></tr></table>
<%@include file="../include/foot.jsp"%>
</body>
</html>

