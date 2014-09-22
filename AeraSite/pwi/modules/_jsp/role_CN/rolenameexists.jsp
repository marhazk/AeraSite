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

		<title>角色名是否存在</title>
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
								角色名
							</TH>
							<TH>
								存在标志
							</TH>
						</TR>
						<%GMService gs = new GMServiceImpl();

			LogInfo info = new LogInfo(-1, rolename, "通过唯一名服务器判断角色名是否存在");
			if (rolename != null && rolename.trim().length() > 0) {
				int flag = gs.rolenameExists(rolename, info);
				String result = "";
				switch (flag) {
				case 0:
					result = "角色名存在";
					break;
				case 1:
					result = "角色名不存在";
					break;
				case -1:
					result = "其他错误";
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
						查询角色名是否存在:
						<br>
						输入角色名称:
						<input type="text" name="rolename" value="" size="16" maxlength="10" />
						&nbsp;&nbsp;
						<input type="submit" value="提交">
					</form>
				</td>
			</tr>

		</table>

		<%@include file="../include/foot.jsp"%>

	</body>
</html>
