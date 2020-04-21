<?php
/**
* @package   JE Ecard
* @copyright Copyright (C) 2009 - 2010 Open Source Matters. All rights reserved.
* @license   http://www.gnu.org/licenses/lgpl.html GNU/LGPL, see LICENSE.php
* Contact to : emailtohardik@gmail.com, joomextensions@gmail.com
* Visit : http://www.joomlaextensions.co.in/
**/ 

defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.view' );

class group_detailViewgroup_detail extends JViewLegacy
{
	function display($tpl = null)
	{
		$option = JRequest::getWord('option','','request','string');
		
		//JToolBarHelper::title(   JText::_( 'HOTEL_MANAGEMENT_DETAIL' ), 'generic.png' );
		
		
		
		//============ Below js is used for selected field display when select field type=================
		//$document->addScript ('components/'.$option.'/assets/js/fields.js');
		//================================================================================================
		
		$uri 		= JFactory::getURI();
		
		$this->setLayout('default');
		$document = JFactory::getDocument();
		 $document->setTitle (JText::_( 'GROUP_DETAIL' ));
// ________________________________________________________
// 		All Functions are Declared in Variable for View
// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

		$lists = array();
		$detail	= $this->get('data');
		
		
 		 
		$isNew		= ($detail->groupid < 1);
		
		$text = $isNew ? JText::_( 'NEW' ) : JText::_( 'EDIT' );
		
		$assceetype = array();
		$assceetype[]   = JHTML::_('select.option', '1',JText::_('YES'));
		$assceetype[]   = JHTML::_('select.option', '0', JText::_('NO'));
		
		$group_contact = $this->get('contact');
				
		$all_contact = $this->get('allcontact');
	
		
		$lists['published'] 		= JHTML::_('select.radiolist',$assceetype,  'published', 'class="inputbox" size="1"  ', 'value', 'text' ,$detail->published); 	
		
		$lists['selectcontact'] = JHTML::_('select.genericlist',$group_contact,'fromBox[]','class="inputtext" multiple="multiple" size="1"','value','text',0);
		
		$lists['allcontact'] = JHTML::_('select.genericlist',$all_contact,'toBox','class="inputtext" multiple="multiple" size="1"','value','text',0);
// ____________________________________________________
//  (Assigned Function Call here that Used in Default)
// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
		
		$this->assignRef('lists',		$lists);
		
		$this->assignRef('detail',		$detail);
		
		$this->assignRef('request_url',	$uri->toString());

		parent::display($tpl);
	}
}
?>
