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
 
class form_layoutViewform_layout extends JViewLegacy 
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
		$document->setTitle( JText::_('FORM_LAYOUT') );
   		JToolBarHelper::title(   JText::_( 'FORM_LAYOUT' ) );   		
   		$uri	= JFactory::getURI();
		
		$filter_order     = $mainframe->getUserStateFromRequest( $context.'filter_order',      'filter_order', 	  'id' );
		$filter_order_Dir = $mainframe->getUserStateFromRequest( $context.'filter_order_Dir',  'filter_order_Dir', '' );
		$limitstart = $mainframe->getUserStateFromRequest( $context.'limitstart',  'limitstart', '0' );
		$limit = $mainframe->getUserStateFromRequest( $context.'limit',  'limit', '10' );
		$plan = $mainframe->getUserStateFromRequest( $context.'form_layout','form_layout',0 );
	 	$lists['order'] 		= $filter_order;  
		$lists['order_Dir'] = $filter_order_Dir;
		
		$field_section = JRequest::getVar('field_section','0','','int');
		$total			= $this->get( 'Total');
		$pagination = $this->get( 'Pagination' );
		
		
		$formdata	= $this->get('formdata');
		if($field_section!="0") {
			$fielddata	= $this->get('fielddata');
			$fields			= $this->get( 'Data');
		}
		
		$sel_formdata = array();
		$sel_formdata[0]->value="0";
		$sel_formdata[0]->text=JText::_('SELECT_FORM');
		$formdata=@array_merge($sel_formdata,$formdata);
		//-----this field is used for search form name select box--//
			$field_section = JRequest::getVar('field_section','','','int');
		//---------------------------------------------------------//
		$lists['formdata'] 	= JHTML::_('select.genericlist',$formdata,  'field_section', 'class="inputtext" ', 'value', 'text', $field_section );
		
		$pagination = new JPagination( $total, $limitstart, $limit);
		
     	$this->assignRef('lists',		$lists);    
  		$this->assignRef('fields',		$fields);
		$this->assignRef('fielddata',	$fielddata);
    	$this->assignRef('pagination',	$pagination);
    	   	
    	parent::display($tpl);
  }
}
?>
