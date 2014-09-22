<%@ page language="java" pageEncoding="GB2312"%>
<%@ page import="com.goldhuman.auth.AuthFilter"%>
<%@ page import="com.goldhuman.service.interfaces.LogInfo"%>
<%@ page import="com.goldhuman.service.interfaces.GMService"%>
<%@ page import="com.goldhuman.service.GMServiceImpl"%>
<%@page import="org.apache.commons.logging.LogFactory"%>

<%request.setCharacterEncoding("GB2312");

			String userid = "";
			String roleid = "";
			String rolename = "";
			String biao = request.getParameter("biao");
			if (biao != null && biao.equals("1")) {
				userid = request.getParameter("userid");
			}
			if (biao != null && biao.equals("2")) {
				roleid = request.getParameter("roleid");
				if (roleid != null && roleid.trim().length() > 0) {
					try {
						int rid = Integer.parseInt(roleid);
						userid = (rid & 0xFFFFFFF0) + "";
					} catch (Exception e) {
						out.println("请输入数字!&nbsp;<font color=red size=2>"
								+ e.getMessage() + "</font>");

					}
				}
			}
			if (biao != null && biao.equals("3")) {
				rolename = request.getParameter("rolename");
				if (rolename != null && rolename.trim().length() > 0) {
					try {
						GMService gs = new GMServiceImpl();
						int tem = gs.getRoleIdByName(rolename, new LogInfo());
						userid = (tem & 0xFFFFFFF0) + "";
					} catch (Exception e) {
						out.println("<font color=red size=2>找不到!</font>");
					}
				}
			}

			LogFactory.getLog("deleterole.jsp").info(
					"useid=" + userid + ",rolename=" + rolename + ","
							+ "operator=" + AuthFilter.getRemoteUser(session));

			%>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>

		<title>删除角色</title>
		<link href="../include/style.css" rel="stylesheet" type="text/css">
	</head>

	<body>
		<%@include file="../include/header.jsp"%>

		<table width="100%" height="514" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">

			<tr>
				<td>
					<TABLE align="center" border="1" cellpadding="0" cellspacing="1" width="500px">
						<TR>
							<TH>
								用户ID
							</TH>
							<TH>
								角色名
							</TH>
							<TH>
								删除标志
							</TH>
						</TR>
						<%LogInfo info = null;
			int uid = -1;
			GMService gs = new GMServiceImpl();
			if (userid != null && userid.trim().length() > 0) {
				try {
					uid = Integer.parseInt(userid);
				} catch (Exception e) {
					out
							.println("\"输入用户ID\" 请输入数字!&nbsp;<font color=red size=2>"
									+ e.getMessage() + "</font>");
				}
				info = new LogInfo(uid, "", "删除角色");

				int flag = gs.deleteRole(uid, rolename, info);
				String result = null;
				switch (flag) {
				case 0:
					result = "成功";
					break;

				case 3:
					result = "角色不存在";
					break;

				case 4:
					result = "角色不属于该帐号";
					break;

				case -1:
					result = "网络通讯超时";
				}

				%>
						<TR>
							<TD>
								<%=uid%>
							</TD>
							<TD>
								<%=rolename%>
							</TD>
							<TD>
								<%=result%>
							</TD>
						</TR>
						<%}%>
					</TABLE>
				</td>
			</tr>

			<tr>
				<td align="center">
					<form name="form1" action="deleterole.jsp" method="post">
						删除角色:
						<table border="0">
							<tr>
								<td>
									<input type="radio" name="biao" value="1" onclick="show(1)" checked="checked">
									输入用户ID:
								</td>
								<td>
									<div id="uid" style="display:">
										<input type="text" name="userid" value="<%=userid%>" size="16" maxlength="10" />
									</div>
								</td>
							</tr>
							<tr>
								<td>
									<input type="radio" name="biao" value="2" onclick="show(2)">
									输入角色ID:
								</td>
								<td>
									<div id="rid" style="display:none">
										<input type="text" name="roleid" value="<%=roleid%>" size="16" maxlength="10" />
									</div>
								</td>
							</tr>
							<tr>
								<td>
									<input type="radio" name="biao" value="3" onclick="show(3)">
									输入角色名:
								</td>
								<td>
									<div id="rname" style="display:none">
										<input type="text" name="rolename" value="<%=rolename%>" size="16" maxlength="10" />
									</div>
								</td>
							</tr>
						</table>

						<input type="submit" value="提交">
					</form>
				</td>
			</tr>

		</table>
		<%@include file="../include/foot.jsp"%>

		<script language="javascript">
<!--

    function show(t){
      if(t==1)
        document.getElementById("uid").style.display="";
      else
        document.getElementById("uid").style.display="none";
      if(t==2)  
        document.getElementById("rid").style.display="";
      else
        document.getElementById("rid").style.display="none"; 
      if(t==3)
        document.getElementById("rname").style.display="";
      else 
        document.getElementById("rname").style.display="none";       
          
    
    }

-->

</script>

	</body>
</html>
