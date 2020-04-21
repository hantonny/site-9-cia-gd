<?php
 /**
 * @package ODude ECard
 * @author ODude.com
 * @copyright (C) 2014 ODude Network. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 **/

  	function getCardM($cardid)
		{
		
		$card = array();
		$db = JFactory::getDBO();
		$query =  "select * from #__ecard_media where id='".$cardid."'";
		$db->setQuery($query);
		$rows = $db -> loadObjectList();
				
		if(!empty($rows))
		{
		$card['ecard_alias']=$rows[0]->slug;
		$card['effect']=$rows[0]->effect;
		$card['cate']=$rows[0]->cat;
		$card['title']=$rows[0]->title;
		$card['image']=$rows[0]->file;
		$card['type']=$rows[0]->type;
		$card['desp']=$rows[0]->desp;
		$card['thumb']=$rows[0]->thumb;
		$card['cate_alias']=getEcardAlias($rows[0]->cat,'cate');
		return $card;
		}
		else
		{
		
		return 'X';	

		}
		}
	function getThumbM($cardid,$mymenuitem)
		{
		   //$mymenuitem = JRequest::getVar('Itemid', 0, 'request', 'int');
		   $greeting = getCardM($cardid);
		    $layout="card_".getSetting()->a2;
		  if(getSetting()->a2=='default')
		$layout="card_show";
		   $thumb_path='media/ecard/'.$greeting['thumb'];
		   
		   if (file_exists($thumb_path))
		   $pic=JURI::base().$thumb_path;
		   else
		   if($greeting['type']=='V')
		   $pic=JURI::root().'components/com_odudecard/media/video.png';
		   else
		    $pic=JURI::root().'components/com_odudecard/media/photo.gif';
		   
		   
		   
		   if($greeting['type']=='Y')
       $img='<a href='.JRoute::_('index.php?option=com_odudecard&id='.$greeting['ecard_alias'].'&controller='.$layout.'&Itemid='.$mymenuitem.'&cate='.$greeting['cate_alias']).' ><img src="http://img.youtube.com/vi/'.$greeting['thumb'].'/1.jpg" alt="'.$greeting['title'].'" border=1 id=card2></a>';
       else
        $img='<a href='.JRoute::_('index.php?option=com_odudecard&id='.$greeting['ecard_alias'].'&controller='.$layout.'&Itemid='.$mymenuitem.'&cate='.$greeting['cate_alias']).' ><img src="'.$pic.'" alt="'.$greeting['title'].'" border=1 id=card2></a>';                                                                                                                                                   
	
	    return $img;
		}

?>