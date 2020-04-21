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
 
class eventstyleVieweventstyle extends JViewLegacy 
{
	function __construct( $config = array())
	{
		 parent::__construct( $config );
	}
    
	function display($tpl = null)
	{	
		global $context;
		$mainframe = JFactory::getApplication();
		$document = JFactory::getDocument();
		$document->setTitle( JText::_('EVENT_STYLE') );
   		
		JToolBarHelper::title(   JText::_( 'STYLE_MANAGEMENT' ) );   		
   		JToolBarHelper::addNew();
 		JToolBarHelper::editList();
		JToolBarHelper::deleteList();		
		//JToolBarHelper::publishList();
		//JToolBarHelper::unpublishList();
	   	
		$uri	= JFactory::getURI();
		$filter_order     = $mainframe->getUserStateFromRequest( $context.'filter_order',      'filter_order', 	  'catid' );
		$filter_order_Dir = $mainframe->getUserStateFromRequest( $context.'filter_order_Dir',  'filter_order_Dir', '' );
		$plan = $mainframe->getUserStateFromRequest( $context.'eventstyle','eventstyle',0 );
	 	$lists['order'] 		= $filter_order;  
		$lists['order_Dir'] = $filter_order_Dir;
		
		$eventstyle			= $this->get( 'Data');
		$total			= $this->get( 'Total');
		$pagination = $this->get( 'Pagination' );
		
		
	
		
		$this->assignRef('lists',		$lists);
		$this->assignRef('searchlists',	$searchlists);
  		$this->assignRef('eventstyle',		$eventstyle); 		
    	$this->assignRef('pagination',	$pagination);
    	   	
    	parent::display($tpl);
  }
}