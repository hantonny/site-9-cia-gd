<?php

// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

class odudecardsControllerimport extends odudecardsController
{
		function display($cachable = false, $urlparams = array())
	{
		
		JRequest::setVar( 'view', 'import' );
		JRequest::setVar( 'layout', 'import'  );
		JRequest::setVar('hidemainmenu', 0);
		parent::display();
	}
	

}