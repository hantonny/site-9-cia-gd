<?php 
/**
* @package   JE Ecard
* @copyright Copyright (C) 2009 - 2010 Open Source Matters. All rights reserved.
* @license   http://www.gnu.org/licenses/lgpl.html GNU/LGPL, see LICENSE.php
* Contact to : emailtohardik@gmail.com, joomextensions@gmail.com
* Visit : http://www.joomlaextensions.co.in/
**/ 

defined('_JEXEC') or die('Restricted access');
 
$option = JRequest::getVar('option');
$filter = JRequest::getVar('filter');
$model = $this->getModel ( 'eventinvite' );

?>
<script language="javascript" type="text/javascript">

Joomla.submitform =function submitform(pressbutton){
var form = document.adminForm;
   if (pressbutton)
    {form.task.value=pressbutton;}
     
	 
	 if ((pressbutton=='add')||(pressbutton=='edit')||(pressbutton=='publish')||(pressbutton=='unpublish')
	 ||(pressbutton=='remove')|| (pressbutton=='copy') )
	 {		 
	  form.view.value="eventinvite_detail";
	 }
	try {
		form.onsubmit();
		}
	catch(e){}
	
	form.submit();
}

function submitform(pressbutton){
var form = document.adminForm;
   if (pressbutton)
    {form.task.value=pressbutton;}
	 if ((pressbutton=='publish')||(pressbutton=='unpublish'))
	 {		 
	  form.view.value="eventinvite_detail";
	 }
	try {
		form.onsubmit();
		}
	catch(e){}
	form.submit();
}

function selectsearch() {
var form = document.adminForm;
form.submit();
}

</script>

<form action="<?php echo 'index.php?option='.$option; ?>" method="post" name="adminForm" id="adminForm" >
<div id="editcell">
 	<table class="table table-striped">
	<thead>
		<tr>
			
			<th width="5%">
				<?php echo JText::_( 'NUM' ); ?>
			</th>
			<th width="5%" class="title">
				<input type="checkbox" name="toggle" value=""  onclick="Joomla.checkAll(this);" />
			</th >
			<th class="title">
				<?php echo JHTML::_('grid.sort','EVENT_TITLE', 'event_title', $this->lists['order_Dir'], $this->lists['order']); ?>
			</th>
			
			<th class="title"  width="20%">
				<?php echo JHTML::_('grid.sort', 'HOST_NAME', 'host', $this->lists['order_Dir'], $this->lists['order'] ); ?>				
			</th>
			<th class="title" >
				<?php echo JHTML::_('grid.sort', 'HOST_EMAIL', 'host_email', $this->lists['order_Dir'], $this->lists['order'] ); ?>				
			</th>
			
			<th class="title">
				<?php echo JText::_('RECEIVER'); //JHTML::_('grid.sort','RECEIVER', 'eventid', $this->lists['order_Dir'], $this->lists['order']); ?>
			</th>
			<!--<th width="5%" nowrap="nowrap">
				<?php echo JHTML::_('grid.sort', 'PUBLISHED', 'published', $this->lists['order_Dir'], $this->lists['order'] ); ?>	
			</th>-->				 
		</tr>
	</thead>
<?php
	$k = 0;
	for ($i=0, $n=count( $this->eventinvite ); $i < $n; $i++)
	{
		$row =$this->eventinvite[$i];
		$row->id = $row->eventlist_id;
		$link 	= JRoute::_( 'index.php?option='.$option.'&view=eventinvite_detail&task=edit&cid[]='. $row->id );
		//$published 	= JHTML::_('grid.published', $row, $i );
		$sent_emailids	= $model->getsentevents($row->id);	
		
		if(count($sent_emailids)!=0) {
			$event_sentemail	= implode(',',$sent_emailids);
		} else {
			$event_sentemail 	= '';
		}
?>
		<tr class="row<?php echo $i % 2; ?>" >
			<td class="order nowrap center hidden-phone">
			<?php 
				$disableClassName = '';
				$disabledLabel	  = '';
				if (!$saveOrder) :
					$disabledLabel    = JText::_('JORDERINGDISABLED');
					$disableClassName = 'inactive tip-top';
				endif; ?>
				<span class="sortable-handler hasTooltip <?php echo $disableClassName; ?>" title="<?php echo $disabledLabel; ?>">
					<i class="icon-menu"></i>
				</span>
				<input type="text" style="display:none" name="order[]" size="5" value="<?php echo $row->ordering; ?>" class="width-20 text-area-order " />
			</td>
			<td class="order">
				<?php echo $this->pagination->getRowOffset( $i ); ?>
			</td>
			<td class="order">
			<?php echo JHTML::_('grid.id', $i, $row->id ); ?>
			</td>
			<td align="center">
				<a href="<?php echo $link; ?>" title="<?php echo JText::_( 'EDIT_TAG' ); ?>"><?php  echo $row->event_title; ?></a>
			</td>
			<td align="center">
			<a href="<?php echo $link; ?>" title="<?php echo JText::_( 'EDIT_TAG' ); ?>"><?php echo $row->host; ?></a>
			</td>
			<td align="center">
				<?php  echo $row->host_email; ?>
			</td>
			<td align="center">
				<?php  echo $event_sentemail; ?>
			</td>
		</tr>
		<?php
		$k = 1 - $k;
	}
	?>	
<tfoot>
		<td colspan="10">
			<?php echo $this->pagination->getListFooter(); ?>
		</td>
	</tfoot>
	</table>
</div>
<input type="hidden" name="view" value="eventinvite" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="boxchecked" value="0" />
<input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
<input type="hidden" name="filter_order_Dir" value="<?php echo $this->lists['order_Dir']; ?>" />
<?php echo JHTML::_( 'form.token' ); ?>
</form>