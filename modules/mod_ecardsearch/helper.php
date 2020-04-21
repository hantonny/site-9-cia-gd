<?php 
/**
* @package   JE EcardSearch
* @copyright Copyright (C) 2009-2010 Joomlaextensions.co.in All rights reserved.
* @license   http://www.gnu.org/licenses/lgpl.html GNU/LGPL, see LICENSE.php
* Contact to : emailtohardik@gmail.com, joomextensions@gmail.com
**/
  // no direct access

defined('_JEXEC') or die('Restricted access');
class mod_ecardsearchHelper {
	public static function getTour_list(&$params, &$access){
		
		$cat_id = $params->get('cat_id','');
		$category_id = implode(',',$cat_id);
		
		$db			=JFactory::getDBO();
	
		$where = '';
		if($cat_id){
			$where = ' AND catid IN ('.$category_id.')';
		}	
		
		$query = 'SELECT catid AS value, name  AS text FROM #__jeecard_category WHERE 1=1'.$where;
		$db->setQuery($query);
    	$make=   $db->loadObjectList();
		$sel_make	= array();
		$sel_make[]  = JHTML::_('select.option', '0 ', JText::_( 'SELECT_CATEGORY'));
		$make=@array_merge($sel_make,$make);

		$cid = JRequest::getVar('cid','','request','string');
		$lists['category_list'] 	= JHTML::_('select.genericlist',$make,'cid', 'class="inputtext" style="width:150px;" onchange="getmyitem(this.value)"', 'value', 'text',$cid);
		return $lists;
		
	}
	
	
}
?>