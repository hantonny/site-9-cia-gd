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
 
class category_detailController extends JControllerForm  {
	function __construct($default = array()) {
		parent::__construct ( $default );
		$this->registerTask ( 'add', 'edit' );
	}
	function edit($key = NULL, $urlVar = NULL) {
		JRequest::setVar ( 'view', 'category_detail' );
		JRequest::setVar ( 'layout', 'default' );
		JRequest::setVar ( 'hidemainmenu', 1 );
		parent::display ();
	
	}
	function save($key = NULL, $urlVar = NULL) { 
		

		$post = JRequest::get ( 'post' );
		
		
		$option = JRequest::getVar('option','','request','string');
		
		$post["description"] = JRequest::getVar( 'description', '', 'post', 'string', JREQUEST_ALLOWRAW );
		
		$cid = JRequest::getVar ( 'cid', array (0 ), 'post', 'array' );
		
		$post ['catid'] = $cid [0];
		
		$model = $this->getModel ( 'category_detail' );
		
		$cat_id=$model->store ( $post );
		if ($cat_id) {
				//----------------------------- Ordering ----------------------------------------------//
		if($cid[0]==0){	
			$sql = "SELECT max(ordering) As ordering FROM #__jeecard_category ";
			$db		=& JFactory::getDBO();
			$db->setQuery($sql);
			$max  = $db->loadObject();
			
			if($max->ordering)
				$order = $max->ordering + 1;
			else
				$order = 1;
			
			$query = "UPDATE #__jeecard_category SET ordering = ".$order." WHERE name = '".$post['name']."'"; 
			$db->setQuery($query);
			$db->query();
		}
		//----------------------------- Ordering ----------------------------------------------//

			
			$msg = JText::_ ( 'CATEGORY_DETAIL_SAVED' );
		
		} else {
			
			$msg = JText::_ ( 'ERROR_SAVING_CATEGORY_DETAIL' );
		}

		$this->setRedirect ( 'index.php?option=' . $option . '&view=category', $msg );
		
		
	}
	function remove() {
		
		$option = JRequest::getVar('option','','request','string');
		
	 $cid = JRequest::getVar ( 'cid', array (0 ), 'post', 'array' );
	
		
		if (! is_array ( $cid ) || count ( $cid ) < 1) {
			JError::raiseError ( 500, JText::_ ( 'SELECT_AN_ITEM_TO_DELETE' ) );
		}
		
		$model = $this->getModel ( 'category_detail' );
		if (! $model->delete ( $cid )) {
			echo "<script> alert('" . $model->getError ( true ) . "'); window.history.go(-1); </script>\n";
		}
		$msg = JText::_ ( 'CATEGORY_DETAIL_DELETED_SUCCESSFULLY' );
		$this->setRedirect ( 'index.php?option='.$option.'&view=category',$msg );
	}
	
	function publish() {
		
		$option = JRequest::getVar('option','','request','string');
		
		 $cid = JRequest::getVar ( 'cid', array (0 ), 'post', 'array' );
		if (! is_array ( $cid ) || count ( $cid ) < 1) {
			JError::raiseError ( 500, JText::_ ( 'SELECT_AN_ITEM_TO_PUBLISH' ) );
		}
		
		$model = $this->getModel ( 'category_detail' );
		if (! $model->publish ( $cid, 1 )) {
			echo "<script> alert('" . $model->getError ( true ) . "'); window.history.go(-1); </script>\n";
		}
		$msg = JText::_ ( 'CATEGORY_DETAIL_PUBLISHED_SUCCESSFULLY' );
		$this->setRedirect ( 'index.php?option='.$option.'&view=category',$msg );
	}
	
	function unpublish() {
		
		$option = JRequest::getVar('option','','request','string');
		
		$cid = JRequest::getVar ( 'cid', array (0 ), 'post', 'array' );
		
		if (! is_array ( $cid ) || count ( $cid ) < 1) {
			JError::raiseError ( 500, JText::_ ( 'SELECT_AN_ITEM_TO_UNPUBLISH' ) );
		}
		
		$model = $this->getModel ( 'category_detail' );
		if (! $model->publish ( $cid, 0 )) {
			echo "<script> alert('" . $model->getError ( true ) . "'); window.history.go(-1); </script>\n";
		}
		$msg = JText::_ ( 'CATEGORY_DETAIL_UNPUBLISHED_SUCCESSFULLY' );
		$this->setRedirect ( 'index.php?option='.$option.'&view=category',$msg );
	}
	function cancel($key = NULL) {
		
		$option = JRequest::getVar('option','','request','string');
		$msg = JText::_ ( 'CATEGORY_DETAIL_EDITING_CANCELLED' );
		$this->setRedirect ( 'index.php?option='.$option.'&view=category',$msg );
	}	 
}
?>