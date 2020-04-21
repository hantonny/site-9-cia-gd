<?php
 /**
 * @package ODude ECard
 * @author ODude.com
 * @copyright (C) 2014 ODude Network. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 **/

jimport( 'joomla.application.component.view');


class odudecardViewodudecardlist extends JViewLegacy
{
	function display($tpl = null)
	{
		require_once ( JPATH_BASE .DS.'components'.DS.'com_odudecard'.DS.'include'.DS.'lib.php' );	  
		$setting=getSetting();	  
		$mymenuitem = JRequest::getVar('Itemid', 0, 'request', 'int');	
$opt = JRequest::getVar('opt', 'all', 'request');	

$q_cate = JRequest::getVar('cate', '0');
			$category=getSpecificId($q_cate,'cate'); 
			
		$model = $this->getModel();
    //$rows = $model->getGreeting();
    //$setting = $model->getSetting();
		$cate_detail = $model->getCategory();
			
	  $cardPerRow=$setting->card_row;
    $cardPerPage=$setting->card_page;	
	
	  $rowsPerPage=$cardPerPage;	
		
		if($opt=='pro')
	 {
	 $listcard ="select * from #__ecard_media where cat='$category' and published=1 and point!=0 order by ordering asc";
     }
     else
     {
		$listcard ="select * from #__ecard_media where cat='$category' and published=1 order by ordering asc";
	}
	$db = JFactory::getDBO();
		$db->setQuery( $listcard );
        $rows = $db->loadObjectList();
				
		$maxPage=30;
		$q_cate = JRequest::getVar('cate', '0');
		//$category=getSpecificId($q_cate,'cate');
		$linku="option=com_odudecard&controller=card_list&Itemid=$mymenuitem&cate=$q_cate&opt=$opt";
		
		$pager=JRequest::getVar('pager', 'x');
		if($pager=='x')
		$pager=0;
		else
		$pager=($pager-1)*$rowsPerPage;
		
		$pagex=JRequest::getVar('pager', 'x');
		if($pagex=='x')
		$pageNum=1;
		else
		$pageNum=$pagex;
		
		$numrows=count($rows);
		
		//$listcard ="select * from #__ecard_media where cat='$category' and published=1 order by ordering,ddate desc limit $pager,$rowsPerPage";

		//$db = JFactory::getDBO();
		//$db->setQuery( $listcard );
       // $rows = $db->loadObjectList();
		
		$pagination = $model->pager($rowsPerPage,$maxPage,$numrows,$linku);

		$this->assignRef( 'pagination',  $pagination );
		
	
        $this->assignRef( 'cate_name',  $cate_detail[0]->name );
		  $this->assignRef( 'cate_banner',  $cate_detail[0]->banner );
		    $this->assignRef( 'cate_bg',  $cate_detail[0]->bg );
		    $this->assignRef( 'keyword',  $cate_detail[0]->keyword );
			
		$this->assignRef( 'cardPerRow',  $setting->card_row );
		$this->assignRef( 'a2',  $setting->a2);
		$this->assignRef( 'rowsPerPage',  $rowsPerPage );
		$pro='Y';
		$free='N';
		
		
		if($setting->captcha==1 || $setting->point==1 || $setting->import==1 || $setting->add_rec==1 || $setting->width!=0 || $setting->tubewidth!=0 || $setting->videowidth!=0)
		{
			$this->assignRef( 'pro',  $pro );
		}
		else
		{
			$this->assignRef( 'pro',  $free );
		}
			$this->assignRef( 'display',  $setting->version );
	//echo "$setting->captcha - $setting->point - $setting->import - $setting->add_rec - $setting->width - $setting->tubewidth - $setting->videowidth ";
	//print_r($setting);
	//echo $this->pro;
			  
		parent::display($tpl);
	}
}
?>
                                                                                                
