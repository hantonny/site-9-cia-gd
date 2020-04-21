<?php

/**
* @package  JE Ecard
* @copyright Copyright (C) 2009 - 2010 Open Source Matters. All rights reserved.
* @license   http://www.gnu.org/licenses/lgpl.html GNU/LGPL, see LICENSE.php
* Contact to : emailtohardik@gmail.com, joomextensions@gmail.com
**/
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.controller' );
jimport ('joomla.filesystem.file');
class registerController extends JControllerForm
{
	function __construct( $default = array())
	{		
		parent::__construct( $default );
	}	
	function save()
	{
	
		$post = JRequest::get ( 'post' );
		JRequest::checkToken('request') or jexit( 'Invalid Token' );
		// ======= NEW code for comparision of captcha ========================
		$cap		=	$_SESSION['comments-captcha-code'];
		$textval	= $post['cap'];
		// ================================================================
		$option = JRequest::getWord ('option','','','string');
		
		$db = JFactory::getDbo();
		$pass=md5($post['password']);
		$arr = array($post['year'],$post['month'],$post['day']);
	    $post['dob'] = implode("-",$arr);
		if($cap==$textval)
		{	
		//$file = JRequest::getVar('img', '', 'files', 'array' );//Get File name, tmp_name
		/*if($file['name']!='') {
			$filetype = strtolower(JFile::getExt($file['name'])); // Image file extension
			//$ufile_size	= $file['size']/1048576; // Get the file size in Mb
			if($filetype =='jpeg' || $filetype=='jpg' || $filetype =='png' || $filetype=='gif' ||$filetype =='bmp')
			{
				
					if($post['oldimg']!='') {
						$dest_del 	= JPATH_ROOT.'/'.'components/'.$option.'/assets/images/'.$post['oldimg'];
							@unlink($dest_del);
						
						$dest_del1 	= JPATH_ROOT.'/'.'components/'.$option.'/assets/images/thumb_'.$post['oldimg'];
							@unlink($dest_del1);
					}
					$file_name	= time().$file['name'];
					$src	= $file['tmp_name'];
					$dest 	= JPATH_ROOT.'/'.'components/'.$option.'/assets/images/'.$file_name;				
					JFile::upload($src,$dest);
					
					$dest1 	= JPATH_ROOT.'/'.'components/'.$option.'/assets/images/thumb_'.$file_name;
						copy($dest,$dest1);
					$img = new thumbnail();
					$thumb=$img->config_data();
					
					$dest 	= JPATH_ROOT.'/'.'components/'.$option.'/assets/images/'.$file_name;				
					
					//$img->CreatThumb($filetype,$dest1,$dest,$thumb->thumb_width,$thumb->thumb_height);
					$img->CreatThumb($filetype,$dest1,$dest,$thumb->width,$thumb->height);	
					$post['img']	= $file_name;
				
				
			} else {
				$mylink = 'index.php?option='.$option.'&view='.$view.'&task=edit&cid[]='.$post ['id'];
				$msg = JText::_ ( 'PLEASE_UPLOAD_VALID_IMAGE_FILE' );
				$mainframe->redirect( $mylink,$msg );
			}
			
		} else {
			$post['img']	= $post['oldimg'];
		}*/
		$db= JFactory :: getDBO();
		$sql="select id from #__users where id=".$post["userid"];
		$db->setQuery($sql);
		$user_id=$db->loadResult();
	
		if($user_id=="")
		{	
		///////////// User registration //////////////////
		// Get required system objects
		$user 		= clone(JFactory::getUser());
		//$pathway 	= $mainframe->getPathway();
		$config		= JFactory::getConfig();
		$authorize	= JFactory::getACL();
		$document   = JFactory::getDocument();
		// If user registration is not allowed, show 403 not authorized.
		$usersConfig =JComponentHelper::getParams( 'com_users');
		if ($usersConfig->get('allowUserRegistration') == '0') 
		{
			JError::raiseError( 403, JText::_( 'Access Forbidden' ));
			return;
		}
		// Initialize new usertype setting
		$newUsertype = $usersConfig->get( 'new_usertype' );
		if ($newUsertype) 
		{
			$newUsertype = 'Registered';
		}
		// Bind the post array to the user object
		if (!$user->bind( JRequest::get('post'), 'usertype' ))
		{
			JError::raiseError( 500, $user->getError());
		}
		// Set some initial user values
		$user->set('id', 0);
		$user->set('name', $post["lname"]);
		$user->set('username', $post["fname"]);
		$user->set('password', $pass);
		//$user->set('usertype', $newUsertype);
		$user->set('email', $post["email"]);
		//$user->set('gid', $authorize->get_group_id( '', $newUsertype, 'ARO' ));
			$date = JFactory::getDate();
					$user->set('registerDate', $date->toMySQL());
					$useractivation = $usersConfig->get( 'useractivation' );		// If user activation is turned on, we need to set the activation information
					if ($useractivation == '1'){
						jimport('joomla.user.helper');
						$user->set('activation', JUtility::getHash( JUserHelper::genRandomPassword()) );
						$user->set('block', '1');
					}
					if ( !$user->save() ){
						JError::raiseWarning('', JText::_( $user->getError()));// If there was an error with registration, set the message and display form
						return false;
					}
						
					$post["user_id"]	= $user->id;	
					$sql = 'Select id from #__usergroups where title="Registered"'; 
					$db->setQuery($sql);
					$res = $db->LoadObject();
					$sql_temp="insert into #__user_usergroup_map(user_id,group_id) values('".$post['user_id']."','".$res->id."')";
					$db->setQuery($sql_temp);
					$db->Query();
						
	
		
		$model = $this->getModel ( 'register' );
		if($model->store ( $post ))
		{ 
		
			$msg = JText::_ ( 'THANK_YOU_FOR_REGISTERING_WITH_SITE' );
		}
		else
		{
			$msg = JText::_ ( 'ERROR_SAVING_PROFILE' );
		}
		}
		else
		{
			echo $sqluser="UPDATE #__users SET name='".$post['lname']."',password='".$pass."' where id=".$post["userid"];
				$db->setQuery($sqluser);
				$db->query();	
			$model = $this->getModel ( 'register' );
		if($model->store ( $post ))
		{ 
			$msg = JText::_ ( 'THANK_YOU_FOR_REGISTERING_WITH_SITE' );
		}
		else
		{
			$msg = JText::_ ( 'ERROR_SAVING_PROFILE' );
		}
		}
		$this->setRedirect( 'index.php?option=' . $option . '&view=register',$msg  );
		}else {
						$_SESSION['fname'] = $post['fname'];
						$_SESSION['lname'] = $post['lname'];
						$_SESSION['email'] = $post['email'];
						$_SESSION['email2'] = $post['email2'];
						$_SESSION['day'] = $post['day'];
						$_SESSION['month'] = $post['month'];
						$_SESSION['year'] = $post['year'];
						$_SESSION['sex'] = $post['sex'];
						$_SESSION['password'] = $post['password'];
						$msg=JText::_( 'PLEASE_ENTER_CORRECT_CODE_GIVEN_IN_IMAGE' );
						$code_link	= JRoute::_('index.php?option=' . $option . '&view=register&err=1');
						$this->setRedirect ( $code_link, $msg );
		}
	
}
	function cancel($key = NULL)
	{
			 $option = JRequest::getWord ('option','','','string');
	    	 $this->setRedirect( 'index.php?option='.$option.'&view=register'  );
	}
	function display($cachable = false, $urlparams = '') 
	{
	
			$user =  clone(JFactory::getUser());
			$option = JRequest::getVar('option','','','string');
			
						
				parent::display();
	}
	function _sendMail(&$user, $password)
	{
		$mainframe = JFactory::getApplication();
		$context='';
		$db		= JFactory::getDBO();
		$name 		= $user->get('name');
		$email 		= $user->get('email');
		$username 	= $user->get('username');
		$usersConfig 	=JComponentHelper::getParams( 'com_users' );
		$sitename 		= $mainframe->getCfg( 'sitename' );
		$useractivation = $usersConfig->get( 'useractivation' );
		$mailfrom 		= $mainframe->getCfg( 'mailfrom' );
		$fromname 		= $mainframe->getCfg( 'fromname' );
		$siteURL		= JURI::base();
		$subject 	= sprintf ( JText::_( 'Account details for' ), $name, $sitename);
		$subject 	= html_entity_decode($subject, ENT_QUOTES);
		if ( $useractivation == 1 ){
			//$message = sprintf ( JText::_( 'SEND_MSG_ACTIVATE' ), $name, $sitename, $siteURL."index.php?option=com_user&task=activate&activation=".$user->get('activation'), $siteURL, $username, $password);
			//$message = sprintf ( JText::_( 'SEND_MSG1_ACTIVATE' ), $name, $sitename, $siteURL."index.php?option=com_user&task=activate&activation=".$user->get('activation'), $siteURL, $username, $password);
			//$message = sprintf ( JText::_( 'SEND_HOTELMSG_ACTIVATE' ), $name, $sitename, $siteURL, $username, $password);
			$message = sprintf ( JText::_( 'SEND_MSG_ACTIVATE' ), $name, $sitename, $siteURL."index.php?option=com_user&task=activate&activation=".$user->get('activation'), $username, $password);
		} else {
			$message = sprintf ( JText::_( 'SEND_MSG' ), $name, $sitename, $siteURL);
		}
		$message = html_entity_decode($message, ENT_QUOTES);
		
		
		//get all super administrator
		$query = 'SELECT name, email, sendEmail,username' .
				' FROM #__users' .
				' WHERE LOWER( usertype ) = "super administrator"';
		$db->setQuery( $query );
		$rows = $db->loadObjectList();
		// Send email to user
		if ( ! $mailfrom  || ! $fromname ) {
			$fromname = $rows[0]->name;
			$mailfrom = $rows[0]->email;
		}
		$return = JFactory::getMailer()->sendMail($mailfrom, $fromname, $email, $subject, $message);
		// Send notification to all administrators
		$subject2 	= sprintf ( JText::_( 'Account details for' ), $name, $sitename);
		//$subject2 = html_entity_decode($subject2, ENT_QUOTES);
		// get superadministrators id
		foreach ( $rows as $row )
		{
			if ($row->sendEmail)
			{
				$message2 = sprintf ( JText::_( 'SEND_MSG_ADMIN' ), $row->name, $row->username, $name, $email, $username);
				$message2 = html_entity_decode($message2, ENT_QUOTES);
				$return = JFactory::getMailer()->sendMail($mailfrom, $fromname, $row->email, $subject2, $message2);
			}
		}
	}
	
	
	function captchacr() {
		@session_start();
		$captcha = new KCAPTCHA();
		$_SESSION['comments-captcha-code'] = $captcha->getKeyString();
		exit;
	}
	//====================== EOF New Captcha Code ==========================//
	
	//+++++++++++++++++++++++++++++++ Ajax Captcha Code +++++++++++++++++++++++++++++++++++++++++++++++ //
	function refresh_captchacr() { 
		
		$option = JRequest::getVar('option','','request','string');
		$uri = JURI::getInstance();
		$url= $uri->root();
			
	  	$dest = $url.'index.php?option='.$option.'&view=register&task=captchacr&tmpl=component&ac='.rand();
		echo '<img src="'.$dest.'" />';
		exit;
	}
	
	


}	
?>