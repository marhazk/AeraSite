<%@page contentType="text/html; charset=GBK"%>
<%@page import="java.lang.*"%>
<%@page import="protocol.*"%>
<%@page import="com.goldhuman.auth.*"%>
<%@page import="org.apache.commons.logging.Log"%>
<%@page import="org.apache.commons.logging.LogFactory"%>
<%
int roleid = Integer.parseInt(request.getParameter("roleid"));

RoleBean role = (RoleBean)session.getAttribute("gamedb_rolebean");
role.base.id = roleid;

//role.user.cash = Integer.parseInt(request.getParameter("cash"));

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
try { success = GameDB.update( role ); }
catch (Exception e) { out.println(e.toString()); return; }
LogFactory.getLog("saverole.jsp").info("putRoleInfo, "+role.getLogString()+",result="+success+",operator=" + AuthFilter.getRemoteUser(session) );
%>

<html>
<head>
<link href="../include/style.css" rel="stylesheet" type="text/css">
<title>角色信息管理-保存</title>
</head>

<body>
<%@include file="../include/header.jsp"%>
<table width="100%" height="350"  border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF"><tr><td>

<table width="30%" height="200" align="center" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td height="350">
<%
	if( success )
		out.print( "角色信息保存成功。&nbsp;&nbsp;&nbsp;&nbsp;" );
	else if( null == session.getAttribute("gamedb_rolebean") )
		out.print( "角色信息保存失败。登录时间过长，已经超时。请重新登录。&nbsp;&nbsp;&nbsp;&nbsp;" );
	else
		out.print( "角色信息保存失败。&nbsp;&nbsp;&nbsp;&nbsp;" );
%>
    </td>
  </tr>
</table>

</td></tr></table>
<%@include file="../include/foot.jsp"%>
</body>
</html>

