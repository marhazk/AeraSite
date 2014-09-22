<%@page contentType="text/html; charset=GBK"%>
<%@page import="java.lang.*"%>
<%@page import="java.util.*"%>
<%@page import="java.text.*"%>
<%@page import="org.apache.commons.lang.StringEscapeUtils"%>
<%@page import="protocol.*"%>
<%@page import="com.goldhuman.auth.*"%>
<%@page import="org.apache.commons.logging.Log"%>
<%@page import="org.apache.commons.logging.LogFactory"%>
<%@ page import="java.sql.*" %>
<%
	//
	// ORIGINALLY CODED BY MARHAZK (MARHAZK@YAHOO.COM) 
	// SUPPORTED PW-UWEB v3.5 MODULE (www.perfectworld.sytes.net/pwuweb)
	// COPYRIGHT ALL RIGHT RESERVED BY MARHAZK
	// DEVELOPMENT TEAM : MMORPG-DEV (www.mmorpg-dev.com)
	// VERSION: V2.0
	// FIRST RELEASE: MSSQL ONLY
	// NOTES: MODIFYING THIS PAGE OR/AND REMOVE THE COMMENTS THAT CONTAIN "MarHazK" NAME AS ORIGINAL CODER ARE ILLEGAL UNDER GNU LICENSES
	//
	//
	//
	// SQL INFORMATION
	//
	// NOTES: PLEASE EDIT YOUR <IP ADDRESS>, <USERNAME>, AND <PASSWORD> TO MAKE IT FUNCTIONING
	//
	Connection connection = null;
    Class.forName("sun.jdbc.odbc.JdbcOdbcDriver");
    connection = DriverManager.getConnection("jdbc:microsoft:sqlserver://192.168.1.2:1433;databasename=dbo", "sa", "hahaha");

	Statement statement = connection.createStatement();
	
	//
	//CLEAR UWEBPLAYERS DATABASE
	//	
	//String deleteall = "DELETE FROM uWebplayers";
	//statement.executeUpdate(deleteall);

	//
	//GET USER DB FIRST
	//
	ResultSet rst=null;
	rst = statement.executeQuery("select Id from Online");

	RoleBean role = null;
	String tempplayername = null;
	String command = null;
	int index = 0;
	int maxid = 0;
	int roleid = 0;
	int uid = 0;
	int total = 0;
	while (rst.next())
	{
		total++;
	}
	out.println("<p>TOTAL: "+uid+"</p>");
%>
