<?php
// No direct access to this file
defined('_JEXEC') or die;
 
/**
 * HelloWorld component helper.
 */
class odudecardHelper extends JHelperContent
{
        /**
         * Configure the Linkbar.
         */
		 public static $extension = 'com_odudecard';
		 
        public static function addSubmenu($submenu) 
        {
                
                JSubMenuHelper::addEntry(JText::_('Categories'), 'index.php?option=com_odudecard', $submenu == 'categories');
                JSubMenuHelper::addEntry(JText::_('List of Ecards'), 'index.php?option=com_odudecard&controller=odudecardcard', $submenu == 'list');
                 JSubMenuHelper::addEntry(JText::_('NEW JPG/FLASH Ecard'), 'index.php?option=com_odudecard&controller=odudecardcard&task=add', $submenu == 'add');
                JSubMenuHelper::addEntry(JText::_('NEW JPG Auto-Thumbnail Ecard'), 'index.php?option=com_odudecard&view=odudecardthumb', $submenu == 'thumbnail');
               
                  JSubMenuHelper::addEntry(JText::_('Import from Folder'), 'index.php?option=com_odudecard&controller=import', $submenu == 'import');
                JSubMenuHelper::addEntry(JText::_('Statistics'), 'index.php?option=com_odudecard&controller=odudecardstat', $submenu == 'stats');
                JSubMenuHelper::addEntry(JText::_('Setting'), 'index.php?option=com_odudecard&controller=odudecardsetting&task=edit&cid[]=1', $submenu == 'setting');
                // set some global property
                $document = JFactory::getDocument();
                $document->addStyleDeclaration('.icon-48-helloworld {background-image: url(../media/com_helloworld/media/tux-48x48.png);}');
                if ($submenu == 'categories') 
                {
                        $document->setTitle(JText::_('COM_HELLOWORLD_ADMINISTRATION_CATEGORIES'));
                }
				
				
        }
		
}
