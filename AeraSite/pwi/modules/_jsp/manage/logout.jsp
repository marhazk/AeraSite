<%@page import="java.io.*"%>
<%@page import="java.util.*"%>
<%
		FileWriter fw = new FileWriter("servermgmtlogs.txt",true);
		BufferedWriter bw = new BufferedWriter(fw);
		Date dateToday = new Date();
		String logStr = request.getSession().getAttribute("username")+":logout:"+dateToday;
		bw.write(logStr);
		bw.newLine();
		bw.close();
		bw = null;
		fw = null;
		request.getSession().setAttribute("username",null);
		response.sendRedirect("login.jsp");
%>