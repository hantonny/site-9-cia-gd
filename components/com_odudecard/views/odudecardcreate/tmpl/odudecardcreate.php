<?php 
 /**
 * @package ODude ECard
 * @author ODude.com
 * @copyright (C) 2014 ODude Network. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 **/

defined('_JEXEC') or die('Restricted access'); ?>
<?php 
if(!defined('DS')){
   define('DS',DIRECTORY_SEPARATOR);
}
JHTML::_('behavior.formvalidation');

 ?>
<?php
require_once ( JPATH_BASE .DS.'components'.DS.'com_odudecard'.DS.'include'.DS.'lib.php' );	  
$setting=getSetting();

$doc =JFactory::getDocument();
$doc->setMetaData( 'keywords', $this->cate_name );
$doc->setTitle($this->cate_name." ".JText::_('COM_ODUDECARD_ECARD_CREATE_CARD'));
$mymenuitem = JRequest::getVar('Itemid', 0, 'request', 'int');
$q_cate = JRequest::getVar('cate', '0');
$cate=getSpecificId($q_cate,'cate'); 

$mainframe = JFactory::getApplication();
$version = new JVersion;
$joomla = $version->getShortVersion();
$opt = JRequest::getVar('opt', 'all', 'request');

$temp=$this->a2;
$doc->addStyleSheet('components/com_odudecard/template/'.$temp.'/'.$temp.'.css');
$doc->addStyleSheet('components/com_odudecard/template/pure-min.css');
$doc->addStyleSheet('components/com_odudecard/template/grids-responsive-min.css');

?>
  <style type="text/css">
.box {
	background-image: url(<?php echo JURI::root() ?>media/ecard/<?php echo $this->cate_bg ?>);
	border: 1px solid <?php echo $this->a2 ?>;
	width:100%;
}

</style>

<?php 

	if($this->cate_banner!="")
	echo "<center><img src=\"".JURI::base()."media/ecard/".$this->cate_banner."\" alt=\"".$this->cate_name."\"  /></center>";

    $user = JFactory::getUser();
    if($user->name)
    {
    

?>
<div class="box">
  <div class="bar" align="center"><?php echo $this->cate_name ?>: <?php echo JText::_('COM_ODUDECARD_ECARD_CREATE_CARD'); ?></div>
<center>
<?php
if (empty($_POST))
{
?>
<form name="odude" action="" method="post" enctype="multipart/form-data">
 <input type="hidden" name="nouse" class="required" />
    <table border=0>
    <tr><td>
      <?php echo  JText::_('COM_ODUDECARD_ECARD_TITLE');  ?></td><td>
         <input type="text" name="title" id="title" /></td></tr>

                
    <tr>
    <td> <?php echo  JText::_('COM_ODUDECARD_ECARD_FILE');  ?></td>
      <td> <input type="file" name="banner" id="banner" /></td></tr>

       <tr><td rowspan=2>
       <input type=hidden name=addpic>
       <input type="submit" value="Submit" class="submit" /> 
        <a href="<?php echo JRoute::_('index.php?option=com_odudecard&controller=card_list&Itemid='.$mymenuitem.'&cate='.$q_cate.'&opt='.$opt); ?>" class="ODude"><?php echo JText::_('COM_ODUDECARD_ECARD_BACK'); ?></a>
       </td></tr>
       </table>
       </form> <br><br>
       <?php echo JText::_('COM_ODUDECARD_ADMIN_CHECK'); ?>

<?php



}
else
{

  //JError::raiseNotice( 100, JText::_('COM_ODUDECARD_SUCESS_UPDATE') );
  $title=$_REQUEST["title"];
  $twidth=$setting->thumb_width;
	$owidth=$setting->large_width;
  $tp=time();

  $file = JRequest::getVar('banner',null, 'files', 'array');
  jimport('joomla.filesystem.file');
	$filename = JFile::makeSafe($file['name']);
	$src = $file['tmp_name'];
	$dest = JPATH_ROOT.DS.'media'.DS.'ecard'.DS .$tp.'.jpg';
  $path=JPATH_ROOT.DS.'media'.DS.'ecard'.DS;
  
   
//if ( strtolower(JFile::getExt($filename) ) == 'jpg' || strtolower(JFile::getExt($filename) ) == 'JPG')
if ( $file['type']=='image/jpeg')
{
   if ( JFile::upload($src, $dest) )
   {


   $s=$dest;

   $size = getimagesize($s);
		
if($size)
{

   $d1=JPATH_ROOT.DS.'media'.DS.'ecard'.DS.'org_'.$tp.'.jpg';
   $sz1=$owidth;
   createThumbSimple($s,$d1,$sz1,0);
   
   
   $d2=JPATH_ROOT.DS.'media'.DS.'ecard'.DS.'thumb_'.$tp.'.jpg';
   $sz2=$twidth;
   createThumbSimple($s,$d2,$sz2,0);
   

    $user = JFactory::getUser();
                $db2 = JFactory::getDBO();
                $query2="insert into #__ecard_media(id,ddate,title,type,file,thumb,effect,cat,username,published) values (null,now(),'".cleanuserinput($title)."','J','org_$tp.jpg','thumb_$tp.jpg','N','$cate','$user->username',0)";
                $db2->setQuery($query2);
                $result = $db2->execute();
                $lastid= $db2->insertid();
				$ecard_alias=makeAlias($title,'media',$lastid);	
}

unlink($dest);

$odude_profile=JPATH_ADMINISTRATOR . '/components/com_easysocial/includes/foundry.php';
 if($setting->point==1 )
  {
   if(file_exists($odude_profile))
   {
	   
	  require_once( JPATH_ADMINISTRATOR . '/components/com_easysocial/includes/foundry.php' );
	  Foundry::points()->assign( 'odudecard.jpeg' , 'com_odudecard' , $user->id);
	 //Foundry::points()->assignCustom($user->id, 100, $message = 'You uploaded good ecard');
   }
  }


ob_start();
header("Location: ".JRoute::_('index.php?option=com_odudecard&id='.$ecard_alias.'&controller=card_'.$setting->a2.'&cate='.$q_cate));
ob_flush();

   }
   else
   {
     JError::raiseWarning( 0, JText::_('COM_ODUDECARD_UPLOAD_ERROR'));
   }
}
else
{
    if($filename!="")
    JError::raiseWarning( 0, JText::_('COM_ODUDECARD_UPLOAD_JPG'));
	?>
	  <form name="odude" action="" method="post" enctype="multipart/form-data">
 <input type="hidden" name="nouse" class="required" />
    <table border=0>
    <tr><td>
      <?php echo  JText::_('COM_ODUDECARD_ECARD_TITLE');  ?></td><td>
         <input type="text" name="title" id="title" /></td></tr>

                
    <tr>
    <td> <?php echo  JText::_('COM_ODUDECARD_ECARD_FILE');  ?></td>
      <td> <input type="file" name="banner" id="banner" /></td></tr>

       <tr><td rowspan=2>
       <input type=hidden name=addpic>
       <input type="submit" value="Submit" class="submit" /> 
      <a href="<?php echo JRoute::_('index.php?option=com_odudecard&controller=card_list&Itemid='.$mymenuitem.'&cate='.$q_cate.'&opt='.$opt); ?>" class="ODude"><?php echo JText::_('COM_ODUDECARD_ECARD_BACK'); ?></a>
       </td></tr>
       </table>
       </form> <br><br>
       <?php echo JText::_('COM_ODUDECARD_ADMIN_CHECK'); ?>
	
	
	<?php
}  
  

} 

echo "</div>";

}
     else
     {
      //JError::raiseWarning( 100, JText::_('COM_ODUDECARD_ECARD_LOGIN') );
      //JError::raiseNotice( 100, JText::_('COM_ODUDECARD_ECARD_REG') );
      
      
       //Redirect*****
if(substr($joomla,0,3) == '1.5')
{
  $return = JURI::getInstance()->toString();
$url    = 'index.php?option=com_user&view=login';
$url   .= '&return='.base64_encode($return);
      JFactory::getApplication()->redirect($url, JText::_('COM_ODUDECARD_ECARD_LOGIN')); 
}
else
{
   $return = JURI::getInstance()->toString();
$url    = 'index.php?option=com_users&view=login';
$url   .= '&return='.base64_encode($return);
      JFactory::getApplication()->redirect($url, JText::_('COM_ODUDECARD_ECARD_LOGIN')); 
}      
//Redirect*****END 
      
      }
?>