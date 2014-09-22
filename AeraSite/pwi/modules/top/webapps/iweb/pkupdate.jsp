<%@page import="java.sql.*"%>
<%@page import="protocol.*"%>
<%@page import="java.io.*"%>
<%@page import="java.text.*"%>
<%@page import="org.apache.commons.logging.LogFactory"%>
<%@page import="java.util.Iterator"%>
<%@page import="com.goldhuman.Common.Octets"%>
<%@page import="com.goldhuman.IO.Protocol.Rpc.Data.DataVector"%>
<%@page import="org.apache.commons.lang.StringEscapeUtils"%>
<%@ page language="java" import="java.sql.*" errorPage="" %>
<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8"%> 
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
<%
	Connection connection = null;
	Class.forName("com.mysql.jdbc.Driver").newInstance();
	connection = DriverManager.getConnection("jdbc:mysql://192.168.1.2/dbo","root", "5449");
	ResultSet rst = null;
	RoleBean role = null;
	String tempplayername = null;
	int count = 0;
	int level = 0;
	int rep = 0;
	String cls = null;
	String gender = null;
	PreparedStatement UpdateInfo = null;
try {
	Statement statement = connection.createStatement();
	rst = statement.executeQuery("SELECT ID FROM users ORDER BY ID ASC");
	
	int index = 0;
	while (rst.next())
		{	
			//Prepare Statement
			try
			{
				UpdateInfo = connection.prepareStatement("UPDATE pkrank SET name=?, clasa=?, level=?, reputation=?, gender=? WHERE userid=?");
			}
			catch (Exception e)
			{
				UpdateInfo = connection.prepareStatement("INSERT INTO pkrank (name, clasa, level, reputation, gender, userid) VALUES (?,?,?,?,?,?)");
			}
			int roleid = rst.getInt("ID");
			role = GameDB.get( roleid );			
			if (null == role)
			{
			}
			else 
			{
			try{
				tempplayername = null;
				tempplayername = StringEscapeUtils.escapeHtml(role.base.name.getString()); 
				index = 0;
				index = tempplayername.indexOf("'");
				StringBuffer playername = new StringBuffer(tempplayername);
				if(index > 0)
				{
					playername.replace(index, index + 1, "?");
				}

			switch(role.base.cls)
			{
				case 0:	cls = "0"; break;
				case 1:	cls = "1"; break;
				case 2:	cls = "2"; break;
				case 3:	cls = "3"; break;
				case 4:	cls = "4"; break;
				case 5:	cls = "5"; break;
				case 6:	cls = "6"; break;
				case 7:	cls = "7"; break;
				case 8:	cls = "8"; break;
				case 9:	cls = "9"; break;
				default:	cls = "Unknown";
			}
			
				level = role.status.level;
				rep = role.status.reputation;

			
			gender = (role.base.gender == 0) ? "0" : "1";	

         
    }
    catch (Exception e)
    {
        continue;
    }				
			}
			UpdateInfo.setString(1, tempplayername);
			UpdateInfo.setString(2, cls);
			UpdateInfo.setInt(3, level);
			UpdateInfo.setInt(4, rep);
			UpdateInfo.setString(5, gender);
			UpdateInfo.setInt(6, roleid);
			UpdateInfo.executeUpdate();
			count++;			
		}
}
catch (Exception e)
{
	out.println("<font color=red>Error Occured But System Added <b>" + count + "</b> Characters.<br>");
	out.println(e);
}	



if (count > 0) {
out.println("<font color=green><br>Complete Updated: <b>" + count + "</b> Characters.<br><br>");
}
else
{
out.println("<br><font color=red>No Characters available to add!");
}
try{
         if(connection!=null){
             connection.close();
         }
         if(rst!=null){
             rst.close();
         }
         
         if(UpdateInfo!=null){
          UpdateInfo.close();
         }
    }
    catch(Exception e)
    {
        e.printStackTrace();
    }
%>