<%@ page language="java" pageEncoding="GB2312"%>
<%@ page import="java.util.*"%>
<%@ page import="com.goldhuman.auth.AuthFilter"%>
<%@ page import="com.goldhuman.service.interfaces.LogInfo"%>
<%@ page import="com.goldhuman.service.interfaces.SimpleRoleBean"%>
<%@ page import="com.goldhuman.service.interfaces.GMService"%>
<%@ page import="com.goldhuman.service.GMServiceImpl"%>
<%@ page import="org.apache.commons.logging.LogFactory"%>
<%@page import="java.io.*"%>
<%@page import="java.util.*"%>
<%
	request.setCharacterEncoding("GB2312");

	String userid = "";
	String roleid2 = "";
	String rname = "";
	String biao = request.getParameter("biao");
	
	if (biao != null && biao.equals("1")) {
		userid = request.getParameter("userid");
	}
	if (biao != null && biao.equals("2")) {
		roleid2 = request.getParameter("roleid2");
		if (roleid2 != null && roleid2.trim().length() > 0) {
			try {
				int rid2 = Integer.parseInt(roleid2);
				userid = (rid2 & 0xFFFFFFF0) + "";
			} catch (Exception e) {
				out.println("Please input numbers!&nbsp;<span class='ver_10_black'>" + e.getMessage() + "</span>");
			}
		}
	}
	if (biao != null && biao.equals("3")) {
		rname = request.getParameter("roname");
		if (rname != null && rname.trim().length() > 0) {
			try {
				GMService gs = new GMServiceImpl();
				int tem = gs.getRoleIdByName(rname, new LogInfo());
				userid = (tem & 0xFFFFFFF0) + "";
			} catch (Exception e) {
				out.println("<span class='ver_10_black'>Not!</span>");
			}
		}
	}

	if (userid == null || userid.trim().length() < 1)
		userid = (String) request.getAttribute("userid");
	else
		request.setAttribute("userid", userid);

	String fbdtype = request.getParameter("fbdtype");
	String forbidtime = request.getParameter("forbidtime");
	String roleid = request.getParameter("roleid");
	//String reason = reason = request.getParameter("reason");
	String reason = request.getParameter("reason");
	if (fbdtype == null)
		fbdtype = "";
	if (forbidtime == null)
		forbidtime = "";
	if (roleid == null)
		roleid = "";
	if (reason == null)
		reason = "";
	if (userid == null)
		userid = "";

	LogFactory.getLog("forbidrole.jsp").info("operator=" + AuthFilter.getRemoteUser(session));

	LogInfo info = null;
	int uid = -1;
	int rid = -1;
	GMService gs = new GMServiceImpl();

	boolean showTag = false;
	if(request.getSession().getAttribute("username")!=null){
		showTag = true;
		FileWriter fw = new FileWriter("rolemanagementlogs.txt",true);
		BufferedWriter bw = new BufferedWriter(fw);
		Date dateToday = new Date();
		String logStr = request.getSession().getAttribute("username")+":forbid role";
		logStr = logStr +"-id="+userid+";type="+fbdtype+";time="+forbidtime+";reason="+reason;
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
<title>Forbid Role</title>
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="cache-control" content="no-cache">
<link href="../css/styles_ph.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="800" border="0" cellspacing="0">
<%@include file="../include/topheader.jsp"%>  
 <tr><td colspan="2">&nbsp;</td></tr> 
 <%	if(showTag){ %>
 <tr><td colspan="2" class="ver_12_black_b">Role Management -> Forbid Role</td></tr> 
<tr><td colspan="2">&nbsp;</td></tr>
<tr>
   <td width="3%">&nbsp;</td>
   <td width="97%"" align="left">
<!-- code: start -->
    <form name="form1" action="forbidrole.jsp" method="post">
	<table border="0" cellspacing="0" cellpadding="3">
	  <tr>
		<td class="ver_10_black">
		  <input type="radio" name="biao" value="1" onclick="show(1)" checked="checked">Enter User ID:
		 </td>
		 <td>
		  <div id="uid" style="display:">
		    <input type="text" name="userid" value="<%=userid%>" size="16" maxlength="10" class="text_field"/>
		  </div>
		 </td>
		 <td class="ver_10_black">
			<input type="radio" name="biao" value="2" onclick="show(2)">Enter Role ID:
		 </td>
		 <td>
		  <div id="rid2" style="display:none">
			<input type="text" name="roleid2" value="<%=roleid2%>" size="16" maxlength="10" class="text_field"/>
		  </div>
		 </td>
		 <td class="ver_10_black">
		    <input type="radio" name="biao" value="3" onclick="show(3)">Enter Role Name:
		 </td>
		 <td class="ver_10_black">
			<div id="rname" style="display:none">
				<input type="text" name="roname" value="<%=rname%>" size="16" maxlength="10" class="text_field"/>
			</div>
		 </td>
		 <td class="ver_10_black"><input type="submit" value="Check" class="button"></td>
	    </tr>
	 </table>
     </form>
    </td>
 </tr>
 <%
		if (userid != null && userid.trim().length() > 0) {    %>
 <tr>
   <td>&nbsp;</td>
   <td align="left">
    <table border="0" cellspacing="1" cellpadding="3" bgcolor="#000000">
	  <tr>
		<td class="ver_10_white">Role ID</td>
		<td class="ver_10_white">Role Name</td>
		<td class="ver_10_white">Role Level</td>
	  </tr>
<%		try {
				uid = Integer.parseInt(userid);
			} catch (Exception ee) { %>
				<span class="ver_10_black">Please input a number for User ID.</span>&nbsp;<span class="ver_10_red"><%=ee.getMessage()%></span>
<%				
			}
			info = new LogInfo(uid, "", "List of Users");
			Vector v = gs.getRolelist(uid, info);
			if (v != null) {
				for (int i = 0; i < v.size(); i++) {
					SimpleRoleBean bean = (SimpleRoleBean) v.get(i);
		%>	  
	  <tr bgcolor="#FFFFFF">
		<td class="ver_10_black"><%=bean.roleid%></td>
		<td class="ver_10_black"><%=bean.rolename%></td>
		<td class="ver_10_black"><%=bean.level%></td>
	  </tr>
<%			}
			} %>
     </table>			
    </td>
 </tr>     
<%     
		}%>
 <tr>
   <td>&nbsp;</td>
   <td align="left">		
    <!-- class="ver_12_black_b-->
	<form name="form2" action="forbidrole.jsp" method="post">
	<table align="left" border="0" cellpadding="2" cellspacing="1">
	<tr>
		<td align="left" class="ver_10_black">Forbidden Role ID:</td>
		<td><input type="text" name="roleid" value="<%=roleid%>" size="20" maxlength="20" class="text_field"></td>
	</tr>
	<tr>
		<td align="left" class="ver_10_black">Forbidden Type:</td>
		<td>
			<select name="fbdtype">
			   <option value="100">Forbid Sign In</option>
				<option value="101">Forbid Talking</option>
				<option value="102">Forbid Trade Among Players</option>
				<option value="103">Forbid Selling</option>
			</select>
		</td>
	</tr>
	<tr>
		<td align="left" class="ver_10_black">Forbid Time(in mins):</td>
		<td class="ver_10_black">
			<input type="text" name="forbidtime" value="<%=forbidtime%>" size="16" maxlength="10" class="text_field"/>
		</td>
	</tr>
	<tr>
		<td class="ver_10_black">Reason:</td>
		<td>
			<input type="text" name="reason" value="<%=reason%>" size="20" maxlength="20" class="text_field"/>
			&nbsp;&nbsp;
			<input type="submit" value="Submit" class="button">
			<input type="button" value="Back to Role Management" class="button" onclick="location.href('manage.jsp');">
		</td>
	</tr>
	</table>
	</form>
    </td>
 </tr>     
 <tr>
   <td>&nbsp;</td>
   <td align="left">	
<%
		/*
		 * @param fbd_type : 封禁类型. 100:禁止登陆; 101:禁言; 102:禁止玩家交易; 103:禁卖
		 * @param gmroleid : GM角色ID
		 * @param localsid : session ID,可以忽略
		 * @param dstroleid : 被封禁角色ID
		 * @param forbid_time : 封禁时间,单位:秒
		 * @param reason : 封禁原因
		 * @param loginfo : 调用者信息
		 */

		int gmroleid = -1;
		int localsid = -1;
		int forbid_time = -1;
		byte fbd_type = -1;

		if (roleid != null && roleid.trim().length() > 0) { %>
		<br>
<%		
			try {
				rid = Integer.parseInt(roleid);
			} catch (Exception e) {%>
				<span class="ver_10_black">Please input a number for Role ID.</span>&nbsp;<span class="ver_10_red"><%=e.getMessage()%></span>			   
<%				
			}
			try {
				fbd_type = Byte.parseByte(fbdtype);
			} catch (Exception ex) { %>
				<span class="ver_10_black">Please input numbers.</span>&nbsp;<span class="ver_10_red"><%=ex.getMessage()%></span>			   			
<%				
			}
			try {
				forbid_time = Integer.parseInt(forbidtime);
				forbid_time = forbid_time * 60;
			} catch (Exception exp) { %>
				<span class="ver_10_black">Please input a number for Block Type.</span>&nbsp;<span class="ver_10_red"><%=exp.getMessage()%></span>
<%				
			}
			info = new LogInfo(rid, "", "Forbid Role");

			int flag = gs.forbidRole(fbd_type, gmroleid, localsid, rid,forbid_time, reason, info);
			
			String result = null;
			switch (flag) {
				case -1:
					result = "Failed";
					break;
				default:
					result = flag + "";
			}
			
			String fbdType = "";
			switch (fbd_type) {
				case 100:
					fbdType = "Forbid Sign in";
					break;
				case 101:
					fbdType = "Forbid Talking";
					break;
				case 102:
					fbdType = "Forbid Trade Among Players";
					break;
				case 103:
					fbdType = "Forbid Selling";
			}
				%>	
	<br><br>
	<table width="90%" align="left" border="0" cellpadding="2" cellspacing="1" bgcolor="#000000">
      <tr>
		<td class="ver_10_white">Forbidden Role ID</td>
		<td class="ver_10_white">GM Role ID</td>
		<td class="ver_10_white">Session ID</td>
		<td class="ver_10_white">Forbid Type</td>
		<td class="ver_10_white">Forbid Sign</td>
		<td class="ver_10_white">Forbid Time</td>
		<td class="ver_10_white">Reason</td>
	  </tr>				
	  <tr bgcolor="#FFFFFF">
		<td class="ver_10_black"><%=rid%></td>
		<td class="ver_10_black"><%=gmroleid%></td>
		<td class="ver_10_black"><%=localsid%></td>
		<td class="ver_10_black"><%=fbdType%></td>
		<td class="ver_10_black"><%=result%></td>
		<td class="ver_10_black"><%=forbid_time%> secs</td>
		<td class="ver_10_black"><%=reason%></td>
	  </tr>
	 </table>   	  
<%}%>	  
<!-- code: end -->   
    </td>
   </tr>
<%	} else { %>
 <tr><td colspan="2" align="center" class="ver_10_red">You are not allowed to access this page.</td></tr> 
 <%	} %>   
 <tr><td colspan="2">&nbsp;</td></tr>
<%@include file="../include/footer.jsp"%>    
  </table>
  </td>
 </tr>
 </table>
<script language="javascript">
<!--
	function show(t){
    	if(t==1)
        	document.getElementById("uid").style.display="";
      	else
        	document.getElementById("uid").style.display="none";
      	if(t==2)  
        	document.getElementById("rid2").style.display="";
      	else
        	document.getElementById("rid2").style.display="none";  
      	if(t==3)
        	document.getElementById("rname").style.display="";
      	else 
        	document.getElementById("rname").style.display="none";           
    }
//-->
</script>
</body>
</html>