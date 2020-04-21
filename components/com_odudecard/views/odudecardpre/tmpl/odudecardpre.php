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
//jimport('joomla.html.parameter');
$doc =JFactory::getDocument();
$doc->setMetaData( 'generator', 'ODude.com Ecard System' );

JHTML::_('behavior.formvalidation');
//JHTML::_('behavior.calendar');
//jimport( 'joomla.html.html' );
//JHtml::_('bootstrap.framework');
  //JHtml::_('jquery.framework');
//JHtml::script('components/com_odudecard/template/zebra_datepicker.js');
//$doc->addStyleSheet('components/com_odudecard/template/default.css');





require_once ( JPATH_BASE .DS.'components'.DS.'com_odudecard'.DS.'include'.DS.'recaptchalib.php' );
require_once ( JPATH_BASE .DS.'components'.DS.'com_odudecard'.DS.'include'.DS.'lib.php' );
$setting=getSetting();
$mymenuitem = JRequest::getVar('Itemid', 0, 'request', 'int');
 $version = new JVersion;
$joomla = $version->getShortVersion();
$temp=$this->a2;
$doc->addStyleSheet('components/com_odudecard/template/'.$temp.'/'.$temp.'.css');
$doc->addStyleSheet('components/com_odudecard/template/pure-min.css');
$doc->addStyleSheet('components/com_odudecard/template/grids-responsive-min.css');
$body=JRequest::getVar('body', '', 'request');
$SN=JRequest::getVar('SN', '', 'request');
$SE=JRequest::getVar('SE', '', 'request');
$sub=JRequest::getVar('title', '', 'request');
$name = JRequest::getVar('name', '', 'request');
$email = JRequest::getVar('email', '', 'request');

$sec_check='fail';
$response = null;
/*
if($setting->captcha!='0')
if(isset($_COOKIE['captcha']))
if($_COOKIE['captcha']==$this->captcha)
$sec_check='pass';
*/
if($setting->captcha=='1')
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
}
  if ($response != null && $response->success) 
  {
    $sec_check='pass';
	$_SESSION["security"] = "ok";	
  } 
  else 
  {
	 $sec_check='fail';
  }

if($setting->captcha=='0')
{
$sec_check='pass';
$_SESSION["security"] = "ok";	
}
?>  


  <style type="text/css">
.box {
	background-image: url(<?php echo JURI::root() ?>media/ecard/<?php echo $this->cate_bg ?>);
	width:100%;
}

</style>



<?php 
	$iid=JRequest::getVar('id', '0');
	$media_id=getSpecificId($iid,'media');
	
	include ( JPATH_BASE .DS.'components'.DS.'com_odudecard'.DS.'template'.DS.$temp.DS.$temp.'.top.tpl.php' );
	
          if($setting->import!='0')
		  {
          $recipients= JRequest::getVar('recipients', '', 'post', 'string', JREQUEST_ALLOWRAW);
          }
          else
          {
           $recipients= "";
          }
          if($setting->add_rec!='0')
		  {
          $rec_no=$_POST["rec_no"];
          }
          else
          {
          $rec_no=1;
          }
if($rec_no>10)
$rec_no=10;

if($sec_check=='pass')
{
$user = JFactory::getUser();
  if($user->name || $setting->member_restrict!=1)
  {
  
include ( JPATH_BASE .DS.'components'.DS.'com_odudecard'.DS.'template'.DS.$temp.DS.$temp.'.preview.tpl.php' );
}
else
{
//JError::raiseWarning( 100, JText::_('COM_ODUDECARD_ECARD_LOGIN') );
//JError::raiseNotice( 100, JText::_('COM_ODUDECARD_ECARD_REG') );

$cid=JRequest::getVar('id', 0, 'request', 'int');
      //Redirect*****
if(substr($joomla,0,3) == '1.5')
{
$return = JRoute::_('index.php?option=com_odudecard&id='.$cid.'&controller=card_show&Itemid='.$mymenuitem.'&cate='.$this->cate_name);
$url    = 'index.php?option=com_user&view=login';
$url   .= '&return='.base64_encode($return);
      JFactory::getApplication()->redirect($url, JText::_('COM_ODUDECARD_ECARD_REG')); 
}
else
{
$return = JRoute::_('index.php?option=com_odudecard&id='.$cid.'&controller=card_show&Itemid='.$mymenuitem.'&cate='.$this->cate_name);
$url    = 'index.php?option=com_users&view=login';
$url   .= '&return='.base64_encode($return);
      JFactory::getApplication()->redirect($url, JText::_('COM_ODUDECARD_ECARD_REG')); 
}      
//Redirect*****END 

}
}
else
{
JError::raiseWarning( 100, JText::_('COM_ODUDECARD_CAPTCHA_INVALID') );
?> 
<form method="post" action="<?php echo JRoute::_("index.php?option=com_odudecard&amp;controller=cardpreview&amp;Itemid=$mymenuitem");?>" id='myForm' class="form-validate" onSubmit="return myValidate(this);">
  <center>
<?php
    if($this->type=='Y')
    echo '<img src="http://img.youtube.com/vi/'.$this->thumb.'/1.jpg" hspace="2" vspace="2" border="1" id=card2 />';
    else
    echo  '<img src="'.JURI::base().'media/ecard/'.$this->thumb.'" hspace="2" vspace="2" border="1" id=card2 />';
    
        ?>
  </center>


 <div class="g-recaptcha" data-sitekey="<?php echo $setting->captcha_key; ?>"></div>
		<script src='https://www.google.com/recaptcha/api.js'></script>
       
  <br>   
  <input name="effect1" type="hidden" id="effect1" value="<?php echo $this->effect;  ?>" />        
  <input name="rec_no" type="hidden" id="rec_no" value="<?php echo $rec_no;  ?>" />        
  <input name="image" type="hidden" id="image" value="<?php echo $this->image;  ?>" />           
  <input name="thumb" type="hidden" id="thumb" value="<?php echo $this->thumb;  ?>" />         
  <input name="cate" type="hidden" id="cate" value="<?php echo $this->cate;  ?>" />         
  <input name="id" type="hidden" id="id" value="<?php echo JRequest::getVar('id', '0');  ?>" />        
  <input name="title" type="hidden" id="title" value="<?php echo $this->title;  ?>" /> 
  <input name="eorm" type="hidden" id="eorm" value="<?php echo $this->eorm;  ?>" />           
  <input name="send" type="hidden" id="send" value="normal" />        
  <BR>
  <input type="submit" name="button2" id="button2" value="<?php echo JText::_('COM_ODUDECARD_ECARD_SEND_ECARD'); ?>" />        
  <BR> 
<TEXTAREA id="recipient_list" name="recipients" style="visibility: hidden"><?php echo $recipients;  ?>
</textarea>   
</form>
<?php
}
?>