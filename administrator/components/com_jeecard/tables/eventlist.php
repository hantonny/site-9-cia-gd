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

class Tableeventlist extends JTable
{
	var $eventlist_id 		= null;
	var $eventid 			= null;
	var $user_id 			= null;
	var $event_title 		= null;
	var $catid 				= null;
	var $host 				= null;
	var $phone 				= null;
	var $location_name 		= null;
	var $address 			= null;
	var $city 				= null;
	var $event_time 		= null;
	var $date 				= null;
	var $message 			= null;
	var $rsvp 				= null;
	var $comment			= null;
	var $hideguest 			= null;
	var $noguests 			= null;
	var $inviteother 		= null;
	var $bringother			= null;
	var $limit	 			= null;
	var $indicateattending  = null;
	var $host_email			= null;
	
	function Tableeventlist(& $db) 
	{
	 	$this->_table_prefix = '#__jeecard_';
		parent::__construct($this->_table_prefix.'eventlist', 'eventlist_id', $db);
	}

	function bind($array, $ignore = '')
	{
		if (key_exists( 'params', $array ) && is_array( $array['params'] )) {
			$registry = new JRegistry();
			$registry->loadArray($array['params']);
			$array['params'] = $registry->toString();
		}
		return parent::bind($array, $ignore);
	}
	
}