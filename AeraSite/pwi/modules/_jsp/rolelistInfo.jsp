<%@ page contentType="text/html; charset=utf-8" pageEncoding="GBK" %>
<%@ page import="com.world2.util.*" %>
<html>
<head>
<title>
<bean:message key="rolelist_title"/>
</title>
<link href="<%=request.getContextPath()%>/css/style.css" rel="stylesheet" type="text/css">
<%
	com.world2.csm.module.User userb=( com.world2.csm.module.User ) session.getAttribute(com.world2.common.IConst.SESSION.CSM_USER_KEY);
	Integer serverid = (Integer)request.getAttribute("zoneid");
	if (userb == null){
		out.println("<div align='center'><font color='red'><bean:message key='exp_timeout'/></font></div>");
		return;
	}

	java.util.Vector rolelistVector=(java.util.Vector)request.getAttribute("rolelistVector");
	if(rolelistVector==null){
    	out.println("<div align='center'><font color='red'><bean:message key='rolelist_cantfindrolelist'/></font></div>");
		return;
  	}
%>
</head>
<body bgcolor="#ffffff">
<form action="<%=request.getContextPath()%>/accountinfo/baseInfoUpdateAction.do" name="form1" onSubmit="return checkForm(form1);" method="POST">
<table width="100%" cellspacing="0" cellpadding="5">
<tr>
  <td class="title"><bean:message key="rolelist_title"/> for <font color="red"><%=(String)request.getAttribute("username")%></font></td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
  <td>
	<table width="600"  border="0" cellspacing="1" cellpadding="5" align="left" bgcolor="#000000">
  	 <tr bgcolor="#CCCCCC">
    	<td width="15%"><bean:message key="rolelist_roleid"/></td>
     	<td width="25%"><bean:message key="rolelist_rolename"/>&nbsp;</td>
   		<td width="25%"><bean:message key="rolelist_level"/>&nbsp;</td>
  	</tr>
 <%
 		for(int i=0;i<rolelistVector.size();i++){
 			com.goldhuman.service.interfaces.SimpleRoleBean srb=(com.goldhuman.service.interfaces.SimpleRoleBean)rolelistVector.get(i);
 %>
    <tr bgcolor="#FFFFFF">
      <td><a href="<%=request.getContextPath()%>/role/roleInfoAction.do?zoneid=<%=serverid%>&selecttype=1&roleid=<%=srb.roleid%>"><%=srb.roleid%></a></td>
      <td><%=srb.rolename%>&nbsp;</td>
      <td><%=srb.level%>&nbsp;</td>
    </tr>
<%
		}%>
      </table>
     </td>
    </tr>
   <tr align="left">
  	  <td align="left" colspan="3"><input type="button" value="<bean:message key="submit_back"/>" onclick="javascript:history.back()" / class="button"></td>
   </tr>
 </table>
</form>
</body>
</html>