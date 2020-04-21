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


$doc = JFactory::getDocument();
 $app= JFactory::getApplication();
 $params = $app->getParams();
 $opt=$params->def('list', '');
 if($opt=='')
 $opt="all";

$doc->setMetaData( 'generator', 'ODude.com Ecard System' );

require_once ( JPATH_BASE .DS.'components'.DS.'com_odudecard'.DS.'include'.DS.'lib.php' );
$setting=getSetting();
$Itemid = JRequest::getVar('Itemid', 0, 'request', 'int');
$mainframe = JFactory::getApplication();

$db =JFactory::getDBO();

//Deleting expired cards
$del="delete FROM #__ecard_view WHERE clock <=date_sub(curdate(),interval ".$setting->expire." day)";
$db->setQuery($del);
$deleted = $db->execute();

$query="SELECT #__ecard_view.*,#__ecard_media.cat FROM `#__ecard_view`,#__ecard_media where #__ecard_view.card=#__ecard_media.id and status='N' and clock<=CURRENT_DATE limit 0,100";
$db->setQuery($query);
$rows = $db -> loadObjectList();
		for( $i=0; $i<count($rows); $i++ )
		{
			$view = $rows[$i];
		
		$id=$view->id;
		$SN=$view->SN;
		$SE=$view->SE;
		$RN=$view->RN;
		$RE=$view->RE;
		$sub=$view->sub;
		$clock=$view->clock;
		$notify=$view->notify;
		$cat=$view->cat;


		
		$qr="update #__ecard_view set status='Y' where id='$id'";
		$db->setQuery($qr);
		$result = $db->execute();

		$from = $setting->from_email;
		$fromname = $SN;
		$recipient = $RE;
		$subject = $setting->subject_suffix.': '.$sub;
		$replyto = $SE;
		$replytoname = $SN;

$u = JURI::getInstance();					
		
$linc=$u->getScheme()."://".$u->getHost().JRoute::_("index.php?option=com_odudecard&amp;xid=$id&amp;controller=cardpick&amp;notify=$notify&amp;cate=$cat");

$body = JText::_('COM_ODUDECARD_ECARD_HELLO')." $RN,<br><br>".JText::_('COM_ODUDECARD_ECARD_I_HAVE')."<br>".JText::_('COM_ODUDECARD_ECARD_PICK')."<br><br><a href=".$linc.">".$linc."</a><br><br>".JText::_('COM_ODUDECARD_ECARD_EXPIRE')." <B>".$setting->expire."</B> ".JText::_('COM_ODUDECARD_ECARD_DAYS').".<br><br>".JText::_('COM_ODUDECARD_ECARD_THANK')."<br>$SN";
$mode = 1;
//echo $body;
//JUtility::sendMail($from, $fromname, $recipient, $subject, $body, $mode,'','','',$replyto, $replytoname);
$mailer = JFactory::getMailer();
           $config = JFactory::getConfig();
           $sender = array($from,$fromname);
           $mailer->setSender($sender);
           $mailer->addRecipient($recipient);
		   $mailer->addReplyTo( array( $replyto, $replytoname ) );
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




		}




			ob_start();
			header("Location: ".JRoute::_('index.php?option=com_odudecard&controller=card_list&Itemid='.$Itemid.'&cate='.$this->cat_alias.'&opt='.$opt));
			ob_flush();
			


?>