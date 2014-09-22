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
	int totalrole = 0;
	while (rst.next())
	{
		totalrole++;
		out.println("<br>Online found:"+totalrole);
	}

	int uid = 0;
	int udb[] = new int[totalrole];
	int tempuid = 0;

	rst = statement.executeQuery("select Id from Online");
	while (rst.next())
	{
		tempuid = Integer.parseInt(rst.getString("Id"));
		udb[uid] = tempuid;
		uid++;
		out.println("<br>STORED found:"+uid+" RoleID:"+tempuid);
	}

	uid = 0;
	while (uid < totalrole)
	{
		roleid = udb[uid];
		roleid--;
		maxid = roleid+16;
		while (roleid < maxid)
		{
			roleid++;
			try
			{
				out.println("<br>Reading roleid:"+roleid);
				role = GameDB.get( roleid );
				session.setAttribute( "gamedb_rolebean", role );
				if (null == role){
					out.println("<br>FAIL Reading roleid:"+roleid);
					continue;
				}
				else
				{
					out.println("<br><B>GOOD</B> Reading roleid:"+roleid);
					tempplayername = null;
					tempplayername = StringEscapeUtils.escapeHtml(role.base.name.getString());
					
					index = 0;
					index = tempplayername.indexOf("'");
					StringBuffer playername = new StringBuffer(tempplayername);
					if(index > 0){
						playername.replace(index, index + 1, "?");
					}
						
					command = "UPDATE uWebplayers SET updated=1, rolename='"+playername+"', rolelevel=" + role.status.level + ", rolestatus='" + role.base.status + "', rolegender='" + role.base.gender + "', roleprof='" + role.base.cls + "', rolerep='" + role.status.reputation + "', redname='" + role.status.invader_state + "', rednametime='" + role.status.invader_time + "', pinknametime='" + role.status.pariah_time + "', rolemoney='"+role.pocket.money+"', rolesp='"+role.status.sp+"', rolebank='"+role.storehouse.money+"' WHERE roleid='"+roleid+"'";
					statement.executeUpdate(command);
					out.println("<br><B>SUCCESS UPDATED:</B> --100% stored RoleDB: Name:" + tempplayername + " Roleid:" + roleid + " Level:" + role.status.level);
					//out.println(command);
				}
			}
			catch (Exception e)
			{
				out.println("<br><B>FAIL UPDATED: "+e+"</B>");
				continue;
			}
		}
		uid++;
	}	
	
%>
