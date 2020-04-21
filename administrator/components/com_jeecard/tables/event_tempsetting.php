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

class Tableevent_tempsetting extends JTable
{
	var $id 						= null;
	var $alleventlist_tempt 		= null;
	var $alleventlist_more_tempt	= null;
	var $eventcrlist_tempt 			= null;
	var $dateevent_tempt			= null;
	
	function Tableevent_tempsetting(& $db) 
	{
	  	$this->_table_prefix = '#__jeajx_';
		parent::__construct($this->_table_prefix.'tempsetting', 'id', $db);
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
?>