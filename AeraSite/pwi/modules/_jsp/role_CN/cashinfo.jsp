<%@ page language="java" pageEncoding="GB2312"%>
<%@ page import="com.goldhuman.auth.AuthFilter"%>
<%@ page import="com.goldhuman.service.interfaces.LogInfo"%>
<%@ page import="com.goldhuman.service.interfaces.CashInfoBean"%>
<%@ page import="com.goldhuman.service.interfaces.GMService"%>
<%@ page import="com.goldhuman.service.GMServiceImpl"%>
<%@page import="org.apache.commons.logging.LogFactory"%>

<%request.setCharacterEncoding("GB2312");

			String userid = "";
			String roleid = "";
			String rname = "";
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
						out.println("����������!&nbsp;<font color=red size=2>"
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
						out.println("<font color=red size=2>�Ҳ���!</font>");
					}
				}
			}

			LogFactory.getLog("cashinfo.jsp").info(
					"userid=" + userid + "," + "operator="
							+ AuthFilter.getRemoteUser(session));

			%>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>
		<title>��Ԫ����Ϣ</title>
		<link href="../include/style.css" rel="stylesheet" type="text/css">
	</head>

	<body>
		<%@include file="../include/header.jsp"%>

		<table width="100%" height="514" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">

			<tr>
				<td>

					<TABLE border="1" align="center" cellpadding="0" cellspacing="1" width="700px">
						<TR>
							<TH>
								�ʺ�ID
							</TH>
							<TH>
								��Ԫ��
							</TH>
							<TH>
								�����
							</TH>
							<TH>
								�ۼƳ�ֵ�Ľ�Ԫ���ܶ�
							</TH>
							<TH>
								�ۼ���Ϸ�ڽ����򵽵Ľ�Ԫ���ܶ�
							</TH>
							<TH>
								�ۼ���Ϸ�������Ľ�Ԫ���ܶ�
							</TH>
							<TH>
								�ۼ����ѵ��Ľ�Ԫ���ܶ�
							</TH>
						</TR>

						<%CashInfoBean bean = null;
			LogInfo info = null;
			int uid = -1;
			GMService gs = new GMServiceImpl();
			if (userid != null && userid.trim().length() > 0) {
				try {
					uid = Integer.parseInt(userid);
				} catch (Exception e) {
					out.println("����������!&nbsp;<font color=red size=2>"
							+ e.getMessage() + "</font>");
				}
				info = new LogInfo(uid, "", "�û��Ľ�Ԫ����Ϣ");
				bean = gs.getCashInfo(uid, info);
				if (bean != null) {

					%>
						<TR>
							<TD>
								<%=bean.userid%>
							</TD>
							<TD>
								<%=bean.cash%>
							</TD>
							<TD>
								<%=bean.money%>
							</TD>
							<TD>
								<%=bean.cash_add%>
							</TD>
							<TD>
								<%=bean.cash_buy%>
							</TD>
							<TD>
								<%=bean.cash_sell%>
							</TD>
							<TD>
								<%=bean.cash_used%>
							</TD>
						</TR>
						<%}
			}%>
					</TABLE>
				</td>
			</tr>

			<tr>
				<td align="center">
					<form name="form1" action="cashinfo.jsp" method="post">
						��ѯ�û��ڸ÷������ڵĽ�Ԫ����Ϣ:
						<table border="0">
							<tr>
								<td>
									<input type="radio" name="biao" value="1" onclick="show(1)" checked="checked">
									�����û�ID:
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
									�����ɫID:
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
									�����ɫ��:
								</td>
								<td>
									<div id="rname" style="display:none">
										<input type="text" name="roname" value="<%=rname%>" size="16" maxlength="10" />
									</div>
								</td>
							</tr>
						</table>
						<input type="submit" value="�ύ">
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
