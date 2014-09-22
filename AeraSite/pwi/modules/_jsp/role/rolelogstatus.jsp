<%@ page contentType="text/html; charset=UTF-8" %>
<%@ page import="com.goldhuman.auth.AuthFilter"%>
<%@ page import="com.goldhuman.service.interfaces.LogInfo"%>
<%@ page import="com.goldhuman.service.interfaces.GMService"%>
<%@ page import="com.goldhuman.service.GMServiceImpl"%>
<%@page import="org.apache.commons.logging.LogFactory"%>
<%@page import="com.goldhuman.util.LocaleUtil" %>

<%
			String roleid = request.getParameter("roleid");
			LogFactory.getLog("rolelogstatus.jsp").info(
					"roleid=" + roleid + "," + "operator="
							+ AuthFilter.getRemoteUser(session));

			%>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>

		<title><%= LocaleUtil.getMessage(request,"role_logstatus_rolestatus") %></title>
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
								<%= LocaleUtil.getMessage(request,"role_logstatus_roleid") %>
							</TH>
							<TH>
								<%= LocaleUtil.getMessage(request,"role_logstatus_statusflag") %>
							</TH>
						</TR>
						<%int rid = -1;
			LogInfo info = null;
			GMService gs = new GMServiceImpl();
			if (roleid != null && roleid.trim().length() > 0) {
				try {
					rid = Integer.parseInt(roleid);
				} catch (Exception e) {
					out.println(LocaleUtil.getMessage(request,"role_logstatus_inputnum") + "&nbsp;<font color=red size=2>" + e.getMessage() + "</font>");
				}
				info = new LogInfo(rid, "", LocaleUtil.getMessage(request,"role_logstatus_rolestatus"));
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
									<%= LocaleUtil.getMessage(request,"role_logstatus_searchrole") %>
								</td>
							<tr>
							<tr>
								<td>
									<%= LocaleUtil.getMessage(request,"role_logstatus_inputroleid") %>
									<input type="text" name="roleid" value="<%=roleid%>" size="16" maxlength="10" />
									&nbsp;&nbsp;
									<input type="submit" value="<%= LocaleUtil.getMessage(request,"role_logstatus_submit") %>">
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
