<?php
/**
* @package   JE Ecard
* @copyright Copyright (C) 2009 - 2010 Open Source Matters. All rights reserved.
* @license   http://www.gnu.org/licenses/lgpl.html GNU/LGPL, see LICENSE.php
* Contact to : emailtohardik@gmail.com, joomextensions@gmail.com
* Visit : http://www.joomlaextensions.co.in/
**/ 
defined ('_JEXEC') or die ('Restricted access');
jimport('joomla.application.component.model');
class eventinviteModeleventinvite extends JModelLegacy
{
	var $_data = null;
	var $_total = null;
	var $_pagination = null;
	var $_table_prefix = null;
	
	function __construct()
	{
		parent::__construct();

		global $context; 
		$mainframe = JFactory::getApplication();
		$context='eventlist_id';
	  	$this->_table_prefix = '#__jeecard_';
					
		$limit			= $mainframe->getUserStateFromRequest( $context.'limit', 'limit', $mainframe->getCfg('list_limit'), 0);
		$limitstart = $mainframe->getUserStateFromRequest( $context.'limitstart', 'limitstart', 0 );
		
		$state     = $mainframe->getUserStateFromRequest( $context.'state','state',0);
		$filter     = $mainframe->getUserStateFromRequest( $context.'filter','filter',0);
		
		$this->setState('limit', $limit);
		$this->setState('limitstart', $limitstart);
		$this->setState('state', $state);
		$this->setState('filter', $filter);

	}
	function getData()
	{		
		if (empty($this->_data))
		{
			$query = $this->_buildQuery();
			$this->_data = $this->_getList($query, $this->getState('limitstart'), $this->getState('limit'));
		}
		return $this->_data;
	}
	
	function getTotal()
	{
		if (empty($this->_total))
		{
			$query = $this->_buildQuery();
			$this->_total = $this->_getListCount($query);
		}
		return $this->_total;
	}
	
	function getPagination()
	{
		if (empty($this->_pagination))
		{
			jimport('joomla.html.pagination');
			$this->_pagination = new JPagination( $this->getTotal(), $this->getState('limitstart'), $this->getState('limit') );
		}
		return $this->_pagination;
	}
  	
	function _buildQuery()
	{
		$where = "";    
	    $orderby	= $this->_buildContentOrderBy();
		$query = ' SELECT *  FROM '.$this->_table_prefix.'eventlist WHERE 1=1 '.$where;
		return $query;
	}
	function _buildContentOrderBy()
	{
		global $context;
		$mainframe = JFactory::getApplication();
		$filter_order     = $mainframe->getUserStateFromRequest( $context.'filter_order',      'filter_order', 	  'id' );
		$filter_order_Dir = $mainframe->getUserStateFromRequest( $context.'filter_order_Dir',  'filter_order_Dir', '' );		
		$orderby 	= ' ORDER BY '.$filter_order.' '.$filter_order_Dir;			
		return $orderby;
	}
	
	function getallcategory() 
	{
		$db= JFactory :: getDBO();
		$sql = "SELECT catid AS value,name AS text FROM ".$this->_table_prefix."category";
		$db->setQuery($sql);
		return $db->loadObjectlist();
	}
	
	function getallevent() 
	{
		$db= JFactory :: getDBO();
		$sql = "SELECT eventid AS value,name AS text FROM ".$this->_table_prefix."event";
		$db->setQuery($sql);
		return $db->loadObjectlist();
	}
	
	function getsentevents($eventlist_id) 
	{
		$db= JFactory :: getDBO();
		$sql = 'SELECT email FROM '.$this->_table_prefix.'eventsent WHERE eventlist_id IN ('.$eventlist_id.')';
		$db->setQuery($sql);
		return $db->loadColumn();
	}

}