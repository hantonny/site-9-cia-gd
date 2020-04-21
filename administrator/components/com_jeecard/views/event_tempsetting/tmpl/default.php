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
$uri = JURI::getInstance();
$url= $uri->root();
$option = JRequest::getVar('option','','','string');
$editor = JFactory::getEditor();
$model = $this->getModel ( 'event_tempsetting' );
?>
<script language="javascript" type="text/javascript">
	Joomla.submitform =function submitbutton(pressbutton) {
		var form = document.adminForm;
		if (pressbutton == 'cancel') {
			submitform( pressbutton );
			return;
		}
		else {
			submitform( pressbutton );
		}
	}
</script>

<form action="<?php echo JRoute::_($uri->toString()); ?>" method="post" name="adminForm" id="adminForm" enctype="multipart/form-data">
  <div class="col50">
    <fieldset class="adminform">
    <legend><?php echo JText::_( 'DETAILS' ); ?></legend>
    <table class="admintable">
      <tr>
        <td width="100" align="right" class="key" ><label for="name"> <?php echo JText::_( 'All Eventlist Template' ); ?>: </label>
        </td>
        <td><?php echo $editor->display("alleventlist_tempt",$this->detail->alleventlist_tempt,600,500,'100','20','1'); ?> </td>
      </tr>
      <tr>
        <td></td>
        <td><?php
					echo 'If you insert <b>{title}</b> into the above editor it will display the <b>Event Title</b> in Front End.  <br>Add any of the fields you want to have displayed in the Front End.<br /> '; 
					$fields=$model->getfields(2);
					$allevent_note ="{title},{gmap_icon},{description},{video_link},{event_date},{end_date},{date_link},{address},{catname},{gcal},{ical},{outlook},";		
						for($i=0;$i<count($fields);$i++)
						{
					
							$allevent_note.='{'.$fields[$i]->field_name.'},';
					
						}
						
						$allevent_note=substr($allevent_note,0,strlen($allevent_note)-1);
						
						echo '<b>'.$allevent_note.'</b>';
			?>
        </td>
      </tr>
      <tr>
        <td width="100" align="right" class="key" ><label for="name"> <?php echo JText::_( 'All Eventlist More Template' ); ?>: </label>
        </td>
        <td><?php echo $editor->display("alleventlist_more_tempt",$this->detail->alleventlist_more_tempt,600,500,'100','20','1'); ?> </td>
      </tr>
      <tr>
        <td></td>
        <td><?php		echo 'If you insert <b>{title}</b> into the above editor it will display the <b>Event Title</b> in Front End.<br />If you insert <b>{related_event}</b> into the above editor it will display the related events in Front End.<br>Add any of the fields you want to have displayed in the Front End.<br>'; 
			$fields1	= $model->getfields(2);
			$alleventmore_note ="{event_photo},{title},{description},{event_date},{date_link},{address},{google_map_icon},{event_detail_tab},{event_video_tab},{event_photo_tab},{google_map_tab},{related_event},{gcal},{ical},{outlook},";		
			for($j=0;$j<count($fields1);$j++)
			{
				$alleventmore_note.='{'.$fields1[$j]->field_name.'},';
			}
			$alleventmore_note=substr($alleventmore_note,0,strlen($alleventmore_note)-1);
			echo '<b>'.$alleventmore_note.'</b>';
?>
        </td>
      </tr>
      <tr>
        <td width="100" align="right" class="key" ><label for="name"> <?php echo JText::_( 'Event Createlist Template' ); ?>: </label>
        </td>
        <td><?php echo $editor->display("eventcrlist_tempt",$this->detail->eventcrlist_tempt,600,500,'100','20','1'); ?> </td>
      </tr>
      <tr>
        <td width="100" align="right" class="key" ><label for="name"> <?php echo JText::_( 'Date EventList Template' ); ?>: </label>
        </td>
        <td><?php echo $editor->display("dateevent_tempt",$this->detail->dateevent_tempt,600,500,'100','20','1'); 	?> </td>
      </tr>
      <tr>
        <td></td>
        <td><?php
					echo 'If you insert <b>{event_title}</b> in above editor it will display label like <b>Event</b> in Front end side. Insert for the fields which you display in front end side. <br /> {description_title} displays label like <b>Description</b><br> {enddate_title} displays label like <b>End Date</b><br> {city_title} displays label like <b>City</b><br> {image_title} displays label like <b>Image</b><br> {eventdetail} will display <b>Event Data</b> with above label title.';
			
			?>
        </td>
      </tr>
    </table>
    </fieldset>
  </div>
  <div class="clr"></div>
  <input type="hidden" name="id" value="<?php echo $this->detail->id; ?>" />
  <input type="hidden" name="task" value="" />
  <input type="hidden" name="view" value=" event_tempsetting" />
</form>
