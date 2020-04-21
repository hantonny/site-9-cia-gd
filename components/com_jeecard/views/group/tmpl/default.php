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
//$Itemid 	= JRequest::getVar('Itemid');
if($userid->id){
$option = JRequest::getWord('option','','','string');
$document 	=	JFactory::getDocument();
$option = JRequest::getVar('option','','request','string'); 
$uri 	= JFactory::getURI();
$url	= $uri->root();

$link 		=	JRoute::_( 'index.php?option='.$option.'&view=group_detail&task=edit' );
$link2		=	JRoute::_( 'index.php?option='.$option.'&view=cid[]&task=logout');

$image		=	$url."components/com_hbooking/assets/component_images/new_f2.png"; 
$image_dir	=	$url."components/com_hbooking/assets/component_images/icon_error.gif";

?>

<form action="<?php echo 'index.php?option='.$option; ?>" method="post" name="adminForm"  enctype="multipart/form-data" >
  
  <div class="formHeading">
    <table width="100%" border="0">
      <tr>
        <td width="100%" align="center" ><?php echo JText::_('GROUP');?></td>
        <td valign="bottom"  align="right"><a onclick="form.submit()">
          <input type="image"  width="28px" height="28px"  name="new" value="New" src="<?php echo $image; ?>"/>
          </a></td>
      </tr>
    </table>
    <div id="editcell">
      <table width="100%" class="htmlForm">
        <thead>
          <tr>
            <td class="formHeading"><?php echo JText::_( 'NUM' ); ?> </td>
            <td class="formHeading"><?php echo JText::_('GROUP_NAME'); ?> </td>
           
            <td class="formHeading"><?php echo JText::_('TASK'); ?> </td>
          </tr>
        </thead>
        <?php 
	$k = 0;	

	for ($i=0;$i<count($this->test);$i++)
	{
		$row =$this->test[$i];
		
		$link 	= JRoute::_( 'index.php?option='.$option.'&view=group_detail&task=edit&cid[]='. $row->groupid );
		$link1 	=JRoute::_( 'index.php?option='.$option.'&view=group_detail&task=remove&cid[]='. $row->groupid );

		$published 	= JHTML::_('grid.published', $row, $i );
 
		?>
        <tr class="<?php echo "row$k"; ?>">
          <td align="center" ><?php echo $row->groupid;  ?> </td>
          <td  ><?php echo $row->groupname; ?> </td>
          
         
          <td align="center" width="20%"><a href="<?php echo $link; ?>"> <?php echo JText::_('EDIT');?></a> / <a href="<?php echo $link1; ?>"><?php echo JText::_('DELETE');?></a> </td>
        </tr>
        <?php
		$k = 1 - $k;
	}	
	?>
	<tr><td colspan="4"><?php echo $this->pagination->getPagesLinks(); ?> </td></tr>
      </table>
    </div>
    <input type="hidden" name="h_id"  value="<?php echo $row->h_id; ?>" />
    <input type="hidden" name="view" value="group_detail" />
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
