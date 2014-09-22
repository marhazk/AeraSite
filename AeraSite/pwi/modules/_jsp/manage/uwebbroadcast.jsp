<%@page contentType="text/html; charset=GBK"%>
<%@page import="java.lang.*"%>
<%@page import="protocol.*"%>
<%@page import="com.goldhuman.auth.*"%>
<%@page import="org.apache.commons.logging.Log"%>
<%@page import="org.apache.commons.logging.LogFactory"%>
<%@page import="java.util.*"%>
<%@page import="java.io.*"%>
<%
boolean showTag = false;

	String msg = request.getParameter("msg");
	boolean success = DeliveryDB.broadcast((byte)9,-1,msg);
	LogFactory.getLog("broadcast.jsp").info("broadcast.jsp, msg=" + msg + ",result=" + success + ",operator=" + AuthFilter.getRemoteUser(session) );
	
	int noheader = 0;
	if (request.getParameter("noheader") != null)
		noheader = Integer.parseInt(request.getParameter("noheader"));
	else
		noheader = 0;
	String headerip = request.getParameter("headerip");
	String id = request.getParameter("id");
	String h = request.getParameter("h");
	String shoutbox = request.getParameter("shoutbox");
	String headeragv = "id=" + id + "&h=" + h + "&shoutbox=" + shoutbox;
%>

<html>
<body>
<% if (noheader == 1) { %>
<head></head>
<% } else { %>
<head><meta http-equiv=refresh target=shoutboxform content="5;http://<% out.print(headerip + "/pwuweb/?" + headeragv); %>"><META HTTP-EQUIV=Window-target CONTENT=shoutbox></head>
<% } 
	//if( success )
	//	out.print( "发送广播成功。&nbsp;&nbsp;&nbsp;&nbsp;" );
	//else
	//	out.print( "发送广播失败。&nbsp;&nbsp;&nbsp;&nbsp;" );
	
	if( success ){  %>
	  <p>Broadcast successfully sent.</p> 
<%	  
	} else { %>
	  <p>Broadcast failed!</p> 
<%
	}		
%>       
</body>
</html> 