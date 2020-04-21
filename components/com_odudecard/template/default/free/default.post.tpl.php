
<?php
 /**
 * @package ODude ECARD
 * @author ODude.com
 * @copyright (C) 2014 ODude Network. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 **/

defined( '_JEXEC' ) or die( 'Restricted access' );
?>
<div class="pure-g-r">
<div class="pure-u-1-3">
<?php
 if(  $params->get( 'show_create' )=='1')
    {
 ?>   
  <a href="#" class="ODude"><?php echo $this->cate_name." : ".JText::_('COM_ODUDECARD_ECARD_CREATE_CARD'); ?></a><br><a href="http://www.odude.com/" target="_blank">BUY ODude Ecard PRO</a><br />
  You can hide this button from <br>ODude Ecard Control panel > Options Button
 <br> 

  <?php
}
?>
 </div>
<div class="pure-u-1-3">
<?php
 if(  $params->get( 'show_tube' )=='1')
    {
 ?>   
  <a href="#" class="ODude"><?php echo $this->cate_name." : ".JText::_('COM_ODUDECARD_ECARD_CREATE_TUBE'); ?></a><br><a href="http://www.odude.com/" target="_blank">BUY ODude Ecard PRO</a><br />
  <?php
}
?> <br> </div>
<div class="pure-u-1-3">
<?php
 if(  $params->get( 'show_video' )=='1')
    {
 ?>   
  <a href="#" class="ODude"><?php echo $this->cate_name." : ".JText::_('COM_ODUDECARD_ECARD_CREATE_VIDEO'); ?></a><br><a href="http://www.odude.com/" target="_blank">BUY ODude Ecard PRO</a><br />
  <br />
  <?php
}
?>
</div>
</div>