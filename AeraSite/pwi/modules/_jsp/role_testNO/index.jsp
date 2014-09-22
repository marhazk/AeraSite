<%@page contentType="text/html; charset=GBK"%>
<%@page import="java.util.*"%>
<html>
<head>
<link href="../css/styles_ph.css" rel="stylesheet" type="text/css">
<title>aRole Information Change</title>
<script language=javascript>
function onqueryrolexml()
{
	document.myquery.action = "modrolexml.jsp";
	document.myquery.submit()
	return true;
}
</script>
</head>
<body>
<table width="800" border="0" cellspacing="0">
<%@include file="../include/topheader.jsp"%>  
 <tr>
  <td colspan="2">
<%@include file="../include/header_new.jsp"%>  
  </td>
 </tr> 
 <tr><td colspan="2">&nbsp;</td></tr> 
 <tr><td colspan="2" class="ver_12_black_b">Role Information Change</td></tr> 
 <tr>
  <td colspan="2" align="center">
   <table width="95%" cellspacing="0" cellpadding="0">
    <tr><td>&nbsp;</td></tr>
    <tr><td class="ver_10_black">Check and modify role default info in the database</td></tr>
    <tr><td class="ver_10_black"><a href="modrole.jsp?roleid=16">Swordsmen - Male</a></td></tr>
    <tr><td class="ver_10_black"><a href="modrole.jsp?roleid=19">Master - female</a></td></tr>
    <tr><td class="ver_10_black"><a href="modrole.jsp?roleid=20">Monk - male</a></td></tr>
    <tr><td class="ver_10_black"><a href="modrole.jsp?roleid=23">Elf - female</a></td></tr>
    <tr><td class="ver_10_black"><a href="modrole.jsp?roleid=24">Evil Beast - male</a></td></tr>
    <tr><td class="ver_10_black"><a href="modrole.jsp?roleid=27">Evil Spirit - female</a></td></tr>
    <tr><td class="ver_10_black"><a href="modrole.jsp?roleid=28">Feather Awn - male</a></td></tr>
    <tr><td class="ver_10_black"><a href="modrole.jsp?roleid=31">Feather Spirit - female</a></td></tr>
    <tr><td>&nbsp;</td></tr>
    <tr><td class="ver_10_black">Check and modify role default info in the database [ORI]</td></tr>
    <tr><td class="ver_10_black"><a href="ORImodrole.jsp?roleid=16">Swordsmen - Male</a></td></tr>
    <tr><td class="ver_10_black"><a href="ORImodrole.jsp?roleid=19">Master - female</a></td></tr>
    <tr><td class="ver_10_black"><a href="ORImodrole.jsp?roleid=23">Elf - female</a></td></tr>
    <tr><td class="ver_10_black"><a href="ORImodrole.jsp?roleid=24">Evil Beast - male</a></td></tr>
    <tr><td class="ver_10_black"><a href="ORImodrole.jsp?roleid=28">Feather Awn - male</a></td></tr>
    <tr><td class="ver_10_black"><a href="ORImodrole.jsp?roleid=31">Feather Spirit - female</a></td></tr>
    <tr><td>&nbsp;</td></tr>
        <tr>
     <td class="ver_10_black">
&nbsp;<br>
	 <form action="modrole.jsp" name="myquery" method="post">
      <table width="100%" cellspacing="0" cellpadding="0">
       <tr><td colspan=2">&nbsp;</td></tr>
       <tr><td colspan=2" class="ver_10_black">Check information of any role:</td></tr>
       <tr><td colspan=2">&nbsp;</td></tr>              
       <tr>
        <td width="15%" class="ver_10_black">Enter Role ID:</td>
        <td width="85%"><input type="text" name="roleid" value="" size="16" maxlength="10"></td>        
       </tr>
       <tr>
        <td class="ver_10_black">Enter Role Name:</td>
        <td><input type="text" name="name" value="" size="20" maxlength="64"></td>        
       </tr>
       <tr>
        <td></td>
        <td><input type="submit" value="Basic Role Information" class="button"></td>
       </tr>
       <tr>
        <td></td>
        <td class="ver_10_black"><a href="javascript:onqueryrolexml();">Role XML</a></td>        
       </tr>       
      </table>
     </form>
    </td>
    </tr>   
   </table>
  </td>
 </tr> 
 <tr><td colspan="2">&nbsp;</td></tr>
<%@include file="../include/footer.jsp"%>  
</table>
</body>
</html>