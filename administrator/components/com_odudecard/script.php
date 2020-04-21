<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * Script file of HelloWorld component
 */
class com_odudecardInstallerScript
{
          function install($parent)
        {
//script to run at the time of install
        }

        /**
         * method to uninstall the component
         *
         * @return void
         */
        function uninstall($parent)
        {
                	echo "Component successfully uninstalled.<br /><br />";
	//echo "<p style='font-family:Verdana; size: 12px;'>Please keep in mind that the <code>/images/ecard/</code> directory is <strong>NOT</strong> deleted. You have to do this by hand.<br> If you upgrade, your images are all still there.</p><br /><br />";
	echo "<p style=\"text-align:center;\">&copy; Copyright 2013 by ODude - <a href=\"http://www.odude.com\" target=\"_blank\">ODude</a></p>";

        }

        /**
         * method to update the component
         *
         * @return void
         */
        function update($parent)
        {
                // $parent is the class calling this method
               // echo '<p>' . JText::_('COM_HELLOWORLD_UPDATE_TEXT') . '</p>';
        }

        /**
         * method to run before an install/update/uninstall method
         *
         * @return void
         */
        function preflight($type, $parent)
        {
                // $parent is the class calling this method
                // $type is the type of change (install, update or discover_install)
                //echo '<p>' . JText::_('COM_HELLOWORLD_PREFLIGHT_' . $type . '_TEXT') . '</p>';
        }

        /**
         * method to run after an install/update/uninstall method
         *
         * @return void
         */
        function postflight($type, $parent)
        {
                // $parent is the class calling this method
                // $type is the type of change (install, update or discover_install)
               // echo '<p>' . JText::_('COM_HELLOWORLD_POSTFLIGHT_' . $type . '_TEXT') . '</p>';
        }
}
?>


