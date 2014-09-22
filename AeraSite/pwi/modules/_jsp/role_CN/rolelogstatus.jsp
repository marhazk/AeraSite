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

		<title>角色状态</title>
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
								角色ID
							</TH>
							<TH>
								状态标志
							</TH>
						</TR>
						<%int rid = -1;
			LogInfo info = null;
			GMService gs = new GMServiceImpl();
			if (roleid != null && roleid.trim().length() > 0) {
				try {
					rid = Integer.parseInt(roleid);
				} catch (Exception e) {
					out.println("请输入数字!&nbsp;<font color=red size=2>"
							+ e.getMessage() + "</font>");
				}
				info = new LogInfo(rid, "", "角色状态");
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
									查询角色状态:
								</td>
							<tr>
							<tr>
								<td>
									输入角色ID:
									<input type="text" name="roleid" value="<%=roleid%>" size="16" maxlength="10" />
									&nbsp;&nbsp;
									<input type="submit" value="提交">
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
