<%@page contentType="text/html; charset=GBK"%>
<%@page import="java.util.*"%>
<html>
<head>
<link href="../include/style.css" rel="stylesheet" type="text/css">
<title>��ɫ��Ϣ����</title>
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
    <td>��ѯ�޸����ݿ��ɫȱʡ��Ϣ��</td>
  </tr>
  <tr>
    <td><a href="modrole.jsp?roleid=16">����-��</a></td>
  </tr>
  <tr>
    <td><a href="modrole.jsp?roleid=19">��ʦ-Ů</a></td>
  </tr>
  <tr>
    <td><a href="modrole.jsp?roleid=20">ɮ��-��</a></td>
  </tr>
  <tr>
    <td><a href="modrole.jsp?roleid=23">����-Ů</a></td>
  </tr>
  <tr>
    <td><a href="modrole.jsp?roleid=24">����-��</a></td>
  </tr>
  <tr>
    <td><a href="modrole.jsp?roleid=27">����-Ů</a></td>
  </tr>
  <tr>
    <td><a href="modrole.jsp?roleid=28">��â-��</a></td>
  </tr>
  <tr>
    <td><a href="modrole.jsp?roleid=31">����-Ů</a></td>
  </tr>
  <tr>
    <td>
&nbsp;<br>
��ѯ�����ɫ��Ϣ��
<form action="modrole.jsp" name="myquery" method="post">
�����ɫID��&nbsp;&nbsp;<input type="text" name="roleid" value="" size="16" maxlength="10"><br>
�����ɫ���ƣ�<input type="text" name="name" value="" size="20" maxlength="64">
<input type="submit" value="��ɫ������Ϣ">
&nbsp;&nbsp;<a href="javascript:onqueryrolexml();">��ɫXML</a>
</form>
    </td>
  </tr>
</table>

</td></tr></table>
<%@include file="../include/foot.jsp"%>
</body>
</html>

