<?php
 /**
 * @package ODude ECard
 * @author ODude.com
 * @copyright (C) 2014 ODude Network. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 **/

 
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view' );

class odudecardsViewodudecardstat extends JViewLegacy
{
	function display($tpl = null)
	{
		JToolBarHelper::title(   JText::_( 'E-Card Stats' ), 'generic.png' );
		JToolBarHelper::cancel( 'cancel', 'Close' );

		$items		=  $this->get( 'Data');

		$this->assignRef('items',		$items);

		parent::display($tpl);
	}
}