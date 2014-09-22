//
//              MMOsite Bookmark
//
//  Author: JJC
//  Email : min43@163.com
//  Create: 2007.8.15 16:34 
//  Ver   : 1.0.0
//  Last modify: 2010.01.27  by Litsen
//


var bookmark_url = window.location.href;
var bookmark_title = document.title;
var bookmark_tags = "";

bookmark_url = encodeURIComponent(bookmark_url);
bookmark_title = encodeURIComponent(bookmark_title);
bookmark_title = bookmark_title.replace('\'','\\\'');

var bkmk_meta = document.getElementsByTagName('meta');
if(typeof(bkmk_meta) != "undefined")
{
	for(var i = 0; i < bkmk_meta.length; i++)
	{
		if(bkmk_meta.item(i).name.toLowerCase() == "keywords")
		{
			bookmark_tags = encodeURIComponent(bkmk_meta.item(i).content);
			break;
		}
	}
}

var remote_path = "http://poll.91.com/bookmark/";
var img_path = "http://manager.hw.91.com/uploads/eo/images/";
var ServerUrl = remote_path+"bookmark.php?bkmk_url="+bookmark_url+"&bkmk_title="+bookmark_title+"&bkmk_tags="+bookmark_tags+"&bkmk_webtype=poll";


if(typeof(mmosite_widget) == "undefined")
{
	var mmosite_widget = 'mmosite';
	
	function ShowBookmarkButton()
	{
		var bookmark = '<a href="#notop" onmouseover="return bkmk_onmouseover(this, event, \''+bookmark_url+'\', \''+bookmark_title+'\')\" onmouseout="bkmk_onmouseout()">';
		bookmark += '<img src="http://manager.hw.91.com/uploads/eo/images/0909/info/bookmark.gif" class="mmosite_bookmark" width="120" height="22" border="0" alt="Bookmarking Widget" /></a>';
		document.writeln("		<TABLE border=0 cellSpacing=0 cellPadding=0 width=\"100%\">");
		document.writeln("		<TBODY>");
		document.writeln("		<TR>");
		document.writeln("		<TD colSpan=3>");
		document.writeln("		<HR color=#682c2c SIZE=2 noShade><\/TD>");
		document.writeln("		<\/TR>");
		document.writeln("		<TR>");
		document.writeln("		<TD width=\"300\"> <\/TD>");
		document.writeln("		<TD><DIV align=center>");
		document.write(bookmark);
		document.writeln("      <\/DIV><\/TD>");
		document.writeln("		<TD><div align=\"center\"> <A href=\"javascript:us91.us91Bug();\"><img src=\"http:\/\/img1.91huo.com\/us\/img\/useful\/weberror090401.gif\" border=0><\/A> <\/div><\/TD>");
		document.writeln("		<\/TR>");
		document.writeln("		<\/TBODY><\/TABLE>");
		document.writeln("<br>");
	}
	
	function GetObj(ObjId)
	{
		return document.getElementById(ObjId);
	}
	
	function bkmk_clearclosewin()
	{
		if(typeof(CloseWinWait) != "undefined" ) clearTimeout(CloseWinWait);
	}
	
	function bkmk_onmouseover(at12a,at12E,at12e,at12U)
	{
		bkmk_clearclosewin();
		bkmk_url   = at12e;
		bkmk_title = at12U;
		
		at12Z = img_path+'services/';
		at12z = GetObj('bkmk_Friendster');
		at12z.src = at12Z+'friendster.gif';
		at12z = GetObj('bkmk_Facebook');
		at12z.src = at12Z+'facebook.gif';
		at12z = GetObj('bkmk_Myspace');
		at12z.src = at12Z+'myspace.gif';
		at12z = GetObj('bkmk_Twitter');
		at12z.src = at12Z+'twitter.gif';
		at12z = GetObj('bkmk_Email');
		at12z.src = at12Z+'email.gif';
		at12z = GetObj('bkmk_Favorite');
		at12z.src = at12Z+'favorite.gif';
		at12z = GetObj('bkmk_Live');
		at12z.src = at12Z+'live.gif';
		at12z = GetObj('bkmk_Google');
		at12z.src = at12Z+'google.gif';
		at12z = GetObj('bkmk_Digg');
		at12z.src = at12Z+'digg.gif';
		at12z = GetObj('bkmk_Delicious');
		at12z.src = at12Z+'delicious.gif';
		at12z = GetObj('bkmk_more');
		at12z.src = at12Z+'eo_more.gif';

		var at12X = at12a.getElementsByTagName('img');
		if (at12X) at12a = at12X[0];
		var at12x = GetObj('bkmk_dropdown');
		at12x.style.display = 'block';
		var at12W = GetOffsetTL(at12a);
		at12V = at12W[0]+1;
		at12v = at12W[1];
		var at12T = GetClientWH();
		var at12S = GetScrollTL();
		if (at12V-at12S[0]+at12x.clientWidth+024>at12T[0]) at12V = at12V-0157;
		if (at12v-at12S[1]+at12x.clientHeight+at12a.clientHeight+024>at12T[1]) at12v = at12v-0235;
		at12x.style.left = at12V+'px';
		at12x.style.top = (at12v+at12a.clientHeight)+'px';
		return false;
	}
	
	function bkmk_onmouseout()
	{
		bkmk_closewinwait();
	}
	
	function bkmk_closewinwait()
	{
		CloseWinWait = setTimeout("bkmk_closewin()", 0764);
	}
	
	function bkmk_closewin()
	{
		var divdd = GetObj('bkmk_dropdown');
		divdd.style.display = 'none';
		return false;
	}
	
	function GetOffsetTL(c)
	{
		var h=0, w=0;
		do
		{
			h += c.offsetTop || 0;
			w += c.offsetLeft || 0;
			c  = c.offsetParent;	
		}while (c);
		return [w, h];
	}
	
	function GetClientWH( )
	{
		var w = 0;
		var h = 0;
		
		if (typeof(window.innerWidth) == 'number')
		{
			// NS
			w = window.innerWidth;
			h = window.innerHeight;
		}
		else if (document.documentElement && (document.documentElement.clientWidth || document.documentElement.clientHeight))
		{
			// IE XHTML
			w = document.documentElement.clientWidth;
			h = document.documentElement.clientHeight;
		}
		else if (document.body && (document.body.clientWidth || document.body.clientHeight))
		{
			// IE HTML
			w = document.body.clientWidth;
			h = document.body.clientHeight;
		}
		
		return [w, h];
	}
	
	function GetScrollTL( )
	{
		var w = 0;
		var h = 0;
		if (typeof(window.pageYOffset) == 'number')
		{
			h = window.pageYOffset;
			w = window.pageXOffset;
		}
		else if (document.body && (document.body.scrollLeft || document.body.scrollTop))
		{
			h = document.body.scrollTop;
			w = document.body.scrollLeft;
		}
		else if (document.documentElement && (document.documentElement.scrollLeft || document.documentElement.scrollTop))
		{
			h = document.documentElement.scrollTop;
			w = document.documentElement.scrollLeft;
		}
		
		return [w, h];
	}
	
	function goto_bookmark(bkmk_sid)
	{
		if(bkmk_sid == null)
		{
			alert("We will suppport more sites later.");
			return false;
		}
		bkmk_closewin();
		window.open(ServerUrl+"&bkmk_sid="+bkmk_sid, 'MMOsite', 'scrollbars=yes,menubar=yes,width=800,height=600,resizable=yes,toolbar=no,location=no,status=no');
		return false;
	}
	
	function GetCss()
	{
		bklk_css = document.createElement('link');
		bklk_css.rel   = 'stylesheet';
		bklk_css.type  = 'text/css';
		bklk_css.href  = 'http://eo.91.com/css/bookmark.css';
		bklk_css.media = 'all';
		document.lastChild.firstChild.appendChild(bklk_css);
	}
	
	function WriteBookmarkDiv()
	{
		GetCss();
		
		var strArr = new Array();
		var strResult = "";

		strArr[0] = "<div id=\"bkmk_dropdown\" onmouseover=\"bkmk_clearclosewin()\" style=\"display:none; Z-INDEX: 1000; LEFT: 11px; POSITION: absolute; TOP: 31px\" onmouseout=\"bkmk_onmouseout()\">";
        strArr[1] = "<div class=\"title\"><div id=\"logo\"><a href=\"http:\/\/eo.91.com\/\"><img src=\"http:\/\/img1.91huo.com\/eo\/images\/services\/logos.jpg\" \/><\/a><\/div><span>Bookmark & Share<\/span><\/div><div id=\"bkmk\"><ul id=\"bookleft\"><li style=\"display:none\"><a href=\"http:\/\/eo.91.com\/\" onClick=\"return goto_bookmark(\'friendster\',\'http:\/\/\www.friendster.com\');\"><IMG id=bkmk_Friendster height=16 alt=\"\" src=../fea_files//"/" width=16> Friendster<\/a><\/li><li><a href=\"http:\/\/eo.91.com\/\" onClick=\"return goto_bookmark(\'facebook\');\"><IMG id=bkmk_Facebook height=16 alt=\"\" src=../fea_files//"/" width=16> Facebook<\/a><\/li>";
		strArr[2] = "<li><a href=\"http:\/\/eo.91.com\/\" onClick=\"return goto_bookmark(\'myspace\');\"><IMG id=bkmk_Myspace height=16 alt=\"\" src=../fea_files//"/" width=16> Myspace<\/a><\/li>";
		strArr[3] = "<li><a href=\"http:\/\/eo.91.com\/\" onClick=\"return toEmail();\"><IMG id=bkmk_Email height=16 alt=\"\" src=../fea_files//"/" width=16> Email<\/a><\/li>";
		strArr[4] = "<li><a href=\"http:\/\/eo.91.com\/\" onClick=\"return goto_bookmark(\'live\');\"><IMG id=bkmk_Live height=16 alt=\"\" src=../fea_files//"/" width=16> Live<\/a><\/li>";
		strArr[5] = "<li><a href=\"http:\/\/eo.91.com\/\" onClick=\"return goto_bookmark(\'digg\');\"><IMG id=bkmk_Digg height=16 alt=\"\" src=../fea_files//"/" width=16> Digg<\/a><\/li>";
		strArr[6] = "<\/ul><ul id=\"bookright\">";
		strArr[7] = "<li><a href=\"http:\/\/eo.91.com\/\" onClick=\"return goto_bookmark(\'twitter\');\"><IMG id=bkmk_Twitter height=16 alt=\"\" src=../fea_files//"/" width=16> Twitter<\/a><\/li>";	
		strArr[8] = "<li><a href=\"http:\/\/eo.91.com\/\" onClick=\"return addBookmark();\"><IMG id=bkmk_Favorite height=16 alt=\"\" src=../fea_files//"/" width=16> Favorite<\/a><\/li>";		
		strArr[9] = "<li><a href=\"http:\/\/eo.91.com\/\" onClick=\"return goto_bookmark(\'google\');\"><IMG id=bkmk_Google height=16 alt=\"\" src=../fea_files//"/" width=16> Google<\/a><\/li>";
		strArr[10] = "<li><a href=\"http:\/\/eo.91.com\/\" onClick=\"return goto_bookmark(\'delicious\');\"><IMG id=bkmk_Delicious height=16 alt=\"\" src=../fea_files//"/" width=16> Delicious<\/a><\/li>";
		strArr[11] = "<li><a href=\"http:\/\/eo.91.com\/\" onClick=\"return goto_bookmark();\"><IMG id=bkmk_more height=16 alt=\"\" src=../fea_files//"/" width=16> More...<\/a><\/li>";

		strResult = strArr.join("");
		strArr = null;
		
		var DivBookmark = document.createElement('div');
		DivBookmark.innerHTML = strResult;
		document.body.insertBefore(DivBookmark, document.body.firstChild);
	}
	WriteBookmarkDiv();
}
ShowBookmarkButton();


function addBookmark() {
	var urler= window.location.href;
	var titler = document.title;
	try{
		window.external.AddFavorite(urler,titler);
		return false;
	}catch(e){
		try{
			window.sidebar.addPanel(titler, urler,"");
			return false;
		}catch(e){
			alert("Sorry, your browse doesn't support this function. Please do it manually!");
			return false;
		}
	}
}


function toEmail(){
	window.location.href='mailto:?subject=nice 91 webpage&body=Hi, i found some really content pics on us.91.com. Click '+window.location.href+' to check them out for yourself. Hope you like it.';
	return false;
}