
<?php
 /**
 * @package ODude ECARD
 * @author ODude.com
 * @copyright (C) 2014 ODude Network. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 **/

defined( '_JEXEC' ) or die( 'Restricted access' );
?>

<div class="pure-g">
<div class="pure-u-1" style="text-align:center;">
<?php echo $this->code; ?>
</div>
<div class="pure-u-1" style="text-align:center;">
<?php echo $this->card; ?><br>
<?php
if($params->get( 'show_postedby')=='1')
{
?>

<?php echo JText::_('COM_ODUDECARD_POSTED_BY'); ?> :<a href='<?php echo JRoute::_('index.php?option=com_odudecard&controller=cardmylist&Itemid='.$mymenuitem.'&id='.$this->user); ?>' > <?php echo $this->user; ?> </a>
<BR>
<?php 
}
?>
</div>

<div class="pure-u-1" style="text-align:center;">

<?php
  if($setting->point==1)
  {
  if($this->point!=0)
   echo "<h3>".JText::_('COM_ODUDECARD_PROFILE_PAY')." ". $this->point." ".JText::_('COM_ODUDECARD_PROFILE_POINT')."</h3>";
  }


?>
</div>
</div>