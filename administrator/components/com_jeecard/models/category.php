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

class categoryModelcategory extends JModelLegacy
{
	var $_data = null;
	var $_total = null;
	var $_pagination = null;
	var $_table_prefix = null;
	
	function __construct()
	{
		parent::__construct();

		global  $context; 
		$mainframe = JFactory::getApplication();
		$context='catid';
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
		$cateid		= JRequest::getVar('cateid', '0','request','int');
		$published	= JRequest::getVar('published', '-1','request','int');
		$cat_name=JRequest::getVar('search','','request','string');

		$where = '';
		if($cateid!=0 && $published!='-1') {
			$where .= 'WHERE catid='.$cateid.' AND published='.$published;
		} else if($cateid!=0) {
			$where .= 'WHERE catid='.$cateid;
		} else if($published!=-1) {
			$where .= 'WHERE published='.$published;  
		}
		if($cat_name!='')
		{
			$where=" WHERE name LIKE '".$cat_name."%'";	
		}
	    $orderby	= $this->_buildContentOrderBy();
		 $query 		= ' SELECT * FROM '.$this->_table_prefix.'category '.$where.$orderby;
		return $query;
	}
	function _buildContentOrderBy()
	{
		global $context;
		$mainframe = JFactory::getApplication();
		$filter_order     = $mainframe->getUserStateFromRequest( $context.'filter_order',      'filter_order', 	  'catid' );
		$filter_order_Dir = $mainframe->getUserStateFromRequest( $context.'filter_order_Dir',  'filter_order_Dir', '' );		
		$orderby 	= ' ORDER BY '.$filter_order.' '.$filter_order_Dir;			
		return $orderby;
	}
	
	function getparent($catid)
	{
		$db= JFactory :: getDBO();
		$query = 'SELECT * FROM '.$this->_table_prefix.'category WHERE catid='.$catid;
		$db->setQuery($query);
		return $db->loadObject();
	}
	
	function getallcategory() 
	{
		$db= JFactory :: getDBO();
		$sql = "SELECT catid AS value,name AS text FROM ".$this->_table_prefix."category";
		$db->setQuery($sql);
		return $db->loadObjectlist();
	}

// ================================= Ordering Function =======================================================//

		function saveorder(){

			$mainframe = JFactory::getApplication();

			$db = JFactory::getDBO();

			$cid = JRequest::getVar('cid', array(0), 'post', 'array');

			$total = count($cid);

			$order = JRequest::getVar('order', array(0), 'post', 'array');

			JArrayHelper::toInteger($order, array(0));

			$row = JTable::getInstance('category', 'Table');

			$groupings = array();

			for ($i = 0; $i < $total; $i++){

				$row->load((int)$cid[$i]);

				$groupings[] = $row->name;

				if ($row->ordering != $order[$i]){

					$row->ordering = $order[$i];

					if (!$row->store()){

						JError::raiseError(500, $db->getErrorMsg());

					}

				}

			}

			$groupings = array_unique($groupings);

			// foreach ($groupings as $group){

			// 	$row->reorder('c_id = '.(int)$group);

			// }

			$cache = JFactory::getCache('com_jeecard');

			$cache->clean();

			return true;

		}

	// ================================= End Ordering Function =======================================================//

}