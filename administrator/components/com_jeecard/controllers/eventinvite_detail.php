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
 
class eventinvite_detailController extends JControllerForm  {
	function __construct($default = array()) {
		parent::__construct ( $default );
		$this->registerTask ( 'add', 'edit' );
	}
	function edit($key = NULL, $urlVar = NULL) {
		JRequest::setVar ( 'view', 'eventinvite_detail' );
		JRequest::setVar ( 'layout', 'default' );
		JRequest::setVar ( 'hidemainmenu', 1 );
		parent::display ();
	
	}
	
	function remove() {
		$option = JRequest::getVar('option','','request','string');
		$cid = JRequest::getVar ( 'cid', array (0 ), 'post', 'array' );
		if (! is_array ( $cid ) || count ( $cid ) < 1) {
			JError::raiseError ( 500, JText::_ ( 'SELECT_AN_ITEM_TO_DELETE' ) );
		}
		$model = $this->getModel ( 'eventinvite_detail' );
		if (! $model->delete ( $cid )) {
			echo "<script> alert('" . $model->getError ( true ) . "'); window.history.go(-1); </script>\n";
		}
		$msg = JText::_ ( 'EVENT_DETAIL_DELETED_SUCCESSFULLY' );
		$this->setRedirect ( 'index.php?option='.$option.'&view=eventinvite',$msg );
	}
	
	function cancel($key = NULL) {
		$option = JRequest::getVar('option','','request','string');
		//$msg = JText::_ ( 'EVENT_INVITATION_DETAIL_EDITING_CANCELLED' );
		$msg = '';
		$this->setRedirect ( 'index.php?option='.$option.'&view=eventinvite',$msg );
	}
	
}