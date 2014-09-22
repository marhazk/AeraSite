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
	// VERSION: V1.0
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
	String deleteall = "DELETE FROM uWebplayers";
	statement.executeUpdate(deleteall);

	//
	//GET USER DB FIRST
	//
	ResultSet rst=null;
	rst = statement.executeQuery("select ID, name from users");
	int eachacc = 0;
	int roleid = 0;
	int uid = 0;
	String username = null;
	RoleBean role = null;
	String tempplayername = null;
	String command = null;
	int index = 0;
	while (rst.next())
	{
		try
		{
			username = rst.getString("name");
			uid = Integer.parseInt(rst.getString("ID"));
			if (uid > 31)
			{
				roleid = 0;
				eachacc = 0;
				out.println("<p>" + uid + ". USERNAME: " + username);
				if (roleid < 6)
				{
					eachacc++;
					roleid = uid + eachacc;
					//
					//
					//GET CHARROLE DB FIRST
					//
					//
					try{
						role = GameDB.get( roleid );
						session.setAttribute( "gamedb_rolebean", role );
						if (null == role){
							//out.println("Role does not exist.");
							continue;
						}
						else
						{
							//LogFactory.getLog("modrole.jsp").info("getRoleInfo, "+role.getLogString()+",operator=" + AuthFilter.getRemoteUser(session) );
							tempplayername = null;
							tempplayername = StringEscapeUtils.escapeHtml(role.base.name.getString());
							
							index = 0;
							index = tempplayername.indexOf("'");
							StringBuffer playername = new StringBuffer(tempplayername);
							if(index > 0){
								playername.replace(index, index + 1, "?");
							}
								
							//out.println("<br>-- Name:" + tempplayername + " Roleid:" + roleid + " Level:" + role.status.level);
							command = "INSERT INTO uWebplayers (roleid, rolename, rolelevel, rolestatus, rolegender, roleprof, rolerep, redname, rednametime, pinknametime) VALUES ("+roleid+", '"+playername+"', " + role.status.level + ", '" + role.base.status + "', '" + role.base.gender + "', '" + role.base.cls + "', '" + role.status.reputation + "', '" + role.status.invader_state + "', '" + role.status.invader_time + "', '" + role.status.pariah_time + "')";
							statement.executeUpdate(command);
							//out.println(command);
						}
					}
					catch (Exception e) {
						//out.println(e.toString());
						continue;
					}
				}
				out.println("</p>");
			}
			else
				continue;
		}
		catch (Exception e)
		{
			continue;
		}
	}
	
%>
