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
$search	= JRequest::getVar('serachtext', '','request','string');
$ordering = ($this->lists['order'] == 'ordering');
$listOrder	= $this->escape($this->lists['order']);
$listDirn	= $this->escape($this->lists['order_Dir']);
$saveOrder	= $listOrder == 'ordering';
if($saveOrder)
{
	$saveOrderingUrl = 'index.php?tmpl=component&option=com_jeecard&view=event&task=saveOrderAjax';
	JHtml::_('sortablelist.sortable', 'list2', 'adminForm', strtolower($listDirn), $saveOrderingUrl);
}
$sortFields = $this->getSortFields();


?>
<script type="text/javascript">
	Joomla.orderTable = function()
	{
		table = document.getElementById("sortTable");
		direction = document.getElementById("directionTable");
		order = table.options[table.selectedIndex].value;
		if (order != '<?php echo $listOrder; ?>') 
		{
			dirn = 'asc';
		} 
		else 
		{
			dirn = direction.options[direction.selectedIndex].value;
		}
		Joomla.tableOrdering(order, dirn, '');
	}
</script>
<script language="javascript" type="text/javascript">

Joomla.submitform =function submitform(pressbutton){
var form = document.adminForm;
   if (pressbutton)
    {form.task.value=pressbutton;}
     
	 
	 if ((pressbutton=='add')||(pressbutton=='edit')||(pressbutton=='publish')||(pressbutton=='unpublish')
	 ||(pressbutton=='remove')|| (pressbutton=='copy') )
	 {		 
	  form.view.value="event_detail";
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
	  form.view.value="event_detail";
	 }
	try {
		form.onsubmit();
		}
	catch(e){}
	form.submit();
}

function selectsearch() {
var form = document.adminForm;
document.getElementById("serachtext").value = '';
form.submit();
}

</script>
<form action="<?php echo 'index.php?option='.$option; ?>" method="post" name="adminForm" id="adminForm" >
<div id="editcell">
 	<table width="100%" border="0">
		<tr>
			 <td><?php echo JText::_( 'FILTER' ); ?>
          <input type="text" name="serachtext" value="<?php echo $search;?>" id="serachtext"/>
         <input type="submit" name="search" value="search"/>
         <input type="submit" name="reset" value="reset" onclick="return selectsearch();"/>
          <input type="hidden" name="reset" value="reset" /></td>
			<td align="right"><b><?php echo JText::_( 'Search :' ); ?></b></td>
			<td align="right" width="130px"><?php echo $this->searchlists['allcategory']; ?></td>
		<!--	<td align="right" width="130px"><?php //echo $this->searchlists['allevent']; ?></td>-->
			<td align="right" width="130px"><?php echo $this->searchlists['published']; ?></td>
		</tr>
	</table>
	<table class="table table-striped" id="list2">
	<thead>
		<tr>
			<!----------------------------------------For Ordering ------------------------------------------>
			<th width="1%" class="nowrap center hidden-phone">
				<?php echo JHtml::_('grid.sort', '<i class="icon-menu-2"></i>', 'ordering', $listDirn, $listOrder, null, 'asc', 'JGRID_HEADING_ORDERING'); ?>
			</th>
			<!----------------------------------------For Ordering ------------------------------------------>

			<th width="5%">
				<?php echo JText::_( 'NUM' ); ?>
			</th>
			<th width="5%" class="title">
				<input type="checkbox" name="toggle" value="" onclick="Joomla.checkAll(this);" />
			</th>
			
			<th class="title" >
				<?php echo JHTML::_('grid.sort', 'EVENT_ID', 'eventid', $this->lists['order_Dir'], $this->lists['order'] ); ?>				
			</th>
			
			<th class="title"  width="20%">
				<?php echo JHTML::_('grid.sort', 'NAME', 'name', $this->lists['order_Dir'], $this->lists['order'] ); ?>				
			</th>
			
			<th class="title">
				<?php echo JHTML::_('grid.sort','CATEGORY', 'catid', $this->lists['order_Dir'], $this->lists['order']); ?>
			</th>
			<th class="title">
				<?php echo JHTML::_('grid.sort','USER', 'user_id', $this->lists['order_Dir'], $this->lists['order']); ?>
			</th>
			<th width="5%" nowrap="nowrap">
				<?php echo JHTML::_('grid.sort', 'PUBLISHED', 'published', $this->lists['order_Dir'], $this->lists['order'] ); ?>	
			</th>					 
			 
					
		</tr>
	</thead>
	<?php
	$k = 0;
	 
	for ($i=0, $n=count( $this->event ); $i < $n; $i++)
	{
	
		$row =$this->event[$i];
		
		@$user	= clone(JFactory::getuser($row->user_id));
		
        $row->id = $row->eventid;
		$link 	= JRoute::_( 'index.php?option='.$option.'&view=event_detail&task=edit&cid[]='. $row->id );
		
		$published 	= JHTML::_('grid.published', $row, $i );		
		
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
				<?php  echo $row->id; ?>
			</td>
			<td align="center">
			<a href="<?php echo $link; ?>" title="<?php echo JText::_( 'EDIT_TAG' ); ?>"><?php echo $row->name; ?></a>
			</td>
			
			<td align="center">
				<?php  echo $row->category; ?>
			</td>
			
			<td align="center">
				<?php  echo $user->username; ?>
			</td>
			<td class="center">
		       <div class="btn-group">
				<?php echo JHtml::_('jgrid.published', $row->published, $i, '', 'cb'); ?>
			  </div>
		  </td>
		</tr>
		<?php
		$k = 1 - $k;
	}
	?>	

<tfoot>
		<td colspan="9">
			<?php echo $this->pagination->getListFooter(); ?>
		</td>
	</tfoot>
	</table>
</div>

<input type="hidden" name="view" value="event" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="boxchecked" value="0" />
<input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
<input type="hidden" name="filter_order_Dir" value="<?php echo $this->lists['order_Dir']; ?>" />
<?php echo JHTML::_( 'form.token' ); ?>
</form>