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

class event_tempsettingController extends JControllerForm  {
	
	function __construct($default = array()) { 
		parent::__construct ( $default );
		$this->registerTask ( 'add', 'edit' );
	}
	
	function edit($key = NULL, $urlVar = NULL) 
	{
		JRequest::setVar ( 'view', 'event_tempsetting' );
		JRequest::setVar ( 'layout', 'default' );
		JRequest::setVar ( 'hidemainmenu', 1 );
		$model = $this->getModel ( 'event_tempsetting' );
		parent::display ();
	}
	
	function save($key = NULL, $urlVar = NULL) 
	{
		$post = JRequest::get ( 'post' );
		$post["alleventlist_tempt"] = JRequest::getVar( 'alleventlist_tempt', '', 'post', 'string', JREQUEST_ALLOWRAW );
		$post["alleventlist_more_tempt"] = JRequest::getVar( 'alleventlist_more_tempt', '', 'post', 'string', JREQUEST_ALLOWRAW );
		$post["eventcrlist_tempt"] = JRequest::getVar( 'eventcrlist_tempt', '', 'post', 'string', JREQUEST_ALLOWRAW );
		$post["dateevent_tempt"] = JRequest::getVar( 'dateevent_tempt', '', 'post', 'string', JREQUEST_ALLOWRAW );
		
	 	$option = JRequest::getVar ('option','','','string');
		$model = $this->getModel ( ' event_tempsetting' );
		
		if ($model->store ( $post )) {
			$msg = JText::_ ( 'EVENT_TEMPLATE_SETTING_DETAIL_SAVED' );
		} else {
			$msg = JText::_ ( 'ERROR_SAVING_ EVENT_TEMPLATE_SETTING_DETAIL' );
		}
		$this->setRedirect ( 'index.php?option=' . $option . '&view=event_tempsetting', $msg );
	}
	 
 	function cancel($key = NULL) {
		$option = JRequest::getVar ('option','','','string');
		$msg = JText::_ ( 'EVENT_TEMPLATE_SETTING_DETAIL_EDITING_CANCELLED' );
		$this->setRedirect ( 'index.php?option='.$option.'&view=event_tempsetting',$msg );
	}	 
	 
}
?>