<%@page contentType="text/html; charset=UTF-8"%>
<%@page import="java.lang.*"%>
<%@page import="protocol.*"%>
<%@page import="com.goldhuman.auth.*"%>
<%@page import="org.apache.commons.logging.Log"%>
<%@page import="org.apache.commons.logging.LogFactory"%>
<%@page import="java.util.*"%>
<%@page import="java.io.*"%>
<%
request.setCharacterEncoding("UTF-8");
boolean showTag = false;
if(request.getSession().getAttribute("username")!=null) showTag = true;
%>
<html>
<title>Enviar uma mensagem</title>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="../include/style.css" rel="stylesheet" type="text/css">
<link rel="shortcut icon" type="image/ico" href="images/favicon.ico" />
</head>
<body>
<%if(showTag)
{
	String msg = request.getParameter("msg");
	boolean success = DeliveryDB.broadcast((byte)9,-1,msg);
%>
<%@include file="/include/header.jsp"%>  
<table width="800" border="0" cellspacing="0">
	<tr><td colspan="2">&nbsp;</td></tr> 
	<tr>
	</tr> 
	<tr><td colspan="2">&nbsp;</td></tr> 
	<tr>
		<td colspan="2" align="center"><%
			if( success )
			{%>
				<span class="ver_10_black">Mensagem enviada para o mundo!</span>
				<%	  
			} else 
			{%>
				<span class="ver_10_red">Falha ao enviar a mensagem, talvez o mundo não está funcionando!</span>
				<%
			}%>    
		</td>
	</tr> 
	<noscript>Luxaras Iweb</noscript>
	<tr><td colspan="2">&nbsp;</td></tr>
</table><%
} else 
{%>
<%@include file="/include/nologin.jsp"%><%
}%>
<%@include file="/include/foot.jsp"%>  
</body>
</html> 
