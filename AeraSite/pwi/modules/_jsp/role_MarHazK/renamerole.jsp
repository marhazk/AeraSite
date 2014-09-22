<%@ page language="java" pageEncoding="GB2312"%>
<%@ page import="com.goldhuman.auth.AuthFilter"%>
<%@ page import="com.goldhuman.service.interfaces.LogInfo"%>
<%@ page import="com.goldhuman.service.interfaces.GMService"%>
<%@ page import="com.goldhuman.service.GMServiceImpl"%>
<%@page import="org.apache.commons.logging.LogFactory"%>

<%
	request.setCharacterEncoding("GB2312");

	String userid = "";
	String roleid = "";
	String oldname = new String("");
	String newname = new String("");
	String biao = request.getParameter("biao");
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
				out.println("Please input numbers!&nbsp;<span class='ver_10_red'>"+ e.getMessage() + "</font>");
			}
		}
	}

	if(request.getParameter("oldname")!="" && request.getParameter("oldname")!=null){
		oldname = request.getParameter("oldname");
	} else {
		oldname = "";
	}
	if(request.getParameter("newname")!="" &&  request.getParameter("newname")!=null)
		newname = request.getParameter("newname");
	else newname = "";

	LogFactory.getLog("renamerole.jsp").info(
		"userid=" + userid + ",oldname=" + oldname + ",newname="
		+ newname + "," + "operator="
		+ AuthFilter.getRemoteUser(session));
	
	boolean showTag = false;
	if(request.getSession().getAttribute("username")!=null){
		showTag = true;
		//out.println("username:"+request.getSession().getAttribute("username").toString());
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
 <%		if(showTag) { %>
 <tr><td colspan="2" class="ver_12_black_b">Role Management -> Change Role Name</td></tr> 
<tr><td colspan="2">&nbsp;</td></tr>
<tr>
   <td width="5%">&nbsp;</td>
   <td width="95%"" align="center">
   <form name="form1" action="renamerole.jsp" method="post">
     <table width="100%" cellspacing="0" cellpadding="3">
       <tr>
         <td width="3%"><input type="radio" name="biao" value="1" onclick="show(1)" checked="checked"></td>
         <td width="20%" class="ver_10_black">Input User ID:</td>
         <td width="77%">
	         <div id="uid" style="display:">
				<input type="text" name="userid" value="<%=userid%>" size="16" maxlength="10" class="text_field" />
			</div>
         </td>
       </tr>
       <tr>
         <td><input type="radio" name="biao" value="2" onclick="show(2)"></td>
         <td class="ver_10_black">Input Role ID:</td>
         <td>
			<div id="rid" style="display:none">
				<input type="text" name="roleid" value="<%=roleid%>" size="16" maxlength="10"  class="text_field"/>
			</div>         
         </td>
       </tr>
      <!-- <tr>
         <td></td>
         <td class="ver_10_black"></td>
         <td></td>
       </tr> -->
       <tr>
         <td class="ver_10_black" colspan="2">Enter Old Role Name:</td>
         <td><input type="text" name="oldname" value="<%=oldname%>" size="16" maxlength="10" class="text_field" /></td>
       </tr>
       <tr>
         <td class="ver_10_black" colspan="2">Enter New Role Name:</td>
         <td><input type="text" name="newname" value="<%=newname%>" size="16" maxlength="10" class="text_field" /></td>
       </tr>
       <tr>
         <td colspan="2">&nbsp;</td>
         <td>
           <input type="submit" value="Submit" class="button">
           <input type="button" value="Back to Role Management" class="button" onclick="location.href('manage.jsp');">
          </td>
       </tr>
       <tr><td class="ver_10_black"></td></tr>
     </table>
    </form>
    <br><br>
    
<%
		LogInfo info = null;
		int uid = -1;
		int zoneid = -1;

		GMService gs = new GMServiceImpl();
		if (userid != null && userid.trim().length() > 0) {
			try {
				uid = Integer.parseInt(userid);
			} catch (Exception e) {
				out.println("\"User Input ID\" Please input numbers!&nbsp;<span class='ver_10_red'>"+ e.getMessage() + "</font>");
			}
			info = new LogInfo(uid, "", "Rename Role");

			int flag = gs.renameRole(uid, zoneid, oldname, newname, info);
			
			String result = null;
			switch (flag) {
				case 0:
					//result = "成功";
					result = "Success";
					break;

				case 4:
					result = "Non-existent Role.";
					break;

				case 5:
					//result = "角色不属于该帐号";
					result = "Role does not belong to the account.";
					break;

				case 6:
					//result = "新角色名称已存在,请重新选择";
					result = "Role name already exists, please select another one.";
					break;

				case 7:
					//result = "该角色不能改名";
					result = "Role can not be renamed.";
					break;

				case -1:
					//result = "网络通讯超时";
					result = "Network communications overtime.";
					break;
				}
%>
		<table width="90%" cellspacing="1" cellpadding="3" bgcolor="#000000">
		  <tr>
		  	<td width="10%" class="ver_10_white">User ID</td>
		  	<td width="15%" class="ver_10_white">Server ID</td>
		  	<td width="20%" class="ver_10_white">Old Role Name</td>
		  	<td width="20%" class="ver_10_white">New Role Name</td>
		  	<td width="25%" class="ver_10_white">Role Modification Sign</td>
		  </tr>
		  <tr bgcolor="#FFFFFF">
			<td class="ver_10_black"><%=uid%></td>
			<td class="ver_10_black"><%=zoneid%></td>
			<td class="ver_10_black"><%=oldname%></td>
			<td class="ver_10_black"><%=newname%></td>		
			<td class="ver_10_black"><%=result%></td>										
		  </tr>
		</table>
<%		} %>
   </td>
</tr>
<%		} else { %>
<tr><td colspan="2" class="ver_10_red" align="center">You are not allowed to access this page.</td></tr>
<%		} %>
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
    }
//-->
</script>
</body>
</html>