<?php
/**
* @package   JE Ecard
* @copyright Copyright (C) 2009 - 2010 Open Source Matters. All rights reserved.
* @license   http://www.gnu.org/licenses/lgpl.html GNU/LGPL, see LICENSE.php
* Contact to : emailtohardik@gmail.com, joomextensions@gmail.com
* Visit : http://www.joomlaextensions.co.in/
**/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

class JFormFieldJePcategory extends JFormFieldList
{
	protected $type 	= 'JePcategory';
	public $_cat_list 	= NULL;
	function getInput()
	{
		$parents	= null;
		$db = JFactory::getDBO();
		 $query = 'SELECT catid AS value,name AS text FROM #__jeecard_category WHERE catparent=0 ORDER BY catid ASC';
		$db->setQuery( $query );
		$parents = $db->loadObjectList();
		
		if(count($parents)!=0) {	
			for($i=0;$i<count($parents);$i++){
				$this->_cat_list[]= $parents[$i];
				$this->get_child($parents[$i]->value,0);
			}
			$eventdata	= $this->_cat_list;
		} else {
			$eventdata	= $parents;
		}
		
		$sel_pcat	= array();
		$sel_pcat[]  = JHTML::_('select.option', '0 ', JText::_( 'SELECT_CATEGORY'));
		$eventdata	= @array_merge($sel_pcat,$eventdata);
		
		//return JHTML::_('select.genericlist',  $eventdata, ''.$control_name.'['.$name.']', 'class="inputbox"', 'value', 'text', $value, $control_name.$name );

		return JHTML::_('select.genericlist',  $eventdata, $this->name, 'class="inputbox"', 'value', 'text', $this->value );
	}
	
	function get_child($id="",$count){
		$count++;
		$db= JFactory :: getDBO();
		
		$q = "SELECT catid AS value,name AS text FROM #__jeecard_category WHERE catparent=".$id;
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
	
}
