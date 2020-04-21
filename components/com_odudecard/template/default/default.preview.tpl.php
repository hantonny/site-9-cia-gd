
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
   <input name="cate" type="hidden" id="cate" value="<?php echo $this->cate_alias;  ?>" />  
       <input name="send" type="hidden" id="send" value="<?php echo $this->send;  ?>" />      
          <input name="eorm" type="hidden" id="eorm" value="<?php echo $this->eorm;  ?>" />      
          <input name="point" type="hidden" id="point" value="<?php echo $this->point;  ?>" />  
        <input name="temp" type="hidden" id="temp" value="<?php echo $temp;  ?>" />  
     <input name="image" type="hidden" id="image" value="<?php echo $this->image;  ?>" />  
	 <input name="title" type="hidden" id="title" value="<?php echo $this->title;  ?>" /> 
	 <input name="rec_no" type="hidden" id="rec_no" value="<?php echo $rec_no;  ?>" />   
	<div class="pure-g">
	<div class="pure-u-3-5" style="text-align:left;">

    <fieldset class="pure-group">
        <input type="text" name="SN" id="SN" size="100" class="required" placeholder="<?php echo JText::_('COM_ODUDECARD_ECARD_YOUR_NAME'); ?>" value="<?php echo $SN;  ?>" style="height: 40px;">
        <input type="email" name="SE" id="SE" class="required validate-email"  placeholder=" <?php echo JText::_('COM_ODUDECARD_ECARD_YOUR_EMAIL'); ?>" value="<?php echo $SE;  ?>" style="height: 40px;">
        <input type="text" name="title" id="title" class="required" placeholder="<?php echo JText::_('COM_ODUDECARD_ECARD_SUBJECT'); ?>" value="<?php echo $sub;  ?>" style="height: 40px;">
    </fieldset>
	   
	</div>
	<div class="pure-u-2-5" style="text-align:center;"><br>
	<?php echo getThumb($media_id); ?>
	</div>
   
   <div class="pure-u-1" style="text-align:left;">
     
   <textarea name="body" id="body" cols="90" rows="8" class="required pure-input-1" placeholder="<?php echo JText::_('COM_ODUDECARD_ECARD_MESSAGE'); ?>"><?php echo $body; ?></textarea>   
    </div>

	<div class="pure-g">
	<div class="pure-u-1-2"><div class="l-box"><?php echo JText::_('COM_ODUDECARD_ECARD_REC'); ?></div> </div><div class="pure-u-1-2">  <div class="l-box">  <?php echo JText::_('COM_ODUDECARD_ECARD_REC_EMAIL'); ?></div></div>
	<?php
	
	
                       if (!empty($recipients))
                      {
                      $res1 = preg_match_all( "/\"(.*?)\"/", $recipients,   $matches1  );
                      $res = preg_match_all(
                      "/[a-z0-9]+([_\\.-][a-z0-9]+)*@([a-z0-9]+([\.-][a-z0-9]+)*)+\\.[a-z]{2,}/i",
                      $recipients,  $matches  );
                      $k=0;
                      if ($res)
                      {
                       foreach(array_unique($matches[0]) as $email)
	                   {
                       $k++;
                       if(isset($matches1[0][$k-1]))
                       {
                       if (ereg('@', $matches1[0][$k-1]))
                       {
                       $names="";
                       }
                       else
                        {
                        $names= str_replace('"', '', $matches1[0][$k-1]);
                        }
                      }
                      else
                      {
                        $names="";
                      }
					   echo "<div class=\"pure-u-1-2\"> <div class=\"l-box\"><input type=text name=name[] id=name[] class=\"pure-input-1\" value=\"".$names."\" style=\"height: 30px;\" /></div></div><div class=\"pure-u-1-2\"> <div class=\"l-box\"><input type=email name=email[] id=email[] class='pure-input-1 validate-email' value=\"".$email."\" style=\"height: 30px;\" /></div></div>";
	                  // echo "<tr><td>iii".$k."</td><td > <input type=text name=name[] id=name[] value=\"".$names."\" /></td><td><input type=text name=email[] id=email[] class=email size=50 value=\"".$email."\" /></td></tr>";
                       }
                     }
                      else
                      {
                      //echo "No emails found.";
                      }
                     }
	
	?>
	  
	<?php
	for($x=1;$x<=$rec_no;$x++)
	{
		if(isset($name[$x-1]))
		$nm="value='".$name[$x-1]."'";
		else
		$nm ="";
		
		if(isset($email[$x-1]))
		$em="value='".$email[$x-1]."'";
		else
		$em ="";
		
echo "<div class=\"pure-u-1-2\"><div class=\"l-box\"><input type=text name=\"name[]\" id=\"name[]\" class=\"pure-input-1\" placeholder=\"".JText::_('COM_ODUDECARD_ECARD_REC')."-$x\" ".$nm." style=\"height: 30px;\"></div></div><div class=\"pure-u-1-2\"><div class=\"l-box\"><input type=text name=\"email[]\" id=\"email[]\" class=\"pure-input-1 validate-email\"  placeholder='".JText::_('COM_ODUDECARD_ECARD_REC_EMAIL')."-$x' ".$em." style=\"height: 30px;\" ></div></div>";

}
            	?>    
	
	</div>
	
	
	<div class="pure-u-1">
	     <?php echo JText::_('COM_ODUDECARD_ECARD_DATE_TEXT'); ?><br>
		<?php
            // echo JHTML::calendar('','date1','cal_field_id','%Y-%m-%d');
			
       ?> 
	   
Date: <input type="text" name="date1" id="datepicker" placeholder="Send Now" class="pure-input-1-4" style="height: 30px;">

 <?php
  // echo JHTML::calendar(date("Y-m-d"),'mycalendar', 'date', '%Y-%m-%d',array('size'=>'8','maxlength'=>'10','class'=>' validate[\'required\']',));
  ?>
  
	</div>
	<div class="pure-u-1">
	
	 <input name="notify" type="checkbox" id="notify" value="Y" checked="checked" />      &nbsp;
           
          <?php echo JText::_('COM_ODUDECARD_ECARD_NOTIFY'); ?>
	</div>
   
	</div>
  <input type="submit" name="button" id="button" value="<?php echo JText::_('COM_ODUDECARD_ECARD_SEND_ECARD'); ?>" class="pure-button pure-input-1-2 pure-button-primary"/> 
  <input type="submit" name="button" id="button" value="<?php echo JText::_('COM_ODUDECARD_ECARD_SEND_ECARD_PREVIEW'); ?>" class="pure-button pure-input-1-4 pure-button-primary"/> 
  </form>
</div>

