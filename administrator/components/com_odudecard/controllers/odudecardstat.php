<?php

// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

class odudecardsControllerodudecardstat extends odudecardsController
{
		function display($cachable = false, $urlparams = array())
	{
		
		JRequest::setVar( 'view', 'odudecardstat' );
		JRequest::setVar( 'layout', 'stat'  );
		JRequest::setVar('hidemainmenu', 0);
		parent::display();
	}
	

}