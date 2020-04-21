
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
<?php echo $this->card; ?>
<?php
if($params->get( 'show_postedby')=='1')
{
?>
ONLY for PRO version.<BR>
<?php 
}
?>
</div>

<div class="pure-u-1" style="text-align:center;">

<?php
  if($setting->point==1)
  {
  if($this->point!=0)
   echo "<div class=errorMessage><h1>".JText::_('COM_ODUDECARD_PROFILE_PAY')." ". $this->point." ".JText::_('COM_ODUDECARD_PROFILE_POINT')."</h1></div>";
  }


?>
</div>
</div>