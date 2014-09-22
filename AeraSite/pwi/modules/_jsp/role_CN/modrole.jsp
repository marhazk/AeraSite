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
		out.println("�޷��鵽�ý�ɫ��" + strRoleName + "������û�иý�ɫ����ʳ�ʱ��" );
		return;
	}
}
if( -1 == roleid )
{
	out.println("�������ɫID���߽�ɫ���ơ�");
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
	out.println("�����ݿ��ȡ��ɫ��Ϣʧ�ܣ�����û�иý�ɫ����ʳ�ʱ�������ԡ�");
	return;
}
LogFactory.getLog("modrole.jsp").info("getRoleInfo, "+role.getLogString()+",operator=" + AuthFilter.getRemoteUser(session) );
String rolename;
switch( roleid )
{
	case 16:	rolename = "����-��";	break;
	case 17:	rolename = "����-Ů";	break;
	case 18:	rolename = "��ʦ-��";	break;
	case 19:	rolename = "��ʦ-Ů";	break;
	case 20:    rolename = "ɮ��-��";	break;
	case 21:    rolename = "ɮ��-Ů";	break;
	case 22:    rolename = "����-��";	break;
	case 23:    rolename = "����-Ů";	break;
	case 24:    rolename = "����-��";	break;
	case 25:    rolename = "����-Ů";	break;
	case 26:    rolename = "����-��";	break;
	case 27:    rolename = "����-Ů";	break;
	case 28:    rolename = "��â-��";	break;
	case 29:    rolename = "��â-Ů";	break;
	case 30:    rolename = "����-��";	break;
	case 31:    rolename = "����-Ů";	break;
	default:	rolename = "��ͨ��ɫ";
}
%>


<html>
<head>
<link href="../include/style.css" rel="stylesheet" type="text/css">
<title>��ɫ��Ϣ����-�޸�</title>
</head>

<body>
<%@include file="../include/header.jsp"%>
<table width="100%" height="350"  border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF"><tr><td>

<form action="saverole.jsp" method="post">
<input type="hidden" name="roleid" value="<%=roleid%>">
<table width="80%" height="300" align="center" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td height="30" colspan="4" class="table_title"><%=rolename%>(roleid=<%=roleid%>)&nbsp;&nbsp;--&nbsp;��ɫ��ʼ��Ϣ</td>
  </tr>

  <tr>
    <td height="20">���ƣ�&nbsp;&nbsp;<%=StringEscapeUtils.escapeHtml(role.base.name.getString())%></td>
    <td height="20">���壺&nbsp;&nbsp;<%=role.base.race%></td>
    <td height="20">ְҵ��&nbsp;&nbsp;<%=RoleBean.ClsName(role.base.cls)%></td>
    <td height="20">�Ա�&nbsp;&nbsp;<%=RoleBean.GenderName(role.base.gender)%></td>
  </tr>
  <tr>
    <td height="20">״̬��&nbsp;&nbsp;&nbsp;&nbsp;<%=RoleBean.StatusName(role.base.status)%></td>
    <td height="20">ɾ��ʱ�䣺&nbsp;&nbsp;&nbsp;&nbsp;<%=role.base.delete_time<=0 ? "-" : (new SimpleDateFormat("y/M/d H:m:s")).format(new Date(1000*(long)role.base.delete_time))%></td>
    <td height="20">����ʱ�䣺&nbsp;&nbsp;&nbsp;&nbsp;<%=role.base.create_time<=0 ? "-" : (new SimpleDateFormat("y/M/d H:m:s")).format(new Date(1000*(long)role.base.create_time))%></td>
    <td height="20">�ϴε�¼ʱ�䣺&nbsp;&nbsp;&nbsp;&nbsp;<%=role.base.lastlogin_time<=0 ? "-" : (new SimpleDateFormat("y/M/d H:m:s")).format(new Date(1000*(long)role.base.lastlogin_time))%></td>
  </tr>
  <tr>
    <td height="20">���磺&nbsp;&nbsp;&nbsp;&nbsp;<%=role.status.worldtag%></td>
    <td height="20">����״̬��&nbsp;&nbsp;&nbsp;&nbsp;<%=role.status.invader_state%></td>
    <td height="20">����ʱ�䣺&nbsp;&nbsp;&nbsp;&nbsp;<%=role.status.invader_time%></td>
    <td height="20">����ʱ�䣺&nbsp;&nbsp;&nbsp;&nbsp;<%=role.status.pariah_time%></td>
  </tr>
  <tr>
    <td height="20" colspan="3">������&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="reputation" value="<%=role.status.reputation%>" size="12" maxlength="10"/></td>
    <td height="20"><input type="checkbox" name="clearstorehousepasswd">����ֿ����룺&nbsp;&nbsp;&nbsp;&nbsp;</td>
  </tr>
  <tr><td colspan="4">&nbsp;</td></tr>
  <tr>
    <td height="20" colspan="1">�ܳ�ֵ��Ԫ����&nbsp;&nbsp;&nbsp;&nbsp;<%=role.user.cash_add%></td>
    <td height="20" colspan="1">�������Ԫ����&nbsp;&nbsp;&nbsp;&nbsp;<%=role.user.cash_buy%></td>
    <td height="20" colspan="1">��������Ԫ����&nbsp;&nbsp;&nbsp;&nbsp;<%=role.user.cash_sell%></td>
    <td height="20" colspan="1">�����ѽ�Ԫ����&nbsp;&nbsp;&nbsp;&nbsp;<%=role.user.cash_used%></td>
  </tr>
  <tr>
    <td height="20">����&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="level" value="<%=role.status.level%>" size="5" maxlength="3"/></td>
    <td height="20">���漶��&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="level2" value="<%=role.status.level2%>" size="5" maxlength="3"/></td>
    <td height="20">����ֵ��&nbsp;&nbsp;<input type="text" name="exp" value="<%=role.status.exp%>" size="12" maxlength="10"/></td>
    <td height="20">���ܵ㣺&nbsp;&nbsp;<input type="text" name="sp" value="<%=role.status.sp%>" size="12" maxlength="10"/></td>
  </tr>
  <tr>
    <td height="20">���Ե㣺&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="pp" value="<%=role.status.pp%>" size="12" maxlength="10"/></td>
    <td height="20">��ʼ����X��&nbsp;<input type="text" name="posx" value="<%=(int)role.status.posx%>" size="5" maxlength="6"/></td>
    <td height="20">��ʼ����Y��&nbsp;<input type="text" name="posy" value="<%=(int)role.status.posy%>" size="5" maxlength="6"/></td>
    <td height="20">��ʼ����Z��&nbsp;<input type="text" name="posz" value="<%=(int)role.status.posz%>" size="5" maxlength="6"/></td>
  </tr>
  <tr>
    <td height="20">��Ǯ��&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="money" value="<%=role.pocket.money%>" size="12" maxlength="10"/></td>
    <td height="20">����&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="vitality" value="<%=role.ep.vitality%>" size="12" maxlength="10"/></td>
    <td height="20">��&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="energy" value="<%=role.ep.energy%>" size="12" maxlength="10"/></td>
    <td height="20">����&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="strength" value="<%=role.ep.strength%>" size="12" maxlength="10"/></td>
  </tr>
  <tr>
    <td height="20">����&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="agility" value="<%=role.ep.agility%>" size="12" maxlength="10"/></td>
    <td height="20">���HP��&nbsp;<input type="text" name="max_hp" value="<%=role.ep.max_hp%>" size="12" maxlength="10"/></td>
    <td height="20">���MP��&nbsp;<input type="text" name="max_mp" value="<%=role.ep.max_mp%>" size="12" maxlength="10"/></td>
    <td height="20">�����ʣ�&nbsp;&nbsp;<input type="text" name="attack" value="<%=role.ep.attack%>" size="12" maxlength="10"/></td>
  </tr>
  <tr>
    <td height="20" colspan="2">�������damage��&nbsp;<input type="text" name="damage_low" value="<%=role.ep.damage_low%>" size="12" maxlength="10"/></td>
    <td height="20" colspan="2">�������damage��&nbsp;<input type="text" name="damage_high" value="<%=role.ep.damage_high%>" size="12" maxlength="10"/></td>
  </tr>
  <tr>
    <td height="20" colspan="2">��ͽ�ϵdamage��&nbsp;<input type="text" name="addon_damage_low0" value="<%=role.ep.addon_damage_low[0]%>" size="12" maxlength="10"/></td>
    <td height="20" colspan="2">����ϵdamage��&nbsp;<input type="text" name="addon_damage_high0" value="<%=role.ep.addon_damage_high[0]%>" size="12" maxlength="10"/></td>
  </tr>
  <tr>
    <td height="20" colspan="2">���ľϵdamage��&nbsp;<input type="text" name="addon_damage_low1" value="<%=role.ep.addon_damage_low[1]%>" size="12" maxlength="10"/></td>
    <td height="20" colspan="2">���ľϵdamage��&nbsp;<input type="text" name="addon_damage_high1" value="<%=role.ep.addon_damage_high[1]%>" size="12" maxlength="10"/></td>
  </tr>
  <tr>
    <td height="20" colspan="2">���ˮϵdamage��&nbsp;<input type="text" name="addon_damage_low2" value="<%=role.ep.addon_damage_low[2]%>" size="12" maxlength="10"/></td>
    <td height="20" colspan="2">���ˮϵdamage��&nbsp;<input type="text" name="addon_damage_high2" value="<%=role.ep.addon_damage_high[2]%>" size="12" maxlength="10"/></td>
  </tr>
  <tr>
    <td height="20" colspan="2">��ͻ�ϵdamage��&nbsp;<input type="text" name="addon_damage_low3" value="<%=role.ep.addon_damage_low[3]%>" size="12" maxlength="10"/></td>
    <td height="20" colspan="2">����ϵdamage��&nbsp;<input type="text" name="addon_damage_high3" value="<%=role.ep.addon_damage_high[3]%>" size="12" maxlength="10"/></td>
  </tr>
  <tr>
    <td height="20" colspan="2">�����ϵdamage��&nbsp;<input type="text" name="addon_damage_low4" value="<%=role.ep.addon_damage_low[4]%>" size="12" maxlength="10"/></td>
    <td height="20" colspan="2">�����ϵdamage��&nbsp;<input type="text" name="addon_damage_high4" value="<%=role.ep.addon_damage_high[4]%>" size="12" maxlength="10"/></td>
  </tr>
  <tr>
    <td height="20" colspan="2">ħ����͹�������&nbsp;<input type="text" name="damage_magic_low" value="<%=role.ep.damage_magic_low%>" size="12" maxlength="10"/></td>
    <td height="20" colspan="2">ħ����߹�������&nbsp;<input type="text" name="damage_magic_high" value="<%=role.ep.damage_magic_high%>" size="12" maxlength="10"/></td>
  </tr>
  <tr>
    <td height="20" colspan="2">��ϵħ�����ԣ�&nbsp;<input type="text" name="resistance0" value="<%=role.ep.resistance[0]%>" size="12" maxlength="10"/></td>
    <td height="20" colspan="2">ľϵħ�����ԣ�&nbsp;<input type="text" name="resistance1" value="<%=role.ep.resistance[1]%>" size="12" maxlength="10"/></td>
  </tr>
  <tr>
    <td height="20" colspan="2">ˮϵħ�����ԣ�&nbsp;<input type="text" name="resistance2" value="<%=role.ep.resistance[2]%>" size="12" maxlength="10"/></td>
    <td height="20" colspan="2">��ϵħ�����ԣ�&nbsp;<input type="text" name="resistance3" value="<%=role.ep.resistance[3]%>" size="12" maxlength="10"/></td>
  </tr>
  <tr>
    <td height="20" colspan="2">��ϵħ�����ԣ�&nbsp;<input type="text" name="resistance4" value="<%=role.ep.resistance[4]%>" size="12" maxlength="10"/></td>
    <td height="20" colspan="2">��������&nbsp;<input type="text" name="defense" value="<%=role.ep.defense%>" size="12" maxlength="10"/></td>
  </tr>
  <tr>
    <td height="20" colspan="2">�����ʣ�&nbsp;<input type="text" name="armor" value="<%=role.ep.armor%>" size="12" maxlength="10"/></td>
    <td height="20" colspan="2">���ŭ��ֵ��&nbsp;<input type="text" name="max_ap" value="<%=role.ep.max_ap%>" size="12" maxlength="10"/></td>
  </tr>
  <tr>
    <td height="50" align="center" colspan="4"> &nbsp;
    &nbsp;<font color=red>���棺�����޸ĳ�����ֵ����Ǯ�����������ܵ�����������������������������崻���</font><br>
	<input type="submit" class="button" value="����" />&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="reset" class="button" value="����" /></td>
  </tr>
</table>
</form>

</td></tr></table>
<%@include file="../include/foot.jsp"%>
</body>
</html>

