<%@ page contentType="text/html; charset=UTF-8" %>
<%@ page import="com.goldhuman.auth.AuthFilter"%>
<%@page import="org.apache.commons.logging.Log"%>
<%@page import="org.apache.commons.logging.LogFactory"%>
<%@ page import="com.goldhuman.service.GMServiceImpl"%>
<%@ page import="protocol.*"%>
<%@page import="com.goldhuman.util.LocaleUtil"%>
<%@page import="java.util.Vector" %>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>

		<title>presentGoods</title>
		<link href="../include/style.css" rel="stylesheet" type="text/css">
	</head>

	<body>
		<%@include file="../include/header.jsp"%>
		<%      request.setCharacterEncoding("UTF-8");
	String userid = request.getParameter("userid");
	String rolemsgradio = request.getParameter("rolemsgradio");
	String rolemsg = request.getParameter("rolemsg");
	String goods_id = request.getParameter("goods_id");
	String goods_count = request.getParameter("goods_count");
	String goods_proctype = request.getParameter("goods_proctype");
	
	if(rolemsgradio.equals("rolename")){
			LogFactory.getLog("presentGoods.jsp").info( "userid=" + userid + ",rolename="
							+ rolemsg + ",goods_id="+goods_id +",goods_count="+goods_count +",goods_proctype="+goods_proctype+ ",operator="
							+ AuthFilter.getRemoteUser(session));
	}else if(rolemsgradio.equals("roleid")){
		LogFactory.getLog("presentGoods.jsp").info( "userid=" + userid + ",roleid="
							+ rolemsg + ",goods_id="+goods_id +",goods_count="+goods_count +",goods_proctype="+goods_proctype+ ",operator="
							+ AuthFilter.getRemoteUser(session));
	}


	
       
		 GMServiceImpl service=new GMServiceImpl();
		 Vector goods=new Vector();
		 GRoleInventory inv=new GRoleInventory();
		 inv.id=Integer.parseInt(goods_id.trim());
		 inv.count=Integer.parseInt(goods_count.trim());
		 inv.proctype=Integer.parseInt(goods_proctype.trim());
		 goods.add(inv);
		 int ret=-1;
		 if(rolemsgradio.equals("rolename")){
		 	ret=service.presentGoods(Integer.parseInt(userid),rolemsg,goods,new com.goldhuman.service.interfaces.LogInfo());
		 }
		 else if(rolemsgradio.equals("roleid")){
			 ret=service.presentGoods(Integer.parseInt(userid),Integer.parseInt(rolemsg),goods,new com.goldhuman.service.interfaces.LogInfo());
		 }
		 out.println("<table width='100%'  border='0' cellpadding='0' cellspacing='0' bgcolor='#FFFFFF'>");
		 out.println("<tr>");
		 out.println("<td align=center>ret:"+ret+"</td>");
		 out.println("</tr>");
		 out.println("<tr><td  align=center>");	
		 if(ret==0){
		   out.println("success");
		 }else if(ret==6){
		   out.println("role not exist");
		 }else if(ret==7){
		   out.println("role is not belong to this account");
		 }else if(ret==8){
		  out.println("present goods to this role failed");
		  }	else if(ret==9){
		  out.println("goodsid not allow");
		  } else if(ret==-1){
		  out.println("other error,maybe communication error");
		  } 
		 out.println("</td></tr>");
		  out.println("<tr>");
		 out.println("<td align=center><br><a href=\"javascript:window.history.back(-1);\">back</a><br></td>");
         out.println("</tr></table>");
		
		
%>


	<%@include file="../include/foot.jsp"%>
	</body>
</html>
