<%@ page contentType="text/html; charset=UTF-8" %>
<%@ page import="com.goldhuman.auth.AuthFilter"%>
<%@ page import="com.goldhuman.service.interfaces.LogInfo"%>
<%@ page import="com.goldhuman.service.interfaces.GMService"%>
<%@ page import="com.goldhuman.service.GMServiceImpl"%>
<%@page import="org.apache.commons.logging.LogFactory"%>
<%@page import="com.goldhuman.util.LocaleUtil" %>

<%
			String userid = "";
			String roleid = "";
			String rolename = "";
				rolename = request.getParameter("rolename");
				if (rolename != null && rolename.trim().length() > 0) {
					try {
						GMService gs = new GMServiceImpl();
						int tem = gs.getRoleIdByName(rolename, new LogInfo());
						if (-1 == tem)
							throw new Exception("getRoleIdByName error");
						roleid = Integer.toString(tem);
						int tmpid = gs.roleid2Uid(new Integer(tem), new LogInfo());
						if (-1 == tmpid)
							throw new Exception("roleid2Uid error");
						userid = Integer.toString(tmpid);
					} catch (Exception e) {
						out.println("<font color=red size=2>"+ LocaleUtil.getMessage(request,"role_deleterole_nofound") + "</font>");
					}
				}

			LogFactory.getLog("deleterole.jsp").info(
					"useid=" + userid + ",rolename=" + rolename + ","
							+ "operator=" + AuthFilter.getRemoteUser(session));

			%>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>

		<title><%= LocaleUtil.getMessage(request,"role_deleterole_delerole") %></title>
		<link href="../include/style.css" rel="stylesheet" type="text/css">
	</head>

	<body>
		<%@include file="../include/header.jsp"%>

		<table width="100%" height="514" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">

			<tr>
				<td>
					<TABLE align="center" border="1" cellpadding="0" cellspacing="1" width="500px">
						<TR>
							<TH>
								<%= LocaleUtil.getMessage(request,"role_deleterole_userid") %>
							</TH>
							<TH>
								roleid	
							</TH>	
							<TH>
								<%= LocaleUtil.getMessage(request,"role_deleterole_rolename") %>
							</TH>
							<TH>
								<%= LocaleUtil.getMessage(request,"role_deleterole_deleflag") %>
							</TH>
						</TR>
						<%LogInfo info = null;
			int uid = -1;
			GMService gs = new GMServiceImpl();
			if (userid != null && userid.trim().length() > 0) {
				try {
					uid = Integer.parseInt(userid);
				} catch (Exception e) {
					out .println("\"" + LocaleUtil.getMessage(request,"role_deleterole_inputroleid") + "\"" 
						+ LocaleUtil.getMessage(request,"role_deleterole_inputnum") 
						+ " &nbsp;<font color=red size=2>" + e.getMessage() + "</font>");
				}
				info = new LogInfo(uid, "", LocaleUtil.getMessage(request,"role_deleterole_delerole"));

				int flag = gs.deleteRole(uid, rolename, info);
				String result = null;
				switch (flag) {
				case 0:
					result = LocaleUtil.getMessage(request,"role_deleterole_succ");
					break;

				case 3:
					result = LocaleUtil.getMessage(request,"role_deleterole_rolenotexist");
					break;

				case 4:
					result = LocaleUtil.getMessage(request,"role_deleterole_rolenotmatchacco");
					break;

				case -1:
					result = LocaleUtil.getMessage(request,"role_deleterole_timeout");
				}

				%>
						<TR>
							<TD>
								<%=uid%>
							</TD>
							<TD>
								<%=roleid%>
							</TD>
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
					<form name="form1" action="deleterole.jsp" method="post">
						<%= LocaleUtil.getMessage(request,"role_deleterole_delerole") %>
						<table border="0">
							<tr>
								<td>
									<%= LocaleUtil.getMessage(request,"role_deleterole_inputrolename") %>
									<input type="text" name="rolename" value="<%=rolename%>" size="16" maxlength="10" />
								</td>
							</tr>
						</table>

						<input type="submit" value="<%= LocaleUtil.getMessage(request,"role_deleterole_submit") %>">
					</form>
				</td>
			</tr>

		</table>
		<%@include file="../include/foot.jsp"%>

		<script language="javascript">
<!--

    function show(t){
      if(t==1)
        document.getElementById("uid").style.display="";
      else
        document.getElementById("uid").style.display="none";
      if(t==2)  
        document.getElementById("rid").style.display="";
      else
        document.getElementById("rid").style.display="none"; 
      if(t==3)
        document.getElementById("rname").style.display="";
      else 
        document.getElementById("rname").style.display="none";       
          
    
    }

-->

</script>

	</body>
</html>
