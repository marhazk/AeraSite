        <% // FOLDER: /opt/jakarta-tomcat-5.5.9/webapps/iweb %>
                <% @page contentType = "text/html; charset=GBK" %>
                <% @page import = "java.lang.*" %>
                <% @page import = "java.util.*" %>
                <% @page import = "java.text.*" %>
                <% @page import = "org.apache.commons.lang.StringEscapeUtils" %>
                <% @page import = "org.apache.commons.logging.LogFactory" %>
                <% @page import = "org.apache.commons.logging.Log" %>
                <% @page import = "protocol.*" %>
                <% @ page import = "protocol.GRoleInventory" %>
                <% @ page import = "protocol.RoleBean" %>
                <% @ page import = "protocol.RoleInfo" %>
                <% @ page import = "protocol.DeliveryDB" %>
                <% @ page import = "protocol.GameDB" %>
                <% @ page import = "protocol.XmlRole" %>
                <% @ page import = "protocol.XmlRoleBase" %>
                <% @ page import = "com.goldhuman.auth.*" %>
                <% @ page import = "com.goldhuman.auth.AuthFilter" %>
                <% @ page import = "com.goldhuman.service.interfaces.LogInfo" %>
                <% @ page import = "com.goldhuman.service.interfaces.SimpleRoleBean" %>
                <% @ page import = "com.goldhuman.service.interfaces.GMService" %>
                <% @ page import = "com.goldhuman.service.GMServiceImpl" %>
                <% @ page import = "com.goldhuman.util.LocaleUtil" %>
                <% @page import = "java.sql.*" %>
                <% @page import = "java.sql.Date" %>
                <% @ page import = "java.sql.*,java.net.*,java.io.*,java.lang.*,java.util.*" %>
                <% @page import = "org.apache.commons.codec.binary.Base64" %>
            <html>
            <head>
            </head>
            <P>DB LAST UPDATED:<%= new java . util . Date() %></p>
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

java . sql . Date now = new java . sql . Date(System . currentTimeMillis());
SimpleDateFormat sdf_e = new SimpleDateFormat("EEE");        //Tue
SimpleDateFormat sdf_f = new SimpleDateFormat("F");        //2
SimpleDateFormat sdf_d = new SimpleDateFormat("dd");        //04
SimpleDateFormat sdf_m = new SimpleDateFormat("MM");        //09
SimpleDateFormat sdf_y = new SimpleDateFormat("yyyy");    //2009
SimpleDateFormat sdf_hh = new SimpleDateFormat("HH");        //13
SimpleDateFormat sdf_mm = new SimpleDateFormat("mm");        //43
SimpleDateFormat sdf_ss = new SimpleDateFormat("ss");        //23

String snow_e = sdf_e . format(now) . toLowerCase();                //toLowerCase or toUpperCase
int snow_f = Integer . parseInt(sdf_f . format(now));
int snow_d = Integer . parseInt(sdf_d . format(now));
int snow_m = Integer . parseInt(sdf_m . format(now));
int snow_y = Integer . parseInt(sdf_y . format(now));
int snow_hh = Integer . parseInt(sdf_hh . format(now));
int snow_mm = Integer . parseInt(sdf_mm . format(now));
int snow_ss = Integer . parseInt(sdf_ss . format(now));

SimpleDateFormat sdf = new SimpleDateFormat("dd/MM/yyyy hh:mm:ss");
// 07/02/2008 03:22:32
String snow = sdf . format(now);
out . println(snow);

Connection connection = null;
Class.forName("sun.jdbc.odbc.JdbcOdbcDriver");
connection = DriverManager . getConnection("jdbc:mysql://192.168.1.5/dbo?useUnicode=true&amp;characterEncoding=UTF-8", "aera", "870830");

Statement statement = connection . createStatement();


//
//CLEAR uwebplayers DATABASE
//
//String deleteall = "DELETE FROM uwebplayers";
//statement.executeUpdate(deleteall);

//
//GET USER DB FIRST
//
ResultSet rst = null;
ResultSet rstx = null;
ResultSet onlinerst = null;
ResultSet fixonlinerst = null;
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

int RoleDB0[];
int RoleDB1[];
int RoleDB2[];
int RoleDB3[];
int RoleDB4[];
int RoleDB5[];
int RoleDB6[];
int RoleDB7[];
int RoleDB8[];
int battlepower_max[];
int battlepower_min[];
int battlepower_full[];


GMService gs = new GMServiceImpl();
LogInfo info = null;
RoleBean role = null;
RoleBean crbrole = null;


Iterator itr;
GRoleInventory grp;

string[] tmp1, tmp2, tmp3, tmp4, tmp5;
bool success = false;
char v1 = ' ';
char v2 = ':';
char v3 = '=';


string[] val = new string[2];
string[] values = new string[1] {
    null };
string[] attr = new string[1] {
    null };
tmp1 = value . Split(v1);
if ((tmp1 . Length == 10) && (tmp1[4] == "chat"))
{

    tmp2 = tmp1[6] . Split(v2);
                tmp3 = tmp1[7] . Split(v3);
                tmp4 = tmp1[8] . Split(v3);
                string str = tmp1[9] . Replace("msg=", "");
                //byte[] b = Convert.FromBase64String(str);
                //values[4] = Encoding.Unicode.GetString(b);
                values = new String[] {
    tmp1[0] + " " + tmp1[1],
                        tmp2[0],
                        tmp3[1],
                        tmp4[1],
                        str
                    };
                attr = new String[] {
    "cdate", "type", "src", "dst", "msg" };
                value = values[0] + "," + values[1] + "," + values[2] + "," + values[3] + "," + values[4];
                val     = getSQL(attr, "chats", value);
                success = true;
            }
if ((tmp1 . Length == 7) && (tmp1[4] == "notice"))
{
    tmp2 = tmp1[6] . Split(v2);
                if ((tmp2 . Length == 5) && (tmp2[1] == "die"))
                {
                    tmp3 = tmp2[2] . Split(v3);
                    tmp4 = tmp2[3] . Split(v3);
                    tmp5 = tmp2[4] . Split(v3);
                    string temp = null;
                    if (Convert . ToInt32(tmp5[1]) >= 1)
                        temp = "1";
                    else
                        temp = "0";

                    values = new String[] {
                    tmp1[0] + " " + tmp1[1],
                        tmp3[1],
                        tmp4[1],
                        tmp5[1],
                        temp
                    };
                    attr = new String[] {
                    "pdate", "roleid", "type", "attacker", "pk" };
                    value = values[0] + "," + values[1] + "," + values[2] + "," + values[3] + "," + values[4];
                    val     = getSQL(attr, "pkmode", value);
                    success = true;
                }
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
connection . close();
%>
