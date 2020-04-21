
<?php
 /**
 * @package ODude ECARD
 * @author ODude.com
 * @copyright (C) 2014 ODude Network. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 **/

defined( '_JEXEC' ) or die( 'Restricted access' );
?>
<div class=bar><strong><?php echo JText::_('COM_ODUDECARD_ECARD_CAPTCHA'); ?></strong></div>


<div class="pure-g-r">
<div class="pure-u-1-5">
				<img src="<?php echo JURI::base(); ?>components/com_odudecard/include/captcha.php" alt="captcha image">
			  <input type="text" name="captcha" size="5" maxlength="3" class="required">

</div>
<div class="pure-u-4-5">
<?php echo JText::_('COM_ODUDECARD_CAPTCHA_3CHAR'); ?>	
	
</div>




</div>