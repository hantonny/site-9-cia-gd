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

class eventstyle_detailVieweventstyle_detail extends JViewLegacy 
{
	function display($tpl = null)
	{
		$document = JFactory::getDocument();
		$document->setTitle( JText::_('EVENT_STYLE_DETAIL') );

		$uri 		= JFactory::getURI();
		
		//$doc = JFactory::getDocument();
		$option = JRequest::getVar('option','','request','string');
		
		$this->setLayout('default');

		$lists = array();

		$detail	= $this->get('data');
		
		$eventstyle	= $this->get('eventstyle');			
		
	 	
		$isNew		= ($detail->id < 1);

		$text = $isNew ? JText::_( 'NEW' ) : JText::_( 'EDIT' );
		JToolBarHelper::title(   JText::_( 'EVENT_STYLE' ).': <small><small>[ ' . $text.' ]</small></small>' );
	
		 
		JToolBarHelper::save();
		
		if ($isNew)  {
			JToolBarHelper::cancel();
		} else {
		
			JToolBarHelper::cancel( 'cancel', 'Close' );
		}
		 
		
		
		$this->assignRef('lists',		$lists);
		$this->assignRef('detail',		$detail);
		

		parent::display($tpl);
	}
	
}