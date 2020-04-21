<?php
/**
* @package   JE Ecard
* @copyright Copyright (C) 2009 - 2010 Open Source Matters. All rights reserved.
* @license   http://www.gnu.org/licenses/lgpl.html GNU/LGPL, see LICENSE.php
* Contact to : emailtohardik@gmail.com, joomextensions@gmail.com
* Visit : http://www.joomlaextensions.co.in/
**/ 

defined ('_JEXEC') or die ('Restricted access');
jimport( 'joomla.application.component.controller' );
 
class form_layoutController extends JControllerForm 
{
	function __construct( $default = array())
	{
		parent::__construct( $default );
		$this->_table_prefix = '#__jeajx_';
	}	
	
	function cancel($key = NULL)
	{
		$this->setRedirect( 'index.php' );
	}
	
	function display($cachable = false, $urlparams = '')  {
		
		parent::display();
	}
	
	function update()
	{
	 	$db = JFactory::getDBO();
		$res = JRequest::getVar('q','0');
		$rec= explode("`",$res);
		$c=count($rec);
		for($i=0;$i<$c-1;$i++)
		{
			$j=$i+1;
			$query="UPDATE ".$this->_table_prefix."fields set ordering=".$j." where field_id=".$rec[$i];
			$db->setQuery( $query );
			$db->query();
		}
		exit;
	}
}	
?>