<?php
/**
* @package   JE Ecard
* @copyright Copyright (C) 2009 - 2010 Open Source Matters. All rights reserved.
* @license   http://www.gnu.org/licenses/lgpl.html GNU/LGPL, see LICENSE.php
* Contact to : emailtohardik@gmail.com, joomextensions@gmail.com
* Visit : http://www.joomlaextensions.co.in/
**/ 

defined('_JEXEC') or die('Restricted access');
 
$option = JRequest::getVar('option','','','string');
$filter = JRequest::getVar('filter'); 


$document =JFactory::getDocument();
$document->addScript( 'components/'.$option.'/assets/js/jquery_002.js' );
$document->addScript( 'components/'.$option.'/assets/js/jquery1.js' );
$document->addScript( 'components/'.$option.'/assets/js/jqueryTableDnDArticle.js' );

 

?>
<script>
function layoutvalidate()
{
	var form=document.adminForm;
	
	
	if(form.field_section.value==0)
	{
		alert("<?php echo JText::_( 'PLEASE_SELECT_FORM' ); ?>");
		return false;
	}
	return true;
}
</script>
<form action="<?php echo 'index.php?option='.$option; ?>" method="post" name="adminForm" >
<table width="100%" border="0" >
	<tr><td colspan="2">
		<?php echo $this->lists['formdata']; ?>
		<input type="submit" name="search" value="Go" onclick="return layoutvalidate()" /></td>
		
	</tr>
  <tr>
    
	<td width="15%">&nbsp; </td>
    <td width="50%">
	 
	<table id="table-2" cellpadding="2" cellspacing="0" border="1" style="border-collapse:collapse; border:1px solid #ccc;" width="50%">
	 
	 
<tbody align="left">
 	<?php 
	$k = 0;
	for ($i=0, $n=count( $this->fields ); $i <$n; $i++)
	{
		$row =$this->fields[$i];
        $row->id = $row->field_id;
		 	
		?>
		
		<tr style="cursor: move;" class="alt" id="<?php echo $row->id  ?>"><td height="25" align="right" id="<?php echo $row->id;  ?>">
			<?php 
			
			 echo "{".$row->field_name."} : "; 
			?></td><td><?php
			
			 if ($row->field_type == 1) echo JText::_( 'TEXT_FIELD' ) ;
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
			else  echo JText::_( 'Select Box</font>' );
			echo "<BR>";
			
			
			 }?></td>	
			
		</tr>
	  </table>
	  </div>
	  </td>
  </tr>
</table>
 
<div id="debugArea" style="float: right;">&nbsp;</div>

<label for="name" id="exp"></label>


<input type="hidden" name="view" value="form_layout" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="boxchecked" value="0" />
<input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
<input type="hidden" name="filter_order_Dir" value="<?php echo $this->lists['order_Dir']; ?>" />
</form>


