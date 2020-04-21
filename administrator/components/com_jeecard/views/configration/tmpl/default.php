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
$editor = JFactory::getEditor();
$model = $this->getModel ( 'configration' );
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');
JHtml::_('behavior.combobox');
JHtml::_('behavior.keepalive');

?>
<script language="javascript" type="text/javascript">
	function submitbutton(pressbutton) {
		var form = document.adminForm;
		if (pressbutton == 'cancel') {
			submitform( pressbutton );
			return;
		}
		else {
			submitform( pressbutton );
		}
	}
</script>

<form action="<?php echo JRoute::_($uri->toString()); ?>" method="post" name="adminForm" id="adminForm" enctype="multipart/form-data">
  <div class="col50">
    <fieldset class="adminform">
    <legend><?php echo JText::_( 'DETAILS' ); ?></legend>
    <table class="admintable">
	<!--		<tr>
      		<td width="100" align="right" class="key" >
    			<?php //echo JText::_( 'ALLOW_TO_SHOW_CATEOGRY_IN_FRONT_END');?>
      		</td>
      		<td>
      			<?php  //echo $this->lists['cat_id'];?>
      		</td>
    	</tr>
      <tr>
        	<td width="100" align="right" class="key" >
				<label for="name">
					<?php echo JText::_( 'THUMB_WIDTH' ); ?>: 
				</label>
        	</td>
        	<td><input class="text_area" type="text" name="width" id="width" size="5" value="<?php echo $this->detail->width;?>" /></td>
      	</tr>
		<tr>
        	<td width="100" align="right" class="key" >
				<label for="name">
					<?php echo JText::_( 'THUMB_HEIGHT' ); ?>: 
				</label>
        	</td>
        	<td><input class="text_area" type="text" name="height" id="height" size="5" value="<?php echo $this->detail->height;?>" /></td>
      	</tr>
		<tr>
        	<td width="100" align="right" class="key" >
				<label for="name">
					<?php echo JText::_( 'CURRENCY' ); ?>: 
				</label>
        	</td>
        	<td><input class="text_area" type="text" name="currency" id="currency" size="5" value="<?php echo $this->detail->currency;?>" /></td>
      	</tr>
		   <tr>
			<td width="100" align="right" class="key" >
				<label for="name">
					<?php echo JText::_( 'HOST_TEMPLATE' ); ?>:
				</label>
			</td>
			<td>
				 <?php echo $editor->display("host_tempt",$this->detail->host_tempt,'400','200','100','20','0'); ?>
			</td>
		</tr>
        <tr>
		<td align="right" class="key">
				<label for="name">
					<?php echo JText::_( 'NOTE' ); ?>:
				</label>
			</td>
			<td>
			
					<?php echo 'If you write <b>{hostname}</b> in above editor it will display owner .<b>{property_name}</b> in Front end side.If you write <b>{chekin}</b> & <b>{chekout}</b> in above editor it will display <b>checkin </b> date to <b>chekout</b> date in Front end side. If you write <b>{amount}</b> in above editor it will display total amount  in Front end side.'; ?><br />
							
			</td>
		</tr>-->
		   <tr>
			<td width="100" align="right" class="key" >
				<label for="name">
					<?php echo JText::_( 'MAIL_TEMPLATE' ); ?>:
				</label>
			</td>
			<td>
				 <?php echo $editor->display("mail_tempt",$this->detail->mail_tempt,'800','400','100','20','0'); ?>
			</td>
		</tr>
      <!--  <tr>
		<td align="right" class="key">
				<label for="name">
					<?php echo JText::_( 'NOTE' ); ?>:
				</label>
			</td>
			<td>
			
					<?php echo 'If you write <b>{hostname}</b> in above editor it will display owner .<b>{property_name}</b> in Front end side.If you write <b>{chekin}</b> & <b>{chekout}</b> in above editor it will display <b>checkin </b> date to <b>chekout</b> date in Front end side. If you write <b>{amount}</b> in above editor it will display total amount  in Front end side.'; ?><br />
							
			</td>
		</tr>
         <tr>
			<td width="100" align="right" class="key" >
				<label for="name">
					<?php echo JText::_( 'CONFIRM_TEMPLATE' ); ?>:
				</label>
			</td>
			<td>
				 <?php echo $editor->display("confirm_tempt",$this->detail->confirm_tempt,'400','200','100','20','0'); ?>
			</td>
		</tr>
        <tr>
		<td align="right" class="key">
				<label for="name">
					<?php echo JText::_( 'NOTE' ); ?>:
				</label>
			</td>
			<td>
			
					<?php echo 'If you write <b>{hostname}</b> in above editor it will display owner .<b>{property_name}</b> in Front end side.If you write <b>{chekin}</b> & <b>{chekout}</b> in above editor it will display <b>checkin </b> date to <b>chekout</b> date in Front end side. If you write <b>{amount}</b> in above editor it will display total amount  in Front end side.'; ?><br />
							
			</td>
		</tr>-->
    </table>
    </fieldset>
  </div>
  <div class="clr"></div>
  <input type="hidden" name="cid[]" value="<?php echo $this->detail->id; ?>" />
  <input type="hidden" name="task" value="" />
  <input type="hidden" name="view" value="configration" />
</form>
