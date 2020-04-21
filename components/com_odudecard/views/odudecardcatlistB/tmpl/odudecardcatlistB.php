<?php
 /**
 * @package ODude ECard
 * @author ODude.com
 * @copyright (C) 2014 ODude Network. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 **/

defined('_JEXEC') or die('Restricted access');
jimport('joomla.html.parameter');
$mainframe = JFactory::getApplication();
$document = JFactory::getDocument();
$doc = JFactory::getDocument();
$doc->setMetaData( 'generator', 'ODude.com Ecard' );
//JHTML::stylesheet('default.css', 'components/com_odudecard/include/');
require_once ( JPATH_BASE .DS.'components'.DS.'com_odudecard'.DS.'include'.DS.'lib.php' );
$setting=getSetting();	
$temp=$setting->a2;
$doc->addStyleSheet('components/com_odudecard/template/'.$temp.'/'.$temp.'.css');
$doc->addStyleSheet('components/com_odudecard/template/pure-min.css');
$doc->addStyleSheet('components/com_odudecard/template/grids-responsive-min.css');


$mymenuitem = JRequest::getVar('Itemid', 0, 'request', 'int');

$component = JComponentHelper::getComponent( 'com_odudecard' );



?>
<style type="text/css">
.box {
	border: 1px solid #BBDDFF;
	width:100%;
}

</style>

<?php

$listcard="SELECT * FROM `#__ecard_cate` WHERE `subcat`=0  order by ordering asc";
$db = JFactory::getDBO();
		  $db->setQuery( $listcard );
      $rows = $db->loadObjectList();
      for( $i=0; $i<count($rows); $i++ )
                  		{
								 $cate_detail = getCategoryDetail($rows[$i]->cat);
								 $cate_banner=$cate_detail->banner;
								 $cate_name=$cate_detail->name;
								 $cate_bg=$cate_detail->bg;
								 
                  				 echo "<div class=box style=\"text-align:center;\"><div class=bar style=\"text-align:center;\">".$cate_name."</div>";
								$url=JRoute::_('index.php?option=com_odudecard&controller=card_list&Itemid='.$mymenuitem.'&cate='.$rows[$i]->cat);
								echo "<a href=".$url.">";
								 if($cate_banner!="")
								echo "<img src=\"".JURI::base()."media/ecard/".$cate_banner."\" alt=\"".$cate_name."\"  />";
								else
								echo "<h3>".$cate_name."</h3>";
																
								echo "</a></div><br><br>";

								 
								 //echo cateMedia($rows[$i]->cat)."<br /><br />";
                  		}


?>
