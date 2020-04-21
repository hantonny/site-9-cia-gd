<?php
 /**
 * @package ODude ECard
 * @author ODude.com
 * @copyright (C) 2014 ODude Network. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 **/

jimport( 'joomla.application.component.view');


class odudecardViewodudecardonepage extends JViewLegacy
{
	function display($tpl = null)
	{
	    require_once ( JPATH_BASE .DS.'components'.DS.'com_odudecard'.DS.'include'.DS.'lib.php' );	  
      $setting=getSetting();


    	$q_id = JRequest::getVar('id', '0');
		$id=getSpecificId($q_id,'media');

	  
		$model = $this->getModel();
        $greeting = $model->getCard($id);
		
		
		$cate_detail = $model->getCategory();
		
        $this->assignRef( 'cate_name',  $cate_detail[0]->name );
		  $this->assignRef( 'cate_banner',  $cate_detail[0]->banner );
		    $this->assignRef( 'cate_bg',  $cate_detail[0]->bg );
			
		
		$this->assignRef( 'a2',  $setting->a2);
	

 
 		if($greeting['type']=='J')
 		{
               if($setting->watermark=='1')
               {
                $card="<img src='".JURI::base()."components/com_odudecard/include/watermark.php?src=".JURI::base()."media/ecard/".$greeting['image']."' alt='".$greeting['title']."' border=1><br>";


               }
               else
               {
                  $card="<img src='".JURI::base()."media/ecard/".$greeting['image']."' alt='".$greeting['title']."' border=1><br>";

               }
		}
		
		
 		if($greeting['type']=='F')
		$card="<object classid=\"clsid:d27cdb6e-ae6d-11cf-96b8-444553540000\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0\" width=\"".$setting->width."\" height=\"".$setting->height."\" id=".$greeting['title']." align=\"middle\"><param name=\"allowScriptAccess\" value=\"sameDomain\" /><param name=\"movie\" value=".JURI::base()."media/ecard/".DS.$greeting['image']." /><param name=\"quality\" value=\"high\" /><embed src=".JURI::base()."media/ecard/".$greeting['image']." quality=\"high\"  width=\"".$setting->width."\" height=\"".$setting->height."\" name=".$greeting['title']." align=\"middle\" allowScriptAccess=\"sameDomain\" type=\"application/x-shockwave-flash\" pluginspage=\"http://www.macromedia.com/go/getflashplayer\" /></object>";

    if($greeting['type']=='Y')
    $card="<iframe src=\"http://www.youtube.com/embed/".$greeting['thumb']."\" width=\"".$setting->tubewidth."\" height=\"".$setting->tubeheight."\" frameborder=\"0\"></iframe>";
		//$card="<img src=http://img.youtube.com/vi/".$greeting['thumb']."/1.jpg  alt='".$greeting['title']."' border=1>";

      if($greeting['type']=='V')
    $card="<video id=\"example_video_1\" class=\"video-js vjs-default-skin\" controls preload=\"none\" width=\"".$setting->videowidth."\" height=\"".$setting->videoheight."\" data-setup=\"{}\"><source src=".JURI::base()."media/ecard".DS.$greeting['image']." type='video/mp4' /> </video>";
		
$gcode=stripslashes($greeting['code']);
		$this->assignRef( 'card',  $card );
 		$this->assignRef( 'effect',  $greeting['effect'] );
 		$this->assignRef( 'image',  $greeting['image'] );
 		$this->assignRef( 'thumb',  $greeting['thumb'] );
 		$this->assignRef( 'cate',  $greeting['cate'] );
		$cate_alias=getEcardAlias($greeting['cate'],'cate');
		$this->assignRef( 'cate_alias',$cate_alias   );
 		$this->assignRef( 'title',  $greeting['title'] );
 		$this->assignRef( 'point',  $greeting['point'] );
 		$this->assignRef( 'user',  $greeting['user'] );
 		$this->assignRef( 'type',  $greeting['type'] );
    $this->assignRef( 'desp',  $greeting['desp'] );
    $this->assignRef( 'code',  $gcode );
		$this->assignRef( 'keyword',  $greeting['keyword'] );
 //Getting previous pic


                                 $query =  "select * from #__ecard_media WHERE id > ".$id." and cat='".$greeting['cate']."' and published=1 ORDER BY ordering asc LIMIT 1";
                                  $db = JFactory::getDBO();
		                          $db->setQuery($query);
		                          $rows = $db -> loadObjectList();
                                  $user_data = $db->loadObject();
                                  $f='';
                                  if(empty($user_data))
                                  {

                                  $this->assignRef( 'prev', $f);
                                  }
                                 else
                                  {
                                  $f='x';
                                  $this->assignRef( 'prev', $f);
                                  $this->assignRef( 'prev_thumb',  $rows[0]->thumb );
                                  $this->assignRef( 'prev_id',  $rows[0]->id );
                                  $this->assignRef( 'prev_title',  $rows[0]->title );
                                  $this->assignRef( 'prev_type',  $rows[0]->type );
                                    }
                                    
                                  $query =  "select * from #__ecard_media WHERE id < ".$id." and cat='".$greeting['cate']."' and published=1 ORDER BY ordering asc LIMIT 1";
                                 $db = JFactory::getDBO();
		                          $db->setQuery($query);
		                          $rows = $db -> loadObjectList();
                                  $user_data = $db->loadObject();
                                  $g='';
                                  if(empty($user_data))
                                  {

                                  $this->assignRef( 'next', $g);
                                  }
                                 else
                                  {
                                  $g='x';
                                  $this->assignRef( 'next', $g);
                                 $this->assignRef( 'next_thumb',  $rows[0]->thumb );
                                  $this->assignRef( 'next_id',  $rows[0]->id );
                                  $this->assignRef( 'next_title',  $rows[0]->title );
                                  $this->assignRef( 'next_type',  $rows[0]->type );
                                    }
//*******
 
			  
		parent::display($tpl);
	}
}
?>
                                                                                                
