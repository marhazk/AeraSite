<%@ page contentType="text/html; charset=UTF-8" %>
<%@page import="java.lang.*"%>
<%@page import="protocol.*"%>
<%@page import="com.goldhuman.auth.*"%>
<%@page import="org.apache.commons.logging.Log"%>
<%@page import="org.apache.commons.logging.LogFactory"%>
<%@page import="com.goldhuman.util.LocaleUtil" %>
<%
String msg = request.getParameter("msg");
boolean success = false;
//success = DeliveryDB.broadcast((byte)9,-1,msg);

int _roleid[] = new int[1000];
_roleid[0] = 1024; //aera
_roleid[1] = 1120; //Θ:1120
_roleid[2] = 1062; //Ψαηιξ:1062 (ON) SQL:1002070

msg = "TEST ";
//success = DeliveryDB.broadcast((byte)5,_roleid[0],msg+1);
//success = DeliveryDB.replyComplain(_roleid[2],_roleid[0], "aera", msg+2);

int type = 0;
boolean r;

for (int typeid = 0; typeid <= 100; typeid++)
{
    DeliveryDB.init();
    if (type == 0) //Private
    {
        PrivateChat pc = (PrivateChat)com.goldhuman.IO.Protocol.Protocol.Create("PrivateChat");
        pc.msg.setString(msg+typeid);
        pc.channel = (byte)typeid;
        pc.srcroleid = _roleid[1];
        pc.src_name.setString("aera");
        pc.dstroleid = _roleid[1];
        r = DeliveryDB.mgr.Send(DeliveryDB.mgr.s, pc);

        // OFFLINE SRC PLAYER
        // typeid 5 = works
        //
        // ONLINE SRC PLAYER
        // typeid 0 (with name), 1 (with name), 5 = works
    }
    if (type == 1) //PublicChat
    {
        PublicChat pc = (PublicChat)com.goldhuman.IO.Protocol.Protocol.Create("PublicChat");
        pc.msg.setString(msg+typeid);
        //pc.name.setString("aera");
        pc.roleid = _roleid[1];
        pc.channel = (byte)typeid;
        pc.emotion = 0;
        r = DeliveryDB.mgr.Send(DeliveryDB.mgr.s, pc);


        // NORMAL PLAYER
        // typeid 9 = works without name
        //
        // GM
        // typeid 9 = works without name
    }
    if (type == 2) //WorldChat = FAILED
    {
    /*
  public byte channel;
  public byte emotion;
  public int roleid;
  public Octets name;
  public Octets msg;
  public Octets data;
  */
        WorldChat pc = (WorldChat)com.goldhuman.IO.Protocol.Protocol.Create("WorldChat");
        pc.msg.setString(msg+type);
        pc.name.setString("Θ");
        pc.roleid = _roleid[1];
        pc.channel = (byte)typeid;
        pc.emotion = 0;
        r = DeliveryDB.mgr.Send(DeliveryDB.mgr.s, pc);


        // NORMAL PLAYER
        // typeid failed
        //
        // GM
        // typeid failed
    }
    if (type == 3) //ForwardChat = FAILED
    {
  /*
  public int zoneid;
  public int lineid;
  public int userid;
  public int roleid;
  public Octets name;
  public Octets msg;
  */
        ForwardChat pc = (ForwardChat)com.goldhuman.IO.Protocol.Protocol.Create("ForwardChat");
        pc.msg.setString(msg+type);
        pc.name.setString("aera");
        pc.zoneid = 1;
        pc.lineid = 0;
        pc.userid = 32;
        r = DeliveryDB.mgr.Send(DeliveryDB.mgr.s, pc);


        // NORMAL PLAYER
        // typeid failed
        //
        // GM
        // typeid failed
    }
    if (type == 4) //ChatBroadCast - FAIL
    {
    /*
  public byte channel;
  public byte emotion;
  public int srcroleid;
  public Octets msg;
  public Octets data;
    */
        ChatBroadCast pc = (ChatBroadCast)com.goldhuman.IO.Protocol.Protocol.Create("ChatBroadCast");
        pc.msg.setString(msg+type);
        pc.srcroleid = _roleid[0];
        pc.channel = (byte)typeid;
        pc.emotion = 0;
        r = DeliveryDB.mgr.Send(DeliveryDB.mgr.s, pc);


        // NORMAL PLAYER
        // typeid failed
        //
        // GM
        // typeid failed
    }
    com.goldhuman.IO.PollIO.WakeUp();
}
LogFactory.getLog("broadcast.jsp").info("broadcast.jsp, msg=" + msg + ",result=" + success + ",operator=" + AuthFilter.getRemoteUser(session) );
%>

<html>
<head>
<link href="../include/style.css" rel="stylesheet" type="text/css">
<title><%= LocaleUtil.getMessage(request,"manage_bc_bcsend") %></title>
</head>

<body>
<%@include file="../include/header.jsp"%>
<table width="100%" height="350"  border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF"><tr><td>

<table width="30%" height="200" align="center" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td height="350">
<%
	if( success )
		out.print( LocaleUtil.getMessage(request,"manage_bc_sendok") + "&nbsp;&nbsp;&nbsp;&nbsp;" );
	else
		out.print( LocaleUtil.getMessage(request,"manage_bc_sendfail") + "&nbsp;&nbsp;&nbsp;&nbsp;" );
%>aaaaaaaaaaa
    </td>
  </tr>
</table>

</td></tr></table>
<%@include file="../include/foot.jsp"%>
</body>
</html>

