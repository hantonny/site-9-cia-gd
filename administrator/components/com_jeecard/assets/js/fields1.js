function field_select(value)
{
	//alert("HI HELLO");
//	return false;
/*
 * field_type 	=   1 :- Text Field
 * 					2 :- Text Area
 * 					3 :- Check Box
 * 					4 :- Radio Button
 * 					5 :- Select Box (Single select)
 * 					6 :- Select Box (Multiple select) 
 * 					7 :- Select country box
 * 					8 :- Wysiwyg
 * 					9 :- File
 * 				   10 :- HR Tag
 * 				   11 :- Label
 * 				   12 :- Date
 * 				   13 :- Password
 */
	if(value==5  || value==6 )		// 5 :- Select Box (Single select)	6 :- Select Box (Multiple select)
	{
			
		document.getElementById("field_data").style.display="block";
		document.getElementById("field_textarea").style.display="none";
		document.getElementById("field_radio").style.display="none";
		
	}
	else if(value==2)	// 2 :- Text Area
	{
		document.getElementById("field_textarea").style.display="block";
		document.getElementById("field_radio").style.display="none";
		document.getElementById("field_maxlength").style.display="none";
	}
	else if(value==1 || value==13)	// 1 :- Text Field 	13 :- Password
	{
		document.getElementById("field_maxlength").style.display="block";
		document.getElementById("field_textarea").style.display="none";
		document.getElementById("field_radio").style.display="none";
	}
	else if(value==4 || value==3 )	// 3 :- Check Box	4 :- Radio Button
	{
		document.getElementById("field_radio").style.display="block";
		document.getElementById("field_data").style.display="block";
		
	}
	else if(value==11)
	{
			
		document.getElementById("field_label").style.display="block";
		document.getElementById("field_data").style.display="none";
		document.getElementById("field_radio").style.display="none";
		document.getElementById("field_textarea").style.display="none";
		document.getElementById("field_maxlength").style.display="none";	
	}
	else
	{
		document.getElementById("field_data").style.display="none";
		document.getElementById("field_radio").style.display="none";
		document.getElementById("field_textarea").style.display="none";
		document.getElementById("field_maxlength").style.display="none";
	}
	
	
}

var f=1;
function addNewRow(tableRef){	
	var g		= parseInt(document.getElementById("total_extra").value) + parseInt(f);	
	var myTable = document.getElementById(tableRef);
	var tBody 	= myTable.getElementsByTagName('tbody')[0];
	var newTR 	= document.createElement('tr');
	var newTD 	= document.createElement('td');
	/*var newTD1 = document.createElement('td');*/
	newTD.innerHTML = '<input type="file" name="extra_name[]" value="field_temp_opt_'+g+'" id="extra_name[]"><input type="radio" name="mainphoto" id="mainphoto" value="'+g+'" /> Mainphoto &nbsp;&nbsp;&nbsp;<input type="hidden" name="value_id[]" id="value_id[]">  <input value="Delete" onclick="deleteRow(this)" class="button" type="button" />';
	newTR.appendChild (newTD);
	/*newTR.appendChild (newTD1);*/
	tBody.appendChild(newTR);
	f++;
	//alert(newTD);
	}

function deleteRow(r) {
	if(window.confirm("Are you sure you want to delete field value?"))
	{
		var i=r.parentNode.parentNode.rowIndex;
		document.getElementById('extra_table').deleteRow(i);
	}
}



function addNewRow1(tableRef){	

	
	var g=parseInt(document.getElementById("total_extra_data").value) + parseInt(f);	
	
	var myTable = document.getElementById(tableRef);
	var tBody = myTable.getElementsByTagName('tbody')[0];
	var newTR = document.createElement('tr');
	var newTD = document.createElement('td');
	var newTD1 = document.createElement('td');
	newTD.innerHTML = '<input type="text" name="extra[]">';
	newTD1.innerHTML = '<input type="hidden" name="value[]" id="value[]">  <input value="Delete" onclick="deleteRow3(this)" class="button" type="button" />';
	newTR.appendChild (newTD);
	newTR.appendChild (newTD1);
	tBody.appendChild(newTR);
	f++;
	
	}
function deleteRow3(r) {
	//alert(r);
	if(window.confirm("Are you sure you want to delete field value?"))
	{
	var i=r.parentNode.parentNode.rowIndex;
	document.getElementById('extra').deleteRow(i);
	}
	}


var x=1;
function addNewDateRow(tableRef){
	var g=parseInt(document.getElementById("total_extra").value) + parseInt(f);	
	var myTable = document.getElementById(tableRef);
	var tBody 	= myTable.getElementsByTagName('tbody')[0];
	var newTR 	= document.createElement('tr');
	var newTD 	= document.createElement('td');
	var newTD1 	= document.createElement('td');
	var mysdate	= document.getElementById('daily_sdate').value;
	var myedate	= document.getElementById('daily_edate').value;
	
	if(mysdate=="") {
		alert("Please select date from date picker");
		return false;
	}
	
	newTD.innerHTML = '<input type="text" name="dailysdate[]" value="'+mysdate+'" id="dailysdate[]">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="dailyedate[]" value="'+myedate+'" id="dailyedate[]">&nbsp<input value="Delete" onclick="deleteDateRow(this)" class="button" type="button" />';
	newTR.appendChild (newTD);
	newTR.appendChild (newTD1);
	tBody.appendChild(newTR);
	x++;
	document.getElementById('daily_sdate').value = '';
	document.getElementById('daily_edate').value = '';
}

function deleteDateRow(r) {
	if(window.confirm("Are you sure you want to delete field value?"))
	{
		var i=r.parentNode.parentNode.rowIndex;
		document.getElementById('extradate_table').deleteRow(i);
	}
}


function select_repeat(roption) {
	if(roption==4) {
		document.getElementById('dialyevent_div').style.display="block";
		document.getElementById('norepeat_div').style.display="none";
	} else {
		document.getElementById('dialyevent_div').style.display="none";
		document.getElementById('norepeat_div').style.display="block";
	}
	
}