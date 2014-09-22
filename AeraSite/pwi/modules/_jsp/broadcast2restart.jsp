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
String msg;
msg = "ERROR: id";
String idm = request.getParameter("msg");
if (idm.equals("1")){
	msg = "ATTENTION: Server will maintainance for 5 minutes in 30 minutes. Please logoff your account immediately to avoid lose data";
}
if (idm.equals("2")){
	msg = "ATTENTION: Server will maintainance for 5 minutes in 15 minutes. Please logoff your account immediately to avoid lose data";
}
if (idm.equals("3")){
	msg = "ATTENTION: Server will maintainance for 5 minutes in 10 minutes. Please logoff your account immediately to avoid lose data";
}
if (idm.equals("4")){
	msg = "ATTENTION: Server will maintainance for 5 minutes in 5 minutes. Please logoff your account immediately to avoid lose data";
}
if (idm.equals("5")){
	msg = "ATTENTION: Server will maintainance for 5 minutes in 2 minutes. Please logoff your account immediately to avoid lose data";
}

if (idm.equals("6")){
	msg = "ATTENTION: Server will maintainance for 5 minutes in 1 minutes. Please logoff your account immediately to avoid lose data";
}

if (idm.equals("7")){
	msg = "ATTENTION: Server will maintainance for 5 minutes starting from now. Please logoff your account immediately to avoid lose data.";
}

boolean success = DeliveryDB.broadcast((byte)9,-1,msg);
if( success )

{%><span class="ver_10_black">SUCCESS</span>
<%} else {%><span class="ver_10_red">FAIL</span>
<%
}%>
