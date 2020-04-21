<?php
/**
* @package   JE Ecard
* @copyright Copyright (C) 2009 - 2010 Open Source Matters. All rights reserved.
* @license   http://www.gnu.org/licenses/lgpl.html GNU/LGPL, see LICENSE.php
* Contact to : emailtohardik@gmail.com, joomextensions@gmail.com
* Visit : http://www.joomlaextensions.co.in/
**/

defined ('_JEXEC') or die ('Restricted access');
$option = JRequest::getVar('option','','request','string');
$task = JRequest::getVar('task','','request','string');
$controller = JRequest::getVar('view','event','','string' );
$userviews = array('event_list','fetch_group','group','group_detail','fetch_contact','contact','contact_detail','contactlist','events','register','mailreply');

if(in_array ($controller,$userviews))
{
	//echo JPATH_COMPONENT.'/'."helpers/kcaptcha/kcaptcha.php";
	require_once (JPATH_COMPONENT.'/'.'controllers'.'/'.$controller.'.php');
	require_once(JPATH_COMPONENT.'/'."helpers/thumbnail.php");
	require_once(JPATH_COMPONENT.'/'."helpers/kcaptcha/kcaptcha.php");
	$classname  = $controller.'controller';
	$controller = new $classname( array('default_task' => 'display') );
	$controller->execute( JRequest::getVar('task','','request','string'));
	$controller->redirect();
}
else
{
	$mainframe = JFactory::getApplication();
	$Itemid = JRequest::getVar('Itemid','','request','int');
	$option = JRequest::getVar('option','','request','string');
	$mainframe->redirect ( 'index.php?option=' . $option . '&view=event&Itemid='.$Itemid);
}
?>