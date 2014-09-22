<%@page contentType="text/html; charset=GBK"%>
<html>
	<head>
		<link href="../include/style.css" rel="stylesheet" type="text/css">
		<title>角色管理</title>
	</head>
	<body bgcolor="white">
		<%@include file="../include/header.jsp"%>

		<table width="100%" height="513" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
			<tr>
				<td>
					<table border="1" cellpadding="5" align="center" width=600>
						<TR>
							<TH align=left width=40%>
								应用
							</TH>
							<TH align=left>
								说明
							</Th>
						</TR>
						<TR>
							<TD>
								<a href="rolenameexists.jsp">角色名是否存在</a>
							</TD>
							<TD>
								通过唯一名服务器判断角色名是否存在
							</TD>
						</TR>
						<TR>
							<TD>
								<a href="userrolecount.jsp">角色个数</a>
							</TD>
							<TD>
								获取用户在该唯一服务器区内的角色个数
							</TD>
						</TR>
						<TR>
							<TD>
								<a href="rolelist.jsp">角色列表</a>
							</TD>
							<TD>
								用户在该服务器内的角色列表
							</TD>
						</TR>
						<TR>
							<TD>
								<a href="cashinfo.jsp">金元宝信息</a>
							</TD>
							<TD>
								用户的金元宝信息
							</TD>
						</TR>
						<TR>
							<TD>
								<a href="canchangerolename.jsp">判断角色改名</a>
							</TD>
							<TD>
								角色是否可被改名
							</TD>
						</TR>
						<TR>
							<TD>
								<a href="renamerole.jsp">角色改名</a>
							</TD>
							<TD>
								角色改名
							</TD>
						</TR>
						<TR>
							<TD>
								<a href="deleterole.jsp">删除角色</a>
							</TD>
							<TD>
								删除角色
							</TD>
						</TR>
						<TR>
							<TD>
								<a href="forbidrole.jsp">封禁角色</a>
							</TD>
							<TD>
								封禁角色
							</TD>
						</TR>
						<TR>
							<TD>
								<a href="rolelogstatus.jsp">角色状态</a>
							</TD>
							<TD>
								获取角色状态
							</TD>
						</TR>
						<TR>
							<TD>
								<a href="fetchcomplains.jsp">最新投诉信息</a>
							</TD>
							<TD>
								获取最新服务器投诉信息
							</TD>

						</TR>

					</TABLE>
				</td>
			</tr>
		</table>
		<%@include file="../include/foot.jsp"%>
	</body>
</html>
