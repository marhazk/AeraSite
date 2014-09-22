function CheckUserName(theform)		//----Choose an account ID and check if it is usable.
{
	if (!checkvalue(theform.txtAccount,4,20,32,"Account ID"))	return false;
	if (!CheckIfEnglish4Reg(theform.txtAccount.value))
	{
		alert("Account ID should consist of a-z, A-Z , 0-9 and email!");
		theform.txtAccount.focus();
		theform.txtAccount.select();
		return false;
	}
	
	if(theform.txtAccount.value.indexOf(".") != -1 || theform.txtAccount.value.indexOf("@") != -1 || theform.txtAccount.value.indexOf("_") != -1 || theform.txtAccount.value.indexOf("-") != -1)
	{
		if (!checkemail(theform.txtAccount.value))
		{
			alert("Invalid entry. You can use email or non-email as a game account (only letters, numbers or combination of letters and numbers are valid). Please try again. ");
			theform.txtAccount.focus();
			theform.txtAccount.select();
			return false;
		}
	}
}

//简易注册提示
function CheckRegStepByQuickReg(theform, download_url) {

    if (theform.txtAccount.value == "" && theform.txtPassword.value == "" && theform.txtConfirmPassword.value == "" && theform.txtEmail.value == "") {
        alert("Please fill in the registration inform first.");
        return false;
    }
    if (theform.txtAccount.value == "") {
        alert("Please fill your user name.");
        return false;
    }
    if (theform.txtPassword.value == "") {
        alert("Please fill your password.");
        return false;
    }
    if (theform.txtConfirmPassword.value == "") {
        alert("Please fill your password again. ");
        return false;
    }
    if (theform.txtEmail.value == "") {
        alert("Please fill your E-mail.");
        return false;
    }
    if (theform.txtAccount.value == "") {
        alert("Please fill your user name. ");
        return false;
    }
	if( typeof(theform.isAgreement)!="undefined" && theform.isAgreement.checked==false )
	{
		alert("In order to continue, you must check the box labeled I Agree.");
		return false;
	}
    if (ValidaterShowInt >= 5) {
       if (theform.txtCheckCode.value == "") {
         alert("Please enter Validation Code!");
         theform.txtCheckCode.focus();
         theform.txtCheckCode.select();
         return false;
       }
    }
	
	if (!checkvalue(theform.txtAccount,4,20,32,"Account ID"))	return false;
	if (!CheckIfEnglish4Reg(theform.txtAccount.value))
	{
		alert("Account ID should consist of a-z, A-Z , 0-9 and email!");
		theform.txtAccount.focus();
		theform.txtAccount.select();
		return false;
	}
	
	if(theform.txtAccount.value.indexOf(".") != -1 || theform.txtAccount.value.indexOf("@") != -1 || theform.txtAccount.value.indexOf("_") != -1 || theform.txtAccount.value.indexOf("-") != -1)
	{
		if (!checkemail(theform.txtAccount.value))
		{
			alert("Invalid entry. You can use email or non-email as a TQ game account (only letters, numbers or combination of letters and numbers are valid). Please try again. ");
			theform.txtAccount.focus();
			theform.txtAccount.select();
			return false;
		}
	}

	if (!checkvalue(theform.txtPassword,6,14,32,"Password"))	return false;
	if (!CheckIfEnglish(theform.txtPassword.value))
	{
		alert("Password should consist of a-z, A-Z and 0-9!");
		theform.txtPassword.focus();
		theform.txtPassword.select();
		return false;
	}
	if (!checkvalue(theform.txtConfirmPassword,6,14,32,"Confirm Password"))	return false;
	if (!CheckIfEnglish(theform.txtConfirmPassword.value))
	{
		alert("Password should consist of a-z, A-Z and 0-9!");
		theform.txtConfirmPassword.focus();
		theform.txtConfirmPassword.select();
		return false;
	}	
	if(theform.txtPassword.value!=theform.txtConfirmPassword.value)
	{
		alert("Your passwords don't match!");
		theform.txtPassword.focus();
		theform.txtPassword.select();
		return false;
	}
	
	
	if(theform.txtEmail.value == "")
	{
		alert("Please enter your E-mail address!");
		theform.txtEmail.focus();
		theform.txtEmail.select();
		return false;
	}
	
	if (!checkemail(theform.txtEmail.value))
	{
		alert("Invalid email!");
		theform.txtEmail.focus();
		theform.txtEmail.select();
		return false;
	}
	if (ValidaterShowInt >= 5) {
	    if (theform.txtCheckCode.value == "") {
	        alert("Please enter Validation Code!");
	        theform.txtCheckCode.focus();
	        theform.txtCheckCode.select();
	        return false;
	    }
	}

    //打开下载链接
    var opener = window.open(download_url);
    opener.blur();
    self.focus();
}

//简易注册提示
function CheckRegStepByQuickReg2(theform) {

    if (theform.txtAccount.value == "" && theform.txtPassword.value == "" && theform.txtConfirmPassword.value == "" && theform.txtEmail.value == "") {
        alert("Please fill in the registration inform first.");
        return false;
    }
    if (theform.txtAccount.value == "") {
        alert("Please fill your user name.");
        return false;
    }
    if (theform.txtPassword.value == "") {
        alert("Please fill your password.");
        return false;
    }
    if (theform.txtConfirmPassword.value == "") {
        alert("Please fill your password again. ");
        return false;
    }
    if (theform.txtEmail.value == "") {
        alert("Please fill your E-mail.");
        return false;
    }
    if (theform.txtAccount.value == "") {
        alert("Please fill your user name. ");
        return false;
    }
    if (typeof (theform.isAgreement) != "undefined" && theform.isAgreement.checked == false) {
        alert("In order to continue, you must check the box labeled I Agree.");
        return false;
    }
    if (ValidaterShowInt >= 5) {
        if (theform.txtCheckCode.value == "") {
            alert("Please enter Validation Code!");
            theform.txtCheckCode.focus();
            theform.txtCheckCode.select();
            return false;
        }
    }

    if (!checkvalue(theform.txtAccount, 4, 20, 32, "Account ID")) return false;
    if (!CheckIfEnglish4Reg(theform.txtAccount.value)) {
        alert("Account ID should consist of a-z, A-Z , 0-9 and email!");
        theform.txtAccount.focus();
        theform.txtAccount.select();
        return false;
    }

    if (theform.txtAccount.value.indexOf(".") != -1 || theform.txtAccount.value.indexOf("@") != -1 || theform.txtAccount.value.indexOf("_") != -1 || theform.txtAccount.value.indexOf("-") != -1) {
        if (!checkemail(theform.txtAccount.value)) {
            alert("Invalid entry. You can use email or non-email as a TQ game account (only letters, numbers or combination of letters and numbers are valid). Please try again. ");
            theform.txtAccount.focus();
            theform.txtAccount.select();
            return false;
        }
    }

    if (!checkvalue(theform.txtPassword, 6, 14, 32, "Password")) return false;
    if (!CheckIfEnglish(theform.txtPassword.value)) {
        alert("Password should consist of a-z, A-Z and 0-9!");
        theform.txtPassword.focus();
        theform.txtPassword.select();
        return false;
    }
    if (!checkvalue(theform.txtConfirmPassword, 6, 14, 32, "Confirm Password")) return false;
    if (!CheckIfEnglish(theform.txtConfirmPassword.value)) {
        alert("Password should consist of a-z, A-Z and 0-9!");
        theform.txtConfirmPassword.focus();
        theform.txtConfirmPassword.select();
        return false;
    }
    if (theform.txtPassword.value != theform.txtConfirmPassword.value) {
        alert("Your passwords don't match!");
        theform.txtPassword.focus();
        theform.txtPassword.select();
        return false;
    }


    if (theform.txtEmail.value == "") {
        alert("Please enter your E-mail address!");
        theform.txtEmail.focus();
        theform.txtEmail.select();
        return false;
    }

    if (!checkemail(theform.txtEmail.value)) {
        alert("Invalid email!");
        theform.txtEmail.focus();
        theform.txtEmail.select();
        return false;
    }
    if (ValidaterShowInt >= 5) {
        if (theform.txtCheckCode.value == "") {
            alert("Please enter Validation Code!");
            theform.txtCheckCode.focus();
            theform.txtCheckCode.select();
            return false;
        }
    }

   
}
function CheckRegStep1(theform , download_url)
{
	if( typeof(theform.isAgreement)!="undefined" && theform.isAgreement.checked==false )
	{
		alert("In order to continue, you must check the box labeled I Agree.");
		return false;
	}	
	
	
	if (!checkvalue(theform.txtAccount,4,20,32,"Account ID"))	return false;
	if (!CheckIfEnglish4Reg(theform.txtAccount.value))
	{
		alert("Account ID should consist of a-z, A-Z , 0-9 and email!");
		theform.txtAccount.focus();
		theform.txtAccount.select();
		return false;
	}
	
	if(theform.txtAccount.value.indexOf(".") != -1 || theform.txtAccount.value.indexOf("@") != -1 || theform.txtAccount.value.indexOf("_") != -1 || theform.txtAccount.value.indexOf("-") != -1)
	{
		if (!checkemail(theform.txtAccount.value))
		{
			alert("Invalid entry. You can use email or non-email as a game account (only letters, numbers or combination of letters and numbers are valid). Please try again. ");
			theform.txtAccount.focus();
			theform.txtAccount.select();
			return false;
		}
	}

	if (!checkvalue(theform.txtPassword,6,14,32,"Password"))	return false;
	if (!CheckIfEnglish(theform.txtPassword.value))
	{
		alert("Password should consist of a-z, A-Z and 0-9!");
		theform.txtPassword.focus();
		theform.txtPassword.select();
		return false;
	}
	if (!checkvalue(theform.txtConfirmPassword,6,14,32,"Confirm Password"))	return false;
	if (!CheckIfEnglish(theform.txtConfirmPassword.value))
	{
		alert("Password should consist of a-z, A-Z and 0-9!");
		theform.txtConfirmPassword.focus();
		theform.txtConfirmPassword.select();
		return false;
	}	
	if(theform.txtPassword.value!=theform.txtConfirmPassword.value)
	{
		alert("Your passwords don't match!");
		theform.txtPassword.focus();
		theform.txtPassword.select();
		return false;
	}
	
//	if (!checkvalue(theform.txtRealName,0,12,32,"Real Name"))	return false;
	if (!checkvalue(theform.txtEmail,0,40,32,"E-mail Address"))	return false;
	
	if (!checkemail(theform.txtEmail.value))
	{
		alert("Invalid entry. You can use email or non-email as a game account (only letters, numbers or combination of letters and numbers are valid). Please try again. ");
		theform.txtEmail.focus();
		theform.txtEmail.select();
		return false;
	}	 
	
	if (theform.txt_teltphone.value == '')
	{
		alert("Please input Security Code!");
		theform.txt_teltphone.focus();
		theform.txt_teltphone.select();
		return false;	
	}
	if (!isValidLength(theform.txt_teltphone.value,7,16)||!isNumber(theform.txt_teltphone.value)) 
	{
		alert("Security Code should be 8 - 15 characters!");
		theform.txt_teltphone.focus();
		theform.txt_teltphone.select();
		return false;	
	}

	//if(!checkvalue(theform.txtQuestion,2,30,32,"Security Question"))	return false;
	if(!checkvalue(theform.txtAnswer,4,30,32,"Security Answer"))	return false;
	/*if(!checkvalue(theform.txtConfirmAnswer,0,0,1,"Re-type Answer"))	return false;
	if(theform.txtAnswer.value.toLowerCase()!=theform.txtConfirmAnswer.value.toLowerCase())
	{
		alert("Your answers don't match!");
		theform.txtAnswer.focus();
		theform.txtAnswer.select();
		return false;
	}	*/

	//打开下载链接
	var opener = window.open(download_url);
	opener.blur();
	self.focus();
}

function CheckRegStep2(theform)
{
	if (!checkvalue(theform.txt_country,0,16,32,"Residence Country"))	return false;
	if (!checkvalue(theform.txt_teltphone,0,20,32,"Telephone"))	return false;
	if (!checkvalue(theform.txt_zipcode,0,7,32,"Zip Code"))	return false;
	if (!checkvalue(theform.txt_address,0,50,32,"Address"))	return false;
}


function CheckResetPassword(theform)
{
	if (!checkvalue(theform.txtPassword,10,14,32,"Password"))	return false;
	if (!CheckIfEnglish(theform.txtPassword.value))
	{
		alert("Password should consist of a-z, A-Z and 0-9!");
		theform.txtPassword.focus();
		theform.txtPassword.select();
		return false;
	}
	if (!checkvalue(theform.txtCPassword,10,14,32,"Confirm Password"))	return false;
	if (!CheckIfEnglish(theform.txtCPassword.value))
	{
		alert("Password should consist of a-z, A-Z and 0-9!");
		theform.txtCPassword.focus();
		theform.txtCPassword.select();
		return false;
	}	
	if(theform.txtPassword.value!=theform.txtCPassword.value)
	{
		alert("Your passwords don't match!");
		theform.txtPassword.focus();
		theform.txtPassword.select();
		return false;
	}
}
function rediect()
		{
		 
		if(document.getElementById("lblUrl")!=null)
		{
		window.setTimeout("rediectUrl()",10000);
		}	
		}
		 
		function rediectUrl()
		{ 
		window.location.href=document.getElementById("lblUrl").innerHTML;
		}