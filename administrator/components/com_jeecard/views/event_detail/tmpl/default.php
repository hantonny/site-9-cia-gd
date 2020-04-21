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
$uri = JURI::getInstance();
$url= $uri->root();
$editor = JFactory::getEditor();
$image_dir = $url.'/components/com_jeecard/assets/images/thumb_';

$document		= JFactory::getDocument();
		JHTML::stylesheet($url.'administrator/components/com_jeecard/assets/colorpixer/css/colorpicker.css' );
		$document->addScript($url.'administrator/components/com_jeecard/assets/colorpixer/js/jquery.js');
		$document->addScript($url.'administrator/components/com_jeecard/assets/colorpixer/js/colorpicker.js');
		$document->addScript($url.'administrator/components/com_jeecard/assets/colorpixer/js/eye.js');
		$document->addScript($url.'administrator/components/com_jeecard/assets/colorpixer/js/utils.js');
		$document->addScript($url.'administrator/components/com_jeecard/assets/colorpixer/js/layout.js?ver=1.0.2.js');
$model = $this->getModel('event_detail');
// =========================== Bring dynemic fields value ===========================
/*$res=new extra_field();
// =======   $fields= $res->list_all_field(Section_id,$this->detail->eventid);  ========
$fields= $res->list_all_field(2,$this->detail->eventid);
// ====================================================================================
$extra=explode("`",$fields);*/
// =====================================================================================
$user	= clone(JFactory::getuser());

?>

<script type="text/javascript">jQuery.noConflict(); </script>


<script language="javascript" type="text/javascript">
	function submitbutton(pressbutton) {
		var form = document.adminForm;
		
		if (pressbutton == 'cancel') {
			submitform( pressbutton );
			return;
		}
		else if(form.name.value=="")
		{
			alert("<?php echo JText::_( 'PLEASE_ENTER_EVENT_NAME' ); ?>");
			return false;
		}
		
		else if(form.catid.value==0)
		{
			alert("<?php echo JText::_( 'PLEASE_SELECT_CATEGORY' ); ?>");
			return false;
		}
			submitform( pressbutton );
	}
	function submitform(pressbutton)
{
	var form = document.adminForm;
	   if (pressbutton)
		{form.task.value=pressbutton;}
	  if ((pressbutton=='publish')||(pressbutton=='unpublish')||(pressbutton=='saveorder'))
	  {   
	   form.view.value="category_detail";
	  }
	 try {
	  form.onsubmit();
	  }
	 catch(e){}
	 
	 form.submit();

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
					<?php echo JText::_( 'EVENT_NAME' ); ?>:
				</label>
			</td>
			<td>
				<input class="text_area" type="text" name="name" id="name" size="32" maxlength="250" value="<?php echo $this->detail->name;?>"/>
				
			</td>
		</tr>
		
		<tr>
			<td width="100" align="right" class="key">
				<label for="name">
					<?php echo JText::_( 'CATEGORY' ); ?>:
				</label>
			</td>
			<td>
				<?php echo $this->lists['category']; ?> 
			</td>
		</tr>
        <tr>
			<td width="100" align="right" class="key">
				<label for="name">
					<?php echo JText::_( 'EVENT_IMAGE_WIDTH' ); ?>:
				</label>
			</td>
			<td>
				<input class="" type="text" name="width" id="width" size="32" maxlength="250" value="<?php echo $this->detail->width;?>"/>
				
			</td>
		</tr>
        <tr>
			<td width="100" align="right" class="key">
				<label for="name">
					<?php echo JText::_( 'EVENT_IMAGE_HEIGHT' ); ?>:
				</label>
			</td>
			<td>
				<input class="" type="text" name="height" id="height" size="32" maxlength="250" value="<?php echo $this->detail->height;?>"/>
				
			</td>
		</tr>
        <tr>
			<td width="100" align="right" class="key">
				<label for="name">
					<?php echo JText::_( 'EVENT_IMAGE_COLOR' ); ?>:
				</label>
			</td>
			<td>
				<input class="" type="text" name="color" id="color" size="32" maxlength="250" value="<?php echo $this->detail->color;?>"/> Ex. White,Red etc..
				<!--<input type="text" name="color" id="colorpickerField1" size="32" maxlength="250" value="<?php echo $this->detail->color;?>" />-->
			</td>
		</tr>
		<tr>
        <td><label for="name">
					<?php echo JText::_( 'BACKGROUND_IMAGE' ); ?>:
				</label></td><td>		<?php if($this->detail->b_image!='') { ?><a class="modal" href="<?php echo $image_dir.$this->detail->b_image; ?>"><img src="<?php echo $image_dir.$this->detail->b_image; ?>" height="100" width="100" /></a><?php }	 ?>
				<input type="file" name="b_image" />
		
					
				
				<input type="hidden" name="old_img" value="<?php echo $this->detail->b_image;?>" />
			</td>
         </tr>
		
		<tr>
			<td width="100" align="right" class="key" valign="top">
				<label for="name">
					<?php echo JText::_( 'TEMPLATE_DESCRIPTION' ); ?>:
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
		
	</table>
	
	</fieldset>
</div>

<div class="clr"></div>
<input type="hidden" name="cid[]" value="<?php echo $this->detail->eventid; ?>" />

<input type="hidden" name="event_cdate" id="event_cdate" <?php if(@$this->detail->event_cdate) {?> value="<?php echo $this->detail->event_cdate; ?>" <?php } ?>/>
<?php	if($this->detail->eventid!=0) { ?>
<input type="hidden" name="user_id" id="user_id"  value="<?php echo @$this->detail->user_id; ?>" />
<?php	} else { ?>
<input type="hidden" name="user_id" id="user_id" value="<?php echo $user->id; ?>" />
<?php 	}	?>


<input type="hidden" name="task" value="" />
<input type="hidden" name="view" value="event_detail" />
</form>