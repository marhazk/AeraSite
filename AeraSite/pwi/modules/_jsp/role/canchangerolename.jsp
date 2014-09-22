<%@ page contentType="text/html; charset=UTF-8" %>
<%@ page import="com.goldhuman.auth.AuthFilter"%>
<%@ page import="com.goldhuman.service.interfaces.LogInfo"%>
<%@ page import="com.goldhuman.service.interfaces.GMService"%>
<%@ page import="com.goldhuman.service.GMServiceImpl"%>
<%@page import="org.apache.commons.logging.LogFactory"%>
<%@page import="com.goldhuman.util.LocaleUtil" %>
<%
			String rolename = request.getParameter("rolename");
			if (rolename == null)
				rolename = "";
			LogFactory.getLog("canchangerolename.jsp").info(
					"operator=" + AuthFilter.getRemoteUser(session));

			%>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>

		<title><i18n:message key="role_canchangerolename_title"/>û</title>
		<link href="../include/style.css" rel="stylesheet" type="text/css">
	</head>

	<body>
		<%@include file="../include/header.jsp"%>

		<table width="100%" height="514" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">

			<tr>
				<td>
                                        <TABLE align="center" border="1" cellpadding="0" cellspacing="1" width="300px">
                                                <TR>
                                                        <TD>
                                                        	<%= LocaleUtil.getMessage(request,"role_canchangerolename_rolename")%>
                                                        </TD>
                                                        <TD>
                                                        	<%= LocaleUtil.getMessage(request,"role_canchangerolename_ischanged") %>        
                                                        </TD>
                                                </TR>
                                                <%int flag = -1;
                        GMService gs = new GMServiceImpl();
                        LogInfo info = new LogInfo(-1, rolename, LocaleUtil.getMessage(request,"role_canchangerolename_loginfo"));
                        if (rolename != null && rolename.trim().length() > 0) {
                                flag = gs.canChangeRolename(rolename, info);
                                String result = null;
                                switch (flag) {
                                case 0:
                                        result = LocaleUtil.getMessage(request,"role_canchangerolename_canchanged");
                                        break;

                                case 1:
                                        result = LocaleUtil.getMessage(request,"role_canchangerolename_cannotchanged");
                                        break;

				case 2:
					result = LocaleUtil.getMessage(request,"role_canchangerrolename_rolenotexist");
					break;

				case -1:
					result = "-1";

				}

				%>
						<TR>
							<TD>
								<%=rolename%>
								&nbsp;
							</TD>
							<TD>
								<%=result%>
								&nbsp;
							</TD>
						</TR>
						<%}%>
					</TABLE>
				</td>
			</tr>

			<tr>
				<td align="center">
					<form name="form1" action="canchangerolename.jsp" method="post">
						<%= LocaleUtil.getMessage(request,"role_canchangerolename_searchrole") %>
						<br>
						<%= LocaleUtil.getMessage(request,"role_canchangerolename_inputrole") %>
						<input type="text" name="rolename" value="<%=rolename%>" size="16" maxlength="10" />
						&nbsp;&nbsp;
						<input type="submit" value="<%= LocaleUtil.getMessage(request,"role_canchangerolename_submit") %>" />
					</form>
				</td>
			</tr>

		</table>
		<%@include file="../include/foot.jsp"%>
	</body>
</html>
