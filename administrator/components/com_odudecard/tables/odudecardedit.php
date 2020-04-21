<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

class Tableodudecardedit extends JTable
{
	var $id = null;
	var $title = null;
	var $slug = null;
	var $cat = 0;
	
	var $file=null;
	var $thumb=null;
	function Tableodudecardedit(& $db) {
		parent::__construct('#__ecard_media', 'id', $db);
	}
}