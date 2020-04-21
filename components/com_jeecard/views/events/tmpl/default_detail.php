<?php 
/**
* @package   JE Ecard
* @copyright Copyright (C) 2009 - 2010 Open Source Matters. All rights reserved.
* @license   http://www.gnu.org/licenses/lgpl.html GNU/LGPL, see LICENSE.php
* Contact to : emailtohardik@gmail.com, joomextensions@gmail.com
* Visit : http://www.joomlaextensions.co.in/
**/  

defined('_JEXEC') or die('Restricted access');
$mosConfig_live_site = JURI :: base();
$doc = JFactory::getDocument();
JHTML::_('behavior.calendar');
jimport( 'joomla.utilities.date' );
	 
$db = JFactory::getDbo();
$option = JRequest::getVar('option','','request','string');
$doc->addStyleSheet("components/".$option."/assets/css/style.css");
$model = $this->getModel ( 'events' );
$setting= $model->getsetting();
$user 		= clone(JFactory::getUser());
$insert_user= $user->id;
$uri = JURI::getInstance();
$url= $uri->root();
$Itemid = JRequest::getVar('Itemid','','request','int');
$img_path	= $url.'/components/'.$option.'/assets/images/';
 $today = date("Y-m-d"); 
 $post = JRequest::get('post','','','string');
?>
<style type="text/css">
.dib_bg1{
	height:<?php echo $this->allevents->height; ?>px;
	width:<?php echo $this->allevents->width; ?>px;
	margin:0 auto;
background:url("<?php echo $img_path.$this->allevents->b_image;?>") <?php echo $this->allevents->color; ?> no-repeat;
}
</style>
<!--<script type="text/javascript" language="javascript">
function eventtitle(title,span){

document.getElementById(span).innerHTML = document.getElementById(title).value;

}
</script>-->
<table align="center" width="100%"><tr><td>
<div class="dib_bg1">
<?php  
  $mydata = $this->allevents->description; 
$mydata=str_replace('{title}','<span id="e_title_span">'.$post['event_title'].'</span>',$mydata);
$mydata=str_replace('{name}','<span id="host1_span">'.$post['host'].'</span>',$mydata);
$mydata=str_replace('{phone}','<span id="phone_span">'.$post['phone'].'</span>',$mydata);
$mydata=str_replace('{location}','<span id="location_span">'.$post['location_name'].'</span>',$mydata);
$mydata=str_replace('{address}','<span id="Address_span">'.$post['address'].'</span>',$mydata);
$mydata=str_replace('{city}','<span id="city_span">'.$post['city'].'</span>',$mydata);
$mydata=str_replace('{state}','<span id="state_span">'.$post['state'].'</span>',$mydata);
$mydata=str_replace('{date}','<span id="date_span">'.$today.'</span>',$mydata);
echo $mydata=str_replace('{time}','<span id="time_span">'.$post['event_time'].'</span>',$mydata);
?>
</div>
</td></tr></table>
<br clear="all" />
<!--<table cellpadding="5" width="72%" cellspacing="5">
	<tr>
		<td valign="top" width="25%"><h3>Will you attend?</h3></td>
        <td  width="25%"valign="top"><h3>Yes</h3></td>
        <td valign="top"><h3>Maybe</h3></td>
        <td valign="top" width="25%"><h3>No</h3></td>
   </tr>
</table>-->