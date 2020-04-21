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

class event_detailModelevent_detail extends JModelLegacy
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
			$query = 'SELECT * FROM '.$this->_table_prefix.'event WHERE eventid = '. $this->_id;
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
			$detail->eventid		= 0;
			$detail->name			= null;
			$detail->description	= '<p> </p>
<h1 class="event_title"><span class="title">{title}</span></h1>
<ul class="host_phone">
<li class="host"><strong class="host">Host:</strong>
<div><span class="hostName">{name}</span></div>
<div><span class="phone">{phone}</span></div>
</li>
<li class="phone">
<div> </div>
</li>
</ul>
<ul class="when_where">
<li class="time"><strong class="when">When:</strong>
<div><span class="dateAndTime">{date}<br /></span></div>
<div><span class="dateAndTime">{time}<br /></span></div>
</li>
<li class="address"><strong class="where">Where:</strong>
<div><span class="locationName">{location}</span></div>
<div><span class="address">{address}</span></div>
<div><span class="address">{city}</span></div>
<div><span class="address">{state}</span></div>
</li>
</ul>';
			$detail->width		= null;
			$detail->height		= null;
			$detail->color		= null;	
			$detail->catid		= null;
			$detail->b_image	= null;
			$detail->published	= 1;					
			$this->_data		= $detail;
			return (boolean) $this->_data;
		}
		return true;
	}
  	function store($data)
	{ 
		$row =$this->getTable('event');
		if (!$row->bind($data)) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}
	
		if (!$row->store()) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}
		
		return $row->eventid;
	}

	function delete($cid = array())
	{
		if (count( $cid ))
		{
			$cids = implode( ',', $cid );
			$query = 'DELETE FROM '.$this->_table_prefix.'event WHERE eventid IN ( '.$cids.' )';
			$this->_db->setQuery( $query );
			if(!$this->_db->query()) {
				$this->setError($this->_db->getErrorMsg());
				return false;
			}
			
			$comment_query = 'DELETE FROM '.$this->_table_prefix.'comment WHERE id IN ( '.$cids.' )';
			$this->_db->setQuery( $comment_query );
			if(!$this->_db->query()) {
				$this->setError($this->_db->getErrorMsg());
				return false;
			}
			
			/*$rating_query = 'DELETE FROM '.$this->_table_prefix.'ratings WHERE eventid IN ( '.$cids.' )';
			$this->_db->setQuery( $rating_query );
			if(!$this->_db->query()) {
				$this->setError($this->_db->getErrorMsg());
				return false;
			}*/
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
	
	function getcategory() {
		$db= JFactory :: getDBO();
		$q = "SELECT catid AS value,name AS text FROM ".$this->_table_prefix."category WHERE catparent=0";
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
		
		$addquery	= "";
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
	
	
	
}