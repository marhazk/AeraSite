<%@ page contentType="text/html; charset=UTF-8" %>
<%@ page import="java.util.*"%>
<%@ page import="com.goldhuman.auth.AuthFilter"%>
<%@ page import="com.goldhuman.service.interfaces.*"%>
<%@ page import="com.goldhuman.service.GMServiceImpl"%>
<%@ page import="org.apache.commons.logging.LogFactory"%>
<%@ page import="com.goldhuman.util.LocaleUtil"%>

<%	
			String userid = "";
			String roleid2 = "";
			String rname = "";
			String action = request.getParameter("action");
			if (action == null) action = "";
			String biao = request.getParameter("biao");
			if (biao != null && biao.equals("1")) {
				userid = request.getParameter("userid");
			}
			if (biao != null && biao.equals("2")) {
				roleid2 = request.getParameter("roleid2");
				if (roleid2 != null && roleid2.trim().length() > 0) {
					try {
						int rid2 = Integer.parseInt(roleid2);
						GMService gs = new GMServiceImpl();
						int tmpid = gs.roleid2Uid(new Integer(rid2), new LogInfo());
						if (-1 == tmpid)
							throw new Exception("roleid2Uid error");
						userid = Integer.toString(tmpid);
					} catch (Exception e) {
						out.println(LocaleUtil.getMessage(request,"role_forbid_inputnum") + "&nbsp;<font color=red size=2>" + e.getMessage() + "</font>");

					}
				}
			}
			if (biao != null && biao.equals("3")) {
				rname = request.getParameter("roname");
				if (rname != null && rname.trim().length() > 0) {
					try {
						GMService gs = new GMServiceImpl();
						int tem = gs.getRoleIdByName(rname, new LogInfo());
						if (-1 == tem)
		
							throw new Exception("getRoleIdByName error");
						int tmpid = gs.roleid2Uid(new Integer(tem), new LogInfo());
						if (-1 == tmpid)
							throw new Exception("roleid2Uid error");
						userid = Integer.toString(tmpid);
					} catch (Exception e) {
						out.println("<font color=red size=2>" + LocaleUtil.getMessage(request,"role_forbid_nofound") + "</font>");
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

			LogFactory.getLog("forbiduser.jsp").info(
					"operator=" + AuthFilter.getRemoteUser(session));

			LogInfo info = null;
			int uid = -1;
			int rid = -1;
			GMService gs = new GMServiceImpl();
		

			%>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>


		<title> <%= LocaleUtil.getMessage(request,"role_forbid_forbrole") %></title>
		<link href="../include/style.css" rel="stylesheet" type="text/css">
	</head>

	<body>
		<%@include file="../include/header.jsp"%>

		<table width="100%" height="514" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">

			<tr>
				<td>

					<TABLE border="1" cellpadding="0" cellspacing="1" width="600px" align="center" bgcolor="#FFFFFF">
						<CAPTION>
							<font color="#222222"><%= LocaleUtil.getMessage(request,"role_forbid_searchuserroles")%></font>
						</CAPTION>
						<tr>
							<form name="form1" action="forbiduser.jsp" method="post">
							<td colspan="3">

								<table border="0">
									<tr>
										<td>
											<input type="radio" name="biao" value="1" onclick="show(1)" checked="checked">
											<%= LocaleUtil.getMessage(request,"role_forbid_inputuserid") %>
										</td>
										<td>
											<div id="uid" style="display:">
												<input type="text" name="userid" value="<%=userid%>" size="16" maxlength="10" />
											</div>
										</td>

										<td>
											<input type="radio" name="biao" value="2" onclick="show(2)">
											<%= LocaleUtil.getMessage(request,"role_forbid_inputroleid") %>
										</td>
										<td>
											<div id="rid2" style="display:none">
												<input type="text" name="roleid2" value="<%=roleid2%>" size="16" maxlength="10" />
											</div>
										</td>
										<td>
											<input type="radio" name="biao" value="3" onclick="show(3)">
											<%= LocaleUtil.getMessage(request,"role_forbid_inputrolename") %>
										</td>
										<td>
											<div id="rname" style="display:none">
												<input type="text" name="roname" value="<%=rname%>" size="16" maxlength="10" />
											</div>
										</td>
										<td>
											<input type="submit" value="<%= LocaleUtil.getMessage(request,"role_forbid_search") %>">
										</td>
									</tr>
								</table>

							</td>

							</form>
						</tr>

						<TR>
							<TH>
								<%= LocaleUtil.getMessage(request,"role_forbid_roleid") %>
							</TH>
							<TH>
								<%= LocaleUtil.getMessage(request,"role_forbid_rolename") %>
							</TH>
							<TH>
								<%= LocaleUtil.getMessage(request,"role_forbid_rolelevel") %>
							</TH>
						</TR>

						<%if (userid != null && userid.trim().length() > 0) {
				try {
					uid = Integer.parseInt(userid);
				} catch (Exception ee) {
					out.println(LocaleUtil.getMessage(request,"role_forbid_useridinputnum") + "&nbsp;<font color=red size=2>"
							+ ee.getMessage() + "</font>");
				}
				info = new LogInfo(0, "", LocaleUtil.getMessage(request,"role_forbid_userrolelist"));
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
					<FORM name="form2" action="forbiduser.jsp" method="post">
						<TABLE align="center" border="1" cellpadding="0" cellspacing="1" width="950px">
						<CAPTION>
							<font color="#222222"><%= LocaleUtil.getMessage(request,"role_forbiduser_forbiduserid")%></font>
						</CAPTION>
	
							<tr>
								<td align="center">
									<%= LocaleUtil.getMessage(request,"role_forbiduser_forbiduserid") %>
								</td>
								<td colspan="2">
									&nbsp;
									<input type="text" name="userid" value="<%=userid%>" size="20" maxlength="20">
								</td>

								<td align="center">
									<%= LocaleUtil.getMessage(request,"role_forbid_forbtime") %>
								</td>
								<td>
									&nbsp;
									<input type="text" name="forbidtime" value="<%=forbidtime%>" size="16" maxlength="10" />

								</td>
								<td>
									<%= LocaleUtil.getMessage(request,"role_forbid_forbreason") %>
								</td>
								<td>
									<input type="text" name="reason" value="<%=reason%>" size="20" maxlength="20" />
									<input type="hidden" name="action" value="forbiduser"/>
									&nbsp;&nbsp;
									<input type="submit" value="<%= LocaleUtil.getMessage(request,"role_forbid_submit")%>">
								</td>
							</tr>

							<TR>
								<TH>
									<%= LocaleUtil.getMessage(request,"role_forbid_forbroleid") %>
								</TH>
								<TH>
									<%= LocaleUtil.getMessage(request,"role_forbid_gmroleid") %>
								</TH>
								<TH>
									session ID
								</TH>
								<TH>
									<%= LocaleUtil.getMessage(request,"role_forbid_forbtype") %>
								</TH>
								<TH>
									<%= LocaleUtil.getMessage(request,"role_forbid_forbflag") %>
								</TH>
								<TH>
									<%= LocaleUtil.getMessage(request,"role_forbid_forbtime2") %>
								</TH>
								<TH colspan="3">
									<%= LocaleUtil.getMessage(request,"role_forbid_forbreason") %>
								</TH>
							</TR>
			<%
			 /*
			 * @param fbd_type : 封禁类型. 100:禁止登陆; 101:禁言; 102:禁止玩家交易; 103:禁卖
			 * @param gmroleid : GM角色ID
			 * @param localsid : session ID,可以忽略
			 * @param dstroleid : 被封禁角色ID
			 * @param forbid_time : 封禁时间,单位:秒
			 * @param reason : 封禁原因
			 * @param loginfo : 调用者信息
			 */

		if (action.equals("forbiduser")) {
			userid = request.getParameter("userid");
			if (userid == null) { out.println("userid is null");  return;}
out.println("userid="+userid);
			int gmroleid = -1;
			int localsid = -1;
			int forbid_time = -1;
			byte fbd_type = -1;

			if (userid != null && userid.trim().length() > 0) {
				try {
					uid = Integer.parseInt(userid);
				} catch (Exception e) {
					out.println(LocaleUtil.getMessage(request,"role_forbid_roleinputnum") + "&nbsp;<font color =red size=2>" + e.getMessage() + "</font>");
				}
				try {

					fbd_type = Byte.parseByte(fbdtype);
				} catch (Exception ex) {
					//out.println(LocaleUtil.getMessage(request,"role_forbid_typeinputnum") + "&nbsp;<font color =red size=2>" + ex.getMessage() + "</font>");
				}
				try {
					forbid_time = Integer.parseInt(forbidtime);
					forbid_time = forbid_time * 60;
				} catch (Exception exp) {
					//out.println(LocaleUtil.getMessage(request,"role_forbid_timeinputint") + "&nbsp;<font color =red size=2>" + exp.getMessage() + "</font>");
				}
				info = new LogInfo(0, "", LocaleUtil.getMessage(request,"role_forbid_forbrole") );

				RoleForbidBean roleforbidbean = gs.ForbidUser(uid, forbid_time, reason, info);
				String result = null;
				if (roleforbidbean == null) {
					roleforbidbean = new RoleForbidBean();
					result = LocaleUtil.getMessage(request,"role_forbid_fail");
				} else {
					result = LocaleUtil.getMessage(request, "role_modifyroledata_success");
				}
				String fbdType = "";
				switch (fbd_type) {
				case 100:
					fbdType = LocaleUtil.getMessage(request,"role_forbid_forblogin");
					break;
				case 101:
					fbdType = LocaleUtil.getMessage(request,"role_forbid_forbspeak");
					break;
				case 102:
					fbdType = LocaleUtil.getMessage(request,"role_forbid_forbbusi");
					break;
				case 103:
					fbdType = LocaleUtil.getMessage(request,"role_forbid_forbsale");
				}

				%>
							<TR>
								<TD>
									<%=userid%>
								</TD>
								<TD>
									<%=gmroleid%>
								</TD>
								<TD>
									<%=localsid%>
								</TD>
								<TD>
									<%=roleforbidbean.type%>
								</TD>
								<TD>
									<%=result%>
								</TD>
								<TD>
									<%=roleforbidbean.time%>
									<%= LocaleUtil.getMessage(request,"role_forbid_sec") %>
								</TD>
								<TD colspan="3">
									<%=roleforbidbean.reason%>
									&nbsp;
								</TD>
							</TR>
				<%}%>
			<%}%>
						</TABLE>
					</FORM>
				</td>
			</tr>
			<tr>
				<td>
					<FORM name="form3" action="forbiduser.jsp" method="post">
						<TABLE align="center" border="1" cellpadding="0" cellspacing="1" width="950px">
						<CAPTION>
							<font color="#222222"><%= LocaleUtil.getMessage(request,"role_forbiduser_searchuserid")%></font>
						</CAPTION>
	
							<tr>
								<td align="center">
									<%= LocaleUtil.getMessage(request,"role_forbiduser_forbiduserid") %>
								</td>
								<td colspan="2">
									&nbsp;
									<input type="text" name="userid" value="<%=userid%>" size="20" maxlength="20">
								</td>

								<td>
									<input type="hidden" name="action" value="forbiduserinfo"/>
									<input type="submit" value="<%= LocaleUtil.getMessage(request,"role_forbid_submit")%>">
								</td>
							</tr>

							<TR>
								<TH>
									<%= LocaleUtil.getMessage(request,"role_forbid_forbroleid") %>
								</TH>
								<TH>
									<%= LocaleUtil.getMessage(request,"role_forbid_gmroleid") %>
								</TH>
								<TH>
									session ID
								</TH>
								<TH>
									<%= LocaleUtil.getMessage(request,"role_forbid_forbtype") %>
								</TH>
								<TH>
									<%= LocaleUtil.getMessage(request,"role_forbid_forbflag") %>
								</TH>
								<TH>
									<%= LocaleUtil.getMessage(request,"role_forbid_forbtime2") %>
								</TH>
								<TH colspan="3">
									<%= LocaleUtil.getMessage(request,"role_forbid_forbreason") %>
								</TH>
							</TR>
			<%
			 /*
			 * @param fbd_type : 封禁类型. 100:禁止登陆; 101:禁言; 102:禁止玩家交易; 103:禁卖
			 * @param gmroleid : GM角色ID
			 * @param localsid : session ID,可以忽略
			 * @param dstroleid : 被封禁角色ID
			 * @param forbid_time : 封禁时间,单位:秒
			 * @param reason : 封禁原因
			 * @param loginfo : 调用者信息
			 */

		if (action.equals("forbiduserinfo")) {
			userid = request.getParameter("userid");
                        if (userid == null) { out.println("userid is null");  return;}
			int gmroleid2 = -1;
			int localsid2 = -1;
			int forbid_time2 = -1;
			byte fbd_type2 = -1;

			if (userid != null && userid.trim().length() > 0) {
				try {
					uid = Integer.parseInt(userid);
				} catch (Exception e) {
					out.println(LocaleUtil.getMessage(request,"role_forbid_roleinputnum") + "&nbsp;<font color =red size=2>" + e.getMessage() + "</font>");
				}
				try {

					fbd_type2 = Byte.parseByte(fbdtype);
				} catch (Exception ex) {
					//out.println(LocaleUtil.getMessage(request,"role_forbid_typeinputnum") + "&nbsp;<font color =red size=2>" + ex.getMessage() + "</font>");
				}
				try {
					forbid_time2 = Integer.parseInt(forbidtime);
					forbid_time2 = forbid_time2 * 60;
				} catch (Exception exp) {
					//out.println(LocaleUtil.getMessage(request,"role_forbid_timeinputint") + "&nbsp;<font color =red size=2>" + exp.getMessage() + "</font>");
				}
				info = new LogInfo(0, "", LocaleUtil.getMessage(request,"role_forbid_forbrole") );

				RoleForbidBean roleforbidbean2 = gs.ForbidUserInfo(uid, info);
				String result2 = null;
				if (roleforbidbean2 == null) {
					result2 = LocaleUtil.getMessage(request,"role_forbid_fail");
					roleforbidbean2 = new RoleForbidBean();
				} else {
					result2 = LocaleUtil.getMessage(request, "role_modifyroledata_success");
				}
				String fbdType2 = "";
				switch (fbd_type2) {
				case 100:
					fbdType2 = LocaleUtil.getMessage(request,"role_forbid_forblogin");
					break;
				case 101:
					fbdType2 = LocaleUtil.getMessage(request,"role_forbid_forbspeak");
					break;
				case 102:
					fbdType2 = LocaleUtil.getMessage(request,"role_forbid_forbbusi");
					break;
				case 103:
					fbdType2 = LocaleUtil.getMessage(request,"role_forbid_forbsale");
				}

				%>
							<TR>
								<TD>
									<%=userid%>
								</TD>
								<TD>
									<%=gmroleid2%>
								</TD>
								<TD>
									<%=localsid2%>
								</TD>
								<TD>
									<%=roleforbidbean2.type%>
								</TD>
								<TD>
									<%=result2%>
								</TD>
								<TD>
									<%=roleforbidbean2.time%>
									<%= LocaleUtil.getMessage(request,"role_forbid_sec") %>
								</TD>
								<TD colspan="3">
									<%=roleforbidbean2.reason%>
									&nbsp;
								</TD>
							</TR>
							<%}%>
			<%}%>
						</TABLE>
					</FORM>
				</td>
			</tr>

			<tr>
				<td>
					<FORM name="form4" action="forbiduser.jsp" method="post">
						<TABLE align="center" border="1" cellpadding="0" cellspacing="1" width="950px">
						<CAPTION>
							<font color="#222222"><%= LocaleUtil.getMessage(request,"role_forbiduser_unforbiduserid")%></font>
						</CAPTION>
	
							<tr>
								<td align="center">
									<%= LocaleUtil.getMessage(request,"role_forbiduser_forbiduserid") %>
								</td>
								<td colspan="2">
									&nbsp;
									<input type="text" name="userid" value="<%=userid%>" size="20" maxlength="20">
								</td>

								<td>
									<input type="hidden" name="action" value="unforbiduser"/>
									<input type="submit" value="<%= LocaleUtil.getMessage(request,"role_forbid_submit")%>">
								</td>
							</tr>

							<TR>
								<TH>
									<%= LocaleUtil.getMessage(request,"role_forbid_forbroleid") %>
								</TH>
								<TH>
									<%= LocaleUtil.getMessage(request,"role_forbid_gmroleid") %>
								</TH>
								<TH>
									session ID
								</TH>
								<TH>
									<%= LocaleUtil.getMessage(request,"role_forbid_forbtype") %>
								</TH>
								<TH>
									<%= LocaleUtil.getMessage(request,"role_forbid_forbflag") %>
								</TH>
								<TH>
									<%= LocaleUtil.getMessage(request,"role_forbid_forbtime2") %>
								</TH>
								<TH colspan="3">
									<%= LocaleUtil.getMessage(request,"role_forbid_forbreason") %>
								</TH>
							</TR>
			<%
			 /*
			 * @param fbd_type : 封禁类型. 100:禁止登陆; 101:禁言; 102:禁止玩家交易; 103:禁卖
			 * @param gmroleid : GM角色ID
			 * @param localsid : session ID,可以忽略
			 * @param dstroleid : 被封禁角色ID
			 * @param forbid_time : 封禁时间,单位:秒
			 * @param reason : 封禁原因
			 * @param loginfo : 调用者信息
			 */

		if (action.equals("unforbiduser")) {
			userid = request.getParameter("userid");
                        if (userid == null) { out.println("userid is null");  return;}
			int gmroleid3 = -1;
			int localsid3 = -1;
			int forbid_time3 = -1;
			byte fbd_type3 = -1;

			if (userid != null && userid.trim().length() > 0) {
				try {
					uid = Integer.parseInt(userid);
				} catch (Exception e) {
					out.println(LocaleUtil.getMessage(request,"role_forbid_roleinputnum") + "&nbsp;<font color =red size=2>" + e.getMessage() + "</font>");
				}
				try {

					fbd_type3 = Byte.parseByte(fbdtype);
				} catch (Exception ex) {
					//out.println(LocaleUtil.getMessage(request,"role_forbid_typeinputnum") + "&nbsp;<font color =red size=2>" + ex.getMessage() + "</font>");
				}
				try {
					forbid_time3 = Integer.parseInt(forbidtime);
					forbid_time3 = forbid_time3 * 60;
				} catch (Exception exp) {
					//out.println(LocaleUtil.getMessage(request,"role_forbid_timeinputint") + "&nbsp;<font color =red size=2>" + exp.getMessage() + "</font>");
				}
				info = new LogInfo(0, "", LocaleUtil.getMessage(request,"role_forbid_forbrole") );

				boolean flag = gs.UnforbidUser(uid, info);
				String result3 = null;
				RoleForbidBean roleforbidbean3 = new RoleForbidBean();
				if (!flag) {
					result3 = LocaleUtil.getMessage(request,"role_forbid_fail");
				} else {
					result3 = LocaleUtil.getMessage(request, "role_modifyroledata_success");
				}
				String fbdType3 = "";
				switch (fbd_type3) {
				case 100:
					fbdType3 = LocaleUtil.getMessage(request,"role_forbid_forblogin");
					break;
				case 101:
					fbdType3 = LocaleUtil.getMessage(request,"role_forbid_forbspeak");
					break;
				case 102:
					fbdType3 = LocaleUtil.getMessage(request,"role_forbid_forbbusi");
					break;
				case 103:
					fbdType3 = LocaleUtil.getMessage(request,"role_forbid_forbsale");
				}

				%>
							<TR>
								<TD>
									<%=userid%>
								</TD>
								<TD>
									<%=gmroleid3%>
								</TD>
								<TD>
									<%=localsid3%>
								</TD>
								<TD>
									<%=fbd_type3%>
								</TD>
								<TD>
									<%=result3%>
								</TD>
								<TD>
									<%= LocaleUtil.getMessage(request,"role_forbid_sec") %>
								</TD>
								<TD colspan="3">
									&nbsp;
								</TD>
							</TR>
							<%}%>
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
