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
 jimport( 'joomla.filesystem.file' ); 
class event_detailController extends JControllerForm  {
	function __construct($default = array()) {
		parent::__construct ( $default );
		$this->registerTask ( 'add', 'edit' );
	}
	function edit($key = NULL, $urlVar = NULL) {
		JRequest::setVar ( 'view', 'event_detail' );
		JRequest::setVar ( 'layout', 'default' );
		JRequest::setVar ( 'hidemainmenu', 1 );
		parent::display ();
	
	}
	
	function save($key = NULL, $urlVar = NULL) { 
		$post = JRequest::get ( 'post' );
		$option = JRequest::getVar('option','','request','string');
		$post["description"] = JRequest::getVar( 'description', '', 'post', 'string', JREQUEST_ALLOWRAW );
		$cid = JRequest::getVar ( 'cid', array (0 ), 'post', 'array' );
		$post ['eventid'] = $cid [0];
		$model = $this->getModel ( 'event_detail' );
		$file 	= JRequest::getVar ( 'b_image', '', 'files', 'array' );
		
		if($file['name']!='') {
				$filetype = strtolower(JFile::getExt($file['name'])); //Get extension of the file
				if($filetype =='jpeg' || $filetype=='jpg' || $filetype=='jpe' || $filetype =='png' || $filetype=='gif'){
					switch($filetype){
						case "jpe": case "jpeg":  case "jpg":
							$file_type = IMAGETYPE_JPEG;
							break;
						case 'png':
							$file_type = IMAGETYPE_PNG;
							break;
						case 'gif':
							$file_type = IMAGETYPE_GIF;
							break;
					}
					if($filetype == 'jpeg' || $filetype=='jpg'){}
					$src			= $file['tmp_name'];
					$portrait		= time().'_'.$file['name'];
					$dest 			= JPATH_ROOT.'/'.'components/'.$option.'/assets/images/'.$portrait; 
					JFile::upload($src,$dest);	
					$dest_thumb		= JPATH_ROOT.'/'.'components/'.$option.'/assets/images/thumb_'.$portrait; 
					//$model = $this->getModel ( 'event_detail' );
					//$config			= $model->getconfigration();
					$thumboption 	= array('type'   => $file_type,'width'   => 100,'height'  => 100,'method'  => THUMBNAIL_METHOD_SCALE_MAX);
					Thumbnail::output($dest, $dest_thumb, $thumboption);
					
					$post['b_image']	= $portrait;
					if($post['old_img']){
						$userdest 		= JPATH_ROOT.'/'.'components/'.$option.'/assets/images/'.$post['old_img']; 
						unlink($userdest);
						$userthumbdest 	= JPATH_ROOT.'/'.'components/'.$option.'/assets/images/thumb_'.$post['old_img']; 
						unlink($userthumbdest);
					}
					
				}else{
					$mylink = 'index.php?option='.$option.'&view='.$view;
					$msg = JText::_ ( 'PLEASE_UPLOAD_VALID_IMAGE_FILE' );
					$mainframe->redirect( $mylink,$msg );
				}
			}else{
				$post['b_image']	= $post['old_img'];
			}
		$myeventid	= $model->store ( $post );
		if ($myeventid) {

					//----------------------------- Ordering ----------------------------------------------//
		if($cid[0]==0){	
			$sql = "SELECT max(ordering) As ordering FROM #__jeecard_event ";
			$db		=& JFactory::getDBO();
			$db->setQuery($sql);
			$max  = $db->loadObject();
			
			if($max->ordering)
				$order = $max->ordering + 1;
			else
				$order = 1;
			
			$query = "UPDATE #__jeecard_event SET ordering = ".$order." WHERE name = '".$post['name']."'"; 
			$db->setQuery($query);
			$db->query();
		}
		//----------------------------- Ordering ----------------------------------------------//

			$msg = JText::_ ( 'EVENT_DETAIL_SAVED' );
		} else {
			$msg = JText::_ ( 'ERROR_SAVING_EVENT_DETAIL' );
		}
		
		$count1=$myeventid;
		
		// =============== Code for Saving dynemic fields value ============================ //
		/*	$res11=new extra_field();
			$res11->extra_field_save($post,2,$count1);*/
		// ================================================================================= //
		 
		$this->setRedirect ( 'index.php?option=' . $option . '&view=event', $msg );
		
		
	}
	function remove() {
		$option = JRequest::getVar('option','','request','string');
		$cid = JRequest::getVar ( 'cid', array (0 ), 'post', 'array' );
		if (! is_array ( $cid ) || count ( $cid ) < 1) {
			JError::raiseError ( 500, JText::_ ( 'SELECT_AN_ITEM_TO_DELETE' ) );
		}
		$model = $this->getModel ( 'event_detail' );
		if (! $model->delete ( $cid )) {
			echo "<script> alert('" . $model->getError ( true ) . "'); window.history.go(-1); </script>\n";
		}
		$msg = JText::_ ( 'EVENT_DETAIL_DELETED_SUCCESSFULLY' );
		$this->setRedirect ( 'index.php?option='.$option.'&view=event',$msg );
	}
	
	function publish() {
		$option = JRequest::getVar('option','','request','string');
		$cid = JRequest::getVar ( 'cid', array (0 ), 'post', 'array' );
		if (! is_array ( $cid ) || count ( $cid ) < 1) {
			JError::raiseError ( 500, JText::_ ( 'SELECT_AN_ITEM_TO_PUBLISH' ) );
		}
		$model = $this->getModel ( 'event_detail' );
		if (! $model->publish ( $cid, 1 )) {
			echo "<script> alert('" . $model->getError ( true ) . "'); window.history.go(-1); </script>\n";
		}
		$msg = JText::_ ( 'EVENT_DETAIL_PUBLISHED_SUCCESSFULLY' );
		$this->setRedirect ( 'index.php?option='.$option.'&view=event',$msg );
	}
	
	function unpublish() {
		$option = JRequest::getVar('option','','request','string');
		$cid = JRequest::getVar ( 'cid', array (0 ), 'post', 'array' );
		if (! is_array ( $cid ) || count ( $cid ) < 1) {
			JError::raiseError ( 500, JText::_ ( 'SELECT_AN_ITEM_TO_UNPUBLISH' ) );
		}
		$model = $this->getModel ( 'event_detail' );
		if (! $model->publish ( $cid, 0 )) {
			echo "<script> alert('" . $model->getError ( true ) . "'); window.history.go(-1); </script>\n";
		}
		$msg = JText::_ ( 'EVENT_DETAIL_UNPUBLISHED_SUCCESSFULLY' );
		$this->setRedirect ( 'index.php?option='.$option.'&view=event',$msg );
	}
	
	function cancel($key = NULL) {
		$option = JRequest::getVar('option','','request','string');
		$msg = JText::_ ( 'EVENT_DETAIL_EDITING_CANCELLED' );
		$this->setRedirect ( 'index.php?option='.$option.'&view=event',$msg );
	}
	
}