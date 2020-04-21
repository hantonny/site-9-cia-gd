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
 
class categoryViewcategory extends JViewLegacy 
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
		$document->setTitle( JText::_('CATEGORY') );
   		
		JToolBarHelper::title(   JText::_( 'CATEGORY_MANAGEMENT' ) );   		
   		JToolBarHelper::addNew();
 		JToolBarHelper::editList();
		JToolBarHelper::deleteList();		
		JToolBarHelper::publishList();
		JToolBarHelper::unpublishList();
	   	
		$uri	= JFactory::getURI();
		$filter_order     = $mainframe->getUserStateFromRequest( $context.'filter_order',      'filter_order', 	  'catid' );
		$filter_order_Dir = $mainframe->getUserStateFromRequest( $context.'filter_order_Dir',  'filter_order_Dir', '' );
		$plan = $mainframe->getUserStateFromRequest( $context.'category','category',0 );
	 	$lists['order'] 		= $filter_order;  
		$lists['order_Dir'] = $filter_order_Dir;
		
		$category			= $this->get( 'Data');
		$total			= $this->get( 'Total');
		$pagination = $this->get( 'Pagination' );
		
		
		$searchlists	= array();
		
		$allcategory	= $this->get('allcategory');
		$sel_cat	= array();
	
		
		$sel_cat[]  = JHTML::_('select.option', '0 ', JText::_( 'SELECT_CATEGORY'));
		
		$allcategory	= @array_merge($sel_cat,$allcategory);
		$sel_catid		= JRequest::getVar('cateid', '0','request','int');
		$searchlists['catlist'] 	= JHTML::_('select.genericlist',$allcategory,  'cateid', 'class="inputbox" size="1" onchange="selectsearch(this.value)"', 'value', 'text',$sel_catid ); 
		
		$publish_op = array();
		$publish_op[]   	= JHTML::_('select.option', '-1',JText::_('SELECT'));
		$publish_op[]   	= JHTML::_('select.option', '1',JText::_('PUBLISHED'));
		$publish_op[]   	= JHTML::_('select.option', '0', JText::_('UNPUBLISHED'));
		
		$published	= JRequest::getVar('published', '-1','request','int');
		$searchlists['published'] = JHTML::_('select.genericlist',$publish_op,'published', 'class="inputbox" size="1" onchange="selectsearch(this.value)" ','value','text' ,$published); 
		$this->assignRef('lists',		$lists);
		$this->assignRef('searchlists',	$searchlists);
  		$this->assignRef('category',		$category); 		
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