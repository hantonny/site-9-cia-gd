var xmlHttp
//******************************** Check Browser Compability******************
function GetXmlHttpObject()
{
	
var xmlHttp=null;
try
 {
 // Firefox, Opera 8.0+, Safari
 xmlHttp=new XMLHttpRequest();
 }
catch (e)
 {
 //Internet Explorer
 try
  {
  xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
  }
 catch (e)
  {
  xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
 }
return xmlHttp;
}
//******************************** Mail Section Select ******************
function get_guestlist(){
	var myguest = document.getElementById("extra_table").innerHTML;
	
	xmlHttp = GetXmlHttpObject();
	xmlHttp.onreadystatechange =function() {		
		if (xmlHttp.readyState == 4) {			//alert(xmlHttp.responseText);
			//document.getElementById("md_guest").innerHTML=xmlHttp.responseText;
			/*if(stateid)			
			  document.getElementById("state_id").value=stateid;
			  */
		}
	}	
	var jelurl=document.getElementById("jelive_url").value;
	var url = jelurl+"index.php?&option=com_jeecard&view=events&task=get_guset&myguestlist="+ myguest;
	//alert(url);
	xmlHttp.open("GET", url, true)
	xmlHttp.send(null);	
}

var f=1;
function addtolist(tableRef){


var str = document.getElementById("add_manullay").value;
var email_array = str.split(',');

for(var k=0;k<email_array.length;k++)
{
		var a = email_array[k].split("@");
		if(check_emailvalid(email_array[k])== false){
			return false;	
      	}
	var g=parseInt(document.getElementById("total_extra").value) + parseInt(f);	
	var myTable = document.getElementById(tableRef);
	var tBody1 = myTable.getElementsByTagName('tbody')[0];
	var newTR = document.createElement('tr');
	var newTD = document.createElement('td');
	var newTD1 = document.createElement('td');
	var newTD2 = document.createElement('td');
	newTD.innerHTML = a[0];
	newTD1.innerHTML = email_array[k];
	
	newTD2.innerHTML = '<input type="hidden" name="my_name[]" id="my_name[]" value="'+a[0]+'"><input type="hidden" name="my_email[]" id="my_email[]" value="'+email_array[k]+'"><input value="Delete" onclick="deleteRow2(this)" class="button" type="button" />';
	newTR.appendChild (newTD);
	newTR.appendChild (newTD1);
	newTR.appendChild (newTD2);
	tBody1.appendChild(newTR);
	f++;
	}
	document.getElementById("add_manullay").value = '';	
}
	function deleteRow2(r) {
	//alert(r);
	if(window.confirm("Are you sure you want to delete field value?"))
	{
	var i=r.parentNode.parentNode.rowIndex;
	document.getElementById('extra_table').deleteRow(i);
	}
	}

function add_secondlist(tableRef){
var mychk_list = document.getElementsByName('cid[]');
for (var  m = 0; m < mychk_list.length; m++) 
	{  	 if(mychk_list[m].checked)
		 { 
				str = mychk_list[m].value;
				var mychkname = document.getElementById('chk_name'+[m]).value;
				var mychkemail =document.getElementById('chk_email'+[m]).value;
				var str = mychkemail;
				if(check_emailvalid(str)== false){
				return false;	
				}
				var g=parseInt(document.getElementById("total_extra").value) + parseInt(f);	
				var myTable = document.getElementById(tableRef);
				var tBody1 = myTable.getElementsByTagName('tbody')[0];
				var newTR = document.createElement('tr');
				var newTD = document.createElement('td');
				var newTD1 = document.createElement('td');
				var newTD2 = document.createElement('td');
				newTD.innerHTML = mychkname;
				newTD1.innerHTML = mychkemail;
				newTD2.innerHTML = '<input type="hidden" name="my_name[]" id="my_name[]" value="'+mychkname+'"><input type="hidden" name="my_email[]" id="my_email[]" value="'+mychkemail+'"><input value="Delete" onclick="deleteRow2(this)" class="button" type="button" />';
				newTR.appendChild (newTD);
				newTR.appendChild (newTD1);
				newTR.appendChild (newTD2);
				tBody1.appendChild(newTR);
				f++;
	 	}
    } 
}

function check_emailvalid(str){

		  			var at="@"
		var dot="."
		var lat=str.indexOf(at)
		var lstr=str.length
		var ldot=str.indexOf(dot)
		if (str.indexOf(at)==-1){
		   alert(valid_email)
		   return false
		}if (str.indexOf(at)==-1 || str.indexOf(at)==0 || str.indexOf(at)==lstr){
		   alert(valid_email)
		   return false
		}if (str.indexOf(dot)==-1 || str.indexOf(dot)==0 || str.indexOf(dot)==lstr){
		    alert(valid_email)
		    return false
		}if (str.indexOf(at,(lat+1))!=-1){
		    alert(valid_email)
		    return false
		 }if (str.substring(lat-1,lat)==dot || str.substring(lat+1,lat+2)==dot){
		    alert(valid_email)
		    return false
		 }if (str.indexOf(dot,(lat+2))==-1){
		    alert(valid_email)
		    return false
		 }if (str.indexOf(" ")!=-1){
		    alert(valid_email)
		    return false
		 }
		  return true 
}
var checked = false;
function checkAll2 () {
        if (checked == false){checked = true}
		else{checked = false}
	for (var c = 0; c < document.getElementById("adminForm").elements.length; c++) {
		
	  document.getElementById("adminForm").elements[c].checked = checked;
	}
      }
function add_thordlist(tableRef){
var mychk_list = document.getElementsByName('checkID[]');
for (var  m = 0; m < mychk_list.length; m++) 
	{  	 if(mychk_list[m].checked)
		 { 
				str = mychk_list[m].value;
			//	var mychkname = document.getElementById('chk_name1'+[m]).value;
				var mychkemail =document.getElementById('chk_email1'+[m]).value;
				var str = mychkemail;
				if(check_emailvalid(str)== false){
				return false;	
				}
				var g=parseInt(document.getElementById("total_extra").value) + parseInt(f);	
				var myTable = document.getElementById(tableRef);
				var tBody1 = myTable.getElementsByTagName('tbody')[0];
				var newTR = document.createElement('tr');
				var newTD = document.createElement('td');
				var newTD1 = document.createElement('td');
				var newTD2 = document.createElement('td');
				var mychkname = mychkemail.split("@");
		 
				newTD.innerHTML = mychkname[0];
				newTD1.innerHTML = mychkemail;
				newTD2.innerHTML = '<input type="hidden" name="my_name[]" id="my_name[]" value="'+mychkname+'"><input type="hidden" name="my_email[]" id="my_email[]" value="'+mychkemail+'"> <input value="Delete" onclick="deleteRow2(this)" class="button" type="button" />';
				newTR.appendChild (newTD);
				newTR.appendChild (newTD1);
				newTR.appendChild (newTD2);
				tBody1.appendChild(newTR);
				f++;
	 	}
    } }
	function choose_style(cid){
		
	xmlHttp = GetXmlHttpObject();
	xmlHttp.onreadystatechange =function() {		
		if (xmlHttp.readyState == 4) {			//alert(xmlHttp.responseText);
			document.getElementById("md_style_mydiv").innerHTML=xmlHttp.responseText;
			/*if(stateid)			
				document.getElementById("state_id").value=stateid;
				*/
			
		}
	}	
	var jelurl=document.getElementById("jelive_url").value;
	var url = jelurl+"index.php?tmpl=component&option=com_jeecard&view=events&task=getStyledata&id="+ cid;
	
	xmlHttp.open("GET", url, true)
	xmlHttp.send(null);			
}