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
$model = $this->getModel('eventstyle');  
?>
<script language="javascript" type="text/javascript">

Joomla.submitform =function submitform(pressbutton){
var form = document.adminForm;
   if (pressbutton)
    {form.task.value=pressbutton;}
     
	 
	 if ((pressbutton=='add')||(pressbutton=='edit')||(pressbutton=='publish')||(pressbutton=='unpublish')
	 ||(pressbutton=='remove')|| (pressbutton=='copy') )
	 {		 
	  form.view.value="eventstyle_detail";
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
	  form.view.value="eventstyle_detail";
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
<form action="<?php echo 'index.php?option='.$option; ?>" method="post" name="adminForm" id="adminForm">
<div id="editcell">
 	<table class="adminlist">
	<thead>
		<tr>
			<th width="5%">
				<?php echo JText::_( 'NUM' ); ?>
			</th>
			<th width="5%" class="title">
				<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $this->eventstyle ); ?>);" />
			</th >
			<th class="title"  width="20%">
				<?php echo JHTML::_('grid.sort', 'STYLE', 'style', $this->lists['order_Dir'], $this->lists['order'] ); ?>				
			</th>
			<th class="title"  width="10%">
				<?php echo JHTML::_('grid.sort', 'WHO', 'who', $this->lists['order_Dir'], $this->lists['order'] ); ?>				
			</th>
            	<th class="title"  width="10%">
				<?php echo JHTML::_('grid.sort', 'YES1', 'yes', $this->lists['order_Dir'], $this->lists['order'] ); ?>				
			</th>
            	<th class="title"  width="10%">
				<?php echo JHTML::_('grid.sort', 'Maybe', 'maybe', $this->lists['order_Dir'], $this->lists['order'] ); ?>				
			</th>
            	<th class="title"  width="10%">
				<?php echo JHTML::_('grid.sort', 'NO1', 'no', $this->lists['order_Dir'], $this->lists['order'] ); ?>				
			</th>
			
							 
		</tr>
	</thead>
	<?php
	$k = 0;
	 
	for ($i=0, $n=count( $this->eventstyle ); $i < $n; $i++)
	{
	
		$row =$this->eventstyle[$i];
		
        $row->id = $row->id;
		$link 	= JRoute::_( 'index.php?option='.$option.'&view=eventstyle_detail&task=edit&cid[]='. $row->id );
		
	
		
		?>
		<tr class="<?php echo "row$k"; ?>">
			<td class="order">
				<?php echo $this->pagination->getRowOffset( $i ); ?>
			</td>
			<td class="order">
			<?php echo JHTML::_('grid.id', $i, $row->id ); ?>
			</td>
			<td>
			<a href="<?php echo $link; ?>" title="<?php echo JText::_( 'EDIT_TAG' ); ?>"><?php echo $row->style; ?></a>
			</td>
			<td>
					<?php  echo $row->who; ?>
			</td>
            <td>
					<?php  echo $row->yes; ?>
			</td>
            <td>
					<?php  echo $row->maybe; ?>
			</td>
            <td>
					<?php  echo $row->no; ?>
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

<input type="hidden" name="view" value="eventstyle" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="boxchecked" value="0" />
<input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
<input type="hidden" name="filter_order_Dir" value="<?php echo $this->lists['order_Dir']; ?>" />
</form>