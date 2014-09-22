<%@ page language="java" pageEncoding="GB2312"%>
<%@ page import="com.goldhuman.auth.AuthFilter"%>
<%@ page import="com.goldhuman.service.interfaces.LogInfo"%>
<%@ page import="com.goldhuman.service.interfaces.GMService"%>
<%@ page import="com.goldhuman.service.GMServiceImpl"%>
<%@page import="org.apache.commons.logging.LogFactory"%>

<%request.setCharacterEncoding("GB2312");

			String rolename = request.getParameter("rolename");
			LogFactory.getLog("rolenameexists.jsp").info(
					"rolename=" + rolename + "," + "operator="
							+ AuthFilter.getRemoteUser(session));

			%>



<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>

		<title>��ɫ���Ƿ����</title>
		<link href="../include/style.css" rel="stylesheet" type="text/css">
	</head>

	<body>
		<%@include file="../include/header.jsp"%>

		<table width="100%" height="514" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
			<tr>
				<td>
					<TABLE align="center" border="1" cellpadding="0" cellspacing="1" width="400px" bgcolor="#FFFFFF">
						<TR>
							<TH>
								��ɫ��
							</TH>
							<TH>
								���ڱ�־
							</TH>
						</TR>
						<%GMService gs = new GMServiceImpl();

			LogInfo info = new LogInfo(-1, rolename, "ͨ��Ψһ���������жϽ�ɫ���Ƿ����");
			if (rolename != null && rolename.trim().length() > 0) {
				int flag = gs.rolenameExists(rolename, info);
				String result = "";
				switch (flag) {
				case 0:
					result = "��ɫ������";
					break;
				case 1:
					result = "��ɫ��������";
					break;
				case -1:
					result = "��������";
				}

				%>
						<TR>
							<TD>
								<%=rolename%>
							</TD>
							<TD>
								<%=result%>
							</TD>
						</TR>
						<%}%>
					</TABLE>

				</td>
			</tr>

			<tr>
				<td align="center">
					<form name="form1" action="rolenameexists.jsp" method="post">
						��ѯ��ɫ���Ƿ����:
						<br>
						�����ɫ����:
						<input type="text" name="rolename" value="" size="16" maxlength="10" />
						&nbsp;&nbsp;
						<input type="submit" value="�ύ">
					</form>
				</td>
			</tr>

		</table>

		<%@include file="../include/foot.jsp"%>

	</body>
</html>
