
<?php
 /**
 * @package ODude ECARD
 * @author ODude.com
 * @copyright (C) 2014 ODude Network. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 **/

defined( '_JEXEC' ) or die( 'Restricted access' );
?>
<br>
<div class="pure-g">
<div class="pure-u-1 bar" style="text-align:center;">

			<div class="pure-g">
			<div class="pure-u-1-5" style="text-align:center;">
				
				 <?php
	  
					 if($this->prev)
					 echo getThumb($this->prev_id).'<br />'.$this->prev_title.'';
					 else
					 echo " <img src=".JURI::base()."components/com_odudecard/include/spacer.gif width=100>";



				?>
				</div>
				
				<div class="pure-u-1-5" style="text-align:left;">
				
				<?php
					if($this->prev)
					{
					echo '<a rel="example_group" href='.JRoute::_('index.php?option=com_odudecard&id='.$this->prev_id.'&controller=odudecardshow&Itemid='.$mymenuitem.'&cate='.$this->cate) .' title="'.$this->prev_title.'">';
					?>
					<img src="<?php echo JURI::base(); ?>components/com_odudecard/include/prev.png" alt="<?php echo JText::_('COM_ODUDECARD_ECARD_PREV'); ?>" title="<?php echo JText::_('COM_ODUDECARD_ECARD_PREV'); ?>" border=0>     </a>
					<?php
					}
					else
					{
					?>
					<img src="<?php echo JURI::base(); ?>components/com_odudecard/include/bt-prev.gif" alt="<?php echo JText::_('COM_ODUDECARD_ECARD_PREV'); ?>" title="<?php echo JText::_('COM_ODUDECARD_ECARD_PREV'); ?>" border=0>     </a>
					<?php
					}

					?>
				</div>
				
				<div class="pure-u-1-5" style="text-align:center;">
				
				&nbsp;
				
				</div>
				
				<div class="pure-u-1-5" style="text-align:right;">
						
				
				<?php
								if($this->next)
								{
								echo '<a rel="example_group" href='.JRoute::_('index.php?option=com_odudecard&id='.$this->next_id.'&controller=odudecardshow&Itemid='.$mymenuitem.'&cate='.$this->cate) .' title="'.$this->next_title.'">';
								?>
								<img src="<?php echo JURI::base(); ?>components/com_odudecard/include/next.png" alt="<?php echo JText::_('COM_ODUDECARD_ECARD_NEXT'); ?>" title="<?php echo JText::_('COM_ODUDECARD_ECARD_NEXT'); ?>" border=0>     </a>
								<?php
								}
								else
								{
								?>
									 <img src="<?php echo JURI::base(); ?>components/com_odudecard/include/bt-next.gif" alt="<?php echo JText::_('COM_ODUDECARD_ECARD_NEXT'); ?>" title="<?php echo JText::_('COM_ODUDECARD_ECARD_NEXT'); ?>" border=0>
								<?php
								}
								?>
				
				
				</div>
				
				<div class="pure-u-1-5" style="text-align:center;">
				<?PHP
    
								if($this->next)
								 echo getThumb($this->next_id).'<br />'.$this->next_title.'';
								 else
								echo " <img src=".JURI::base()."components/com_odudecard/include/spacer.gif width=100>";


							  ?>
				</div>
		</div>		
				
</div>
</div>
<br>