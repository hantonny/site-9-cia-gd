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


function deleteRow1(image,divid)
{
	xmlHttp = GetXmlHttpObject();
	xmlHttp.onreadystatechange =function() {		
		if (xmlHttp.readyState == 4) {
			var temp = xmlHttp.responseText.replace(/^\s+|\s+$/g,"");
			if(temp=="true")
				document.getElementById(divid).style.display="none";
		}
	
	}
	var jelurl=document.getElementById("jelive_url").value;
	var url =jelurl+"administrator/index.php?option=com_jeajaxeventcalendar&view=event_detail&task=unlink2&pname="+image;
	xmlHttp.open("GET", url, true)
	xmlHttp.send(null);			
}

function delete_dailyevent(dailyevent_id) {
	//document.getElementById("eloading_img").style.display="block";
	xmlHttp = GetXmlHttpObject();
	xmlHttp.onreadystatechange =function() {		
		if (xmlHttp.readyState == 4) {
			var temp = xmlHttp.responseText.replace(/^\s+|\s+$/g,"");
			if(temp=="true") {
				//document.getElementById("eloading_img").style.display="none";
				document.getElementById("dailysdate"+dailyevent_id).disabled = true;
				document.getElementById("dailyedate"+dailyevent_id).disabled = true;
				document.getElementById("del_dailydate_div"+dailyevent_id).style.display="none";
			}
		}
	
	}
	var jelurl=document.getElementById("jelive_url").value;
	var url =jelurl+"administrator/index.php?option=com_jeajaxeventcalendar&view=event_detail&task=del_dailyevent&dailyevent_id="+dailyevent_id;
	xmlHttp.open("GET", url, true)
	xmlHttp.send(null);
}