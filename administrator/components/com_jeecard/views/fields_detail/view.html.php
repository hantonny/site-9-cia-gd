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

class fields_detailVIEWfields_detail extends JViewLegacy  {
	
	function display($tpl = null) 	{
		
		$option = JRequest::getVar('option','','request','string');
		JToolBarHelper::title(   JText::_( 'FIELDS_MANAGEMENT_DETAIL' ), 'generic.png' );
		$document = JFactory::getDocument();
		//============ Below js is used for selected field display when select field type=================
		$document->addScript ('components/'.$option.'/assets/js/fields.js');
		//================================================================================================
		
		$option = JRequest::getVar('option','','request','string');
		$uri 		= JFactory::getURI();
		$url= $uri->root();
		$document->addScript($url.'components/'.$option.'/assets/color_picker/js/jquery.js');
		$document->addScript($url.'components/'.$option.'/assets/color_picker/js/colorpicker.js');
		$document->addScript($url.'components/'.$option.'/assets/color_picker/js/eye.js');
		$document->addScript($url.'components/'.$option.'/assets/color_picker/js/utils.js');
		$document->addScript($url.'components/'.$option.'/assets/color_picker/js/layout.js?ver=1.0.2');
		
		$document->addStyleSheet ($url.'components/'.$option.'/assets/colorpicker/css/colorpicker.css' ); 
		$document->addStyleSheet($url.'components/'.$option.'/assets/color_picker/css/colorpicker.css');
		
		$uri 		= JFactory::getURI();
		$this->setLayout('default');
		$lists = array();

		$detail	= $this->get('data');
		$model = $this->getModel ( 'fields_detail' );
		$filed_data	= $model->field_data();
		$isNew		= ($detail->field_id < 1);
		$text = $isNew ? JText::_( 'NEW' ) : JText::_( 'EDIT' );
		
		JToolBarHelper::title(   JText::_( 'FIELDS' ).': <small><small>[ ' . $text.' ]</small></small>' );
		
		JToolBarHelper::apply();
		JToolBarHelper::save();
		
		if ($isNew)  {
			JToolBarHelper::cancel();
		} else {
			JToolBarHelper::cancel( 'cancel', 'Close' );
		}
		$optiontype = array();
		$optiontype[]   = JHTML::_('select.option', '0"selected"',JText::_('SELECT'));
		$optiontype[]   = JHTML::_('select.option', '1 ', JText::_('TEXT_FIELD'));
		$optiontype[]   = JHTML::_('select.option', '2', JText::_('TEXT_AREA'));
		$optiontype[]   = JHTML::_('select.option', '3', JText::_('CHECK_BOX'));
		$optiontype[]   = JHTML::_('select.option', '4', JText::_('RADIO_BUTTON'));
		$optiontype[]   = JHTML::_('select.option', '5', JText::_('SELECT_BOX_SINGLE_SELECT'));
		$optiontype[]   = JHTML::_('select.option', '6', JText::_('SELECT_BOX_MULTIPLE_SELECT'));
		$optiontype[]   = JHTML::_('select.option', '7', JText::_('SELECT_COUNTRY_BOX'));
		$optiontype[]   = JHTML::_('select.option', '9', JText::_('FILE'));
		$optiontype[]   = JHTML::_('select.option', '8', JText::_('WYSIWYG'));
		$optiontype[]   = JHTML::_('select.option', '10', JText::_('HR_TAG'));
		$optiontype[]   = JHTML::_('select.option', '11', JText::_('LABEL'));
		$optiontype[]   = JHTML::_('select.option', '12', JText::_('DATE'));
		$optiontype[]   = JHTML::_('select.option', '13', JText::_('PASSWORD'));
		
		$lists['type'] = JHTML::_('select.genericlist',$optiontype,  'field_type', 'class="inputbox" size="1" onchange="field_select(this.value)" ', 'value', 'text',  $detail->field_type );
		
		
		
		$op_publish[] = JHtml::_('select.option', '0', JText::sprintf('No'));
		$op_publish[] = JHtml::_('select.option', '1', JText::sprintf('Yes')); 
		
		$lists['published'] 	= JHTML::_('select.genericlist',$op_publish,  'published', 'class="inputtext" ', 'value', 'text', $detail->published );
		
		
		$op_showfront[] = JHtml::_('select.option', '0', JText::sprintf('No'));
		$op_showfront[] = JHtml::_('select.option', '1', JText::sprintf('Yes')); 
		
		$lists['show_in_front'] 	= JHTML::_('select.genericlist',$op_showfront,  'field_show_in_front', 'class="inputtext" ', 'value', 'text', $detail->field_show_in_front );
		
		
		$op_required[] = JHtml::_('select.option', '0', JText::sprintf('No'));
		$op_required[] = JHtml::_('select.option', '1', JText::sprintf('Yes')); 
		
		$lists['is_required'] 	= JHTML::_('select.genericlist',$op_required,  'is_required', 'class="inputtext" ', 'value', 'text', $detail->is_required );
		
		
		
		$formdata	= $this->get('formdata');
		$sel_formdata = array();
		$sel_formdata[0]->value="0";
		$sel_formdata[0]->text=JText::_('SELECT_FORM');
		$formdata=@array_merge($sel_formdata,$formdata);
	
		$lists['formdata']	=	JHTML::_('select.genericlist',$formdata,  'field_section', 'class="inputbox" size="1" ', 'value', 'text',  $detail->field_section );
		
		$filed_data;
		$lists['extra_data']=$filed_data;
		
		$this->assignRef('lists',		$lists);
		$this->assignRef('detail',		$detail);
		

		parent::display($tpl);
	}
	
}

?>
