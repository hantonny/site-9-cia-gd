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
JHTMLBehavior::modal();

$editor = JFactory::getEditor();

$uri = JURI::getInstance();
$url= $uri->root();
$editor = JFactory::getEditor();



?>

<script language="javascript" type="text/javascript">
	function submitbutton(pressbutton) {
		var form = document.adminForm;
		if (pressbutton == 'cancel') {
			submitform( pressbutton );
			return;
		}
		
		else if(form.style.value=="")
		{
			
			alert("<?php echo JText::_( 'PLEASE_ENTER_EVENT_STYLE' ); ?>");
			return false;
		}
	
			submitform( pressbutton );
		
	}
</script>
<form action="<?php echo JRoute::_($uri->toString()); ?>" method="post" name="adminForm" id="adminForm" enctype="multipart/form-data">
<div class="col50">
	<fieldset class="adminform">
		<legend><?php echo JText::_( 'DETAILS' ); ?></legend>

		<table class="admintable" border="0">
		
		<tr>
			<td width="100" align="right" class="key">
				<label for="name">
					<?php echo JText::_( 'STYLE' ); ?>:
				</label>
			</td>
			<td>
				<input class="text_area" type="text" name="style" id="style" size="32" maxlength="250" value="<?php echo $this->detail->style;?>"/>
				
			</td>
		</tr>
		
		<tr>
			<td width="100" align="right" class="key">
				<label for="name">
					<?php echo JText::_( 'WHO' ); ?>:
				</label>
			</td>
			<td>
			<input class="text_area" type="text" name="who" id="who" size="32" maxlength="250" value="<?php echo $this->detail->who;?>"/>
				
			</td>
		</tr>
		
		
		<tr>
			<td width="100" align="right" class="key" valign="top">
				<label for="name">
					<?php echo JText::_( 'YES1' ); ?>:
				</label>
			</td>
			<td>
				<input class="text_area" type="text" name="yes" id="yes" size="32" maxlength="250" value="<?php echo $this->detail->yes;?>"/>
				
			</td>
		</tr>
		
		<tr>
			<td width="100" align="right" class="key" valign="top">
				<label for="name">
					<?php echo JText::_( 'MAYBE' ); ?>:
				</label>
			</td>
			<td>
					<input class="text_area" type="text" name="maybe" id="maybe" size="32" maxlength="250" value="<?php echo $this->detail->maybe;?>"/>
				
			</td>
		</tr>
			<tr>
			<td width="100" align="right" class="key" valign="top">
				<label for="name">
					<?php echo JText::_( 'NO1' ); ?>:
				</label>
			</td>
			<td>
					<input class="text_area" type="text" name="no" id="no" size="32" maxlength="250" value="<?php echo $this->detail->no;?>"/>
				
			</td>
		</tr>
		
		
	</table>
	
	</fieldset>
</div>

<div class="clr"></div>

<input type="hidden" name="cid[]" value="<?php echo $this->detail->id; ?>" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="view" value="eventstyle_detail" />
</form>