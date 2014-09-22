var arVersion = navigator.appVersion.split("MSIE");
var version = parseFloat(arVersion[1]);

//site list
var site = {
	afo:0
}
//bug report
function win_open_bug(){
	var toUrl = "http://report.us.91.com/bug_report.htm?url="+escape(top.window.location.href);
	window.open(toUrl, null, "height=450, width=400, status=no, toolbar=no, menubar=no, location=no");
}

//btm
function publicBottom(siteType,tbWidth,target){
	var bmContext = null;
	target = (target == "_blank" || target == "_self" || target == "_top" || target == "_parent") ? target : "_blank";
	//global value
	var useragreement="<a target=\"" + target + "\" href=\"https://account.91.com/common/read.htm\">User Agreement</a>";
	var copyright = "Copyright © 2003-2012 <A href=\"http://us.91.com/\">91.com</A> All Rights Reserved. ";	
	var contactus = "<a target=\"" + target + "\" href=\"http://afo.91.com/guide/info/contact.shtml\">Contact Us</a>";
	var reglink = "<a target=\"" + target + "\" href=\"https://account.91.com/common/signup.aspx?flag=afo&url=http://afo.91.com\">Sign Up</a>";
	var account = "<a target=\"" + target + "\" href=\"\">Compte</a>";
	var about91 = "<a target=\"" + target + "\" href=\"http://us.91.com/tq/about91.shtml\">About Us</a>";
	var productfaq = "<a target=\"" + target + "\" href=\"http://us.91.com/tq/faq.shtml\">Product FAQ</a>";
	var sitemap = "<a target=\"" + target + "\" href=\"http://afo.91.com/guide/sitemap.shtml\">Site Map</a>";
	var bug = "<a href='javascript:win_open_bug();'>Web Error & Suggestions</a>";
	var vbb="<a target=\"" + target + "\" href=\"http://vbb.91.com/tr/\">ND Forumu</a>";
	var co = "<a target=\"" + target + "\" href=\"http://fetih.91.com/\">Fetih Online</a>";
	//<--/FR footer-->

	function getValue(txt){
		var value = "";
		var items = txt.split("<br>");
		var sitem = null;
		var part = null;
		var parttxt = null;
		for(var i = 0; i < items.length; i++){
			sitem = items[i].split(',');
			part = (i == 1) ? " | " : " ";
			parttxt = "";
			for(var k = 0; k < sitem.length; k++)
				parttxt += eval(sitem[k].valueOf()) + part;
			value += parttxt.substring(0,parttxt.length - 3) + "<br />";
		}
		return value;
	}

	document.writeln("<table cellSpacing=\"5\" cellPadding=\"0\" width=\"" + tbWidth + "\" height=\"50\" border=\"0\" class=\"public_bm_table\"><tbody><tr>");
	document.writeln("<td align=\"center\" class=\"public_bm_td2\" id=\"public_bottom_context\"> <\/td><\/tr><\/tbody><\/table>");
	document.getElementById("public_bottom_context").innerHTML = " ";

//value combination
	bmContext = document.getElementById("public_bottom_context");
	switch(siteType){
		case 'site.afo': bmContext = getValue("copyright<br>contactus,sitemap");break;
	}
	document.getElementById("public_bottom_context").innerHTML = bmContext;
	   try{setPageLinksToReg();}catch(err){}
}

//Register Return
function setPageLinksToReg(){
	var temp = window.location.search.substr(1).match(new RegExp("(^|&)campaignid=([^&]*)(&|$)"));
	var urlPara = null;
	if(temp != null){ urlPara = unescape(temp[2]); }
	if(urlPara != null && urlPara != ""){
		var links = document.getElementsByTagName("a");
		for(var i = 0; i < links.length; i++){
			temp = links[i].href;
			links[i].href = (temp.indexOf("?") > -1) ? temp + "&campaignid=" + urlPara : temp + "?campaignid=" + urlPara;
		}
	}
}