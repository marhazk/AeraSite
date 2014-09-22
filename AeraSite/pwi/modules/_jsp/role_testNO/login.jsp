<%@page contentType="text/html; charset=GBK"%>
<%
	String strErr = "";
	if(request.getParameter("err")!=null && request.getParameter("err").equals("1")){
		strErr = "Invalid access details.";
	}
%>
<html>
<head>
<link href="../css/styles_ph.css" rel="stylesheet" type="text/css">
<title>Role Management</title>
</head>


<body bgcolor="white">
<table width="800" border="0" cellspacing="0">
<%@include file="../include/topheader.jsp"%>  
 <tr><td colspan="2" class="ver_12_black_b">&nbsp;&nbsp;Role Management</td></tr> 
 <tr><td colspan="2">&nbsp;</td></tr>   
 <tr>
   <td width="5%">&nbsp;</td>
   <td>
    <form name="login" action="checklogin.jsp">
     <table width="100%" cellspacing="0" cellpadding="2">
<%	if(!strErr.equals("")){ %>
	 <tr bgcolor="#FFFFFF">
	  <td colspan="2" class="ver_10_red"><%=strErr%></td>
	 </tr>
<%	} %>     
      <tr>
        <td width="10%" class="ver_10_black">Username:</td>
        <td width="90%"><input type="text" name="username" value=""></td>
      </tr>
      <tr>
        <td class="ver_10_black">Password:</td>
        <td><input type="password" name="password" value=""></td>
      </tr>
      <tr>
        <td></td>
        <td>
          <input type="submit" value="Submit" class="button">
          <input type="reset" value="Cancel" class="button">
        </td>
      </tr>
     </table>
     </form>
   </td>
 </tr>   
 <tr><td colspan="2">&nbsp;</td></tr>   
 <tr><td colspan="2">&nbsp;</td></tr> 
<%@include file="../include/footer.jsp"%>   
</table>
</body>
</html>
