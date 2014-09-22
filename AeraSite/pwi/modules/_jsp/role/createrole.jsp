<%@ page contentType="text/html; charset=UTF-8" %>
<%@ page import="com.goldhuman.auth.AuthFilter"%>
<%@ page import="com.goldhuman.service.interfaces.LogInfo"%>
<%@ page import="com.goldhuman.service.interfaces.GMService"%>
<%@ page import="com.goldhuman.service.GMServiceImpl"%>
<%@ page import="protocol.*"%>
<%@page import="org.apache.commons.logging.LogFactory"%>
<%@page import="com.goldhuman.util.LocaleUtil"%>

<%
	String userid = request.getParameter("userid");
	String newname = request.getParameter("newname");
	LogFactory.getLog("createrole.jsp").info( "userid=" + userid + ",newname="
							+ newname + "," + "operator="
							+ AuthFilter.getRemoteUser(session));

	if( userid == null ) userid = "";
	if( newname == null ) newname = "";

	int uid = -1;
	int zoneid = -1;

	if (userid.trim().length() <= 0 && newname.trim().length() > 0)
        {       
                out.println("please input userid");
                return;
        }
        if ( newname.trim().length() <= 0 && userid.trim().length() > 0)
        {
		out.println("please input username");
                return;
        }               

	String result = null;
        if(userid.trim().length() > 0 && newname.trim().length() > 0)
	{
		try {
			uid = Integer.parseInt(userid);
		} catch (Exception e) {
			out.println("\"" + LocaleUtil.getMessage(request,"role_createrole_inputid") + "\"" + LocaleUtil.getMessage(request,"role_createrole_inputnum") + "&nbsp;<font color=red size=2>" + e.getMessage() + "</font>");
		}

		UniquenameDB.ID ret1 = UniquenameDB.PreCreateRole( zoneid, uid, newname );
		if( ret1.roleid > 0 )
		{
			int newroleid = ret1.roleid;
			XmlRole.Role role = new XmlRole.Role();
			role.base = new GRoleBase();
			role.status = new GRoleStatus();
			role.base.id = newroleid;
			role.base.gender = 1;
			role.base.race = 1;
			role.base.cls = 1;
			role.status.level = 1;
			role.base.name.setString( newname ); 
			int ret2 = GameDB.createRole(uid, ret1.logicuid, newroleid, role );
			if( ret2 > 0 )			result = LocaleUtil.getMessage(request,"role_createrole_createok") + ret2;
			else if( -48 == ret2 )		result = LocaleUtil.getMessage(request,"role_createrole_roleexist");
			else if( -33 == ret2 )		result = LocaleUtil.getMessage(request,"role_createrole_createfail");
			else				result = LocaleUtil.getMessage(request,"role_createrole_unknow") + " GameDB.createRole ret=" + ret2;
		}
		else if( -45 == ret1.roleid )
			result = LocaleUtil.getMessage(request,"role_createrole_nameexist");
		else if( -46 == ret1.roleid )
			result = LocaleUtil.getMessage(request,"role_createrole_rolespacefull");
		else
			result = LocaleUtil.getMessage(request,"role_createrole_unknow") +  " UniquenameDB.PreCreateRole ret=" + ret1.roleid;
	}
	else
	{
		result = LocaleUtil.getMessage(request,"role_createrole_idname");
	}
%>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>

		<title><%= LocaleUtil.getMessage(request,"role_createrole_newrole") %>«</title>
		<link href="../include/style.css" rel="stylesheet" type="text/css">
	</head>

	<body>
		<%@include file="../include/header.jsp"%>

		<table width="100%" height="514" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">

			<tr>
				<td align="center">
					<% out.println( result ); %>
				</td>
			</tr>
			<tr>
				<td align="center">
					<form name="form1" action="createrole.jsp" method="post">
						<table border="0">
							<tr>
								<td>
									<%= LocaleUtil.getMessage(request,"role_createrole_inputid") %>
								</td>
								<td>
									<input type="text" name="userid" value="<%=userid%>" size="16" maxlength="10" />
								</td>
							</tr>
							<tr>
								<td>
									<%= LocaleUtil.getMessage(request,"role_createrole_newrolename") %>
								</td>
								<td>
									<input type="text" name="newname" value="<%=newname%>" size="16" maxlength="32" />
								</td>
							</tr>
						</table>

						<input type="submit" value="<%= LocaleUtil.getMessage(request,"role_cashinfo_submit") %>">
					</form>
				</td>
			</tr>

		</table>
		<%@include file="../include/foot.jsp"%>
	</body>
</html>
