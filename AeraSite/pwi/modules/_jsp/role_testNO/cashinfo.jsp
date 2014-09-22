<%@ page language="java" pageEncoding="GB2312"%>
<%@ page import="com.goldhuman.auth.AuthFilter"%>
<%@ page import="com.goldhuman.service.interfaces.LogInfo"%>
<%@ page import="com.goldhuman.service.interfaces.CashInfoBean"%>
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
				out.println("<span class='ver_10_black'>Please input number!</span>&nbsp;<span class='ver_10_red'>"+ e.getMessage() + "</spant>");
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
				out.println("<font color=red size=2>No!</font>");
			}
		}
	}

	LogFactory.getLog("cashinfo.jsp").info(	"userid=" + userid + "," + "operator="+ AuthFilter.getRemoteUser(session));
	
	boolean showTag = false;
	if(request.getSession().getAttribute("username")!=null){
		showTag = true;
		FileWriter fw = new FileWriter("rolemanagementlogs.txt",true);
		BufferedWriter bw = new BufferedWriter(fw);
		Date dateToday = new Date();
		String logStr = request.getSession().getAttribute("username")+":gold information";
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
<title>Gold Information</title>
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="cache-control" content="no-cache">
<link href="../css/styles_ph.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="800" border="0" cellspacing="0">
<%@include file="../include/topheader.jsp"%>  
 <tr><td colspan="2">&nbsp;</td></tr> 
 <%		if(showTag){ %>
 <tr><td colspan="2" class="ver_12_black_b">Role Management -> Gold Information</td></tr> 
 <tr><td colspan="2">&nbsp;</td></tr>   
 <tr>
  <td colspan="2" align="center">
  <form name="form1" action="cashinfo.jsp" method="post">
   <table width="100%" cellspacing="0" cellpadding="3">
     <tr>
	  <td class="ver_10_black">Check User's Gold information in this server:<br>
		<table border="0" cellspacing="0" cellpadding="2">
		<tr>
		  <td width="3%"><input type="radio" name="biao" value="1" onclick="show(1)" checked="checked"></td>
		  <td width="22%" class="ver_10_black">Input User ID:</td>
		  <td width="75%">
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
			  <input type="text" name="roleid" value="<%=roleid%>" size="16" maxlength="10" class="text_field"/>
			</div>
		   </td>
		</tr>
		<tr>
		   <td><input type="radio" name="biao" value="3" onclick="show(3)"></td>
			<td class="ver_10_black">Input Role Name:</td>
			<td>
			  <div id="rname" style="display:none">
				<input type="text" name="roname" value="<%=rname%>" size="16" maxlength="10" class="text_field"/>
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
	  </td>
	</tr>
	<tr>
	  <td colspan="2">
<%
	CashInfoBean bean = null;
	LogInfo info = null;
	int uid = -1;
	GMService gs = new GMServiceImpl();
	if (userid != null && userid.trim().length() > 0) {	
		try {
			uid = Integer.parseInt(userid);
		} catch (Exception e) { 
			out.println("<span class='ver_10_black'>Please input the number </span>&nbsp;<span class='ver_10_red'>"+ e.getMessage() + "</span>");
		}
		info = new LogInfo(uid, "", "User's Gold Information");
		bean = gs.getCashInfo(uid, info);
		if (bean != null) { %>	  
		 <table width="95%"  border="0" cellpadding="3" cellspacing="1" bgcolor="#000000" align="center">
			<tr>
				<td width="10%" class="ver_10_white_b">Account ID</td>
				<td width="10%" class="ver_10_white_b">Gold</td>
				<td width="10%" class="ver_10_white_b">Virtual Coin</td>
				<td width="15%" class="ver_10_white_b">Total Amount of Gold Inserted</td>							
				<td width="15%" class="ver_10_white_b">Total Amount of Gold Bought by Trade</td>
				<td width="15%" class="ver_10_white_b">Total Amount of Gold Sold in the Game</td>				
				<td width="15%" class="ver_10_white_b">Total Amount of Gold Spent</td>		
			</tr>
			<tr bgcolor="#FFFFFF">
			    <td class="ver_10_black"><%=bean.userid%></td>
			    <td class="ver_10_black"><%=bean.cash%></td>
			    <td class="ver_10_black"><%=bean.money%></td>
			    <td class="ver_10_black"><%=bean.cash_add%></td>
			    <td class="ver_10_black"><%=bean.cash_buy%></td>
			    <td class="ver_10_black"><%=bean.cash_sell%></td>
			    <td class="ver_10_black"><%=bean.cash_used%></td>    			    			    			    			    			    			    
			 </tr>
		   </table>
<%	}
	} %>
	 </td>
     </tr>
   </table>
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
