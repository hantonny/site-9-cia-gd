<?php
 /**
* @package   JE Ecard
* @copyright Copyright (C) 2009 - 2010 Open Source Matters. All rights reserved.
* @license   http://www.gnu.org/licenses/lgpl.html GNU/LGPL, see LICENSE.php
* Contact to : emailtohardik@gmail.com, joomextensions@gmail.com
* Visit : http://www.joomlaextensions.co.in/
**/  
    
defined ( '_JEXEC' ) or die ( 'Restricted access' );
jimport ( 'joomla.application.component.controller' );

class configrationController extends JControllerForm  {
	
	function __construct($default = array()) { 
		parent::__construct ( $default );
		$this->registerTask ( 'add', 'edit' );
	}
	
	function edit($key = NULL, $urlVar = NULL) 
	{
		JRequest::setVar ( 'view', 'configration' );
		JRequest::setVar ( 'layout', 'default' );
		JRequest::setVar ( 'hidemainmenu', 1 );
		$model = $this->getModel ( 'configration' );
		parent::display ();
	}
	
	function save($key = NULL, $urlVar = NULL) 
	{
		$cid = JRequest::getVar ( 'cid', array (0 ), 'post', 'array' );
		
		$post = JRequest::get ( 'post' );
		$post['id'] = $cid[0];
		$post['mail_tempt'] = JRequest::getVar( 'mail_tempt', '', 'post', 'string', JREQUEST_ALLOWRAW );
		//$post['guest_tempt'] = JRequest::getVar( 'guest_tempt', '', 'post', 'string', JREQUEST_ALLOWRAW );
		//$post["confirm_tempt"] = JRequest::getVar( 'confirm_tempt', '', 'post', 'string', JREQUEST_ALLOWRAW );
		//$post["dateevent_tempt"] = JRequest::getVar( 'dateevent_tempt', '', 'post', 'string', JREQUEST_ALLOWRAW );
		
		$post['cat_id'] = implode(',',$post['cat_id']);
		
		$option = JRequest::getVar ('option','','','string');
		$model = $this->getModel ( ' configration' );
		
		if ($model->store ( $post )) {
			$msg = JText::_ ( 'CONFIGURATION_DETAIL_SAVED' );
		} else {
			$msg = JText::_ ( 'ERROR_SAVING_CONFIGURATION_DETAIL' );
		}
		$this->setRedirect ( 'index.php?option=' . $option . '&view=configration', $msg );
	}
	 
 	function cancel($key = NULL) {
		$option = JRequest::getVar ('option','','','string');
		$msg = JText::_ ( 'CONFIGURATION_DETAIL_EDITING_CANCELLED' );
		$this->setRedirect ( 'index.php?option='.$option.'&view=configration',$msg );
	}	 
	 
}
?>