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

class event_configrationVIEWevent_configration extends JViewLegacy 
{
	function display($tpl = null)
	{		
		$document = JFactory::getDocument();
		$document->setTitle( JText::_('EVENT_DETAIL') );
		$uri 		= JFactory::getURI();
		$option = JRequest::getVar('option','','request','string');
		$url= $uri->root();
		$document->addScript($url.'components/'.$option.'/assets/color_picker/js/jquery.js');
		$document->addScript($url.'components/'.$option.'/assets/color_picker/js/colorpicker.js');
		$document->addScript($url.'components/'.$option.'/assets/color_picker/js/eye.js');
		$document->addScript($url.'components/'.$option.'/assets/color_picker/js/utils.js');
		$document->addScript($url.'components/'.$option.'/assets/color_picker/js/layout.js?ver=1.0.2');
		
		$document->addStyleSheet ($url.'components/'.$option.'/assets/colorpicker/css/colorpicker.css' ); 
		$document->addStyleSheet($url.'components/'.$option.'/assets/color_picker/css/colorpicker.css');
		$db = jFactory::getDBO();
		JToolBarHelper::title(   JText::_( 'EVENT_CONFIGRATION_DETAIL' ));
		$option = JRequest::getVar('option','','request','string');
		$document = JFactory::getDocument();
		$document->setTitle( JText::_('EVENT_CONFIGRATION_DETAIL') );
		$uri = JFactory::getURI();
		$this->setLayout('default');

		$lists = array();
		$detail	= $this->get('data'); 
		$isNew = ($detail->id < 1);
		$text = $isNew ? JText::_( 'NEW' ) : JText::_( 'EDIT' );
		
		JToolBarHelper::save();
		if ($isNew)  {
			JToolBarHelper::cancel();
		} else {
			JToolBarHelper::cancel( 'cancel', 'Close' );
		}
 		
		$gmap_op = array();
		$gmap_op[]   	= JHTML::_('select.option', '1',JText::_('Yes'));
		$gmap_op[]   	= JHTML::_('select.option', '0', JText::_('No'));
		$lists['gmap_display']	= JHTML::_('select.genericlist',$gmap_op,'gmap_display','class="inputbox"','value','text',$detail->gmap_display);
		
		$iscreate_op = array();
		$iscreate_op[]   	= JHTML::_('select.option', '1',JText::_('Yes'));
		$iscreate_op[]   	= JHTML::_('select.option', '0', JText::_('No'));
		$lists['iscreate']	= JHTML::_('select.genericlist',$iscreate_op,'iscreate','class="inputbox"','value','text',$detail->iscreate);
		
		$lists['title'] = $detail->title;
		$lists['head1'] = $detail->head1;
		$lists['head2'] = $detail->head2;
		$lists['head3'] = $detail->head3;
		$lists['head4'] = $detail->head4;
		
		$autopub_op = array();
		$autopub_op[]   	= JHTML::_('select.option', '1',JText::_('Yes'));
		$autopub_op[]   	= JHTML::_('select.option', '0', JText::_('No'));
		$lists['autopub']	= JHTML::_('select.genericlist',$autopub_op,'autopub','class="inputbox"','value','text',$detail->autopub);
		
		$show_rssop = array();
		$show_rssop[]   	= JHTML::_('select.option', '1',JText::_('Yes'));
		$show_rssop[]   	= JHTML::_('select.option', '0', JText::_('No'));
		$lists['show_rss']	= JHTML::_('select.genericlist',$show_rssop,'show_rss','class="inputbox"','value','text',$detail->show_rss); 
		
		$this->assignRef('lists',		$lists);
		$this->assignRef('detail',		$detail);
		

		parent::display($tpl);
	}
}
?>