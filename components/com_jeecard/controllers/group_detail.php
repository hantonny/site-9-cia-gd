<?php
/**
* @package   JE Ecard
* @copyright Copyright (C) 2009 - 2010 Open Source Matters. All rights reserved.
* @license   http://www.gnu.org/licenses/lgpl.html GNU/LGPL, see LICENSE.php
* Contact to : emailtohardik@gmail.com, joomextensions@gmail.com
* Visit : http://www.joomlaextensions.co.in/
**/ 

defined ( '_JEXEC' ) or die ( 'Restricted access' );
require_once(JPATH_COMPONENT.'/'.'helpers'.'/'.'thumbnail.php');

jimport ( 'joomla.application.component.controller' );
jimport('joomla.filesystem.file');
class group_detailController extends JControllerForm 
{
	function __construct($default = array()) 
	{
		parent::__construct ( $default );
		$this->registerTask ( 'add', 'edit' );
		
	}
	function edit($key = NULL, $urlVar = NULL) 
	{
		
		JRequest::setVar ( 'view', 'group_detail' );
		JRequest::setVar ( 'layout', 'default' );
		JRequest::setVar ( 'hidemainmenu', 1 );
		$model = $this->getModel ( 'group_detail' );
		parent::display ();
	}
	function save($key = NULL, $urlVar = NULL) 
	{
		$mainframe = JFactory::getApplication();
		$option = JRequest::getWord ('option','','','string');
		$post = JRequest::get ( 'post' ); 
		
		
		$post["description"] = JRequest::getVar( 'description', '', 'post', 'string', JREQUEST_ALLOWRAW );
		$array = JRequest::getVar('cid',  0, '', 'array');
		$post["groupid"] = $array[0];
		$db = JFactory::getDbO();
		
		
		$userid = clone(JFactory::getUser());
		
		if($post['groupid'])
		{
		 $sqluser="UPDATE #__jeecard_group SET groupname= '".$post["groupname"]."',description ='".$post["description"]."',published=".$post['published']." WHERE groupid=".$post['groupid'] .' AND uid='.$userid->id ;	
		}
		else	
		{	
			$sqluser="INSERT INTO #__jeecard_group VALUES('','".$post["groupname"]."',".$userid->id.",'".$post["description"]."',".$post['published'].")";	
		}
		
		
	 	$db->setQuery($sqluser);
	 	$temp = $db->query();
		
		if(!$post['groupid'])
			$post['groupid'] = $db->insertid();
		
		if(count($post['fromBox'])>0)
		{
			$sql = "DELETE FROM #__jeecard_groupcontact WHERE groupid = ".$post["groupid"];
			$db->setQuery($sql);
			$temp11 = $db->query();
			
			for($i=0;$i<count($post['fromBox']);$i++)
			{
			
				//$sql="INSERT INTO #__jeecard_groupcontact VALUES('',".$post["groupid"].",'".$post["fromBox"][$i]."')";
			
				$sql="UPDATE #__jeecard_contact SET groupid= ".$post["groupid"]." WHERE cid=".$post["fromBox"][$i];
				
				$db->setQuery($sql);

				$db->query();
			}
		}
		
		
		if($temp)
		$msg = JText::_( 'GROUP_ADDEDED_SUCCESSFULLY' );
		else
		$msg = JText::_( 'ERROR_IN_SAVING_GROUP' );
	 
		$mainframe->redirect ( JRoute::_('index.php?option=' . $post['option'] . '&view=group'), $msg );
		
	}
	function remove() {
	
		
		$option = JRequest::getWord ('option','','','string');
				
		$cid = JRequest::getVar ('cid',0,'','array');
		
		
		
		if (! is_array ( $cid ) || count ( $cid ) < 1) {
			JError::raiseError ( 500, JText::_ ( 'SELECT_AN_ITEM_TO_DELETE' ) );
		}
		
		$model = $this->getModel ( 'group_detail' );
		if (! $model->delete ( $cid )) {
			echo "<script> alert('" . $model->getError ( true ) . "'); window.history.go(-1); </script>\n";
		}
		$msg = JText::_ ( 'GROUP_DELETED_SUCCESSFULLY' );
		$this->setRedirect ( JRoute::_('index.php?option='.$option.'&view=group'),$msg );
	}
	
	function cancel($key = NULL) {
		
		$option = JRequest::getWord ('option','','','string');
		$msg = JText::_ ( 'GROUP_EDITING_CANCELLED' );
		$this->setRedirect ( JRoute::_('index.php?option='.$option.'&view=group'),$msg );
	}

	
	

}
?>

