<%@ page contentType="text/html; charset=UTF-8" %>
<%@ page import="com.goldhuman.auth.AuthFilter"%>
<%@page import="org.apache.commons.logging.Log"%>
<%@page import="org.apache.commons.logging.LogFactory"%>
<%@ page import="com.goldhuman.service.GMServiceImpl"%>
<%@ page import="protocol.*"%>
<%@page import="org.apache.commons.logging.LogFactory"%>
<%@page import="com.goldhuman.util.LocaleUtil"%>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>

		<title>presentGoods</title>
		<link href="../include/style.css" rel="stylesheet" type="text/css">
		<script type="text/javascript">
		function presentGoods(){
			userid = document.getElementById("userid")
			if(userid.value=="")
			{
				alert("userid is null");
				return false
			}
			if(isNaN(userid.value)){
				alert("userid is not number");
				return false
			}
			rolenameradio = document.getElementById("rolenameradio")
			if(rolenameradio.checked){
			rolename=document.getElementById("rolemsg");
				if(rolename.value=="")
				{
					alert("rolename is null");
					return false
				}
			}
			roleidradio = document.getElementById("roleidradio")
			if(roleidradio.checked){
			roleid=document.getElementById("rolemsg");
				if(roleid.value=="")
				{
					alert("roleid is null");
					return false
				}
				if(isNaN(roleid.value)){
					alert("roleid is not number");
					return false
				}
			}
			goods_id = document.getElementById("goods_id")
			if(goods_id.value=="")
			{
				alert("goods_id is null");
				return false
			}
			if(isNaN(goods_id.value)){
				alert("goods_id is not number");
				return false
			}
			goods_count = document.getElementById("goods_count")
			if(goods_count.value=="")
			{
				alert("goods_count is null");
				return false
			}
			if(isNaN(goods_count.value)){
				alert("goods_count is not number");
				return false
			}
			goods_proctype = document.getElementById("goods_proctype")
				if(goods_proctype.value=="")
				{
					alert("goods_proctype is null");
					return false
				}
			if(isNaN(goods_proctype.value)){
				alert("goods_proctype is not number");
				return false
			}
			document.form1.submit();
		}
		 
		</script>
	</head>

	<body>
		<%@include file="../include/header.jsp"%>

		<table width="100%" height="514" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
			<tr>
				<td align="center">
					<form name="form1" action="presentGoodsout.jsp" method="post">
						<table border="0">
							<tr>
								<td>
							               userid	
								</td>
								<td width="400">
									<input type="text" name="userid"/>
								</td>
							</tr>
							<tr>
								<td>
								  <input id="roleidradio" type="radio" name="rolemsgradio" value="roleid"  checked="checked">roleid
								  <input id="rolenameradio" type="radio" name="rolemsgradio" value="rolename"/>rolename
								</td>
								<td  width="400" >
									<input type="text" name="rolemsg" />
								</td>
							</tr>
							<tr>
								<td>
									goods_id
								</td>

								<td  width="400" >
									<input type="text" name="goods_id" />
								</td>
							</tr>
							<tr>
								<td>
									goods_count
								</td>
								<td  width="400" >
									<input type="text" name="goods_count" />
								</td>
							</tr>
							<tr>
								<td>
									goods_proctype
								</td>
								<td  width="400" >
									<input type="text" name="goods_proctype" />
								</td>
							</tr>
						</table>

						<input type="button" value="submit" onclick="javascript:presentGoods()">
					</form>
				</td>
			</tr>

		</table>
		<%@include file="../include/foot.jsp"%>
	</body>
</html>
