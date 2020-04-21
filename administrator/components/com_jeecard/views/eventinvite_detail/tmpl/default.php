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
$user	= clone(JFactory::getuser());

$model = $this->getModel ( 'eventinvite_detail' );
$sent_emailids	= $model->getsentevents($this->detail->eventlist_id);
if(count($sent_emailids)!=0) {
	$event_sentemail	= implode(',',$sent_emailids);
} else {
	$event_sentemail 	= '';
}
?>
<script language="javascript" type="text/javascript">
	Joomla.submitform =function submitbutton(pressbutton) {
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
	  // if ((pressbutton=='publish')||(pressbutton=='unpublish')||(pressbutton=='saveorder'))
	  // {   
	  //  form.view.value="eventinvite_detail";
	  // }
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
					<b><?php echo JText::_( 'EVENT_TITLE' ); ?>:</b>
				</label>
			</td>
			<td>
				<?php echo $this->detail->event_title;?>
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="name">
					<b><?php echo JText::_( 'HOST_NAME' ); ?>:</b>
				</label>
			</td>
			<td>
				<?php echo $this->detail->host;?>
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="name">
					<b><?php echo JText::_( 'HOST_EMAIL' ); ?>:</b>
				</label>
			</td>
			<td>
				<?php echo $this->detail->host_email;?>
			</td>
		</tr>
        <tr>
			<td width="100" align="right" class="key">
				<label for="name">
					<b><?php echo JText::_( 'MESSAGE' ); ?>:</b>
				</label>
			</td>
			<td>
				<?php echo $this->detail->message;?>
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="name">
					<b><?php echo JText::_( 'RECEIVER' ); ?>:</b>
				</label>
			</td>
			<td>
				<?php echo $event_sentemail;?>
			</td>
		</tr>
		<?php if($this->detail->location_name!='' && $this->detail->location_name!='Location Name') { ?>
        <tr>
			<td width="100" align="right" class="key">
				<label for="name">
					<b><?php echo JText::_( 'LOCATION' ); ?>:</b>
				</label>
			</td>
			<td>
				<?php echo $this->detail->location_name;?>
			</td>
		</tr>
		<?php } ?>
		<?php if($this->detail->address!='' && $this->detail->address!='Address') { ?>
        <tr>
			<td width="100" align="right" class="key">
				<label for="name">
					<b><?php echo JText::_( 'ADDRESS' ); ?>:</b>
				</label>
			</td>
			<td>
				<?php echo $this->detail->address;?>
			</td>
		</tr>
		<?php } ?>
		<?php if($this->detail->city!='' && $this->detail->city!='City') { ?>
		<tr>
        	<td width="100" align="right" class="key">
				<label for="name">
					<b><?php echo JText::_( 'CITY' ); ?>:</b>
				</label>
			</td>
			<td>
				<?php echo $this->detail->city;?>
			</td>
         </tr>
		<?php } ?>
		<tr>
			<td width="100" align="right" class="key" valign="top">
				<label for="name">
					<b><?php echo JText::_( 'DATE' ); ?>:</b>
				</label>
			</td>
			<td>
				<?php echo $this->detail->date;	?>
			</td>
		</tr>
	</table>
	
	</fieldset>
</div>

<div class="clr"></div>
<input type="hidden" name="cid[]" value="<?php echo $this->detail->eventlist_id; ?>" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="view" value="eventinvite_detail" />
</form>