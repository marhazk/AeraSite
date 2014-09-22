<%@page import="java.io.*"%>
<%@page import="java.util.*"%>
<%
	String username = request.getParameter("username");
	String password = request.getParameter("password");
	//out.println("access:&nbsp;"+username+":"+password+"<br>");
	String loginrecord = null;
	int separatorIndex = 0;
	String recordUsername = null;
	String recordPassword = null;
	int recordLength = 0;
	boolean matchTag = false;
	
	try{
		FileReader fr = new FileReader("/loginlistROL.txt");
		BufferedReader br = new BufferedReader(fr);
		loginrecord = new String();
		while((loginrecord=br.readLine())!=null && !matchTag){
			recordLength = loginrecord.length();
			separatorIndex = loginrecord.indexOf(":");
			recordUsername = loginrecord.substring(0, separatorIndex);
			recordPassword = loginrecord.substring(separatorIndex+1,recordLength);
			if(recordUsername.compareTo(username)==0){
				if(recordPassword.compareTo(password)==0) matchTag = true;
			} 
		}
		if(matchTag){
			FileWriter fw = new FileWriter("rolemanagementlogs.txt",true);
			BufferedWriter bw = new BufferedWriter(fw);
			Date dateToday = new Date();
			String logStr = recordUsername+":login:"+dateToday;
			bw.write(logStr);
			bw.newLine();
			bw.close();
			bw = null;
			fw = null;
		}
		fr = null;
		br = null;
		
	} catch(Exception e){
		//out.print(e.printStackTrace());
		out.println("Error:"+e.getMessage());
	}
		
	if(matchTag){
		request.getSession().setAttribute("username", username);
		response.sendRedirect("manage.jsp");
	} else {
		response.sendRedirect("login.jsp?err=1");
	}
%>
