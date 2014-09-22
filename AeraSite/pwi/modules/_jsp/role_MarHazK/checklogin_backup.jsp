<%@page import="java.io.*"%>
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
		FileReader fr = new FileReader("/loginlist.txt");
		BufferedReader br = new BufferedReader(fr);
		loginrecord = new String();
		while((loginrecord=br.readLine())!=null && !matchTag){
			recordLength = loginrecord.length();
			separatorIndex = loginrecord.indexOf(":");
			recordUsername = loginrecord.substring(0, separatorIndex);
			recordPassword = loginrecord.substring(separatorIndex+1,recordLength);
			//out.print("record:"+recordUsername+":"+recordPassword+"<br>");
			//out.print("compare:"+recordUsername.compareTo(username));
			if(recordUsername.compareTo(username)==0){
				if(recordPassword.compareTo(password)==0) matchTag = true;
			} 
		}
	} catch(Exception e){
		//out.print(e.printStackTrace());
	}
		
	if(matchTag){
		request.getSession().setAttribute("username", username);
		response.sendRedirect("manage.jsp");
	} else {
		response.sendRedirect("login.jsp?err=1");
	}
%>