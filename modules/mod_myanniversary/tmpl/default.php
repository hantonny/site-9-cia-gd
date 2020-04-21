<?php
date_default_timezone_set('UTC');
 /**
*
* MyAnniversary tells you about anniversaries of a current day
*
* Copyright (C) 2012-2018 mokhin-tech.ru. All rights reserved. 
*
* Author is:
* Denis Mokhin < denis@mokhin-tech.ru >
* http://mokhin-tech.ru
*
* @license GNU GPL, see http://www.gnu.org/licenses/gpl-2.0.html
* 
* This program is free software; you can redistribute it and/or
* modify it under the terms of the GNU General Public License
* as published by the Free Software Foundation; either version 2
* of the License, or (at your option) any later version.
*
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.
*
**/
 
// no direct access
defined('_JEXEC') or die('Restricted access'); ?>

<?php if(empty($list)) {
	echo JText::_("MOD_MYANNIVERSARY_NOANNIVERSARY");
	} ?>

<ul class="myanniversary<?php echo $params->get('moduleclass_sfx'); ?>">
<?php foreach ($list as $item) :  ?>
	<li class="myanniversary<?php echo $params->get('moduleclass_sfx'); ?>">
		
		<?php if($item->years==0) {?>
			<?php 
			
			if(date('d/m/Y',strtotime($item->create_rel)) == date('d/m/Y')){
				echo "<img src='http://localhost/site9ciagd/modules/mod_myanniversary/tmpl/caixa.png'>";
				echo " - ";
				echo "<strong>".date('d/m/Y',strtotime($item->create_rel)).": </strong>";
				echo JText::_("MOD_MYANNIVERSARY_TODAYWECELEBRATE");
				echo $item->title;
			}else if(date('Y-m-d H:i:s') < date('d/m/Y',strtotime($item->create_rel))){
				echo "<img src='http://localhost/site9ciagd/modules/mod_myanniversary/tmpl/calendario(1).png'>";
				echo " - ";
				echo date('d/m/Y',strtotime($item->create_rel)).": ";
				echo JText::_("MOD_MYANNIVERSARY_NEXT");
				echo $item->title;
			}
			?>
		
			<?php 

			/*
			if(date('d/m/Y',strtotime($item->create_rel)) == date('d/m/Y')){
				echo "<strong>".date('d/m/Y',strtotime($item->create_rel)).".</strong>";
			}else{
				echo date('d/m/Y',strtotime($item->create_rel)).".";
			} 
			*/
			?>
			
		<?php }
		else
		{ ?>
		<?php echo $item->years; ?><?php echo JText::_("MOD_MYANNIVERSARY_OFEVENT"); ?> <a href="<?php echo $item->link; ?>" class="myanniversary<?php echo $params->get('moduleclass_sfx'); ?>">
			<?php echo $item->title; ?></a>
		<?php } ?>
	</li>
<?php endforeach; ?>
</ul>	