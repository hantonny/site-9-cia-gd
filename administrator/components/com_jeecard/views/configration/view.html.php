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

class  configrationViewconfigration extends JViewLegacy 
{
	function display($tpl = null)
	{		
		$document = JFactory::getDocument();
		$document->setTitle( JText::_('CONFIGRATION') );
		$uri 		= JFactory::getURI();
		$option = JRequest::getVar('option','','request','string');
		
		JToolBarHelper::title(   JText::_( 'CONFIGRATION' ));
		$document->setTitle( JText::_('CONFIGRATION') );
		
		$this->setLayout('default');
		$detail	= $this->get('data'); 
		$isNew = ($detail->id < 1);
			$text = $isNew ? JText::_( 'NEW' ) : JText::_( 'EDIT' );
		
		JToolBarHelper::save();
		
		if ($isNew)  {
			JToolBarHelper::cancel();
		} else {
		
			JToolBarHelper::cancel( 'cancel', 'Close' );
		}
		
		$lists = array();
		$cat	= $this->get('category');
		$mysel_cat	= @explode(',',$detail->cat_id);
		$lists['cat_id']	= JHTML::_('select.genericlist',$cat,  'cat_id[]', 'class="inputtext" multiple="multiple" size="5"   ', 'value', 'text',$mysel_cat );

		
		$this->assignRef('lists',		$lists);
		$this->assignRef('detail',		$detail);
		

		parent::display($tpl);
	}
}
?>