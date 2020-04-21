<?php 
 /**
 * @package ODude ECard
 * @author ODude.com
 * @copyright (C) 2014 ODude Network. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 **/

defined('_JEXEC') or die('Restricted access');
JHTML::_('behavior.tooltip');
JHTML::_('behavior.formvalidation');
JHTML::_('behavior.framework');
JHTML::_('behavior.modal');
 require_once ( JPATH_SITE .DS.'components'.DS.'com_odudecard'.DS.'include'.DS.'lib.php' );
global $mainframe;
	$mainframe= JFactory::getApplication();
	$option 	= JRequest::getVar('option');
	
    $db = JFactory::getDBO();
	
	$filter_order= $mainframe->getUserStateFromRequest( $option.'filter_order','filter_order','id','cmd' );
	$filter_order_Dir= $mainframe->getUserStateFromRequest( $option.'filter_order_Dir',	'filter_order_Dir','','word' );
	$filter_order     = $mainframe->getUserStateFromRequest($option . '.filter_order', 'filter_order', 'ordering', 'cmd');
	$filter_state = $mainframe-> getUserStateFromRequest( $option.'filter_state', 	'filter_state', '','word' );
	$search_cat = $mainframe-> getUserStateFromRequest( $option.'search_cat', 'search_cat','','string' );
	$search_cat = JString::strtolower( $search_cat );
	
// table ordering
	$lists['order_Dir']	= $filter_order_Dir;
	$lists['order']		= $filter_order;	
// search filter	
    $lists['search_cat']= $search_cat;
	
		function getCategory()
    {
       
		   $db = JFactory::getDBO();
			$query = "select * from #__ecard_cate where subcat='0' order by ordering asc";
			$db->setQuery($query);
			$rows = $db -> loadObjectList();
			return $rows;
		
    }
 ?>
 
 <?php
 
 function buttonUp($prev_order,$prev_id,$current_order,$current_id,$next_order,$next_id)
				{
					$where=JRequest::getVar('where','');
					$cat=JRequest::getVar('cat','');
					$filter_order_Dir = JRequest::getVar('filter_order_Dir','asc');
					
					$upurl='index.php?option=com_odudecard&cat='.$cat.'&where='.$where.'&filter_order=ordering&filter_order_Dir='.$filter_order_Dir.'&pi='.$prev_id.'&po='.$prev_order.'&ci='.$current_id.'&co='.$current_order.'&go=up';
					echo "<a href=\"".$upurl."\" rel=\"tooltip\" class=\"saveorder btn btn-micro pull-right\" title=\"\" data-original-title=\"Move Up\">UP</a>";
				}	
					

				function buttonDown($prev_order,$prev_id,$current_order,$current_id,$next_order,$next_id)
				{
					$where=JRequest::getVar('where','');
					$cat=JRequest::getVar('cat','');
					$filter_order_Dir = JRequest::getVar('filter_order_Dir','asc');
					
					$upurl='index.php?option=com_odudecard&cat='.$cat.'&where='.$where.'&filter_order=ordering&filter_order_Dir='.$filter_order_Dir.'&ni='.$next_id.'&no='.$next_order.'&ci='.$current_id.'&co='.$current_order.'&go=down';	
					echo "<a href=\"".$upurl."\" rel=\"tooltip\" class=\"saveorder btn btn-micro pull-right\" title=\"\" data-original-title=\"Move Down\">Down</a>";
						
	
				}

			
				?>
<form id="adminForm1" action="<?php echo JRoute::_( 'index.php' );?>" method="post" name="adminForm1">
<div class="btn-wrapper input-append">
			<input type="text" name="where" id="where" value="<?php echo JRequest::getVar('where',''); ?>" class="text_area" onchange="document.adminForm1.submit();" placeholder="Search Category" />	<button type="submit" class="btn hasTooltip" title="" data-original-title="Search">
				<i class="icon-search"></i>
			</button>
			
		</div>


<input type="hidden" name="option" value="com_odudecard" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="boxchecked" value="0" />
<input type="hidden" name="controller" value="odudecardcatnew" />
</form>

<form id="adminForm2" action="<?php echo JRoute::_( 'index.php' );?>" method="post" name="adminForm2">

		
		 <select name="cat" id="cat" class="text_area" onchange="document.adminForm2.submit();">
				          
                          <?php
	
		
		echo "<option value=0 >All Ecards</option><option value=0>---------------</option>";

		
		$subcat=getCategory();
				
		for( $j=0; $j<count($subcat); $j++ )
		{
		$subcategory = $subcat[$j];
		
					$check="";
					if(JRequest::getVar('cat','')==$subcategory->cat)
					$check="selected=selected";
		
		//if($subcategory->cat!=$this->odudecard->cat)
		echo "\n\r<option value='".$subcategory->cat."' ".$check.">".$subcategory->name."</option>";
		
		}
						  ?>
				          

			            </select> <?php echo JText::_( 'Filter Sub Category' ); ?>

<input type="hidden" name="option" value="com_odudecard" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="boxchecked" value="0" />
<input type="hidden" name="controller" value="odudecardcatnew" />
</form>

<form id="adminForm" action="<?php echo JRoute::_( 'index.php' );?>" method="post" name="adminForm">
<div id="editcell">
	<table class="table table-striped">
	<thead>
		<tr>
			<th width="5">
				<?php echo JText::_( 'ID' ); ?>
			</th>
			<th width="20">
				<input type="checkbox" name="toggle" value="" onclick="Joomla.checkAll(this)" />
			</th>			
			<th>
				<?php echo JHTML::_('grid.sort',   'Categories', 'name', @$lists['order_Dir'], @$lists['order'] ); ?>
			</th>
			  <th>
				<?php echo JText::_( 'Alias' ); ?>
			</th>
             <th>
				<?php echo JText::_( 'Type' ); ?>
			</th>
			<th width="1%" nowrap="nowrap"><?php echo JHTML::_('grid.sort', 'Order', 'ordering', @$lists['order_Dir'], @$lists['order']);?></th>
			<th width="1%"><?php if($lists['order']=='ordering') echo JHTML::_('grid.order', '', 'filesave.png', 'saveorder' ); ?></th>
						
            <th>
				<?php echo JText::_( 'Highlighted' ); ?>
			</th>
		</tr>
	</thead>
	<?php
	$k = 0;
	for ($i=0, $n=count( $this->items ); $i < $n; $i++)	{
		$row = &$this->items[$i];
		
		if($i!=0)
		$previous_row=&$this->items[$i-1];
	else
		$previous_row=&$this->items[$i+1];
	
	
		if($i!=(count( $this->items ))-1)
		$next_row=&$this->items[$i+1];
	else
		$next_row=&$this->items[$i-1];
		
		$checked 	= JHTML::_('grid.id',   $i, $row->cat );
		$link 		= JRoute::_( 'index.php?option=com_odudecard&controller=odudecard&task=edit&cid[]='.$row->cat );
		?>
		<tr class="row<?php echo $i % 2; ?>">
			<td>
				<?php echo $row->cat; ?>
			</td>
			<td>
				<?php echo $checked; ?>
			</td>
			<td>
			<?php echo $row->name; ?> <a href="<?php echo $link; ?>">[Edit]</a> &nbsp; | &nbsp; [<a target=_blank href="<?php echo JURI::root()."index.php?option=com_odudecard&controller=odudevideocreate&cate=".$row->cat; ?>">Post Video</a>] &nbsp; | &nbsp; [<a target=_blank href="<?php echo JURI::root()."index.php?option=com_odudecard&controller=odudetubecreate&cate=".$row->cat; ?>">Post YouTube</a>]
			</td>
			 <td>
				<?php
				
				if($row->slug=="")
					makeAlias($row->name,'cate',$row->cat);
			
				echo $row->slug;


				?>
			</td>
            <td>
				<?php echo $row->subcat=='0'?'Primary':'Sub Category'; ?>
			</td>
				<td class="order" colspan="2">
				
				
				<?php 
				if($i==0 || $i==count( $this->items )-1)
				{
					echo "";
				}
				else
				{
					if($lists['order']=='ordering')
					{
						buttonUp($previous_row->ordering,$previous_row->cat,$row->ordering,$row->cat,$next_row->ordering,$next_row->cat);
						buttonDown($previous_row->ordering,$previous_row->cat,$row->ordering,$row->cat,$next_row->ordering,$next_row->cat);
					}
				}
				?>


				<input type="text" name="order[]" size="5" value="<?php echo $row->ordering; ?>" class="text_area" style="text-align: center" />
			</td>
            	<td>
				<?php echo $row->front=='Y'?'<b>YES</b>':''; ?>
			</td>
		</tr>
		<?php
		$k = 1 - $k;
	}
	?>
	</table>
</div>

	<input type="hidden" name="where" value="<?php echo JRequest::getVar('where',''); ?>" />
		<input type="hidden" name="cat" value="<?php echo JRequest::getVar('cat',''); ?>" />
	<input type="hidden" name="filter_order" value="<?php echo $lists['order']; ?>" />
	    <input type="hidden" name="filter_order_Dir" value="<?php  echo $lists['order_Dir']; ?>" />  
<input type="hidden" name="option" value="com_odudecard" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="boxchecked" value="0" />
<input type="hidden" name="controller" value="odudecardcatnew" />

</form>
