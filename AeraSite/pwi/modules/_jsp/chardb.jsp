        <%	// FOLDER: /opt/jakarta-tomcat-5.5.9/webapps/iweb %>
            <%@ page contentType="text/html; charset=UTF-8" %>
            <%@page import="java.lang.*" %>
            <%@page import="java.util.*" %>
            <%@page import="java.text.*" %>
            <%@page import="org.apache.commons.lang.StringEscapeUtils" %>
            <%@page import="org.apache.commons.logging.LogFactory" %>
            <%@page import="org.apache.commons.logging.Log" %>
            <%@page import="protocol.*" %>
            <%@ page import="protocol.GRoleInventory" %>
            <%@ page import="protocol.RoleBean" %>
            <%@ page import="protocol.RoleInfo" %>
            <%@ page import="protocol.DeliveryDB" %>
            <%@ page import="protocol.GameDB" %>
            <%@ page import="protocol.XmlRole" %>
            <%@ page import="protocol.XmlRoleBase" %>
            <%@ page import="com.goldhuman.auth.*" %>
            <%@ page import="com.goldhuman.auth.AuthFilter" %>
            <%@ page import="com.goldhuman.service.interfaces.LogInfo" %>
            <%@ page import="com.goldhuman.service.interfaces.SimpleRoleBean" %>
            <%@ page import="com.goldhuman.service.interfaces.GMService" %>
            <%@ page import="com.goldhuman.service.GMServiceImpl" %>
            <%@ page import="com.goldhuman.util.LocaleUtil" %>
            <%@page import="java.sql.*" %>
            <%@page import="java.sql.Date" %>
            <%@ page import="java.sql.*,java.net.*,java.io.*,java.lang.*,java.util.*" %>
            <%@page import="org.apache.commons.codec.binary.Base64" %>
            <%@page import="java.io.*" %>
            <%@page import="java.util.zip.*"%>
            <%@page import="java.util.List"%>
            <html><head>
            </head>
            <P>DB LAST UPDATED:<%= new java.util.Date() %></p>
                <%
	//
	// ORIGINALLY CODED BY MARHAZK (MARHAZK@YAHOO.COM) 
	// SUPPORTED PW-uweb v3.5 MODULE (www.marhazk.sytes.net/pwuweb)
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
	SimpleDateFormat _sqldate = new SimpleDateFormat( "yyyy-MM-dd HH:mm:ss" );
	// 07/02/2008 03:22:32
	String snow=sdf.format(now);
	String sqldate=_sqldate.format(now);
	out.println( snow );
	
	Connection connection = null;
    Class.forName("sun.jdbc.odbc.JdbcOdbcDriver");
    connection = DriverManager.getConnection("jdbc:mysql://192.168.1.5/dbo?useUnicode=true&amp;characterEncoding=UTF-8", "aera", "870830");

	Statement statement = connection.createStatement();
	

    DeliveryDB.init();
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

	boolean itemBool = false;
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
	String tempplayername = null;
	int tempplayernamenum = 0;
	String command = null;
	double posx = 0;
	double posy = 0;
	double posz = 0;
	int index = 0;
	int total = 0;
	int maxid = 0;
	int roleid = 0;
	int userid = 0;
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

	String sqldata;
	String sqldatacomplete;
	String sqltype;

	int ChatRole[] = new int[1];
	ChatRole[0] = 1024;
	int ChatRoleTotal = 0;
	int RoleDB0[];
	int RoleDB1[];
	int RoleDB2[];
	int RoleDB3[];
	int RoleDB4[];
	int RoleDB5[];
	int RoleDB6[];
	int RoleDB7[];
	int RoleDB8[];
	String SRoleDB0[];
	String SRoleDB1[];
	String SRoleDB2[];
	String SRoleDB3[];
	String SRoleDB4[];
	String SRoleDB5[];
	String SRoleDB6[];
	String SRoleDB7[];
	String SRoleDB8[];
	int battlepower_max[];
	int battlepower_min[];
	int battlepower_full[];
	int flag = -1;

	GMService gs = new GMServiceImpl();
	LogInfo info = null;
	RoleBean role = null;
	RoleBean crbrole = null;


    Iterator itr;
    GRoleInventory grp;

	PrivateChat pchat;

	/////////////////////////////
	// EXECUTE ALL SQL BEFORE START
	// COMPLETED VERSION
	/////////////////////////////
	//
	try
	{
	    statement.executeUpdate("UPDATE roles r, factionusers fu, factions f SET r.guildname=f.fname WHERE fu.rid=r.roleid AND f.fid=fu.fid;");
	}
	catch (Exception e)
	{
		out.println("<br><B>FAIL SQL: "+e+"</B>");
	}


	/////////////////////////////
	// UPDATE ROLES ONLINE through GAMEDBD
	// COMPLETED VERSION
	/////////////////////////////
	//
	try
	{
		/////////////////////////////
		//UPDATE ROLES ONLINE
		/////////////////////////////
		//
		String names = "";
		rst = statement.executeQuery("SELECT * FROM users WHERE online=1");
		total = 0;
		while (rst.next())
		{
		    total++;
		}


		RoleDB0 = new int[total];
		ChatRoleTotal = total;
		ChatRole = new int[total];
		rst = statement.executeQuery("SELECT * FROM users WHERE online=1;");
		index = 0;
		while (rst.next())
		{
		    try
		    {
                RoleDB0[index] = Integer.parseInt(rst.getString("ID"));
    			index++;
			}
            catch (Exception e)
            {
                out.println("<br><B>FAIL BP: "+e+"</B>");
            }
		}

		for (index = 0; index < total; index++)
		{
			int _uid = RoleDB0[index];
			int _roleid = 0;
			info = null;
			gs = new GMServiceImpl();
			info = new LogInfo(_uid, "", "What?");
			Vector v = gs.getRolelist(_uid, info);
			if (v != null)
			{
			    for (int i = 0; i < v.size(); i++)
			    {
			        SimpleRoleBean bean = (SimpleRoleBean) v.get(i);
			        _roleid = bean.roleid;
			        RoleBean _role = GameDB.get( _roleid );

			        //RETRIEVING DATA
                    try
                    {
                        //
                        //
                        // STORING INTO MYSQL
                        //
                        //
                        int _level = _role.status.level;
                        if (_level >= 150)
                            _level = 150;
                        String[] rolesAttr = {
                            "roleid",
                            "userid",
                            "name",
                            "lastlogin2",
                            "level",
                            "level2",
                            "reputation",
                            "occupation",
                            "gender"
                            };
                        String[] rolesVals = {
                            Integer.toString(_roleid),
                            Integer.toString(_uid),
                            _role.base.name.getString().replace("\"", "").replace("'", "`"),
                            Integer.toString(_role.base.lastlogin_time),
                            Integer.toString(_level),
                            Integer.toString(_role.status.level2),
                            Integer.toString(_role.status.reputation),
                            Integer.toString(_role.base.cls),
                            Integer.toString(_role.base.gender)
                            };
                        String temp3 = "";
                        String temp4 = "";
                        String temp5 = "";
                        String tempsql = "";
                        int rolesIndex = 0;

                        for (String _att : rolesAttr)
                        {
                            if (rolesIndex >= 1)
                            {
                                temp3 += ", ";
                                temp4 += ", ";
                                temp5 += ", ";
                            }
                            temp3 += _att + "=VALUES("+_att+")";
                            temp4 += _att;
                            temp5 += "'" + rolesVals[rolesIndex] + "'";
                            rolesIndex++;
                        }
                        tempsql = "INSERT INTO roles (" + temp4 + ") VALUES (" + temp5 + ") ON DUPLICATE KEY UPDATE " + temp3 + ";";
                        try
                        {
                            //out.println();
                            names += "<BR>"+rolesVals[2]+":"+_roleid+" ";
                            statement.executeUpdate(tempsql);

                            //
                            /////////////////////////////
                            //CHECK EITHER ONLINE OR NOT
                            /////////////////////////////
                            //
                            flag = -1;
            				flag = gs.getRoleLogStatus(_roleid, info);
            				if (flag >= 1)
            				{
                                int chkex = statement.executeUpdate("UPDATE roles SET online=1, online2=1 WHERE (online2=0 OR online2<=1) AND roleid="+_roleid);
                                names += " (ON) SQL:"+_role.status.reputation;
                                ChatRole[index] = _roleid;
            				}
            				else
            				{
                                statement.executeUpdate("UPDATE roles SET online2=0 WHERE roleid="+_roleid);
                                names += " (OFF) ";
            				}
                        }
                        catch (Exception e)
                        {
                            out.println("<BR>ERROR SQL: " + e + " <BR>" + tempsql);
                        }
                    }
                    catch (Exception e)
                    {
                        statement.executeUpdate("UPDATE roles SET failrole=1001 WHERE roleid="+_roleid);
                        out.println("<br><B>FAIL UPDATE "+_roleid+" ROLES: "+e+"</B>");
                    }
                }
			}
		}
		out.println("<br><B>TOTAL ONLINE ROLES: "+total+"</B> :"+names);
	}
	catch (Exception e)
	{
		out.println("<br><B>FAIL ONLINE ROLES: "+e+"</B>");
	}

	/////////////////////////////
	// UPDATE ROLES ONLINE
	/////////////////////////////
	//
	try
	{
		/////////////////////////////
		//UPDATE ROLES ONLINE
		/////////////////////////////
		//
		String names = "";
		rst = statement.executeQuery("SELECT r.*, g.name AS gname, o.name AS oname, c.name as cname FROM cultivations c, roles r, gender g, occupations o WHERE c.id=r.level2 AND o.id=r.occupation AND g.id=r.gender AND r.roleid>=1 AND r.online=1 AND r.online2>=1;");
		//rst = statement.executeQuery("SELECT r.*, f.fname, g.name AS gname, o.name AS oname, c.name as cname FROM cultivations c, roles r, factions f, factionusers fu, gender g, occupations o WHERE c.id=r.level2 AND o.id=r.occupation AND g.id=r.gender AND r.roleid>=1 AND r.online=1 AND r.online2>=1 AND f.fid=fu.fid AND fu.rid=r.roleid;");
		total = 0;
		while (rst.next())
		{
		    total++;
		}


		RoleDB0 = new int[total];
		RoleDB1 = new int[total];
		RoleDB2 = new int[total];
		RoleDB3 = new int[total];
		RoleDB4 = new int[total];
		RoleDB5 = new int[total];
		RoleDB6 = new int[total];
		RoleDB7 = new int[total];
		//SRoleDB0 = new String[total];
		SRoleDB1 = new String[total];
		SRoleDB2 = new String[total];
		SRoleDB3 = new String[total];
		SRoleDB4 = new String[total];
		SRoleDB5 = new String[total];
		SRoleDB6 = new String[total];
		SRoleDB7 = new String[total];
	    battlepower_max = new int[total];
	    battlepower_min = new int[total];
        battlepower_full = new int[total];
		rst = statement.executeQuery("SELECT r.*, g.name AS gname, o.name AS oname, c.name as cname FROM cultivations c, roles r, gender g, occupations o WHERE c.id=r.level2 AND o.id=r.occupation AND g.id=r.gender AND r.roleid>=1 AND r.online=1 AND r.online2>=1;");
		//rst = statement.executeQuery("SELECT r.*, f.fname, g.name AS gname, o.name AS oname, c.name as cname FROM cultivations c, roles r, factions f, factionusers fu, gender g, occupations o WHERE c.id=r.level2 AND o.id=r.occupation AND g.id=r.gender AND r.roleid>=1 AND r.online=1 AND r.online2>=1 AND f.fid=fu.fid AND fu.rid=r.roleid;");
		index = 0;
		while (rst.next())
		{
		    try
		    {
                RoleDB0[index] = Integer.parseInt(rst.getString("roleid"));
                RoleDB1[index] = Integer.parseInt(rst.getString("userid"));
                RoleDB2[index] = Integer.parseInt(rst.getString("reborn"));
                RoleDB3[index] = Integer.parseInt(rst.getString("level2"));
                RoleDB4[index] = Integer.parseInt(rst.getString("level3"));
                RoleDB5[index] = Integer.parseInt(rst.getString("online2"));
                RoleDB6[index] = Integer.parseInt(rst.getString("level"));
                RoleDB7[index] = Math.round(Float.parseFloat(rst.getString("bounty")));
                //SRoleDB0[index] = rst.getString("fname");
                SRoleDB1[index] = rst.getString("cname");
                SRoleDB2[index] = rst.getString("gname");
                SRoleDB3[index] = rst.getString("oname");
                SRoleDB4[index] = rst.getString("oname");
                SRoleDB5[index] = rst.getString("battlepowerlvl");
                SRoleDB6[index] = rst.getString("battlepowerpct");
                SRoleDB7[index] = rst.getString("guildname");
    			index++;
			}
            catch (Exception e)
            {
                out.println("<br><B>FAIL BP: "+e+"</B>");
            }
		}

		for (index = 0; index < total; index++)
		{
			int _roleid = RoleDB0[index];
			int _userid = RoleDB1[index];
			int _reborn = RoleDB2[index];
			int _level2 = RoleDB3[index];
			int _level3 = RoleDB4[index];
			int _online = RoleDB5[index];
			int _level = RoleDB6[index];
			if ((SRoleDB7[index] == null) || (SRoleDB7[index] == "null"))
			    SRoleDB7[index] = "";
			try
			{
                RoleBean _role = GameDB.get( _roleid );
                //out.println("<br><B>UPDATING ROLE: "+_roleid+"</B>");
                if (null == _role)
                {
                    statement.executeUpdate("DELETE FROM roles WHERE roleid="+_roleid);
                    continue;
                }
                else
                {
                    //RETRIEVING DATA
                    String _tcomplete = (_role.task.task_complete).toString();
                    String tcompletedb[] = _tcomplete.split("=");
                    String tcomplete = tcompletedb[1];
                    int battlepower_task = Integer.parseInt(tcomplete);
                    int battlepower_lvl1 = _role.status.level;
                    int battlepower_lvl2 = _level2;
                    int battlepower_lvl3 = _level3;

                    /// CALCULATING BP
                    int value_max = (int)(battlepower_task + 1) * (_reborn + 1);
                    int value_sqmax = (int)(Math.sqrt(value_max));
                    int value_min = (int)(battlepower_max[index]/2);

                    //RESULT BP
                    battlepower_min[index] = (int)(Math.sqrt(value_min));
                    battlepower_max[index] = value_sqmax;
                    battlepower_full[index] = (battlepower_max[index]) * (battlepower_task+(battlepower_lvl1+battlepower_lvl2+battlepower_lvl3));

                    try
                    {
                        String tempsql = "";
                        String modetype = "";
                        try
                        {
                            if ((_online == 1) && (_online != 2))
                            {
                                tempsql = "UPDATE roles SET online2=2 WHERE roleid="+_roleid+";";
                                try
                                {
                                    //out.println();
                                    statement.executeUpdate(tempsql);

                                    if (_roleid >= 1028)
                                    {
                                        if (_reborn >= 1)
                                            modetype = "(PvE, CRB)";
                                        else if (_level >= 150)
                                            modetype = "(PvP, Non-CRB)";
                                        else
                                            modetype = "(NEW PLAYER)";

                                        String xemsg2 = "Welcome, "+_role.base.name.getString().replaceAll("'","")+"! | LEVEL: "+_level+" | MODE: "+modetype+" | CLASS: "+SRoleDB3[index]+" | CULTIVATION: "+SRoleDB1[index]+" | GENDER: "+SRoleDB2[index]+" | BP LEVEL: "+SRoleDB5[index]+" | BP EXP: "+SRoleDB6[index]+"% | BOUNTY: "+RoleDB7[index]+" | GUILD: "+SRoleDB7[index];
                                        boolean xesuccess2 = DeliveryDB.broadcast((byte)9,-1,xemsg2);
                                    }
                                }
                                catch (Exception e)
                                {
                                    out.println("<BR>ERROR SQL: " + e + " <BR>" + tempsql);
                                }
                            }
                            if ((_role.status.reputation >= 1000000) && (_reborn == 0))
                            {
                                statement.executeUpdate("UPDATE roles SET reborn=3 WHERE roleid="+_roleid);
                                String xemsg = _role.base.name.getString().replaceAll("'","")+" has successfully made his/her Celestial Reborn (PvE / Questing Mode)!";
                                boolean xesuccess = DeliveryDB.broadcast((byte)9,-1,xemsg);
                            }
                        }
                        catch (Exception e)
                        {
                            out.println("<BR>ERROR SQL: " + e + " <BR>" + tempsql);
                        }
                    }
                    catch (Exception e)
                    {
                        statement.executeUpdate("UPDATE roles SET failrole=1001 WHERE roleid="+_roleid);
                        out.println("<br><B>FAIL UPDATE "+_roleid+" ROLES: "+e+"</B>");
                    }
                }
			}
            catch (Exception e)
            {
                statement.executeUpdate("UPDATE roles SET failrole=1000 WHERE roleid="+_roleid);
                out.println("<br><B>FAIL RETRIEVE ROLES: "+e+"</B>");
            }
		}
		out.println("<br><B>TOTAL ONUPDATE ROLES: "+total+"</B> :"+names);
	}
	catch (Exception e)
	{
		out.println("<br><B>FAIL ROLES: "+e+"</B>");
	}
	/////////////////////////////
	// RESTORE FROM XML TO GAMEDB
	/////////////////////////////
	//
	sqldata = "SELECT * FROM rolesxml WHERE restore=1";
	sqldatacomplete = "UPDATE rolesxml SET restore=0 WHERE restore=1";
	sqltype = "XMLRESTORE";
    try
	{
		rst = statement.executeQuery(sqldata);
		total = 0;
		while (rst.next())
		{
		    total++;
		}
		RoleDB0 = new int[total];
		RoleDB1 = new int[total];
		SRoleDB0 = new String[total];
		rst = statement.executeQuery(sqldata);
		index = 0;
		while (rst.next())
		{
		    try
		    {
                RoleDB0[index] = Integer.parseInt(rst.getString("roleid"));
                RoleDB1[index] = Integer.parseInt(rst.getString("xid"));
                SRoleDB0[index] = rst.getString("xml");
    			index++;
			}
            catch (Exception e)
            {
                out.println("<br><B>FAIL "+sqltype+": "+e+"</B>");
            }
		}

		for (index = 0; index < total; index++)
		{
			try
			{
                int _roleid = RoleDB0[index];
                int _xid = RoleDB1[index];
                String xmlstring = SRoleDB0[index];

                boolean success = false;
                XmlRole.Role _role = XmlRole.fromXML( xmlstring.getBytes("UTF-8") );
                _role.base.id = _roleid;
                success = XmlRole.putRoleToDB( _roleid, _role );

			}
            catch (Exception e)
            {
                out.println("<br><B>FAIL "+sqltype+"-RETRIEVE ROLES: "+e+"</B>");
            }
		}
		out.println("<br><B>TOTAL "+sqltype+": "+total+"</B>");
		statement.executeUpdate(sqldatacomplete);
	}
	catch (Exception e)
	{
		out.println("<br><B>FAIL "+sqltype+": "+e+"</B>");
	}

	/////////////////////////////
	// EXPORT TO XML
	/////////////////////////////
	//

	sqldata = "SELECT * FROM roles WHERE xmlexport=1 OR xmlexport=3 OR xmlexport=5 OR xmlexport=7 OR (xmlexport>=100 AND xmlexport<=900);";
	sqldatacomplete = "UPDATE roles SET xmlexport=(xmlexport+1), xmlexportdate='"+sqldate+"' WHERE xmlexport=1 OR xmlexport=3 OR xmlexport=5 OR xmlexport=7 OR (xmlexport>=100 AND xmlexport<=900);";
	sqltype = "XML";
    try
	{
		rst = statement.executeQuery(sqldata);
		total = 0;
		while (rst.next())
		{
		    total++;
		}
		RoleDB0 = new int[total];
		RoleDB1 = new int[total];
		rst = statement.executeQuery(sqldata);
		index = 0;
		while (rst.next())
		{
		    try
		    {
                RoleDB0[index] = Integer.parseInt(rst.getString("roleid"));
                RoleDB1[index] = Integer.parseInt(rst.getString("xmlexport"));
    			index++;
			}
            catch (Exception e)
            {
                out.println("<br><B>FAIL "+sqltype+": "+e+"</B>");
            }
		}

		for (index = 0; index < total; index++)
		{
			try
			{
			    com.goldhuman.Common.Octets.setDefaultCharset("UTF-16LE");
                int _roleid = RoleDB0[index];
                int _xmlid = RoleDB1[index];

                String xmlstring = null;
                byte[] xmlbytes = null;
                try{
                    XmlRole.Role _xmlrole = XmlRole.getRoleFromDB(_roleid);
                    if( null == _xmlrole )
                    {
                        out.println(LocaleUtil.getMessage(request,"role_modrolexml_retry"));
                        continue;
                    }
                    xmlbytes = XmlRole.toXMLByteArray(_xmlrole);
                    if( null == xmlbytes )
                    {
                        out.println(LocaleUtil.getMessage(request,"role_modrolexml_failtoxml"));
                        continue;
                    }
                    xmlstring = new String( xmlbytes, "UTF-8" );
                }
                catch (Exception e) { out.println(e.toString()); continue; }

                RoleBean _role = GameDB.get( _roleid );
                if (null == _role)
                {
                    statement.executeUpdate("DELETE FROM roles WHERE roleid="+_roleid);
                }

                String xmlidType = "";
                if (_xmlid == 900)
                    xmlidType = "SERVERON";
                else if (_xmlid == 3)
                    xmlidType = "PLAYERON";
                else if (_xmlid == 5)
                    xmlidType = "PLAYEROFF";
                else if (_xmlid == 7)
                    xmlidType = "USERREQUEST";
                else
                    xmlidType = "";
                byte[] encodedBytes = Base64.encodeBase64(xmlstring.getBytes());
                String msgout= "";
                String xml64 = new String(encodedBytes);
                String tempsql = "INSERT INTO rolesxml (roleid, xml, xml64, lastadded, xtype, xname, xlevel, xlevel2) VALUES ('" +_roleid+ "', '"+xmlstring+"', '"+xml64+"', '"+sqldate+"', '"+xmlidType+"', '"+_role.base.name.getString().replace("\"", "").replace("'", "`")+"', '"+_role.status.level+"', '"+_role.status.level2+"');";

                try
                {
                    statement.executeUpdate(tempsql);
                }
                catch (Exception e)
                {
                    statement.executeUpdate("UPDATE roles SET xmlexport=2 WHERE roleid=" +_roleid);
                    out.println("<br><B>FAIL "+sqltype+"-RETRIEVE ROLES: "+e+"</B>");
                }
			}
            catch (Exception e)
            {
                out.println("<br><B>FAIL "+sqltype+"-RETRIEVE ROLES: "+e+"</B>");
            }
		}
		out.println("<br><B>TOTAL "+sqltype+": "+total+"</B>");
		statement.executeUpdate(sqldatacomplete);
	}
	catch (Exception e)
	{
		out.println("<br><B>FAIL "+sqltype+": "+e+"</B>");
	}


	try
	{
		/////////////////////////////
		//SELECT from roles db - UPDATE ROLES BP
		/////////////////////////////
		//
		statement.executeUpdate("UPDATE roles SET battlepower=(task_complete_size+level), battlepowerlvl=FLOOR(SQRT(task_complete_size+level)), battlepowerpct=ROUND(((((task_complete_size+level)-(FLOOR(SQRT(task_complete_size+level))*FLOOR(SQRT(task_complete_size+level))))/((FLOOR(SQRT(task_complete_size+level)+1)*FLOOR(SQRT(task_complete_size+level)+1))-(FLOOR(SQRT(task_complete_size+level))*FLOOR(SQRT(task_complete_size+level)))))*100),2);");

		/*
		((SQRT(task_complete_size+level)+1)*(SQRT(task_complete_size+level)+1)) 27*27
		(task_complete_size+level)
		(SQRT(task_complete_size+level)*SQRT(task_complete_size+level)) 26*26

		((((task_complete_size+level)-(SQRT(task_complete_size+level)*SQRT(task_complete_size+level)))/(((SQRT(task_complete_size+level)+1)*(SQRT(task_complete_size+level)+1))-(SQRT(task_complete_size+level)*SQRT(task_complete_size+level))))*100)
		(((-)/(-))*100)
		*/

        statement.executeUpdate("UPDATE inventories i, roles r SET i.sync=0 WHERE i.roleid=r.roleid AND r.roleid>=1 AND r.updating=1 AND failrole=0 AND r.online=0 AND r.online2=0;");
		rst = statement.executeQuery("SELECT * FROM roles WHERE roleid>=1 AND updating=1 AND online=0 AND online2=0");
		total = 0;
		while (rst.next())
		{
		    total++;
		}


		RoleDB0 = new int[total];
		RoleDB1 = new int[total];
		RoleDB2 = new int[total];
		RoleDB3 = new int[total];
		RoleDB4 = new int[total];
	    battlepower_max = new int[total];
	    battlepower_min = new int[total];
        battlepower_full = new int[total];
		rst = statement.executeQuery("SELECT * FROM roles WHERE roleid>=1 AND updating=1 AND online=0 AND online2=0");
		index = 0;
		while (rst.next())
		{
		    try
		    {
                RoleDB0[index] = Integer.parseInt(rst.getString("roleid"));
                RoleDB1[index] = Integer.parseInt(rst.getString("userid"));
                RoleDB2[index] = Integer.parseInt(rst.getString("reborn"));
                RoleDB3[index] = Integer.parseInt(rst.getString("level2"));
                RoleDB4[index] = Integer.parseInt(rst.getString("level3"));
    			index++;
			}
            catch (Exception e)
            {
                out.println("<br><B>FAIL BP: "+e+"</B>");
            }
		}

		for (index = 0; index < total; index++)
		{
			int _roleid = RoleDB0[index];
			int _userid = RoleDB1[index];
			int _reborn = RoleDB2[index];
			int _level2 = RoleDB3[index];
			int _level3 = RoleDB4[index];
			try
			{
                RoleBean _role = GameDB.get( _roleid );
                if (null == _role)
                {
                    statement.executeUpdate("DELETE FROM roles WHERE roleid="+_roleid);
                    continue;
                }
                else
                {
                    //RETRIEVING DATA
                    //out.println("<br><B>ROLE: "+_roleid+" "+_role.base.name.getString().replace("\"", "").replace("'", "`")+"</B>");
                    String _tcomplete = (_role.task.task_complete).toString();
                    String tcompletedb[] = _tcomplete.split("=");
                    String tcomplete = tcompletedb[1];
                    int battlepower_task = Integer.parseInt(tcomplete);
                    int battlepower_lvl1 = _role.status.level;
                    int battlepower_lvl2 = _level2;
                    int battlepower_lvl3 = _level3;

                    /// CALCULATING BP
                    int value_max = (int)(battlepower_task + 1) * (_reborn + 1);
                    int value_sqmax = (int)(Math.sqrt(value_max));
                    int value_min = (int)(battlepower_max[index]/2);

                    //RESULT BP
                    battlepower_min[index] = (int)(Math.sqrt(value_min));
                    battlepower_max[index] = value_sqmax;
                    battlepower_full[index] = (battlepower_max[index]) * (battlepower_task+(battlepower_lvl1+battlepower_lvl2+battlepower_lvl3));

                    battlepower_full[index] = (int)(Math.sqrt(battlepower_full[index]))*(_reborn+1);

                    //UPDATING BPs
                    out.println("<br><B>Updating role: "+_roleid+" : "+StringEscapeUtils.escapeHtml(_role.base.name.getString()).replaceAll("'","")+" (L"+_role.status.level+")- BP Full: " + battlepower_full[index] + " Max: " + battlepower_max[index] + " Min: " + battlepower_max[index] + "</B>");
                    _role.ep.addon_damage_low[0]	= battlepower_full[index];
                    _role.ep.addon_damage_high[0]	= battlepower_full[index];
                    _role.ep.addon_damage_low[1]	= battlepower_full[index];
                    _role.ep.addon_damage_high[1]	= battlepower_full[index];
                    _role.ep.addon_damage_low[2]	= battlepower_full[index];
                    _role.ep.addon_damage_high[2]	= battlepower_full[index];
                    _role.ep.addon_damage_low[3]	= battlepower_full[index];
                    _role.ep.addon_damage_high[3]	= battlepower_full[index];
                    _role.ep.addon_damage_low[4]	= battlepower_full[index];
                    _role.ep.addon_damage_high[4]	= battlepower_full[index];

                    _role.ep.resistance[0]	        = battlepower_max[index];
                    _role.ep.resistance[1]	        = battlepower_max[index];
                    _role.ep.resistance[2]	        = battlepower_max[index];
                    _role.ep.resistance[3]	        = battlepower_max[index];
                    _role.ep.resistance[4]	        = battlepower_max[index];

                    _role.ep.defense                = battlepower_min[index];
                    _role.ep.armor                  = battlepower_min[index];
                    _role.ep.attack		            = battlepower_full[index];
                    boolean success = false;
                    try
                    {
                        success = GameDB.update(_role);

                        //
                        //
                        // STORING INTO MYSQL
                        //
                        //
                        int _level = _role.status.level;
                        if (_level >= 150)
                            _level = 150;
                        String[] rolesAttr = {
                            "roleid",
                            "userid",
                            "name",
                            "lastlogin2",
                            "level",
                            "level2"
                            };
                        String[] rolesVals = {
                            Integer.toString(_roleid),
                            Integer.toString(_userid),
                            _role.base.name.getString().replace("\"", "").replace("'", "`"),
                            Integer.toString(_role.base.lastlogin_time),
                            Integer.toString(_level),
                            Integer.toString(_role.status.level2)
                            };
                        String temp3 = "";
                        String temp4 = "";
                        String temp5 = "";
                        String tempsql = "";
                        int rolesIndex = 0;

                        for (String _att : rolesAttr)
                        {
                            if (rolesIndex >= 1)
                            {
                                temp3 += ", ";
                                temp4 += ", ";
                                temp5 += ", ";
                            }
                            temp3 += _att + "=VALUES("+_att+")";
                            temp4 += _att;
                            temp5 += "'" + rolesVals[rolesIndex] + "'";
                            rolesIndex++;
                        }
                        tempsql = "INSERT INTO roles (" + temp4 + ") VALUES (" + temp5 + ") ON DUPLICATE KEY UPDATE " + temp3 + ";";
                        try
                        {
                            out.println("<BR> UPDATE BP : "+battlepower_full[index]);
                            statement.executeUpdate(tempsql);
                        }
                        catch (Exception e)
                        {
                            out.println("<BR>ERROR SQL: " + e + " <BR>" + tempsql);
                        }

                        if(_role.equipment != null)
                        {
                            itr = _role.equipment.iterator();
                            while(itr.hasNext())
                            {
                                grp = (GRoleInventory)itr.next();
                                try
                                {
                                    statement.executeUpdate("INSERT INTO inventories (roleid,userid,itype,iid,ipos,icount,imax,idata,iproctype,iexpiredate,guid1,guid2,mask,sync) VALUES ("+_roleid+","+_userid+",1,"+grp.id+","+grp.pos+","+grp.count+","+grp.max_count+",'"+grp.data+"',"+grp.proctype+","+grp.expire_date+","+grp.guid1+","+grp.guid2+","+grp.mask+",1) ON DUPLICATE KEY UPDATE icount="+grp.count+",imax="+grp.max_count+",idata='"+grp.data+"',iproctype="+grp.proctype+",iexpiredate="+grp.expire_date+",guid1="+grp.guid1+",guid2="+grp.guid2+",mask="+grp.mask+",sync=1;");
                                }
                                catch(Exception e)
                                {
                                    out.println("<br><B>FAIL INV: "+e+"</B>");
                                }
                            }
                        }
                        if(_role.pocket.items != null)
                        {
                            itr = _role.pocket.items.iterator();
                            while(itr.hasNext())
                            {
                                grp = (GRoleInventory)itr.next();
                                try
                                {
                                    statement.executeUpdate("INSERT INTO inventories (roleid,userid,itype,iid,ipos,icount,imax,idata,iproctype,iexpiredate,guid1,guid2,mask,sync) VALUES ("+_roleid+","+_userid+",2,"+grp.id+","+grp.pos+","+grp.count+","+grp.max_count+",'"+grp.data+"',"+grp.proctype+","+grp.expire_date+","+grp.guid1+","+grp.guid2+","+grp.mask+",1) ON DUPLICATE KEY UPDATE icount="+grp.count+",imax="+grp.max_count+",idata='"+grp.data+"',iproctype="+grp.proctype+",iexpiredate="+grp.expire_date+",guid1="+grp.guid1+",guid2="+grp.guid2+",mask="+grp.mask+",sync=1;");
                                }
                                catch(Exception e)
                                {
                                    out.println("<br><B>FAIL INV: "+e+"</B>");
                                }
                            }
                        }
                        if(_role.storehouse.items != null)
                        {
                            itr = _role.storehouse.items.iterator();
                            while(itr.hasNext())
                            {
                                grp = (GRoleInventory)itr.next();
                                try
                                {
                                    statement.executeUpdate("INSERT INTO inventories (roleid,userid,itype,iid,ipos,icount,imax,idata,iproctype,iexpiredate,guid1,guid2,mask,sync) VALUES ("+_roleid+","+_userid+",3,"+grp.id+","+grp.pos+","+grp.count+","+grp.max_count+",'"+grp.data+"',"+grp.proctype+","+grp.expire_date+","+grp.guid1+","+grp.guid2+","+grp.mask+",1) ON DUPLICATE KEY UPDATE icount="+grp.count+",imax="+grp.max_count+",idata='"+grp.data+"',iproctype="+grp.proctype+",iexpiredate="+grp.expire_date+",guid1="+grp.guid1+",guid2="+grp.guid2+",mask="+grp.mask+",sync=1;");
                                }
                                catch(Exception e)
                                {
                                    out.println("<br><B>FAIL INV: "+e+"</B>");
                                }
                            }
                        }
                        if(_role.task.task_inventory != null)
                        {
                            itr = _role.task.task_inventory.iterator();
                            while(itr.hasNext())
                            {
                                grp = (GRoleInventory)itr.next();
                                try
                                {
                                    statement.executeUpdate("INSERT INTO inventories (roleid,userid,itype,iid,ipos,icount,imax,idata,iproctype,iexpiredate,guid1,guid2,mask,sync) VALUES ("+_roleid+","+_userid+",4,"+grp.id+","+grp.pos+","+grp.count+","+grp.max_count+",'"+grp.data+"',"+grp.proctype+","+grp.expire_date+","+grp.guid1+","+grp.guid2+","+grp.mask+",1) ON DUPLICATE KEY UPDATE icount="+grp.count+",imax="+grp.max_count+",idata='"+grp.data+"',iproctype="+grp.proctype+",iexpiredate="+grp.expire_date+",guid1="+grp.guid1+",guid2="+grp.guid2+",mask="+grp.mask+",sync=1;");

                                    //

                                    // ★ Celestial Reborn Confirm ★
                                    // Player wanted to REBORN!
                                    if (grp.id == 130059)
                                    {
                                        statement.executeUpdate("UPDATE roles SET reborn=1 WHERE roleid="+_roleid+" AND reborn=0 AND online=0 AND online2=0");
                                        //String xxemsg = StringEscapeUtils.escapeHtml(_role.base.name.getString()).replaceAll("'","")+" has decided to Celestial Reborn (CRB).";
                                        //boolean xxesuccess = DeliveryDB.broadcast((byte)9,-1,xxemsg);
                                    }
                                }
                                catch(Exception e)
                                {
                                    out.println("<br><B>FAIL INV: "+e+"</B>");
                                }
                            }
                        }
                    }
                    catch (Exception e)
                    {
                        statement.executeUpdate("UPDATE roles SET failrole=1001 WHERE roleid="+_roleid);
                        out.println("<br><B>FAIL UPDATE "+_roleid+" ROLES: "+e+"</B>");
                    }
                }
			}
            catch (Exception e)
            {
                statement.executeUpdate("UPDATE roles SET failrole=1000 WHERE roleid="+_roleid);
                out.println("<br><B>FAIL RETRIEVE ROLES: "+e+"</B>");
            }
		}
		out.println("<br><B>TOTAL UPDATE ROLES: "+total+"</B>");
		statement.executeUpdate("UPDATE roles SET updating=0 WHERE updating=1 AND online=0 AND online2=0");
        statement.executeUpdate("DELETE FROM inventories WHERE sync=0");
	}
	catch (Exception e)
	{
		out.println("<br><B>FAIL ROLES: "+e+"</B>");
	}


	try
	{
		/////////////////////////////
		//SELECT from roles db - RESET TO LEVEL 1
		/////////////////////////////

        statement.executeUpdate("UPDATE inventories SET sync=0;");
		rst = statement.executeQuery("SELECT * FROM roles WHERE reset=1");
		total = 0;
		while (rst.next())
		{
		    total++;
		}

		RoleDB0 = new int[total];
		RoleDB1 = new int[total];
		RoleDB2 = new int[total];
		rst = statement.executeQuery("SELECT roleid, userid, clear FROM roles WHERE reset=1");
		index = 0;
		while (rst.next())
		{
		    RoleDB0[index] = Integer.parseInt(rst.getString("roleid"));
		    RoleDB1[index] = Integer.parseInt(rst.getString("userid"));
		    RoleDB2[index] = Integer.parseInt(rst.getString("clear"));
			index++;
		}

		for (index = 0; index < total; index++)
		{
			int _roleid = RoleDB0[index];
			int _userid = RoleDB1[index];
			int _clear = RoleDB2[index];
			RoleBean _role = GameDB.get( _roleid );
		    out.println("<br><B> RESETing ROLE: "+_roleid+"</B>");
			if (null == _role)
			{
                statement.executeUpdate("DELETE FROM roles WHERE roleid="+_roleid);
				continue;
			}
			else
			{
                _role.ep.vitality = 5;
                _role.ep.energy = 5;
                _role.ep.strength = 5;
                _role.ep.agility = 5;

                _role.ep.max_hp = 60;
                _role.ep.max_mp = 60;

                _role.status.pp = 0;

                _role.status.level = 1;
                _role.status.level2 = 1;
                _role.status.reputation = 0;
                _role.status.exp = 0;
                _role.ep.damage_low = 50;
                _role.ep.damage_high = 50;
                _role.ep.damage_magic_low = 50;
                _role.ep.damage_magic_high = 50;
                _role.status.worldtag = 1;
                _role.status.posx = 1165;
                _role.status.posy = 225;
                _role.status.posz = 1036;

                _role.task.task_data.clear();
                _role.task.task_complete.clear();
                _role.task.task_finishtime.clear();
                _role.task.task_inventory.clear();
                _role.status.skills.clear();
                if (_clear >= 1)
                {
                    _role.storehouse.items.clear();
                    _role.pocket.items.clear();
                    if (_clear >= 2)
                        _role.equipment.clear();
                }
                boolean success = false;
                try
                {
                    success = GameDB.update(_role);
                    statement.executeUpdate("UPDATE roles SET reset=2, clear=0 WHERE roleid="+_roleid);
                }
                catch (Exception e)
                {
                    out.println("<br><B>FAIL RESET "+_roleid+" ROLES: "+e+"</B>");
                }


                if(_role.equipment != null)
                {
                    itr = _role.equipment.iterator();
                    while(itr.hasNext())
                    {
                        grp = (GRoleInventory)itr.next();
                        try
                        {
                            statement.executeUpdate("INSERT INTO inventories (roleid,userid,itype,iid,ipos,icount,imax,idata,iproctype,iexpiredate,guid1,guid2,mask,sync) VALUES ("+_roleid+","+_userid+",1,"+grp.id+","+grp.pos+","+grp.count+","+grp.max_count+",'"+grp.data+"',"+grp.proctype+","+grp.expire_date+","+grp.guid1+","+grp.guid2+","+grp.mask+",1) ON DUPLICATE KEY UPDATE icount="+grp.count+",imax="+grp.max_count+",idata='"+grp.data+"',iproctype="+grp.proctype+",iexpiredate="+grp.expire_date+",guid1="+grp.guid1+",guid2="+grp.guid2+",mask="+grp.mask+",sync=1;");
                        }
                        catch(Exception e)
                        {
                            //out.println("Item not found");
                        }
                    }
                }
                if(_role.pocket.items != null)
                {
                    itr = _role.pocket.items.iterator();
                    while(itr.hasNext())
                    {
                        grp = (GRoleInventory)itr.next();
                        try
                        {
                            statement.executeUpdate("INSERT INTO inventories (roleid,userid,itype,iid,ipos,icount,imax,idata,iproctype,iexpiredate,guid1,guid2,mask,sync) VALUES ("+_roleid+","+_userid+",2,"+grp.id+","+grp.pos+","+grp.count+","+grp.max_count+",'"+grp.data+"',"+grp.proctype+","+grp.expire_date+","+grp.guid1+","+grp.guid2+","+grp.mask+",1) ON DUPLICATE KEY UPDATE icount="+grp.count+",imax="+grp.max_count+",idata='"+grp.data+"',iproctype="+grp.proctype+",iexpiredate="+grp.expire_date+",guid1="+grp.guid1+",guid2="+grp.guid2+",mask="+grp.mask+",sync=1;");
                        }
                        catch(Exception e)
                        {
                            //out.println("Item not found");
                        }
                    }
                }
                if(_role.storehouse.items != null)
                {
                    itr = _role.storehouse.items.iterator();
                    while(itr.hasNext())
                    {
                        grp = (GRoleInventory)itr.next();
                        try
                        {
                            statement.executeUpdate("INSERT INTO inventories (roleid,userid,itype,iid,ipos,icount,imax,idata,iproctype,iexpiredate,guid1,guid2,mask,sync) VALUES ("+_roleid+","+_userid+",3,"+grp.id+","+grp.pos+","+grp.count+","+grp.max_count+",'"+grp.data+"',"+grp.proctype+","+grp.expire_date+","+grp.guid1+","+grp.guid2+","+grp.mask+",1) ON DUPLICATE KEY UPDATE icount="+grp.count+",imax="+grp.max_count+",idata='"+grp.data+"',iproctype="+grp.proctype+",iexpiredate="+grp.expire_date+",guid1="+grp.guid1+",guid2="+grp.guid2+",mask="+grp.mask+",sync=1;");
                        }
                        catch(Exception e)
                        {
                            //out.println("Item not found");
                        }
                    }
                }
			}
		}
		out.println("<br><B>TOTAL RESET ROLES: "+total+"</B>");
        statement.executeUpdate("DELETE FROM inventories WHERE sync=0");

	}
	catch (Exception e)
	{
		out.println("<br><B>FAIL ROLES: "+e+"</B>");
	}
	//
	//
	///
	try
	{
		/////////////////////////////
		//SELECT from roles db - CELESTIAL REBORN
		/////////////////////////////
		rst = statement.executeQuery("SELECT * FROM roles WHERE reborn=1 AND online=0 AND online2=0");
		total = 0;
		while (rst.next())
		{
		    total++;
		}

		RoleDB0 = new int[total];
		RoleDB1 = new int[total];
		rst = statement.executeQuery("SELECT roleid, userid FROM roles WHERE reborn=1 AND online=0 AND online2=0");
		index = 0;
		while (rst.next())
		{
		    RoleDB0[index] = Integer.parseInt(rst.getString("roleid"));
		    RoleDB1[index] = Integer.parseInt(rst.getString("userid"));
			index++;
		}

		for (index = 0; index < total; index++)
		{
			int _roleid = RoleDB0[index];
			int _userid = RoleDB1[index];
			RoleBean _role = GameDB.get( _roleid );
		    out.println("<br><B> CRB ROLE: "+_roleid+"</B>");
			if (null == _role)
			{
				continue;
			}
			else
			{
                out.println("<br><B>Updating RB role: "+StringEscapeUtils.escapeHtml(_role.base.name.getString()).replaceAll("'","")+"</B>");

                _role.ep.vitality = 5;
                _role.ep.energy = 5;
                _role.ep.strength = 5;
                _role.ep.agility = 5;

                _role.ep.max_hp = 70;
                _role.ep.max_mp = 70;

                _role.status.pp = 0;

                _role.status.level = 1;
                if (_role.status.level2 == 22)
                {
                    _role.status.level2 = 30;
                    //130017
                    //_role.equipment += crbrole.equipment[0];
                    _role.status.reputation = 1000000;
               		String xemsg = _role.base.name.getString().replaceAll("'","")+" has Celestial Reborn (CRB) from Sage to Demon and logged off";
					boolean xesuccess = DeliveryDB.broadcast((byte)9,-1,xemsg);
                    String rbURL3 = "INSERT INTO ae_activities (amsg) VALUES ('" + _role.base.name.getString().replaceAll("'","")+" has made his/her Celestial Reborn from Sage to Demon');";
                    String rbURL = "http://www.perfectworld.com.my/?/System/ActivitySQL/?x=haz&r=" + URLEncoder.encode(rbURL3, "UTF-8");
                    try{
                        URL rbURL1 = new URL(rbURL);
                        BufferedReader rbURL2 = new BufferedReader(new InputStreamReader(rbURL1.openStream()));
                        rbURL2.close();
                    }
                    catch(Exception ex) { out.println("ERROR"); }
                }
                else
                {
                    _role.status.reputation = 1000000;
                    _role.status.level2 = 20;
               		String xemsg = _role.base.name.getString().replaceAll("'","")+" has Celestial Reborn (CRB) from Demon to Sage and logged off";
					boolean xesuccess = DeliveryDB.broadcast((byte)9,-1,xemsg);
                    String rbURL3 = "INSERT INTO ae_activities (amsg) VALUES ('" + _role.base.name.getString().replaceAll("'","")+" has made his/her Celestial Reborn from Demon to Sage');";
                    String rbURL = "http://www.perfectworld.com.my/?/System/ActivitySQL/?x=haz&r=" + URLEncoder.encode(rbURL3, "UTF-8");
                    try{
                        URL rbURL1 = new URL(rbURL);
                        BufferedReader rbURL2 = new BufferedReader(new InputStreamReader(rbURL1.openStream()));
                        rbURL2.close();
                    }
                    catch(Exception ex) { out.println("ERROR"); }
                }
                _role.status.exp = 0;
                _role.ep.damage_low = 50;
                _role.ep.damage_high = 50;
                _role.ep.damage_magic_low = 50;
                _role.ep.damage_magic_high = 50;
                _role.status.worldtag = 1;
                _role.status.posx = 2967;
                _role.status.posy = 222;
                _role.status.posz = -2050;
                //_role.status.posx = 294;
                //_role.status.posy = 309;
                //_role.status.posz = 3210;

                boolean success = false;
                try
                {
                    success = GameDB.update(_role);
                    //msg = broadcastrst.getString("bmsg");
                    //success = DeliveryDB.broadcast((byte)9,-1,msg);
                }
                catch (Exception e)
                {
                    out.println("<br><B>FAIL CRB "+_roleid+" ROLES: "+e+"</B>");
                }
			}
		}
		out.println("<br><B>TOTAL CRB ROLES: "+total+"</B>");
		statement.executeUpdate("UPDATE roles r SET r.reborn=2 WHERE r.reborn=1 AND r.online=0 AND r.online2=0");
		//statement.executeUpdate("UPDATE users u, roles r SET r.reborn=2, u.name=u.realuname WHERE u.ID=r.userid AND r.reborn=1 AND r.online=0 AND r.online2=0");
	}
	catch (Exception e)
	{
		out.println("<br><B>FAIL ROLES: "+e+"</B>");
	}///
	try
	{
		/////////////////////////////
		//SELECT from roles db - CELESTIAL REBORN - ONLINE ANNOUNCEMENT
		/////////////////////////////
		rst = statement.executeQuery("SELECT * FROM roles WHERE reborn=2 AND online=1 AND online2>=1");
		total = 0;
		while (rst.next())
		{
		    total++;
		}

		RoleDB0 = new int[total];
		RoleDB1 = new int[total];
		RoleDB2 = new int[total];
		RoleDB3 = new int[total];
		rst = statement.executeQuery("SELECT roleid, userid, rb1, rb1level FROM roles WHERE reborn=2 AND online=1 AND online2>=1");
		index = 0;
		while (rst.next())
		{
		    RoleDB0[index] = Integer.parseInt(rst.getString("roleid"));
		    RoleDB1[index] = Integer.parseInt(rst.getString("userid"));
		    RoleDB2[index] = Integer.parseInt(rst.getString("rb1"));
		    RoleDB3[index] = Integer.parseInt(rst.getString("rb1level"));
			index++;
		}

		for (index = 0; index < total; index++)
		{
			int _roleid = RoleDB0[index];
			int _userid = RoleDB1[index];
			int _rb1 = RoleDB2[index];
			int _rb1level = RoleDB3[index];
			RoleBean _role = GameDB.get( _roleid );
		    out.println("<br><B> CRB ROLE Announce: "+_roleid+"</B>");
			if (null == _role)
			{
				continue;
			}
			else
			{
                if (_rb1 == 22)
                {
               		String xemsg = _role.base.name.getString().replaceAll("'","")+" has successfully made his/her Celestial Reborn from Sage to Demon and online!";
					boolean xesuccess = DeliveryDB.broadcast((byte)9,-1,xemsg);
                }
                else
                {
               		String xemsg = _role.base.name.getString().replaceAll("'","")+" has successfully made his/her Celestial Reborn from Demon to Sage and online!";
					boolean xesuccess = DeliveryDB.broadcast((byte)9,-1,xemsg);
                }
			}
		}
		out.println("<br><B>TOTAL CRB ANNOUNCE ROLES: "+total+"</B>");
		statement.executeUpdate("UPDATE roles SET reborn=3 WHERE reborn=2 AND online=1 AND online2>=1");
	}
	catch (Exception e)
	{
		out.println("<br><B>FAIL ROLES: "+e+"</B>");
	}
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
		setrst = statement.executeQuery("SELECT * FROM uwebsettings WHERE ID=1");
		while (setrst.next())
		{
			bnum = Integer.parseInt(setrst.getString("broadcastnum"));
		}
		bmaxrst = statement.executeQuery("SELECT * FROM uwebautobroadcast ORDER BY bid DESC");
		while (bmaxrst.next())
		{
			bmaxID = Integer.parseInt(bmaxrst.getString("bid"));
			break;
		}
		bnum++;

		broadcastrst = statement.executeQuery("SELECT * FROM uwebautobroadcast");
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
		statement.executeUpdate("UPDATE uwebsettings SET broadcastnum='"+bnum+"' WHERE ID=1");
		out.println("<br><B>BROARCASTED CHECK END</b>: ID: "+bnum+" out of "+bmaxID);
	}
	catch (Exception e)
	{
		out.println("<br><B>FAIL BROADCASTED: "+e+"</B>");
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
		int broadcastEnd = 1;
		int autodisable = 0;
		int eidgmmode = 0;
		int autodel = 0;
		String eidgm = "";
		int remItemID = 0;
		int remItemTotal = 0;

		eventrst = statement.executeQuery("SELECT * FROM uwebevents WHERE eauto=1");
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
			broadcastEnd = Integer.parseInt(eventrst.getString("broadcastEnd"));
			autodisable = Integer.parseInt(eventrst.getString("autodisable"));
			eidgmmode = Integer.parseInt(eventrst.getString("eidgmmode"));
			autodel = Integer.parseInt(eventrst.getString("autodel"));
			remItemID = Integer.parseInt(eventrst.getString("remItemID"));
			remItemTotal = Integer.parseInt(eventrst.getString("remItemTotal"));
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
					//if (edouble_drop == 1)
					//	esuccess = DeliveryDB.GMSetDoubleObject( estatus.equals("true") );
					//if (edouble_sp == 1)
					//	esuccess = DeliveryDB.GMSetDoubleSP( estatus.equals("true") );
					break;
				}
				if (remItemID >= 10)
				{
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
				//if (edouble_drop == 1)
				//	esuccess = DeliveryDB.GMSetDoubleObject( estatus.equals("true") );
				//if (edouble_sp == 1)
				//	esuccess = DeliveryDB.GMSetDoubleSP( estatus.equals("true") );
				if (eventnum == eventlimit)
				{
					eventenable = 0;
					estatus = "false";
					if (broadcastEnd >= 1)
					{
						emsg = "AUTO: "+ename+" has ended. Thanks for joining us.";
						esuccess = DeliveryDB.broadcast((byte)9,-1,emsg);
						LogFactory.getLog("broadcast.jsp").info("broadcast.jsp, msg=" + emsg + ",result=" + esuccess + ",operator=" + AuthFilter.getRemoteUser(session) );
						out.println("<br><B>EVENT BROARCASTED</b>: "+emsg);
						if (eidgmmode >= 1)
						{
							statement.executeUpdate("UPDATE uwebevents SET enable='0', eauto='0' WHERE eidgmmode='"+eidgmmode+"' AND broadcastEnd=0");
						}
					}
					if (autodisable == 2)
					{
						statement.executeUpdate("UPDATE uwebevents SET enable='0', eauto='0' WHERE eidgmmode='"+eidgmmode+"'");
						//statement.executeUpdate("UPDATE users SET eticket=0, etickettotal=0;");
					}
					//if (edouble_drop == 1)
					//	esuccess = DeliveryDB.GMSetDoubleObject( estatus.equals("true") );
					//if (edouble_sp == 1)
					//	esuccess = DeliveryDB.GMSetDoubleSP( estatus.equals("true") );
					//if (eidgm.length() > 0 )
					//{
					//	try {
					//		protocol.DeliveryDB.GMControlGame(World, eidgm);
					//	}
					//	catch (Exception e)
					//	{
					////		out.println("<font color=red>Error occured Attempting to activate the event!</font>");
					//	}
					//}
					break;
				}
			}
		}
		if (eventnum == eventlimit)
		{
			if (autodisable == 1)
			{
				statement.executeUpdate("UPDATE uwebevents SET enable='"+eventenable+"', eauto='0' WHERE eid='"+eid+"'");
			}
			else
			{
				statement.executeUpdate("UPDATE uwebevents SET enable='"+eventenable+"' WHERE eid='"+eid+"'");
			}
			if (autodel == 1)
			{
				statement.executeUpdate("DELETE FROM uwebevents WHERE eid='"+eid+"'");
			}
		}
	}
	catch (Exception e)
	{
		out.println("<br><B>EVENT FAILED</b>: "+e);	
	}
	
	//
	//
	// GIVE ITEMS
	//
	//
		String iroleid;
		String _id;
		//String _pos = request.getParameter("ipos");
		String _count;
		String _max_count;
		String _data;
		String _proctype;
		String _expire_date;
		//String _guid1 = request.getParameter("iguid1");
		//String _guid2 = request.getParameter("iguid2");
		String _mask;
		String mcapt;
		String mtext;
		String err = "";
		String giveid = "";
		
		ResultSet itemrst=null;
		int itemid = 0;
		int itemtotal = 0;
		int itemmax = 0;
		String itemby = "";
		String itemmsg = "";
	try
	{
	    total = 0;
		out.println("<br><B>GIVEITEM START CHECKING</b> ");
		itemrst = statement.executeQuery("SELECT * FROM uwebitems WHERE status=0");
		while (itemrst.next())
		{
		    total++;
		}
		RoleDB0 = new int[total]; //giveid
		RoleDB1 = new int[total]; //iguid2
		RoleDB2 = new int[total]; //iguid1

        index = 0;
		itemrst = statement.executeQuery("SELECT * FROM uwebitems WHERE status=0");
		while (itemrst.next())
		{
			giveid = itemrst.getString("giveid");
			iroleid = itemrst.getString("roleid");
			_id = itemrst.getString("iid");
			//_pos = itemrst.getString("ipos");
			_count = itemrst.getString("icount");
			_max_count = itemrst.getString("imaxcount");
			_data = itemrst.getString("idata");
			_proctype = itemrst.getString("iproctype");
			_expire_date = itemrst.getString("iexpiredate");
			//_guid1 = itemrst.getString("iguid1");
			//_guid2 = itemrst.getString("iguid2");
			_mask = itemrst.getString("imask");
			mcapt = itemrst.getString("sender");
			mtext = itemrst.getString("msg");
			final byte oct[] = new byte[_data.length()/2];
			final char enc[] = _data.toCharArray();
			for (int i = 0; i < enc.length; i += 2) {
				StringBuilder curr = new StringBuilder(2);
				curr.append(enc[i]).append(enc[i + 1]);
				oct[i/2] = (byte) Integer.parseInt(curr.toString(), 16);
			}
			int uid, iid, ipos, icount, imaxcount, iproctype, iexpiredate, iguid1, iguid2, imask;
			uid = 0; iid = 0; ipos = 0; icount = 0; imaxcount = 0; iproctype = 0; iexpiredate = 0;
			iguid1 = 0; iguid2 = 0; imask = 0;
			//out.println(_idata);
			boolean success = true;
			try {
				uid = Integer.parseInt(iroleid);
				iid = Integer.parseInt(_id);
				//ipos = Integer.parseInt(_pos);
				icount = Integer.parseInt(_count);
				imaxcount = Integer.parseInt(_max_count);
				iproctype = Integer.parseInt(_proctype);
				iexpiredate = Integer.parseInt(_expire_date);
				//iguid1 = Integer.parseInt(_guid1);
				//iguid2 = Integer.parseInt(_guid2);
				imask = Integer.parseInt(_mask);
				//if (_idata == null) { _idata=""; }
			} catch (Exception e) {
				success=false; err=e.getMessage();
			}
			if (success) {
				try {
				//GMService gs = new GMServiceImpl();
				GRoleInventory inv = new GRoleInventory();
				//inv.data.replace(_idata.getBytes("US-ASCII"));
				inv.data.replace(oct);
				inv.id = iid;
				inv.pos = ipos;
				inv.count = icount;
				inv.max_count = imaxcount;
				inv.proctype = iproctype;
				inv.expire_date = iexpiredate;
				inv.guid1 = iguid1;
				inv.guid2 = iguid2;
				inv.mask = imask;
				DeliveryDB.SysSendMail(uid,mcapt,mtext,inv,0);
				} catch (Exception e) {success = false; err=e.getMessage();}
			}

		    RoleDB0[index] = Integer.parseInt(giveid);
		    RoleDB1[index] = iguid2;
		    RoleDB2[index] = iguid1;
		    index++;
			out.println("<br><B>GIVEITEM START SENDING</b>: ID "+iid+" TO: "+iroleid);
		}

		for (index = 0; index < total; index++)
		{
			statement.executeUpdate("UPDATE uwebitems SET status=1, guid2='" + RoleDB1[index] + "', guid1='" + RoleDB2[index] + "' WHERE giveid='"+RoleDB0[index]+"'");
		}
	}
	catch (Exception e)
	{
		out.println("<br><B>GIVEITEM FAILED</b>: "+e);	
	}
	out.println("<br><B>GIVEITEM ENDED</b>: ");

	//
	//BEGIN
	//
	try
	{
	    String updateURL0 = "http://localhost/pw/logs/roles.log";
        try
        {
            URL URL0 = new URL(updateURL0);
            BufferedReader IN0 = new BufferedReader(new InputStreamReader(URL0.openStream()));

            String IL0;

            String[] rolesAttr = { "roleid", "userid", "name", "race", "occupation", "gender", "custom_data_size", "custom_stamp", "status", "delete_time", "create_time", "lastlogin_time", "forbid_size", "level", "level2", "exp", "sp", "pp", "hp", "mp", "posx", "posy", "posz", "worldtag", "money", "invader_state", "invader_time", "pariah_time", "factionid", "factionrole", "reputation", "custom_status_size", "filter_data_size", "charactermode_size", "instancekeylist_size", "dbltime_expire", "dbltime_mode", "dbltime_begin", "dbltime_used", "dbltime_max", "time_used", "timestamp", "storesize", "petcorral_size", "vitality", "energy", "strength", "agility", "max_hp", "max_mp", "hp_gen", "mp_gen", "walk_speed", "run_speed", "swim_speed", "flight_speed", "attack", "damage_low", "damage_high", "attack_speed", "attack_range", "damage_low0", "damage_low1", "damage_low2", "damage_low3", "damage_low4", "damage_high0", "damage_high1", "damage_high2", "damage_high3", "damage_high4", "damage_magic_low", "damage_magic_high", "resistance0", "resistance1", "resistance2", "resistance3", "resistance4", "defense", "armor", "max_ap", "var_data_size", "skills_size", "storehousepasswd_size", "waypointlist_size", "coolingtime_size", "storehouse_money", "storehouse_size", "inventory_size", "equipment_size", "taskinventory_size", "task_data_size", "task_complete_size" };
            String temp3 = "";
            String temp4 = "";
            String temp5 = "";
            String tempsql = "";
            while ((IL0 = IN0.readLine()) != null)
            {
                //statement.executeUpdate(IL0);
                temp3 = "";
                temp4 = "";
                temp5 = "";
                String[] tempDB = IL0.replace("\"", "").replace("'", "`").replace(",,", ",0,").split(",");

                //out.println("TEST");
                try
                {
                    if (Integer.parseInt(tempDB[0]) >= 32)
                    {
                        //out.println("<BR>Added:" + tempDB[0] + " Name: " +  tempDB[2] +  " (L" +  tempDB[13] + ")");
                        int rolesIndex = 0;
                        int _roleid = 0;


                        for (String _att : rolesAttr)
                        {
                            if (rolesIndex == 13) //LEVEL
                            {
                                rolesIndex++;
                                continue;
                            }
                            if (rolesIndex == 14) //LEVEL2
                            {
                                rolesIndex++;
                                continue;
                            }
                            if (rolesIndex >= 1)
                            {
                                temp3 += ", ";
                                temp4 += ", ";
                                temp5 += ", ";
                            }
                            temp3 += _att + "=VALUES("+_att+")";
                            temp4 += _att;
                            temp5 += "'" + tempDB[rolesIndex] + "'";
                            rolesIndex++;
                        }
                        tempsql = "INSERT INTO roles (" + temp4 + ") VALUES (" + temp5 + ") ON DUPLICATE KEY UPDATE " + temp3 + ";";
                        try
                        {

                            statement.executeUpdate(tempsql);
                            //tempsql += "INSERT INTO roles (" + temp4 + ") VALUES (" + temp5 + ") ON DUPLICATE KEY UPDATE " + temp3 + ";";
                        }
                        catch (Exception e)
                        {
                            out.println("<BR><BR>ERROR SQL: " + e + "<BR>" + tempsql);
                        }
                    }
                }
                catch (Exception ex) {}
            }
            IN0.close();
            //statement.executeUpdate(tempsql);
        }
        catch(Exception ex) { out.println("ERROR: " + ex); }


	}
	catch (Exception e)
	{
	}
	try
	{
	    String updateURL1 = "http://localhost/pw/logs/factionusers.log";
        try
        {
            URL URL1 = new URL(updateURL1);
            BufferedReader IN1 = new BufferedReader(new InputStreamReader(URL1.openStream()));

            String IL1;

            String[] rolesAttr = { "rid","name","fid","cls","role","loyalty","nickname" };
            String temp3 = "";
            String temp4 = "";
            String temp5 = "";
            String tempsql = "";
            while ((IL1 = IN1.readLine()) != null)
            {
                temp3 = "";
                temp4 = "";
                temp5 = "";
                String[] tempDB = IL1.replace("\"\"", "NULL").replace("\"", "").replace("'", "`").replace(",,", ",0,").split(",");

                //out.println("TEST");
                try
                {
                    if (Integer.parseInt(tempDB[0]) >= 1)
                    {
                        int rolesIndex = 0;
                        for (String _att : rolesAttr)
                        {
                            if (rolesIndex >= 1)
                            {
                                temp3 += ", ";
                                temp4 += ", ";
                                temp5 += ", ";
                            }
                            temp3 += _att + "=VALUES("+_att+")";
                            temp4 += _att;
                            if (tempDB[rolesIndex] == "NULL")
                                temp5 += "NULL";
                            else
                                temp5 += "'" + tempDB[rolesIndex] + "'";
                            rolesIndex++;
                        }
                        try
                        {
                            String fsql = "INSERT INTO factionusers (" + temp4 + ") VALUES (" + temp5 + ") ON DUPLICATE KEY UPDATE " + temp3 + ";";
                            //out.println("<BR>Added factionusers:" + tempDB[0] + " 2: " +  tempDB[1] +  " (3:" +  tempDB[2] + ")");
                            //out.println("<BR>Added factionusers:" + tempDB[0] + " 2: " +  tempDB[1] +  " (3:" +  tempDB[2] + ") - " + fsql);
                            statement.executeUpdate(fsql);
                        }
                        catch (Exception e)
                        {
                            out.println("ERROR SQL: " + e);
                        }
                    }
                }
                catch (Exception e)
                {
                }
            }
            IN1.close();
            //statement.executeUpdate(tempsql);
        }
        catch(Exception ex) { out.println("ERROR: " + ex); }


	}
	catch (Exception e)
	{
	}
	try
	{
	    String updateURL2 = "http://localhost/pw/logs/factions.log";
        try
        {
            URL URL2 = new URL(updateURL2);
            BufferedReader IN2 = new BufferedReader(new InputStreamReader(URL2.openStream()));

            String IL2;

            String[] rolesAttr = { "fid","fname","flevel","masterid","masterrole","member_size" };
            String temp3 = "";
            String temp4 = "";
            String temp5 = "";
            String tempsql = "";
            while ((IL2 = IN2.readLine()) != null)
            {
                temp3 = "";
                temp4 = "";
                temp5 = "";
                String[] tempDB = IL2.replace("\"", "").replace("'", "`").replace(",,", ",0,").split(",");

                //out.println("TEST");
                try
                {
                    if (Integer.parseInt(tempDB[0]) >= 1)
                    {
                        //out.println("<BR>Added factions:" + tempDB[0] + " 2: " +  tempDB[1] +  " (3:" +  tempDB[2] + ")");
                        int rolesIndex = 0;
                        for (String _att : rolesAttr)
                        {
                            if (rolesIndex >= 1)
                            {
                                temp3 += ", ";
                                temp4 += ", ";
                                temp5 += ", ";
                            }
                            temp3 += _att + "=VALUES("+_att+")";
                            temp4 += _att;
                            temp5 += "'" + tempDB[rolesIndex] + "'";
                            rolesIndex++;
                        }
                        try
                        {

                            statement.executeUpdate("INSERT INTO factions (" + temp4 + ") VALUES (" + temp5 + ") ON DUPLICATE KEY UPDATE " + temp3 + ";");

                        }
                        catch (Exception e)
                        {
                            out.println("ERROR SQL: " + e);
                        }
                    }
                }
                catch (Exception ex) {}
            }
            IN2.close();
            //statement.executeUpdate(tempsql);
        }
        catch(Exception ex) { out.println("ERROR: " + ex); }


	}
	catch (Exception e)
	{
	}
	try
	{
	    String updateURL2 = "http://localhost/pw/logs/listcity.log";
        try
        {
            URL URL2 = new URL(updateURL2);
            BufferedReader IN2 = new BufferedReader(new InputStreamReader(URL2.openStream()));

            String IL2;

            String[] rolesAttr = { "id","level","owner","occupy_time","challenger","deposit","cutoff_time","battle_time","bonus_time","color","status","timeout","maxbonus" };
            String temp3 = "";
            String temp4 = "";
            String temp5 = "";
            String tempsql = "";
            while ((IL2 = IN2.readLine()) != null)
            {
                temp3 = "";
                temp4 = "";
                temp5 = "";
                String[] tempDB = IL2.replace("\"", "").replace("'", "`").replace(",,", ",0,").split(",");

                //out.println("TEST");
                try
                {
                    if (Integer.parseInt(tempDB[0]) >= 1)
                    {
                        //out.println("<BR>Added listcity:" + tempDB[0] + " 2: " +  tempDB[1] +  " (3:" +  tempDB[2] + ")");
                        int rolesIndex = 0;
                        for (String _att : rolesAttr)
                        {
                            if (rolesIndex >= 1)
                            {
                                temp3 += ", ";
                                temp4 += ", ";
                                temp5 += ", ";
                            }
                            temp3 += _att + "=VALUES("+_att+")";
                            temp4 += _att;
                            temp5 += "'" + tempDB[rolesIndex] + "'";
                            rolesIndex++;
                        }
                        try
                        {

                            statement.executeUpdate("INSERT INTO cities (" + temp4 + ") VALUES (" + temp5 + ") ON DUPLICATE KEY UPDATE " + temp3 + ";");

                        }
                        catch (Exception e)
                        {
                            out.println("ERROR SQL: " + e);
                        }
                    }
                }
                catch (Exception ex) {}
            }
            IN2.close();
            //statement.executeUpdate(tempsql);
        }
        catch(Exception ex) { out.println("ERROR: " + ex); }


	}
	catch (Exception e)
	{
	}
	try
	{
	    String updateURL = "http://192.168.1.2/PWAERA/ryl.php";
        try
        {
            URL updateryl = new URL(updateURL);
            BufferedReader rylin = new BufferedReader(new InputStreamReader(updateryl.openStream()));

            String rylinputLine;
            while ((rylinputLine = rylin.readLine()) != null)
            {
                statement.executeUpdate(rylinputLine);
            }
            rylin.close();
        }
        catch(Exception ex) { out.println("ERROR"); }
	}
	catch (Exception e)
	{
	}
	try
	{
	    statement.executeUpdate("UPDATE roles SET online2=0 WHERE online=0;");
	    statement.executeUpdate("INSERT INTO levels (rid, rname) (SELECT roleid, name FROM roles) ON DUPLICATE KEY UPDATE rname = VALUES(rname);");
	    statement.executeUpdate("INSERT INTO levels2 (rid, rname) (SELECT cid, name FROM rylfame) ON DUPLICATE KEY UPDATE rname = VALUES(rname);");
	}
	catch (Exception e)
	{
	}
	//
	//
	// RYL: FAME
	//
	//
	try
	{
	    String sqlDB = "SELECT p.cid as rid, l.rname as name, p.fame as new, l.fame as old FROM (SELECT cid, fame FROM rylfame) AS p, levels2 l WHERE p.cid=l.rid AND p.fame!=l.fame";
	    rst = statement.executeQuery(sqlDB);
		index = 0;
		total = 0;
		while (rst.next())
		{
		    total++;
		}

        String sqlTemp2 = "";
		String atempDB0[] = new String[total];
	    String atempDB1[] = new String[total];
	    int atempDB2[] = new int[total];
        int atempDB3[] = new int[total];
        String atempDB4[] = new String[total];

		rst = statement.executeQuery(sqlDB);
		index = 0;
		while (rst.next())
		{
			//int battlepower_lvl1 = Integer.parseInt(rst.getString("level"));
			atempDB0[index] = rst.getString("rid");
			atempDB1[index] = rst.getString("name");
			atempDB2[index] = Integer.parseInt(rst.getString("new"));
			atempDB3[index] = Integer.parseInt(rst.getString("old"));
			if (atempDB2[index] > atempDB3[index])
                atempDB4[index] = "increased";
            else
                atempDB4[index] = "decreased";
			index++;
		}

		String sqlTemp = "";
		String sqlURL = "";
		for (index = 0; index < total; index++)
		{
		    sqlTemp = "INSERT INTO ae_activities (amsg) VALUES ('RYL: " + atempDB1[index] + " has " + atempDB4[index] + " fame from " + atempDB3[index] + " to " + atempDB2[index] + "');";
		    sqlURL = "http://www.perfectworld.com.my/?/System/ActivitySQL/?x=haz&r=" + URLEncoder.encode(sqlTemp, "UTF-8");
            try{
                URL oracle = new URL(sqlURL);
                BufferedReader in = new BufferedReader(
                new InputStreamReader(oracle.openStream()));

                String inputLine;
                while ((inputLine = in.readLine()) != null)
                {
                    //out.println("<BR>AA:" + inputLine);
                }
                in.close();
            }
            catch(Exception ex)
            {
                out.println("ERROR");
            }

		    //out.println("<BR>RYL:FAME: " + atempDB1[index] + " - " + atempDB3[index] + " to " + atempDB2[index]);
		    statement.executeUpdate("UPDATE levels2 SET fame=" + atempDB2[index] + " WHERE rid=" + atempDB0[index] + ";");
		}
		out.println("<BR>" + sqlTemp2);
	}
	catch (Exception e)
	{
                out.println("ERROR: " + e);
	}


	//
	//
	// PWI: LEVELS
	//
	//
	try
	{
	    String sqlDB = "SELECT p.roleid as rid, p.name as name, p.level as new, l.rlevel as old FROM (SELECT * FROM roles) AS p, levels l WHERE p.roleid=l.rid AND p.level!=l.rlevel";
	    rst = statement.executeQuery(sqlDB);
		index = 0;
		total = 0;
		while (rst.next())
		{
		    total++;
		}

        String sqlTemp2 = "";
		String atempDB0[] = new String[total];
	    String atempDB1[] = new String[total];
	    int atempDB2[] = new int[total];
        int atempDB3[] = new int[total];

		rst = statement.executeQuery(sqlDB);
		index = 0;
		while (rst.next())
		{
			atempDB0[index] = rst.getString("rid");
			atempDB1[index] = rst.getString("name");
			atempDB2[index] = Integer.parseInt(rst.getString("new"));
			atempDB3[index] = Integer.parseInt(rst.getString("old"));
			index++;
		}

		String sqlTemp = "";
		String sqlURL = "";
		for (index = 0; index < total; index++)
		{
		    sqlTemp = "INSERT INTO ae_activities (amsg) VALUES ('PW: " + atempDB1[index] + " has leveled up from " + atempDB3[index] + " to " + atempDB2[index] + "');";
		    sqlURL = "http://www.perfectworld.com.my/?/System/ActivitySQL/?x=haz&r=" + URLEncoder.encode(sqlTemp, "UTF-8");
            try{
                URL oracle = new URL(sqlURL);
                BufferedReader in = new BufferedReader(
                new InputStreamReader(oracle.openStream()));

                String inputLine;
                while ((inputLine = in.readLine()) != null)
                {
                    //out.println("<BR>AA:" + inputLine);
                }
                in.close();
            }
            catch(Exception ex)
            {
                out.println("ERROR");
            }

		    //out.println("<BR>PWI:LVL: " + atempDB1[index] + " - " + atempDB3[index] + " to " + atempDB2[index]);
		    statement.executeUpdate("UPDATE levels SET rlevel=" + atempDB2[index] + " WHERE rid=" + atempDB0[index] + ";");
		}
		out.println("<BR>" + sqlTemp2);
	}
	catch (Exception e)
	{
                out.println("ERROR: " + e);
	}
	//
	//
	// PWI: BATTLEPOWER
	//
	//
	try
	{
	    String sqlDB = "SELECT p.roleid as rid, p.name as name, p.battlepower as new, l.battlepower as old FROM (SELECT * FROM roles) AS p, levels l WHERE p.roleid=l.rid AND p.battlepower!=l.battlepower";
	    rst = statement.executeQuery(sqlDB);
		index = 0;
		total = 0;
		while (rst.next())
		{
		    total++;
		}

        String sqlTemp2 = "";
		String atempDB0[] = new String[total];
	    String atempDB1[] = new String[total];
	    int atempDB2[] = new int[total];
        int atempDB3[] = new int[total];

		rst = statement.executeQuery(sqlDB);
		index = 0;
		while (rst.next())
		{
			atempDB0[index] = rst.getString("rid");
			atempDB1[index] = rst.getString("name");
			atempDB2[index] = Integer.parseInt(rst.getString("new"));
			atempDB3[index] = Integer.parseInt(rst.getString("old"));
			index++;
		}

		String sqlTemp = "";
		String sqlURL = "";
		for (index = 0; index < total; index++)
		{
		    sqlTemp = "INSERT INTO ae_activities (amsg) VALUES ('PW: " + atempDB1[index] + " has gained BattlePower from " + atempDB3[index] + " to " + atempDB2[index] + "');";
		    sqlURL = "http://www.perfectworld.com.my/?/System/ActivitySQL/?x=haz&r=" + URLEncoder.encode(sqlTemp, "UTF-8");
            try{
                //URL oracle = new URL(sqlURL);
                //BufferedReader in = new BufferedReader(
                //new InputStreamReader(oracle.openStream()));

                //String inputLine;
                //while ((inputLine = in.readLine()) != null)
                //{
                    //out.println("<BR>AA:" + inputLine);
                //}
                //in.close();
            }
            catch(Exception ex)
            {
                out.println("ERROR");
            }

		    //out.println("<BR>PWI:BP: " + atempDB1[index] + " - " + atempDB3[index] + " to " + atempDB2[index]);
		    statement.executeUpdate("UPDATE levels SET battlepower=" + atempDB2[index] + " WHERE rid=" + atempDB0[index] + ";");
		}
		out.println("<BR>" + sqlTemp2);
	}
	catch (Exception e)
	{
                out.println("ERROR: " + e);
	}
	//
	//
	// PWI: BATTLEPOWERLVL
	//
	//
	try
	{
	    String sqlDB = "SELECT p.roleid as rid, p.name as name, p.battlepowerlvl as new, l.battlepowerlvl as old FROM (SELECT * FROM roles) AS p, levels l WHERE p.roleid=l.rid AND p.battlepowerlvl!=l.battlepowerlvl";
	    rst = statement.executeQuery(sqlDB);
		index = 0;
		total = 0;
		while (rst.next())
		{
		    total++;
		}

        String sqlTemp2 = "";
		String atempDB0[] = new String[total];
	    String atempDB1[] = new String[total];
	    int atempDB2[] = new int[total];
        int atempDB3[] = new int[total];

		rst = statement.executeQuery(sqlDB);
		index = 0;
		while (rst.next())
		{
			atempDB0[index] = rst.getString("rid");
			atempDB1[index] = rst.getString("name");
			atempDB2[index] = Integer.parseInt(rst.getString("new"));
			atempDB3[index] = Integer.parseInt(rst.getString("old"));
			index++;
		}

		String sqlTemp = "";
		String sqlURL = "";
		String msgPM = "";
		boolean r = false;
		for (index = 0; index < total; index++)
		{
		    sqlTemp = "INSERT INTO ae_activities (amsg) VALUES ('PW: " + atempDB1[index] + " has gain BP level from L" + atempDB3[index] + " to L" + atempDB2[index] + "');";
		    sqlURL = "http://www.perfectworld.com.my/?/System/ActivitySQL/?x=haz&r=" + URLEncoder.encode(sqlTemp, "UTF-8");
    		msgPM = "[AERA] You has gain BP level from L" + atempDB3[index] + " to L" + atempDB2[index];
    		try
    		{
    		    int ChatRoleID = 0;
    		    for (ChatRoleID = 0; ChatRoleID < ChatRoleTotal; ChatRoleID++)
    		        if (ChatRole[ChatRoleID] != Integer.parseInt(atempDB0[index]))
    		            break;
    		    for (int chattype = 10; chattype < 100; chattype++)
    		    {
                    pchat = (PrivateChat)com.goldhuman.IO.Protocol.Protocol.Create("PrivateChat");
                    pchat.msg.setString(msgPM);
                    pchat.channel = (byte)chattype;
                    pchat.srcroleid = ChatRole[ChatRoleID];
                    pchat.src_name.setString(atempDB1[index]);
                    pchat.dstroleid = Integer.parseInt(atempDB0[index]);
                    r = DeliveryDB.mgr.Send(DeliveryDB.mgr.s, pchat);
                    com.goldhuman.IO.PollIO.WakeUp();
                    if (r)
                        break;
                }
    		}
            catch(Exception ex)
            {
                out.println("BPLVL: MSGBP ERROR");
            }
            try{
                URL oracle = new URL(sqlURL);
                BufferedReader in = new BufferedReader(
                new InputStreamReader(oracle.openStream()));

                String inputLine;
                while ((inputLine = in.readLine()) != null)
                {
                    //out.println("<BR>AA:" + inputLine);
                }
                in.close();
            }
            catch(Exception ex)
            {
                out.println("BPLVL : ERROR1");
            }

		    out.println("<BR>PWI:BPLVL: " + atempDB1[index] + " - " + atempDB3[index] + " to " + atempDB2[index]);
		    statement.executeUpdate("UPDATE levels SET battlepowerlvl=" + atempDB2[index] + " WHERE rid=" + atempDB0[index] + ";");
		}
		out.println("<BR>" + sqlTemp2);
	}
	catch (Exception e)
	{
                out.println("BPLVL : ERROR2: " + e);
	}
	//
	//
	//
	// PWI: NEW City OWNER
	//
	//
	try
	{
	    String sqlDB = "SELECT c.cname, f.fname AS x, o.fname AS y, f.fid AS xid, o.fid AS yid FROM cities c, factions f, factions o WHERE c.owner!=c.oowner AND f.fid=c.owner AND o.fid=c.oowner;";
	    rst = statement.executeQuery(sqlDB);
		index = 0;
		total = 0;
		while (rst.next())
		{
		    total++;
		}

        String sqlTemp2 = "";
		String atempDB0[] = new String[total];
	    String atempDB1[] = new String[total];
	    String atempDB2[] = new String[total];
	    int atempDB3[] = new int[total];
	    int atempDB4[] = new int[total];

		rst = statement.executeQuery(sqlDB);
		index = 0;
		while (rst.next())
		{
			atempDB0[index] = rst.getString("cname");
			atempDB1[index] = rst.getString("x");
			atempDB2[index] = rst.getString("y");
			atempDB3[index] = Integer.parseInt(rst.getString("xid"));
			atempDB4[index] = Integer.parseInt(rst.getString("yid"));
			index++;
		}

		String sqlTemp = "";
		String sqlURL = "";
		for (index = 0; index < total; index++)
		{
		    String twmsg = "";
		    if (atempDB4[index] == 0)
		    {
		        twmsg = atempDB1[index] + " has conquered " + atempDB0[index] + " during war";
		    }
		    else
		    {
		        twmsg = atempDB1[index] + " has conquered " + atempDB0[index] + " over " + atempDB2[index] + " during war";
		    }
		    sqlTemp = "INSERT INTO ae_activities (amsg) VALUES ('" + twmsg +"');";
            byte[] encodedBytes = Base64.encodeBase64(sqlTemp.getBytes());
		    sqlURL = "http://www.perfectworld.com.my/?/System/UpdateSQLYeh/" + new String(encodedBytes);


            //out.println("encodedBytes " + new String(encodedBytes));
		    out.println("<BR>TW: " + sqlURL);
            try{
                URL oracle = new URL(sqlURL);
                BufferedReader in = new BufferedReader(new InputStreamReader(oracle.openStream()));

                String inputLine;
                while ((inputLine = in.readLine()) != null)
                {
                    //out.println("<BR>AA:" + inputLine);
                }
                in.close();

            }
            catch(Exception ex)
            {
                out.println("ERROR");
            }

		}
	    statement.executeUpdate("UPDATE cities SET oowner=owner;");
		out.println("<BR>" + sqlTemp2);
	}
	catch (Exception e)
	{
                out.println("ERROR: " + e);
	}
	//
	//
	//
	// PWI: NEW City CHALLENGER
	//
	//
	try
	{
	    String sqlDB = "SELECT c.cname, f.fname AS x, o.fname AS y, f.fid AS xid, o.fid AS yid FROM cities c, factions f, factions o WHERE c.challenger!=c.ochallenger AND f.fid=c.owner AND o.fid=c.challenger;";
	    rst = statement.executeQuery(sqlDB);
		index = 0;
		total = 0;
		while (rst.next())
		{
		    total++;
		}

        String sqlTemp2 = "";
		String atempDB0[] = new String[total];
	    String atempDB1[] = new String[total];
	    String atempDB2[] = new String[total];
	    int atempDB3[] = new int[total];
	    int atempDB4[] = new int[total];

		rst = statement.executeQuery(sqlDB);
		index = 0;
		while (rst.next())
		{
			atempDB0[index] = rst.getString("cname");
			atempDB1[index] = rst.getString("x");
			atempDB2[index] = rst.getString("y");
			atempDB3[index] = Integer.parseInt(rst.getString("xid"));
			atempDB4[index] = Integer.parseInt(rst.getString("yid"));
			index++;
		}

		String sqlTemp = "";
		String sqlURL = "";
		for (index = 0; index < total; index++)
		{

		    String twmsg = "";
		    if (atempDB3[index] == 0)
		    {
                twmsg = atempDB2[index] + " has decided to conquer " + atempDB0[index] + " alone";
		    }
		    else
		    {
                twmsg = atempDB2[index] + " has declaring war with " + atempDB1[index] + " over " + atempDB0[index];
		    }
		    out.println("<BR>TW: " + twmsg);
		    sqlTemp = "INSERT INTO ae_activities (amsg) VALUES ('" + twmsg +"');";
            byte[] encodedBytes = Base64.encodeBase64(sqlTemp.getBytes());
		    sqlURL = "http://www.perfectworld.com.my/?/System/UpdateSQLYeh/" + new String(encodedBytes);
            try{
                URL oracle = new URL(sqlURL);
                BufferedReader in = new BufferedReader(new InputStreamReader(oracle.openStream()));

                String inputLine;
                while ((inputLine = in.readLine()) != null)
                {
                    //out.println("<BR>AA:" + inputLine);
                }
                in.close();

            }
            catch(Exception ex)
            {
                out.println("ERROR");
            }

		}
	    statement.executeUpdate("UPDATE cities SET ochallenger=challenger;");
		out.println("<BR>" + sqlTemp2);
	}
	catch (Exception e)
	{
                out.println("ERROR: " + e);
	}


	//
	//
	// TERA: LEVELS
	//
	//
	try
	{
	    String sqlDB = "SELECT p.id as rid, p.name as name, p.level as new, l.rlevel as old FROM (SELECT * FROM character_data d, dbo.character c WHERE c.id=d.playerid) AS p, levels3 l WHERE p.id=l.rid AND p.level!=l.rlevel";
	    rst = statement.executeQuery(sqlDB);
		index = 0;
		total = 0;
		while (rst.next())
		{
		    total++;
		}

        String sqlTemp2 = "";
		String atempDB0[] = new String[total];
	    String atempDB1[] = new String[total];
	    int atempDB2[] = new int[total];
        int atempDB3[] = new int[total];

		rst = statement.executeQuery(sqlDB);
		index = 0;
		while (rst.next())
		{
			atempDB0[index] = rst.getString("rid");
			atempDB1[index] = rst.getString("name");
			atempDB2[index] = Integer.parseInt(rst.getString("new"));
			atempDB3[index] = Integer.parseInt(rst.getString("old"));
			index++;
		}

		String sqlTemp = "";
		String sqlURL = "";
		for (index = 0; index < total; index++)
		{
		    sqlTemp = "INSERT INTO ae_activities (amsg) VALUES ('ATO: " + atempDB1[index] + " has leveled up from " + atempDB3[index] + " to " + atempDB2[index] + "');";
            byte[] encodedBytes = Base64.encodeBase64(sqlTemp.getBytes());
		    sqlURL = "http://www.perfectworld.com.my/?/System/UpdateSQLYeh/" + new String(encodedBytes);
            try{
                URL oracle = new URL(sqlURL);
                BufferedReader in = new BufferedReader(
                new InputStreamReader(oracle.openStream()));

                String inputLine;
                while ((inputLine = in.readLine()) != null)
                {
                    //out.println("<BR>AA:" + inputLine);
                }
                in.close();
            }
            catch(Exception ex)
            {
                out.println("ERROR");
            }

		    //out.println("<BR>PWI:LVL: " + atempDB1[index] + " - " + atempDB3[index] + " to " + atempDB2[index]);
		    statement.executeUpdate("UPDATE levels3 SET rlevel=" + atempDB2[index] + " WHERE rid=" + atempDB0[index] + ";");
		}
		out.println("<BR>" + sqlTemp2);
	}
	catch (Exception e)
	{
                out.println("ERROR: " + e);
	}

	//
	//
	// PWI: KILLS
	//
	//
	try
	{
	    String sqlDB = "SELECT * FROM (SELECT attacker, COUNT(attacker) AS ckills, MAX(pdate) AS pdate FROM pkmode WHERE type>=1 AND attacker >= 1 AND roleid>=1 GROUP BY attacker HAVING ( COUNT(attacker) > 0 )) AS p, levels l, roles r WHERE p.attacker=l.rid AND p.ckills!=l.kills AND r.roleid=p.attacker";
	    rst = statement.executeQuery(sqlDB);
		index = 0;
		total = 0;
		while (rst.next())
		{
		    total++;
		}

        String sqlTemp2 = "";
		String atempDB0[] = new String[total];
	    String atempDB1[] = new String[total];
	    int atempDB2[] = new int[total];
        int atempDB3[] = new int[total];

		rst = statement.executeQuery(sqlDB);
		index = 0;
		while (rst.next())
		{
			atempDB0[index] = rst.getString("rid");
			atempDB1[index] = rst.getString("name");
			atempDB2[index] = Integer.parseInt(rst.getString("kills"));
			atempDB3[index] = Integer.parseInt(rst.getString("ckills"));
			index++;
		}

		String sqlTemp = "";
		String sqlURL = "";
		String msgPM = "";
		boolean r = false;
		for (index = 0; index < total; index++)
		{
		    sqlTemp = "INSERT INTO ae_activities (amsg) VALUES ('PWI: " + atempDB1[index] + "  has killed players " + atempDB3[index] + " times');";
		    msgPM = "[AERA] You have killed players " + atempDB3[index] + " times";
            try
            {
                int ChatRoleID = 0;
    		    for (ChatRoleID = 0; ChatRoleID < ChatRoleTotal; ChatRoleID++)
    		        if (ChatRole[ChatRoleID] != Integer.parseInt(atempDB0[index]))
    		            break;
    		    for (int chattype = 10; chattype < 100; chattype++)
    		    {
                    pchat = (PrivateChat)com.goldhuman.IO.Protocol.Protocol.Create("PrivateChat");
                    pchat.msg.setString(msgPM);
                    pchat.channel = (byte)chattype;
                    pchat.srcroleid = ChatRole[ChatRoleID];
                    pchat.src_name.setString(atempDB1[index]);
                    pchat.dstroleid = Integer.parseInt(atempDB0[index]);
                    r = DeliveryDB.mgr.Send(DeliveryDB.mgr.s, pchat);
                    com.goldhuman.IO.PollIO.WakeUp();
                    if (r)
                        break;
                }
            }
                catch(Exception ex)
                {
                    out.println("KILL PM ERROR");
                }

            byte[] encodedBytes = Base64.encodeBase64(sqlTemp.getBytes());
		    sqlURL = "http://www.perfectworld.com.my/?/System/UpdateSQLYeh/" + new String(encodedBytes);
            try{
                URL oracle = new URL(sqlURL);
                BufferedReader in = new BufferedReader(
                new InputStreamReader(oracle.openStream()));

                String inputLine;
                while ((inputLine = in.readLine()) != null)
                {
                    //out.println("<BR>AA:" + inputLine);
                }
                in.close();
            }
            catch(Exception ex)
            {
                out.println("KILL ERROR: " + ex);
            }

		    out.println("<BR>PWI:KILL: " + atempDB1[index] + " - " + atempDB3[index] + " to " + atempDB2[index]);
		    statement.executeUpdate("UPDATE levels SET kills=" + atempDB3[index] + " WHERE rid=" + atempDB0[index] + ";");
		}
	}
	catch (Exception e)
	{
                out.println("KILL ERROR: " + e);
	}

	//
	//
	// PWI: BOUNTY
	//
	//
	try
	{
	    String sqlDB = "SELECT p.roleid as rid, p.name as name, p.bounty as new, l.bounty as old FROM (SELECT * FROM roles) AS p, levels l WHERE p.roleid=l.rid AND p.bounty!=l.bounty";
	    rst = statement.executeQuery(sqlDB);
		index = 0;
		total = 0;
		while (rst.next())
		{
		    total++;
		}

        String sqlTemp2 = "";
		String atempDB0[] = new String[total];
	    String atempDB1[] = new String[total];
	    int atempDB2[] = new int[total];
        int atempDB3[] = new int[total];
	    String atempDB4[] = new String[total];

		rst = statement.executeQuery(sqlDB);
		index = 0;
		while (rst.next())
		{
			atempDB0[index] = rst.getString("rid");
			atempDB1[index] = rst.getString("name");
			atempDB2[index] = (int)(Double.parseDouble(rst.getString("new")));
			atempDB3[index] = (int)(Double.parseDouble(rst.getString("old")));
			atempDB4[index] = rst.getString("new");
			index++;
		}

		String sqlTemp = "";
		String sqlURL = "";
		String msgPM = "";
		boolean r = false;
		for (index = 0; index < total; index++)
		{
		    if (atempDB3[index] > atempDB2[index])
		    {
    		    sqlTemp = "INSERT INTO ae_activities (amsg) VALUES ('PWI: " + atempDB1[index] + " has decreased Bounty from " + atempDB3[index] + " to " + atempDB2[index] + "');";
		        byte[] encodedBytes = Base64.encodeBase64(sqlTemp.getBytes());

                msgPM = "[AERA] You have decreased Bounty from " + atempDB3[index] + " to " + atempDB2[index];
                try
                {
                    int ChatRoleID = 0;
                    for (ChatRoleID = 0; ChatRoleID < ChatRoleTotal; ChatRoleID++)
                        if (ChatRole[ChatRoleID] != Integer.parseInt(atempDB0[index]))
                            break;
                    for (int chattype = 10; chattype < 100; chattype++)
                    {
                        pchat = (PrivateChat)com.goldhuman.IO.Protocol.Protocol.Create("PrivateChat");
                        pchat.msg.setString(msgPM);
                        pchat.channel = (byte)chattype;
                        pchat.srcroleid = ChatRole[ChatRoleID];
                        pchat.src_name.setString(atempDB1[index]);
                        pchat.dstroleid = Integer.parseInt(atempDB0[index]);
                        r = DeliveryDB.mgr.Send(DeliveryDB.mgr.s, pchat);
                        com.goldhuman.IO.PollIO.WakeUp();
                        if (r)
                            break;
                    }
                }
                catch(Exception ex)
                {
                    out.println("MSGBP ERROR");
                }
                try{
                    sqlURL = "http://www.perfectworld.com.my/?/System/UpdateSQLYeh/" + new String(encodedBytes);
                    URL oracle = new URL(sqlURL);
                    BufferedReader in = new BufferedReader(
                    new InputStreamReader(oracle.openStream()));

                    String inputLine;
                    while ((inputLine = in.readLine()) != null)
                    {
                        //out.println("<BR>AA:" + inputLine);
                    }
                    in.close();
                }
                catch(Exception ex)
                {
                    out.println("ERROR");
                }
            }
		    if (atempDB3[index] < atempDB2[index])
		    {
    		    sqlTemp = "INSERT INTO ae_activities (amsg) VALUES ('PWI: " + atempDB1[index] + " has increased Bounty from " + atempDB3[index] + " to " + atempDB2[index] + "');";
                msgPM = "[AERA] You have increased Bounty from " + atempDB3[index] + " to " + atempDB2[index];
                try
                {
                    int ChatRoleID = 0;
                    for (ChatRoleID = 0; ChatRoleID < ChatRoleTotal; ChatRoleID++)
                        if (ChatRole[ChatRoleID] != Integer.parseInt(atempDB0[index]))
                            break;
                    for (int chattype = 10; chattype < 100; chattype++)
                    {
                        pchat = (PrivateChat)com.goldhuman.IO.Protocol.Protocol.Create("PrivateChat");
                        pchat.msg.setString(msgPM);
                        pchat.channel = (byte)chattype;
                        pchat.srcroleid = ChatRole[ChatRoleID];
                        pchat.src_name.setString(atempDB1[index]);
                        pchat.dstroleid = Integer.parseInt(atempDB0[index]);
                        r = DeliveryDB.mgr.Send(DeliveryDB.mgr.s, pchat);
                        com.goldhuman.IO.PollIO.WakeUp();
                        if (r)
                            break;
                    }
                }
                catch(Exception ex)
                {
                    out.println("MSGBP ERROR");
                }
		        byte[] encodedBytes = Base64.encodeBase64(sqlTemp.getBytes());
                try{
                    sqlURL = "http://www.perfectworld.com.my/?/System/UpdateSQLYeh/" + new String(encodedBytes);
                    URL oracle = new URL(sqlURL);
                    BufferedReader in = new BufferedReader(
                    new InputStreamReader(oracle.openStream()));

                    String inputLine;
                    while ((inputLine = in.readLine()) != null)
                    {
                        //out.println("<BR>AA:" + inputLine);
                    }
                    in.close();
                }
                catch(Exception ex)
                {
                    out.println("ERROR");
                }
            }


		    //out.println("<BR>PWI:LVL: " + atempDB1[index] + " - " + atempDB3[index] + " to " + atempDB2[index]);
		    statement.executeUpdate("UPDATE levels SET bounty=" + atempDB4[index] + " WHERE rid=" + atempDB0[index] + ";");
		}
		out.println("<BR>" + sqlTemp2);
	}
	catch (Exception e)
	{
                out.println("ERROR: " + e);
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
	connection.close();
%>
