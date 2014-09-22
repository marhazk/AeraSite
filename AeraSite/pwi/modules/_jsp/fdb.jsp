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

<META HTTP-EQUIV=Window-target CONTENT=shoutboxform>
</head>

<P><% out.println("DB LAST COUNTER: 1"); %> </p>
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

	RoleBean role = null;

	// /////////////////////////////
	//
	// THIRD SYSTEM (UPDATING)
	//
	// /////////////////////////////
	int uid = 0;
	while (uid < 20)
	{
		//		
		//DECLARATION START
		//
		uid = uid+1;
		role = FactionDB[ uid ];
		session.setAttribute( "factiondb_rolebean", role );
		out.println("<br>FOUND :"+uid);
		if (null == role){
			continue;
		}
		else
		{
			out.println("<br>Trying to STORE roleid:"+uid);
			out.println(" ID : "+role.id);
			tempplayername = null;
			tempplayername = StringEscapeUtils.escapeHtml(role.name.getString()).replaceAll("'","");
			out.println(" Name:"+tempplayername);
		}
	}

%>
<center>
<a name=_bottom>Copyright by MarHazK</a>
</center>
<%
	// Overviews:
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
