<%@ page contentType="text/html; charset=UTF-8" %>
<%@page import="java.util.*"%>
<%@page import="com.goldhuman.util.LocaleUtil2"%>
<html>
<head>
<link href="../include/style.css" rel="stylesheet" type="text/css">
<title>newrole</title>
<script language=javascript>
</script>
</head>
<body>
<%@include file="../include/header.jsp"%>
<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF"><tr><td>
<table border=1 cellpadding=2 align=center width=900>
<tr><td align=center><a href=GMService_SysRecoveredObjMail_request.jsp><%=LocaleUtil2.getMessage(request,"GMService_SysRecoveredObjMail_title")%></a></td><td aligen=center><%=LocaleUtil2.getMessage(request,"GMService_SysRecoveredObjMail_comment")%></td></tr>
<tr><td colspan=2 align=center><a href="javascript:window.history.back(-1);">Return</a></td></tr>
</table>
</td></tr></table>
<%@include file="../include/foot.jsp"%>
</body>
</html>
