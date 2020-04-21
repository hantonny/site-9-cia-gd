<?php
/**
* @package   JE Ecard
* @copyright Copyright (C) 2009 - 2010 Open Source Matters. All rights reserved.
* @license   http://www.gnu.org/licenses/lgpl.html GNU/LGPL, see LICENSE.php
* Contact to : emailtohardik@gmail.com, joomextensions@gmail.com
* Visit : http://www.joomlaextensions.co.in/
**/ 

defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.view' );

class event_listViewevent_list extends JViewLegacy
{
	function __construct( $config = array())
	{
		parent::__construct( $config );
	}

	function display($tpl = null)
	{	
		global $context;
		$mainframe = JFactory::getApplication();
		$uri	= JFactory::getURI();
		$temp_id = JRequest::getvar('send_invite','','','int');
		if($temp_id)
		{
			$tpl = 'detail';
		}
		else
		{
			$eventlist = $this->get( 'Data');
			// ========= For paginaion =========================================
			$limit		= JRequest::getVar('limit', 10, '', 'int');
			$limitstart	= JRequest::getVar('limitstart', 0, '', 'int');
			$total = $this->get('total');
			jimport('joomla.html.pagination'); 
			$this->pagination = new JPagination($total, $limitstart, $limit);
			// =================================================================
			$this->assignRef('eventlist',$eventlist); 
		}
		parent::display($tpl);
	}

}
?>

