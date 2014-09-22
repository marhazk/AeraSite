<%@ page language="java" pageEncoding="GB2312"%>
<%@ page import="com.goldhuman.auth.AuthFilter"%>
<%@ page import="com.goldhuman.service.interfaces.LogInfo"%>
<%@ page import="com.goldhuman.service.interfaces.GMService"%>
<%@ page import="com.goldhuman.service.GMServiceImpl"%>
<%@page import="org.apache.commons.logging.LogFactory"%>
<%@page import="java.io.*"%>
<%@page import="java.util.*"%>
<%
	request.setCharacterEncoding("GB2312");
	String rolename = request.getParameter("rolename");
	LogFactory.getLog("rolenameexists.jsp").info("rolename=" + rolename + "," + "operator="+ AuthFilter.getRemoteUser(session));
	
	boolean showTag = false;
	if(request.getSession().getAttribute("username")!=null){
		showTag = true;
		FileWriter fw = new FileWriter("rolemanagementlogs.txt",true);
		BufferedWriter bw = new BufferedWriter(fw);
		Date dateToday = new Date();
		String logStr = request.getSession().getAttribute("username")+":check role name";
		if(rolename!=null){
			logStr = logStr + "-rolename="+rolename;
		}
		logStr = logStr + ":"+dateToday;
		bw.write(logStr);
		bw.newLine();
		bw.close();
		bw = null;
		fw = null;
	}	
%>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Check Role Name</title>
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="cache-control" content="no-cache">
<link href="../css/styles_ph.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="800" border="0" cellspacing="0">
<%@include file="../include/topheader.jsp"%>  
 <tr><td colspan="2">&nbsp;</td></tr> 
 <%		if(showTag){ %>
 <tr><td colspan="2" class="ver_12_black_b">Role Management -> Check Role Name</td></tr> 
<tr><td colspan="2">&nbsp;</td></tr>
<tr>
   <td width="5%">&nbsp;</td>
   <td width="95%"" align="center">
     <form name="form1" action="rolenameexists.jsp" method="post">
     <table width="100%" cellspacing="0" cellpadding="3">
        <tr><td colspan="2">&nbsp;</td></tr>
        <tr>
          <td width="15%" class="ver_10_black">Enter Role Name:</td>
          <td width="85%"><input type="text" name="rolename" value="" size="16" maxlength="10" class="text_field"/></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>
            <input type="submit" value="Submit" class="button">
            <input type="button" value="Back to Role Management" class="button" onclick="location.href('manage.jsp');">
          </td>
        </tr>
     </table>
     </form>
     <br><br>
<%
		GMService gs = new GMServiceImpl();
		LogInfo info = new LogInfo(-1, rolename, "Check Role Name");
		if (rolename != null && rolename.trim().length() > 0) {
			int flag = gs.rolenameExists(rolename, info);
			String result = "";
			switch (flag) {
				case 0:
					result = "Role exists";
					break;
				case 1:
					result = "Role name does not exist.";
					break;
				case -1:
					result = "Other Errors";
					break;
			}			
%>     
     <table width="80%" cellspacing="1" cellpadding="3" bgcolor="#000000">
       <tr>
          <td width="40%" class="ver_10_white_b">Role Name</td>
          <td width="60%" class="ver_10_white_b">Sign of Existence</td>
        </tr>
       <tr bgcolor="#FFFFFF">
          <td class="ver_10_black"><%=rolename%></td>
          <td class="ver_10_black"><%=result%></td>
        </tr>
     </table>     
<%
		} 
%>     
  </td>
</tr>
<%		} else { %>
<tr><td colspan="2" class="ver_10_red" align="center">You are not allowed to access this page.</td></tr>
<%		} %>
<tr><td colspan="2">&nbsp;</td></tr>
<%@include file="../include/footer.jsp"%>  
</table>
</body>
</html>