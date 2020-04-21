<?php 
/**
* @package   JE Ecard
* @copyright Copyright (C) 2009 - 2010 Open Source Matters. All rights reserved.
* @license   http://www.gnu.org/licenses/lgpl.html GNU/LGPL, see LICENSE.php
* Contact to : emailtohardik@gmail.com, joomextensions@gmail.com
* Visit : http://www.joomlaextensions.co.in/
**/ 

defined('_JEXEC') or die('Restricted access');
$userid =  clone(JFactory::getUser());
$mainframe = JFactory::getApplication();
JHTML::_('behavior.tooltip');
if($userid->id){
$option = JRequest::getWord('option','','','string');
$document 	=	JFactory::getDocument();
$option = JRequest::getVar('option','','request','string'); 
$uri 	= JFactory::getURI();
$url	= $uri->root();

$link 		=	JRoute::_( 'index.php?option='.$option.'&view=group_detail&task=edit' );
$link2		=	JRoute::_( 'index.php?option='.$option.'&view=cid[]&task=logout');


?>

<form action="<?php echo 'index.php?option='.$option; ?>" method="post" name="adminForm"  enctype="multipart/form-data" >
  
  <div class="formHeading">
    
    <div id="editcell">
      <table width="100%" class="htmlForm">
        <thead>
          <tr>
            <td class="formHeading"><strong><?php echo JText::_( 'NUM' ); ?> </strong></td>
			<td><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $this->test ); ?>);" /></td>
			<td class="formHeading"><strong><?php echo JText::_('CONTACT_NAME' ); ?> </strong></td>
			<td class="formHeading"><strong><?php echo JText::_('CONTACT_EMAIL' ); ?></strong> </td>
            
          </tr>
        </thead>
        <?php 
	$k = 0;	
	
	for ($i=0;$i<count($this->test);$i++)
	{
		$row =$this->test[$i];
		
		$link 	= JRoute::_( 'index.php?option='.$option.'&view=contact_detail&task=edit&cid[]='. $row->cid );
		$link1 	=JRoute::_( 'index.php?option='.$option.'&view=contact_detail&task=remove&cid[]='. $row->cid );

		//$published 	= JHTML::_('grid.published', $row, $i );
 
		?>
        <tr class="<?php echo "row$k"; ?>">
          <td align="center" ><?php echo $row->cid;  ?> </td>
		  <td class="order"><?php echo JHTML::_('grid.id', $i, $row->cid); ?></td>
		  <td  ><?php echo $row->contact_name; ?> </td>
		  <td  ><?php echo $row->contact_email; ?> </td>
         
        </tr>
        <?php
		$k = 1 - $k;
	}	
	?>
	<!--<tr><td colspan="5" align="center"><?php echo $this->pagination->getPagesLinks(); ?> </td></tr>-->
      </table>
    </div>

    <input type="hidden" name="view" value="contact_detail" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="option" value="<?php echo $option;?>" />
    <input type="hidden" name="boxchecked" value="0" />
    <input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
    <input type="hidden" name="filter_order_Dir" value="<?php echo $this->lists['order_Dir']; ?>" />
  </div>
</form>
<?php 
}else{
	$return = 'index.php';
	$mainframe->redirect( $return );	

}
?>
