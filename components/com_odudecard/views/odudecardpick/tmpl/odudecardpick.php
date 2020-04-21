<?php 
 /**
 * @package ODude ECard
 * @author ODude.com
 * @copyright (C) 2014 ODude Network. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 **/

defined('_JEXEC') or die('Restricted access');
if(!defined('DS')){
   define('DS',DIRECTORY_SEPARATOR);
}

$doc =JFactory::getDocument();
$doc->setMetaData( 'generator', 'ODude.com Ecard System' );
if($this->v=='o')
$doc->setTitle($this->title);
$temp=$this->a2;
$doc->addStyleSheet('components/com_odudecard/template/'.$temp.'/'.$temp.'.css');
$doc->addStyleSheet('components/com_odudecard/template/pure-min.css');
$doc->addStyleSheet('components/com_odudecard/template/grids-responsive-min.css');

//$doc->addStyleSheet('components/com_odudecard/include/default.css');

require_once ( JPATH_BASE .DS.'components'.DS.'com_odudecard'.DS.'include'.DS.'lib.php' );
$setting=getSetting();
$mymenuitem = JRequest::getVar('Itemid', 0, 'request', 'int');

$params  = JComponentHelper::getParams('com_odudecard');
?>
  <style type="text/css">
.box {
	background-image: url(<?php echo JURI::root() ?>media/ecard/<?php echo $this->cate_bg ?>);
	width:100%;
}

</style>
<?php
if($this->v=='o')
{
$allow=$this->viewlimit;
$left=$allow-$this->count;
if($left>0)
echo "<center>".JText::_('COM_ODUDECARD_ECARD_VIEW')." <b> $left </b>".JText::_('COM_ODUDECARD_ECARD_TIMES')."</center>";


if($left<1)
{
echo "<br><h2>".JText::_('COM_ODUDECARD_ECARD_LIMIT')."</h2><br>";
}
else
{


$db = JFactory::getDBO();
$qr="update #__ecard_view set count=count+1 where id='".$this->xid."'";
$db->setQuery($qr);
$result = $db->execute();





	include ( JPATH_BASE .DS.'components'.DS.'com_odudecard'.DS.'template'.DS.$temp.DS.$temp.'.pick.tpl.php' );

  }
  
      

		if($this->notify=="Y")
		{
		
		$from = $this->from_email;
		$fromname = $this->from_name;
		$recipient = $this->SE;
		$subject = $this->msgsuffix.': '.JText::_('COM_ODUDECARD_ECARD_PICKEDUP'). ' '.$this->RN;
		
			$u = JURI::getInstance();	
			
		$db = JFactory::getDBO();
		$qr="update #__ecard_view set notify='N' where id='".$this->xid."'";
		$db->setQuery($qr);
		$result = $db->execute();
		
	$linc=$u->getScheme()."://".$u->getHost().JRoute::_("index.php?option=com_odudecard&amp;xid=".$this->xid."&amp;notify=N&amp;controller=cardpick&amp;Itemid=".$mymenuitem."&amp;cate=".$this->cat);

		
		$mode = 1;
$body = JText::_('COM_ODUDECARD_ECARD_HELLO').",<br><br>".JText::_('COM_ODUDECARD_ECARD_PICKEDUP')." ".$this->RN.".<br><br>".JText::_('COM_ODUDECARD_ECARD_CLICK_LINK')."<br><br><a href=".$linc.">".$linc."</a><br><br>".JText::_('COM_ODUDECARD_ECARD_THANK')."<br>$fromname";

   $mailer = JFactory::getMailer();
           $config = JFactory::getConfig();
           $sender = array($from,$fromname);
           $mailer->setSender($sender);
           $mailer->addRecipient($recipient);
           $mailer->setSubject($subject);
           $mailer->setBody($body);
           $mailer->isHTML(true);
           
           try
           {
           $send = $mailer->Send();
           }
           catch (Exception $e)
           {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
           }
        //JUtility::sendMail($from, $fromname, $recipient, $subject, $body, $mode,'','','','', '');

        JError::raiseNotice( 100, JText::_(JText::_('COM_ODUDECARD_ECARD_NOTIFIED')) );




		}




  
  }
?>


<?php
echo "<a href=".JRoute::_("index.php?option=com_odudecard&Itemid=$mymenuitem")." class=\"ODude\" >".JText::_('COM_ODUDECARD_ECARD_NEW')."</a><br><br>";


if($this->v=='o')
{
 if(  $params->get( 'show_create' )=='1')
    {
 ?>   
  <a href="<?php echo JRoute::_('index.php?option=com_odudecard&controller=create_ecard&Itemid='.$mymenuitem.'&cate='.$this->cat); ?>" class="ODude"><?php echo $this->cate_name." : ".JText::_('COM_ODUDECARD_ECARD_CREATE_CARD'); ?></a> 

  <?php
}
?>

<?php
 if(  $params->get( 'show_tube' )=='1')
    {
 ?>   
  <a href="<?php echo JRoute::_('index.php?option=com_odudecard&controller=create_youtube&Itemid='.$mymenuitem.'&cate='.$this->cat); ?>" class="ODude"><?php echo $this->cate_name." : ".JText::_('COM_ODUDECARD_ECARD_CREATE_TUBE'); ?></a>
  
  <?php
}
?>

<?php
 if(  $params->get( 'show_video' )=='1')
    {
 ?>   
  <a href="<?php echo JRoute::_('index.php?option=com_odudecard&controller=create_video&Itemid='.$mymenuitem.'&cate='.$this->cat); ?>" class="ODude"><?php echo $this->cate_name." : ".JText::_('COM_ODUDECARD_ECARD_CREATE_VIDEO'); ?></a>

  <?php
}
}
?>
