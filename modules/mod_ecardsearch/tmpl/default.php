<?php 
/**
* @package   JE EcardSearch
* @copyright Copyright (C) 2009 - 2010 Open Source Matters. All rights reserved.
* @license   http://www.gnu.org/licenses/lgpl.html GNU/LGPL, see LICENSE.php
* Contact to : emailtohardik@gmail.com, joomextensions@gmail.com
**/

defined('_JEXEC') or die('Restricted access');
jimport('joomla.filesystem.file');
$option = JRequest::getVar('option','','request','string');
$uri = JURI::getInstance();
$url= $uri->root();
$document = JFactory::getDocument();
$document->addScript("modules/mod_ecardsearch/js/ajax.js");
?>
<form name="tour_searchForm" id="tour_searchForm" action="" method="post" >
<table width="100%">
	<tr>
		<td><?php echo $lists['category_list']; ?></td>
	</tr>
	<tr>
        <td><div id="myitemdiv"><select name="pid" id="pid" disabled="disabled"><option value="0"><?php echo JText::_('Please Select'); ?></option></select>
		</div>
        </td>
	</tr>
	<tr>
		<td><input type="submit" name="Search" class="button" id="Search"  value="<?php echo JText::_('SEARCH')?>" /></td>
	</tr>
</table>
<?php

?>
<input type="hidden" name="option" id="option" value="com_jeecard" />
<input type="hidden" name="lilive_url" id="lilive_url" value="<?php echo $url.'index.php?option='.$option.'&view=event_list&task=search';?>" />
<input type="hidden" name="task" id="task" value="search" />
<input type="hidden" name="view" id="view" value="event_list" />

</form>
 