<?php 
/**
* @package   JE Ecard
* @copyright Copyright (C) 2009 - 2010 Open Source Matters. All rights reserved.
* @license   http://www.gnu.org/licenses/lgpl.html GNU/LGPL, see LICENSE.php
* Contact to : emailtohardik@gmail.com, joomextensions@gmail.com
* Visit : http://www.joomlaextensions.co.in/
**/

defined('_JEXEC') or die('Restricted access');
$option = JRequest::getVar('option','','request','string');
$search = JRequest::getVar('field_search');
?>
<script language="javascript" type="text/javascript">

Joomla.submitform =function submitform(pressbutton){
 
var form = document.adminForm;
   if (pressbutton)
    {form.task.value=pressbutton;}
     
	 if ((pressbutton=='add')||(pressbutton=='edit')||(pressbutton=='publish')||(pressbutton=='unpublish')
	 ||(pressbutton=='remove') )
	 {
	 //alert("any button is pressed");		 
	  form.view.value="fields_detail";
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
	  form.view.value="category_detail";
	 }
	try {
		form.onsubmit();
		}
	catch(e){}
	
	form.submit();

}

</script>

<form action="<?php echo 'index.php?option='.$option; ?>" method="post" name="adminForm" >
  <div id="editcell">
    <table class="adminlist">
      <label style="font-weight:bold"></label>
      <thead>
        <tr>
          <td colspan="7"><b><?php echo JText::_( 'FORM' ); ?>:</b> <?php echo $this->lists['formdata']; ?>
            <input type="submit" name="search" value="Go" /></td>
        </tr>
        <tr>
          <td colspan="7"><b><?php echo JText::_( 'FIELD_SEARCH' ); ?>:</b>
            <input type="text" name="field_search" id="field_search" value="<?php echo $search;?>"/>
            <input type="submit" name="search1" value="Search" /></td>
        </tr>
        <tr>
          <th width="5"> <?php echo JText::_( 'NUM' ); ?> </th>
          <th width="20"> <input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $this->fields ); ?>);" />
          </th>
          <th class="title"> <?php echo JHTML::_('grid.sort', 'FIELD_TITLE', 'field_title', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>
          <th class="title"> <?php echo JHTML::_('grid.sort', 'FIELD_NAME', 'field_name', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>
          <th class="title"> <?php echo JHTML::_('grid.sort', 'FIELD_TYPE', 'field_type', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>
          <th> <?php echo JHTML::_('grid.sort','FORM_NAME', 'field_section', $this->lists['order_Dir'], $this->lists['order']); ?> </th>
          <th width="5%" nowrap="nowrap"> <?php echo JHTML::_('grid.sort', 'PUBLISHED', 'published', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>
          <th width="5%" nowrap="nowrap"> <?php echo JHTML::_('grid.sort', 'ID', 'field_id', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>
        </tr>
      </thead>
      <?php
	$k = 0;
	//echo '<pre>';
//	print_r($this->fields);
//	exit;
	for ($i=0, $n=count( $this->fields ); $i < $n; $i++)
	{
		$row =$this->fields[$i];
        $row->id = $row->field_id;
		$link 	= JRoute::_( 'index.php?option='.$option.'&view=fields_detail&task=edit&cid[]='. $row->field_id );
		
		$published 	= JHTML::_('grid.published', $row, $i );		
		
		?>
      <tr class="<?php echo "row$k"; ?>">
        <td ><?php echo $this->pagination->getRowOffset( $i ); ?> </td>
        <td><?php echo JHTML::_('grid.id', $i, $row->id ); ?> </td>
        <td width="30%"><a href="<?php echo $link; ?>" title="<?php echo JText::_( 'EDIT_FIELDS' ); ?>"><?php echo $row->field_title; ?></a> </td>
        <td width="30%"><?php echo $row->field_name; ?> </td>
        <td width="30%"><?php
			    if ($row->field_type == 1) echo JText::_( 'TEXT_FIELD' );
			elseif ($row->field_type == 2) echo JText::_( 'TEXT_AREA' );
			elseif ($row->field_type == 3) echo JText::_( 'CHECK_BOX' );
			elseif ($row->field_type == 4) echo JText::_( 'RADIO_BUTTON' );
			elseif ($row->field_type == 5) echo JText::_( 'SELECT_BOX_SINGLE_SELECT' );
			elseif ($row->field_type == 6) echo JText::_( 'SELECT_BOX_MULTIPLE_SELECT' );
			elseif ($row->field_type == 7) echo JText::_( 'SELECT_COUNTRY_BOX' );
			elseif ($row->field_type == 9) echo JText::_( 'FILE' );
			elseif ($row->field_type == 8) echo JText::_( 'WYSIWYG' );
			elseif ($row->field_type == 10) echo JText::_( 'HR_TAG' );
			elseif ($row->field_type == 11) echo JText::_( 'LABEL' );
			elseif ($row->field_type == 12) echo JText::_( 'DATE' );
			elseif ($row->field_type == 13) echo JText::_( 'PASSWORD' );
			
			else  echo JText::_( 'SELECT_BOX' );
			 
			?>
        </td>
        <td class="order" width="30%"><?php // This field is taken model fields.php as  frm.name as frmname in query //
						echo $row->frmname;
					 //-----------------------------------------------------------------------//
				?>
        </td>
        <td align="center" width="5%"><?php echo $published;?> </td>
        <td align="center" width="5%"><?php echo $row->field_id; ?> </td>
      </tr>
      <?php
		$k = 1 - $k;
	}
	?>
      <tfoot>
      <td colspan="9"><?php echo $this->pagination->getListFooter(); ?> </td>
        </tfoot>
    </table>
  </div>
  <input type="hidden" name="view" value="fields" />
  <input type="hidden" name="task" value="" />
  <input type="hidden" name="boxchecked" value="0" />
  <input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
  <input type="hidden" name="filter_order_Dir" value="<?php echo $this->lists['order_Dir']; ?>" />
</form>
