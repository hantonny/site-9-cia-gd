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

class event_detailViewevent_detail extends JViewLegacy 
{
	function display($tpl = null)
	{
		$document = JFactory::getDocument();
		$document->setTitle( JText::_('EVENT_DETAIL') );
		$uri 		= JFactory::getURI();
		$option = JRequest::getVar('option','','request','string');
		
		$this->setLayout('default');
		$lists = array();
		$detail	= $this->get('data');
					
		$isNew		= ($detail->catid < 1);
		$text = $isNew ? JText::_( 'NEW' ) : JText::_( 'EDIT' );
		JToolBarHelper::title(   JText::_( 'EVENT' ).': <small><small>[ ' . $text.' ]</small></small>' );
		JToolBarHelper::save();
		
		if ($isNew)  {
			JToolBarHelper::cancel();
		} else {
		
			JToolBarHelper::cancel( 'cancel', 'Close' );
		}
		 
		$category	= $this->get('category');
		$sel_category = array();
		$sel_category[]  = JHTML::_('select.option', '0 ', JText::_( 'SELECT_CATEGORY'));
		$category=@array_merge($sel_category,$category);
		$lists['category'] 	= JHTML::_('select.genericlist',$category,  'catid', 'class="inputtext" ', 'value', 'text', $detail->catid ); 
		 
		$options[] = JHtml::_('select.option', '0', JText::sprintf('No'));
		$options[] = JHtml::_('select.option', '1', JText::sprintf('Yes')); 
		@$lists['published'] 	= JHTML::_('select.genericlist',$options,  'published', 'class="inputtext" ', 'value', 'text', $detail->published );
		
		$this->assignRef('lists',		$lists);
		$this->assignRef('detail',		$detail);
		

		parent::display($tpl);
	}
	
}