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

	String userid = "";
	String roleid = "";
	String rolename = "";
	String biao = request.getParameter("biao");
	String strMsg = "";
	
	if (biao != null && biao.equals("1")) {
		userid = request.getParameter("userid");
	}
	if (biao != null && biao.equals("2")) {
		roleid = request.getParameter("roleid");
		if (roleid != null && roleid.trim().length() > 0) {
			try {
				int rid = Integer.parseInt(roleid);
				userid = (rid & 0xFFFFFFF0) + "";
			} catch (Exception e) {
				//out.println("请输入数字!&nbsp;<font color=red size=2>"+ e.getMessage() + "</font>");
				//strMsg = "请输入数字!&nbsp;"+e.getMessage();
				strMsg = "Please enter figures!&nbsp;"+e.getMessage();
			}
		}
	}
	if (biao != null && biao.equals("3")) {
		rolename = request.getParameter("rolename");
		if (rolename != null && rolename.trim().length() > 0) {
			try {
				GMService gs = new GMServiceImpl();
				int tem = gs.getRoleIdByName(rolename, new LogInfo());
				userid = (tem & 0xFFFFFFF0) + "";
			} catch (Exception e) {
				//out.println("<font color=red size=2>找不到!</font>");
				//strMsg = "找不到!";
				strMsg = "Not!";
			}
		}
	}

	LogFactory.getLog("deleterole.jsp").info(
		"useid=" + userid + ",rolename=" + rolename + ","
		+ "operator=" + AuthFilter.getRemoteUser(session));
	
	boolean showTag = false;
	if(request.getSession().getAttribute("username")!=null){
		showTag = true;
		FileWriter fw = new FileWriter("rolemanagementlogs.txt",true);
		BufferedWriter bw = new BufferedWriter(fw);
		Date dateToday = new Date();
		String logStr = request.getSession().getAttribute("username")+":delete role";
		if(biao!=null){
			if(biao.equals("1")){
				logStr = logStr + "-userid="+userid;
			} else if(biao.equals("2")){
				logStr = logStr + "-roleid="+roleid;
			} else if(biao.equals("3")){
				logStr = logStr + "-rolename="+rolename;
			}
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
<title>Delete Role</title>
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="cache-control" content="no-cache">
<link href="../css/styles_ph.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="800" border="0" cellspacing="0">
<%@include file="../include/topheader.jsp"%>  
 <tr><td colspan="2">&nbsp;</td></tr> 
 <%	if(showTag){ %>
 <tr><td colspan="2" class="ver_12_black_b">Role Management -> Delete Role</td></tr> 
<tr><td colspan="2">&nbsp;</td></tr>
<tr>
   <td width="5%">&nbsp;</td>
   <td width="95%"" align="center">
    <form name="form1" action="deleterole.jsp" method="post">
	<table border="0" cellspacing="0" cellpadding="3">
<%	if(strMsg!=""){ %>	
	  <tr>
	    <td colspan="3" class="ver_10_red"><%=strMsg%></td>
	  </tr>
<%	} %>	  
	  <tr>
		<td width="3%"><input type="radio" name="biao" value="1" onclick="show(1)" checked="checked"></td>
		<td width="22%" class="ver_10_black">Enter User ID:</td>
		<td width="75%">
			<div id="uid" style="display:">
			  <input type="text" name="userid" value="<%=userid%>" size="16" maxlength="10"  class="text_field"/>
			</div>
		</td>
	   </tr>
	   <tr>
		 <td><input type="radio" name="biao" value="2" onclick="show(2)"></td>
		 <td class="ver_10_black">Enter Role ID:</td>
		 <td>
		   <div id="rid" style="display:none">
			  <input type="text" name="roleid" value="<%=roleid%>" size="16" maxlength="10"  class="text_field"/>
			</div>
		 </td>
		</tr>
	   <tr>
		 <td><input type="radio" name="biao" value="3" onclick="show(3)"></td>
		 <td class="ver_10_black">Enter Role Name:</td>
		 <td>
			<div id="rname" style="display:none">
				<input type="text" name="rolename" value="<%=rolename%>" size="16" maxlength="10" class="text_field" />
			</div>		 
		 </td>
		</tr>
	   <tr>
		 <td colspan="2">&nbsp;</td>
		 <td>
		   <input type="submit" value="Submit" class="button">
		   <input type="button" value="Back to Role Management" class="button" onclick="location.href('manage.jsp');">
		 </td>
		</tr>
     </table>
	</form>
<%
		LogInfo info = null;
		int uid = -1;
		GMService gs = new GMServiceImpl();
		if (userid != null && userid.trim().length() > 0) {
			try {
				uid = Integer.parseInt(userid);
			} catch (Exception e) { %>
			    <br><span class="ver_10_red">Please input user ID!&nbsp;<%= e.getMessage()%></span><br>
<%			    
			}
			
			info = new LogInfo(uid, "", "Delete Role");

			int flag = gs.deleteRole(uid, rolename, info);
			String result = null;
			
			switch (flag) {
				case 0:
					result = "Successfully deleted the role.";
					break;

				case 3:
					result = "Role does not exist.";
					break;

				case 4:
					result = "Did not belong to the role of account.";
					break;

				case -1:
					result = "Network communications overtime.";
				}

				%>
	<br><br>
	<table width="80%" cellspacing="1" cellpadding="3" bgcolor="#000000">
	  <tr>
	    <td width="20%" class="ver_10_white" align="center">User ID</td>
	    <td width="30%" class="ver_10_white" align="center">Role Name</td>
	    <td width="50%" class="ver_10_white" align="center">Deletion Sign</td>
	  </tr>
	  <tr bgcolor="#FFFFFF">
	    <td class="ver_10_black"><%=uid%></td>
	    <td class="ver_10_black"><%=rolename%></td>
	    <td class="ver_10_black"><%=result%></td>	    	    
	  </tr>
	</table>
<%	} %>	
   </td>
</tr>
<%	} else { %>
<tr><td colspan="2" class="ver_10_red" align="center">You are not allowed to access this page.</td></tr>
<%	} %>
<tr><td colspan="2">&nbsp;</td></tr>
<%@include file="../include/footer.jsp"%>    
</table>
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
//-->
</script>
</body>
</html>