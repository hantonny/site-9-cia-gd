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
		document.getElementById("field_label").style.display="none";
		
	}
	else if(value==2)	// 2 :- Text Area
	{
		document.getElementById("field_textarea").style.display="block";
		document.getElementById("field_radio").style.display="none";
		document.getElementById("field_maxlength").style.display="none";
		document.getElementById("field_label").style.display="none";
	}
	else if(value==1 || value==13)	// 1 :- Text Field 	13 :- Password
	{
		document.getElementById("field_maxlength").style.display="block";
		document.getElementById("field_textarea").style.display="none";
		document.getElementById("field_radio").style.display="none";
		document.getElementById("field_label").style.display="none";
	}
	else if(value==4 || value==3 )	// 3 :- Check Box	4 :- Radio Button
	{
		document.getElementById("field_radio").style.display="block";
		document.getElementById("field_data").style.display="block";
		document.getElementById("field_label").style.display="none";
		document.getElementById("field_textarea").style.display="none";
		
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
		document.getElementById("field_label").style.display="none";
	}
	
	
}



var f=1;
function addNewRow(tableRef){	
	var g=parseInt(document.getElementById("total_extra").value) + parseInt(f);	
	var myTable = document.getElementById(tableRef);
	var tBody = myTable.getElementsByTagName('tbody')[0];
	var newTR = document.createElement('tr');
	var newTD = document.createElement('td');
	var newTD1 = document.createElement('td');
	newTD.innerHTML = '<input type="text" name="extra_name[]" value="field_temp_opt_'+g+'" id="extra_name[]">';
	newTD1.innerHTML = '<input type="text" name="extra_value[]" value="" id="extra_value[]">&nbsp;<input type="hidden" name="value_id[]" id="value_id[]">  <input value="Delete" onclick="deleteRow(this)" class="button" type="button" />';
	newTR.appendChild (newTD);
	newTR.appendChild (newTD1);
	tBody.appendChild(newTR);
	f++;
	}

function create_table_data(data,volume,id){ 
	name=data;	
	
	var g=parseInt(document.getElementById("total_extra").value) + parseInt(f);	
	var myTable = document.getElementById('container_table');
	var tBody = myTable.getElementsByTagName('tbody')[0];
	var newTR = document.createElement('tr');
	
	var newTD1 = document.createElement('td');
	var newTD2 = document.createElement('td');
	var newTD3 = document.createElement('td');
	var newTD4 = document.createElement('td');
	
	newTD1.innerHTML = name;
	newTD2.innerHTML = '<input size="5" type="text" name="quantity[]" value="1" id="quantity[]"><input type="hidden" name="container_product[]" value="'+id+'" id="container_product[]">';
	newTD3.innerHTML = '<div align="center">'+volume+'</div>';
	newTD4.innerHTML = "<input value=\"X\" onclick=\"javascript:deleteRow_container(this);\" class=\"button\" type=\"button\" />"; 
	
	newTR.appendChild (newTD1);
	newTR.appendChild (newTD2);
	newTR.appendChild (newTD3);
	newTR.appendChild (newTD4);
	tBody.appendChild(newTR);
	f++;
}
function create_table_accessory(data,id){ 
	name=data;		
	var g=parseInt(document.getElementById("total_accessory").value) + parseInt(f);	
	var myTable = document.getElementById('accessory_table');
	var tBody = myTable.getElementsByTagName('tbody')[0];
	var newTR = document.createElement('tr');
	
	var newTD1 = document.createElement('td');
	var newTD2 = document.createElement('td');
	var newTD3 = document.createElement('td');
		
	newTD1.innerHTML = name;
	newTD2.innerHTML = '<input size="5" type="text" name="accessory_price[]" value="1" id="accessory_price[]"><input type="hidden" name="accessory_product[]" value="'+id+'" id="accessory_product[]">';
	newTD3.innerHTML = "<input value=\"X\" onclick=\"javascript:deleteRow_accessory(this);\" class=\"button\" type=\"button\" />"; 
	
	newTR.appendChild (newTD1);
	newTR.appendChild (newTD2);
	newTR.appendChild (newTD3);
	tBody.appendChild(newTR);
	f++;
}
function deleteRow(r) {
	if(window.confirm("Are you sure you want to delete field value?"))
	{
	var i=r.parentNode.parentNode.rowIndex;
	document.getElementById('extra_table').deleteRow(i);
	}
	}

var gh=1;

function addNewRow_attribute(tableRef){	
	//var g=parseInt(document.getElementById("attribute_table").value) + parseInt(gh);
	 
	if(gh == 1)
		gh=document.getElementById("total_table").value;		
	
	var tit=document.getElementById("atitle").innerHTML;
	var prop=document.getElementById("aproperty").innerHTML;
	var pri=document.getElementById("aprice").innerHTML;
	var new_attrib=document.getElementById("new_attribute").innerHTML;
	var delete_attri =document.getElementById("delete_attribute").innerHTML;
	var new_prop=document.getElementById("new_property").innerHTML;
	var img=document.getElementById("aimage").innerHTML;
	
	var myTable = document.getElementById(tableRef);
	var tBody = myTable.getElementsByTagName('tbody')[0];
	var newTR = document.createElement('tr');
	var newTD = document.createElement('td');
	var newTD1 = document.createElement('td');
	
	newTD.innerHTML = tit;
	table_pr="property_table"+gh;
	newTD1.innerHTML = "<input type='hidden' class='text_area' size='55' value='0' name='attribute_id["+gh+"][id]' ><input type='text' class='text_area' size='55' name='title["+gh+"][name]' >&nbsp;<a href=\"javascript:addNewRow_attribute('"+tableRef+"')\">"+new_attrib+"</a>&nbsp; | &nbsp;<a href=\"javascript:addproperty('"+table_pr+"','"+gh+"')\">"+new_prop+"</a>&nbsp;&nbsp;<input value='"+delete_attri+"' onclick=\"javascript:deleteRow_attribute(this,'"+tableRef+"','"+table_pr+"')\" class='button' type='button' /> ";
	
	newTR.appendChild (newTD);
	newTR.appendChild (newTD1);
	tBody.appendChild(newTR);
	
	var newTR1 = document.createElement('tr');
	var newTD = document.createElement('td');
	var newTD1 = document.createElement('td');
	
	newTD.innerHTML = "";
	newTD1.innerHTML = '<table  class="adminform" cellpadding="2" width="100%" border="1" cellspacing="2" id="property_table'+gh+'"><tr><td>'+prop+'</td><td><input type="text" class="text_area" size="40" name="property['+gh+'][value][]" ><td>'+pri+'</td><td><input type="text" class="text_area" size="2" name="oprand['+gh+'][value][]" id="oprand'+gh+'0" style="text-align: center;" maxlength="1" value="+" onchange="javascript:oprand_check(this);" ></td><td><input type="text" class="text_area" size="12" name="price['+gh+'][value][]" id="price" ></td><td>'+img+' <input type="file" class="text_area" size="12" name="image['+gh+'][value][]"  /><input type="hidden" class="text_area" size="12" name="imagetmp['+gh+'][value][]"  /><input type="hidden" name="property_id['+gh+'][value][]" value="0" ></td></tr><table>';
	
	newTR1.appendChild (newTD);
	newTR1.appendChild (newTD1);
	tBody.appendChild(newTR1);
//	
	//addproperty(table_pr,gh);
	gh++;
	}

var h=1;
function addproperty(tableRef,rh){	
  
	if(h == 1)		
		h=document.getElementById("total_g").value;
	
	
	var prop=document.getElementById("aproperty").innerHTML;
	var pri=document.getElementById("aprice").innerHTML;
	var new_attrib=document.getElementById("new_attribute").innerHTML;
	var delete_attri =document.getElementById("delete_attribute").innerHTML;
	var new_prop=document.getElementById("new_property").innerHTML;
	var img=document.getElementById("aimage").innerHTML;
	
	var myTable = document.getElementById(tableRef);
	var tBody = myTable.getElementsByTagName('tbody')[0];
	var newTR = document.createElement('tr');
	
	var newTD = document.createElement('td');
	var newTD1 = document.createElement('td');
	var newTD2 = document.createElement('td');
	var newTD3 = document.createElement('td');
	var newTD4 = document.createElement('td');
	var newTD5 = document.createElement('td');
	
	newTD.innerHTML = prop;
	newTD1.innerHTML ='<input type="text" class="text_area" size="40" name="property['+rh+'][value][]" ><input type="hidden" name="property_id['+rh+'][value][]" value="0" >';
	newTD2.innerHTML = pri;
	newTD3.innerHTML = '<input type="text" class="text_area" size="12" name="price['+rh+'][value][]"  > ';
	newTD5.innerHTML = '<input type="text" class="text_area" size="2" name="oprand['+rh+'][value][]" style="text-align: center;" id="oprand'+rh+h+'" value="+" maxlength="1" onchange="javascript:oprand_check(this);" > ';
	newTD4.innerHTML = img+'<input type="hidden" class="text_area" size="12" name="imagetmp['+rh+'][value][]"  /><input type="file" class="text_area" size="12" name="image['+rh+'][value][]"  > '+"&nbsp;<input value='X' onclick=\"javascript:deleteRow_property(this,'"+tableRef+"')\" class='button' type='button' /> ";
	
	
	newTR.appendChild (newTD);
	newTR.appendChild (newTD1);
	newTR.appendChild (newTD2);
	newTR.appendChild (newTD5);
	newTR.appendChild (newTD3);	
	newTR.appendChild (newTD4);
	tBody.appendChild(newTR);
	
	h++;
}
function deleteRow_attribute(r,tableref,table_pr) {
	var i=r.parentNode.parentNode.rowIndex;
	
	document.getElementById(tableref).deleteRow(i+1);
	document.getElementById(tableref).deleteRow(i);
	
	}
function deleteRow_property(r,tableref) {
	var i=r.parentNode.parentNode.rowIndex;
	document.getElementById(tableref).deleteRow(i);
	}
function deleteRow_container(r)
{
	var i=r.parentNode.parentNode.rowIndex;
	document.getElementById('container_table').deleteRow(i);
}
function deleteRow_accessory(r)
{
	var i=r.parentNode.parentNode.rowIndex;
	document.getElementById('accessory_table').deleteRow(i);
}