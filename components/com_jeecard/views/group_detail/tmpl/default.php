<?php
/**
* @package   JE Ecard
* @copyright Copyright (C) 2009 - 2010 Open Source Matters. All rights reserved.
* @license   http://www.gnu.org/licenses/lgpl.html GNU/LGPL, see LICENSE.php
* Contact to : emailtohardik@gmail.com, joomextensions@gmail.com
* Visit : http://www.joomlaextensions.co.in/
**/ 

defined('_JEXEC') or die('Restricted access');

$userid =  clone(JFactory::getUser());
$mainframe = JFactory::getApplication();
if($userid->id){	

$editor = JFactory::getEditor();
$uri = JURI::getInstance();
$url= $uri->root();
$option = JRequest::getVar('option','','','string'); 
$document =JFactory::getDocument();

$link=JRoute::_($url.'index.php?option='.$option);

//$document->addStyleSheet('components/'.$option.'/assets/css/style.css');

?>
<style type="text/css">


	.multipleSelectBoxControl span{	/* Labels above select boxes*/
		font-family:arial;
		font-size:11px;
		font-weight:bold;
	}
	.multipleSelectBoxControl div select{	/* Select box layout */
		font-family:arial;
		height:100%;
	}
	.multipleSelectBoxControl input{	/* Small butons */
		width:25px;	
	}
	
	.multipleSelectBoxControl div{
		float:left;
	}
		
	.multipleSelectBoxDiv
	</style>
	<script type="text/javascript">
	
	
	
	
		
	var fromBoxArray = new Array();
	var toBoxArray = new Array();
	var selectBoxIndex = 0;
	var arrayOfItemsToSelect = new Array();
	
	
	function moveSingleElement()
	{
		var selectBoxIndex = this.parentNode.parentNode.id.replace(/[^\d]/g,'');
		var tmpFromBox;
		var tmpToBox;
		if(this.tagName.toLowerCase()=='select'){			
			tmpFromBox = this;
			if(tmpFromBox==fromBoxArray[selectBoxIndex])tmpToBox = toBoxArray[selectBoxIndex]; else tmpToBox = fromBoxArray[selectBoxIndex];
		}else{
		
			if(this.value.indexOf('>')>=0){
				tmpFromBox = fromBoxArray[selectBoxIndex];
				tmpToBox = toBoxArray[selectBoxIndex];			
			}else{
				tmpFromBox = toBoxArray[selectBoxIndex];
				tmpToBox = fromBoxArray[selectBoxIndex];	
			}
		}
		
		for(var no=0;no<tmpFromBox.options.length;no++){
			if(tmpFromBox.options[no].selected){
				tmpFromBox.options[no].selected = false;
				tmpToBox.options[tmpToBox.options.length] = new Option(tmpFromBox.options[no].text,tmpFromBox.options[no].value);
				
				for(var no2=no;no2<(tmpFromBox.options.length-1);no2++){
					tmpFromBox.options[no2].value = tmpFromBox.options[no2+1].value;
					tmpFromBox.options[no2].text = tmpFromBox.options[no2+1].text;
					tmpFromBox.options[no2].selected = tmpFromBox.options[no2+1].selected;
				}
				no = no -1;
				tmpFromBox.options.length = tmpFromBox.options.length-1;
											
			}			
		}
		
		
		var tmpTextArray = new Array();
		for(var no=0;no<tmpFromBox.options.length;no++){
			tmpTextArray.push(tmpFromBox.options[no].text + '___' + tmpFromBox.options[no].value);			
		}
		tmpTextArray.sort();
		var tmpTextArray2 = new Array();
		for(var no=0;no<tmpToBox.options.length;no++){
			tmpTextArray2.push(tmpToBox.options[no].text + '___' + tmpToBox.options[no].value);			
		}		
		tmpTextArray2.sort();
		
		for(var no=0;no<tmpTextArray.length;no++){
			var items = tmpTextArray[no].split('___');
			tmpFromBox.options[no] = new Option(items[0],items[1]);
			
		}		
		
		for(var no=0;no<tmpTextArray2.length;no++){
			var items = tmpTextArray2[no].split('___');
			tmpToBox.options[no] = new Option(items[0],items[1]);			
		}
	}
	
	function sortAllElement(boxRef)
	{
		var tmpTextArray2 = new Array();
		for(var no=0;no<boxRef.options.length;no++){
			tmpTextArray2.push(boxRef.options[no].text + '___' + boxRef.options[no].value);			
		}		
		tmpTextArray2.sort();		
		for(var no=0;no<tmpTextArray2.length;no++){
			var items = tmpTextArray2[no].split('___');
			boxRef.options[no] = new Option(items[0],items[1]);			
		}		
		
	}
	function moveAllElements()
	{
		var selectBoxIndex = this.parentNode.parentNode.id.replace(/[^\d]/g,'');
		var tmpFromBox;
		var tmpToBox;		
		if(this.value.indexOf('>')>=0){
			tmpFromBox = fromBoxArray[selectBoxIndex];
			tmpToBox = toBoxArray[selectBoxIndex];			
		}else{
			tmpFromBox = toBoxArray[selectBoxIndex];
			tmpToBox = fromBoxArray[selectBoxIndex];	
		}
		
		for(var no=0;no<tmpFromBox.options.length;no++){
			tmpToBox.options[tmpToBox.options.length] = new Option(tmpFromBox.options[no].text,tmpFromBox.options[no].value);			
		}	
		
		tmpFromBox.options.length=0;
		sortAllElement(tmpToBox);
		
	}
	
	
	/* This function highlights options in the "to-boxes". It is needed if the values should be remembered after submit. Call this function onsubmit for your form */
	function multipleSelectOnSubmit()
	{
		fromObj = document.getElementById("fromBox");
		
		//alert(fromObj.options[0].value);
		for(var no=0;no<fromObj.length;no++){
			
			fromObj.options[no].selected = true;
			
		}
		
		
		/*for(var no=0;no<fromBoxArray.length;no++){
			var obj = arrayOfItemsToSelect[no];
			alert(obj.options.length);
			for(var no2=0;no2<obj.options.length;no2++){
				obj.options[no2].selected = true;
			}
		}*/
		//return false;
	}
	
	function createMovableOptions(fromBox,toBox,totalWidth,totalHeight,labelLeft,labelRight)
	{		
		fromObj = document.getElementById(fromBox);
		toObj = document.getElementById(toBox);
		
		arrayOfItemsToSelect[arrayOfItemsToSelect.length] = toObj;

		
		fromObj.ondblclick = moveSingleElement;
		toObj.ondblclick = moveSingleElement;

		
		fromBoxArray.push(fromObj);
		toBoxArray.push(toObj);
		
		var parentEl = fromObj.parentNode;
		
		var parentDiv = document.createElement('DIV');
		parentDiv.className='multipleSelectBoxControl';
		parentDiv.id = 'selectBoxGroup' + selectBoxIndex;
		parentDiv.style.width = totalWidth + 'px';
		parentDiv.style.height = totalHeight + 'px';
		parentEl.insertBefore(parentDiv,fromObj);
		
		
		var subDiv = document.createElement('DIV');
		subDiv.style.width = (Math.floor(totalWidth/2) - 15) + 'px';
		fromObj.style.width = (Math.floor(totalWidth/2) - 15) + 'px';

		var label = document.createElement('SPAN');
		label.innerHTML = labelLeft;
		subDiv.appendChild(label);
		
		subDiv.appendChild(fromObj);
		subDiv.className = 'multipleSelectBoxDiv';
		parentDiv.appendChild(subDiv);
		
		
		var buttonDiv = document.createElement('DIV');
		buttonDiv.style.verticalAlign = 'middle';
		buttonDiv.style.paddingTop = (totalHeight/2) - 50 + 'px';
		buttonDiv.style.width = '30px';
		buttonDiv.style.textAlign = 'center';
		parentDiv.appendChild(buttonDiv);
		
		var buttonRight = document.createElement('INPUT');
		buttonRight.type='button';
		buttonRight.value = '>';
		buttonDiv.appendChild(buttonRight);	
		buttonRight.onclick = moveSingleElement;	
		
		var buttonAllRight = document.createElement('INPUT');
		buttonAllRight.type='button';
		buttonAllRight.value = '>>';
		buttonAllRight.onclick = moveAllElements;
		buttonDiv.appendChild(buttonAllRight);		
		
		var buttonLeft = document.createElement('INPUT');
		buttonLeft.style.marginTop='10px';
		buttonLeft.type='button';
		buttonLeft.value = '<';
		buttonLeft.onclick = moveSingleElement;
		buttonDiv.appendChild(buttonLeft);		
		
		var buttonAllLeft = document.createElement('INPUT');
		buttonAllLeft.type='button';
		buttonAllLeft.value = '<<';
		buttonAllLeft.onclick = moveAllElements;
		buttonDiv.appendChild(buttonAllLeft);
		
		var subDiv = document.createElement('DIV');
		subDiv.style.width = (Math.floor(totalWidth/2) - 15) + 'px';
		toObj.style.width = (Math.floor(totalWidth/2) - 15) + 'px';

		var label = document.createElement('SPAN');
		label.innerHTML = labelRight;
		subDiv.appendChild(label);
				
		subDiv.appendChild(toObj);
		parentDiv.appendChild(subDiv);		
		
		toObj.style.height = (totalHeight - label.offsetHeight) + 'px';
		fromObj.style.height = (totalHeight - label.offsetHeight) + 'px';

			
		selectBoxIndex++;
		
	}
	
	
	
	</script>	

<?php
$image=$url."components/com_hbooking/assets/component_images/save_f2.png"; 

$image1=$url."components/com_hbooking/assets/component_images/cancel_f2.png";

$image2=$url."components/com_hbooking/assets/component_images/apply.png";   

$link2	= JRoute::_( 'index.php?option='.$option.'&view=hotel_detail&task=cancel' ); 

$link3	= JRoute::_( 'index.php?option='.$option.'&view=hotel_detail&task=apply' ); 

$link_save	= JRoute::_( 'index.php?option='.$option.'&view=hotel_detail&task=save' ); 

?>


<form action="<?php echo JRoute::_($this->request_url) ?>" method="post" name="hotelform" id="hotelform" enctype="multipart/form-data"  >
  <input type="hidden"  name="jelive_url" id="jelive_url" value="<?php echo $url; ?>" />
  <div class="editcell">
    <div style="display: block;" id="content_1" class="content1">
        <table width="100%" class="htmlForm">
          
          <tr>
            <td ><label for="name"> <?php echo JText::_( 'GROUP_NAME' ); ?>*: </label>
            </td>
            <td><input  type="text" name="groupname" class="inputbox" id="groupname" size="30"  value="<?php echo $this->detail->groupname;?>" />
            </td>
          </tr>
          
          <tr>
		  <td></td>
		  <td><?php echo $this->lists['selectcontact']; echo $this->lists['allcontact'];?></td>
		  </tr>
         
          
       
          <tr>
            <td valign="top"><label for="name"> <?php echo JText::_( 'DESCRIPTION' ); ?>: </label>
            </td>
            <td><?php echo $editor->display("description",$this->detail->description,'$widthPx','$heightPx','40','10','0'); ?> </td>
          </tr>
          <tr>
            <td ><label for="name"> <?php echo JText::_( 'PUBLISHED' ); ?>*: </label>
            </td>
            <td><?php echo $this->lists['published'];?>
            </td>
          </tr>
		  <tr>
		  <td>&nbsp;</td>
		  <td > <input type="submit" name="save_group" onclick="return multipleSelectOnSubmit();" value="Submit" /></td>
		  </tr>
        
        </table>
      </div>
  </div>
 
 
  <input type="hidden" name="option" value="com_jeecard" />
  <input type="hidden" name="task" id="task" value="save" />
  <input type="hidden" name="view" value="group_detail" />
  <input type="hidden" name="cid[]" value="<?php echo $this->detail->groupid; ?>" />
  <?php echo JHTML::_( 'form.token' ); ?>
</form>
<?php 
}else{
	$return = JRoute::_('index.php');
	$mainframe->redirect( $return );	
}
?>
<script type="text/javascript">
createMovableOptions("fromBox","toBox",500,300,'<?php echo JText::_('MY_CONTACT'); ?>','<?php echo JText::_('ALL_CONTACT'); ?>');
</script>