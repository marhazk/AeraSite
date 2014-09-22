<%@ page language="java" pageEncoding="GB2312"%>
<%@ page import="java.util.*"%>
<%@ page import="com.goldhuman.auth.AuthFilter"%>
<%@ page import="com.goldhuman.service.interfaces.LogInfo"%>
<%@ page import="com.goldhuman.service.interfaces.SimpleRoleBean"%>
<%@ page import="com.goldhuman.service.interfaces.GMService"%>
<%@ page import="com.goldhuman.service.GMServiceImpl"%>
<%@page import="org.apache.commons.logging.LogFactory"%>
<%@page import="java.io.*"%>
<%@page import="java.util.*"%>
<%

	request.setCharacterEncoding("GB2312");

	String userid = "";
	String roleid = "";
	String rname = "";
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
				out.println("Please input numbers!&nbsp;<span class='ver_10_red'>"+ e.getMessage() + "</span>");

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
				out.println("<span class='ver_10_red'>No!</font>");
			}
		}
	}
	LogFactory.getLog("rolelist.jsp").info("userid=" + userid + "," + "operator="+ AuthFilter.getRemoteUser(session));
	
	boolean showTag = false;
	if(request.getSession().getAttribute("username")!=null){
		showTag = true;
		FileWriter fw = new FileWriter("rolemanagementlogs.txt",true);
		BufferedWriter bw = new BufferedWriter(fw);
		Date dateToday = new Date();
		String logStr = request.getSession().getAttribute("username")+":view role list";
		if(biao!=null){
			if(biao.equals("1")){
				logStr = logStr + "-userid="+userid;
			} else if(biao.equals("2")){
				logStr = logStr + "-roleid="+roleid;
			} else if(biao.equals("3")){
				logStr = logStr + "-rolename="+rname;
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
<title>Role List</title>
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="cache-control" content="no-cache">
<link href="../css/styles_ph.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="800" border="0" cellspacing="0">
<%@include file="../include/topheader.jsp"%>  
 <tr><td colspan="2">&nbsp;</td></tr> 
 <%		if(showTag){ %>
 <tr><td colspan="2" class="ver_12_black_b">Role Management -> Role List</td></tr> 
<tr><td colspan="2">&nbsp;</td></tr>
<tr><td colspan="2">&nbsp;</td></tr>
<tr>
   <td width="5%">&nbsp;</td>
   <td width="95%"" align="center">
	   <form name="form1" action="rolelist.jsp" method="post">
   		<table width="100%" cellspacing="0" cellpadding="3">
        <tr><td colspan="3" class="ver_10_black">Check user's role list in this server:</td></tr>
        <tr><td colspan="3">&nbsp;</td></tr>
        <tr>
          <td width="3%"><input type="radio" name="biao" value="1" onclick="show(1)" checked="checked"></td>
          <td width="15%" class="ver_10_black">Enter User ID:</td>
          <td width="82%">
          	<div id="uid" style="display:">
				<input type="text" name="userid" value="<%=userid%>" size="16" maxlength="10" class="text_field"/>
			</div>
          </td>
        </tr>
         <tr>
          <td><input type="radio" name="biao" value="2" onclick="show(2)"></td>
          <td class="ver_10_black">Enter Role ID:</td>
          <td>
			<div id="rid" style="display:none">
				<input type="text" name="roleid" value="<%=roleid%>" size="16" maxlength="10" class="text_field" />
			</div>          
          </td>
        </tr>
        <tr>
          <td><input type="radio" name="biao" value="3" onclick="show(3)"></td>
          <td class="ver_10_black">Enter Role Name:</td>
          <td>
			<div id="rname" style="display:none">
				<input type="text" name="roname" value="<%=rname%>" size="16" maxlength="10" class="text_field" />
			</div>          
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="2">
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
			} catch (Exception e) {
				out.println("<span class='ver_10_black'>Please input the number!</span>&nbsp;<span class='ver_10_red'>"+ e.getMessage() + "</span>");
			}
			info = new LogInfo(uid, "", "Role List");
			Vector v = gs.getRolelist(uid, info);
			if (v != null) {%>  
       <br><br>
       <table width="85%" cellspacing="1" cellpadding="3" bgcolor="#000000">
       <tr>
          <td width="20%" class="ver_10_white_b">Roler ID</td>
          <td width="40%" class="ver_10_white_b">Role Name</td>
          <td width="40%" class="ver_10_white_b">Role Level</td>
        </tr>
<%
				for (int i = 0; i < v.size(); i++) {
					SimpleRoleBean bean = (SimpleRoleBean) v.get(i);
%>        
        <tr bgcolor="#FFFFFF">
          <td class="ver_10_black"><%=bean.roleid%></td>
          <td class="ver_10_black"><%=bean.rolename%></td>
           <td class="ver_10_black"><%=bean.level%></td>
        </tr>
<%			}  %>        
     </table>
<%		} 
		}%>     
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
      if(t==3)
        document.getElementById("rname").style.display="";
      else 
        document.getElementById("rname").style.display="none";          
    
    }

//-->
</script>
</body>
</html>