
<?php
 /**
 * @package ODude ECARD
 * @author ODude.com
 * @copyright (C) 2015 ODude Network. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 **/

defined( '_JEXEC' ) or die( 'Restricted access' );
?>


    <fieldset>
      

        <label for="remember">
       <div class="g-recaptcha" data-sitekey="<?php echo $setting->captcha_key; ?>"></div>
		<script src='https://www.google.com/recaptcha/api.js'></script>
        </label>

		
       
    </fieldset>