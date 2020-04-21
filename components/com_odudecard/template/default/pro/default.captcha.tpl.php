
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

    <fieldset>
        <legend><?php echo JText::_('COM_ODUDECARD_CAPTCHA_3CHAR'); ?>	</legend>

     

        <label for="remember">
         <img src="<?php echo JURI::base(); ?>components/com_odudecard/include/captcha.php" alt="captcha image"><br><input type="text" name="captcha" size="5" maxlength="3" class="required ">  
        </label>

       
    </fieldset>