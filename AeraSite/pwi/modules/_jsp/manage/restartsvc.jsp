<%@ page contentType="text/html; charset=UTF-8" %>
<%@page import="java.lang.*"%>
<%@page import="protocol.*"%>
<%@page import="com.goldhuman.auth.*"%>
<%@page import="org.apache.commons.logging.Log"%>
<%@page import="org.apache.commons.logging.LogFactory"%>
<%@page import="com.goldhuman.util.LocaleUtil" %>

<%
int waitsecs = Integer.parseInt(request.getParameter("waitsecs"));
int inpwd = Integer.parseInt(request.getParameter("pwd"));
int paswd = 123;

int option = Integer.parseInt(request.getParameter("option"));
String pathC = request.getParameter("pathC");
String filedb = request.getParameter("filedb");
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
else if (option == 2)
{
    Runtime.getRuntime().exec( "/bin/bash service mysqld restart" ).getInputStream().read( b );
    msg = "MYSQLD has been restarted!!!";
}
else if ((option == 3) && (inpwd == paswd))
{
    Runtime.getRuntime().exec( "/bin/bash /root/restoredb" ).getInputStream().read( b );
    b = new byte[4096];
    Runtime.getRuntime().exec( "/bin/bash /root/startdb" ).getInputStream().read( b );
    boolean success = DeliveryDB.GMRestartServer( -1, waitsecs );
    LogFactory.getLog("shutdowngamefriendly.jsp").info("shutdowngamefriendly, waitsecs=" + waitsecs + ",result=" + success + ",operator=" + AuthFilter.getRemoteUser(session) );
    msg = "DB and SERVER has been restored and restarted!!!";
}
else if ((option == 4) && (inpwd == paswd))
{
    Runtime.getRuntime().exec( "/bin/bash /root/restoredb" ).getInputStream().read( b );
    b = new byte[4096];
    Runtime.getRuntime().exec( "/bin/bash /root/shut" ).getInputStream().read( b );
    boolean success = DeliveryDB.GMRestartServer( -1, waitsecs );
    LogFactory.getLog("shutdowngamefriendly.jsp").info("shutdowngamefriendly, waitsecs=" + waitsecs + ",result=" + success + ",operator=" + AuthFilter.getRemoteUser(session) );
    msg = "DB and OS-SERVER has been restored and restarted!!!";
}
else if (option == 5)
{
    Runtime.getRuntime().exec( "/bin/bash /root/shut" ).getInputStream().read( b );
    //Runtime.getRuntime().exec( "/usr/sbin/rshrun game1,game2,game3,game4 /usr/bin/killall -w -9 loader" ).getInputStream().read( b );
    // Runtime.getRuntime().exec( "/usr/sbin/rshrun --loadgroup=game /usr/bin/killall -w -9 loader" ).getInputStream().read( b );
    boolean success = DeliveryDB.GMRestartServer( -1, waitsecs );
    LogFactory.getLog("shutdowngamefriendly.jsp").info("shutdowngamefriendly, waitsecs=" + waitsecs + ",result=" + success + ",operator=" + AuthFilter.getRemoteUser(session) );
    msg = "OS-SERVER has been restarted!!!";
}
else if ((option == 6) && (inpwd == paswd))
{
    Runtime.getRuntime().exec( "/bin/bash /root/deldb" ).getInputStream().read( b );
    msg = "GameDBD and UNIQUENAMED DB have been SHUTDOWN and DELETED!!!";
}
else if ((option == 7) && (inpwd == paswd))
{
    Runtime.getRuntime().exec( "/bin/bash /root/shutdb" ).getInputStream().read( b );
    msg = "GameDBD and UNIQUENAMED have been SHUTDOWN!!!";
}
else if ((option == 8) && (inpwd == paswd))
{
    Runtime.getRuntime().exec( "/bin/bash /root/startdb" ).getInputStream().read( b );
    msg = "GameDBD and UNIQUENAMED have been STARTED!!!";
}
else if ((option == 9) && (inpwd == paswd))
{
    msg = "OS will be Maintenance and RESTARTED";

    String amsg = "Server will maintenance in "+waitsecs+" seconds. Please log-off your account now to avoid lost-data of your accounts. Staying online during maintenance at your OWN RISK. Please dont forget to VERIFY your client with our patch once the server is up";

    boolean successmsg = DeliveryDB.broadcast((byte)9,-1,amsg);
    boolean success = DeliveryDB.GMRestartServer( -1, waitsecs );
    LogFactory.getLog("restartgamefriendly.jsp").info("restartgamefriendly, waitsecs=" + waitsecs + ",result=" + success + ",operator=" + AuthFilter.getRemoteUser(session) );

    Runtime.getRuntime().exec( "/bin/bash /root/shuttimer "+(waitsecs+10) ).getInputStream().read( b );
}
else if ((option == 10) && (inpwd == paswd))
{
    msg = filedb+" has been restored, OS will be Maintenance and RESTARTED";
    String amsg = "Database has been restored by system administrator. Server will be restart now.";

    boolean successmsg = DeliveryDB.broadcast((byte)9,-1,amsg);
    boolean success = DeliveryDB.GMRestartServer( -1, waitsecs );
    LogFactory.getLog("restartgamefriendly.jsp").info("restartgamefriendly, waitsecs=" + waitsecs + ",result=" + success + ",operator=" + AuthFilter.getRemoteUser(session) );

    Runtime.getRuntime().exec( "/bin/bash /root/delshutdb "+(filedb) ).getInputStream().read( b );
}
else if ((option == 8889) && (inpwd == paswd))
{
    Runtime.getRuntime().exec( "/bin/bash /root/restoredb" ).getInputStream().read( b );
    msg = "XXXXXXXXX!!!";
}
else if ((option == 8888) && (inpwd == paswd))
{
    //Runtime.getRuntime().exec( "/bin/bash /root/restoredb" ).getInputStream().read( b );
    //b = new byte[4096];
    //Runtime.getRuntime().exec( "/bin/bash /root/startdb" ).getInputStream().read( b );
    //boolean success = DeliveryDB.GMRestartServer( -1, waitsecs );
    //LogFactory.getLog("shutdowngamefriendly.jsp").info("shutdowngamefriendly, waitsecs=" + waitsecs + ",result=" + success + ",operator=" + AuthFilter.getRemoteUser(session) );
    msg = "MYSQLD has been restarted!!!";
}
else if (option == 9999)
{
}
else
{
    msg = "Syntax error or INVALID password!!!";
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

