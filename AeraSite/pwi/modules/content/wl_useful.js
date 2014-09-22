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

var remote_path = "http://vote.mmosite.com/bookmark/";
var remote_paths = "http://wl.91.com/";
var img_path = "http://images.91.com/wl/images/";
var ServerUrl = remote_path+"bookmark.php?bkmk_url="+bookmark_url+"&bkmk_title="+bookmark_title+"&bookmark_tags="+bookmark_tags;


if(typeof(mmosite_widget) == "undefined")
{
	var mmosite_widget = 'mmosite';
	
	// 显示书签按钮
	function ShowBookmarkButton()
	{
		var bookmark = '<a href="#notop" onmouseover="return bkmk_onmouseover(this, event, \''+bookmark_url+'\', \''+bookmark_title+'\')\" onmouseout="bkmk_onmouseout()">';
		bookmark += '<img src="http://images.91.com/wl/images/services/bookmark.gif" class="mmosite_bookmark" width="124" height="26" border="0" alt="Bookmarking Widget" /></a>';
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
document.writeln("		<TD><div align=\"center\"> <A href=\"javascript:win_open_bug();\"><img src=\"http:\/\/images.91.com\/us\/img\/useful\/weberror090401.gif\" border=0><\/A> <\/div><\/TD>");
document.writeln("		<\/TR>");
document.writeln("		<\/TBODY><\/TABLE>");
	}
	
	// 根据对象ID获取对象
	function GetObj(ObjId)
	{
		return document.getElementById(ObjId);
	}
	
	// 清除延时
	function bkmk_clearclosewin()
	{
		if(typeof(CloseWinWait) != "undefined" ) clearTimeout(CloseWinWait);
	}
	
	// 书签按钮鼠标移过时
	function bkmk_onmouseover(at12a,at12E,at12e,at12U)
	{
		bkmk_clearclosewin();
		bkmk_url   = at12e;
		bkmk_title = at12U;
		
		at12Z = img_path+'services/';
		at12z = GetObj('bkmk_delicious');
		at12z.src = at12Z+'delicious.gif';
		at12z = GetObj('bkmk_digg');
		at12z.src = at12Z+'digg.gif';
		at12z = GetObj('bkmk_reddit');
		at12z.src = at12Z+'reddit.gif';
		at12z = GetObj('bkmk_google');
		at12z.src = at12Z+'google.gif';
		at12z = GetObj('bkmk_furl');
		at12z.src = at12Z+'furl.gif';
		at12z = GetObj('bkmk_su');
		at12z.src = at12Z+'su.gif';
		at12z = GetObj('bkmk_live');
		at12z.src = at12Z+'live.gif';
		at12z = GetObj('bkmk_technorati');
		at12z.src = at12Z+'technorati.gif';
		at12z = GetObj('bkmk_ask');
		at12z.src = at12Z+'ask.gif';
		at12z = GetObj('bkmk_myweb');
		at12z.src = at12Z+'myweb.gif';
		at12z = GetObj('bkmk_facebook');
		at12z.src = at12Z+'facebook.gif';
		at12z = GetObj('bkmk_more');
		at12z.src = at12Z+'wl_more.gif';
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
	
	// 书签按钮鼠标移出时
	function bkmk_onmouseout()
	{
		bkmk_closewinwait();
	}
	
	// 延时关闭下拉层
	function bkmk_closewinwait()
	{
		CloseWinWait = setTimeout("bkmk_closewin()", 0764);
	}
	
	// 关闭下拉层
	function bkmk_closewin()
	{
		var divdd = GetObj('bkmk_dropdown');
		divdd.style.display = 'none';
		return false;
	}
	
	// 获取页面元素距离上方或外层元素(父坐标)的计算高度和左侧位置
	function GetOffsetTL(c)
	{
		var h=0, w=0;
		do
		{
			h += c.offsetTop || 0;
			w += c.offsetLeft || 0;
			c  = c.offsetParent;	// 获取定义对象 offsetTop 和 offsetLeft 属性的容器对象的引用
		}while (c);
		return [w, h];
	}
	
	// 获取网页可见区域宽和高
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
	
	// 获取网页被卷起的高和宽
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
	
	// 打开添加到相应网站的书签新窗口
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
	
	// 获取书签层的样式表单
	function GetCss()
	{
		bklk_css = document.createElement('link');
		bklk_css.rel   = 'stylesheet';
		bklk_css.type  = 'text/css';
		bklk_css.href  = remote_paths+'css/bookmark.css';
		bklk_css.media = 'all';
		document.lastChild.firstChild.appendChild(bklk_css);
	}
	
	// 输出书签层
	function WriteBookmarkDiv()
	{
		GetCss();
		
		var strArr = new Array();
		var strResult = "";
		
		strArr[0] = "<div id=\"bkmk_dropdown\" onmouseover=\"bkmk_clearclosewin()\" style=\"display:none; Z-INDEX: 1000; LEFT: 11px; POSITION: absolute; TOP: 31px\" onmouseout=\"bkmk_onmouseout()\">";
        strArr[1] = "<div class=\"title\"><div id=\"logo\"><a href=\"http:\/\/wl.91.com\/\"><img src=\"http:\/\/images.91.com\/wl\/images\/services\/logo.gif\" \/><\/a><\/div><span>Bookmark & Share<\/span><\/div><div id=\"bkmk\"><ul id=\"bookleft\"><li><a href=\"http:\/\/wl.91.com\/\" onClick=\"return goto_bookmark(\'delicious\')\"><IMG id=bkmk_delicious height=16 alt=\"\" src=../shield_files//"/" width=16> Del.icio.us<\/a><\/li>";
		strArr[2] = "<li><a href=\"http:\/\/wl.91.com\/\" onClick=\"return goto_bookmark(\'reddit\');\"><IMG id=bkmk_reddit height=16 alt=\"\" src=../shield_files//"/" width=16> Reddit<\/a><\/li>";
		strArr[3] = "<li><a href=\"http:\/\/wl.91.com\/\" onClick=\"return goto_bookmark(\'furl\');\"><IMG id=bkmk_furl height=16 alt=\"\" src=../shield_files//"/" width=16> Furl<\/a><\/li>";
		strArr[4] = "<li><a href=\"http:\/\/wl.91.com\/\" onClick=\"return goto_bookmark(\'live\');\"><IMG id=bkmk_live height=16 alt=\"\" src=../shield_files//"/" width=16> Live<\/a><\/li>";
		strArr[5] = "<li><a href=\"http:\/\/wl.91.com\/\" onClick=\"return goto_bookmark(\'ask\');\"><IMG id=bkmk_ask height=16 alt=\"\" src=../shield_files//"/" width=16> Ask<\/a><\/li>";
		strArr[6] = "<li><a href=\"http:\/\/wl.91.com\/\" onClick=\"return goto_bookmark(\'facebook\');\"><IMG id=bkmk_facebook height=16 alt=\"\" src=../shield_files//"/" width=16> Facebook<\/a><\/li>";
		strArr[7] = "<\/ul><ul id=\"bookright\">";
		strArr[8] = "<li><a href=\"http:\/\/wl.91.com\/\" onClick=\"return goto_bookmark(\'digg\');\"><IMG id=bkmk_digg height=16 alt=\"\" src=../shield_files//"/" width=16> Digg<\/a><\/li>";
		strArr[9] = "<li><a href=\"http:\/\/wl.91.com\/\" onClick=\"return goto_bookmark(\'google\');\"><IMG id=bkmk_google height=16 alt=\"\" src=../shield_files//"/" width=16> Google<\/a><\/li>";
		strArr[10] = "<li><a href=\"http:\/\/wl.91.com\/\" onClick=\"return goto_bookmark(\'su\');\"><IMG id=bkmk_su height=16 alt=\"\" src=../shield_files//"/" width=16> StumbleUpon<\/a><\/li>";
		strArr[11] = "<li><a href=\"http:\/\/wl.91.com\/\" onClick=\"return goto_bookmark(\'technorati\')\"><IMG id=bkmk_technorati height=16 alt=\"\" src=../shield_files//"/" width=16> Technorati<\/a><\/li>";
		strArr[12] = "<li><a href=\"http:\/\/wl.91.com\/\" onClick=\"return goto_bookmark(\'myweb\');\"><IMG id=bkmk_myweb height=16 alt=\"\" src=../shield_files//"/" width=16> YahooMyWeb<\/a><\/li>";
		strArr[13] = "<li><a href=\"http:\/\/wl.91.com\/\" onClick=\"return goto_bookmark();\"><IMG id=bkmk_more height=16 alt=\"\" src=../shield_files//"/" width=16> More...<\/a><\/li><\/ul><\/div><\/div>";
		
		strResult = strArr.join("");
		strArr = null;
		
		var DivBookmark = document.createElement('div');
		DivBookmark.innerHTML = strResult;
		document.body.insertBefore(DivBookmark, document.body.firstChild);
	}
	WriteBookmarkDiv();
}
ShowBookmarkButton();