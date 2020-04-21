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



class contactlistModelcontactlist extends JModelLegacy
{
	var $_data = null;
	var $_total = null;
	var $_pagination = null;
	var $_table_prefix = null;

	function __construct()
	{
		parent::__construct();
		$mainframe = JFactory::getApplication();
   	
		$context='hid';	
		
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
		
// _______________________________________________________________
	// Function can get All Dynamic Fields within defined Section
// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

	
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
				
			$user =  clone(JFactory::getUser());		
		    $query = ' SELECT * FROM #__jeecard_contact WHERE hostid='.$user->id;
			return $query;
	}

	
}	
?>