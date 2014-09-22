function _ieTrueBody() { 
	return (document.compatMode && document.compatMode != "BackCompat") ? document.documentElement : document.body; 
} 
function _getScrollTop() { 
	return document.all?_ieTrueBody().scrollTop:window.pageYOffset; 
} 
$(document).ready(function(){
	//横向导航
	$("#nav h3 a").mouseover(
		function () {
			//定义
			var bodywidth=$(window).width();
			var menu=$(this).parent().next();
			var menuall=$(".sub_nav");
			var menuleft=$(this).offset().left;
			var menuwidth=menu.outerWidth();
			var menuright=bodywidth-menuleft;
			//局中对齐
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
//			//事件开始
			//menuall.slideUp("fast");//IE6存在兼容问题
			menuall.css("display","none");
			menu.css("left","-"+menumove+"px");
			//menu.slideDown("fast");//IE6存在兼容问题
			menu.css("display","block");
		}
	);
	//等高
	if($(".sidebar").height()>$(".column").height())
	{
		BoxHeightEqual(".sidebar",".column_foot");
	}
	BoxHeightEqual(".column",".full_bg4");
	//下拉
	DropDownList(".JsSelect");
	//漂浮定位
	$("#uptop").css("right","2px");
	var h=(($(window).height()/2)-54);
	$("#uptop").css("top",h+"px");
	$(window).scroll(function(){
		$("#uptop").css("top",_getScrollTop()+h+"px");
	});
});
//程序：陈进福
//use:  等高
//time：15:57 2009-1-15
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
//程序：陈进福
//time：20:41 2009-1-23
function DropDownList(_div)
{
	$(_div).hover(
		function(){
			//展开动作
			//$(this).find(".JsSelectDownBox").slideDown("fast");
			$(this).find(".JsSelectDownBox").css("top","23px");
			$(this).find(".JsSelectDownBox>li").width($(this).find(".JsSelectDownBox").width());
		},
		function(){
			//收栏动作
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
 document.write('<param name="movie" value="http://images.91.com/conquer91e/flash/index_huandeng_0812.swf"><param name="quality" value="high"><param name="bgcolor" value="#F0F0F0">');
 document.write('<param name="menu" value="false">');
 document.write('<param name=wmode value="transparent">')
 document.write('<param name="FlashVars" value="mylinkpic='+pics+'">');
 
 document.write('<embed src="http://images.91.com/eo91e/flash/index_flash.swf"  wmode="transparent" FlashVars="mylinkpic='+pics+'" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" height="'+swf_height+'"width="'+focus_width+'"/>');  document.write('</object>');
 }