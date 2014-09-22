<%@ page language="java" pageEncoding="GB2312"%>
<%@ page import="com.goldhuman.auth.AuthFilter"%>
<%@ page import="com.goldhuman.service.interfaces.LogInfo"%>
<%@ page import="com.goldhuman.service.interfaces.GMService"%>
<%@ page import="com.goldhuman.service.GMServiceImpl"%>
<%@page import="org.apache.commons.logging.LogFactory"%>

<%request.setCharacterEncoding("GB2312");

			String roleid = request.getParameter("roleid");
			LogFactory.getLog("rolelogstatus.jsp").info(
					"roleid=" + roleid + "," + "operator="
							+ AuthFilter.getRemoteUser(session));

			%>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>

		<title>��ɫ״̬</title>
		<link href="../include/style.css" rel="stylesheet" type="text/css">
	</head>

	<body>
		<%@include file="../include/header.jsp"%>

		<table width="100%" height="514" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">

			<tr>
				<td>
					<TABLE border="1" cellpadding="0" cellspacing="1" width="400px" align="center">
						<TR>
							<TH>
								��ɫID
							</TH>
							<TH>
								״̬��־
							</TH>
						</TR>
						<%int rid = -1;
			LogInfo info = null;
			GMService gs = new GMServiceImpl();
			if (roleid != null && roleid.trim().length() > 0) {
				try {
					rid = Integer.parseInt(roleid);
				} catch (Exception e) {
					out.println("����������!&nbsp;<font color=red size=2>"
							+ e.getMessage() + "</font>");
				}
				info = new LogInfo(rid, "", "��ɫ״̬");
				int flag = -1;
				flag = gs.getRoleLogStatus(rid, info);

				%>
						<TR>
							<TD>
								<%=roleid%>
							</TD>
							<TD>
								<%=flag%>
							</TD>
						</TR>
						<%}%>
					</TABLE>

			</td>
			</tr>

			<tr>
				<td align="center">
					<form name="form1" action="rolelogstatus.jsp" method="post">
						<table>
							<tr>
								<td>
									��ѯ��ɫ״̬:
								</td>
							<tr>
							<tr>
								<td>
									�����ɫID:
									<input type="text" name="roleid" value="<%=roleid%>" size="16" maxlength="10" />
									&nbsp;&nbsp;
									<input type="submit" value="�ύ">
								</td>
							</tr>
						</table>
					</form>
				</td>
			</tr>

		</table>
		<%@include file="../include/foot.jsp"%>
	</body>
</html>
