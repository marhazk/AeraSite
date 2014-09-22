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
<meta http-equiv=refresh target=shoutboxform content="60;URL=
<%
	// FOLDER: /opt/jakarta-tomcat-5.5.9/webapps/iweb
	String counter = request.getParameter("counter");
	int numC = 0;
	if( null != counter && counter.length() > 0 )
	{
		numC = Integer.parseInt(request.getParameter("counter"));
		if (numC > 1)
		{
			numC = 0;
		}
	}
	numC++;
	out.println("https://pw.net/iweb/chardb.jsp?online=1&counter="+numC);
%>
">
<META HTTP-EQUIV=Window-target CONTENT=shoutboxform>
</head>
<P><a href="https://pw.net/iweb/chardb.jsp?online=1&counter=<%out.println(numC);%>">Click here to continue to the next session</a>
| <a href="about:blank">BLANK PAGE</a></P>
<P>VERSION: 011</p>
<P>UPDATED: 04-Sept-09</p>
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
	ResultSet onlinerst=null;
	ResultSet fixonlinerst=null;
	
	boolean fixchar = false;
	boolean oneChar = false;
	boolean allChar = false;
	boolean onlineBool = false;
	int oneaccid = 0;
	int allaccid = 0;
	int endaccid = 0;
	int _allaccid = 0;
	int onlineID = 0;
	int fixonlineID = 0;
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
	
	// ON BROADCAST VARIABLES!!!
	int toplevel = 0;
	String topname = "N/A";
	int toponlevel = 0;
	String toponname = "N/A";
	int top1onlevel = 0;
	String top1onname = "N/A";
	int top2onlevel = 0;
	String top2onname = "N/A";
	int top3onlevel = 0;
	String top3onname = "N/A";
	
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
				onlineBool = true;
				rst = statement.executeQuery("select ID from users WHERE chardbupdate>=1");
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
	int udb[] = new int[totalrole];			//USERID
	int adb[] = new int[totalrole];			//Access Stat
	int bdb[] = new int[totalrole];			//Buy UserID
	int cdb[] = new int[totalrole];			//PostGold Amount
	int ddb[] = new int[totalrole];			//PreGold Amount
	String edb[] = new String[totalrole];	//Original Username
	int fdb[] = new int[totalrole];			//Value of chardbupdate in table USER
	int gdb[] = new int[totalrole];			//ONLINE or NOT
	int tempuid = 0;
	int tempaid = 0;
	int tempbid = 0;
	int tempcid = 0;
	int tempdid = 0;
	String tempeid = "noname";
	int tempfid = 0;
	int tempgid = 0;

	if (oneChar)
	{
		udb[uid] = oneaccid;
		adb[uid] = 0;
		bdb[uid] = 0;
		cdb[uid] = 0;
		ddb[uid] = 0;
		edb[uid] = "noname";
		fdb[uid] = 0;
		gdb[uid] = 0;
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
				tempbid = 0;
				tempbid = 0;
				tempcid = 0;
				tempdid = 0;
				tempeid = "noname";
				tempfid = 0;
				tempgid = 0;
				if (numC == 0)
				{
					out.println("<br>STORED found:"+uid+" RoleID:"+tempuid+" AccStat:"+tempaid);
				}
				udb[uid] = tempuid;
				adb[uid] = tempaid;
				bdb[uid] = tempbid;
				cdb[uid] = tempcid;
				ddb[uid] = tempdid;
				edb[uid] = tempeid;
				fdb[uid] = tempfid;
				gdb[uid] = tempgid;
				uid++;
			}
		}
		else
		{
			if( null != strOnline && strOnline.length() > 0 )
			{
				rstx = statement.executeQuery("select ID, realuname, accstat, buyid, pregold, postgold, online, chardbupdate from users WHERE chardbupdate>=1");
			}
			else
			{
				rstx = statement.executeQuery("select ID, realuname, accstat, buyid, pregold, postgold, online, chardbupdate from users WHERE system!=1");
			}
			while (rstx.next())
			{
				tempuid = Integer.parseInt(rstx.getString("ID"));
				tempaid = Integer.parseInt(rstx.getString("accstat"));
				tempbid = 0;
				tempcid = 0;
				tempdid = 0;
				tempeid = "noname"; //rstx.getString("realuname");
				try
				{
					tempfid = Integer.parseInt(rstx.getString("chardbupdate"));
				}
				catch (Exception e)
				{
					tempfid = 0;
				}
				try
				{
					tempgid = Integer.parseInt(rstx.getString("online"));
				}
				catch (Exception e)
				{
					tempgid = 0; //Integer.parseInt(rstx.getString("online"));
				}
				if (Integer.parseInt(rstx.getString("buyid")) >= 32)
				{
					tempbid = Integer.parseInt(rstx.getString("buyid"));
					tempcid = Integer.parseInt(rstx.getString("postgold"));
					tempdid = Integer.parseInt(rstx.getString("pregold"));
				}
				if (numC == 0)
				{
					out.println("<br>STORED found:"+uid+" RoleID:"+tempuid+" AccStat:"+tempaid);
				}
				udb[uid] = tempuid;
				adb[uid] = tempaid;
				bdb[uid] = tempbid;
				cdb[uid] = tempcid;
				ddb[uid] = tempdid;
				edb[uid] = tempeid;
				fdb[uid] = tempfid;
				gdb[uid] = tempgid;
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
		//		
		//DECLARATION START
		//
		roleid = udb[uid];
		try
		{
			accstat = adb[uid];
		}
		catch (Exception e)
		{
			accstat = 0;
		}
		tempbid = 0;
		tempcid = 0;
		tempdid = 0;
		tempbid = bdb[uid];
		tempcid = cdb[uid];
		tempdid = ddb[uid];		
		tempuid = udb[uid];
		tempeid = edb[uid];
		tempfid = fdb[uid];
		tempgid = gdb[uid];
		
		//		
		//DECLARATION ENDED
		//
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
					out.println(" New Name:"+playername.toString());
					
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
					if ((tempbid == roleid) && (tempfid == 2) && (tempgid == 0) && (onlineBool == true))
					{
						boolean success = false;
						try {
							statement.executeUpdate("update users SET chardbupdate='0', buyid='0', buysuccess=1 WHERE ID='" + tempuid + "'");
							role.storehouse.money = tempcid;						
							out.println("<br><B>ROLE SUCCESS UPDATED - BUY POINT/GOLD</B>");
							success = GameDB.update( role );
						}
						catch (Exception e) { out.println(e.toString()); continue; }
					}
					byte[] rolenameb = tempplayername.getBytes();
					command = "UPDATE uWebplayers SET updated=1,";
					command += " rolename='"+playername.toString()+"',";
					
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
					try
					{
						command += " taskdata='" + role.task.task_data.getBytes().length + "',";
					}
					catch (Exception e)
					{
						command += " taskdata='0',";
						out.println("<br><B>NULL DETECTED:</B> on TaskData");
					}
					try
					{
						command += " taskcomplete='" + role.task.task_complete.getBytes().length + "',";
					}
					catch (Exception e)
					{
						command += " taskcomplete='0',";
						out.println("<br><B>NULL DETECTED:</B> on TaskComplete");
					}
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
					
					if (onlineBool == true)
					{
						// TOP ONLINE PLAYERS - BROADCAST ON TOP PLAYER
						if (role.status.level > top3onlevel)
						{
							if (role.status.level > top2onlevel)
							{
								if (role.status.level > top1onlevel)
								{
									top3onlevel = top2onlevel;
									top3onname = top2onname;
									top2onlevel = top1onlevel;
									top2onname = top1onname;
									top1onlevel = role.status.level;
									top1onname = playername.toString();
								}
								else
								{
									top3onlevel = top2onlevel;
									top3onname = top2onname;
									top2onlevel = role.status.level;
									top2onname = playername.toString();
								}
							}
							else
							{
								top3onlevel = role.status.level;
								top3onname = playername.toString();
							}
						}
						if (tempgid == 0)
						{
							out.println("<br><B>OFFLINE UPDATED!</B> "+playername.toString());
							statement.executeUpdate("update users SET chardbupdate='0' WHERE ID='" + tempuid + "'");
						}
					}
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

	////////////////////////////////
	//
	//
	// ON BROADCAST MODE!!!
	//
	//
	/////////////////////////////////
	try
	{
		String msg = "N/A";
		boolean success = false;
		ResultSet setrst=null;
		ResultSet broadcastrst=null;
		ResultSet bmaxrst=null;
		int bnum = 0;
		int bID = 0;
		int bmaxID = 100;
		setrst = statement.executeQuery("SELECT * FROM uWebsettings WHERE ID=1");
		while (setrst.next())
		{
			bnum = Integer.parseInt(setrst.getString("broadcastnum"));
		}
		bmaxrst = statement.executeQuery("SELECT * FROM uWebautobroadcast ORDER BY bid DESC");
		while (bmaxrst.next())
		{
			bmaxID = Integer.parseInt(bmaxrst.getString("bid"));
			break;
		}
		bnum++;

		if (bnum == 10)
		{
			msg = "AUTO: Currently Top 3 Online Player: 1. "+top1onname+" (L"+top1onlevel+") 2. "+top2onname+" (L"+top2onlevel+") 3. "+top3onname+" (L"+top3onlevel+").";
			success = DeliveryDB.broadcast((byte)9,-1,msg);
			LogFactory.getLog("broadcast.jsp").info("broadcast.jsp, msg=" + msg + ",result=" + success + ",operator=" + AuthFilter.getRemoteUser(session) );
			out.println("<br><B>BROARCASTED</b>: "+msg);	
		}

		broadcastrst = statement.executeQuery("SELECT * FROM uWebautobroadcast");
		while (broadcastrst.next())
		{
			bID = Integer.parseInt(broadcastrst.getString("bid"));
			if (bID == bnum)
			{
				msg = "AUTO: Player is now able to buy eubopoint with gamecoin through PW-uWeb > Buy E-Point. Limit is 1000 eubogold.";
				success = DeliveryDB.broadcast((byte)9,-1,msg);
				LogFactory.getLog("broadcast.jsp").info("broadcast.jsp, msg=" + msg + ",result=" + success + ",operator=" + AuthFilter.getRemoteUser(session) );
				out.println("<br><B>BROARCASTED</b>: "+msg);	
			}
		}
		if (bnum > bmaxID)
			bnum = 1;
		statement.executeUpdate("UPDATE uWebsettings SET broadcastnum='"+bnum+"' WHERE ID=1");
		out.println("<br><B>BROARCASTED CHECK END</b>: ID: "+bnum+" out of "+bmaxID);
	}
	catch (Exception e)
	{
		out.println("<br><B>FAIL BROADCASTED: "+e+"</B>");
	}
	
	////////////////////////////////
	//
	//
	// ON FIXING MODE!!!
	//
	//
	/////////////////////////////////
	fixonlinerst = statement.executeQuery("select Id from Online");
	int fixonlineDB[] = new int[100];
	int fixonlineUID = 0;
	int fixonlineNUM = 0;
	while (fixonlinerst.next())
	{
		if ((fixonlineID = Integer.parseInt(fixonlinerst.getString("Id"))) > 0)
		{
			fixonlineDB[fixonlineUID] = fixonlineID;
			fixonlineUID++;
			out.println("<br><B>CHECK ONLINE ID</b>: "+fixonlineID);
		}
		else
		{
			break;
		}
	}
	while (fixonlineNUM < fixonlineUID)
	{
		fixonlineID = fixonlineDB[fixonlineNUM];
		statement.executeUpdate("UPDATE users SET online='1', chardbupdate='1' WHERE chardbupdate='0' AND ID='"+fixonlineID+"'");
		fixonlineNUM++;
		out.println("<br><B>FIX ONLINE ID</b>: "+fixonlineID);
	}
%>
<%
	// Overviews:
	// 
	// Version 011
	// - Added e-Point
	// - Added Error on NULL
	// - Added arrays for ROLES
	// - Added on Broadcast Mode
	// - Added fixing online mode
%>
