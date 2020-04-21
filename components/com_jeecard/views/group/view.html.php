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
 
class groupViewgroup extends JViewLegacy
{
	function __construct( $config = array())
	{
		 parent::__construct( $config );
	}
	function display($tpl = null)
	{	
		$mainframe = JFactory::getApplication();
		$context = "";


		$limit		= JRequest::getVar('limit', '', '', 'int');
		$limitstart	= JRequest::getVar('limitstart', 0, '', 'int');
		$uri	= JFactory::getURI();
		$option = JRequest::getWord('option','','request','string');
		$this->setLayout('default');
		
		$document 	= JFactory::getDocument();
		$document->setTitle (JText::_( 'GROUP' ));
		
		$filter_order     = $mainframe->getUserStateFromRequest( $context.'filter_order',      'filter_order', 	  'groupid' );
		$filter_order_Dir = $mainframe->getUserStateFromRequest( $context.'filter_order_Dir',  'filter_order_Dir', '' );
		
		
		$lists['order'] 		= $filter_order;  
		$lists['order_Dir'] = $filter_order_Dir;
// _____________________________________
      // Models files executes here
// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
		
		$test = $this->get( 'Data');
			
		$total			= $this->get( 'Total');
	
		jimport('joomla.html.pagination');
		$this->pagination = new JPagination($total, $limitstart, $limit);	
		/*echo '<pre>';
		print_r($this->pagination);
		exit;*/
		
		$this->assignRef('test',$test); 
		//$this->assignRef('pagination',	$pagination);		
			
		parent::display($tpl);
	
  }
}
 
?>
