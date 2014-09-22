<%@page contentType="text/html; charset=GBK"%>
<%@page import="java.io.*"%>
<%@page import="java.util.*"%>
<%
	boolean showTag = false;
	if(request.getSession().getAttribute("username")!=null){
		showTag = true;
		//out.println("username:"+request.getSession().getAttribute("username").toString());
	}
	if(request.getParameter("action")!=null && request.getParameter("action").equals("logout")){
		FileWriter fw = new FileWriter("rolemanagementlogs.txt",true);
		BufferedWriter bw = new BufferedWriter(fw);
		Date dateToday = new Date();
		String logStr = request.getSession().getAttribute("username")+":logout:"+dateToday;
		bw.write(logStr);
		bw.newLine();
		bw.close();
		bw = null;
		fw = null;
		request.getSession().setAttribute("username",null);
		response.sendRedirect("login.jsp");
	}
%>
<html>
<head>
<link href="../css/styles_ph.css" rel="stylesheet" type="text/css">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="cache-control" content="no-cache">
<title>Role Management</title>
</head>


<body bgcolor="white">
<table width="800" border="0" cellspacing="0">
<%@include file="../include/topheader.jsp"%>  
 <tr><td colspan="2">&nbsp;</td></tr> 
 <%		if(showTag){ %>
 <tr><td colspan="2" class="ver_12_black_b">Role Management</td></tr> 
 <tr><td colspan="2">&nbsp;</td></tr>   
 <tr>
  <td colspan="2" align="center">
	<table width="80%" border="0" cellpadding="3" cellspacing="1" bgcolor="#000000">
	 <tr>
	  <td width="30%" class="ver_12_white_b">Application</td>
	  <td width="70%" class="ver_12_white_b">Description</td>
	 </tr>
	 <tr bgcolor="#FFFFFF">
 	  <td class="ver_10_black"><a href="rolenameexists.jsp">Check Role Name</a></td>
	  <td class="ver_10_black">Check whether the Role Name is existing through the Uniquename Server</td>
 	 </tr>
	 <tr bgcolor="#FFFFFF">
	  <td class="ver_10_black"><a href="userrolecount.jsp">Number of Roles</a></td>
	  <td class="ver_10_black">Obtain user's number of roles in this Unique Server Area</td>
	 </tr>
	 <tr bgcolor="#FFFFFF">
	  <td class="ver_10_black"><a href="rolelist.jsp">Role List</a></td>
	  <td class="ver_10_black">List of User's Role in this Server</td>
	 </tr>
     <tr bgcolor="#FFFFFF">
	  <td class="ver_10_black"><a href="cashinfo.jsp">Gold Information</a></td>
	  <td class="ver_10_black">Gold Information of User</td>
	 </tr>
	 <tr bgcolor="#FFFFFF">
	  <td class="ver_10_black"><a href="canchangerolename.jsp">Check change of Role Name</a></td>
	  <td class="ver_10_black">Check whether the Role Name can be changed</td>
	 </tr>
	 <tr bgcolor="#FFFFFF">
	  <td class="ver_10_black"><a href="renamerole.jsp">Change Role Name</a></td>
	  <td class="ver_10_black">Change Role Name</td>
	 </tr>
	 <tr bgcolor="#FFFFFF">
	  <td class="ver_10_black"><a href="deleterole.jsp">Delete Role</a></td>
	  <td class="ver_10_black">Delete Role</td>
	 </tr>
	 <tr bgcolor="#FFFFFF">
	  <td class="ver_10_black"><a href="forbidrole.jsp">Forbid Role</a></td>
	  <td class="ver_10_black">Forbid Role</td>
	 </tr>
	 <tr bgcolor="#FFFFFF">
	  <td class="ver_10_black"><a href="rolelogstatus.jsp">Role Status</a></td>
	  <td class="ver_10_black">Obtain Role Status</td>
	 </tr>
	 <tr bgcolor="#FFFFFF">
	  <td class="ver_10_black"><a href="manage.jsp?action=logout">Log Out</a></td>
	  <td class="ver_10_black">Log Out of the Role Management Module</td>
	 </tr>	 
	 <!--<tr bgcolor="#FFFFFF">
	  <td class="ver_10_black"><a href="fetchcomplains.jsp">Latest Complaint Information</a></td>
	  <td class="ver_10_black">Obtain latest complaint information of server</td>
	 </tr>-->
   </table>  
  </td>
 </tr>
 <%		} else { %>
 <tr>
  <td colspan="2" align="center" class="ver_10_red">You are not allowed to access this page.</td>
 </tr> 
 <%		} %>
 <tr><td colspan="2">&nbsp;</td></tr> 
<%@include file="../include/footer.jsp"%>   
</table>
</body>
</html>
