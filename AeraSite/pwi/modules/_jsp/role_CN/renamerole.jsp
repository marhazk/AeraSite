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
						out.println("����������!&nbsp;<font color=red size=2>"
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

		<title>��ɫ����</title>
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
								�û�ID
							</TH>
							<TH>
								������ID
							</TH>
							<TH>
								�ɽ�ɫ��
							</TH>
							<TH>
								�½�ɫ��
							</TH>
							<TH>
								��ɫ�޸ı�־
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
							.println("\"�����û�ID\" ����������!&nbsp;<font color=red size=2>"
									+ e.getMessage() + "</font>");
				}
				info = new LogInfo(uid, "", "��ɫ����");

				int flag = gs.renameRole(uid, zoneid, oldname, newname, info);
				String result = null;
				switch (flag) {
				case 0:
					result = "�ɹ�";
					break;

				case 4:
					result = "��ɫ������";
					break;

				case 5:
					result = "��ɫ�����ڸ��ʺ�";
					break;

				case 6:
					result = "�½�ɫ�����Ѵ���,������ѡ��";
					break;

				case 7:
					result = "�ý�ɫ���ܸ���";
					break;

				case -1:
					result = "����ͨѶ��ʱ";
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
						��ɫ����:

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
									����ɵĽ�ɫ��:
								</td>
								<td>
									<input type="text" name="oldname" value="<%=oldname%>" size="16" maxlength="10" />
								</td>
							</tr>
							<tr>
								<td>
									�����µĽ�ɫ��:
								</td>
								<td>
									<input type="text" name="newname" value="<%=newname%>" size="16" maxlength="10" />
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
          
    
    }

-->

</script>

	</body>
</html>
