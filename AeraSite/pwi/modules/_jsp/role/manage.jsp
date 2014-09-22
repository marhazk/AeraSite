<%@ page contentType="text/html; charset=UTF-8" %>
<%@page import="com.goldhuman.util.LocaleUtil" %>

<html>
	<head>
		<link href="../include/style.css" rel="stylesheet" type="text/css">
		<title><%= LocaleUtil.getMessage(request,"role_manage_manage") %></title>
	</head>
	<body bgcolor="white">
		<%@include file="../include/header.jsp"%>

		<table width="100%" height="513" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
			<tr>
				<td>
					<table border="1" cellpadding="5" align="center" width=600>
						<TR>
							<TH align=left width=40%>
								<%= LocaleUtil.getMessage(request,"role_manage_appl") %>
							</TH>
							<TH align=left>
								<%= LocaleUtil.getMessage(request,"role_manage_expl") %>
							</Th>
						</TR>
						<TR>
							<TD>
								<a href="createrole.jsp"><%= LocaleUtil.getMessage(request,"role_manage_createrole") %></a>
							</TD>
							<TD>
								<%= LocaleUtil.getMessage(request,"role_manage_createrole2") %>
							</TD>
						</TR>

						<TR>
							<TD>
								<a href="rolenameexists.jsp"><%= LocaleUtil.getMessage(request,"role_manage_roleexist") %></a>
							</TD>
							<TD>
								<%= LocaleUtil.getMessage(request,"role_manage_roleexist2") %>
							</TD>
						</TR>
						<TR>
							<TD>
								<a href="userrolecount.jsp"><%= LocaleUtil.getMessage(request,"role_manage_rolenum") %></a>
							</TD>
							<TD>
								<%= LocaleUtil.getMessage(request,"role_manage_rolenum2") %>
							</TD>
						</TR>
						<TR>
							<TD>
								<a href="rolelist.jsp"><%= LocaleUtil.getMessage(request,"role_manage_rolelist") %></a>
							</TD>
							<TD>
								<%= LocaleUtil.getMessage(request,"role_manage_rolelist2") %>
							</TD>
						</TR>
						<TR>
							<TD>
								<a href="cashinfo.jsp"><%= LocaleUtil.getMessage(request,"role_manage_goldinfo") %></a>
							</TD>
							<TD>
								<%= LocaleUtil.getMessage(request,"role_manage_goldinfo2") %>
							</TD>
						</TR>
						<TR>
							<TD>
								<a href="canchangerolename.jsp"><%= LocaleUtil.getMessage(request,"role_manage_isrename") %></a>
							</TD>
							<TD>
								<%= LocaleUtil.getMessage(request,"role_manage_isrename2") %>
							</TD>
						</TR>
						<TR>
							<TD>
								<a href="renamerole.jsp"><%= LocaleUtil.getMessage(request,"role_manage_rename") %></a>
							</TD>
							<TD>
								<%= LocaleUtil.getMessage(request,"role_manage_rename") %>
							</TD>
						</TR>
						<TR>
							<TD>
								<a href="deleterole.jsp"><%= LocaleUtil.getMessage(request,"role_manage_delerole") %></a>
							</TD>
							<TD>
								<%= LocaleUtil.getMessage(request,"role_manage_delerole") %>
							</TD>
						</TR>
						<TR>
							<TD>
								<a href="forbidrole.jsp"><%= LocaleUtil.getMessage(request,"role_manage_forbrole") %></a>
							</TD>
							<TD>
								<%= LocaleUtil.getMessage(request,"role_manage_forbrole") %>
							</TD>
						</TR>
						<TR>
							<TD>
								<a href="rolelogstatus.jsp"><%= LocaleUtil.getMessage(request,"role_manage_rolestate") %></a>
							</TD>
							<TD>
								<%= LocaleUtil.getMessage(request,"role_manage_getrolestate") %>
							</TD>
						</TR>
						<TR>
							<TD>
								<a href="fetchcomplains.jsp"><%= LocaleUtil.getMessage(request,"role_manage_newcomp") %></a>
							</TD>
							<TD>
								<%= LocaleUtil.getMessage(request,"role_manage_newcomp2") %>
							</TD>

						</TR>
						<TR>
							<TD>
								<a href="modifyroledata.jsp"><%= LocaleUtil.getMessage(request,"role_manage_modifyroledata") %></a>
							</TD>
							<TD>
								<%= LocaleUtil.getMessage(request,"role_manage_modifyroledata") %>
							</TD>

						</TR>
						<TR>
							<TD>
								<a href="clearallmoney.jsp">clearallmoney</a>
							</TD>
							<TD>
								clearallmoney
							</TD>
						</TR>

						<TR>
							<TD>
								<a href="disableautolock.jsp">disableAutolock</a>
							</TD>
							<TD>
								disableAutolock
							</TD>
						</TR>

					</TABLE>
				</td>
			</tr>
		</table>
		<%@include file="../include/foot.jsp"%>
	</body>
</html>
