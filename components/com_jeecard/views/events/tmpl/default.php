<?php 
/**
* @package   JE Ecard
* @copyright Copyright (C) 2009 - 2010 Open Source Matters. All rights reserved.
* @license   http://www.gnu.org/licenses/lgpl.html GNU/LGPL, see LICENSE.php
* Contact to : emailtohardik@gmail.com, joomextensions@gmail.com
* Visit : http://www.joomlaextensions.co.in/
**/  

defined('_JEXEC') or die('Restricted access');
JHTML::_('behavior.calendar');
JHTML::_('behavior.tooltip');
jimport( 'joomla.utilities.date' );
JHTMLBehavior::modal();

$doc = JFactory::getDocument();
$db = JFactory::getDbo();
$uri 	= JURI::getInstance();
$url	= $uri->root();
$model 	= $this->getModel ( 'events' );
$option = JRequest::getVar('option','','request','string');
$Itemid = JRequest::getVar('Itemid','','request','int');
$doc->addStyleSheet("components/".$option."/assets/css/style.css");
$doc->addscript("components/".$option."/assets/js/events.js");
$doc->addScript('components/'.$option.'/assets/js/jquery.js' );

$gget_contact = $model->getcontact();

$mydivid 	= JRequest::getVar('mydivid','','request','int');
$img_path	= $url.'components/'.$option.'/assets/images/';
$Yes_image	= $url.'/components/'.$option.'/assets/img/yes11.png';
$maybe_image= $url.'/components/'.$option.'/assets/img/maybe11.png';
$no_image	= $url.'/components/'.$option.'/assets/img/no11.png';
$event_id 	= JRequest::getVar('event_id','','','int');
$today 		= date("Y-m-d"); 
$show_tddate= date("l ,F d");

$login_user	= JFactory::getuser();

?>

<style type="text/css">
.dib_bg {
	height:<?php echo $this->allevents->height; ?>px !important;
	width:<?php echo $this->allevents->width; ?>px !important;
	margin:0 auto;
	background:url("<?php echo $img_path.$this->allevents->b_image;?>") <?php echo $this->allevents->color; ?> no-repeat !important;
}
</style>
<script type="text/javascript" language="javascript">
function eventtitle(title,span) {
/*if(span == "phone_span")
{
	var ph_len = document.getElementById(title).value;
	if(ph_len.length==3 || ph_len.length==7)
	{
		document.getElementById(title).value = ph_len+'-';
	}
}*/
document.getElementById(span).innerHTML = document.getElementById(title).value;
}


</script><table align="center" width="100%"><tr><td>
<div class="dib_bg">
  <?php	$mydata = $this->allevents->description; 
        $mydata=str_replace('{title}','<span id="e_title_span">Event Title</span>',$mydata);
        $mydata=str_replace('{name}','<span id="host1_span">Your Name</span>',$mydata);
        $mydata=str_replace('{phone}','<span id="phone_span"></span>',$mydata);
        $mydata=str_replace('{location}','<span id="location_span">Location Name</span>',$mydata);
        $mydata=str_replace('{address}','<span id="Address_span"></span>',$mydata);
        $mydata=str_replace('{city}','<span id="city_span"></span>',$mydata);
        $mydata=str_replace('{state}','<span id="state_span"></span>',$mydata);
        $mydata=str_replace('{date}','<span id="date_span">'.$today.' </span>',$mydata);
		echo $mydata=str_replace('{time}','<span id="time_span"></span>',$mydata);
        ?>
</div>
</td></tr></table>
<script language="javascript" type="text/javascript">
var Event_title   = "<?php echo JText::_('PLEASE_ENTER_EVENT_TITLE');?>";
var cat_name      = "<?php echo JText::_('PLEASE_SELECT_CATEGORY');?>";
var host_name     = "<?php echo JText::_('PLEASE_ENTER_HOST_NAME');?>";
var phone_no      = "<?php echo JText::_('PLEASE_ENTER_PHONE_NUMBER');?>";
var phone_format  = "<?php echo JText::_('FORMAT');?>";

var host_email_msg     = "<?php echo JText::_('PLEASE_ENTER_HOST_EMAIL');?>";

function open_div()
{
document.getElementById("first_div").style.display = 'block';
document.getElementById("second_div").style.display = 'none';
document.getElementById("thard_div").style.display = 'none';
document.getElementById("nav_test").setAttribute("class", "select_design");
}
function open_div1(){
	var event_title = document.getElementById("event_title").value;
	var category	= document.getElementById("catid").value;
	var host 	= document.getElementById("host").value;
	var phone 	= document.getElementById("phone").value;
	var myhost_email 	= document.getElementById("host_email").value;
	
	if(event_title == '' || event_title == 'Event Title')
	{
		alert(Event_title);
		return false;
	} else if(category == 0)
	{
		alert(cat_name);
		return false;
	} else if(host == '' || host == 'Your Name'){
		alert(host_name);
		return false;
	} else if(myhost_email == '' || myhost_email == 'Your Email') {
		alert(host_email_msg);
		return false;
	} else if(phone == '' || phone == 'Your Phone'){
		alert(phone_no);
		return false;
	} /*else if(phone.length!= 12 ){
		alert(phone_format);
		return false;
	}*/
document.getElementById("first_div").style.display = 'none';
document.getElementById("second_div").style.display = 'block';
document.getElementById("thard_div").style.display = 'none';
document.getElementById("inn_div").style.display = 'block';
document.getElementById("nav_test").setAttribute("class", "add_guests");
}
function open_div2(){
	var event_title = document.getElementById("event_title").value;
	var category = document.getElementById("catid").value;
	var host = document.getElementById("host").value;
	var phone = document.getElementById("phone").value;
	var myhost_email 	= document.getElementById("host_email").value;
	if(event_title == '' || event_title == 'Event Title') {
		alert(Event_title);
		return false;
	} else if(category == 0) {
		alert(cat_name);
		return false;
	} else if(host == '' || host == 'Your Name') {
		alert(host_name);
		return false;
	} else if(myhost_email == '' || myhost_email == 'Your Email') {
		alert(host_email_msg);
		return false;
	} else if(phone == '' || phone == 'Your Phone') {
		alert(phone_no);
		return false;
	}
	document.getElementById("first_div").style.display = 'none';
	document.getElementById("second_div").style.display = 'none';
	document.getElementById("thard_div").style.display = 'block';
	document.getElementById("nav_test").setAttribute("class", "invite_options");
}

function addmanually_div()
{
	document.getElementById("inn_div").style.display = 'block';
	document.getElementById("inn_div1").style.display = 'none';
	document.getElementById("inn_div2").style.display = 'none';
	document.getElementById("openmydiv").value = 'inn_div';
}

function envite_con_div()
{
	document.getElementById("inn_div").style.display = 'none';
	document.getElementById("inn_div1").style.display = 'block';
	document.getElementById("inn_div2").style.display = 'none';
	document.getElementById("openmydiv").value = 'inn_div1';
}
function Import_con_div()
{
	document.getElementById("inn_div").style.display = 'none';
	document.getElementById("inn_div1").style.display = 'none';
	document.getElementById("inn_div2").style.display = 'block';
	document.getElementById("openmydiv").value = 'inn_div2';
}

$(document).ready(function(){
    //called when key is pressed in textbox
	$("#phone").keypress(function (e)  
	{ 
	  //if the letter is not digit then display error and don't type anything
	  if( e.which!=8 && e.which!=0 && (e.which<48 || e.which>57))
	  {
		//display error message
		$("#errmsg").html("Digits Only").show().fadeOut("slow"); 
	    return false;
      }	
	});
});
</script>

<div id="all_div">
<form name="adminForm" action="<?php  echo JRoute::_('index.php?option='.$option.'&view=events')  ?>"  target="_blank" id="adminForm" method="post" enctype="multipart/form-data">
<div class="nav_jeecard">
  <ul id="nav_test" class="select_design">
    <li class="design"><a message="create/details" onclick="return open_div();" track="create_step1_choosestepnav_step1_button" class="page_event"><span class="num">1</span> <span>Enter Details</span></a></li>
    <li class="guests"><a message="create/guests"  onclick="return open_div1();" track="create_step1_choosestepnav_step2_button" class="page_event"><span class="num">2</span> <span>Add Guests</span></a></li>
    <li class="options"><a message="create/review"  onclick="return open_div2();" track="create_step1_choosestepnav_step3_button" class="page_event"><span class="num">3</span> <span><!--Invite Options--> Finished </span></a></li>
  </ul>
</div>
<?php //$myposition1 =''; $myposition ='';
if($mydivid==1) {
	$myposition = 'style="display:block;"';
	$myposition1 = 'style="display:none;"';
} else {
	$myposition = 'style="display:none;"';
	$myposition1 = 'style="display:block;"';
} 

?>
  <div id="first_div" <?php echo $myposition1; ?>>
    <table width="100%">
      <tr>
        <td><table width="100%">
	            <tr>
	              <td><?php echo JText::_('EVENT_TITLE'); ?></td>
	              <td><input name="event_title" id="event_title" value="Event Title" onblur="if(this.value=='') this.value='Event Title';" onfocus="if(this.value=='Event Title') this.value='';"  onkeyup="eventtitle(this.id,'e_title_span')" type="text"></td>
	            </tr>
	            <tr>
	              <td><?php echo JText::_('EVENT_TYPE'); ?></td>
	              <td><?php echo $this->lists['category']; ?></td>
	            </tr>
            <tr>
              <td><?php echo JText::_('HOST'); ?></td>
              <td><input type="text" name="host" id="host" value="Your Name" onblur="if(this.value=='') this.value='Your Name';" onfocus="if(this.value=='Your Name') this.value='';" onkeyup="eventtitle(this.id,'host1_span')" /></td>
            </tr>
			<tr>
              <td><?php echo JText::_('HOST_EMAIL'); ?></td>
              <td>
			<?php if($login_user->id!=0) { ?>	
			  	<input type="text" name="host_email" id="host_email" value="<?php echo $login_user->email; ?>" readonly="true" />
			<?php } else { ?>	
				<input type="text" name="host_email" id="host_email" value="Your Email" onblur="if(this.value=='') this.value='Your Email';" onfocus="if(this.value=='Your Email') this.value='';" />
			<?php } ?>
			  </td>
            </tr>
            <tr>
              <td><?php echo JText::_('PHONE'); ?></td>
              <td><input type="text" name="phone" id="phone"  maxlength="12" value="Your Phone" onblur="if(this.value=='') this.value='Your Phone';" onfocus="if(this.value=='Your Phone') this.value='';" onkeyup="eventtitle(this.id,'phone_span')" onk /><br><span id="errmsg"></span></td>
            </tr>
            <tr>
              <td><?php echo JText::_('LOCATION_NAME'); ?></td>
              <td><input type="text" name="location_name" id="location_name" value="Location Name" onblur="if(this.value=='') this.value='Location Name';" onfocus="if(this.value=='Location Name') this.value='';" onkeyup="eventtitle(this.id,'location_span')" /></td>
            </tr>
            <tr>
              <td><?php echo JText::_('ADDRESS'); ?></td>
              <td><input type="text" name="address" id="address" value="Address" onblur="if(this.value=='') this.value='Address';" onfocus="if(this.value=='Address') this.value='';"  onkeyup="eventtitle(this.id,'Address_span')"  /></td>
            </tr>
            <tr>
              <td><?php echo JText::_('CITY'); ?></td>
              <td><input type="text" name="city" id="city" value="City" onblur="if(this.value=='') this.value='City';" onfocus="if(this.value=='City') this.value='';" onkeyup="eventtitle(this.id,'city_span')"  /></td>
            </tr>
            <tr>
              <td><?php echo JText::_('STATE'); ?></td>
              <td><!--<input type="text" name="state" id="state" value="State" onblur="if(this.value=='') this.value='State';" onfocus="if(this.value=='State') this.value='';" onkeyup="eventtitle(this.id,'state_span')" />--><?php echo $this->lists['state']; ?></td>
            </tr>
          </table>
		</td>
        <td valign="top">
		<table width="100%">
            <tr>
              <td><?php echo JText::_('WHEN'); ?></td>
              <td><input type="text" class="" name="date1" id="date1" value="<?php  echo $today; ?>"  onchange="eventtitle(this.id,'date_span')" onkeyup="eventtitle(this.id,'date_span')" size="12" maxlength="10" />
                <script type="text/javascript">
				Calendar.setup(
				  {
					inputField  : "date1",         		// ID of the input field
					ifFormat    : "%Y-%m-%d",    		// the date format
					button      : "intro_date_img1" 	// ID of the button
					
				  }
				);
				</script>
			</td>
			<td><?php echo JText::_('TIME'); ?></td>
            <td><!--<input type="text" name="event_time" id="event_time"  maxlength="10" value="555-555-5555" onblur="if(this.value=='') this.value='555-555-5555';" onfocus="if(this.value=='555-555-5555') this.value='';" onkeyup="eventtitle(this.id,'phone_span')" />--><?php echo $this->lists['event_time']; ?></td>
           </tr>
        	<tr valign="top">
    			<td colspan="1"><?php echo JText::_('MESSAGE') ?></td>
	   			<td colspan="3"><textarea name="message" id="message" rows="10" cols="60"></textarea></td>
  			</tr>
		</table>
		</td>
      	</tr>
		<tr>
			<td colspan="2" align="right" >
	  		<table width="200" >
			<tr><!--<td>
      		<input type="button" name="goback" id="goback" class="button nextbtn" onclick="return open_div();" value="Go Back"/>
      		</td>--><Td>
	  			<input type="button" name="first_second_div" id="first_second_div" class="button nextbtn" onclick="return open_div1();" value="Next step"/>
	  		</Td>
			</tr>
			</table>
	  		</td>
		</tr>
	  </table>
    <!--<input type="hidden" name="cid[]" value="<?php //echo $this->detail->groupid; ?>" />-->
    <?php //echo JHTML::_( 'form.token' ); ?>
  </div>
  <div id="second_div" <?php echo $myposition; ?>>
    <script type="text/javascript" language="javascript">
	var valid_email = "<?php echo JText::_('PLEASE_ENTER_VALID_EMAIL'); ?>";
	</script>
    <table width="100%">
      <tr>
        <td valign="top"><table>
            <tr>
              <td><a href="JavaScript:void(0);" onclick="addmanually_div();"><?php echo JText::_('ADD_MANUALLY')?></a></td>
              <td><a href="JavaScript:void(0);" onclick="envite_con_div();"><?php echo JText::_('ENVITE_CONTACT')?></a></td>
              <!--<td><a href="JavaScript:void(0);" onclick="Import_con_div();">Import Contacts</a></td>-->
            </tr>
          </table>
          <input type="hidden" value="add_manullay" name="opendiv" id="openmydiv">
          <div id="inn_div" <?php echo $myposition1; ?> style="display:block;">
            <table>
              <tr>
                <td colspan="3"><textarea name="add_manullay" id="add_manullay" cols="50" rows="10"></textarea>
                  <input type="hidden" value="<?php //echo $k;?>" name="total_extra" id="total_extra">
                </td>
              </tr>
            </table>
            <table>
              <tr>
                <td colspan="3" align="right"><input type="button"  name="add_list"  value="Add to Guest List"  class="button nextbtn" id="add_list" onclick="addtolist('extra_table');"/></td>
              </tr>
            </table>
          </div>
          <div id="inn_div1" <?php echo $myposition1; ?>>
            <table class="">
                <tr>
                  <td width="5%" class="title"> <input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $gget_contact ); ?>);" />
                  </td >
                  <td class="title"  width="20%"> <?php echo JTEXT::_('NAME'); ?> </td>
                  <td class="title"  width="10%"> <?php echo JTEXT::_('EMAIL');?> </td>
                </tr>
 <?php
	$k1 = 0;
	for ($i=0, $n=count( $gget_contact ); $i < $n; $i++)
	{
		$row = $gget_contact[$i];
		$row->id = $row->cid;
		?><!--<input type="hidden" name="climit[]" id="climit<?php //echo $i; ?>" value="<?php //echo $i;?>" />-->
              <tr class="<?php echo "row$k"; ?>">
                <td class="order"><?php echo JHTML::_('grid.id', $i, $row->id ); ?> </td>
                <td><?php echo $row->contact_name; ?>
                  <input type="hidden" name="chk_name<?php echo $i; ?>" id="chk_name<?php echo $i; ?>" value="<?php echo $row->contact_name; ?>" />
                </td>
                <td><?php  echo $row->contact_email; ?>
                  <input type="hidden" name="chk_email<?php echo $i; ?>" id="chk_email<?php echo $i; ?>" value="<?php echo $row->contact_email; ?>" />
                </td>
                <td>
              </tr>
              <?php
		$k1 = 1 - $k1;
	}
	?>
            </table>
            <table>
              <tr>
                <td colspan="3" align="right"><input type="button" name="add_list"    class="button nextbtn"value="Add to Guest List" id="add_list" onclick="add_secondlist('extra_table');"/></td>
              </tr>
            </table>
          </div>
          <div id="inn_div2" <?php echo $myposition; ?> style="display:none;">
            <?php $import_contact = JRoute::_('index.php?option=com_openinviter&tmpl=component&Itemid='.$Itemid);
 ?>
            <table width="100%" border="1">
              <tr>
                <td colspan="2"><a rel="{handler: 'iframe', size: {x: 600, y: 400}}" href="<?php echo $import_contact; ?>" class="modal" onclick="get_guestlist()"><?php echo JText::_('IMPORT_CONTACT'); ?></a></td>
              </tr>
              <tr>
                <th width="5%" class="title"> <input type="checkbox" name="chk" value="" onclick="checkAll2();" />
                </th >
                
                <th class="title"  width="10%"> <?php echo JTEXT::_('EMAIL');?> </th>
              </tr>
              <?php  $k = 0;
			 
 if(isset($_SESSION['email_contact']))
		{
		
			for($q=0;$q<count($_SESSION['email_contact']);$q++)
			{	?>
              <tr><!--<input type="hidden" name="limit[]" id="limit<?php //echo $q; ?>" value="<?php //echo $q;?>" />-->
                <td class="order"><input type="checkbox" name="checkID[]"   value="<?php  echo $q; ?>" /> </td>                
                <td><?php  echo $_SESSION["email_contact"][$q]; ?>
                <input type="hidden" name="chk_email1<?php echo $q; ?>"  id="chk_email1<?php echo $q; ?>" value="<?php echo  $_SESSION["email_contact"][$q];?>" /></td>
              </tr>
              <?php $k = 1 - $k;
			}
		}

 ?>
              <tr>
                <td></td>
              </tr>
            </table>
            <table width="100%">
              <tr>
                <td colspan="3" align="right"><input type="button" name="add_list"    class="button nextbtn"value="Add to Guest List" id="add_list" onclick="add_thordlist('extra_table');"/></td>
              </tr>
            </table>
          </div></td>
        <td valign="top" >
		<div class="table" name="guest_edit" id="guest_edit" style="float:right;">
		 <h4>Your Guest List</h4>
		    <table border="0">
              <thead>
                <tr>
                  <th class="name">Name</th>
                   <th class="email">Email</th>
                      <th class="edit">Edit/Remove</th>
					</tr>
					</thead>        
					</table>
					 <table border="0" id="extra_table">
					  <tbody><Tr class="name"><td></td><td class="email"></td><td class="edit"></td></Tr>
                <tr class="table_placeholder">
    
					<!--<span id="list_span"></span>-->
					<?php 
                                $session =JFactory::getSession();
                                $my_dup_row = $session->get('mysession');
                                echo $my_dup_row;?>
				</tr>	</tbody>			 
                </table> 		 
		</div>
		</td>
      </tr><tr><td colspan="2" align="right" >
	  <table width="200" ><tr><td>
       <input type="button" name="goback1" id="goback1" class="button nextbtn" onclick="return open_div();" value="Go Back"/>
      </td><td>
	<input type="button" name="second_thard_div" id="second_thard_div" class="button nextbtn" onclick="return open_div2();" value="Next step"/>
	  </Td></tr></table>
	  </td></tr>
    </table>
  </div><!--<input type="text" name="location_name" id="location_name" value="Location Name" onblur="if(this.value=='') this.value='Location Name';" onfocus="if(this.value=='Location Name') this.value='';" onkeyup="eventtitle(this.id,'location_span')" />-->
  
  <div id="thard_div" style="display:none;">
	<!--<div id="rsvp_styles">
    	<h3>Reply Style</h3>
        <p>Customize the reply headers for yes, maybe, and no.</p>
        <table>
  		<tr>
      		<td>Style</td>
      		<td><?php echo  $this->lists['style']; //echo $this->lists['reply_style']; ?></td>
		</tr>
      	</table>
		<div id="md_style_mydiv">
		<table>
  			<tr>
  				<td>Who?</td>
  				<td><input type="text" name="style_who" id="style_who" value="Who's In?" onblur="if(this.value=='') this.value='Who's In?';" onfocus="if(this.value=='Who's In?') this.value='';" /></td>
			</tr>
  			<tr>
		  		<td><img src="<?php echo $Yes_image; ?>"  alt=""/></td>
		  		<td><input type="text" name="style_yes" id="style_yes" value="Yes" onblur="if(this.value=='') this.value='Yes';" onfocus="if(this.value=='Yes') this.value='';" /></td>
			</tr>
  			<tr>
				<td><img src="<?php echo $maybe_image; ?>"  alt=""/></td>
				<td><input type="text" name="style_maybe" id="style_maybe"  value="May Be" onblur="if(this.value=='') this.value='May Be';" onfocus="if(this.value=='May Be') this.value='';" /></td>
			</tr>
		  	<tr>
				<td><img src="<?php echo $no_image; ?>"  alt=""/></td>
				<td><input type="text" name="style_no" id="style_no" value="No" onblur="if(this.value=='') this.value='No';" onfocus="if(this.value=='No') this.value='';"/></td>
			</tr>
  		</table>
		</div>
	</div>
  
  	<br />Reply Options-->
  	<table align="right">
		<!--<tr>
			<td><input type="checkbox" name="rsvp" id="rsvp" value="1" />Notify me when guests rsvp</td>
			<td><input type="checkbox" name="inviteother" checked="checked" id="inviteother" value="1" />Allow guests to invite other people</td>
		</tr>
		<tr>
			<td><input type="checkbox" name="comment" id="comment" value="1" />Notify me when guests comment</td>
			<td><input type="checkbox" name="bringother" id="bringother" checked="checked" value="1" />Allow guests to bring other people</td>
		</tr>
		<tr>
			<td><input type="checkbox" name="hideguest" id="hideguest" value="1" />Hide guest list</td>
			<td>Limit per guest<?php echo $this->lists['no_limit']; ?></td>
		</tr>
		<tr>
		  <td><input type="checkbox" name="set_guest" id="set_guest" value="1" /> Set the maximum number of guests who can attend to<input type="text"  size="2"name="noguests" id="noguests" />guests</td>
		  <td><input type="checkbox" name="indicateattending" id="indicateattending" value="0" />Allow guests to indicate number of kids attending</td>
		</tr>-->
      	<tr align="right">
			<td colspan="2" align="right" >
				<table width="200" align="right" >
					<tr>
						<td><input type="button" name="goback2" id="goback2" class="button nextbtn" onclick="return open_div1();" value="Go Back"/></td>
						<td><input type="submit" class="button nextbtn" value="Finish & send" name="event" onclick="return show_invite('<?php //echo $this->allevents->eventid;?>' )" /></td>
					</tr>
				</table>
		  </td>
		</tr>
  </table>
  </div>
  
  <table>
    <tr>
      <td align="right" colspan="2">
       <input type="hidden" name="option" value="com_jeecard" />
    <input type="hidden" name="task" id="task" value="sendinvitation" />
    <input type="hidden" name="view" value="events" />
      <input type="hidden"  name="Itemid" id="Itemid" value="<?php echo $Itemid; ?>" />
    <input type="hidden" name="event_id" id="event_id" value="<?php echo $event_id; ?>" />
    <input type="hidden" name="myid" id="myid" value="1" /> 
         <input type="submit" name="preview" value="preview" id="preview" class="button nextbtn" />
         <input type="hidden" name="jelive_url" id="jelive_url" value="<?php echo $url; ?>" />
      </td>
    </tr>
  </table>
</form>
</div>
<script language="javascript" type="text/javascript">
var list_alert = "<?php echo JText::_('PLEASE_ENTER_YOUR_GUEST_LIST');?>";
function show_invite()
{	
	document.getElementById("adminForm").target = '';
	if(!document.getElementsByName("my_email[]")[0])
	{
	alert(list_alert);
	//document.getElementById('list_span').innerHTML = '<br />'+list_alert;
	return false;	 
	}
	document.getElementById("task").value = 'sendinvitation';
	
	document.adminForm.submit();
}
<?php
if($mydivid==1){
?>open_div1();<?php
}else{ ?>
addmanually_div();
<?php 
}
?>
</script>
