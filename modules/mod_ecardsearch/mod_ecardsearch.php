<?php 
/**
* @package   JE EcardSearch
* @copyright Copyright (C) 2009 - 2010 Open Source Matters. All rights reserved.
* @license   http://www.gnu.org/licenses/lgpl.html GNU/LGPL, see LICENSE.php
* Contact to : emailtohardik@gmail.com, joomextensions@gmail.com
**/
// no direct access

defined('_JEXEC') or die('Restricted access');
require_once (dirname(__FILE__).'/'.'helper.php');
$lists = mod_ecardsearchHelper::getTour_list($params, $access);
$items = count($lists);
if (!$items) {
	return;
}
$layout = $params->get('layout','default');
//$layout = JFilterInput::clean($layout, 'word');
$path = JModuleHelper::getLayoutPath('mod_ecardsearch', $layout);
if (file_exists($path)) {
	require($path);
}
