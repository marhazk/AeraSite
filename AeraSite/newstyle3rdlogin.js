          <div class="clear"></div>
          
		<div class="share">
			<a class="s1" title="Facebook" onclick="thirdLogin('facebook');" href="javascript:void(0);">Facebook</a>
			<a class="s2" title="Google" onclick="thirdLogin('google');" href="javascript:void(0);">Google</a>
			<a class="s3" title="Myspace" onclick="thirdLogin('myspace');" href="javascript:void(0);">Myspace</a>
			<a class="s4" title="Twitter" onclick="thirdLogin('twitter');" href="javascript:void(0);">Twitter</a>
			<a class="s5" title="Yahoo" onclick="thirdLogin('yahoo');" href="javascript:void(0);">Yahoo</a>
		</div>


// JavaScript Document
/**
 * 构造函数
 * @param ppUrl
 * @param src
 * @returns
 */
function Passport(url){
	this.ppUrl = url;
	var domain = document.domain;
	var tmp = url.split('.');   
	if(tmp.length > 2) 
		domain = tmp.slice(-2).join('.');
	domain = domain.replace('/', '');
	this.rootDomain = domain;
	//设置document.domain为顶级域名
	document.domain = this.rootDomain;
//	alert(this.rootDomain);
}
/**
 * 退出
 * @param backUrl 回跳地址，如果为空回跳到平台首页
 */
function logout(backUrl){
	if (window.confirm('Are you sure want to log out?')) {
		var url = this.ppUrl + 'user/logout.do';
		if(backUrl){
			url += '?backUrl='+encodeURIComponent(backUrl);
		}
		location.href = url;
	}
};
/**
 * 切换验证码
 */
function changeImgCode(imgId){
	$('#'+imgId).attr('src',ppUrl+'util/getValidateCode.do?_='+Math.random());
}
function subReq(url, para, callBack){
	$.ajax({
		url: url,
		data: para,
		dataType : 'jsonp',
		jsonp : 'jsonp',
		type: "post",
		cache : false,
		success: function(result){
			callBack(result);
		}
	});
}
/**
 * js请求公用方法，支持jsonp
 * @param url 请求地址
 * @param para 参数对象:{name1: v1,name2 :v2.....}
 * @param jsonp 是否jsonp ， true-是；false-不是
 * @param callBack 返回成功回调方法,返回数据,如果不是jsonp，返回的是字符串内容
 * @param errBack  请求错误回调方法，textStatus：返回html错误状态码,responseText：返回text内容
 */
function ajaxReq(url, para,jsonp, callBack,errBack){
	var config = {url: url,
			data: para,
			type: "post",
			cache : false,
			success: function(result){
				callBack(result);
			},
			error: function (XMLHttpRequest, textStatus, errorThrown) {
				//alert('=====error==='+XMLHttpRequest.status);
				//如果返回的数据不是json格式html状态码是200的，jquery会当做json解析错误
				//分开处理，当做成功返回内容
				if(200==XMLHttpRequest.status){
					callBack(XMLHttpRequest.responseText);
				}else{
					if(errBack){
						errBack(XMLHttpRequest.status,XMLHttpRequest.responseText);
					}
				}
			}};
	
	if(jsonp){
		config.dataType = 'jsonp';
		config.jsonp = 'jsonp';
	}
	$.ajax(config);
}
/**
 * 注册
 * @param para   参数对象{如果参数flag=1则设为会话级别}
 * @param callBack  回调方法，返回数据
 */
Passport.prototype.regist = function(para, callBack){
	subReq(this.ppUrl+'user/regist.do', para, callBack);
};
/**
 * 检查账号是否存在
 * @param account   账户名
 * @param callBack  回调方法，返回数据：1-存在；2-不存在
 */
Passport.prototype.chkAct = function(account, callBack){
	subReq(this.ppUrl+'user/chkAccount.do', {account:account}, callBack);
};
/**
 * 登录
 * @param para   参数对象{如果参数flag=1则设为会话级别}
 * @param callback  回调方法，返回数据
 */
Passport.prototype.login = function(para, callBack){
	subReq(this.ppUrl+'user/login.do', para, callBack);
};
/**
 * 检查登录
 * @param callback
 */
Passport.prototype.checkLogin = function(callBack){
	subReq(this.ppUrl+'user/checkLogin.do', null, callBack);
};
/**
 * 第三方登录
 * @param name 指定值：google,facebook,yahoo,myspace,twitter
 * @param flag 如果flag=1则设为会话级别,0-不是
 * @param open 是否打开新窗口，1-打开新窗口；0-页面跳转
 * @param backUrl 会跳地址
 */
Passport.prototype.loginThird = function(name,flag,open,backUrl){
	if(name=='myspace'){
		alert('Under maintenance.');
		return;
	}
	var para = GetUrlParms();
	var url = this.ppUrl+'thirdlogin/forword.do'+'?channel='+name+'&flag='+flag;
	if (para.urlCode){
		url += '&urlCode='+para.urlCode;
	}
	if (para.time){
		url += '&time='+para.time;
	}
	if (para.sign){
		url += '&sign='+para.sign;
	}
	if(backUrl){
		url += "&backUrl="+encodeURIComponent(backUrl);
	}
	if(1==open){
		//openwin(url);
		return window.open(url,'_blank');
	}else{
		window.location.href = url;
		return null;
	}
};


var passport = new Passport(ppUrl);
function thirdLogin(name){
	passport.loginThird(name,0,0,location.href);
}
