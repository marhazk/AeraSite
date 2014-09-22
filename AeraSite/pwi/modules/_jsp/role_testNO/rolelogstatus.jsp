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
	String roleid = new String("");
	if(request.getParameter("roleid")!="" && request.getParameter("roleid")!=null){
		roleid = request.getParameter("roleid");
	}
	LogFactory.getLog("rolelogstatus.jsp").info(	"roleid=" + roleid + "," + "operator="+ AuthFilter.getRemoteUser(session));

	boolean showTag = false;
	if(request.getSession().getAttribute("username")!=null){
		showTag = true;
		FileWriter fw = new FileWriter("rolemanagementlogs.txt",true);
		BufferedWriter bw = new BufferedWriter(fw);
		Date dateToday = new Date();
		String logStr = request.getSession().getAttribute("username")+":role status";
		if(roleid!=null){
			logStr = logStr + "-roleid="+roleid;
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
<title>Role Status</title>
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="cache-control" content="no-cache">
<link href="../css/styles_ph.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="800" border="0" cellspacing="0">
<%@include file="../include/topheader.jsp"%>  
 <tr><td colspan="2">&nbsp;</td></tr> 
<%	if(showTag){ %>
 <tr><td colspan="2" class="ver_12_black_b">Role Management -> Role Status</td></tr> 
<tr><td colspan="2">&nbsp;</td></tr>
<tr>
   <td width="3%">&nbsp;</td>
   <td width="97%"" align="left">
   <form name="form1" action="rolelogstatus.jsp" method="post">
	<table width="100%" cellspacing="0" cellpadding="3">
	  <tr><td class="ver_10_black">Check Role Status:</td><tr>
	  <tr>
		<td class="ver_10_black">Input Role ID:
		  <input type="text" name="roleid" value="<%=roleid%>" size="16" maxlength="10" class="text_field"/>
		  <input type="submit" value="Submit" class="button">
		  <input type="button" value="Back to Role Management" class="button" onclick="location.href('manage.jsp');">
		</td>
	   </tr>
	</table>
    </form>
<%
		int rid = -1;
		LogInfo info = null;
		GMService gs = new GMServiceImpl();
		if (roleid != null && roleid.trim().length() > 0) { %>
    <br><br>
    <table border="0" cellpadding="3" cellspacing="1" width="80%" align="left" bgcolor="#000000">
	  <tr>
		<td class="ver_10_white">Role ID</td>
		<td class="ver_10_white">Status Sign</td>
	 </tr>		
<%		
			try {
				rid = Integer.parseInt(roleid);
			} catch (Exception e) { %>
				<span class="ver_10_black">Please input numbers.</span>&nbsp;<span class="ver_10_red"><%=e.getMessage()%></span>
<%				
			}
			info = new LogInfo(rid, "", "Status of the Role");
			int flag = -1;
			flag = gs.getRoleLogStatus(rid, info);
%>
		<tr bgcolor="#FFFFFF">
		  <td class="ver_10_black"><%=roleid%></td>
		  <td class="ver_10_black"><%=flag%></td>
		</tr>
	 </table>		
<%
		}%>
   </td>
 </tr>
 <%	} else { %>
  <tr><td colspan="2" class="ver_10_red" align="center">You are not allowed to access this page.</td></tr>
 <%	} %>
  <tr><td colspan="2">&nbsp;</td></tr>
<%@include file="../include/footer.jsp"%>
 </table>
</body>
</html>