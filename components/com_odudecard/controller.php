<?php
 /**
 * @package ODude ECard
 * @author ODude.com
 * @copyright (C) 2014 ODude Network. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 **/

defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.controller');

class odudecardController extends JControllerLegacy
{
/*
	function display()
	{
		parent::display();
	}
*/

 function display($cachable = false, $urlparams = array())
		{
		$modelName=JRequest::getVar( 'view'  );
			parent::display($cachable = false, $urlparams = false);
		}
}