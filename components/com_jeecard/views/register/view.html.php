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



class registerViewregister extends JViewLegacy

{

	function __construct( $config = array())

	{

		 parent::__construct( $config );

	}

	function display($tpl = null)

	{	

		$mainframe = JFactory::getApplication();
		$context='';
		$state= $this->get('state');
		$detail= $this->get('Data');
		 $err = JRequest::getVar('err','','','int');
		 
		//print_r ($detail);
		 $country = $this->get('country');
		 $document = JFactory::getDocument();
		$user =  clone(JFactory::getUser());
		$this->setLayout('default');
		//print_r($default);exit;
		$lists = array();
		$year = array();
		$month = array();
		
		for($i=1970;$i<2012;$i++)
		{
			$year[]   = JHTML::_('select.option', $i,$i);
		}
				$lists['year']= JHTML::_('select.genericlist',$year,  'year','class="f_input" style="width:70px"', 'value', 'text',2011);
				$month[] = JHtml::_('select.option', '1', JText::sprintf('January'));
				$month[] = JHtml::_('select.option', '2', JText::sprintf('February'));
				$month[] = JHtml::_('select.option', '3', JText::sprintf('March')); 
				$month[] = JHtml::_('select.option', '4', JText::sprintf('April'));
				$month[] = JHtml::_('select.option', '5', JText::sprintf('May'));
				$month[] = JHtml::_('select.option', '6', JText::sprintf('June')); 
				$month[] = JHtml::_('select.option', '7', JText::sprintf('July'));
				$month[] = JHtml::_('select.option', '8', JText::sprintf('August'));
				$month[] = JHtml::_('select.option', '9', JText::sprintf('September')); 
				$month[] = JHtml::_('select.option', '10', JText::sprintf('October'));
				$month[] = JHtml::_('select.option', '11', JText::sprintf('November'));
				$month[] = JHtml::_('select.option', '12', JText::sprintf('December')); 
				$lists['month']= JHTML::_('select.genericlist',$month,  'month','class="f_input" style="width:90px"', 'value','text');


		for($i=1;$i<32;$i++)
		{
			$day[]   = JHTML::_('select.option', $i,$i);
		}
		$lists['day']= JHTML::_('select.genericlist',$day,  'day', 'class="f_input"', 'value', 'text',1);
				
		
		$userdata		= $this->get( 'userdetail');

		$document = JFactory::getDocument();

		if($userdata){

		$country_select = $userdata->country_id;

		}else{

		$country_select = 0;

		}
		// $country_id = JRequest::getVar('country_id','','','int');
		//combo for country
		/*	$tempc = array();
			$tempc[0]->value="";
			$tempc[0]->text=JText::_('SELECT_COUNTRY');
			$country=@array_merge($tempc,$country);
    		$lists['country'] = JHTML::_('select.genericlist',$country,'country_id','class="required" size="1" onchange="choose_restate(this.value)" style="width:206px;"  ','value','text',$detail->country_id);*/

		    $optiontype = array();
	    	$optiontype[] = JHtml::_('select.option', '', JText::sprintf('SELECT_ONE'));
			$optiontype[] = JHtml::_('select.option', '0', JText::sprintf('MALE'));
			$optiontype[] = JHtml::_('select.option', '1', JText::sprintf('FEMALE')); 
			$lists['sex'] 		= JHTML::_('select.genericlist',$optiontype, 'sex', 'class="" style="width:206px; size="1" ', 'value', 'text',$detail->sex);

			$this->assignRef('lists',		$lists); 
			$this->assignRef('detail',		$detail); 
			$this->assignRef('userdata',$userdata);
			parent::display($tpl);

		

  }

}

 

?>

