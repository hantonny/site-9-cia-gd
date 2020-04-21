<?php
 /**
 * @package ODude ECard
 * @author ODude.com
 * @copyright (C) 2014 ODude Network. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 **/

 
defined( '_JEXEC' ) or die( 'Restricted access' );
if(!defined('DS')){
    define('DS',DIRECTORY_SEPARATOR);
}

require_once( JPATH_COMPONENT.DS.'controller.php' );

if($controller = JRequest::getWord('controller')) {
	$path = JPATH_COMPONENT.DS.'controllers'.DS.$controller.'.php';
	if (file_exists($path)) {
		require_once $path;
	} else {
		$controller = '';
	}
}
// require helper file
JLoader::register('odudecardHelper', dirname(__FILE__) . DS . 'helpers' . DS . 'odudecard.php');

$classname	= 'odudecardsController'.$controller;
$controller	= new $classname( );

$controller->execute( JRequest::getVar( 'task' ) );

$controller->redirect();
