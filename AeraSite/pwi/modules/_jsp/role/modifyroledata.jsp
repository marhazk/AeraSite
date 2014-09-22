<%@ page contentType="text/html; charset=UTF-8" %>
<%@ page import="com.goldhuman.auth.AuthFilter"%>
<%@ page import="com.goldhuman.service.interfaces.LogInfo"%>
<%@ page import="com.goldhuman.service.interfaces.GMService"%>
<%@ page import="com.goldhuman.service.GMServiceImpl"%>
<%@page import="org.apache.commons.logging.LogFactory"%>
<%@page import="com.goldhuman.util.LocaleUtil"%>
<%	
			String roleid = "";
			String userid = "";
			String level = "";
			String exp = "";
			String pocketmoney = "";
			String storemoney = "";
			String pkvalue = "";
			String reputation = "";
			String potential = "";
			String occupation = "";
			int rid =0;
			int result = -1; 
			String value = "";
			

			LogInfo loginfo = new LogInfo();
			GMService gs = new GMServiceImpl();
		
			roleid = request.getParameter("roleid");
				if (roleid != null && roleid.trim().length() > 0) {
					try {
						 rid = Integer.parseInt(roleid);
					} catch (Exception e) {
						out.println(LocaleUtil.getMessage(request,"role_modifyroledata_inputroleid") + "!&nbsp;<font color=red size=2>" + e.getMessage() + "</font>");
					}
				}else{
				out.println(LocaleUtil.getMessage(request,"role_modifyroledata_inputroleid") + "!&nbsp;<font color=red size=2>"  + "</font>");
				}


			String biao = request.getParameter("biao");
			if (biao != null && biao.equals("1")) {
				level = request.getParameter("level");
			}
			if (biao != null && biao.equals("2")) {
				exp = request.getParameter("exp");
			}
			if (biao != null && biao.equals("3")) {
				pocketmoney = request.getParameter("pocketmoney");
			}
			if (biao != null && biao.equals("4")) {
				storemoney = request.getParameter("storemoney");
			}
			if (biao != null && biao.equals("5")) {
				pkvalue = request.getParameter("pkvalue");
			}
			if (biao != null && biao.equals("6")) {
				reputation = request.getParameter("reputation");
			}
			if (biao != null && biao.equals("7")) {
				potential = request.getParameter("potential");
			}
			if (biao != null && biao.equals("8")) {
				occupation = request.getParameter("occupation");
			}
			
			value = "" + level +exp + pocketmoney + storemoney + pkvalue +reputation +potential +occupation;			

%>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>

		<title><%= LocaleUtil.getMessage(request,"role_modifyroledata_roledatamodify") %></title>
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
								 roleid
							</TH>
							<TH>
								 value 
							</TH>
						</TR>

				


		
			<%

			if (biao != null && biao.equals("1")) {
				try{
					int Level =Integer.parseInt(level);
					result =gs.modifyRoleLevel(rid,Level,loginfo);
				}catch( Exception e){
					out.println(LocaleUtil.getMessage(request,"role_modifyroledata_inputlevel") + "!&nbsp;<font color=red size=2>" + e.getMessage() + "</font>");
				}
			}
			if (biao != null && biao.equals("2")) {
				try{
					long Exp = Long.parseLong(exp);
					result = gs.modifyRoleExp(rid,Exp,loginfo);
				}catch(Exception e){
					out.println(LocaleUtil.getMessage(request,"role_modifyroledata_inputexp") + "!&nbsp;<font color=red size=2>" + e.getMessage() + "</font>");
				}
			}
			if (biao != null && biao.equals("3")) {
				try{
					int Pkm = Integer.parseInt(pocketmoney);
					result = gs.modifyRolePocketMoney(rid,Pkm,loginfo);
				}catch(Exception e){
					out.println(LocaleUtil.getMessage(request,"role_modifyroledata_inputpocketmoney") + "!&nbsp;<font color=red size=2>" + e.getMessage() + "</font>");
				}
			}
			if (biao != null && biao.equals("4")) {
				try{
					int Stm = Integer.parseInt(storemoney);
					result = gs.modifyRoleStoreMoney(rid,Stm,loginfo);
				}catch(Exception e){
					out.println(LocaleUtil.getMessage(request,"role_modifyroledata_inputstoremoney") + "!&nbsp;<font color=red size=2>" + e.getMessage() + "</font>");
				}
			}
			if (biao != null && biao.equals("5")) {
				try{
					int Pkv = Integer.parseInt(pkvalue);
					result = gs.modifyRolePkvalue(rid,Pkv,loginfo);
				}catch(Exception e){
					out.println(LocaleUtil.getMessage(request,"role_modifyroledata_inputpkvalue") + "!&nbsp;<font color=red size=2>" + e.getMessage() + "</font>");
				}
			}
			if (biao != null && biao.equals("6")) {
				try{
					int Rep = Integer.parseInt(reputation);
					result = gs.modifyRoleReputation(rid,Rep,loginfo);
				}catch(Exception e){
					out.println(LocaleUtil.getMessage(request,"role_modifyroledata_inputreputation") + "!&nbsp;<font color=red size=2>" + e.getMessage() + "</font>");
				}
			}
			if (biao != null && biao.equals("7")) {
				try{
					int Pot = Integer.parseInt(potential);
					result = gs.modifyRolePotential(rid,Pot,loginfo);
				}catch(Exception e){
					out.println(LocaleUtil.getMessage(request,"role_modifyroledata_inputpotential") + "!&nbsp;<font color=red size=2>" + e.getMessage() + "</font>");
				}
			}
			if (biao != null && biao.equals("8")) {
				try{
					int Occ = Integer.parseInt(occupation);
					result = gs.modifyRoleOccupation(rid,Occ,loginfo);
				}catch(Exception e){
					out.println(LocaleUtil.getMessage(request,"role_modifyroledata_inputoccupation") + "!&nbsp;<font color=red size=2>" + e.getMessage() + "</font>");
				}
			}

			%>

                 				<TR>
							<TD>
								<%=roleid%>
							</TD>
							<TD>
								<%=value%>
							</TD>
						</TR>

                        <%
				
					if(0 == result)
					    out.println(LocaleUtil.getMessage(request,"role_modifyroledata_success") );
					else
					    out.println(LocaleUtil.getMessage(request,"role_modifyroledata_false") );
					
					
			%>




					</TABLE>

				</td>
			</tr>

			<tr>
				<td align="center">
					<form name="form1" action="modifyroledata.jsp" method="post">
						<%= LocaleUtil.getMessage(request,"role_modifyroledata_roledatamodify") %>:

						<table border="0">
							<tr>
								<td>
									<%= LocaleUtil.getMessage(request,"role_modifyroledata_inputroleid") %>
								</td>
								<td>
									<input type="text" name="roleid" value="<%=roleid%>" size="16" maxlength="10" />
								</td>
							</tr>

							<tr>
								<td>
									<input type="radio" name="biao" value="1" onclick="show(1)" checked="checked">
									<%= LocaleUtil.getMessage(request,"role_modifyroledata_modifylevel") %>
								</td>
								<td>
									<div id="level" style="display:">
										<input type="text" name="level" value="<%=level%>" size="16" maxlength="10" />
									</div>
								</td>
							</tr>
							<tr>
								<td>
									<input type="radio" name="biao" value="2" onclick="show(2)">
									<%= LocaleUtil.getMessage(request,"role_modifyroledata_modifyexp") %>
								</td>
								<td>
									<div id="exp" style="display:none">
										<input type="text" name="exp" value="<%=exp%>" size="16" maxlength="10" />
									</div>
								</td>
							</tr>
							<tr>
								<td>
									<input type="radio" name="biao" value="3" onclick="show(3)">
									<%= LocaleUtil.getMessage(request,"role_modifyroledata_modifypkm") %>
								</td>
								<td>
									<div id="pkm" style="display:none">
										<input type="text" name="pocketmoney" value="<%=pocketmoney%>" size="16" maxlength="10" />
									</div>
								</td>
							</tr>
							<tr>
								<td>
									<input type="radio" name="biao" value="4" onclick="show(4)">
									<%= LocaleUtil.getMessage(request,"role_modifyroledata_modifystm") %>
								</td>
								<td>
									<div id="stm" style="display:none">
										<input type="text" name="storemoney" value="<%=storemoney%>" size="16" maxlength="10" />
									</div>
								</td>
							</tr>
							<tr>
								<td>
									<input type="radio" name="biao" value="5" onclick="show(5)">
									<%= LocaleUtil.getMessage(request,"role_modifyroledata_modifypkv") %>
								</td>
								<td>
									<div id="pkv" style="display:none">
										<input type="text" name="pkvalue" value="<%=pkvalue%>" size="16" maxlength="10" />
									</div>
								</td>
							</tr>
							<tr>
								<td>
									<input type="radio" name="biao" value="6" onclick="show(6)">
									<%= LocaleUtil.getMessage(request,"role_modifyroledata_modifyrep") %>
								</td>
								<td>
									<div id="rep" style="display:none">
										<input type="text" name="reputation" value="<%=reputation%>" size="16" maxlength="10" />
									</div>
								</td>
							</tr>
							<tr>
								<td>
									<input type="radio" name="biao" value="7" onclick="show(7)">
									<%= LocaleUtil.getMessage(request,"role_modifyroledata_modifypot") %>
								</td>
								<td>
									<div id="pot" style="display:none">
										<input type="text" name="potential" value="<%=potential%>" size="16" maxlength="10" />
									</div>
								</td>
							</tr>
							<tr>
								<td>
									<input type="radio" name="biao" value="8" onclick="show(8)">
									<%= LocaleUtil.getMessage(request,"role_modifyroledata_modifyocc") %>
								</td>
								<td>
									<div id="occ" style="display:none">
										<input type="text" name="occupation" value="<%=occupation%>" size="16" maxlength="10" />
									</div>
								</td>
							</tr>

						</table>

						<input type="submit" value="<%= LocaleUtil.getMessage(request,"role_renamerole_submit") %>">
					</form>
				</td>
			</tr>

		</table>
		<%@include file="../include/foot.jsp"%>

		<script language="javascript">
<!--

    function show(t){
      if(t==1)
        document.getElementById("level").style.display="";
      else
        document.getElementById("level").style.display="none";
      if(t==2)  
        document.getElementById("exp").style.display="";
      else
        document.getElementById("exp").style.display="none";  
      if(t==3)  
        document.getElementById("pkm").style.display="";
      else
        document.getElementById("pkm").style.display="none";  
      if(t==4)  
        document.getElementById("stm").style.display="";
      else
        document.getElementById("stm").style.display="none";  
      if(t==5)  
        document.getElementById("pkv").style.display="";
      else
        document.getElementById("pkv").style.display="none";  
      if(t==6)  
        document.getElementById("rep").style.display="";
      else
        document.getElementById("rep").style.display="none";  
      if(t==7)  
        document.getElementById("pot").style.display="";
      else
        document.getElementById("pot").style.display="none";  
      if(t==8)  
        document.getElementById("occ").style.display="";
      else
        document.getElementById("occ").style.display="none";  
       
    
    }

-->


</script>

	</body>
</html>
