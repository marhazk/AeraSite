<%	// FOLDER: /opt/jakarta-tomcat-5.5.9/webapps/iweb %>
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

<html><head>
<meta http-equiv=refresh target=shoutboxform content="60;URL=https://pw.net/iweb/chardb.jsp?online=1&counter=
<%
	// FOLDER: /opt/jakarta-tomcat-5.5.9/webapps/iweb
	String counter = request.getParameter("counter");
	int numC = 0;
	if( null != counter && counter.length() > 0 )
	{
		numC = Integer.parseInt(request.getParameter("counter"));
	}
	numC++;
	out.println(numC);
%>
">
<META HTTP-EQUIV=Window-target CONTENT=shoutboxform>
</head>
<P>VERSION: 010</p>
<P>UPDATED: 05-July-09</p>
<P><% out.println("DB LAST COUNTER: "+numC); %> </p>
<P>DB LAST UPDATED: <%= new java.util.Date() %></p>
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
    connection = DriverManager.getConnection("jdbc:microsoft:sqlserver://192.168.1.2\\SQLEXPRESS;databasename=dbo", "sa", "hahaha");

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
	
	boolean fixchar = false;
	boolean oneChar = false;
	boolean allChar = false;
	int oneaccid = 0;
	int allaccid = 0;
	int endaccid = 0;
	int _allaccid = 0;
	RoleBean role = null;
	String tempplayername = null;
	int tempplayernamenum = 0;
	String command = null;
	double posx = 0;
	double posy = 0;
	double posz = 0;
	int index = 0;
	int maxid = 0;
	int roleid = 0;
	int accstat = 0;
	int totalrole = 0;
	
	// /////////////////////////////
	//
	// FIRST SYSTEM (DETECTING)
	//
	// /////////////////////////////
	String strRoleId = request.getParameter("roleid");
	String strAll = request.getParameter("all");
	String strOnline = request.getParameter("online");
	String strActive = request.getParameter("active");
	String fixcharEnable = request.getParameter("fixchar");
	if( null != fixcharEnable && fixcharEnable.length() > 0 )
	{
		fixchar = true;
	}
	else
	{
		fixchar = false;
	}
	if( null != strAll && strAll.length() > 0 )
	{
		allChar = true;
		endaccid = Integer.parseInt(request.getParameter("all"));
		allaccid = 0;
		while (allaccid <= endaccid)
		{
			allaccid = allaccid+16;
			totalrole++;
			if (numC == 0)
			{
				out.println("<br>Actived account found:"+totalrole);
			}
		}
	}
	else
	{
		if( null != strRoleId && strRoleId.length() > 0 )
		{
			oneChar = true;
			oneaccid = Integer.parseInt(request.getParameter("roleid"));
			totalrole++;
			out.println("<br>Actived account found:"+totalrole);
		}
		else
		{
			oneChar = false;
			if( null != strOnline && strOnline.length() > 0 )
			{
				rst = statement.executeQuery("select ID from users WHERE online=1");
			}
			else
			{
				statement.executeUpdate("update uWebplayers SET updated='0' WHERE updated='1'");
				rst = statement.executeQuery("select ID from users WHERE system!=1");
			}
			while (rst.next())
			{
				totalrole++;
				if (numC == 0)
				{
					out.println("<br>Actived account found:"+totalrole);
				}
				else continue;
			}		
			if (numC >= 1)
			{
				out.println("<br>Total Onlines:"+totalrole+"<BR><BR>");
			}
			else
			{
				out.println("<br>Total Data:"+totalrole+"<BR><BR>");
			}
		}
	}
	out.println("<br>LIMIT done:"+totalrole);
	
	// /////////////////////////////
	//
	// SECOND SYSTEM (REGISTERING)
	//
	// /////////////////////////////
	int uid = 0;
	int udb[] = new int[totalrole];
	int adb[] = new int[totalrole];
	int tempuid = 0;
	int tempaid = 0;

	if (oneChar)
	{
		udb[uid] = oneaccid;
		adb[uid] = 0;
	}
	else
	{
		if (allChar)
		{
			_allaccid = 0;
			while (_allaccid <= endaccid)
			{
				_allaccid = _allaccid+16;
				tempuid = _allaccid;
				tempaid = 0;
				if (numC == 0)
				{
					out.println("<br>STORED found:"+uid+" RoleID:"+tempuid+" AccStat:"+tempaid);
				}
				udb[uid] = tempuid;
				adb[uid] = tempaid;
				uid++;
			}
		}
		else
		{
			if( null != strOnline && strOnline.length() > 0 )
			{
				rstx = statement.executeQuery("select ID, accstat from users WHERE online=1");
			}
			else
			{
				rstx = statement.executeQuery("select ID, accstat from users WHERE system!=1");
			}
			while (rstx.next())
			{
				tempuid = Integer.parseInt(rstx.getString("ID"));
				tempaid = Integer.parseInt(rstx.getString("accstat"));
				if (numC == 0)
				{
					out.println("<br>STORED found:"+uid+" RoleID:"+tempuid+" AccStat:"+tempaid);
				}
				udb[uid] = tempuid;
				adb[uid] = tempaid;
				uid++;
			}
		}
	}
	if (numC == 0)
	{
		out.println("<br><B>ALL STORED</b> TOTAL:"+totalrole);
	}

	// /////////////////////////////
	//
	// THIRD SYSTEM (UPDATING)
	//
	// /////////////////////////////
	uid = 0;
	while (uid < totalrole)
	{
		roleid = udb[uid];
		try
		{
			accstat = adb[uid];
		}
		catch (Exception e)
		{
			accstat = 0;
		}
		//if (roleid <= 31) continue;
		roleid--;
		maxid = roleid+16;
		while (roleid < maxid)
		{
			roleid++;
			if (roleid <= 31) continue;
			command = null;
			try
			{
				//out.println("<br>Reading roleid:"+roleid);
				role = GameDB.get( roleid );
				session.setAttribute( "gamedb_rolebean", role );
				if (null == role){
					//out.println("<br>FAIL Reading roleid:"+roleid);
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
					
					if (fixchar)
					{
						boolean success = false;
						try {
							role.status.exp = 0;
							role.status.sp = 30000000;						
							out.println("<br><B>ROLE SUCCESS UPDATED</B>");
							success = GameDB.update( role );
						}
						catch (Exception e) { out.println(e.toString()); continue; }
					}
					byte[] rolenameb = tempplayername.getBytes();
					command = "UPDATE uWebplayers SET updated=1,";
					command += " rolename='"+playername+"',";
					
					tempplayernamenum = 0;
					while (tempplayernamenum < tempplayername.length())
					{
						command += " rolenameb"+tempplayernamenum+"="+rolenameb[tempplayernamenum]+",";
						tempplayernamenum++;
					}
					
					posx = role.status.posx + 5000;
					posy = role.status.posy + 5000;
					posz = role.status.posz + 5000;
					command += " rolenamebTotal=" + tempplayernamenum + ",";
					command += " rolelevel=" + role.status.level + ",";
					command += " rolestatus='" + role.base.status + "',";
					command += " rolegender='" + role.base.gender + "',";
					command += " roleprof='" + role.base.cls + "',";
					command += " rolerep='" + role.status.reputation + "',";
					command += " redname='" + role.status.invader_state + "',";
					command += " rednametime='" + role.status.invader_time + "',";
					command += " pinknametime='" + role.status.pariah_time + "',";
					command += " rolemoney='"+role.pocket.money+"',";
					command += " rolesp='"+role.status.sp+"',";
					command += " rolebank='"+role.storehouse.money+"',";
					command += " roleclass='" + role.base.race + "',";
					command += " roleagi='" + role.ep.agility + "',";
					command += " rolestr='" + role.ep.strength + "',";
					command += " rolevit='" + role.ep.vitality + "',";
					command += " roleint='" + role.ep.energy + "',";
					command += " roleculti='" + role.status.level2 + "',";
					command += " taskdata='" + role.task.task_data.getBytes().length + "',";
					command += " taskcomplete='" + role.task.task_complete.getBytes().length + "',";
					command += " posx='" + posx + "',";
					command += " posy='" + posy + "',";
					command += " posz='" + posz + "',";
					command += " createtime='" + role.base.create_time + "',";
					command += " lastlogin='" + role.base.lastlogin_time + "',";
					command += " accstat='" + accstat + "'";
					command += " WHERE roleid='"+roleid+"'";
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
