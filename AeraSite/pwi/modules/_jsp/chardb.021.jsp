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
<%@page import="java.sql.*" %>
<%@page import="java.sql.Date"%>

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
	out.println("https://marhazk.sytes.net/iweb/chardb.jsp?online=1&counter="+numC+"#_bottom");
%>
">
<META HTTP-EQUIV=Window-target CONTENT=shoutboxform>
</head>
<P><a href="https://marhazk.sytes.net/iweb/chardb.jsp?online=1&counter=<%out.println(numC);%>">Click here to continue to the next session</a>
| <a href="about:blank">BLANK PAGE</a> | <a href="http://localhost/pwuweb/gamemap/?postype=3">Click here to view map</a> | <A href="http://apps.facebook.com/onthefarm">FarmVille</a></P>
<P><% out.println("DB LAST COUNTER: "+numC); %> </p>
<P>DB LAST UPDATED: <%= new java.util.Date() %></p>
<%
	//
	// ORIGINALLY CODED BY MARHAZK (MARHAZK@YAHOO.COM) 
	// SUPPORTED PW-UWEB v3.5 MODULE (www.marhazk.sytes.net/pwuweb)
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
	//	Letter   Date or Time Component   Presentation       Examples
	//	G        Era designator             Text                AD
	//	y        Year                       Year                1996;    96
	//	M        Month in year               Month               July; Jul; 07
	//	w        Week in year               Number               27
	//	W        Week in month               Number               2
	//	D        Day in year               Number               189
	//	d        Day in month               Number               10
	//	F        Day of week in month       Number               2
	//	E        Day in week               Text               Tuesday; Tue
	//	a        Am/pm marker               Text               PM
	//	H        Hour in day (0-23)       Number               0
	//	k        Hour in day (1-24)       Number               24
	//	K        Hour in am/pm (0-11)       Number               0
	//	h        Hour in am/pm (1-12)       Number               12
	//	m        Minute in hour           Number               30
	//	s        Second in minute           Number               55
	//	S        Millisecond                Number               978
	//	z        Time zone                   General time zone   Pacific Standard Time; PST; GMT-08:00
	//	Z        Time zone                  RFC 822 time zone   -0800
	//	
	java.sql.Date now = new java.sql.Date( System.currentTimeMillis() );
	SimpleDateFormat sdf_e = new SimpleDateFormat( "EEE" );		//Tue
	SimpleDateFormat sdf_f = new SimpleDateFormat( "F" );		//2
	SimpleDateFormat sdf_d = new SimpleDateFormat( "dd" );		//04
	SimpleDateFormat sdf_m = new SimpleDateFormat( "MM" );		//09
	SimpleDateFormat sdf_y = new SimpleDateFormat( "yyyy" );	//2009
	SimpleDateFormat sdf_hh = new SimpleDateFormat( "HH" );		//13
	SimpleDateFormat sdf_mm = new SimpleDateFormat( "mm" );		//43
	SimpleDateFormat sdf_ss = new SimpleDateFormat( "ss" );		//23
	
	String snow_e=sdf_e.format(now).toLowerCase();				//toLowerCase or toUpperCase
	int snow_f=Integer.parseInt(sdf_f.format(now));
	int snow_d=Integer.parseInt(sdf_d.format(now));
	int snow_m=Integer.parseInt(sdf_m.format(now));
	int snow_y=Integer.parseInt(sdf_y.format(now));
	int snow_hh=Integer.parseInt(sdf_hh.format(now));
	int snow_mm=Integer.parseInt(sdf_mm.format(now));
	int snow_ss=Integer.parseInt(sdf_ss.format(now));
	
	SimpleDateFormat sdf = new SimpleDateFormat( "dd/MM/yyyy hh:mm:ss" );
	// 07/02/2008 03:22:32
	String snow=sdf.format(now);
	out.println( snow );
	
	Connection connection = null;
    Class.forName("sun.jdbc.odbc.JdbcOdbcDriver");
    connection = DriverManager.getConnection("jdbc:mysql://192.168.1.2/dbo?useUnicode=true&amp;characterEncoding=utf8", "root", "5449");

	Statement statement = connection.createStatement();
	
	
	//
	//CLEAR uwebplayers DATABASE
	//	
	//String deleteall = "DELETE FROM uwebplayers";
	//statement.executeUpdate(deleteall);

	//
	//GET USER DB FIRST
	//
	ResultSet rst=null;
	ResultSet rstx=null;
	ResultSet onlinerst=null;
	ResultSet fixonlinerst=null;
	String msg = "N/A";
	boolean success2 = false;

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
	long templastlogin = 0;
	int templastrid = 0;
	int templastuid = 0;
	int battlepower = 0;
	
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
				statement.executeUpdate("update uwebplayers SET updated='0' WHERE updated='1'");
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
	long hdb[] = new long[totalrole];		//Last Online Date in LONGINT
	int idb[] = new int[totalrole];			//SP
	int jdb[] = new int[totalrole];			//Reputation
	int tempuid = 0;
	int tempaid = 0;
	int tempbid = 0;
	int tempcid = 0;
	int tempdid = 0;
	String tempeid = "noname";
	int tempfid = 0;
	int tempgid = 0;
	long temphid = 0;
	int tempiid = 0;
	int tempjid = 0;

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
		hdb[uid] = 0;
		idb[uid] = 0;
		jdb[uid] = 0;
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
				temphid = 0;
				tempiid = 0;
				tempjid = 0;
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
				hdb[uid] = tempgid;
				idb[uid] = tempiid;
				jdb[uid] = tempjid;
				uid++;
			}
		}
		else
		{
			if( null != strOnline && strOnline.length() > 0 )
			{
				rstx = statement.executeQuery("select ID, realuname, accstat, buyid, pregold, postgold, online, chardbupdate, chardblastonline, sp, rep from users WHERE chardbupdate>=1");
			}
			else
			{
				rstx = statement.executeQuery("select ID, realuname, accstat, buyid, pregold, postgold, online, chardbupdate, chardblastonline, sp, rep from users WHERE system!=1");
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
				temphid = Long.parseLong(rstx.getString("chardblastonline"));
				tempiid = Integer.parseInt(rstx.getString("sp"));
				tempjid = Integer.parseInt(rstx.getString("rep"));
				if (Integer.parseInt(rstx.getString("buyid")) >= 32)
				{
					tempbid = Integer.parseInt(rstx.getString("buyid"));
					tempcid = Integer.parseInt(rstx.getString("postgold"));
					tempdid = Integer.parseInt(rstx.getString("pregold"));
					tempeid = rstx.getString("realuname");
				}
				if (numC == 0)
				{
					out.println("<br>STORED found:"+uid+" RoleID:"+tempuid+" AccStat:"+tempaid);
				}
				
				out.println("<br>BEFORE UPDATE :"+uid+" RoleID:"+tempuid+" UNAME:"+tempeid+" AccStat:"+tempaid);
				udb[uid] = tempuid;
				adb[uid] = tempaid;
				bdb[uid] = tempbid;
				cdb[uid] = tempcid;
				ddb[uid] = tempdid;
				edb[uid] = tempeid;
				fdb[uid] = tempfid;
				gdb[uid] = tempgid;
				hdb[uid] = temphid;
				idb[uid] = tempiid;
				jdb[uid] = tempjid;
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
		temphid = hdb[uid];
		tempiid = idb[uid];
		tempjid = jdb[uid];
		
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
					tempplayername = StringEscapeUtils.escapeHtml(role.base.name.getString()).replaceAll("'","");
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
					
					// ANNOUNCE NEW PLAYER
					if ((tempfid == 40) && (onlineBool == true))
					{
						boolean success = false;
						try {
							out.println("<br><B>ANNOUNCE NEW PLAYER</B>");
							msg = "Welcome to Perfect World:Aera Malaysia, "+tempplayername+". Thank for supporting and joining us.";
							success = DeliveryDB.broadcast((byte)9,-1,msg);
							LogFactory.getLog("broadcast.jsp").info("broadcast.jsp, msg=" + msg + ",result=" + success + ",operator=" + AuthFilter.getRemoteUser(session) );
							statement.executeUpdate("update users SET chardbupdate='"+tempgid+"' WHERE ID='" + tempuid + "'");
						}
						catch (Exception e) { out.println(e.toString()); continue; }
					}
					// BUY GOLD SYSTEM
					if ((tempbid == roleid) && (tempfid == 2) && (tempgid == 0) && (onlineBool == true))
					{
						boolean success = false;
						try {
							statement.executeUpdate("update users SET name='"+tempeid+"', chardbupdate='0', buyid='0', buysuccess='1' WHERE ID='" + tempuid + "'");
							//role.storehouse.money = tempcid;
							role.pocket.money = tempcid;
							role.status.sp = tempiid;
							role.status.reputation = tempjid;
							out.println("<br><B>ROLE SUCCESS UPDATED - BUY POINT/GOLD</B>");
							success = GameDB.update( role );
						}
						catch (Exception e) { out.println(e.toString()); continue; }
					}
					
					// CELESTIAL REBORNING SYSTEM
					if ((tempbid == roleid) && ((tempfid == 32) || (tempfid == 22)) && (tempgid == 0) && (onlineBool == true))
					{
						boolean success = false;
						try {
							statement.executeUpdate("update users SET name='"+tempeid+"', chardbupdate='0', buyid='0', WHERE ID='" + tempuid + "'");
							//role.storehouse.money = tempcid;
							role.pocket.money = tempcid;
							role.status.sp = 0;
							role.status.reputation = tempjid + 100000;
							role.status.level = 1;
							role.ep.agility = 5;
							role.ep.strength = 5;
							role.ep.vitality = 5;
							role.ep.energy = 5;
							role.status.posx = 1295 - 5000;
							role.status.posy = 796 - 5000;
							role.status.posz = 1006 - 5000;
							role.status.pp = 0;
							role.ep.attack = 100;
							if (tempfid == 32)
							{
								role.status.level2 = 20; //Reborn to Holy
								msg = tempplayername+" has been Celestial Reborn to Holy and spawned at Ancient Dragon City West";
							}
							else
							{
								role.status.level2 = 30; //Reborn to Devil
								msg = tempplayername+" has been Celestial Reborn to Daimon and spawned at Ancient Dragon City West";
							}
							success2 = DeliveryDB.broadcast((byte)9,-1,msg);
							LogFactory.getLog("broadcast.jsp").info("broadcast.jsp, msg=" + msg + ",result=" + success2 + ",operator=" + AuthFilter.getRemoteUser(session) );
							out.println("<br><B>ROLE SUCCESS UPDATED - CELESTIAL REBORN</B>");
							success = GameDB.update( role );
						}
						catch (Exception e) { out.println(e.toString()); continue; }
					}					
					byte[] rolenameb = tempplayername.getBytes();
					command = "UPDATE uwebplayers SET updated=1,";
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
					//(int)(($uWeb_rinfo["taskcomplete"]/10000)*500)+(int)($uWeb_rinfo["roleculti"])+(int)($uWeb_rinfo["rolelevel"])+SP/200000000;
					//(int)()
					// QUEST : 9365
					// BP Quest : 4000
					battlepower = 0;
					if (role.task.task_complete.getBytes().length >= 200)
					{
						battlepower = (int)((role.task.task_complete.getBytes().length - 200)/5);
					}
					battlepower = (int)(battlepower)+(int)(role.status.level2)+(int)(role.status.level)+(int)((role.status.sp/200000000)*200)+(int)((role.pocket.money/200000000)*50)+(int)((role.storehouse.money/200000000)*50);
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
					command += " skills='" + role.status.skills.getBytes() + "',";
					command += " taskdatabyte='" + role.task.task_data.getBytes() + "',";
					command += " taskcompletebyte='" + role.task.task_complete.getBytes() + "',";
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
					command += " deltime='" + role.base.delete_time + "',";
					command += " exp='" + role.status.exp + "',";
					command += " pp='" + role.status.pp + "',";
					command += " capacity='" + role.pocket.capacity + "',";
					command += " flight_speed='" + role.ep.flight_speed + "',";
					command += " swim_speed='" + role.ep.swim_speed + "',";
					command += " run_speed='" + role.ep.run_speed + "',";
					command += " walk_speed='" + role.ep.walk_speed + "',";
					command += " hp_gen='" + role.ep.hp_gen + "',";
					command += " mp_gen='" + role.ep.mp_gen + "',";
					command += " max_hp='" + role.ep.max_hp + "',";
					command += " max_mp='" + role.ep.max_mp + "',";
					command += " attack='" + role.ep.attack + "',";
					command += " damage_low='" + role.ep.damage_low + "',";
					command += " damage_high='" + role.ep.damage_high + "',";
					command += " addon_damage_low0='" + role.ep.addon_damage_low[0] + "',";
					command += " addon_damage_low1='" + role.ep.addon_damage_low[1] + "',";
					command += " addon_damage_low2='" + role.ep.addon_damage_low[2] + "',";
					command += " addon_damage_low3='" + role.ep.addon_damage_low[3] + "',";
					command += " addon_damage_low4='" + role.ep.addon_damage_low[4] + "',";
					command += " addon_damage_high0='" + role.ep.addon_damage_high[0] + "',";
					command += " addon_damage_high1='" + role.ep.addon_damage_high[1] + "',";
					command += " addon_damage_high2='" + role.ep.addon_damage_high[2] + "',";
					command += " addon_damage_high3='" + role.ep.addon_damage_high[3] + "',";
					command += " addon_damage_high4='" + role.ep.addon_damage_high[4] + "',";
					command += " damage_magic_low='" + role.ep.damage_magic_low + "',";
					command += " damage_magic_high='" + role.ep.damage_magic_high + "',";
					command += " resistance0='" + role.ep.resistance[0] + "',";
					command += " resistance1='" + role.ep.resistance[1] + "',";
					command += " resistance2='" + role.ep.resistance[2] + "',";
					command += " resistance3='" + role.ep.resistance[3] + "',";
					command += " resistance4='" + role.ep.resistance[4] + "',";
					command += " defense='" + role.ep.defense + "',";
					command += " armor='" + role.ep.armor + "',";
					command += " max_ap='" + role.ep.max_ap + "',";
					command += " battlepower='" + battlepower + "',";
					command += " accstat='" + accstat + "'";
					command += " WHERE roleid='"+roleid+"'";
					statement.executeUpdate(command);
					if (templastuid != tempuid)
					{
						templastuid = tempuid;
						templastlogin = 0;
						templastrid = 0;
					}
					if (role.base.lastlogin_time >= templastlogin)
					{
						templastlogin = (long)role.base.lastlogin_time;
						statement.executeUpdate("update users set chardblastonline='" + templastlogin + "', onlineid='" + roleid + "' WHERE ID='" + tempuid + "'");
					}
					out.println("<br><B>SUCCESS UPDATED:</B> --100% stored RoleDB: AccID: " + tempuid + " Name:" + tempplayername + " Roleid:" + roleid + " Level:" + role.status.level + " CharDB Time: " + role.base.lastlogin_time + " AccDB Time: " + templastlogin);

					//out.println(command);
					
					if (onlineBool == true)
					{
						// TOP ONLINE PLAYERS - BROADCAST ON TOP PLAYER
						if ((role.status.level > top3onlevel) && (role.status.level < 100) && (roleid >= 48))
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
				msg = broadcastrst.getString("bmsg");
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
	////////////////////////////////
	//
	//
	// ON EVENT MODE!!!
	//
	//
	/////////////////////////////////
	try
	{
		String emsg = "N/A";
		String estatus = "true";
		String ename = "N/A";
		boolean esuccess = false;
		ResultSet eventrst=null;
		int eid = 0;
		int eday = 0;
		int ef = 0;
		int ehh = 0;
		int emm = 0;
		int eday_start = 0;
		int ef_start = 0;
		int ehh_start = 0;
		int emm_start = 0;
		int eday_end = 0;
		int ef_end = 0;
		int ehh_end = 0;
		int emm_end = 0;
		int eventnum = 0;
		int eventenable = 0;
		int eventlimit = 0;
		int edouble_exp = 0;
		int edouble_sp = 0;
		int edouble_drop = 0;
		int World = 1;
		String eidgm = "";

		eventrst = statement.executeQuery("SELECT * FROM uWebevents WHERE eauto=1");
		while (eventrst.next())
		{
			eventnum = 0;
			eventlimit = 0;
			eday = 0;
			ef = 0;
			ehh = 0;
			emm = 0;
			eday_start = 0;
			ef_start = 0;
			ehh_start = 0;
			emm_start = 0;
			eday_end = 0;
			ef_end = 0;
			ehh_end = 0;
			emm_end = 0;
			eid = Integer.parseInt(eventrst.getString("eid"));
			eventenable = Integer.parseInt(eventrst.getString("enable"));
			edouble_exp = Integer.parseInt(eventrst.getString("doubleexp"));
			edouble_sp = Integer.parseInt(eventrst.getString("doublesp"));
			edouble_drop = Integer.parseInt(eventrst.getString("doubleitem"));
			emsg = eventrst.getString("bmsg");
			ename = eventrst.getString("name");
			eidgm = "";

			out.println("<br><B>EVENT START CHECKING</b>: ID "+eid);
			if ((emm = Integer.parseInt(eventrst.getString("emm"))) > 0)
			{
				eventlimit++;
				emm_start = Integer.parseInt(eventrst.getString("emm_start"));
				emm_end = Integer.parseInt(eventrst.getString("emm_end"));
			}
			if ((ehh = Integer.parseInt(eventrst.getString("ehh"))) > 0)
			{
				eventlimit++;
				ehh_start = Integer.parseInt(eventrst.getString("ehh_start"));
				ehh_end = Integer.parseInt(eventrst.getString("ehh_end"));
			}
			if ((eday = Integer.parseInt(eventrst.getString("eday"))) > 0)
			{
				eventlimit++;
				eday_start = Integer.parseInt(eventrst.getString("eday_start"));
				eday_end = Integer.parseInt(eventrst.getString("eday_end"));
			}
			if ((ef = Integer.parseInt(eventrst.getString("ef"))) > 0)
			{
				eventlimit++;
				ef_start = Integer.parseInt(eventrst.getString("ef_start"));
				ef_end = Integer.parseInt(eventrst.getString("ef_end"));
			}
			try {
				eidgm = eventrst.getString("eidgm");
			}
			catch (Exception e)
			{
				eidgm = "";
			}
			if (eventenable == 0)
			{
				if ((snow_mm == emm_start) && (emm == 1))
					eventnum++;
				if ((snow_hh == ehh_start) && (ehh == 1))
					eventnum++;
				if ((snow_d == eday_start) && (eday == 1))
					eventnum++;
				if ((snow_f == ef_start) && (ef == 1))
					eventnum++;
				out.println("<br><B>EVENT CHECKED</b>: ID "+eid+" Requires: "+eventnum+" out of "+eventlimit+" : (CURRENT: D"+snow_d+" FDay"+snow_f+" HH:MM "+snow_hh+":"+snow_mm+") (STARTED: D"+eday_start+" FDay "+ef_start+" HH:MM "+ehh_start+":"+emm_start+")");
				if (eventnum == eventlimit)
				{
					eventenable = 1;
					esuccess = DeliveryDB.broadcast((byte)9,-1,emsg);
					LogFactory.getLog("broadcast.jsp").info("broadcast.jsp, msg=" + emsg + ",result=" + esuccess + ",operator=" + AuthFilter.getRemoteUser(session) );
					out.println("<br><B>EVENT BROARCASTED</b>: "+emsg);
					if (edouble_drop == 1)
						esuccess = DeliveryDB.GMSetDoubleObject( estatus.equals("true") );
					if (edouble_sp == 1)
						esuccess = DeliveryDB.GMSetDoubleSP( estatus.equals("true") );
					if (edouble_exp == 1)
						esuccess = DeliveryDB.GMSetDoubleExp( estatus.equals("true") );
					if (eidgm.length() > 0 )
					{
						try {
							protocol.DeliveryDB.GMControlGame(World, eidgm);
						}
						catch (Exception e)
						{
							out.println("<font color=red>Error occured Attempting to activate the event!</font>");
						}
					}
					break;
				}
			}
			if (eventenable == 1)
			{
				if ((snow_mm == emm_end) && (emm == 1))
					eventnum++;
				if ((snow_hh == ehh_end) && (ehh == 1))
					eventnum++;
				if ((snow_d == eday_end) && (eday == 1))
					eventnum++;
				if ((snow_f == ef_end) && (ef == 1))
					eventnum++;
				out.println("<br><B>EVENT CHECKED</b>: ID "+eid+" Requires: "+eventnum+" out of "+eventlimit+" : (CURRENT: D"+snow_d+" HH:MM "+snow_hh+":"+snow_mm+") (ENDED: D"+eday_end+" HH:MM "+ehh_end+":"+emm_end+")");
				estatus = "true";
				if (edouble_drop == 1)
					esuccess = DeliveryDB.GMSetDoubleObject( estatus.equals("true") );
				if (edouble_sp == 1)
					esuccess = DeliveryDB.GMSetDoubleSP( estatus.equals("true") );
				if (edouble_exp == 1)
					esuccess = DeliveryDB.GMSetDoubleExp( estatus.equals("true") );
				if (eventnum == eventlimit)
				{
					eventenable = 0;
					estatus = "false";
					emsg = "AUTO: "+ename+" has ended. Thanks for joining us.";
					esuccess = DeliveryDB.broadcast((byte)9,-1,emsg);
					LogFactory.getLog("broadcast.jsp").info("broadcast.jsp, msg=" + emsg + ",result=" + esuccess + ",operator=" + AuthFilter.getRemoteUser(session) );
					out.println("<br><B>EVENT BROARCASTED</b>: "+emsg);
					if (edouble_drop == 1)
						esuccess = DeliveryDB.GMSetDoubleObject( estatus.equals("true") );
					if (edouble_sp == 1)
						esuccess = DeliveryDB.GMSetDoubleSP( estatus.equals("true") );
					if (edouble_exp == 1)
						esuccess = DeliveryDB.GMSetDoubleExp( estatus.equals("true") );
					if (eidgm.length() > 0 )
					{
						try {
							protocol.DeliveryDB.GMControlGame(World, eidgm);
						}
						catch (Exception e)
						{
							out.println("<font color=red>Error occured Attempting to activate the event!</font>");
						}
					}
					break;
				}
			}
		}
		if (eventnum == eventlimit)
		{
			statement.executeUpdate("UPDATE uWebevents SET enable='"+eventenable+"' WHERE eid='"+eid+"'");
		}
	}
	catch (Exception e)
	{
		out.println("<br><B>EVENT FAILED</b>: "+e);	
	}

%>
<center>
<a name=_bottom>Copyright by MarHazK</a>
</center>
<%
	// Overviews:
	// Version 022 (16-June-12)
	// Version 021 (13-June-12)
	// Version 020 (13-June-12)
	// Version 019 (0)
	// Version 018 (23-May-12) 
	//
	// Version 013 (28-Sept-09)
	// - Auto On Server event if event is restarted
	//
	// Version 012 (12-Sept-09)
	// - Added Event Broadcasting
	//
	// Version 011 (04-Sept-09)
	// - Added e-Point
	// - Added Error on NULL
	// - Added arrays for ROLES
	// - Added on Broadcast Mode
	// - Added fixing online mode
%>
