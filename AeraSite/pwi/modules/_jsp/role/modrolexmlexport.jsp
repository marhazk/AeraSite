    <%@ page contentType="text/html; charset=UTF-8" %>
        <%@page import="java.lang.*" %>
        <%@page import="java.util.*" %>
        <%@page import="java.io.*" %>
        <%@page import="java.text.*" %>
        <%@page import="org.apache.commons.lang.StringEscapeUtils" %>
        <%@page import="protocol.*" %>
        <%@page import="com.goldhuman.auth.*" %>
        <%@page import="org.apache.commons.logging.Log" %>
        <%@page import="org.apache.commons.logging.LogFactory" %>
        <%@page import="com.goldhuman.util.LocaleUtil" %>
        <%@page import="java.sql.*" %>
        <%@page import="java.sql.Date" %>
        <%@ page import="java.sql.*,java.net.*,java.io.*,java.lang.*,java.util.*" %>
        <%@page import="org.apache.commons.codec.binary.Base64" %>
            <%
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

	SimpleDateFormat sdf = new SimpleDateFormat( "yyyy-MM-dd hh:mm:ss" );
	// 07/02/2008 03:22:32
	String snow=sdf.format(now);
	out.println( snow );

	Connection connection = null;
    Class.forName("sun.jdbc.odbc.JdbcOdbcDriver");
    connection = DriverManager.getConnection("jdbc:mysql://192.168.1.5/dbo?useUnicode=true&amp;characterEncoding=UTF-8", "aera", "870830");

	Statement statement = connection.createStatement();


com.goldhuman.Common.Octets.setDefaultCharset("UTF-16LE");
String strRoleId = request.getParameter("roleid");
String strRoleName = request.getParameter("name");

LogFactory.getLog("modrolexml.jsp").info("request xml for roleid=" + strRoleId + ",name=" + strRoleName + ",operator=" + AuthFilter.getRemoteUser(session) );

int roleid = -1;
if( null != strRoleId && strRoleId.length() > 0 )
	roleid = Integer.parseInt(request.getParameter("roleid"));

if( -1 == roleid && null != strRoleName && strRoleName.length() > 0 )
{
	try{ roleid = GameDB.getRoleIdByName( strRoleName ); }
	catch (Exception e) { out.println(e.toString()); return; }
	if( -1 == roleid )
	{
		out.println(LocaleUtil.getMessage(request,"role_modrolexml_notsearchrole") + strRoleName + LocaleUtil.getMessage(request,"role_modrolexml_noroletimeout"));
		return;
	}
}
if( -1 == roleid )
{
	out.println(LocaleUtil.getMessage(request,"role_modrolexml_inputrolename"));
	return;
}

String xmlstring = null;
byte[] xmlbytes = null;
try{
	XmlRole.Role role = XmlRole.getRoleFromDB(roleid);
	if( null == role )
	{
		out.println(LocaleUtil.getMessage(request,"role_modrolexml_retry"));
		return;
	}
	xmlbytes = XmlRole.toXMLByteArray(role);
	if( null == xmlbytes )
	{
		out.println(LocaleUtil.getMessage(request,"role_modrolexml_failtoxml"));
		return;
	}
	xmlstring = new String( xmlbytes, "UTF-8" );

	Runtime.getRuntime().exec("/bin/mkdir -p /var/spool/rolexml/outcoming");
	(new FileOutputStream("/var/spool/rolexml/outcoming/" 
		+roleid+"_"+System.currentTimeMillis()/1000+".xml"))
		.write(xmlstring.getBytes("UTF-8"));
}
catch (Exception e) { out.println(e.toString()); return; }
LogFactory.getLog("modrolexml.jsp").info("getRoleInfoXML success, roleid=" + roleid + ",name=" + strRoleName + ",operator=" + AuthFilter.getRemoteUser(session) );

            byte[] encodedBytes = Base64.encodeBase64(xmlstring.getBytes());
String msgout= "";
String xml64 = new String(encodedBytes);
String tempsql = "INSERT INTO rolesxml (roleid, xml, xml64, lastadded) VALUES ('" +strRoleId+ "', '"+xmlstring+"', '"+xml64+"', '"+snow+"');";
                        try
                        {

                        	ResultSet rst=null;
                            rst = statement.executeQuery("SELECT xid FROM rolesxml WHERE xml64='"+xml64+"';");
                            int xmltotal = 0;
                            while (rst.next())
                            {
                                xmltotal++;
                            }
                            if (xmltotal >= 1)
                                msgout = "Player "+strRoleId+" failed to exported to XML DB. DATA EXIST in DB";
                            else
                            {
                            //out.println();
                                statement.executeUpdate(tempsql);
                                msgout = "Player "+strRoleId+" has been exported to XML DB";
                                }
                            %>
<meta http-equiv="refresh" content="0;index.jsp?msg=<%=msgout%>&rid=<%=strRoleId%>" />
        <%
                        }
                        catch (Exception e)
                        {
                            out.println("<BR>ERROR SQL: " + e + " <BR>" + tempsql);
                        }
%>
