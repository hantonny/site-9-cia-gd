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

class event_listModelevent_list extends JModelLegacy
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
		$context='id';		
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
			//$query = 'SELECT * FROM '.$this->_table_prefix.'event WHERE published=1   ORDER BY eventid ASC ';
			$this->_total = $this->_getListCount($query);
		}
		return $this->_total;
	}

	function _buildQuery()
	{
		global $context;
		$event_id=JRequest::getVar('event_id','','','int');
		$d_itemid=JRequest::getVar('d_itemid','request','','int');
		$mainframe = JFactory::getApplication();
		$redconfig =$mainframe->getParams();
		$cat_id=$redconfig->get('cat_id');
		$where ='';
		$join ='';
		$fetch ='';
		if($cat_id > 0){
				$where = ' AND c.catid='.$cat_id;  
				$join = ' INNER JOIN '.$this->_table_prefix.'category AS c ON  e.catid=c.catid ';
				$fetch = ' ,c.name AS catname ';
		}
		if($event_id > 0 && $d_itemid > 0)
		{
			$where=' AND catid='.$event_id.' AND eventid='.$d_itemid;
		}
		 $query = 'SELECT e.* '.$fetch.' FROM '.$this->_table_prefix.'event AS e '.$join.' WHERE e.published=1 '.$where.'  ORDER BY e.eventid ASC ';
		return $query;
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
	function gettempsetting()
	{
		$db= JFactory :: getDBO();
		$sql="SELECT dateevent_tempt FROM ".$this->_table_prefix."tempsetting WHERE id=1";
		$db->setQuery($sql);
		return $db->loadObject();
	}
	function getcategory($cat_id)																			
	{	
		$db= JFactory :: getDBO();																				
		$sql='SELECT * FROM '.$this->_table_prefix.'category WHERE catid='.$cat_id;
		$db->setQuery($sql);																						
		return $db->loadObject();																					
	}
	function eventcategory($category)																			
	{	
		$db= JFactory :: getDBO();																				
		$sql='SELECT * FROM '.$this->_table_prefix.'cal_category WHERE id='.$category;
		$db->setQuery($sql);																						
		return $db->loadObject();																					
	}
} 
?>