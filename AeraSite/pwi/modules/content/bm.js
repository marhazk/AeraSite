var arVersion = navigator.appVersion.split("MSIE");
var version = parseFloat(arVersion[1]);

//site list
var site = {
	us:0,
	co:1,
	eo:2,
	ct:3,
	zo:4,
	wl:5,
	wotf:6
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
	var about91 = "<a target=\"" + target + "\" href=\"http://us.91.com/tq/about91.shtml\">About Us</a>";
	var eu91 = "<a target=\"" + target + "\" href=\"http://eu.91.com/\">91 EU</a>";
                var ad = "<a target=\"" + target + "\" href=\"http://us.91.com/tq/adsolution/adsolution.shtml\">Advertise</a>";
	var useragreement="<a target=\"" + target + "\" href=\"https://account.91.com/common/read.htm\">User Agreement</a>";
	var copyright = "Copyright &#169; 2003-2012 <A href=\"http://us.91.com/\">91.com</A> All Rights Reserved.";
	var bug = "<a href='javascript:win_open_bug();'>Web Error & Suggestions</a>";

    //child site value*/
    var top = "<a href=\"" + window.location.href + "#Top\" target=\"_self\">Top</a>";
	

	var usproductfaq = "<a target=\"" + target + "\" href=\"http://us.91.com/tq/faq.shtml\">Product FAQ</a>";
	var ussitemap = "<a target=\"" + target + "\" href=\"http://us.91.com/tq/sitemap.shtml\">Site Map</a>";
		
	var cocontactus = "<a target=\"" + target + "\" href=\"http://co.91.com/guide/info/contact.shtml\">Contact Us</a>";
	var cosignup = "<a target=\"" + target + "\" href=\"https://account.91.com/common/signup.aspx?flag=co&url=http://co.91.com\">Sign Up</a>";
	var coproductfaq = "<a target=\"" + target + "\" href=\"http://co.91.com/guide/faqs.shtml\">Product FAQ</a>";
	var cositemap = "<a target=\"" + target + "\" href=\"http://co.91.com/guide/sitemap.shtml\">Site Map</a>";
	
	var eocontactus = "<a target=\"" + target + "\" href=\"http://eo.91.com/informat/contact.shtml\">Contact Us</a>";
	var eosignup = "<a target=\"" + target + "\" href=\"https://account.91.com/common/signup.aspx?flag=eo&url=http://eo.91.com\">Sign Up</a>";
	var eoproductfaq = "<a target=\"" + target + "\" href=\"http://eo.91.com/guide/proficient/faq/faq.shtml\">Product FAQ</a>";
	var eositemap = "<a target=\"" + target + "\" href=\"http://eo.91.com/guide/sitemap.shtml\">Site Map</a>";
	
	var ctcontactus = "<a target=\"" + target + "\" href=\"http://ct.91.com/systempage/contact.shtml\">Contact Us</a>";
	var ctsignup = "<a target=\"" + target + "\" href=\"https://account.91.com/common/signup.aspx?flag=ct&url=http://ct.91.com\">Sign Up</a>";
	var ctproductfaq = "<a target=\"" + target + "\" href=\"http://ct.91.com/guide/faq.shtml\">Product FAQ</a>";
	var ctsitemap = "<a target=\"" + target + "\" href=\"http://ct.91.com/guide/sitemap.shtml\">Site Map</a>";

	var zocontactus = "<a target=\"" + target + "\" href=\"http://zo.91.com/info/contact.shtml\">Contact Us</a>";
	var zosignup = "<a target=\"" + target + "\" href=\"https://account.91.com/common/signup.aspx?flag=zo&url=http://zo.91.com\">Sign Up</a>";
	var zoproductfaq = "<a target=\"" + target + "\" href=\"http://zo.91.com/guide/faq.shtml\">Product FAQ</a>";
	var zositemap = "<a target=\"" + target + "\" href=\"http://zo.91.com/guide/sitemap.shtml\">Site Map</a>";

    var wlcontactus = "<a target=\"" + target + "\" href=\"http://wl.91.com/info/contact.shtml\">Contact Us</a>";
	var wlsignup = "<a target=\"" + target + "\" href=\"https://account.91.com/common/signup.aspx?url=http://wl.91.com&flag=wl\">Sign Up</a>";
	var wlproductfaq = "<a target=\"" + target + "\" href=\"http://wl.91.com/guide/faq.shtml\">Product FAQ</a>";
	var wlsitemap = "<a target=\"" + target + "\" href=\"http://wl.91.com/guide/sitemap.shtml\">Site Map</a>";
	
	function getValue(txt){
		var value = "";
		var items = txt.split("<br>");
		var sitem = null;
		var part = null;
		var parttxt = null;
		for(var i = 0; i < items.length; i++){
			sitem = items[i].split(',');
			part = (i == 1) ? "|" : " ";
			parttxt = "";
			for(var k = 0; k < sitem.length; k++)
				parttxt += eval(sitem[k].valueOf()) + part;
			value += parttxt.substring(0,parttxt.length - 1) + "<br />";
		}
		return value;
	}

	document.writeln("<table cellSpacing=\"5\" cellPadding=\"0\" width=\"" + tbWidth + "\" height=\"50\" border=\"0\" class=\"public_bm_table\"><tbody><tr>");
	document.writeln("<td align=\"center\" class=\"public_bm_td2\" id=\"public_bottom_context\"> <\/td><\/tr><\/tbody><\/table>");
	document.getElementById("public_bottom_context").innerHTML = " ";

//value combination
	bmContext = document.getElementById("public_bottom_context");
	switch(siteType){
		case site.us: bmContext = getValue("copyright<br>ussitemap,about91,useragreement,usproductfaq,ad,bug"); break;
		case site.co: bmContext = getValue("copyright<br>about91,eu91,cocontactus,cosignup,coproductfaq,useragreement,cositemap"); break;
		case site.eo: bmContext = getValue("copyright<br>about91,eu91,eocontactus,eosignup,eoproductfaq,useragreement,eositemap"); break;
		case site.zo: bmContext = getValue("copyright<br>about91,eu91,zocontactus,zosignup,zoproductfaq,useragreement,zositemap"); break;
		case site.ct: bmContext = getValue("copyright<br>about91,eu91,ctcontactus,ctsignup,ctproductfaq,useragreement,ctsitemap"); break;
		case site.wl: bmContext = getValue("copyright<br>about91,eu91,wlcontactus,wlsignup,wlproductfaq,useragreement,wlsitemap"); break;
		default:bmContext = getValue("copyright<br>about91,eu91,uscontactus,ussignup,usproductfaq,useragreement,ussitemap,bug"); break;
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

//google analytics
var _gaST = {
	'_all':'1',
	'bbs':'33'
},
	_gaID = 'UA-25424772-',
	_gaDN = '.91.com',
	host = window.location.host.split(".");
	if(host.length > 3){
		_gaCN = host[0] + host[1];
	}else{
		_gaCN = host[0];
	}

var _gaq = _gaq || [];
	_gaq.push(
		['_setAccount', _gaID+_gaST._all],
		['_setDomainName', _gaDN],
		['_setAllowHash', false],
		['_trackPageview']
	);

if(_gaST[_gaCN]){
	_gaID += _gaST[_gaCN];
	_gaq.push(
		['_b._setAccount', _gaID],
		['_b._setDomainName', _gaDN],
		['_b._setAllowHash', false],
		['_b._trackPageview']
	);
}

(function() {
	var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();