<?php 

/**

* @package   JE Ecard

* @copyright Copyright (C) 2009 - 2010 Open Source Matters. All rights reserved.

* @license   http://www.gnu.org/licenses/lgpl.html GNU/LGPL, see LICENSE.php

* Contact to : emailtohardik@gmail.com, joomextensions@gmail.com

* Visit : http://www.joomlaextensions.co.in/

**/

defined('_JEXEC') or die('Restricted access');

//session_start();

$user =  clone(JFactory::getUser());

$user 	= JFactory::getUser();
$option = JRequest::getWord('option','','request','string');
$lower = JRequest::getVar( 'lower', '0','request','int');
$Itemid = JRequest::getVar( 'Itemid', '0','request','int');
$higher = JRequest::getVar( 'higher','2000','request','int');
$price = JRequest::getVar( 'price', $lower.';'.$higher);	 
JHTML::_('behavior.calendar');
 $send_id = JRequest::getVar('send_id','','request','int');
$uri 	= JFactory::getURI();
$url	= $uri->root();
//$link	=JRoute::_($link);	
$document =JFactory::getDocument();
$img_path	= $url.'/components/'.$option.'/assets/images/';
/*$document->addScript('components/'.$option.'/assets/javascript/validation.js' );
$photo_link = $url.'components/'.$option.'/assets/images/';
$photo_links = $url.'components/'.$option.'/assets/img/';
$document->addStyleSheet('components/'.$option.'/assets/css/listing.css' );
$document->addStyleSheet('components/'.$option.'/assets/css/page2-datauri.css' );*/
$model = $this->getModel ( 'mailreply' );
$myview = $model->getmyevent();
$myyes = $model->getmyyes();
$mymaybe = $model->getmymaybe();
$myno = $model->getmyno();

$myower = $model->getmycommet();

$myuser = $model->mygetuser();
?><style type="text/css">
.dib_bg {

height:<?php echo $myview->height; ?>px;
	width:<?php echo $myview->width; ?>px;
	margin:0 auto;
background:url(<?php echo $img_path.$myview->b_image;
?>);
}
</style>
<script type="text/javascript" language="javascript">
function myall_yes(){
var yes = document.getElementById("yes");
		if(yes.style.display=='block'){
				yes.style.display='none';
		}
		else{
				yes.style.display='block';
		}

}
function myall_maybe(){
var maybe = document.getElementById("maybe");
if(maybe.style.display=='block'){
				maybe.style.display='none';
		}
		else{
				maybe.style.display='block';
		}

}
function myall_no(){
var no = document.getElementById("no");
if(no.style.display=='block'){
				no.style.display='none';
		}
		else{
				no.style.display='block';
		}
}

</script>
<form action="<?php echo  JRoute::_('index.php?option='.$option); ?>" method="post" name="mailfrom"  enctype="multipart/form-data">
    <table align="center" width="100%" border="1"><tr><td>
    <div class="dib_bg">
  <?php 
   $mydata = $myview->description; 
        $mydata=str_replace('{title}',$myview->event_title,$mydata);
        $mydata=str_replace('{name}',$myview->host,$mydata);
		$mydata	= str_replace('{time}',$myview->event_time,$mydata);
        $mydata=str_replace('{phone}',$myview->phone,$mydata);
        $mydata=str_replace('{location}',$myview->location_name,$mydata);
        $mydata=str_replace('{address}',$myview->address,$mydata);
        $mydata=str_replace('{city}',$myview->city,$mydata);
        $mydata=str_replace('{state}','',$mydata);
        $mydata=str_replace('{date}',$myview->date,$mydata);
        ?>
</div></td></tr></table>

<?php if($myview->hideguest == '0'){ ?>
<table width="50%">
<tr><td><a href="Javascript:void(0);" onclick="myall_yes();"><?php echo JText::_('E_YES')?></a></td><td><?php echo count($myyes); ?></td></tr>
<tr><td>

<div id="yes" style="display:none;">
<?php for($p=0;$p<count($myyes);$p++){  $mytotal = explode("@",$myyes[$p]->email);
?><table><tr><td><?php echo  $mytotal[0];  ?></td></tr></table><?php } ?>
</div>
</td></tr>
<tr><td><a href="Javascript:void(0);" onclick="myall_maybe();"><?php echo JText::_('E_MAYBE')?></a></td><td><?php echo count($mymaybe); ?></td></tr>
<tr><td>

<div id="maybe" style="display:none;">
<?php for($m=0;$m<count($mymaybe);$m++){  $mytotal1 = explode("@",$mymaybe[$m]->email);
?><table><tr><td><?php  echo  $mytotal1[0];  ?></td></tr></table><?php } ?>
</div>
</td></tr>
<tr><td><a href="Javascript:void(0);" onclick="myall_no();"><?php echo JText::_('E_NO')?></a></td><td><?php echo count($myno); ?></td></tr>
<tr><td>

<div id="no" style="display:none;">
<?php for($p2=0;$p2<count($myno);$p2++){  $mytotal2 = explode("@",$myno[$p2]->email);
?><table><tr><td><?php echo  $mytotal2[0];  ?></td></tr></table><?php } ?>
</div>
</td></tr>
</table> <?php  }?>
<table cellpadding="5" width="72%"  cellspacing="5">
<?php if($myview->message){ ?>
<tr><td colspan="4"><?php echo JText::_('MESSAGE_FORM_HOST'); ?></td></tr>
<tr><td colspan="4"><?php echo $myview->message; ?></td></tr> <?php }?>
	<tr>
		<td valign="top" width="25%"><h3><?php echo JText::_('WILL_U_ATTEND'); ?></h3></td>
         <td  valign="top" width="25%"><h3><?php echo JText::_('MYES'); ?></h3></td>
        <td valign="top" width="25%"><h3><?php echo JText::_('MAYBE'); ?></h3></td>
        <td valign="top" ><h3><?php echo JText::_('MNO'); ?></h3></td></tr>
   </tr>
   <?php 
	
   for($q=0;$q<count($this->detail);$q++){ ?>
   <tr> <?php  $name_con =  explode("@",$this->detail[$q]->email); ?>
   			<td><?php  echo $name_con[0]; ?></td>
            <td><?php echo $this->detail[$q]->comment; ?></td>
   </tr>
   
   
   
   <?php }
    ?>
   
   <tr><td colspan="1" valign="top"><?php echo JText::_('COMMENT'); ?></td><td colspan="3"><textarea name="comment" cols="25"  rows="4"id="comment"></textarea></td></tr>
	 <tr><td colspan="4"><input type="submit" name="Reply" id="Reply" value="<?php echo JText::_('REPLAY')?>" /></td></tr>


</table>
<input type="hidden"  name="eventtitle" id="eventtitle" value="<?php echo $myower->event_title; ?>" />
	<input type="hidden"  name="email1" id="email1" value="<?php echo $myuser->email; ?>" />
	 <input type="hidden"  name="email" id="email" value="<?php echo $myower->email; ?>" />
	 <input type="hidden"  name="comment1" id="comment1" value="<?php echo $myview->comment; ?>" />
	<input type="hidden"  name="Itemid" id="Itemid" value="<?php echo $Itemid; ?>" />
    <input type="hidden"  name="send_id" id="send_id" value="<?php echo $send_id; ?>" />
    <input type="hidden"  name="current_div" id="current_div" value="0" />
    <input type="hidden"  name="jelive_url" id="jelive_url" value="<?php echo $url; ?>" />
  <!--  <input type="hidden" name="userid" value="<?php // echo $user_id->id;?>" />-->
    <input type="hidden" name="view" value="mailreply" />
    <input type="hidden" name="task" value="save" />
    <?php echo JHTML::_( 'form.token' ); ?>
  </form>

