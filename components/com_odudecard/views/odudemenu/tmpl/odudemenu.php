<?php
 /**
 * @package ODude ECARD
 * @author ODude.com
 * @copyright (C) 2014 ODude Network. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 **/

defined( '_JEXEC' ) or die( 'Restricted access' );

if(!defined('DS')){
   define('DS',DIRECTORY_SEPARATOR);
}
////jimport('joomla.html.parameter');
 //JHtmlBootstrap::loadCss();
$mainframe = JFactory::getApplication();
$document = JFactory::getDocument();
$doc =JFactory::getDocument();
$doc->setMetaData( 'generator', 'ODude.com Ecard' );
 $params = $mainframe->getParams();
$mymenuitem = JRequest::getVar('Itemid', 0, 'request', 'int');
$pickcat = $params->def('pickcat', '');

$list = $params->def('list', '');
$layout="card_".$this->a2;
if($this->a2=='default')
$layout="card_show";


$media_alias=$params->def('pickcat', '');
$media_id= getSpecificId($media_alias,'media');
$cat_alias=getCard($media_id)['cate_alias'];

if($pickcat=='')
{
	
echo "Select Category";

}	
else
{
	$mymenuitem = $params->def('mymenuitem', '');
$link='index.php?option=com_odudecard&id='.$media_alias.'&controller='.$layout.'&Itemid='.$mymenuitem.'&cate='.$cat_alias;
 ob_start();
header("Location: ".JRoute::_($link));
ob_flush();
//echo JRoute::_($link);
}
?>

