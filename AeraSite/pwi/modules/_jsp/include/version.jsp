<%@ page contentType="text/html; charset=UTF-8" %>
<%@page import="java.util.*"%>                                                                
<%@page import="com.goldhuman.util.*"%>                                                       
<%@page import="common.*"%>                                                                   
<%@page import="com.goldhuman.auth.*"%>                                                       
<%@page import="com.goldhuman.util.*"%>                                                       
<%@page import="com.goldhuman.Common.*"%>                                                     
<%@page import="org.apache.commons.logging.Log"%>                                             
<%@page import="org.apache.commons.logging.LogFactory"%>                                      
<%@page import="com.goldhuman.service.mhsdinterfaces.*"%>                                     
<%@page import="com.goldhuman.service.*"%>                                                    
<%@page import="javax.management.*"%>                                                         
<%@page import="javax.management.remote.*"%>                                                  
<%@page import="java.rmi.*"%>                                                                 
                                                                                              
<html>                                                                                        
<head>                                                                                        
<link href="../include/style.css" rel="stylesheet" type="text/css">                           
<title>version message</title>                                                                
</head>
<body>
<%@include file="../include/header.jsp"%>                                                     
<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
<tr><td>
<table width="30%" align="center" border="1" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">             
<tr><td align="center"> classes/version.conf message</td> </tr>
<tr><td align="center">version:<%= protocol.IwebVersionManager.getInstance().getVersionConfVersion().getVersion() %></td></tr>
<tr><td align="center">update:<%= protocol.IwebVersionManager.getInstance().getVersionConfVersion().getUpdate() %></td></tr>
<tr><td align="center">game:<%= protocol.IwebVersionManager.getInstance().getVersionConfVersion().getGame() %></td></tr>
<tr><td align="center">comment:<%= protocol.IwebVersionManager.getInstance().getVersionConfVersion().getComment() %></td></tr>
<tr><td align="center">build:<%= protocol.IwebVersionManager.getInstance().getVersionConfVersion().getBuildDate() %></td></tr>
</table>
</td></tr>
<tr><td>
<table width="30%" align="center" border="1" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">             
<tr><td align="center"> /etc/iweb.conf message</td> </tr>
<tr><td align="center">version:<%= protocol.IwebVersionManager.getInstance().getIwebConfVersion().getVersion() %></td></tr>
<tr><td align="center">update:<%= protocol.IwebVersionManager.getInstance().getIwebConfVersion().getUpdate() %></td></tr>
<tr><td align="center">game:<%= protocol.IwebVersionManager.getInstance().getIwebConfVersion().getGame() %></td></tr>                                                                      
<tr><td align="center">comment:<%= protocol.IwebVersionManager.getInstance().getIwebConfVersion().getComment() %></td></tr>
<tr><td align="center">build:<%= protocol.IwebVersionManager.getInstance().getIwebConfVersion().getBuildDate() %></td></tr>
</table>
</td></tr>
</table>                                                                                      
<%@include file="../include/foot.jsp"%>
</body>
</html>
