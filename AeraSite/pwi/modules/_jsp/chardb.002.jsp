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
<P>VERSION: 002</p>
<P>UPDATED: 06-Feb-09</p>
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
	ResultSet rstx=null;
	
	statement.executeUpdate("update uWebplayers SET updated='0' WHERE updated='1'");
	
	rst = statement.executeQuery("select ID from users");

	RoleBean role = null;
	String tempplayername = null;
	String command = null;
	int index = 0;
	int maxid = 0;
	int roleid = 0;
	int accstat = 0;
	int totalrole = 0;
	while (rst.next())
	{
		totalrole++;
		out.println("<br>Actived account found:"+totalrole);
	}

	int uid = 0;
	int udb[] = new int[totalrole];
	int adb[] = new int[totalrole];
	int tempuid = 0;

	rstx = statement.executeQuery("select ID from users");
	while (rstx.next())
	{
		tempuid = Integer.parseInt(rstx.getString("ID"));
		tempaid = Integer.parseInt(rstx.getString("accstat"));
		out.println("<br>STORED found:"+uid+" RoleID:"+tempuid);
		udb[uid] = tempuid;
		adb[uid] = tempaid;
		uid++;
	}
	
	out.println("<br><B>ALL STORED</b> TOTAL:"+totalrole);


	uid = 0;
	while (uid < totalrole)
	{
		roleid = udb[uid];
		accstat = adb[uid];
		//if (roleid <= 32) continue;
		roleid--;
		maxid = roleid+16;
		while (roleid < maxid)
		{
			roleid++;
			if (roleid <= 47) continue;
			command = null;
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
					out.println("<br>Trying to STORE roleid:"+roleid);
					tempplayername = null;
					tempplayername = StringEscapeUtils.escapeHtml(role.base.name.getString());
					out.println(" Name:"+tempplayername);
					
					index = 0;
					index = tempplayername.indexOf("'");
					StringBuffer playername = new StringBuffer(tempplayername);
					if(index > 0){
						playername.replace(index, index + 1, "?");
					}
					out.println(" New Name:"+playername);
					command = "UPDATE uWebplayers SET updated=1,";
					command .= " rolename='"+playername+"',";
					command .= " rolelevel=" + role.status.level + ",";
					command .= " rolestatus='" + role.base.status + "',";
					command .= " rolegender='" + role.base.gender + "',";
					command .= " roleprof='" + role.base.cls + "',";
					command .= " rolerep='" + role.status.reputation + "',";
					command .= " redname='" + role.status.invader_state + "',";
					command .= " rednametime='" + role.status.invader_time + "',";
					command .= " pinknametime='" + role.status.pariah_time + "',";
					command .= " rolemoney='"+role.pocket.money+"',";
					command .= " rolesp='"+role.status.sp+"',";
					command .= " rolebank='"+role.storehouse.money+"'";
					command .= " roleclass='" + role.storehouse.race + "'";
					command .= " roleagi='" + role.storehouse.agility + "'";
					command .= " rolestr='" + role.storehouse.strength + "'";
					command .= " rolevit='" + role.storehouse.vitality + "'";
					command .= " roleint='" + role.storehouse.energy + "'";
					command .= " roleculti='" + role.storehouse.level2 + "'";
					command .= " roleclass='" + role.storehouse.race + "'";
					command .= " accstat='" + accstat + "'";
					//command .= " role='" + role.storehouse. + "'";
					command .= " WHERE roleid='"+roleid+"'";
					statement.executeUpdate(command);
					out.println("<br><B>SUCCESS UPDATED:</B> --100% stored RoleDB: Name:" + tempplayername + " Roleid:" + roleid + " Level:" + role.status.level);
					//out.println(command);
				}
			}
			catch (Exception e)
			{
				out.println("<br><B>FAIL UPDATED: "+e+"</B> SQL:"+command);
				continue;
			}
		}
		uid++;
	}	
	out.println("<br><B>ALL ROLES HAVE BEEN STORED</b> TOTAL:"+totalrole);	
%>
