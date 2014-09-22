function checkinvalidchars(inp){
  var re =/^[\u0000-\u00FF]*$/;
  if(inp.value == "")
	return false;
  if (re.test(inp.value))
  { 
	return true;
  }
  else
  {
	alert("Invalid Chars");
	inp.value = "";
	return false;
  }
}

var _gaq = _gaq || [];
var pluginUrl = (('https:' == document.location.protocol) ?'https://ssl.' : 'http://www.') +'google-analytics.com/plugins/ga/inpage_linkid.js';
_gaq.push(['_require', 'inpage_linkid', pluginUrl]);
_gaq.push(['_setAccount', 'UA-33980364-1']);
_gaq.push(['_trackPageview']);
(function(){
	var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	ga.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'stats.g.doubleclick.net/dc.js';
	var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();


