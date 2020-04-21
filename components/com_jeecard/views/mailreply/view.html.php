<?php

/**

* @package    JE Ecard

* @copyright Copyright (C) 2009 - 2010 Open Source Matters. All rights reserved.

* @license   http://www.gnu.org/licenses/lgpl.html GNU/LGPL, see LICENSE.php

* Contact to : emailtohardik@gmail.com, joomextensions@gmail.com

* Visit : http://www.joomlaextensions.co.in/

**/

defined( '_JEXEC' ) or die( 'Restricted access' );



jimport( 'joomla.application.component.view' );



class mailreplyViewmailreply extends JViewLegacy

{

	function __construct( $config = array())

	{
		
		 parent::__construct( $config );

	}

	function display($tpl = null)
	{	

		
		$mainframe = JFactory::getApplication();
			 $context='';
		$detail= $this->get('Data');
		
		
		$document = JFactory::getDocument();
		$user =  clone(JFactory::getUser());
		$this->setLayout('default');
		//$limit		= JRequest::getVar('limit', 10, '', 'int');
	 	//$limitstart	= JRequest::getVar('limitstart', 0, '', 'int');
		//$total = $this->get('total');	 
		//jimport('joomla.html.pagination');
		//$this->pagination = new JPagination($total, $limitstart, $limit);
		
	/*	$prop_type[]   	= JHTML::_('select.option', '0',JText::_('SELECT_PROPERTY_TYPE'));
		$prop_type[]   	= JHTML::_('select.option', '1',JText::_('PRICE_LOW_HIGH'));
		$prop_type[]   	= JHTML::_('select.option', '2', JText::_('PRICE_HIGH_LOW'));
		$prop_type[]   	= JHTML::_('select.option', '3', JText::_('NEW_LISTING'));
		$prop_id	= JRequest::getVar('sort', '0','request','int'); // onchange="document.registerform.submit()
		$lists['sorting_list'] = JHTML::_('select.genericlist',$prop_type, 'sort','class="inputbox" size="1" onchange="search_listproperty(this.value);" ','value','text',$prop_id);
		
		$prop_id	= JRequest::getVar('sort', '0','request','int');*/
	/*	$lists['sorting_list1'] = JHTML::_('select.genericlist',$prop_type, 'sort1','class="inputbox" size="1" onchange="document.registerform.submit();" ','value','text',$prop_id);*/
		$document = JFactory::getDocument();
 
		$this->assignRef('lists',		$lists); 
		$this->assignRef('detail',		$detail); 
		$this->assignRef('userdata',$userdata);
		parent::display($tpl);

		

  }

}

 

?>

