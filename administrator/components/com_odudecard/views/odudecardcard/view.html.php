<?php
 /**
 * @package ODude ECard
 * @author ODude.com
 * @copyright (C) 2014 ODude Network. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 **/

 
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view' );

class odudecardsViewodudecardcard extends JViewLegacy
{
	function display($tpl = null)
	{
		
		
		
		JToolBarHelper::title(   JText::_( 'E-Card Management' ), 'generic.png' );
		JToolBarHelper::deleteList();
		
		if(version_compare(JVERSION, '3.0', 'ge'))
		{
	
		//JToolBarHelper::editList();
		JToolBarHelper::addNew();
		} 
		else 
		{
	
		//JToolBarHelper::editListX();
		JToolBarHelper::addNewX();
		}
		
		

		$items		=  $this->get( 'Data');

		$this->assignRef('items',		$items);
		
        $items = $this->get('Data');      
        $pagination = $this->get('Pagination');
 
        $this->assignRef('items', $items);     
        $this->assignRef('pagination', $pagination);



		parent::display($tpl);
	}
}