<%@page contentType="text/html; charset=GBK"%>
<%@page import="java.lang.*"%>
<%@page import="java.util.*"%>
<%@page import="java.text.*"%>
<%@page import="org.apache.commons.lang.StringEscapeUtils"%>
<%@page import="protocol.*"%>
<%@page import="com.goldhuman.auth.*"%>
<%@page import="org.apache.commons.logging.Log"%>
<%@page import="org.apache.commons.logging.LogFactory"%>
<%
String strRoleId = request.getParameter("roleid");
String strRoleName = request.getParameter("name");

LogFactory.getLog("modrole.jsp").info("request for roleid=" + strRoleId + ",name=" + strRoleName + ",operator=" + AuthFilter.getRemoteUser(session) );

int roleid = -1;
if( null != strRoleId && strRoleId.length() > 0 )
	roleid = Integer.parseInt(request.getParameter("roleid"));

if( -1 == roleid && null != strRoleName && strRoleName.length() > 0 )
{
	try{ roleid = GameDB.getRoleIdByName( strRoleName ); }
	catch (Exception e) { out.println(e.toString()); return; }
	if( -1 == roleid )
	{
		out.println("无法查到该角色：" + strRoleName + "，可能没有该角色或访问超时。" );
		return;
	}
}
if( -1 == roleid )
{
	out.println("请输入角色ID或者角色名称。");
	return;
}
RoleBean role = null;
try{
	role = GameDB.get( roleid );
	session.setAttribute( "gamedb_rolebean", role );
}
catch (Exception e) { out.println(e.toString()); return; }
if (null == role)
{
	out.println("从数据库获取角色信息失败，可能没有该角色或访问超时。请重试。");
	return;
}
LogFactory.getLog("modrole.jsp").info("getRoleInfo, "+role.getLogString()+",operator=" + AuthFilter.getRemoteUser(session) );
String rolename;
switch( roleid )
{
	case 16:	rolename = "武侠-男";	break;
	case 17:	rolename = "武侠-女";	break;
	case 18:	rolename = "法师-男";	break;
	case 19:	rolename = "法师-女";	break;
	case 20:    rolename = "僧侣-男";	break;
	case 21:    rolename = "僧侣-女";	break;
	case 22:    rolename = "妖精-男";	break;
	case 23:    rolename = "妖精-女";	break;
	case 24:    rolename = "妖兽-男";	break;
	case 25:    rolename = "妖兽-女";	break;
	case 26:    rolename = "魅灵-男";	break;
	case 27:    rolename = "魅灵-女";	break;
	case 28:    rolename = "羽芒-男";	break;
	case 29:    rolename = "羽芒-女";	break;
	case 30:    rolename = "羽灵-男";	break;
	case 31:    rolename = "羽灵-女";	break;
	default:	rolename = "普通角色";
}
%>


<html>
<head>
<link href="../include/style.css" rel="stylesheet" type="text/css">
<title>角色信息管理-修改</title>
</head>

<body>
<%@include file="../include/header.jsp"%>
<table width="100%" height="350"  border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF"><tr><td>

<form action="saverole.jsp" method="post">
<input type="hidden" name="roleid" value="<%=roleid%>">
<table width="80%" height="300" align="center" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td height="30" colspan="4" class="table_title"><%=rolename%>(roleid=<%=roleid%>)&nbsp;&nbsp;--&nbsp;角色初始信息</td>
  </tr>

  <tr>
    <td height="20">名称：&nbsp;&nbsp;<%=StringEscapeUtils.escapeHtml(role.base.name.getString())%></td>
    <td height="20">种族：&nbsp;&nbsp;<%=role.base.race%></td>
    <td height="20">职业：&nbsp;&nbsp;<%=RoleBean.ClsName(role.base.cls)%></td>
    <td height="20">性别：&nbsp;&nbsp;<%=RoleBean.GenderName(role.base.gender)%></td>
  </tr>
  <tr>
    <td height="20">状态：&nbsp;&nbsp;&nbsp;&nbsp;<%=RoleBean.StatusName(role.base.status)%></td>
    <td height="20">删除时间：&nbsp;&nbsp;&nbsp;&nbsp;<%=role.base.delete_time<=0 ? "-" : (new SimpleDateFormat("y/M/d H:m:s")).format(new Date(1000*(long)role.base.delete_time))%></td>
    <td height="20">创建时间：&nbsp;&nbsp;&nbsp;&nbsp;<%=role.base.create_time<=0 ? "-" : (new SimpleDateFormat("y/M/d H:m:s")).format(new Date(1000*(long)role.base.create_time))%></td>
    <td height="20">上次登录时间：&nbsp;&nbsp;&nbsp;&nbsp;<%=role.base.lastlogin_time<=0 ? "-" : (new SimpleDateFormat("y/M/d H:m:s")).format(new Date(1000*(long)role.base.lastlogin_time))%></td>
  </tr>
  <tr>
    <td height="20">世界：&nbsp;&nbsp;&nbsp;&nbsp;<%=role.status.worldtag%></td>
    <td height="20">红名状态：&nbsp;&nbsp;&nbsp;&nbsp;<%=role.status.invader_state%></td>
    <td height="20">红名时间：&nbsp;&nbsp;&nbsp;&nbsp;<%=role.status.invader_time%></td>
    <td height="20">粉名时间：&nbsp;&nbsp;&nbsp;&nbsp;<%=role.status.pariah_time%></td>
  </tr>
  <tr>
    <td height="20" colspan="3">声望：&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="reputation" value="<%=role.status.reputation%>" size="12" maxlength="10"/></td>
    <td height="20"><input type="checkbox" name="clearstorehousepasswd">清除仓库密码：&nbsp;&nbsp;&nbsp;&nbsp;</td>
  </tr>
  <tr><td colspan="4">&nbsp;</td></tr>
  <tr>
    <td height="20" colspan="1">总充值金元宝：&nbsp;&nbsp;&nbsp;&nbsp;<%=role.user.cash_add%></td>
    <td height="20" colspan="1">总买入金元宝：&nbsp;&nbsp;&nbsp;&nbsp;<%=role.user.cash_buy%></td>
    <td height="20" colspan="1">总卖出金元宝：&nbsp;&nbsp;&nbsp;&nbsp;<%=role.user.cash_sell%></td>
    <td height="20" colspan="1">总消费金元宝：&nbsp;&nbsp;&nbsp;&nbsp;<%=role.user.cash_used%></td>
  </tr>
  <tr>
    <td height="20">级别：&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="level" value="<%=role.status.level%>" size="5" maxlength="3"/></td>
    <td height="20">修真级别：&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="level2" value="<%=role.status.level2%>" size="5" maxlength="3"/></td>
    <td height="20">经验值：&nbsp;&nbsp;<input type="text" name="exp" value="<%=role.status.exp%>" size="12" maxlength="10"/></td>
    <td height="20">技能点：&nbsp;&nbsp;<input type="text" name="sp" value="<%=role.status.sp%>" size="12" maxlength="10"/></td>
  </tr>
  <tr>
    <td height="20">属性点：&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="pp" value="<%=role.status.pp%>" size="12" maxlength="10"/></td>
    <td height="20">初始坐标X：&nbsp;<input type="text" name="posx" value="<%=(int)role.status.posx%>" size="5" maxlength="6"/></td>
    <td height="20">初始坐标Y：&nbsp;<input type="text" name="posy" value="<%=(int)role.status.posy%>" size="5" maxlength="6"/></td>
    <td height="20">初始坐标Z：&nbsp;<input type="text" name="posz" value="<%=(int)role.status.posz%>" size="5" maxlength="6"/></td>
  </tr>
  <tr>
    <td height="20">金钱：&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="money" value="<%=role.pocket.money%>" size="12" maxlength="10"/></td>
    <td height="20">命：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="vitality" value="<%=role.ep.vitality%>" size="12" maxlength="10"/></td>
    <td height="20">神：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="energy" value="<%=role.ep.energy%>" size="12" maxlength="10"/></td>
    <td height="20">力：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="strength" value="<%=role.ep.strength%>" size="12" maxlength="10"/></td>
  </tr>
  <tr>
    <td height="20">敏：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="agility" value="<%=role.ep.agility%>" size="12" maxlength="10"/></td>
    <td height="20">最大HP：&nbsp;<input type="text" name="max_hp" value="<%=role.ep.max_hp%>" size="12" maxlength="10"/></td>
    <td height="20">最大MP：&nbsp;<input type="text" name="max_mp" value="<%=role.ep.max_mp%>" size="12" maxlength="10"/></td>
    <td height="20">攻击率：&nbsp;&nbsp;<input type="text" name="attack" value="<%=role.ep.attack%>" size="12" maxlength="10"/></td>
  </tr>
  <tr>
    <td height="20" colspan="2">最低物理damage：&nbsp;<input type="text" name="damage_low" value="<%=role.ep.damage_low%>" size="12" maxlength="10"/></td>
    <td height="20" colspan="2">最大物理damage：&nbsp;<input type="text" name="damage_high" value="<%=role.ep.damage_high%>" size="12" maxlength="10"/></td>
  </tr>
  <tr>
    <td height="20" colspan="2">最低金系damage：&nbsp;<input type="text" name="addon_damage_low0" value="<%=role.ep.addon_damage_low[0]%>" size="12" maxlength="10"/></td>
    <td height="20" colspan="2">最大金系damage：&nbsp;<input type="text" name="addon_damage_high0" value="<%=role.ep.addon_damage_high[0]%>" size="12" maxlength="10"/></td>
  </tr>
  <tr>
    <td height="20" colspan="2">最低木系damage：&nbsp;<input type="text" name="addon_damage_low1" value="<%=role.ep.addon_damage_low[1]%>" size="12" maxlength="10"/></td>
    <td height="20" colspan="2">最大木系damage：&nbsp;<input type="text" name="addon_damage_high1" value="<%=role.ep.addon_damage_high[1]%>" size="12" maxlength="10"/></td>
  </tr>
  <tr>
    <td height="20" colspan="2">最低水系damage：&nbsp;<input type="text" name="addon_damage_low2" value="<%=role.ep.addon_damage_low[2]%>" size="12" maxlength="10"/></td>
    <td height="20" colspan="2">最大水系damage：&nbsp;<input type="text" name="addon_damage_high2" value="<%=role.ep.addon_damage_high[2]%>" size="12" maxlength="10"/></td>
  </tr>
  <tr>
    <td height="20" colspan="2">最低火系damage：&nbsp;<input type="text" name="addon_damage_low3" value="<%=role.ep.addon_damage_low[3]%>" size="12" maxlength="10"/></td>
    <td height="20" colspan="2">最大火系damage：&nbsp;<input type="text" name="addon_damage_high3" value="<%=role.ep.addon_damage_high[3]%>" size="12" maxlength="10"/></td>
  </tr>
  <tr>
    <td height="20" colspan="2">最低土系damage：&nbsp;<input type="text" name="addon_damage_low4" value="<%=role.ep.addon_damage_low[4]%>" size="12" maxlength="10"/></td>
    <td height="20" colspan="2">最大土系damage：&nbsp;<input type="text" name="addon_damage_high4" value="<%=role.ep.addon_damage_high[4]%>" size="12" maxlength="10"/></td>
  </tr>
  <tr>
    <td height="20" colspan="2">魔法最低攻击力：&nbsp;<input type="text" name="damage_magic_low" value="<%=role.ep.damage_magic_low%>" size="12" maxlength="10"/></td>
    <td height="20" colspan="2">魔法最高攻击力：&nbsp;<input type="text" name="damage_magic_high" value="<%=role.ep.damage_magic_high%>" size="12" maxlength="10"/></td>
  </tr>
  <tr>
    <td height="20" colspan="2">金系魔法抗性：&nbsp;<input type="text" name="resistance0" value="<%=role.ep.resistance[0]%>" size="12" maxlength="10"/></td>
    <td height="20" colspan="2">木系魔法抗性：&nbsp;<input type="text" name="resistance1" value="<%=role.ep.resistance[1]%>" size="12" maxlength="10"/></td>
  </tr>
  <tr>
    <td height="20" colspan="2">水系魔法抗性：&nbsp;<input type="text" name="resistance2" value="<%=role.ep.resistance[2]%>" size="12" maxlength="10"/></td>
    <td height="20" colspan="2">火系魔法抗性：&nbsp;<input type="text" name="resistance3" value="<%=role.ep.resistance[3]%>" size="12" maxlength="10"/></td>
  </tr>
  <tr>
    <td height="20" colspan="2">土系魔法抗性：&nbsp;<input type="text" name="resistance4" value="<%=role.ep.resistance[4]%>" size="12" maxlength="10"/></td>
    <td height="20" colspan="2">防御力：&nbsp;<input type="text" name="defense" value="<%=role.ep.defense%>" size="12" maxlength="10"/></td>
  </tr>
  <tr>
    <td height="20" colspan="2">闪躲率：&nbsp;<input type="text" name="armor" value="<%=role.ep.armor%>" size="12" maxlength="10"/></td>
    <td height="20" colspan="2">最大怒气值：&nbsp;<input type="text" name="max_ap" value="<%=role.ep.max_ap%>" size="12" maxlength="10"/></td>
  </tr>
  <tr>
    <td height="50" align="center" colspan="4"> &nbsp;
    &nbsp;<font color=red>警告：请勿修改除经验值，金钱，声望，技能点以外的其他变量，否则服务器可能宕机。</font><br>
	<input type="submit" class="button" value="保存" />&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="reset" class="button" value="重置" /></td>
  </tr>
</table>
</form>

</td></tr></table>
<%@include file="../include/foot.jsp"%>
</body>
</html>

