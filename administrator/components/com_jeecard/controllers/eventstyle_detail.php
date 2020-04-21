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
 
class eventstyle_detailController extends JControllerForm  {
	function __construct($default = array()) {
		parent::__construct ( $default );
		$this->registerTask ( 'add', 'edit' );
	}
	function edit($key = NULL, $urlVar = NULL) {
		JRequest::setVar ( 'view', 'eventstyle_detail' );
		JRequest::setVar ( 'layout', 'default' );
		JRequest::setVar ( 'hidemainmenu', 1 );
		parent::display ();
	
	}
	function save($key = NULL, $urlVar = NULL) { 
		

		$post = JRequest::get ( 'post' );
		
		
		$option = JRequest::getVar('option','','request','string');
		
		$post["description"] = JRequest::getVar( 'description', '', 'post', 'string', JREQUEST_ALLOWRAW );
		
		$cid = JRequest::getVar ( 'cid', array (0 ), 'post', 'array' );
		
		$post ['id'] = $cid [0];
		$model = $this->getModel ( 'eventstyle_detail' );
		
		
		if ($model->store ( $post )) {
			
			$msg = JText::_ ( 'EVENT_STYLE_SAVED' );
		
		} else {
			
			$msg = JText::_ ( 'ERROR_SAVING_EVENT_STYLE' );
		}

		$this->setRedirect ( 'index.php?option=' . $option . '&view=eventstyle', $msg );
		
		
	}
	function remove() {
		
		$option = JRequest::getVar('option','','request','string');
		
	 $cid = JRequest::getVar ( 'cid', array (0 ), 'post', 'array' );
	
		
		if (! is_array ( $cid ) || count ( $cid ) < 1) {
			JError::raiseError ( 500, JText::_ ( 'SELECT_AN_ITEM_TO_DELETE' ) );
		}
		
		$model = $this->getModel ( 'eventstyle_detail' );
		if (! $model->delete ( $cid )) {
			echo "<script> alert('" . $model->getError ( true ) . "'); window.history.go(-1); </script>\n";
		}
		$msg = JText::_ ( 'EVENT_STYLE_DELETED_SUCCESSFULLY' );
		$this->setRedirect ( 'index.php?option='.$option.'&view=eventstyle',$msg );
	}
	
	
	
	
	function cancel($key = NULL) {
		
		$option = JRequest::getVar('option','','request','string');
		$msg = JText::_ ( 'EVENT_STYLE_EDITING_CANCELLED' );
		$this->setRedirect ( 'index.php?option='.$option.'&view=eventstyle',$msg );
	}	 
}
?>