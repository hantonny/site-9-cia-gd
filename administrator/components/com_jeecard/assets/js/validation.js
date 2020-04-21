
var JSONstring;
var request;
var user_valid=1;
var email_valid=1;
function getHTTPObject()
{
	var xhr = false;
	if (window.XMLHttpRequest)
	{
		xhr = new XMLHttpRequest();
	} else if (window.ActiveXObject) {
		try
		{
			xhr = new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch(e)
		{
			try
			{
				xhr = new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(e)
			{
				xhr = false;
			}
		}
	}
	return xhr;
}
function select_register_as(value)
{
	if(value==0){
	document.getElementById('company_field').style.display="none";
	document.getElementById('customer_field').style.display="block";
	}if(value==1){
	document.getElementById('customer_field').style.display="none";
	document.getElementById('company_field').style.display="block";
	}

}
function select_dynamic_field(tpl_id,pr_id,section)
{
	if(tpl_id==0)
	{
		document.getElementById('dynamic_field').innerHTML="";
		return false;
	}

	var form = document.forms['adminForm'];
	
	var JSONObject = new Object;	
	 
	JSONObject.template_id = tpl_id;	
	JSONObject.product_id = pr_id;
	JSONObject.section = section;
	JSONstring = JSON.stringify(JSONObject);
	 
	request = getHTTPObject();
	request.onreadystatechange = templateData;
	request.open("GET", "index.php?option=com_redshop&view=product&task=template&json="+JSONstring, true);
	request.send(null);
}

function templateData()
{

	if(request.readyState == 4)
	{
		var JSONtext = request.responseText;
		 
		var JSONobject = JSON.parse(JSONtext);
		
		document.getElementById('dynamic_field').innerHTML=JSONobject.data_product;
		
		window.addEvent('domready', function(){ var JTooltips = new Tips($$('.hasTip'), { maxTitleChars: 50, fixed: false}); });
		 
		///

		///////
	}
}
/*function loadScript()
{
	scriptURL = "http://localhost/redshop/plugins/editors/tinymce/jscripts/tiny_mce/tiny_mce.js";
	alert(scriptURL);
	var newScript = document.createElement("script");
	newScript.src = scriptURL;
	
	document.body.appendChild(newScript);
}*/

function validate(ind)
{
	var form = document.forms['adminForm'];
	
	var JSONObject = new Object;
	
	JSONObject.ind = ind;
	JSONObject.username = form['username'].value;	
	JSONObject.email = form['email'].value;
	
	if(JSONObject.username == ''){		
		user_valid=0;		
		document.getElementById('user_valid').style.color = "red";
		document.getElementById('user_valid').innerHTML = 'User Field can\'t be blank';
		return false;
	}
	 
	if(ind==2 && user_valid==1)
	{
		if(JSONObject.email == ''){
			email_valid=0;
			document.getElementById('email_valid').style.color = "red";
			document.getElementById('email_valid').innerHTML = 'E-mail Field can\'t be blank';
			return false;
		}
	}
	 
	var temp=validateemail(form['email']);	if(temp==false) return false; 
	
	JSONstring = JSON.stringify(JSONObject);
	
	request = getHTTPObject();
	request.onreadystatechange = sendData;
	request.open("GET", "index.php?option=com_redshop&view=user_detail&task=validation&json="+JSONstring, true);
	request.send(null);
}

// function is executed when var request state changes
function sendData()
{
	// if request object received response
	if(request.readyState == 4)
	{
		
		// controller response
		var JSONtext = request.responseText;
		
		// convert received string to JavaScript object
		var JSONobject = JSON.parse(JSONtext);
		 
		// notice how variables are used
		if(JSONobject.ind == 1){
			
			if(JSONobject.username == 1){
				user_valid=0;	
				document.getElementById('user_valid').style.color = "red";
				document.getElementById('user_valid').innerHTML = 'User already exist';
			}else{ user_valid=1;	
				document.getElementById('user_valid').style.color = "green";
				document.getElementById('user_valid').innerHTML = 'Username is available';
			}
		}
		else{
			
			if(JSONobject.email == 1){ email_valid=0;
				document.getElementById('email_valid').style.color = "red";
				document.getElementById('email_valid').innerHTML = 'Email already exist';
			}else{ email_valid=1;
				document.getElementById('email_valid').style.color = "green";
				document.getElementById('email_valid').innerHTML = 'Email is available';
			}
		}
	}

}



function checkmail(email)
{
// a very simple email validation checking. 
/* you can add more complex email checking if it helps */
    if(email.length <= 0)
	{
	  return true;
	}
    var splitted = email.match("^(.+)@(.+)$");
    if(splitted == null) return false;
    if(splitted[1] != null )
    {
      var regexp_user=/^\"?[\w-_\.]*\"?$/;
      if(splitted[1].match(regexp_user) == null) return false;
    }
    if(splitted[2] != null)
    {
      var regexp_domain=/^[\w-\.]*\.[A-Za-z]{2,4}$/;
      if(splitted[2].match(regexp_domain) == null) 
      {
	    var regexp_ip =/^\[\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}\]$/;
	    if(splitted[2].match(regexp_ip) == null) return false;
      }// if
      return true;
    }
return false; 
}
function validateemail(o)
{
	var strError;
	email=o.value;
			   if(!checkmail(email)) 
               { 
                 if(!strError || strError.length ==0) 
                 { 
                    strError ="Enter valid Email address "; 
                 }//if                                               
                 document.getElementById('email_valid').innerHTML = strError;
                 return false; 
               }
}

//******************************** Mail Section Select ******************


function mail_select(str)
{		
	var form = document.forms['adminForm'];
	
	var val = form.mail_section.value;
	
	var please = form.please.value;

	if(val != 'order'){
		
		document.getElementById("order_state_edit").style.display="none";
		document.getElementById("order_state").style.display="none";
		return false;
	}
	if(val == '0' ){
		alert(please);
		return true;	
	}
	
	var JSONObject = new Object;	
	 
	JSONObject.mail_order_status = form.mail_section.value;
	
	JSONstring = JSON.stringify(JSONObject);
	
	request = getHTTPObject();
	request.onreadystatechange = mail_order_status;
	request.open("GET", "index3.php?option=com_redshop&view=mail_detail&task=mail_section&json="+JSONstring, true);
	request.send(null);
}
function mail_order_status(){
	
	
	if(request.readyState == 4)
	{
		var JSONtext = request.responseText;
		 
		var JSONobject = JSON.parse(JSONtext);
		
		document.getElementById('responce').innerHTML=JSONobject.order_statusHtml;
		try
		 {
			document.getElementById("order_state").style.display="table-row";
			document.getElementById("order_state_edit").style.display="none";
		 }
		catch(ex)
		{
			document.getElementById("order_state").style.display="block";
			document.getElementById("order_state_edit").style.display="none";
		}
	}
}
/* Catalog colour added  */
var f=0;
function addNewcolor(tableRef){
	
	var ccode=document.getElementById("color_code_1").value;
	if(ccode=="")
	{
		var cat_img=document.getElementById("catalog_image").value;
	}
	var g=parseInt(document.getElementById("total_extra").value) + parseInt(f);	
	var myTable = document.getElementById(tableRef);
	var tBody = myTable.getElementsByTagName('tbody')[0];
	var newTR = document.createElement('tr');
	var newTD = document.createElement('td');
	var newTD1 = document.createElement('td');
	if(ccode!="")
	{
	is_img=0;
	code_img=document.getElementById("color_code_1").value;
	newTD.innerHTML = '<div style=" width:100px:height:100px;background-color:'+code_img+'">&nbsp;</div>';
	}
	else
	{
	is_img=1;
	code_img=document.getElementById("catalog_image").value;
	newTD.innerHTML = document.getElementById("image_dis").innerHTML;
	}
	
	newTD1.innerHTML = '<input type="hidden" name="colour_id[]" id="colour_id[]">  <input value="Delete" onclick="deletecolor(this)" class="button" type="button" />';
	newTD1.innerHTML += '<input type="hidden" value="'+code_img+'" name="code_image[]"  id="code_image[]"><input type="hidden" name="is_image[]" value="'+is_img+'" id="is_image[]">';
	newTR.appendChild (newTD);
	newTR.appendChild (newTD1);	
	tBody.appendChild(newTR);
	document.getElementById("color_code_1").value="";
	document.getElementById("catalog_image").value="";
	document.getElementById("image_display").src="";
	f++;
	}
function deletecolor(r) {
	 
	var i=r.parentNode.parentNode.rowIndex;
	document.getElementById('extra_table').deleteRow(i);
	 
	}
