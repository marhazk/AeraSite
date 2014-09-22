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
	
	roleid = 32;
			try
			{
				//out.println("<br>Reading roleid:"+roleid);
				role = GameDB.get( roleid );
				session.setAttribute( "gamedb_rolebean", role );
				if (null == role){
					out.println("<br>FAIL Reading roleid:"+roleid);
				}
				else
				{
					out.println("<br>TEST to STORE roleid:"+roleid);
					
				}
			}
			catch (Exception e)
			{
				out.println("<br><B>FAIL UPDATED: "+e+"</B> SQL:");
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
