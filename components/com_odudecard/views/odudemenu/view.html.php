<?php
 /**
 * @package ODude ECard
 * @author ODude.com
 * @copyright (C) 2014 ODude Network. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 **/

jimport( 'joomla.application.component.view');


class odudecardViewodudemenu extends JViewLegacy
{
	function display($tpl = null)
	{
		require_once ( JPATH_BASE .DS.'components'.DS.'com_odudecard'.DS.'include'.DS.'lib.php' );	  
		$setting=getSetting();	  
		
		
		$this->assignRef( 'a2',  $setting->a2);
				  
		parent::display($tpl);
	}
}
?>
                                                                                                
