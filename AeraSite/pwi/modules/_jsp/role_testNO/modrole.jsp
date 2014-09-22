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

	if( -1 == roleid && null != strRoleName && strRoleName.length() > 0 ){
		try{ roleid = GameDB.getRoleIdByName( strRoleName ); }
		catch (Exception e) { out.println(e.toString()); return; }
		if( -1 == roleid ){
			//out.println("无法查到该角色：" + strRoleName + "，可能没有该角色或访问超时。" );
			out.println("Role can not be found：" + strRoleName + "，可能没有该角色或访问超时。" );
			return;
		}
	}
	
	if( -1 == roleid ){
		//out.println("请输入角色ID或者角色名称。");
		out.println("Please enter Role ID or Role Name:");
		return;
	}
	RoleBean role = null;
	try{
		role = GameDB.get( roleid );
		session.setAttribute( "gamedb_rolebean", role );
	}catch (Exception e) { out.println(e.toString()); return; }
	
	if (null == role){
		//out.println("从数据库获取角色信息失败，可能没有该角色或访问超时。请重试。");
		out.println("Role does not exist.");
		return;
	}
	
	LogFactory.getLog("modrole.jsp").info("getRoleInfo, "+role.getLogString()+",operator=" + AuthFilter.getRemoteUser(session) );
	String rolename;
	
	switch( roleid ){
		case 16:	rolename = "Swordsmen - male";	break;
		case 17:	rolename = "Swordsmen - female";	break;
		case 18:	rolename = "Master - male";	break;
		case 19:	rolename = "Master - female";	break;
		case 20:    rolename = "Monk - male";	break;
		case 21:    rolename = "Monk - female";	break;
		case 22:    rolename = "Elf - male";	break;
		case 23:    rolename = "Elf - female";	break;
		case 24:    rolename = "Evil Beast - male";	break;
		case 25:    rolename = "Evil Beast - female";	break;
		case 26:    rolename = "Evil Spirit - male";	break;
		case 27:    rolename = "Evil Spirit - female";	break;
		case 28:    rolename = "Feather awn - male";	break;
		case 29:    rolename = "Feather awn - female";	break;
		case 30:    rolename = "Feather Spirit - male";	break;
		case 31:    rolename = "Feather Spirit - female";	break;
		default:	rolename = "General Role Information";
	}
%>


<html>
<head>
<link href="../css/styles_ph.css" rel="stylesheet" type="text/css">
<title>Role Information Change</title>
</head>

<body>
<table width="800" border="0" cellspacing="0">
<%@include file="../include/topheader.jsp"%>  
 <tr>
  <td colspan="2">
<%@include file="../include/header_new.jsp"%>  
  </td>
 </tr> 
 <tr><td colspan="2">&nbsp;</td></tr> 
 <tr>
  <td colspan="2">
<form action="saverole.jsp" method="post">
<input type="hidden" name="roleid" value="<%=roleid%>">
<table width="98%" align="center" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="30" class="ver_10_black"><b><%=rolename%>&nbsp;(roleid=<%=roleid%>)</b>&nbsp;&nbsp;--&nbsp;Original information of the Role</td>
  </tr>
  <tr>
  <tr><td>&nbsp;</td></tr>
  <tr>
    <td>
      <table width="100%" cellspacing="1" cellpadding="3" bgcolor="#000000">
        <tr bgcolor="#FFFFFF">
			<td width="25%" class="ver_10_black">Name：&nbsp;&nbsp;<%=StringEscapeUtils.escapeHtml(role.base.name.getString())%></td>
    		<td width="25%" class="ver_10_black">Race：&nbsp;&nbsp;<%=role.base.race%></td>
    		<td width="25%" class="ver_10_black">Profession：&nbsp;&nbsp;<%=RoleBean.ClsName(role.base.cls)%></td>
    		<td width="25%" class="ver_10_black">Gender：&nbsp;&nbsp;<%=RoleBean.GenderName(role.base.gender)%></td>        
        </tr>
        <tr bgcolor="#FFFFFF">
  			<td class="ver_10_black">Status：&nbsp;&nbsp;&nbsp;&nbsp;<%=RoleBean.StatusName(role.base.status)%></td>
    		<td class="ver_10_black">Deleted Time：&nbsp;&nbsp;&nbsp;&nbsp;<%=role.base.delete_time<=0 ? "-" : (new SimpleDateFormat("y/M/d H:m:s")).format(new Date(1000*(long)role.base.delete_time))%></td>
    		<td class="ver_10_black">Created Time：&nbsp;&nbsp;&nbsp;&nbsp;<%=role.base.create_time<=0 ? "-" : (new SimpleDateFormat("y/M/d H:m:s")).format(new Date(1000*(long)role.base.create_time))%></td>
    		<td class="ver_10_black">Last Access Time：&nbsp;&nbsp;&nbsp;&nbsp;<%=role.base.lastlogin_time<=0 ? "-" : (new SimpleDateFormat("y/M/d H:m:s")).format(new Date(1000*(long)role.base.lastlogin_time))%></td>
        </tr>
        <tr bgcolor="#FFFFFF">
		    <td class="ver_10_black">World：&nbsp;&nbsp;&nbsp;&nbsp;<%=role.status.worldtag%></td>
		    <td class="ver_10_black">Red Name Status：&nbsp;&nbsp;&nbsp;&nbsp;<%=role.status.invader_state%></td>
		    <td class="ver_10_black">Red Name Time：&nbsp;&nbsp;&nbsp;&nbsp;<%=role.status.invader_time%></td>
		    <td class="ver_10_black">Pink Name Time：&nbsp;&nbsp;&nbsp;&nbsp;<%=role.status.pariah_time%></td>        
        </tr>
        <tr bgcolor="#FFFFFF">
        	<td colspan="2" class="ver_10_black">Reputation：&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="reputation" value="<%=role.status.reputation%>" size="12" maxlength="10"/></td>
    		<td colspan="2" class="ver_10_black"><input type="checkbox" name="clearstorehousepasswd">Clear the storehouse password：&nbsp;&nbsp;&nbsp;&nbsp;</td>
        </tr>
      </table>
    </td>
  </tr>
    <tr><td>&nbsp;</td></tr>
    <tr>
      <td>
         <table width="100%" cellspacing="1" cellpadding="3" bgcolor="#000000">
           <tr bgcolor="#FFFFFF">
             <td width="30%" class="ver_10_black">Total Amount of Gold Inserted:</td>
             <td class="ver_10_black"><%=role.user.cash_add%></td>
           </tr>
           <tr bgcolor="#FFFFFF">
             <td class="ver_10_black">Total Amount of Gold Bought:</td>
             <td class="ver_10_black"><%=role.user.cash_buy%></td>
           </tr>
           <tr bgcolor="#FFFFFF">
             <td class="ver_10_black">Total Amount of Gold Sold:</td>
             <td class="ver_10_black"><%=role.user.cash_sell%></td>
           </tr>           
           <tr bgcolor="#FFFFFF">
             <td class="ver_10_black">Total Amount of Expended</td>
             <td class="ver_10_black"><%=role.user.cash_used%></td>
           </tr>                  
         </table>
      </td>
    </tr>
    <tr><td>&nbsp;</td></tr>
    <tr>
     <td>
        <table width="100%" cellspacing="1" cellpadding="3" bgcolor="#000000">
           <tr bgcolor="#FFFFFF">
             <td width="25%" class="ver_10_black">Level:&nbsp;<input type="text" name="level" value="<%=role.status.level%>" size="5" maxlength="3"  /></td>
            <td width="25%" class="ver_10_black">Cultivation Level:&nbsp;<input type="text" name="level2" value="<%=role.status.level2%>" size="5" maxlength="3"  readonly/></td>
            <td width="25%" class="ver_10_black">Experience Value:&nbsp;<input type="text" name="exp" value="<%=role.status.exp%>" size="12" maxlength="10"/></td>
            <td width="25%" class="ver_10_black">Skill Point:&nbsp;<input type="text" name="sp" value="<%=role.status.sp%>" size="12" maxlength="10"/></td>
           </tr>
           <tr bgcolor="#FFFFFF">
             <td class="ver_10_black">Attribute Point:&nbsp;<input type="text" name="pp" value="<%=role.status.pp%>" size="12" maxlength="10"  readonly /></td>
            <td class="ver_10_black">Original Coordinate X:&nbsp;<input type="text" name="posx" value="<%=(int)role.status.posx%>" size="5" maxlength="6"   readonly/></td>
            <td class="ver_10_black">Original Coordinate Y:&nbsp;<input type="text" name="posy" value="<%=(int)role.status.posy%>" size="5" maxlength="6"   readonly/></td>
            <td class="ver_10_black">Original Coordinate Z:&nbsp;<input type="text" name="posz" value="<%=(int)role.status.posz%>" size="5" maxlength="6"   readonly/></td>
           </tr>           
           <tr bgcolor="#FFFFFF">
             <td class="ver_10_black">Money:&nbsp;<input type="text" name="money" value="<%=role.pocket.money%>" size="12" maxlength="10"/></td>
            <td class="ver_10_black">Life:&nbsp;<input type="text" name="vitality" value="<%=role.ep.vitality%>" size="12" maxlength="10"   readonly/></td>
            <td class="ver_10_black">Nimbus:&nbsp;<input type="text" name="energy" value="<%=role.ep.energy%>" size="12" maxlength="10"  readonly /></td>
            <td class="ver_10_black">Strength:&nbsp;<input type="text" name="strength" value="<%=role.ep.strength%>" size="12" maxlength="10"   readonly/></td>
           </tr>    
           <tr bgcolor="#FFFFFF">
             <td class="ver_10_black">Dexterity:&nbsp;<input type="text" name="agility" value="<%=role.ep.agility%>" size="12" maxlength="10"   readonly/></td>
            <td class="ver_10_black">Maximum HP:&nbsp;<input type="text" name="max_hp" value="<%=role.ep.max_hp%>" size="12" maxlength="10"   readonly/></td>
            <td class="ver_10_black">Maximum MP:&nbsp;<input type="text" name="max_mp" value="<%=role.ep.max_mp%>" size="12" maxlength="10"   readonly/></td>
            <td class="ver_10_black">Attack Rate:&nbsp;<input type="text" name="attack" value="<%=role.ep.attack%>" size="12" maxlength="10"   readonly/></td>
           </tr>    
           <tr bgcolor="#FFFFFF">
             <td class="ver_10_black" colspan="2">Mnimum Physical Damage:&nbsp;<input type="text" name="damage_low" value="<%=role.ep.damage_low%>" size="12" maxlength="10"   readonly/></td>
            <td class="ver_10_black" colspan="2">Maximum Physical Damage:&nbsp;<input type="text" name="damage_high" value="<%=role.ep.damage_high%>" size="12" maxlength="10"   readonly/></td>
           </tr>  
           <tr bgcolor="#FFFFFF">
             <td class="ver_10_black" colspan="2">Minimum Metal Damage: &nbsp;<input type="text" name="addon_damage_low0" value="<%=role.ep.addon_damage_low[0]%>" size="12" maxlength="10"   readonly/></td>
            <td class="ver_10_black" colspan="2">Maximum Metal Damage:&nbsp;<input type="text" name="addon_damage_high0" value="<%=role.ep.addon_damage_high[0]%>" size="12" maxlength="10"  readonly /></td>
           </tr>             
           <tr bgcolor="#FFFFFF">
             <td class="ver_10_black" colspan="2">Minimum Wood Damage:&nbsp;<input type="text" name="addon_damage_low1" value="<%=role.ep.addon_damage_low[1]%>" size="12" maxlength="10"   readonly/></td>
            <td class="ver_10_black" colspan="2">Maximum Wood Damage:&nbsp;<input type="text" name="addon_damage_high1" value="<%=role.ep.addon_damage_high[1]%>" size="12" maxlength="10"   readonly/></td>
           </tr>  
           <tr bgcolor="#FFFFFF">
             <td class="ver_10_black" colspan="2">Minimum Water Damage:&nbsp;<input type="text" name="addon_damage_low2" value="<%=role.ep.addon_damage_low[2]%>" size="12" maxlength="10"   readonly/></td>
            <td class="ver_10_black" colspan="2">Maximum Water Damage:&nbsp;<input type="text" name="addon_damage_high2" value="<%=role.ep.addon_damage_high[2]%>" size="12" maxlength="10"   readonly/></td>
           </tr>                        
           <tr bgcolor="#FFFFFF">
             <td class="ver_10_black" colspan="2">Minimum Fire Damage:&nbsp;<input type="text" name="addon_damage_low3" value="<%=role.ep.addon_damage_low[3]%>" size="12" maxlength="10"   readonly/></td>
            <td class="ver_10_black" colspan="2">Maximum Fire Damage:&nbsp;<input type="text" name="addon_damage_high3" value="<%=role.ep.addon_damage_high[3]%>" size="12" maxlength="10"   readonly/></td>
           </tr>                        
           <tr bgcolor="#FFFFFF">
             <td class="ver_10_black" colspan="2">Minimum Earth Damage:&nbsp;<input type="text" name="addon_damage_low4" value="<%=role.ep.addon_damage_low[4]%>" size="12" maxlength="10"  readonly/></td>
            <td class="ver_10_black" colspan="2">Maximum Earth Damage:&nbsp;<input type="text" name="addon_damage_high4" value="<%=role.ep.addon_damage_high[4]%>" size="12" maxlength="10"  readonly/></td>
           </tr>                        
           <tr bgcolor="#FFFFFF">
             <td class="ver_10_black" colspan="2">Minimum Attack power of Magic:&nbsp;<input type="text" name="damage_magic_low" value="<%=role.ep.damage_magic_low%>" size="12" maxlength="10"   readonly/></td>
            <td class="ver_10_black" colspan="2">Maximum Attack power of Magic:&nbsp;<input type="text" name="damage_magic_high" value="<%=role.ep.damage_magic_high%>" size="12" maxlength="10"   readonly/></td>
           </tr>                        
           <tr bgcolor="#FFFFFF">
             <td class="ver_10_black" colspan="2">Metal Magic Resistibility:&nbsp;<input type="text" name="resistance0" value="<%=role.ep.resistance[0]%>" size="12" maxlength="10"   readonly/></td>
            <td class="ver_10_black" colspan="2">Wood Magic Resiistibility:&nbsp;<input type="text" name="resistance1" value="<%=role.ep.resistance[1]%>" size="12" maxlength="10"   readonly/></td>
           </tr>                        
           <tr bgcolor="#FFFFFF">
             <td class="ver_10_black" colspan="2">Water Magic Resistibility:&nbsp;<input type="text" name="resistance2" value="<%=role.ep.resistance[2]%>" size="12" maxlength="10"  readonly/></td>
            <td class="ver_10_black" colspan="2">Fire Magic Resistibility:&nbsp;<input type="text" name="resistance3" value="<%=role.ep.resistance[3]%>" size="12" maxlength="10"  readonly/></td>
           </tr>                                
           <tr bgcolor="#FFFFFF">
             <td class="ver_10_black" colspan="2">Earth Magic Resistibility:&nbsp;<input type="text" name="resistance4" value="<%=role.ep.resistance[4]%>" size="12" maxlength="10"  readonly /></td>
            <td class="ver_10_black" colspan="2">Defense Power:&nbsp;<input type="text" name="defense" value="<%=role.ep.defense%>" size="12" maxlength="10"  readonly /></td>
           </tr>                                
           <tr bgcolor="#FFFFFF">
             <td class="ver_10_black" colspan="2">Avoidability:&nbsp;<input type="text" name="armor" value="<%=role.ep.armor%>" size="12" maxlength="10"  readonly /></td>
            <td class="ver_10_black" colspan="2">Maximum Rage Value:&nbsp;<input type="text" name="max_ap" value="<%=role.ep.max_ap%>" size="12" maxlength="10"  readonly /></td>
           </tr>                                
        </table>
     </td>
    </tr>
    <tr><td>&nbsp;</td></tr>
    <tr><td><span class="ver_10_red">Warning:  Please do onot change the variables except the experience value, money, reputation and skill point.  Changing the other values may result to the server not working.</span></td></tr>
    <tr><td>&nbsp;</td></tr>
    <tr>
      <td align="center">
      	<input type="submit" class="button" value="Save"/>
      	<input type="reset" class="button" value="Reset"/>
      	<input type="button" class="button" value="Back to Role Information Page" onclick="location.href='index.jsp';">
      </td>
    </tr>
    <tr><td>&nbsp;</td></tr>
 </table>
  </form>  
  </td>
 </tr>
 <tr><td colspan="2">&nbsp;</td></tr> 
<%@include file="../include/footer.jsp"%> 
</table>
</body>
</html>