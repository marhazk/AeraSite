<%@page contentType="text/html; charset=UTF-8"%>
<%@page import="java.lang.*"%>
<%@page import="protocol.*"%>
<%@page import="com.goldhuman.auth.*"%>
<%@page import="org.apache.commons.logging.Log"%>
<%@page import="org.apache.commons.logging.LogFactory"%>
<%@page import="java.util.*"%>
<%@page import="java.io.*"%>
<%
request.setCharacterEncoding("UTF-8");
	String msg = request.getParameter("msg");
msg = "TEST";
	boolean success = DeliveryDB.broadcast((byte)9,1056,msg);
success = DeliveryDB.broadcast((byte)9,(int)1056,"TEST 9");
success = DeliveryDB.broadcast((byte)8,(int)1056,"TEST 8");
success = DeliveryDB.broadcast((byte)7,(int)1056,"TEST 7");
success = DeliveryDB.broadcast((byte)6,(int)1056,"TEST 6");
success = DeliveryDB.broadcast((byte)5,(int)1056,"TEST 5");
success = DeliveryDB.broadcast((byte)4,(int)1056,"TEST 4");
success = DeliveryDB.broadcast((byte)3,(int)1056,"TEST 3");
success = DeliveryDB.broadcast((byte)2,(int)1056,"TEST 2");
success = DeliveryDB.broadcast((byte)1,(int)1056,"TEST 1");
success = DeliveryDB.broadcast((byte)0,(int)1056,"TEST 0");

			if( success )
			{%>
				<span class="ver_10_black">SUCCESS</span>
				<%	  
			} else 
			{%>
				<span class="ver_10_red">FAIL</span>
				<%
			}%>    
