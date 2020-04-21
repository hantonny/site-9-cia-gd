var xmlhttp
Array.prototype.count = function() {
	return this.length;
};


$(document).ready(function() {
	// Initialise the first table (as before)
	$("#table-1").tableDnD();
	// Make a nice striped effect on the table
	$("#table-2 tr:even").addClass("alt");
	// Initialise the second table specifying a dragClass and an onDrop function that will display an alert
	
	
	
	$("#table-2").tableDnD({
	
	
						   
						   
	    onDragClass: "myDragClass",
	    onDrop: function(table, row) {
			
            var rows = table.tBodies[0].rows;
			//var arr[];
            var debugStr="";
            for (var i=0; i<rows.length; i++) {
                debugStr += rows[i].id+"`";
				
				
            }
		 
		
		//alert(t);
	       //$("#debugArea").html(debugStr);
		  	xmlhttp=GetXmlHttpObject();
			if (xmlhttp==null)
 			 {
  				alert ("Your browser does not support XMLHTTP!");
  				return;
  			 }
			 
				var url="index.php?tmpl=component&option=com_jeajaxeventcalendar&view=form_layout&task=update";
				url=url+"&q="+debugStr;
				url=url+"&sid="+Math.random();
				xmlhttp.onreadystatechange=stateChanged;
			
				xmlhttp.open("GET",url,true);
				xmlhttp.send(null); 
	    },
		onDragStart: function(table, row) {
			$("#debugArea").html("Started dragging row "+row.id);
		}
	});

	$('#table-3').tableDnD({
	    onDrop: function(table, row) {
	        alert("Result of $.tableDnD.serialise() is "+$.tableDnD.serialize());
		    $('#AjaxResult').load("/articles/ajaxTest.php?"+$.tableDnD.serialize());
        }
	}); 
	
	$('#table-4').tableDnD(); // no options currently
	
	$('#table-5').tableDnD({
        onDrop: function(table, row) {
            alert($('#table-5').tableDnDSerialize());
        },
        dragHandle: "dragHandle"
    });

    $("#table-5 tr").hover(function() {
          $(this.cells[0]).addClass('showDragHandle');
    }, function() {
          $(this.cells[0]).removeClass('showDragHandle');
    });
    
});

function stateChanged()
{
if (xmlhttp.readyState==4)
  {
   //alert(xmlhttp.responseText);
  }
}

function GetXmlHttpObject()
{
if (window.XMLHttpRequest)
  {
  // code for IE7+, Firefox, Chrome, Opera, Safari
  return new XMLHttpRequest();
  }
if (window.ActiveXObject)
  {
  // code for IE6, IE5
  return new ActiveXObject("Microsoft.XMLHTTP");
  }
return null;
}// JavaScript Document