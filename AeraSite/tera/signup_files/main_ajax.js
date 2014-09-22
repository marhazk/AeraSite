var $w = window;
var $d = document;
var $l = location;
function $i(s){return $d.getElementById(s);}
function $t(s){return $d.getElementsByTagName(s);}
function $n(s){return $d.getElementsByName(s);}

var _jsc = {};
if(!_jschome)var _jschome='https://account.perfectworld.com.my';

_jsc.loaded = false;

_jsc.client = (function(){	
	var t = {};
	var b = navigator.userAgent.toLowerCase();
	t.isOpera = (b.indexOf('opera') > -1);
	t.isIE = (!t.isOpera && b.indexOf('msie') > -1);
	t.isFF = (!t.isOpera &&!t.isIE&&b.indexOf('firefox') > -1);
	return t;
})();

_jsc.util = (function(){
	var t = {};
	t.addEvent = function(o,c,h){
		if(_jsc.client.isIE){
			o.attachEvent('on'+c,h);
		}else{
			o.addEventListener(c,h,false);
		}
		return true;
	};
	t.ga = function(o,s){
		return o.getAttribute(s);
	};
	t.sa = function(o,k,v){
		return o.setAttribute(k,v);
	};
	t.s2d = function(s){
		var sa = s.split('-');
		var d =  new Date(sa[0],(sa[1]-1),sa[2]);
		return d;
	};
	t.d2s = function(d,b){
		var ye = d.getFullYear();
		var me = (parseInt(d.getMonth())+1).toString()
		var de = d.getDate();
		if(me.length==1&&b)me='0'+me;
		if(de.length==1&&b)de='0'+de;
		return ye+me+de;
	};
	return t;
})();

_jsc.mgr = (function(){
	var t = {};
	t.s = [];
	t.addC = function(o){
		this.s.push(o);
	};
	t.getC = function(bid){
		for(var i=0;i<this.s.length;i++){
			if(this.s[i].bid==bid){
				return this.s[i];
			}
		}
		return null;
	};
	return t;
})();

_jsc.ajax = (function(){
	t={};
	t.getAjax = function(){
		try{
			return new XMLHttpRequest();
		}catch(e){
			try{
				return new ActiveXObject('Msxml2.XMLHTTP');
			}catch(e){
				return new ActiveXObject('Microsoft.XMLHTTP')
			}
		}
		return null;
	};
	return t;
})();

_jsc.dom = (function(){
	var t = {};
	t.gNxtSib = function(o){
		var co = o;
		do{
			if(co.nextSibling==null || co.nextSibling.nodeType==1){
				return co.nextSibling;
			}else{
				co = co.nextSibling;
			}			
		}while(true)
	};
	
	return t;
})();

_jsc.evt = (function(){
	var t = {};
	t.gTar = function(oe){
		if(_jsc.client.isIE){
			return oe.srcElement;
		}else{
			return oe.target;
		}
	};
	t.gJsc = function(o){
		var ot = o
		do{
			if(ot.getAttribute("c_type")){
				return ot;
			}
			if(ot.parentNode){
				ot = ot.parentNode;
			}else{
				return null;
			}
		}while(true);
	};
	t.evtHandler = function(){
		var eo = window.event?window.event:arguments[0];
		var tar = _jsc.evt.gTar(eo);
		var jsc = _jsc.evt.gJsc(tar).jsc;
		et = eo.type;
		eval("var h = jsc.jsc"+et);
		h(tar,jsc);
	};
	t.fire = function(jsc,etype,evt){
		eval("var h = jsc.c_on"+etype);
		eval("var t = typeof "+h);
		if(t == "function"){
			eval(h+"(evt)");
		}
	};
	return t;
})();

function Jsc(){
	this.chkPropName = function(s){
		if(s == 'c_type'){
			return false;
		}
		return true;
	};		
	
	this.getAttr = function(k){
		return eval("this."+k);
	};
	
	this.setAttr = function(k,v,n){
		if(!n){
			if(typeof v == "string"){
				eval("this."+k+" = \""+v+"\"");
			}else{
				eval("this."+k+" = "+v);
			}
		}
	};
	
	this.initBase = function(){
		_jsc.mgr.addC(this);
		for(var i = 0;i<this.doc.attributes.length;i++){
			var nn = this.doc.attributes[i].nodeName;
			if(nn.indexOf("c_") == 0){
				if(this.chkPropName(nn)){
					var nv = this.doc.attributes[i].nodeValue;
					eval("this."+nn+" = '"+nv+"'");
				}
			}
		}
	};
}

function JscStateElement(ele,dft,ukey){
	this.getState = null;//y
	this.setState = null;//y
	this.defaultState = dft;
	this.currentState = dft;
	this.ele = ele;
	this.eid = ele.id;
	this.must = true;	
	this.ischanged = false;
	this.check = false;//o
	this.urlKey = ukey;
}

function JscSet(){
	this.arr = [];
	this.idx = {};
	this.cp = -1;
	this.al = 0;
	this.add = function(oid,obj){
		this.arr.push([oid,obj]);
		this.cp++;
		this.idx[oid] = this.cp;
		this.al++;
	};
	this.del = function(oid){
		var add = this.idx[oid];
		delete this.arr[add];
		this.al--;
		delete this.idx[oid];
	};
		
	this.getFirst = function(){
		if(this.al<1)return null;
		for(var i=0;i<this.arr.length;i++){
			if(this.arr[i]){
				return this.arr[i][1];
			}
		}
		return null;
	};
}
