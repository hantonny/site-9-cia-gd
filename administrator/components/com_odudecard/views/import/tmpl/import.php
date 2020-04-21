<?php 
 /**
 * @package ODude ECard
 * @author ODude.com
 * @copyright (C) 2014 ODude Network. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 **/

 defined('_JEXEC') or die('Restricted access'); ?>
<form method='post' action='index.php?option=com_odudecard&controller=import'>

<div class="col100">
<b>Note & Tips:</b>
<ul>
<li>50 files will be processed at a time.</li>
<li>Filename will be used for ecard title</li>
<li>Original files will be deleted from folder after it is created</li>
</ul> 

<?php
$path=JPATH_ROOT.DS.'media'.DS;
JHTML::stylesheet('default.css', 'components/com_odudecard/include/');
 require_once ( JPATH_SITE .DS.'components'.DS.'com_odudecard'.DS.'include'.DS.'lib.php' );
   jimport('joomla.filesystem.file');
   $setting=getSetting();
?>
<br><br>
<b>Import media from:</b><br>
<?php echo $path; ?><input type='text' name='folder'><?echo DS ?><br />
<input type=hidden name=req value=1>


         
          
				          
                          <?php
$sel='<select name=cat id=cat class="text_area">';
$subcat=listCategory();
		for( $j=0; $j<count($subcat); $j++ )
		{
			
			
		$subcategory = $subcat[$j];
		$sel.="\n\r<option value='".$subcategory->cat."'>".$subcategory->name."</option>";
		
		}
$sel.='</select>';	
//echo $sel;
?>			          


<input type=submit value='List Thumbnails'><hr />

</form>



<?php
$req = JRequest::getVar('req', 0, 'request', 'int');
$folder = JRequest::getVar('folder', 0, 'request');
$go = JRequest::getVar('go', 0, 'request');

if($req=='1')
{
 echo '<form method="post" action="index.php?option=com_odudecard&controller=import&go=1">';
 echo "<input type='hidden' name='folder' value='".$folder.DS."'>" ;
 echo '<input type="hidden" name="owidth" value="'.$setting->large_width.'" /><input type="hidden" name="twidth" value="'.$setting->thumb_width.'" />';
 echo 'Move into category :'.$sel;
 echo '<br><br><table border=0 width=600 class=fancy>';
 echo '<tr><td width=150><b>Thumbnail</b></td><td><b>Title</b></td><td width=30><b>Post</b></td></tr>';
 
 
 if(substr(decoct(fileperms($path.$folder.DS)),3)=='77')
 {
     //--
             $i=0;
      if ($handle = opendir($path.$folder.DS)) 
     {
          while (false !== ($file = readdir($handle)))
           {     
              $f=strtolower($file) ;                              
              if ($file != "." && $file != ".." && strpos($f,'.jpg'))
               {
                 
               
               echo "<tr><td><input type=\"hidden\" name=\"pic[]\" id=\"pic[]\" value=\"$file\">";
               //echo "$file\n = ".substr($file, 0, -4)."<br>";
                 echo "<img src='".JURI::root()."components/com_odudecard/include/thumbnail.php?path=".$path.$folder.DS."&filename=".$file."&width=115&height=50'  border=1><br>";
               echo $file;
               echo "</td><td><input type=\"text\" name=\"title[]\" id=\"title[]\" size=\"60\"></td> <td><input name=\"publish[]\" type=\"checkbox\" id=\"publish[]\" value=\"$i\"></td></tr>";   
              $i++;
              if($i==50)
              break;
              }
          }
    closedir($handle);
      }  
        
     //--      
 
 }

else
{
echo $path.$folder.DS." is <b>not writable</b>. <font color=red>Please set chomod 777</font>";
}
echo "</table><br><input type=submit value='Copy/Post Thumbnails'></form>";         
     
}
if($go=='1')
{
$title_ecard = JRequest::getVar('title', 0, 'request');
$publish = JRequest::getVar('publish', 0, 'request');
$pic = JRequest::getVar('pic', 0, 'request');
$cate = JRequest::getVar('cat', 0, 'request');
$owidth = JRequest::getVar('owidth', 0, 'request');
$twidth = JRequest::getVar('twidth', 0, 'request');
$x=0;
$type="J";
$desp="";

$user = JFactory::getUser();
	

	
  


 for ($i=0; $i<count($publish); $i++)
    {
     echo  $pic[$publish[$i]];
     echo  "---".$title_ecard[$publish[$i]]."<br>";
     
     $src = $path.$folder.$pic[$publish[$i]];
     $title =$title_ecard[$publish[$i]]; 
     $tp=time();
     $dest = JPATH_ROOT.DS.'media'.DS.'ecard'.DS .$tp.'.jpg';
      //****
               if ( JFile::move($src, $dest) )
               {
            
               $s=$dest;
               
               	
               $d1=JPATH_ROOT.DS.'media'.DS.'ecard'.DS.'org_'.$tp.'.jpg';
               $sz1=$owidth;
               createThumbSimple($s,$d1,$sz1,0);
            
               $d2=JPATH_ROOT.DS.'media'.DS.'ecard'.DS.'thumb_'.$tp.'.jpg';
               $sz2=$twidth;
               createThumbSimple($s,$d2,$sz2,0);
               
            
                $user = JFactory::getUser();
                            $db2 = JFactory::getDBO();
                            $query2="insert into #__ecard_media(id,ddate,title,type,file,thumb,desp,effect,cat,published,username) values (null,now(),'$title','J','org_$tp.jpg','thumb_$tp.jpg','$desp','N','$cate',1,'$user->username')";
                            $db2->setQuery($query2);
                            $result = $db2->execute();
            
            
            unlink($dest);
            //unlink($src);
                
            
               }
               else
               {
                 JError::raiseWarning( 0, JText::_('Error Saving picture'));
               }
      
      
      //****
    
    
    }

    echo "DONE";


}

?>
