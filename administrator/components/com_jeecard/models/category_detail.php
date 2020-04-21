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


class category_detailModelcategory_detail extends JModelLegacy
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
			 $query = 'SELECT * FROM '.$this->_table_prefix.'category WHERE catid = '. $this->_id;
			
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
			$detail->catid			= 0;
			$detail->name			= null;
			$detail->catparent		= 0;
			$detail->description	= null;
			$detail->published		= 1;
			
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
		
		$row =$this->getTable('category');
		
		 
		if (!$row->bind($data)) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}
	
		if (!$row->store()) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}
		
		return true;
	}

	function delete($cid = array())
	{
		if (count( $cid ))
		{
			$cids = implode( ',', $cid );
			
			 $query = 'DELETE FROM '.$this->_table_prefix.'category WHERE catid IN ( '.$cids.' )';
		
			$this->_db->setQuery( $query );
			if(!$this->_db->query()) {
				$this->setError($this->_db->getErrorMsg());
				return false;
			}
		}

		return true;
	}
	function publish($cid = array(), $publish = 1)
	{		
		if (count( $cid ))
		{
			$cids = implode( ',', $cid );
			
		 	$query = 'UPDATE '.$this->_table_prefix.'category'
				. ' SET published = ' . intval( $publish )
				. ' WHERE catid IN ( '.$cids.' )';
			$this->_db->setQuery( $query );
	
			if (!$this->_db->query()) {
				$this->setError($this->_db->getErrorMsg());
				return false;
			}
		}

		return true;
	}
	
	function getcategory() {
		$db= JFactory :: getDBO();
		$q = "SELECT catid AS value,name AS text FROM ".$this->_table_prefix."category WHERE catparent=0 AND catid NOT IN (".$this->_id.")";
		$db->setQuery($q); 
		$parents=$db->loadObjectList();
		if(count($parents)!=0) {	
			for($i=0;$i<count($parents);$i++){
				$this->_cat_list[]= $parents[$i];
				$this->get_child($parents[$i]->value,0);
			}
			return $this->_cat_list;
		} else {
			return $parents;
		}
		
			
	}
	
	function get_child($id="",$count){
		$count++;
		$db= JFactory :: getDBO();
		$addquery ='';
		$addquery	= " AND catid NOT IN (".$this->_id.")";
		$q = "SELECT catid AS value,name AS text FROM ".$this->_table_prefix."category WHERE catparent=".$id.$addquery;
		$db->setQuery($q);
		$child=$db->loadObjectList();
			
		for($i=0;$i<count($child);$i++){
			$des ='';
			for($k=0;$k<$count;$k++) {
				$des.=' - ';	
			}
			$child[$i]->text = $des.$child[$i]->text;
			$this->_cat_list[]= $child[$i];
			$this->get_child($child[$i]->value,$count);
		}
		
	}

	
		
}