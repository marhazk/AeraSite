/// <reference path="jquery-1.4.1.min.js" />

var random = 0;
//var checkurl = "https://account.91.com/common/usernamecheck.aspx?info=";
var checkurl = "usernamecheck.aspx?info=";

function getJsonData(para) {
    var ajax = _jsc.ajax.getAjax();
    ajax.open("GET", para, false);
    ajax.send(null);
    try {
        //eval("var s = "+ajax.responseText);
        var s = ajax.responseText;
        return s;
    } catch (e) {
        alert(e.message);
        return null;
    }
}
//regsvr32 scrrun.dll 

var msgs = {

    //帐号相关校验提示信息
    txtAccount_default: 'The "Username" must be at least 4 and 20 characters, using only letters, numbers, or both (case sensitive). You cannot use email address as your account ID.',
    txtAccount_leninvalid: 'The "Username" must be at least 4 and 20 characters, using only letters, numbers, or both (case sensitive). You cannot use email address as your account ID.',
    txtAccount_contentinvalid: 'Account ID should consist of a-z, A-Z , 0-9 and email!',
    txtAccount_noblank: 'The "Username" must be at least 4 and 20 characters, using only letters, numbers, or both (case sensitive). You cannot use email address as your account ID.',
    txtAccount_used: 'This account ID has been taken. Please try again!',
    txtAccount_valid: 'Filled out correctly!',
    //密码校验相关提示信息
    txtPassword_default: '*The password length must be between 6 and 14 characters, using only letters, numbers or both (case sensitive).',
    txtPassword_noblank: 'Password length must be between 6 and 14 characters.',
    txtPassword_leninvalid: 'Password length must be between 6 and 14 characters.',
    txtPassword_contentinvalid: 'Password should consist of a-z, A-Z or 0-9!',
    txtPassword_valid: 'Filled out correctly!',
    //确认密码校验相关提示信息
    txtConfirmPassword_default: '*The password length must be between 6 and 14 characters, using only letters, numbers or both (case sensitive).',
    txtConfirmPassword_noblank: 'Confirm password length must be between 6 and 14 characters.',
    txtConfirmPassword_nocompare: 'Your passwords don\'t match!',
    txtConfirmPassword_valid: 'Filled out correctly!',
    //真实姓名相关校验提示信息
    txtRealName_default: 'The name should no more than 12 characters long!',
    txtRealName_leninvalid: 'The name should no more than 12 characters long!',
    txtRealName_noblank: 'Please enter your name!',
    txtRealName_valid: 'Filled out correctly!',
    //邮箱校验相关提示信息
    txtEmail_default: '* Must be valid!',
    txtEmail_noblank: 'Please enter your e-mail address!',
    txtEmail_leninvalid: 'E-mail Address should be no more than 40 characters!',
    txtEmail_formatinvalid: 'The email address is invalid!',
    txtEmail_valid: 'Filled out correctly!',
    //身份证校验相关提示信息
    txtPaperCard_default: '* Minimum 8 digits',
    txtPaperCard_noblank: 'Please enter your Identification No.!',
    txtPaperCard_leninvalid: 'Identification No. should be 8-15 characters!',
    txtPaperCard_valid: 'Filled out correctly!',
    //确认身份证验证相关提示信息
    txtConfirmPaperCard_default: '* Minimum 8 digits',
    txtConfirmPaperCard_noblank: 'Please enter your Confirm Identification No.!',
    txtConfirmPaperCard_nocompare: 'Your Identification No. don\'t match.',
    txtConfirmPaperCard_valid: 'Filled out correctly!',
    //密保问题相关提示信息
    txtQuestion_default: '* Minimum 2 letters',
    txtQuestion_noblank: 'Please enter your Security Question!',
    txtQuestion_leninvalid: 'Security Question should be 2-30 characters!',
    txtQuestion_valid: 'Filled out correctly!',
    //密保答案相关提示信息
    txtAnswer_default: '* Minimum 4 letters',
    txtAnswer_noblank: 'Please enter your security answer!',
    txtAnswer_leninvalid: 'Security Answer should be 4-30 characters!',
    txtAnswer_valid: 'Filled out correctly!',
    //确认密保答案相关提示信息
    txtConfirmAnswer_default: '* Minimum 4 letters',
    txtConfirmAnswer_noblank: 'Please enter your security answer!',
    txtConfirmAnswer_nocompare: 'Your answers don\'t match!',
    txtConfirmAnswer_valid: 'Filled out correctly!',
    //电话号码相关提示信息
    txt_teltphone_default: '*Only numbers may be used, with a minimum of 8 digits.',
    txt_teltphone_noblank: 'Please enter your Security Code!',
    txt_teltphone_nocompare: 'At least 8 digits are required!',
    txt_teltphone_valid: 'Filled out correctly!'


};

var types = ['text', 'password'];
//var blank_check_excepts = ['txtPaperCard','txtConfirmPaperCard','txtQuestion','txtAnswer','txtConfirmAnswer','txtAccount','txtConfirmPassword','txtPassword','txtRealName','txtEmail','txtConfirmEmail'];
var blank_check_excepts = ['txtAccount', 'txtPassword', 'txtConfirmPassword', 'txtEmail'];

var depends = {
    txtConfirmPassword: 'txtPassword'
};

var valid_reg = Validator.extend({

    valid_txtAccount: function (o) {
        if (o.value.trim().length >= 4 && o.value.trim().length <= 20) {
            $(o.id + '_info').innerHTML = 'Checking...';
            var url = checkurl + o.value + "&checkstatus=0";
            var result = getJsonData(url);

            if (result.trim().length != 0) {
                //alert(result);
                if (result == '0') {
                    this.setDefinedStyle(o, 'leninvalid', 'FailedMsg');
                    this.valid_r &= false;
                    return;
                }
                if (result == '1' || result == '2') {
                    this.setDefinedStyle(o, 'contentinvalid', 'FailedMsg');
                    this.valid_r &= false;
                    return;
                }
                if (result == '4') {
                    this.setDefinedStyle(o, 'used', 'FailedMsg');
                    this.valid_r &= false;
                    return;
                }
                this.setDefinedStyle(o, 'valid', 'SucceedMsg');
                if (jQuery("#txtEmail").val() == "" && checkemail(o.value)) {
                    jQuery("#txtEmail").val(o.value.trim());
                    this.setDefinedStyle(jQuery("#txtEmail")[0], 'valid', 'SucceedMsg');
                }
                this.valid_r &= true;
            }
            else {
                this.setDefinedStyle(o, 'sysbusy', 'FailedMsg');
                this.valid_r &= false;
            }
        }
        else {
            if (o.value.trim().length == 0) {
                this.setDefinedStyle(o, 'noblank', 'FailedMsg');
                this.valid_r &= false;
            }
            else {
                this.setDefinedStyle(o, 'leninvalid', 'FailedMsg');
                this.valid_r &= false;
            }
        }
    },

    valid_txtPassword: function (o) {
        if (o.value.length < 6 || o.value.length > 14) {
            this.setDefinedStyle(o, 'leninvalid', 'FailedMsg');
            this.valid_r &= false;
            return;
        }
        if (!CheckIfEnglish(o.value)) {
            this.setDefinedStyle(o, 'contentinvalid', 'FailedMsg');
            this.valid_r &= false;
            return;
        }
        this.setDefinedStyle(o, 'valid', 'SucceedMsg');
        this.valid_r &= true;
    },
    valid_txtConfirmPassword: function (o) {
        if (o.value == $('txtPassword').value && o.value != '') {
            this.setDefinedStyle(o, 'valid', 'SucceedMsg');
            this.valid_r &= true;
        } else {
            this.setDefinedStyle(o, 'nocompare', 'FailedMsg');
            this.valid_r &= false;
        }
    },

    valid_txtRealName: function (o) {
        if (o.value.trim().length == 0) {
            this.setDefinedStyle(o, 'noblank', 'FailedMsg');
            this.valid_r &= false;
            return;
        }
        else if (o.value.length < 1 || o.value.length > 12) {
            this.setDefinedStyle(o, 'leninvalid', 'FailedMsg');
            this.valid_r &= false;
            return;
        }
        this.setDefinedStyle(o, 'valid', 'SucceedMsg');
        this.valid_r &= true;
    },

    valid_txtEmail: function (o) {
        if (o.value.length < 1 || o.value.length > 40) {
            this.setDefinedStyle(o, 'leninvalid', 'FailedMsg');
            this.valid_r &= false;
            return;
        }
        if (!checkemail(o.value)) {
            this.setDefinedStyle(o, 'formatinvalid', 'FailedMsg');
            this.valid_r &= false;
            return;
        }
        this.setDefinedStyle(o, 'valid', 'SucceedMsg');
        this.valid_r &= true;
    },

    valid_txtAnswer: function (o) {
        if (o.value.length < 4 || o.value.length > 30) {
            this.setDefinedStyle(o, 'leninvalid', 'FailedMsg');
            this.valid_r &= false;
            return;
        }
        this.setDefinedStyle(o, 'valid', 'SucceedMsg');
        this.valid_r &= true;
    },
    valid_txtConfirmAnswer: function (o) {
        if (o.value == $('txtAnswer').value && o.value != '') {
            this.setDefinedStyle(o, 'valid', 'SucceedMsg');
            this.valid_r &= true;
        } else {
            this.setDefinedStyle(o, 'nocompare', 'FailedMsg');
            this.valid_r &= false;
        }
    },
    valid_txt_teltphone: function (o) {
        if (o.value != '' && isValidLength(o.value, 7, 16) && isNumber(o.value)) {
            this.setDefinedStyle(o, 'valid', 'SucceedMsg');
            this.valid_r &= true;
        } else {
            this.setDefinedStyle(o, 'nocompare', 'FailedMsg');
            this.valid_r &= false;
        }
    }

});

var valid = new valid_reg('Form1', 'Form1', msgs, types, blank_check_excepts, depends);