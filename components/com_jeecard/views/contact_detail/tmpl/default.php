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
if($userid->id){	

$editor = JFactory::getEditor();
$uri = JURI::getInstance();
$url= $uri->root();
$option = JRequest::getVar('option','','','string'); 
$document =JFactory::getDocument();
$tmpl = JRequest::getVar('tmpl','','','string');
$link=JRoute::_($url.'index.php?option='.$option);

//$document->addStyleSheet('components/'.$option.'/assets/css/style.css');

?>
<script language="javascript" type="text/javascript">

	function submitbutton(pressbutton) 
	{		
		var form = document.adminForm;
		if (pressbutton == 'cancel') {
			submitform( pressbutton );
			return;
		}
		
			submitform( pressbutton );
		
	}
</script>
<?php


?>


<form action="<?php echo JRoute::_($this->request_url) ?>" method="post" name="hotelform" id="hotelform" enctype="multipart/form-data" >
  <input type="hidden"  name="jelive_url" id="jelive_url" value="<?php echo $url; ?>" />
  <div class="editcell">
    <div style="display: block;" id="content_1" class="content1">
        <table width="100%" class="htmlForm">
          
          <tr>
            <td ><label for="name"> <?php echo JText::_( 'CONTACT_NAME' ); ?>*: </label>
            </td>
            <td><input  type="text" name="contact_name" class="inputbox" id="contact_name" size="30"  value="<?php echo $this->detail->contact_name;?>" />
            </td>
          </tr>
         
          <tr>
            <td ><label for="name"> <?php echo JText::_( 'CONTACT_EMAIL' ); ?>*: </label>
            </td>
            <td><input  type="text" name="contact_email" class="inputbox" id="contact_email" size="30"  value="<?php echo $this->detail->contact_email;?>" />
            </td>
          </tr>
		  
          <tr>
            <td ><label for="name"> <?php echo JText::_( 'GROUP_NAME' ); ?>*: </label>
            </td>
            <td><?php echo $this->lists['group'];?>
            </td>
          </tr>
		  <tr>
		  <td>&nbsp;</td>
		  <td > <input type="submit" name="save_group" value="Submit" /></td>
		  </tr>
        
        </table>
      </div>
  </div>
 
 <input type="hidden" name="user_id" value="<?php echo $userid->id;?>" />
  <input type="hidden" name="option" value="com_jeecard" />
  <input type="hidden" name="task" id="task" value="save" />
  <input type="hidden" name="tmpl" id="tmpl" value="<?php echo $tmpl;?>" />
  <input type="hidden" name="view" value="contact_detail" />
  <input type="hidden" name="cid" value="<?php echo $this->detail->cid; ?>" />
  <?php echo JHTML::_( 'form.token' ); ?>
</form>
<?php  
}else{
	$return = JRoute::_('index.php');
	$mainframe->redirect( $return );	
}
?>
