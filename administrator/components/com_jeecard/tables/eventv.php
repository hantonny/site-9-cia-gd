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

class Tableevent extends JTable
{
	var $id			= null;
	var $title 		= null;
	var $category 	= null;
	var $usr 		= null;
	var $desc 		= null;
	var $start_date = null;
	var $end_date 	= null;
	var $published 	= null;
	var $bgcolor 	= null;
	var $txtcolor 	= null;
	var $street 	= null;
	var $country 	= null;
	var $city 		= null;
	var $postcode	= null;
	var $insert_user= null;
	var $youtubelink= null;
	var $googlelink	= null;
	var $erepeat	= null;

	function Tableevent(& $db) 
	{
		$this->_table_prefix = '#__jeajx_';
		parent::__construct($this->_table_prefix.'event', 'id', $db);
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
