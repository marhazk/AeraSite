<%@ page language="java" pageEncoding="GB2312"%>
<%@ page import="com.goldhuman.auth.AuthFilter"%>
<%@ page import="com.goldhuman.service.interfaces.LogInfo"%>
<%@ page import="com.goldhuman.service.interfaces.GMService"%>
<%@ page import="com.goldhuman.service.GMServiceImpl"%>
<%@page import="org.apache.commons.logging.LogFactory"%>

<%request.setCharacterEncoding("GB2312");

			String userid = "";
			String roleid = "";
			String oldname = "";
			String newname = "";
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

			oldname = request.getParameter("oldname");
			newname = request.getParameter("newname");

			LogFactory.getLog("renamerole.jsp").info(
					"userid=" + userid + ",oldname=" + oldname + ",newname="
							+ newname + "," + "operator="
							+ AuthFilter.getRemoteUser(session));

			%>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>

		<title>角色改名</title>
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
								服务器ID
							</TH>
							<TH>
								旧角色名
							</TH>
							<TH>
								新角色名
							</TH>
							<TH>
								角色修改标志
							</TH>
						</TR>

						<%LogInfo info = null;
			int uid = -1;
			int zoneid = -1;

			GMService gs = new GMServiceImpl();
			if (userid != null && userid.trim().length() > 0) {
				try {
					uid = Integer.parseInt(userid);
				} catch (Exception e) {
					out
							.println("\"输入用户ID\" 请输入数字!&nbsp;<font color=red size=2>"
									+ e.getMessage() + "</font>");
				}
				info = new LogInfo(uid, "", "角色改名");

				int flag = gs.renameRole(uid, zoneid, oldname, newname, info);
				String result = null;
				switch (flag) {
				case 0:
					result = "成功";
					break;

				case 4:
					result = "角色不存在";
					break;

				case 5:
					result = "角色不属于该帐号";
					break;

				case 6:
					result = "新角色名称已存在,请重新选择";
					break;

				case 7:
					result = "该角色不能改名";
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
								<%=zoneid%>
							</TD>
							<TD>
								<%=oldname%>
							</TD>
							<TD>
								<%=newname%>
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
					<form name="form1" action="renamerole.jsp" method="post">
						角色改名:

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
									输入旧的角色名:
								</td>
								<td>
									<input type="text" name="oldname" value="<%=oldname%>" size="16" maxlength="10" />
								</td>
							</tr>
							<tr>
								<td>
									输入新的角色名:
								</td>
								<td>
									<input type="text" name="newname" value="<%=newname%>" size="16" maxlength="10" />
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
          
    
    }

-->

</script>

	</body>
</html>
