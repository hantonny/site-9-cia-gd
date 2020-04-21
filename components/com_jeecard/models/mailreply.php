<?php

/**
* @package  JE Ecard
* @copyright Copyright (C) 2009 - 2010 Open Source Matters. All rights reserved.
* @license   http://www.gnu.org/licenses/lgpl.html GNU/LGPL, see LICENSE.php
* Contact to : emailtohardik@gmail.com, joomextensions@gmail.com
* Visit : http://www.joomlaextensions.co.in/
**/ 

defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.model');
class mailreplyModelmailreply extends JModelLegacy
{


	var $_data = null;
	var $_total = null;
	var $_pagination = null;
	var $_table_prefix = null;
	function __construct()
	{
		parent::__construct();
		$mainframe = JFactory::getApplication();
		 $context='';
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
			
			$this->_data = $this->_getList($query);
		}
		return $this->_data;
	}
	function getTotal()
	{
		if (empty($this->_total))
		{
			$mainframe = JFactory::getApplication();
		 $context='';
		  $send_id = JRequest::getVar( 'send_id', '0','request','int');
		  $myvar 	= JRequest::getVar ( 'myvar', '', '0', 'int' );
				$db = JFactory::getDbo();
				if($myvar){
				echo $sqlp = 'UPDATE  '.$this->_table_prefix.'eventsent SET '.$myvar.'=1  WHERE id= '.$send_id;
				$db->setQuery($sqlp);
				$db->query();	
		  		}
			$query = ' SELECT * FROM '.$this->_table_prefix.'comment WHERE send_id='.$send_id.' ORDER BY id ASC';
			$this->_total = $this->_getListCount($query);
		}
		return $this->_total;
	}
	
	function _buildQuery()
	{			$send_id = JRequest::getVar( 'send_id', '0','request','int');
				$myvar 	= JRequest::getVar ( 'myvar', '', 'request', 'string' );
				$db = JFactory::getDbo();
				if($myvar){
					if($myvar == 'yes'){
				
						  $sqlp = 'UPDATE  '.$this->_table_prefix.'eventsent SET '.$myvar.'=1,maybe=0,no=0  WHERE id= '.$send_id;
					
						}
					 if($myvar == 'maybe'){
				
					  $sqlp = 'UPDATE  '.$this->_table_prefix.'eventsent SET '.$myvar.'=1,yes=0,no=0  WHERE id= '.$send_id;
						}
					 if($myvar == 'no'){
				
					  $sqlp = 'UPDATE  '.$this->_table_prefix.'eventsent SET '.$myvar.'=1,maybe=0,yes=0  WHERE id= '.$send_id;
						}	
						$db->setQuery($sqlp);
					$db->query();	
		  		}
				$db= JFactory :: getDBO();
	 	$query = 'SELECT eventlist_id FROM '.$this->_table_prefix.'eventsent WHERE id ='.$send_id;
		$db->setQuery($query);
		$eventdata = $db->LoadObject();
	
		//exit;
		if($eventdata->eventlist_id)
		{
		  			$query = 'SELECT c.*,s.* FROM '.$this->_table_prefix.'comment AS c INNER JOIN '.$this->_table_prefix.'eventsent AS s  ON c.send_id=s.id 	 						WHERE s.eventlist_id='.$eventdata->eventlist_id;
				//	$query = 'SELECT * FROM '.$this->_table_prefix.'comment WHERE send_id='.$send_id;
		 			return $query;
		}
	}
	function store($data)
	{ 
		$row = $this->getTable('comment');
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
	
	
		
	function getcurrency()
	{
		$db= JFactory :: getDBO();
	 	$query = 'SELECT * FROM '.$this->_table_prefix.'configration WHERE id = 1';
		$db->setQuery($query);
		$list = $db->LoadObject();
		return $list;
		
	}
	function getuserimg($id)
	{
		$db= JFactory :: getDBO();
	  	$query = 'SELECT * FROM '.$this->_table_prefix.'userdetail WHERE user_id ='.$id;
		$db->setQuery($query);
		$list = $db->LoadObject();
		return $list;
	}
	function getmyevent(){
		$send_id = JRequest::getVar( 'send_id', '0','request','int');
		
		$db= JFactory :: getDBO();
	 	$query = 'SELECT eventlist_id FROM '.$this->_table_prefix.'eventsent WHERE id ='.$send_id;
		$db->setQuery($query);
		$eventdata = $db->LoadObject();
		if($eventdata->eventlist_id)
		{
		$db= JFactory :: getDBO();
	   	$query = 'SELECT e.*,el.* FROM '.$this->_table_prefix.'eventlist AS el INNER JOIN '.$this->_table_prefix.'event AS e WHERE el.eventlist_id ='.$eventdata->eventlist_id;
		$db->setQuery($query);
		return $yes = $db->LoadObject();
		}
		}
		
	
	function getmyyes(){
		$send_id = JRequest::getVar( 'send_id', '0','request','int');
		
		$db= JFactory :: getDBO();
	 	$query = 'SELECT eventlist_id FROM '.$this->_table_prefix.'eventsent WHERE id ='.$send_id;
		$db->setQuery($query);
		$eventdata = $db->LoadObject();
		if($eventdata->eventlist_id)
		{
		$db= JFactory :: getDBO();
	   	$query = 'SELECT * FROM '.$this->_table_prefix.'eventsent WHERE eventlist_id ='.$eventdata->eventlist_id.' AND yes=1';
		$db->setQuery($query);
		return $yes = $db->LoadObjectList();
		}
		
	}
	function getmymaybe(){
		$send_id = JRequest::getVar( 'send_id', '0','request','int');
		
		$db= JFactory :: getDBO();
	 	$query = 'SELECT eventlist_id FROM '.$this->_table_prefix.'eventsent WHERE id ='.$send_id;
		$db->setQuery($query);
		$eventdata = $db->LoadObject();
		if($eventdata->eventlist_id)
		{
		$db= JFactory :: getDBO();
	   	$query = 'SELECT * FROM '.$this->_table_prefix.'eventsent WHERE eventlist_id ='.$eventdata->eventlist_id.' AND maybe=1';
		$db->setQuery($query);
		return $maybe = $db->LoadObjectList();
		}
		
	}
	function getmyno(){
		$send_id = JRequest::getVar( 'send_id', '0','request','int');
		
		$db= JFactory :: getDBO();
	 	$query = 'SELECT eventlist_id FROM '.$this->_table_prefix.'eventsent WHERE id ='.$send_id;
		$db->setQuery($query);
		$eventdata = $db->LoadObject();
		if($eventdata->eventlist_id)
		{
		$db= JFactory :: getDBO();
	   	$query = 'SELECT * FROM '.$this->_table_prefix.'eventsent WHERE eventlist_id ='.$eventdata->eventlist_id.' AND no=1';
		$db->setQuery($query);
		return $no = $db->LoadObjectList();
			
		}
		}
		function getmycommet(){
				$send_id = JRequest::getVar( 'send_id', '0','request','int');
		
				$db= JFactory :: getDBO();
	 			$query = 'SELECT eventlist_id FROM '.$this->_table_prefix.'eventsent WHERE id ='.$send_id;
				$db->setQuery($query);
				$eventdata = $db->LoadObject();
				if($eventdata->eventlist_id)
				{
					$db= JFactory :: getDBO();
	   				$query = 'SELECT el.*,u.* FROM '.$this->_table_prefix.'eventlist AS el INNER JOIN #__users AS u On u.id=el.user_id WHERE el.eventlist_id ='.$eventdata->eventlist_id;
					$db->setQuery($query);
					return $myower = $db->LoadObject();
					
				}
	
		
		
		
		}
		
		function mygetuser(){
		
				$send_id = JRequest::getVar( 'send_id', '0','request','int');
		
				$db= JFactory :: getDBO();
	 			 $query = 'SELECT * FROM '.$this->_table_prefix.'eventsent WHERE id ='.$send_id;
				$db->setQuery($query);
				return  $db->LoadObject();
		
		
		
		}
	
		
	

}