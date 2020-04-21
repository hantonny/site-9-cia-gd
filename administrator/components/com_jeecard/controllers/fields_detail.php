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

class fields_detailController extends JControllerForm  {

	function __construct($default = array()) {
		parent::__construct ( $default );
		$this->registerTask ( 'add', 'edit' );
	}
	
	function edit($key = NULL, $urlVar = NULL) 	{
		JRequest::setVar ( 'view', 'fields_detail' );
		JRequest::setVar ( 'layout', 'default' );
		JRequest::setVar ( 'hidemainmenu', 1 );
		parent::display ();
	
	}
	
	function save($key = NULL, $urlVar = NULL) {
		$post = JRequest::get ( 'post' ); 
		$field_desc = JRequest::getVar( 'field_desc', '', 'post', 'string', JREQUEST_ALLOWRAW );
		$post["field_desc"]=$field_desc;		
		$option = JRequest::getVar ('option','','','string');
		$cid = JRequest::getVar ( 'cid', array (0 ), 'post', 'array' );
		$post['field_name'] = strtolower($post['field_name']);
		$post['field_name'] = str_replace(" ","_",$post['field_name']);
		$post ['field_id'] = $cid [0];
		$model = $this->getModel ( 'fields_detail' );
		if ($row=$model->store ( $post )) {
			if($post["field_type"]==0 || $post["field_type"]==1 ||  $post["field_type"]==2)	{  
				$aid[]=$row->field_id;
					$model->field_delete($aid,'field_id');
			}
			else {
				$model->field_save($row->field_id,$post);
			}
		 	$msg = JText::_ ( 'FIELDS_DETAIL_SAVED' );
		} else {
			$msg = JText::_ ( 'ERROR_SAVING_FIELDS_DETAIL' );
		}
		$this->setRedirect ( 'index.php?option=' . $option . '&view=fields', $msg );
	}
	
	function apply() {
		$post = JRequest::get ( 'post' ); 
		$field_desc = JRequest::getVar( 'field_desc', '', 'post', 'string', JREQUEST_ALLOWRAW );
		$post["field_desc"]=$field_desc;		
		$option = JRequest::getVar ('option','','','string');
		$cid = JRequest::getVar ( 'cid', array (0 ), 'post', 'array' );
		$post['field_name'] = strtolower($post['field_name']);
		$post['field_name'] = str_replace(" ","_",$post['field_name']);
		$post ['field_id'] = $cid [0];
		$model = $this->getModel ( 'fields_detail' );
		if ($row=$model->store ( $post )) {
			if($post["field_type"]==0 || $post["field_type"]==1 ||  $post["field_type"]==2)	{  
				$aid[]=$row->field_id;
					$model->field_delete($aid,'field_id');
			}
			else {
				$model->field_save($row->field_id,$post);
			}
		 	$msg = JText::_ ( 'FIELDS_DETAIL_SAVED' );
		} else {
			$msg = JText::_ ( 'ERROR_SAVING_FIELDS_DETAIL' );
		}
		$this->setRedirect ( 'index.php?option=' . $option . '&view=fields_detail&task='.$task.'&cid[]='.$row->field_id, $msg );
	}
	
	function remove() {
		$option = JRequest::getVar ('option','','','string');
		$cid = JRequest::getVar ( 'cid', array (0 ), 'post', 'array' );
		if (! is_array ( $cid ) || count ( $cid ) < 1) {
			JError::raiseError ( 500, JText::_ ( 'SELECT_AN_ITEM_TO_DELETE' ) );
		}
		$model = $this->getModel ( 'fields_detail' );
		if (! $model->delete ( $cid )) {
			echo "<script> alert('" . $model->getError ( true ) . "'); window.history.go(-1); </script>\n";
		}
		$msg = JText::_ ( 'FIELD_DELETED_SUCCESSFULLY' );
		$this->setRedirect ( 'index.php?option='.$option.'&view=fields',$msg );
	}
	
	function publish() {
		$option = JRequest::getVar ('option','','','string');
		$cid = JRequest::getVar ( 'cid', array (0 ), 'post', 'array' );
		if (! is_array ( $cid ) || count ( $cid ) < 1) {
			JError::raiseError ( 500, JText::_ ( 'SELECT_AN_ITEM_TO_PUBLISH' ) );
		}
		$model = $this->getModel ( 'fields_detail' );
		if (! $model->publish ( $cid, 1 )) {
			echo "<script> alert('" . $model->getError ( true ) . "'); window.history.go(-1); </script>\n";
		}
		$msg = JText::_ ( 'FIELD_PUBLISHED_SUCCESSFULLY' );
		$this->setRedirect ( 'index.php?option='.$option.'&view=fields',$msg );
	}
	
	function unpublish() {
		$option = JRequest::getVar ('option','','','string');
		$cid = JRequest::getVar ( 'cid', array (0 ), 'post', 'array' );
		if (! is_array ( $cid ) || count ( $cid ) < 1) {
			JError::raiseError ( 500, JText::_ ( 'SELECT_AN_ITEM_TO_UNPUBLISH' ) );
		}
		$model = $this->getModel ( 'fields_detail' );
		if (! $model->publish ( $cid, 0 )) {
			echo "<script> alert('" . $model->getError ( true ) . "'); window.history.go(-1); </script>\n";
		}
		$msg = JText::_ ( 'FIELD_UNPUBLISHED_SUCCESSFULLY' );
		$this->setRedirect ( 'index.php?option='.$option.'&view=fields',$msg );
	}
	
	function cancel($key = NULL) {
		$option = JRequest::getVar ('option','','','string');
		$msg = JText::_ ( 'FIELD_EDITING_CANCELLED' );
		$this->setRedirect ( 'index.php?option='.$option.'&view=fields',$msg );
	}
}
?>