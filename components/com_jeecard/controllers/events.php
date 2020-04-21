<?php
/**
* @package   JE Ecard
* @copyright Copyright (C) 2009 - 2010 Open Source Matters. All rights reserved.
* @license   http://www.gnu.org/licenses/lgpl.html GNU/LGPL, see LICENSE.php
* Contact to : emailtohardik@gmail.com, joomextensions@gmail.com
* Visit : http://www.joomlaextensions.co.in/
**/ 
 
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.controller' );
class eventscontroller extends JControllerForm
{	
	function __construct( $default = array())
	{
		parent::__construct( $default );
		$this->_table_prefix = '#__jeecard_';
	}
	
	function cancel($key = NULL)
	{
		$option = JRequest::getVar ('option','','','string');
		$this->setRedirect( 'index.php?option='.$option.'&view=events'  );
	}
	
	function display($cachable = false, $urlparams = '') 
	{
		parent::display();
	}
	
	function sendinvitation()
	{		
		$db = JFactory::getDbO();
		$mainframe = JFactory::getApplication();
		$uri 	= JURI::getInstance();
		$url	= $uri->root();
		$option = JRequest::getVar('option','','request','string');
		$post 	= JRequest::get('post','','','string');
		$model 	= $this->getModel ( 'events' );
		$event_id 	= JRequest::getVar('event_id','','request','int');
		$userid 	= clone(JFactory::getUser());
		if($userid->id!=0) {
			$frommail 	= $userid->email;
			$fromname 	= $userid->name;
			$subject	= $userid->name.' send invitation ';
		} 
		else
		{
			$frommail 	= $post['host_email'];
			$fromname 	= $post['host'];
			$subject	= $post['host'].' send invitation ';
		}
		
		//$browse_tempt = $event_data->description;
		if(isset($post['my_email']))
		{
			$post['user_id']  = $userid->id;
			$post['email']    = $userid->email;
			$post['eventid']  = $event_id;
			$post['limit']    = @$post['no_limit'];
			$post['date']    = $post['date1'];
			
			$temp = $model->store( $post );
			
			if($temp) {
				for($p=0;$p<count($post['my_email']);$p++)
				{
					$email	=  $post['my_email'][$p];
					$name 	= $post['my_name'][$p];
					$query 	= 'SELECT * FROM #__jeecard_event WHERE eventid = '.$event_id;
					$db->setQuery($query);
					$event_data = $db->LoadObject();
					
					if($userid->id!=0) {
						$query = "SELECT cid FROM #__jeecard_contact  WHERE  hostid=".$userid->id." AND contact_email = '". $email."'";
						$db->setQuery($query);
						$user_detail = $db->loadObject();
						if(!$user_detail) {
							$sqluser="INSERT INTO #__jeecard_contact VALUES('',".$userid->id.",'".$name."','".$email."',0)";	
							$db->setQuery($sqluser);
							$temp3 = $db->query();
						}
					}
					
					$sql= "INSERT INTO #__jeecard_eventsent VALUES('',".$temp.",'".$email."',0,0,0)";	
					$db->setQuery($sql);
					$temp1 	= $db->query();
					$mytable_id = $db->insertid();
					
					if($temp1) {
						$recipient 		= $email; 
						$link 			= $url.'index.php?option='.$option.'&view=mailreply&send_id='.$mytable_id;
						$myyes_link 	= $url.'index.php?option='.$option.'&view=mailreply&send_id='.$mytable_id.'&myvar=yes' ;
						$mymaybe_link 	= $url.'index.php?option='.$option.'&view=mailreply&send_id='.$mytable_id.'&myvar=maybe';
						$myno_link 		= $url.'index.php?option='.$option.'&view=mailreply&send_id='.$mytable_id.'&myvar=no';
						$img_path		= $url.'components/'.$option.'/assets/images/thumb_';
						$static_image	= $url.'components/'.$option.'/assets/img/';
						$myimage 		= '<a href='.$link.' target="_blank"><img src='.$img_path.$event_data->b_image.' /></a>'; 
						$myyes 			= '<a href='.$myyes_link.' target="_blank"><img src='.$static_image.'yes1.gif  border="0" alt=""  /></a>'; 
						$mymaybe 		= '<a href='.$mymaybe_link.'  target="_blank"><img src='.$static_image.'maybe1.gif  border="0" alt=""  /></a>'; 
						$myno 			= '<a href='.$myno_link.' target="_blank"><img src='.$static_image.'no1.gif   border="0" alt="" /></a>'; 
						$myview 		= '<a href='.$link.' target="_blank">'.JText::_('VIEW_THIS_INVITATION').'</a>'; 
						$myevent_title 	= '<a href='.$link.' target="_blank">'.$post['event_title'].'</a>'; 						
						if($post['address'] == 'Address') {
							$address_my = ''; 
						} else {
							$address_my = $post['address']; 
						}
						if($post['city'] == 'City') {
							$city_my = ''; 
						} else {
							$city_my = $post['city']; 
						}
						$setting1= $model->getsetting();
						$setting 	= $setting1->mail_tempt; 
						$setting	= str_replace('{host_name}',$post['host'],$setting);
						$setting	= str_replace('{event_title}',$myevent_title,$setting);
						$setting	= str_replace('{date}',$post['date'],$setting);
						$setting	= str_replace('{time}',$post['event_time'],$setting);
						$setting	= str_replace('{location}',$post['location_name'],$setting);
						$setting	= str_replace('{address}',$address_my,$setting);
						$setting	= str_replace('{city}',$city_my,$setting);
						$setting	= str_replace('{state}','',$setting);
						$setting	= str_replace('{yes}',$myyes,$setting);
						$setting	= str_replace('{maybe}',$mymaybe,$setting);
						$setting	= str_replace('{no}',$myno,$setting);
						$setting	= str_replace('{maybe}',$mymaybe,$setting);
						$setting	= str_replace('{view_invitation}',$myview,$setting);
						$setting	= str_replace('{image}',$myimage,$setting);
						$return = JFactory::getMailer()->sendMail($frommail, $fromname, $recipient, $subject, $setting, $mode=1);
					}
				}
				$msg = JText::_ ( 'EVENT_DETAIL_SAVED' );
			} else {
				$msg = JText::_ ( 'ERROR_SAVING_IN_EVENT_DETAIL' );
			}
		}
		$redirect_link = JRoute::_('index.php?option=com_jeecard&view=events&event_id='.$event_id.'&Itemid='.$post['Itemid']);
		$mainframe->redirect ( $redirect_link ,$msg );
	}
	
	function get_guset(){
		$myguestlist= JRequest::getVar( 'myguestlist', '', '', 'string', JREQUEST_ALLOWRAW );
	 	$session =JFactory::getSession();
		$session->set('mysession',$myguestlist);
		exit;
	}


	function getStyledata(){
				$uri = JURI::getInstance();
				$url= $uri->root();
				$id = JRequest::getVar('id','','','int'); 
				$user = clone(JFactory::getUser());
				$db= JFactory :: getDBO();
				$query = "SELECT * FROM ".$this->_table_prefix."style WHERE id =".$id;
				$db->setQuery($query);
				$mystyle = $db->loadObject();
				$option = JRequest::getVar('option','','request','string');
				$Yes_image	= $url.'/components/'.$option.'/assets/img/yes11.png';
				$maybe_image	= $url.'/components/'.$option.'/assets/img/maybe11.png';
				$no_image	= $url.'/components/'.$option.'/assets/img/no11.png';
				
			echo $abc = '<table>
								<tr>
									<td>Who?</td>
									<td><input type="text" name="style_who" id="style_who" value="'.$mystyle->who.'"  /></td>
								</tr>
								<tr>
										<td><img src="'.$Yes_image.'"  alt=""/></td>
  										<td><input type="text" name="style_yes" id="style_yes" value="'.$mystyle->yes.'"  /></td>
                            	</tr>
 							 	<tr>
                             		<td><img src="'.$maybe_image.'"  alt=""/></td>
                                	<td><input type="text" name="style_maybe" id="style_maybe"  value="'.$mystyle->maybe.'"  /></td></tr>
 							 <tr>
                             		<td><img src="'.$no_image.'"  alt=""/></td>
                                	<td><input type="text" name="style_no" id="style_no" value="'.$mystyle->no.'"/></td>
                                </tr>
  </table>';

		exit;
	}	
	function getmyitem()
	{
		$db= JFactory :: getDBO();
		$option = JRequest::getVar('option','','request','string'); 
		$id = JRequest::getVar('id','','request','int'); 
		$db			= JFactory::getDBO();
		$query = 'SELECT eventid AS value, name AS text FROM  #__jeecard_event WHERE published = 1 AND catid='.$id; 
		$db->setQuery($query);
    	$make=   $db->loadObjectList();
		$sel_make = array();
		$d_itemid = JRequest::getVar('d_itemid','','request','int');
		$sel_make[]  = JHTML::_('select.option', '0 ', JText::_( 'Select Event'));
		$make=@array_merge($sel_make,$make);
		echo $lists['item_list'] 	= JHTML::_('select.genericlist',$make,'d_itemid', 'class="inputtext" style="width:150px;"', 'value', 'text', $d_itemid);
		exit;
		
	}
	// function search()
	// {
	// 	$post 	= JRequest::get('post','','','string');
	// 	$this->setRedirect ('index.php?option=com_jeecard&view=events&event_id='.$post['cid'].'&d_itemid='.$post['d_itemid']);
	// }

}	

?>