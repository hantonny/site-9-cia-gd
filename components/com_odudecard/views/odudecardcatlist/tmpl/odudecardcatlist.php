<?php
 /**
 * @package ODude ECard
 * @author ODude.com
 * @copyright (C) 2014 ODude Network. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 **/

defined('_JEXEC') or die('Restricted access');

$mainframe = JFactory::getApplication();

$doc = JFactory::getDocument();
$doc->setMetaData( 'generator', 'ODude.com Ecard' );

require_once ( JPATH_BASE .DS.'components'.DS.'com_odudecard'.DS.'include'.DS.'lib.php' );
$setting=getSetting();	

		//$q_cate = JRequest::getVar('cate', '0');
		//$category=getSpecificId($q_cate,'cate');
$mymenuitem = JRequest::getVar('Itemid', 0, 'request', 'int');

$component = JComponentHelper::getComponent( 'com_odudecard' );

$temp=$setting->a2;
$doc->addStyleSheet('components/com_odudecard/template/'.$temp.'/'.$temp.'.css');
$doc->addStyleSheet('components/com_odudecard/template/pure-min.css');
$doc->addStyleSheet('components/com_odudecard/template/grids-responsive-min.css');
?>
<style type="text/css">
.box {
	border: 1px solid #BBDDFF;
	width:100%;
}

</style>

<?php
$listcard="SELECT * FROM `#__ecard_cate` WHERE `subcat`=0 order by ordering asc";
$db = JFactory::getDBO();
		  $db->setQuery( $listcard );
      $rows = $db->loadObjectList();
      for( $i=0; $i<count($rows); $i++ )
                  		{
                  				 echo cateMedia($rows[$i]->cat)."<br />&nbsp;";
                  		}


?> 
