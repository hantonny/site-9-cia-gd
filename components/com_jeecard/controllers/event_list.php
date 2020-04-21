<?php
/**
* @package   JE Ecard
* @copyright Copyright (C) 2009 - 2010 Open Source Matters. All rights reserved.
* @license   http://www.gnu.org/licenses/lgpl.html GNU/LGPL, see LICENSE.php
* Contact to : emailtohardik@gmail.com, joomextensions@gmail.com
* Visit : http://www.joomlaextensions.co.in/
**/  

defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.controller' );

class event_listController extends JControllerForm
{	
	function __construct( $default = array())
	{
		parent::__construct( $default );
		$this->_table_prefix = '#__jeecard_';
	}
	function cancel($key = NULL)
	{
		$option = JRequest::getVar ('option','','','string');
		$this->setRedirect( 'index.php?option='.$option.'&view=event_list'  );
	}
	function display($cachable = false, $urlparams = '') 
	{
		parent::display();
	}
	function addcontact()
	{
		$post = JRequest::get('post','','','string');
		$user =  clone(JFactory::getUser());
		$mainframe = JFactory::getApplication();
		$db = JFactory::getDbO();
		if(isset($post['check']))
		{
		
			for($m=0;$m<count($post['check']);$m++)
			{
				$name = 'name_'.$post['check'][$m];
				$email = 'email_'.$post['check'][$m];
				$query = "SELECT cid FROM #__jeecard_contact  WHERE contact_email = '". $post["$email"]."'";
				$db->setQuery($query);
				$user_detail = $db->loadObject();
				if(!$user_detail)
				{
					 $sqluser="INSERT INTO #__jeecard_contact VALUES('',".$user->id.",'".$post["$name"]."','".$post["$email"]."',0)";	
			 		$db->setQuery($sqluser);
	 				$temp = $db->query();
				}
			}
 		}
		$mainframe->redirect ( JRoute::_('index.php?option=' . $post['option'] . '&view=event_list'), $msg );
	}
	
	function search()
	{
		$post 	= JRequest::get('post','','','string');
		$this->setRedirect ('index.php?option=com_jeecard&view=event_list&event_id='.$post['cid'].'&d_itemid='.$post['d_itemid']);
	}
}	
?>