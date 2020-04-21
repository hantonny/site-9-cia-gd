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
$editor = JFactory::getEditor();

?>
<script language="javascript" type="text/javascript">
	function submitbutton(pressbutton) {
		
		var form = document.adminForm;
		if (pressbutton == 'cancel') {
			submitform( pressbutton );
			return;
		}
		if(form.field_type.value=="0")
		{
			alert("<?php echo JText::_( 'PLEASE_SELECT_FIELD_TYPE' ); ?>");
			return false;
		}
		else if(form.field_section.value=="0")
		{
			alert("<?php echo JText::_( 'PLEASE_SELECT_FORM' ); ?>");
			return false;
		}
		else if (form.field_name.value == ""){
			alert( "<?php echo JText::_( 'FIELDS_ITEM_MUST_HAVE_A_NAME', true ); ?>" );
		} else {
			submitform( pressbutton );
		}
	}
</script>

<form action="<?php echo JRoute::_($uri->toString()); ?>" method="post" name="adminForm" id="adminForm" enctype="multipart/form-data">
  <div class="col50">
    <fieldset class="adminform">
    <legend><?php echo JText::_( 'DETAILS' ); ?></legend>
    <table class="admintable" border="0" width="100%">
      <tr>
        <td width="100" align="right" class="key"><label for="name"> <?php echo JText::_( 'TYPE' ); ?>: </label>
        </td>
        <td><?php echo $this->lists['type']; ?> <?php echo JHTML::tooltip( JText::_( 'TOOLTIP_TYPE' ), JText::_( 'TYPE' ), 'tooltip.png', '', '', false); ?> </td>
      </tr>
	  <tr>
        <td valign="top" align="right" class="key"><label for="name"> <?php echo JText::_( 'FORM' ); ?>: </label>
        </td>
        <td><?php echo $this->lists['formdata']; ?> <?php echo JHTML::tooltip( JText::_( 'TOOLTIP_SECTION' ), JText::_( 'SECTION' ), 'tooltip.png', '', '', false); ?> </td>
      </tr>
      <tr>
        <td width="100" align="right" class="key"><label for="name"> <?php echo JText::_( 'NAME' ); ?>: </label>
        </td>
        <td><input class="text_area" type="text" name="field_name" id="field_name" size="32" maxlength="250" value="<?php echo $this->detail->field_name;?>" />
        </td>
      </tr>
      <tr>
        <td width="100" align="right" class="key"><label for="name"> <?php echo JText::_( 'TITLE' ); ?>: </label>
        </td>
        <td><input class="text_area" type="text" name="field_title" id="field_title" size="32" maxlength="250" value="<?php echo $this->detail->field_title;?>" />
          <?php echo JHTML::tooltip( JText::_( 'TOOLTIP_TITLE' ), JText::_( 'TITLE' ), 'tooltip.png', '', '', false); ?> </td>
      </tr>
      <tr>
        <td valign="top" align="right" class="key"><label for="deliverytime"> <?php echo JText::_( 'CLASS' ); ?>: </label>
        </td>
        <td><input class="text_area" type="text" name="field_class" id="field_class" value="<?php echo $this->detail->field_class; ?>" size="32" maxlength="250" />
          <?php echo JHTML::tooltip( JText::_( 'TOOLTIP_CLASS' ), JText::_( 'CLASS' ), 'tooltip.png', '', '', false); ?> </td>
      </tr>
	  </table>
	  <?php if($this->detail->field_type==11)
	  			$style="display:block;";
			else 
				$style="display:none;";	
			
	   ?>
	  
	  
     <div class="col50" id="field_label" style="<?php echo $style;?>">
	 <table class="admintable">
      <tr>
        <td valign="top" align="right" class="key"><label for="deliverytime"> <?php echo JText::_( 'FONT_SIZE' ); ?>: </label>
        </td>
        <td><input class="text_area" type="text" name="label_fontsize" id="label_fontsize" value="<?php echo $this->detail->label_fontsize; ?>" size="32" maxlength="250" />
          <?php echo JHTML::tooltip( JText::_( 'TOOLTIP_LABEL_FONT_SIZE' ), JText::_( 'LABEL_FONT_SIZE' ), 'tooltip.png', '', '', false); ?> </td>
      </tr>
	  <tr>
        <td valign="top" align="right" class="key"><label for="deliverytime"> <?php echo JText::_( 'LABEL_BACKGROUND_COLOR' ); ?>: </label>
        </td>
        <td><input class="text_area" type="text" name="label_bgcolor" id="colorpickerField1" value="<?php echo $this->detail->label_bgcolor; ?>" size="32" maxlength="250" />
          <?php echo JHTML::tooltip( JText::_( 'TOOLTIP_LABEL_BACKGROUND_COLOR' ), JText::_( 'LABEL_BACKGROUND_COLOR' ), 'tooltip.png', '', '', false); ?> </td>
      </tr>
	  <tr>
        <td valign="top" align="right" class="key"><label for="deliverytime"> <?php echo JText::_( 'TEXT_COLOR' ); ?>: </label>
        </td>
        <td><input class="text_area" type="text" name="label_textcolor" id="colorpickerField2" value="<?php echo $this->detail->label_textcolor; ?>" size="32" maxlength="250" />
          <?php echo JHTML::tooltip( JText::_( 'TOOLTIP_LABEL_TEXT_COLOR' ), JText::_( 'LABEL_TEXT_COLOR' ), 'tooltip.png', '', '', false); ?> </td>
      </tr>
	  </table>
	  </div>
	  
	  <?php if($this->detail->field_type==1)
	  			$style="display:block;";
			else 
				$style="display:none;";	
			
	   ?>
	 <div class="col50" id="field_maxlength" style="<?php echo $style;?>">
	 <table class="admintable">
      <tr>
        <td valign="top" align="right" class="key"><label for="deliverytime"> <?php echo JText::_( 'MAX_LENGTH' ); ?>: </label>
        </td>
        <td><input class="text_area" type="text" name="field_maxlength" id="field_maxlength" value="<?php echo $this->detail->field_maxlength; ?>" size="32" maxlength="250" />
          <?php echo JHTML::tooltip( JText::_( 'TOOLTIP_MAX_LENGTH' ), JText::_( 'MAX_LENGTH' ), 'tooltip.png', '', '', false); ?> </td>
      </tr>
	  </table>
	  </div>
	  
	  
	  <?php if($this->detail->field_type==2)
	  			$style="display:block;";
			else 
				$style="display:none;";	
			
	   ?>
	  <div class="col50" id="field_textarea" style="<?php echo $style;?>">
	  <table class="admintable">
	
    
      <tr>
        <td valign="top" align="right" class="key"><label for="deliverytime"> <?php echo JText::_( 'COLS' ); ?>: </label>
        </td>
        <td><input class="text_area" type="text" name="field_cols" id="field_cols" value="<?php echo $this->detail->field_cols; ?>" size="32" maxlength="250" />
          <?php echo JHTML::tooltip( JText::_( 'TOOLTIP_COLS' ), JText::_( 'COLS' ), 'tooltip.png', '', '', false); ?> </td>
      </tr>
      <tr>
        <td valign="top" align="right" class="key"><label for="deliverytime"> <?php echo JText::_( 'ROWS' ); ?>: </label>
        </td>
        <td><input class="text_area" type="text" name="field_rows" id="field_rows" value="<?php echo $this->detail->field_rows; ?>" size="32" maxlength="250" />
          <?php echo JHTML::tooltip( JText::_( 'TOOLTIP_ROWS' ), JText::_( 'ROWS' ), 'tooltip.png', '', '', false); ?> </td>
      </tr>
	  
	  </table> 
	  </div>
	  <?php if($this->detail->field_type==4)
	  			$style="display:block;";
			else 
				$style="display:none;";	
			
	   ?>
	  
	  
     <div class="col50" id="field_radio" style="<?php echo $style;?>">
	 <table class="admintable"> 
      <tr>
        <td valign="top" align="right" class="key"><label for="deliverytime"> <?php echo JText::_( 'RADIO_COLUMNS' ); ?>: </label>
        </td>
        <td><input class="text_area" type="text" name="radio_cols" id="radio_cols" value="<?php echo $this->detail->radio_cols; ?>" size="32" maxlength="250" />
          <?php echo JHTML::tooltip( JText::_( 'TOOLTIP_COLS' ), JText::_( 'RADIO_COLUMNS' ), 'tooltip.png', '', '', false); ?> </td>
		  
      </tr>
	  </table>
	  </div>
	  
	  <div class="col50">
	  <table class="admintable" border="0" width="100%">
	  <tr>
        <td width="100" valign="top" align="right" class="key"><label for="name"><?php echo JText::_( 'SHOW_AT_FRONT' ); ?>: </td>
        <td><?php echo $this->lists['show_in_front']; ?> </td>
      </tr>
      <tr>
        <td width="100" valign="top" align="right" class="key"><label for="name"><?php echo JText::_( 'IS_REQUIRED_FIELD' ); ?>: </td>
        <td><?php echo $this->lists['is_required']; ?> </td>
      </tr>
      <tr>
        <td width="100" valign="top" align="right" class="key"><label for="name"><?php echo JText::_( 'PUBLISHED' ); ?>: </td>
        <td><?php echo $this->lists['published']; ?> </td>
      </tr>
	  </table>
	  </div>
	  
	  
    
    </fieldset>
  </div>
  <div class="col50"> </div>
  <div class="col50">
    <fieldset class="adminform">
    <legend><?php echo JText::_( 'DESCRIPTION' ); ?></legend>
    <table class="admintable">
      <tr>
        <td><?php echo $editor->display("field_desc",$this->detail->field_desc,'$widthPx','$heightPx','100','20','0');	?> </td>
      </tr>
      <?php JHTML::_('behavior.calendar'); ?>
    </table>
    </fieldset>
  </div>
  <?php
 
if( (count($this->lists['extra_data']) <=0 ) || $this->detail->field_type==7 || $this->detail->field_type==8 || $this->detail->field_type==9 || $this->detail->field_type==10 || $this->detail->field_type==11 || $this->detail->field_type==12)
$style="display:none;";
else
{
	
$style="display:block;";
}
?>
  <div class="col50" id="field_data" style="<?php echo $style;?>"> <?php echo JText::_( 'USE_THE_TABLE_BELOW_TO_ADD_NEW_VALUES' ); ?>
    <input type="button" name="addvalue" id="addvalue" class="button"  Value="<?php echo JText::_( 'ADD_VALUE' ); ?>" onclick="addNewRow('extra_table');" />
    <fieldset class="adminform">
    <legend><?php echo JText::_( 'VALUE' ); ?></legend>
    <table cellpadding="0" cellspacing="5" border="0" id="extra_table">
      <tr>
        <th><?php echo JText::_( 'OPTION_NAME' ); ?></th>
        <th><?php echo JText::_( 'OPTION_VALUE' ); ?></th>
      </tr>
      <?php 
		if(count($this->lists['extra_data']) >0)
		{
			for($k=0;$k<count($this->lists['extra_data']);$k++)
			{
				 
		?>
      <tr>
        <td><input type="text" name="extra_name[]" value="<?php echo $this->lists['extra_data'][$k]->field_name; ?>" id="extra_name[]"></td>
        <td><input type="text" name="extra_value[]" value="<?php echo $this->lists['extra_data'][$k]->field_value; ?>" id="extra_value[]">
          <input type="hidden" value="<?php echo $this->lists['extra_data'][$k]->value_id; ?>" name="value_id[]" id="value_id[]">
          <input value="Delete" onclick="deleteRow(this)" class="button" type="button" />
        </td>
      </tr>
      <?php
			}	
			
		}
		else 
		{
			$k=1;
		?>
      <tr>
        <td><input type="text" name="extra_name[]" value="field_temp_opt_1" id="extra_name[]"></td>
        <td><input type="text" name="extra_value[]" id="extra_value[]">
          <input type="hidden" name="value_id[]" id="value_id[]"></td>
      </tr>
      <?php 
		}
		?>
    </table>
    </fieldset>
  </div>
  <div class="clr"></div>
  <input type="hidden" value="<?php echo $k;?>" name="total_extra" id="total_extra">
  <input type="hidden" name="cid[]" value="<?php echo $this->detail->field_id; ?>" />
  <input type="hidden" name="task" value="" />
  <input type="hidden" name="view" value="fields_detail" />
</form>
