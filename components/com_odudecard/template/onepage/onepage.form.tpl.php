 <fieldset>
	
		<div class="pure-g">
					 <div class="pure-u-1 pure-u-md-1-2">
						<label for="SN">Your Name</label>
					   <input type="text" name="SN" id="SN" class="pure-input-1 required" value="" style="height: 30px;">
					</div>

					 <div class="pure-u-1 pure-u-md-1-2">
						<label for="SE">Your Email</label>
						<input type="email" name="SE" id="SE" class="pure-input-1 required validate-email"  value="" style="height: 30px;">
					</div>
					
					 <div class="pure-u-1 pure-u-md-1-2">
						<label for="name[]">Recipient Name</label>
					  <input type=text name="name[]" id="name[]" class="pure-input-1 required" style="height: 30px;" >
					</div>

					 <div class="pure-u-1 pure-u-md-1-2">
						<label for="email[]">Recipient Email Address</label>
						 <input type=text name="email[]" id="email[]" class="pure-input-1 required validate-email" style="height: 30px;" >
					</div>
					
					 <div class="pure-u-1 pure-u-md-1-4">
						<label for="title">Subject</label>
					
					</div>

					 <div class="pure-u-1 pure-u-md-2-3">
						  <input type="text" name="title" id="title" class="pure-input-1 required" value="" style="height: 30px;">
					</div>
					
					<div class="pure-u-1 pure-u-md-1">
				
					 <textarea name="body" id="body" cols="90" rows="8" class="required pure-input-1" placeholder="Write Your Message"></textarea> 
					</div>
					
						 <div class="pure-u-1 pure-u-md-1">
						<label for="datepicker">Date</label>	<input type="text" name="date1" id="datepicker" placeholder="Send Now" class="pure-input-1-4 pure-input-rounded" style="height: 30px;">
					
					</div>

					 <div class="pure-u-1 pure-u-md-1">
						 <label for="datemsg">	<?php echo JText::_('COM_ODUDECARD_ECARD_DATE_TEXT'); ?></label>
						 
						 <?php
						// JHTML::_('behavior.calendar');
						//echo JHTML::calendar('14-06-2010','field_name', 'field_id',"%d-%m-%Y"); 
 ?>
  
  
					</div>
					<br>
					 <div class="pure-u-1 pure-u-md-1">	
						<input name="notify" type="checkbox" id="notify" value="Y" checked="checked" />      &nbsp;
           
					<?php echo JText::_('COM_ODUDECARD_ECARD_NOTIFY'); ?>
					</div>
	
				
		</div>
</fieldset>