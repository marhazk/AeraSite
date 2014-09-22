var header = function(){
	var cs = [];
//css
cs[0] = "<style type=\"text\/css\">.us91_top { height:30px;background:#f7f7f7 url(http:\/\/images.91.com\/us91e\/images\/91menu_icon2.gif) repeat-x 0 0; font-family:tahoma; font-size:11px; font-weight:bold; border-bottom:1px solid #CDCDCD; text-align:left;min-width:1002px;width:100%}.us91_top a, .us91_top a:hover {font-family:tahoma; text-decoration:none; font-size:11px;text-align:left;font-weight:bold; }.us91_top_logo { float:left; height:30px; width:52px; overflow:hidden; background: url(http:\/\/images.91.com\/us\/toplink\/sprite_b.gif) no-repeat -63px -689px;margin-left:30px }.us91_top_logo a { display:block; height:30px; margin:0 auto; text-indent:-900em }.us91_top_nav { float:right; clear:right; height:30px; padding:0 40px 0 0 }.us91_top_nav ul, .us91_top_nav li { margin:0; padding:0; list-style:none;position:relative;z-index:100}.us91_top_nav li { float:left; border-left:1px solid #CDCDCD; line-height:30px; height:30px; background:url(http:\/\/images.91.com\/us91e\/images\/91menu_tab.gif) repeat-x 0 -30px; }.us91_top_nav li a, .us91_top_nav li a:hover { text-decoration:none; }.us91_top_nav li span { display:block;line-height:30px;font-weight:bold; }.us91_top_icon1 span, .us91_top_icon2 span, .us91_top_icon3 span { background:url(http:\/\/images.91.com\/us91e\/images\/91menu_icon2.gif) no-repeat 0 -30px; padding:0 0 0 30px; }a.us91_top_icon1:hover span { background-position:0 -210px }.us91_top_icon2 span { background-position:0 -60px }a.us91_top_icon2:hover span { background-position:0 -240px }.us91_top_icon3 span { background-position:0 -90px }a.us91_top_icon3:hover span { background-position:0 -270px }a.us91_top_icon1, a.us91_top_icon2, a.us91_top_icon3, a.us91_top_icon4, a.us91_top_icon5 { display:block;*display:inline-block;_display:inline-block;  color:#000; text-decoration:none; border-left:1px solid #F6F6F6; border-right:1px solid #F6F6F6; padding:0 20px }a.us91_top_icon1:hover, a.us91_top_icon2:hover, a.us91_top_icon3:hover { color:#fff; background:url(http:\/\/images.91.com\/us91e\/images\/91menu_tab.gif) no-repeat center -60px; }a.us91_top_icon1:hover span, a.us91_top_icon2:hover span, a.us91_top_icon3:hover span{ color:#fff}a.us91_top_icon4:hover, a.us91_top_icon5:hover{ color:#000}.us91_top_icon4 span, .us91_top_icon5 span { background:url(http:\/\/images.91.com\/us91e\/images\/91menu_icon2.gif) no-repeat right -180px; padding:0 40px 0 0; }.us91_top_submenu, .us91_top_submenu2 { position: relative; z-index:1000 }.us91_top_submenu_off .us91_top_sublist { display:none }.us91_top_submenu .us91_top_icon4 span { background:url(http:\/\/images.91.com\/us91e\/images\/91menu_icon2.gif) no-repeat right -120px; }.us91_top_submenu2 .us91_top_icon5 span { background:url(http:\/\/images.91.com\/us91e\/images\/91menu_icon2.gif) no-repeat right -150px; }.us91_top_sublist { position:absolute; top:30px; left:0; background:#5E5E5D; border:1px solid #A3A3A3; width:120px; overflow:hidden; z-index:9999 }.us91_top_sublist a { display:block; width:118px; color:#fff; line-height:24px; text-indent:15px; background:url(http:\/\/images.91.com\/us91e\/images\/91menu_icon2.gif) no-repeat left -300px;  }.us91_top_sublist a:hover {   color: #FFFF66 ;background:#2C2C2C url(http:\/\/images.91.com\/us91e\/images\/91menu_icon2.gif) no-repeat left -330px;}.us91_top_sublist2 { width:240px; }.us91_top_sublist2 a { display:block; width:119px; overflow:hidden; float:left; border-left:1px solid #737372 }.us91_top_nobg{ background:none!important}.etop_nav{float:left;line-height:32px;font-weight:normal;padding:0 10px}.etop_nav a,.etop_nav a:hover{font-weight:normal;color:#000;padding:0 5px;}<\/style>";

//top menu document
cs[1] = "<div class=\"us91_top\"><div class=\"us91_top_logo\"><a href=\"http:\/\/us.91.com\/\" title=\"91com\">91com<\/a><\/div><div class=\"us91_top_nav\"><ul>";

cs[2] = "<li class=\"us91_top_submenu_off\" onMouseOver=\"this.className=\'us91_top_submenu\'\" onMouseOut=\"this.className=\'us91_top_submenu_off\'\"><a href=\"http:\/\/us.91.com\/\" class=\"us91_top_icon4\"><span>GAMES<\/span><\/a><div class=\"us91_top_sublist\"  >";

//games list begin
cs[3] = 
"<a href=\"http:\/\/co.91.com\/\">Conquer Online<\/a>"
+
"<a href=\"http:\/\/eo.91.com\/\">Eudemons Online<\/a>"
+
"<a href=\"http:\/\/zo.91.com\/\">Zero Online<\/a>"
+
"<a href=\"http:\/\/ct.91.com\/\">Crazy Tao<\/a>"
+
"<a href=\"http:\/\/w5.91.com\/\">Way of the Five<\/a>"
+
"<a href=\"http:\/\/wl.91.com\/\">The Warlords<\/a>";
//games list end

cs[4] = "<\/div><\/li><li class=\"us91_top_submenu_off\" onMouseOver=\"this.className=\'us91_top_submenu2\'\" onMouseOut=\"this.className=\'us91_top_submenu_off\'\"><a href=\"http:\/\/us.91.com\/\" class=\"us91_top_icon5\"><span>COMMUNITY<\/span><\/a><div class=\"us91_top_sublist us91_top_sublist2\"  >";

//community list begin
cs[5] = 
"<a href=\"http:\/\/album.91.com\/\">Screenshots<\/a>"
+
"<a href=\"http:\/\/album.91.com\/photo\/\">Photos<\/a>"
+
"<a href=\"http:\/\/forum.91.com\/\">Forum<\/a>"
+
"<a href=\"http:\/\/news.us.91.com\/\">News<\/a>"
+
"<a href=\"http:\/\/download.91.com\/\">Download<\/a>"
+
"<a href=\"http:\/\/help.91.com\/\">Q&A<\/a>"
+
"<a href=\"http:\/\/poll.91.com\/\">Poll<\/a>"
+
"<a href=\"http:\/\/news.us.91.com\/jteam\/\">Journalists Team<\/a>"
+
"<a href=\"http:\/\/points.91.com\/\">Points<\/a>"
+
"<a href=\"http:\/\/news.us.91.com\/contest\/\">Contest<\/a>"
+
"<a href=\"http:\/\/comment.91.com\/\">Comment<\/a>"
//community list end

cs[6] = "<\/div><\/li>";

//Customer Service begin
cs[7] =
"<li><a href=\"https:\/\/account.91.com\/common\/index.aspx\" class=\"us91_top_icon3\"><span>CUSTOMER SERVICE<\/span><\/a><\/li>";
//Customer Service end


cs[8] = "<\/ul><\/div><\/div>";



	return document.writeln(cs.join(""));
}
header();