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

class Tablefields_detail extends JTable
{
	var $field_id = null;
	var $field_title = null;
	var $wysiwyg = null;
	var $field_name = null;
	var $field_type = null;
	var $field_desc = null;	
	var $field_class = null;
	var $field_section = null;
	var $field_maxlength = null;
	var $field_cols = null;
	var $radio_cols = null;
	var $field_rows = null;
	var $field_show_in_front = null;
	
	//var $title_show_on_top = null;
	var $published = null;
	var $is_required = null;
	var $label_fontsize = null;
	var $label_bgcolor = null;
	var $label_textcolor = null;	
	
	
	function Tablefields_detail(& $db) 
	{
	  $this->_table_prefix = '#__jeajx_';
			
		parent::__construct($this->_table_prefix.'fields', 'field_id', $db);
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
