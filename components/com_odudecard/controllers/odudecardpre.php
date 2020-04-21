<?php
 /**
 * @package ODude ECard
 * @author ODude.com
 * @copyright (C) 2014 ODude Network. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 **/

defined('_JEXEC') or die();


class odudecardControllerodudecardpre extends odudecardController
{
	function display($cachable = false, $urlparams = array())
	{
		$model = $this->getModel('odudecardpre');
		JRequest::setVar( 'view', 'odudecardpre' );
		JRequest::setVar( 'layout', 'odudecardpre'  );
		parent::display();
	}	
}
?>
