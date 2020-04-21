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
$doc =JFactory::getDocument();

		require_once ( JPATH_BASE .DS.'components'.DS.'com_odudecard'.DS.'include'.DS.'recaptchalib.php' );
		require_once ( JPATH_BASE .DS.'components'.DS.'com_odudecard'.DS.'include'.DS.'lib.php' );
		//jimport('joomla.html.parameter');
		$setting=getSetting();
		$mymenuitem = JRequest::getVar('Itemid', 0, 'request', 'int');
		$params  = JComponentHelper::getParams('com_odudecard');
		$q_id = JRequest::getVar('id', '0');
		$id=getSpecificId($q_id,'media');
		$SN=JRequest::getVar('SN', 0, 'request');
		$SE=JRequest::getVar('SE', 0, 'request');
		$body=JRequest::getVar('body', 0, 'request');
		$sub=JRequest::getVar('title', 0, 'request');
			//$body=cleanuserinput(JRequest::getVar('body', 0, 'request'));
		//$sub=cleanuserinput(JRequest::getVar('title', 0, 'request'));
		$name = JRequest::getVar('name', 0, 'request');
		
		
		$email = JRequest::getVar('email', 0, 'request');
		$q_cate = JRequest::getVar('cate', '0');
			$cate=getSpecificId($q_cate,'cate'); 
		$clock = JRequest::getVar('date1', 0, 'request');
		$send = JRequest::getVar('send', 0, 'request');
		$notify = JRequest::getVar('notify', 0, 'request');
		$point = JRequest::getVar('point', 0, 'request');
		$eorm = JRequest::getVar('eorm', 0, 'request');
		$recipients= JRequest::getVar('recipients', '', 'post', 'string', JREQUEST_ALLOWRAW);
		if($notify!='Y')
		$notify='N';
		$button = JRequest::getVar('button', 0, 'request');
		$temp=JRequest::getVar('temp', 0, 'request');


$sec_check='fail';

if(isset($_SESSION["security"]))
	if($_SESSION["security"]=='ok')
	$sec_check='pass';

if($sec_check!='pass')
{
// your secret key
$secret = $setting->captcha_secret;
 // empty response
$response = null;
 // check secret key
$reCaptcha = new ReCaptcha($secret);


// if submitted check response
	if(isset($_POST["g-recaptcha-response"]))
	if ($_POST["g-recaptcha-response"]) 
	{
		$response = $reCaptcha->verifyResponse(
			$_SERVER["REMOTE_ADDR"],
			$_POST["g-recaptcha-response"]
		);
	}

  if ($response != null && $response->success) 
  {
    $sec_check='pass';
  } 
  else 
  {
	 $sec_check='fail';
  }
}
  
  
if($setting->captcha=='0')
$sec_check='pass';


if($sec_check=='pass')
{

?>
<style>
table.fancy {
  margin: 1em 1em 1em 0;
  background: #F5F5F5;
  border-collapse: collapse;
}
table.fancy tr:hover {
   background: #DDEEFF !important;
}
table.fancy th, table.fancy td {
  border: 1px silver solid;
  padding: 0.2em;
}
table.fancy th {
  background: gainsboro;
  text-align: left;
}
table.fancy caption {
  margin-left: inherit;
  margin-right: inherit;
}

</style>
<?php


                          

  		$doc->addStyleSheet('components/com_odudecard/template/'.$temp.'/'.$temp.'.css');
		$doc->addStyleSheet('components/com_odudecard/template/pure-min.css');
		$doc->addStyleSheet('components/com_odudecard/template/grids-responsive-min.css');

		$tab="";

				$model = $this->getModel();
     	         $ecardS = $model->getSetting();


			$x=0;
			if(!preg_match('/([a-zA-z0-9\.\-]+)@([a-zA-Z0-9\.\-]+)\.([a-zA-Z]{2,3})/',$SE))
			{
				echo JText::_('COM_ODUDECARD_ECARD_SENDER_EMAIL_ERROR').": $SE<br>";
				$x++;
			}
			if($SN==null || $SN=="")
			{
				echo JText::_('COM_ODUDECARD_ECARD_SENDER_BLANK')."<br>";
				$x++;
			}
			if($x==0)
			{
				
				if($button==JText::_('COM_ODUDECARD_ECARD_SEND_ECARD_PREVIEW'))
				{
				$catid=getCategoryDetail($cate);
				//print_r($catid);
				$cardid=getCard($id);
				//print_r($cardid);
				$rec_no=JRequest::getVar('rec_no', 1, 'request');
				include ( JPATH_BASE .DS.'components'.DS.'com_odudecard'.DS.'template'.DS.$temp.DS.$temp.'.pick_pre.tpl.php' );
				?>
				 <form id='myForm' action="<?php echo JRoute::_("index.php?option=com_odudecard&amp;controller=cardsend&amp;Itemid=$mymenuitem");?>" method="post"> 
				<?php
					foreach($_POST as $key=>$value)
					{
					if ($key=='name' || $key=='email')
					{
					echo "";

					}
					else
					{
					echo "<input type='hidden' name='{$key}' value='{$value}'>\n\r";
					}
					
					
					}
					for ($i=0; $i<count($name); $i++)
								{
									//echo $name[$i]."--".$email[$i]."<br>";
									echo "<input type='hidden' name='name[]' value='".$name[$i]."'>\n\r";
									echo "<input type='hidden' name='email[]' value='".$email[$i]."'>\n\r";
								}
								
					?>				
				<input type="submit" name="button" id="button" value="<?php echo JText::_('COM_ODUDECARD_ECARD_SEND_ECARD'); ?>" class="pure-button pure-input-1-2 pure-button-primary"/> 
				</form> 
				<form method="post" action="<?php echo JRoute::_("index.php?option=com_odudecard&amp;controller=cardpreview&amp;Itemid=$mymenuitem");?>" id='myForm'>
				<?php
					foreach($_POST as $key=>$value)
					{
					if ($key=='name' || $key=='email')
					{
					echo "";

					}
					else
					{
					echo "<input type='hidden' name='{$key}' value='{$value}'>\n\r";
					}
					
					
					}
					for ($i=0; $i<count($name); $i++)
								{
									//echo $name[$i]."--".$email[$i]."<br>";
									echo "<input type='hidden' name='name[]' value='".$name[$i]."'>\n\r";
									echo "<input type='hidden' name='email[]' value='".$email[$i]."'>\n\r";
								}
								
					//session_start();
					$_SESSION["security"] = "ok";					
				?>	
					
				
				<input type="submit" name="back" id="back" value="<?php echo JText::_('COM_ODUDECARD_ECARD_MODIFY'); ?>" class="pure-button pure-input-1-2 pure-button-primary" onClick="history.go(-1)"/> 
				</form>
				<?php  
						
				}
				else
				{
				//$dispatcher = JDispatcher::getInstance();

  
  
                    echo "<center><h1>".JText::_('COM_ODUDECARD_ECARD_SENT')."</h1> <strong>".JText::_('COM_ODUDECARD_ECARD_CHECK_STATUS')."</strong><br><table border=0 width=99% class=fancy>";
					 if($eorm==1)
					 {
					 
                	 if($setting->point==1 )
                  {
                  
					  if($point!=0)
					  {
					  $user = JFactory::getUser();
					  
					  //$trs=$dispatcher->trigger('doProfilePoint', array($user->username,'admin',$point,JText::_('COM_ODUDECARD_ECARD')."-".$id,0));
					   $msg="Greetings Card Sent";
					   require_once( JPATH_ADMINISTRATOR . '/components/com_easysocial/includes/foundry.php' );
					 // Foundry::points()->assign( 'odudecard.jpeg' , 'com_odudecard' , $user->id);
					 Foundry::points()->assignCustom($user->id, -$point, $message = $msg);
					  
					  echo "<br><b> $point</b> Spent.<br>";
					  
					  }
                  }
                					 
					 
          
          echo "<tr align=left><th>".JText::_('COM_ODUDECARD_ECARD_SNO')."</th><th>&nbsp;</th><th>".JText::_('COM_ODUDECARD_ECARD_STATUS')."</th></tr>";

                    for ($i=0; $i<count($name); $i++)
					{

                  //  echo "<h1>".$clock."</h1>";

                    	$status="";

						if(!preg_match('/([a-zA-z0-9\.\-]+)@([a-zA-Z0-9\.\-]+)\.([a-zA-Z]{2,3})/',$email[$i]))
						$status="<b><font color=red>X</font></b>";
						else
						$status="<b>O</b>";


                        if(!preg_match('/([a-zA-z0-9\.\-]+)@([a-zA-Z0-9\.\-]+)\.([a-zA-Z]{2,3})/',$email[$i]))
						$st="<img src=\"".JURI::base()."components/com_odudecard/include/cross.png\">";
						else
            $st="<img src=\"".JURI::base()."components/com_odudecard/include/tick.png\"> $clock";

						$a=$i+1;

						if($email==null)
						{
						echo "<tr><td color=#FFFFCC size=2 align=left><b>".$a."</b></td><td align=left>".JText::_('COM_ODUDECARD_ECARD_REC')." : ".$name[$i]." <br>".JText::_('COM_ODUDECARD_ECARD_REC_EMAIL').": ".$email[$i]."&nbsp;</td><td><b><font color=red>X</font></b></td></tr>";
						}
						else
						{


						echo "<tr><td color=#FFFFCC size=2 align=left width=5%><b>".$a."</b></td><td align=left>".JText::_('COM_ODUDECARD_ECARD_REC')." : ".$name[$i]." <br>".JText::_('COM_ODUDECARD_ECARD_REC_EMAIL').": ".$email[$i]."&nbsp;</td><td align=center> &nbsp;";


                        //$dispatcher->trigger('getProfilePic', array('email',$email[$i],'icon' ));

                        echo "<br>$st</td></tr>";

                       //  echo "<h1>Checking Status</h1>";
                        	if($status=="<b>O</b>")
							{
								  // echo "<h1>Status found to be O </h1>";

							if(preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/', $clock))
							{
						//	 echo "<h1>found it will be sent on specified time $clock ... </h1>";
							//$clock = $_POST['date1'];
							$xid=time()+$a;
							$db = JFactory::getDBO();
							//$query =  "insert into #__ecard_view values('$xid','$SN','$SE','".cleanuserinput($name[$i])."','$email[$i]','$clock','$sub','$body','$notify','N','$id')";
							$query =  "insert into #__ecard_view values('$xid','$SN','$SE','".$name[$i]."','$email[$i]','$clock','$sub','$body','$notify','N','$id','',0,'')";
							$db->setQuery($query);
							$result = $db->execute();
		                      //echo "<b>Cron = $query </b>";
							}
							else
							{
                                        /// echo "<h1>ready to send card $i ".time()."".$a."</h1>";


                           
                            	$clock1=JFactory::getDate()->Format('Y-m-d');
								$xid=time()+$a;
								$db =JFactory::getDBO();
								//$query =  "insert into #__ecard_view values('$xid','$SN','$SE','".cleanuserinput($name[$i])."','$email[$i]','$clock1','$sub','$body','$notify','Y','$id')";
								$query =  "insert into #__ecard_view values('$xid','$SN','$SE','".$name[$i]."','$email[$i]','$clock1','$sub','$body','$notify','Y','$id','',0,'')";
								$db->setQuery($query);
								$result = $db->execute();
								//echo $query."<br>";
								$from = $ecardS['from_email'];
								$fromname = $SN;
								$recipient = $email[$i];
								$subject = $ecardS['subject_suffix']." ".$sub;
								$replyto = $SE;
								$replytoname = $SN;


								$u = JURI::getInstance();
								//$linc=$u->getScheme()."://".$u->getHost().JRoute::_("index.php?option=com_odudecard&amp;xid=$xid&amp;controller=cardpick&amp;notify=$notify&amp;cate=$cate&amp;Itemid=$mymenuitem&amp;tmpl=component");
								$linc=$u->getScheme()."://".$u->getHost().JRoute::_("index.php?option=com_odudecard&amp;xid=$xid&amp;controller=cardpick&amp;notify=$notify&amp;cate=$cate&amp;Itemid=$mymenuitem");
								$body1 = JText::_('COM_ODUDECARD_ECARD_HELLO')." $name[$i],<br><br>".JText::_('COM_ODUDECARD_ECARD_I_HAVE')."<br>".JText::_('COM_ODUDECARD_ECARD_PICK')."<br><br><a href=".$linc.">".$linc."</a><br><br>".JText::_('COM_ODUDECARD_ECARD_EXPIRE')." <B>".$setting->expire."</B> ".JText::_('COM_ODUDECARD_ECARD_DAYS').".<br><br>".JText::_('COM_ODUDECARD_ECARD_THANK')."<br>$SN";
                
               $mode = 1;
							//echo "<b>$body1 </b>";
								//echo $linc."<hr>";

								//JUtility::sendMail($from, $fromname, $recipient, $subject, $body1, $mode,'','','',$replyto, $replytoname);
           
           $mailer = JFactory::getMailer();
           $config = JFactory::getConfig();
           $sender = array($from,$fromname);
           $mailer->setSender($sender);
           $mailer->addRecipient($recipient);
		   $mailer->addReplyTo( array( $replyto, $replytoname ) );
		   
		   
		   
		   
		   
           $mailer->setSubject($subject);
           $mailer->setBody($body1);
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

							}

						}
					}
          }
          else
          {
          //******************
          
          //Send ecard if it is not sent to email address
          
          //******************
          }

					echo "</table></center><br><img src=\"components/com_odudecard/include/tick.png\"> = ".JText::_('COM_ODUDECARD_ECARD_OK_MSG')."<br><img src=\"components/com_odudecard/include/cross.png\"> = ".JText::_('COM_ODUDECARD_ECARD_X')."<br><br><br><br><a href=".JRoute::_("index.php?option=com_odudecard&Itemid=$mymenuitem&opt=all")." class=\"css_button_example\" style=\"clear:none;\"><strong>".JText::_('COM_ODUDECARD_ECARD_NEW')."</strong></a>";
			}

			}
			else
			{
				echo "<br>".JText::_('COM_ODUDECARD_ECARD_CANNOT')." <a href=javascript:history.back() class=\"css_button_example\" style=\"clear:none;\" >".JText::_('COM_ODUDECARD_ECARD_BACK')."</a>";


			}

echo $tab;

}
else
{
		//security reasking for captcha
	JError::raiseWarning( 100, JText::_('COM_ODUDECARD_CAPTCHA_INVALID') );
 $catid=getCategoryDetail($cate);
				//print_r($catid);
				$cardid=getCard($id);
				//print_r($cardid);
				$rec_no=JRequest::getVar('rec_no', 1, 'request');
				
 ?>
 <form id='myForm' action="<?php echo JRoute::_("index.php?option=com_odudecard&amp;controller=cardsend&amp;Itemid=$mymenuitem");?>" method="post">
			<?php
					foreach($_POST as $key=>$value)
					{
					if ($key=='name' || $key=='email')
					{
					echo "";

					}
					else
					{
					echo "<input type='hidden' name='{$key}' value='{$value}'>\n\r";
					}
					
					
					}
					for ($i=0; $i<count($name); $i++)
								{
									//echo $name[$i]."--".$email[$i]."<br>";
									echo "<input type='hidden' name='name[]' value='".$name[$i]."'>\n\r";
									echo "<input type='hidden' name='email[]' value='".$email[$i]."'>\n\r";
								}
						include ( JPATH_BASE .DS.'components'.DS.'com_odudecard'.DS.'template'.DS.$temp.DS.$temp.'.captcha.tpl.php' );		
					?>				
				<input type="submit" name="button" id="button" value="<?php echo JText::_('COM_ODUDECARD_ECARD_SEND_ECARD'); ?>" class="pure-button pure-input-1-2 pure-button-primary"/> 
				</form>  
		
		<?php
}
?>
