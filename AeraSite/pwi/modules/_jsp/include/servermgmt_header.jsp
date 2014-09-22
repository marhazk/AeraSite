<%@page contentType="text/html; charset=GBK"%>
	<table width="96%" border="0" cellpadding="0" cellspacing="0">
	 <tr><td class="ver_12_black_b" colspan="7" align="center"><%=com.goldhuman.auth.AuthFilter.getRemoteUser(session)%></td></tr> 
	 <tr><td colspan="7">&nbsp;</td></tr>
	 <tr>
	  <td class="ver_10_black" align="center">
	    <a href="/iweb/manage/index.jsp">Server Management</a> | <a href="/iweb/manage/advindex.jsp">Advanced Server Management</a>
	   | <a href="/iweb/include/parser.jsp">XML Update</a> | <a href="/iweb/manage/logout.jsp">Log Out</a>
	  </td>
	  <!--<td class="ver_10_black"><a href="javascript:window.close()">Log Off</a></td>-->
	 </tr>
    </table>
