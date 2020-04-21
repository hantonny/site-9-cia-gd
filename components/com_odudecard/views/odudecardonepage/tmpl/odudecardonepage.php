<?php
 /**
 * @package ODude ECARD
 * @author ODude.com
 * @copyright (C) 2014 ODude Network. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 **/

defined( '_JEXEC' ) or die( 'Restricted access' );
?>

<?php 
if(!defined('DS')){
   define('DS',DIRECTORY_SEPARATOR);
}
JHTML::_('behavior.formvalidation');
////jimport('joomla.html.parameter');

$_SESSION["security"] = "";	

 ?>

<?php
require_once ( JPATH_BASE.DS.'components'.DS.'com_odudecard'.DS.'include'.DS.'lib.php' );	  
$setting=getSetting();

$doc =JFactory::getDocument();
$doc->setMetaData( 'Description', $this->desp );
$doc->setMetaData( 'generator', 'ODude.com Ecard' );
$doc->setMetaData( 'keywords', $this->keyword );
$doc->setTitle($this->title);

$mymenuitem = JRequest::getVar('Itemid', 0, 'request', 'int');

$params  = JComponentHelper::getParams('com_odudecard');

$version = new JVersion;
$joomla = $version->getShortVersion();
  
$mainframe = JFactory::getApplication();
$document = JFactory::getDocument();
$document->addCustomTag( "<meta property=\"fb:app_id\" content=\"303175376446097\">" );
$document->addCustomTag( "<meta property=\"og:title\" content=\"".$this->title."\">" );
$document->addCustomTag( "<meta property=\"og:url\" content=\"http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']."\">" );
if($this->type=='Y')
$document->addCustomTag( "<meta property=\"og:image\" content=\"http://img.youtube.com/vi/".$this->thumb."/1.jpg\">" );
else
$document->addCustomTag( "<meta property=\"og:image\" content=\"".JURI::base()."media/ecard/".$this->image."\">" );
$document->addCustomTag( "<meta property=\"og:site_name\" content=\"".$mainframe->getCfg('sitename')."\">" );
$document->addCustomTag( "<meta property=\"og:description\" content=\"".$this->desp ." \">" );
$document->addCustomTag( "<meta property=\"og:type\" content=\"article\">" );

$q_id = JRequest::getVar('id', '0');
		$id=getSpecificId($q_id,'media');


$temp=$this->a2;
$doc->addStyleSheet('components/com_odudecard/template/'.$temp.'/'.$temp.'.css');
$doc->addStyleSheet('components/com_odudecard/template/pure-min.css');
$doc->addStyleSheet('components/com_odudecard/template/grids-responsive-min.css');

$pathway = $mainframe->getPathway();
JHTML::_('behavior.modal');

if($this->type=='V')
{
$doc->addStyleSheet('components/com_odudecard/include/video-js.min.css');
$doc->addScript('components/com_odudecard/include/video.min.js');

}



$catid=getCategoryDetail($this->cate)->subcat;

if($catid!=0)
$pathway->addItem(getCategoryDetail($catid)->name,"index.php?option=com_odudecard&controller=card_list&Itemid=".$mymenuitem."&cate=".$catid);
$pathway->addItem($this->cate_name,"index.php?option=com_odudecard&controller=card_list&Itemid=".$mymenuitem."&cate=".$this->cate);
$pathway->addItem($this->title,"#");
?>

<script language="javascript">
function myValidate(f) {
        if (document.formvalidator.isValid(f)) {
                f.check.value='<?php echo JSession::getFormToken(); ?>';//send token
                return true; 
        }
        else {
                alert('Some values are not acceptable.  Please retry.');
        }
        return false;
}


</script>

  <style type="text/css">
.box {
	background-image: url(<?php echo JURI::root() ?>media/ecard/<?php echo $this->cate_bg ?>);
	width:100%;
}

</style>


<?php 

	

include ( JPATH_BASE .DS.'components'.DS.'com_odudecard'.DS.'template'.DS.$temp.DS.$temp.'.top.tpl.php' );

?>
<div class=box>
  <div class=bar align="center"><?php echo $this->cate_name ?>: <?php echo $this->title; ?></div>
<center>

<?php
include ( JPATH_BASE .DS.'components'.DS.'com_odudecard'.DS.'template'.DS.$temp.DS.$temp.'.tpl.php' );
	
	if($setting->share==1)
   {
	include ( JPATH_BASE .DS.'components'.DS.'com_odudecard'.DS.'template'.DS.$temp.DS.$temp.'.share.tpl.php' );
	}

	
?>
<?php
//Hit Counter
if (!session_id())
 {
 session_start();
}
if(!isset($_SESSION['views']))
{
$db2 = JFactory::getDBO();
     $query2="update #__ecard_media set hits=hits+1 where id='$id'";
     $db2->setQuery($query2);
     $result = $db2->execute();
}
else
{

 $_SESSION['views'] = '1';

} 




  $user = JFactory::getUser();
  //$dispatcher = JDispatcher::getInstance();
  $abc=0;
  $odude_profile=JPATH_ADMINISTRATOR . '/components/com_easysocial/includes/foundry.php';
  
  

           
   if($setting->point==1 )
  {
   if(file_exists($odude_profile))
   {
	   
	  require_once( JPATH_ADMINISTRATOR . '/components/com_easysocial/includes/foundry.php' );

		// Get the current logged in user
		$my     = Foundry::user();
		echo $my->getName(). " you have ".$my->getPoints()." points.";



	   
		  if($this->point!=0)
		  {
			  
			if($user->name)
			{
			   //echo "Logged in";
			 //$check=$dispatcher->trigger('getPointCheck', array($user->username,$this->point));
			  $check=odude_check_point(Foundry::user(),$this->point);
			 //print_r($check);
			//echo $check."---";
			 if($check=='0')
			 {
			 $abc=0;
			  
			 }
			 else
			 {
			   $abc=1;
			 
			 }
			
			 }
			 else
			 {
			
			   
					//Redirect*****

		  $return = JURI::getInstance()->toString();
		$url    = 'index.php?option=com_users&view=login';
		$url   .= '&return='.base64_encode($return);
			  JFactory::getApplication()->redirect($url, JText::_('COM_ODUDECARD_ECARD_LOGIN')); 

		 
		//Redirect*****END 
			   
			   
			   $abc=0;
			  }
		  }
		  else
		  {
		  $abc=1;
		  
		  }
 }
 else
 {
 echo "<h3>EasySocial Plugin must be installted and enabled.</h3>";
 }
 }
 else
 {
  $abc=1;
 }
 
if($params->get( 'start_ecard')=='1')
$abc=0; 
 
if($abc==1)
{
?>
 <form id='myForm' action="<?php echo JRoute::_("index.php?option=com_odudecard&amp;controller=cardsend&amp;Itemid=$mymenuitem");?>" method="post" class="form-validate pure-form pure-form-stacked" onSubmit="return myValidate(this);"> 
 
<?php
		if($setting->import!='0')
		{
			include ( JPATH_BASE .DS.'components'.DS.'com_odudecard'.DS.'template'.DS.$temp.DS.$temp.'.import.tpl.php' );
		}
		if($setting->add_rec!='0')
		{
		include ( JPATH_BASE .DS.'components'.DS.'com_odudecard'.DS.'template'.DS.$temp.DS.$temp.'.add_rec.tpl.php' );
		}
		else
		{
		echo "<input type=hidden name=rec_no value=1>";
		echo "<input type='hidden' name='eorm' id='eorm' value='1'>";
		}
?>

 	

				<?php
				
				include ( JPATH_BASE .DS.'components'.DS.'com_odudecard'.DS.'template'.DS.$temp.DS.$temp.'.form.tpl.php' );
				
				
				if($setting->captcha!='0')
				{
				include ( JPATH_BASE .DS.'components'.DS.'com_odudecard'.DS.'template'.DS.$temp.DS.$temp.'.captcha.tpl.php' );
				?>

<?php
}
?>

<input name="id" type="hidden" id="id" value="<?php echo JRequest::getVar('id', '0');  ?>" />      
<input name="cate" type="hidden" id="cate" value="<?php echo $this->cate_alias;  ?>" />  
<input name="send" type="hidden" id="send" value="normal" />      
<input name="eorm" type="hidden" id="eorm" value="1" />      
<input name="point" type="hidden" id="point" value="<?php echo $this->point;  ?>" />  
<input name="temp" type="hidden" id="temp" value="onepage" />  
<input name="image" type="hidden" id="image" value="<?php echo $this->image;  ?>" />  	
<input name="rec_no" type="hidden" id="rec_no" value="1" />  
   
       <input type="submit" name="button" id="button" value="<?php echo JText::_('COM_ODUDECARD_ECARD_SEND_ECARD'); ?>" class="pure-button pure-input-1-2 pure-button-primary"/> 
       <input type="submit" name="button" id="button" value="<?php echo JText::_('COM_ODUDECARD_ECARD_SEND_ECARD_PREVIEW'); ?>" class="pure-button pure-input-1-4 pure-button-primary"/> 
  
      </label>
    </form>
    
           <?php

    }

    ?>
    

  
</div>
<br>
<?php
include ( JPATH_BASE .DS.'components'.DS.'com_odudecard'.DS.'template'.DS.$temp.DS.$temp.'.media.tpl.php' );
/*
  <a href=http://www.odude.com target=_blank ><img src="<?php echo JURI::base(); ?>components/com_odudecard/include/dot.gif" border=0 align=right title="Powered By ODude.com"></a>
  */
?>
 
 
