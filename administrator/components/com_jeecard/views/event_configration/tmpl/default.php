<?php
/**
* @package   JE Ecard
* @copyright Copyright (C) 2009 - 2010 Open Source Matters. All rights reserved.
* @license   http://www.gnu.org/licenses/lgpl.html GNU/LGPL, see LICENSE.php
* Contact to : emailtohardik@gmail.com, joomextensions@gmail.com
* Visit : http://www.joomlaextensions.co.in/
**/ 

defined('_JEXEC') or die('Restricted access');
JHTML::_('behavior.tooltip');
$uri = JURI::getInstance();
$url= $uri->root();
$option = JRequest::getVar('option','','','string');
?>
<script language="javascript" type="text/javascript">
	Joomla.submitform =function submitbutton(pressbutton) {
		var form = document.adminForm;
		if (pressbutton == 'cancel') {
			submitform( pressbutton );
			return;
		}
	
		if (form.title.value == ""){
			alert( "<?php echo JText::_( 'Please enter the title', true ); ?>" );
		} else {
			submitform( pressbutton );
		}
	}
</script>

<form action="<?php echo JRoute::_($uri->toString()); ?>" method="post" name="adminForm" id="adminForm" enctype="multipart/form-data">
  <div class="col50">
    <fieldset class="adminform">
    <legend><?php echo JText::_( 'GOOGLE_MAP_SETTING' ); ?></legend>
    	<table class="admintable">
      	<tr>
        	<td width="100" align="right" class="key" >
				<label for="name">
					<?php echo JText::_( 'GOOGLE_MAP_DISPLAY' ); ?>:
				</label>
			</td>
        	<td><?php echo $this->lists['gmap_display']; ?> </td>
      	</tr>
     	<tr>
        	<td width="100" align="right" class="key" >
				<label for="name">
					<?php echo JText::_( 'GOOGLE_MAP_API_KEY' ); ?>:
				</label>
			</td>
        	<td><input type="text" name="gmap_api" id="gmap_api" size="122" value="<?php  echo $this->detail->gmap_api; ?>" /></td>
      	</tr>
      	<tr>
        	<td width="100" align="right" class="key" >
				<label for="name"> 
					<?php echo JText::_( 'GOOGLE_MAP_WIDTH'); ?>:
				</label>
			</td>
        	<td><input type="text" name="gmap_width" id="gmap_width"  value="<?php  echo $this->detail->gmap_width; ?>" /></td>
      	</tr>
      	<tr>
        	<td width="100" align="right" class="key" >
				<label for="name">
					<?php echo JText::_( 'GOOGLE_MAP_HEIGHT' ); ?>:
				</label>
			</td>
        	<td><input type="text" name="gmap_height" id="gmap_height" value="<?php  echo $this->detail->gmap_height; ?>" /></td>
      	</tr>
		</table>
	</fieldset>
	<fieldset class="adminform">
    <legend><?php echo JText::_( 'IMAGE_SETTING' ); ?></legend>
    	<table class="admintable">
      	<tr>
        	<td width="100" align="right" class="key" >
				<label for="name">
					<?php echo JText::_( 'THUMB_WIDTH'); ?>:
				</label>
			</td>
        	<td><input type="text" name="thumb_width" id="thumb_width"  value="<?php  echo $this->detail->thumb_width; ?>" /></td>
      	</tr>
      	<tr>
        	<td width="100" align="right" class="key" >
				<label for="name">
					<?php echo JText::_( 'THUMB_HEIGHT' ); ?>:
				</label>
			</td>
        	<td><input type="text" name="thumb_height" id="thumb_height" value="<?php  echo $this->detail->thumb_height; ?>" /></td>
      	</tr>
		<tr>
			<td width="100" align="right" class="key" >
				<label for="name">
					<?php echo JText::_('MAX_IMAGE_UPLOAD_SIZE'); ?>:
				</label>
			</td>
			<td>
				<input type="text" name="max_img_size" id="max_img_size" size="5" value="<?php  echo $this->detail->max_img_size; ?>" />&nbsp;<?php echo JText::_('MB'); ?>
			</td>
		</tr>
      	</table>
	</fieldset>
	
	<fieldset class="adminform">
    <legend><?php echo JText::_( 'CALENDAR_SETTING' ); ?></legend>
    	<table class="admintable">
      	<!--<tr>
        	<td width="100" align="right" class="key" ><label for="name"> <?php echo JText::_( 'TITLE' ); ?>: </label></td>
        	<td><input type="text" name="title" id="title" value="<?php  echo $this->lists['title']; ?>" /></td>
      	</tr>-->
      	<tr>
        	<td width="100" align="right" class="key" >
				<label for="name"> 
					<?php echo JText::_( 'HEADER1' ); ?>: 
				</label>
			</td>
        	<td><input type="text" name="head1" id="colorpickerField1" value="<?php  echo $this->lists['head1']; ?>" /></td>
      	</tr>
		<tr>
			<td width="100" align="right" class="key" >
				<label for="name">
					<?php echo JText::_( 'HEADER1_TEXT_COLOR' ); ?>:
				</label>
			</td>
			<td>
				<input type="text" name="head1_txtcolor" id="colorpickerField1" value="<?php  echo $this->detail->head1_txtcolor; ?>" />
			</td>
		</tr>
      	<tr>
        	<td width="100" align="right" class="key" >
				<label for="name">
					<?php echo JText::_( 'HEADER2' ); ?>: 
				</label>
			</td>
        	<td><input type="text" name="head2" id="colorpickerField1" value="<?php  echo $this->lists['head2']; ?>" /></td>
      	</tr>
		
		<tr>
			<td width="100" align="right" class="key" >
				<label for="name">
					<?php echo JText::_( 'HEADER2_TEXT_COLOR' ); ?>:
				</label>
			</td>
			<td>
				<input type="text" name="head2_txtcolor" id="colorpickerField1" value="<?php  echo $this->detail->head2_txtcolor; ?>" />
			</td>
		</tr>
		
      	<tr>
        	<td width="100" align="right" class="key" >
				<label for="name"> 
					<?php echo JText::_( 'HEADER3' ); ?>: 
				</label>
			</td>
        	<td><input type="text" name="head3" id="colorpickerField1" value="<?php  echo $this->lists['head3']; ?>" /></td>
      	</tr>
		
		<tr>
			<td width="100" align="right" class="key" >
				<label for="name">
					<?php echo JText::_( 'HEADER3_TEXT_COLOR' ); ?>:
				</label>
			</td>
			<td>
				<input type="text" name="head3_txtcolor" id="colorpickerField1" value="<?php  echo $this->detail->head3_txtcolor; ?>" />
			</td>
		</tr>
		
      	<!--<tr>
        	<td width="100" align="right" class="key" ><label for="name"> <?php echo JText::_( 'CALBODYCOLOR' ); ?>: </label></td>
        	<td><input type="text" name="head4" id="colorpickerField1" value="<?php  echo $this->lists['head4']; ?>" /></td>
      	</tr>-->
		</table>
	</fieldset>
	<fieldset class="adminform">
    <legend><?php echo JText::_( 'EVENT_SETTING' ); ?></legend>
    	<table class="admintable">
      	<tr>
        	<td width="100" align="right" class="key" ><label for="name"> <?php echo JText::_( 'AUTOPUBLISH' ); ?>: </label></td>
        	<td><?php echo $this->lists['autopub']; ?> </td>
      	</tr>
		<tr>
        	<td width="100" align="right" class="key" ><label for="name"> <?php echo JText::_( 'SHOW_RSS_FEED' ); ?>: </label></td>
        	<td><?php echo $this->lists['show_rss'];//$this->lists['iscreate']; ?> </td>
      	</tr>
    	</table>
    </fieldset>
  </div>
  
  <div class="clr"></div>
  <input type="hidden" name="id" value="<?php echo $this->detail->id; ?>" />
  <input type="hidden" name="task" value="" />
  <input type="hidden" name="view" value="event_configration" />
</form>
