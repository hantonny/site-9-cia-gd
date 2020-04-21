
<?php
 /**
 * @package ODude ECARD
 * @author ODude.com
 * @copyright (C) 2014 ODude Network. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 **/

defined( '_JEXEC' ) or die( 'Restricted access' );

?>
<style>
    .l-box {
        padding: 1px;
    }
</style>

<div class="bar"><strong> <?php echo JText::_('COM_ODUDECARD_ECARD_TYPE_INFO'); ?></strong></div>
<div class="box"> 
  <form id='myForm' action="<?php echo JRoute::_("index.php?option=com_odudecard&amp;controller=cardsend&amp;Itemid=$mymenuitem");?>" method="post" class="pure-form form-validate" onSubmit="return myValidate(this);"> 
  <input name="id" type="hidden" id="id" value="<?php echo $iid;  ?>" />      
   <input name="cate" type="hidden" id="cate" value="<?php echo $this->cate;  ?>" />  
       <input name="send" type="hidden" id="send" value="<?php echo $this->send;  ?>" />      
          <input name="eorm" type="hidden" id="eorm" value="<?php echo $this->eorm;  ?>" />      
          <input name="point" type="hidden" id="point" value="<?php echo $this->point;  ?>" />  
        <input name="temp" type="hidden" id="temp" value="<?php echo $temp;  ?>" />  
   
	<div class="pure-g-r">
	<div class="pure-u-1-2" style="text-align:left;">
    <fieldset class="pure-group">
        <input type="text" name="SN" id="SN" class="pure-input-1 required" placeholder="<?php echo JText::_('COM_ODUDECARD_ECARD_YOUR_NAME'); ?>">
        <input type="email" name="SE" id="SE" class="pure-input-1 required validate-email"  placeholder=" <?php echo JText::_('COM_ODUDECARD_ECARD_YOUR_EMAIL'); ?>">
        <input type="text" name="title" id="title" class="pure-input-1 required" placeholder="<?php echo JText::_('COM_ODUDECARD_ECARD_SUBJECT'); ?>">
    </fieldset>
	   
	</div>
	<div class="pure-u-1-2" style="text-align:center;"><br>
	<?php echo getThumb($iid); ?>
	</div>
   
   <div class="pure-u-1" style="text-align:left;">
     
   <textarea name="body" id="body" cols="90" rows="8" class="required" placeholder="<?php echo JText::_('COM_ODUDECARD_ECARD_MESSAGE'); ?>"></textarea>   
    </div>
	<div class="pure-g">
	<div class="pure-u-1-2"><div class="l-box"><?php echo JText::_('COM_ODUDECARD_ECARD_REC'); ?></div> </div><div class="pure-u-1-2">  <div class="l-box">  <?php echo JText::_('COM_ODUDECARD_ECARD_REC_EMAIL'); ?></div></div>

	
	<?php
	for($x=1;$x<=$rec_no;$x++)
	{
	
 echo "<div class=\"pure-u-1-2\"><div class=\"l-box\"><input type=text name=name[] id=name[] class=\"pure-input-1\" placeholder=\"".JText::_('COM_ODUDECARD_ECARD_REC')."-$x\" /></div></div><div class=\"pure-u-1-2\"><div class=\"l-box\"><input type=text name=email[] id=email[] class='pure-input-1 validate-email'  placeholder=\"".JText::_('COM_ODUDECARD_ECARD_REC_EMAIL')."-$x\" /></div></div>";
}
            	?>    
	</div>
	<input type="hidden" name="date1" id="date1" value="">
	<input type="hidden" name="notify" id="notify" value="N">

   
	</div><br>
  <input type="submit" name="button" id="button" value="<?php echo JText::_('COM_ODUDECARD_ECARD_SEND_ECARD'); ?>" class="pure-button pure-input-1-2 pure-button-primary"/> 
</form>
</div>

