<?php 
/**
* @package   JE Ecard
* @copyright Copyright (C) 2009 - 2010 Open Source Matters. All rights reserved.
* @license   http://www.gnu.org/licenses/lgpl.html GNU/LGPL, see LICENSE.php
* Contact to : emailtohardik@gmail.com, joomextensions@gmail.com
* Visit : http://www.joomlaextensions.co.in/
**/  

defined('_JEXEC') or die('Restricted access');
JHTML::_('behavior.tooltip');
JHTMLBehavior::modal();
$mainframe = JFactory::getApplication();
$doc = JFactory::getDocument();
$uri = JURI::getInstance();
$url= $uri->root();
$Itemid = JRequest::getVar('Itemid','','','int');
$import_contact = JRoute::_('index.php?option=com_openinviter&tmpl=component&Itemid='.$Itemid);
$fetch_group = JRoute::_('index.php?option=com_jeecard&view=fetch_group&tmpl=component&Itemid='.$Itemid);
$fetch_contact = JRoute::_('index.php?option=com_jeecard&view=fetch_contact&tmpl=component&Itemid='.$Itemid);
$userid =  clone(JFactory::getUser());

if($userid->guest)
{
	$return = 'index.php';
	$mainframe->redirect( $return );	
}
?>


<form action="<?php echo 'index.php?option='.$option; ?>" method="post" name="adminForm" enctype="multipart/form-data" >

<div>
<h3> contact </h3>
<table width="100%" border="1">
<tr>
<td><a rel="{handler: 'iframe', size: {x: 600, y: 500}}" href="<?php echo $fetch_group; ?>" class="modal"><?php echo JText::_('SELECT_GROUP'); ?></a></td>
<td><a rel="{handler: 'iframe', size: {x: 600, y: 500}}" href="<?php echo $fetch_contact; ?>" class="modal"><?php echo JText::_('SELECT_CONTACT'); ?></a></td>
<td><a rel="{handler: 'iframe', size: {x: 600, y: 400}}" href="<?php echo $import_contact; ?>" class="modal"><?php echo JText::_('IMPORT_CONTACT'); ?></a></td>
</tr>
	
	
</table>
</div>
<div style="clear:both;"></div>  
<input type="hidden" name="Itemid" value="<?php echo $Itemid; ?>" />				
<input type="hidden" name="option" value="<?php echo $option;?>">
<input type="hidden" name="view" value="event_list" />
<input type="hidden" name="task" id="task" value="" />
<input type="hidden" name="eventid" id="eventid" value="" />
<input type="hidden" name="boxchecked" value="0" />
<!--<input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
<input type="hidden" name="filter_order_Dir" value="<?php echo $this->lists['order_Dir']; ?>" />-->
</form>

