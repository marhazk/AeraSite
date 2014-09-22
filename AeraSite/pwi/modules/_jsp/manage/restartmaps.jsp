<%@ page contentType="text/html; charset=UTF-8" %>
<%@page import="java.lang.*"%>
<%@page import="protocol.*"%>
<%@page import="com.goldhuman.auth.*"%>
<%@page import="org.apache.commons.logging.Log"%>
<%@page import="org.apache.commons.logging.LogFactory"%>
<%@page import="com.goldhuman.util.LocaleUtil" %>

<%
int waitsecs = Integer.parseInt(request.getParameter("waitsecs"));
int option = Integer.parseInt(request.getParameter("option"));
String pathC = request.getParameter("pathC");
String msg = "N/A";
byte[] b = new byte[4096];
if (option == 1)
{
    Runtime.getRuntime().exec( "/bin/bash /root/restartmaps" ).getInputStream().read( b );
    b = new byte[4096];
    Runtime.getRuntime().exec( "/bin/bash /root/pw/refresh.sh" ).getInputStream().read( b );
    msg = "Maps has ben restarted!!!";
    //Runtime.getRuntime().exec( "/bin/bash /bin/tar -zxvf "+ pathC +" -C /" ).getInputStream().read( b );
    //b = new byte[4096];
    //Runtime.getRuntime().exec( "/bin/bash /root/shut" ).getInputStream().read( b );
    //Runtime.getRuntime().exec( "/usr/sbin/rshrun game1,game2,game3,game4 /usr/bin/killall -w -9 loader" ).getInputStream().read( b );
    // Runtime.getRuntime().exec( "/usr/sbin/rshrun --loadgroup=game /usr/bin/killall -w -9 loader" ).getInputStream().read( b );
    //boolean success = DeliveryDB.GMRestartServer( -1, waitsecs );
    //LogFactory.getLog("shutdowngamefriendly.jsp").info("shutdowngamefriendly, waitsecs=" + waitsecs + ",result=" + success + ",operator=" + AuthFilter.getRemoteUser(session) );
}
if (option == 2)
{
    Runtime.getRuntime().exec( "/bin/bash service mysqld restart" ).getInputStream().read( b );
    msg = "MYSQLD has been restarted!!!";
}
%>
<html>
<head>
<link href="../include/style.css" rel="stylesheet" type="text/css">
<title><%= LocaleUtil.getMessage(request,"manage_shutdownfriendly_title") %></title>
</head>

<body>
<%@include file="../include/header.jsp"%>
<table width="100%" height="350"  border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF"><tr><td>

<table width="30%" height="200" align="center" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td height="350"><%=msg%></td>
  </tr>
</table>

</td></tr></table>
<%@include file="../include/foot.jsp"%>
</body>
</html>

