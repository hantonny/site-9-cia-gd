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
 
class fieldsViewfields extends JViewLegacy  {
	function __construct( $config = array()){
		parent::__construct( $config );
	}
    
	function display($tpl = null){
		global $context;
		$mainframe = JFactory::getApplication();
		$document = JFactory::getDocument();
		$document->setTitle( JText::_('FIELDS') );
   		JToolBarHelper::title(   JText::_( 'FIELDS_MANAGEMENT' ), 'generic.png' );
        JToolBarHelper::addNew();
 		JToolBarHelper::editList();		
		JToolBarHelper::deleteList();		
		JToolBarHelper::publishList();
		JToolBarHelper::unpublishList();
	   
		$uri	= JFactory::getURI();
		
		$filter_order     = $mainframe->getUserStateFromRequest( $context.'filter_order',      'filter_order', 	  'field_id' );
		$filter_order_Dir = $mainframe->getUserStateFromRequest( $context.'filter_order_Dir',  'filter_order_Dir', '' );		
		$limitstart = $mainframe->getUserStateFromRequest( $context.'limitstart',  'limitstart', '0' );
		$limit = $mainframe->getUserStateFromRequest( $context.'limit',  'limit', '10' );
		
		  
		$lists['order'] 		= $filter_order;  
		$lists['order_Dir'] = $filter_order_Dir;
		$fields			= $this->get( 'Data');
		$total			= $this->get( 'Total');
		$pagination = $this->get( 'Pagination' );
		
		
		$formdata	= $this->get('formdata');
		$sel_formdata = array();
		$sel_formdata[0]->value="0";
		$sel_formdata[0]->text=JText::_('SELECT_FORM');
		$formdata=@array_merge($sel_formdata,$formdata);
		
		//-----this field is used for search form name select box--//
			$field_section = JRequest::getVar('field_section','','','int');
		//---------------------------------------------------------//
		$lists['formdata'] 	= JHTML::_('select.genericlist',$formdata,  'field_section', 'class="inputtext" ', 'value', 'text', $field_section );
		
		
		$pagination = new JPagination( $total, $limitstart, $limit);
				
		$this->assignRef('user',		JFactory::getUser());	
		$this->assignRef('lists',		$lists);    
		$this->assignRef('fields',		$fields); 		
		$this->assignRef('pagination',	$pagination);
		   	
		parent::display($tpl);
  }
}
?>
