<?php 

/**

* @package    JE Ecard

* @copyright Copyright (C) 2009 - 2010 Open Source Matters. All rights reserved.

* @license   http://www.gnu.org/licenses/lgpl.html GNU/LGPL, see LICENSE.php

* Contact to : emailtohardik@gmail.com, joomextensions@gmail.com

* Visit : http://www.joomlaextensions.co.in/

**/

defined('_JEXEC') or die('Restricted access');

//session_start();

$userid =  clone(JFactory::getUser());

$user 	= JFactory::getUser();
$option = JRequest::getWord('option','','request','string');
 $err = JRequest::getVar('err','','','int');
JHTML::_('behavior.calendar');

$tp = JRequest::getVar('tp','','','string');
$uri 	= JFactory::getURI();
$url	= $uri->root();
//$link	=JRoute::_($link);	
$document =JFactory::getDocument();

$document->addScript('components/'.$option.'/assets/js/ajax1.js' );
$document->addScript('components/'.$option.'/assets/js/validation.js' );
$separetor = $url.'components/'.$option.'/assets/img/';
?>



<script type="text/javascript" language="javascript">

var fname_alert 		= "<?php echo JText::_('PLEASE_ENTER_FIRST_NAME');?>";
var lname_alert 		= "<?php echo JText::_('PLEASE_ENTER_LAST_NAME');?>";
var email_alert 		= "<?php echo JText::_('PLEASE_ENTER_EMAIL');?>";
var valid_email 		= "<?php echo JText::_('PLEASE_ENTER_VALID_EMAIL');?>";
var pass_alert			= "<?php echo JText::_('PLEASE_ENTER_PASSWORD');?>";
var valid_pass_alert	= "<?php echo JText::_('PLEASE_ENTER_ATLEAST_6_CHAR');?>";
var con_email_alert		= "<?php echo JText::_('PLEASE_ENTER_CONFIRM_EMAIL');?>";
var genter_alert    	= "<?php echo JText::_('PLEASE_SELECT_GENDER');?>";
</script>



<form action="<?php echo  JRoute::_('index.php?option='.$option); ?>" method="post" name="registerform"  id="registerform" enctype="multipart/form-data" class="">
<h3><?php  echo JText::_("REGISTRATION"); ?></h3>
	 <table  width="100%" cellpadding="5" cellspacing="5" class="htmlForm" border="0">
		
	  <tr>
      	  <td width="250"><label for="name"><strong> <?php echo JText::_( 'FULL_NAME' ); ?>*</strong> </label></td>
       		 <td ><input class="inputbox required" type="text" name="fname" id="fname" size="30" maxlength="50" value="<?php if($err==1){
			  	 echo $_SESSION['fname']; }else{  echo $this->detail->fname;} 
		?>" /><span id="flname_span" class="flname_span"></span></td>
      </tr>
        <tr>
      	  <td><label for="name"> <strong><?php echo JText::_( 'LAST_NAME' ); ?>*</strong> </label></td>
       		 <td ><input class="inputbox required" type="text" name="lname" id="lname" size="30" maxlength="50" value="<?php if($err==1){if(isset($_SESSION['lname'])){ echo $_SESSION['lname']; } }else{  echo $this->detail->lname;}
		?>" /><span id="lname_span" class="lname_span"></span></td>
      </tr>
    
      <!-- <tr>
      	  <td><label for="name"><strong> <?php echo JText::_( 'BACKUP_CONTACT' ); ?>*</strong> </label></td>
       		 <td ><textarea  name="b_contact" id="b_contact"   rows="2" cols="23" class="textarea required"><?php if($err==1){if(isset($_SESSION['b_contact'])){ echo $_SESSION['b_contact']; } }
		?></textarea></td>
      </tr>-->
	 <tr>
        <td><label for="name"> <strong><?php echo JText::_( 'EMAIL_ADDRESS' ); ?>* </strong></label></td>
        <td ><input class="inputbox required" type="text" name="email" id="email" size="30" maxlength="30" value="<?php if($err==1){if(isset($_SESSION['email'])){ echo $_SESSION['email']; } }else{  echo @$this->detail->email;}
		?>" /><span id="email_span" class="email_span"></span></td>
	 </tr>
     <?php if(!$userid->id){ ?>
      <tr>
         <td><label for="name"> <strong><?php echo JText::_( 'CONFIRM_EMAIL' ); ?> </strong></label></td>
         <td ><?php //echo $this->lists['city']; ?>
         <input class="inputbox required" type="text" name="email2" id="email2" size="30" maxlength="30" value="<?php if($err==1){if(isset($_SESSION['email2'])){ echo $_SESSION['email2']; } }
		?>" /><span id="con_email_span" class="con_email_span"></span>
		 </td> 
	</tr><?php }?>
      <tr>
			<td><label for="name"><strong><?php echo JText::_( 'PASSWORD' ); ?>*</strong></label></td>
			<td ><input class="inputbox required validate-passverify" type="password" name="password" id="password" size="30" maxlength="50" value="<?php /*if($err==1){if(isset($_SESSION['rpass'])){ echo $_SESSION['rpass']; } }*/ 
		?>" /><span id="pass_span" class="pass_span"></span></td>
	    </tr>
     <tr>
        <td><label for="name"><strong> <?php  echo JText::_( 'BRITH_OF_DATE' ); ?> </strong></label></td>
        <td ><div class="form_i">
        
		<?php echo $this->lists['day']; ?>
		
		
		<?php echo $this->lists['month']; ?>
        
		<?php echo $this->lists['year']; ?>
		</div>
        
       
 </td>
 </tr>
       <tr>
        <td><label for="name"><strong> <?php echo JText::_( 'SEX' ); ?>* </strong></label></td>
    
		
			<td >
				<?php echo $this->lists['sex'];?><span id="genter_span" class="genter_span"></span>
			</td>
		
	 </tr>
	
	
   
          <?php 
				 $dest = $url.'index.php?option='.$option.'&view=register&task=captchacr&tmpl=component&ac='.rand();
		?>
      <tr>
        <td valign="top"><b><?php echo JText::_( 'WORD_VARIFICATION' ); ?></b></td>
        <td><table cellpadding="0" cellspacing="0" border="0">
           
            <tr>
              <td><div id="default_cap_div"><img src="<?php echo $dest;?>" /></div>
                <div id="refresh_cap_div"></div></td>
              <td><input type="button" name="caprefresh" id="caprefresh" onclick="cap_refresh()" value="<?php echo JText::_( 'REFRESH' ); ?>" class="ref_button" /></td>
            </tr>
            <tr>
              <td colspan="2" valign="top"><?php echo JText::_( 'PLEASE_ENTER_CODE_IN_GIVEN_IMAGE' ); ?></td>
            </tr>
            <tr>
              <td><input class="inputbox" type="text" name="cap" value="" id="cap" /></td>
              <td></td>
            </tr>
          </table></td>
      </tr>
    
    <tr style="padding:10px;">
	    <td colspan="2" ><div class="submit_b"><input type="submit" class="button validate"  name="Save" id="Save" value="Submit" onclick="return registerform_valid();"/></div>
        </td>
      </tr>	 
	</table>

<input type="hidden"  name="jelive_url" id="jelive_url" value="<?php echo $url; ?>" />
<input type="hidden" name="userid" value="<?php  echo $userid->id;?>" />
<input type="hidden" name="view" value="register" />
<input type="hidden" name="task" value="save" />
<?php echo JHTML::_( 'form.token' ); ?>
</form>



