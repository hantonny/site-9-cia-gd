<?php
 /**
 * @package ODude ECard
 * @author ODude.com
 * @copyright (C) 2014 ODude Network. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 **/

jimport( 'joomla.application.component.view');


class odudecardViewodudecardmylist extends JViewLegacy
{
	function display($tpl = null)
	{
		require_once ( JPATH_BASE .DS.'components'.DS.'com_odudecard'.DS.'include'.DS.'lib.php' );	  
		$setting=getSetting();	  
		 $q_id = JRequest::getVar('id', '0');
		$id=getSpecificId($q_id,'media');
      $delete = JRequest::getVar('delete','0', 'request', 'string');
      	$user = JFactory::getUser();
	     $uid = JRequest::getVar('id','0', 'request', 'string');
      if($delete!='0')
      {
        if($user->username==$uid)
        JError::raiseNotice( 100, remove($delete) );
        // echo remove($delete);
      }
      	  
		$model = $this->getModel();
    $rows = $model->getGreeting();
    //$setting = $model->getSetting();
		//$cate_detail = $model->getCategory();
			
	  $cardPerRow=$setting->card_row;
    $cardPerPage=$setting->card_page;	
	
	  $rowsPerPage=$cardPerPage;	
		
		
		$maxPage=30;
		
		$q_cate = JRequest::getVar('cate', '0');
		$category=getSpecificId($q_cate,'cate');
		
		$linku="option=com_odudecard&controller=cardmylist&id=$id";
		
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

 if($user->name)
  {
  	
  if($uid=='0')
  {
     ob_start();
header("Location: ".JRoute::_('index.php?option=com_odudecard&controller=cardmylist&id='.$user->username));
ob_flush();
   $iid=$user->username;
   
  }
  else
  {
  $iid=$uid;
  }
		$listcard ="select * from #__ecard_media where username='$iid' order by ddate desc limit $pager,$rowsPerPage";

		$db = JFactory::getDBO();
		$db->setQuery( $listcard );
    $rows = $db->loadObjectList();
		
		$pagination = $model->pager($rowsPerPage,$maxPage,$numrows,$linku);

		$this->assignRef( 'pagination',  $pagination );
		
	
     //   $this->assignRef( 'cate_name',  $cate_detail[0]->name );
		 // $this->assignRef( 'cate_banner',  $cate_detail[0]->banner );
		 //   $this->assignRef( 'cate_bg',  $cate_detail[0]->bg );
		    
			
			//$this->assignRef( 'a1',  $setting['a1'] );
		$this->assignRef( 'a2',  $setting->a2);
		//	$this->assignRef( 'a3',  $setting['a3'] );
		//	$this->assignRef( 'a4',  $setting['a4'] );




	$tab="<table width=100% border=0>\n\r";
	$x=0;
		for( $i=0; $i<count($rows); $i++ )
		{
			$category = $rows[$i];
			if($x==0)
			{
			$tab.="\n\r<tr>";
			$x++;
			}
			
			if($x<=$cardPerRow)
			{
			$id=$category->id;
			$title=$category->title;
			$type=$category->type;
			$file=$category->file;
			$desp=$category->desp;
			$effect=$category->effect;
			$cate=$category->cat;
			$thumb=$category->thumb;
			$point=$category->point;
			
			if($point==0)
			$point="";
			else
			$point=$point." ".JText::_('COM_ODUDECARD_PROFILE_POINT');
			
			
			  $tab.='<td valign="top" width="114" align="center" >'.getThumb($id).'<br>'.$title.'';
      /*
      $tab.='<td valign=top width=114 align=center><a href='.JRoute::_('index.php?option=com_odudecard&id='.$id.'&controller=card_show&cate='.$cate).' ><img src="'.JURI::base().'media/ecard/'.$thumb.'" alt="'.$title.'" border=1 id=card2></a><br />'.$title.'</a>';
      if($type=='J')
      $tab.="<br> <a rel=\"{handler: 'image', size: {x: 700, y: 400}}\" class=\"modal\" href='".JURI::root()."media/ecard/".$file."'><img src='".JURI::root()."components/com_odudecard/include/zoom.png' alt=".JText::_('COM_ODUDECARD_ZOOM')." title=".JText::_('COM_ODUDECARD_ZOOM')." border=0></a>";
      else
      $tab.="<br>";
      */
      
      
      if($user->username==$uid)
      $tab.="<a href='".JRoute::_('index.php?option=com_odudecard&view=odudecardmylist&id='.$user->username.'&delete='.$id)."'><img src='".JURI::root()."components/com_odudecard/include/cross.png' alt=".JText::_('COM_ODUDECARD_DELETE')." title=".JText::_('COM_ODUDECARD_DELETE')." border=0></a><br>";
			
      
      $tab.=$point."</td>";

			
			$x++;
			}
			
			if($x==$cardPerRow+1)
			{
			$tab.="</tr>\n\r";
			$x=0;
			}
			
			
		}
$tab.="</table>";

		
		
        $this->assignRef( 'listCard',  $tab );
 
			  
		parent::display($tpl);
		}
else
{
JError::raiseWarning( 100, JText::_('COM_ODUDECARD_ECARD_LOGIN') );
JError::raiseNotice( 100, JText::_('COM_ODUDECARD_ECARD_REG') );

}
	}
}
?>
                                                                                                
