<?php
 /**
 * @package ODude ECARD
 * @author ODude.com
 * @copyright (C) 2014 ODude Network. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 **/

 
 
 //Don't edit this file. It is restricted to use and will violet our terms and condition. You many not able to install ODude Ecard on this system again.
 
 
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
$doc->setMetaData( 'keywords', $this->keyword );
 $params = $mainframe->getParams();
$mymenuitem = JRequest::getVar('Itemid', 0, 'request', 'int');
$pickcat = $params->def('pickcat', '');
$list = $params->def('list', '');

if($pickcat=='')
{
	
require_once ( JPATH_BASE .DS.'components'.DS.'com_odudecard'.DS.'include'.DS.'ecardThumb.php' );	

require_once ( JPATH_BASE .DS.'components'.DS.'com_odudecard'.DS.'include'.DS.'lib.php' );
//JHTML::_('behavior.framework');
//JHTML::_('behavior.modal');



$q_cate = JRequest::getVar('cate', '0');
$category=getSpecificId($q_cate,'cate');
$opt = JRequest::getVar('opt', 'all', 'request');


$params  = JComponentHelper::getParams('com_odudecard');
$show_create = $params->get('show_create');
$pathway = $mainframe->getPathway();
$catid=getCategoryDetail($category)->subcat;
if($catid!=0)
$pathway->addItem(getCategoryDetail($catid)->name,"index.php?option=com_odudecard&controller=card_list&Itemid=".$mymenuitem."&cate=".$catid);

$pathway->addItem($this->cate_name,"index.php?option=com_odudecard&controller=card_list&Itemid=".$mymenuitem."&cate=".$category);
//$pathway->addItem('',"#");
$temp=$this->a2;
$doc->addStyleSheet('components/com_odudecard/template/'.$temp.'/'.$temp.'.css');
$doc->addStyleSheet('components/com_odudecard/template/pure-min.css');
$doc->addStyleSheet('components/com_odudecard/template/grids-responsive-min.css');
?>
<style type="text/css">
.box {
	background-image: url(<?php echo JURI::root() ?>media/ecard/<?php echo $this->cate_bg ?>);
	border: 1px solid #BBDDFF;
	width:100%;
}

</style>

<?php 


	include ( JPATH_BASE .DS.'components'.DS.'com_odudecard'.DS.'template'.DS.$temp.DS.$temp.'.top.tpl.php' );


  $doc = JFactory::getDocument();
  $doc->setTitle($this->cate_name);
?>
<input type="hidden" name="imp" value="<?php echo imp(); ?>">
<div class='box'>
  <div class='bar' align="center"><b><?php echo $this->cate_name ?></b></div>

<?php 
//echo $this->listCard;

$q_cate = JRequest::getVar('cate', '0');
$category=getSpecificId($q_cate,'cate');


$pager=JRequest::getVar('pager', 'x');
if($pager=='x')
$pager=0;
else
$pager=($pager-1)*$this->rowsPerPage;
		

     if($opt=='pro')
	 {
	 $listcard ="select * from #__ecard_media where cat='$category' and published=1 and point!=0 order by ordering asc limit $pager,".$this->rowsPerPage;
     }
     else
     {
		$listcard ="select * from #__ecard_media where cat='$category' and published=1 order by ordering asc limit $pager,".$this->rowsPerPage;
	}
	
	
		$db = JFactory::getDBO();
		$db->setQuery( $listcard );
        $rows = $db->loadObjectList();
	
	  if($this->cardPerRow!='1')
		  
	  $cssperrow="pure-u-1 pure-u-md-1-".$this->cardPerRow;
	  else
	  $cssperrow="pure-u-1 pure-u-md-1-3";
		
		echo "<div class=\"odude_list_gallery\">";
		echo "<div class=\"pure-g\">";
		for( $i=0; $i<count($rows); $i++ )
			{
				$row = $rows[$i];
				echo "<div class=\"$cssperrow\">";
				echo "<div class=\"odude_list_item\">";
				include ( JPATH_BASE .DS.'components'.DS.'com_odudecard'.DS.'template'.DS.$temp.DS.$temp.'.list.tpl.php' );
				echo "</div>";
				echo "</div>";
			}
		echo "</div>";
		echo "</div>";							
?>
</div>
<br />

<?php 
include ( JPATH_BASE .DS.'components'.DS.'com_odudecard'.DS.'template'.DS.$temp.DS.$temp.'.post.tpl.php' );
echo $this->pagination;
								
?><br />
       <center>
         <!-- odude_ecard_footer --> 
         <?php
        
        $zone = "odude_footer";
        $modules =& JModuleHelper::getModules($zone);
        $i=0;
        foreach ($modules as $module)
        {
              echo "<div id=\"roundme\" class=\"odude_round_corner\"><div class=\"odude_form_heading\">";
        echo "<h3>".$modules[$i]->title."</h3>";
        
              echo JModuleHelper::renderModule($module);
              echo "</div></div><br />";
              $i++;
        }
       
       
       
       ?>
       </center>  
	 
<?php

//Don't ever try to modify this page in any way. This may delete some of the files so that ODude Ecard can't be installed again.
if(imp()=='6128')
{
	 if($this->display=='1')
 {
	 //Don't Touch
	 
	 echo "<a href='http://www.odude.com' target='_blank'>".JText::_('COM_ODUDECARD_POWERED')."- ODude.com</a>";
 }
 else
 {
			if($this->pro=='N' && $this->display=='1')
		  echo "<a href='http://www.odude.com' target='_blank'>".JText::_('COM_ODUDECARD_POWERED').":- ODude.com</a>";
 }
	
 }
else
{
	//Don't Touch this file.
	echo "<a href='http://www.odude.com' target='_blank'>".JText::_('COM_ODUDECARD_POWERED').": ODude.com</a>";
} 


//$listcard="SELECT * FROM `#__ecard_cate` WHERE `subcat` =$category and front='Y' ";
$listcard="SELECT * FROM `#__ecard_cate` WHERE `subcat` =$category  order by ordering asc";
$db = JFactory::getDBO();
		  $db->setQuery( $listcard );
      $rows = $db->loadObjectList();
      for( $i=0; $i<count($rows); $i++ )
                  		{
                  				 echo cateMedia($rows[$i]->cat)."<br /><br />";
                  		}



}	
else
{
	$mymenuitem = $params->def('mymenuitem', '');
$link="index.php?option=com_odudecard&controller=card_list&Itemid=".$mymenuitem."&cate=".$pickcat."&opt=".$list;
     ob_start();
header("Location: ".JRoute::_($link));
ob_flush();
//echo $link;
}
?>

