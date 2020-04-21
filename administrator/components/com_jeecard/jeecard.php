<?php
/**
* @package   JE Ecard
* @copyright Copyright (C) 2009 - 2010 Open Source Matters. All rights reserved.
* @license   http://www.gnu.org/licenses/lgpl.html GNU/LGPL, see LICENSE.php
* Contact to : emailtohardik@gmail.com, joomextensions@gmail.com
* Visit : http://www.joomlaextensions.co.in/
**/ 
    
	defined ('_JEXEC') or die ('Restricted access');
	
	//error_reporting(0); 
    $controller = JRequest::getVar('view','category' );
    $task = JRequest::getVar('task','' );
		if($controller=="about")
	{
	JToolBarHelper::title(   JText::_( 'About us' ) ); 
	require_once (JPATH_COMPONENT.'/'.'readme.html');
	require_once (JPATH_COMPONENT.'/'.'controller.php');
	}
	else {
    require_once (JPATH_COMPONENT.'/'.'controller.php');
    require_once (JPATH_COMPONENT.'/'.'controllers'.'/'.$controller.'.php');
	//require_once(JPATH_COMPONENT.'/'."helpers/extra_field.php");
	require_once(JPATH_COMPONENT.'/'."helpers/Thumbnail.php");
    $classname  = $controller.'controller';

    $controller = new $classname( array('default_task' => 'display') );

    $controller->execute( JRequest::getVar('task' ));
	    
    $controller->redirect();
    }
?>