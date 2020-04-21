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


class contact_detailModelcontact_detail extends JModelLegacy
{
	var $_id = null;
	var $_data = null;
	var $_table_prefix = null;
	var $_fielddata = null;
	function __construct()
	{	
		parent::__construct();				
	  
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
 			  
			  $query = ' SELECT c.*,g.groupname FROM #__jeecard_contact AS c LEFT JOIN  #__jeecard_group AS g ON c.groupid=g.groupid  WHERE  c.cid='.$this->_id.' ORDER BY  c.cid  ' ;
			
			$this->_db->setQuery($query);
			$this->_data = $this->_db->loadObject();
			 
			return (boolean) $this->_data;
			
		}
		 return true;
		
	}

	
	// _____________________________________________________________________
	// Function is defined for Initialization of DATA in detail form
	// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	function _initData()
	{
		if (empty($this->_data))
		{
			$detail = new stdClass();
			$detail->cid		= 0;
			$detail->hostid		= 0;
			$detail->contact_name	= null;
			$detail->contact_email	= null;			
			$detail->groupid    = 0;
			$detail->groupname	= null;
			$this->_data= $detail;
			
			return (boolean) $this->_data;
			
			}
		return true;
	}
  	
	
	
	function delete($cid = array())
	{
		
		if (count( $cid ))
		{
			$cids = implode( ',', $cid );
			
			 $query = 'DELETE FROM #__jeecard_contact WHERE cid IN ( '.$cids.' )';
			$this->_db->setQuery( $query );
			if(!$this->_db->query()) {
				$this->setError($this->_db->getErrorMsg());
				//exit;
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
			
			$query = 'UPDATE '.$this->_table_prefix.'hoteldetail'
				. ' SET published = ' . intval( $publish )
				. ' WHERE h_id IN ( '.$cids.' )';
			$this->_db->setQuery( $query );
			
			if (!$this->_db->query()) {
				$this->setError($this->_db->getErrorMsg());
				return false;
			}
		}

		return true;
	}
	function getgroup()
	{
		$userid =  clone(JFactory::getUser());
		$db= JFactory :: getDBO();
		$query = 'SELECT groupname as text, groupid as value FROM #__jeecard_group WHERE uid ='.$userid->id.' AND published  =1 ';
			
		$db->setQuery($query);
		return $db->LoadObjectList();
	}
	
	

}

?>
