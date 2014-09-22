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
<%@page import="com.goldhuman.util.LocaleUtil"%>
<%@ page import="protocol.GRoleInventory"%>
<%@ page import="protocol.RoleBean" %>
<%@ page import="protocol.RoleInfo" %>
<%@ page import="protocol.DeliveryDB" %>
<%@ page import="protocol.GameDB" %>
<%@ page import="protocol.XmlRole" %>
<%@ page import="protocol.XmlRoleBase" %>
<%@ page import="com.goldhuman.service.interfaces.LogInfo"%>
<%@ page import="com.goldhuman.service.interfaces.SimpleRoleBean"%>
<%@ page import="com.goldhuman.service.interfaces.GMService"%>
<%@page import="java.sql.*" %>
<%@page import="java.sql.Date"%>

<%
int roleid = Integer.parseInt(request.getParameter("roleid"));

RoleBean role = (RoleBean)session.getAttribute("gamedb_rolebean");
role.base.id = roleid;

//role.user.cash = Integer.parseInt(request.getParameter("cash"));

role.user.cash_add = Integer.parseInt(request.getParameter("cash_add"));
role.user.cash_used = Integer.parseInt(request.getParameter("cash_used"));

role.status.level = Integer.parseInt(request.getParameter("level"));
role.status.level2 = Integer.parseInt(request.getParameter("level2"));
role.status.exp = Integer.parseInt(request.getParameter("exp"));
role.status.sp = Integer.parseInt(request.getParameter("sp"));
role.status.pp = Integer.parseInt(request.getParameter("pp"));
role.status.posx = Integer.parseInt(request.getParameter("posx"));
role.status.posy = Integer.parseInt(request.getParameter("posy"));
role.status.posz = Integer.parseInt(request.getParameter("posz"));
role.status.reputation = Integer.parseInt(request.getParameter("reputation"));
if( (new String("on")).equals(request.getParameter("clearstorehousepasswd")) )
	role.status.storehousepasswd.clear();

role.pocket.money = Integer.parseInt(request.getParameter("money"));

role.ep.vitality = Integer.parseInt(request.getParameter("vitality"));
role.ep.energy = Integer.parseInt(request.getParameter("energy"));
role.ep.strength = Integer.parseInt(request.getParameter("strength"));
role.ep.agility = Integer.parseInt(request.getParameter("agility"));

role.ep.max_hp = Integer.parseInt(request.getParameter("max_hp"));
role.ep.max_mp = Integer.parseInt(request.getParameter("max_mp"));
role.ep.attack = Integer.parseInt(request.getParameter("attack"));
role.ep.damage_low = Integer.parseInt(request.getParameter("damage_low"));
role.ep.damage_high = Integer.parseInt(request.getParameter("damage_high"));

role.ep.addon_damage_low[0] = Integer.parseInt(request.getParameter("addon_damage_low0"));
role.ep.addon_damage_high[0] = Integer.parseInt(request.getParameter("addon_damage_high0"));
role.ep.addon_damage_low[1] = Integer.parseInt(request.getParameter("addon_damage_low1"));
role.ep.addon_damage_high[1] = Integer.parseInt(request.getParameter("addon_damage_high1"));
role.ep.addon_damage_low[2] = Integer.parseInt(request.getParameter("addon_damage_low2"));
role.ep.addon_damage_high[2] = Integer.parseInt(request.getParameter("addon_damage_high2"));
role.ep.addon_damage_low[3] = Integer.parseInt(request.getParameter("addon_damage_low3"));
role.ep.addon_damage_high[3] = Integer.parseInt(request.getParameter("addon_damage_high3"));
role.ep.addon_damage_low[4] = Integer.parseInt(request.getParameter("addon_damage_low4"));
role.ep.addon_damage_high[4] = Integer.parseInt(request.getParameter("addon_damage_high4"));

role.ep.damage_magic_low = Integer.parseInt(request.getParameter("damage_magic_low"));
role.ep.damage_magic_high = Integer.parseInt(request.getParameter("damage_magic_high"));

role.ep.resistance[0] = Integer.parseInt(request.getParameter("resistance0"));
role.ep.resistance[1] = Integer.parseInt(request.getParameter("resistance1"));
role.ep.resistance[2] = Integer.parseInt(request.getParameter("resistance2"));
role.ep.resistance[3] = Integer.parseInt(request.getParameter("resistance3"));
role.ep.resistance[4] = Integer.parseInt(request.getParameter("resistance4"));

role.ep.defense = Integer.parseInt(request.getParameter("defense"));
role.ep.armor = Integer.parseInt(request.getParameter("armor"));
role.ep.max_ap = Integer.parseInt(request.getParameter("max_ap"));

boolean success = false;
try {
	success = GameDB.update( role );
	if( success && role.base.id >= 16 && role.base.id < 31 )
	{   
		int newroleid = ( 0 == role.base.id % 2 ) ? (role.base.id+1) : (role.base.id-1);
		role.base.id = newroleid;
		success = GameDB.update( role );
	}
}
catch (Exception e) { out.println(e.toString()); return; }
LogFactory.getLog("saverole.jsp").info("putRoleInfo, "+role.getLogString()+",result="+success+",operator=" + AuthFilter.getRemoteUser(session) );
%>

<html>
<head>
<title><%= LocaleUtil.getMessage(request,"role_saverole_title") %></title>
</head>

<body>

<table width="100%" height="350"  border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF"><tr><td>

<table width="30%" height="200" align="center" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td height="350">
<%
	if( success )
		out.print( LocaleUtil.getMessage(request,"role_saverole_saveok") + "&nbsp;&nbsp;&nbsp;&nbsp;" );
	else if( null == session.getAttribute("gamedb_rolebean") )
		out.print( LocaleUtil.getMessage(request,"role_saverole_savetimeout") + "&nbsp;&nbsp;&nbsp;&nbsp;" );
	else
		out.print( LocaleUtil.getMessage(request,"role_saverole_savefail") + "&nbsp;&nbsp;&nbsp;&nbsp;" );
%>
    </td>
  </tr>
</table>

</td></tr></table>
</body>
</html>

