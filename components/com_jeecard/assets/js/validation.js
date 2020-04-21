//=========E-Mail Validation Code========//
function echeck(str) {
		var at="@"
		var dot="."
		var lat=str.indexOf(at)
		var lstr=str.length
		var ldot=str.indexOf(dot)
		if (str.indexOf(at)==-1){
		   document.getElementById('email_span').innerHTML = '<br />'+valid_email;
		   return false;
		}if (str.indexOf(at)==-1 || str.indexOf(at)==0 || str.indexOf(at)==lstr){
		   document.getElementById('email_span').innerHTML = '<br />'+valid_email;
		   return false;
		}if (str.indexOf(dot)==-1 || str.indexOf(dot)==0 || str.indexOf(dot)==lstr){
		    document.getElementById('email_span').innerHTML = '<br />'+valid_email;
		    return false;
		}if (str.indexOf(at,(lat+1))!=-1){
		    document.getElementById('email_span').innerHTML = '<br />'+valid_email;
		    return false;
		 }if (str.substring(lat-1,lat)==dot || str.substring(lat+1,lat+2)==dot){
		    document.getElementById('email_span').innerHTML = '<br />'+valid_email;
		    return false;
		 }if (str.indexOf(dot,(lat+2))==-1){
		    document.getElementById('email_span').innerHTML = '<br />'+valid_email;
		    return false;
		 }if (str.indexOf(" ")!=-1){
		    document.getElementById('email_span').innerHTML = '<br />'+valid_email;
		    return false;
		 }return true;					
}
function registerform_valid(){
	var form = document.registerform;
	
	document.getElementById('flname_span').innerHTML 	= '';
	document.getElementById('lname_span').innerHTML 	= '';
	document.getElementById('email_span').innerHTML 	= '';
	document.getElementById('con_email_span').innerHTML = '';
	document.getElementById('pass_span').innerHTML 		= '';
	document.getElementById('genter_span').innerHTML 	= '';
	
	
	if(form.fname.value == ''){
		document.getElementById('flname_span').innerHTML = '<br />'+fname_alert;
		form.fname.focus();
		return false;
	}else if(form.lname.value == ''){
		document.getElementById('lname_span').innerHTML = '<br />'+lname_alert;
		form.lname.focus();
		return false;
	}else if(form.email.value == ''){
		document.getElementById('email_span').innerHTML = '<br />'+email_alert;
		form.email.focus();
		return false;
	}else if ( echeck(form.email.value) ==false ) {
		form.email.value = '';
		form.email.focus();
		return false;	
    }else if(form.email2.value == ''){
		document.getElementById('con_email_span').innerHTML = '<br />'+email_alert;
		form.email2.focus();
		return false;
	}else if ( form.email.value!= form.email2.value ) {
			document.getElementById('con_email_span').innerHTML = '<br />'+con_email_alert;
		form.email2.focus();
			return false;
	}else if(form.password.value == ''){
		document.getElementById('pass_span').innerHTML = '<br />'+pass_alert;
		form.password.focus();
		return false;
	}else if(form.password.value.length < 6){
		document.getElementById('pass_span').innerHTML = '<br />'+valid_pass_alert;
		form.password.focus();
		return false;
	}else if (form.sex.value == ''){
		document.getElementById('genter_span').innerHTML = '<br />'+genter_alert;
		form.sex.focus();
		return false;
	}return true;
}
