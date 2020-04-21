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


class eventstyle_detailModeleventstyle_detail extends JModelLegacy
{
	var $_id = null;
	var $_data = null;
	var $_region = null;
	var $_table_prefix = null;
	var $_copydata	=	null;

	function __construct()
	{
		parent::__construct();

		$this->_table_prefix = '#__jeecard_';		
	  
		$array = JRequest::getVar('cid',  0, '', 'array');
		
		$this->setId((int)$array[0]);
		
	}
	function setId($id)
	{
		$this->_id		= $id;
		$this->_data	= null;
	}

	function &getData()
	{
		if ($this->_loadData())
		{
			
		}else  $this->_initData();

	   	return $this->_data;
	}
	
	
	function _loadData()
	{
		if (empty($this->_data))
		{
			 $query = 'SELECT * FROM '.$this->_table_prefix.'style WHERE id = '. $this->_id;
			
			$this->_db->setQuery($query);
			$this->_data = $this->_db->loadObject();
			return (boolean) $this->_data;
		}
		return true;
	}

	
	function _initData()
	{
		if (empty($this->_data))
		{
			$detail = new stdClass();
			$detail->id			= null;
			$detail->style		= null;
			$detail->who		= null;
			$detail->yes    	= null;
			$detail->maybe		= null;
			$detail->no  		= null;
			
			$this->_data		 	= $detail;
			return (boolean) $this->_data;
		}
		return true;
	}
  	function store($data)
	{ 
		
		/*echo '<pre>';
		print_r($data);
		exit;*/
		
		$row =$this->getTable('eventstyle');
		
		 
		if (!$row->bind($data)) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}
	
		if (!$row->store()) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}
		
		return $row;
	}

	function delete($cid = array())
	{
		if (count( $cid ))
		{
			$cids = implode( ',', $cid );
			
			 $query = 'DELETE FROM '.$this->_table_prefix.'style WHERE id IN ( '.$cids.' )';
		
			$this->_db->setQuery( $query );
			if(!$this->_db->query()) {
				$this->setError($this->_db->getErrorMsg());
				return false;
			}
		}

		return true;
	}

	
	
	
		
}