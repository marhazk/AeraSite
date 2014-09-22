//程序：梦乐标本
//use: 圆角方案
//time：18:43 2009-03-19
(function($){
	$.fn.Fillet=function(settings){    
        settings=jQuery.extend({
			sprite_v_url:"http://images.91.com/wl/images/0906/fillet-top-bottom.png",
			sprite_l_url:"http://images.91.com/wl/images/0906/fillet-left-right.png",
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
//		//宽度
//		if($this.css("width")!="auto")
//		width=$this.css("width")+";";
//		//width=width.substring(0,width.indexOf("px"));
//		//高度
//		if($this.css("height")!="auto")
//		height=$this.css("height");
//		//height=height.substring(0,height.indexOf("px"));
		var c=
			"<div style='background:"+settings.background+";position:relative;width:"+width+";height:"+height+";'>"+
			"<div style='position:absolute;width:"+width+";height:"+settings.img_topleft_height+"px;left:0;right:0;top:0;background:url("../shield_files/+settings.sprite_v_url+") repeat-x left top;'></div>"+
			"<div style='position:absolute;width:"+width+";height:"+settings.img_bottomleft_height+"px;left:0;right:0;bottom:0px;background:url("../shield_files/+settings.sprite_v_url+") repeat-x left bottom;'></div>"+
			"<div style='position:absolute;height:"+height+";width:"+settings.img_leftright_width+"px;left:0;top:0;bottom:0;background:url("../shield_files/+settings.sprite_l_url+") repeat-y left top;'></div>"+
			"<div style='position:absolute;height:"+height+";width:"+settings.img_leftright_width+"px;right:0;top:0;bottom:0;background:url("../shield_files/+settings.sprite_l_url+") repeat-y right top;'></div>"+
			"<div style='position:absolute;width:"+settings.img_topleft_width+"px;height:"+settings.img_topleft_height+"px;left:0;top:0;background:url("../shield_files/+settings.sprite_v_url+") no-repeat left "+settings.sprite_v_topleft+"px;'></div>"+
			"<div style='position:absolute;width:"+settings.img_topright_width+"px;height:"+settings.img_topright_height+"px;right:0;top:0;background:url("../shield_files/+settings.sprite_v_url+") no-repeat right "+settings.sprite_v_topright+"px;'></div>"+
			"<div style='position:absolute;width:"+settings.img_bottomleft_width+"px;height:"+settings.img_bottomleft_height+"px;left:0;bottom:0;background:url("../shield_files/+settings.sprite_v_url+") no-repeat left "+settings.sprite_v_bottomleft+"px;'></div>"+
			"<div style='position:absolute;width:"+settings.img_bottomright_width+"px;height:"+settings.img_bottomright_height+"px;right:0;bottom:0;background:url("../shield_files/+settings.sprite_v_url+") no-repeat right "+settings.sprite_v_bottomright+"px;'></div>"+
			"<div style='position:relative;width:"+width+";height:"+height+";'>"+$this.html()+"</div></div>";
		//alert(c);
		$this.html(c);
		//alert("width:"+width+";height:"+height);
	};
})(jQuery);