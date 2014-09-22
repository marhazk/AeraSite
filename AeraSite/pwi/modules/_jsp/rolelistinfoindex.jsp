<%@ page contentType="text/html; charset=utf-8" pageEncoding="GBK" %>
<%@ taglib uri="/WEB-INF/struts-bean.tld" prefix="bean" %>
<%@ page import="com.world2.game.service.Source"%>
<%@ page import="com.world2.util.*" %>
<%@page import="java.util.*"%>

<html>
<head>
<%
	com.world2.csm.module.User ub=(com.world2.csm.module.User)session.getAttribute(com.world2.common.IConst.SESSION.CSM_USER_KEY);
	if (ub == null){
		String msgerror = LocaleUitl.getMessage("exp_timeout"); out.println("<div align='center'><font color='red'>"+msgerror+"</font></div>");
		return;
	}
	String zoneid=request.getParameter("zoneid");
	//common.ZoneBean zb =(common.ZoneBean)com.world2.game.service.Source.getZonemapById(new common.LogInfo(ub.getUserId(),ub.getUserName(),"获得地区Map")).get(new Integer(zoneid));
%>
<link href="<%=request.getContextPath()%>/css/style.css" rel="stylesheet" type="text/css">
<title><bean:message key='rolelist_title'/></title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<script src="<%=request.getContextPath()%>/js/checkForm.js"></script>
<script language="javascript">
<!--
	function checkForm(FStr){
       if(isNull(FStr.username,"<bean:message key='input_account_name'/>")) return false;
       return true;
	}
	
	function goback(){
  		window.location.href="<%=request.getContextPath()%>/welcome.jsp";
	}
//-->	
</script>
</head>

<body>
<form action="<%=request.getContextPath()%>/accountinfo/roleListInfoAction.do" method="post" onsubmit="return checkForm(this);">
<table width="100%"  border="0" cellpadding="5" cellspacing="0" bgcolor="#FFFFFF">
<tr><td class="title"><bean:message key='rolelist_title'/></td></tr>
<tr>
  <td>
	<table width="100%"  align="center" border="0" cellpadding="3" cellspacing="0" bgcolor="#FFFFFF">
	 <tr>
	  <td width="20%"><bean:message key='rolelist_server'/></td>
	  <td width="80%">
		<%--<input type="hidden"  name="zoneid" value="<%=zoneid%>"/>--%>
   			<select name="zoneid" id="zoneid">
				<%=Source.getSelectServers()%>
      		</select>
       </td>
      </tr>
      <tr>
       <td><bean:message key='rolelist_inputaccount'/></td>
       <td>
			<input type="text" name="username"  size="15" maxlength="20">
		</td>
	  </tr>
	</table>
   </td>
 </tr>
 <tr>
  <td>
	<input type="submit" value="<bean:message key='submit_ok'/>" class="button">&nbsp;
	<input type="button" value="<bean:message key='submit_back'/>" onclick="goback()" class="button">
  </td>
 </tr>
 </table>
</form>
</body>
</table>
