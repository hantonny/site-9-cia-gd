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


/*$res=new extra_field();
$fields= $res->list_all_field(1,$this->detail->catid);

$extra=explode("`",$fields);
*/
?>

<script language="javascript" type="text/javascript">
	function submitbutton(pressbutton) {
		var form = document.adminForm;
		if (pressbutton == 'cancel') {
			submitform( pressbutton );
			return;
		}
		
		else if(form.name.value=="")
		{
			
			alert("<?php echo JText::_( 'PLEASE_ENTER_CATEGORY_NAME' ); ?>");
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
					<?php echo JText::_( 'CATEGORY_NAME' ); ?>:
				</label>
			</td>
			<td>
				<input class="text_area" type="text" name="name" id="name" size="32" maxlength="250" value="<?php echo $this->detail->name;?>"/>
				
			</td>
		</tr>
		
		<tr>
			<td width="100" align="right" class="key">
				<label for="name">
					<?php echo JText::_( 'PARENT' ); ?>:
				</label>
			</td>
			<td>
				<?php echo $this->lists['catparent']; ?> 
			</td>
		</tr>
		
		
		<tr>
			<td width="100" align="right" class="key" valign="top">
				<label for="name">
					<?php echo JText::_( 'DESCRIPTION' ); ?>:
				</label>
			</td>
			<td>
				<?php echo $editor->display("description",$this->detail->description,'$widthPx','$heightPx','100','20','0');	?>
			</td>
		</tr>
		
		<tr>
			<td width="100" align="right" class="key" valign="top">
				<label for="name">
					<?php echo JText::_( 'PUBLISHED' ); ?>:
				</label>
			</td>
			<td>
				<?php echo $this->lists['published']; ?> 
			</td>
		</tr>
		<!--<tr>
			<td colspan="2">
				<?php echo $extra[0];?>
				
				</table>
				
			</td>
		</tr>-->
		
		
	</table>
	
	</fieldset>
</div>

<div class="clr"></div>

<input type="hidden" name="cid[]" value="<?php echo $this->detail->catid; ?>" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="view" value="category_detail" />
</form>