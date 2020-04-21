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
 
class eventViewevent extends JViewLegacy 
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
		$document->setTitle( JText::_('EVENT') );
   		 
   		JToolBarHelper::title(   JText::_( 'EVENT_MANAGEMENT') );   		
   		JToolBarHelper::addNew();
 		JToolBarHelper::editList();
		JToolBarHelper::deleteList();		
		JToolBarHelper::publishList();
		JToolBarHelper::unpublishList();
	   
	   	$uri	= JFactory::getURI();
		$filter_order     = $mainframe->getUserStateFromRequest( $context.'filter_order',      'filter_order', 	  'eventid' );
		$filter_order_Dir = $mainframe->getUserStateFromRequest( $context.'filter_order_Dir',  'filter_order_Dir', '' );
		$plan = $mainframe->getUserStateFromRequest( $context.'event','event',0 );
	 	$lists['order'] 		= $filter_order;  
		$lists['order_Dir'] = $filter_order_Dir;
		
		$event			= $this->get( 'Data');
		$total			= $this->get( 'Total');
		$pagination = $this->get( 'Pagination' );
		
		$searchlists	= array();
		
		$allcategory	= $this->get('allcategory');
		$sel_allcategory	= array();
		$sel_allcategory[]  = JHTML::_('select.option', '0 ', JText::_( 'SELECT_CATEGORY'));
	
		
		$allcategory	= @array_merge($sel_allcategory,$allcategory);
		
		$sel_catid		= JRequest::getVar('catid', '0','request','int');
		$searchlists['allcategory'] 	= JHTML::_('select.genericlist',$allcategory, 'catid', 'class="inputbox" size="1" onchange="selectsearch(this.value)"', 'value', 'text',$sel_catid );
		
		
		
/*		$allevent	= $this->get('allevent');
		$sel_allevent	= array();
		$sel_allevent[0]->text	= JText::_('SELECT_EVENT');	
		$sel_allevent[0]->value	= '0';
		$allevent	= @array_merge($sel_allevent,$allevent);
		$sel_eventid		= JRequest::getVar('eventeid', '0','request','int');
		$searchlists['allevent'] 	= JHTML::_('select.genericlist',$allevent,'eventeid', 'class="inputbox" size="1" onchange="selectsearch(this.value)"', 'value', 'text',$sel_eventid ); */
		$publish_op = array();
		$publish_op[]   	= JHTML::_('select.option', '-1',JText::_('SELECT'));
		$publish_op[]   	= JHTML::_('select.option', '1',JText::_('PUBLISHED'));
		$publish_op[]   	= JHTML::_('select.option', '0', JText::_('UNPUBLISHED'));
		
		$published	= JRequest::getVar('published', '-1','request','int');
		$searchlists['published'] = JHTML::_('select.genericlist',$publish_op,'published', 'class="inputbox" size="1" onchange="selectsearch(this.value)" ','value','text' ,$published); 
		
	
     	$this->assignRef('lists',		$lists);
		$this->assignRef('searchlists',		$searchlists);    
  		$this->assignRef('event',		$event); 		
    	$this->assignRef('pagination',	$pagination);
    	   	
    	parent::display($tpl);
  }
   // ================================= For Ordering =======================================================//
	  protected function getSortFields(){
			return array(
				'ordering' => JText::_('JGRID_HEADING_ORDERING'),
				'published' => JText::_('JSTATUS'),
				'name' => JText::_('JGLOBAL_TITLE')
			);
		}
   // ================================= For Ordering =======================================================//	

}