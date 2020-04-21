
<?php
 /**
 * @package ODude ECARD
 * @author ODude.com
 * @copyright (C) 2014 ODude Network. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 **/

defined( '_JEXEC' ) or die( 'Restricted access' );
?>

<div class=bar><strong><?php echo JText::_('COM_ODUDECARD_ECARD_NO_REC'); ?></strong></div>
<div class="pure-g-r">
<div class="pure-u-1-5">
				<input type="hidden" name="eorm" id="eorm" value="1">
 <input name="rec_no" type="text" id="rec_no" value="1" size="4" maxlength="2" class="required validate-numeric" />
					
</div>
<div class="pure-u-4-5">

  
    (<?php echo JText::_('COM_ODUDECARD_ECARD_ENTER_REC'); ?> 10)
    <?php //echo JText::_('COM_ODUDECARD_ECARD_ENTER_REC_MOBILE'); ?>

</div>
</div>
				
