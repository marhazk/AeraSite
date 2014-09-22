<%@ page contentType="text/html; charset=UTF-8" %>
    <%@page import="java.lang.*" %>
    <%@page import="java.util.*" %>
    <%@page import="java.text.*" %>
    <%@page import="org.apache.commons.lang.StringEscapeUtils" %>
    <%@page import="org.apache.commons.logging.LogFactory" %>
    <%@page import="org.apache.commons.logging.Log" %>
    <%@page import="protocol.*" %>
    <%@ page import="protocol.GRoleInventory" %>
    <%@ page import="protocol.RoleBean" %>
    <%@ page import="protocol.RoleInfo" %>
    <%@ page import="protocol.DeliveryDB" %>
    <%@ page import="protocol.GameDB" %>
    <%@ page import="protocol.XmlRole" %>
    <%@ page import="protocol.XmlRoleBase" %>
    <%@ page import="com.goldhuman.auth.*" %>
    <%@ page import="com.goldhuman.auth.AuthFilter" %>
    <%@ page import="com.goldhuman.service.interfaces.LogInfo" %>
    <%@ page import="com.goldhuman.service.interfaces.SimpleRoleBean" %>
    <%@ page import="com.goldhuman.service.interfaces.GMService" %>
    <%@ page import="com.goldhuman.service.GMServiceImpl" %>
    <%@ page import="com.goldhuman.util.LocaleUtil" %>
    <%@page import="java.sql.*" %>
    <%@page import="java.sql.Date" %>
    <%@ page import="java.sql.*,java.net.*,java.io.*,java.lang.*,java.util.*" %>
    <%@page import="org.apache.commons.codec.binary.Base64" %>
    <%@page import="java.io.*" %>
    <%@page import="java.util.zip.*"%>
    <%@page import="java.util.List"%>
<%
String strMax = new String("-1");
String strFakeMax = new String("-1");
String strCur = new String("-1");
String strNewMax = new String("5000");
String strNewFakeMax = new String("5000");
{
	Integer[] curmax = new Integer[3];
	if( !DeliveryDB.GetMaxOnlineNum( curmax ) )
		LogFactory.getLog("index.jsp").info("GetMaxOnlineNum error." );
	if( null == curmax[0] )	curmax[0] = new Integer(-1);
	if( null == curmax[1] )	curmax[1] = new Integer(-1);
	if( null == curmax[2] )	curmax[2] = new Integer(-1);
	if( -1 != curmax[0].intValue() ) strNewMax=(new Integer(curmax[0].intValue())).toString();
	if( -1 != curmax[1].intValue() ) strNewFakeMax=(new Integer(curmax[1].intValue())).toString();
	strMax = curmax[0].toString();
	strFakeMax = curmax[1].toString();
	strCur = curmax[2].toString();
}

String strDoubleExp = LocaleUtil.getMessage(request,"manage_index_unknow");
{
	Double v = new com.goldhuman.service.GMServiceImpl().getw2iexperience(new com.goldhuman.service.interfaces.LogInfo());
	if (v != null) {
		strDoubleExp = v.toString();
	}
	/*
	if (strDoubleExp.equals("1") || strDoubleExp.equals("1.0")) {
		strDoubleExp =  "1==1?��?";
	}
	*/
	/*
	byte status = DeliveryDB.GMGetDoubleExp();
	if( (byte)1 == status )			strDoubleExp = LocaleUtil.getMessage(request,"manage_index_yes");
	else if( (byte)0 == status )	strDoubleExp = LocaleUtil.getMessage(request,"manage_index_no");
	if( (byte)1 == status )			strDoubleExp_check = "";
	*/
}

String strLambda = "-1";
{
	int lambda = DeliveryDB.GMGetLambda();
	strLambda = (new Integer(lambda)).toString();
}

String strNoTrade_check = "checked=\"checked\"";
String strNoTrade = LocaleUtil.getMessage(request,"manage_index_unknow");
{
	byte status = DeliveryDB.GMGetNoTrade();
	if( (byte)1 == status )			strNoTrade = LocaleUtil.getMessage(request,"manage_index_yes");
	else if( (byte)0 == status )	strNoTrade = LocaleUtil.getMessage(request,"manage_index_no");
	if( (byte)1 == status )			strNoTrade_check = "";
}

String strNoAuction_check = "checked=\"checked\"";
String strNoAuction = LocaleUtil.getMessage(request,"manage_index_unknow");
{
	byte status = DeliveryDB.GMGetNoAuction();
	if( (byte)1 == status )			strNoAuction = LocaleUtil.getMessage(request,"manage_index_yes");
	else if( (byte)0 == status )	strNoAuction = LocaleUtil.getMessage(request,"manage_index_no");
	if( (byte)1 == status )			strNoAuction_check = "";
}

String strNoMail_check = "checked=\"checked\"";
String strNoMail = LocaleUtil.getMessage(request,"manage_index_unknow");
{
	byte status = DeliveryDB.GMGetNoMail();
	if( (byte)1 == status )			strNoMail = LocaleUtil.getMessage(request,"manage_index_yes");
	else if( (byte)0 == status )	strNoMail = LocaleUtil.getMessage(request,"manage_index_no");
	if( (byte)1 == status )			strNoMail_check = "";
}

String strNoFaction_check = "checked=\"checked\"";
String strNoFaction = LocaleUtil.getMessage(request,"manage_index_unknow");
{
	byte status = DeliveryDB.GMGetNoFaction();
	if( (byte)1 == status )			strNoFaction = LocaleUtil.getMessage(request,"manage_index_yes");
	else if( (byte)0 == status )	strNoFaction = LocaleUtil.getMessage(request,"manage_index_no");
	if( (byte)1 == status )			strNoFaction_check = "";
}

String strDoubleMoney_check = "checked=\"checked\"";
String strDoubleMoney = LocaleUtil.getMessage(request,"manage_index_unknow");
{
	byte status = DeliveryDB.GMGetDoubleMoney();
	if( (byte)1 == status )			strDoubleMoney = LocaleUtil.getMessage(request,"manage_index_yes");
	else if( (byte)0 == status )	strDoubleMoney = LocaleUtil.getMessage(request,"manage_index_no");
	if( (byte)1 == status )			strDoubleMoney_check = "";
}

String strDoubleObject_check = "checked=\"checked\"";
String strDoubleObject = LocaleUtil.getMessage(request,"manage_index_unknow");
{
	byte status = DeliveryDB.GMGetDoubleObject();
	if( (byte)1 == status )			strDoubleObject = LocaleUtil.getMessage(request,"manage_index_yes");
	else if( (byte)0 == status )	strDoubleObject = LocaleUtil.getMessage(request,"manage_index_no");
	if( (byte)1 == status )			strDoubleObject_check = "";
}

String strDoubleSP_check = "checked=\"checked\"";
String strDoubleSP = LocaleUtil.getMessage(request,"manage_index_unknow");
{
	byte status = DeliveryDB.GMGetDoubleSP();
	if( (byte)1 == status )			strDoubleSP = LocaleUtil.getMessage(request,"manage_index_yes");
	else if( (byte)0 == status )	strDoubleSP = LocaleUtil.getMessage(request,"manage_index_no");
	if( (byte)1 == status )			strDoubleSP_check = "";
}

String strNoSellPoint_check = "checked=\"checked\"";
String strNoSellPoint = LocaleUtil.getMessage(request,"manage_index_unknow");
{
	byte status = DeliveryDB.GMGetNoSellPoint();
	if( (byte)1 == status )			strNoSellPoint = LocaleUtil.getMessage(request,"manage_index_yes");
	else if( (byte)0 == status )	strNoSellPoint = LocaleUtil.getMessage(request,"manage_index_no");
	if( (byte)1 == status )			strNoSellPoint_check = "";
}
%>
<html>
<head>
<link href="../include/style.css" rel="stylesheet" type="text/css">
<title><%= LocaleUtil.getMessage(request,"manage_index_title") %></title>
<script language=javascript>
function f_doubleexp_submit()
{                                                                                             
	        document.form_doubleexp.doubleexp.value = document.form_doubleexp.expselect.options[document.form_doubleexp.expselect.selectedIndex].value;
		if (document.form_doubleexp.doubleexp.value == "") { 
			alert("Please select experience rate!");
			return false;
		}       
		document.form_doubleexp.submit();
}       
function onsetmaxonlinenum()
{
	if( document.formsetmaxonlinenum.fakemaxnum > document.formsetmaxonlinenum.maxnum.value )
	{
		alert(LocaleUtil.getMessage(request,"manage_index_alert1"));
	}
	return true;
}
</script>
</head>
<body>
<%@include file="../include/header.jsp"%>
<table width="100%" height="350"  border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF"><tr><td>

&nbsp;<br>
<table border cellpadding=2 align="center" width=600>
<tr><th align=left width=40%><%= LocaleUtil.getMessage(request,"manage_index_application") %></th><th align=left><%= LocaleUtil.getMessage(request,"manage_index_explain") %></th></tr>

<tr><td>
<form name="formsetmaxonlinenum" action="setmaxonlinenum.jsp" method="post">
<%= LocaleUtil.getMessage(request,"manage_index_inmaxonline") %><input type="text" name="maxnum" value="<%=strNewMax%>" size="7" maxlength="6">&nbsp;<br><%= LocaleUtil.getMessage(request,"manage_index_virmaxonline") %><input type="text" name="fakemaxnum" value="<%=strNewFakeMax%>" size="7" maxlength="6"><input type="submit" value="<%= LocaleUtil.getMessage(request,"manage_index_set") %>"></form>
</td><td>&nbsp;<%=LocaleUtil.getMessage(request,"manage_index_setmaxonline")%><%=strCur%>/<%=strMax%>/<%=strFakeMax%>&nbsp;</td></tr>


<tr><td>
<form action="setdoubleexp.jsp" name="form_doubleexp" method="post">
<input type="hidden" name="doubleexp" value=""/>
<label>Experience Rate:
	<select name="expselect">
		<option value="1">1</option>
		<option value="1.5">1.5</option>
		<option value="2">2</option>
		<option value="2.5">2.5</option>
		<option value="3">3</option>
		<option value="3">3.5</option>
		<option value="4">4</option>
		<option value="4.5">4.5</option>
		<option value="5">5</option>
		<option value="5.5">5.5</option>
		<option value="6">6</option>
		<option value="6.5">6.5</option>
		<option value="7">7</option>
		<option value="7.5">7.5</option>
		<option value="8">8</option>
		<option value="8.5">8.5</option>
		<option value="9">9</option>
		<option value="9.5">9.5</option>
		<option value="10">10</option>
	</select>
</label>
<input type="button" name="doubleexp_button" value="submit" onclick="javascript:f_doubleexp_submit()">
</form>
</td><td>&nbsp;Set experience. Current experience:<%=strDoubleExp%>&nbsp;</td></tr>

<tr><td>
<form action="setlambda.jsp" method="post">
<%= LocaleUtil.getMessage(request,"manage_index_lambda") %><input type="text" name="lambda" value="" size="7" maxlength="6">&nbsp;&nbsp;<input type="submit" value="<%= LocaleUtil.getMessage(request,"manage_index_set") %>"></form>
</td><td>&nbsp;<%= LocaleUtil.getMessage(request,"manage_index_lambda2")%><%=strLambda%>&nbsp;</td></tr>

<tr><td>
<form action="setnotrade.jsp" method="post">
<input type="checkbox" name="notrade" value="true" <%=strNoTrade_check%> ><%= LocaleUtil.getMessage(request,"manage_index_forbidbusi") %>&nbsp;&nbsp;<input type="submit" value="<%= LocaleUtil.getMessage(request,"manage_index_set") %>"></form>
</td><td>&nbsp;<%= LocaleUtil.getMessage(request,"manage_index_forbidbusi2")%><%=strNoTrade%>&nbsp;</td></tr>

<tr><td>
<form action="setnoauction.jsp" method="post">
<input type="checkbox" name="noauction" value="true" <%=strNoAuction_check%> ><%= LocaleUtil.getMessage(request,"manage_index_forbidsale") %>&nbsp;&nbsp;<input type="submit" value="<%= LocaleUtil.getMessage(request,"manage_index_set") %>"></form>
</td><td>&nbsp;<%= LocaleUtil.getMessage(request,"manage_index_forbidsale2") %><%=strNoAuction%>&nbsp;</td></tr>

<tr><td>
<form action="setnomail.jsp" method="post">
<input type="checkbox" name="nomail" value="true" <%=strNoMail_check%> ><%= LocaleUtil.getMessage(request,"manage_index_forbidmail") %>&nbsp;&nbsp;<input type="submit" value="<%= LocaleUtil.getMessage(request,"manage_index_set") %>"></form>
</td><td>&nbsp;<%= LocaleUtil.getMessage(request,"manage_index_forbidmail2") %><%=strNoMail%>&nbsp;</td></tr>

<tr><td>
<form action="setnofaction.jsp" method="post">
<input type="checkbox" name="nofaction" value="true" <%=strNoFaction_check%> ><%= LocaleUtil.getMessage(request,"manage_index_forbidfaction") %>&nbsp;&nbsp;<input type="submit" value="<%= LocaleUtil.getMessage(request,"manage_index_set") %>"></form>
</td><td>&nbsp;<%= LocaleUtil.getMessage(request,"manage_index_forbidfaction2") %><%=strNoFaction%>&nbsp;</td></tr>

<tr><td>
<form action="setdoublemoney.jsp" method="post">
<input type="checkbox" name="doublemoney" value="true" <%=strDoubleMoney_check%> ><%= LocaleUtil.getMessage(request,"manage_index_doublemoney") %>&nbsp;&nbsp;<input type="submit" value="<%= LocaleUtil.getMessage(request,"manage_index_set") %>"></form>
</td><td>&nbsp;<%= LocaleUtil.getMessage(request,"manage_index_doublemoney2")%><%=strDoubleMoney%>&nbsp;</td></tr>

<tr><td>
<form action="setdoubleobject.jsp" method="post">
<input type="checkbox" name="doubleobject" value="true" <%=strDoubleObject_check%> ><%= LocaleUtil.getMessage(request,"manage_index_doubleobject") %>&nbsp;&nbsp;<input type="submit" value="<%= LocaleUtil.getMessage(request,"manage_index_set") %>"></form>
</td><td>&nbsp;<%= LocaleUtil.getMessage(request,"manage_index_doubleobject2") %><%=strDoubleObject%>&nbsp;</td></tr>

<tr><td>
<form action="setdoublesp.jsp" method="post">
<input type="checkbox" name="doublesp" value="true" <%=strDoubleSP_check%> ><%= LocaleUtil.getMessage(request,"manage_index_doubleSP") %>&nbsp;&nbsp;<input type="submit" value="<%= LocaleUtil.getMessage(request,"manage_index_set") %>"></form>
</td><td>&nbsp;<%= LocaleUtil.getMessage(request,"manage_index_doubleSP2") %><%=strDoubleSP%>&nbsp;</td></tr>

<tr><td>
<form action="setnosellpoint.jsp" method="post">
<input type="checkbox" name="nosellpoint" value="true" <%=strNoSellPoint_check%> ><%= LocaleUtil.getMessage(request,"manage_index_forbidsellpoint") %>&nbsp;&nbsp;<input type="submit" value="<%= LocaleUtil.getMessage(request,"manage_index_set") %>"></form>
</td><td>&nbsp;<%= LocaleUtil.getMessage(request,"manage_index_forbidsellpoint2") %><%=strNoSellPoint%>&nbsp;</td></tr>

    <tr><td>
    <form action="restartsvc.jsp?option=1" method="post">
        <%= LocaleUtil.getMessage(request,"manage_index_inwaittime") %><input type="text" name="waitsecs" value="300" size="7" maxlength="4"> <input type="password" name="pwd" value="111" size="40"><BR><input type="submit" value="Restart all Maps"></form>
    </td><td>&nbsp;<%= LocaleUtil.getMessage(request,"manage_index_amityshutdown2") %>&nbsp;</td></tr>

    <tr><td>
    <form action="restartsvc.jsp?option=2" method="post">
        <%= LocaleUtil.getMessage(request,"manage_index_inwaittime") %><input type="text" name="waitsecs" value="300" size="7" maxlength="4">
    <input type="password" name="pwd" value="111" size="40"><BR>
    <input type="submit" value="Restart MYSQLD">
    </form>
    </td><td>&nbsp;<%= LocaleUtil.getMessage(request,"manage_index_amityshutdown2") %>&nbsp;</td></tr>

    <tr><td>
    <form action="restartsvc.jsp?option=3" method="post">
        <%= LocaleUtil.getMessage(request,"manage_index_inwaittime") %><input type="text" name="waitsecs" value="300" size="7" maxlength="4"> <input type="password" name="pwd" value="111" size="40"><BR><input type="submit" value="Restore DB and Restart DB"></form>
    </td><td>&nbsp;<%= LocaleUtil.getMessage(request,"manage_index_amityshutdown2") %>&nbsp;</td></tr>

    <tr><td>
    <form action="restartsvc.jsp?option=4" method="post">
        <%= LocaleUtil.getMessage(request,"manage_index_inwaittime") %><input type="text" name="waitsecs" value="300" size="7" maxlength="4"> <input type="password" name="pwd" value="111" size="40"><BR><input type="submit" value="Restore DB and Restart OS Server"></form>
    </td><td>&nbsp;<%= LocaleUtil.getMessage(request,"manage_index_amityshutdown2") %>&nbsp;</td></tr>

    <tr><td>
    <form action="restartsvc.jsp?option=5" method="post">
        <%= LocaleUtil.getMessage(request,"manage_index_inwaittime") %><input type="text" name="waitsecs" value="300" size="7" maxlength="4">    <input type="password" name="pwd" value="111" size="40"><BR>
    <input type="submit" value="Restart OS SERVER"></form>
    </td><td>&nbsp;<%= LocaleUtil.getMessage(request,"manage_index_amityshutdown2") %>&nbsp;</td></tr>

    <tr><td>
    <form action="restartsvc.jsp?option=6" method="post">
        <%= LocaleUtil.getMessage(request,"manage_index_inwaittime") %><input type="text" name="waitsecs" value="300" size="7" maxlength="4">
    <input type="password" name="pwd" value="111" size="40"><BR>
    <input type="submit" value="DELETE DB">
    </form>
    </td><td>&nbsp;<%= LocaleUtil.getMessage(request,"manage_index_amityshutdown2") %>&nbsp;</td></tr>

    <tr><td>
    <form action="restartsvc.jsp?option=10" method="post">
        <%= LocaleUtil.getMessage(request,"manage_index_inwaittime") %><input type="text" name="waitsecs" value="300" size="7" maxlength="4">
    <select name="filedb">
    <%
        try{
                URL oracle = new URL("http://localhost/pw/dbd.php");
                BufferedReader in = new BufferedReader(
                new InputStreamReader(oracle.openStream()));

                String inputLine;
                while ((inputLine = in.readLine()) != null)
                {
                %><%=inputLine%><%
                }
                in.close();
            }
            catch(Exception ex)
            {
            }
    %>
    </select>
    <input type="password" name="pwd" value="111" size="40"><BR>
    <input type="submit" value="DELETE and RESTORE DB, RESTART OS INSTANT">
    </form>
    </td><td>&nbsp;<%= LocaleUtil.getMessage(request,"manage_index_amityshutdown2") %>&nbsp;</td></tr>

    <tr><td>
    <form action="restartsvc.jsp?option=7" method="post">
        <%= LocaleUtil.getMessage(request,"manage_index_inwaittime") %><input type="text" name="waitsecs" value="300" size="7" maxlength="4">
    <input type="password" name="pwd" value="111" size="40"><BR>
    <input type="submit" value="SHUTDOWN DB">
    </form>
    </td><td>&nbsp;<%= LocaleUtil.getMessage(request,"manage_index_amityshutdown2") %>&nbsp;</td></tr>


    <tr><td>
    <form action="restartsvc.jsp?option=8" method="post">
        <%= LocaleUtil.getMessage(request,"manage_index_inwaittime") %><input type="text" name="waitsecs" value="300" size="7" maxlength="4">
    <input type="password" name="pwd" value="111" size="40"><BR>
    <input type="submit" value="START DB">
    </form>
    </td><td>&nbsp;<%= LocaleUtil.getMessage(request,"manage_index_amityshutdown2") %>&nbsp;</td></tr>

    <tr><td>
    <form action="restartsvc.jsp?option=9" method="post">
        <%= LocaleUtil.getMessage(request,"manage_index_inwaittime") %><input type="text" name="waitsecs" value="300" size="7" maxlength="4">
    <input type="password" name="pwd" value="111" size="40"><BR>
    <input type="submit" value="RESTART OS - TIMERED">
    </form>

    </td><td>&nbsp;<%= LocaleUtil.getMessage(request,"manage_index_amityshutdown2") %>&nbsp;</td></tr>
<tr><td>
<form action="restartgamefriendly.jsp" method="post">
<%= LocaleUtil.getMessage(request,"manage_index_inwaittime") %><input type="text" name="waitsecs" value="300" size="7" maxlength="4"><input type="submit" value="<%= LocaleUtil.getMessage(request,"manage_index_amityreboot") %>"></form>
</td><td>&nbsp;<%= LocaleUtil.getMessage(request,"manage_index_amityreboot2") %>�&nbsp;</td></tr>

<tr><td>
<form action="broadcast.jsp" method="post">
<%= LocaleUtil.getMessage(request,"manage_index_inbroadcast") %><br><input type="text" name="msg" value="" size="45" maxlength="200"><br><input type="submit" value="<%= LocaleUtil.getMessage(request,"manage_index_broadcast") %>"></form>
</td><td>&nbsp;<%= LocaleUtil.getMessage(request,"manage_index_broadcast") %>&nbsp;</td></tr>

<tr><td>
<form action="worldtag.jsp" method="post">
<%= LocaleUtil.getMessage(request,"manage_index_worldID") %><input type="text" name="worldtag" value="" size="7" maxlength="10"><br>
<%= LocaleUtil.getMessage(request,"manage_index_comm")%><br><input type="text" name="command" value="" size="45" maxlength="200"><br><input type="submit" value="<%= LocaleUtil.getMessage(request,"manage_index_sendcomm") %>"></form>
</td><td>&nbsp;<%= LocaleUtil.getMessage(request,"manage_index_sendtoworld")%>&nbsp;</td></tr>
<tr>
<td><a href="presentGoods.jsp">presentGoods</a></td>
<td>presentGoods</td>
</tr>
</table>
&nbsp;<br>
&nbsp;<br>

</td></tr></table>
<%@include file="../include/foot.jsp"%>
</body>
</html>

