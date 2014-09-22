<%@ page language="java" pageEncoding="GB2312"%>
<%@ page import="com.goldhuman.auth.AuthFilter"%>
<%@ page import="com.goldhuman.service.interfaces.LogInfo"%>
<%@ page import="com.goldhuman.service.interfaces.GMService"%>
<%@ page import="com.goldhuman.service.GMServiceImpl"%>
<%@ page import="com.goldhuman.service.interfaces.ComplainRe"%>
<%@ page import="org.apache.commons.logging.LogFactory"%>
<%@ page import="com.goldhuman.util.Page"%>
<%@ page import="java.sql.*"%>
<jsp:useBean id="mysql" class="com.goldhuman.util.MySqlCon" />


<%try {%>
<%request.setCharacterEncoding("GB2312");

				LogFactory.getLog("fetchcomplains.jsp").info(
						"operator=" + AuthFilter.getRemoteUser(session));

				%>

<%String flag = request.getParameter("flag");
				if (flag != null && flag.equals("true")) {
					String roleid = request.getParameter("roleid");
					String gmroleid = request.getParameter("gmroleid");
					String gmrolename = request.getParameter("gmrolename");
					String content = request.getParameter("content");
					int rd = -1;
					int gmd = -1;
					if (roleid != null && roleid.trim().length() > 0)
						rd = Integer.parseInt(roleid);
					if (gmroleid != null && gmroleid.trim().length() > 0)
						gmd = Integer.parseInt(gmroleid);

					ComplainRe reply = new ComplainRe(rd, gmd, gmrolename,
							content);

					LogInfo info2 = new LogInfo(-1, "", "回复投诉处理!");
					GMService gs2 = new GMServiceImpl();
					gs2.replyComplain(reply, info2);

					String str = "insert into replyComplain(roleid,gmroleid,gmrolename,content,sendtime) values("
							+ rd
							+ ","
							+ gmd
							+ ",'"
							+ gmrolename
							+ "','"
							+ content + "',now())";

					mysql.updateLog(str);

				}

				%>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>

		<title>最新投诉信息</title>
		<link href="../include/style.css" rel="stylesheet" type="text/css">
	</head>

	<body>
		<%@include file="../include/header.jsp"%>
		<table width="100%" height="514" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">

			<tr>
				<td>

					<TABLE border="1" cellpadding="0" cellspacing="1" width="800px" align="center" bgcolor="#FFFFFF">
						<TR>
							<TH>
								投诉类型
							</TH>
							<TH>
								角色ID
							</TH>
							<TH>
								角色名
							</TH>
							<TH>
								投诉角色ID
							</TH>
							<TH>
								投诉角色名
							</TH>
							<TH>
								服务器ID
							</TH>
							<TH>
								地图区域
							</TH>
							<TH>
								投诉内容
							</TH>
							<TH>
								回复
							</TH>
						</TR>
						<%//
				//

				Page pag = null;
				String allCount = null;
				String sql = null;
				ResultSet rs = null;
				// 获取参数
				String currentPage = request.getParameter("currentPage");
				// 查询总数
				allCount = (String) request.getAttribute("allcount");
				if (allCount == null) {
					sql = "select count(*) as count from complains";
					rs = mysql.selectLog(sql);
					if (rs.next()) {
						allCount = rs.getString("count");
						request.setAttribute("allcount", allCount);
					}
				}
				// 实现分页显示
				pag = new Page();
				pag.setPage(currentPage, Integer.parseInt(allCount));

				//

				sql = "select * from complains order by roleid asc limit "
						+ (Integer.parseInt(pag.getCurrentNumStart()) - 1)
						+ ",10";

				rs = mysql.selectLog(sql);
				while (rs.next()) {

					%>
						<TR>
							<TD>
								<%=rs.getString("comtype")%>
								&nbsp;
							</TD>
							<TD>
								<%=rs.getString("roleid")%>
								&nbsp;
							</TD>
							<TD>
								<%=rs.getString("rolename")%>
								&nbsp;
							</TD>
							<TD>
								<%=rs.getString("comroleid")%>
								&nbsp;
							</TD>
							<TD>
								<%=rs.getString("comrolename")%>
								&nbsp;
							</TD>
							<TD>
								<%=rs.getString("zoneid")%>
								&nbsp;
							</TD>
							<TD>
								<%=rs.getString("mapzone")%>
								&nbsp;
							</TD>
							<TD>
								<%=rs.getString("content")%>
								&nbsp;
							</TD>
							<TD align="center">
								<a href="javascript:reply(<%=rs.getString("roleid")%>)">回复</a>
							</TD>
						</TR>
						<%}
				rs.close();
				mysql.close();

				%>
					</TABLE>

				</td>
			</tr>

			<tr>
				<td>

					<table border="0" align="right">
						<tr valign="bottom">
							<td align="right">

								<%if (pag.getShow_pre_flag().equals("yes")) {%>
								<a href="javascript:turnPage('<%=pag.getCurrentPage()%>','first')">首页</a> <a href="javascript:turnPage('<%=pag.getCurrentPage()%>','pre')">上一页</a>
								<%} else {%>
								<span>首页 上一页</span>
								<%}%>

								<%if (pag.getShow_next_flag().equals("yes")) {%>
								<a href="javascript:turnPage('<%=pag.getCurrentPage()%>','next')">下一页</a> <a href="javascript:turnPage('<%=pag.getAllPage()%>','last')">尾页</a>
								<%} else {%>
								<span>下一页 尾页</span>
								<%}%>

							</td>
							<td width="10">
								&nbsp;
							</td>
							<td>
								总共<font color="blue"><%=pag.getAllPage()%></font>页 &nbsp;当前第
								<select id="turn" onchange="javascript:gotoPage()">
									<%for (int k = 1; k <= Integer.parseInt(pag.getAllPage()); k++) {%>
									<OPTION value="<%=k%>" <%if(pag.getCurrentPage().equals(k+"")){%> selected <%}%>>
										<%=k%>
									</OPTION>
									<%}%>
								</select>
								页
							</td>
						</tr>
					</table>

				</td>
			</tr>


			<tr>
				<td id="reply" style="display:none;">

					<FORM name="form2" action="fetchcomplains.jsp" method="post">
						<TABLE align="center" border="1" cellpadding="1" cellspacing="1" width="400px">
							<CAPTION>
								回复投诉
							</CAPTION>
							<TR>
								<TD>
									角色ID
								</TD>
								<TD>
									<input type="text" name="roleid" value="" size="20" maxlength="20">
								</TD>
							</TR>
							<TR>
								<TD>
									GM角色ID
								</TD>
								<TD>
									<input type="text" name="gmroleid" size="20" maxlength="20">
								</TD>
							</TR>
							<TR>
								<TD>
									GM角色名
								</TD>
								<TD>
									<input type="text" name="gmrolename" size="20" maxlength="20">
								</TD>
							</TR>
							<TR>
								<TD>
									内容
								</TD>
								<TD>
									<textarea name="content" cols="20" rows="5"></textarea>
									&nbsp;&nbsp;
									<input type="hidden" name="flag" value="true">
									<input type="button" value="回复" onclick="checknum()">
								</TD>
							</TR>
						</TABLE>
					</FORM>

				</td>
			</tr>


		</table>
		<%@include file="../include/foot.jsp"%>

		<script language="javascript">
		<!-- 
		
		function turnPage(currentPage,dir)
 {
    if(dir=="first"){
        currentPage="1";
    }else if(dir=="next"){
        currentPage=parseInt(currentPage)+1;
    }else if(dir=="pre"){
        currentPage=parseInt(currentPage)-1;
    }else{
        currentPage=currentPage;
    }
    location.href="fetchcomplains.jsp?currentPage="+currentPage;
}
	
	
	function gotoPage(){
    var c=document.getElementById("turn");
    location.href="fetchcomplains.jsp?currentPage="+c.value;
    
}	
		
		-->

		</script>

		<script language="javascript">
<!-- 

      function reply(id){    
        document.getElementById("reply").style.display="";
        document.all("roleid").focus();
        document.all("roleid").value=id;      
      }


       function checknum(){ 
        var p=document.all("roleid").value;      
        if (p == "") {
            alert ("『角色ID』输入不能为空！");
            return false;
             
        } 
        var l = p.length; 
        var count=0; 
        for(var i=0; i<l; i++){ 
            var digit = p.charAt(i); 
            if(digit < "0" || digit > "9"){
               alert ("『角色ID』输入类型必须为数字！");
               return false;
                
            } 
        } 
        
        
        var p2=document.all("gmroleid").value;      
        if (p2 == "") {
            alert ("『GM角色ID』输入不能为空！");
            return false;
             
        } 
        var l2 = p2.length; 
        var count2=0; 
        for(var i2=0; i2<l2; i2++){ 
            var digit2 = p2.charAt(i2); 
            if(digit2 < "0" || digit2 > "9"){
               alert ("『GM角色ID』输入类型必须为数字！");
               return false;
               
            } 
        } 
             
        
       document.forms["form2"].submit(); 
      } 

    
-->
       </script>



		<%} catch (Exception e) {
				e.printStackTrace();
				out.println(e.getMessage());
			}%>
	</body>
</html>
