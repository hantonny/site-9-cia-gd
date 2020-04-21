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

class eventinvite_detailVieweventinvite_detail extends JViewLegacy 
{
	function display($tpl = null)
	{
		$document = JFactory::getDocument();
		$document->setTitle( JText::_('EVENT_INVITATION_DETAIL') );
		$uri 		= JFactory::getURI();
		$option = JRequest::getVar('option','','request','string');
		
		$this->setLayout('default');
		$lists = array();
		$detail	= $this->get('data');
					
		$isNew		= ($detail->catid < 1);
		//$text = $isNew ? JText::_( 'NEW' ) : JText::_( 'EDIT' );
		$text = '';
		JToolBarHelper::title(   JText::_( 'EVENT_INVITATION_DETAIL' ));
		
		
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