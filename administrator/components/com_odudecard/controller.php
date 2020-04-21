<?php
 /**
 * @package ODude ECard
 * @author ODude.com
 * @copyright (C) 2014 ODude Network. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 **/

 
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.controller');

class odudecardsController extends JControllerLegacy
{
	function display($cachable = false, $urlparams = array())
	{
	JToolBarHelper::preferences( 'com_odudecard', '500' );
		parent::display();
		odudecardHelper::addSubmenu('messages');


	}
}
