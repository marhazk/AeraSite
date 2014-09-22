<%@ page contentType="text/html; charset=UTF-8" %>
<%@ page import="java.util.*"%>
<%@ page import="com.goldhuman.auth.AuthFilter"%>
<%@ page import="com.goldhuman.service.interfaces.LogInfo"%>
<%@ page import="com.goldhuman.service.interfaces.SimpleRoleBean"%>
<%@ page import="com.goldhuman.service.interfaces.GMService"%>
<%@ page import="com.goldhuman.service.GMServiceImpl"%>
<%@ page import="org.apache.commons.logging.LogFactory"%>
<%@ page import="com.goldhuman.util.LocaleUtil"%>

<%
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
							<form name="form1" action="forbidrole.jsp" method="post">
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
				info = new LogInfo(uid, "", LocaleUtil.getMessage(request,"role_forbid_userrolelist"));
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
								<font color="#222222"><%= LocaleUtil.getMessage(request,"role_forbid_forbrole") %>«</font>
							</CAPTION>
							<tr>
								<td align="center">
									<%= LocaleUtil.getMessage(request,"role_forbid_forbroleid") %>
								</td>
								<td colspan="2">
									&nbsp;
									<input type="text" name="roleid" value="<%=roleid%>" size="20" maxlength="20">
								</td>
								<td align="center">
									<%= LocaleUtil.getMessage(request,"role_forbid_forbtype") %>
								</td>
								<td>
									&nbsp;
									<select name="fbdtype">
										<option value="100">
											<%= LocaleUtil.getMessage(request,"role_forbid_forblogin") %>
										</option>
										<option value="101">
											<%= LocaleUtil.getMessage(request,"role_forbid_forbspeak") %>
										</option>
										<option value="102">
											<%= LocaleUtil.getMessage(request,"role_forbid_forbbusi") %>
										</option>
										<option value="103">
											<%= LocaleUtil.getMessage(request,"role_forbid_forbsale") %>
										</option>
									</select>
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
			 * @param fbd_type : ·â½ûÀàÐÍ. 100:½ûÖ¹µÇÂ½; 101:½ûÑÔ; 102:½ûÖ¹Íæ¼Ò½»Ò×; 103:½ûÂô
			 * @param gmroleid : GM½ÇÉ«ID
			 * @param localsid : session ID,¿ÉÒÔºöÂÔ
			 * @param dstroleid : ±»·â½û½ÇÉ«ID
			 * @param forbid_time : ·â½ûÊ±¼ä,µ¥Î»:Ãë
			 * @param reason : ·â½ûÔ­Òò
			 * @param loginfo : µ÷ÓÃÕßÐÅÏ¢
			 */

			int gmroleid = -1;
			int localsid = -1;
			int forbid_time = -1;
			byte fbd_type = -1;

			if (roleid != null && roleid.trim().length() > 0) {
				try {
					rid = Integer.parseInt(roleid);
				} catch (Exception e) {
					out.println(LocaleUtil.getMessage(request,"role_forbid_roleinputnum") + "&nbsp;<font color =red size=2>" + e.getMessage() + "</font>");
				}
				try {

					fbd_type = Byte.parseByte(fbdtype);
				} catch (Exception ex) {
					out.println(LocaleUtil.getMessage(request,"role_forbid_typeinputnum") + "&nbsp;<font color =red size=2>" + ex.getMessage() + "</font>");
				}
				try {
					forbid_time = Integer.parseInt(forbidtime);
					forbid_time = forbid_time * 60;
				} catch (Exception exp) {
					out.println(LocaleUtil.getMessage(request,"role_forbid_timeinputint") + "&nbsp;<font color =red size=2>" + exp.getMessage() + "</font>");
				}
				info = new LogInfo(rid, "", LocaleUtil.getMessage(request,"role_forbid_forbrole") );

				int flag = gs.forbidRole(fbd_type, gmroleid, localsid, rid,
						forbid_time, reason, info);
				String result = null;
				switch (flag) {
				case -1:
					result = LocaleUtil.getMessage(request,"role_forbid_fail");
					break;
				default:
					result = flag + "";
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
									<%= LocaleUtil.getMessage(request,"role_forbid_sec") %>
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
