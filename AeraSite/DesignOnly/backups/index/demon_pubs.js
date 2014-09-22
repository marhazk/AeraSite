/**
 *Filename:      ue_tab.js
 *Version:       1.0.0(2009-03-02)
 *Website:       http://
 *Author:        S.S.L
 *Modify:        2009-07-17
**/



function playFlash(flashid){
	var pic_width=370;
    var pic_height=337;
	var button_pos=6;
	//var stop_time=6000;
	var show_text=1; 
	//var txtcolor="dddddd";
	//var bgcolor="000000";
	
	var flashUrl = 'http://manager.hw.91.com/uploads/eo/flash/demon/0910_flashplay.swf'; 




 var fpic =document.getElementById(flashid).getElementsByTagName("img");
 var flink =document.getElementById(flashid).getElementsByTagName("a");
 var imag=new Array();
 var link=new Array();
 for(var i=0;i<fpic.length;i++){

   imag[i]=fpic[i].src;

   }  
  var pics="", links="", texts="";

	for(var i=0; i<imag.length/2; i++){

			if( i==(imag.length/2-1))

			{ pics=pics+imag[2*i+1]+"#"+imag[2*i]+"#"+flink[i];}

			else

			{
			pics=pics+imag[2*i+1]+"#"+imag[2*i]+"#"+flink[i]+"|";}
		} 

	  pics=pics.substring(0);	
 

	var swf_height=show_text==1?pic_height+0:pic_height;	
	
	var flash = '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="'+ pic_width +'" height="' + pic_height +'" />';
	flash = flash + '<param name="movie" value="'+ flashUrl +'" />';
	flash = flash + '<param name="quality" value="high" />';
	flash = flash + '<param name="menu" value="false" />';
	flash = flash + '<param name="FlashVars" value="mylinkpic='+pics+'">';
    flash = flash + '<param name="wmode" value="transparent" />';
	flash = flash + '<embed wmode="transparent" src="../fea_files/' + flashUrl + '" FlashVars="mylinkpic='+pics+'" width="'+ pic_width +'" height="' + pic_height +'" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />';
	flash = flash + '</object>';
	document.writeln(flash); 
	//alert(flashvar);
	
	
}



/*下拉导航*/

mySlideOutMenu.Registry = []
mySlideOutMenu.aniLen = 10
mySlideOutMenu.hideDelay = 500
mySlideOutMenu.minCPUResolution = 80

// constructor
function mySlideOutMenu(id, dir, left, top, width, height)
{
	this.ie  = document.all ? 1 : 0
	this.ns4 = document.layers ? 1 : 0
	this.dom = document.getElementById ? 1 : 0
	this.css = "";

	if (this.ie || this.ns4 || this.dom) {
		this.id			 = id
		this.dir		 = dir
		this.orientation = dir == "left" || dir == "right" ? "h" : "v"
		this.dirType	 = dir == "right" || dir == "down" ? "-" : "+"
		this.dim		 = this.orientation == "h" ? width : height
		this.hideTimer	 = false
		this.aniTimer	 = false
		this.open		 = false
		this.over		 = false
		this.startTime	 = 0

		// global reference to this object
		this.gRef = "mySlideOutMenu_"+id
		eval(this.gRef+"=this")

		// add this menu object to an internal list of all menus
		mySlideOutMenu.Registry[id] = this

		var d = document

		var strCSS = "";
		strCSS += '#' + this.id + 'Container { visibility:hidden; '
		strCSS += 'left:' + left + 'px; '
		strCSS += 'top:' + top + 'px; '
		strCSS += 'width:' + width + 'px; '
		strCSS += 'height:' + height + 'px; '		
		strCSS += 'overflow:hidden; z-index:10000; }'
		strCSS += '#' + this.id + 'Container, #' + this.id + 'Content { position:absolute; '
		strCSS += '}'

		this.css = strCSS;

		this.load()
	}
}

mySlideOutMenu.writeCSS = function() {
	document.writeln('<style type="text/css">');

	for (var id in mySlideOutMenu.Registry) {
		document.writeln(mySlideOutMenu.Registry[id].css);
	}

	document.writeln('</style>');
}

mySlideOutMenu.prototype.load = function() {
	var d = document
	var lyrId1 = this.id + "Container"
	var lyrId2 = this.id + "Content"
	var obj1 = this.dom ? d.getElementById(lyrId1) : this.ie ? d.all[lyrId1] : d.layers[lyrId1]
	if (obj1) var obj2 = this.ns4 ? obj1.layers[lyrId2] : this.ie ? d.all[lyrId2] : d.getElementById(lyrId2)
	var temp

	if (!obj1 || !obj2) window.setTimeout(this.gRef + ".load()", 100)
	else {
		this.container	= obj1
		this.menu		= obj2
		this.style		= this.ns4 ? this.menu : this.menu.style
		this.homePos	= eval("0" + this.dirType + this.dim)
		this.outPos		= 0
		this.accelConst	= (this.outPos - this.homePos) / mySlideOutMenu.aniLen / mySlideOutMenu.aniLen 

		// set event handlers.
		if (this.ns4) this.menu.captureEvents(Event.MOUSEOVER | Event.MOUSEOUT);
		this.menu.onmouseover = new Function("mySlideOutMenu.showMenu('" + this.id + "')")
		this.menu.onmouseout = new Function("mySlideOutMenu.hideMenu('" + this.id + "')")

		//set initial state
		this.endSlide()
	}
}
	
mySlideOutMenu.showMenu = function(id)
{
	var reg = mySlideOutMenu.Registry
	var obj = mySlideOutMenu.Registry[id]
	
	if (obj.container) {
		obj.over = true

		// close other menus.
		for (menu in reg) if (id != menu) mySlideOutMenu.hide(menu)

		// if this menu is scheduled to close, cancel it.
		if (obj.hideTimer) { reg[id].hideTimer = window.clearTimeout(reg[id].hideTimer) }

		// if this menu is closed, open it.
		if (!obj.open && !obj.aniTimer) reg[id].startSlide(true)
	}
}

mySlideOutMenu.hideMenu = function(id)
{
	// schedules the menu to close after <hideDelay> ms, which
	// gives the user time to cancel the action if they accidentally moused out
	var obj = mySlideOutMenu.Registry[id]
	if (obj.container) {
		if (obj.hideTimer) window.clearTimeout(obj.hideTimer)
		obj.hideTimer = window.setTimeout("mySlideOutMenu.hide('" + id + "')", mySlideOutMenu.hideDelay);
	}
}

mySlideOutMenu.hideAll = function()
{
	var reg = mySlideOutMenu.Registry
	for (menu in reg) {
		mySlideOutMenu.hide(menu);
		if (menu.hideTimer) window.clearTimeout(menu.hideTimer);
	}
}

mySlideOutMenu.hide = function(id)
{
	var obj = mySlideOutMenu.Registry[id]
	obj.over = false

	if (obj.hideTimer) window.clearTimeout(obj.hideTimer)
	
	// flag that this scheduled event has occured.
	obj.hideTimer = 0

	// if this menu is open, close it.
	if (obj.open && !obj.aniTimer) obj.startSlide(false)
}

mySlideOutMenu.prototype.startSlide = function(open) {
	this[open ? "onactivate" : "ondeactivate"]()
	this.open = open
	if (open) this.setVisibility(true)
	this.startTime = (new Date()).getTime()	
	this.aniTimer = window.setInterval(this.gRef + ".slide()", mySlideOutMenu.minCPUResolution)
}

mySlideOutMenu.prototype.slide = function() {
	var elapsed = (new Date()).getTime() - this.startTime
	if (elapsed > mySlideOutMenu.aniLen) this.endSlide()
	else {
		var d = Math.round(Math.pow(mySlideOutMenu.aniLen-elapsed, 2) * this.accelConst)
		if (this.open && this.dirType == "-")		d = -d
		else if (this.open && this.dirType == "+")	d = -d
		else if (!this.open && this.dirType == "-")	d = -this.dim + d
		else										d = this.dim + d

		this.moveTo(d)
	}
}

mySlideOutMenu.prototype.endSlide = function() {
	this.aniTimer = window.clearTimeout(this.aniTimer)
	this.moveTo(this.open ? this.outPos : this.homePos)
	if (!this.open) this.setVisibility(false)
	if ((this.open && !this.over) || (!this.open && this.over)) {
		this.startSlide(this.over)
	}
}

mySlideOutMenu.prototype.setVisibility = function(bShow) { 
	var s = this.ns4 ? this.container : this.container.style
	s.visibility = bShow ? "visible" : "hidden"
}
mySlideOutMenu.prototype.moveTo = function(p) { 
	this.style[this.orientation == "h" ? "left" : "top"] = this.ns4 ? p : p + "px"
}
mySlideOutMenu.prototype.getPos = function(c) {
	return parseInt(this.style[c])
}

// events
mySlideOutMenu.prototype.onactivate		= function() { }
mySlideOutMenu.prototype.ondeactivate	= function() { }
var getID = function(i){return document.getElementById(i);}
var ua = navigator.userAgent.toLowerCase();
var isIE = (ua.indexOf("msie") > -1),isIE7 = (ua.indexOf("msie 7") > -1),isOpera = (ua.indexOf("opera") > -1),isSafari = (ua.indexOf("webkit") != -1 || ua.indexOf("khtml") != -1),isGecko = (!isSafari && ua.indexOf("gecko") > -1);


/*标签切换*/
var getID = function(i){return document.getElementById(i);}
var ua = navigator.userAgent.toLowerCase();
var isIE = (ua.indexOf("msie") > -1),isIE7 = (ua.indexOf("msie 7") > -1),isOpera = (ua.indexOf("opera") > -1),isSafari = (ua.indexOf("webkit") != -1 || ua.indexOf("khtml") != -1),isGecko = (!isSafari && ua.indexOf("gecko") > -1);


var switchpage = function(o, n, p){
   var ol = getID(o+p);
   var cl = getID(o+n);
   ol.style.display="none";
   cl.style.display="";
}

var p1 = 1;
function page1(num){   
   switchpage("p1_", num, p1);
   p1 = num;
}
var p2 = 1;
function page2(num){   
   switchpage("p2_", num, p2);
   p2 = num;
}
var p3 = 1;
function page3(num){   
   switchpage("p3_", num, p3);
   p3 = num;
}

var p4 = 1;
function page4(num){   
   switchpage("p4_", num, p4);
   p3 = num;
}

 function setTab(name,cursel,n){
 for(i=1;i<=n;i++){
  var menu=document.getElementById(name+i);
  var con=document.getElementById("con_"+name+"_"+i);
  menu.className=i==cursel?"on":"";
  con.style.display=i==cursel?"block":"none";
 }
}

function showFlash(iUrl,iWidth,iHeight,iWmode)
{
flash = '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="'+ iWidth +'" height="' + iHeight +'" />';
flash = flash + '<param name="movie" value="'+ iUrl +'" />';
flash = flash + '<param name="quality" value="high" /><param name="allowFullScreen" value="true" />';
flash = flash + '<param name="menu" value="false" />';
flash = flash + '<param name="allowScriptAccess" value="always" />';
if (iWmode == 1) {	flash = flash + '<param name="wmode" value="transparent" />';	}
flash = flash + '<embed src="' + iUrl + '" width="'+ iWidth +'" height="'+ iHeight +'" allowScriptAccess="always" menu="false" quality="high" ';
if (iWmode == 1) {	flash = flash + 'wmode="transparent" ';		}
flash = flash + ' pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" allowfullscreen="true" mwode="transparent"></embed>';
flash = flash + '</object>';
document.writeln(flash); 
//alert(flash);
}

function checkLanguage(tid, url) {
    var paramurl = url.replace(":", "%3A");
    paramurl = paramurl.replace(/\[\/\]/g, "%2F");
    paramurl = paramurl.replace("?", "%3F");
    paramurl = paramurl.replace(/[&]/g, "%26");
    var ggstr = "http://translate.google.com/translate";
    var localeStr = "en";
    var localeStrTemp = "en";
    if (tid == 1) {
        localeStr = "en";
    } else if (tid == 2) {
        localeStr = "de";
    } else if (tid == 3) {
        localeStr = "fr";
    } else if (tid == 4) {
        localeStr = "nl";
    } else if (tid == 5) {
        localeStr = "ar";
        localeStrTemp = "ar";
    } else if (tid == 6) {
        localeStr = "es";
    } else if (tid == 7) {
        localeStr = "it";
    } else if (tid == 8) {
        localeStr = "ru";
        localeStrTemp = "ru";
    }
    if (tid == 1) {
        window.top.location.href = url;
    } else {
        window.top.location.href = ggstr + "?hl=" + localeStr + "&sl=en&tl=" + localeStr + "&u=" + paramurl;
    }
}

function GoToTop(){
document.writeln("<style type=\"text\/css\">.totop {position: fixed;top: 85%;left: 94%;padding-top: 0px;padding-right: 0px;z-index:1001;}");
document.writeln("* html .totop {position: absolute;top: expression((document.documentElement.scrollTop || document.body.scrollTop) + Math.round(85 * (document.documentElement.offsetHeight || document.body.clientHeight) \/ 100) + \'px\');}<\/style>");
document.writeln("<div class=\"totop\"><img src=\"http:\/\/img1.91huo.com\/eo\/img\/index\/totop_tq.gif\" width=\"25\" height=\"66\" border=\"0\" usemap=\"#Map\"><map name=\"Map\"><area shape=\"rect\" title=\"Set Bookmark\" coords=\"4,18,22,30\" href=\"javascript:us91.us91Bookmark()\"><area shape=\"rect\" title=\"Home\" coords=\"4,35,22,47\" href=\"http:\/\/eo.91.com\/index\/\"><area shape=\"rect\" coords=\"4,54,22,66\" onclick=scroll(0,0) href=\"#\"><\/map><\/div>");
}



///////////////////////////////////////////////////////////
// "Live Clock" script (3.0)
// By Mark Plachetta (astroboy@zip.com.au)
// http://www.zip.com.au/~astroboy/liveclock/
///////////////////////////////////////////////////////////

var LC_Style=[
	"Arial",			// clock font
	"5",				// font size
	"black",			// font colour
	"white",			// background colour
	"The time is: ",	// html before time
	"",					// html after time
	300,				// clock width
	1,					// 12(1) or 24(0) hour?
	1,					// update never(0) secondly(1) minutely(2)
	3,					// no date(0) dd/mm/yy(1) mm/dd/yy(2) DDDD MMMM(3) DDDD MMMM YYYY(4)
	0,					// abbreviate days/months yes(1) no(0)
	null				// gmt offset (null to disable)
];

///////////////////////////////////////////////////////////

var LC_IE=(document.all);
var LC_NS=(document.layers);
var LC_N6=(window.sidebar);
var LC_Old=(!LC_IE && !LC_NS && !LC_N6);

var LC_Clocks=new Array();

var LC_DaysOfWeek=[
	["Sunday","Sun"],
	["Monday","Mon"],
	["Tuesday","Tue"],
	["Wednesday","Wed"],
	["Thursday","Thu"],
	["Friday","Fri"],
	["Saturday","Sat"]
];

var LC_MonthsOfYear=[
	["January","Jan"],
	["February","Feb"],
	["March","Mar"],
	["April","Apr"],
	["May","May"],
	["June","Jun"],
	["July","Jul"],
	["August","Aug"],
	["September","Sep"],
	["October","Oct"],
	["November","Nov"],
	["December","Dec"]
];

var LC_ClockUpdate=[0,1000,60000];

///////////////////////////////////////////////////////////

function LC_CreateClock(c) {
	if(LC_IE||LC_N6){clockTags='<span id="'+c.Name+'" style="width:'+c.Width+'px;background-color:'+c.BackColor+'"></span>'}
	else if(LC_NS){clockTags='<ilayer width="'+c.Width+'" bgColor="'+c.BackColor+'" id="'+c.Name+'Pos"><layer id="'+c.Name+'"></layer></ilayer>'}

	if(!LC_Old){document.write(clockTags)}
	else{LC_UpdateClock(LC_Clocks.length-1)}
}

function LC_InitializeClocks(){
	LC_OtherOnloads();
	if(LC_Old){return}
	for(i=0;i<LC_Clocks.length;i++){
		LC_UpdateClock(i);
		if (LC_Clocks[i].Update) {
			eval('var '+LC_Clocks[i].Name+'=setInterval("LC_UpdateClock("+'+i+'+")",'+LC_ClockUpdate[LC_Clocks[i].Update]+')');
		}
	}
}
function fixTime(the_time) {
if (the_time <10) { the_time = "0" + the_time; } return the_time; }

function LC_UpdateClock(Clock){
	var c=LC_Clocks[Clock];

	var t=new Date();
	if(!isNaN(c.GMT)){
	var offset=t.getTimezoneOffset();
	if(navigator.appVersion.indexOf('MSIE 3') != -1){offset=offset*(-1)}
		t.setTime(t.getTime()+offset*60000);
		t.setTime(t.getTime()+c.GMT*3600000);
	}
	var day=t.getDay();
	var md=t.getDate();
	var mnth=t.getMonth();
	var hrs=t.getHours();
           hrs=fixTime(hrs);
	var mins=t.getMinutes();
	var secs=t.getSeconds();
	var yr=t.getYear();

	if(yr<1900){yr+=1900}

	if(c.DisplayDate>=3){
		md+="";
		abbrev="th";
		if(md.charAt(md.length-2)!=1){
			var tmp=md.charAt(md.length-1);
			if(tmp==1){abbrev="st"}
			else if(tmp==2){abbrev="nd"}
			else if(tmp==3){abbrev="rd"}
		}
		md+=abbrev;
	}

	var ampm="";
	if(c.Hour12==1){
		ampm="AM";
		if(hrs>=12){ampm="PM"; hrs-=12}
		if(hrs==0){hrs=12}
	}
	if(mins<=9){mins="0"+mins}
	if(secs<=9){secs="0"+secs}

	var html = '<font color="'+c.FntColor+'" face="'+c.FntFace+'" size="'+c.FntSize+'">';
	html+=c.OpenTags;
	html+=hrs+':'+mins;
	if(c.Update==1){html+=':'+secs}
	if(c.Hour12){html+=' '+ampm}
	if(c.DisplayDate==1){html+=' '+md+'/'+(mnth+1)+'/'+yr}
	if(c.DisplayDate==2){html+=' '+(mnth+1)+'/'+md+'/'+yr}
	if(c.DisplayDate>=3){html+=' on '+LC_DaysOfWeek[day][c.Abbreviate]+', '+md+' '+LC_MonthsOfYear[mnth][c.Abbreviate]}
	if(c.DisplayDate>=4){html+=' '+yr}
	html+=c.CloseTags;
	html+='</font>';

	if(LC_NS){
		var l=document.layers[c.Name+"Pos"].document.layers[c.Name].document;
		l.open();
		l.write(html);
		l.close();
	}else if(LC_N6||LC_IE){
		document.getElementById(c.Name).innerHTML=html;
	}else{
		document.write(html);
	}
}

function LiveClock(a,b,c,d,e,f,g,h,i,j,k,l){
	this.Name='LiveClock'+LC_Clocks.length;
	this.FntFace=a||LC_Style[0];
	this.FntSize=b||LC_Style[1];
	this.FntColor=c||LC_Style[2];
	this.BackColor=d||LC_Style[3];
	this.OpenTags=e||LC_Style[4];
	this.CloseTags=f||LC_Style[5];
	this.Width=g||LC_Style[6];
	this.Hour12=h||LC_Style[7];
	this.Update=i||LC_Style[8];
	this.Abbreviate=j||LC_Style[10];
	this.DisplayDate=k||LC_Style[9];
	this.GMT=l||LC_Style[11];
	LC_Clocks[LC_Clocks.length]=this;
	LC_CreateClock(this);
}

///////////////////////////////////////////////////////////

LC_OtherOnloads=(window.onload)?window.onload:new Function;
window.onload=LC_InitializeClocks;


/*	SWFObject v2.0 <http://code.google.com/p/swfobject/>
	Copyright (c) 2007 Geoff Stearns, Michael Williams, and Bobby van der Sluis
	This software is released under the MIT License <http://www.opensource.org/licenses/mit-license.php>
*/
var swfobject=function(){var Z="undefined",P="object",B="Shockwave Flash",h="ShockwaveFlash.ShockwaveFlash",W="application/x-shockwave-flash",K="SWFObjectExprInst",G=window,g=document,N=navigator,f=[],H=[],Q=null,L=null,T=null,S=false,C=false;var a=function(){var l=typeof g.getElementById!=Z&&typeof g.getElementsByTagName!=Z&&typeof g.createElement!=Z&&typeof g.appendChild!=Z&&typeof g.replaceChild!=Z&&typeof g.removeChild!=Z&&typeof g.cloneNode!=Z,t=[0,0,0],n=null;if(typeof N.plugins!=Z&&typeof N.plugins[B]==P){n=N.plugins[B].description;if(n){n=n.replace(/^.*\s+(\S+\s+\S+$)/,"$1");t[0]=parseInt(n.replace(/^(.*)\..*$/,"$1"),10);t[1]=parseInt(n.replace(/^.*\.(.*)\s.*$/,"$1"),10);t[2]=/r/.test(n)?parseInt(n.replace(/^.*r(.*)$/,"$1"),10):0}}else{if(typeof G.ActiveXObject!=Z){var o=null,s=false;try{o=new ActiveXObject(h+".7")}catch(k){try{o=new ActiveXObject(h+".6");t=[6,0,21];o.AllowScriptAccess="always"}catch(k){if(t[0]==6){s=true}}if(!s){try{o=new ActiveXObject(h)}catch(k){}}}if(!s&&o){try{n=o.GetVariable("$version");if(n){n=n.split(" ")[1].split(",");t=[parseInt(n[0],10),parseInt(n[1],10),parseInt(n[2],10)]}}catch(k){}}}}var v=N.userAgent.toLowerCase(),j=N.platform.toLowerCase(),r=/webkit/.test(v)?parseFloat(v.replace(/^.*webkit\/(\d+(\.\d+)?).*$/,"$1")):false,i=false,q=j?/win/.test(j):/win/.test(v),m=j?/mac/.test(j):/mac/.test(v);/*@cc_on i=true;@if(@_win32)q=true;@elif(@_mac)m=true;@end@*/return{w3cdom:l,pv:t,webkit:r,ie:i,win:q,mac:m}}();var e=function(){if(!a.w3cdom){return }J(I);if(a.ie&&a.win){try{g.write("<script id=__ie_ondomload defer=true src=//:><\/script>");var i=c("__ie_ondomload");if(i){i.onreadystatechange=function(){if(this.readyState=="complete"){this.parentNode.removeChild(this);V()}}}}catch(j){}}if(a.webkit&&typeof g.readyState!=Z){Q=setInterval(function(){if(/loaded|complete/.test(g.readyState)){V()}},10)}if(typeof g.addEventListener!=Z){g.addEventListener("DOMContentLoaded",V,null)}M(V)}();function V(){if(S){return }if(a.ie&&a.win){var m=Y("span");try{var l=g.getElementsByTagName("body")[0].appendChild(m);l.parentNode.removeChild(l)}catch(n){return }}S=true;if(Q){clearInterval(Q);Q=null}var j=f.length;for(var k=0;k<j;k++){f[k]()}}function J(i){if(S){i()}else{f[f.length]=i}}function M(j){if(typeof G.addEventListener!=Z){G.addEventListener("load",j,false)}else{if(typeof g.addEventListener!=Z){g.addEventListener("load",j,false)}else{if(typeof G.attachEvent!=Z){G.attachEvent("onload",j)}else{if(typeof G.onload=="function"){var i=G.onload;G.onload=function(){i();j()}}else{G.onload=j}}}}}function I(){var l=H.length;for(var j=0;j<l;j++){var m=H[j].id;if(a.pv[0]>0){var k=c(m);if(k){H[j].width=k.getAttribute("width")?k.getAttribute("width"):"0";H[j].height=k.getAttribute("height")?k.getAttribute("height"):"0";if(O(H[j].swfVersion)){if(a.webkit&&a.webkit<312){U(k)}X(m,true)}else{if(H[j].expressInstall&&!C&&O("6.0.65")&&(a.win||a.mac)){D(H[j])}else{d(k)}}}}else{X(m,true)}}}function U(m){var k=m.getElementsByTagName(P)[0];if(k){var p=Y("embed"),r=k.attributes;if(r){var o=r.length;for(var n=0;n<o;n++){if(r[n].nodeName.toLowerCase()=="data"){p.setAttribute("src",r[n].nodeValue)}else{p.setAttribute(r[n].nodeName,r[n].nodeValue)}}}var q=k.childNodes;if(q){var s=q.length;for(var l=0;l<s;l++){if(q[l].nodeType==1&&q[l].nodeName.toLowerCase()=="param"){p.setAttribute(q[l].getAttribute("name"),q[l].getAttribute("value"))}}}m.parentNode.replaceChild(p,m)}}function F(i){if(a.ie&&a.win&&O("8.0.0")){G.attachEvent("onunload",function(){var k=c(i);if(k){for(var j in k){if(typeof k[j]=="function"){k[j]=function(){}}}k.parentNode.removeChild(k)}})}}function D(j){C=true;var o=c(j.id);if(o){if(j.altContentId){var l=c(j.altContentId);if(l){L=l;T=j.altContentId}}else{L=b(o)}if(!(/%$/.test(j.width))&&parseInt(j.width,10)<310){j.width="310"}if(!(/%$/.test(j.height))&&parseInt(j.height,10)<137){j.height="137"}g.title=g.title.slice(0,47)+" - Flash Player Installation";var n=a.ie&&a.win?"ActiveX":"PlugIn",k=g.title,m="MMredirectURL="+G.location+"&MMplayerType="+n+"&MMdoctitle="+k,p=j.id;if(a.ie&&a.win&&o.readyState!=4){var i=Y("div");p+="SWFObjectNew";i.setAttribute("id",p);o.parentNode.insertBefore(i,o);o.style.display="none";G.attachEvent("onload",function(){o.parentNode.removeChild(o)})}R({data:j.expressInstall,id:K,width:j.width,height:j.height},{flashvars:m},p)}}function d(j){if(a.ie&&a.win&&j.readyState!=4){var i=Y("div");j.parentNode.insertBefore(i,j);i.parentNode.replaceChild(b(j),i);j.style.display="none";G.attachEvent("onload",function(){j.parentNode.removeChild(j)})}else{j.parentNode.replaceChild(b(j),j)}}function b(n){var m=Y("div");if(a.win&&a.ie){m.innerHTML=n.innerHTML}else{var k=n.getElementsByTagName(P)[0];if(k){var o=k.childNodes;if(o){var j=o.length;for(var l=0;l<j;l++){if(!(o[l].nodeType==1&&o[l].nodeName.toLowerCase()=="param")&&!(o[l].nodeType==8)){m.appendChild(o[l].cloneNode(true))}}}}}return m}function R(AE,AC,q){var p,t=c(q);if(typeof AE.id==Z){AE.id=q}if(a.ie&&a.win){var AD="";for(var z in AE){if(AE[z]!=Object.prototype[z]){if(z=="data"){AC.movie=AE[z]}else{if(z.toLowerCase()=="styleclass"){AD+=' class="'+AE[z]+'"'}else{if(z!="classid"){AD+=" "+z+'="'+AE[z]+'"'}}}}}var AB="";for(var y in AC){if(AC[y]!=Object.prototype[y]){AB+='<param name="'+y+'" value="'+AC[y]+'" />'}}t.outerHTML='<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"'+AD+">"+AB+"</object>";F(AE.id);p=c(AE.id)}else{if(a.webkit&&a.webkit<312){var AA=Y("embed");AA.setAttribute("type",W);for(var x in AE){if(AE[x]!=Object.prototype[x]){if(x=="data"){AA.setAttribute("src",AE[x])}else{if(x.toLowerCase()=="styleclass"){AA.setAttribute("class",AE[x])}else{if(x!="classid"){AA.setAttribute(x,AE[x])}}}}}for(var w in AC){if(AC[w]!=Object.prototype[w]){if(w!="movie"){AA.setAttribute(w,AC[w])}}}t.parentNode.replaceChild(AA,t);p=AA}else{var s=Y(P);s.setAttribute("type",W);for(var v in AE){if(AE[v]!=Object.prototype[v]){if(v.toLowerCase()=="styleclass"){s.setAttribute("class",AE[v])}else{if(v!="classid"){s.setAttribute(v,AE[v])}}}}for(var u in AC){if(AC[u]!=Object.prototype[u]&&u!="movie"){E(s,u,AC[u])}}t.parentNode.replaceChild(s,t);p=s}}return p}function E(k,i,j){var l=Y("param");l.setAttribute("name",i);l.setAttribute("value",j);k.appendChild(l)}function c(i){return g.getElementById(i)}function Y(i){return g.createElement(i)}function O(k){var j=a.pv,i=k.split(".");i[0]=parseInt(i[0],10);i[1]=parseInt(i[1],10);i[2]=parseInt(i[2],10);return(j[0]>i[0]||(j[0]==i[0]&&j[1]>i[1])||(j[0]==i[0]&&j[1]==i[1]&&j[2]>=i[2]))?true:false}function A(m,j){if(a.ie&&a.mac){return }var l=g.getElementsByTagName("head")[0],k=Y("style");k.setAttribute("type","text/css");k.setAttribute("media","screen");if(!(a.ie&&a.win)&&typeof g.createTextNode!=Z){k.appendChild(g.createTextNode(m+" {"+j+"}"))}l.appendChild(k);if(a.ie&&a.win&&typeof g.styleSheets!=Z&&g.styleSheets.length>0){var i=g.styleSheets[g.styleSheets.length-1];if(typeof i.addRule==P){i.addRule(m,j)}}}function X(k,i){var j=i?"visible":"hidden";if(S){c(k).style.visibility=j}else{A("#"+k,"visibility:"+j)}}return{registerObject:function(l,i,k){if(!a.w3cdom||!l||!i){return }var j={};j.id=l;j.swfVersion=i;j.expressInstall=k?k:false;H[H.length]=j;X(l,false)},getObjectById:function(l){var i=null;if(a.w3cdom&&S){var j=c(l);if(j){var k=j.getElementsByTagName(P)[0];if(!k||(k&&typeof j.SetVariable!=Z)){i=j}else{if(typeof k.SetVariable!=Z){i=k}}}}return i},embedSWF:function(n,u,r,t,j,m,k,p,s){if(!a.w3cdom||!n||!u||!r||!t||!j){return }r+="";t+="";if(O(j)){X(u,false);var q=(typeof s==P)?s:{};q.data=n;q.width=r;q.height=t;var o=(typeof p==P)?p:{};if(typeof k==P){for(var l in k){if(k[l]!=Object.prototype[l]){if(typeof o.flashvars!=Z){o.flashvars+="&"+l+"="+k[l]}else{o.flashvars=l+"="+k[l]}}}}J(function(){R(q,o,u);if(q.id==u){X(u,true)}})}else{if(m&&!C&&O("6.0.65")&&(a.win||a.mac)){X(u,false);J(function(){var i={};i.id=i.altContentId=u;i.width=r;i.height=t;i.expressInstall=m;D(i)})}}},getFlashPlayerVersion:function(){return{major:a.pv[0],minor:a.pv[1],release:a.pv[2]}},hasFlashPlayerVersion:O,createSWF:function(k,j,i){if(a.w3cdom&&S){return R(k,j,i)}else{return undefined}},createCSS:function(j,i){if(a.w3cdom){A(j,i)}},addDomLoadEvent:J,addLoadEvent:M,getQueryParamValue:function(m){var l=g.location.search||g.location.hash;if(m==null){return l}if(l){var k=l.substring(1).split("&");for(var j=0;j<k.length;j++){if(k[j].substring(0,k[j].indexOf("="))==m){return k[j].substring((k[j].indexOf("=")+1))}}}return""},expressInstallCallback:function(){if(C&&L){var i=c(K);if(i){i.parentNode.replaceChild(L,i);if(T){X(T,true);if(a.ie&&a.win){L.style.display="block"}}L=null;T=null;C=false}}}}}();