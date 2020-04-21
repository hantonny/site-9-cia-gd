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
JHTML::_('behavior.tooltip');
JHTMLBehavior::modal();
$mainframe = JFactory::getApplication();
//$Itemid 	= JRequest::getVar('Itemid');
if($userid->id){
$option = JRequest::getWord('option','','','string');
$document 	=	JFactory::getDocument();
$option = JRequest::getVar('option','','request','string'); 
$uri 	= JFactory::getURI();
$url	= $uri->root();
$document->addStylesheet($url."components/".$option."/assets/css/facebox.css");
$document->addScript($url."components/".$option."/assets/js/jquery.js");
$document->addScript($url."components/".$option."/assets/js/facebox.js");
$new_components = JRoute::_('index.php?option=com_openinviter&tmpl=component');
$static1	= $url."components/".$option."/assets/img/closelabel.png";
$static2	= $url."components/".$option."/assets/img/loading.gif";
$link 		=	JRoute::_( 'index.php?option='.$option.'&view=group_detail&task=edit' );
$link2		=	JRoute::_( 'index.php?option='.$option.'&view=cid[]&task=logout');
?><script type="text/javascript">
    jQuery(document).ready(function($) {
      $('a[rel*=facebox]').facebox({
        loadingImage : "<?php echo $static2; ?>",
        closeImage   : "<?php echo $static1; ?>"
      })
    })
  </script>
  <form action="<?php echo 'index.php?option='.$option; ?>" method="post" name="adminForm"  enctype="multipart/form-data" >
  <div class="formHeading">
  	<div id="editcell">
      <table width="100%" class="htmlForm">
        <thead>
        	<tr><td align="right" colspan="3" ><a rel="{handler: 'iframe', size: {x: 400, y: 400}}" href="<?php echo $new_components; ?>" class="modal"><?php echo JText::_('IMPORT_CONTACT'); ?></a></td></tr>
          <tr>
          <td>

				<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $this->test ); ?>);" />

			</td>
            <td class="formHeading"><?php echo JText::_( 'NUM' ); ?> </td>
			<td class="formHeading"><?php echo JText::_('EMAIL' ); ?> </td>
		          </tr>
        </thead>
        <?php 
	for ($i=0;$i<count($this->test);$i++)
	{
		$row =$this->test[$i];
	?>
        <tr >
        	<td class="order">

			<?php echo JHTML::_('grid.id', $i, $row->cid ); ?>

			</td>
          <td align="center" ><?php echo $row->contact_name;  ?> </td>
		  <td><?php echo $row->contact_email; ?> </td>
	
        </tr>
       <?php }	?>
      </table>
      <table cellpadding="0" cellspacing="0" border="0" align="center" width="100%">
<tr>
	<td valign="top" align="center">
		<?php echo $this->pagination->getPagesLinks(); ?>

	</td>
</tr>
<tr>
	<td valign="top" align="center">
		<?php echo $this->pagination->getPagesCounter(); ?>
	</td>
</tr>
</table>
    </div>

   
  </div>
</form>
<?php 
}else{
	$return = 'index.php';
	$mainframe->redirect( $return );	

}
?>
