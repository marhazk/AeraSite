var pswYlIsid = "afV0AoVIcd6v";
// safe-standard@gecko.js

var pswYlIiso;
try {
	pswYlIiso = (opener != null) && (typeof(opener.name) != "unknown") && (opener.pswYlIwid != null);
} catch(e) {
	pswYlIiso = false;
}
if (pswYlIiso) {
	window.pswYlIwid = opener.pswYlIwid + 1;
	pswYlIsid = pswYlIsid + "_" + window.pswYlIwid;
} else {
	window.pswYlIwid = 1;
}
function pswYlIn() {
	return (new Date()).getTime();
}
var pswYlIs = pswYlIn();
function pswYlIst(f, t) {
	if ((pswYlIn() - pswYlIs) < 7200000) {
		return setTimeout(f, t * 1000);
	} else {
		return null;
	}
}
var pswYlIol = false;
function pswYlIow() {
	if (pswYlIol || (1 == 1)) {
		var pswo = "menubar=0,location=0,scrollbars=auto,resizable=1,status=0,width=650,height=680";
		var pswn = "pscw_" + pswYlIn();
		var url = "http://messenger.providesupport.com/messenger/1tou5biav6yqh1wsmke6n7sw0a.html?ps_s=" + pswYlIsid;
		if (false && !false) {
			window.open(url, pswn, pswo); 
		} else {
			var w = window.open("", pswn, pswo); 
			try {
				w.document.body.innerHTML += '<form id="pscf" action="http://messenger.providesupport.com/messenger/1tou5biav6yqh1wsmke6n7sw0a.html" method="post" target="' + pswn + '" style="display:none"><input type="hidden" name="ps_s" value="'+pswYlIsid+'"></form>';
				w.document.getElementById("pscf").submit();
			} catch (e) {
				w.location.href = url;
			}
		}
	} else if (1 == 2) {
		document.location = "http\u003a\u002f\u002f";
	}
}
var pswYlIil;
var pswYlIit;
function pswYlIpi() {
	var il;
	if (3 == 2) {
		il = window.pageXOffset + 50;
	} else if (3 == 3) {
		il = (window.innerWidth * 50 / 100) + window.pageXOffset;
	} else {
		il = 50;
	}
	il -= (271 / 2);
	var it;
	if (3 == 2) {
		it = window.pageYOffset + 50;
	} else if (3 == 3) {
		it = (window.innerHeight * 50 / 100) + window.pageYOffset;
	} else {
		it = 50;
	}
	it -= (191 / 2);
	if ((il != pswYlIil) || (it != pswYlIit)) {
		pswYlIil = il;
		pswYlIit = it;
		var d = document.getElementById('ciwYlI');
		if (d != null) {
			d.style.left  = Math.round(pswYlIil) + "px";
			d.style.top  = Math.round(pswYlIit) + "px";
		}
	}
	setTimeout("pswYlIpi()", 100);
}
var pswYlIlc = 0;
function pswYlIsi(t) {
	window.onscroll = pswYlIpi;
	window.onresize = pswYlIpi;
	pswYlIpi();
	pswYlIlc = 0;
	var url = "http://messenger.providesupport.com/" + ((t == 2) ? "auto" : "chat") + "-invitation/1tou5biav6yqh1wsmke6n7sw0a.html?ps_s=" + pswYlIsid + "&ps_t=" + pswYlIn() + "";
	var d = document.getElementById('ciwYlI');
	if (d != null) {
		d.innerHTML = '<iframe allowtransparency="true" style="background:transparent;width:271;height:191" src="../eudomon_files/' + url + 
			'" onload="pswYlIld()" frameborder="no" width="271" height="191" scrolling="no"></iframe>';
	}
}
function pswYlIld() {
	if (pswYlIlc == 1) {
		var d = document.getElementById('ciwYlI');
		if (d != null) {
			d.innerHTML = "";
		}
	}
	pswYlIlc++;
}
if (false) {
	pswYlIsi(1);
}
var pswYlId = document.getElementById('scwYlI');
if (pswYlId != null) {
	if (pswYlIol || (1 == 1) || (1 == 2)) {
		var ctt = "";
		if (ctt != "") {
			tt = 'alt="' + ctt + '" title="' + ctt + '"';
		} else {
			tt = '';
		}
		if (false) {
			var p1 = '<table style="display:inline;border:0px;border-collapse:collapse;border-spacing:0;"><tr><td style="padding:0px;text-align:center;border:0px;vertical-align:middle"><a href="#" onclick="pswYlIow(); return false;"><img name="pswYlIimage" src="http://image.providesupport.com/image/1tou5biav6yqh1wsmke6n7sw0a/offline-1228127585.gif" width="80" height="80" style="border:0;display:block;margin:auto"';
			var p2 = '<td style="padding:0px;text-align:center;border:0px;vertical-align:middle"><a href="http://www.providesupport.com/pb/1tou5biav6yqh1wsmke6n7sw0a" target="_blank"><img src="http://image.providesupport.com/';
			var p3 = 'style="border:0;display:block;margin:auto"></a></td></tr></table>';
			if ((80 >= 140) || (80 >= 80)) {
				pswYlId.innerHTML = p1+tt+'></a></td></tr><tr>'+p2+'lcbpsh.gif" width="140" height="17"'+p3;
			} else {
				pswYlId.innerHTML = p1+tt+'></a></td>'+p2+'lcbpsv.gif" width="17" height="140"'+p3;
			}
		} else {
			pswYlId.innerHTML = '<a href="#" onclick="pswYlIow(); return false;"><img name="pswYlIimage" src="http://image.providesupport.com/image/1tou5biav6yqh1wsmke6n7sw0a/offline-1228127585.gif" width="80" height="80" border="0"'+tt+'></a>';
		}
	} else {
		pswYlId.innerHTML = '';
	}
}
var pswYlIop = false;
function pswYlIco() {
	var w1 = pswYlIci.width - 1;
	pswYlIol = (w1 & 1) != 0;
	pswYlIsb(pswYlIol ? "http://image.providesupport.com/image/1tou5biav6yqh1wsmke6n7sw0a/online-1471232867.gif" : "http://image.providesupport.com/image/1tou5biav6yqh1wsmke6n7sw0a/offline-1228127585.gif");
	pswYlIscf((w1 & 2) != 0);
	var h = pswYlIci.height;

	if (h == 1) {
		pswYlIop = false;

	// manual invitation
	} else if ((h == 2) && (!pswYlIop)) {
		pswYlIop = true;
		pswYlIsi(1);
		//alert("Chat invitation in standard code");
		
	// auto-invitation
	} else if ((h == 3) && (!pswYlIop)) {
		pswYlIop = true;
		pswYlIsi(2);
		//alert("Auto invitation in standard code");
	}
}
var pswYlIci = new Image();
pswYlIci.onload = pswYlIco;
var pswYlIpm = false;
var pswYlIcp = pswYlIpm ? 30 : 60;
var pswYlIct = null;
function pswYlIscf(p) {
	if (pswYlIpm != p) {
		pswYlIpm = p;
		pswYlIcp = pswYlIpm ? 30 : 60;
		if (pswYlIct != null) {
			clearTimeout(pswYlIct);
			pswYlIct = null;
		}
		pswYlIct = pswYlIst("pswYlIrc()", pswYlIcp);
	}
}
function pswYlIrc() {
	pswYlIct = pswYlIst("pswYlIrc()", pswYlIcp);
	try {
		pswYlIci.src = "http://image.providesupport.com/cmd/1tou5biav6yqh1wsmke6n7sw0a?" + "ps_t=" + pswYlIn() + "&ps_l=" + escape(document.location) + "&ps_r=" + escape(document.referrer) + "&ps_s=" + pswYlIsid + "" + "";
	} catch(e) {
	}
}
pswYlIrc();
var pswYlIcb = "http://image.providesupport.com/image/1tou5biav6yqh1wsmke6n7sw0a/offline-1228127585.gif";
function pswYlIsb(b) {
	if (pswYlIcb != b) {
		var i = document.images['pswYlIimage'];
		if (i != null) {
			i.src = b;
		}
		pswYlIcb = b;
	}
}

