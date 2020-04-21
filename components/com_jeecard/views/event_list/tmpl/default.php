<?php 
/**
* @package   JE Ecard
* @copyright Copyright (C) 2009 - 2010 Open Source Matters. All rights reserved.
* @license   http://www.gnu.org/licenses/lgpl.html GNU/LGPL, see LICENSE.php
* Contact to : emailtohardik@gmail.com, joomextensions@gmail.com
* Visit : http://www.joomlaextensions.co.in/
**/ 
 
defined('_JEXEC') or die('Restricted access');
$doc = JFactory::getDocument();
$uri = JURI::getInstance();
$url= $uri->root();
$model = $this->getModel ( 'event_list' );
$option = JRequest::getVar('option','','request','string');
$Itemid = JRequest::getVar('Itemid','','','int');
$mainframe = JFactory::getApplication();
$redconfig 	=$mainframe->getParams();
$cat_id		= $redconfig->get('cat_id');
$image_dir = $url.'/components/com_jeecard/assets/images/thumb_';
if($cat_id!=0) {
	$category_data 	= $model->getcategory($cat_id);
	$category_name	= $category_data->name;
} else {
	$category_name	= JText::_('ALL_CATEGORY');
}
?>
<form action="<?php echo 'index.php?option='.$option; ?>" method="post" name="adminForm" enctype="multipart/form-data" >
<div>
<h3> <?php echo $category_name;  ?> </h3>
<table width="100%" border="0">
<tr>
<?php $a=1;
	for($i=0;$i<count($this->eventlist);$i++){  ?>
	<td valign="top" width="33%"> 
		<table width="100%">
    		<tr>
    			<td  valign="top"><a href="<?php echo JRoute::_( 'index.php?option='.$option.'&view=events&event_id='. $this->eventlist[$i]->eventid ); ?>"><img src="<?php echo $image_dir.$this->eventlist[$i]->b_image; ?>"  width="200" height="100"/></a></td>
    		</tr>
			<tr>
   				<td valign="top"><?php echo $this->eventlist[$i]->name;  ?></td>
    		</tr>
		</table>
	</td>
	<?php if($a%3==0)
	 		echo '</tr><tr>';
	  		$a++;
	 }	
 ?>
</tr>
<tr>
	<td colspan="10" valign="top" align="center">
		<?php echo $this->pagination->getPagesLinks(); ?>
		<br /><br />
	</td>
</tr>
<tr>
	<td colspan="10" valign="top" align="center">
		<?php echo $this->pagination->getPagesCounter(); ?>
	</td>
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
</form>