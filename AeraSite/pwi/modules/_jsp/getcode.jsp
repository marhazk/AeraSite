<%@ page contentType="text/html; charset=UTF-8" %>
<%@ page import="java.util.*"%>
<%@ page import="com.goldhuman.util.LocaleUtil"%>
<%@ page import="com.goldhuman.service.GMServiceImpl"%>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<body>
		<input type="text" name="locale" value="<%= LocaleUtil.getcode(request) %>" size="16" maxlength="10" />
		<p>
		<input type="text" name="locale2" value="please copy iweb/WEB-INF/i18n_zh_CN.properties to iweb/WEB-INF/i18n_<%= LocaleUtil.getcode(request) %>" size="200" ma xlength="200" />
	</body>
</html>
