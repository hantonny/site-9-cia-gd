<?php
/**
* @package   JE Ecard
* @copyright Copyright (C) 2009 - 2010 Open Source Matters. All rights reserved.
* @license   http://www.gnu.org/licenses/lgpl.html GNU/LGPL, see LICENSE.php
* Contact to : emailtohardik@gmail.com, joomextensions@gmail.com
* Visit : http://www.joomlaextensions.co.in/
**/ 

defined ('_JEXEC') or die ('Restricted access');
function jeecardBuildRoute(&$query)
{ 
	$segments = array();	 
	if(isset($query['view']))
	{
		$segments[] = $query['view'];
		
		if( (array_key_exists('event_id',$query)) && $query['view']=='events') {
			$name 	= jeecardGetcategoryname($query['event_id']);
			
			$segments[]		= $name;
			unset($query['event_id']);
		}
	
		unset($query['view']);
	}
	return $segments;
}

function jeecardParseRoute($segments)
{
	$vars = array();
	$count = count($segments);
	
	if(!empty($count)) {
		$vars['view'] = $segments[0];
	}
	
	if(!empty($segments[1]) && $vars['view']=='events') {
		$eventid = jeecardGetcategoryid($segments[1]);
		$vars['event_id'] = $eventid;
	}
	
	return $vars;
}

function jeecardGetcategoryname($eventid)
{
	$db	= JFactory::getDBO();
	$sql = "SELECT `name` FROM #__jeecard_event WHERE `eventid`=".$eventid;
	$db->setQuery($sql);
	$title = $db->loadResult();
	//echo $title;
	return $title;
}

function jeecardGetcategoryid($evenname)
{
	$db	= JFactory::getDBO();
	$sql = "SELECT `eventid` FROM #__jeecard_event WHERE `name`='".$evenname."' ";
	$db->setQuery($sql);
	$id = $db->loadResult();
	return $id;
}

function jeecardGetcontactname($contactid)
{
	$db	= JFactory::getDBO();
	$sql = "SELECT `contact_name ` FROM #__jeecard_contact WHERE `cid`=".$contactid;
	$db->setQuery($sql);
	$title = $db->loadResult();
	//echo $title;
	return $title;
}

function jeecardGetcontactid($contactname)
{
	$db	= JFactory::getDBO();
	$sql = "SELECT `cid` FROM #__jeecard_contact WHERE `contact_name `='".$contactname."' ";
	$db->setQuery($sql);
	$id = $db->loadResult();
	return $id;
}
?>