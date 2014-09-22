<%@ page contentType="text/html; charset=UTF-8" %>
<%@page import="java.lang.*"%>
<%@page import="protocol.*"%>
<%@page import="com.goldhuman.auth.*"%>
<%@page import="org.apache.commons.logging.Log"%>
<%@page import="org.apache.commons.logging.LogFactory"%>
<%@page import="com.goldhuman.util.LocaleUtil" %>

<%
int worldtag = Integer.parseInt(request.getParameter("worldtag"));
String command = request.getParameter("command");

GMControlGame_Re res = DeliveryDB.GMControlGame( worldtag, command );
LogFactory.getLog("worldtag.jsp").info("worldtag.jsp, worldtag=" + worldtag +",command=" + command + ",operator=" + AuthFilter.getRemoteUser(session) );
%>

<html>
<head>
<link href="../include/style.css" rel="stylesheet" type="text/css">
<title><%= LocaleUtil.getMessage(request,"manage_worldtag_sendcomm") %></title>
</head>

<body>
<%@include file="../include/header.jsp"%>
<table width="100%" height="350"  border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF"><tr><td>

<table width="30%" height="200" align="center" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td height="350">
<%
	if( null != res && 0 == res.retcode )
	{
		out.print( LocaleUtil.getMessage(request,"manage_worldtag_sendcommok") + "&nbsp;&nbsp;&nbsp;&nbsp;<br>&nbsp;<br>" );

		for( int i=0; i<res.resvector.size(); i++ )
		{
			GMControlGameRes w = (GMControlGameRes)res.resvector.get(i);
			out.println( "gsid&nbsp;=&nbsp;" + w.gsid + "&nbsp;" );
			if( -2 == w.retcode )
			{
				out.print( LocaleUtil.getMessage(request,"manage_worldtag_timeout") );
			}
			else if( -1 == w.retcode )
			{
				out.print( LocaleUtil.getMessage(request,"manage_worldtag_sendfail") );
			}
			else if( 1 == w.retcode )
			{
				out.print( LocaleUtil.getMessage(request,"manage_worldtag_fail") );
			}
			else if( 0 == w.retcode )
			{
				out.print( LocaleUtil.getMessage(request,"manage_worldtag_succ") );
			}
			out.println( "<br>" );
		}
	}
	else if( null != res && -1 == res.retcode )
	{
		out.print( LocaleUtil.getMessage(request,"manage_worldtag_sendcommfail") + "&nbsp;&nbsp;&nbsp;&nbsp;" );
	}
	else
	{
		out.print( LocaleUtil.getMessage(request,"manage_worldtag_sendcommfailtimeout") + "&nbsp;&nbsp;&nbsp;&nbsp;" );
	}
%>
    </td>
  </tr>
</table>

</td></tr></table>
<%@include file="../include/foot.jsp"%>
</body>
</html>

