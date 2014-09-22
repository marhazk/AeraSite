function _ieTrueBody() { 
	return (document.compatMode && document.compatMode != "BackCompat") ? document.documentElement : document.body; 
} 
function _getScrollTop() { 
	return document.all?_ieTrueBody().scrollTop:window.pageYOffset; 
} 
$(document).ready(function(){
	//���򵼺�
	$("#nav h3 a").mouseover(
		function () {
			//����
			var bodywidth=$(window).width();
			var menu=$(this).parent().next();
			var menuall=$(".sub_nav");
			var menuleft=$(this).offset().left;
			var menuwidth=menu.outerWidth();
			var menuright=bodywidth-menuleft;
			//���ж���
			var menumove=(menuwidth/2)-($(this).width()/2);
			if(menumove<menuwidth-menuright)
			{
				menumove=menuwidth-menuright;
			}
			if(menumove>menuleft)
			{
				menumove=menuleft;
			}
			//alert("move:"+menumove+"width:"+menuwidth);
//			//�¼���ʼ
			//menuall.slideUp("fast");//IE6���ڼ�������
			menuall.css("display","none");
			menu.css("left","-"+menumove+"px");
			//menu.slideDown("fast");//IE6���ڼ�������
			menu.css("display","block");
		}
	);
	//�ȸ�
	if($(".sidebar").height()>$(".column").height())
	{
		BoxHeightEqual(".sidebar",".column_foot");
	}
	BoxHeightEqual(".column",".full_bg4");
	//����
	DropDownList(".JsSelect");
	//Ư����λ
	$("#uptop").css("right","2px");
	var h=(($(window).height()/2)-54);
	$("#uptop").css("top",h+"px");
	$(window).scroll(function(){
		$("#uptop").css("top",_getScrollTop()+h+"px");
	});
});
//���򣺳½�
//use:  �ȸ�
//time��15:57 2009-1-15
function BoxHeightEqual(divforclass1,divforclass2)
{
	if($(divforclass1).height()>$(divforclass2).height())
	{
		$(divforclass2).height($(divforclass1).height());
	}
	else
	{
		$(divforclass1).height($(divforclass2).height());
	}
}
//example for function js
//$(document).ready(function(){
//	BoxHeightEqual(".main-left",".main-right");
//});
//���򣺳½�
//time��20:41 2009-1-23
function DropDownList(_div)
{
	$(_div).hover(
		function(){
			//չ������
			//$(this).find(".JsSelectDownBox").slideDown("fast");
			$(this).find(".JsSelectDownBox").css("top","23px");
			$(this).find(".JsSelectDownBox>li").width($(this).find(".JsSelectDownBox").width());
		},
		function(){
			//��������
			//$(this).find(".JsSelectDownBox").slideUp("fast");
			$(this).find(".JsSelectDownBox").css("top","-100em");
		}
	);
	$(_div+" .JsSelectDownBox li").hover(
		function(){
			$(this).attr("class","hover");
			var $ul=$(this).find("ul");
			$ul.find("li").each(function(){
				$(this).width($(this).parent().width());
			});
			$ul.css("left",$(this).width());
			//$ul.slideDown("fast");
			$ul.css("top","5px");
		},
		function(){
			$(this).attr("class","");
			var $ul=$(this).find("ul");
			//$ul.slideUp("fast");
			$ul.css("top","-100em");
		}
	); 
}

//flash
function playFlash(flashid){
 var fpic =document.getElementById(flashid).getElementsByTagName("img");
 var flink =document.getElementById(flashid).getElementsByTagName("a");
 var focus_width=334
 var focus_height=249
 var text_height=0
 var imag=new Array();
 var link=new Array();
 var text=new Array();
 
 var swf_height = focus_height+text_height
 
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
	
 document.write('<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="'+ focus_width +'" height="'+ swf_height +'">');
 document.write('<param name="movie" value="http://images.perfectworld.my/conquer91e/flash/index_huandeng_0812.swf"><param name="quality" value="high"><param name="bgcolor" value="#F0F0F0">');
 document.write('<param name="menu" value="false">');
 document.write('<param name=wmode value="transparent">')
 document.write('<param name="FlashVars" value="mylinkpic='+pics+'">');
 
 document.write('<embed src="http://images.perfectworld.my/eo91e/flash/index_flash.swf"  wmode="transparent" FlashVars="mylinkpic='+pics+'" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" height="'+swf_height+'"width="'+focus_width+'"/>');  document.write('</object>');
 }
 
 
 
 

(function($){
	$.fn.Fillet=function(settings){    
        settings=jQuery.extend({
			sprite_v_url:"http://images.perfectworld.my/wl/images/0906/fillet-top-bottom.png",
			sprite_l_url:"http://images.perfectworld.my/wl/images/0906/fillet-left-right.png",
			sprite_v_topleft:-50,
			sprite_v_topright:-100,
			sprite_v_bottomleft:-150,
			sprite_v_bottomright:-200,
			img_topleft_width:200,
			img_topleft_height:50,
			img_topright_width:50,
			img_topright_height:50,
			img_bottomleft_width:50,
			img_bottomleft_height:50,
			img_bottomright_width:50,
			img_bottomright_height:50,
			img_leftright_width:50,
			background:"#FFFFFF"
    	},settings);
		return this.each(function() {
			$.fn.Fillet.FilletAt( $(this), settings );
    	});
    };
	$.fn.Fillet.FilletAt = function($this, settings){
		var width=$this.innerWidth()+"px",height=$this.innerHeight()+"px";
//		//���
//		if($this.css("width")!="auto")
//		width=$this.css("width")+";";
//		//width=width.substring(0,width.indexOf("px"));
//		//�߶�
//		if($this.css("height")!="auto")
//		height=$this.css("height");
//		//height=height.substring(0,height.indexOf("px"));
		var c=
			"<div style='background:"+settings.background+";position:relative;width:"+width+";height:"+height+";'>"+
			"<div style='position:absolute;width:"+width+";height:"+settings.img_topleft_height+"px;left:0;right:0;top:0;background:url("+settings.sprite_v_url+") repeat-x left top;'></div>"+
			"<div style='position:absolute;width:"+width+";height:"+settings.img_bottomleft_height+"px;left:0;right:0;bottom:0px;background:url("+settings.sprite_v_url+") repeat-x left bottom;'></div>"+
			"<div style='position:absolute;height:"+height+";width:"+settings.img_leftright_width+"px;left:0;top:0;bottom:0;background:url("+settings.sprite_l_url+") repeat-y left top;'></div>"+
			"<div style='position:absolute;height:"+height+";width:"+settings.img_leftright_width+"px;right:0;top:0;bottom:0;background:url("+settings.sprite_l_url+") repeat-y right top;'></div>"+
			"<div style='position:absolute;width:"+settings.img_topleft_width+"px;height:"+settings.img_topleft_height+"px;left:0;top:0;background:url("+settings.sprite_v_url+") no-repeat left "+settings.sprite_v_topleft+"px;'></div>"+
			"<div style='position:absolute;width:"+settings.img_topright_width+"px;height:"+settings.img_topright_height+"px;right:0;top:0;background:url("+settings.sprite_v_url+") no-repeat right "+settings.sprite_v_topright+"px;'></div>"+
			"<div style='position:absolute;width:"+settings.img_bottomleft_width+"px;height:"+settings.img_bottomleft_height+"px;left:0;bottom:0;background:url("+settings.sprite_v_url+") no-repeat left "+settings.sprite_v_bottomleft+"px;'></div>"+
			"<div style='position:absolute;width:"+settings.img_bottomright_width+"px;height:"+settings.img_bottomright_height+"px;right:0;bottom:0;background:url("+settings.sprite_v_url+") no-repeat right "+settings.sprite_v_bottomright+"px;'></div>"+
			"<div style='position:relative;width:"+width+";height:"+height+";'>"+$this.html()+"</div></div>";
		//alert(c);
		$this.html(c);
		//alert("width:"+width+";height:"+height);
	};
})(jQuery);


function GoToTop(){
document.writeln("<style type=\"text\/css\">.totop {position: fixed;top: 85%;left: 94%;padding-top: 0px;padding-right: 0px;z-index:1001;}");
document.writeln("* html .totop {position: absolute;top: expression((document.documentElement.scrollTop || document.body.scrollTop) + Math.round(85 * (document.documentElement.offsetHeight || document.body.clientHeight) \/ 100) + \'px\');}<\/style>");
document.writeln("<div class=\"totop\"><img src=\"http:\/\/images.perfectworld.my\/aerapwe\/img\/totop_tq.gif\" width=\"25\" height=\"66\" border=\"0\" usemap=\"#Map\"><map name=\"Map\"><area shape=\"rect\" title=\"Web Error & Suggestions\" coords=\"4,2,22,14\" href=\"javascript:aerapw.aerapwBug();\"><area shape=\"rect\" title=\"Set Bookmark\" coords=\"4,18,22,30\" href=\"javascript:aerapw.aerapwBookmark()\"><area shape=\"rect\" title=\"Home\" coords=\"4,35,22,47\" href=\"http:\/\/aera.perfectworld.my\/\"><area shape=\"rect\" coords=\"4,54,22,66\" onclick=scroll(0,0) href=\"#\"><\/map><\/div>");
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
	"",			// background colour
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