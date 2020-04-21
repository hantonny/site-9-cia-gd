<?php
/**
* @package   JE Ecard
* @copyright Copyright (C) 2009 - 2010 Open Source Matters. All rights reserved.
* @license   http://www.gnu.org/licenses/lgpl.html GNU/LGPL, see LICENSE.php
* Contact to : emailtohardik@gmail.com, joomextensions@gmail.com
* Visit : http://www.joomlaextensions.co.in/
**/  


defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.model');

class eventsModelevents extends JModelLegacy
{
	var $_data 			= null;
	var $_total 		= null;
	var $_pagination 	= null;
	var $_table_prefix 	= null;
	
	function __construct()
	{
		parent::__construct();
		$mainframe = JFactory::getApplication();
		$context='jecard_events';		
	  	$this->_table_prefix = '#__jeecard_';
		$limit		= $mainframe->getUserStateFromRequest( $context.'limit', 'limit', $mainframe->getCfg('list_limit'), 0);
		$limitstart = $mainframe->getUserStateFromRequest( $context.'limitstart', 'limitstart', 0 );
		$this->setState('limit', $limit);
		$this->setState('limitstart', $limitstart);
	}
	
	function getData()
	{	
		if (empty($this->_data))
		{
			$this->_data = $this->_buildQuery();
		}
		return $this->_data;
	}
	
	function getTotal()
	{
		if (empty($this->_total))
		{
			$mainframe = JFactory::getApplication();
			$context='';
		 	$event_id = JRequest::getVar('event_id','','','int');
			$query = 'SELECT * FROM #__jeecard_event WHERE eventid='.$event_id.' ORDER BY id ASC';
			$this->_total = $this->_getListCount($query);
		}
		return $this->_total;
	}
	
	function _buildQuery()
	{	
		$context='';
		$event_id = JRequest::getVar('event_id','','','int');
		$db= JFactory :: getDBO();
		$query = 'SELECT * FROM #__jeecard_event WHERE eventid='.$event_id;
		$db->setQuery($query);
		return $db->loadObject();
		
	}
	function store($data)
	{ 
		$row = $this->getTable('eventlist');
		if (!$row->bind($data)) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}
		if (!$row->store()) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}
		return $row->eventlist_id;
	}
	
	function getPagination()
	{
		if (empty($this->_pagination))
		{
			jimport('joomla.html.pagination');
			$this->_pagination = new JPagination( $this->getTotal(), JRequest::getVar( 'limitstart', 0 ), 10 );
		}
		return $this->_pagination;
	}
	
	function getsetting()
	{
		$db= JFactory :: getDBO();
		$query = "SELECT * FROM ".$this->_table_prefix."configration WHERE id=1";
		$db->setQuery($query);
		return $db->loadObject();
	}
	
	function getcategory()
	{
		$db= JFactory :: getDBO();
		$query = "SELECT catid AS value,name AS text FROM ".$this->_table_prefix."category";
		$db->setQuery($query);
		return $db->loadObjectList();
	}
	
	function getcontact()
	{	$user = clone(JFactory::getUser());
		$db= JFactory :: getDBO();
		$query = "SELECT * FROM ".$this->_table_prefix."contact WHERE hostid =".$user->id;
		$db->setQuery($query);
		return $db->loadObjectList();
	}
	
	function getstyle()
	{
		$db= JFactory :: getDBO();
		$query = "SELECT id AS value,style AS text FROM ".$this->_table_prefix."style";
		$db->setQuery($query);
		return $db->loadObjectList();
	}
} 
?>