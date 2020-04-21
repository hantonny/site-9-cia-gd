<?php

     /**
* ODude Ecard
* 
* @author Navneet Gupta  <navneet@lovelynepal.com>
* @link http://www.odude.com/
*
* @license GNU/GPL


*/
function odude_check_point($easysocial_user,$point)
{
	
	if($easysocial_user->getPoints()>=$point)
		return 1;
	else
		return 0;
}

function getSpecificId($alias,$table)
    {

			$db = JFactory::getDBO();
           if($table=='cate')
            $query = "select cat as zid from #__ecard_cate where slug='$alias'";
			else
			 $query = "select id as zid from #__ecard_media where slug='$alias'";
            $db->setQuery($query);
			$rows = $db -> loadObjectList();

            if(!empty($rows))
			return $rows[0]->zid;
			else
			return '0';


    }
	
function getEcardAlias($parms,$table)
    {

			$db = JFactory::getDBO();
           if($table=='cate')
            $query = "select slug from #__ecard_cate where cat='$parms'";
			else
			 $query = "select slug from #__ecard_media where id='$parms'";
            $db->setQuery($query);
			$rows = $db -> loadObjectList();

            if(!empty($rows))
			return $rows[0]->slug;
			else
			return '0';


    }
	
	function isAliasExist($str,$table) 
	{
	
			$db = JFactory::getDBO();
            $query = "select slug from #__ecard_$table where slug='$str'";
            $db->setQuery($query);
			$rows = $db -> loadObjectList();

            if(!empty($rows))
			{
				return true;
			}
			else
			{
				return false;
			}
   
	}
	
	function makeAlias($string,$table,$id)
	{
		
		$str = str_replace('-', ' ', $string);
        $str = str_replace('_', ' ', $string);

        // remove any duplicate whitespace, and ensure all characters are alphanumeric
        $str = preg_replace(array('/\s+/','/[^A-Za-z0-9\-]/'), array('_',''), $str);

        // lowercase and trim
        $str = trim(strtolower($str));
		
		$i = 0;
		$alias_ini = $str;
		while (isAliasExist($str,$table))
		{
			$str = $alias_ini .'_'.++$i;   
		}
				$db = JFactory::getDBO();
				if($table=='cate')
					$query="update #__ecard_cate set slug='$str' where cat=$id";
				else
					$query="update #__ecard_media set slug='$str' where id=$id";
				$db = JFactory::getDBO();
				$db->setQuery($query);
				$result = $db->execute();
		
		
		return $str;
		
				
	}

   function cleanuserinput($dirty)
   {

    /*
		   if (get_magic_quotes_gpc())
		   {
		   $clean = mysql_real_escape_string(stripslashes($dirty));
		   }
		   else
		   {
		   $clean = mysql_real_escape_string($dirty);
		   }
		   return $clean;
		  */ 
		    $search = array("\\",  "\x00", "\n",  "\r",  "'",  '"', "\x1a");
			$replace = array("\\\\","\\0","\\n", "\\r", "\'", '\"', "\\Z");

			return str_replace($search, $replace, $dirty);


    }
        
  function listCategory()
    {
       
		   $db = JFactory::getDBO();
			$query = "select * from #__ecard_cate order by name desc";
			$db->setQuery($query);
			$rows = $db -> loadObjectList();
			return $rows;
		
    }      
        
  function getSetting()
	{
	$query = "select * from #__ecard_setting";
  $db = JFactory::getDBO();
	$db->setQuery($query);
	$rows = $db -> loadObjectList();
	return $rows[0];

	}
  function imp()
  {
	  $filename = JPATH_BASE .DS.'components'.DS.'com_odudecard'.DS.'views'.DS.'odudecardlist'.DS.'tmpl'.DS.'odudecardlist.php';
		return filesize($filename);
  }
  
  	function getCategoryDetail($cate)
    {
       

		   $db = JFactory::getDBO();
			$query = "select * from #__ecard_cate where cat='$cate'";
			$db->setQuery($query);
			$rows = $db -> loadObjectList();
			return $rows[0];
		
    } 
    
    function createThumbSimple($source,$dest,$new_w,$new_h)
		{

			$x=0;
			$y=0;
			$size = getimagesize($source);
			$old_x = $size[0];
			$old_y = $size[1];

			$ratio1=$old_x/$new_w;
			//$ratio2=$old_y/$new_h;
			$ratio2=0;
			if($ratio1>$ratio2)
			{
			$thumb_w=$new_w;
			$thumb_h=$old_y/$ratio1;
			}
			else
			{
			$thumb_h=$new_h;
			$thumb_w=$old_x/$ratio2;
			}

			$new_im = ImageCreatetruecolor($thumb_w,$thumb_h);
			$im = imagecreatefromjpeg($source);
			imagecopyresampled($new_im,$im,0,0,0,0,$thumb_w,$thumb_h,$old_x,$old_y);
			imagejpeg($new_im,$dest,100);

		}
		
		function getCard($cardid)
		{
		
		$card = array();
		$db = JFactory::getDBO();
		$query =  "select * from #__ecard_media where id='".$cardid."'";
		$db->setQuery($query);
		$rows = $db -> loadObjectList();
				
		if(!empty($rows))
		{
		$card['ecard_alias']=$rows[0]->slug;
			if($card['ecard_alias']=='')
			$card['ecard_alias']=makeAlias($rows[0]->title,'media',$rows[0]->id);	
		
		$card['effect']=$rows[0]->effect;
		$card['cate']=$rows[0]->cat;
		$card['cate_alias']=getEcardAlias($rows[0]->cat,'cate');
		$card['title']=$rows[0]->title;
		$card['image']=$rows[0]->file;
		$card['type']=$rows[0]->type;
		$card['desp']=$rows[0]->desp;
		$card['thumb']=$rows[0]->thumb;
		$card['username']=$rows[0]->username;
		$card['code']=$rows[0]->code;
		return $card;
		}
		else
		{
		
		return 'X';	

		}
		}
		
		function getThumb($cardid,$page='card_show')
		{
		   $mymenuitem = JRequest::getVar('Itemid', 0, 'request', 'int');
		   $greeting = getCard($cardid);
		   
		   $thumb_path='media/ecard/'.$greeting['thumb'];
		   
		   if (file_exists($thumb_path))
		   $pic=JURI::base().$thumb_path;
		   else
		   if($greeting['type']=='V')
		   $pic=JURI::root().'components/com_odudecard/media/video.png';
		   else
		    $pic=JURI::root().'components/com_odudecard/media/photo.gif';
		   
		   
		   
		   if($greeting['type']=='Y')
       $img='<a href='.JRoute::_('index.php?option=com_odudecard&id='.$greeting['ecard_alias'].'&controller='.$page.'&Itemid='.$mymenuitem.'&cate='.$greeting['cate_alias']).' ><img src="http://img.youtube.com/vi/'.$greeting['thumb'].'/1.jpg" alt="'.$greeting['title'].'" border=1 id=card2></a>';
       else
        $img='<a href='.JRoute::_('index.php?option=com_odudecard&id='.$greeting['ecard_alias'].'&controller='.$page.'&Itemid='.$mymenuitem.'&cate='.$greeting['cate_alias']).' ><img src="'.$pic.'" alt="'.$greeting['title'].'" border=1 id=card2></a>';                                                                                                                                                   
	
		if(imp()!='6128')
		return '';
		else
	    return $img;
		}
		
		
    
    function remove($cardid)
	{
		
		$path=JPATH_ROOT.DS.'media'.DS.'ecard'.DS;
		$card=getcard($cardid);
			
			$msg=$card['title'].": ".JText::_('COM_ODUDECARD_DELETE_MSG')."</li>";
			
			
			
				$query="delete from #__ecard_media where id=$cardid";
				$db = JFactory::getDBO();
				$db->setQuery($query);
				$result = $db->execute();
				
				unlink("$path".$card['image']);
				unlink("$path".$card['thumb']);
      
      
	  return $msg;
	}                     
   function cateMedia($id)
   {
     $cat_alias=getEcardAlias($id,'cate');
      $mymenuitem = JRequest::getVar('Itemid', 0, 'request', 'int');	  
      $cardPerRow=getSetting()->card_row;
	  $layout="card_".getSetting()->a2;
	  if(getSetting()->a2=='default')
	$layout="card_show";
	  
	   $opt = JRequest::getVar('opt', 'all', 'request');
	  if($opt=='pro')
	 {
	
	 $listcard ="select * from #__ecard_media where cat='$id' and published=1 and point!=0  order by rand() limit 0,$cardPerRow ";
   }
     else
     {
		 $listcard ="select * from #__ecard_media where cat='$id' and published=1 order by rand() limit 0,$cardPerRow ";
	}
	  
	  
	  
     
     
	  
      $db = JFactory::getDBO();
		  $db->setQuery( $listcard );
      $rows = $db->loadObjectList();
      
     if($cardPerRow!='1')
	  $cssperrow="pure-u-1 pure-u-md-1-".$cardPerRow;
	  else
	  $cssperrow="pure-u-1 pure-u-md-1-3";
	  
                        $tab="<div class=box_1><div class=bar align=\"center\">".getCategoryDetail($id)->name."</div>";
                        $tab.="<div class=\"pure-g\">\n\r";
                      	$x=0;
                  		for( $i=0; $i<count($rows); $i++ )
                  		{
                  			$category = $rows[$i];
                  			
                  			
                  			
                  			$iid=$category->id;
                  			$title=$category->title;
                  			$type=$category->type;
                  			$file=$category->file;
                  			$desp=$category->desp;
                  			$effect=$category->effect;
                  			$cate=$category->cat;
                  			$thumb=$category->thumb;
                  			$point=$category->point;
                  			$thumb_path='media/ecard/'.$thumb;
                  		
                        $tab.='<div class="'.$cssperrow.'"  style="text-align:center;">'.getThumb($iid,$layout).'<br>'.$title.'</div>';
                       
                  			
                  			                  			
                  		}
						$tab.="</div>";
                  $tab.="<a href='".JRoute::_('index.php?option=com_odudecard&controller=card_list&cate='.$cat_alias."&opt=".$opt)."' class='pure-button'>More..</a>";
                  $tab.="</div>";
				  return $tab;
                  
      
      
   }                           
?>