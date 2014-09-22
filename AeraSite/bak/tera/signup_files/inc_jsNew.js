function CheckIEVersion()
{
	var appVar=new String(navigator.appVersion);
	var st=appVar.substr(appVar.indexOf("MSIE")+5,3);
	st=parseInt(st);
	if(st*10<55)
	{
		return true;
	}
	else
	{
		return false;
	}
}

function CheckAll(form)
{
  for (var i=0;i<form.elements.length;i++)
    {
    var e = form.elements[i];
    if (e.name != 'chkall')
       e.checked = form.chkall.checked;
    }
}

function checkDate(inString,fieldName)
{
	if( inString!="" )
	{
		var tempDate;
		var a=new Date(inString);
		var y=a.getFullYear();
		var m=a.getMonth()+1;
		var d=a.getDate();
		var myday=y + "/" + m + "/" + d
		if (myday!=inString)
		{
			alert("Invalid"+ fieldName + "date(MM/DD/YYYY!"); 
			return false; 
		}
	}
	return true; 
}

function checkvalue(obj, low, up, mode, lable){
    var temp,type;
    var length, i, base, str;
    str=getformvalue(obj);
    if(str==null){
		lenght=0;
		str="";
	}	
	else{	
		length = GetStringLength(str);
	}	
    temp=""
    if( mode % 2 >= 1 ){
        if( str == "" ){
           temp = temp  + " Please enter" + " " + lable + "!" + "\n";
        }
    }
    
    if( mode % 4 >= 2 ){
        base = "0123456789."
        for(i = 0;i<=length-1;i++)
            if( base.indexOf(str.substring(i, i+1)) == -1  ){
				temp = temp + "" + lable + "" + " It should consist of 0-9!" + "\n";
				break;
            }    
    }
    
    if( mode % 8 >= 4 ){
        base = "0123456789"
        for(i = 0;i<=length-1;i++)
            if( base.indexOf(str.substring(i, i+1)) == -1  ){
                temp = temp + "" + lable + "" + " It should consist of 0-9!" + "\n";
                break;
            }    
    }
    
    if( mode % 16 >= 8 ){
        base = "abcdefghijklmnopqrstuvwxyzabcdefghijklmnopqrstuvwxyz0123456789_-.@"
        for(i = 0;i<=length-1;i++)
            if( base.indexOf(str.substring(i, i+1)) == -1  ){
                temp = temp + "" + lable + "" + " contains invalid character! Only a-z, A-Z, 0-9 and .-_@" + "\n";
                break;
            }
    }
    
    if( mode % 32 >= 16 ){
        base = low.replace("[a-z]", "abcdefghijklmnopqrstuvwxyz")
        base = base.replace("[a-z]", "abcdefghijklmnopqrstuvwxyz")
        base = base.replace( "[0-9]", "0123456789")
        for(i = 0;i<=length-1;i++)
            if( base.indexOf(str.substring(i, i+1)) == -1 ){
                temp = temp + "" + lable + "" + " contains invalid characters! It can only be" + up + "." + "\n";
                break;
            }
    }
    
     if( mode % 64 >= 32 ){
        if( ! (length >= low && length <= up) ){
               temp = temp + "" + lable + "" + " should be " + low + "-" + up + " characters!" + "\n";
        }
    }
    
     if( mode % 128 >= 64 ){
        if( ! (parseInt(str) >= parseInt(low) && parseInt(str) <= parseInt(up)) ){
               temp = temp + "" + lable + "" + " should be " + low + "-" + up + " characters!" + "\n";
        }

    }
    if(temp!=""){
    	alert(temp);
    	type=(getformtype(obj));
    	if(type!="radio" && type!="checkbox"){
    		obj.focus();
    	}
	return false; 
   }
   return true;
    
}


function getformvalue(input){
	var type,temp;
	temp="";
	
	type=getformtype(input);	

	switch(type){
		case "radio":

			n=input.length-1;

			if(isNaN(n)==true){
				if(input.checked == true){
					temp = input.value;
				}else{
					temp = "";
				}	
			}else{
				for(i=0;i<=n;i++){
					if(input[i].checked == true){
						return(input[i].value);
					}
				}
				break;
			}
			case "checkbox":
			n=input.length-1;
			if(isNaN(n)==true){
				if(input.checked == true){
					temp = input.value;
				}else{
					temp = "";
				}	
			}else{
				for(i=0;i<=n;i++){
					if(input[i].checked == true){
						if(temp!=""){
							temp += ",";
						}
						temp += input[i].value;

					}	
				}
			}
			return(temp);
			break;
			
		case "select-one" :

			n=input.length-1;	
			for(i=0;i<=n;i++){
				if(input.options[i].selected == true){
					temp = input.options[i].value;
					break;
				}			
			}
			return(temp);
			break;				
		case "select-multiple":

			n=input.length-1;	
			for(i=0;i<=n;i++){
				if(input.options[i].selected == true){
					if(temp!=""){
						temp+=",";
					}					
					temp+=input.options[i].value;
				}			
			}
			return(temp);
			break;			
		default:
			return(input.value);
			break;
	
	}
	
	return(input.value);

}


function getformtype(obj){
	var type;
	type=obj.type;
	if(typeof(type)=="undefined"){

		type=obj[0].type;
	}
	return type;		
}


function getformvalue(input){
	var type,temp;
	temp="";
	
	type=getformtype(input);	

	switch(type){
		case "radio":

			n=input.length-1;

			if(isNaN(n)==true){
				if(input.checked == true){
					temp = input.value;
				}else{
					temp = "";
				}	
			}else{
				for(i=0;i<=n;i++){
					if(input[i].checked == true){
						return(input[i].value);
					}
				}
				break;
			}
			case "checkbox":
			n=input.length-1;
			if(isNaN(n)==true){
				if(input.checked == true){
					temp = input.value;
				}else{
					temp = "";
				}	
			}else{
				for(i=0;i<=n;i++){
					if(input[i].checked == true){
						if(temp!=""){
							temp += ",";
						}
						temp += input[i].value;

					}	
				}
			}
			return(temp);
			break;
			
		case "select-one" :

			n=input.length-1;	
			for(i=0;i<=n;i++){
				if(input.options[i].selected == true){
					temp = input.options[i].value;
					break;
				}			
			}
			return(temp);
			break;				
		case "select-multiple":

			n=input.length-1;	
			for(i=0;i<=n;i++){
				if(input.options[i].selected == true){
					if(temp!=""){
						temp+=",";
					}					
					temp+=input.options[i].value;
				}			
			}
			return(temp);
			break;			
		default:
			return(input.value);
			break;
	
	}
	
	return(input.value);

}

function ischecked(group,value){
	var i,n;
	n=group.length-1;
	for(i=0;i<=n;i++){
		if(value==group[i]){
			return true;			
		}
	}
	return false;
}


function SetSelectedAndChecked(input,value){
	var type,temp,i,n;
	var split_value = new Array();
	temp="";
	
	type=input.type;
	
	if(typeof(type)=="undefined"){
		type=input[0].type;
	}
	

	switch(type){
		case "radio":

			n=input.length-1;

			if(isNaN(n)==true){
				if(input.value = value){
					input.checked = true;
				}else{
					input.checked = false;
				}	
			}else{
				for(i=0;i<=n;i++){
					if(input[i].value == value){
						input[i].checked = true;
					}else{
						input[i].checked = false;					
					}
				}
			}
			break;

		case "checkbox":
			n=input.length-1;
			split_value=value.split(",");
			if(isNaN(n)==true){
				if(ischecked(split_value,input.value)){
					input.checked = true;
				}else{
					input.checked = false;
				}	
			}else{
				for(i=0;i<=n;i++){
					if(ischecked(split_value,input[i].value)){
						input[i].checked = true;
					}else{
						input[i].checked = false;					
					}					
				}
				
			}
			break;
			
		case "select-one" :

			n=input.options.length-1;	
			for(i=0;i<=n;i++){
				if(input.options[i].value == value){
					input.options[i].selected = true;
				}else{
					input.options[i].selected = false;				
				}
						
			}
			break;				
		case "select-multiple":

			n=input.options.length-1;	
			split_value=value.split(",");
			for(i=0;i<=n;i++){
				if(ischecked(split_value,input.options[i].value)){
						input.options[i].selected = true;
				}else{
						input.options[i].selected = false;				
				}			
			}
			break;			
		default:
			return false;
			break;
	
	}
	
	return true;

}


function checkemail(stremail)
{
	var str=stremail
	//var filter=/^.+@.+\..{2,3}$/
	var filter=/^\w+([-.]{0,}\w+)*[-]{0,10}@\w+([-.]\w+)*\.\w+([-.]\w+)*$/
	if (filter.test(str))
		testresults=true
	else
	{
		testresults=false
	}
	return (testresults)
}

function CheckIfEnglish(String)
{ 
   var Letters = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
   var i;
   var c;
   for( i = 0; i < String.length; i ++ )
   {
     c = String.charAt( i );
	   if (Letters.indexOf( c ) < 0)
	     return false;
   }
     return true;
}

function CheckIfEnglish4Reg(String)
{ 
   var Letters = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890.@_-";
   var i;
   var c;
   for( i = 0; i < String.length; i ++ )
   {
     c = String.charAt( i );
	   if (Letters.indexOf( c ) < 0)
	     return false;
   }
     return true;
}

function CheckIfSmallEnglish(String)
{
   var Letters = "abcdefghijklmnopqrstuvwxyz1234567890";
   var i;
   var c;
   for( i = 0; i < String.length; i ++ )
   {
     c = String.charAt( i );
	   if (Letters.indexOf( c ) < 0)
	     return false;
   }
   return true;
}

function CheckIfBothEnglishInt(String) {
    var Letters = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
    var Letteraz = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
    var Letter09 = "1234567890";
    var i;
    var c;
    var baz = false;
    var b09 = false;
    for (i = 0; i < String.length; i++) {
        c = String.charAt(i);
        if (Letters.indexOf(c) < 0) {
            return false;
        }
        if (Letteraz.indexOf(c) >= 0) {
            baz = true;
        }
        if (Letter09.indexOf(c) >= 0) {
            b09 = true;
        }
    }
    return (baz && b09);
}

function CheckTel(String)
{ 
   var Letters = "0123456789-";
   var i;
   var c;
   for( i = 0; i < String.length; i ++ )
   {
     c = String.charAt( i );
	   if (Letters.indexOf( c ) < 0)
	     return false;
   }
     return true;
}


function checkIsNull(str)
{
	var newstr;
	var re = /\s/gi;
	newstr=str.replace(re, "");
	if(str.length!=newstr.length)
	return(1);
	else
	return(0);
}

function Trim(str)
{
	var newstr;
	var re = /\s/gi;
	newstr=str.replace(re, "");
	return newstr;
}

function checkIsNull_All(str)
{
	var newstr = "";
	for(i=0;i<str.length;i++)
	{
		if( str.substr(i,1)!=" " )
		{
			newstr += str.substr(i,1);
		}
	}
	if(  str.length!=newstr.length )
		return 1;
	else
		return 0;
}

function checkIsNull(str)
{
	var newstr;
	var re = /\s/gi;
	newstr=str.replace(re, "");
	if(str.length!=newstr.length)
	return(1);
	else
	return(0);
}

function getCookieVal (offset) 
{
   var endstr = document.cookie.indexOf (";", offset);
   if (endstr == -1)
      endstr = document.cookie.length;
   return unescape(document.cookie.substring(offset, endstr));
}

function GetCookie (name) 
{
   var arg = name + "=";
   var alen = arg.length;
   var clen = document.cookie.length;
   var i = 0;
   while (i < clen) 
      {
      var j = i + alen;
      if (document.cookie.substring(i, j) == arg)
         return getCookieVal (j);
      i = document.cookie.indexOf(" ", i) + 1;
      if (i == 0) 
         break; 
      }
   return null;
}

function SetCookie (name, value) 
{
   var argv = SetCookie.arguments;
   var argc = SetCookie.arguments.length; 
   var expires = (2 < argc) ? argv[2] : null;
   var path = (3 < argc) ? argv[3] : null;
   var domain = (4 < argc) ? argv[4] : null;	
   var secure = (5 < argc) ? argv[5] : false;  
   document.cookie = name + "=" + escape (value) +
     ((expires == null) ? "" : ("; expires=" + expires.toGMTString())) +
     ((path == null) ? "" : ("; path=" + path)) +
     ((domain == null) ? "" : ("; domain=" + domain)) +
	((secure == true) ? "; secure" : "");
}
String.prototype.trueLength   =   function()   
  {   
  return   this.replace(/[^\x00-\xff]/g,   "**").length;   
  }
function GetStringLength(str)
{ 
	var Length = 0;
	for(i=0;i<str.length;i++)
	{
		char=str.charCodeAt(i); 
		if(char>255)
		{ 
			Length = Length + 2;
		}
		else
		{
			Length = Length + 1;
		}
	} 
	return Length;
}

function checkChinese(str)
{
	for(i=0;i<str.length;i++)
	{
		char=str.charCodeAt(i); 
		if(char>255)
		{ 
			return false;
		}
	}
	return true;
}