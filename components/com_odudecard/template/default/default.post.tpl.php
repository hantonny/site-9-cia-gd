
<?php
 /**
 * @package ODude ECARD
 * @author ODude.com
 * @copyright (C) 2014 ODude Network. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 **/

defined( '_JEXEC' ) or die( 'Restricted access' );
?>

<b><?php echo $this->cate_name; ?>:</b><br>
<div class="pure-g">
<div class="pure-u-1-3">
<?php
 if(  $params->get( 'show_create' )=='1')
    {
 ?>   
  <a href="<?php echo JRoute::_('index.php?option=com_odudecard&controller=create_ecard&Itemid='.$mymenuitem.'&cate='.$q_cate.'&opt='.$opt); ?>" class="pure-button pure-button-primary"><?php echo JText::_('COM_ODUDECARD_ECARD_CREATE_CARD'); ?></a>&nbsp;
  <?php
}
?></div>
<div class="pure-u-1-3">
<?php
 if(  $params->get( 'show_tube' )=='1')
    {
 ?>   
  <a href="<?php echo JRoute::_('index.php?option=com_odudecard&controller=create_youtube&Itemid='.$mymenuitem.'&cate='.$q_cate.'&opt='.$opt); ?>" class="pure-button pure-button-primary"><?php echo JText::_('COM_ODUDECARD_ECARD_CREATE_TUBE'); ?></a>&nbsp;
  <?php
}
?> </div>
<div class="pure-u-1-3">
<?php
 if(  $params->get( 'show_video' )=='1')
    {
 ?>   
  <a href="<?php echo JRoute::_('index.php?option=com_odudecard&controller=create_video&Itemid='.$mymenuitem.'&cate='.$q_cate); ?>" class="pure-button pure-button-primary"><?php echo JText::_('COM_ODUDECARD_ECARD_CREATE_VIDEO'); ?></a>&nbsp;

  <?php
}
?>
</div>
</div>
<br>