<%@ page language="java" pageEncoding="GB2312"%>
<%@ page import="java.util.*"%>
<%@ page import="com.goldhuman.auth.AuthFilter"%>
<%@ page import="com.goldhuman.service.interfaces.LogInfo"%>
<%@ page import="com.goldhuman.service.interfaces.SimpleRoleBean"%>
<%@ page import="com.goldhuman.service.interfaces.GMService"%>
<%@ page import="com.goldhuman.service.GMServiceImpl"%>
<%@ page import="org.apache.commons.logging.LogFactory"%>

<%request.setCharacterEncoding("GB2312");

			String userid = "";
			String roleid2 = "";
			String rname = "";
			String biao = request.getParameter("biao");
			if (biao != null && biao.equals("1")) {
				userid = request.getParameter("userid");
			}
			if (biao != null && biao.equals("2")) {
				roleid2 = request.getParameter("roleid2");
				if (roleid2 != null && roleid2.trim().length() > 0) {
					try {
						int rid2 = Integer.parseInt(roleid2);
						userid = (rid2 & 0xFFFFFFF0) + "";
					} catch (Exception e) {
						out.println("请输入数字!&nbsp;<font color=red size=2>"
								+ e.getMessage() + "</font>");

					}
				}
			}
			if (biao != null && biao.equals("3")) {
				rname = request.getParameter("roname");
				if (rname != null && rname.trim().length() > 0) {
					try {
						GMService gs = new GMServiceImpl();
						int tem = gs.getRoleIdByName(rname, new LogInfo());
						userid = (tem & 0xFFFFFFF0) + "";
					} catch (Exception e) {
						out.println("<font color=red size=2>找不到!</font>");
					}
				}
			}

			if (userid == null || userid.trim().length() < 1)
				userid = (String) request.getAttribute("userid");
			else
				request.setAttribute("userid", userid);

			String fbdtype = request.getParameter("fbdtype");
			String forbidtime = request.getParameter("forbidtime");
			String roleid = request.getParameter("roleid");
			String reason = reason = request.getParameter("reason");
			if (fbdtype == null)
				fbdtype = "";
			if (forbidtime == null)
				forbidtime = "";
			if (roleid == null)
				roleid = "";
			if (reason == null)
				reason = "";
			if (userid == null)
				userid = "";

			LogFactory.getLog("forbidrole.jsp").info(
					"operator=" + AuthFilter.getRemoteUser(session));

			LogInfo info = null;
			int uid = -1;
			int rid = -1;
			GMService gs = new GMServiceImpl();

			%>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>


		<title>封禁角色</title>
		<link href="../include/style.css" rel="stylesheet" type="text/css">
	</head>

	<body>
		<%@include file="../include/header.jsp"%>

		<table width="100%" height="514" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">

			<tr>
				<td>

					<TABLE border="1" cellpadding="0" cellspacing="1" width="600px" align="center" bgcolor="#FFFFFF">
						<CAPTION>
							<font color="#222222">查询用户在该服务器内的角色列表</font>
						</CAPTION>
						<tr>
							<form name="form1" action="forbidrole.jsp" method="post">
							<td colspan="3">

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

										<td>
											<input type="radio" name="biao" value="2" onclick="show(2)">
											输入角色ID:
										</td>
										<td>
											<div id="rid2" style="display:none">
												<input type="text" name="roleid2" value="<%=roleid2%>" size="16" maxlength="10" />
											</div>
										</td>
										<td>
											<input type="radio" name="biao" value="3" onclick="show(3)">
											输入角色名:
										</td>
										<td>
											<div id="rname" style="display:none">
												<input type="text" name="roname" value="<%=rname%>" size="16" maxlength="10" />
											</div>
										</td>
										<td>
											<input type="submit" value="查询">
										</td>
									</tr>
								</table>

							</td>

							</form>
						</tr>

						<TR>
							<TH>
								角色ID
							</TH>
							<TH>
								角色名
							</TH>
							<TH>
								角色级别
							</TH>
						</TR>

						<%if (userid != null && userid.trim().length() > 0) {
				try {
					uid = Integer.parseInt(userid);
				} catch (Exception ee) {
					out.println("用户ID,请输入数字!&nbsp;<font color=red size=2>"
							+ ee.getMessage() + "</font>");
				}
				info = new LogInfo(uid, "", "访问用户角色列表");
				Vector v = gs.getRolelist(uid, info);
				if (v != null) {
					for (int i = 0; i < v.size(); i++) {
						SimpleRoleBean bean = (SimpleRoleBean) v.get(i);

						%>
						<TR>
							<TD>
								<%=bean.roleid%>
							</TD>
							<TD>
								<%=bean.rolename%>
							</TD>
							<TD>
								<%=bean.level%>
							</TD>
						</TR>
						<%}
				}
			}%>
					</TABLE>
				</td>
			</tr>



			<tr>
				<td>
					<FORM name="form2" action="forbidrole.jsp" method="post">
						<TABLE align="center" border="1" cellpadding="0" cellspacing="1" width="950px">
							<CAPTION>
								<font color="#222222">被封禁的角色</font>
							</CAPTION>
							<tr>
								<td align="center">
									封禁角色ID:
								</td>
								<td colspan="2">
									&nbsp;
									<input type="text" name="roleid" value="<%=roleid%>" size="20" maxlength="20">
								</td>
								<td align="center">
									封禁类型:
								</td>
								<td>
									&nbsp;
									<select name="fbdtype">
										<option value="100">
											禁止登陆
										</option>
										<option value="101">
											禁言
										</option>
										<option value="102">
											禁止玩家交易
										</option>
										<option value="103">
											禁卖
										</option>
									</select>
								</td>

								<td align="center">
									封禁时间(单位:分):
								</td>
								<td>
									&nbsp;
									<input type="text" name="forbidtime" value="<%=forbidtime%>" size="16" maxlength="10" />

								</td>
								<td>
									封禁原因
								</td>
								<td>
									<input type="text" name="reason" value="<%=reason%>" size="20" maxlength="20" />
									&nbsp;&nbsp;
									<input type="submit" value="提交">
								</td>
							</tr>

							<TR>
								<TH>
									封禁角色ID
								</TH>
								<TH>
									GM角色ID
								</TH>
								<TH>
									session ID
								</TH>
								<TH>
									封禁类型
								</TH>
								<TH>
									封禁标志
								</TH>
								<TH>
									封禁时间
								</TH>
								<TH colspan="3">
									封禁原因
								</TH>
							</TR>
							<%/*
			 * @param fbd_type : 封禁类型. 100:禁止登陆; 101:禁言; 102:禁止玩家交易; 103:禁卖
			 * @param gmroleid : GM角色ID
			 * @param localsid : session ID,可以忽略
			 * @param dstroleid : 被封禁角色ID
			 * @param forbid_time : 封禁时间,单位:秒
			 * @param reason : 封禁原因
			 * @param loginfo : 调用者信息
			 */

			int gmroleid = -1;
			int localsid = -1;
			int forbid_time = -1;
			byte fbd_type = -1;

			if (roleid != null && roleid.trim().length() > 0) {
				try {
					rid = Integer.parseInt(roleid);
				} catch (Exception e) {
					out.println("角色ID,请输入数字!&nbsp;<font color=red size=2>"
							+ e.getMessage() + "</font><br>");
				}
				try {

					fbd_type = Byte.parseByte(fbdtype);
				} catch (Exception ex) {
					out.println("封禁类型,请输入数字!&nbsp;<font color=red size=2>"
							+ ex.getMessage() + "</font><br>");
				}
				try {
					forbid_time = Integer.parseInt(forbidtime);
					forbid_time = forbid_time * 60;
				} catch (Exception exp) {
					out.println("封禁时间，请输入整数!&nbsp;<font color=red size=2>"
							+ exp.getMessage() + "</font><br>");
				}
				info = new LogInfo(rid, "", "封禁角色");

				int flag = gs.forbidRole(fbd_type, gmroleid, localsid, rid,
						forbid_time, reason, info);
				String result = null;
				switch (flag) {
				case -1:
					result = "失败";
					break;
				default:
					result = flag + "";
				}
				String fbdType = "";
				switch (fbd_type) {
				case 100:
					fbdType = "禁止登陆";
					break;
				case 101:
					fbdType = "禁言";
					break;
				case 102:
					fbdType = "禁止玩家交易";
					break;
				case 103:
					fbdType = "禁卖";
				}

				%>
							<TR>
								<TD>
									<%=rid%>
								</TD>
								<TD>
									<%=gmroleid%>
								</TD>
								<TD>
									<%=localsid%>
								</TD>
								<TD>
									<%=fbdType%>
								</TD>
								<TD>
									<%=result%>
								</TD>
								<TD>
									<%=forbid_time%>
									秒
								</TD>
								<TD colspan="3">
									<%=reason%>
									&nbsp;
								</TD>
							</TR>
							<%}%>
						</TABLE>
					</FORM>
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
        document.getElementById("rid2").style.display="";
      else
        document.getElementById("rid2").style.display="none";  
      if(t==3)
        document.getElementById("rname").style.display="";
      else 
        document.getElementById("rname").style.display="none";           
    
    }

-->

</script>

	</body>
</html>
