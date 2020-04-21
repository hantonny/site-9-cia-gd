//++++++++++++++++++++++++++ Mail Section +++++++++++++++++++++++++++

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

function getmyitem(id)
{
	xmlHttp = GetXmlHttpObject();
	xmlHttp.onreadystatechange =function() {		
		if (xmlHttp.readyState == 4) {		
			document.getElementById("myitemdiv").innerHTML=xmlHttp.responseText;
		}
	}
	var myelive_url=document.getElementById("lilive_url").value;
	var url = myelive_url+"index.php?option=com_jeecard&&view=events&task=getmyitem&id="+id;
	xmlHttp.open("GET", url, true);
	xmlHttp.send(null);			
}
