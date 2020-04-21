<?php
/**
* @package   JE Ecard
* @copyright Copyright (C) 2009 - 2010 Open Source Matters. All rights reserved.
* @license   http://www.gnu.org/licenses/lgpl.html GNU/LGPL, see LICENSE.php
* Contact to : emailtohardik@gmail.com, joomextensions@gmail.com
* Visit : http://www.joomlaextensions.co.in/
**/ 

jimport('joomla.application.component.controller');

$l['hm']	= 'Home';
$l['ct']	= 'Category';
$l['et']	= 'Event';
$l['st']	= 'Event Style';
$l['co']	= 'Event Setting';
$l['ei']	= 'Event Invititations';

// Submenu view
$view	= JRequest::getVar( 'view', '', '', 'string', JREQUEST_ALLOWRAW );
if ($view == '' || $view == 'home') {
	JSubMenuHelper::addEntry(JText::_($l['hm']), 'index.php?option=com_jeecard&view=home', true);
	JSubMenuHelper::addEntry(JText::_($l['ct']), 'index.php?option=com_jeecard&view=category');
	JSubMenuHelper::addEntry(JText::_($l['et']), 'index.php?option=com_jeecard&view=event' );
	//JSubMenuHelper::addEntry(JText::_($l['st']), 'index.php?option=com_jeecard&view=eventstyle' );
	JSubMenuHelper::addEntry(JText::_($l['ei']), 'index.php?option=com_jeecard&view=eventinvite' );
	JSubMenuHelper::addEntry(JText::_($l['co']), 'index.php?option=com_jeecard&view=configration' );
}

if ($view == 'category') {
	JSubMenuHelper::addEntry(JText::_($l['hm']), 'index.php?option=com_jeecard&view=home');
	JSubMenuHelper::addEntry(JText::_($l['ct']), 'index.php?option=com_jeecard&view=category', true);
	JSubMenuHelper::addEntry(JText::_($l['et']), 'index.php?option=com_jeecard&view=event' );
	//JSubMenuHelper::addEntry(JText::_($l['st']), 'index.php?option=com_jeecard&view=eventstyle' );
	JSubMenuHelper::addEntry(JText::_($l['ei']), 'index.php?option=com_jeecard&view=eventinvite' );
	JSubMenuHelper::addEntry(JText::_($l['co']), 'index.php?option=com_jeecard&view=configration' );
}

if ($view == 'event') {
	JSubMenuHelper::addEntry(JText::_($l['hm']), 'index.php?option=com_jeecard&view=home');
	JSubMenuHelper::addEntry(JText::_($l['ct']), 'index.php?option=com_jeecard&view=category');
	JSubMenuHelper::addEntry(JText::_($l['et']), 'index.php?option=com_jeecard&view=event', true );
	//JSubMenuHelper::addEntry(JText::_($l['st']), 'index.php?option=com_jeecard&view=eventstyle' );
	JSubMenuHelper::addEntry(JText::_($l['ei']), 'index.php?option=com_jeecard&view=eventinvite' );
	JSubMenuHelper::addEntry(JText::_($l['co']), 'index.php?option=com_jeecard&view=configration' );
}

if ($view == 'eventinvite') {
	JSubMenuHelper::addEntry(JText::_($l['hm']), 'index.php?option=com_jeecard&view=home');
	JSubMenuHelper::addEntry(JText::_($l['ct']), 'index.php?option=com_jeecard&view=category');
	JSubMenuHelper::addEntry(JText::_($l['et']), 'index.php?option=com_jeecard&view=event');
	//JSubMenuHelper::addEntry(JText::_($l['st']), 'index.php?option=com_jeecard&view=eventstyle', true );
	JSubMenuHelper::addEntry(JText::_($l['ei']), 'index.php?option=com_jeecard&view=eventinvite', true );
	JSubMenuHelper::addEntry(JText::_($l['co']), 'index.php?option=com_jeecard&view=configration'  );
}
if ($view == 'configration') {
	JSubMenuHelper::addEntry(JText::_($l['hm']), 'index.php?option=com_jeecard&view=home');
	JSubMenuHelper::addEntry(JText::_($l['ct']), 'index.php?option=com_jeecard&view=category');
	JSubMenuHelper::addEntry(JText::_($l['et']), 'index.php?option=com_jeecard&view=event');
	//JSubMenuHelper::addEntry(JText::_($l['st']), 'index.php?option=com_jeecard&view=eventstyle' );
	JSubMenuHelper::addEntry(JText::_($l['ei']), 'index.php?option=com_jeecard&view=eventinvite' );
	JSubMenuHelper::addEntry(JText::_($l['co']), 'index.php?option=com_jeecard&view=configration', true  );
}

?>