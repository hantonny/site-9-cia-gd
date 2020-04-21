<?php
/**
* @package   JE Ecard
* @copyright Copyright (C) 2009 - 2010 Open Source Matters. All rights reserved.
* @license   http://www.gnu.org/licenses/lgpl.html GNU/LGPL, see LICENSE.php
* Contact to : emailtohardik@gmail.com, joomextensions@gmail.com
* Visit : http://www.joomlaextensions.co.in/

**/ 

defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.plugin.plugin' ); 
jimport( 'joomla.application.component.controller' );
 jimport ('joomla.filesystem.file');
 
 
 
class mailreplyController extends JControllerForm
{
	function __construct( $default = array())
	{	
		parent::__construct( $default );
	}	
	/*function cancel($key = NULL)
	{
	
		$this->setRedirect( 'index.php' );
		
	}*/
	
	function display($cachable = false, $urlparams = '') {

	parent::display();
	
	}

	function save($key = NULL, $urlVar = NULL)
	{ 
		
		$mainframe = JFactory::getApplication();
		$context='';
		$option = JRequest::getWord('option','','','string');
		$post = JRequest::get('post');
		
		$model = $this->getModel('mailreply');
		$temp = $model->store( $post );
		if($temp){
					if($post['comment1'] =='1'){
					 			$mainframe = JFactory::getApplication();
					 			$frommail = $post['email1'];
					 			$myusername = explode("@",$post['email1']);
					 			$fromname = $myusername[0];
					 			$recipient = $post['email'];
					 			$subject   = 'user responce for <b>'.$post['eventtitle'].'</b>' ;
					 			$setting   = $post['comment'];
					 			$return = JFactory::getMailer()->sendMail($frommail,$fromname,$recipient,$subject, $setting, $mode=1);
					}
		$msg = JText::_ ( 'COMMENT_DETAIL_SAVED' );
		}else{
		
		$msg = JText::_ ( 'ERROR_SAVING_IN_COMMENT_DETAIL' );
		}
		$redirect_link = JRoute::_('index.php?option=com_jeecard&view=mailreply&send_id='.$post['send_id'].'&Itemid='.$post['Itemid']);
		$mainframe->redirect ( $redirect_link ,$msg );
	}
}