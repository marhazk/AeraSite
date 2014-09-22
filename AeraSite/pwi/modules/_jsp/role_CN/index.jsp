<%@page contentType="text/html; charset=GBK"%>
<%@page import="java.util.*"%>
<html>
<head>
<link href="../include/style.css" rel="stylesheet" type="text/css">
<title>角色信息管理</title>
<script language=javascript>
function onqueryrolexml()
{
	document.myquery.action = "modrolexml.jsp";
	document.myquery.submit()
	return true;
}
</script>
</head>
<body>
<%@include file="../include/header.jsp"%>
<table width="100%" height="350"  border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF"><tr><td>

<table width="450" height="200" align="center" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td>查询修改数据库角色缺省信息：</td>
  </tr>
  <tr>
    <td><a href="modrole.jsp?roleid=16">武侠-男</a></td>
  </tr>
  <tr>
    <td><a href="modrole.jsp?roleid=19">法师-女</a></td>
  </tr>
  <tr>
    <td><a href="modrole.jsp?roleid=20">僧侣-男</a></td>
  </tr>
  <tr>
    <td><a href="modrole.jsp?roleid=23">妖精-女</a></td>
  </tr>
  <tr>
    <td><a href="modrole.jsp?roleid=24">妖兽-男</a></td>
  </tr>
  <tr>
    <td><a href="modrole.jsp?roleid=27">魅灵-女</a></td>
  </tr>
  <tr>
    <td><a href="modrole.jsp?roleid=28">羽芒-男</a></td>
  </tr>
  <tr>
    <td><a href="modrole.jsp?roleid=31">羽灵-女</a></td>
  </tr>
  <tr>
    <td>
&nbsp;<br>
查询任意角色信息：
<form action="modrole.jsp" name="myquery" method="post">
输入角色ID：&nbsp;&nbsp;<input type="text" name="roleid" value="" size="16" maxlength="10"><br>
输入角色名称：<input type="text" name="name" value="" size="20" maxlength="64">
<input type="submit" value="角色基本信息">
&nbsp;&nbsp;<a href="javascript:onqueryrolexml();">角色XML</a>
</form>
    </td>
  </tr>
</table>

</td></tr></table>
<%@include file="../include/foot.jsp"%>
</body>
</html>

