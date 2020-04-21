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
function cap_refresh()
{
	//document.getElementById("default_cap_div").style.display='none';	
	xmlHttp = GetXmlHttpObject();
	xmlHttp.onreadystatechange =function() {		
		if (xmlHttp.readyState == 4) {
			
			document.getElementById("default_cap_div").innerHTML=xmlHttp.responseText;
		}
	}	
	var url = "index.php?tmpl=component&option=com_jeecard&&view=register&task=refresh_captchacr&tmpl=component";
	xmlHttp.open("GET", url, true)
	xmlHttp.send(null);			
}