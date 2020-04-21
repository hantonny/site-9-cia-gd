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

class eventinvite_detailModeleventinvite_detail extends JModelLegacy
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
			$query = 'SELECT * FROM '.$this->_table_prefix.'eventlist WHERE eventlist_id = '. $this->_id;
			$this->_db->setQuery($query);
			$this->_data = $this->_db->loadObject();
			return (boolean) $this->_data;
		}
		return true;
	}

	
  	function delete($cid = array())
	{
		if (count( $cid ))
		{
			$cids = implode( ',', $cid );
			$query = 'DELETE FROM '.$this->_table_prefix.'eventlist WHERE eventlist_id IN ( '.$cids.' )';
			$this->_db->setQuery( $query );
			if(!$this->_db->query()) {
				$this->setError($this->_db->getErrorMsg());
				return false;
			}
			
			$comment_query = 'DELETE FROM '.$this->_table_prefix.'eventsent WHERE eventlist_id IN ( '.$cids.' )';
			$this->_db->setQuery( $comment_query );
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
			
			 $query = 'UPDATE '.$this->_table_prefix.'event'
				. ' SET published = ' . intval( $publish )
				. ' WHERE eventid IN ( '.$cids.' )';
				
				
			$this->_db->setQuery( $query );
			if (!$this->_db->query()) {
				$this->setError($this->_db->getErrorMsg());
				return false;
			}
		}

		return true;
	}
	
	function getconfigration()
	{
		$db= JFactory :: getDBO();
		$sql="SELECT * FROM ".$this->_table_prefix."configration WHERE id=1";
		$db->setQuery($sql);
		return $db->loadObject();
	}
	
	function getmyevent($cids)
	{
		$db= JFactory :: getDBO();
		$sql='SELECT user_id FROM '.$this->_table_prefix.'event WHERE eventid IN ( '.$cids.' )';
		$db->setQuery($sql);
		return $db->loadObjectlist();
	}
	
	function getsentevents($eventlist_id) 
	{
		$db= JFactory :: getDBO();
		$sql = 'SELECT email FROM '.$this->_table_prefix.'eventsent WHERE eventlist_id IN ('.$eventlist_id.')';
		$db->setQuery($sql);
		return $db->loadresultarray();
	}

}