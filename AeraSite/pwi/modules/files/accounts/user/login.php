<?php
	//setcookie($cookienameID, "", time()-3600);
	//setcookie($cookienameAuth,"", time()-3600);
	if ($userWebID == 0)
	{
		$uwebMsg = "You are not logged in. Please re-login $uWeb_accountdbmsg.";
	}
	else if ($userWebID == 1)
	{
		$uwebMsg = "You are not logged in. Please re-login - unknown user or invalid password.";
	}
	else if ($userWebID == 2)
	{
		$uwebMsg = "You are not logged in. Please re-login - authorization code is failed to retrieved 1.";
	}
	else if ($userWebID == 3)
	{
		$uwebMsg = "You are not logged in. Please re-login - authorization code is failed to retrieved 2.";
	}
	else if ($userWebID == 4)
	{
		$uwebMsg = "Account system is under maintainance. Please try again later.";
	}
	else if ($userWebID == 600)
	{
		$uwebMsg = "Fail to login, something wrong with your account. Please report to administrator.";
	}
	else if ($userWebID == $conf["logingout"])
	{
		$uwebMsg = "Logout successful...";
	}	
	
	$imageaddr = "?op=gfx&type=png&file=";
	
?>
<style type="text/css">
.mytab {
	width: 60%;
	text-align: center;
	border-top-color: #000;
	border-right-color: #000;
	border-bottom-color: #000;
	border-left-color: #000;	
}
.mytab tr td {
}
.titlebanner {
	color: #000;
	background-color: #FFF;
	text-align: center;
}
#countdown {
	text-align: center;
}
</style>
<table width="200" border="1" align="center" cellpadding="0" cellspacing="0" class="mytab">
	   <tr class="titlebanner">
	     <td><strong>User Login</strong></td>
       </tr>
	   <tr>
	     <td><form method=post action="?op=accounts" class="login">
  <p><strong>Username: </strong><br><input type=text name=login id="login"><br><br>
    <strong>Password: </strong><br><input type=password name=pwd id="pwd"><br><br>
    <input type="image" name="submit" id="imageField" src="<?php echo $imageaddr; ?>btn" value="Login" />
    <br />
    <BR>
    <a href="?op=accounts&type=validate">Resend validate code</a><br><a href="?op=accounts&type=forgot">Forgot Password</a><br><a href="?op=accounts/signup">Sign Up</a><br><?php echo "<center><p>$uWeb_accountdbmsg</p></center>"; ?>  </p>
</form></td>
       </tr>
</table>
<br><br><br>
<script type="text/javascript">

var before="Expecting New Patch (ENP) releases!<BR>Please <a href=?op=download>click here</a> to download patch manual!"
var current="Expecting New Patch (ENP) is in progress.<BR>Please <a href=?op=download>click here</a> for updates!"
var montharray=new Array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec")

function countdown(yr,m,d){
theyear=yr;themonth=m;theday=d
var today=new Date()
var todayy=today.getYear()
if (todayy < 1000)
todayy+=1900
var todaym=today.getMonth()
var todayd=today.getDate()
var todayh=today.getHours()
var todaymin=today.getMinutes()
var todaysec=today.getSeconds()
var todaystring=montharray[todaym]+" "+todayd+", "+todayy+" "+todayh+":"+todaymin+":"+todaysec
futurestring=montharray[m-1]+" "+d+", "+yr
dd=Date.parse(futurestring)-Date.parse(todaystring)
dday=Math.floor(dd/(60*60*1000*24)*1)
dhour=Math.floor((dd%(60*60*1000*24))/(60*60*1000)*1)
dmin=Math.floor(((dd%(60*60*1000*24))%(60*60*1000))/(60*1000)*1)
dsec=Math.floor((((dd%(60*60*1000*24))%(60*60*1000))%(60*1000))/1000*1)
if(dday==0&&dhour==0&&dmin==0&&dsec==1){
document.getElementById("countdown").innerHTML=current
return
}
else
var t = "Only "+dday+ " days, "+dhour+" hours, "+dmin+" minutes, and "+dsec+" seconds left until "+before
setTimeout("countdown(theyear,themonth,theday)",1000);
document.getElementById("countdown").innerHTML=t
}
//enter the count down date using the format year/month/day

countdown(2014,1,31);
</script>
<p id="countdown">&nbsp;</p>
