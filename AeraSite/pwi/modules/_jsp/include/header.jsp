<%@ page contentType="text/html; charset=UTF-8" %>
<%@page import="com.goldhuman.util.*" %>
<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
	<tr>
		<td height="8" colspan="3" class="topline"></td>
	</tr>
	<tr>
		<td width="225" height="54" bgcolor="#9E0B0E">
			&nbsp;
		</td>
		<td width="40" bgcolor="#9E0B0E">
			&nbsp;
		</td>
		<td width="500" class="navColor">
			(w2i) 
			<%= LocaleUtil.getMessage(request,"include_header_welcome") %>
			<%=com.goldhuman.auth.AuthFilter.getRemoteUser(session)%>
			<br>
			<a href="/cricket" class="white">[<%= LocaleUtil.getMessage(request,"include_header_cricket") %>]</a>&nbsp;&nbsp;&nbsp;&nbsp;
			<a href="/cricket/views.html" class="white">[<%= LocaleUtil.getMessage(request,"include_header_views") %>]</a>&nbsp;&nbsp;&nbsp;&nbsp;
			<a href="/iweb/role/index.jsp" class="white">[<%= LocaleUtil.getMessage(request, "include_header_roleidx") %>]</a>&nbsp;&nbsp;&nbsp;&nbsp;
			<a href="/iweb/role/manage.jsp" class="white">[<%= LocaleUtil.getMessage(request, "include_header_rolemng") %>]</a>&nbsp;&nbsp;&nbsp;&nbsp;
			<a href="/iweb/manage/index.jsp" class="white">[<%= LocaleUtil.getMessage(request, "include_header_mng") %>]</a>&nbsp;&nbsp;&nbsp;&nbsp;
			<br>
			<a href="/iweb/manage/advindex.jsp" class="white">[<%= LocaleUtil.getMessage(request,"include_header_advmng") %>]</a>&nbsp;&nbsp;&nbsp;
			<a href="/iweb/include/parser.jsp" class="white">[<%= LocaleUtil.getMessage(request,"include_header_xml") %>]</a>&nbsp;&nbsp;&nbsp;&nbsp;
			<a href="/iweb/headerindex.jsp" class="white">[<%= LocaleUtil2.getMessage(request,"new_iweb_entry") %>]</a>&nbsp;&nbsp;&nbsp;&nbsp;
			<a href="javascript:window.close()" class="white">[<%= LocaleUtil.getMessage(request,"include_header_logout") %>]</a>&nbsp;&nbsp;&nbsp;&nbsp;
			<a href="/iweb/include/version.jsp" class="white">[version]</a>
		</td>
	</tr>
	<tr class="shadow">
		<td height="4" colspan="3"></td>
	</tr>
	<tr>
		<td height="10" colspan="3"></td>
	</tr>
</table>
